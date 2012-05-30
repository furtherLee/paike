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
	    console.log(d);
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

});
