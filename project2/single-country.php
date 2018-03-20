<?php
 require_once('includes/travel-config.inc.php'); 
              
function returnFormatted($data){
    if(is_numeric($data))
    {
        $data=number_format($data);
    }
    return '<b>' . $data . '</b>';
} 

function makeMap($name, $iso, $result2) {
    $name = str_replace(" ", "+", $name);
    $map =  "https://maps.googleapis.com/maps/api/staticmap?center=" .$name. "," .$iso . "&zoom=3&size=600x300"; //before i forget, issue with countries that have more than 1 word, ie united states, united kingdom. Because of the space, the img tag stops at the first word and the map will not display
    //$db = new CitiesGateway($connection);
    //$result = $db->getbyCity2($_GET['id']);
    foreach($result2 as $row) {
        $map .= "&markers=color:red|" .$row['Latitude']. "," .$row['Longitude'];
    }
    return $map;
}

$db = new CountriesGateway($connection);
$result = $db->findById($_GET['id']);
$result2 = $db->getByCities($_GET['id']);
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
}
 include 'includes/header.inc.php';
 

 ?>
    
<main class="container">
<div class="container">
    <div class="col-md-8">
    <div class="jumbotron">
          <h2><?php echo $result['CountryName']; ?></php></h2>
          <div ><p>Capital: <b><?php echo returnFormatted($result['Capital']); ?> </b></p>
          <p>Area: <b><?php echo returnFormatted($result['Area']);?> sq km.</b></p>
          <p>Population: <?php echo returnFormatted($result['Population']); ?></p>
          <p>Currency Name: <?php echo returnFormatted($result['CurrencyName']); ?></p>
          <p><?php echo $result['CountryDescription']; ?></p>
          <img src= <?php echo makeMap($result['CountryName'], $result['ISO'], $result2) ?>>
          </div>
    </div>    
</div>
    
     <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images From <?php echo $result['CountryName']; ?></div>
          <div class="panel-body">
            <!--<form action="single-country.php" method="post"> --->
             <ul class='caption-style-2'> <!-- temp attempt to get images to work. Not too sure where displayImgList is --->
                 <?php 
                    $db = new ImageDetailsGateway($connection);
                    $result = $db->getByCountryISO($_GET['id']);
                    foreach ($result as $row) {
                        echo "<li>";
                        echo "<a class='imagePreview' href='single-image.php?id=".$row['ImageID']. "&userid=" .$row['UserID']. "'><img src='images/square-small/" .$row['Path']. "'></a>";
                        
                        echo "<div class='displayTitle'>
                        <img    src='images/square-small/" .$row['Path']. "'>";
                       $result2 = $db -> getPosition($row['ImageID']);
                       foreach ($result2 as $row2){
                           echo "<h3>".$row2['Title']."</h3>";
                           echo "<p>".$row2['Description']."</p>";
                       }
                        echo "</div>";
                        echo "</li>";        
                    }
                    ?>
             </ul>   
              <script type="text/javascript">
                    
                    window.onload=function(){
                       


                        var imgPrev = document.getElementsByClassName("imagePreview")
                        
                        for(var i=0; i<imgPrev.length; i++){
                            imgPrev[i].onmouseover=function(e){
                             var panel= this.getBoundingClientRect();
                            var x = e.clientX;
                            var y = e.clientY;
                            var sib = this.nextSibling;
                           sib.style.top = (y - panel.top) + "px";
                            sib.style.left = (x - panel.left) +"px";
                            sib.style.display="block";
                            
                    
                            }
                            
                            imgPrev[i].onmouseout=function(e){
                            var sib = this.nextSibling;
                                 sib.style.display="none";
                            }
                        }
                        
                       
                    }
                    
                </script>
                <?php
                
                //$link="CountryCodeISO";
              //displayImgList($link)
              ?>
            <!--</form> --->
          </div>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>