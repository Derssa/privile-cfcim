<?php
    include "./db.php";
    if(isset($_GET)){
          $city=$_GET["city"];
          $hotel=$_GET["hotel"];
          $voyage=$_GET["voyage"];
          $food=$_GET["food"];
          $health=$_GET["health"];
          $bien=$_GET["bien"];
          $service=$_GET["service"];
          $tout=$_GET["tout"];
          if($city!=''){
            if($hotel=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND category='hotel' AND visibility=1";
            }else if($voyage=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND category='voyage' AND visibility=1";
            }else if($food=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND category='food' AND visibility=1";
            }else if($health=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND category='health' AND visibility=1";
            }else if($bien=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND category='bien' AND visibility=1";
            }else if($service=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND category='service' AND visibility=1";
            }else if($tout=='true'){
              $sql = "SELECT * FROM elements WHERE city='$city' AND visibility=1";
            }

          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // output data of each row

            while($row = $result->fetch_assoc()) {
              echo '<div class="item" onclick="sir('.($row["id"]-1).')">
              <img
                src="./admin/'.$row["photo"].'"
                alt="item"
                id="poste"
              />
              <div class="west_item">
                <span>'.$row["name"].'</span>
                <p>'.$row["city"].'</p>
              </div>
            </div>';
            }
          } else {
            echo "";
          }}else{
            if($hotel=='true'){
              $sql = "SELECT * FROM elements WHERE category='hotel' AND visibility=1";
            }else if($voyage=='true'){
              $sql = "SELECT * FROM elements WHERE category='voyage' AND visibility=1";
            }else if($food=='true'){
              $sql = "SELECT * FROM elements WHERE category='food' AND visibility=1";
            }else if($health=='true'){
              $sql = "SELECT * FROM elements WHERE category='health' AND visibility=1";
            }else if($bien=='true'){
              $sql = "SELECT * FROM elements WHERE category='bien' AND visibility=1";
            }else if($service=='true'){
              $sql = "SELECT * FROM elements WHERE category='service' AND visibility=1";
            }else if($tout=='true'){
              $sql = "SELECT * FROM elements WHERE visibility=1";
            }
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                echo '<div class="item" onclick="sir('.($row["id"]-1).')">
                <img
                  src="./admin/'.$row["photo"].'"
                  alt="item"
                  id="poste"
                />
                <div class="west_item">
                  <span>'.$row["name"].'</span>
                  <p>'.$row["city"].'</p>
                </div>
              </div>';
              }
            } else {
              echo "";
            }
          }

    }
?>