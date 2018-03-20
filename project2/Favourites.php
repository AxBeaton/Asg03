<?php
include "includes/travel-config.inc.php";
include "includes/header.inc.php";
?>
<main class="container">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading heading-2">Favourite Posts</div>
            <div class="panel-body">
                <!-- loop?,cookie serialization, for cookies array??, loop through array and paste 
                    a small square img and post/image title --->
                <ul class='caption-style-2'>
                    <?php 
                    if (isset($_COOKIE['post'])) {
                        $postArray = unserialize($_COOKIE['post']);
                        for($i = 0; $i< sizeof($postArray); $i++) {
                            echo "<div class='row'>";
                            echo "<li class='col-md-12'><a href='single-post.php?id=" .$postArray[$i]['id']. "'><img src='images/square-small/" .$postArray[$i]["image"]. "'></a>";
                            echo $postArray[$i]['title'];
                            echo "<br><a href='removeCookies.php?postId=" .$i. "' >Remove Item</a>";
                            echo "</li>";
                            echo "</div>";
                        }
                    
                    echo "<li class='removeAll'>";
                        echo "<a href='removeCookies.php'>Remove all favourites</a>";
                        echo "<br>";
                        echo "<a href='removeCookies.php?postAll=y'>Remove all post favourites</a>";
                    echo "</li>";
                    }
                    ?>
                </ul>
                    
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading heading-2">Favourite Images</div>
            <div class="panel-body">
                <ul class='caption-style-2'>
                    <?php 
                    if (isset($_COOKIE['image'])) {
                        $imageArray = unserialize($_COOKIE['image']);
                      for($i = 0; $i< sizeof($imageArray); $i++) {
                          echo "<div class='row'>";
                          echo "<li class='col-md-12'><a href='single-image.php?id=" .$imageArray[$i]["id"]. "'><img src='images/square-small/" .$imageArray[$i]["image"]. "'></a>";
                          echo $imageArray[$i]['title'];
                          echo "<br><a href='removeCookies.php?imageId=" .$i. "'>Remove Item</a>";
                          echo "</li>";
                          echo "</div>";
                       }
                    
                    echo "<li class='removeAll'>";
                        echo "<a href='removeCookies.php?imageAll=y'>Remove all image favourites</a>";
                    echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.inc.php"; ?>
</html>