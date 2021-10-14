<?php
include 'header.php';
include './Models/types.php';
include './Controllers/ctrlAjoutType.php';
?>
<div class="btnAjoutType text-center">
    <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
    	<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
    <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>
<!-- Début Formulaire -->
<!-- Titre Formulaire -->
<h1 class="text-center mt-3" id="titreAjoutEquipement">Ajouter un Type d'engin</h1>

<div class="formAjoutType">
	<form action="ajoutType.php" method="POST">
		<div class="form-group">
			<label for="nomTypes" id="labelForm">Nom de Type d'engin</label>
			<input oninput="this.value = this.value.toUpperCase()" class="form-control" id="nomTypes" <?= count($formErrors) > 0 ? (isset($formErrors['nomTypes']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['nomTypes']) ? $_POST['nomTypes'] : '' ?>" type="text" name="nomTypes" />
			<small id="help" class="form-text text-muted">Entrez un nouveau engin</small>
		</div>
	<!--message de succés ou d'erreur-->
		<p class="formMessage"><?= isset($addTypesMessage) ? $addTypesMessage : '' ?></p>
	<!-- Btn validation -->
		<button type="submit" name="addTypes" class="btn btn-primary btn-sm">Valider</button>
	    <button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
	</form>
</div>

<!-- Affichage de Footer -->
<?php
  include 'footer.php'
?>