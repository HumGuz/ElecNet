alm = {
	path:'../application/views/almacenes/',
	request:'../almacenes/',
	init:function(i){
		$("body").catalogo({
			title : 'Almacenes',id_c:"alm_c",view : alm.request,post : i,
			callback : function(i) {			
				$("#tbl-alm").scrollTable({
					parent : $("#catalogo-alm"),
					source :  alm.request+"almacenesTable",
					extend : i,
					singleFilter : $("#busqueda-alm")
				});
			}
		});
	},	
	nuevoAlmacen:function(i){		
		$("body").formModal({title : "Nuevo Almacen",id : "alm",modal :alm.request+"nuevoAlmacen",post : i,
			callback : function(i) {				
				if(i && i.id_almacen){				
					s = $('#alm-modal .modal-content').data();
					for(k in s)
						($("#"+k).length && $("#"+k).val(s[k]));
				}				
				$("#nvoAlmFrm").validation({extend:i,success:function(i){alm.guardarAlmacen(i)}})	
			}
		})
	},
	guardarAlmacen:function(o){	
		app.spin('#nvoAlmFrm button.ladda-button');				
		console.log(o)
		$.ajax({type : "POST",url : alm.request+"guardarAlmacen",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('alm')) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarAlmacen:function(o){
		$.confirm({ title: 'Borrar Almacén',content: '¿Esta seguro de querer borrar este almacén?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el almacén, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url :  alm.request+"borrarAlmacen",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),app.close('alm')) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
