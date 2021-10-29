<?php
include 'header.php';
include_once './Models/types.php';
include './Controllers/ctrlModifTypes.php'; 
?>

<div class="btnModif text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
  <!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
  <a class="btn btn-outline-primary btn-sm" href="listeTypes.php"><i class="far fa-building fa-2x"></i> Liste des Types</a>
  <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

  <!-- Titre Formulaire -->
  <h1 class="text-center" id="titreModif">Modifier un Type d'Engin</h1>

<div class="formModif"><?php
    if(isset($types)){ ?>
        <form action="modifType.php?&id_types=<?= $types->id_types ?>" method="POST">
            <div class="form-group">
			<div>
				<!--message d'erreur/succés-->
		<?php
			if(isset($modifyMessageFail)){ ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $modifyMessageFail ?>
			</div>
		<?php } 
		if(isset($modifyMessageSuccess)){ ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= $modifyMessageSuccess ?>
			</div>
		<?php } ?>
                <label for="nomTypes">Nom de Type :</label>
                <input oninput="this.value = this.value.toUpperCase()" id="nomTypes" class="form-control <?= count($formErrors) > 0 ? (isset($formErrors['nomTypes']) ? 'is-invalid' : 'is-valid') : '' ?>" value="<?= isset($_POST['nomTypes']) ? $_POST['nomTypes'] : $types->nomTypes ?>" type="text" name="nomTypes" />
                <!--message d'erreur-->
                <p class="errorForm"><?= isset($formErrors['nomTypes']) ? $formErrors['nomTypes'] : '' ?></p>
            </div>
			<input type="submit" class="btn btn-primary btn-sm" name="modify" value="Valider"></input>
          	<button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>

        </form><?php
    } ?>
</div>
<?php include './footer.php';