<?php
include 'header.php';
include_once 'config.php';
include_once './Models/users.php';
include_once './Controllers/ctrlConnexion.php';

?>
<h1 class="text-center mt-3" id="titreAjoutClient">Se Connecter</h1>
<div class="formAjoutClient">
    <form action="#" method="POST">
        <div class="form-group">
            <label for="mail" id="labelForm">Identifiant :</label>
            <input type="email" class="form-control" id="mail" aria-describedby="mailHelp" name="mail"/>
            <?php if(isset($formErrors['mail'])){ ?>
                <p class="text-danger"><?= $formErrors['mail'] ?></p>
           <?php }else{ ?>
                <small id="mailHelp" class="form-text text-muted">Merci de renseigner votre adresse mail</small>
           <?php } ?>
        </div>
        <div class="form-group">
            <label for="pass" id="labelForm">Mot de passe :</label>
            <input type="password" class="form-control" id="pass" aria-describedby="passHelp" name="pass" />
            <?php if(isset($formErrors['pass'])){ ?>
                <p class="text-danger"><?= $formErrors['pass'] ?></p>
           <?php }else{ ?>
                <small id="passHelp" class="form-text text-muted">Merci de renseigner votre mot de passe</small>
                <?php } ?>
        </div>
        <button type="submit" name="connexion" class="btn btn-primary">Se Connecter</button>
    </form>
</div>
<?php include 'footer.php';