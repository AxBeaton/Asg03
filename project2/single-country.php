<?php
 require_once('config.php'); 
 try{
         $id=$_GET['id'];
          $sql = "select * from Countries where ISO = '$id'";
          $result = retriveResult($sql);
          $row = $result->fetch(); 
              $name=$row['CountryName'];
              $capital=$row['Capital'];
              $curr=$row['CurrencyName'];
              $area=$row['Area'];
              $pop=$row['Population'];
              $desc=$row['CountryDescription'];
 }
          catch (PDOException $e) {
              die( $e->getMessage() );
              }
              
function returnFormatted($data){
    if(is_numeric($data))
    {
        $data=number_format($data);
    }
    return '<b>' . $data . '</b>';
}

 include 'includes/header.inc.php';
 ?>
    
<div class="container">
    <div class="jumbotron">
          <h2><?php echo $name; ?></php></h2>
          <div ><p>Capital: <?php echo returnFormatted($capital); ?></p>
          <p>Area: <?php echo returnFormatted($area);?> sq km.</p>
          <p>Population: <?php echo returnFormatted($pop); ?></p>
          <p>Currency Name: <?php echo returnFormatted($curr); ?></p>
          <p><?php echo $desc; ?></p>
          </div>
    </div>    
</div>
    
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading heading-2">Images From <?php echo $name; ?></div>
          <div class="panel-body">
            <form action="single-country.php" method="post">
                <?php
                $link="CountryCodeISO";
              displayImgList($link)
              ?>
            </form>
          </div>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>