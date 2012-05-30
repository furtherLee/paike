$(function(){

    $form = $("#group-form");
    $submit = $("#submit");

    var checkOK = function(){
	return true;
    }
    
    $submit.click(function(e){
	if (checkOK()){
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
	}
	else{
		
	}
	return false;
    });

});
