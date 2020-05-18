<?php

function __autoload($className){
	include_once("../models/$className.php");	
}

$fileObj=new File("localhost","root","","frro");
$_POST = json_decode(file_get_contents('php://input'), true);

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

switch($_POST['action']) {
	case 'read_all':
		print $fileObj->readAll();		
	break;
	
	case 'read':
		print $fileObj->read($_POST['application_id']);		
	break;

	case 'read_photo':
		print $fileObj->readPhoto($_POST['application_id']);		
	break;
	
	case 'create':
		print $fileObj->create($_POST['type'],$_POST['url'],$_POST['application_id']);		
	break;
	
	case 'delete':
		print $fileObj->delete($_POST['id']);		
	break;
	
	case 'update':
		print $fileObj->update($_POST['id'],$_POST['field'],$_POST['newValue']);				
	break;
}

exit();

?>