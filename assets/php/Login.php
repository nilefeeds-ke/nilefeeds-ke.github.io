<?php


class Login extends Connection
{
    private $username;
    private $password;
    private $conn;

    public function __construct(){
        $this->conn = Parent::connection();
    }

    public function login(){
        $res = false;
        try{
            $stmt = $this->conn->prepare("SELECT USERNAME, PASSWORD FROM USERS WHERE USERNAME=? AND PASSWORD=?");
            $stmt->bind_param('ss',$this->username,$this->password);
            $result = $stmt->execute();
            if($result === true){
                $res=true;
            }
            else{
                echo "could not find user";
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        return $res;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}