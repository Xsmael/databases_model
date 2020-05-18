<?php

class   Utilisateur {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM utilisateur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM utilisateur WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}
		
	public function view_readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM v_utilisateur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}

	public function login($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM utilisateur WHERE username=? AND password=?");
		$sth->execute(array($obj->username,$obj->password));		
		$_SESSION['loggedin']=1;
		$_SESSION['userData']=$sth->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($_SESSION['userData']);
		
	}
	public function logout() {
		unset($_SESSION["loggedin"]);
		unset($_SESSION["userData"]);		
		return json_encode(1);		
	}
	public function currentUser() {	
		return json_encode($_SESSION['userData']);		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO utilisateur (ID,nom,prenom,ID_profil,username,password,tel,email,ID_structure_un,derniere_connexion,date_creation,supprimer) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);");
		$sth->execute(array($obj->ID,$obj->nom,$obj->prenom,$obj->ID_profil,$obj->username,$obj->password,$obj->tel,$obj->email,$obj->ID_structure_un,$obj->derniere_connexion,$obj->date_creation,$obj->supprimer));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE utilisateur SET ID = IF(? = NULL, ID , ?), nom = IF(? = NULL, nom , ?), prenom = IF(? = NULL, prenom , ?), ID_profil = IF(? = NULL, ID_profil , ?), username = IF(? = NULL, username , ?), password = IF(? = NULL, password , ?), tel = IF(? = NULL, tel , ?), email = IF(? = NULL, email , ?), ID_structure_un = IF(? = NULL, ID_structure_un , ?), derniere_connexion = IF(? = NULL, derniere_connexion , ?), date_creation = IF(? = NULL, date_creation , ?), supprimer = IF(? = NULL, supprimer , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->nom,$obj->nom,$obj->prenom,$obj->prenom,$obj->ID_profil,$obj->ID_profil,$obj->username,$obj->username,$obj->password,$obj->password,$obj->tel,$obj->tel,$obj->email,$obj->email,$obj->ID_structure_un,$obj->ID_structure_un,$obj->derniere_connexion,$obj->derniere_connexion,$obj->date_creation,$obj->date_creation,$obj->supprimer,$obj->supprimer,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM utilisateur WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>