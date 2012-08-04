<?php
// Controller of a sort for index.php


$battle_id = get('id');

$battle = $battle_id ? Battle::from_id($battle_id) : NULL;

if(post("new_battle")) {
	$battle = new Battle(array('name' => post("new_battle")));
	$battle->commit();
	redirect("index.php?id={$battle->id}");
}

if($battle) {

}
