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
	else{
		
	}
	return false;
    });

    $('#upload-img').click(function(e){

	var $box = $(Mustache.to_html(widgets.upload_form,{
	    upload_url: config.home+"upload/",
	    photo: config.home+"image/"+$('#input-photo').val()
	},{}));

        $box.find("textarea").autoResize();	

	$box.bind("posted", function(e) {
            $box.modal('hide');
        });

	$box.draggable({handle: '.modal-header'}).modal('show').bind('hidden', function(e) {
            $box.remove();
        });
	
	$box.find('#cancel').click(function(e) {
            $box.modal('hide');
	    return false;
        });

	var currentResult = $('#input-photo').val();

	$box.find('#file-upload').fileupload({
	    url: config.home+"upload/",
	    sequentialUploads: true,
	    dataType:'json',
	    done: function(e, data){
		currentResult = data['result']['path'],
		$box.find('#photo-preview').attr('src', config.home+"image/"+currentResult);
	    }
	});
	
	$box.find('#upload-submit').click(function(e){
	    $('#input-photo').val(currentResult);
	    $box.modal('hide');
	    return false;
	});
	return false;
    });
});