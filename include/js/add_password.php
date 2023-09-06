<?php

session_start();
require_once("../../bdd.php");
require_once("../function.php");

if(isset($_POST['add_site']) and isset($_POST['add_email']) and isset($_POST['add_password'])){
    $email = htmlspecialchars($_POST['add_email']);
    $password = htmlspecialchars($_POST['add_password']);
    $website = htmlspecialchars($_POST['add_site']);
    $id_user = $_SESSION['id'];

    $password = encryptPassword($password, $id_user, $bdd);

    $sqlQuery = "SELECT * FROM password WHERE email = :email AND password = :password and website = :website AND id_user = :id_user";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":email"=>$email,":password"=>$password,":website"=>$website,":id_user"=>$id_user));

    $rows = $stmt->fetchAll();

    if( count($rows) == 0 ){
        $sqlQuery = "INSERT INTO password (email, password, website, id_user) VALUES(:email, :password, :website, :id_user)";
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute(array(":email"=>$email,":password"=>$password, ":website"=>$website, ":id_user"=>$id_user));
        echo json_encode(array('status' => 'success')); // Retourne une réponse JSON en cas de succès
    }
    else {
        echo json_encode(array('status' => 'known')); // Retourne une réponse JSON en cas d'échec
    }
}

?>