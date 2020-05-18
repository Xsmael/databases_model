<?php
session_start();

function __autoload($className){
	include_once("../models/$className.php");	
}

include("../db_config.php");
$utilisateurObj=new Utilisateur($DB['HOST'],$DB['USER'],$DB['PASS'],$DB['DB']);
$_POST = json_decode(file_get_contents('php://input'), true);

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

if($_POST['action'] != 'login') exitIfNotAuth();

switch($_POST['action']) {
	case 'read_all':
		print $utilisateurObj->readAll();		
	break;

	case 'view_read_all':
		print $utilisateurObj->view_readAll();		
	break;	
	case 'read':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $utilisateurObj->read($jsonObj);		
	break;
	
	case 'create':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $utilisateurObj->create($jsonObj);		
	break;
	
	case 'login':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $utilisateurObj->login($jsonObj);		
	break;

	case 'current_user':
		print $utilisateurObj->curentUser();		
	break;
	case 'logout':
		print $utilisateurObj->logout();		
	break;
	
	case 'delete':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $utilisateurObj->delete($jsonObj);		
	break;
	
	case 'update':
		$jsonObj = new stdClass;
		$jsonObj = (object) $_POST['obj'];
		print $utilisateurObj->update($jsonObj);				
	break;
	
	default:
		print 'INVALID REQUEST';
	break;
}

function exitIfNotAuth()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) return;
    else  exit();
}

function isLogged()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 1) return true;
    else return false;
} 

exit();