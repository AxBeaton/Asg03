<?php
 include 'includes/travel-config.inc.php';
 include 'includes/header.inc.php'; 
 
 if(isset($_GET['continent']) && ($_GET['continent'] != "0")){
     $pageVar="[Continent=".$_GET['continent']."]";
 }
 else if(isset($_GET['country']) && ($_GET['country'] != "0")){
     $pageVar="[Country=".$_GET['country']."]";
 }
 else if(isset($_GET['title']) && ($_GET['title'] != "")){
     $pageVar="[Title=".$_GET['title']."]";
 }
 else $pageVar="[All]";
 ?>
    
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
              <div class="button-container">
                  
            <form action="browse-images.php" method="get" class="form-horizontal">
             <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php 
                $db = new ContinentsGateway($connection);
                $result = $db -> findAllSorted();
                  foreach ($result as $row) {         
                   echo '<option value="' . $row['ContinentCode'] . '"'. $row['ContinentName'];
                   if (isset($_GET['continent']) && $row['ContinentName'] == $_GET['continent']) 
                      echo ' selected ';
                      echo '>';
                      echo $row['ContinentName'];
                      echo '</option>';
             }
                  ?>
              </select>     
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                echo "hello";
                     $db = new CountriesGateway($connection);
                     
                $result = $db -> innerJoin();

                  foreach ($result as $row)  {
                    
                   echo '<option value="' . $row['ISO'] . '"';
                   if (isset($_GET['country']) && $row['CountryName'] == $_GET['country']) 
                      echo ' selected ';
                      echo '>';
                      echo $row['CountryName'];
                      echo '</option>';
                  }
                  ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <div>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
           </div>
            </form>
            <form action="browse-images.php" method="post">
                    <div>
                        <button type="submit" class="btn btn-me">Clear</button>
                    </div>
            </form>
            </div>
          </div>
        </div>     
        
        <div class="panel panel-default">
          <div class="panel-heading">Images <?php echo $pageVar;?></div>
          <div class="panel-body">
		<ul class="caption-style-2">
            <?php 

            
            $varTitle=$_GET['title'];
            if(!isset($varTitle) || $varTitle == "")
            {
            
            $db = new ImageDetailsGateway($connection);
            $result = $db -> findAll();
            foreach ($result as $row) {
             $img=$row['ImageID'];
             $path=$row['Path'];
             $title=$row['Title'];
             $code=$row['CountryCodeISO'];
             $contCode=$row['ContinentCode'];
             $var= $_GET['country'];
             $varCont= $_GET['continent'];
             
             if ((!isset($var)&&(!isset($varCont)))||($var=='0' && $varCont=='0') || $var == $code|| $varCont == $contCode){
			        echo "<li> <a href='single-image.php?id=$img' class='img-responsive'>
                          <img src='images/square-medium/$path' alt='$title'>
                          <div class='caption'>
                              <div class='blur'></div>
                              <div class='caption-text'>
                                  <p>$title</p>
                              </div>
                          </div>
                  </a>
			  </li> ";}
           }
            }
            else {
            $result = $db -> whereClause();
            foreach ($result as $row) {
             $img=$row['ImageID'];
             $path=$row['Path'];
             $title=$row['Title'];
             $code=$row['CountryCodeISO'];
             $contCode=$row['ContinentCode'];
             
             
			        echo "<li> <a href='single-image.php?id=$img' class='img-responsive'>
                          <img src='images/square-medium/$path' alt='$title'>
                          <div class='caption'>
                              <div class='blur'></div>
                              <div class='caption-text'>
                                  <p>$title</p>
                              </div>
                          </div>
                  </a>
			  </li> ";
            }
            }
           ?>
       </ul>    
       </div></div></div>

      
    </main>
    
<?php include 'includes/footer.inc.php'; ?>
</html>