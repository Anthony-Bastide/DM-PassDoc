<form method="POST" id="from_add_password" enctype="multipart/form-data" onsubmit="return add_password_doc(event);">
    <div class="row">
        <div class="col-5">
            <label class="input_text_blue_tilte" for="add_email">Email</label>
            <input type="email" class="form-control input_text_blue" id="add_email" name="add_email" required>
        </div>
        <div class="col-2">
            <label class="input_text_blue_tilte" for="add_sit">Site</label>
            <input type="text" class="form-control input_text_blue" id="add_site" name="add_site" required>
        </div>
        <div class="col-5">
            <label class="input_text_blue_tilte" for="add_password">Password</label>
            <input type="password" placeholder="Au Moins 6 Caractères" class="form-control input_text_blue" id="add_password" name="add_password" required>
        </div>
    </div>
    <div class="col-8 offset-md-2">
        <div class="row btn_add_password">
            <div class="col-6">
                <button class="btn btn-outline-primary" onclick="generate_password()" type="button">
                    Mots de Passe Aléatoire
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-outline-success" type="submit">
                    Ajouter un Mots de Passe
                </button>
            </div>
        </div> 
    </div>
</form>
<div class="col-10 offset-md-1 text_add_password">
    <span>Les mots de passe aléatoire son programmaient pour être sécurisés. Par conséquent on vous le recommande pour que votre expérience sur Internet soit la plus sure.</span>
</div>