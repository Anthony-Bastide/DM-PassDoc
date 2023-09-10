<?php

session_start();
require_once("../../bdd.php");
require_once("../function.php");

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $id_user = $_SESSION['id'];

    try {
        $sqlQuery = "DELETE FROM password WHERE id = :id AND id_user = :id_user";
        $stmt = $bdd->prepare($sqlQuery);
        $success = $stmt->execute(array(":id" => $id, ":id_user" => $id_user));

        echo json_encode(array('status' => 'success')); // Retourne une réponse JSON en cas de succès
    } catch (PDOException $e) {
        echo json_encode(array('status' => 'known')); // Retourne une réponse JSON en cas d'échec
    }
}

?>