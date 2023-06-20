<?php
session_start();

include '../cor/function.php';
include '../cor/Validation.php';
$errors=[];
if (request('POST') && input('name')) {
    
    foreach ($_POST as $key => $value) {
        $$key = test_input("$value");
    }

if (empty($name)) {
    $errors[]='error name';   
}else{
if (!minVal($name,3)) {
    $errors[]='min <3';
}
if (!maxVal($name,25)) {
    $errors[] ='max >25';
}
}

if (empty($email)) {
    $errors[]='fals email';   
}elseif (!emailVal($email)) {
    $errors[]='error email';
}

if (empty($psw)) {
    $errors[]='error psw';   
}else{
if (!minVal($psw,6)) {
    $errors[]='min <6';
}
if (!maxVal($psw,25)) {
    $errors[] ='max >25';
}
}







//sha1($psw)
if (empty($errors)){
$id=0;
    
    $usets_file=fopen("../data/users.csv",'a+');
    while (($data = fgetcsv($usets_file)) !== false) {
        if ($email== $data[2]) {
            $_SESSION['errors']=['The email already exists'];
            redirect( '../register.php');
        }        
    $id=$data[0]+1;
    }

    $data=[$id,$name,$email,sha1($psw)];
    fputcsv($usets_file,$data);
    $_SESSION['user']=[$id,$name,$email];

    redirect('../index.php');
}else {
    $_SESSION['errors']=$errors;
    redirect( '../register.php');
}

//print_r($errors);
//var_dump($errors);
}else {
    echo 5555555;
}