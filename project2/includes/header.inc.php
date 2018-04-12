<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Assign 3 (Winter 2018)</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='//fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/custom.css" />
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />
    <link rel="stylesheet" href="css/theme.css" />
    
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>  
    <script src="js/script.js"></script>
    
    
<style>
    .topHeaderRow{
        background-color: #4484CE;
    }
    
    .navbar{
        background-color: white;
    border: none;
    }
    
    .topHeaderRow a:link{
        color: #DF744A !important;
    }
    
   
    
    .navbar-header a {
        color: black !important;
        font-family: 'Libre Baskerville', serif !important;
        font-size: 40px;

    }
    .nav a {
        color: black !important;
    }
    
    .nav a:hover {
        color: #984B43 !important;
    }
    
    .dropdown a{
       
    background-color: white !important;
    
    }
    
    .modal-backdrop {
  z-index: -1;
}

    
</style>
</head>

<body>
<header>
        <div class="topHeaderRow">
            <div class="container">
                <div class="pull-right">
                    <ul class="list-inline">
                        <?php if(isset($_SESSION['Username'])){
	echo "<li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
	echo "<li><a href='UserProfile.php'><span class='glyphicon glyphicon-user'></span> Profile</a></li>";
}
else{
    echo "<li><a href='login.php'><span class='glyphicon glyphicon-log-out'></span> Login</a></li>";
}
                        echo "<li><a href='Favourites.php'><span class='glyphicon glyphicon-star'></span> Favorites</a></li>";?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end topHeaderRow -->


        <nav class="navbar navbar-default ">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Share Your Travels</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about-me.php">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="browse-countries.php">Countries</a></li>
                                <li><a href="browse-images.php">Images</a></li>
                                <li><a href="browse-users.php">Users</a></li>
                                <li><a href="browse-posts.php">Posts</a></li>
                                <li><a href="browse-cities.php">Cities</a></li>
                            </ul>
                        </li>
                    </ul>


                    <form class="navbar-form navbar-right" action="browse-images.php" method="get" >
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" name="title">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </nav>
    </header>