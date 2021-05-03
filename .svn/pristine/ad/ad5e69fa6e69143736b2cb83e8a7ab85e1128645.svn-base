lgn = {
	init:function(){		
			// s$('input').iCheck({ checkboxClass: 'icheckbox_square-blue', radioClass: 'iradio_square-blue', increaseArea: '20%' });
			$("#lgnFrm").validation({
			 	success:function(e){
			 		$.ajax({type : "POST",url : "login/signin",dataType : "json",data : e})
					.done(function(t) {
						if(t.code==1252)
							location.href = 'admin/';
						else
							($("#lgnFrm").validate()).showErrors(t),(t.email && setTimeout(function(){$("#pass").val('').valid()},500)) 
					}).fail(function(e, t, i) {console.log(e, t, i)})
			 	}	
			 });
	}
};
$(document).ready(function(){lgn.init()});

