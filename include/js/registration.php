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

        $sqlQuery = "SELECT id FROM users WHERE email = :email AND name = :name AND surname = :surname";
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute(array(":email"=>$email , ":name"=>$name, ":surname"=>$surname));

        $tab_id_user = $stmt->fetch();
        $id_user = $tab_id_user['id'];

        $lettres = 'abcdefghijklmnopqrstuvwxyz';
        $cript = '';
        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($lettres) - 1);
            $cript .= $lettres[$index];
        }

        $sqlQuery = "INSERT INTO keyscript (id_user, cript) VALUES(:id_user, :cript)";
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute(array(":id_user"=>$id_user,":cript"=>$cript));

        echo json_encode(array('status' => 'success')); // Retourne une réponse JSON en cas de succès
    }
    else {
        echo json_encode(array('status' => 'known')); // Retourne une réponse JSON en cas d'échec
    }
}

?>