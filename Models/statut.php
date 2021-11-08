<?php
class statut
{
	public $id_statut = 0;
	public $nomStatut = '';
	private $db = null;
	public function __construct()
	{
        $this->db = dataBase::getInstance();
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