<?php
session_start();
require ("includes/common.php");

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM products WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $info = mysqli_real_escape_string($con, $_POST['info']);

    $query = "UPDATE products SET name='$name', price='$price', category='$category', info ='$info' WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Product Updated Successfully";
        header("Location: admin-view.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Product Not Updated";
        header("Location: admin-view.php");
        exit(0);
    }

}


if(isset($_POST['save_product']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $info = mysqli_real_escape_string($con, $_POST['info']);


    $query = "INSERT INTO products (name,price,category,info) VALUES ('$name','$price','$category','$info')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: index.php");
        exit(0);
    }
}

// Query the database to load the data for the selected product into a variable
$product_id = $_GET['product_id'];
include('product_page.php');


?>

