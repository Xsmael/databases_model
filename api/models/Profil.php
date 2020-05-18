<?php

class   Profil {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM profil");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM profil WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO profil (ID,nom,droits) VALUES (?,?,?);");
		$sth->execute(array($obj->ID,$obj->nom,$obj->droits));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE profil SET ID = IF(? = NULL, ID , ?), nom = IF(? = NULL, nom , ?), droits = IF(? = NULL, droits , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->nom,$obj->nom,$obj->droits,$obj->droits,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM profil WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>