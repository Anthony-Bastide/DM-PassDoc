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
        <th class="th_edit"><img class="img_delete" src="./dist/img/icon/delete.png"></th>
    </thead>
    <tbody>
        <?php
        foreach ($tab_password as $password) 
        {
            $password2 = decryptPassword($password['password'], $id_user , $bdd);
            ?>
            <tr>
                <td class="td_site"><?= $password['website'] ?></td>
                <td class="td_input"><input type="text" class="form-control" onkeyup="dispay_edit('<?= $password['id'] ?>')" value="<?= $password['email'] ?>"></td>
                <td class="td_input"><input type="text" id="input_password" onkeyup="dispay_edit('<?= $password['id'] ?>')" class="form-control" value="<?= $password2 ?>"></td>
                <td class="td_copy">
                    <button id="copy_button<?= $password['id'] ?>" class="btn btn-outline-primary copy_button" onclick="copy_text()">
                        <img id="img_copy_button<?= $password['id'] ?>" class="img_copy_button" src="./dist/img/icon/copy.png">
                    </button>
                </td>
                <td class="td_edit">
                    <button id="delete_button<?= $password['id'] ?>" class="btn btn-outline-danger" onclick="delet_password('<?= $password['id'] ?>')">
                        <img id="img_delete_button<?= $password['id'] ?>" class="img_delete_button" src="./dist/img/icon/delete.png">
                    </button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>