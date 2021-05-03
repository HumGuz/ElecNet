var app = function() {	
	var  resizeHandlers = [],
	_runResizeHandlers = function() {
		for (var t = 0; t < resizeHandlers.length; t++)
			resizeHandlers[t].call()
	},
	handleOnResize = function() {
		var t;
		$(window).resize(function() {t && clearTimeout(t),t = setTimeout(function() {_runResizeHandlers()}, 50)}).resize()
	};	
	return {
		test : function(t) {},		
		spin : function(t) {(Ladda.create(document.querySelector(t))).start();},
		loaded : {app:1},
		script : function(script, fn, object) {
			app.loaded[script] && 1 == app.loaded[script] ? eval(script) && eval(script)[fn](object) : $.ajax({
				type : "POST",
				url : "../application/views/js/" + script + ".js?"+app.getUniqueID(1),
				dataType : "script"
			}).done(function(response) {
				 response && (app.loaded[script] = 1, fn!='' ? eval(response)[fn](object) : eval(response))
			}).fail(function(i, a, e) {console.log(i, a, e)})
		},
		init : function() {			
			handleOnResize();			
			$("body").on('click','[data-scr]:not([data-tag])',function() {
				js = $(this).data("scr"),
				fn = $(this).data("fn"),
				fn = fn || "init",
				ob = $.extend({}, {}, $(this).data()),
				delete ob.scr,
				delete ob.fn, app.script(js, fn, ob)
			});				
			$("body").on("hide.bs.modal", function() {$(".modal:visible").length > 1 && !1 === $("html").hasClass("modal-open") ? $("html").addClass("modal-open") : $(".modal:visible").length <= 1 && $("html").removeClass("modal-open")}), 
			$("body").on("show.bs.modal", ".modal", function() {$(this).hasClass("modal-scroll") && $("body").addClass("modal-open-noscroll")}), 
			$("body").on("hidden.bs.modal", ".modal", function() {$("body").removeClass("modal-open-noscroll")}),
			$("body").on("hidden.bs.modal", ".modal:not(.modal-cached)", function() {$(this).removeData("bs.modal")}),
			$('[data-toggle="tooltip"]').tooltip(),
	        $('body').on('click', 'button.filter,a.filter', function(e) { e.stopPropagation(),$(this).siblings('div.box-filter').slideToggle(200); });
	        $('body').on('click', 'div.box-filter,.bootstrap-select', function(e) { if($(".bootstrap-select.open:visible").length==0 && $(".daterangepicker:visible").length==0) e.stopPropagation();});
	        $('body').click(function(e){if($(".bootstrap-select.open:visible").length==0 && $(".daterangepicker:visible").length==0)$('div.box-filter:visible').slideUp(200);});
	        $('body').on('click','div.daterangepicker.dropdown-menu.ltr',function(e){e.stopPropagation()});
	        $('body').on('click', 'div.close-filter', function(e) {$(this).parents('div.box-filter').slideUp(200);});	        
			$(document).ajaxSend(function(a,b,c) {$(".spinner").show()  }),
			$(document).ajaxStop(function() {setTimeout(function() { $(".spinner").hide(); }, 1e3)}), 
			$(document).ajaxComplete(function(t, a, e) {setTimeout(function() {$(".spinner") }, 2e3)});			
			$("#id_sucursal").change(function(){
				$.ajax({type : "POST",url : "setSucursal",dataType : "json",data : {id_sucursal:$(this).val()}})
				.done(function(r) {
					1 == r.status ? location.reload() : app.error();
				}).fail(function(e, a, r) {console.log(e, a, r)});
			})
		},
		close:function(id){			
			$("#" + id + "-tab").next("i.fa-times").dblclick().click()
		},
		updateByTag : function(tag) {			
			tags = tag.split(',');			
			for(i=0;i<tags.length;i++){
				tag = tags[i];
				$("[data-tag='" + tag + "']").each(function(k, d) {				
					if($(this).hasClass('tab-control') && !$(this).hasClass('initialized') )
						return 0;				
					ob = $.extend({}, {}, $(this).data()),
					js = ob.scr,
					fn = ob.fn,
					delete ob.tag,
					delete ob.fn,
					delete ob.scr, eval(js)[fn](ob)
				})
			}
		},
		dateRangePicker:function(frm){
			strt = moment().subtract(29, 'days');end =  moment();
			cb =  function (start, end, lbl) {	      
		       	frm.find('.daterange-button span').html('<b>'+lbl+'</b> del '+start.format('D MMMM YYYY') + ' al ' + end.format('D MMMM YYYY'));	        
		        frm.find("#fecha_inicial").val(start.format('YYYY-MM-DD'))
		        frm.find("#fecha_final").val(end.format('YYYY-MM-DD'))
		    };		
			frm.find('.daterange-button').daterangepicker({locale:{format: 'YYYY-MM-DD'},startDate: strt,endDate: end,opens: "left",drops: "up",autoApply:true, ranges: { 'Hoy':[moment(), moment()],'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],'Últimos 7 Días' : [moment().subtract(6, 'days'), moment()],'Últimos 30 Días': [moment().subtract(29, 'days'), moment()],'Este Mes'  : [moment().startOf('month'), moment().endOf('month')], 'Mes Anterior'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]}},cb);		 
			cb(strt,end,'Últimos 30 Días');
		},
		reset:function(frm){
    		frm.find('button[type="reset"]').click(function(){
				if(frm.find('.daterange-button').length){
	    			strt = moment().subtract(29, 'days'),end =  moment();
	    			frm.find("#fecha_inicial").val(strt.format('YYYY-MM-DD')),
	    			frm.find("#fecha_final").val(end.format('YYYY-MM-DD')); 	    			
	    			frm.find('.daterange-button').data('daterangepicker').setStartDate(strt),
	    			frm.find('.daterange-button').data('daterangepicker').setEndDate(end);
	    			frm.find('.daterange-button span').html('<b>Últimos 30 Días</b> del '+strt.format('D MMM YYYY') + ' al ' + end.format('D MMM YYYY'));	        
				}	
				setTimeout(function(){frm.find('.selectpicker').selectpicker('refresh'),frm.submit()},5);  
			});	
    	},
    	initSelects:function(frm){
			frm.find(".selectpicker").not('.no-multiple').attr('multiple','multiple').each(function(k,s){$(s).addClass('pull-right').removeClass('required'),$(s).find('option[value=""]').eq(0).remove()}).selectpicker({});
			frm.find(".selectpicker.no-multiple").each(function(k,s){$(s).addClass('pull-right').removeClass('required')}).selectpicker({})
		},  	
		getUniqueID : function(t) { return (t || "") + Math.floor(Math.random() * (new Date).getTime()) },
		number_format : function(t, a, e, i) {
			t = (t + "").replace(/[^0-9+\-Ee.]/g, "");
			var o = isFinite(+t) ? +t : 0,
			    s = isFinite(+a) ? Math.abs(a) : 0,
			    n = void 0 === i ? "," : i,
			    l = void 0 === e ? "." : e,
			    r = "";
			return (r=(s?function(t,a){var e=Math.pow(10,a);return""+(Math.round(t*e)/e).toFixed(a)}(o,s):""+Math.round(o)).split("."))[0].length > 3 && (r[0] = r[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, n)), (r[1] || "").length < s && (r[1] = r[1] || "", r[1] += new Array(s - r[1].length + 1).join("0")), r.join(l)
		},
		addResizeHandler : function(t) { resizeHandlers.push(t) },
		runResizeHandlers : function() { _runResizeHandlers() },
		initSlimScroll : function(t) {
			$().slimScroll && $(t).each(function() {
				if (!$(this).data("initialized")) {
					var t;
					t = $(this).data("height") ? $(this).data("height") : $(this).outerHeight(!0), t -= $(this).data("offset") ? $(this).data("offset") : 0, $(this).slimScroll({
						allowPageScroll : !0,
						size : "7px",
						color : $(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : "#bbb",
						wrapperClass : $(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : "slimScrollDiv",
						railColor : $(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : "#eaeaea",
						position : "right",
						height : t,
						alwaysVisible : "1" == $(this).attr("data-always-visible"),
						railVisible : "1" == $(this).attr("data-rail-visible"),
						disableFadeOut : !0
					}), $(this).data("initialized", 1)
				}
			})
		},
		destroySlimScroll : function(t) {
			$().slimScroll && $(t).each(function() {
				if (1 === $(this).data("initialized")) {
					$(this).removeData("initialized"), $(this).removeAttr("style"), $(this).removeData("height");
					$(this).slimScroll({wrapperClass : $(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : "slimScrollDiv",destroy : !0})
				}
			})
		},	
		dateDiff : function(t, a) {
			return result = "", "" != t && a ? ( t = Date.parse(t + " GMT") / 1e3,
			a = Date.parse(a + " GMT") / 1e3,
			timestamp = a - t) : timestamp = t,
			monts = Math.floor(timestamp / 2678400), monts > 0 && (timestamp -= 2678400 * monts, result += monts + " meses "),
			days = Math.floor(timestamp / 60 / 60 / 24), days > 0 && (timestamp -= 24 * days * 60 * 60, result += days + " días "),
			hours = Math.floor(timestamp / 60 / 60), hours > 0 && (timestamp -= 60 * hours * 60, result += (hours <= 9 ? "0" : "") + hours + " hrs "),
			minutes = Math.floor(timestamp / 60), minutes > 0 ? (timestamp -= 60 * minutes, result += (minutes <= 9 ? "0" : "") + minutes + " min ") : (result += "00:", result += (timestamp <= 9 ? "0" : "") + timestamp + " sec "), result
		},
		ok:function(){
			toastr["success"]("Cambios guardados con éxito")
		},
		error:function(){
			  $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
		}
	}
}();
$(document).ready(function() {app.init()}); 