<?php   
 include 'includes/travel-config.inc.php';
include 'includes/header.inc.php'; 

?>
   <!-- make 2 coloumns for the country, finish favourites, finish cookie functions, fix up country db accesses --->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2 ">Countries with Images</div>
          <div class="panel-body">
            <form action="single-country.php" method="post">
              <div >
                  <ul class="list-group">
                <?php 
                $db = new CountriesGateway($connection);
                
                $result = $db->InnerJoin();
                foreach ($result as $row) {
                    echo "<li class='list-group-item col-md-3 col-sm-3 col-xs-2' style='border: none'>";
                    echo "<a href='single-country.php?id=" . $row['ISO'] . "'>" . $row['CountryName']. "</a>";
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