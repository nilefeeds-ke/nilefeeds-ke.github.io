<div class="content-page">
    <div class="products-content">
        <?php
            $result = $conn->query("SELECT * FROM products");
            if($result){
                if($result->num_rows > 0){
                    while($row = $result->fetch_array()){

                        ?>
                        <div class="product-box">
                            <?php
                                if(isset($_SESSION['token'])){
                                    echo '<a href="edit/edit.php?token=' . $_SESSION['token'] . '&pid=' . $row['id'].'">edit</a>';
                                }
                            ?>
                            <div class="product-image">
                                <h1><?php echo $row['name']; ?></h1>
                                <img src="<?php echo $row['location'] ?>" onerror="this.onerror=null;this.src='<?php echo 'uploads/'.$row['location']?>'">
                            </div>
                            <div class="product-description">
                                <?php echo $row['description']; ?>
                            </div>
                        </div>
                        <?php


                    }
                }
                else{
                    echo "Data not found";
                }
            }
            else{
                echo "Database not available";
            }
        ?>

    </div>
</div>