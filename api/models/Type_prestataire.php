<?php

class   Type_prestataire {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM type_prestataire");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM type_prestataire WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function search($obj) {		
		$queryString= "";
		foreach ($obj as $key => $value) {
			if($queryString!="") $queryString= $queryString.' AND ';
			$queryString= $queryString.$key. ' = "'. $value.'"';
		 }
		$sth = $this->dbh->prepare("SELECT * FROM type_prestataire WHERE  ".$queryString);
		$sth->execute();		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}


	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO type_prestataire (ID,nom,classification) VALUES (?,?,?);");
		$sth->execute(array($obj->ID,$obj->nom,$obj->classification));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE type_prestataire SET ID = IF(? = NULL, ID , ?), nom = IF(? = NULL, nom , ?), classification = IF(? = NULL, classification , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->nom,$obj->nom,$obj->classification,$obj->classification,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM type_prestataire WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>