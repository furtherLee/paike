$(function(){
    $form = $("#register-form");
    $name = $form.find('[name="name"]');
    $email=  $form.find('[name="email"]');
    $pass = $form.find('[name="password"]');
    $passAgain = $form.find('[name="passwordagain"]');
    $sex = $form.find('[name="sex"]');
    $birthday = $form.find('[name="birthday"]');
    $submit = $('#submit');
    $birthday.datepicker();
    
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
	return false;
    });
});