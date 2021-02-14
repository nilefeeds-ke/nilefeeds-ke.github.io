<?php
    require_once '../assets/php/Login.php';
    if(isset($_POST['login'])){
        if(!empty($_POST['username']) && !empty($_POST['password'])){
            $user = stripcslashes($_POST['username']);
            $password = stripcslashes($_POST['password']);
            $log = new Login();
            $log->setUsername($user);
            $log->setPassword($password);
            $log->login();
            if($log->login() === true){
                // SESSION START;
                session_start();
                $userToken = bin2hex(openssl_random_pseudo_bytes(24));
                $_SESSION['token'] =  $userToken;
                $_SESSION['user'] = $user;
                header("Location:../index.php?".$_SESSION['token']);
            }
        }
    }
?>

<div class="login">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <label for="username">
            Username:
            <input type="text" name="username">
        </label>
        <label for="password">
            Password:
            <input type="password" name="password">
        </label>
        <input type="submit" name="login" value="Login">
    </form>
</div>
