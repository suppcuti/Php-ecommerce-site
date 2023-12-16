

<?php
require ("includes/common.php");
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student CRUD</title>
</head>
<body>
    <div class="container mt-4">


        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>History 
                        <a href="index.php" style="margin-left: 50px;" class="btn btn-danger float-end">BACK</a>
                        </h4>
                        </h4>
                        
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Item Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                    $query = "SELECT * FROM users_products  ";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['id']; ?></td>
                                                <td>
                                                    <?php $id = $student['user_id'];
                                                    $query = "SELECT * FROM users WHERE id = '$id' ";
                                                    $query_run = mysqli_query($con, $query);
                                                    foreach($query_run as $user)
                                                    {
                                                        echo $user['first_name'];
                                                        echo " ";
                                                        echo $user['last_name'];
                                                        
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php $id = $student['item_id'];
                                                    $query = "SELECT * FROM products WHERE id = '$id' ";
                                                    $query_run = mysqli_query($con, $query);
                                                    foreach($query_run as $product)
                                                    {
                                                        echo $product['price'];  
                                                        if ($student['status'] == 'Confirmed'){
                                                            $total =  $total + $product['price']; 
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $student['status']; ?></td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                                    <div class='row'>
                                        <p class="flex-end">Total : <?php echo $total?></p>
                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


