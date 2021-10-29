<?php
class statut
{
	public $id_statut = 0;
	public $nomStatut = '';
	private $db = null;
	public function __construct()
	{
		try {
            $this->db = new PDO('mysql:host=localhost;dbname=digit_engin;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $error) {
            die($error->getMessage());
        }
	}

	public function getStatut(){
        $getStatut = $this->db->prepare(
            'SELECT `id_statut`, `nomStatut`
            FROM `statut`;'
        );
        $getStatut->execute();
        return $getStatut->fetchAll(PDO::FETCH_OBJ);
    }
}