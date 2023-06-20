<?php
session_start();


function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

foreach ($_POST as $key => $value) {
  $$key = test_input($value);
  
}

$error=[];

if (!empty($name)&& !empty($email) && !empty($psw) && !empty($psw_repeat)) {
  
    if (strlen($name)<3 ||strlen($name)>25) {
      //$error[]='name';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[]='email';
    }

    if (strlen($psw)>2) {
      if ($psw_repeat!=$psw) {
        $error[]='RepeatPassword';
      }
    }else {
      $error[]='Password';
    }
 

}else {
  $error[]='Enter the data';
}

if (count($error)>0) {
$_SESSION['error']=$error;
header("location:index.php");
   exit;
  // foreach ($error as  $value) {
  //   echo $value,'<br>';
  // }
}else{
  
$_SESSION['name']=$name;
$_SESSION['email']=$email;
header("location:user.php");
   exit;
}