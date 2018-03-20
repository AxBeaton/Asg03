  <?php
  if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: error.php");
}
 include 'includes/travel-config.inc.php';
 include 'includes/header.inc.php'; 
 $db= new ContinentsGateway($connection);
  $db2 = new CountriesGateway($connection); 
  $db3 = new UsersGateway($connection);
  $db4 = new ImageDetailsGateway($connection);
  $star = $db4->getByRatings($_GET['id']);
  
  
   function generateStars($starNum) {
            $noStar = 5 - $starNum;
            for ($i = 1; $i <= $starNum; $i++) {
                
                echo "<img src='images/misc/star-gold.svg' width='16' />";
                
            }
            for ($x = 0; $x < $noStar; $x++) {
                    echo "<img src='images/misc/star-white.svg' width='16' />";
                }
        }
 ?>
  <main class="container">
     <script	type="text/javascript"	language="javascript">
       function favourite() {
            var node = document.getElementsByClassName("hidden");
            node.classList.remove("hidden");
        }
     </script>
        <div class="row">
                        <aside class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Continents</div>
                    <ul class="list-group">
                        <?php
                       
                 
                  $result = $db -> findAllSorted('DESC');
                  foreach ($result as $row) {
                      
                      $name=$row['ContinentName'];
                      $contId=$row['ContinentCode'];
                      if(isset($contId)&&$contId != "");
                      echo "<li class='list-group-item'>";
                      echo "<a href='browse-images.php?continent=$contId'>$name</a>";
                      echo "</li>";
                  }
                       
                        ?>
                    </ul>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">Popular</div>
                    <ul class="list-group">
                       <?php
                     $result=$db2 -> innerJoin();
                          foreach($result as $row) {
                              
                              $name=$row['CountryName'];
                              $countId=$row['ISO'];
                              if(isset($countId)&&$countId != "");
                              echo "<li class='list-group-item'>";
                              echo "<a href='browse-images.php?country=$countId'>$name</a>";
                              echo "</li>";
                          }
                      
                        ?>
                    </ul>
                </div>
            </aside>
            <div class="col-md-10">
                <div class="row">
                    <?php
                    $result=$db3 -> join($_GET['id']);
                    foreach( $result as $row){
                    	$path=$row['Path'];
                    	$name=$row['FirstName'].' '.$row['LastName'];;
                    	$country=$row['CountryName'];
                    	$city=$row['AsciiName'];
                    	$desc=$row['Description'];
                    	$imgName=$row['Title'];
                    	$userId=$row['UserID'];
                    	$cityID=$row['CityCode'];
                    	$countryID=$row['CountryCodeISO'];
                    	$imageArray = array("title"=> $imgName, "image"=>$path, "id"=>$_GET['id']);
                    	$imageArray = serialize($imageArray); }?>
                    	<div class='col-md-8'>
                        <img class='img-responsive' src='images/medium/<?php echo $path?>' alt='<?php echo $imgName?>'>
                        <p class='description'><?php echo $desc;?></p>
                    </div>
                    <div class='col-md-4'>                                                
                        <h2><?php echo $imgName?></h2>
                        <div class='panel panel-default'>
                            <div class='panel-body'>
                                <ul class='details-list'>
                                    <li>By: <a href='single-user.php?id=<?php echo $userId;?>'><?php echo $name ?> </a></li>
                                    <li>Country: <a href='browse-images.php?country=<?php echo $countryID?>'><?php echo $country?></a></li>
                                    <li>City: <a href='single-city.php?id=<?php echo $cityID?>'><?php echo $city?></a></li>
                                    <li>Rating: <?php generateStars($star[0]['RatingSum'])?> </li> 
                                </ul>
                            </div>
                            <div class="hidden">test<?php if(isset($_GET['fav'])): ?> <script>alert('Added To Favourites!')</script> <?php endif; ?></div>
                        </div>
                        <div class='btn-group btn-group-justified' role='group' aria-label='responses'>
                            <div class='btn-group' role='group'>
                                <?php echo "<a href='makeCookies.php?image=" .$imageArray. "'><button type='button' class='btn btn-default'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span></button></a>"?>
                            </div>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-save' aria-hidden='true'></span></button>
                            </div>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-print' aria-hidden='true'></span></button>
                            </div>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span></button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
               <div id='map'></div>
                <script>
      function initMap() {
var lat =<?php 
$result= $db4 -> getPosition($_GET['id']);
foreach($result as $row){
    echo $row['Latitude'];
}
?>;

var lng =<?php 
$result= $db4 -> getPosition($_GET['id']);
foreach($result as $row){
    echo $row['Longitude'];
}
?>;
        var uluru = {lat, lng};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMSmOGAYhHgPfW-wdXjMLyjoVmwFSMMKA&callback=initMap">
    </script>
            </div> 
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>
