<?php
 require_once('includes/travel-config.inc.php'); 
 $db = new UsersGateway($connection );
 $db2 = new ImageDetailsGateway($connection);
 $result = $db->findById($_GET['id']);
 $result2= $db->getImages($_GET['id']);
 if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
}
 include 'includes/header.inc.php'; ?>

<main class="container">
    <div class="container">
        <div class="col-md-8">
    <div class="jumbotron">
          <h2><?php echo $result['FirstName'].' '.$result['LastName']; ?></php></h2>
          <div ><p><?php echo $result['Address']; ?></p>
          <p><?php echo $result['City'] . ", " .$result['Postal']. ", ". $result['Country'];?></p>
          <p><?php echo $result['Phone']; ?></p>
          <p><?php echo $result['Email']; ?></p>
          </div>
        </div>   
  </div>
    
    <div class="col-md-4">
        <div class="panel panel-default" id="box">
          <div class="panel-heading heading-2">Images by <?php echo $result['FirstName'].' '.$result['LastName'];?></div>
          <div class="panel-body">
            <form action="single-country.php" method="post">
                <ul class='caption-style-2'>
                <?php
                foreach ($result2 as $row) {
                        
                        
                        echo "<li>";
                        echo "<a  class='imagePreview' href='single-image.php?id=".$row['ImageID']. "'><img src='images/square-small/" .$row['Path']. "'></a>";
                         
                         
                         echo "<div class='displayTitle' >
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
                  
              </ul>
            </form>
          </div>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>