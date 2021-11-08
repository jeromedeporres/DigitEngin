<?php
include 'header.php';
include_once './Models/users.php';
include_once './Controllers/ctrlInscription.php';

if(isset($inscriptionMessageFail)){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">&times;</span></button>
	<?= $inscriptionMessageFail ?>
</div>
<?php } 
if(isset($inscriptionMessageSuccess)){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">&times;</span></button>
	<?= $inscriptionMessageSuccess ?>
</div>
<?php } ?>
<h1 class="text-center mt-3" id="titreAjoutClient">Créer Mon Compte</h1>
<div class="formAjoutClient">
	<form action="#" method="POST">
		<div class="form-group">
			<label for="nomUser" id="labelForm">Nom d'utilisateur :</label>
			<input type="text" class="form-control" id="nomUser" aria-describedby="nomUserHelp" name="nomUser"
				onblur="checkUnavailability(this)" />
			<?php if(isset($formErrors['nomUser'])){ ?>
			<p class="text-danger"><?= $formErrors['nomUser'] ?></p>
			<?php }else{ ?>
			<small id="nomUserHelp" class="form-text text-muted">Merci de renseigner votre nom d'utilisateur</small>
			<?php } ?>
		</div>
		<div class="form-group">
			<label for="mail" id="labelForm">Adresse mail :</label>
			<input type="email" class="form-control" id="mail" aria-describedby="mailHelp" name="mail"
				onblur="checkUnavailability(this)" />
			<?php if(isset($formErrors['mail'])){ ?>
			<p class="text-danger"><?= $formErrors['mail'] ?></p>
			<?php }else{ ?>
			<small id="mailHelp" class="form-text text-muted">Merci de renseigner votre adresse mail</small>
			<?php } ?>
		</div>
		<div class="form-group">
			<label for="pass" id="labelForm">Mot de passe :</label>
			<input type="password" class="form-control" aria-describedby="passHelp" name="pass" >
			<?php if(isset($formErrors['pass'])){ ?>
			<p class="text-danger"><?= $formErrors['pass'] ?></p>
			<?php }else{ ?>
			<small id="passHelp" class="form-text text-muted">Merci de renseigner votre mot de passe</small>
			<?php } ?>
		</div>
		<div class="form-group">
			<label for="passVerify" id="labelForm">Mot de passe (confirmation) :</label>
			<input type="password" class="form-control" id="passVerify" aria-describedby="passVerifyHelp"
				name="passVerify" />
			<?php if(isset($formErrors['passVerify'])){ ?>
			<p class="text-danger"><?= $formErrors['passVerify'] ?></p>
			<?php }else{ ?>
			<small id="passVerifyHelp" class="form-text text-muted">Merci de confirmer votre mot de passe</small>
			<?php } ?>
		</div>
			<!-- Btn validation -->
			<button type="submit" name="register" class="btn btn-primary btn-sm">Je m'inscris</button>
			<button type="reset" class="btn btn-warning btn-sm">Réinitialiser</button>
	</form>
</div>
		
<?php include 'footer.php';