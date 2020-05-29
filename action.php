<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $houseId = $_POST['house_id'];
    $password = $_POST['password'];
    
    $errors = [];
    
    $inputs = [
        'fullname' => $name,
        'email' => $email,
        'house_id' => $houseId,
        'password' => $password
    ];
    
    if (empty($name)) {
        $errors['fullname'] = [
            'message' => 'İsim soyisim girilmesi zorunludur',
            'old_input' => $name
        ];
    }
    
    if (empty($email)) {
        $errors['email'] = [
            'message' => 'Eposta adresi girilmesi zorunludur',
            'old_input' => $email
        ];
    }
    
    if (empty($houseId)) {
        $errors['house_id'] = [
            'message' => 'Bina seçilmesi zorunludur',
            'old_input' => $houseId
        ];
    }
    
    if (empty($password)) {
        $errors['password'] = [
            'message' => 'Parola girilmesi zorunludur',
            'old_input' => null
        ];
    }
    
    $_SESSION['inputs'] = $inputs;
}

if (isset($errors)) {
    $_SESSION['errors'] = $errors;
}

header("Location: http://potterhead.test/register.php");
