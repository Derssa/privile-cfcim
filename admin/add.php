<?php
session_start();
if(!$_SESSION['admin-guide-cfcim']){
    header('location:index.php');      
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
  <h2 style="color:#aaa;">AJOUTER OFFRE</h2>
                  <form style="display:flex;flex-direction:column;width:60%;" method="POST" action="php/additem.php" enctype="multipart/form-data">
                        <div><label for="logo">Select logo:</label>
                        <input type="file" id="logo" name="logo" required/></div>
                            
                        <div><label for="image">Select image:</label>                    
                        <input type="file" id="image" name="image" required/></div>

                        <div><label for="image">Offre:</label>                    
                        <input type="file" id="offre" name="offre" required/></div>
                        
                      <input type="text" name="nom" id="nom" placeholder="Nom" required/>
                      <input type="adresse" name="location" id="location" placeholder="Location"/>
                      <select name="cities" id="cities" required>
                            <option value="">Choisissez la ville</option>
                            <option value="agadir">Agadir</option>
                            <option value="casablanca">Casablanca</option>
                            <option value="dakhla">Dakhla</option>
                            <option value="fes">Fès</option>
                            <option value="laayoune">Laâyoune</option>
                            <option value="marrakech">Marrakech</option>
                            <option value="meknes">Meknès</option>
                            <option value="oujda">Oujda</option>
                            <option value="rabat">Rabat</option>
                            <option value="tanger">Tanger</option>
                            <option value="paris">Paris</option>
                      </select>
                      <textarea name="description" id="description" placeholder="Description"  rows="7"></textarea>
                      <input type="email" name="email" id="email" placeholder="email"/>
                      <input type="text" name="contact" id="contact" placeholder="Nom du contact"/>
                      <input type="text" name="web" id="web" placeholder="Site web"/>
                      <input type="phone" name="phone" id="phone" placeholder="phone"/>
                      <input type="text" name="lat" id="lat" placeholder="lat" required/>
                      <input type="text" name="lon" id="lon" placeholder="lon" required/>
                      <select name="categorie" id="categorie" required>
                            <option value="">Choisissez la categorie</option>
                            <option value="hotel">hotelrie</option>
                            <option value="voyage">voyage</option>
                            <option value="food">resto</option>
                            <option value="health">santé</option>
                            <option value="bien">Bien</option>
                            <option value="service">service</option>
                      </select>
                      <button type="submit" id="sub2">Ajouter</button>                 
                  </form> 
      <body>
</html>