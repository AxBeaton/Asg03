<?php
 require_once('includes/travel-config.inc.php'); 
              
function returnFormatted($data){
    if(is_numeric($data))
    {
        $data=number_format($data);
    }
    return '<b>' . $data . '</b>';
} 

$db = new CountriesGateway($connection);
$result = $db->findById($_GET['id']);

 include 'includes/header.inc.php';
 

 ?>
    
<div class="container">
    <div class="jumbotron">
          <h2><?php echo $result['CountryName']; ?></php></h2>
          <div ><p>Capital: <b><?php echo returnFormatted($result['Capital']); ?> </b></p>
          <p>Area: <b><?php echo returnFormatted($result['Area']);?> sq km.</p>
          <p>Population: <?php echo returnFormatted($result['Population']); ?></p>
          <p>Currency Name: <?php echo returnFormatted($result['CurrencyName']); ?></p>
          <p><?php echo $result['CountryDescription']; ?></p>
          </div>
    </div>    
</div>
    
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images From <?php echo $result['CountryName']; ?></div>
          <div class="panel-body">
            <!--<form action="single-country.php" method="post"> --->
             <ui class='caption-style-2'> <!-- temp attempt to get images to work. Not too sure where displayImgList is --->
                 <?php 
                    $db = new ImageDetailsGateway($connection);
                    $result = $db->getByCountryISO($_GET['id']);
                    foreach ($result as $row) {
                        echo "<li class='col-md-1'>";
                        echo "<a href='single-image.php?id=".$row['ImageID']. "&userid=" .$row['UserID']. "'><img src='images/square-small/" .$row['Path']. "'></a>";
                        echo "</li>";        
                    }
                    ?>
             </ui>   
                
                <?php
                
                //$link="CountryCodeISO";
              //displayImgList($link)
              ?>
            <!--</form> --->
          </div>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>