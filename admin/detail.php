<?php
session_start();
if(!$_SESSION['admin-guide-cfcim']){
    header('location:index.php');      
}
include "../php/db.php";
if(isset($_GET)){
    $id=$_GET["id"];
    $sql = "SELECT * FROM elements WHERE id=$id";
    $result = $conn->query($sql);
    $nom="";
    $location="";
    $city="";
    $description = "";
    $email="";
    $contact="";
    $web="";
    $phone="";
    $lat="";
    $lon="";
    $categorie="";
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $nom=$row["name"];
        $location=$row["location"];
        $city=$row["city"];
        $description = $row["description"];
        $email=$row["email"];
        $contact=$row["contact"];
        $web=$row["web"];
        $phone=$row["phone"];
        $lat=$row["lat"];
        $lon=$row["lon"];
        $categorie=$row["category"];
    }
    } else {
    echo "0 results";
    }
    $conn->close();
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Admin</title>
      <style type="text/css">
          *{             
              font-family: Arial, Helvetica, sans-serif;
          }
          input{
                  padding: 10px;
                  background-color: rgb(215, 215, 215);
                  outline: none;
                  border-radius: 10px;
                  border: none;
                  margin-bottom:10px;
              }
              p{
                  color:#e40343;
                  text-align:center;
                  font-weight:bold;
              }
              form select {
  background-color: rgb(215, 215, 215);
  width: 100%;
  margin-bottom:10px;
  border: none;
  outline: none;
  color: #111;
  border-radius: 10px;
  padding: 10px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: 0.2s;
}
form select:hover {
  background-color: rgb(200, 200, 200);
}
form option {
  background-color: #f3f3f3;
  width: 100%;
  margin-top: 20px;
  border: none;
  outline: none;
  color: #0c4377;
  padding: 5px;
  font-size: 14px;
  font-weight: 500;
}
form textarea {
    resize:none;
    padding: 10px;
    background-color: rgb(215, 215, 215);
                  outline: none;
                  border-radius: 10px;
                  border: none;
                  margin-bottom:10px;
}
              form button {
                  padding: 10px;
                  background-color: #e40343;
                  text-transform: uppercase;
                  font-weight: 600;
                  border-radius: 10px;
                  border:none;
                  outline:none;
                  color: white;
                  transition: 0.2s;
              }
              form button:hover {
                  padding: 10px;
                  background-color: #e4034354;
                  text-transform: uppercase;
                  font-weight: 600;
                  border-radius: 10px;
                  color: #e40343;
              }
          </style>
  </head>
  <body style="display:flex;flex-direction:column;align-items:center;padding:0 20px;font-family: Arial, Helvetica, sans-serif;">
  <h2 style="color:#aaa;">MODIFIER OFFRE</h2>
                  <form style="display:flex;flex-direction:column;width:60%;" method="POST" action="php/modifyitem.php?id=<?php echo $id?>" enctype="multipart/form-data">
                                               
                      <input type="text" name="nom" id="nom" placeholder="Nom" value="<?php echo $nom?>" />
                      <input type="adresse" name="location" id="location" placeholder="Location" value="<?php echo $location?>" />
                      <select name="cities" id="cities" >
                            <option value="">Choisissez la ville</option>
                            <option value="agadir" <?php $city=="agadir"?print "selected":"";?>>Agadir</option>
                            <option value="casablanca" <?php $city=="casablanca"?print "selected":"";?>>Casablanca</option>
                            <option value="dakhla" <?php $city=="dakhla"?print "selected":"";?>>Dakhla</option>
                            <option value="fes" <?php $city=="fes"?print "selected":"";?>>Fès</option>
                            <option value="laayoune" <?php $city=="laayoune"?print "selected":"";?>>Laâyoune</option>
                            <option value="marrakech" <?php $city=="marrakech"?print "selected":"";?>>Marrakech</option>
                            <option value="meknes" <?php $city=="meknes"?print "selected":"";?>>Meknès</option>
                            <option value="oujda" <?php $city=="oujda"?print "selected":"";?>>Oujda</option>
                            <option value="rabat" <?php $city=="rabat"?print "selected":"";?>>Rabat</option>
                            <option value="tanger" <?php $city=="tanger"?print "selected":"";?>>Tanger</option>
                            <option value="paris" <?php $city=="paris"?print "selected":"";?>>Paris</option>
                      </select>
                      <textarea name="description" id="description" placeholder="Description" rows="7" ><?php echo $description?></textarea>
                      <input type="email" name="email" id="email" placeholder="email" value="<?php echo $email?>" />
                      <input type="text" name="contact" id="contact" placeholder="Nom du contact" value="<?php echo $contact?>" />
                      <input type="text" name="web" id="web" placeholder="Site web" value="<?php echo $web?>" />
                      <input type="phone" name="phone" id="phone" placeholder="phone" value="<?php echo $phone?>" />
                      <input type="text" name="lat" id="lat" placeholder="lat" value="<?php echo $lat?>" />
                      <input type="text" name="lon" id="lon" placeholder="lon" value="<?php echo $lon?>" />
                      <select name="categorie" id="categorie" >
                            <option value="">Choisissez la categorie</option>
                            <option value="hotel" <?php $categorie=="hotel"?print "selected":"";?>>hotelrie</option>
                            <option value="voyage" <?php $categorie=="voyage"?print "selected":"";?>>voyage</option>
                            <option value="food" <?php $categorie=="food"?print "selected":"";?>>resto</option>
                            <option value="health" <?php $categorie=="health"?print "selected":"";?>>santé</option>
                            <option value="bien" <?php $categorie=="bien"?print "selected":"";?>>bien</option>
                            <option value="service" <?php $categorie=="service"?print "selected":"";?>>service</option>
                      </select>
                      <button type="submit" id="sub2">Modifier</button>                 
                  </form> 
      <body>
</html>