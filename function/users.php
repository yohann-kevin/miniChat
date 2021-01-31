<?php

function register(){
    global $db;

    extract($_POST);

    $validation = true;

    $errors = [];

    if(empty($pseudo) || empty($email) || empty($emailconf) || empty($password) || empty($passwordconf)){
        $validation = false;
        $errors[] = 'Tous les champs sont obligatoires !!!'; 
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $validation = false;
        $errors[] = 'Adresse Email non valide !!!';
    }
    
    if($emailconf != $email){
        $validation = false;
        $errors[] = 'adresse email de confirmation est incorrecte !!!';
    }

    if($passwordconf != $password){
        $validation = false;
        $errors[] = 'le mot de passe de confirmation est incorrect !!!';
    }

    if(pseudoCheck($pseudo)){
        $validation = false;
        $errors[] = 'Ce pseudo est déjà pris !';
    }

    if($validation){
        $register = $db->prepare('INSERT INTO users(pseudo, email, password) VALUES (:pseudo, :email, :password)');
        $register->execute([
            'pseudo' => htmlentities($pseudo),
            'email' => htmlentities($email),
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        
        header('Location: account.php');
        unset($_POST['pseudo']);
        unset($_POST['email']);
        unset($_POST['emailconf']);

    }

    return $errors;
    
}

function pseudoCheck($pseudo){
    global $db;

    $results = $db->prepare('SELECT COUNT(*) FROM users WHERE pseudo = ? ');
    $results->execute([$pseudo]);

    $results = $results->fetch()[0];

    return $results;
}