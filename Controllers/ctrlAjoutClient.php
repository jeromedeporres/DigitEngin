<?php
$formErrors = array();
$clients = new clients();
 /*  if (isset($_POST['addClient'])) {  */
  if (!empty($_POST['nomClients'])) {
            $clients->nomClients = htmlspecialchars($_POST['nomClients']);
    } else {
        $formErrors['nomClients'] = 'L\'information n\'est pas renseigné';
    }
    // Validation//
  if (empty($formErrors['nomClients'])) { 
         if (!$clients->checkClientExist()){ 
            if($clients->addClient()){
                $addClientMessage = 
                '<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> Le client a bien été ajouté</div>';
            } else {
                $addClientMessage = 
                '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.</div>';
            }
        } else {
            $addClientMessage = 
            '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Le client existe.</div>';
        } 
     }   
/*    }    */