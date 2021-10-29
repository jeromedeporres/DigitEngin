<?php
if(isset($_GET['id_equipements'])){
    $equipements = new equipements();
    $updatedEquipements = new equipements();
    $equipements->id_equipements = $_GET['id_equipements'];
    if($equipements->getEquipementsInfo()){
        $equipements = $equipements->getEquipementsInfo();
    }else {
        $modifyMessageFail = '<i class="fas fa-exclamation-triangle"></i> Cette equipements n\'éxiste pas';
    } 
}
        
$formErrors = array();
if(isset($_POST['modify'])){

    //instancier notre requete de la class equipements
    if(!empty($_POST['nomEquipements'])){
        //J'hydrate mon instance d'objet equipements
        $updatedEquipements->nomEquipements = htmlspecialchars($_POST['nomEquipements']);
    }else{
        $formErrors['nomEquipements'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Renseigner le nom de l\'equipement</div>' ;
    }

    if(empty($formErrors)){
        // On verify si le nomEquipements a été modifié
        if ($equipements->nomEquipements != $updatedEquipements->nomEquipements){
            //On vérifie si le pseudo est libre
            if($updatedEquipements->checkEquipementsExist()){
                $formErrors['nomEquipements'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Le nom d\'equipement déja existe</div>';
            }else {
                $updatedEquipements->id_equipements = $_GET['id_equipements'];
                if($updatedEquipements->modifyEquipements()){
				
                    $modifyMessageSuccess = '<i class="far fa-check-circle"></i>L\'equipement a bien été modifié';
                }else {
                    $modifyMessageFail = '<i class="fas fa-exclamation-triangle"></i> Pas de modification';
                }
            }
        }else{
            $modifyMessageFail ='<i class="fas fa-exclamation-triangle"></i> Pas de changements';
        }
    }
}
