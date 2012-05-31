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
    $('.work-ban').droppable({
	drop: function(event, ui){
	    console.log(event);
	    console.log(ui);
	    var uid=ui.draggable.attr('data');
	    var wid=$(this).attr('data');
	    console.log(wid);
	    console.log(uid);
	    if(!map[uid][wid] || getNumOfWork(wid) > $('#work-target-'+wid).attr('num')){
		console.log("fuck");
		$(this).sortable('cancel');
	    }
	    else
		result[wid][uid] = true;
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
