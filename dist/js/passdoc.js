function registration(event) {
    event.preventDefault();
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;
    
    if (password == password2) {
        let formElem = document.getElementById("registration_form");
        let formdata = new FormData(formElem);
        
        fetch("include/js/registration.php", {
            method: "POST",
            body: formdata
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error("Erreur lors de la requête.");
            }
        })
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '/passdoc/index.php'; 
            } else {
                const htmlCode = `
                    <div class="tilte_alert"><img src="./dist/img/icon/warning.png" class="warning"></img>Un Problème est Survenu Soit :
                    <br>
                    - Vous avez déjà un compte PassDoc
                    <br>
                    - Il y a peut-être un problème avec l'enregistrement de votre compte
                `;
                document.getElementById('card_alert').innerHTML = htmlCode;
            }
        })
        .catch(error => {
            alert(error.message);
        });
    } else {
        document.getElementById("password2").className = "form-control is-invalid";
        alert("Erreur les deux mots de passe ne sont pas identiques.");
    }
}

function connection(event){
    event.preventDefault();
    let formElem = document.getElementById("connection_form");
    let formdata = new FormData(formElem);

    fetch("include/js/connection.php", {
        method: "POST",
        body: formdata
    })
    .then(response => {
        if(response.ok) {
            return response.json();
        } else {
            throw new Error("Erreur lors de la requête.");
        }
    })
    .then(data => {
        if(data.status === 'success') {
            window.location.href = '/passdoc/passdoc.php';
        } else {
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
    })
    .catch(error => {
        alert(error.message);
    });
}

function update_profil(event){
    event.preventDefault();
    let formElem = document.getElementById("update_profil");
    let formdata = new FormData(formElem);
    fetch("include/js/update_profil.php", {
        method: "POST",
        body: formdata
    })
    .then(response => {
        if(response.ok){
            return response.json();
        } else {
            throw new Error("Erreur lors de la requête.")
        }
    })
    .then(data => {
        switch(data.status){
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
    })
    .catch(error => {
        alert(error.message);
    });
}

function copy_text(id) {
    let val = document.getElementById("input_password"+id).value;
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
    fetch("include/js/add_password.php", {
        method : "POST",
        body : formdata
    })
    .then(response => {
        if(response.ok){
            return response.json();
        } else {
            throw new Error("Erreur lors de la requête.");
        }
    })
    .then(data => {
        if(data.status === 'success'){
            let size_tab = document.getElementById("size_tab_paswword");
            size_tab.value = parseInt(size_tab.value) + 1;
            display_see_password();
        } else {
            alert("C'est information son déjà enregistrer");
        }
    })
    .catch(error => {
        alert(error.message);
    });
}

function display_add_password() {
    document.getElementById("card_tool").style.display = "";
    fetch("include/js/display_add_password.php", {
        method: "POST",
    })
    .then(response =>{
        if(response.ok){
            return response.text();
        } else {
            throw new Error("Erreur lors de la requête.");
        }
    })
    .then(data => {
        document.getElementById("card_display_tool").innerHTML = data;
    })
}

function display_see_password() {
    let size_tab = document.getElementById("size_tab_paswword").value;
    if(size_tab != "0"){
        fetch("include/js/display_see_password.php", {
            method: "POST",
        })
        .then(response =>{
            if(response.ok){
                return response.text();
            } else {
                throw new Error("Erreur lors de la requête.");
            }
        })
        .then(data => {
            document.getElementById("card_display_tool").innerHTML = data;
        })
        .catch(error => {
            alert(error.message);
        });
    } else {
        document.getElementById("card_tool").style.display = "none";
    }
}

function display_see_password_search() {
    let size_tab = document.getElementById("size_tab_paswword").value;
    if(size_tab != "0"){
        let selected_value = document.getElementById("pass_search").value;
        let formdata = new FormData();
        formdata.append("search", selected_value);
        fetch("include/js/display_see_password_search.php", {
            method : "POST",
            body : formdata
        })
        .then(response => {
            if(response.ok){
                return response.text();
            } else {
                throw new Error("Erreur lors de la requête.");
            }
        })
        .then(data => {
            document.getElementById("card_display_tool").innerHTML = data;
            document.getElementById("search_ok").value = "1";
        })
        .catch(error => {
            alert(error.message);
        })
    } else {
        document.getElementById("card_tool").style.display = "none";
    }
}

function delet_password(id) {
    if(confirm("Est te vous sur de vouloir supprimer votre mot de passe")) {
        let formdata = new FormData();
        formdata.append("id", id);
        fetch("include/js/delet_password.php", {
            method : "POST",
            body : formdata
        })
        .then(response => {
            if(response.ok){
                return response.json();
            } else {
                return new Error("Erreur lors de la requête.");
            }
        })
        .then(data => {
            if(data.status === 'success'){
                let size_tab = document.getElementById("size_tab_paswword");
                size_tab.value = parseInt(size_tab.value) - 1;
                display_see_password();
            } else {
                alert("Il y a eu une erreur lors de la suppression de votre mot de passe.");
            }
        })
        .catch(error => {
            alert(error.message);
        });
    }
}

function dispay_edit(id) {
    document.getElementById("img_copy_button"+ id).className = "img_edit";
    document.getElementById("img_copy_button"+ id).src = "./dist/img/icon/edit.svg";
    document.getElementById("copy_button"+ id).className = "btn btn-outline-success edit_button";
    document.getElementById("copy_button"+ id).setAttribute("onclick", "edit_password("+ id +")");

    document.getElementById("img_delete_button"+ id).className = "img_back";
    document.getElementById("img_delete_button"+ id).src = "./dist/img/icon/back.png";
    document.getElementById("delete_button"+ id).className = "btn btn-outline-danger back_button";
    document.getElementById("delete_button"+ id).setAttribute("onclick", "return_view()");
}

function return_view() {
    const search =document.getElementById("search_ok").value;
    if(search != "0") {
        display_see_password_search();
    } else {
        display_see_password();
    }
}

function edit_password(id){
    if(confirm("Est te vous sur de vouloir modifier votre mot de passe ou votre adresse e-mail")) {
        let edit_email = document.getElementById("input_email"+ id).value;
        let edit_password = document.getElementById("input_password"+ id).value;
        let formdata = new FormData();
        formdata.append("id", id);
        formdata.append("edit_email", edit_email);
        formdata.append("edit_password", edit_password);
        fetch("include/js/edit_password.php", {
            method : "POST",
            body : formdata
        })
        .then(response => {
            if(response.ok){
                return response.json();
            } else {
                throw new Error("Erreur lors de la requête.");
            }
        }).then(data => {
            if(data.status === 'success'){
                return_view();
            } else {
                alert("Un problème est survenu, veuillez réessayer plus tard");
            }
        })
        .catch(error => {
            alert(error.message);
        })
    }
}

function display_see_password_search_event(event) {
    if (event.keyCode === 13) {
        display_see_password_search();
    }
}