<?php

class   Sous_categorie {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM sous_categorie");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM sous_categorie WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function readByCategoryID($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM sous_categorie WHERE 	ID_categorie=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO sous_categorie (ID,ID_categorie,nom) VALUES (?,?,?);");
		$sth->execute(array($obj->ID,$obj->ID_categorie,$obj->nom));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE sous_categorie SET ID = IF(? = NULL, ID , ?), ID_categorie = IF(? = NULL, ID_categorie , ?), nom = IF(? = NULL, nom , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->ID_categorie,$obj->ID_categorie,$obj->nom,$obj->nom,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM sous_categorie WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>