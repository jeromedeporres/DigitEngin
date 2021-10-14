<?php
class engins
{
	public $id_Engins = 0;
	public $typeEngin = '';
	public $numeroEngin = '';
	public $id_equipements  = 0;
	public $statut = '';
	public $dernierRevision = '';
	public $km_reel = '';
	public $heure_jour = '';
	public $horametre = '';
	public $prochainRevision = '';
	public $id_Clients  = '';
    public $nomClients = '';
   	private $db = null;
	public function __construct()
	{
		try {
            $this->db = new PDO('mysql:host=localhost;dbname=digit_engin;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
	}
	public function getEnginsByNumber(){
        $getEngNumber = $this->db->prepare(
            'SELECT `id_engins`, `numeroEngin`
            FROM `engins`;'
        );
        $getEngNumber->execute();
        return $getEngNumber->fetchAll(PDO::FETCH_OBJ);
    }

	public function getEnginsByClients() {
        $getEnginsByClientsQuery = $this->db->prepare(
            'SELECT `id_Engins`,  `id_Types`, `numeroEngin`,`id_equipements`, `statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`id_Clients`,`image`
            FROM `engins`
            WHERE `id_Engins` = :id_Engins'
            );
            $getEnginsByClientsQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
            $getEnginsByClientsQuery->execute();
            return $getEnginsByClientsQuery->fetchAll(PDO::FETCH_OBJ);
    }

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
        $modifyEnginsInfoQuery = $this->db->prepare(
// Marqueur nominatif
//bindValue: vérifie le type et que ça ne génère pas de faille de sécurité.
//$this-> : permet d'acceder aux attributs de l'instance qui est en cours
			'INSERT INTO `engins` ( `typeEngin`, `numeroEngin`,`id_equipements`, `statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`id_Clients`,`image`)
        VALUES(:typeEngin, :numeroEngin, :id_equipements, :statut,:dernierRevision, :km_reel, :heure_jour, :horametre, :prochainRevision, :id_Clients, :image)'
        );
        $modifyEnginsInfoQuery->bindvalue(':typeEngin', $this->typeEngin, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':id_equipements', $this->id_equipements, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':statut', $this->statut, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':dernierRevision', $this->dernierRevision, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':km_reel', $this->km_reel, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':heure_jour', $this->heure_jour, PDO::PARAM_STR);
		$modifyEnginsInfoQuery->bindvalue(':horametre', $this->horametre, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':prochainRevision', $this->prochainRevision, PDO::PARAM_STR);
		$modifyEnginsInfoQuery->bindvalue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':image', $this->image, PDO::PARAM_STR);
        return $modifyEnginsInfoQuery->execute();
    }
public function getEnginsList($orderBy) {
    $getEnginsListQuery = $this->db->query(
        'SELECT `nomTypes`,`engins`.`id_Engins`, `nomClients` , `numeroEngin`,`nomEquipements`, `description`, `ImageAnom1` ,`ImageAnom2`, `ImageAnom3`, `statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`image` 
        FROM `clients` 
        INNER JOIN `engins` ON `clients`.`id_clients` = `engins`.`id_clients` 
        INNER JOIN `types` ON `types`.`id_types` = `engins`.`id_types` 
        INNER JOIN `equipements` ON `equipements`.`id_equipements` = `engins`.`id_equipements`
        INNER JOIN `anomalies` ON `anomalies`.`id_anomalies` = `engins`.`id_anomalies`
        ORDER BY '.$orderBy.' ;'
        );
    return $getEnginsListQuery->fetchAll(PDO::FETCH_OBJ);
    }
    public function getEnginsInfo() {
        $getEnginsInfoQuery = $this->db->prepare(
            'SELECT `typeEngin`, `numeroEngin`,`id_equipements`, `statut`,`dernierRevision`, `km_reel` , `heure_jour`, `horametre`, `prochainRevision`,`id_Clients`,`image`
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
           SET  `id_Engins` = :id_Engins, `typeEngin` = :typeEngin, `numeroEngin` = :numeroEngin, `id_equipements` = :id_equipements, `statut` = :statut,`dernierRevision` = :dernierRevision, `km_reel` = :km_reel, `heure_jour` = :km_reel, `horametre` = :horametre, `prochainRevision` = :prochainRevision,`id_Clients` = :id_Clients,`image` = :image
           WHERE `id_Engins` = :id_Engins'
        );
        $modifyEnginsInfoQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
        $modifyEnginsInfoQuery->bindvalue(':typeEngin', $this->typeEngin, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':numeroEngin', $this->numeroEngin, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':id_equipements', $this->id_equipements, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':statut', $this->statut, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':dernierRevision', $this->dernierRevision, PDO::PARAM_STR);
        $modifyEnginsInfoQuery->bindvalue(':km_reel', $this->km_reel, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':heure_jour', $this->heure_jour, PDO::PARAM_STR);
		$modifyEnginsInfoQuery->bindvalue(':horametre', $this->horametre, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':prochainRevision', $this->prochainRevision, PDO::PARAM_STR);
		$modifyEnginsInfoQuery->bindvalue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
		$modifyEnginsInfoQuery->bindvalue(':image', $this->image, PDO::PARAM_STR);
        return $modifyEnginsInfoQuery->execute();
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