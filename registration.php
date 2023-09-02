<?php 
require_once("bdd.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./librairie/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./dist/css/style_registration.css">
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="card" id="card_alert">
    </div>
</div>
<div class="card" id="card_registration">
    <div class="card-body">
        <span class="card-title" id="card-title">Inscription</span>
        <div class="card" id="form_card_registration">
            <form method="POST" id="registration_form" enctype="multipart/form-data" onsubmit="return registration(event);">
                <div class="row" id="identifier">
                    <div class="col-6" id="name">
                        <label id="name_tilte" for="name">Nom :</label>
                        <input type="text" name="name" id="name_text" class="form-control" required>
                    </div>
                    <div class="col-6" id="surname">
                        <label id="surname_tilte" for="surname">Prenom :</label>
                        <input type="text" name="surname" id="surname_text" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="email">
                        <label id="email_tilte" for="email">Email :</label>
                        <input type="email" name="email" id="email_text" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="pass">
                        <label id="password_tilte" for="password">Mot de Passe :</label>
                        <input type="password" pattern="[a-z0-9]{6,16}" placeholder="Au Moins 6 Caractères" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="pass">
                        <label id="password2_tilte" for="password2">Entrez le Mot de Passe à Nouveau :</label>
                        <input type="password" pattern="[a-z0-9]{6,16}" id="password2" name="password2" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 offset-md-4">
                        <button id="button_form_mailpas" type="submit" class="btn btn-outline-primary">Continuer</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-12">
                <button id="button_registration" onclick="window.location.href='index.php'" type="button" class="btn btn-outline-primary">Vous Connecter avec votre Compte</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="./librairie/bootstrap/js/bootstrap.bundle.js"></script>
<script src="./dist/js/passdoc.js"></script>
</html>