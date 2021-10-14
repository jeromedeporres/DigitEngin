<?php
class anomalies
{
	public $id_anomalies = 0;
	public $description = '';
    public $imageAnom1 = '';
    public $imageAnom2 = '';
    public $imageAnom3 = '';
	private $db = null;
	public function __construct()
	{
		try {
            $this->db = new PDO('mysql:host=localhost;dbname=digit_engin;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
	}
	public function checkAnomaliesExist(){
        $checkAnomaliesExist = $this->db->prepare(
            'SELECT COUNT(`id_anomalies`) AS `isAnomaliesExist`
            FROM `anomalies` 
            WHERE `description` = :description'
        );
        $checkAnomaliesExist->bindvalue(':description', $this->description, PDO::PARAM_STR);
        $checkAnomaliesExist->execute();
        return $checkAnomaliesExist->fetch(PDO::FETCH_OBJ)->isAnomaliesExist;
    }
	public function getAnomalies(){
        $getAnomalies = $this->db->prepare(
            'SELECT `id_anomalies`, `description`,`imageAnom1`,`imageAnom2`,`imageAnom3`
            FROM `anomalies`'
        );
        $getAnomalies->execute();
        return $getAnomalies->fetchAll(PDO::FETCH_OBJ);
    }
	public function checkidAnomaliesExist(){
        $checkidAnomaliesExist = $this->db->prepare(
            'SELECT COUNT(`id_anomalies`) AS `isIdAnomaliesExist`
            FROM `anomalies` 
            WHERE `id_anomalies` = :id_anomalies'
        );
        $checkidAnomaliesExistQuery->bindvalue(':id_anomalies', $this->id_anomalies, PDO::PARAM_INT);
        $checkidAnomaliesExistQuery->execute();
        $data = $checkidAnomaliesExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isIdAnomaliesExist;     
    } 
	public function addAnomalies(){
     
            $addAnomaliesQuery = $this->db->prepare(    
                'INSERT INTO `anomalies` (`description`)
                VALUES (:description)'
            );
            $addAnomaliesQuery->bindvalue(':description', $this->description, PDO::PARAM_STR);
            return $addAnomaliesQuery->execute();
   
    }
	public function modifyAnomalies(){
        $modifyAnomaliesQuery = $this->db->prepare(
           'UPDATE `anomalies` 
           SET `description` = :description
           WHERE `id_anomalies` = :id_anomalies'
        );
        $modifyAnomaliesQuery->bindValue(':description', $this->description, PDO::PARAM_STR);
        $modifyAnomaliesQuery->bindValue(':id_anomalies', $this->id_anomalies, PDO::PARAM_INT);
        return $modifyAnomaliesQuery->execute();
     }

    public function deleteAnomalies() {
        $deleteAnomaliesQuery = $this->db->prepare(
            'DELETE FROM `anomalies`
            WHERE `id_anomalies` = :id_anomalies'
        );
        $deleteAnomaliesQuery->bindValue(':id_anomalies', $this->id_anomalies, PDO::PARAM_INT);
        return $deleteAnomaliesQuery->execute();
    }
}