function registration(event){
    event.preventDefault();
    var password = document.getElementById("password").value;
    var password2 = document.getElementById("password2").value;
    if(password == password2){
        var formElem = document.getElementById("registration_form");
        var formdata = new FormData(formElem);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "include/js/registration.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if(response.status === 'success'){
                    window.location.href = '/passdoc/index.php'; 
                } 
                else {
                    window.location.href = '/passdoc/known.php'; 
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
    var formElem = document.getElementById("connection_form");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/connection.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if(response.status === 'success'){
                window.location.href = '/passdoc/chat.php'; 
            } 
            else {
                window.location.href = '/passdoc/unknown.php'; 
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
    var formElem = document.getElementById("update_profil");
    var formdata = new FormData(formElem);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "include/js/update_profil.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            if(xhr.responseText.length > 0) {
                var response = JSON.parse(xhr.responseText);
                switch (response.status) {
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