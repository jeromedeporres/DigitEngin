<?php
$formErrors = array();

$engins = new engins();
$enginsListe = $engins->getEngin();

if (isset($_POST['id_Engins'])) {
    $engins ->id_Engins = htmlspecialchars($_POST['id_Engins']);
    $enginsInfo = $engins->getEnginsInfo();
}

if (isset($_POST['addFinPoste'])) {

    /* NUMERO ENGIN */
    if (!empty(['numeroEngin'])) {
         $engins->numeroEngin = htmlspecialchars($enginsInfo->numeroEngin);
     } else {
        $formErrors['numeroEngin'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> L\'information n\'est pas renseigné</div>';
    } 
 
/* L'HEURE */
if (!empty($_POST['finPoste'])) {
	$engins->finPoste = $_POST['finPoste'];
} else {
$formErrors['finPoste'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné le kilométrage</div>';
}

/* CTRL KM REEL */
if (!empty($_POST['km_reel'])) {
	$engins->km_reel = $_POST['km_reel'];
} else {
$formErrors['km_reel'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné le kilométrage</div>';
}

/* CTRL EQUIPEMENTS */
if (!empty($_POST['nomEquipements'])) {
	$engins->nomEquipements = $_POST['nomEquipements'];
} else {
$formErrors['nomEquipements'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné l\'equipements</div>';
}

/* CTRL OBSERVATION */
if (!empty($_POST['observation'])) {
	$engins->observation = $_POST['observation'];
} else {
$formErrors['observation'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné l\'observation</div>';
}


/* IMAGE */
    if (!empty($_FILES['imageObservation']) && $_FILES['imageObservation']['error'] == 0) {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['imageObservation']['name']);
        // On crée un tableau contenant les extensions autorisées.
        $fileExtension = ['jpg', 'jpeg', 'png','JPG','JPEG', 'PNG'];
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array($fileInfos['extension'], $fileExtension)) {
          //On définit le chemin vers lequel uploader le fichier
          $path = './Assets/ImgAnomalies/';
          //On crée une date pour différencier les fichiers
          $date = date('Y-m-d_H-i-s');
          //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
          $fileNewName = $_FILES['imageObservation']['name'];
          //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
          $imageObservation = $path . $fileNewName ;
          //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
          if (move_uploaded_file($_FILES['imageObservation']['tmp_name'], $imageObservation)) {
            //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
            chmod($imageObservation, 0644);
            $engins->imageObservation = $imageObservation;
          }else {
            $formErrors['imageObservation'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Votre fichier ne s\'est pas téléversé correctement</div>';
          }
        }else {
          $formErrors['imageObservation'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Votre fichier n\'est pas du format attendu</div>';
        }
    }else {
      $engins->imageObservation = $enginsInfo->imageObservation;
      }

    if (empty($formErrors)) { 
    if ($engins->checkIdEnginsExist() > 0 ){ 
            if($engins->addFinPoste()){
				if($engins->modifyHorametre()){
               $addFinPoste = '<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> Les informations à bien été ajouté.</div>'; 
            } else {
                $addFinPoste = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.</div>';
            }
		}
       }  else {
            $addDebutPoste = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> L\'engin existe.</div>';
        }  
     } 
}