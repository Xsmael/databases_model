<?php

class   File {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM file");
		$sth->execute();
		return json_encode($sth->fetchAll());
	}
	
	public function read($id) {
		$sth = $this->dbh->prepare("SELECT * FROM file WHERE application_id=?");
		$sth->execute(array($id));		
		return json_encode($sth->fetchAll());
		
	}

	public function readPhoto($id) {
		$sth = $this->dbh->prepare("SELECT * FROM file WHERE application_id=? AND type= 'Photo'");
		$sth->execute(array($id));		
		return json_encode($sth->fetchAll());
		
	}

	public function create($type,$url,$application_id) {		
		$sth = $this->dbh->prepare("INSERT INTO file (type,url,application_id) VALUES (?,?,?);");
		$sth->execute(array($type,$url,$application_id));	
		return json_encode($this->dbh->lastInsertId());
	}	
	/*
	public function create($argArray) {		
		$sth = $this->dbh->prepare("INSERT INTO file (type,url,application_id) VALUES (?,?,?);");
		$sth->execute($argArray);	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}
	*/
	public function update($id,$field,$newValue) {		
		$sth = $this->dbh->prepare("UPDATE file SET ".$field."=? WHERE id=?");
		$sth->execute(array($newValue, $id));				
		return json_encode(1);	
	}
	
	public function delete($id) {				
		$sth = $this->dbh->prepare("DELETE FROM file WHERE id=?");
		$sth->execute(array($id));
		return json_encode(1);
	}
}
?>