<?php

function is_connected($session)
{
    if(!empty($session) ){
        return true;
    }
    else{
        return false;
    }
}

function recup_table_users_by_id($id, $bdd)
{
    $tab_user = array();

    $sqlQuery = "SELECT * FROM users WHERE id = :id";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id"=>$id));

    $tab_user = $stmt->fetch();
    
    return $tab_user;
}

function recup_doc_pass($id_user, $bdd)
{
    $tab_password = array();

    $sqlQuery = "SELECT * FROM password WHERE id_user = :id_user ORDER BY id DESC";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id_user"=>$id_user));

    $tab_password = $stmt->fetchAll();
    
    return $tab_password;
}

function recup_doc_pass_for_search($search ,$id_user, $bdd)
{
    $tab_password = array();

    $sqlQuery = "SELECT * FROM password WHERE id_user = :id_user AND (email LIKE :email OR website LIKE :website)";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id_user"=>$id_user, ":email"=>"%".$search."%", ":website"=>"%".$search."%"));

    $tab_password = $stmt->fetchAll();
    
    return $tab_password;
}

function encryptPassword($password, $id_user, $bdd) {

    $sqlQuery = "SELECT cript FROM keyscript WHERE id_user = :id_user";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id_user"=>$id_user));

    $tab_cript = $stmt->fetch();
    $key = $tab_cript['cript'];

    $iv = random_bytes(16); 
    $encryptedPassword = openssl_encrypt($password, 'AES-256-CBC', $key, 0, $iv);
    return base64_encode($iv . $encryptedPassword);
}

function decryptPassword($encryptedPassword, $id_user , $bdd) {

    $sqlQuery = "SELECT cript FROM keyscript WHERE id_user = :id_user";
    $stmt = $bdd->prepare($sqlQuery);
    $stmt->execute(array(":id_user"=>$id_user));

    $tab_cript = $stmt->fetch();
    $key = $tab_cript['cript'];
    
    $data = base64_decode($encryptedPassword);
    $iv = substr($data, 0, 16);
    $encryptedPassword = substr($data, 16);
    $decryptedPassword = openssl_decrypt($encryptedPassword, 'AES-256-CBC', $key, 0, $iv);
    return $decryptedPassword;
}

?>