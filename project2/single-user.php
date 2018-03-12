<?php
 require_once('includes/travel-config.inc.php'); 
 $db = new UsersGateway($connection );
 $result = $db->findById($_GET['id']);
 include 'includes/header.inc.php'; ?>

    <div class="container">
    <div class="jumbotron">
          <h2><?php echo $result['FirstName'].' '.$result['LastName']; ?></php></h2>
          <div ><p><?php echo $result['Address']; ?></p>
          <p><?php echo $result['City'] . ", " .$result['Postal']. ", ". $result['Country'];?></p>
          <p><?php echo $result['Phone']; ?></p>
          <p><?php echo $result['Email']; ?></p>
          </div>
        </div>   
  </div>
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images by <?php echo $result['FirstName'].' '.$result['LastName'];?></div>
          <div class="panel-body">
            <form action="single-country.php" method="post">
                <?php
                $link="UserID";
              displayImgList($link)
              ?>
            </form>
          </div>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>