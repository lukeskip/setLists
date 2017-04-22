<?php

require("conexion.php");

$name		= $_POST['name'];
$lastname 	= $_POST['lastname'];
$email 		= $_POST['mail'];
$answers 	= $_POST['answers'];

date_default_timezone_set('America/Mexico_City'); 
$date = date("Y-m-d H:i:s");
if($email!=""){
	$guardar 	= "INSERT INTO musicos (id,name,lastname,email,answers,date) VALUES ('',:name,:lastname,:email,:answers,:date)";
	$query 		= $conn->prepare($guardar);

	$query->bindParam(':name', $name);
	$query->bindParam(':lastname', $lastname);
	$query->bindParam(':email', $email);
	$query->bindParam(':answers', $answers);
	$query->bindParam(':date', $date);

	$status =  $query->execute();
	if ($status) {
		echo "se guardó";
	}else{
		print_r($query->errorInfo());
	}
}else{
	echo false;
}