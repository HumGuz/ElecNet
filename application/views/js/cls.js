cls = {
	init:function(){		
		$("#clasTbl").on('click','[data-fn]',function(){d = $.extend({},$(this).data()),f = d.fn,delete d.fn,delete d['bs.tooltip'],delete d.toggle,delete d.trigger,cls[f](d)});
		$("#depSrchFrm").validation({extend:{dump:'depList'},success:function(o){$("#depList").empty(),cls.elementsList(o)}}),
		cls.clearDep(),
		$("#catSrchFrm").validation({extend:{dump:'catList'},success:function(o){$("#catList").empty(),cls.elementsList(o)}}),
		$("#subCatSrchFrm").validation({extend:{dump:'subCatList'},success:function(o){$("#subCatList").empty(),cls.elementsList(o)}})			
		$("#clasTbl").on('click','li[data-fnc]',function(e){	
			tis = $(this)		
			if(!tis.hasClass('active') && $(e.currentTarget).hasClass('list-group-item')){
				tis.siblings("li[data-fnc].active").removeClass('active');				
				tis.addClass('active');
				d = $.extend({},tis.data()),
				f = d.fnc,delete d.fnc,				
				$(d.empty).empty(),cls[f](d)
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
		console.log(o,p);
		$.ajax({type : "POST",url : "elementsList",dataType : "html",data : o})
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
		$.ajax({type:"POST",url :  "nuevaClasificacion",dataType : "html",data:o}).done(function(r) {
			$('body').append(r);  
			$('#nuevaClasificacion').modal({show:true,backdrop:'static'}).on('hidden.bs.modal',function(){$(this).remove();});		
			s = $('#nuevaClasificacion .modal-content').data();	
			if($("#id_departamento").length && $("#id_categoria_padre").length){
				$("#id_departamento").change(function(){
					vl =$(this).val(),
					$("#id_categoria_padre").val(''),
					$("#id_categoria_padre option").prop('disabled',true),					
					(vl!='' &&  $("#id_categoria_padre option[data-id_departamento='"+vl+"']").prop('disabled',false) ),
					$("#id_categoria_padre").selectpicker('refresh');					
				});
			}		
			$("#id_departamento").change();			
			if(o && Object.keys(s).length && (o.id_departamento || o.id_categoria)){
				for(i in s)
					($("#"+i).length && $("#"+i).val(s[i]));
			}else{
				((o.op==2 || o.op==3) && o.id_departamento && $("#id_departamento").val(o.id_departamento),$("#id_departamento").change()),
				( o.op==3 && o.id_categoria_padre && $("#id_categoria_padre").val(o.id_categoria_padre),$("#id_categoria_padre").selectpicker('refresh'))
			}	
			$("#nvoClasFrm .selectpicker").selectpicker({}),
			$("#nvoClasFrm").validation({extend:o,success:function(ob){cls.guardarClasificacion(ob)}})
		});
	},
	guardarClasificacion:function(o){
		console.log(o);			
		$.ajax({type : "POST",url : "guardarClasificacion",dataType : "json",data : o})
		.done(function(r) {
			1 == r.status ? (				
				toastr["success"]("Cambios guardados con éxito"),$('#nuevaClasificacion').modal('hide'),cls.clearG(r)
			) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});})
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
					        	$.ajax({type : "POST",url : "borrarClasificacion",dataType : "json",data : o})
								.done(function(r) {
									1 == r.status ? (toastr["success"]("Cambios guardados con éxito"),cls.clearD(o)) : $.alert({title: 'Error',icon: 'fa fa-warning',content: 'Hubo un error al guardar los cambios, contecte con el area de sistemas',type: 'red',theme:"dark",buttons:{a: {text: 'Aceptar',btnClass: 'btn-red',keys: ['enter']}}});
								}).fail(function(e, t, i) {console.log(e, t, i)})
					        }}		        
					}});
		        }}		        
		    }
		});
	}	
};
