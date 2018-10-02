srv = {
	md:null,
	limit:0,filter:{},
	init:function(){		
		$('body').on('click',"[data-fn]",function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn,delete d['bs.tooltip'],delete d['placement'],delete d.toggle,delete d.trigger ,srv[f](d)});		
		srv.initFilter($("section.content"));
	},	
	initFilter:function(md){
		srv.md = md;
		srv.limit = 0,srv.filter= {},		
		md.find(".selectpicker").selectpicker({});
		var s,i = md.find("#busqueda_out");
		i.keyup(function(){if(s) clearTimeout(s),s = setTimeout(function() {srv.limit = 0,srv.filter= {},val = $.trim(i.val()),srv.serviciosTable({busqueda:val,id_sucursal:md.find("#id_sucursal").val(),limit:0})},500)})	
		srv.initClas(md);		
		$("#fltrSrvFrm").validation({extend:{},success:function(ob){
			$("#srvTbl tbody").empty(),srv.limit = 0,srv.filter= ob,ob.limit = 0,
			srv.serviciosTable(ob)
		}})
		srv.serviciosTable({limit:0});		
	},	
	initClas:function(c,d,cp,ch){	
		suc = c.find("#id_sucursal"),
		dep = c.find("#id_departamento"),
		catp = c.find("#id_categoria_padre"),
		cath = c.find("#id_categoria"),
		suc.change(function(){srv.serviciosTable({limit:0})}),			
		dep.change(function(){
			vl =$(this).val(),c.find(".categorias").val(''),c.find(".categorias option").prop('disabled',true),					
			(vl!='' &&  c.find(".categorias option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
			c.find(".categorias").selectpicker('refresh');					
		}),
		(d && dep.val(d)),dep.change(),			
		catp.change(function(){
			vl =$(this).val(),cath.val(''),cath.find("option").prop('disabled',true),					
			(vl!='' &&  cath.find("option[data-id_categoria_padre='"+vl+"']").prop('disabled',false) ),
			cath.selectpicker('refresh');					
		}),
		(cp && catp.val(cp)),catp.change(),(ch && cath.val(ch) && cath.selectpicker('refresh'))
	},	
	clearSrv:function(){		
		$("#fltrSrvFrm").resetForm(),$("#fltrSrvFrm select").selectpicker('refresh'),$("#fltrSrvFrm").submit()		
	},		
	serviciosTable:function(o){
		$(".overlay").show();			
		srv.filter = $.extend({},0,{id_sucursal:srv.md.find("#id_sucursal").val()})			
		$.ajax({type : "POST",url : "serviciosTable",dataType : "html",data : srv.filter})
		.done(function(r) {
			($.trim(r)!='' && $("#srvTbl tbody").append(r)),
			($(r).find('tr').length && srv.scr()),$(".overlay").hide();			
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	scr:function(){
		$(".scroller-tbl").scroll(function(){
	    	control = this; 
	        if ($(control).scrollTop() >= $(control)[0].scrollHeight - $(control).outerHeight()-100){ 	               
	        	$(this).unbind('scroll');
	            srv.limit += 50;
                obj = $.extend({},srv.filter,{id_sucursal:srv.id_sucursal,limit:srv.limit});
                srv.serviciosTable( obj );
	        }                  
	  	}); 
	},
	nuevoServicio:function(o){	
		o.id_sucursal = $("#id_sucursal").val();
		$.ajax({type:"POST",url :  "nuevoServicio",dataType : "html",data:o}).done(function(r) {
			$('body').append(r),md = $('#nuevoServicio'); 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});			
			var s,rules = {},msj = {}
			if(o && o.id_servicio){				
				s = $('#nuevoServicio .modal-content').data();				
				for(i in s)
					(md.find("#"+i).length && md.find("#"+i).val(s[i]));
				md.find( "#clave" ).attr('disabled','disabled'),
				srv.initClas(md,s.id_departamento,s.id_categoria_padre,s.id_categoria)
			}else{	
				srv.initClas(md)		
				rules = {
					clave:{remote:{ url: "claveUnica",type: "POST",data: {id_sucursal:o.id_sucursal,clave: function() {return md.find( "#clave" ).val();}}}},
					clave_secundaria:{remote:{ url: "claveUnica",type: "POST",data: {id_sucursal:o.id_sucursal,clave_secundaria: function() {return md.find( "#clave_secundaria" ).val();}}}}
				},
				msj = {clave:{remote:"Esta clave ya esta en uso"},clave_secundaria:{remote:"Esta clave ya esta en uso"}}
			}		
			$("#nvoPrdFrm .selectpicker").selectpicker({}),				
			$("#nvoPrdFrm").validation({extend:o,rules:rules,messages:msj,success:function(ob){srv.guardarServicio(ob)}})
		});
	},
	guardarServicio:function(o){		
		(Ladda.create(document.querySelector( '#nvoPrdFrm button.ladda-button' ))).start();		
		$.ajax({type : "POST",url : "guardarServicio",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#nuevoServicio').modal('hide'),srv.clearSrv()) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarServicio:function(o){
		$.confirm({ title: 'Borrar servicio',content: '¿Esta seguro de querer borrar este servicio?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el servicio , ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarServicio",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),srv.clearSrv()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}
};
