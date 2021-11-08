<?php
include 'header.php';
include './Models/engins.php';
include './Models/anomalies.php';
include './Controllers/ctrlAnomalies.php';
?>
<div class="btnAjoutEngin text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
 <h1 class="text-center mt-3" id="titreAjoutEngin">Declarer une Anomalie</h1>

<div class="formAjoutAnomalies">
	<form action="ajoutAnomalies.php" method="POST" enctype="multipart/form-data"> 
	<!-- TYPE D'ENGINE -->
  <div class="form-group">
    <label for="numeroEngin" id="labelForm">Numero d'Engin</label>
    <select id="numeroEngin" class="form-control" name="numeroEngin">
      <option selected disabled>Choisissez l'Engin :</option><?php
      foreach($numeroEnginListe as $numeroEngin){ ?>
      <option value="<?= $numeroEngin->id_engins ?>"><?= $numeroEngin->id_engins . ' - ' . $numeroEngin->numeroEngin ?></option><?php
      } ?>
    </select>	
    <!--message d'erreur-->
    <p class="errorForm"><?= isset($formErrors['id_Engins']) ? $formErrors['id_Engins'] : '' ?></p>
  </div>

  <div class="form-group">
    <label for="description" id="labelForm">Observation</label>
      <textarea onkeyup="textCounter(this,'counter',300);" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['description']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['description']) ? $_POST['description'] : ' ' ?>" type="text" maxlength=300 name="description" ></textarea>
      <input disabled maxlength="300" size="22" value="Maximum 300 Caractères." id="counter">
    <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['description']) ? $formErrors['description'] : '' ?></p>
  </div>

<!-- IMAGE -->
  <div class="form-group">
      <label for="image" id="labelForm">Image</label>
      <input id="image" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['imageAnom1']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['imageAnom1']) ? $_POST['imageAnom1'] : '' ?>" type="file" name="imageAnom1" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['imageAnom1']) ? $formErrors['imageAnom1'] : '' ?></p>
  </div>
	<!--message de succés ou d'erreur-->
		<p class="formMessage"><?= isset($addAnomaliesMessage) ? $addAnomaliesMessage : '' ?></p>
	<!-- Btn validation -->
	<div>	
    <button type="submit" name="addAnomalies" class="btn btn-primary btn-sm">Valider</button>
    <button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
  </div>
  </form>
</div>

<!-- Affichage de Footer -->
<?php
  include 'footer.php'
?>