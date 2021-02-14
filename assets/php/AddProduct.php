<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'].'/Niles/assets/php/Connection.php';
DEFINE("PATH", $_SERVER['DOCUMENT_ROOT'].'/Niles/uploads/');

class AddProduct extends Connection
{
    private $allowed = array('jpg','jpeg','png','gif');
    private $fileDestination = PATH;
    private $fileNameNew;
    private $fileName;
    private $fileTmpName ;
    private $fileSize;
    private $fileError;
    private $productName;
    private $productDescription ;
    private $conn;

    public function __construct(){
        $this->conn = Parent::connection();
    }


    private function uploadImage(){
        $ret = false;
        $fileExt = explode('.',$this->fileName);
        $fileExtActual = strtolower(end($fileExt));
        $this->allowed;

        if(in_array($fileExtActual,$this->allowed)){
            if($this->fileError === 0){
                if($this->fileSize < 1000000){
                    $this->fileNameNew = uniqid('', true).".".$fileExtActual;
                    $this->fileDestination .= $this->fileNameNew;

                    if(move_uploaded_file($this->fileTmpName,$this->fileDestination)){
                       // header("Location: uploadProducts.php?uploadSuccess");
                        $ret = true;
                    }
                    else{
                        echo "Houston We have a problem ! ";
                    }

                }
                else{
                    echo 'File size is too large';
                }
            }
            else{
                echo 'There was a problem during upload';
            }
        }
        else{
            echo "Wrong file format";
        }
        return $ret;
    }

    public function insertToDB(){
         if(self::uploadImage() == true){
             echo "Houston the package has been dispatched!";
             $sql = "INSERT INTO products(name, description, location) VALUES (?,?,?)";
             $query = $this->conn->prepare($sql);
             $query->bind_param("sss",$this->productName,$this->productDescription,$this->fileNameNew);
             if($query->execute()){
                 echo "Houston The package has been successfully delivered!";
             }
             else{
                 echo "Package could not be delivered";
             }

         }
         else{
             echo "Houston we were unable to deliver your package!";
         }
    }

    //GETTERS

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return mixed
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return mixed
     */
    public function getFileTmpName()
    {
        return $this->fileTmpName;
    }

    /**
     * @return mixed
     */
    public function getFileError()
    {
        return $this->fileError;
    }

    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    // SETTERS

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @param mixed $productDescription
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
    }
    /**
     * @param mixed $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param mixed $fileTmpName
     */
    public function setFileTmpName($fileTmpName)
    {
        $this->fileTmpName = $fileTmpName;
    }

    /**
     * @param mixed $fileError
     */
    public function setFileError($fileError)
    {
        $this->fileError = $fileError;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = $fileSize;
    }

}