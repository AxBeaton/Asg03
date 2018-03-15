<?php
 require_once('includes/travel-config.inc.php'); 
 $db = new PostsGateway($connection );
 $result = $db->postsGet($_GET['id']);
 $result2= $db->findByID("Desc");
 include 'includes/header.inc.php'; ?>

     <div class="col-md-10">

                <div class="jumbotron" id="postJumbo">
                    <h1>Single Post</h1>
                    </div>        
                 <div class="postlist">
                     <div class="container">
    <div class="jumbotron">
          <h2><?php echo $result2['FirstName'].' '.$result['LastName']; ?></php></h2>
          <div ><p><?php echo $result['Address']; ?></p>
          <p><?php echo $result['City'] . ", " .$result['Postal']. ", ". $result['Country'];?></p>
          <p><?php echo $result['Phone']; ?></p>
          <p><?php echo $result['Email']; ?></p>
          </div>
        </div>   
  </div>

                <?php
                
                
                echo $_GET['id'];
                 foreach($result as $row){
                     $PostID=$row['PostID'];
                     $UserID=$row['UserID'];
                     $path=$row['Path'];
                     $name=$row['FirstName'].' '.$row['LastName'];
                      
                          echo "<a ><img src='images/square-medium/$path' alt='$UserID' class='img-responsive'/></a>";
                       echo '</div>
                       <div class="col-md-8"> 
                          <h2>'.$row['Title'].'</h2>
                          <div class="details">';
                            echo "Posted by <a href='single-user.php?id=$UserID'>$name</a>";
                            echo '<span class="pull-right">2/8/2017</span>
                           </div>
                          <p class="excerpt">
                          '.substr($row['Message'],0,200).'...'.'
                          </p>';
                          echo "<p class='pull-right'><a href='single-post.php?id=$PostID' class='btn btn-primary btn-sm'>Read more</a></p>
                       </div>
                   </div>  
                   <hr/>"
                   ;}
                   ?>
                   
                   
    <?php include 'includes/footer.inc.php'; ?>
    </div>
    </div>
    </div>
</html>