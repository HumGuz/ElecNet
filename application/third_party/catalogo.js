<<<<<<< HEAD
(function($){
        $.fn.catalogo = function(options) { 
           if($('a[data-id_c="'+options.id_c+'"]').length){
            	$('a[data-id_c="'+options.id_c+'"]').click();
            	return 0;	
           }     	
           defaults = {
           		id:app.getUniqueID('tab'),            	   		
           		title:'New tab',
           		view:false,          		
           		post:{},
           		callback:function(){},
           		beforeClose:function(){},
           		onclose:function(){}
           };       
           opt = $.extend({},defaults, options); 
           opt.post.uid = defaults.id;
           cat = $('<li role="presentation" data-uid="'+opt.id+'" id="'+opt.id+'-li" class="cerrable"><a id="'+opt.id+'-tab" data-id_c="'+opt.id_c+'" href="#'+opt.id+'-tabpanel" aria-controls="" role="tab" data-toggle="tab">'+opt.title+'</a><i class="fa fa-times"></i></li>');
           tabpanel = $('<div id="'+opt.id+'-tabpanel" data-uid="'+opt.id+'" role="tabpanel" class="tab-pane">cargando contenido ...</div>');
           opt.cat = cat;
           cat.find('i.fa-times').data('options',opt);
           tabpanel.data('options',opt);
           tabpanel.click(function(){opt = $(this).data('options');opt.cat.find('a').tab('show'); });
           cat.find('i.fa-times').click(function(event){
           		options = $(this).data('options');
           		options.beforeClose(options);
           		event.preventDefault(); 
           		event.stopPropagation(); 
           		a = $(this).siblings('a').eq(0); 
           		if(a.attr('aria-expanded') == 'true'){
           			previusA = a.parent('li').prev('li').find('a').eq(0);           			
           			if(previusA.attr('data-toggle')=='tab'){
           				previusA.one('click',function(e){  
	           				$("#"+options.id+'-tabpanel').find('.selectpicker').selectpicker('destroy');
	           				$("#"+options.id+'-tabpanel').remove();
	           				$("#"+options.id+'-li').remove();
	           			}).click();  
           			}
           			if(previusA.attr('data-toggle')=='modal'){           				
           				previusTarget = $(previusA.attr('href'));	           				
	           			previusTarget.one('shown.bs.modal',function(e){		           						
		           			$("#"+options.id+'-tabpanel').find('.selectpicker').selectpicker('destroy');
		           			$("#"+options.id+'-tabpanel').remove();
		           			$("#"+options.id+'-li').remove();
		           		})
		           		previusTarget.modal('show'); 
           			}        			
           		}else{     
           			$("#"+options.id+'-tabpanel').find('.selectpicker').selectpicker('destroy');      				
           			$("#"+options.id+'-tabpanel').remove();
           			$("#"+options.id+'-li').remove();
           		}
           		options.onclose(options);
           });         
           $(this).find('#barra-tareas').append(cat);
           $(this).find('#content').append(tabpanel);
           cat.find('a').click();           
           if(opt.view){           	
            tabpanel.load(opt.view, opt.post,function(){ 
           		opt = tabpanel.data('options');           		
           		opt.callback(opt.post);
            });
           }else{
           		opt.callback(opt.post);
           }          
        };
=======
(function($){
        $.fn.catalogo = function(options) { 
           if($('a[data-id_c="'+options.id_c+'"]').length){
            	$('a[data-id_c="'+options.id_c+'"]').click();
            	return 0;	
           }     	
           defaults = {
           		id:app.getUniqueID('tab'),            	   		
           		title:'New tab',
           		view:false,          		
           		post:{},
           		callback:function(){},
           		beforeClose:function(){},
           		onclose:function(){}
           };       
           opt = $.extend({},defaults, options); 
           opt.post.uid = defaults.id;
           cat = $('<li role="presentation" data-uid="'+opt.id+'" id="'+opt.id+'-li" class="cerrable"><a id="'+opt.id+'-tab" data-id_c="'+opt.id_c+'" href="#'+opt.id+'-tabpanel" aria-controls="" role="tab" data-toggle="tab">'+opt.title+'</a><i class="fa fa-times"></i></li>');
           tabpanel = $('<div id="'+opt.id+'-tabpanel" data-uid="'+opt.id+'" role="tabpanel" class="tab-pane">cargando contenido ...</div>');
           opt.cat = cat;
           cat.find('i.fa-times').data('options',opt);
           tabpanel.data('options',opt);
           tabpanel.click(function(){opt = $(this).data('options');opt.cat.find('a').tab('show'); });
           cat.find('i.fa-times').click(function(event){
           		options = $(this).data('options');
           		options.beforeClose(options);
           		event.preventDefault(); 
           		event.stopPropagation(); 
           		a = $(this).siblings('a').eq(0); 
           		if(a.attr('aria-expanded') == 'true'){
           			previusA = a.parent('li').prev('li').find('a').eq(0);           			
           			if(previusA.attr('data-toggle')=='tab'){
           				previusA.one('click',function(e){  
	           				$("#"+options.id+'-tabpanel').find('.selectpicker').selectpicker('destroy');
	           				$("#"+options.id+'-tabpanel').remove();
	           				$("#"+options.id+'-li').remove();
	           			}).click();  
           			}
           			if(previusA.attr('data-toggle')=='modal'){           				
           				previusTarget = $(previusA.attr('href'));	           				
	           			previusTarget.one('shown.bs.modal',function(e){		           						
		           			$("#"+options.id+'-tabpanel').find('.selectpicker').selectpicker('destroy');
		           			$("#"+options.id+'-tabpanel').remove();
		           			$("#"+options.id+'-li').remove();
		           		})
		           		previusTarget.modal('show'); 
           			}        			
           		}else{     
           			$("#"+options.id+'-tabpanel').find('.selectpicker').selectpicker('destroy');      				
           			$("#"+options.id+'-tabpanel').remove();
           			$("#"+options.id+'-li').remove();
           		}
           		options.onclose(options);
           });         
           $(this).find('#barra-tareas').append(cat);
           $(this).find('#content').append(tabpanel);
           cat.find('a').click();           
           if(opt.view){           	
            tabpanel.load(opt.view, opt.post,function(){ 
           		opt = tabpanel.data('options');           		
           		opt.callback(opt.post);
            });
           }else{
           		opt.callback(opt.post);
           }          
        };
>>>>>>> 233685e26c13ba4685a4ac8e9a5fd7caeb0a0c90
})(jQuery);