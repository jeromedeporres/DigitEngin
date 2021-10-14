<?php
include 'header.php';
include './Models/clients.php';
include './Controllers/ctrlAjoutClient.php';
?>

<div class="btnAjoutClient text-center">
    <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
    	<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
    <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
 <h1 class="text-center mt-3" id="titreAjoutClient">Ajouter un Client</h1>

<div class="formAjoutClient">
	<form action="ajoutClient.php" method="POST">
		<div class="form-group">
			<label for="nomClient" id="labelForm">Nom de Client</label>
			<input oninput="this.value = this.value.toUpperCase()" class="form-control" id="nomClients" <?= count($formErrors) > 0 ? (isset($formErrors['nomClients']) ? 'is-invalid' : 'is-valid') : '' ?> label="Nom de Client" value="<?= isset($_POST['nomClients']) ? $_POST['nomClients'] : '' ?>" type="text" name="nomClients" />
			<small id="help" class="form-text text-muted">Entrez un nouveau client</small>
		</div>
	<!--message de succés ou d'erreur-->
		<p class="formMessage"><?= isset($addClientMessage) ? $addClientMessage : '' ?></p>
	<!-- Btn validation -->
		<button type="submit" name="addClient" class="btn btn-primary btn-sm">Valider</button>
	    <button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
	</form>
</div>

<!-- Affichage de Footer -->
<?php
  include 'footer.php'
?>