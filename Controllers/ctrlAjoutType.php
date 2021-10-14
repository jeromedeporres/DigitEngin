<?php
$formErrors = array();
$types = new types();
 /*  if (isset($_POST['addType'])) {  */
    if (!empty($_POST['nomTypes'])) {
        $types->nomTypes = htmlspecialchars($_POST['nomTypes']);
    } else {
        $formErrors['nomTypes'] = 'L\'information n\'est pas renseigné';
    }
   // Validation//
   if (empty($formErrors['nomTypes'])) { 
    if (!$types->checkTypeExist()){ 
       if($types->addType()){
           $addTypesMessage = 
           '<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> Le Type d\'engin a bien été ajouté</div>';
       } else {
           $addTypesMessage = 
           '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.</div>';
       }
   } else {
       $addTypesMessage = 
       '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Le Type d\'engin existe.</div>';
   } 
}   
/*    }    */