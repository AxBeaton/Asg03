<?php
 include('includes/travel-config.inc.php');
 include 'includes/header.inc.php'; 
 $db = new UsersGateway($connection );
 ?>
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Users</div>
          <div class="panel-body">
            <form action="single-country.php" method="post">
              <div >
                  <ul class="list-group">
                <?php 
                 $result = $db->findAllSorted("DESC");
                 foreach($result as $row){
                      echo "<li class='list-group-item col-md-3 col-sm-3 col-xs-2' style='border: none'>";
                     $var=$row['UserID'];
                      echo "<a href='single-user.php?id=$var'>".$row['FirstName'].' '.$row['LastName']."</a>";
                      echo "</li>";
                 }
                 ?>
               </ul>
         </div>
        </form>

      </div>
    </div>    
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>