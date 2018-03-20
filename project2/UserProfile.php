<?php
include "includes/travel-config.inc.php";
include "includes/header.inc.php";
?>
<?php
require_once 'includes/travel-config.inc.php';
			
			
			?>
<main class="container">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading heading-2">User Profile</div>
            <div class="panel-body">
                <?php
                $db = new UsersLoginGateway($connection);
			    $statement = $db->findByUser($_SESSION['UserID']);
			    foreach($statement as $row){
                echo "<h6>User Name: ".$row['FirstName']." ".$row['LastName']."</h6>
                <h6>User Address: ".$row['Address']."</h6>
                <h6>User City: ".$row['City']."</h6>
                <h6>User Region: ".$row['Region']."</h6>
                <h6>User Country: ".$row['Country']."</h6>
                <h6>User Postal: ".$row['Postal']."</h6>
                <h6>User Phone: ".$row['Phone']."</h6>
                <h6>User Email: ".$row['Email']."</h6>"
                ;}
                ?>
                
            </div>
        </div>
    </div>
</main>
<?php include "includes/footer.inc.php"; ?>
</html>