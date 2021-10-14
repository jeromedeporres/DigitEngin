<?php
$anomalies = new anomalies();
if(isset($_POST['sendSearch'])){
    $search = htmlspecialchars($_POST['search']);
    
    $resultsNumber = $anomalies->countSearchResult($search);
    $link = 'listeAnomalies.php?search=' . $_GET['search'] . '&sendSearch=';
    if($resultsNumber == 0 ){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $searchMessage = 'Il y a ' . $resultsNumber . ' résultats';
        $listeAnomalies = $anomalies->searchAnomListeByName($search);
    }
}else{
    $listeAnomalies = $anomalies->getAnomalies();
    $resultsNumber = count($listeAnomalies);
    $searchMessage = 'Il y a ' . $resultsNumber . ' anomalies';
    $link = 'listeAnomalies.php?';
}

if(!empty($_GET['idDelete'])){
    $anomalies->id_anomalies = htmlspecialchars($_GET['idDelete']);
}else if(!empty($_POST['idDelete'])){
    $anomalies->id_anomalies = htmlspecialchars($_POST['idDelete']);
}else {
    $deleteMessage = 'Aucune anomalie n\'a été sélectionné';
}
if(isset($_POST['confirmDelete'])){
               if($anomalies->deleteAnomalies());
                header('location:./listeAnomalies.php'); 
            }else {
                $message = 'une erreur est survenue lors de la suppression';       
    }