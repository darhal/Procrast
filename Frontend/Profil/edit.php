<?php

session_start();
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
$user = Systeme::getUserByID($uid);

if ($user == null){
	die("ERROR: Unable to find user by ID");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>S'inscrire</title>
	<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<?php 
	include_once getenv('BASE')."Shared/navbar.php";
?>
<div class="container align-center">
	<div class="spacer"></div>
	<h1 class="text-center"> Modifier ses informations </h1>
	<div class="container align-center">
		<form method="post" action="confirm_edit.php">

			<div class="form-group">
				<h3> Pseudo </h3>
				<label for="pseudo"></label><input class="form-control" type="text" id="pseudo" name="pseudo" placeholder="<?php echo $user->pseudo?>">
			</div>

			<div class="form-group">
				<h3> Prénom </h3>
				<label for="prenom"></label><input class="form-control" type="text" id="prenom" name="prenom" placeholder="<?php echo $user->prenom?>">
			</div>

			<div class="form-group">
				<h3> Nom </h3>
				<label for="nom"></label><input class="form-control" type="text" id="nom" name="nom" placeholder="<?php echo $user->nom?>">
			</div>

			<div class="form-group">
				<h3> Email </h3>
				<label for="email"></label><input class="form-control" type="email" id="email" name="email" placeholder="<?php echo $user->email?>">
			</div>

			<div class="form-group">
				<h3> Confirmer votre mot de passe </h3>
				<label for="conf-password"></label><input class="form-control" type="password" id="conf-password">
			</div>

			<input type="submit" value="Modifier ses informations">
		</form>

		<?php
		if(isset($_GET['erreur'])){
			$err = $_GET['erreur'];
			if($err==1) {
				echo "<p style='color:red'>email déjà utilisé, veuillez changer </p>";
			}
			if($err==2) {
				echo "<p style='color:red'>Vous devez remplir les champs obligatoires </p>";
			}
		}
		?>

		<button onclick="window.location.href='./'"> Retour </button>
	</div>
</div>
<?php 
	include_once getenv('BASE')."Shared/footer.php";
?>
</body>
</html>