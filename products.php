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
<!--header ends -->
<div class="container" style="margin-top:10px">
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
        <form action="products.php" class="row text-center" method="post"> 
<div class="container mt-5">

<div class="row d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card p-3  py-4">
            <h5>An Easier way to find your Dream Products</h5>
            <div class="row g-3 mt-2">
                <div class="col-md-3">
                <?php 
                    $sql = "SELECT DISTINCT category FROM products";
                    $result = mysqli_query($con, $sql);
                    echo "<select name='category' class='btn btn-secondary dropdown-toggle'  >";
                    echo "<option value='' class='dropdown-item'>All Categories</option>";
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='"  . $row["category"] . " 'class='dropdown-item'>" . $row["category"] . "</option>";
                    }
                    }
                    echo "</select>";
                ?>
                </div>
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Enter products name...">
                </div>
                <div class="col-md-3">
                    <input type="submit" class="btn btn-secondary btn-block" value="Search" /> 
                </div>
            </div>
            <div class="mt-3">
<a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="advanced">
Advance Search With Filters <i class="fa fa-angle-down"></i>
</a>


<div class="collapse" id="collapseExample">
<div class="card card-body">

<div class="row">

<div class="col-md-6">
    <span>Price-Max
    <input type="number" placeholder="Price-Max" name="price_max" value="50000" class="form-control">
    
</div>


<div class="col-md-6"><span>Price-Min
    <input type="number" placeholder="Price-Min" name="price_min" value="1" class="form-control">
</div>
</div>
</div>
</div>
            </div>
        </div>  
    </div>
 </div>





</div>
        <!--breadcrumb end-->
    <hr/>
    <!--menu list-->
    <div class="container">
    <div class="row text-center" >

    <?php        
        if(isset($_POST['search']) && isset($_POST['category']) && isset($_POST['price_min']) && isset($_POST['price_max'])){
            $search = $_POST['search'];
            $category = $_POST['category'];
            $price_min = $_POST['price_min'];
            $price_max = $_POST['price_max'];
            if ($category == "") {
                $query = "SELECT * FROM products WHERE name LIKE '%{$search}%' AND price BETWEEN {$price_min} AND {$price_max}";
            } else {
                $query = "SELECT * FROM products WHERE name LIKE '%{$search}%' AND category = '{$category}' AND price BETWEEN {$price_min} AND {$price_max}";
            }
        } else if(isset($_POST['search']) && isset($_POST['price_min']) && isset($_POST['price_max'])){
            $search = $_POST['search'];
            $price_min = $_POST['price_min'];
            $price_max = $_POST['price_max'];
            $query = "SELECT * FROM products WHERE name LIKE '%{$search}%' AND price BETWEEN {$price_min} AND {$price_max}";
        } else if(isset($_POST['search']) && isset($_POST['category'])){
            $search = $_POST['search'];
            $category = $_POST['category'];
            if ($category == "") {
                $query = "SELECT * FROM products WHERE name LIKE '%{$search}%'";
            } else {
                $query = "SELECT * FROM products WHERE name LIKE '%{$search}%' AND category = '{$category}'";
            }
        } else if(isset($_POST['search'])){
            $search = $_POST['search'];
            $query = "SELECT * FROM products WHERE name LIKE '%{$search}%' ";
        }
        else
        $query = "SELECT * FROM products";
        $query_run = mysqli_query($con, $query);
        $imagesDir = './images';
        $images = glob($imagesDir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
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
    <div class="col-md-3 col-6 py-2">
        <div class="card">
            <img src= <?php echo $image_url; ?> alt="" class="img-fluid pb-1 card-img-top" style="height: 200px;">
            
            <div class="figure-caption">
                <h6>
                <a href="product_page.php?product_id=<?= $product['id']; ?>">
                        <?= $product['name']; ?>
                </a>
                    
                </h6>
                <h6>Price :<?= $product['price']; ?></h6>

                <?php if (!isset($_SESSION['email'])) {?>
                <p>
                    <a href="index.php#login" role="button" class="btn btn-warning  text-white ">Add To Cart</a></p>
                <?php
                } else {
                if (check_if_added_to_cart( $product['id'])) {
                echo '<p><a href="#" class="btn btn-warning  text-white" disabled>Added to cart</a></p>';
                } else {
                    ?>
                    <p>
                        <a href="cart-add.php?id=<?= $product['id']; ?>" name="add" value="add" class="btn btn-info btn-sm">Add to cart</a>
                        <p>
                    <?php
                    
                    }
                }
                ?>
            </div>
        </div>
    </div>
    
                    <?php
                }
            }
            else
            {
                echo "<h5> No Record Found </h5>";
            }
        ?>
        </div>
    </div>
      <!--menu list ends-->
      <!-- footer-->
        <?php include 'includes/footer.php'?>
      <!--footer ends-->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script>
<?php if (isset($_GET['error'])) {$z = $_GET['error'];
    echo "<script type='text/javascript'>
$(document).ready(function(){
$('#signup').modal('show');
});
</script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";}?>
<?php if (isset($_GET['errorl'])) {$z = $_GET['errorl'];
    echo "<script type='text/javascript'>
$(document).ready(function(){
$('#login').modal('show');
});
</script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";}?>
</html>
