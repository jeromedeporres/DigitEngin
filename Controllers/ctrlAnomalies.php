<?php
/* $regexPrice = '^([1-9]|([1-9][0-9]+))\.[0-9]{2}$^';
$regexName = '^([A-ÿ0-9\ \%\-\.\/\,\;\:\!\?\(\)\'\"\€\&])+$^';
$regexRef = '^[[:alnum:]]+^';
$formErrors = array(); */
//instancier notre requete de la class categories
$anomalies = new anomalies();
/* $anomalies = $anomalies->getAnomalies(); */

if (isset($_POST['addAnomalies'])) {
//instancier notre requete de la class anomalies
    $anomalies = new anomalies();
//verification formulaire pour ajouter un anomalies
    if (!empty($_POST['description'])) {
        $anomalies->description = htmlspecialchars($_POST['description']);
    } else {
        $formErrors['description'] = 'L\'information n\'est pas renseigné';
    }

$engins = new engins();
$numeroListe = $engins->getEnginsByNumber();





/* CTRL description */
if (!empty($_POST['description'])) {
	$anomalies->description = $_POST['description'];
} else {
$formErrors['description'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas donner une description</div>';
}

	/* IMAGE */
    if (!empty($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // On stock dans $fileInfos les informations concernant le chemin du fichier.
        $fileInfos = pathinfo($_FILES['image']['name']);
        // On crée un tableau contenant les extensions autorisées.
        $fileExtension = ['jpg', 'jpeg', 'png','JPG','JPEG', 'PNG'];
        // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
        if (in_array($fileInfos['extension'], $fileExtension)) {
          //On définit le chemin vers lequel uploader le fichier
          $path = './Assets/Img/';
          //On crée une date pour différencier les fichiers
          $date = date('Y-m-d_H-i-s');
          //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
          $fileNewName = $_FILES['image']['name'];
          //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
          $EnginPhoto = $path . $fileNewName ;
          //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
          if (move_uploaded_file($_FILES['image']['tmp_name'], $EnginPhoto)) {
            //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
            chmod($EnginPhoto, 0644);
            $engins->image = $EnginPhoto;
          }else {
            $formErrors['image'] = 'Votre fichier ne s\'est pas téléversé correctement';
          }
        }else {
          $formErrors['image'] = 'Votre fichier n\'est pas du format attendu';
        }
    }else {
        $formErrors['image'] = 'Veuillez selectionner un fichier';
    }

}
