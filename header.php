<?php
session_start();
include 'config.php';
include_once './Models/dataBase.php';
include_once './Controllers/ctrlHeader.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="Assets/Img/imgHead.png">
	<title>Digit Engin</title>
	<link rel="stylesheet" href="Assets/Styles/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
		integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

</head>

<body>

	<!-- Header Image -->
	<header class="blog-header">
		<a href="./index.php"><img src="./Assets/Img/logo.jpg" class="img-fluid imgLogo" alt="logo"></a>
		<!-- Header BTN -->
		<div class="container-fluid">
			<?php if(!isset($_SESSION['account'])){ //Si l'utilisateur n'est pas connecté ?>
			<a href="connexion.php?view=connexion" role="button" class="btn btn-primary btn-sm"> <span title="S'identifier"><i
						class="fas fa-sign-in-alt"> S'identifier</i></span></a>
			<a href="inscription.php?view=inscription" role="button" class="btn btn-primary btn-sm"><span title="s'inscrire"><i
						class="fas fa-user-plus"> S'inscrire</i></span></a>
			<?php }else{ //Si la personne est connectée?>

			<a href="userProfile.php/" class="titreUtilisateur"><?= isset($_SESSION['account']['nomUser']) ? ' Bonjour ' . $_SESSION['account']['nomUser']: ''?></a>
			<a href="?action=disconnect" role="button" class="btn btn-outline-danger btn-sm"><span
					title="Se deconnecter"><i class="fas fa-sign-out-alt"> Se deconnecter</i></span></a>
			<?php } ?>
		</div>
	</header>