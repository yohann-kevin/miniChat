<?php

function db() {
    $data='mysql:dbname=minichat;host=127.0.0.1';
    $user='root';
    $password='';

    try {
        $db=new PDO($data, $user, $password);
    }

    catch (PDOException $e) {
        echo 'Connexion échouée : '. $e->getMessage();
    }

    return $db;
}

