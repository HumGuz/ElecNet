(function($) {
	$.widget( "custom.scrollTable", { 
	    options: {
	    	idTable:'',
	        fixedHeight : false,
	        heightAdjust:0,
	        source:'',
	        init:true,
			parent : undefined,
			slimScroll : true,
			filter:{},
			limit:0,
			extend:{},			
			dinamicLoad : false,			
			singleFilter:undefined,
			advancedFilter:undefined,				
			response:undefined,
			container:undefined,
			foot:undefined,
			advancedFilterRules:undefined,
			beforeGetContent:function(){},
			callback:function(){},
	    },	  
	    _create: function() {		    	
	    	id = this.element.attr('id');	
	    	if(id==undefined){
	    		id = app.getUniqueID('tbl-');
	    		this.element.attr('id',id);
	    	}  	    		
	    	this.options.idTable =id ;   	    	
	    	this.options.container = $('<div id="'+this.options.idTable + '-container" class="scroll-table-container"><table class="scroll-table-body table table-striped"><tbody></tbody></table></div>')
	    	this.options.container.insertAfter(this.element);
	    	if(this.element.find('tfoot').length){	    		
	    		this.options.foot = $('<table id="'+this.options.idTable + '-foot" class="scroll-table-body table table-striped"></table>');
	    		this.options.foot.append(this.element.find('tfoot'));
	    		this.options.foot.insertAfter(this.options.container);
	    	}		    	 	    	 	   	
	    	(this.options.singleFilter && this._setSingleFilter(this));
	    	(this.options.advancedFilter && this._setAdvancedFilter(this));
	    	this.options.heightAdjust =  this.element.outerHeight() + (this.options.foot ? this.options.foot.outerHeight() : 0);
	    	this._initSlimScroll(this);	
	    	this._setSlimScroll(this);	    	
	    	(this.options.init && this._clean(this));
	    },		    
	    _initSlimScroll:function(_that){
	    	var toR;
	    	$(window).resize(function(){	    		
	    		 toR && clearTimeout(toR);
	    		 toR = setTimeout(function(){
	    		 	_that._setSlimScroll()
	    		 },50)
	    	}); 	
	    },	        
	    _setSlimScroll:function(){ 
	    	app.destroySlimScroll(this.options.container);	    	
			var height = this.options.fixedHeight ? this.options.fixedHeight : ( this.options.parent.height() - this.options.heightAdjust );
			this.options.container.css('height', height);
			app.initSlimScroll(this.options.container);
	    },
	    _setSingleFilter:function(_that){	
	    	var toSF;	    	   	
	    	_that.options.singleFilter.keyup(function(e) {	    		
	    		inpt = $(this);	    		
				(toSF && clearTimeout(toSF)); 				
				toSF = setTimeout(function() {					
					_that._initFilter();
					_that.options.filter.busqueda = $.trim(inpt.val());
					_that.getContent(_that);
				}, 500)
			}); 
	    }, 
	    _setAdvancedFilter:function(_that){	
			_that.options.advancedFilter.validation({
				extend : $.extend({ trim : '-' + _that.options.extend.uid }, _that.options.extend),
				rules:_that.options.advancedFilterRules,
				success : function(o) {					
					_that._initFilter();
					_that.options.filter = $.extend({},o,_that.options.filter);
					_that.getContent(_that);
				}
			});			
			(_that.options.advancedFilter.find('.daterange-button').length && app.dateRangePicker(_that.options.advancedFilter));
			app.reset(_that.options.advancedFilter);
			app.initSelects(_that.options.advancedFilter);
	    }, 
	    _clean:function(_that){
	    	if(_that.options.advancedFilter){
	    		_that.options.advancedFilter.find('button[type="reset"]').click();
	    	}else{
	    		_that._initFilter();
	    		_that.getContent(_that);
	    	}
	    },	       
	    clean:function(){
	    	this._clean(this);
	    },	 
	    getFilter:function(){	    	
	    	return this.options.filter;
	    },
	    setExtend:function(i){
	    	this.options.extend = i;
	    },
	    _initFilter:function(){	    	
	    	this.options.container.find('table tbody').empty();
	    	this.options.filter = $.extend({limit:this.options.limit},this.options.extend);
	    },
	    _setColumnWidth:function(){	 
	    	if(this.options.container.find('table tr').length==0){
				tdsh = this.element.find('thead tr th');				
				tdsb = this.options.response.eq(0).find('td');					
				$.each(tdsb, function(j, col) {$(col).attr('width', $(tdsh[j]).attr('width'))});
			}
	    },    
	    _setScr:function(_that){	    	
	    	_that.options.container.scroll(function(){
		    	control = this; 
		        if ($(control).scrollTop() >= $(control)[0].scrollHeight - $(control).outerHeight()-10){ 	               
		        	$(control).unbind('scroll');		        	
		            _that.options.filter.limit += _that.options.limit;  
	                _that.getContent(_that);
		        }                  
		  	}); 
	    },
	    getContent:function(_that){	
			_that.options.beforeGetContent(_that.options);
			_that.options.parent.append('<div class="overlay"><i class="fa fa-spinner fa-spin"></i></div>');
			$.ajax({type : "POST",url:this.options.source,dataType : "html",data : _that.options.filter})
			.done(function(r) {
				_that.options.response = $(r);
				_that._setColumnWidth();					
				if(_that.options.dinamicLoad && _that.options.response.length){
					_that.options.container.find('table tbody').append(_that.options.response), _that._setScr(_that);
				}else{
					_that.options.container.find('table tbody').html(_that.options.response)
				}
				_that.options.parent.find('.overlay').remove();				
				_that.options.callback(_that.options);				
			}).fail(function(i, a, e) {console.log(i, a, e)})
		}    
	});
})(jQuery);