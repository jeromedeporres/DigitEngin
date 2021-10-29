<?php
 $regexPrice = '^([1-9]|([1-9][0-9]+))\.[0-9]{2}$^';
$regexName = '^([A-ÿ0-9\ \%\-\.\/\,\;\:\!\?\(\)\'\"\€\&])+$^';
$regexRef = '^[[:alnum:]]+^';
$formErrors = array(); 
//instancier notre requete de la class categories
$anomalies = new anomalies();
$anomalies = $anomalies->getAnomalies();

$engins = new engins();
$numeroEnginListe = $engins->getEnginsByNumber();


if (isset($_POST['addAnomalies'])) {
//instancier notre requete de la class anomalies
    $anomalies = new anomalies();
//verification formulaire pour ajouter un anomalies
if(!empty($_POST['numeroEngin'])){
  $engins->id_Engins = htmlspecialchars($_POST['numeroEngin']);
  if($engins->getEnginsByNumber()){ 
      $anomalies->id_Engins = $engins->id_Engins; 
       }else {
      $formErrors['numeroEngin'] = 'Une erreur s\'est ';
  } 
}else {
  $formErrors['numeroEngin'] = 'Vous n\'avez pas sélectionné le ';
}


if (!empty($_POST['description'])) {
  // if (preg_match($regexName, $_POST['description'])) {
      $anomalies->description = $_POST['description'];
  // } else {
  //     $formErrors['description'] = 'Le text est pas valide';
  // }
} else {
  $formErrors['description'] = 'L\'information n\'est pas renseigné';
}




	/* IMAGE */
    if (!empty($_FILES['imageAnom1']) && $_FILES['imageAnom1']['error'] == 0) {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['imageAnom1']['name']);
        // On crée un tableau contenant les extensions autorisées.
        $fileExtension = ['jpg', 'jpeg', 'png','JPG','JPEG', 'PNG'];
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array($fileInfos['extension'], $fileExtension)) {
          //On définit le chemin vers lequel uploader le fichier
          $path = './Assets/Img/';
          //On crée une date pour différencier les fichiers
          $date = date('Y-m-d_H-i-s');
          //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
          $fileNewName = $_FILES['imageAnom1']['name'];
          //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
          $EnginPhoto = $path . $fileNewName ;
          //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
          if (move_uploaded_file($_FILES['imageAnom1']['tmp_name'], $EnginPhoto)) {
            //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
            chmod($EnginPhoto, 0644);
            $anomalies->imageAnom1 = $EnginPhoto;
          }else {
            $formErrors['imageAnom1'] = 'Votre fichier ne s\'est pas téléversé correctement';
          }
        }else {
          $formErrors['imageAnom1'] = 'Votre fichier n\'est pas du format attendu';
        }
    }else {
        $formErrors['imageAnom1'] = 'Veuillez selectionner un fichier';
    }


if (empty($formErrors)) {
  //on appelle la methode de notre model pour creer un nouveau product dans la base de données
          if (!$anomalies->checkAnomaliesExist()){
              if($anomalies->addAnomalies()){
                 $addAnomaliesMessage = '<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> L\'anomalie a bien été ajouté</div>'; 
              } else {
                  $addAnomaliesMessage = 'Une erreur est survenue.';
              }
          } else {
              $addAnomaliesMessage = 'l\'anomalie a déjà été ajouté.';
          }
      }
    }
  