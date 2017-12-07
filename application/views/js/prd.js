prd = {
	init:function(){		
		// $("div.box-tools button.btn.btn-success").click(function(){prd.nuevoProducto({})});
		// $("#prdTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,prd[f](d)});
		// $("#srchFrm").validation({success:function(o){$("#prdTbl tbody").empty(),prd.productosTable(o)}})
		// prd.clear({});
		
		$('body').on('click',"[data-fn]",function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn,delete d['bs.tooltip'],delete d.toggle,delete d.trigger ,prd[f](d)});
	},
	
	productosAlmacen:function(o){
		$.ajax({type : "POST",url : "productosAlmacen",dataType : "html",data : o})
		.done(function(r) {
			$('body').append(r),
			md = $("#prodAlm-modal"),		
			md.modal({backdrop:'static',show:true}).on('hidden.bs.modal',function(){$(this).remove();});	
			prd.productosTable(o),
			prd.initFilter(md);
		}).fail(function(e, t, i) {console.log(e, t, i)});
	},	
	
	initFilter:function(md){
		md.find(".selectpicker").selectpicker({})
		var s,i = md.find("#busqueda_out");
		i.keyup(function(){if(s) clearTimeout(s),s = setTimeout(function() {val = $.trim(i.val()),prd.productosTable({busqueda:val,id_almacen:o.id_almacen})},500)})	
		prd.initClas(md);
		
		
	},
	
	initClas:function(c){
		c.find("#id_departamento").change(function(){
			vl =$(this).val(),
			c.find(".categorias").val(''),
			c.find(".categorias option").prop('disabled',true),					
			(vl!='' &&  c.find(".categorias option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
			c.find(".categorias").selectpicker('refresh');					
		}).change();			
		c.find("#id_categoria_padre").change(function(){
			vl =$(this).val(),
			c.find("#id_categoria").val(''),
			c.find("#id_categoria option").prop('disabled',true),					
			(vl!='' &&  c.find("#id_categoria option[data-id_categoria_padre='"+vl+"']").prop('disabled',false) ),
			c.find("#id_categoria").selectpicker('refresh');					
		}).change();
	},
	
	clearAlm:function(){
		// $("#srchFrm").resetForm();
		// $("#prdTbl tbody").empty();
		// prd.productosTable({});
	},	
	
	productosTable:function(o){
		$.ajax({type : "POST",url : "productosTable",dataType : "html",data : o})
		.done(function(r) {
			$("#prdTbl tbody").append(r);
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevoProducto:function(o){
		$.ajax({type:"POST",url :  "nuevoProducto",dataType : "html",data:o}).done(function(r) {
			$('body').append(r); 
			md = $('#nuevoProducto'); 
			md.modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});			
			prd.initClas(md)
			if(o && o.id_producto){				
				s = $('#nuevoProducto .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$("#nvoPrdFrm .selectpicker").selectpicker({}),
			$("#nvoPrdFrm").validation({extend:o,success:function(ob){prd.guardarProducto(ob)}})
		});
	},
	guardarProducto:function(o){		
		console.log(o)
		$.ajax({type : "POST",url : "guardarProducto",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevoProducto').modal('hide'),prd.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarProducto:function(o){
		$.confirm({ title: 'Borrar Almacén',content: '¿Esta seguro de querer borrar este prdacén?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el prdacén, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarProducto",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),prd.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
