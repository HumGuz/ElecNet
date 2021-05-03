<<<<<<< HEAD
scr = {
	path:'../application/views/sucursales/',
	request:'../sucursales/',
	init:function(i){		
		$("body").catalogo({
			title : 'Sucursales',id_c:"scr_c",view : scr.request,post : i,tag : "scr",
			callback : function(i) {			
				$("#tbl-scr").scrollTable({
					parent : $("#catalogo-scr"),
					source :  "../sucursales/sucursalesTable",
					extend : i,
					singleFilter : $("#busqueda-scr")
				});
			}
		})
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#scrTbl tbody").empty();
		scr.sucursalesTable({});
	},
	sucursalesTable:function(o){
		$(".overlay").show();
		$.ajax({type : "POST",url : "sucursalesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#scrTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaSucursal:function(i){
		$("body").formModal({title : "Nueva Sucursal",id : "scr",modal :scr.request+"nuevaSucursal",post : i,
			callback : function(i) {				
				if(i && i.id_sucursal){				
					s = $('#scr-modal .modal-content').data();
					for(k in s)
						($("#"+k).length && $("#"+k).val(s[k]));
				}				
				$("#nvaScrFrm").validation({extend:i,success:function(i){scr.guardarSucursal(i)}})	
			}
		});
	},
	guardarSucursal:function(o){	
		(Ladda.create(document.querySelector( '#sb-scr' ))).start();
		$.ajax({type : "POST",url : scr.request+"guardarSucursal",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('scr')) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarSucursal:function(o){
		$.confirm({ title: 'Borrar Sucursal',content: '¿Esta seguro de querer borrar esta sucursal?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la sucursal, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "../sucursales/borrarSucursal",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),scr.clear()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
=======
scr = {
	path:'../application/views/sucursales/',
	request:'../sucursales/',
	init:function(i){		
		$("body").catalogo({
			title : 'Sucursales',id_c:"scr_c",view : scr.request,post : i,tag : "scr",
			callback : function(i) {			
				$("#tbl-scr").scrollTable({
					parent : $("#catalogo-scr"),
					source :  "../sucursales/sucursalesTable",
					extend : i,
					singleFilter : $("#busqueda-scr")
				});
			}
		})
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#scrTbl tbody").empty();
		scr.sucursalesTable({});
	},
	sucursalesTable:function(o){
		$(".overlay").show();
		$.ajax({type : "POST",url : "sucursalesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#scrTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaSucursal:function(i){
		$("body").formModal({title : "Nueva Sucursal",id : "scr",modal :scr.request+"nuevaSucursal",post : i,
			callback : function(i) {				
				if(i && i.id_sucursal){				
					s = $('#scr-modal .modal-content').data();
					for(k in s)
						($("#"+k).length && $("#"+k).val(s[k]));
				}				
				$("#nvaScrFrm").validation({extend:i,success:function(i){scr.guardarSucursal(i)}})	
			}
		});
	},
	guardarSucursal:function(o){	
		(Ladda.create(document.querySelector( '#sb-scr' ))).start();
		$.ajax({type : "POST",url : scr.request+"guardarSucursal",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('scr')) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarSucursal:function(o){
		$.confirm({ title: 'Borrar Sucursal',content: '¿Esta seguro de querer borrar esta sucursal?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la sucursal, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "../sucursales/borrarSucursal",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),scr.clear()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
