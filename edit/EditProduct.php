<?php
require_once '../assets/php/Connection.php';

class EditProduct extends Connection
{
    private $productId;
    private $conn;

    public function __construct(){
        $this->conn = Parent::connection();
    }

    public function editProduct(){
        $arr = array();
        $query = $this->conn->prepare("SELECT * FROM products where id = ?");
        $query->bind_param('i', $this->productId);
        $query->execute();
        $result = $query->get_result();
        while($row = $result ->fetch_array()){
           $arr = $row;
        }
        return $arr;
    }

    public function alterProduct($arr){
        $res = false;
        $stmt = $this->conn->prepare("UPDATE products set name=?, description= ?, location =? WHERE id=?");
        $stmt->bind_param('sssi', $arr['name'], $arr['description'], $arr['location'], $arr['id']);
        if ( $stmt->execute()){
            $res = true;
            //echo "Successfully updated!";
        }
        else{
            //echo "Failed to update!";
            $res = false;
        }
        return $res;
    }

    public function deleteProduct(){
        $res = false;
        $query = $this->conn->prepare("DELETE FROM products WHERE id=?");
        $query->bind_param('i', $this->productId);
        if( $query->execute()){
            $res = true;
        }
        return $res;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }



}