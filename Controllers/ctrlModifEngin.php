<?php
$formErrors = array();

$types = new types();
$typesListe = $types->getType();

$statut = new statut();
$statutListe = $statut->getStatut();

$equipements = new equipements();
$equipementsListe = $equipements->getEquipements();

$clients = new clients();
$clientsListe = $clients->getClients();

if (isset($_GET ['id_Engins'])) {
    $engins = new engins();
    $engins ->id_Engins = htmlspecialchars($_GET['id_Engins']);
    $enginsInfo = $engins->getEnginsInfo();
}
if (isset($_POST['modifyEngin'])) {



    if(!empty($_POST['id_types'])){
        $types->id_types = htmlspecialchars($_POST['id_types']);
        if($types->getType()){
            $engins->id_types = $types->id_types;
        }else {
            $formErrors['id_types'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur s\'est produite.</div>';
        }
    }else {
        $formErrors['id_types'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un Type d\'engin</div>';
    }
    /* NUMERO ENGIN */
    if (!empty($_POST['numeroEngin'])) {
        $engins->numeroEngin = htmlspecialchars($_POST['numeroEngin']);
    } else {
        $formErrors['numeroEngin'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> L\'information n\'est pas renseigné</div>';
    }

/* CTRL STATUT */

if(!empty($_POST['id_statut'])){
    $statut->id_statut = htmlspecialchars($_POST['id_statut']);
    if($statut->getStatut()){
        $engins->id_statut = $statut->id_statut;
    }else {
        $formErrors['id_statut'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur s\'est produite.</div>';
    }
}else {
    $formErrors['id_statut'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un Statut d\'engin</div>';
}



/* 
if (!empty($_POST['statut'])) {
	$engins->statut = $_POST['statut'];
} else {
$formErrors['statut'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné une option</div>';
}
 */
/* CTRL DERNIER REVISION */
if (!empty($_POST['dernierRevision'])) {
	$engins->dernierRevision = $_POST['dernierRevision'];
} else {
$formErrors['dernierRevision'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné une date</div>';
}

/* CTRL PROCHAIN REVISION */
if (!empty($_POST['prochainRevision'])) {
	$engins->prochainRevision = $_POST['prochainRevision'];
} else {
$formErrors['prochainRevision'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné une date</div>';
}

/* CTRL KM REEL */
if (!empty($_POST['km_reel'])) {
	$engins->km_reel = $_POST['km_reel'];
} else {
$formErrors['km_reel'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné le kilométrage</div>';
}


/* CTRL HORAMETRE */
if (!empty($_POST['horametre'])) {
	$engins->horametre = $_POST['horametre'];
} else {
$formErrors['horametre'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné le horametre</div>';
}

/* CTRL CLIENTS */
if(!empty($_POST['id_Clients'])){
	$clients->id_Clients = htmlspecialchars($_POST['id_Clients']);
	if($clients->getClients()){
		$engins->id_Clients = $clients->id_Clients;
       
	}else {
		$formErrors['nomClients'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreid_Clientsur s\'est produite.</div>';
	}
}else {
	$formErrors['nomClients'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un client.</div>';
}


	/* CTRL EQUIPEMENTS */
	if(!empty($_POST['id_equipements'])){
		$equipements->id_equipements = htmlspecialchars($_POST['id_equipements']);
		if($equipements->getEquipements()){
			$engins->id_equipements = $equipements->id_equipements;
		}else {
			$formErrors['id_equipements'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur s\'est produite</div>';
		}
	}else {
		$formErrors['id_equipements'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un equipement</div>';
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
            $formErrors['image'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Votre fichier ne s\'est pas téléversé correctement</div>';
          }
        }else {
          $formErrors['image'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Votre fichier n\'est pas du format attendu</div>';
        }
    }else {
        $formErrors['image'] = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Veuillez selectionner un fichier</div>';
    }

    if (empty($formErrors)) {
        if (0<$engins->checkIdEnginsExist()){
            if($engins->modifyEnginsInfo()){
               $modifEnginMessage = '<div class="alert alert-success" role="alert"><i class="far fa-check-circle"></i> l\'engin a été Modifié.</div>'; 
            } else {
                $modifEnginMessage = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> Une erreur est survenue.</div>';
            }
        } else {
            $modifEnginMessage = '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i> L\'engin n\'existe pas.</div>';
        }
    }
}