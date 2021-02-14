<?php
require_once 'EditProduct.php';
$edit = new EditProduct();
if(isset($_POST['alter'])){
    if(!empty(stripcslashes($_POST['product_id'])) && !empty(stripcslashes($_POST['name'])) &&
        !empty(stripcslashes($_POST['description'])) && !empty(stripcslashes($_POST['location']))
    ){

        $product_id = stripcslashes($_POST['product_id']);
        $name = stripcslashes($_POST['name']);
        $description = stripcslashes($_POST['description']);
        $location = stripcslashes($_POST['location']);
        $array = array(
            "id"=>$product_id,
            "name"=>$name,
            "description"=>$description,
            "location"=>$location);

        if($edit->alterProduct($array) === true){
            header("Location: ../");
        }
        else{
            header("Location: edit.php?token=".$_SESSION['token'].'pid='.$product_id);
        }
    }
}
elseif(isset($_POST['cancel'])){
    header("Location:../?");
}
elseif(isset($_POST['delete'])){
    $product_id = stripcslashes($_POST['product_id']);
    $edit->setProductId($product_id);
   if( $edit->deleteProduct() === true){
       header("Location: ../");
   }
}