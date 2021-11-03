<?php
include 'header.php';
include_once './Models/engins.php';
include_once './Models/types.php';
include_once './Models/equipements.php';
include_once './Models/clients.php';
include_once './Models/statut.php';
include './Controllers/ctrlModifEngin.php';
?>

<div class="btnModif text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
  <!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
  <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

  <!-- Titre Formulaire -->
<h1 class="text-center" id="titreModif">Modifier un Engin</h1>

<div class="formModif">
<?php
    if(isset($enginsInfo)){ ?>
    <form action="modifEngin.php?id_Engins=<?= $_GET['id_Engins'] ?>" method="POST" enctype="multipart/form-data">
  <!--message de succés ou d'erreur-->
  <p class="formMessage"><?= isset($modifEnginMessage) ? $modifEnginMessage : '' ?></p>
	<!-- TYPE D'ENGINE -->
  <div class="form-group">
    <label for="typeEngin" id="labelForm">Type d'engin</label>
    <select id="typeEngin" class="form-control" name="id_types">
      <option disabled>Choisissez le Type :</option><?php
      /* Récupere l'item sélectionné */
      $selected = $enginsInfo->id_types;
      foreach($typesListe as $types){ ?>
      <option value="<?= $types->id_types?> " <?= ($types->id_types == $selected)? 'selected': '' ?>><?= $types->id_types . ' . ' . $types->nomTypes?></option><?php
      } ?>
    </select>	
    <!--message d'erreur-->
    <p class="errorForm"><?= isset($formErrors['id_types']) ? $formErrors['id_types'] : '' ?></p>
  </div>
  <!-- NUMERO D'ENGIN -->
  <div class="form-group">
    <label for="numeroEngin" id="labelForm">Numéro d'engin</label>
    <input oninput="this.value = this.value.toUpperCase()" class="form-control" id="numeroEngin" <?= count($formErrors) > 0 ? (isset($formErrors['numeroEngin']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= !empty($_POST['numeroEngin']) ? $_POST['numeroEngin'] : $enginsInfo->numeroEngin ?>" type="text" name="numeroEngin" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['numeroEngin']) ? $formErrors['numeroEngin'] : '' ?></p>
  </div>
<!-- EQUIPEMENTS -->
<div class="form-group">
    <label for="equipements" id="labelForm">Le(s) Equipement(s)</label>
    <input oninput="this.value = this.value.toUpperCase()" class="form-control" id="nomEquipements" <?= count($formErrors) > 0 ? (isset($formErrors['nomEquipements']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['nomEquipements']) ? $_POST['nomEquipements'] : $enginsInfo->nomEquipements ?>" type="text" name="nomEquipements" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['nomEquipements']) ? $formErrors['nomEquipements'] : '' ?></p>
  </div>

<!-- STATUT -->

<div class="form-group">
    <label for="statut" id="labelForm">Disponibilité</label>
    <select class="form-control" id="statut" name="id_statut">
    <option disabled>Choisissez le statut :</option><?php
      /* Récupere l'item sélectionné */
      $statutSelected = $enginsInfo->id_statut;
      /* $selectedEquipements = $equipementsSelected->id_equipements; */
      foreach($statutListe as $statut){ ?>
      <option value="<?= $statut->id_statut ?>"<?= ($statut->id_statut == $statutSelected)? "selected": "" ?>><?= $statut->id_statut . ' . ' . $statut->nomStatut ?></option><?php
      } ?>
       </select>	
    <p class="errorForm"><?= isset($formErrors['statut']) ? $formErrors['statut'] : '' ?></p>
  </div>
  <!-- DERNIER REVISION -->
  <div class="form-group">
    <label for="dernierRevision" id="labelForm">Dernier Revision</label>
    <input oninput="this.value = this.value.toUpperCase()" class="form-control" id="dernierRevision" <?= count($formErrors) > 0 ? (isset($formErrors['dernierRevision']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['dernierRevision']) ? $_POST['dernierRevision'] : $enginsInfo->dernierRevision ?>" type="date" name="dernierRevision" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['dernierRevision']) ? $formErrors['dernierRevision'] : '' ?></p>
  </div>

    <!-- PROCHAIN REVISION -->
    <div class="form-group">
    <label for="prochainRevision" id="labelForm">Prochain Revision</label>
    <input oninput="this.value = this.value.toUpperCase()" class="form-control" id="prochainRevision" <?= count($formErrors) > 0 ? (isset($formErrors['prochainRevision']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['prochainRevision']) ? $_POST['prochainRevision'] : $enginsInfo->prochainRevision ?>" type="date" name="prochainRevision" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['prochainRevision']) ? $formErrors['prochainRevision'] : '' ?></p>
  </div>

    <!-- KM REEL -->
    <div class="form-group">
    <label for="km_reel" id="labelForm">Kilométrage</label>
    <input oninput="this.value = this.value.toUpperCase()" class="form-control" id="km_reel" <?= count($formErrors) > 0 ? (isset($formErrors['km_reel']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['km_reel']) ? $_POST['km_reel'] : $enginsInfo->km_reel ?>" type="number" name="km_reel" />
      <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['km_reel']) ? $formErrors['km_reel'] : '' ?></p>
  </div>
      <!-- HORAMETRE -->
        <div class="form-group">
    <label for="horametre" id="labelForm">Horamétre</label>
    <input oninput="this.value = this.value.toUpperCase()" class="form-control" id="horametre" <?= count($formErrors) > 0 ? (isset($formErrors['horametre']) ? 'is-invalid' : 'is-valid') : ''?>value="<?= isset($_POST['horametre']) ? $_POST['horametre'] : $enginsInfo->horametre?>" type="time" name="horametre" />
    <small>Ex : 234 H 56 M</small>
    <!--message d'erreur-->
      <p class="errorForm"><?= isset($formErrors['horametre']) ? $formErrors['horametre'] : '' ?></p>
  </div>

  	<!-- CLIENT -->
    <div class="form-group">
    <label for="client" id="labelForm">Client</label>
    <select id="client" class="form-control" name="id_Clients">
      <option disabled>Choisissez le Client :</option><?php
      /* Récupere l'item sélectionné */
      $selectedClient = $enginsInfo->id_Clients;
      foreach($clientsListe as $clients){ ?>
      <option value="<?= $clients->id_Clients ?>"<?= ($clients->id_Clients == $selectedClient)? "selected": "" ?>><?= $clients->id_Clients . ' . ' . $clients->nomClients ?></option><?php
      } ?>
    </select>	
    <!--message d'erreur-->
    <p class="errorForm"><?= isset($formErrors['id_Clients']) ? $formErrors['id_Clients'] : '' ?></p>
  </div>
<!-- IMAGE -->
  <div class="form-group">
            <label for="image" id="labelForm">Image</label>
            <input id="image" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['image']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['image']) ? $_POST['image'] : $enginsInfo->image?>" type="file" name="image"  />
            <!--message d'erreur-->
            <p class="errorForm"><?= isset($formErrors['image']) ? $formErrors['image'] : '' ?></p>
        </div>
        	<!-- Btn validation -->
	<div>	
    <button type="submit" name="modifyEngin" class="btn btn-primary btn-sm">Valider</button>
    <button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
    </div>
  </form>

    </div>
    <?php } ?>

<?php
include 'footer.php';
