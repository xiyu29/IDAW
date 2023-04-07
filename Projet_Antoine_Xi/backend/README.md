Description de l'API
Cette API fournit des endpoints pour effectuer les tâches suivantes :

Connexion utilisateur
Récupération du nom d'utilisateur par son ID
Récupération des repas consommés par l'utilisateur
Récupération d'une nourriture par son ID
Récupération de toutes les nourritures
Récupération des informations de l'utilisateur
Récupération des nutriments d'un aliment par son ID
Récupération de l'énergie d'un aliment par son ID
Création d'un nouvel utilisateur
Ajout d'un nouveau repas
Endpoints
GET /api.php?type=connexion&login=xxx&mdp=xxx : Connexion de l'utilisateur avec son nom d'utilisateur et son mot de passe.

GET /api.php?type=getName&id=xxx : Récupération du nom d'utilisateur par son ID.

GET /api.php?type=getMeal&id=xxx : Récupération des repas consommés par l'utilisateur, triés par date de consommation.

GET /api.php?type=getNourriture&id_aliment=xxx : Récupération d'une nourriture par son ID.

GET /api.php?type=getAllNourriture : Récupération de toutes les nourritures.

GET /api.php?type=getUser&id=xxx : Récupération des informations de l'utilisateur par son ID.

GET /api.php?type=getNutriment&id=xxx : Récupération des nutriments d'un aliment par son ID.

GET /api.php?type=getEnergie&id_aliment=xxx : Récupération de l'énergie d'un aliment par son ID.

POST /api.php : Création d'un nouvel utilisateur ou ajout d'un nouveau repas :

DELETE /api.php : Suppression d'un utilisateur ou d'un repas :

Pour créer un nouvel utilisateur : utilisez un objet JSON avec les propriétés type, nom, prenom, login, mdp et email. La propriété type doit être newUser.
Pour ajouter un nouveau repas : utilisez un objet JSON avec les propriétés type, Id_personne, Id_aliment, Date_conso et Quantite. La propriété type doit être newRepas.
PUT /api.php : Modification des informations de l'utilisateur :

Utilisez un objet JSON avec les propriétés type, id, newNom, newPrenom, newSport, newAge, newSexe, newTaille, newPoids et newEmail. La propriété type doit être updateProfil.
