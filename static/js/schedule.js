$(function(){
    var users;
    var works;
    var map;
    var result = {};
    var fetchInfo = function(){
	$.ajax({
            type: 'GET',
            url: config.home+"group/"+$("#now-gid").val()+"/metainfo/",
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
		users = data.members;
		works = data.works;
		map = data.map;
            },
            error: function(data, textStatus, jqXHR){
		//TODO
            },
            complete: function(data, textStatus, jqXHR){
            },
	    async:false
        });

    }
    
    fetchInfo();
    
    $.each(works, function(key, value){
	result[value['id']] = {};
    });
 

    /**
     * Handle Drop Event
     */
    $('.work-ban').droppable({
	drop: function(event, ui){
	    result[$(this).attr('data')][ui.draggable.attr('data')] = true;
	},
	out: function(event, ui){
	    delete result[$(this).attr('data')][ui.draggable.attr('data')];
	}
    });



    /**
     * for save a schedule
     */

    var prepare = function(r){
	var ret = "";
	$.each(r, function(key, value){
	    var str=key+"=";
	    $.each(value, function(k,v){
		str+= k + "+";
	    });
	    ret += str+"&";
	});
	return ret;
    }
    $saveScheduleBtn = $("#save-schedule");
    $saveScheduleBtn.click(function(e){
	$.ajax({
            type: 'POST',
            url: config.home+"group/"+$("#now-gid").val()+"/schedule/",
	    data: prepare(result),
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
		console.log(data);
            },
            error: function(data, textStatus, jqXHR){
		//TODO
            },
            complete: function(data, textStatus, jqXHR){
            },
	    async:false
        });
	console.log("save schedule");
	return false;
    });
});
