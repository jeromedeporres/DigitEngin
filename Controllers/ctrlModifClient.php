<?php
if(isset($_GET['id_Clients'])){
    $clients = new clients();
    $updatedClients = new clients();
    $clients->id_Clients = $_GET['id_Clients'];
    if($clients->getClientInfo()){
        $clients = $clients->getClientInfo();
    }else {
        $modifyMessageFail = '<i class="fas fa-exclamation-triangle"></i> Ce Client n\'éxiste pas';
    } 
}
        
$formErrors = array();
if(isset($_POST['modify'])){

    //instancier notre requete de la class clients
    if(!empty($_POST['nomClients'])){
        //J'hydrate mon instance d'objet clients
        $updatedClients->nomClients = htmlspecialchars($_POST['nomClients']);
    }else{
        $formErrors['nomClients'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Renseigner le nom de client</div>' ;
    }

    if(empty($formErrors)){
        // On verify si le nomClients a été modifié
        if ($clients->nomClients != $updatedClients->nomClients){
            //On vérifie si le pseudo est libre
            if($updatedClients->checkClientExist()){
                $formErrors['nomClients'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Le nom client déja existe</div>';
            }else {
                $updatedClients->id_Clients = $_GET['id_Clients'];
                if($updatedClients->modifyClient()){
				
                    $modifyMessageSuccess = '<i class="far fa-check-circle"></i> Le Client a bien été modifié';
                }else {
                    $modifyMessageFail = '<i class="fas fa-exclamation-triangle"></i> Pas de modification';
                }
            }
        }else{
            $modifyMessageFail ='<i class="fas fa-exclamation-triangle"></i> Pas de changements';
        }
    }
}
