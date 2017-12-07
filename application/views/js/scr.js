scr = {
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){scr.nuevaSucursal({})});
		$("#scrTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,scr[f](d)});
		$("#srchFrm").validation({success:function(o){$("#scrTbl tbody").empty(),scr.sucursalesTable(o)}})
		scr.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#scrTbl tbody").empty();
		scr.sucursalesTable({});
	},
	sucursalesTable:function(o){
		$.ajax({type : "POST",url : "sucursalesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#scrTbl tbody").append(r);
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaSucursal:function(o){
		$.ajax({type:"POST",url :  "nuevaSucursal",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevaSucursal').modal({show:true,backdrop:'static'});
			$('#nuevaSucursal').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_sucursal){				
				s = $('#nuevaSucursal .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$("#nvaScrFrm").validation({extend:o,success:function(ob){scr.guardarSucursal(ob)}})
		});
	},
	guardarSucursal:function(o){		
		console.log(o)
		$.ajax({type : "POST",url : "guardarSucursal",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevaSucursal').modal('hide'),scr.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
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
					        	$.ajax({type : "POST",url : "borrarSucursal",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),scr.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
