<?php
/* Database */
$db = new mysqli(
	$db_settings['host'],
	$db_settings['username'],
	$db_settings['password'],
	$db_settings['database'],
	$db_settings['port']
);
