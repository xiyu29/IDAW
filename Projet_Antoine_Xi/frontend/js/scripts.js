const API_BASE_URL = "http://localhost/Projet_Antoine_Xi/backend/api.php";
const path = "http://localhost/Projet_Antoine_Xi/";


//index.php -> button 'se connecter'
function connexion() {
    event.preventDefault();

    let login = $("#login").val();
    let mdp = $("#mdp").val();

    const params = new URLSearchParams();
    params.append('login', login);
    params.append('mdp', mdp);
    params.append('type', 'connexion');

    console.log(API_BASE_URL);

    const url = API_BASE_URL + `/data?${params.toString()}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            function success(data) {
                //get id correspondant
                let id = data[0].Id_personne;
                //set session
                sessionStorage.setItem('userId', id);
                console.log(path);
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
    const url = API_BASE_URL + `/data?${params.toString()}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            function success(data) {
                //get prenom correspondant
                let prenom = data[0].Prenom_personne;
                let userSessionDiv = document.getElementById("userSession");
                let p = document.createElement("p");
                p.textContent = "Hello, " + prenom;//inversement du nom/prénom pour les utilisateurs entrés manuellements sinon tout ok
                if(p != null){
                    userSessionDiv.appendChild(p);
                }  
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
            url: API_BASE_URL,
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
                alert("Création réussite! Veuillez mettre à jour votre profil.");
                window.location.href = path + "frontend/index.php";
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

//show all meals
async function showMeal() {
    const sessionId = sessionStorage.getItem('userId');
    const params = new URLSearchParams();
    params.append('id', sessionId);
    params.append('type', 'getMeal');
    const url = API_BASE_URL + `/data?${params.toString()}`;
    const response = await fetch(url);
    const data = await response.json();
    for (let i = 0; i < data.length; i++) {
        let date_conso = data[i].Date_conso;
        let quantite = data[i].Quantite;
        const params = new URLSearchParams();
        params.append('id_aliment', data[i].Id_aliment);
        params.append('type', 'getNourriture');
        const url = API_BASE_URL + `/data?${params.toString()}`;
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

//show all nourritures
// function showAllNourriture() {
//     // event.preventDefault();
//     $.ajax({
//         url: API_BASE_URL + '/data?type=getAllNourriture',
//         method: "GET",
//         success: function (data) {
//             for (const element in data) {
//                 const idAliment = data[element].idAliment;
//                 const nomAliment = data[element].nomAliment;
//                 const typeAliment = data[element].type;

//                 $("#allNourritureBody").append(`
//                 <tr>
//                     <td width="100px">` + idAliment + `</td>
//                     <td width="800px">` + nomAliment + `</td>
//                     <td width="600px">` + typeAliment + `</td>
//                 </tr>
//                 `);
//             }
//             $(document).ready(function () {
//                 $('#tableAllNourriture').DataTable({
//                     paging: true,
//                     pageLength: 15,
//                     lengthChange: false,
//                 });
//             });
//         },
//         error: function (error) {
//             console.log(error);
//         }
//     });
// }

//affichage de son profil
function showProfil() {
    document.getElementById("titreProfil").innerHTML = "Mon profil";
    const sessionId = sessionStorage.getItem('userId');
    console.log(sessionId);
    $.ajax({
        url: API_BASE_URL + '/data?type=getUser&id=' + sessionId,
        method: "GET",
        success: function (data) {
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
        error: function (error) {
            console.log(error);
        }
    });
}

//remplir les trucs pour modifier son profil
function inputProfil() {
    document.getElementById("titreProfil").innerHTML = "Mon profil";
    const sessionId = sessionStorage.getItem('userId');
    console.log(sessionId);
    $.ajax({
        url: API_BASE_URL + '/data?type=getUser&id=' + sessionId,
        method: "GET",
        success: function (data) {
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

            let select = document.getElementById('newAge');
            let options = select.querySelectorAll('option');
            let selectBox = document.getElementById("newAge");
            for (let i = 0; i < selectBox.options.length; i++) {
                const option = selectBox.options[i];
                if (option.value === age) {
                    option.selected = true;
                    break;
                }
            }

            select = document.getElementById('newSport');
            options = select.querySelectorAll('option');
            selectBox = document.getElementById("newSport");
            for (let i = 0; i < selectBox.options.length; i++) {
                const option = selectBox.options[i];
                if (option.value === sport) {
                    option.selected = true;
                    break;
                }
            }

            select = document.getElementById('newSexe');
            options = select.querySelectorAll('option');
            selectBox = document.getElementById("newSexe");
            for (let i = 0; i < selectBox.options.length; i++) {
                const option = selectBox.options[i];
                if (option.value === sexe) {
                    option.selected = true;
                    break;
                }
            }

            console.log(email);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//confirmation de la modification
function confirmModification() {
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
        success: function () {
            alert("Modification réussite!");
            window.location.href = path + "frontend/profil.php";
        },
        error: function (error) {
            console.log(error);
        }
    });
}

//modification de mdp
function modificationMdp() {
    var nouveauMdp = document.getElementById("nouveauMdp").value;
    var confirmationNouveauMdp = document.getElementById("confirmationNouveauMdp").value;

    const id = sessionStorage.getItem('userId');

    if (nouveauMdp == confirmationNouveauMdp) {
        $.ajax({
            url: API_BASE_URL,
            method: "PUT",
            data: JSON.stringify({
                type: 'updateMdp',
                id: id,
                nouveauMdp: nouveauMdp,
            }),
            dataType: "json",
            success: function () {
                alert("Modification réussite!");
                window.location.href = path + "frontend/profil.php";
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
    else {
        alert("Veuillez saisir le même mot de passe!");
    }
}

//affichage de pourcentage de chaque nutriment dans un nourriture
function showPourcentage(idAliment){

    $.ajax({
        url: API_BASE_URL + '/data?type=getNutriment&id=' + idAliment,
        method: "GET",
        success: function(data) {
            console.log(data);
            const Eau = data[0].Eau;
            const Protéines = data[0].Protéines;
            const Glucides = data[0].Glucides;
            const Lipides = data[0].Lipides;
            const Sucres = data[0].Sucres;
            const Fructose = data[0].Fructose;
            const Galactose = data[0].Galactose;
            const Glucose = data[0].Glucose;
            const Lactose = data[0].Lactose;
            const Maltose = data[0].Maltose;
            const Saccharose = data[0].Saccharose;
            const Amidon = data[0].EAmidon;
            const FibresAlimentaires = data[0].FibresAlimentaires;
            const autres = 100 - Eau - Protéines - Glucides - Lipides - Sucres - Fructose - Galactose - Glucose - Lactose - Maltose - Saccharose - Amidon - FibresAlimentaires;  

            //show graphe 
            const chartData = {
                labels: ['Eau', 'Protéines', 'Glucides', 'Lipides', 'Sucres', 'Fructose', 'Galactose', 'Glucose', 'Lactose', 'Maltose', 'Saccharose', 'Amidon', 'Fibres alimentaires', 'autres'],
                datasets: [{
                    label: 'Nutriments',
                    data: [Eau,Protéines,Glucides,Lipides,Sucres,Fructose,Galactose,Glucose,Lactose,Maltose,Saccharose,Amidon,FibresAlimentaires,autres],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.3)',
                        'rgba(54, 162, 235, 0.3)',
                        'rgba(255, 206, 86, 0.3)',
                        'rgba(75, 192, 192, 0.3)',
                        'rgba(153, 102, 255, 0.3)',
                        'rgba(255, 159, 64, 0.3)',
                        'rgba(255, 0, 0, 0.3)',
                        'rgba(0, 255, 0, 0.3)',
                        'rgba(0, 0, 255, 0.3)',
                        'rgba(255, 255, 0, 0.3)',
                        'rgba(255, 0, 255, 0.3)',
                        'rgba(0, 255, 255, 0.3)',
                        'rgba(128, 0, 0, 0.3)',
                        'rgba(0, 128, 0, 0.3)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 0, 0, 1)',
                        'rgba(0, 255, 0, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(255, 0, 255, 1)',
                        'rgba(0, 255, 255, 1)',
                        'rgba(128, 0, 0, 1)',
                        'rgba(0, 128, 0, 1)',
                    ],
                    borderWidth: 1
                }]
            };

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Pourcentage(g/100g)'
                        }
                    }
                },
            });
        },
        error: function(error) {
            console.log(error);
        }
    }); 
    
}

async function ajoutRepas() {
    // Récupérer la liste des aliments
    const response = await fetch(API_BASE_URL + '/data?type=getNourriture');
    const nourritureData = await response.json();

    // Créer le formulaire
    const form = document.createElement('form');

    // Champ date
    const dateLabel = document.createElement('label');
    dateLabel.textContent = 'Date : ';
    const dateSelect = document.createElement('select');
    for (let i = 0; i < 7; i++) {
        const date = new Date();
        date.setDate(date.getDate() - i);
        const option = document.createElement('option');
        option.value = date.toISOString().slice(0, 10);
        option.textContent = date.toLocaleDateString();
        dateSelect.appendChild(option);
    }
    form.appendChild(dateLabel);
    form.appendChild(dateSelect);
    form.appendChild(document.createElement('br'));

    // Champ nourriture
    const nourritureLabel = document.createElement('label');
    nourritureLabel.textContent = 'Nourriture : ';
    const nourritureSelect = document.createElement('select');
    for (let i = 0; i < nourritureData.length; i++) {
        const option = document.createElement('option');
        option.value = nourritureData[i].Id_aliment;
        option.textContent = nourritureData[i].nomAliment;
        nourritureSelect.appendChild(option);
    }
    form.appendChild(nourritureLabel);
    form.appendChild(nourritureSelect);
    form.appendChild(document.createElement('br'));

    // Champ quantité
    const quantiteLabel = document.createElement('label');
    quantiteLabel.textContent = 'Quantité : ';
    const quantiteInput = document.createElement('input');
    quantiteInput.type = 'number';
    quantiteInput.min = 0;
    quantiteInput.step = 0.1;
    quantiteInput.required = true;
    form.appendChild(quantiteLabel);
    form.appendChild(quantiteInput);
    form.appendChild(document.createElement('br'));

    // Bouton soumettre
    const submitButton = document.createElement('button');
    submitButton.type = 'submit';
    submitButton.textContent = 'Ajouter';
    form.appendChild(submitButton);

    // Ajouter le formulaire à la page
    const repasDiv = document.getElementById('newRepas');
    repasDiv.insertAdjacentElement('afterend', form);

    // Soumettre le formulaire
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const date = dateSelect.value;
        const nourritureId = nourritureSelect.value;
        const quantite = parseFloat(quantiteInput.value);

        // Créer un objet avec les valeurs à envoyer
        const repas = {
            date: date,
            nourritureId: nourritureId,
            quantite: quantite
        };

        // Convertir l'objet en chaîne de caractères JSON
        const repasJson = JSON.stringify(repas);

        // Envoyer la requête pour ajouter le repas
        const sessionId = sessionStorage.getItem('userId');
        const url = API_BASE_URL + '/data?type=addRepas';
        const response = await fetch(url, {
            method: 'POST',
            body: repasJson,
            headers: {
                'Content-Type': 'application/json'
            }
        });
        const data = await response.json();

        // Afficher le nouveau repas
        $("#nourritureBody").prepend(`
      <tr>
        <td width="150px">` + date + `</td>
          <td width="150px">` + nourritureData[nourritureId - 1].nomAliment + `</td>
          <td width="150px">` + quantite + `</td>
      </tr>
      `);
    });

}

// //show all repas
// async function showAllRepas() {
//     const sessionId = sessionStorage.getItem('userId');
//     const params = new URLSearchParams();

//     params.append('id', sessionId);
//     params.append('type', 'getMeal');

//     const url = API_BASE_URL + `/data?${params.toString()}`;
//     const response = await fetch(url);
//     const data = await response.json();

//     console.log(data);

//     const table = $('#tableRepas').DataTable();

//     for (let i = 0; i < data.length; i++) {
//         let date_conso = data[i].Date_conso;
//         let quantite = data[i].Quantite;

//         const params = new URLSearchParams();
//         params.append('id_aliment', data[i].Id_aliment);
//         params.append('type', 'getNourriture');

//         const url = API_BASE_URL + `/data?${params.toString()}`;
//         const response = await fetch(url);
//         const nourritureData = await response.json();
        
//         let nomAliment = nourritureData[0].nomAliment;

//         const Params = new URLSearchParams();
//         Params.append('id_aliment', data[i].Id_aliment);
//         Params.append('type', 'getEnergie');

//         const Url = API_BASE_URL + `/data?${Params.toString()}`;
//         const Response = await fetch(Url);
//         const NourritureData = await Response.json();
//         // console.log(NourritureData);
//         let energieAliment = NourritureData[0].Energie;
//         let energie = energieAliment * quantite / 100;
        
//         table.row.add([date_conso, nomAliment, quantite, energie]).draw();

//         //merge avec l'energie
//         data[i].Energie = energie;

//         const ctx = document.getElementById('myCalorie').getContext('2d');
//         const chart = new Chart(ctx, {
//             type: 'line',
//             data: {
//             labels: data.map(item => item.Date_conso),
//             datasets: [{
//                 label: '数量',
//                 data: data.map(item => item.Energie),
//                 borderColor: 'rgb(255, 99, 132)',
//             }]
//             },
//         });

//         chart.update();
//     }
// }

async function showAllRepas() {
    const sessionId = sessionStorage.getItem('userId');
    const params = new URLSearchParams();

    params.append('id', sessionId);
    params.append('type', 'getMeal');

    const url = API_BASE_URL + `/data?${params.toString()}`;
    const response = await fetch(url);
    const data = await response.json();

    const table = $('#tableRepas').DataTable();

    for (let i = 0; i < data.length; i++) {
        let date_conso = data[i].Date_conso;
        let quantite = data[i].Quantite;

        const params = new URLSearchParams();
        params.append('id_aliment', data[i].Id_aliment);
        params.append('type', 'getNourriture');

        const url = API_BASE_URL + `/data?${params.toString()}`;
        const response = await fetch(url);
        const nourritureData = await response.json();
        
        let nomAliment = nourritureData[0].nomAliment;

        const Params = new URLSearchParams();
        Params.append('id_aliment', data[i].Id_aliment);
        Params.append('type', 'getEnergie');

        const Url = API_BASE_URL + `/data?${Params.toString()}`;
        const Response = await fetch(Url);
        const NourritureData = await Response.json();
        // console.log(NourritureData);
        let energieAliment = NourritureData[0].Energie;
        let energie = parseFloat(energieAliment * quantite / 100);
        
        table.row.add([date_conso, nomAliment, quantite, energie]).draw();

        //merge avec l'energie
        data[i].Energie = energie;
    }

    //regrouper les energies consommees par jour
    const repasByDate = data.reduce((acc, obj) => {
        const date = obj.Date_conso;
        if (!acc[date]) {
            acc[date] = [];
        }
        acc[date].push(obj);
        return acc;
        }, {});
        
        //calcul de la somme d'energie consommee par jour
        const dateEnergie = Object.keys(repasByDate).map(date => {
        const repas = repasByDate[date];
        const totalEnergie = repas.reduce((sum, obj) => sum + parseFloat(obj.Energie), 0.0);
        return { Date_conso: date, Energie: totalEnergie };
        });
        
        //new arry qui contient que la date_conso et l'energie consommee en total
        console.log(dateEnergie);

    console.log(data);

    const lastSevenData = dateEnergie.slice(0,7).reverse();
    const chartData = lastSevenData.length >= 7 ? lastSevenData : dateEnergie.slice().reverse();

    const ctx = document.getElementById('myCalorie').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(item => item.Date_conso),
            datasets: [{
                label: 'Energie/kj',
                data: chartData.map(item => item.Energie),
                borderColor: 'rgb(255, 99, 132)',
            }]
        },
    });

    chart.update();
}

//partie page showAliments
function getAllAliments(){
    $.ajax({
        url: API_BASE_URL + '/data?type=getAllFood',
        method: "GET",
        success: function (data) {
            console.log(data);
            const table = $('#tableAliments').DataTable();
            table.clear();
            table.rows.add(data);
            table.draw();
        },
        error: function (error) {
            console.log(error);
        }
    });

    const table = $('#tableAliments').DataTable({
        "columns": [
            { "data": "id", "width": "50px" },
            { "data": "nomAliment", "width": "400px" },
            { "data": "type", "width": "150px" },
            { "width": "50px" },
            { "width": "50px" },
            { "width": "50px" }
        ],
        "columnDefs": [
            { "orderable": false, "targets": [3, 4, 5] },
            { "orderable": false, "targets": 0 }
        ],
        "pageLength": 5,
        "lengthChange": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
        },
        "columns": [
            { "data": "idAliment" },
            { "data": "nomAliment" },
            { "data": "type" },
            {
                "render": function (data, type, row, meta) {
                    return '<button type="button" class="btn" onclick="remplirAliment(' + row.idAliment + ')">Modifier</button>';
                }
            },
            {
                "render": function (data, type, row, meta) {
                    return '<button type="button" class="btn" onclick="deleteAliment(' + row.idAliment + ')">Supprimer</button>';
                }
            },
            {
                "render": function (data, type, row, meta) {
                    return '<button type="button" class="btn" onclick="goPourcentagePage(' + row.idAliment + ')">Détailles</button>';
                }
            }
        ]
    });
}

//partie ajout aliment
function goPourcentagePage(id) {
    window.location.href = path + "frontend/nutrimentPourcentage.php?id=" + id;
}

function getAllType(){
    $.ajax({
        url: API_BASE_URL + '/data?type=getAllType' ,
        type: "GET",
        success: function (data) {
            console.log(data);
            var options = '';
            $.each(data, function (index, value) {
                options += '<option value="' + value.Nom_type + '">' + value.Nom_type + '</option>';                    
            });
            $('#type').append(options);
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function addAliment() {
    // prevent the form to be sent to the server
    event.preventDefault();
    let nomAliment = $("#nom").val();
    let type = $("#type").val();
    //connvertir le tableau en JSON
    $.ajax({
        url: API_BASE_URL,
        method: "POST",
        data: JSON.stringify({
            type: 'newAliment',
            nomAliment: nomAliment,
            typeAliment: type,
        }),
        dataType: "json",
        success: function () {
            window.location.href = path + "frontend/showAliment.php";
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function deleteAliment(id){
    event.preventDefault();
    $.ajax({
        url: API_BASE_URL,
        method: "DELETE",
        data: JSON.stringify({
            type: 'deleteAliment',
            id: id,
        }),
        dataType: "json",
        success: function () {
            alert("Aliment supprimé!")
            window.location.href = path + "frontend/showAliment.php";
        },
        error: function (error) {
            alert("Cet aliment est déjà consommé, vous ne pouvez pas le supprimer pour l'instant!");
            window.location.href = path + "frontend/showAliment.php";    
        }
    });
}

function remplirAliment(id){
    event.preventDefault();
    $.ajax({
        url: API_BASE_URL + '/data?type=getAlimentInfo&id_aliment=' + id,
        method: "GET",
        success: function (data) {
            document.getElementById("nom").value=data[0].nomAliment;
        },
        error: function (error) {
            console.log(error);  
        }
    });
    var buttonArea = document.getElementById("buttonArea");
    buttonArea.innerHTML = "<button onclick='modifierAliment(" + id + ")' class='btn btn-primary' id='newButton'>Modifier</button>";
}

function modifierAliment(id){
    event.preventDefault();
    let nouveauNom = $("#nom").val();
    let nouveauType = $("#type").val();
    $.ajax({
        url: API_BASE_URL,
        method: "PUT",
        data: JSON.stringify({
            type: 'updateAliment',
            id: id,
            nouveauNom: nouveauNom,
            nouveauType: nouveauType,
        }),
        dataType: "json",
        success: function () {
            alert("Aliment modifié!")
            window.location.href = path + "frontend/showAliment.php";
        },
        error: function (error) {
            alert("Cet aliment est déjà consommé, vous ne pouvez pas le modifier pour l'instant!");
            window.location.href = path + "frontend/showAliment.php";    
        }
    });
}

