<<<<<<< HEAD
cls = {
	path:'../application/views/clasificaciones/',
	request:'../clasificaciones/',
	init:function(i){
		$("body").catalogo({
			title : 'Clasificacion de Prods.',id_c:"cls",view : cls.request,post : i,
			callback : function(i) {
				var crd;	    	
		    	$(".bus-cat").keyup(function(e) {
		    		inp = $(this);
					(crd && clearTimeout(crd)); 				
					crd = setTimeout(function() {inp.parents('form').eq(0).submit()}, 500)
				}); 	
				$("#depSrchFrm").validation({extend:{dump:'depList'},success:function(o){$("#depList").empty(),cls.elementsList(o)}}),
				cls.clearDep(),
				$("#catSrchFrm").validation({extend:{dump:'catList'},success:function(o){$("#catList").empty(),cls.elementsList(o)}}),
				$("#subCatSrchFrm").validation({extend:{dump:'subCatList'},success:function(o){$("#subCatList").empty(),cls.elementsList(o)}})			
				$("#clasTbl").on('click','li[data-fnc]',function(e){tis = $(this);if(!tis.hasClass('active') && $(e.currentTarget).hasClass('list-group-item')){tis.siblings("li[data-fnc].active").removeClass('active');tis.addClass('active');d = $.extend({},tis.data()),f = d.fnc,delete d.fnc,$(d.empty).empty(),cls[f](d)}});
				app.initSlimScroll('.box-body-list');
			}
		});	
	},
	clearG:function(o){
		$("#depList").empty(),$("#catList").empty(),$("#subCatList").empty(),
		(o.id_departamento && cls.elementsList({dump:'depList'},o)),
		(o.id_departamento && o.id_categoria_padre && cls.elementsList({dump:'catList',id_departamento:o.id_departamento,id_categoria_padre:0},o)),
		(o.id_departamento && o.id_categoria_padre && o.id_categoria && cls.elementsList({dump:'subCatList',id_departamento:o.id_departamento,id_categoria_padre:o.id_categoria_padre},o))
	},		
	clearD:function(o){	
		(o.op==1 && cls.clearDep())
		if(o.op==2){
			$("#depList").empty(),
			cls.elementsList({dump:'depList'},o),
			$("#catList").empty(),$("#subCatList").empty(),
			cls.elementsList({dump:'catList',id_departamento:o.id_departamento})
		} 
		if(o.op==3){
			$("#catList").empty(),$("#subCatList").empty(),
			cls.elementsList({dump:'catList',id_departamento:o.id_departamento,id_categoria_padre:0},o),
			cls.elementsList({dump:'subCatList',id_departamento:o.id_departamento,id_categoria_padre:o.id_categoria_padre})
		}  
	},		
	clearDep:function(){
		$("#depSrchFrm").resetForm(),
		$("#depList").empty(),$("#catList").empty(),$("#subCatList").empty(),cls.elementsList({dump:'depList'})
	},	
	elementsList:function(o,p){		
		$.ajax({type : "POST",url : cls.request+"elementsList",dataType : "html",data : o})
		.done(function(r) {
			$("#"+o.dump).append(r),									
			(o && p && o.dump=='depList' && p.id_departamento && $("#depList li[data-id_departamento='"+p.id_departamento+"']").addClass('active')),	
			(o && p && o.dump=='catList' && p.id_categoria_padre && $("#catList li[data-id_categoria_padre='"+p.id_categoria_padre+"']").addClass('active'))						 
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaClasificacion:function(o){		
		if((o.op==2 || o.op==3 ) && $("#depList li.active").length)
			o.id_departamento = $("#depList li.active").data('id_departamento');		
		if(o.op==3 && $("#catList li.active").length)
			o.id_categoria_padre = $("#catList li.active").data('id_categoria_padre');		
		$("body").formModal({title : "Nueva Clasificacion",id : "cls",modal :cls.request+"nuevaClasificacion",post : o,
			callback : function(i) {				
				md = $('#cls-modal');				
				s = md.find('.modal-content').data();									
				if(md.find("#id_departamento").length && md.find("#id_categoria_padre").length){
					md.find("#id_departamento").change(function(){
						vl =$(this).val(),
						md.find("#id_categoria_padre").val(''),
						md.find("#id_categoria_padre option").prop('disabled',true),					
						(vl!='' &&  md.find("#id_categoria_padre option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
						md.find("#id_categoria_padre").selectpicker('refresh');					
					});
				}		
				if(o && Object.keys(s).length && (o.id_departamento || o.id_categoria_padre)){
					((o.id_departamento || s.id_departamento) &&  md.find("#id_departamento").val(o.id_departamento ? o.id_departamento : s.id_departamento).change());
					((o.id_categoria_padre || s.id_categoria_padre) &&  md.find("#id_categoria_padre").val(o.id_categoria_padre ? o.id_categoria_padre : s.id_categoria_padre).change());
					for(i in s)
						($("#"+i).length && $("#"+i).val(s[i]));
				}else{
					((o.op==2 || o.op==3) && o.id_departamento && md.find("#id_departamento").val(o.id_departamento),md.find("#id_departamento").change()),
					( o.op==3 && o.id_categoria_padre && md.find("#id_categoria_padre").val(o.id_categoria_padre),md.find("#id_categoria_padre").selectpicker('refresh'))
				}	
				md.find("#nvoClasFrm .selectpicker").selectpicker('refresh'),
				md.find("#nvoClasFrm").validation({extend:o,success:function(ob){cls.guardarClasificacion(ob)}});
			}
	});		
	},
	guardarClasificacion:function(o){			
		app.spin('#nvoClasFrm button.ladda-button');		
		console.log(o);			
		$.ajax({type : "POST",url : cls.request+"guardarClasificacion",dataType : "json",data : o})
		.done(function(r) {
			1 == r.status ? (app.ok(),app.close('cls'),cls.clearG(r) ) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarClasificacion:function(o){
		$.confirm({ title: 'Borrar clasificación',content: '¿Esta seguro de querer borrar esta clasificación?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la clasificación, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : cls.request+"borrarClasificacion",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),cls.clearD(o)) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
=======
cls = {
	path:'../application/views/clasificaciones/',
	request:'../clasificaciones/',
	init:function(i){
		$("body").catalogo({
			title : 'Clasificacion de Prods.',id_c:"cls",view : cls.request,post : i,
			callback : function(i) {
				var crd;	    	
		    	$(".bus-cat").keyup(function(e) {
		    		inp = $(this);
					(crd && clearTimeout(crd)); 				
					crd = setTimeout(function() {inp.parents('form').eq(0).submit()}, 500)
				}); 	
				$("#depSrchFrm").validation({extend:{dump:'depList'},success:function(o){$("#depList").empty(),cls.elementsList(o)}}),
				cls.clearDep(),
				$("#catSrchFrm").validation({extend:{dump:'catList'},success:function(o){$("#catList").empty(),cls.elementsList(o)}}),
				$("#subCatSrchFrm").validation({extend:{dump:'subCatList'},success:function(o){$("#subCatList").empty(),cls.elementsList(o)}})			
				$("#clasTbl").on('click','li[data-fnc]',function(e){tis = $(this);if(!tis.hasClass('active') && $(e.currentTarget).hasClass('list-group-item')){tis.siblings("li[data-fnc].active").removeClass('active');tis.addClass('active');d = $.extend({},tis.data()),f = d.fnc,delete d.fnc,$(d.empty).empty(),cls[f](d)}});
				app.initSlimScroll('.box-body-list');
			}
		});	
	},
	clearG:function(o){
		$("#depList").empty(),$("#catList").empty(),$("#subCatList").empty(),
		(o.id_departamento && cls.elementsList({dump:'depList'},o)),
		(o.id_departamento && o.id_categoria_padre && cls.elementsList({dump:'catList',id_departamento:o.id_departamento,id_categoria_padre:0},o)),
		(o.id_departamento && o.id_categoria_padre && o.id_categoria && cls.elementsList({dump:'subCatList',id_departamento:o.id_departamento,id_categoria_padre:o.id_categoria_padre},o))
	},		
	clearD:function(o){	
		(o.op==1 && cls.clearDep())
		if(o.op==2){
			$("#depList").empty(),
			cls.elementsList({dump:'depList'},o),
			$("#catList").empty(),$("#subCatList").empty(),
			cls.elementsList({dump:'catList',id_departamento:o.id_departamento})
		} 
		if(o.op==3){
			$("#catList").empty(),$("#subCatList").empty(),
			cls.elementsList({dump:'catList',id_departamento:o.id_departamento,id_categoria_padre:0},o),
			cls.elementsList({dump:'subCatList',id_departamento:o.id_departamento,id_categoria_padre:o.id_categoria_padre})
		}  
	},		
	clearDep:function(){
		$("#depSrchFrm").resetForm(),
		$("#depList").empty(),$("#catList").empty(),$("#subCatList").empty(),cls.elementsList({dump:'depList'})
	},	
	elementsList:function(o,p){		
		$.ajax({type : "POST",url : cls.request+"elementsList",dataType : "html",data : o})
		.done(function(r) {
			$("#"+o.dump).append(r),									
			(o && p && o.dump=='depList' && p.id_departamento && $("#depList li[data-id_departamento='"+p.id_departamento+"']").addClass('active')),	
			(o && p && o.dump=='catList' && p.id_categoria_padre && $("#catList li[data-id_categoria_padre='"+p.id_categoria_padre+"']").addClass('active'))						 
		}).fail(function(e, t, i) {console.log(e, t, i)})
	},
	nuevaClasificacion:function(o){		
		if((o.op==2 || o.op==3 ) && $("#depList li.active").length)
			o.id_departamento = $("#depList li.active").data('id_departamento');		
		if(o.op==3 && $("#catList li.active").length)
			o.id_categoria_padre = $("#catList li.active").data('id_categoria_padre');		
		$("body").formModal({title : "Nueva Clasificacion",id : "cls",modal :cls.request+"nuevaClasificacion",post : o,
			callback : function(i) {				
				md = $('#cls-modal');				
				s = md.find('.modal-content').data();									
				if(md.find("#id_departamento").length && md.find("#id_categoria_padre").length){
					md.find("#id_departamento").change(function(){
						vl =$(this).val(),
						md.find("#id_categoria_padre").val(''),
						md.find("#id_categoria_padre option").prop('disabled',true),					
						(vl!='' &&  md.find("#id_categoria_padre option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
						md.find("#id_categoria_padre").selectpicker('refresh');					
					});
				}		
				if(o && Object.keys(s).length && (o.id_departamento || o.id_categoria_padre)){
					((o.id_departamento || s.id_departamento) &&  md.find("#id_departamento").val(o.id_departamento ? o.id_departamento : s.id_departamento).change());
					((o.id_categoria_padre || s.id_categoria_padre) &&  md.find("#id_categoria_padre").val(o.id_categoria_padre ? o.id_categoria_padre : s.id_categoria_padre).change());
					for(i in s)
						($("#"+i).length && $("#"+i).val(s[i]));
				}else{
					((o.op==2 || o.op==3) && o.id_departamento && md.find("#id_departamento").val(o.id_departamento),md.find("#id_departamento").change()),
					( o.op==3 && o.id_categoria_padre && md.find("#id_categoria_padre").val(o.id_categoria_padre),md.find("#id_categoria_padre").selectpicker('refresh'))
				}	
				md.find("#nvoClasFrm .selectpicker").selectpicker('refresh'),
				md.find("#nvoClasFrm").validation({extend:o,success:function(ob){cls.guardarClasificacion(ob)}});
			}
	});		
	},
	guardarClasificacion:function(o){			
		app.spin('#nvoClasFrm button.ladda-button');		
		console.log(o);			
		$.ajax({type : "POST",url : cls.request+"guardarClasificacion",dataType : "json",data : o})
		.done(function(r) {
			1 == r.status ? (app.ok(),app.close('cls'),cls.clearG(r) ) : app.error();})
		.fail(function(e, a, r) {console.log(e, a, r)})
	},
	borrarClasificacion:function(o){
		$.confirm({ title: 'Borrar clasificación',content: '¿Esta seguro de querer borrar esta clasificación?', type: 'orange',theme:"dark",
		    buttons: {
		    	a: {text: 'Cancelar'},
		        b: {text: 'Borrar',btnClass: 'btn-orange', action: function(r){ 
		        	$.confirm({ title: 'Borrar',content: 'Al borrar, se perderá toda la información relacionada con la clasificación, ¿Continuar?',
					    type: 'red',theme:"dark",
					    buttons: {
					    	a: {text: 'Cancelar'},
					        b: {text: 'Borrar',btnClass: 'btn-red', action: function(r){ 
					        	$.ajax({type : "POST",url : cls.request+"borrarClasificacion",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (app.ok(),cls.clearD(o)) : app.error();
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
