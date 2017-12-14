ord = {
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){ord.nuevaOrden({})});
		$("#ordTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,ord[f](d)});
		$("#srchFrm").validation({success:function(o){$("#ordTbl tbody").empty(),ord.ordenesTable(o)}});		
		strt = moment().subtract(6, 'days');
		end =  moment();
		cb =  function (start, end, lbl) {	      
	       	$("#srchFrm").find('#daterange-btn span').html('<b>'+lbl+'</b> del '+start.format('D MMMM YYYY') + ' al ' + end.format('D MMMM YYYY'));	        
	        $("#srchFrm").find("#fecha_inicial").val(start.format('YYYY-MM-DD'))
	        $("#srchFrm").find("#fecha_final").val(start.format('YYYY-MM-DD'))
	    };		
		$("#srchFrm").find('#daterange-btn').daterangepicker({
			locale:{format: 'YYYY-MM-DD'},
			startDate: strt,
        	endDate: end,
	        opens: "left",
    		drops: "up",		
    		autoApply:true,
	        ranges: {
	          'Hoy'       : [moment(), moment()],
	          'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	          'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],
	          'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],
	          'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
	          'Mes Anterior'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        }	     
	      },cb);		 
		  cb(strt,end,'Últimos 7 Días');		 
		  ord.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();
		
		$("#ordTbl tbody").empty();
		ord.ordenesTable({});
	},
	ordenesTable:function(o){
		console.log(o)
		$.ajax({type : "POST",url : "ordenesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#ordTbl tbody").append(r);
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaOrden:function(o){
		$.ajax({type:"POST",url :  "nuevaOrden",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevaOrden').modal({show:true,backdrop:'static'});
			$('#nuevaOrden').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_orden_compra){				
				s = $('#nuevaOrden .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}			
			$("#nvoPrvFrm").validation({extend:o,rules:{rfc:{rfc:true}},success:function(ob){ord.guardarOrden(ob)}})
		});
	},		
	guardarOrden:function(o){		
		console.log(o)
		$.ajax({type : "POST",url : "guardarOrden",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevaOrden').modal('hide'),ord.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarOrden:function(o){
		$.confirm({ title: 'Borrar Orden de compra',content: '¿Esta seguro de querer borrar esta orden de compra?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la orden, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarOrden",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),ord.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
