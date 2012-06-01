$(function(){
    $form = $('#login-form');
    $submit = $('#submit');
    $submit.click(function(e){
	$.ajax({
	    type: "POST",
	    data: $form.serialize(),
	    dateType: "json",
	    success: function(data, textStatus, jqXHR){
		window.location.href = config.home;
	    },
	    error: function(textStatus, jqXHR, errorThrown){
		var error = eval("("+textStatus['responseText']+")")['error'];
		if (error['email'] !== undefined)
		    $.jGrowl(error['email'], {header: "登录失败"});
		else
		    $.jGrowl(error['pass'], {header: "登录失败"});

	    }
	});
	return false;
    });
});