<?php
session_start();
if(!$_SESSION['admin-guide-cfcim']){
    header('location:index.php');      
}
include "../../php/db.php";
$target_dir_logo = "uploads/logo/";
$target_dir_img = "uploads/img/";
$target_dir_offre = "uploads/offre/";
$tfl=$target_dir_logo ."logo_". date('mdYHis').'.'.pathinfo($_FILES["logo"]["name"],PATHINFO_EXTENSION);
$tfi=$target_dir_img ."img_". date('mdYHis').'.'.pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
$tfo=$target_dir_offre ."img_". date('mdYHis').'.'.pathinfo($_FILES["offre"]["name"],PATHINFO_EXTENSION);
$target_file_logo = "../".$tfl;
$target_file_img = "../".$tfi;
$target_file_offre = "../".$tfo;
$uploadOk = 1;
$imageFileType_logo = strtolower(pathinfo($target_file_logo,PATHINFO_EXTENSION));
$imageFileType_img = strtolower(pathinfo($target_file_img,PATHINFO_EXTENSION));
$imageFileType_offre = strtolower(pathinfo($target_file_offre,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["logo"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
  $check = getimagesize($_FILES["offre"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file_logo)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}
if (file_exists($target_file_img)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  if (file_exists($target_file_offre)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

// Check file size
if ($_FILES["logo"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  if ($_FILES["offre"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

// Allow certain file formats
if($imageFileType_logo != "jpg" && $imageFileType_logo != "png" && $imageFileType_logo != "jpeg"
&& $imageFileType_logo != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
if($imageFileType_img != "jpg" && $imageFileType_img != "png" && $imageFileType_img != "jpeg"
&& $imageFileType_img != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if($imageFileType_offre != "jpg" && $imageFileType_offre != "png" && $imageFileType_offre != "jpeg"
&& $imageFileType_offre != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file_logo) && move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_img) && move_uploaded_file($_FILES["offre"]["tmp_name"], $target_file_offre)) {
    $logo=$tfl;
    $image=$tfi;
    $offre=$tfo;
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
    $sql = "INSERT INTO elements (name, city, location, description, email, contact, phone, web, logo, photo, lat, lon, category,offre) VALUES (\"$nom\", \"$city\", \"$location\", \"$description\", \"$email\", \"$contact\", \"$phone\", \"$web\",\"$logo\",\"$image\",\"$lat\",\"$lon\",\"$categorie\",\"$offre\")";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>