var app = function() {	
	var  resizeHandlers = [],
	_runResizeHandlers = function() {
		for (var t = 0; t < resizeHandlers.length; t++)
			resizeHandlers[t].call()
	},
	handleOnResize = function() {
		var t;
		$(window).resize(function() {
			t && clearTimeout(t),
			t = setTimeout(function() {
				_runResizeHandlers()
			}, 50)
		}).resize()
	};	
	return {
		test : function(t) {},		
		iconSpin : function(t) {
		},
		loaded : {},
		script : function(script, fn, object) {
			app.loaded[script] && 1 == app.loaded[script] ? eval(script) && eval(script)[fn](object) : $.ajax({
				type : "POST",
				url : "../application/views/js/" + script + ".js",
				dataType : "script"
			}).done(function(response) {
				response && (app.loaded[script] = 1, fn ? eval(response)[fn](object) : eval(response)['init'])
			})
		},
		init : function() {
			$(document).ajaxSend(function(a,b,c) {  }),
			$(document).ajaxStop(function() {setTimeout(function() { }, 1e3)}), 
			$(document).ajaxComplete(function(t, a, e) {setTimeout(function() { }, 2e3)}), 
			handleOnResize(), wrapper = $(".box.catalog");
			$(".box.catalog .box-body.table-responsive").each(function(t, a) {
					var e = function() {
						var t = $(a);
						app.destroySlimScroll(a), dumpHeight = t.outerHeight() ,  t.attr("data-height", dumpHeight), app.initSlimScroll(a)
					};
					e(), app.addResizeHandler(e)
			});				
			$("body").on("hide.bs.modal", function() {$(".modal:visible").length > 1 && !1 === $("html").hasClass("modal-open") ? $("html").addClass("modal-open") : $(".modal:visible").length <= 1 && $("html").removeClass("modal-open")}), 
			$("body").on("show.bs.modal", ".modal", function() {$(this).hasClass("modal-scroll") && $("body").addClass("modal-open-noscroll")}), 
			$("body").on("hidden.bs.modal", ".modal", function() {$("body").removeClass("modal-open-noscroll")}),
			$("body").on("hidden.bs.modal", ".modal:not(.modal-cached)", function() {$(this).removeData("bs.modal")}),
			$('[data-toggle="tooltip"]').tooltip(),
			
			 //filters
			 // apertura de menu-filtro
	        $('body').on('click', 'button.filter,a.filter', function(e) { e.stopPropagation(),$(this).siblings('div.box-filter').slideToggle(200); });
	        //auto close filters
	        $('body').on('click', 'div.box-filter,.bootstrap-select', function(e) { if($(".bootstrap-select.open:visible").length==0) e.stopPropagation();});
	        $('body').click(function(e){if($(".bootstrap-select.open:visible").length==0)$('div.box-filter:visible').slideUp(200);});
	        $('body').on('click','div.daterangepicker.dropdown-menu.ltr',function(e){e.stopPropagation()});
	        $('body').on('click', 'div.close-filter', function(e) {$(this).parents('div.box-filter').slideUp(200);});			
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
		}
	}
}();
$(document).ready(function() {app.init()}); 