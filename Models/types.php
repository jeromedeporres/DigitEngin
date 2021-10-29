<?php
class types
{
	public $id_types = 0;
	public $nomTypes = '';
	private $db = null;
	public function __construct()
	{
		try {
            $this->db = new PDO('mysql:host=localhost;dbname=digit_engin;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
	}
	public function checkTypeExist(){
        $checkTypeExist = $this->db->prepare(
            'SELECT COUNT(`id_types`) AS `isTypeExist`
            FROM `types` 
            WHERE `nomTypes` = :nomTypes'
        );
        $checkTypeExist->bindvalue(':nomTypes', $this->nomTypes, PDO::PARAM_STR);
        $checkTypeExist->execute();
        return $checkTypeExist->fetch(PDO::FETCH_OBJ)->isTypeExist;
    }
	public function getType(){
        $getType = $this->db->prepare(
            'SELECT `id_types`, `nomTypes`
            FROM `types`;'
        );
        $getType->execute();
        return $getType->fetchAll(PDO::FETCH_OBJ);
    }
    
	public function checkIdTypeExist(){
        $checkIdTypeExist = $this->db->prepare(
            'SELECT COUNT(`id_types`) AS `isIdTypeExist`
            FROM `types` 
            WHERE `id_types` = :id_types'
        );
        $checkIdTypeExistQuery->bindvalue(':id_types', $this->id_types, PDO::PARAM_INT);
        $checkIdTypeExistQuery->execute();
        $data = $checkIdTypeExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isIdTypeExist;     
    } 
	public function addType(){
        try {
            $addTypeQuery = $this->db->prepare(
                'INSERT INTO `types` (`nomTypes`)
                VALUES (:nomTypes)'
            );
            $addTypeQuery->bindvalue(':nomTypes', $this->nomTypes, PDO::PARAM_STR);
            return $addTypeQuery->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
            echo $th->getMessage();
        }
    }

    public function getTypesInfo() {
        $getTypesInfoQuery = $this->db->prepare(
            'SELECT `id_types`, `nomTypes`
            FROM `types`
            WHERE `id_types` = :id_types'
        );
        $getTypesInfoQuery->bindValue(':id_types', $this->id_types, PDO::PARAM_INT);
        $getTypesInfoQuery->execute();
        return $getTypesInfoQuery->fetch(PDO::FETCH_OBJ);
    }

	public function modifyType(){
        $modifyTypeQuery = $this->db->prepare(
           'UPDATE `types` 
           SET `nomTypes` = :nomTypes
           WHERE `id_types` = :id_types'
        );
        $modifyTypeQuery->bindValue(':nomTypes', $this->nomTypes, PDO::PARAM_STR);
        $modifyTypeQuery->bindValue(':id_types', $this->id_types, PDO::PARAM_INT);
        return $modifyTypeQuery->execute();
     }

    public function deleteType() {
        $deleteTypeQuery = $this->db->prepare(
            'DELETE FROM `types`
            WHERE `id_types` = :id_types'
        );
        $deleteTypeQuery->bindValue(':id_types', $this->id_types, PDO::PARAM_INT);
        return $deleteTypeQuery->execute();
    }
}