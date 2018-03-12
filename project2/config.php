<?php
define('DBHOST', '');
define('DBNAME', 'travel');
define('DBUSER', 'testuser');
define('DBPASS', 'mypassword');
define('DBCONNSTRING','mysql:dbname=travel;charset=utf8mb4;');

function displayImgList($variableType){
    echo "<ul class='caption-style-2'>";
    try {
         $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $varTitle=$_GET['id'];
            
            if(isset($varTitle) && $varTitle != ""){
            $sql = "select * from ImageDetails where $variableType = '$varTitle'";
            $result = $pdo->query($sql);
            while($row = $result->fetch()){
               $path=$row['Path'];
               $img=$row['ImageID'];
                    echo "<li class='imgList'> <a href='single-image.php?id=$img' class='img-responsive'>
                          <img src='images/square-small/$path' alt='$varTitle'>
                  </a>
			  </li> ";
                
           }
            }
           else{
               echo "<meta http-equiv='refresh' content='0;URL=error.php' />";
           }
    }
catch(PDOException $e) {
                  die( $e->getMessage() );
                  }
echo "</ul>";
}

function retriveResult($sql){
    try{
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $result = $pdo->query($sql);
         return $result;
    }
    catch(PDOException $e) {
                  die( $e->getMessage() );
                  }
}
?>

