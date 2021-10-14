<?php
include 'header.php';
include './Models/anomalies.php';
include './Models/engins.php';
include './Controllers/ctrlAnomalies.php';

?>
<div class="btnAjoutEngin text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
  <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
 <h1 class="text-center mt-3" id="titreAjoutAnomalies">Déclarer Une Anomalie</h1>

<div class="formAjoutAnomalies">
	<form action="anomalies.php" method="POST" enctype="multipart/form-data"> 
	<!-- NUMERO D'ENGIN -->
  <div class="form-group">
    <label for="numeroEngin" id="labelForm">Numero d'engin</label>
    <select id="numeroEngin" class="form-control" name="numeroEngin">
      <option selected disabled>Choisissez l'engin :</option><?php
      foreach($numeroListe as $engins){ ?>
      <option value="<?= $engins->id_engins ?>"><?= $engins->id_engins . ' . ' . $engins->numeroEngin ?></option><?php
      } ?>
    </select>	
    <!--message d'erreur-->
    <p class="errorForm"><?= isset($formErrors['id_engins']) ? $formErrors['id_engins'] : '' ?></p>
  </div>

  <!-- DESCRIPTION -->
  <div class="form-group">
    <label for="description" id="labelForm">Observation</label>
    <textarea id="description" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['description']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>" type="text" name="description"></textarea>
    <!--message d'erreur-->
    <p class="errorForm"><?= isset($formErrors['description']) ? $formErrors['description'] : '' ?></p>
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