<?php
$anomalies = new anomalies();
$listeAnomalies = $anomalies->getAnomalies(); 

$anomalies = new anomalies();
$anomaliesParEngins = $anomalies->getAnomaliesByEngin(); 


/* if(isset($_POST['sendSearch'])){
    $listeAnomalies = $anomalies->getAnomalies(); */
   /*  $resultsNumber = count($listeAnomalies);
    $searchMessage = 'Il y a ' . $resultsNumber . ' anomalies'; */
    /* $link = 'listeAnomalies.php?'; */
   /*  $search = htmlspecialchars($_POST['search']);
    
    $resultsNumber = $anomalies->countSearchResult($search);
    $link = 'listeAnomalies.php?search=' . $_GET['search'] . '&sendSearch=';
    if($resultsNumber == 0 ){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $searchMessage = 'Il y a ' . $resultsNumber . ' résultats';
        $listeAnomalies = $anomalies->searchAnomListeByName($search);
    } */
/* }else{ */
    
/* } */

if(!empty($_GET['idDelete'])){
    $anomalies->id_anomalies = htmlspecialchars($_GET['idDelete']);
}else if(!empty($_POST['idDelete'])){
    $anomalies->id_anomalies = htmlspecialchars($_POST['idDelete']);
}else {
    $deleteMessage = 'Aucune anomalie n\'a été sélectionné';
}
if(isset($_POST['confirmDelete'])){
               if($anomalies->deleteAnomalies());
                /* header('location:./listeAnomalies.php');  */
            }else {
                $message = 'une erreur est survenue lors de la suppression';       
    }