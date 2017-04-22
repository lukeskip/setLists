<?php
require("conexion.php");
$choice = $_POST['choice'];
$check 	= "SELECT * FROM bands WHERE choice = '$choice' ORDER BY rand() LIMIT 1";
$query 	= $conn->prepare($check);
$query->execute();

while ($row = $query->fetch())  {
    $id 		 = $row['id'];
    $title 	     = $row['title'];
    $description = $row['description'];
    $link 	     = $row['link'];
    $image 	     = $row['image'];
    
    
    // Rellenamos el json con las preguntas de la base de datos
    $bands[] = array('id'=> $id, 'title'=> $title, 'description'=> $description, 'link'=> $link,
                        'image'=> $image);

}

//Creamos el JSON
$json_string = json_encode($bands);
echo $json_string;