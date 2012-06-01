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
	var pattern = /^([a-zA-Z0-9._-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
	if ($pass.val() != $passAgain.val()){
	    $.jGrowl("两次密码输入不一致", {header: "注册失败"});
	    return false;
	}
	else if(!pattern.test($email.val())){
	    $.jGrowl("邮箱地址不正确", {header: "注册失败"});	
	    return false;
	}
	else if($pass == ""){
	    $.jGrowl("不能使用空密码", {header: "注册失败"});	
	    return false;
	}	     
	return true;
    }
    
    $submit.click(function(e){
	if (checkOK()){
	    $.ajax({
		type: "POST",
		data: $form.serialize(),
		dateType: "json",
		success: function(data, textStatus, jqXHR){
		    $.jGrowl("注册成功", {header: "成功"});
		    window.location.href = config.home;
		},
		error: function(textStatus, jqXHR, errorThrown){
		    $.jGrowl("注册失败", {header: "失败"});
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