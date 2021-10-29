<?php
if(isset($_GET['id_types'])){
    $types = new types();
    $updatedTypes = new types();
    $types->id_types = $_GET['id_types'];
    if($types->getTypesInfo()){
        $types = $types->getTypesInfo();
    }else {
        $modifyMessageFail = '<i class="fas fa-exclamation-triangle"></i> Ce Type n\'éxiste pas';
    } 
}
        
$formErrors = array();
if(isset($_POST['modify'])){

    //instancier notre requete de la class types
    if(!empty($_POST['nomTypes'])){
        //J'hydrate mon instance d'objet types
        $updatedTypes->nomTypes = htmlspecialchars($_POST['nomTypes']);
    }else{
        $formErrors['nomTypes'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Renseigner le nom de type</div>' ;
    }

    if(empty($formErrors)){
        // On verify si le nomEquipements a été modifié
        if ($types->nomTypes != $updatedTypes->nomTypes){
            //On vérifie si le pseudo est libre
            if($updatedTypes->checkTypeExist()){
                $formErrors['nomTypes'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Le nom type déja existe</div>';
            }else {
                $updatedTypes->id_types = $_GET['id_types'];
                if($updatedTypes->modifyType()){
				
                    $modifyMessageSuccess = '<i class="far fa-check-circle"></i> Le Type a bien été modifié';
                }else {
                    $modifyMessageFail = '<i class="fas fa-exclamation-triangle"></i> Pas de modification';
                }
            }
        }else{
            $modifyMessageFail ='<i class="fas fa-exclamation-triangle"></i> Pas de changements';
        }
    }
}
