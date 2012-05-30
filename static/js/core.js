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
});
