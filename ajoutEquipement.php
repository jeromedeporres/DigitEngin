<?php
include 'header.php';
include './Models/equipements.php';
include './Controllers/ctrlAjoutEquipement.php';
?>
<div class="btnAjoutClient text-center">
    <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
    	<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
    <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
<h1 class="text-center mt-3" id="titreAjoutEquipement">Ajouter un Equipement</h1>

<div class="formAjoutEquipement">
	<form action="ajoutEquipement.php" method="POST">
		<div class="form-group">
			<label for="nomEquipements" id="labelForm">Nom d'équipement</label>
			<input oninput="this.value = this.value.toUpperCase()" class="form-control" id="nomEquipements" <?= count($formErrors) > 0 ? (isset($formErrors['nomEquipements']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['nomEquipements']) ? $_POST['nomEquipements'] : '' ?>" type="text" name="nomEquipements" />
			<small id="help" class="form-text text-muted">Entrez un nouveau équipement</small>
		</div>
	<!--message de succés ou d'erreur-->
		<p class="formMessage"><?= isset($addEquipementMessage) ? $addEquipementMessage : '' ?></p>
	<!-- Btn validation -->
		<button type="submit" name="addEquipements" class="btn btn-primary btn-sm">Valider</button>
	    <button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
	</form>
</div>

<!-- Affichage de Footer -->
<?php
  include 'footer.php'
?>