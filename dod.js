$(function() {
	$("#add_entity_form").submit(function(e) {
		$.post('callback.php', $(this).serialize(), function(data) {
			$("#entities").prepend(data);
		});
		return false;
	});
});
