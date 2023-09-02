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

?>