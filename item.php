<?php
require 'php/connection.php';

$id = "";
$name = "Product Not Found";
$price = "Unknown";
$description = "Description Not Found";
$category = "";
$tagSpecific = "";

if (isset($_GET['productID'])) {
    $query   = "SELECT * FROM product WHERE id = "+productID+";";
    $results = db2_exec($_SESSION['connection'], $query);
    //only one entry
    while ($row = db2_fetch_object($results)) {
        $id = $row->productID;
        $name = $row->name;
        $price = $row ->price;
        $description = $row->description;
        $category = $row->category;
        $tagSpecific = $row->tagSpecific;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$name?> - Ticon</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand lead2" href="index.html"> T </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="service.html">Services</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="login.html">Login/SignUp</a>
                    </li>
                    <li>
                        <a href="cart.html">
                            <img src="http://findicons.com/files/icons/1700/2d/512/cart.png" alt="cartImage" style="width:20px; height=20px;">
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p class="lead">Ticon</p>
                <div id="SideBar">
                    <div class="list-group panel">
                        <a href="#mens" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#SideBar">Mens</a>
                        <div class="collapse" id="mens">
                            <a href="" class="list-group-item">Pants</a>
                            <a href="" class="list-group-item">Shirts</a>
                            <a href="" class="list-group-item">Shoes</a>
                        </div>
                        <a href="#womens" class="list-group-item list-group-item-info" data-toggle="collapse" data-parent="#SideBar">Womens</a>
                        <div class="collapse" id="womens">
                            <a href="" class="list-group-item">Shirts</a>
                            <a href="" class="list-group-item">Pants</a>
                            <a href="" class="list-group-item">Dresses</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--col-->
            <div class="col-md-9">
                <div class="thumbnail">
                    <img class="img-responsive" src="clothing pics/<?=$productID?>.jpg" alt="">
                    <div class="caption-full">
                        <h4 class="pull-right"><?=$price?></h4>
                        <h4><a href="#"><?=$name?></a></h4>
                        <p><?=$description?></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Ticon 2015</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
