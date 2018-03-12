<?php

include 'includes/travel-config.inc.php';

?>

<html>
<body>

<?php

 $db = new UsersGateway($connection );
 $result = $db->findById(11);
 echo '<h3>Sample User (id=11)</h3>';
 echo $result['UserID'] . ' ' . $result['FirstName'] . ' ' .
 $result['LastName'] . ' ' . $result['Country'];

 $result = $db->findAllSorted("hello");
 echo '<h3>All Users</h3>';
 foreach ($result as $row) {
 echo $row['UserID'] . ' ' . $row['LastName'] . '<br> ';
 } 
?>
</body>
</html>