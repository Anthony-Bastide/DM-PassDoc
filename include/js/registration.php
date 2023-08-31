<?php

require_once("../../bdd.php");

if(isset($_POST['email']) and isset($_POST['password']) and isset($_POST['password2']) and isset($_POST['name']) and isset($_POST['surname'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);

    $sqlQuery = "SELECT * FROM users WHERE email = :email";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":email"=>$email));

    $rows = $stmt->fetchAll();

    if( count($rows) == 0 ){
        $sqlQuery = "INSERT INTO users (email, password, name, surname) VALUES(:email, SHA1(:password), :name, :surname)";
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute(array(":email"=>$email,":password"=>$password, ":name"=>$name, ":surname"=>$surname));
        echo json_encode(array('status' => 'success')); // Retourne une réponse JSON en cas de succès
    }
    else {
        echo json_encode(array('status' => 'known')); // Retourne une réponse JSON en cas d'échec
    }
}

?>