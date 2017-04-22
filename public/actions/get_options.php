<?php
require("conexion.php");
$choice = $_POST['choice'];
$check 	= "SELECT * FROM options";
$query 	= $conn->prepare($check);
$query->execute();

while ($row = $query->fetch())  {
   
    $title 	     = $row['title'];
    $choice       = $row['choice'];
    $image 	     = $row['image'];
    
    
    // Rellenamos el json con las preguntas de la base de datos
    $options[] = array('id'=> $id, 'title'=> $title, 'image'=> $image, 'choice'=> $choice);

}

//Creamos el JSON
$json_string = json_encode($options);
echo $json_string;