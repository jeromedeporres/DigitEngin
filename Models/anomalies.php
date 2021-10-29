<?php
class anomalies
{
	public $id_anomalies = 0;
    public $id_Engins = 0;
	public $description = '';
    public $numeroEngin = '';
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
            WHERE `id_anomalies` = :id_anomalies'
        );
        $checkAnomaliesExist->bindvalue(':id_anomalies', $this->id_anomalies, PDO::PARAM_INT);
        $checkAnomaliesExist->execute();
        return $checkAnomaliesExist->fetch(PDO::FETCH_OBJ)->isAnomaliesExist;
    }

    public function getAnomaliesByEngin() {
        $getAnomaliesByEnginQuery = $this->db->prepare(
            'SELECT `engins`.`id_Engins`,`anomalies`.`description`, `engins`.`numeroEngin`
            FROM `anomalies`
            INNER JOIN `engins` ON `engins`.`id_Engins`= `anomalies`.`id_Engins`
            WHERE `engins`.`id_Engins` = :id_Engins'
            );
            $getAnomaliesByEnginQuery->bindValue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
            $getAnomaliesByEnginQuery->execute();
            return $getAnomaliesByEnginQuery->fetchAll(PDO::FETCH_OBJ);
    }



	public function getAnomalies(){
        $getAnomalies = $this->db->prepare(
            'SELECT  `anomalies`.`id_anomalies`, `anomalies`.`description`, `engins`.`numeroEngin`, `imageAnom1`,`imageAnom2`,`imageAnom3`
            FROM `engins`
            INNER JOIN `anomalies` ON `engins`.`id_Engins`= `anomalies`.`id_Engins`;'
        );
        $getAnomalies->execute();
        return $getAnomalies->fetchAll(PDO::FETCH_OBJ);
    }

    /* public function getAnomalie(){
        $getAnomalie = $this->db->prepare(
            'SELECT  `description`,  `imageAnom1`,`imageAnom2`,`imageAnom3`
            FROM `anomalies`
            INNER JOIN `engins` ON `anomalies`.`id_anomalies` = `engins`.`id_anomalies` 
            WHERE `id_Engins` = :id_Engins;'
        );
        $getAnomalie->bindvalue(':description', $this->description, PDO::PARAM_STR); */
/*         $getAnomalie->bindvalue(':imageAnom1', $this->imageAnom1, PDO::PARAM_STR);
        $getAnomalie->bindvalue(':imageAnom2', $this->imageAnom2, PDO::PARAM_STR);
        $getAnomalie->bindvalue(':imageAnom3', $this->imageAnom3, PDO::PARAM_STR);
        $getAnomalie->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
 */ /*        $getAnomalie->execute();
        return $getAnomalie->fetchAll(PDO::FETCH_OBJ);
    }
 */


/* 	public function getAnomalies(){
        $getAnomalies = $this->db->query(
            'SELECT `id_anomalies`,`description`,`numeroEngin`,`imageAnom1`,`imageAnom2`,`imageAnom3`
            FROM `anomalies`
            INNER JOIN `engins` ON `anomalies`.`id_anomalies` = `engins`.`id_Engins`'
        ); */
       /*  $getAnomalies->execute(); */
      /*   return $getAnomalies->fetchAll(PDO::FETCH_OBJ);
    } */


	public function checkidAnomaliesExist(){
        $checkidAnomaliesExistQuery = $this->db->prepare(
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
                'INSERT INTO `anomalies` (`description`, `imageAnom1`, `id_Engins`)
                VALUES (:description, :imageAnom1, :id_Engins)'
            );
            $addAnomaliesQuery->bindvalue(':description', $this->description, PDO::PARAM_STR);
            $addAnomaliesQuery->bindvalue(':imageAnom1', $this->imageAnom1, PDO::PARAM_STR);
            $addAnomaliesQuery->bindvalue(':id_Engins', $this->id_Engins, PDO::PARAM_INT);
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