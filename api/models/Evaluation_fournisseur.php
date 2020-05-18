<?php

class   Evaluation_fournisseur {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM evaluation_fournisseur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM evaluation_fournisseur WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO evaluation_fournisseur (ID,Id_Critereevaluation,Id_Evaluation,Point,Commentaire) VALUES (?,?,?,?,?);");
		$sth->execute(array($obj->ID,$obj->Id_Critereevaluation,$obj->Id_Evaluation,$obj->Point,$obj->Commentaire));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE evaluation_fournisseur SET ID = IF(? = NULL, ID , ?), Id_Critereevaluation = IF(? = NULL, Id_Critereevaluation , ?), Id_Evaluation = IF(? = NULL, Id_Evaluation , ?), Point = IF(? = NULL, Point , ?), Commentaire = IF(? = NULL, Commentaire , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->Id_Critereevaluation,$obj->Id_Critereevaluation,$obj->Id_Evaluation,$obj->Id_Evaluation,$obj->Point,$obj->Point,$obj->Commentaire,$obj->Commentaire,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM evaluation_fournisseur WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>