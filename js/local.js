function load_data(mode) {
	url = "http://kenstore.biz/ajax";
	$.ajax({
		url : url,
		type : 'post',
		data : {
			mode : 'load_data',
			value : mode
		},
		headers: { 'Access-Control-Allow-Origin': '*' },
		success : function (response) {
			$(".content-panel-tab.col-content:first").html(response);
		}
	})
}

function buyApp(id,smt,smte,appview) {
	window.location.href = "http://kenstore.biz/download/id";
	
}