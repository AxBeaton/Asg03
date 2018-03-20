<?php

if (isset($_GET['postId'])) {
    $postArray = unserialize($_COOKIE['post']);
    unset($postArray[$_GET['postId']]);
    // issue: the indexs do not update after unset. 
    $postArray = array_values($postArray);
    if (empty($postArray)) {
        unset($_COOKIE['post']);
        setcookie("post", "", time() - 3600);
    }
    else {
    setcookie("post", serialize($postArray), 0);
    }
        
}

elseif (isset($_GET['imageId'])) {
    $imageArray = unserialize($_COOKIE['image']);
    unset($imageArray[$_GET['imageId']]);
    $imageArray = array_values($imageArray);
    if (empty($imageArray)) {
        unset($_COOKIE['image']);
        setcookie("image", "", time() - 3600);
    }
    else {
    setcookie("image", serialize($imageArray), 0);
    }
}

elseif (isset($_GET['postAll'])) { 
    unset($_COOKIE['post']);
    setcookie("post", "", time() - 3600);
    
}

elseif (isset($_GET['imageAll'])) { 
    unset($_COOKIE['image']);
    setcookie("image", "", time() - 3600);
    
}

else {
    unset($_COOKIE['image']);
    unset($_COOKIE["post"]);
    
    setcookie('image', "" , time() - 3600);
    setcookie('post', "" , time() - 3600);
    
}
header("Location: ". $_SERVER['HTTP_REFERER']);
?>