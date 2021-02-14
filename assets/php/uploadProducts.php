<?php
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'].'/Niles/assets/php/Connection.php';
require_once 'AddProduct.php';
$con = new Connection();
$conn = $con->connection();
$products = new AddProduct();

if(isset($_POST['upload'])){
    $file = $_FILES['productimg'];
    $fileName = $_FILES['productimg']['name'];
    $fileTmpName = $_FILES['productimg']['tmp_name'];
    $fileSize = $_FILES['productimg']['size'];
    $fileError = $_FILES['productimg']['error'];
    $fileType = $_FILES['productimg']['type'];

    $productName = mysqli_real_escape_string($conn,$_POST['productname']);
    $productDescription = mysqli_real_escape_string($conn,$_POST['productdescription']);

    if(!empty(trim($_POST['productname'])) && !empty(trim($_POST['productdescription']))){

        $products->setProductName($_POST['productname']);
        $products->setProductDescription($_POST['productdescription']);
        $products->setFileName($fileName);
        $products->setFileTmpName($fileTmpName);
        $products->setFileError($fileError);
        $products->setFileSize($fileSize);
        $products->insertToDB();
    }
    else{
        echo 'Houston the package is missing!';
    }

}

?>
<div class="add-product">
    <form class="upload" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <label for="productname">
            Product Name<input type="text" name="productname">
        </label>

        <label for="image">
            Image<input type="file" name="productimg">
        </label>

        <label for="productdescription">
            Description<textarea type="text" name="productdescription"></textarea>
        </label>
        <button type="submit" name="upload">Upload</button>
    </form>
</div>

