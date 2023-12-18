<?php
session_start();
require ("includes/common.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planet Shopify | Online Shopping Site for Men</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<!--header -->
 <?php
include 'includes/header_menu.php';
include 'includes/check-if-added.php';
?>
<div class="container" style="margin-top:65px">
         <!--jumbutron start-->
        <div class="jumbotron text-center">
            <h1>Welcome to Planet Shopify!</h1>
            <p>We have wide range of products for you.No need to hunt around,we have all in one place</p>
        </div>
        <!--jumbutron ends-->
        <!--breadcrumb start-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </nav>
        <form action="products.php" class="row text-center form-inline d-flex justify-content-center md-form form-sm mt-0" method="post"> 
             <input type="text" placeholder="Search" aria-label="Search" name="search"class="form-control form-control-sm ml-3 w-75" />
        <input type="submit" class="btn" style="margin-left: 25px;" value="Submit" /> 

        <!--breadcrumb end-->
    <hr/>
    <!--menu list-->
<div class="container"style="margin-top:65px">


<?php
$product_id = $_GET['product_id'];
$query = "SELECT * FROM products WHERE id = $product_id";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $product)
    {
        $category = $product['category'];
        $dir_path = "images/" . $category;
        $files = scandir($dir_path);
        $count = count($files);
        $index = rand(2, ($count - 1));
        $filename = $files[$index];
        $image_url = $dir_path . "/" . $filename;
    ?>
    <div class="row">
    <div class="col-md-6 " style="min-height: 500px; padding-left: 0px;  padding-right: 0px;">
        <img src=<?php echo $image_url; ?>  class="img-responsive card-img-top mb-5 mb-md-0">
    </div>
    
    <div class="col-md-6">
            <div class="small mb-1"><?= $product['category']; ?></div>
                        <h1 class="display-5 fw-bolder"><?= $product['name']; ?></h1>
                        <div class="fs-5 mb-5">
                            <span>$<?= $product['price']; ?></span>
                        </div>
                        <p class="lead"><?= $product['info']; ?></p>
                        <div class="d-flex" style='    justify-content: center;'>
                            <?php if (!isset($_SESSION['email'])) {?>
                            <p>
                                <a href="index.php#login" role="button" class="btn btn-warning  text-white ">Add To Cart</a></p>
                            <?php
                            } else {
                            if (check_if_added_to_cart( $product['id'])) {
                            echo '<p><a href="#" class="btn cart px-auto bg-primary" disabled>Added to cart</a></p>';
                            } else {
                                ?>
                                <p>
                                    <a href="cart-add.php?id=<?= $product['id']; ?>" name="add" value="add" class="btn cart px-auto bg-dark text-white">Add to cart</a>
                                    <p>
                                <?php
                                
                                }
                            }

                            
                            ?>
                            
                        </div>
            </div>
    </div>
</div>
</div>

   <?php }
} 
?>