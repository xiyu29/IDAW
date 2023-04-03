//index.php -> button 'se connecter'
function connexion() {
    event.preventDefault();

    let login = $("#login").val();
    let mdp = $("#mdp").val();

    const params = new URLSearchParams();
    params.append('login', login);
    params.append('mdp', mdp);
    params.append('type', 'connexion');
    const path = 'http://localhost/Xi_Antoine/IDAW/Projet_Antoine_Xi/'
    const url = path + `api.php/data?${params.toString()}`;
    console.log(url);

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
    const url = path + `backend/api.php/data?${params.toString()}`;
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
            url: path + "backend/api.php",
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
            success: function (data) {
                alert("Création réussite!");
                window.location.href =  path + "frontend/index.php";
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
// function showMeal(){
//     //event.preventDefault();
//     const sessionId = sessionStorage.getItem('userId');
//     const params = new URLSearchParams();
//     params.append('id', sessionId);
//     params.append('type', 'getMeal');
//     const url = `http://localhost/Projet_Antoine_Xi/backend/api.php/data?${params.toString()}`;
//     fetch(url)
//         .then(response => response.json())
//         .then(data => {
//             function success(data){
//                 document.getElementById("nourritureBody").innerHTML = "";
//                 // console.log(data);
//                 const length = data.length;
//             //get every information;
//                 for(let i = 0; i < length; i ++){
//                     let date_conso = data[i].Date_conso;
//                     let quantite = data[i].Quantite;
//                     const params = new URLSearchParams();
//                     params.append('id_aliment', data[i].Id_aliment);
//                     params.append('type', 'getNourriture');
//                     console.log(data[i].Id_aliment);
//                     const url = `http://localhost/Projet_Antoine_Xi/backend/api.php/data?${params.toString()}`;
//                     fetch(url)
//                         .then(response => response.json())
//                         .then(data => {
//                             let nomAliment = data[0].nomAliment;
//                             $("#nourritureBody").append(`
//                                 <tr>
//                                     <td width="150px">` + date_conso + `</td>
//                                     <td width="400px">` + nomAliment + `</td>
//                                     <td width="150px">` + quantite + `</td>
//                                 </tr>
//                             `);
//                             console.log(nomAliment + date_conso + quantite);   
//                         })
//                         .catch(error => console.log(error));    
//                 }
//             }
//             success(data);
//         })
//         .catch(error => console.log(error));
// }

async function showMeal() {
    const sessionId = sessionStorage.getItem('userId');
    const params = new URLSearchParams();
    params.append('id', sessionId);
    params.append('type', 'getMeal');
    const url = path + `backend/api.php/data?${params.toString()}`;
    const response = await fetch(url);
    const data = await response.json();
    for (let i = 0; i < data.length; i++) {
        let date_conso = data[i].Date_conso;
        let quantite = data[i].Quantite;
        const params = new URLSearchParams();
        params.append('id_aliment', data[i].Id_aliment);
        params.append('type', 'getNourriture');
        const url = path `backend/api.php/data?${params.toString()}`;
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
}