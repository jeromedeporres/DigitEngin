<?php
include 'header.php'
?>
<q-btn type="a" href="index.php" no-caps target="_self" color="primary" push glossy unelevated icon="home" label="Accueil"></q-btn>
<q-btn type="a" href="tableauDeBord.php" no-caps target="_self" class="" push color="primary" glossy unelevated icon="dashboard" label="Tableau De Bord"></q-btn>
<q-btn type="a" href="index.php" no-caps target="_self" class="btnDecon" push glossy unelevated icon="logout" label="Déconnexion"></q-btn><!-- Btn de deconnexion -->

<!-- Affichage de date et l'heure -->
<p class="dateHeure">Nous sommes le : <strong><?php setlocale(LC_TIME, "fr_FR","French"); 
	echo(strftime("%A %d %B %G </strong>et il est <strong>%H h %M</strong>")); ?></p>
<!-- Début Formulaire -->
<!-- Titre Formulaire -->

<?php
include 'footer.php'
?>