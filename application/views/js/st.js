st = {
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){st.agregarProducto({})});
		$("#stTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,st[f](d)});
		$("#srchFrm").validation({success:function(o){$("#stTbl tbody").empty(),st.productosTable(o)}})
		// st.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#stTbl tbody").empty();
		st.productosTable({});
	},
	productosTable:function(o){
		$(".overlay").show();
		$.ajax({type : "POST",url : "productosTable",dataType : "html",data : o})
		.done(function(r) {
			$("#stTbl tbody").append(r),$(".overlay").hide();
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	agregarProducto:function(o){
		$.ajax({type:"POST",url :  "agregarProducto",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#agregarProducto').modal({show:true,backdrop:'static'});
			$('#agregarProducto').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_sucursal){				
				s = $('#agregarProducto .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$("#nvaScrFrm").validation({extend:o,success:function(ob){st.guardarSucursal(ob)}})
		});
	},
	guardarProducto:function(o){	
		(Ladda.create(document.querySelector( '#gNO' ))).start();			
		console.log(o)
		$.ajax({type : "POST",url : "guardarProducto",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),$('#agregarProducto').modal('hide'),st.clear()) :app.error()})
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
									1 == r.status ? (app.ok(),st.clear()) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
