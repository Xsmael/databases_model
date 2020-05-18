<?php
function __autoload($className){
	include_once("../models/$className.php");	
}
include("../db_config.php");
$sous_categorieObj=new Sous_categorie($DB['HOST'],$DB['USER'],$DB['PASS'],$DB['DB']);
$_POST = json_decode(file_get_contents('php://input'), true);

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

switch($_POST['action']) {
	case 'read_all':
		print $sous_categorieObj->readAll();		
	break;
	
	case 'read':
		print $sous_categorieObj->read();		
	break;
		

	case 'read_by_category_id':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $sous_categorieObj->readByCategoryID($jsonObj);		
	break;

	case 'create':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $sous_categorieObj->create($jsonObj);		
	break;
	
	case 'delete':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $sous_categorieObj->delete($jsonObj);		
	break;
	
	case 'update':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $sous_categorieObj->update($jsonObj);				
	break;
	
	default:
		print 'INVALID REQUEST';
	break;
}

exit();