$(function() {
	$("#add_entity_form").submit(function(e) {
		$.post('callback.php', $(this).serialize(), function(data) {
			$("#entities").prepend(data);
		});
		this.reset();
		return false;
	});

	$(".entity .hit-form").live('submit',function(e) {
		var entity_container = $(this).closest(".entity");
		$.post('callback.php', $(this).serialize(), function(data) {
			entity_container.find('.life_attr').html(data.life_remaining + " / " + data.life);
			entity_container.find('.armor_attr').html(data.armor_str);

			log(entity_container, "Tog "+data.damage_done+" skada");

			var pbar = entity_container.find(".life");
			var target_width = data.life_percent+"%";
			if(data.life_remaining == 0) target_width = "1px";

			pbar.children('.bar').animate( { 'width':target_width}, {
				duration: 'slow',
				step: function() {
					var percent = pbar.children(".bar").width() / pbar.width();
					pbar.attr('class', 'life progress progress-'+progress_class(percent*100.0));
				},
				complete: function() {
					pbar.attr('class', 'life progress progress-'+progress_class(data.life_percent));
					if(data.life_remaining == 0) {
						pbar.children('.bar').css("width", "0px");
						//Remove existing dead label (to prevent doublets)
						entity_container.find(".labels").children(".dead-label").remove();

						entity_container.find(".labels").prepend("<span class='label label-inverse dead-label'>Död</span>");
						entity_container.find("strong").first().addClass("dead muted");
						entity_container.find(".hit-form").hide();
					}
			}});
		});
		this.reset();
		return false;
	});

	$('.entity .entity-visible').live('change', function() {
		var entity_container = $(this).closest(".entity");
		var labels = entity_container.find(".labels");
		var id = $(this).siblings('.entity-id').val();
		labels.find(".visible-status").remove();
		$.post('callback.php', {'action': 'update_entity_attributes', 'id': id, 'visible': $(this).attr("checked")}, function(data) {
			if(data.visible) {
				labels.append("<span class='label label-warning visible-status'>Synlig</span>");
			} else {
				labels.append("<span class='label label-info visible-status'>Dold</span>");
			}
		});
	});

	$('.entity .entity-info').live('change', function() {
		var entity_container = $(this).closest(".entity");
		var id = $(this).siblings('.entity-id').val();
		$.post('callback.php', {'action': 'update_entity_attributes', 'id': id, 'info': $(this).val()}, function(data) {
			log(entity_container, "Uppdaterade info");
		});
	});

	$('.entity .entity-state').live('change', function() {
		var entity_container = $(this).closest(".entity");
		var id = $(this).siblings('.entity-id').val();
		$.post('callback.php', {'action': 'update_entity_attributes', 'id': id, 'state': $(this).val()}, function(data) {
			log(entity_container, "Uppdaterade status till " + data.state);
		});
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

function log(entity_container, text) {
	var log = entity_container.find(".log");
	while(log.children().length >= 5) {
		log.children().last().remove();
	}
	log.prepend("<p>" + text + "</p>");
}
