<?php
date_default_timezone_set('Africa/Kigali');

//PDO Connection 
$db = new PDO('mysql:host=localhost;dbname=db_entryway;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query('SET SESSION SQL_BIG_SELECTS=1');

//2and PDO CONNECTION

$db_username = 'root';
$db_password = '';
$conn = new PDO('mysql:host=localhost;dbname=db_entryway', $db_username, $db_password);
if (!$conn) {
	die("Fatal Error: Connection Failed!");
}

//Connect to MySQL - database one.
$DB_CRUD1 = new PDO('mysql:host=localhost;dbname=db_entryway', 'root', '');