<?php
function __autoload($className){
	include_once("../models/$className.php");	
}
include("../db_config.php");
$villeObj=new Ville($DB['HOST'],$DB['USER'],$DB['PASS'],$DB['DB']);
$_POST = json_decode(file_get_contents('php://input'), true);

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

switch($_POST['action']) {
	case 'read_all':
		print $villeObj->readAll();		
	break;
	
	case 'read':
		print $villeObj->read();		
	break;
	
	case 'create':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $villeObj->create($jsonObj);		
	break;
	
	case 'delete':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $villeObj->delete($jsonObj);		
	break;
	
	case 'update':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $villeObj->update($jsonObj);				
	break;
	
	default:
		print 'INVALID REQUEST';
	break;
}

exit();