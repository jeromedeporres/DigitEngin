<?php
$formErrors = array();
$equipements = new equipements();
 /*  if (isset($_POST['addType'])) {  */
    if (!empty($_POST['nomEquipements'])) {
        $equipements->nomEquipements = htmlspecialchars($_POST['nomEquipements']);
    } else {
        $formErrors['nomEquipements'] = 'L\'information n\'est pas renseigné';
    }
    // Validation//
    if (empty($formErrors['nomEquipements'])) { 
        if (!$equipements->checkEquipementsExist()){ 
           if($equipements->addEquipements()){
               $addEquipementMessage = 
               '<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> Le client a bien été ajouté</div>';
           } else {
               $addEquipementMessage = 
               '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.</div>';
           }
       } else {
           $addEquipementMessage = 
           '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Le client existe.</div>';
       } 
    }   
/*    }    */