<?php   
 include 'includes/travel-config.inc.php';
include 'includes/header.inc.php'; 
$UserID;

?>
   <?php

function	validLogin($connection){
    
			$db = new UsersLoginGateway($connection);
			$statement=$db->findById($_POST['username']);
			$UserID=$statement['UserID'];
            //$result = $db->findByUser($UserID);
            $password=$_POST['username'].$statement['Salt'];
            $password=md5($password);
			if($_POST['username']==$statement['UserName']&&$password=$statement['Password']){
			    $_SESSION['UserID']=$UserID;
					return	true;
			}
			return	false;
            }


function getLoginForm(){
   return "<form action='' method='post' role='form'>
<div class ='form-group'>
  <label for='username'>Username</label>
  <input type='text' name='username' class='form-control'/>
</div>
<div class ='form-group'>
  <label for='pword'>Password</label>
  <input type='password' name='pword' class='form-control'/>
</div>
<div class='loginB'>
<input type='submit' value='Login' class='form-control btn btn-primary loginbutton' />
</div>
</form>";
}
?>
 <div class="container theme-showcase" role="main">  
      <div class="jumbotron">
        <h2>
<?php
   if	($_SERVER["REQUEST_METHOD"]	==	"POST")	{
	if(validLogin($connection)){
			$_SESSION['Username']=$_POST['username'];
			
		}
		else{
		    echo "Login	unsuccessful-";
		}
}
if(isset($_SESSION['Username'])){
	echo "Welcome ".$_SESSION['Username'];
}
else{
    echo "Please Enter Login Information";
}
?>

</h2>
      </div>
<?php 
if (!isset($_SESSION['Username'])){
 echo getLoginForm();
}
else{
   echo '<meta http-equiv="refresh" content="0;url=UserProfile.php">';
    echo "<a href=logout.php>Logout</a>";
}
?>
 </div>
</body>
   
    <?php include 'includes/footer.inc.php'; ?>
</html>