clt = {
	init:function(){		
		$("div.box-tools button.btn.btn-success").click(function(){clt.nuevoCliente({})});
		$("#cltTbl").on('click','a[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn ,clt[f](d)});
		$("#srchFrm").validation({success:function(o){$("#cltTbl tbody").empty(),clt.clientesTable(o)}})
		clt.clear({});
	},
	clear:function(){
		$("#srchFrm").resetForm();
		$("#cltTbl tbody").empty();
		clt.clientesTable({});
	},
	clientesTable:function(o){
		$.ajax({type : "POST",url : "clientesTable",dataType : "html",data : o})
		.done(function(r) {
			$("#cltTbl tbody").append(r);
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevoCliente:function(o){
		$.ajax({type:"POST",url :  "nuevoCliente",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevoCliente').modal({show:true,backdrop:'static'});
			$('#nuevoCliente').on('hidden.bs.modal',function(){$(this).remove();});		
			if(o && o.id_cliente){				
				s = $('#nuevoCliente .modal-content').data();
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}
			$.validator.addMethod("rfc", function(value, element, params) {
			    return  clt.rfcValido($.trim(value).toUpperCase()) ; 
			}, 'El RFC es inválido');
			$('#nuevoCliente .selectpicker').selectpicker({})
			$("#nvoPrvFrm").validation({extend:o,rules:{rfc:{rfc:true}},success:function(ob){clt.guardarCliente(ob)}})
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
	guardarCliente:function(o){		
		console.log(o)
		$.ajax({type : "POST",url : "guardarCliente",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),$('#nuevoCliente').modal('hide'),clt.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarCliente:function(o){
		$.confirm({ title: 'Borrar Cliente',content: '¿Esta seguro de querer borrar este cliente?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con el cliente, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : "borrarCliente",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),clt.clear()) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
