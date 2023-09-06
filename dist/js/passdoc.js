function registration(event){
    event.preventDefault();
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;
    if(password == password2){
        let formElem = document.getElementById("registration_form");
        let formdata = new FormData(formElem);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "include/js/registration.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);
                if(response.status === 'success'){
                    window.location.href = '/passdoc/index.php'; 
                } 
                else {
                    const htmlCode = `
                    <div class="tilte_alert"><img src="./dist/img/icon/warning.png" class="warning"></img>Un Problème est Survenu Soit :</div>
                    - Impossible de trouver un compte correspondant à cette adresse e-mail
                    <br>
                    - Vous avez déjà un compte PassDoc
                    <br>
                    - Il a peut être un problème avec l'enregistrement de votre compte 
                    `;
        
                    document.getElementById('card_alert').innerHTML = htmlCode; 
                }
            }
            else {
                alert("Erreur lors de l'envoi de la requête.");
            }
        };
        xhr.send(formdata);
    }
    else{
        document.getElementById("password2").className = "form-control is-invalid";
        alert("Erreur les deux mot-pass sont pas identique.");
    }
}

function connection(event){
    event.preventDefault();
    let formElem = document.getElementById("connection_form");
    let formdata = new FormData(formElem);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/connection.php");
    xhr.onload = function() {
        if(xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/passdoc/passdoc.php';
            } 
            else {
                const htmlCode = `
                <div class="tilte_alert"><img src="./dist/img/icon/warning.png" class="warning"></img>Un Problème est Survenu Soit :</div>
                - Impossible de trouver un compte correspondant à cette adresse e-mail
                <br>
                - Le mot de passe incorrect
                <br>
                - Vous n'avez pas de compte PassDoc 
                `;
    
                document.getElementById('card_alert').innerHTML = htmlCode;
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}

function update_profil(event){
    event.preventDefault();
    let formElem = document.getElementById("update_profil");
    let formdata = new FormData(formElem);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/update_profil.php");
    xhr.onload = function() {
        if(xhr.status === 200) {
            if(xhr.responseText.length > 0) {
                let response = JSON.parse(xhr.responseText);
                switch(response.status) {
                    case 'error_extension':
                        document.getElementById("file_img").className = "form-control is-invalid";
                        alert("Erreur : Veuillez ne mettre que des images");
                        break;
                    case 'error_move':
                        document.getElementById("file_img").className = "form-control is-invalid";
                        alert("Erreur : Veuillez ressayer plus tard nous avons un petit problème");
                        break;
                    case 'error_size':
                        document.getElementById("file_img").className = "form-control is-invalid";
                        alert("Erreur : Image es trop grande");
                        break;
                    case 'success':
                        window.location.reload();
                        break;
                }
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}

function copy_text() {
    let val = document.getElementById("input_password").value;
    navigator.clipboard.writeText(val).then(function() {
        alert("Le mot de passe a été copié dans le presse-papier");
    });
}

function generate_password() {
    const longueurMotDePasse = 13;
    const majuscules = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const minuscules = "abcdefghijklmnopqrstuvwxyz";
    const chiffres = "0123456789";
    const symboles = "!@#$%&*()_+";
    let caractereAleatoire = "";
    
    while(caractereAleatoire.length < longueurMotDePasse) {
        caractereAleatoire +=  
            majuscules.charAt(Math.floor(Math.random() * majuscules.length)) +
            minuscules.charAt(Math.floor(Math.random() * minuscules.length)) +
            chiffres.charAt(Math.floor(Math.random() * chiffres.length)) +
            symboles.charAt(Math.floor(Math.random() * symboles.length));;
    }

    const lettres = caractereAleatoire.split('');

    for (let i = lettres.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [lettres[i], lettres[j]] = [lettres[j], lettres[i]]; 
    }

    const password = lettres.join('');

    document.getElementById("add_password").value = password;
}
function add_password_doc(event){
    event.preventDefault();
    let formElem = document.getElementById("from_add_password");
    let formdata = new FormData(formElem);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/add_password.php");
    xhr.onload = function() {
        if(xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/passdoc/passdoc.php';
            } 
            else {
                alert("C'est information son déjà enregistrer");
            }
        }
        else {
            alert("Erreur lors de l'envoi de la requête.");
        }
    };
    xhr.send(formdata);
}

function display_add_password() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card_display_tool").innerHTML = xhr.responseText;
        }
    };
    xhr.open("POST", "include/js/display_add_password.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("");
}

function display_see_password() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card_display_tool").innerHTML = xhr.responseText;
        }
    };
    xhr.open("POST", "include/js/display_see_password.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("");
}

function display_see_password_search() {
    var selected_value = document.getElementById("pass_search").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("card_display_tool").innerHTML = xhr.responseText;
        }
    };
    xhr.open("POST", "include/js/display_see_password_search.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("search=" + selected_value);
}