<?php
$types = new types();
if(isset($_POST['sendSearch'])){
    $search = htmlspecialchars($_POST['search']);
    
    $resultsNumber = $types->countSearchResult($search);
    $link = 'listetypes.php?search=' . $_GET['search'] . '&sendSearch=';
    if($resultsNumber == 0 ){
        $searchMessage = 'Aucun resultat ne correspond à votre recherche';
    }else{
        $searchMessage = 'Il y a ' . $resultsNumber . ' résultats';
        $listeTypes = $types->searchTypesByName($search);
    }
}else{
    $listeTypes = $types->getType();
    $resultsNumber = count($listeTypes);
    $searchMessage = 'Il y a ' . $resultsNumber . ' types';
    $link = 'listeTypes.php?';
}

if(!empty($_GET['idDelete'])){
    $types->id_types = htmlspecialchars($_GET['idDelete']);
}else if(!empty($_POST['idDelete'])){
    $types->id_types = htmlspecialchars($_POST['idDelete']);
}else {
    $deleteMessage = 'Aucun utilisateur n\'a été sélectionné';
}
if(isset($_POST['confirmDelete'])){
               if($types->deleteType());
                header('location:./listeTypes.php'); 
            }else {
                $message = 'une erreur est survenue lors de la suppression';       
    }