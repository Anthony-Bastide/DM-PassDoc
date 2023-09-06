<?php
session_start();
require_once("../../bdd.php");
require_once("../function.php");
$id_user = $_SESSION['id'];
$tab_password = recup_doc_pass($id_user, $bdd);
?>
<table class="table table-dark table-striped table_password">
    <thead>
        <th class="th_site">Sites</th>
        <th class="th_email">Emails</th>
        <th class="th_password">Passwords</th>
        <th class="th_copy"><img class="img_copy" src="./dist/img/icon/copy.png"></th>
        <th class="th_edit"><img class="img_edit" src="./dist/img/icon/edit.svg"></th>
    </thead>
    <tbody>
        <?php
        foreach ($tab_password as $password) 
        {
            $password2 = decryptPassword($password['password'], $id_user , $bdd);
            ?>
            <tr>
                <td class="td_site"><?= $password['website'] ?></td>
                <td><input type="text" class="form-control" value="<?= $password['email'] ?>"></td>
                <td><input type="text" id="input_password" class="form-control" value="<?= $password2 ?>"></td>
                <td class="td_copy">
                    <button class="btn btn-outline-primary" onclick="copy_text()">
                        <img class="img_copy_button" src="./dist/img/icon/copy.png">
                    </button>
                </td>
                <td class="td_edit">
                    <button class="btn btn-outline-success">
                        <img class="img_edit_button" src="./dist/img/icon/edit.svg">
                    </button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>