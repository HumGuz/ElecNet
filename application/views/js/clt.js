<<<<<<< HEAD
clt = {
	path:'../application/views/clientes/',
	request:'../clientes/',
	init:function(i){
		$("body").catalogo({
			title : 'Clientes',id_c:"clt_c",view : clt.request,post : i,
			callback : function(i) {			
				$("#tbl-clt").scrollTable({
					parent : $("#catalogo-clt"),
					source :  clt.request+"clientesTable",
					extend : i,
					singleFilter : $("#busqueda-clt")
				});
			}
		});
	},	
	clean:function(i){$("#tbl-clt").scrollTable('clean')},
	nuevoCliente:function(o){		
		$("body").formModal({title : "Nuevo Cliente",id : "clt",modal :clt.request+"nuevoCliente",post : o,
			callback : function(i) {
				md = $('#clt-modal');				
				if(o && o.id_cliente){				
					s = md.find('.modal-content').data();
					for(i in s)
						(md.find("#"+i).length && md.find("#"+i).val(s[i]));
				}
				$.validator.addMethod("rfc", function(value, element, params) {return  clt.rfcValido($.trim(value).toUpperCase())}, 'El RFC es inválido');
				md.find('.selectpicker').selectpicker({})
				md.find("#nvoCltFrm").validation({extend:o,rules:{rfc:true},success:function(ob){clt.guardarCliente(ob)}})
			}
		})
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
		app.spin('#nvoCltFrm button.ladda-button');					
		console.log(o)
		$.ajax({type : "POST",url : clt.request+"guardarCliente",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('clt'),app.updateByTag('clt')) : app.error();})
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
					        	$.ajax({type : "POST",url : clt.request+"borrarCliente",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),app.updateByTag('clt')) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
=======
clt = {
	path:'../application/views/clientes/',
	request:'../clientes/',
	init:function(i){
		$("body").catalogo({
			title : 'Clientes',id_c:"clt_c",view : clt.request,post : i,
			callback : function(i) {			
				$("#tbl-clt").scrollTable({
					parent : $("#catalogo-clt"),
					source :  clt.request+"clientesTable",
					extend : i,
					singleFilter : $("#busqueda-clt")
				});
			}
		});
	},	
	clean:function(i){$("#tbl-clt").scrollTable('clean')},
	nuevoCliente:function(o){		
		$("body").formModal({title : "Nuevo Cliente",id : "clt",modal :clt.request+"nuevoCliente",post : o,
			callback : function(i) {
				md = $('#clt-modal');				
				if(o && o.id_cliente){				
					s = md.find('.modal-content').data();
					for(i in s)
						(md.find("#"+i).length && md.find("#"+i).val(s[i]));
				}
				$.validator.addMethod("rfc", function(value, element, params) {return  clt.rfcValido($.trim(value).toUpperCase())}, 'El RFC es inválido');
				md.find('.selectpicker').selectpicker({})
				md.find("#nvoCltFrm").validation({extend:o,rules:{rfc:true},success:function(ob){clt.guardarCliente(ob)}})
			}
		})
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
		app.spin('#nvoCltFrm button.ladda-button');					
		console.log(o)
		$.ajax({type : "POST",url : clt.request+"guardarCliente",dataType : "json",data : o})
		.done(function(r) {1 == r.status ? (app.ok(),app.close('clt'),app.updateByTag('clt')) : app.error();})
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
					        	$.ajax({type : "POST",url : clt.request+"borrarCliente",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),app.updateByTag('clt')) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
