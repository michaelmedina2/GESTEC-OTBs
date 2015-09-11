$(document).ready(function() {
	/*
	$("#menu a").each(function() {
		var href = $(this).attr("href");
		$(this).attr({href : "#"});
		$(this).click(function() {
			$("#centralX").load(href);
		});
	});
	*/
	$("#btnView").click(function(){
		$("#central").load("viewrol.php");
	});

	$('#gridx').DataTable();

	$( "#roles-tabs" ).tabs();
    $( ".radio" ).buttonset();
});
