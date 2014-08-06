function load_data(mode) {
	url = document.URL;
	env = "ios";
	if (url.indexOf("android") >= 0) env = "android";
	url = "http://kenstore.biz/ajax";
	$.ajax({
		url : url,
		type : 'post',
		data : {
			mode : 'load_data',
			value : mode,
			env : env
		},
		headers: { 'Access-Control-Allow-Origin': '*' },
		success : function (response) {
			$(".content-panel-tab.col-content:first").html(response);
		}
	})
}

function buyApp(id,smt,smte,appview) {
	url = document.URL;
	env = "ios";
	if (url.indexOf("android") >= 0) env = "android"
	window.location.href = "http://kenstore.biz/download/"+ id + "/" + env;

}

function qrstep1(smth) {
	buyApp(smth,"a","e","u");
}