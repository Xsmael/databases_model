<?php

class   Profil_action {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM profil_action");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM profil_action WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO profil_action (ID,Id_Action,Id_Profil,Activer) VALUES (?,?,?,?);");
		$sth->execute(array($obj->ID,$obj->Id_Action,$obj->Id_Profil,$obj->Activer));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE profil_action SET ID = IF(? = NULL, ID , ?), Id_Action = IF(? = NULL, Id_Action , ?), Id_Profil = IF(? = NULL, Id_Profil , ?), Activer = IF(? = NULL, Activer , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->Id_Action,$obj->Id_Action,$obj->Id_Profil,$obj->Id_Profil,$obj->Activer,$obj->Activer,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM profil_action WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>