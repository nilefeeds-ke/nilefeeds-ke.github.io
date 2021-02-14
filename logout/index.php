<?php
session_start();
if(isset($_GET['token'])){
    session_destroy();
    header('Location: ../');
}