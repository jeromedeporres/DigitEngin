<?php
$formErrors = [];
//Vérification du formulaire d'inscription
if(isset($_POST['register'])){
    $user = new users();
    /**
     * Cette variable sert à savoir si les vérifications du mot de passe et de sa confirmation se sont déroulés avec succès
     */
    $isPasswordOk = true;
    if(!empty($_POST['mail'])){
        if(filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            //J'hydrate mon instance d'objet user
            $user->mail = htmlspecialchars($_POST['mail']);
        }else{
            $formErrors['mail'] ='Renseigner un adress mail valide';
        }
    }else{
        $formErrors['mail'] = 'Renseigner votre adresse mail';
    }

    if(!empty($_POST['nomUser'])){
        //J'hydrate mon instance d'objet user
        $user->nomUser = htmlspecialchars($_POST['nomUser']);
    }else{
        $formErrors['nomUser'] = 'Renseigner votre nom d\'utilisateur';
    }

    if(empty($_POST['pass'])){
        $formErrors['pass'] = 'Renseigner un mot de passe';
        $isPasswordOk = false;
    }
    if(empty($_POST['passVerify'])){
        $formErrors['passVerify'] = 'Confirmez votre mot de passe';
        $isPasswordOk = false;
    }
    //Si les vérifications des mots de passe sont ok
    if($isPasswordOk){
        if($_POST['passVerify'] == $_POST['pass']){
            //On hash le mot de passe avec la méthode de PHP
            $user->pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        }else{
            $formErrors['pass'] = $formErrors['passVerify'] = 'Les mots de passe doivent être identiques';
        }
    }
    if(empty($formErrors)){
        $isOk = true;
        //On vérifie si le pseudo est libre
        if($user->checkUserUnavailabilityByFieldName(['nomUser'])){
            $formErrors['nomUser'] = 'Votre nom d\'utilisateur déja pris';
            $isOk = false;
        }
        //On vérifie si le mail est libre
        if($user->checkUserUnavailabilityByFieldName(['mail'])){
            $formErrors['mail'] = 'Votre adress mail déja pris';
            $isOk = false;
        }
        //Si c'est bon on ajoute l'utilisateur
        if($isOk){
            if ($user->addUser()) {
                $inscriptionMessageSuccess = ' Vous etre bien crée votre compte';
            }else {
                $inscriptionMessageFail = ' Une erreur est survenu';
            }
        }
    }
}
//Traitement de la demande AJAX
if(isset($_POST['fieldValue'])){
    //On vérifie que l'on a bien envoyé des données en POST
    if(!empty($_POST['fieldValue']) && !empty($_POST['fieldName'])){
        //On inclut les bons fichiers car dans ce contexte ils ne sont pas connu.
        include_once './config.php';
        include_once '../Models/users.php';
        $user = new users();
        $input = htmlspecialchars($_POST['fieldName']);
        $user->$input = htmlspecialchars($_POST['fieldValue']);
        //Le echo sert à envoyer la réponse au JS
        echo $user->checkUserUnavailabilityByFieldName([htmlspecialchars($_POST['fieldName'])]);
    }else{
        echo 2;
    }
}

?>