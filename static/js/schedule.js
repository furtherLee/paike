$(function(){
    var users;
    var works;
    var map;

    var fetchInfo = function(){
	$.ajax({
            type: 'GET',
            url: config.home+"group/"+$("#now-gid").val()+"/metainfo/",
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
		users = data['users'];
		works = data['works'];
		map = data['map'];
            },
            error: function(data, textStatus, jqXHR){
		//TODO
            },
            complete: function(data, textStatus, jqXHR){
            }
        });

    }   

    /**
     * for save a schedule
     */
    $saveScheduleBtn = $("#save-schedule");
    $saveScheduleBtn.click(function(e){
	console.log("save schedule");
	return false;
    });


});
