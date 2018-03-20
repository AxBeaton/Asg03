<?php
 require_once('includes/travel-config.inc.php'); 
              
function returnFormatted($data){
    if(is_numeric($data))
    {
        $data=number_format($data);
    }
    return '<b>' . $data . '</b>';
} 
  $db2 = new ImageDetailsGateway($connection);
$db = new CitiesGateway($connection);
$result = $db->findById($_GET['id']);
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
}


 include 'includes/header.inc.php';
 $lat=$result['Latitude'];
 $long=$result['Longitude'];
 

 ?>
    
<main class="container">
    <div class="container">
        <div class="col-md-8">
        <div class="jumbotron">
          <h2><?php echo $result['AsciiName']; ?></php></h2>
          <div ><p>Time Zone: <b><?php echo returnFormatted($result['TimeZone']); ?> </b></p>
          <p>Elevation: <b><?php echo returnFormatted($result['Elevation']);?> sq km.</b></p>
          <p>Population: <?php echo returnFormatted($result['Population']); ?></p>
           <?php echo "<img src='https://maps.googleapis.com/maps/api/staticmap?center=" .$lat. "," .$long . "&zoom=10&size=600x300&markers=red|".$lat.",".$long."' class='map'>";
    ?>
          
          </div>
        </div>  
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images From <?php echo $result['AsciiName']; ?></div>
          <div class="panel-body">
             <ui class='caption-style-2'> 
                 <?php 
                    $result2 = $db->getByCity($_GET['id']);
                    foreach ($result2 as $row) {
                        echo "<li>";
                        echo "<a class='imagePreview' href='single-image.php?id=".$row['ImageID']. "'><img src='images/square-small/" .$row['Path']. "'></a>";
                         echo "<div class='displayTitle'>
                        <img    src='images/square-small/" .$row['Path']. "'>";
                       $result3 = $db2 -> getPosition($row['ImageID']);
                       foreach ($result3 as $row2){
                              echo "<h3>".$row2['Title']."</h3>";
                       echo "<p>".$row2['Description']."</p>";
                       }
                    echo "</div>";
                        echo "</li>";        
                    }
                    ?>
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
             </ui>   
         </div>
        </div> 
        </div>
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>

 
</html>