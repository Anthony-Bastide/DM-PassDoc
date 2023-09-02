<?php
session_start();
require_once("bdd.php");
require_once("./include/function.php");
if(!is_connected($_SESSION['id'])){
    header('Location:prohibition.php');
}
$id_user = $_SESSION['id'];
$user = recup_table_users_by_id($id_user, $bdd);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./librairie/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./dist/css/style_passdoc.css">
    <title>Document</title>
</head>
<body>

    <div class="modal fade modal-lg " id="modify_profil" tabindex="-1" aria-labelledby="modify_profilLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modify_profilLabel">Modification du Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="update_profil" enctype="multipart/form-data" onsubmit="return update_profil(event);">
                <div class="modal-body">
                    <div class="row" id="name_surname_profil">
                        <div class="col-6" id="name">
                            <label for="name">Nom :</label>
                            <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control" required>
                        </div>
                        <div class="col-6" id="surname">
                            <label for="surname">Prenom :</label>
                            <input type="text" name="surname" value="<?= $user['surname'] ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row" id="file_profil">
                        <div class="col-9" id="input_file">
                            <label for="file_img" class="form-label">Nouvelle Image de Profil :</label>
                            <input class="form-control" title="Le fichier doit être une image (jpg, jpeg, png)" id="file_img" name="file_img" type="file">
                        </div>
                        <div class="col-3">
                            <img class="img_profile" src="./dist/img/profile/<?php if($user['img']!=""){echo $user['img'];}else{echo 'profile.png';} ?>">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?= $id_user ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sauvegarder les Modifications</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-8 offset-md-2" id="body_tool">
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <img class="profile_img" src="./dist/img/profile/<?php if($user['img']!=""){echo $user['img'];}else{echo 'profile.png';} ?>">
                <a class="navbar-brand" href="#">PassDoc</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="passdoc.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modify_profil">Profil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Option
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Voir les Mots de Passe</a></li>
                                <li><a class="dropdown-item" href="#">Ajouter un Mot de Passe</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="disconect.php">Déconnexion</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="card" id="card_tool">
            <div class="card-body">
            </div>
        </div>
    </div>

</body>
<script src="./librairie/bootstrap/js/bootstrap.bundle.js"></script>
<script src="./dist/js/passdoc.js"></script>
</html>