<?php
$equipements = new equipements();
if(isset($_POST['sendSearch'])){
    $search = htmlspecialchars($_POST['search']);
    
    $resultsNumber = $equipements->countSearchResult($search);
    $link = 'listeEquipements.php?search=' . $_GET['search'] . '&sendSearch=';
    if($resultsNumber == 0 ){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $searchMessage = 'Il y a ' . $resultsNumber . ' résultats';
        $listeEquipements = $equipements->searchEquipementsListByName($search);
    }
}else{
    $listeEquipements = $equipements->getEquipements();
    $resultsNumber = count($listeEquipements);
    $searchMessage = 'Il y a ' . $resultsNumber . ' equipements';
    $link = 'listeEquipements.php?';
}

if(!empty($_GET['idDelete'])){
    $equipements->id_equipements = htmlspecialchars($_GET['idDelete']);
}else if(!empty($_POST['idDelete'])){
    $equipements->id_equipements = htmlspecialchars($_POST['idDelete']);
}else {
    $deleteMessage = 'Aucun equipement n\'a été sélectionné';
}
if(isset($_POST['confirmDelete'])){
               if($equipements->deleteEquipements());
                header('location:./listeEquipements.php'); 
            }else {
                $message = 'une erreur est survenue lors de la suppression';       
    }