<?php
include 'header.php';
include './Models/engins.php';
include './Models/statut.php';
include './Models/finPoste.php';
include './Controllers/ctrlFinPoste.php';

?>
<div class="btnFinPoste text-center">
	<a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
	<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i>
		Tableau De Bord</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
<h1 class="text-center mt-3" id="titreFinPoste">Fin Du Poste</h1>
<div class="formFinPoste">
	<form action="finPoste.php" method="POST" enctype="multipart/form-data">
		<!--message de succés ou d'erreur-->
		<p class="formMessage"><?= isset($addFinPoste) ? $addFinPoste : '' ?></p>

		<!-- DATE L'HEURE -->
		<div class="form-group">
			<label for="dateHeure" id="labelForm">Selectionnez La date et L'heure</label>
			<input class="form-control" id="dateHeure" value="<?php echo date("Y-m-d\TH:i"); ?>" type="datetime-local"
				name="finPoste" />
		</div>

		<!-- ENGINE -->
		<div class="form-group">
			<label for="numeroEngin" id="labelForm">Choisissez votre Engin</label>
			<select id="numeroEngin" class="form-control" name="id_Engins" onchange="selectEngin(this.value)">
				<option selected disabled>Choisissez votre Engin</option>
				<?php foreach($enginsListe as $engins){ ?>
				<option value="<?= $engins->id_Engins ?>"><?= $engins->id_Engins . ' . ' . $engins->numeroEngin ?>
				</option><?php
      } ?>
			</select>
		</div>
		<!-- Prise du poste Info-->
		<div id="prisePosteInfo"></div>

		<!-- Btn validation -->
		<div>
			<button type="submit" name="addFinPoste" class="btn btn-primary btn-sm">Valider</button>
			<button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
		</div>
	</form>
</div>


<!-- Affichage de Footer -->
<?php
  include 'footer.php'
?>