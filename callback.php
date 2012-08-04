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
		'armor_type' => post('armor_type'),
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
		$entity->commit();
		include "partials/entity.php";
	}
}
