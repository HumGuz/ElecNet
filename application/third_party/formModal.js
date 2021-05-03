(function($){
        $.fn.formModal = function(options) {        	
            if($('#'+options.id+'-tab').length){
            	$('#'+options.id+'-tab').next('i.fa-times').eq(0).data('alertOnClose',false);
            	$('#'+options.id+'-tab').next('i.fa-times').click();            	
            }
            	
           defaults = {modal:'', alertOnClose:true , post:{},callback:function(){},onclose:function(){}}; 
           that = this;                   
           object_frm_mdl = $.extend({},defaults, options);           
           li_tab = $('<li role="presentation"  id="'+object_frm_mdl.id+'-li"><a id="'+object_frm_mdl.id+'-tab"  href="#'+object_frm_mdl.id+'-modal" aria-controls="" role="tab" data-toggle="modal" >'+object_frm_mdl.title+'</a><i class="fa fa-times"></i></li>');
           li_tab.find('i.fa-times').data(object_frm_mdl); 
           li_tab.find('i.fa-times').dblclick(function(e){ $(this).data('alertOnClose',false)})   
           li_tab.find('i.fa-times').click(function(e){	           		
	           		thiss = this;
	           		options = $(thiss).data();
	           		e.preventDefault(); 
	           		e.stopPropagation(); 	           		
	           		close_fn = function(){
	           			a = $(thiss).siblings('a').eq(0); 	           		
		           		target = $(a.attr('href'));	 
		           		$(".popover").remove()
		           		if(target.is(':visible')){	           			
		           			target.one('hidden.bs.modal',function(){
				           		$(this).find('.selectpicker').selectpicker('destroy');
				           		$("#"+options.id+'-li').prev('li').addClass('active').attr('aria-expanded','true');	
					        	$("#"+options.id+'-li').remove();					        	
					        	$(this).remove();		           				
					        });
					        target.modal('hide');
		           		}else{
		           			target.find('.selectpicker').selectpicker('destroy');
		           			$("#"+options.id+'-li').prev('li').addClass('active').attr('aria-expanded','true');	
		           			$("#"+options.id+'-li').remove();
				           	 target.remove();			
		           		}
		           		options.onclose();
	           		}           		
	           		if(options.alertOnClose)
	           			$.confirm({ title: 'Cerrar Formulario',content: 'Si cierra antes de guardar, perdera los cambios ¿Cerrar?', type: 'orange',theme:"dark",buttons: {a: {text: 'Cancelar'},b: {text: 'Cerrar',btnClass: 'btn-default', action: function(r){close_fn()}}}});
	           		else
	           			close_fn();		           		
	           });   
           $.ajax({type:'POST',url :object_frm_mdl.modal,dataType : "html",data : object_frm_mdl.post}).done(function(response) { 	           		
				$(document).ready(function(){
					$(that).append(response);  
		           	$(that).find('#barra-tareas').append(li_tab);					
	           		modal =$('#'+object_frm_mdl.id+'-modal');
	           		modal.one('shown.bs.modal',function(){$(this).removeClass('fade')});
					modal.modal({show:false,keyboard:false});   
					modal.data('options',object_frm_mdl);
					object_frm_mdl.callback(object_frm_mdl.post);
					li_tab.find('a').click();    
					modal.find('button.close-modal').on('click',function(){
						opt = $(this).parents('.modal').eq(0).data('options'),
						li_tab = $("#"+opt.id+"-li"),li_tab.find('i.fa-times').click()
					});					
				})			
					
		   }).fail(function(a,b,c){console.log(a,b,c);});          
        };
        
        $('body').on('click','a[data-toggle="modal"]',function(){
			$(this).parents('ul').find('li.active').removeClass('active').attr('aria-expanded','false');
			$(this).parents('li').addClass('active').attr('aria-expanded','true')
		})
        
})(jQuery);