<?php
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
}
 require_once('includes/travel-config.inc.php'); 
 $db = new PostsGateway($connection );
 $db2 = new ImageDetailsGateway($connection);
 $result = $db->postsGet($_GET['id']);
 $result2= $db->findByID($_GET['id']);
 
 include 'includes/header.inc.php'; 

 $postArray = array("title"=> $result2['Title'], "image"=> $result[0]['Path'], "id"=>$_GET['id']);
 $postArray = serialize($postArray);
 ?>

     <main class="container">
        <div class="container">
             <div class="col-md-8">
                <div class="jumbotron" id="postJumbo">
                    <h1>Single Post</h1>
                        
        <h2><?php echo $result2['Title']; ?></h2>
          <h3><?php echo "<a href='single-user.php?id=" .$result2['UserID']."'>"?><?php echo $result2['FirstName'].' '.$result2['LastName']; ?></a></h3>
          <p><?php echo $result2['Message']; ?></p>
         <div class='btn-group btn-group-justified' role='group' aria-label='responses'>
                            <div class='btn-group' role='group'>
                                <?php echo "<a href='makeCookies.php?post=" .$postArray. "'>";?><button type='button' class='btn btn-default'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span></button></a>
                            </div>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></button>
                            </div>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button>
                            </div>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></button>
                            </div>
                        </div>
          </div>
          
  </div>
   
   <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images From <?php echo $result2['Title']; ?></div>
          <div class="panel-body">
            <!--<form action="single-country.php" method="post"> --->
             <ui class='caption-style-2'> <!-- temp attempt to get images to work. Not too sure where displayImgList is --->
                 <?php 
                    foreach ($result as $row) {
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
    </main>

                   
    <?php include 'includes/footer.inc.php'; ?>
   
</html>