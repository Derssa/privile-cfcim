<?php
  include "php/db.php";
?>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="public/icon-cfcim.png">
    <title>Guide Privilège Maroc</title>
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
    />
    <link rel="stylesheet" href="css/home.css" />
    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <div id="data">
      <img src="public/logo-cfcim.png" alt="logo" />
      <p>Guide Privilèges Maroc</p>
      <select name="cities" id="cities">
        <option value="">Tous</option>
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
      <div class="list">
        <?php
          $sql = "SELECT * FROM elements WHERE visibility=1";
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
        ?>
        
      </div>
      <div class="detail">
        <img id="close" src="public/close.png" alt="close"/>
        <div class="content"></div>
      </div>
    </div>
    <ul class="menu"><li style="color:#000" id="tout">Tous</li><li style="color:#bbb" id="hotel">hotels</li><li style="color:#bbb" id="voyage">voyage</li><li style="color:#bbb" id="food">Resto</li><li style="color:#bbb" id="health">Santé</li><li style="color:#bbb" id="bien">Bien</li><li style="color:#bbb" id="service">Service</li></ul>
    <div id="map"></div>
    
    <script type="text/javascript">
      const here = {
        apiKey: "TDEqNj3tpw-MTJ6XyufhwSZzhzA6E2Dj4V_sY2z9J5g",
      };
      const style = "reduced.day";

      const hereTileUrl = `https://2.base.maps.ls.hereapi.com/maptile/2.1/maptile/newest/${style}/{z}/{x}/{y}/512/png8?apiKey=${here.apiKey}&ppi=320&lg=fre`;

      const map = L.map("map", {
        center: [37.769028661069253, -7.845059572405608],
        zoom: 4,
        layers: [L.tileLayer(hereTileUrl)],
      });
      map.attributionControl.addAttribution("&copy;CFCIM "+new Date().getFullYear());
      var isTout=true;
      var isHotel=false;
      var isVoyage=false;
      var isFood=false;
      var isHealth=false;
      var isBien=false;
      var isService=false;
      var markers = [];
      var hotel = L.icon({
          iconUrl: 'public/map-hotel-icon.png',
          shadowUrl: 'public/map-icon-shadow.png',

          iconSize:     [29, 38], // size of the icon
          shadowSize:   [25, 40], // size of the shadow
          iconAnchor:   [15, 39], // point of the icon which will correspond to marker's location
          shadowAnchor: [0, 40],  // the same for the shadow
          popupAnchor:  [0, -30] // point from which the popup should open relative to the iconAnchor
      });
      var voyage = L.icon({
          iconUrl: 'public/map-voyage-icon.png',
          shadowUrl: 'public/map-icon-shadow.png',

          iconSize:     [29, 38], // size of the icon
          shadowSize:   [25, 40], // size of the shadow
          iconAnchor:   [15, 39], // point of the icon which will correspond to marker's location
          shadowAnchor: [0, 40],  // the same for the shadow
          popupAnchor:  [0, -30] // point from which the popup should open relative to the iconAnchor
      });
      var food = L.icon({
          iconUrl: 'public/map-food-icon.png',
          shadowUrl: 'public/map-icon-shadow.png',

          iconSize:     [29, 38], // size of the icon
          shadowSize:   [25, 40], // size of the shadow
          iconAnchor:   [15, 39], // point of the icon which will correspond to marker's location
          shadowAnchor: [0, 40],  // the same for the shadow
          popupAnchor:  [0, -30] // point from which the popup should open relative to the iconAnchor
      });
      var health = L.icon({
          iconUrl: 'public/map-health-icon.png',
          shadowUrl: 'public/map-icon-shadow.png',

          iconSize:     [29, 38], // size of the icon
          shadowSize:   [25, 40], // size of the shadow
          iconAnchor:   [15, 39], // point of the icon which will correspond to marker's location
          shadowAnchor: [0, 40],  // the same for the shadow
          popupAnchor:  [0, -30] // point from which the popup should open relative to the iconAnchor
      });
      var bien = L.icon({
          iconUrl: 'public/map-bien-icon.png',
          shadowUrl: 'public/map-icon-shadow.png',

          iconSize:     [29, 38], // size of the icon
          shadowSize:   [25, 40], // size of the shadow
          iconAnchor:   [15, 39], // point of the icon which will correspond to marker's location
          shadowAnchor: [0, 40],  // the same for the shadow
          popupAnchor:  [0, -30] // point from which the popup should open relative to the iconAnchor
      });
      var service = L.icon({
          iconUrl: 'public/map-service-icon.png',
          shadowUrl: 'public/map-icon-shadow.png',

          iconSize:     [29, 38], // size of the icon
          shadowSize:   [25, 40], // size of the shadow
          iconAnchor:   [15, 39], // point of the icon which will correspond to marker's location
          shadowAnchor: [0, 40],  // the same for the shadow
          popupAnchor:  [0, -30] // point from which the popup should open relative to the iconAnchor
      });
      <?php
        $sql = "SELECT * FROM elements WHERE visibility=1";
        $result = $conn->query($sql);
        
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            
            echo '
            markers['.($row["id"]-1).']={marker:L.marker(['.$row["lat"].', '.$row["lon"].'], {icon: '.$row["category"].'}).addTo(map),name:"'.$row["name"].'",city:"'.$row["city"].'",lat:"'.$row["lat"].'",lon:"'.$row["lon"].'",photo:"'.$row["photo"].'",logo:"'.$row["logo"].'",contact:"'.$row["contact"].'",location:"'.$row["location"].'",phone:"'.$row["phone"].'",mail:"'.$row["email"].'",web:"'.$row["web"].'",desc:"'.$row["description"].'",category:"'.$row["category"].'",offre:"'.$row["offre"].'"};
            markers['.($row["id"]-1).'].marker.on("click", (e) => onMarkerClick(e,'.($row["id"]-1).'));
            markers['.($row["id"]-1).'].marker.on("mouseover", (e) => onMarkerHover(e,'.($row["id"]-1).'));
            markers['.($row["id"]-1).'].marker.on("mouseout", (e) => onMarkerOut(e,'.($row["id"]-1).'));
            ';
          }
        } else {
          echo "";
        }
      ?>

      var markersM=markers;
      $(document).ready(function () {
        $("#cities").on("change", function () {
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});
          if ($("#cities").val() == "agadir") {
            map.flyTo([30.40405737135645, -9.597929007026998], 12);
          } else if ($("#cities").val() == "casablanca") {
            map.flyTo([33.573411984435566, -7.599354948617042], 12);
          } else if ($("#cities").val() == "dakhla") {
            map.flyTo([23.710201744196738, -15.949547990093349], 13);
          } else if ($("#cities").val() == "fes") {
            map.flyTo([34.02707296394294, -5.013416189892562], 11);
          } else if ($("#cities").val() == "laayoune") {
            map.flyTo([27.14121133475826, -13.191432222229247], 13);
          } else if ($("#cities").val() == "marrakech") {
            map.flyTo([31.62546302442532, -8.009229276069894], 12);
          } else if ($("#cities").val() == "meknes") {
            map.flyTo([33.88611549971469, -5.530018489895851], 13);
          } else if ($("#cities").val() == "oujda") {
            map.flyTo([34.68527127394556, -1.908508768576206], 12);
          } else if ($("#cities").val() == "rabat") {
            map.flyTo([33.980587479943644, -6.851085809472512], 12);
          } else if ($("#cities").val() == "tanger") {
            map.flyTo([35.758239258003435, -5.797175505373143], 12);
          }else if ($("#cities").val() == "paris") {
            map.flyTo([48.86308857668857, 2.3411896578614697], 11);
          } else {
            map.flyTo([37.769028661069253, -7.845059572405608], 4);
          }
        });
        $("#tout").click(function () {
          
          if(!isTout){
            $("#tout").css("color", "#000");
            $("#hotel").css("color", "#bbb");
            $("#voyage").css("color", "#bbb");
            $("#food").css("color", "#bbb");
            $("#health").css("color", "#bbb");
            $("#bien").css("color", "#bbb");
            $("#service").css("color", "#bbb");
            isTout=true;
            isHotel=false;
            isVoyage=false;
            isFood=false;
            isHealth=false;
            isBien=false;
            isService=false;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM;
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
            
          }
  
        })
        
        $("#hotel").click(function () {
          
          if(!isHotel){
            $("#tout").css("color", "#bbb");
            $("#hotel").css("color", "#0c4377");
            $("#voyage").css("color", "#bbb");
            $("#food").css("color", "#bbb");
            $("#health").css("color", "#bbb");
            $("#bien").css("color", "#bbb");
            $("#service").css("color", "#bbb");
            isTout=false;
            isHotel=true;
            isVoyage=false;
            isFood=false;
            isHealth=false;
            isBien=false;
            isService=false;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM.filter(marker => marker.category == 'hotel');
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
          }
  
        })
       
        $("#voyage").click(function () {
          if(!isVoyage){
            $("#tout").css("color", "#bbb");
            $("#hotel").css("color", "#bbb");
            $("#voyage").css("color", "#13a83f");
            $("#food").css("color", "#bbb");
            $("#health").css("color", "#bbb");
            $("#bien").css("color", "#bbb");
            $("#service").css("color", "#bbb");
            isTout=false;
            isHotel=false;
            isVoyage=true;
            isFood=false;
            isHealth=false;
            isBien=false;
            isService=false;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM.filter(marker => marker.category == 'voyage');
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
          }

          
        })
        
        $("#food").click(function () {
          if(!isFood){
            $("#tout").css("color", "#bbb");
            $("#hotel").css("color", "#bbb");
            $("#voyage").css("color", "#bbb");
            $("#food").css("color", "#d6690f");
            $("#health").css("color", "#bbb");
            $("#bien").css("color", "#bbb");
            $("#service").css("color", "#bbb");
            isTout=false;
            isHotel=false;
            isVoyage=false;
            isFood=true;
            isHealth=false;
            isBien=false;
            isService=false;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM.filter(marker => marker.category == 'food');
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
          }
          
        });

        $("#health").click(function () {
          if(!isHealth){
            $("#tout").css("color", "#bbb");
            $("#hotel").css("color", "#bbb");
            $("#voyage").css("color", "#bbb");
            $("#food").css("color", "#bbb");
            $("#health").css("color", "#005656");
            $("#bien").css("color", "#bbb");
            $("#service").css("color", "#bbb");
            isTout=false;
            isHotel=false;
            isVoyage=false;
            isFood=false;
            isHealth=true;
            isBien=false;
            isService=false;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM.filter(marker => marker.category == 'health');
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
          }

          
        });

        $("#bien").click(function () {
          if(!isBien){
            $("#tout").css("color", "#bbb");
            $("#hotel").css("color", "#bbb");
            $("#voyage").css("color", "#bbb");
            $("#food").css("color", "#bbb");
            $("#health").css("color", "#bbb");
            $("#bien").css("color", "#ebe54b");
            $("#service").css("color", "#bbb");
            isTout=false;
            isHotel=false;
            isVoyage=false;
            isFood=false;
            isHealth=false;
            isBien=true;
            isService=false;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM.filter(marker => marker.category == 'bien');
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
          }
            
        });

        $("#service").click(function () {
          if(!isService){
            $("#tout").css("color", "#bbb");
            $("#hotel").css("color", "#bbb");
            $("#voyage").css("color", "#bbb");
            $("#food").css("color", "#bbb");
            $("#health").css("color", "#bbb");
            $("#bien").css("color", "#bbb");
            $("#service").css("color", "#9d2515");
            isTout=false;
            isHotel=false;
            isVoyage=false;
            isFood=false;
            isHealth=false;
            isBien=false;
            isService=true;
            for(var i=0;i<markers.length;i++){
              if(typeof markers[i] !== 'undefined'){
                map.removeLayer(markers[i].marker)
              }else{
                continue
              }
            } 
          }
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});

          
          markers = markersM.filter(marker => marker.category == 'service');
          for(var i=0;i<markers.length;i++){
            if(typeof markers[i] !== 'undefined'){
              map.addLayer(markers[i].marker)
              }else{
                continue
              }
          }
            
        });

        $("#close").click(function () {
          $.ajax({url: "php/menu.php?city="+$("#cities").val()+"&hotel="+isHotel+"&voyage="+isVoyage+"&food="+isFood+"&health="+isHealth+"&bien="+isBien+"&service="+isService+"&tout="+isTout, success: function(result){
            $(".list").html(result);
          }});
          $(".detail").animate({
            height: "0%",
          });
          if ($("#cities").val() == "agadir") {
            map.flyTo([30.40405737135645, -9.597929007026998], 12);
          } else if ($("#cities").val() == "casablanca") {
            map.flyTo([33.573411984435566, -7.599354948617042], 12);
          } else if ($("#cities").val() == "dakhla") {
            map.flyTo([23.710201744196738, -15.949547990093349], 13);
          } else if ($("#cities").val() == "fes") {
            map.flyTo([34.02707296394294, -5.013416189892562], 11);
          } else if ($("#cities").val() == "laayoune") {
            map.flyTo([27.14121133475826, -13.191432222229247], 13);
          } else if ($("#cities").val() == "marrakech") {
            map.flyTo([31.62546302442532, -8.009229276069894], 12);
          } else if ($("#cities").val() == "meknes") {
            map.flyTo([33.88611549971469, -5.530018489895851], 13);
          } else if ($("#cities").val() == "oujda") {
            map.flyTo([34.68527127394556, -1.908508768576206], 12);
          } else if ($("#cities").val() == "rabat") {
            map.flyTo([33.980587479943644, -6.851085809472512], 12);
          } else if ($("#cities").val() == "tanger") {
            map.flyTo([35.758239258003435, -5.797175505373143], 12);
          }else if ($("#cities").val() == "paris") {
            map.flyTo([48.86308857668857, 2.3411896578614697], 11);
          } else {
            map.flyTo([37.769028661069253, -7.845059572405608], 4);
          }
        });
      });
      function onMarkerClick(e,i) {
        $(document).ready(function () {
          $(".content").html('<img src="./admin/'+markersM[i].logo+'" alt="logo" id="logo"/><img src="./admin/'+markersM[i].photo+'" alt="item" id="poste"/><span>'+markersM[i].name+'</span><p id="p">'+markersM[i].city+'</p><p id="desc">'+markersM[i].desc+'</p><h3>OFFRE:</h3><img src="./admin/'+markersM[i].offre+'" alt="offre" id="offre"/><div class="contacts"><div class="contact"><span>CONTACT: </span><p>'+markersM[i].contact+'</p></div><div class="contact"><span>ADRESSE POSTALE: </span><p>'+markersM[i].location+'</p></div><div class="contact"><span>TÉL.: </span><p>'+markersM[i].phone+'</p></div><div class="contact"><span>ADRESSE MAIL: </span><a href="mailto:'+markersM[i].mail+'">'+markersM[i].mail+'</a></div><div class="contact"><span>SITE WEB: </span><a href="'+markersM[i].web+'">'+markersM[i].web+'</a></div></div>')
          $(".detail").animate({
            height: "100%",
          });
        });
        map.flyTo([e.latlng.lat, e.latlng.lng], 17);
      }
      
      function onMarkerHover(e,i) {
        markersM[i].marker
          .bindPopup(
            "<div style='display:flex;justify-content:center'><img style='height: 80px;width: 120px;object-fit: cover;border-radius: 3px;' src='./admin/"+markersM[i].photo+"' alt='item_map'/></div><br><b>"+markersM[i].name+"</b><br>"+markersM[i].city
          )
          .openPopup();
      }
      function onMarkerOut(e,i) {
        markersM[i].marker.closePopup();
      }
      function sir(i) {
        map.flyTo([markersM[i].lat, markersM[i].lon], 17);
        $(document).ready(function () {
          $(".content").html('<img src="./admin/'+markersM[i].logo+'" alt="logo" id="logo"/><img src="./admin/'+markersM[i].photo+'" alt="item" id="poste"/><span>'+markersM[i].name+'</span><p id="p">'+markersM[i].city+'</p><p id="desc">'+markersM[i].desc+'</p><h3>OFFRE:</h3><img src="./admin/'+markersM[i].offre+'" alt="offre" id="offre"/><div class="contacts"><div class="contact"><span>CONTACT: </span><p>'+markersM[i].contact+'</p></div><div class="contact"><span>ADRESSE POSTALE: </span><p>'+markersM[i].location+'</p></div><div class="contact"><span>TÉL.: </span><p>'+markersM[i].phone+'</p></div><div class="contact"><span>ADRESSE MAIL: </span><a href="mailto:'+markersM[i].mail+'">'+markersM[i].mail+'</a></div><div class="contact"><span>SITE WEB: </span><a href="'+markersM[i].web+'">'+markersM[i].web+'</a></div></div>')
          $(".detail").animate({
            height: "100%",
          }); 
        })
      }
    </script>
  </body>
</html>
