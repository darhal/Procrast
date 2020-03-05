<?php

include_once (getenv('BASE')."Backend/Utilisateur/Utilisateur.php");
include_once (getenv('BASE')."Backend/Utilisateur/Systeme.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_POST['pseudo'] != '' AND $_POST['prenom'] != '' AND $_POST['nom'] != '' AND $_POST['email'] != '' AND $_POST['password'] != '') { //Si les champs ne sont pas vides
    Systeme::Init();

    $user = new Utilisateur($_POST['pseudo'], $_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['password']);
    Systeme::ajouterUtilisateur($user);
}
else{     //Si les informations ne sont pas remplies
	header('location: /Frontend/Login/index.php?erreur=2');
}

?>
