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
                        <a href="cart-add.php?id=<?= $product['id']; ?>" name="add" value="add" class="btn cart px-auto">Add to cart</a>
                        <p>
                    <?php
                    
                    }
                }
                ?>
            </div>
        </div>