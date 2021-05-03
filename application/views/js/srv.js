srv = {	
	path:'../application/views/servicios/',
	request:'../servicios/',		
	init:function(i){		
		$("body").catalogo({
			title : 'Servicios',id_c:"srv_c",view : srv.request,post : i,
			callback : function(i) {			
				$("#tbl-srv").scrollTable({
					parent : $("#catalogo-srv"),
					source : srv.request+ "serviciosTable",
					extend : i,
					singleFilter : $("#busqueda-srv"),
					advancedFilter: $("#srch-srv")					
				});				
				c = $("#seccion-srv");
				c.find(".selectpicker").selectpicker({});	
				srv.initClas(c);	
			}
		});
	},
	clean:function(i){$("#tbl-srv").scrollTable('clean')},
	initClas:function(c){
		dep = c.find("#id_departamento"),
		catp = c.find("#id_categoria_padre"),
		cath = c.find("#id_categoria");
		dep.change(function(){
			vl =$(this).val(),c.find(".categorias").val(''),c.find(".categorias option").prop('disabled',true),					
			(vl!='' &&  c.find(".categorias option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
			c.find(".categorias").selectpicker('refresh');					
		}),		
		catp.change(function(){
			vl =$(this).val(),cath.val(''),cath.find("option").prop('disabled',true),					
			(vl!='' &&  cath.find("option[data-id_categoria_padre='"+vl+"']").prop('disabled',false) ),
			cath.selectpicker('refresh');					
		});
	},		
	nuevoServicio:function(o){		
		$("body").formModal({title : "Nuevo Servicio",id : "srv",modal :srv.request+"nuevoServicio",post : o,
			callback : function(o) {
				md = $('#srv-modal'); 					
				var s,rules = {},msj = {}
				srv.initClas(md)	
				if(o && o.id_servicio){				
					s = md.find('.modal-content').data();		
					md.find( "#id_departamento" ).val(s.id_departamento).change();
					md.find( "#id_categoria_padre" ).val(s.id_categoria_padre).change();
					md.find( "#id_categoria" ).val(s.id_categoria);		
					for(i in s)
						(md.find("#"+i).length && md.find("#"+i).val(s[i]));
					md.find( "#clave" ).attr('disabled','disabled')					
				}else{							
					rules = {clave:{remote:{ url: srv.request+"claveUnica",type: "POST",data: {id_sucursal:o.id_sucursal,clave: function() {return md.find( "#clave" ).val();}}}}},
					msj = {clave:{remote:"Esta clave ya esta en uso"}}
				}		
				$("#nvoSrvFrm .selectpicker").selectpicker('refresh'),				
				$("#nvoSrvFrm").validation({extend:o,rules:rules,messages:msj,success:function(ob){srv.guardarServicio(ob)}})
			}
		});
	},
	guardarServicio:function(o){
		app.spin('#nvoSrvFrm button.ladda-button');					
		$.ajax({type : "POST",url : srv.request+"guardarServicio",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('srv'),app.updateByTag('srv')) : app.error();})
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
					        	$.ajax({type : "POST",url : srv.request+"borrarServicio",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),app.updateByTag('srv')) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}
};
