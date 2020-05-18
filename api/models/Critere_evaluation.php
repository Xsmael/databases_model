<?php

class   Critere_evaluation {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM critere_evaluation");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}

	public function view_readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM 	v_critere_evaluation");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}

	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM critere_evaluation WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO critere_evaluation (ID,ID_sous_categorie,critere) VALUES (?,?,?);");
		$sth->execute(array($obj->ID,$obj->ID_sous_categorie,$obj->critere));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE critere_evaluation SET ID = IF(? = NULL, ID , ?), ID_sous_categorie = IF(? = NULL, ID_sous_categorie , ?), critere = IF(? = NULL, critere , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->ID_sous_categorie,$obj->ID_sous_categorie,$obj->critere,$obj->critere,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM critere_evaluation WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>