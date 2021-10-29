<?php
include 'header.php';
include './Models/engins.php';
include './Models/types.php';
include './Models/equipements.php';
include './Models/clients.php';
include './Models/statut.php';
include './Controllers/ctrlDebutPoste.php';
?>
<div class="btnDebutPoste text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
  <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
 <h1 class="text-center mt-3" id="titreDebutPoste">Début Du Poste</h1>
<div class="formDebutPoste">
	<form action="debutPoste.php" method="POST" enctype="multipart/form-data"> 
  <!--message de succés ou d'erreur-->
  <p class="formMessage"><?= isset($debutPosteMessage) ? $debutPosteMessage : '' ?></p>

    <!-- DATE L'HEURE -->
	<div class="form-group">
		<label for="dateHeure" id="labelForm">selectionner la date et l'heure</label>
		<input class="form-control" id="dateHeure" value="<?php echo date("Y-m-d\TH:i"); ?>" type="datetime-local" name="dateHeure" />
	</div>

	<!-- ENGINE -->
  <div class="form-group">
    <label for="numeroEngin" id="labelForm">Choisissez votre Engin</label>
    <select id="numeroEngin" class="form-control" name="id_Engins" onchange="selectEngin(this.value)">
      <option selected disabled>Choisissez votre Engin</option>
	  <?php foreach($enginsListe as $engins){ ?>
      <option value="<?= $engins->id_Engins ?>"><?= $engins->id_Engins . ' . ' . $engins->numeroEngin ?></option><?php
      } ?>
    </select>	
    <!--message d'erreur-->
    <p class="errorForm"><?= isset($formErrors['id_types']) ? $formErrors['id_types'] : '' ?></p>
  </div>

   <!-- Prise du poste Info-->
<div id="prisePosteInfo"></div>

<div class="form-group">
    <label for="description" id="labelForm">Observation</label>
      <textarea onkeyup="textCounter(this,'counter',300);" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['description']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['description']) ? $_POST['description'] : ' ' ?>" type="text" maxlength=300 name="description" ></textarea>
      <input disabled maxlength="300" size="22" value="Maximum 300 Caractères." id="counter">
  </div>

  <!-- IMAGE -->
  <div class="form-group">
      <label for="image" id="labelForm">Image d'une Anomalie</label>
      <input id="image" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['imageAnom1']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['imageAnom1']) ? $_POST['imageAnom1'] : '' ?>" type="file" name="imageAnom1" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['imageAnom1']) ? $formErrors['imageAnom1'] : '' ?></p>
  </div>
	<!--message de succés ou d'erreur-->
		<p class="formMessage"><?= isset($addAnomaliesMessage) ? $addAnomaliesMessage : '' ?></p>

<!-- Btn validation -->
	<div>	
		<button type="submit" name="addEngin" class="btn btn-primary btn-sm">Valider</button>
		<button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
	</div>
  </form>
</div>





<!-- Affichage de Footer -->
<?php
  include 'footer.php'
?>