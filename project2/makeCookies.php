<?php
 if(isset($_GET['image'])) {
     if (isset($_COOKIE['image'])) {
         $imageArray = unserialize($_COOKIE['image']);
         array_push($imageArray, unserialize($_GET['image']));
         setcookie("image", serialize($imageArray), 0);
     }
     else {
        $imageArray = array(unserialize($_GET['image']));
        setcookie("image", serialize($imageArray), 0);
 
     }
}

if(isset($_GET['post'])) {
     if (isset($_COOKIE['post'])) {
         $postArray = unserialize($_COOKIE['post']);
         array_push($postArray, unserialize($_GET['post']));
         setcookie("post", serialize($postArray), 0);
     }
     else {
        $postArray = array(unserialize($_GET['post']));
        setcookie("post", serialize($postArray), 0);
 
     }
}
    $prev = $_SERVER['HTTP_REFERER'];
    if (strstr($prev, "fav")) {
        header("Location: ". $prev);
    }
    else {
        header("Location: ". $_SERVER['HTTP_REFERER']. "&fav=1");
    }
?>

