<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'EditProduct.php';
session_start();
if(isset($_SESSION['token'])){
    if(isset($_GET['token'])){
        if($_SESSION['token'] == $_GET['token']){
            if(isset($_GET['pid'])){
                $p_id = stripcslashes($_GET['pid']);
               $edit = new EditProduct();
               $edit->setProductID($p_id);
               $res = $edit->editProduct();

               ?>
                <div class="e-product">
                    <form action="insert_product.php" method="post">
                        <label for="product-id">
                            <input type="text" name="product_id" value="<?php echo $res['id'] ?>" hidden>
                        </label>
                        <label for="name">
                            Product Name
                            <input type="text" name="name" value="<?php echo $res['name'] ?>"
                        </label>
                        <label for="description">
                            Product Description
                            <input type="text" name="description" value="<?php echo $res['description'] ?>"
                        </label>
                        <label for="location">
                            Image URL
                            <input type="text" name="location" value="<?php echo $res['location'] ?>"
                        </label>
                        <div>
                            <input type="submit" name="alter" value="Insert">
                            <input type="submit" name="cancel" value="Cancel">
                            <input type="submit" name="delete" value="Delete">
                        </div>
                    </form>
                </div>
                <?php
            }
        }
    }
}
