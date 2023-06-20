<?php 
session_start();

include_once 'inc/header.php';
include 'inc/nav.php';
foreach ($_SESSION['user'] as $value) {
    echo("$value"),'<br>';
}

?>