<?php
session_start();
if(!isset($_SESSION['admin-guide-cfcim'])){
    $err="";
    if($_POST){
        include '../php/db.php';
        $email=$_POST['email'];
        $password=$_POST['password'];        
        $query="SELECT * FROM admins WHERE email='$email'";
        $result=mysqli_query($conn,$query);
        if ($result->num_rows == 1) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {
                session_start();
                $_SESSION['admin-guide-cfcim']='admin-guide-cfcim';
                header('location:admin.php');
            } else {
                $err="Mot de passe incorrect";    
            } 
        }             
        }else{  
            $err="Email incorrect";          
        }
    }
}else{
    header('location:admin.php');      
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
  <body style="display:flex;flex-direction:column;align-items:center;padding:100px 20px;font-family: Arial, Helvetica, sans-serif;">
  <img style="margin-bottom:20px;" src="../public/logo-cfcim.png" alt="logo-cfcim" width="300"/>
                  <form style="display:flex;flex-direction:column;width:60%;" method="POST">
                      <input type="email" name="email" id="email" placeholder="Email" required/>
                      <input type="password" name="password" id="password" placeholder="password" required/>
                      <button type="submit" id="sub2">Connexion</button> 
                      <?php if($err){echo '<p id="errMsg">"'.$err.'"</p>';} ?>                 
                  </form> 
      <body>
</html>
