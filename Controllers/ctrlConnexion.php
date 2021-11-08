<?php
$formErrors = [];
//Vérification du formulaire de connexion
if(isset($_POST['connexion'])){
    $user = new users();
    if(!empty($_POST['mail'])){
        if(filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
            //J'hydrate mon instance d'objet user
            $user->mail = htmlspecialchars($_POST['mail']);
        }else{
            $formErrors['mail'] = 'Renseigner un adress mail valide';
        }
    }else{
        $formErrors['mail'] = 'Renseigner votre adress mail';
    }

    if(empty($_POST['pass'])){        
        $formErrors['pass'] = 'Renseigner un mot de passe';
    }
    
    if(empty($formErrors)){
        //On récupère le hash de l'utilisateur
       $hash = $user->getUserPasswordHash();
       //Si le hash correspond au mot de passe saisi
       if(password_verify($_POST['pass'], $hash)){
           //On récupère son profil
            $userAccount = $user->getUserAccount();
            //On met en session ses informations
            $_SESSION['account']['id_users'] = $userAccount->id_users;
            $_SESSION['account']['nomUser'] = $userAccount->nomUser;
            $_SESSION['account']['id_roles'] = $userAccount->id_roles;

           if($_SESSION['account']['id_roles'] == 1) {
                $userAccount->id_roles;
                header('location:./index.php');
            }else {
            header('location:./tableauDeBord.php');
           //On redirige vers une autre page.
            }exit();
       }else{
           $formErrors['pass'] = $formErrors['mail'] = 'Veuillez renseigner vos identifiants valide';
       }
    }
}