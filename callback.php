<?php
include "includes.php";

$action = post("action");


if(!$action) {
	echo "INVALID ACTION";
	exit;
}

unset($_POST['action']);

if($action == "add_entity") {
	$count = rand(post("count_min"), post("count_max"));
	$base = array(
		'battle_id' => post('battle_id'),
		'type' => post('type'),
		'visible' => post('visible', false) ? true : false,
		'info' => post('info')
	);

	for($i=0;$i < $count; ++$i) {
		$entity = new Entity($base);
		$entity->name = post('name') . ( $count == 1 ? "" : " #".($i+1));
		$entity->life = rand(post("life_min"), post("life_max"));
		$entity->life_remaining = $entity->life;
		$entity->armor = rand(post("armor_min"), post("armor_max"));
		$entity->natural_armor = rand(post("natural_armor_min"), post("natural_armor_max"));
		$entity->commit();
		include "partials/entity.php";
	}
} else if($action == "hit_entity") {
	$entity = Entity::from_id(post("entity_id"));
	$damage = $entity->hit(post("damage"));
	$entity->commit();
	$output = array(
		'life' => $entity->life,
		'life_remaining' => $entity->life_remaining,
		'armor_str' => $entity->armor_str(),
		'life_percent' => $entity->life_percent(),
		'damage_done' => $damage
	);
	output_json($output);

} else if($action == "update_entity_attributes") {
	$entity = Entity::update_attributes($_POST);
	output_json($entity->data());
} else {
	echo "Invalid action!";
}
