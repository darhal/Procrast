<?php

if (session_status() != PHP_SESSION_ACTIVE) {
	session_start();
}
if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true){
	$uid = $_SESSION["id"];
} else {
	// Redirection vers la page d'accueil
	header("location: /Frontend/Login");
	exit;
}

include_once (getenv('BASE')."Backend/Utilisateur/Utilisateur.php");
include_once (getenv('BASE')."Backend/Utilisateur/Systeme.php");

Systeme::Init();

$logged_user = Systeme::getUserByID($uid);

if ($logged_user == null){
	die("ERROR: Unable to find user by id");
}

print_r($_POST);

if (!isset($_POST['old-password'])) {
	die("old password non défini");
}

$old_password = $_POST['old-password'];

if (!isset($_POST['new-password'])) {
	die("new password non défini");
}

$new_password = $_POST['new-password'];

if (!isset($_POST['conf-password'])) {
	die("conf password non défini");
}

$conf_password = $_POST['conf-password'];

if ($new_password == $conf_password) {
	//Systeme::changePassword($user, $old_password, $new_password);
}


header("location: /Frontend/Login/logout.php");
// TODO: - Vérifier le mot de passe de l'utilisateur lors de la modification