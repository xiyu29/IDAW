//index -> button 'se connecter'
function connexion(){
    event.preventDefault();

    let login = $("#login").val();
    let mdp = $("#mdp").val();

    const params = new URLSearchParams();
    params.append('login', login);
    params.append('mdp', mdp);
    params.append('type', 'connexion');

    const url = `http://localhost/Projet_Antoine_Xi/backend/api.php/data?${params.toString()}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            function success(data){
            //get id correspondant
                let id = data[0].Id_personne;
                console.log(id);
            //set session
                sessionStorage.setItem('userId', id);
                const sessionId = sessionStorage.getItem('userId');
                window.location.href = "http://localhost/Projet_Antoine_Xi/frontend/homePage.php";
            }
            success(data);
        })
        .catch(error => {
            function failed(){
                alert("Veuillez saisir le login et/ou le mot de passe correctement!");
            }
            failed();
        });
    
    document.getElementById("login").value = "";
    document.getElementById("mdp").value = "";
}

//insert username in homePage.php
function getSession(){
    const sessionId = sessionStorage.getItem('userId');
    const params = new URLSearchParams();
    params.append('id', sessionId);
    params.append('type', 'getName');
    const url = `http://localhost/Projet_Antoine_Xi/backend/api.php/data?${params.toString()}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            function success(data){
            //get prenom correspondant
                let prenom = data[0].Prenom_personne;
                let userSessionDiv = document.getElementById("userSession");
                let p = document.createElement("p");
                p.textContent = "Hello, " + prenom;//手动输入的球员nom和prenom写反了
                userSessionDiv.appendChild(p);
            }
            success(data);
        })
        .catch(error => console.log(error));   
}