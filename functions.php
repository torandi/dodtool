<?php

function get($var, $default=NULL) {
	if(isset($_GET[$var])) 
		return $_GET[$var];
	else
		return $default;
}

function post($var, $default=NULL) {
	if(isset($_POST[$var])) 
		return $_POST[$var];
	else
		return $default;
}

function redirect($url) {
	header("Location: $url");
}

function hp_class_select($hp_percent) {
	if($hp_percent > 66) {
		return "success";
	} else if($hp_percent > 33) {
		return "warning";
	} else {
		return "danger";
	}
}

function output_json($data) {
	header("Content-Type: text/json");
	echo json_encode($data);
	exit();
}
