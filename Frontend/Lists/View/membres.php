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
include_once (getenv('BASE')."Backend/Taches/ListeTaches.php");
include_once (getenv('BASE')."Backend/Taches/Tache.php");
include_once (getenv('BASE')."Backend/Utilisateur/Systeme.php");

Systeme::Init();

$user = Systeme::getUserByEmail($_SESSION['email']);

if (!isset($_POST['lid'])) {
	die("ID de liste non défini");
}

$lid = intval($_POST['lid']);

if (!is_int($lid)) {

	die("L'ID de liste n'est pas valide");
}

$liste = Systeme::getListeTachesByID($lid);

if ($liste == null) {
	die("Liste d'ID " . $lid . " inexistante");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../CSS/style.css">
	<title>Procrast - <?php echo $liste->nom; ?></title>
</head>
<body>
<?php include_once getenv('BASE') . "Shared/navbar.php"; ?>
<div class="spacer"></div>
<h1 class="text-center"> Membres </h1>
<div class="spacer"></div>

<div class="container-fluid w-90 d-block">

	<h2><?php echo $liste->nom; ?></h2>

	<table class="table">
		<thead>
		<tr>
			<th scope="col"> ID </th>
			<th scope="col"> Pseudo </th>
			<th scope="col"> Mail </th>
			<th scope="col"> Supprimer </th>
		</tr>
		</thead>
		<tbody>
		<?php
		$membres = Systeme::getMembres($liste);

		foreach ($membres as $membre) {
			echo "
				<tr>
					<th scope='row'>" . $membre->id . "</th>
					<td>" . $membre->pseudo . "</td>
					<td>" . $membre->email . "</td>
					<td><a class='diabled' href='/Frontend/Lists/View/delete.php?id=" . $membre->id . "'> Go </a></td>
				</tr>";
		}
		?>
		</tbody>
	</table>

</div>

<?php include_once getenv("BASE") . "Shared/footer.php"; ?>
</body>
</html>