<?php
 require_once('includes/travel-config.inc.php'); 
              
function returnFormatted($data){
    if(is_numeric($data))
    {
        $data=number_format($data);
    }
    return '<b>' . $data . '</b>';
} 

$db = new CitiesGateway($connection);
$result = $db->findById($_GET['id']);

 include 'includes/header.inc.php';
 $lat=$result['Latitude'];
 $long=$result['Longitude'];
 

 ?>
    
    
<div class="container">
    <div class="jumbotron">
          <h2><?php echo $result['AsciiName']; ?></php></h2>
          <div ><p>Time Zone: <b><?php echo returnFormatted($result['TimeZone']); ?> </b></p>
          <p>Elevation: <b><?php echo returnFormatted($result['Elevation']);?> sq km.</p>
          <p>Population: <?php echo returnFormatted($result['Population']); ?></p>
          </div>
    </div>    
</div>
<div id="map"></div>
    <?php echo "<script>
      function initMap() {
        var uluru = {lat: $lat, lng: $long};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>"
    ?>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgDSLvwY6agkdlVLq0CEDfnJDNIVaOClU&callback=initMap">
    </script>
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images From <?php echo $result['AsciiName']; ?></div>
          <div class="panel-body">
            <!--<form action="single-country.php" method="post"> --->
             <ui class='caption-style-2'> <!-- temp attempt to get images to work. Not too sure where displayImgList is --->
                 <?php 
                    $result2 = $db->getByCity($_GET['id']);
                    foreach ($result2 as $row) {
                        echo "<li class='col-md-1'>";
                        echo "<a href='single-image.php?id=".$row['ImageID']. "'><img src='images/square-small/" .$row['Path']. "'></a>";
                        echo "</li>";        
                    }
                    ?>
             </ui>   
         </div>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>

 
</html>