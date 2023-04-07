# Installation

Aucune installation n'est nécessaire pour utiliser ce code.

# Utilisation

Pour utiliser ce code, il suffit de l'ouvrir dans un navigateur web.

# Description

## tabletest

Ce code correspond à un formulaire permettant d'ajouter des aliments à une table, ainsi qu'une table de données où l'utilisateur peut voir et modifier les aliments déjà ajoutés.

## Technologies utilisées

- HTML
- CSS
- JavaScript
- jQuery
- DataTables

## scripts

On retrouve les fonctions suivantes dans le fichier `scripts.js` : connexion, getSession, insertUser, insertMeal, getMeal, getAliment, getAllAliment, getNutriment, getEnergie, getName, getUser, updateProfil, deleteMeal, deleteUser, logout. Elles correspondent aux différentes requêtes que l'utilisateur peut effectuer et envoient les données à l'API.


## aliments

L'utilisateur peut retrouver tous les aliments dans la table `aliments`. Cette table contient les informations suivantes : l'ID de l'aliment, le nom de l'aliment, le type de l'aliment, l'énergie de l'aliment, le nombre de glucides de l'aliment, le nombre de lipides de l'aliment, le nombre de protéines de l'aliment, le nombre de fibres de l'aliment, le nombre de sucres de l'aliment, le nombre de sel de l'aliment, le nombre de calcium de l'aliment, le nombre de fer de l'aliment, le nombre de magnésium de l'aliment, le nombre de phosphore de l'aliment, le nombre de potassium de l'aliment, le nombre de sodium de l'aliment, le nombre de zinc de l'aliment, le nombre de cuivre de l'aliment, le nombre de manganèse de l'aliment, le nombre de fluor de l'aliment, le nombre de vitamine A de l'aliment, le nombre de vitamine B1 de l'aliment, le nombre de vitamine B2 de l'aliment, le nombre de vitamine B3 de l'aliment, le nombre de vitamine B5 de l'aliment, le nombre de vitamine B6 de l'aliment, le nombre de vitamine B9 de l'aliment, le nombre de vitamine B12 de l'aliment, le nombre de vitamine C de l'aliment, le nombre de vitamine D de l'aliment, le nombre de vitamine E de l'aliment, le nombre de vitamine K de l'aliment, le nombre de cholestérol de l'aliment, le nombre de vitamine PP de l'aliment, le nombre de vitamine B11 de l'aliment, le nombre de vitamine B15 de l'aliment, le nombre de vitamine B17 de l'aliment, le nombre de vitamine B21 de l'aliment, le nombre de vitamine B24 de l'aliment, le nombre de vitamine B27 de l'aliment, le nombre de vitamine B30 de l'aliment, le nombre de vitamine B31 de l'aliment, le nombre de vitamine B32 de l'aliment, le nombre de vitamine B33 de l'aliment, le nombre de vitamine B34 de l'aliment, le nombre de vitamine B35 de l'aliment, le nombre de vitamine B36

## repas

L'utilisateur peut retrouver tous les repas dans la table `repas`. Cette table contient les informations suivantes : l'ID du repas, la date du repas, l'ID de l'aliment, la quantité de l'aliment en grammes.

## Fonctionnement
La page HTML comporte un formulaire où l'utilisateur peut ajouter des aliments à une table. Les aliments sont composés d'un nom et d'un type.

La table est affichée sous le formulaire et elle contient les aliments déjà ajoutés. Chaque ligne de la table correspond à un aliment et comporte quatre colonnes : le nom de l'aliment, son type, un bouton "Supprimer" permettant de supprimer l'aliment, et un bouton "Modifier" permettant de modifier l'aliment.

Les données de la table sont affichées à l'aide de la bibliothèque DataTables.

## AjoutRepas

Il s'agit de la partie frontend de l'API permettant d'ajouter un repas à la base de données. L'API fournit un formulaire où les utilisateurs peuvent saisir la date, l'aliment et sa quantité en grammes. Le formulaire soumet ensuite les données à l'API backend où le repas est stocké dans la base de données.

## homePage

Sur cette page, l'utilisateur peut retrouver tous les repas qu'il a ajoutés. Il peut également supprimer un repas ou le modifier.

## ajoutRepas

Sur cette page, l'utilisateur peut ajouter un repas à la base de données. Il doit saisir la date, l'aliment et sa quantité en grammes.

## ajoutAliment

Sur cette page, l'utilisateur peut ajouter un aliment à la base de données. Il doit saisir le nom et le type de l'aliment.

## modificationProfil

Sur cette page, l'utilisateur peut modifier son profil. Il doit saisir son nom, son prénom, son âge, son poids, sa taille, son sexe, son objectif et son niveau d'activité.

## newCompte 

Sur cette page, l'utilisateur peut créer un compte. Il doit saisir son nom, son prénom, son âge, son poids, sa taille, son sexe, son objectif et son niveau d'activité.

## nutrimentPourcentage

Sur cette page, l'utilisateur peut retrouver le pourcentage de nutriments qu'il a consommé par rapport à ses besoins quotidiens. Il peut également retrouver le pourcentage de nutriments qu'il a consommé par rapport à ses besoins quotidiens pour chaque repas.

## template_foot

Ce fichier contient le code HTML permettant de fermer la page HTML.

## template_head

Ce fichier contient le code HTML permettant d'ouvrir la page HTML.

## template_menu

Ce fichier contient le code HTML permettant d'afficher le menu de la page HTML.

## Auteur

Ce code a été écrit par XI YU et RIBEAUD Antoine.