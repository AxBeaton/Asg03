<?php
 if(isset($_GET['image'])) {
     if (isset($_COOKIE['image'])) {
         $imageArray = unserialize($_COOKIE['image']);
         $copy = unserialize($_GET['image']);
         $copy = $copy["id"];
         $search = array_search($copy, array_column($imageArray, "id"));
         if ($search === false) {
         array_push($imageArray, unserialize($_GET['image']));
         setcookie("image", serialize($imageArray), 0);
         }
     }
     else {
        $imageArray = array(unserialize($_GET['image']));
        setcookie("image", serialize($imageArray), 0);
 
     }
}

if(isset($_GET['post'])) {
     if (isset($_COOKIE['post'])) {
         $postArray = unserialize($_COOKIE['post']);
         $copy = unserialize($_GET['post']);
         $copy = $copy["id"];
         $search = array_search($copy, array_column($postArray, "id"));
         if ($search === false) {
         array_push($postArray, unserialize($_GET['post']));
         setcookie("post", serialize($postArray), 0);
         }
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

