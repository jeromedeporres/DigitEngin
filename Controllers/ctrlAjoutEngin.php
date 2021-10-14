<?php
/* if(isset($_GET['action'])){
    if($_GET['action'] == 'disconnect'){
        //Pour deconnecter l'utilisateur on détruit sa session
        session_destroy();
        //Et on le redirige vers l'accueil
        header('location:/');
        exit();
    }
} */
$regexPrice = '^([1-9]|([1-9][0-9]+))\.[0-9]{2}$^';
$regexName = '^([A-ÿ0-9\ \%\-\.\/\,\;\:\!\?\(\)\'\"\€\&])+$^';
$regexRef = '^[[:alnum:]]+^';
$formErrors = array();
//instancier notre requete de la class categories
$types = new types();
$typesListe = $types->getType();

$equipements = new equipements();
$equipementsListe = $equipements->getEquipements();

$clients = new clients();
$clientsListe = $clients->getClient();

if (isset($_POST['addEngin'])) {
//instancier notre requete de la class engins
    $engins = new engins();
//verification formulaire pour ajouter un engin
    if (!empty($_POST['numeroEngin'])) {
        $engins->numeroEngin = htmlspecialchars($_POST['numeroEngin']);
    } else {
        $formErrors['numeroEngin'] = 'L\'information n\'est pas renseigné';
    }

/* CTRL STATUT */
if (!empty($_POST['statut'])) {
	$engins->statut = $_POST['statut'];
} else {
$formErrors['statut'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné une option</div>';
}

/* CTRL DERNIER REVISION */
if (!empty($_POST['dernierRevision'])) {
	$engins->dernierRevision = $_POST['dernierRevision'];
} else {
$formErrors['dernierRevision'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné une date</div>';
}

/* CTRL PROCHAIN REVISION */
if (!empty($_POST['prochainRevision'])) {
	$engins->prochainRevision = $_POST['prochainRevision'];
} else {
$formErrors['prochainRevision'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné une date</div>';
}

/* CTRL KM REEL */
if (!empty($_POST['km_reel'])) {
	$engins->km_reel = $_POST['km_reel'];
} else {
$formErrors['km_reel'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné le kilométrage</div>';
}


/* CTRL HORAMETRE */
if (!empty($_POST['horametre'])) {
	$engins->horametre = $_POST['horametre'];
} else {
$formErrors['horametre'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas renseigné le horametre</div>';
}

/* CTRL CLIENTS */
if(!empty($_POST['id_Clients'])){
	$clients->id_Clients = htmlspecialchars($_POST['id_Clients']);
	if($types->getType()){
		$engins->id_Clients = $engins->id_Clients;
	}else {
		$formErrors['id_Clients'] = 'Une erreid_Clientsur s\'est produite';
	}
}else {
	$formErrors['id_Clients'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un client</div>';
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




    if (!empty($_POST['productReference'])) {
        if (preg_match($regexRef, $_POST['productReference'])) {
            $product->productReference = htmlspecialchars($_POST['productReference']);
        } else {
            $formErrors['productReference'] = 'Le text est pas valide';
        }
    } else {
        $formErrors['productReference'] = 'L\'information n\'est pas renseigné';
    }
    if (!empty($_POST['price'])) {
        if (preg_match($regexPrice, $_POST['price'])) {
            $product->price = htmlspecialchars($_POST['price']);
        } else {
            $formErrors['price'] = 'Le text est pas valide';
        }
    } else {
        $formErrors['price'] = 'L\'information n\'est pas renseigné';
    }


        
	/* CTRL TYPES */
	if(!empty($_POST['typeEngin'])){
            $types->id_types = htmlspecialchars($_POST['typeEngin']);
            if($types->getType()){
                $engins->id_types = $types->id_types;
            }else {
                $formErrors['typeEngin'] = 'Une erreur s\'est produite';
            }
        }else {
            $formErrors['typeEngin'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un Type d\'engin</div>';
        }

	/* CTRL EQUIPEMENTS */
	if(!empty($_POST['id_equipements'])){
		$equipements->id_equipements = htmlspecialchars($_POST['id_equipements']);
		if($equipements->getEquipements()){
			$engins->id_equipements = $equipements->id_equipements;
		}else {
			$formErrors['id_equipements'] = 'Une erreur s\'est produite';
		}
	}else {
		$formErrors['id_equipements'] = '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-triangle"></i> Vous n\'avez pas sélectionné un equipement</div>';
	}




    if (empty($formErrors)) {
        if (!$engins->checkIdEnginsExist()){
            if($engins->addEngins()){
               $addEnginMessage = 'l\'engin a été ajouté.'; 
            } else {
                $addEnginMessage = 'Une erreur est survenue.';
            }
        } else {
            $addEnginMessage = 'L\'engin existe.';
        }
    }
}