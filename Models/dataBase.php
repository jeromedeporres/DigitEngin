<?php
class dataBase {
    public $db = null;
    private static $instance = null;
    public function __construct(){
        try {
            $this->db = new PDO('mysql:host='. SQL_HOST .';dbname=' . SQL_DBNAME . ';charset=utf8', SQL_USERNAME, SQL_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    //Singleton
        //Static signifie que je ne peut pas y accèder via l'instance. 
        // on y accède de cette façon: nomClass::methode() ou nomClass::attribut
    public static function getInstance(){
        //On créer une instance PDO si et seulement si il en n'existe pas déjà une
        if(is_null(self::$instance)){
            self::$instance = new dataBase();
        }
        return self::$instance->db;
    }
}