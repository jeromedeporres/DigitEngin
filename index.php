<?php
include 'header.php';
include './Controllers/ctrlIndex.php';
include './Controllers/ctrlConnexion.php';
?>

 <div class="jumbotron jumbotron-fluid infoIndex">
 	<!-- Les Buttons de la page d'Accueil -->
	<div class="container">
	<?php if (isset($_SESSION['account']) && $_SESSION['account']['id_roles'] == 2) { ?>
		<a class="btn btn-outline-primary btn-sm" href="debutPoste.php"><i class="fas fa-play fa-2x"></i> Prise Poste</a>
		<a class="btn btn-outline-primary btn-sm" href="finPoste.php"><i class="fas fa-stop fa-2x"></i> Fin Poste</a>
		<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i>Tableau De Bord</a>
		<?php } else if (isset($_SESSION['account']) && $_SESSION['account']['id_roles'] == 1) {?>
		<a class="btn btn-outline-primary btn-sm" href="debutPoste.php"><i class="fas fa-play fa-2x"></i> Prise Poste</a>
		<a class="btn btn-outline-primary btn-sm" href="finPoste.php"><i class="fas fa-stop fa-2x"></i> Fin Poste</a>
	</div>
	<?php }?>
	<div class="container">
		<h1 class="display-4">Digit Engin</h1>
		<p class="lead">La productivité, la fiabilité, la disponibilité et les performances.</p>
		<img src="./Assets/Img/imgIntro.jpg" alt="imgIntro" class="img-fluid imgHeader">
	</div>
</div>

 
<!-- Affichage de Footer -->
<?php
include 'footer.php';
?>