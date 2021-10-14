<?php
if(isset($_GET['id_Clients'])){
    $clients = new clients();
    $updatedClient = new clients();
    $clients->id_Clients = $_GET['id_Clients'];
    if($clients->getClient()){
        $clients = $clients->getClient();
    }else {
        $modifyClientMessageFail = 'Ce Client n\'éxiste pas';
    } 
}
        
$formErrors = array();
if(isset($_POST['modify'])){

    //instancier notre requete de la class clients
    if(!empty($_POST['nomClients'])){
        //J'hydrate mon instance d'objet 
        $updatedClient->nomClients = htmlspecialchars($_POST['nomClients']);
    }else{
        $formErrors['nomClients'] = 'Renseigner le nom de client' ;
    }

    if(empty($formErrors)){
        // On verify si le nomClients a été modifié
        if ($clients->nomClients != $updatedClient->nomClients){
            //On vérifie si le pseudo est libre
            if($updatedClient->checkClientExist()){
                $formErrors['nomClients'] = 'Le nom de client déja utilisé';
            }else {
                $updatedClient->id_Clients = $_GET['id_Clients'];
                if($updatedClient->modifyClient()){
                    $message = 'Le client a bien été modifié';
                }else {
                    $message = 'pas de modification';
                }
            }
        }else{
            $message = 'Vous n\'avez rien changé';
        }
    }
}
