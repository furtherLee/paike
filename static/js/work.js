$(function(){
    /*
     * deal with add a work
     */
    $addWorkBtn = $('#add-work');
    $addWorkBtn.click(function(e){
	var $box = $(Mustache.to_html(widgets.work_form,{},{}));
        $box.find("textarea").autoResize();	
	$box.bind("posted", function(e) {
            $box.modal('hide');
        });
	$box.draggable({handle: '.modal-header'}).modal('show').bind('hidden', function(e) {
            $box.remove();
        });
	$box.find('#cancel').click(function(e) {
            $box.modal('hide');
        });
	$box.find("#submit").click(function(e) {
	    var d = $box.find("#add-work-form").serialize();
            d = d+"&gid="+$("#now-gid").val();
	    $.ajax({
                type: 'POST',
                url: config.home+"work/",
                data: d,
                dataType: 'json',
                success: function(data, textStatus, jqXHR){
		    console.log($("#works .work-list table"));
		    $("#works .work-list table").append(data['html-code']);
                },
                error: function(data, textStatus, jqXHR){
                },
                complete: function(data, textStatus, jqXHR){
                }
            });
            $box.modal("hide");
	    return false;
        });
	return false;
    });

    /**
     * Save my work candidates
     */
    $saveTimeBtn = $("#save-time");
    $saveTimeBtn.click(function(e){
	var d = $("#work-list-form").serialize();
	$.ajax({
            type: 'POST',
            url: config.home+"workers_assign/"+$("#now-gid").val(),
            data: d,
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
		console.log(data);
            },
            error: function(data, textStatus, jqXHR){
            },
            complete: function(data, textStatus, jqXHR){
            }
        });

	return false;
    });

    /**
     * for Schedule
     */
    $('.work-ban, .member-ban').sortable({
	connectWith:".work-ban, .member-ban",
	placeholder:"label"
    }).disableSelection();
    
    console.log($('.work-ban, .member-ban'));
 //   $('li.user-squre-item').draggable();

    /**
     * for save a schedule
     */
    $saveScheduleBtn = $("#save-schedule");
    $saveScheduleBtn.click(function(e){
	
	return false;
    });

});
