<?php   
 include 'includes/travel-config.inc.php';
include 'includes/header.inc.php'; 

?>
   
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Cities with Images</div>
          <div class="panel-body">
            <form action="single-city.php" method="post">
              <div >
                  <ul class="list-group">
                <?php 
                $db = new CitiesGateway($connection);
                
                $result = $db->innerJoin();
                foreach ($result as $row) {
                    echo "<li class='list-group-item col-md-3 col-sm-3 col-xs-2' style='border: none'>";
                    echo "<a href='single-city.php?id=" . $row['CityCode'] . "'>" . $row['AsciiName']. "</a>";
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