<?php
class engins
{
	public $id_Engins = 0;
	public $nomTypes = '';
	public $numeroEngin = '';
	public $id_equipements  = 0;
	public $dernierRevision = '';
	public $km_reel = '';
	public $heure_jour = '';
	public $horametre = '';
	public $prochainRevision = '';
	public $id_Clients  = '';
    public $nomClients = '';
    public $description = '';
    public $id_statut = 0;
    public $nomEquipements = '';
    public $nomStatut = '';
    public $imageObservation = '';
    public $debutPoste = '';
    public $finPoste = '';
   	private $db = null;
	public function __construct()
	{
		try {
            $this->db = new PDO('mysql:host=localhost;dbname=digit_engin;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
	}

    public function getEngin(){
        $getEngin = $this->db->prepare(
            'SELECT `id_Engins`, `numeroEngin`
            FROM `engins`;'
        );
        $getEngin->execute();
        return $getEngin->fetchAll(PDO::FETCH_OBJ);
    }
    
    
	public function getEnginsByNumber(){
        $getEngNumber = $this->db->prepare(
            'SELECT `id_engins`, `numeroEngin`, `id_types`
            FROM `engins`;'
        );
        $getEngNumber->execute();
        return $getEngNumber->fetchAll(PDO::FETCH_OBJ);
    }

	public function getEnginsByClients() {
        $getEnginsByClientsQuery = $this->db->prepare(
            'SELECT `id_Engins`,  `id_Types`, `numeroEngin`,/* `id_equipements`, */ `id_statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`id_Clients`,`image`
            FROM `engins`
            WHERE `id_Engins` = :id_Engins'
            );
            $getEnginsByClientsQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
            $getEnginsByClientsQuery->execute();
            return $getEnginsByClientsQuery->fetchAll(PDO::FETCH_OBJ);
    }

/*     public function getAnomaliesByEngin() {
        $getAnomaliesByEnginQuery = $this->db->prepare(
            'SELECT `anomalies`.`description`, `ImageAnom1` ,`ImageAnom2`, `ImageAnom3`
            FROM `anomalies`
            WHERE `id_Engins` = :id_Engins'
            );
            $getAnomaliesByEnginQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
            $getAnomaliesByEnginQuery->execute();
            return $getAnomaliesByEnginQuery->fetchAll(PDO::FETCH_OBJ);
    }
 */


public function checkEnginsExist(){ 
    $checkEnginsExistQuery = $this->db->prepare(
        'SELECT COUNT(`id_Engins`) AS `isEnginsExist`
        FROM `engins` 
        WHERE `typeEngin` = :typeEngin AND `numeroEngin` = :numeroEngin'
    );
    $checkEnginsExistQuery->bindvalue(':typeEngin', $this->typeEngin, PDO::PARAM_STR);
    $checkEnginsExistQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
    $checkEnginsExistQuery->execute();
    $data = $checkEnginsExistQuery->fetch(PDO::FETCH_OBJ);
    return $data->isEnginsExist; 
}
public function checkIdEnginsExist(){
    $checkIdEnginsExistQuery = $this->db->prepare(
        'SELECT COUNT(`id_Engins`) AS `isIdEnginsExist`
        FROM `engins`
        WHERE `id_Engins` = :id_Engins'
    );
    $checkIdEnginsExistQuery->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
    $checkIdEnginsExistQuery->execute();
    $data = $checkIdEnginsExistQuery->fetch(PDO::FETCH_OBJ);
    return $data->isIdEnginsExist; 
    }     
public function addEngins(){
//$db devient une instance de l'objet PDO
// on fait une requête préparée
        $addEnginsQuery = $this->db->prepare(
// Marqueur nominatif
//bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
//$this-> : permet d'acceder aux attributs de l'instance qui est en cours
			'INSERT INTO `engins` ( `numeroEngin`,`nomEquipements`, `id_statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`id_Clients`,`image`,`id_types`)
        VALUES( :numeroEngin, :nomEquipements, :id_statut,:dernierRevision, :km_reel, :heure_jour, :horametre, :prochainRevision, :id_Clients, :image,:id_types)'
        );
        $addEnginsQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
        $addEnginsQuery->bindvalue(':nomEquipements', $this->nomEquipements, PDO::PARAM_STR);
		$addEnginsQuery->bindvalue(':id_statut', $this->id_statut, PDO::PARAM_INT);
        $addEnginsQuery->bindvalue(':dernierRevision', $this->dernierRevision, PDO::PARAM_STR);
        $addEnginsQuery->bindvalue(':km_reel', $this->km_reel, PDO::PARAM_INT);
		$addEnginsQuery->bindvalue(':heure_jour', $this->heure_jour, PDO::PARAM_STR);
		$addEnginsQuery->bindvalue(':horametre', $this->horametre, PDO::PARAM_INT);
		$addEnginsQuery->bindvalue(':prochainRevision', $this->prochainRevision, PDO::PARAM_STR);
		$addEnginsQuery->bindvalue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
		$addEnginsQuery->bindvalue(':image', $this->image, PDO::PARAM_STR);
        $addEnginsQuery->bindvalue(':id_types', $this->id_types, PDO::PARAM_INT);

/*                 $addEnginsQuery->execute();
                $addEnginsQuery = $this->db->prepare(
                    'SELECT `id_Engins`
                    FROM `engins`
                    ORDER BY `id_Engins` desc limit 1;');
               $addEnginsQuery->execute();
               $row=$addEnginsQuery->fetch(PDO::FETCH_OBJ);
               $addEnginsQuery = $this->db->prepare(
                'INSERT INTO `anomalies` (`id_Engins`)
                VALUES (:id_Engins);'); 
            $addEnginsQuery->bindvalue(':id_Engins', $row->id_Engins, PDO::PARAM_STR);
 */            return  $addEnginsQuery->execute();


    }


public function getEnginsList($orderBy) {
    $getEnginsListQuery = $this->db->query(

    /*     'SELECT * 
        FROM `engins`
        CROSS JOIN types ON engins.id_Engins  = types.id_types
         INNER JOIN equipements ON engins.id_Engins = equipements.id_equipements
        INNER JOIN anomalies ON engins.id_Engins = anomalies.id_anomalies
        INNER JOIN clients ON engins.id_Engins = clients.id_clients
        ORDER BY '.$orderBy.' ;' */
        
    /*     'SELECT `engins`.`id_Engins`, `nomTypes`, `nomClients` , `numeroEngin`,`nomEquipements`,  `description`, `ImageAnom1` ,`ImageAnom2`, `ImageAnom3`, `statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`image` 
        FROM `clients` 
        INNER JOIN `engins` ON `clients`.`id_clients` = `engins`.`id_clients` 
        INNER JOIN `types` ON `types`.`id_types` = `engins`.`id_types` 
        INNER JOIN `equipements` ON `equipements`.`id_equipements` = `engins`.`id_equipements`
        INNER JOIN `anomalies` ON `engins`.`id_Engins`= `anomalies`.`id_Engins`
        ORDER BY '.$orderBy.' ;'  */

        'SELECT TIME_FORMAT(horametre,"%H:%i") AS horametre, `engins`.`id_Engins`, `nomTypes`, `nomClients` , `numeroEngin`,`nomEquipements`,  /*  `anomalies`.`description`, `ImageAnom1` ,`ImageAnom2`, `ImageAnom3`,  */`nomStatut`,`dernierRevision`, `km_reel` , `heure_jour`,  `prochainRevision`,`image`, `engins`.`id_types` 
        FROM `engins` 
     JOIN `clients`
     JOIN `types` 
    /*  JOIN `equipements` */
     JOIN `statut` 
         /* JOIN `anomalies`  */
        WHERE `clients`.`id_clients` = `engins`.`id_clients` 
        AND `types`.`id_types` = `engins`.`id_types` 
        /* AND `equipements`.`id_equipements` = `engins`.`id_equipements` */
        /* AND `anomalies`.`id_Engins` = `engins`.`id_Engins` */
        AND `engins`.`id_Engins` = `engins`.`id_Engins`
        AND `statut`.`id_statut` = `engins`.`id_statut`
        GROUP BY `engins`.`id_engins` 
        ORDER BY '.$orderBy.';' 
        );
    return $getEnginsListQuery->fetchAll(PDO::FETCH_OBJ);
    }

    /* DEBUT POSTE */
    public function getInfoByEngin() {
        $getInfoByEnginQuery = $this->db->prepare(
            'SELECT `km_reel`
            FROM `engins`
            WHERE `id_Engins` = :id_Engins'
        );
        $getInfoByEnginQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        $getInfoByEnginQuery->execute();
        return $getInfoByEnginQuery->fetch(PDO::FETCH_OBJ);
    } 


       public function getEnginsInfo() {
        $getEnginsInfoQuery = $this->db->prepare(
            'SELECT `id_types`, `numeroEngin`, `nomEquipements`,`imageObservation`, `debutPoste`, `finPoste`, `id_statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`id_Clients`, `engins`.`image`
            FROM `engins`
            WHERE `id_Engins` = :id_Engins'
        );
        $getEnginsInfoQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        $getEnginsInfoQuery->execute();
        return $getEnginsInfoQuery->fetch(PDO::FETCH_OBJ);
    } 
    public function modifyEnginsInfo(){
        $modifyEnginsInfoQuery = $this->db->prepare(
           'UPDATE `engins` 
           SET  /* `id_Engins` = :id_Engins,  */
           `numeroEngin` = :numeroEngin, 
        /*    `id_equipements` = :id_equipements,  */
           `id_statut` = :id_statut,
           `dernierRevision` = :dernierRevision, 
           `km_reel` = :km_reel, 
           /* `heure_jour` = :heure_jour, */ 
           `horametre` = :horametre, 
           `prochainRevision` = :prochainRevision,
           `id_Clients` = :id_Clients,
           `image` = :image,
           `id_types` = :id_types
           WHERE `id_Engins` = :id_Engins'
        );
        $modifyEnginsInfoQuery->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        $modifyEnginsInfoQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
/*         $modifyEnginsInfoQuery->bindvalue(':id_equipements', $this->id_equipements, PDO::PARAM_INT);
 */		$modifyEnginsInfoQuery->bindvalue(':id_statut', $this->id_statut, PDO::PARAM_INT);
        $modifyEnginsInfoQuery->bindvalue(':dernierRevision', $this->dernierRevision, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':km_reel', $this->km_reel, PDO::PARAM_INT);
		/* $modifyEnginsInfoQuery->bindvalue(':heure_jour', $this->heure_jour, PDO::PARAM_STR) */;
		$modifyEnginsInfoQuery->bindvalue(':horametre', $this->horametre, PDO::PARAM_STR);
		$modifyEnginsInfoQuery->bindvalue(':prochainRevision', $this->prochainRevision, PDO::PARAM_STR);
		$modifyEnginsInfoQuery->bindvalue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':image', $this->image, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':id_types', $this->id_types, PDO::PARAM_INT);
        return $modifyEnginsInfoQuery->execute();
    }
    public function addDebutPoste(){
        $addDebutPosteQuery = $this->db->prepare(
           'UPDATE `engins` 
           SET   `id_Engins` = :id_Engins,
           `debutPoste` = :debutPoste,  
           `numeroEngin` = :numeroEngin,            
           `km_reel` = :km_reel, 
           `nomEquipements` = :nomEquipements, 
           `imageObservation` = :imageObservation,
           `observation` = :observation
           WHERE `id_Engins` = :id_Engins'
        );
        $addDebutPosteQuery->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        $addDebutPosteQuery->bindvalue(':debutPoste', $this->debutPoste, PDO::PARAM_STR);
        $addDebutPosteQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
        $addDebutPosteQuery->bindvalue(':km_reel', $this->km_reel, PDO::PARAM_INT);
        $addDebutPosteQuery->bindvalue(':nomEquipements', $this->nomEquipements, PDO::PARAM_STR);
		$addDebutPosteQuery->bindvalue(':imageObservation', $this->imageObservation, PDO::PARAM_STR);
		$addDebutPosteQuery->bindvalue(':observation', $this->observation, PDO::PARAM_STR);
        return $addDebutPosteQuery->execute();
    }

    public function addFinPoste(){
        $addFinPosteQuery = $this->db->prepare(
           'UPDATE `engins` 
           SET   `id_Engins` = :id_Engins,  
           `finPoste` = :finPoste,  
           `numeroEngin` = :numeroEngin,            
           `km_reel` = :km_reel, 
           `nomEquipements` = :nomEquipements, 
           `imageObservation` = :imageObservation,
           `observation` = :observation
           WHERE `id_Engins` = :id_Engins'
        );
        $addFinPosteQuery->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        $addFinPosteQuery->bindvalue(':finPoste', $this->finPoste, PDO::PARAM_STR);
        $addFinPosteQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
        $addFinPosteQuery->bindvalue(':km_reel', $this->km_reel, PDO::PARAM_INT);
        $addFinPosteQuery->bindvalue(':nomEquipements', $this->nomEquipements, PDO::PARAM_STR);
		$addFinPosteQuery->bindvalue(':imageObservation', $this->imageObservation, PDO::PARAM_STR);
		$addFinPosteQuery->bindvalue(':observation', $this->observation, PDO::PARAM_STR);
        return $addFinPosteQuery->execute();
    }

    public function modifyHorametre(){
        $modifyHorametreQuery = $this->db->prepare(
            'UPDATE `engins`
            SET `horametre` = (`finPoste` - `debutPoste`)
            WHERE `id_Engins` = :id_Engins'
        );
        $modifyHorametreQuery->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT); 
        return $modifyHorametreQuery->execute();
    }

    public function deleteEngins() {
        $deleteEnginsQuery = $this->db->prepare(
            'DELETE FROM `engins`
            WHERE `id_Engins` = :id_Engins'
        );
        $deleteEnginsQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        return $deleteEnginsQuery->execute();
    }

}