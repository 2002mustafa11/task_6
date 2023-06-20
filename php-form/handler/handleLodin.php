<?php
session_start();

include '../cor/function.php';
include '../cor/Validation.php';
$errors=[];
if (request('POST') && input('email')) {
    foreach ($_POST as $key => $value) {
        $$key = test_input($value);
    }

    if (empty($email)) {
        $errors[]='fals email'; 
    }
    if (empty($psw)) {
        $errors[]='fals psw'; 
    }

    if (empty($errors)) {

        
        $usets_file=fopen("../data/users.csv",'a+');
        while (($data = fgetcsv($usets_file)) !== false) {
            if (sha1($psw) == $data[3] && $email== $data[2]) {
                $_SESSION['user']=[$data[0],$data[1],$email];
            }
            
        }
        
        if (isset($_SESSION['user'])) {
            fclose($usets_file);
            redirect('../index.php');
        }else {
            $errors[]='fals'; 
            $_SESSION['errors']=$errors;
            redirect( '../login.php');
        }
        
        
        
        
    
    }else {
        $_SESSION['errors']=$errors;
        redirect( '../login.php');
    }
}else {
    echo 5555555;
}