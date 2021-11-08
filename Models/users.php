<?php
class users{
    public $id_users = 0;
    public $nomUser = '';
    public $pass = '';
    public $mail = '';
    public $id_roles = 1;
    private $db = null;
    private $table = 'users';

    public function __construct()
    {
        $this->db = dataBase::getInstance();
    }
/**
 * Méthode permettant d'enregistrer un utilisateur
 * @return boolean
 */
public function addUser(){
	$addUser = $this->db->prepare('
		INSERT INTO ' . $this->table . '
		(`nomUser`, `mail`, `pass`, `id_roles`)
		VALUES (:nomUser, :mail, :pass, :id_roles)
	');
	$addUser->bindValue(':nomUser',$this->nomUser,PDO::PARAM_STR);
	$addUser->bindValue(':mail',$this->mail,PDO::PARAM_STR);
	$addUser->bindValue(':pass',$this->pass,PDO::PARAM_STR);
	$addUser->bindValue(':id_roles',$this->id_roles,PDO::PARAM_INT);
	return $addUser->execute();
}
/**
     * Méthode permettant de savoir une valeur d'un champ est déjà prise    
     * Valeur de retour :
     *  - True : la valeur est déjà prise
     *  - False : la valeur est disponible
     * @param array $field
     * @return boolean
     */
    public function checkUserUnavailabilityByFieldName($field){
        $whereArray = [];
        foreach($field as $fieldName ){
            $whereArray[] = '`' . $fieldName . '` = :' . $fieldName;
        }
        $where = ' WHERE ' . implode(' AND ', $whereArray);
        $checkUserUnavailabilityByFieldName = $this->db->prepare('
            SELECT COUNT(`id_users`) as `isUnavailable`
            FROM ' . $this->table 
            . $where
        ); 
        foreach($field as $fieldName ){
            $checkUserUnavailabilityByFieldName->bindValue(':'.$fieldName,$this->$fieldName,PDO::PARAM_STR);
        }
        $checkUserUnavailabilityByFieldName->execute();
        return $checkUserUnavailabilityByFieldName->fetch(PDO::FETCH_OBJ)->isUnavailable;
    }


    /**
     * Méthode permettant de récupérer le hash du mot de passe de l'utilisateur
     *
     * @return void
     */
    public function getUserPasswordHash(){
        $getUserPasswordHash = $this->db->prepare(
            'SELECT `pass` 
            FROM ' . $this->table 
            . ' WHERE `mail` = :mail'
        );
        $getUserPasswordHash->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getUserPasswordHash->execute();
        $response = $getUserPasswordHash->fetch(PDO::FETCH_OBJ);
        if(is_object($response)){
            return $response->pass;
        }else{
            return '';
        }
    }
/**
 * Méthode permettant de récupérer les différentes infos d'un utilisateur
 * 
 * @return object
 */
    public function getUserAccount(){
        $getUserAccount = $this->db->prepare(
            'SELECT `id_users`, `nomUser`, id_roles
            FROM ' . $this->table .
            ' WHERE `mail` = :mail'
        );
        $getUserAccount->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $getUserAccount->execute();
        return $getUserAccount->fetch(PDO::FETCH_OBJ);
    }
    public function getUsersList() {
        $getUsersListQuery = $this->db->query(
            'SELECT `id_users`, `id_roles`, `nomUser`, `mail`
            FROM `users`'
            );
        return $getUsersListQuery->fetchAll(PDO::FETCH_OBJ);
        }
    public function getProfilUser() {
        $getProfilUserQuery = $this->db->prepare(
            'SELECT `id_users`, `nomUser`, `mail`
            FROM `users`
            WHERE `id_users` = :id_users '
        );
        $getProfilUserQuery->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $getProfilUserQuery->execute();
        return $getProfilUserQuery->fetch(PDO::FETCH_OBJ);
    }
    public function checkIdUsersExist() {
        $checkIdUsersExistQuery = $this->db->prepare(
            'SELECT COUNT(`id_users`) AS `isIdUserExist`
            FROM `users` 
            WHERE `id_users` = :id_users '
        );
        $checkIdUsersExistQuery->bindvalue(':id_users', $this->id_users, PDO::PARAM_INT);
        $checkIdUsersExistQuery->execute();
        $data = $checkIdUsersExistQuery->fetch(PDO::FETCH_OBJ);
        return $data->isIdUserExist; 
    } 
    public function modifyUserProfil(){
        $modifyUserProfilQuery = $this->db->prepare(
           'UPDATE `users` 
           SET `nomUser` = :nomUser, `mail` = :mail
           WHERE `id_users` = :id_users '
        );
        $modifyUserProfilQuery->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        $modifyUserProfilQuery->bindValue(':nomUser', $this->nomUser, PDO::PARAM_STR);
        $modifyUserProfilQuery->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $modifyUserProfilQuery->execute();
    }
    public function deleteUsers() {
        $deleteUsersQuery = $this->db->prepare(
            'DELETE FROM `users`
            WHERE `id_users` = :id_users'
        );
        $deleteUsersQuery->bindValue(':id_users', $this->id_users, PDO::PARAM_INT);
        return $deleteUsersQuery->execute();
    }
}