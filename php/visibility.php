<?php
include "./db.php";
if(isset($_GET)){
    $id=$_GET["id"];
    $sql = "UPDATE elements SET visibility=1 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
}
?>