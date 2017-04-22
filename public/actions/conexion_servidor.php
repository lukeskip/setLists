<?php 

$host="nochedequizmx.fatcowmysql.com";
$username= "rey_1367126";
$password="rAs3acE_";
$db_name="rey_games";

$conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
$conn->exec("set names utf8");