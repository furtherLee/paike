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
     * show first tab
     */
    $("#operate-tabs a:first").tab("show");

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
     * deal with tab change for schedules
     */
    $('.schedule-tab').click(function(e){
	var id = $(this).attr('data');
	var $that = $(this);
	$.ajax({
            type: 'GET',
            url: config.home+"schedule/"+id+"/",
            dataType: 'html',
            success: function(data, textStatus, jqXHR){
		$('#schedule-content').html(data);
		$('#nav-schedules').find('li').removeClass('active');
		$that.parent().addClass('active');
            },
            error: function(data, textStatus, jqXHR){
            },
            complete: function(data, textStatus, jqXHR){
            }
        });
	return false;
    });
});
