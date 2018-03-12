  <?php
 require_once('config.php'); 
 include 'includes/header.inc.php'; 
 ?>
  <main class="container">
        <div class="row">
                        <aside class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Continents</div>
                    <ul class="list-group">
                        <?php
                        try{
                  $sql = "select * from Continents";
                  $result = retriveResult($sql);
                  while ($row = $result->fetch()) {
                      
                      $name=$row['ContinentName'];
                      $contId=$row['ContinentCode'];
                      if(isset($contId)&&$contId != "");
                      echo "<li class='list-group-item'>";
                      echo "<a href='browse-images.php?continent=$contId'>$name</a>";
                      echo "</li>";
                  }
                        }
                        catch(PDOException $e) {
                  die( $e->getMessage() );
                  }
                        ?>
                    </ul>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">Popular</div>
                    <ul class="list-group">
                       <?php
                       try{
                          $sql = "select * from Countries inner join ImageDetails on Countries.ISO = ImageDetails.CountryCodeISO group by CountryName order by CountryName";
                          $result = retriveResult($sql);
                          while ($row = $result->fetch()) {
                              
                              $name=$row['CountryName'];
                              $countId=$row['CountryCodeISO'];
                              if(isset($countId)&&$countId != "");
                              echo "<li class='list-group-item'>";
                              echo "<a href='browse-images.php?country=$countId'>$name</a>";
                              echo "</li>";
                          }
                       }
                       catch(PDOException $e) {
                  die( $e->getMessage() );
                  }
                        ?>
                    </ul>
                </div>
            </aside>
            <div class="col-md-10">
                <div class="row">
                    <?php
                    	$id=$_GET['id'];
                    	$sql="select * from Users u join ImageDetails i on u.UserID = i.UserID join Countries c on c.ISO = i.CountryCodeISO join Cities cs on cs.CityCode = i.CityCode where ImageID = '$id'";
                    	$result=retriveResult($sql);
                    	$row=$result->fetch();
                    	$path=$row['Path'];
                    	$name=$row['FirstName'].' '.$row['LastName'];;
                    	$country=$row['CountryName'];
                    	$city=$row['AsciiName'];
                    	$desc=$row['Description'];
                    	$imgName=$row['Title'];
                    	$userId=$row['UserID'];
                    	$countryID=$row['CountryCodeISO'];
                    	echo "<div class='col-md-8'>
                        <img class='img-responsive' src='images/medium/$path' alt='$title'>
                        <p class='description'>$desc</p>
                    </div>
                    <div class='col-md-4'>                                                
                        <h2>$imgName</h2>
                        <div class='panel panel-default'>
                            <div class='panel-body'>
                                <ul class='details-list'>
                                    <li>By: <a href='single-user.php?id=$userId'>$name</a></li>
                                    <li>Country: <a href='browse-images.php?country=$countryID'>$country</a></li>
                                    <li>City: $city</li>
                                </ul>
                            </div>
                        </div>
                        <div class='btn-group btn-group-justified' role='group' aria-label='responses'>
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-default'><span class='glyphicon glyphicon-heart' aria-hidden='true'></span></button>
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
                    </div>";
                    ?>
                </div> 
            </div> 
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>