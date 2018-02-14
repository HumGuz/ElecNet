alm = {
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){alm.nuevoAlmacen({})});
		$("#almTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,alm[f](d)});
		$("#srchFrm").validation({success:function(o){$("#almTbl tbody").empty(),alm.almacenesTable(o)}})
		alm.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#almTbl tbody").empty();
		alm.almacenesTable({});
	},
	almacenesTable:function(o){
		$(".overlay").show();
		$.ajax({type : "POST",url : "almacenesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#almTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevoAlmacen:function(o){
		$.ajax({type:"POST",url :  "nuevoAlmacen",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevoAlmacen').modal({show:true,backdrop:'static'});
			$('#nuevoAlmacen').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_almacen){				
				s = $('#nuevoAlmacen .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$("#nvoAlmFrm .selectpicker").selectpicker({}),
			$("#nvoAlmFrm").validation({extend:o,success:function(ob){alm.guardarAlmacen(ob)}})
		});
	},
	guardarAlmacen:function(o){	
		(Ladda.create(document.querySelector( '#gNO' ))).start();				
		console.log(o)
		$.ajax({type : "POST",url : "guardarAlmacen",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevoAlmacen').modal('hide'),alm.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
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
					        	$.ajax({type : "POST",url : "borrarAlmacen",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),alm.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
