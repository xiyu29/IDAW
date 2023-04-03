const API_BASE_URL = "http://localhost/Projet_Antoine_Xi/backend/api.php";

//index.php -> button 'se connecter'
function connexion() {
    event.preventDefault();

    let login = $("#login").val();
    let mdp = $("#mdp").val();

    const params = new URLSearchParams();
    params.append('login', login);
    params.append('mdp', mdp);
    params.append('type', 'connexion');
<<<<<<< HEAD

    const url = API_BASE_URL + `/data?${params.toString()}`;
=======
    const path = 'http://localhost/Xi_Antoine/IDAW/Projet_Antoine_Xi/'
    const url = path + `api.php/data?${params.toString()}`;
    console.log(url);
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044

    fetch(url)
        .then(response => response.json())
        .then(data => {
            function success(data) {
                //get id correspondant
                let id = data[0].Id_personne;
                console.log(id);
                //set session
                sessionStorage.setItem('userId', id);
                const sessionId = sessionStorage.getItem('userId');
                window.location.href = path + "frontend/homePage.php";
            }
            success(data);
        })
        .catch(error => {
            function failed() {
                alert("Veuillez saisir le login et/ou le mot de passe correctement!");
            }
            failed();
        });

    //clear all
    document.getElementById("login").value = "";
    document.getElementById("mdp").value = "";
}

//insert username in homePage.php
function getSession() {
    const sessionId = sessionStorage.getItem('userId');
    const params = new URLSearchParams();
    params.append('id', sessionId);
    params.append('type', 'getName');
<<<<<<< HEAD
    const url = API_BASE_URL + `/data?${params.toString()}`;
=======
    const url = path + `backend/api.php/data?${params.toString()}`;
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044
    fetch(url)
        .then(response => response.json())
        .then(data => {
            function success(data) {
                //get prenom correspondant
                let prenom = data[0].Prenom_personne;
                let userSessionDiv = document.getElementById("userSession");
                let p = document.createElement("p");
                p.textContent = "Hello, " + prenom;//inversement du nom/prénom pour les utilisateurs entrés manuellements sinon tout ok
                userSessionDiv.appendChild(p);
            }
            success(data);
        })
        .catch(error => console.log(error));
}

//creation de compte
function insertUser() {
    event.preventDefault();

    let login = $("#login").val();
    let mdp = $("#mdp").val();
    let nom = $("#nom").val();
    let prenom = $("#prenom").val();
    let email = $("#email").val();

    if (login && mdp && nom && prenom && email) {
        $.ajax({
<<<<<<< HEAD
            url: API_BASE_URL,
=======
            url: path + "backend/api.php",
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044
            method: "POST",
            data: JSON.stringify({
                nom: nom,
                prenom: prenom,
                email: email,
                login: login,
                mdp: mdp,
                type: 'newUser',
            }),
            dataType: "json",
<<<<<<< HEAD
            success: function(data) {
                alert("Création réussite! Veuillez mettre à jour votre profil.");
                window.location.href = "http://localhost/Projet_Antoine_Xi/frontend/index.php";
=======
            success: function (data) {
                alert("Création réussite!");
                window.location.href =  path + "frontend/index.php";
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    else {
        alert("Veuillez entrer tous les champs demandés, merci!");
    }

    //clear all
    document.getElementById("login").value = "";
    document.getElementById("mdp").value = "";
    document.getElementById("nom").value = "";
    document.getElementById("prenom").value = "";
    document.getElementById("email").value = "";
}

//show 5 first meals
async function showMeal() {
    const sessionId = sessionStorage.getItem('userId');
    const params = new URLSearchParams();
    params.append('id', sessionId);
    params.append('type', 'getMeal');
<<<<<<< HEAD
    const url = API_BASE_URL + `/data?${params.toString()}`;
=======
    const url = path + `backend/api.php/data?${params.toString()}`;
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044
    const response = await fetch(url);
    const data = await response.json();
    for (let i = 0; i < data.length; i++) {
        let date_conso = data[i].Date_conso;
        let quantite = data[i].Quantite;
        const params = new URLSearchParams();
        params.append('id_aliment', data[i].Id_aliment);
        params.append('type', 'getNourriture');
<<<<<<< HEAD
        const url = API_BASE_URL + `/data?${params.toString()}`;
=======
        const url = path `backend/api.php/data?${params.toString()}`;
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044
        const response = await fetch(url);
        const nourritureData = await response.json();
        let nomAliment = nourritureData[0].nomAliment;
        $("#nourritureBody").append(`
            <tr>
                <td width="150px">` + date_conso + `</td>
                <td width="400px">` + nomAliment + `</td>
                <td width="150px">` + quantite + `</td>
            </tr>
        `);
    }
<<<<<<< HEAD
}

//show all nourritures
function showAllNourriture() {
    // event.preventDefault();
    $.ajax({
        url: API_BASE_URL + '/data?type=getAllNourriture',
        method: "GET",
        success: function(data) {
            for(const element in data){
                const idAliment = data[element].idAliment;
                const nomAliment = data[element].nomAliment;
                const typeAliment = data[element].type;
                
                $("#allNourritureBody").append(`
                <tr>
                    <td width="100px">` + idAliment + `</td>
                    <td width="800px">` + nomAliment + `</td>
                    <td width="600px">` + typeAliment + `</td>
                </tr>
                `);
            }
            $(document).ready(function() {
                $('#tableAllNourriture').DataTable({
                    paging: true,
                    pageLength: 15, 
                    lengthChange: false, 
                });
            });
        },
        error: function(error) {
            console.log(error);
        }
    });   
}

//affichage de son profil
function showProfil(){
    document.getElementById("titreProfil").innerHTML = "Mon profil";
    const sessionId = sessionStorage.getItem('userId');
    console.log(sessionId);
    $.ajax({
        url: API_BASE_URL + '/data?type=getUser&id=' + sessionId,
        method: "GET",
        success: function(data) {
            const nom = data[0].Nom_personne === null ? 'NULL' : data[0].Nom_personne;
            const prenom = data[0].Prenom_personne === null ? 'NULL' : data[0].Prenom_personne;
            const sport = data[0].Niveau_sport === null ? 'NULL' : data[0].Niveau_sport;
            const age = data[0].Tranche_age === null ? 'NULL' : data[0].Tranche_age;
            const sexe = data[0].Sexe === null ? 'NULL' : data[0].Sexe;
            const taille = data[0].Taille === null ? 'NULL' : data[0].Taille;
            const poids = data[0].Poids === null ? 'NULL' : data[0].Poids;
            const email = data[0].Email_personne === null ? 'NULL' : data[0].Email_personne;

            document.getElementById("nomProfil").innerHTML = nom;
            document.getElementById("prenomProfil").innerHTML = prenom;
            document.getElementById("sportProfil").innerHTML = sport;
            document.getElementById("sexeProfil").innerHTML = sexe;
            document.getElementById("ageProfil").innerHTML = age;
            document.getElementById("tailleProfil").innerHTML = taille;
            document.getElementById("poidsProfil").innerHTML = poids;
            document.getElementById("emailProfil").innerHTML = email;

            console.log(email);
        },
        error: function(error) {
            console.log(error);
        }
    });   
}

//remplir les trucs pour modifier son profil
function inputProfil(){
    document.getElementById("titreProfil").innerHTML = "Mon profil";
    const sessionId = sessionStorage.getItem('userId');
    console.log(sessionId);
    $.ajax({
        url: API_BASE_URL + '/data?type=getUser&id=' + sessionId,
        method: "GET",
        success: function(data) {
            const nom = data[0].Nom_personne === null ? 'NULL' : data[0].Nom_personne;
            const prenom = data[0].Prenom_personne === null ? 'NULL' : data[0].Prenom_personne;
            const sport = data[0].Niveau_sport === null ? 'NULL' : data[0].Niveau_sport;
            const age = data[0].Tranche_age === null ? 'NULL' : data[0].Tranche_age;
            const sexe = data[0].Sexe === null ? 'NULL' : data[0].Sexe;
            const taille = data[0].Taille === null ? 'NULL' : data[0].Taille;
            const poids = data[0].Poids === null ? 'NULL' : data[0].Poids;
            const email = data[0].Email_personne === null ? 'NULL' : data[0].Email_personne;

            document.getElementById("inputNom").innerHTML = '<input type="text" class="inputText posr-meta" value="' + nom + '" id="newNom"></input>';
            document.getElementById("inputPrenom").innerHTML = '<input type="text" class="inputText posr-meta" value="' + prenom + '" id="newPrenom"></input>';
            document.getElementById("inputSport").innerHTML = `<select id="newSport" name="sport" class="selectStyle">
                                                                    <option value="bas">bas</option>
                                                                    <option value="moyen">moyen</option>
                                                                    <option value="élevé">élevé</option>
                                                                    <option value="profession">profession</option>
                                                                </select>`;
            document.getElementById("inputAge").innerHTML = `<select id="newAge" name="age" class="selectStyle">
                                                                <option value="<40"><40</option>
                                                                <option value="40<âge<60">40<âge<60</option>
                                                                <option value="60+">60+</option>
                                                            </select>`;
            document.getElementById("inputSexe").innerHTML = `<select id="newSexe" name="sexe" class="selectStyle">
                                                                <option value="H">H</option>
                                                                <option value="F">F</option>
                                                            </select>`;
            document.getElementById("inputTaille").innerHTML = '<input type="text" class="inputText posr-meta" value="' + taille + '" id="newTaille"></input>';
            document.getElementById("inputPoids").innerHTML = '<input type="text" class="inputText posr-meta" value="' + poids + '" id="newPoids"></input>';
            document.getElementById("inputEmail").innerHTML = '<input type="text" class="inputText posr-meta" value="' + email + '" id="newEmail"></input>';

            console.log(email);
        },
        error: function(error) {
            console.log(error);
        }
    });   
}

//confirmation de la modification
function confirmModification(){
    const id = sessionStorage.getItem('userId');
    var newNom = document.getElementById("newNom").value;
    var newPrenom = document.getElementById("newPrenom").value;
    var newSport = document.getElementById("newSport").value;
    var newAge = document.getElementById("newAge").value;
    var newSexe = document.getElementById("newSexe").value;
    var newTaille = document.getElementById("newTaille").value;
    var newPoids = document.getElementById("newPoids").value;
    var newEmail = document.getElementById("newEmail").value;

    $.ajax({
        url: API_BASE_URL + '/data?type=updateProfil',
        method: "PUT",
        data: JSON.stringify({
            type: 'updateProfil',
            id: id,
            newNom: newNom,
            newPrenom: newPrenom,
            newSport: newSport,
            newAge: newAge,
            newSexe: newSexe,
            newTaille: newTaille,
            newPoids: newPoids,
            newEmail: newEmail,
        }),
        dataType: "json",
        success: function() {
            alert("Modification réussite!");
            window.location.href = "http://localhost/Projet_Antoine_Xi/frontend/profil.php";
        },
        error: function(error) {
            console.log(error);
        }
    });
}

//modification de mdp
function modificationMdp(){
    var nouveauMdp = document.getElementById("nouveauMdp").value;
    var confirmationNouveauMdp = document.getElementById("confirmationNouveauMdp").value;
    
    const id = sessionStorage.getItem('userId');
    
    if(nouveauMdp == confirmationNouveauMdp){
        $.ajax({
            url: API_BASE_URL,
            method: "PUT",
            data: JSON.stringify({
                type: 'updateMdp',
                id: id,
                nouveauMdp: nouveauMdp,
            }),
            dataType: "json",
            success: function() {
                alert("Modification réussite!");
                window.location.href = "http://localhost/Projet_Antoine_Xi/frontend/profil.php";
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    else{
        alert("Veuillez saisir le même mot de passe!");
    }
=======
>>>>>>> fcc8610b8b2e822b53e5720f26f4f9d4dd017044
}