<?php
include 'header.php'
?>
<div class="btnDebSession text-center">
    <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
    	<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
    <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>
<!-- Affichage de date et l'heure -->
<div class="text-center">
	<p class="dateHeure">Nous sommes le : <strong><?php setlocale(LC_TIME, "fr_FR","French"); 
	echo(strftime("%A %d %B %G </strong>et il est <strong>%H h %M</strong>")); ?></p>
</div>
<!-- Début Formulaire -->
<!-- Titre Formulaire -->
<h1 class="text-center mt-3" id="titreDebSession">Demarrez la session.<br> Veuillez saisir les information.</h1>


<!-- FOOTER -->
<?php
include 'footer.php'
?>