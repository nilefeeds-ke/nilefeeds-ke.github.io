<div class="services">
    <h1>SERVICES</h1>
    <div class="services-items">
    <?php
        if($conn){
            $result = $conn->query("SELECT * FROM services");
            if($result){
               while($row = $result->fetch_array()){?>
                   <div class="products">
                       <h1 class="service-name"><?php echo $row['servicename']; ?></h1>
                       <div class="service-image"><img src="<?php echo $row['serviceimage']; ?>"></div>
                   </div>
                   <?php
               }
            }
            else{
                echo "query not successful";
            }
        }
        else{
            echo "not connected";
        }

    ?>
    </div>
</div>