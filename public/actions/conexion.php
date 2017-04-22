<?php 

$host="localhost";
$username= "root";
$password="root";
$db_name="rey_games";

$conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
$conn->exec("set names utf8");