<?php
session_start();
//include("../database/database.php");
$unwanted_array = array(
    'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
    'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
    'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
    'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="/Frontend/CSS/style.css">
    <style>
        .retour {
            background-color: #555;
            color: white;
            text-decoration: none;
            padding: 15px 26px;
            position: relative;
            display: inline-block;
            border-radius: 2px;
            position: absolute;
            bottom: 0;
            right: 0;
        }
    </style>
</head>

<body>
<?php include_once "Shared/navbar.php"; ?>
<div class="spacer"></div>
<a href="profile.php" class="retour">
    <span>Retour</span>
</a>
<div id="recherche">

    <h1>Tapez le nom de la personne que vous souhaitez rechercher </h1>
    <form action="" class="formulaire">
        <input style="width: 300px" class="champ" type="text" value="Pseudo"/>
        <input class="bouton" type="button" onclick="afficher()" value="recherche" />

    </form>

</div>
<div id="personne">
</div>
<script>
    function afficher() {
        var personne=document.createElement("div");
        var content=document.createTextNode("personne1");
        personne.appendChild(content);
        var divElement=document.getElementById("personne");
        document.body.insertBefore(personne,divElement);
    }
</script>
