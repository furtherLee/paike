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
       
	    }
	});
	return false;
    });
});