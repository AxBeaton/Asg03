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
                    <button id="myButton" data-toggle="modal" data-target="#myModal" type="button" class="btn btm-primary" >Print Favourites</button>
                    <!-- Modal -->
                    

                </ul>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.inc.php"; ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Print Favourites</h5>
      </div>
      <div class="modal-body" >
          <table id="printTable" class="projTables" style="height:450px !important;">
              <form id="tableForm" action="order.php" method="get" name="modalForm">
              <tr><td></td><td>Size</td><td>Paper</td><td>Frame</td><td>Quantity</td><td>Total</td></tr>
          <?php 
          if (isset($_COOKIE['image'])) {
                        $imageArray = unserialize($_COOKIE['image']);
          for($i = 0; $i< sizeof($imageArray); $i++) {
            echo "
            <div id='selectList'>
          <tr><td id='imageColumn" .$i. "'><img src='images/square-small/" .$imageArray[$i]["image"]. "'></img></td><td id='sizeColumn".$i."'><select name='size".$i."' id='sizeSelect".$i."' class='selectSize'></td>
          <td id='paperColumn".$i."'><select name='paper".$i."' id='paperSelect".$i."' class='selectPaper'></td><td id='frameColumn".$i."'><select name='frame".$i."' id='frameSelect".$i."' class='selectFrame'></td>
          <td id='quantityColumn".$i."'><input id='quantity".$i."' type='text' name='quantity".$i."' size='4'></td><td id='totalColumn".$i."'></td>
         </div>
         ";  
          }
          }
          else{}
           echo "<tr><td></td><td></td><td><input id='standardShip' type='radio' name='ship' checked><p id='shipNameBasic'></p></td>
           <td><input id='expressShip' type='radio' name='ship'><p id='shipName'></p></td><td style='font-style:italic;'>Subtotal:</td><td id='subTotal'></td></tr>";
           echo "<tr><td></td><td></td><td></td><td></td><td style='font-style:italic;'>Shipping:</td><td id='shippingCost'></td></tr><br>";
           echo "<tr><td></td><td></td><td></td><td></td><td style='font-style:italic;'>Grand Total:</td><td id='grandTotal'></td></tr>";
         echo "<tr><td></td><td></td><td></td><td></td><td></td><td id ='submitCell'><input type='submit' value='Order'></td></tr>";
          ?> 
          </form>
          </table>
      </div>
      
    </div>
  </div>
</div
</html>