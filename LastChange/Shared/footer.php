<?php

include_once (getenv('BASE')."Backend/Utilisateur/Systeme.php");

if (session_status() != PHP_SESSION_ACTIVE) {
	session_start();
}

$text = "not connected";
if(Systeme::estConnecte()){
	// Redirection vers la page d'accueil
	$pseudo = $_SESSION["username"];
	$text = "connected as ".$pseudo;
}

echo "<footer><small class='sticky-bottom'> " . $text . " </small></footer>";