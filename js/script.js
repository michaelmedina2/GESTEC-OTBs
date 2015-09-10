$(document).ready(function() {
	
	$("#menu a").each(function() {
		var href = $(this).attr("href");
		$(this).attr({href : "#"});
		$(this).click(function() {
			$("#central").load(href);
		});
	});
	
});
