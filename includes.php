<?php
$repo_root=dirname(__FILE__);

define('HTML_ACCESS', true);

include "settings.php";
include "functions.php";
include "form_helpers.php";

/**
 * Automatiskt anropad av php-5 on-demand för att include:a filer med klassdefinitioner.
 * Sätter den globala variabern $repo_root till sökvägen till svn-repots root-mapp.
 */
function __autoload($class)
{
	global $repo_root;
	if(file_exists($repo_root.'/classes/'.$class.'.php')){
		require_once $repo_root.'/classes/'.$class.'.php';
	}
}

session_start();

/* Database */
$db = new mysqli(
	$db_settings['host'],
	$db_settings['username'],
	$db_settings['password'],
	$db_settings['database'],
	$db_settings['port']
);
