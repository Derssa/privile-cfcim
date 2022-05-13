<?php
session_start();
if(!$_SESSION['admin-guide-cfcim']){
    header('location:index.php');      
}
include "../../php/db.php";

      $id=$_GET["id"];    
    $nom=$_POST["nom"];
    $location=$_POST["location"];
    $city=$_POST["cities"];
    $description = str_replace(array("\n", "\r", "\t", "\\"), array("\\n", "\\r", "\\t", "\\\\"), $_POST["description"]);
    $email=$_POST["email"];
    $contact=$_POST["contact"];
    $web=$_POST["web"];
    $phone=$_POST["phone"];
    $lat=$_POST["lat"];
    $lon=$_POST["lon"];
    $categorie=$_POST["categorie"];
    $sql = "UPDATE elements SET name=\"$nom\",location=\"$location\",city=\"$city\",description=\"$description\",email=\"$email\",contact=\"$contact\",web=\"$web\",phone=\"$phone\",lat=\"$lat\",lon=\"$lon\",category=\"$categorie\" WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../admin.php');
      } else {
        echo "Error updating record: " . $conn->error;
      }

    $conn->close();
?>