<?php

class   Chauffeur {
	
	private $dbh;
	
	public function __construct($host,$username,$pass,$db,$port=3306)	{		
		$this->dbh = new PDO("mysql:host=".$host.";port=".$port.";dbname=".$db,$username,$pass);				
		$this->dbh->exec("SET CHARACTER SET utf8");
	} 

	public function readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM chauffeur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}

	public function view_readAll() {				
		$sth = $this->dbh->prepare("SELECT * FROM v_chauffeur");
		$sth->execute();
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
	}
	
	public function read($obj) {
		$sth = $this->dbh->prepare("SELECT * FROM chauffeur WHERE ID=?");
		$sth->execute(array($obj->ID));		
		return json_encode($sth->fetchAll(PDO::FETCH_ASSOC));
		
	}

	public function create($obj) {		 
		$sth = $this->dbh->prepare("INSERT INTO chauffeur (ID,nom,prenom,tel,email,permis,validite_permis,niveau,rang,experience,region,pays,ID_type_prestataire,ID_diplome,ID_ville,ID_langue,ID_categorie,ID_sous_categorie,ID_utilisateur,ID_statut,ID_disponibilite,date_creation) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
		$sth->execute(array($obj->ID,$obj->nom,$obj->prenom,$obj->tel,$obj->email,$obj->permis,$obj->validite_permis,$obj->niveau,$obj->rang,$obj->experience,$obj->region,$obj->pays,$obj->ID_type_prestataire,$obj->ID_diplome,$obj->ID_ville,$obj->ID_langue,$obj->ID_categorie,$obj->ID_sous_categorie,$obj->ID_utilisateur,$obj->ID_statut,$obj->ID_disponibilite,$obj->date_creation));	
		//$sth->execute(array($obj->dlRate, $obj->ulRate, $obj->time, $obj->cpe_id));		
		return json_encode($this->dbh->lastInsertId());
	}

	public function update($obj) {		
		$sth = $this->dbh->prepare("UPDATE chauffeur SET ID = IF(? = NULL, ID , ?), nom = IF(? = NULL, nom , ?), prenom = IF(? = NULL, prenom , ?), tel = IF(? = NULL, tel , ?), email = IF(? = NULL, email , ?), permis = IF(? = NULL, permis , ?), validite_permis = IF(? = NULL, validite_permis , ?), niveau = IF(? = NULL, niveau , ?), rang = IF(? = NULL, rang , ?), experience = IF(? = NULL, experience , ?), region = IF(? = NULL, region , ?), pays = IF(? = NULL, pays , ?), ID_type_prestataire = IF(? = NULL, ID_type_prestataire , ?), ID_diplome = IF(? = NULL, ID_diplome , ?), ID_ville = IF(? = NULL, ID_ville , ?), ID_langue = IF(? = NULL, ID_langue , ?), ID_categorie = IF(? = NULL, ID_categorie , ?), ID_sous_categorie = IF(? = NULL, ID_sous_categorie , ?), ID_utilisateur = IF(? = NULL, ID_utilisateur , ?), ID_statut = IF(? = NULL, ID_statut , ?), ID_disponibilite = IF(? = NULL, ID_disponibilite , ?), cv_link = IF(? = NULL, cv_link , ?), ref_link = IF(? = NULL, ref_link , ?), date_creation = IF(? = NULL, date_creation , ?) WHERE ID=?");
		$sth->execute(array($obj->ID,$obj->ID,$obj->nom,$obj->nom,$obj->prenom,$obj->prenom,$obj->tel,$obj->tel,$obj->email,$obj->email,$obj->permis,$obj->permis,$obj->validite_permis,$obj->validite_permis,$obj->niveau,$obj->niveau,$obj->rang,$obj->rang,$obj->experience,$obj->experience,$obj->region,$obj->region,$obj->pays,$obj->pays,$obj->ID_type_prestataire,$obj->ID_type_prestataire,$obj->ID_diplome,$obj->ID_diplome,$obj->ID_ville,$obj->ID_ville,$obj->ID_langue,$obj->ID_langue,$obj->ID_categorie,$obj->ID_categorie,$obj->ID_sous_categorie,$obj->ID_sous_categorie,$obj->ID_utilisateur,$obj->ID_utilisateur,$obj->ID_statut,$obj->ID_statut,$obj->ID_disponibilite,$obj->ID_disponibilite, $obj->cv_link,$obj->cv_link, $obj->ref_link,$obj->ref_link, $obj->date_creation,$obj->date_creation, $obj->ID));
		return json_encode(1);  
	}
	
	public function delete($obj) {				
		$sth = $this->dbh->prepare("DELETE FROM chauffeur WHERE ID=?");
		$sth->execute(array($obj->ID));
		return json_encode(1);
	}
}
?>
