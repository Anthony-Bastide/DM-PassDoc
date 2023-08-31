<?php

session_start();
require_once("../../bdd.php");

if(isset($_POST['email']) and isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashpass = hash('SHA1',$password);

    $selectQuery = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmtUser = $bdd->prepare($selectQuery);
    $stmtUser->execute(array(":email"=>$email, ":password" =>$hashpass));

    if($stmtUser->rowCount() > 0){
        $data = $stmtUser->fetch();
        $_SESSION['email'] = $data['email'];
        $_SESSION['id'] = $data['id'];
        echo json_encode(array('status' => 'success')); 
    }
    else {
        echo json_encode(array('status' => 'known'));
    }
}

?>