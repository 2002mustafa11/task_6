<?php
session_start();

echo $_SESSION['name'],'<br>',
$_SESSION['email'];