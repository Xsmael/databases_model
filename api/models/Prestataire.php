<?php

class   Prestataire {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM prestataire");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM prestataire WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO prestataire (ID,ID_classification,classification) VALUES (?,?,?);");
		$sth->execute(array($obj->ID,$obj->ID_classification,$obj->classification));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE prestataire SET ID = IF(? = NULL, ID , ?), ID_classification = IF(? = NULL, ID_classification , ?), classification = IF(? = NULL, classification , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->ID_classification,$obj->ID_classification,$obj->classification,$obj->classification,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM prestataire WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>