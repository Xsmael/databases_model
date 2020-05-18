<?php

class   Evaluation {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM evaluation");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM evaluation WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO evaluation (ID,date_evaluation,ID_user,ID_prestataire,ID_statut,ID_critere_exclusion,ID_sous_categorie,commentaire,supprimer) VALUES (?,?,?,?,?,?,?,?,?);");
		$sth->execute(array($obj->ID,$obj->date_evaluation,$obj->ID_user,$obj->ID_prestataire,$obj->ID_statut,$obj->ID_critere_exclusion,$obj->ID_sous_categorie,$obj->commentaire,$obj->supprimer));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE evaluation SET ID = IF(? = NULL, ID , ?), date_evaluation = IF(? = NULL, date_evaluation , ?), ID_user = IF(? = NULL, ID_user , ?), ID_prestataire = IF(? = NULL, ID_prestataire , ?), ID_statut = IF(? = NULL, ID_statut , ?), ID_critere_exclusion = IF(? = NULL, ID_critere_exclusion , ?), ID_sous_categorie = IF(? = NULL, ID_sous_categorie , ?), commentaire = IF(? = NULL, commentaire , ?), supprimer = IF(? = NULL, supprimer , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->date_evaluation,$obj->date_evaluation,$obj->ID_user,$obj->ID_user,$obj->ID_prestataire,$obj->ID_prestataire,$obj->ID_statut,$obj->ID_statut,$obj->ID_critere_exclusion,$obj->ID_critere_exclusion,$obj->ID_sous_categorie,$obj->ID_sous_categorie,$obj->commentaire,$obj->commentaire,$obj->supprimer,$obj->supprimer,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM evaluation WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>