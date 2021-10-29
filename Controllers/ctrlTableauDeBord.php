<?php
$engins = new engins();
$orderBy = (!empty($_POST['orderBy'])) ? htmlspecialchars($_POST['orderBy']) : 'id_Engins';
$listeEngins = $engins->getEnginsList($orderBy);


/* if(isset($_POST['sendSearch'])){
    $search = htmlspecialchars($_POST['search']);
    
    $resultsNumber = $engins->countSearchResult($search);
    $link = 'tableauDeBord.php?search=' . $_GET['search'] . '&sendSearch=';
    if($resultsNumber == 0 ){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $searchMessage = 'Il y a ' . $resultsNumber . ' résultats';
         $listeEngins = $engins->searchEnginsListByName($search); 
    }
}else{
    $orderBy = (!empty($_POST['orderBy'])) ? htmlspecialchars($_POST['orderBy']) : 'id_Engins';
    $listeEngins = $engins->getEnginsList($orderBy);
    $resultsNumber = count($listeEngins);
    $searchMessage = 'Il y a ' . $resultsNumber . ' engins';
    $link = './tableauDeBord.php?';
     $listeAnomalies=$engins->getAnomaliesByEngin($listeEngins->id_Engins); 
}
 */


if(!empty($_GET['idDelete'])){
    $engins->id_Engins = htmlspecialchars($_GET['idDelete']);
}else if(!empty($_POST['idDelete'])){
    $engins->id_Engins = htmlspecialchars($_POST['idDelete']);
}else {
    $deleteMessage = 'Aucun utilisateur n\'a été sélectionné';
}

/* if(isset($_POST['confirmDelete'])){
    if($engins->checkIdEnginsExist()){
        $engins->deleteEngins();
    }else {
        $message = 'une erreur est survenue lors de la suppression';
    }
} */

 if(isset($_POST['confirmDelete'])){
                 if($engins->deleteEngins());
                header('location:./tableauDeBord.php'); 
            }else {
                $message = 'une erreur est survenue lors de la suppression';       
    }