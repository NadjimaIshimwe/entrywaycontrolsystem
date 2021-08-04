<?php
date_default_timezone_set('Africa/Kigali');

//PDO Connection 
$db = new PDO('mysql:host=remotemysql.com;dbname=4eROYMFwMA;charset=utf8', '4eROYMFwMA', 'JOnAp8wNpY');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->query('SET SESSION SQL_BIG_SELECTS=1');

//2and PDO CONNECTION

$db_username = '4eROYMFwMA';
$db_password = 'JOnAp8wNpY';
$conn = new PDO('mysql:host=remotemysql.com;dbname=4eROYMFwMA', $db_username, $db_password);
if (!$conn) {
	die("Fatal Error: Connection Failed!");
}

//Connect to MySQL - database one.
$DB_CRUD1 = new PDO('mysql:host=remotemysql.com;dbname=4eROYMFwMA', '4eROYMFwMA', 'JOnAp8wNpY');