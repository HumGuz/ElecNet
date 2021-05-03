prv = {
	path:'../application/views/proveedores/',
	request:'../proveedores/',
	init:function(i){
		$("body").catalogo({
			title : 'Proveedores',id_c:"prv_c",view : prv.request,post : i,
			callback : function(i) {			
				$("#tbl-prv").scrollTable({
					parent : $("#catalogo-prv"),
					source :  prv.request+"proveedoresTable",
					extend : i,
					singleFilter : $("#busqueda-prv")
				});
			}
		});
	},	
	clean:function(i){$("#tbl-prv").scrollTable('clean')},
	nuevoProveedor:function(o){
		$("body").formModal({title : "Nuevo Proveedor",id : "prv",modal :prv.request+"nuevoProveedor",post : o,
			callback : function(i) {
				md = $('#prv-modal');				
				if(o && o.id_proveedor){				
					s = md.find('.modal-content').data();
					for(i in s)
						(md.find("#"+i).length && md.find("#"+i).val(s[i]));
				}
				$.validator.addMethod("rfc", function(value, element, params) {return  prv.rfcValido($.trim(value).toUpperCase()) }, 'El RFC es inválido');
				md.find("#nvoPrvFrm").validation({extend:o,success:function(ob){prv.guardarProveedor(ob)}})
			}
		})
	},
	guardarProveedor:function(o){	
		app.spin('#nvoPrvFrm button.ladda-button');	
		console.log(o)
		$.ajax({type : "POST",url :  prv.request+"guardarProveedor",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('prv'),app.updateByTag('prv')) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarProveedor:function(o){
		$.confirm({ title: 'Borrar Proveedor',content: '¿Esta seguro de querer borrar este proveedor?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el proveedor, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : prv.request+"borrarProveedor",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),app.updateByTag('prv')) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
