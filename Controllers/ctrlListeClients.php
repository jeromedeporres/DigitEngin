<?php
$clients = new clients();
if(isset($_POST['sendSearch'])){
    $search = htmlspecialchars($_POST['search']);
    
    $resultsNumber = $clients->countSearchResult($search);
    $link = 'listeClients.php?search=' . $_GET['search'] . '&sendSearch=';
    if($resultsNumber == 0 ){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $searchMessage = 'Il y a ' . $resultsNumber . ' résultats';
        $listeClients = $clients->searchCatListByName($search);
    }
}else{
    $listeClients = $clients->getClient();
    $resultsNumber = count($listeClients);
    $searchMessage = 'Il y a ' . $resultsNumber . ' clients';
    $link = 'listeClients.php?';
}

if(!empty($_GET['idDelete'])){
    $clients->id_Clients = htmlspecialchars($_GET['idDelete']);
}else if(!empty($_POST['idDelete'])){
    $clients->id_Clients = htmlspecialchars($_POST['idDelete']);
}else {
    $deleteMessage = 'Aucun utilisateur n\'a été sélectionné';
}
if(isset($_POST['confirmDelete'])){
               if($clients->deleteClient());
                header('location:./listeClients.php'); 
            }else {
                $message = 'une erreur est survenue lors de la suppression';       
    }