$(function() {
	$("#add_entity_form").submit(function(e) {
		$.post('callback.php', $(this).serialize(), function(data) {
			$("#entities").prepend(data);
		});
		this.reset();
		return false;
	});

	$(".entity .hit-form").live('submit',function(e) {
		var entity_container = $(this).parent().parent(); //urk
		$.post('callback.php', $(this).serialize(), function(data) {
			var pbar = entity_container.children(".data").children(".life");
			pbar.children('.bar').css('width', data.life_percent+"%");
			pbar.attr('class', 'life progress progress-'+progress_class(data.life_percent));
		});
		this.reset();
		return false;
	});
});

function progress_class(hp_percent) {
	if(hp_percent > 66) {
		return "success";
	} else if(hp_percent > 33) {
		return "warning";
	} else {
		return "danger";
	}
}
