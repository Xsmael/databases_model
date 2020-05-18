<?php

class   Fournisseur {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM fournisseur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function view_readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM v_fournisseur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}

	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM fournisseur WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		
		$sth = $this->dbh->prepare("INSERT INTO fournisseur (ID,nom,IFU,RCCM,personne_contact,ID_ville,tel,rue,email,secteur,ID_type_prestataire,ID_categorie,ID_sous_categorie,ID_utilisateur,ID_statut,date_creation,supprimer) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
		$sth->execute(array($obj->ID,$obj->nom,$obj->IFU,$obj->RCCM,$obj->personne_contact,$obj->ID_ville,$obj->tel,$obj->rue,$obj->email,$obj->secteur,$obj->ID_type_prestataire,$obj->ID_categorie,$obj->ID_sous_categorie,$obj->ID_utilisateur,$obj->ID_statut,$obj->date_creation,$obj->supprimer));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE fournisseur SET ID = IF(? = NULL, ID , ?), nom = IF(? = NULL, nom , ?), IFU = IF(? = NULL, IFU , ?), RCCM = IF(? = NULL, RCCM , ?), personne_contact = IF(? = NULL, personne_contact , ?), ID_ville = IF(? = NULL, ID_ville , ?), tel = IF(? = NULL, tel , ?), rue = IF(? = NULL, rue , ?), email = IF(? = NULL, email , ?), secteur = IF(? = NULL, secteur , ?), ID_type_prestataire = IF(? = NULL, ID_type_prestataire , ?), ID_categorie = IF(? = NULL, ID_categorie , ?), ID_sous_categorie = IF(? = NULL, ID_sous_categorie , ?), ID_utilisateur = IF(? = NULL, ID_utilisateur , ?), ID_statut = IF(? = NULL, ID_statut , ?), date_creation = IF(? = NULL, date_creation , ?), supprimer = IF(? = NULL, supprimer , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->nom,$obj->nom,$obj->IFU,$obj->IFU,$obj->RCCM,$obj->RCCM,$obj->personne_contact,$obj->personne_contact,$obj->ID_ville,$obj->ID_ville,$obj->tel,$obj->tel,$obj->rue,$obj->rue,$obj->email,$obj->email,$obj->secteur,$obj->secteur,$obj->ID_type_prestataire,$obj->ID_type_prestataire,$obj->ID_categorie,$obj->ID_categorie,$obj->ID_sous_categorie,$obj->ID_sous_categorie,$obj->ID_utilisateur,$obj->ID_utilisateur,$obj->ID_statut,$obj->ID_statut,$obj->date_creation,$obj->date_creation,$obj->supprimer,$obj->supprimer,$obj->ID));
		return json_encode(1);
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM fournisseur WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>