<?php include 'includes/header.inc.php'; ?>
    
    <main class="container ">
        <div class="jumbotron" style="background-color: white;">
          <h2>Orders</h2>
          <table id="ordersTable" class="projTables">
          <tr><td></td><td>Size</td><td>Paper</td><td>Frame</td><td>Quantity</td></tr>
          <?php
          $orderArray = $_SERVER['QUERY_STRING'];
          parse_str($orderArray, $orders);
          //wil;l be 5
          $imageArray = unserialize($_COOKIE['image']);
          if($imageArray){
          for($i = 0; $i< sizeof($imageArray); $i++) {
          echo "<tr><td><img src='images/square-small/" .$imageArray[$i]["image"]. "'></img></td>";
          echo "<td><p id='orderSize".$i."' title=".$orders['size'.$i]."></p></td><td><p id='orderPaper".$i."' title=".$orders['paper'.$i]."></p></td>
          <td><p id='orderFrame".$i."' title=".$orders['frame'.$i]."></p></td><td>".$orders['quantity'.$i]."</td></tr>";
          }
         
              
          }
           echo "<tr><td></td><td></td><td></td><td></td><td><p id='shipping' title=".$orders['ship']."></p></td></tr>";
         
          ?>
          
          </table>
        </div>     
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</html>