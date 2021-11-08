<?php
class clients {
	public $id_Clients = 0;
	public $nomClients = '';
	private $db = null;
	public function __construct(){
         $this->db = dataBase::getInstance();
        }
	public function checkClientExist(){
        $checkClientExist = $this->db->prepare(
            'SELECT * 
            FROM `clients` 
            WHERE `nomClients` = :nomClients'
        );
        $checkClientExist->bindvalue(':nomClients', $this->nomClients, PDO::PARAM_STR);
        $checkClientExist->execute();
        return $checkClientExist->fetch(PDO::FETCH_OBJ);
    }
	public function getClients(){
        $getClient = $this->db->prepare(
            'SELECT `id_Clients`, `nomClients`
            FROM `clients`;'
        );
        $getClient->execute();
        return $getClient->fetchAll(PDO::FETCH_OBJ);
    }


    public function getClient(){
        $getClient = $this->db->prepare(
            'SELECT `nomClients`
            FROM `clients`;
            WHERE `id_Clients` = :id_Clients;'
        );
        $getClient->execute();
        return $getClient->fetchAll(PDO::FETCH_OBJ);
    }

   /*  public function getClient(){
        $getClient = $this->db->prepare(
            'SELECT `nomClients`
            FROM `clients`
            WHERE `id_Clients` = :id_Clients;'
        );
        $getClient->bindvalue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
        $getClient->execute();
         $row = $getClient->fetch();
         $this->nomClients = $row['nomClients']; */
/*         return $row['nomClients'];
 */
    /* } */

	public function checkIdClientExist(){
        $checkIdClientExist = $this->db->prepare(
            'SELECT COUNT(`id_Clients`) AS `isIdClientExist`
            FROM `clients` 
            WHERE `id_Clients` = :id_Clients'
        );
        $checkIdClientExistQuery->bindvalue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
        $checkIdClientExistQuery->execute();
        $data = $checkIdClientExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isIdClientExist;     
    } 
	public function addClient(){
                 $addClientQuery = $this->db->prepare(    
                'INSERT INTO `clients` (`nomClients`)
                VALUES (:nomClients)'
            );
            $addClientQuery->bindvalue(':nomClients', $this->nomClients, PDO::PARAM_STR);
            return $addClientQuery->execute();
   
    }

    public function getClientInfo() {
        $getClientInfoQuery = $this->db->prepare(
            'SELECT `id_Clients`, `nomClients`
            FROM `clients`
            WHERE `id_Clients` = :id_Clients '
        );
        $getClientInfoQuery->bindValue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
        $getClientInfoQuery->execute();
        return $getClientInfoQuery->fetch(PDO::FETCH_OBJ);
    } 


	public function modifyClient(){
        $modifyClientQuery = $this->db->prepare(
           'UPDATE `clients` 
           SET `nomClients` = :nomClients
           WHERE `id_Clients` = :id_Clients'
        );
        $modifyClientQuery->bindValue(':nomClients', $this->nomClients, PDO::PARAM_STR);
        $modifyClientQuery->bindValue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
        return $modifyClientQuery->execute();
     }

    public function deleteClient() {
        $deleteClientQuery = $this->db->prepare(
            'DELETE FROM `clients`
            WHERE `id_Clients` = :id_Clients'
        );
        $deleteClientQuery->bindValue(':id_Clients', $this->id_Clients, PDO::PARAM_INT);
        return $deleteClientQuery->execute();
    }
}