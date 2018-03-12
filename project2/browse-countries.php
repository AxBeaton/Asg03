<?php   
 include 'includes/travel-config.inc.php';
include 'includes/header.inc.php'; 

?>
   
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Countries with Images</div>
          <div class="panel-body">
            <form action="single-country.php" method="post">
              <div >
                  <ul class="list-group">
                <?php 
                $db = new CountriesGateway($connection);
                
                function findByImageDetails($table) { //edit name and parameter names later
                    $sql = $this->getSelectStatement() . ' INNER JOIN  ' . $this->$table . ' on Countries.' . $this->getPrimaryKeyName();
                }
                $result = $db->findByImageDetails("ImageDetails");
                foreach ($result as $row) {
                    echo "<li class='list-group-item col-md-3 col-sm-3 col-xs-2' style='border: none'>";
                    echo "<a href='single-country.php?id=" . $row['ISO'] . "'>" . $row['CountryName']. "</a>";
                }
                
               // try{
                   //  $sql = "select * from Countries inner join ImageDetails on Countries.ISO = ImageDetails.CountryCodeISO group by CountryName order by CountryName";
                //  $result = retriveResult($sql);
                ///  while ($row = $result->fetch()) {
               //       $iso=$row['ISO'];
               //  /     $name=$row['CountryName'];
               //       echo "<li class='list-group-item col-md-3 col-sm-3 col-xs-2' style='border: none'>";
               //       echo "<a href='single-country.php?id=$iso'>$name</a>";
                //      echo "</li>";
                 // }
              //  }
             //   catch (PDOException $e) {
             //     die( $e->getMessage() );
             //     }
               ?>
               </ul>
             </div>
        </form>

      </div>
    </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>