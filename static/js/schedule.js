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
 
    var getNumOfWork = function(wid){
	var ret = 0;
	$.each(result[wid], function(key, value){ret++});
	return ret;
    }

    var checkCan = function(uid, wid){
	var requireNum = $('#work-target-'+wid).attr('num');
	return map[uid][wid] && requireNum > getNumOfWork(wid);
    }

    /**
     * for Schedule
     */
    $('.work-ban, .member-ban').sortable({
	connectWith: ".work-ban, .member-ban",
	dropOnEmpty: true,
	start: function(event, ui){
	    var uid = $(ui.item).attr('data');
	    $.each(works, function(key, value){
		if (checkCan(uid, value['id'])){
		    $('#work-target-'+value['id']).addClass("work-ban-highlight");
		}
	    });
	},
	stop: function(event, ui){
	    $.each(works, function(key, value){
		$('#work-target-'+value['id']).removeClass("work-ban-highlight");
	    });
	}
    }).disableSelection();
    
    
    /**
     * Handle Drop Event
     */
    $('.work-ban').bind("sortreceive", function(event, ui){
	var uid=ui.item.attr('data');
	var wid=$(this).attr('data');

	if(!map[uid][wid] || getNumOfWork(wid) >= $('#work-target-'+wid).attr('num')){
	    result[$(ui.sender).attr('data')][uid] = true;
	    $(ui.sender).sortable('cancel');
	}
	else
	    result[wid][uid] = true;
    });
    
    $('.work-ban').bind("sortremove", function(event, ui){
	delete result[$(this).attr('data')][ui.item.attr('data')];
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
	ret += "schedule-name=" + $('#schedule-name').val();
	return ret;
    }
    $saveScheduleBtn = $("#save-schedule");
    $saveScheduleBtn.click(function(e){
	console.log(prepare(result));
	$.ajax({
            type: 'POST',
            url: config.home+"group/"+$("#now-gid").val()+"/schedule/",
	    data: prepare(result),
            dataType: 'json',
            success: function(data, textStatus, jqXHR){
		// TODO
            },
            error: function(data, textStatus, jqXHR){
		//TODO
            },
            complete: function(data, textStatus, jqXHR){
            },
	    async:false
        });
	return false;
    });
});
