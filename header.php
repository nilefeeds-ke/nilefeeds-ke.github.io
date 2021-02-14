<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once 'assets/php/Connection.php';
    DEFINE("LOGO", '/Niles/assets/images/nilefeedslogo.png');
    DEFINE('BASE_PATH', 'Niles/');
    $con = new Connection();
    $conn = $con->connection();
?>

<html lang="en">
<head>
    <title><?php echo TITLE ?></title>
    <link rel="stylesheet" href="<?php  echo "/Niles/assets/css/styles.css" ?>">
</head>
<body>
<nav class="navigation">
    <div class="logo">
        <a href=""><img alt="" src="<?php echo LOGO;?>"></a>
    </div>
    <div class="nav-bar">
        <ul class="nav-items">

            <?php if(isset($_SESSION['token'])){
                require_once 'user.unsess.php';
                require_once 'user.sess.php';
                echo '<a href="">'.$_SESSION['user'].'</a>';
            }
            else{
                require_once 'user.unsess.php';
                echo '<a href="/Niles/login">Login</a>';
            }
            ?>
        </ul>

    </div>
</nav>