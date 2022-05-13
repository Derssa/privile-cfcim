<?php
session_start();
if(!$_SESSION['admin-guide-cfcim']){
    header('location:index.php');      
}
  include "../php/db.php";
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <link rel="stylesheet" href="../css/admin.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <header>
      <img
        style="margin-bottom: 20px"
        src="../public/logo-cfcim.png"
        alt="logo-cfcim"
        width="300"
      />
      <span>Admin Guide Privilèges Maroc</span>
      <a href="./add.php">AJOUTER OFFRE</a>
      <a id="dec" href="./logout.php">Deconnexion</a>
    </header>
    <div class="list">
      <?php
      $sql = "SELECT * FROM elements";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if($row["visibility"]==1){
            echo '<div class="item">            
            <svg id="'.$row["id"].'_unvisible" viewBox="0 0 640 512" onclick="unvisible('.$row["id"].')">
              <path
                fill="#940909"
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"
              ></path>
            </svg>
            <svg id="'.$row["id"].'_visible" viewBox="0 0 576 512" onclick="visible('.$row["id"].')">
              <path
                fill="#298742"
                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"
              ></path>
            </svg>
            <img
              src="'.$row["photo"].'"
              alt="item"
            />
            <span>'.$row["name"].'</span>
            <a href="detail.php?id='.$row["id"].'">MODIFIER</a>
          </div>';
          }else{
            echo '<div class="item">
            <svg id="'.$row["id"].'_visible" viewBox="0 0 576 512" onclick="visible('.$row["id"].')">
              <path
                fill="#298742"
                d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"
              ></path>
            </svg>
            <svg id="'.$row["id"].'_unvisible" viewBox="0 0 640 512" onclick="unvisible('.$row["id"].')">
              <path
                fill="#940909"
                d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"
              ></path>
            </svg>
            <img
              src="'.$row["photo"].'"
              alt="item"
            />
            <span>'.$row["name"].'</span>
            <a href="detail.php?id='.$row["id"].'">MODIFIER</a>
          </div>';
          }
        }
      } else {
        echo "0 results";
      }
      $conn->close();
      ?>
      
    </div>
    <script>
      
      function visible(id) {
        $(document).ready(function () {
          $.ajax({url: "../php/unvisibility.php?id="+id, success: function(res){
            console.log(res)
          }});
          $("#"+id+"_visible").hide();
          $("#"+id+"_unvisible").show();
        })
      }
      function unvisible(id) {
        $(document).ready(function () {
          $.ajax({url: "../php/visibility.php?id="+id, success: function(res){
            console.log(res)
          }});
          $("#"+id+"_unvisible").hide();
          $("#"+id+"_visible").show();
        })
      }
    </script>
  </body>
</html>
