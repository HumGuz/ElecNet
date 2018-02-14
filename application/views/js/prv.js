prv = {
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){prv.nuevoProveedor({})});
		$("#prvTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,prv[f](d)});
		$("#srchFrm").validation({success:function(o){$("#prvTbl tbody").empty(),prv.proveedoresTable(o)}})
		prv.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#prvTbl tbody").empty();
		prv.proveedoresTable({});
	},
	proveedoresTable:function(o){
		$.ajax({type : "POST",url : "proveedoresTable",dataType : "html",data : o})
		.done(function(r) {
			$("#prvTbl tbody").append(r);
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevoProveedor:function(o){
		$.ajax({type:"POST",url :  "nuevoProveedor",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevoProveedor').modal({show:true,backdrop:'static'});
			$('#nuevoProveedor').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_proveedor){				
				s = $('#nuevoProveedor .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$.validator.addMethod("rfc", function(value, element, params) {
			    return  prv.rfcValido($.trim(value).toUpperCase()) ; 
			}, 'El RFC es inválido');
			$("#nvoPrvFrm").validation({extend:o,rules:{rfc:{rfc:true}},success:function(ob){prv.guardarProveedor(ob)}})
		});
	},
	
	rfcValido: function (rfc,aceptarGenerico) {
	    const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
	    var   validado = rfc.match(re);	
	    if (!validado)
	        return false;
	    const digitoVerificador = validado.pop(), rfcSinDigito = validado.slice(1).join(''),len= rfcSinDigito.length,	
	    diccionario = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ", indice  = len + 1;
	    var   suma, digitoEsperado;	
	    if (len == 12) suma = 0
	    else suma = 481;
	    for(var i=0; i<len; i++)
	        suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
	    digitoEsperado = 11 - suma % 11;
	    if (digitoEsperado == 11) digitoEsperado = 0;
	    else if (digitoEsperado == 10) digitoEsperado = "A";
	    if ((digitoVerificador != digitoEsperado)
	     && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
	        return false;
	    else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
	        return false;
	    return true;
	},
	guardarProveedor:function(o){	
		(Ladda.create(document.querySelector( '#gNO' ))).start();					
		console.log(o)
		$.ajax({type : "POST",url : "guardarProveedor",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevoProveedor').modal('hide'),prv.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
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
					        	$.ajax({type : "POST",url : "borrarProveedor",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),prv.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
