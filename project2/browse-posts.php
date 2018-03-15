<?php
 include('includes/travel-config.inc.php');
 include 'includes/header.inc.php'; 
 ?>
 <div class="col-md-10">

                <div class="jumbotron" id="postJumbo">
                    <h1>Posts</h1>
                    <p>Read other travellers' posts ... or create your own.</p>
                    <p><a class="btn btn-warning btn-lg">Learn more &raquo;</a></p>
                </div>        
      
                 <!-- start post summaries -->
                 <div class="postlist">

                   <!-- replace each of these rows with a function call -->
                   <?php
                   $db = new PostsGateway($connection );
                 $result = $db->findAllSorted("DESC");
                 foreach($result as $row){
                     $PostID=$row['PostID'];
                     $UserID=$row['UserID'];
                     $path=$row['Path'];
                     $name=$row['FirstName'].' '.$row['LastName'];
                     $img=$row['MainPostImage'];
                     echo '<div class="row">
                       <div class="col-md-4">'; 
                          echo "<a href='single-image.php/?id=$img'><img src='images/square-medium/$path' alt='$UserID' class='img-responsive'/></a>";
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