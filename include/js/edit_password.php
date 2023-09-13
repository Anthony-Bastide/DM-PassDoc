<?php
require_once("../../bdd.php");
require_once("../function.php");
session_start();

if(isset($_POST['edit_email']) and isset($_POST['edit_password']) and isset($_POST['id'])){
    $email = htmlspecialchars($_POST['edit_email']);
    $password = htmlspecialchars($_POST['edit_password']);
    $id = $_POST['id'];
    $id_user = $_SESSION['id'];

    $password = encryptPassword($password, $id_user, $bdd);
    try {
        $sqlQuery = " UPDATE password SET email = :email, password = :password WHERE id = :id and id_user = :id_user";
        $stmt = $bdd->prepare($sqlQuery);
        $stmt->execute(array(":email"=>$email,":password"=>$password,":id"=>$id, ":id_user"=>$id_user));
        echo json_encode(array('status' => 'success')); // Retourne une réponse JSON en cas de succès
    } catch (PDOException $e) {
        echo json_encode(array('status' => 'erreur')); // Retourne une réponse JSON en cas d'échec
    }
}