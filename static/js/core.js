var config = {
    home: "http://localhost/paike/"
};

$(function(){
    $searchForm = $("#search-form");
    $searchBtn = $("#search");
    $searchBtn.click(function(e){
	window.location.href = config.home+"search/?"+$searchForm.serialize();
	return false;
    });
    
    $('a.join-group').click(function(e){
	var id = $(this).attr('data');
	$.ajax({
            type: 'POST',
            url: config.home+"group/"+id+"/join/",
            success: function(data, textStatus, jqXHR){
		$.jGrowl("小组加入成功" ,{header: "成功"});
            },
            error: function(data, textStatus, jqXHR){
		$.jGrowl("小组加入失败" ,{header: "失败"});
            },
            complete: function(data, textStatus, jqXHR){
            }
        });
	return false;
    });

});
