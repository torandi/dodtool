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
