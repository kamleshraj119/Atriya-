<?php
error_reporting(E_ALL);
class Version {

	function Version() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
	
	function getVersion($mysqli,$dbHelper,$code){
		$data=array();
		$data=$dbHelper->getData($mysqli, "sp_getVersion", array($id));
		return $data;
	}
	
	function getLatestVersion($mysqli,$dbHelper){
		$data=array();
		$data=$dbHelper->getData($mysqli, "sp_getLatestVersion", array());
		return $data;
	}
	
	function insertVersion($mysqli,$dbHelper){
		$code=$this->clean($_REQUEST["code"]);
		$name=$this->clean($_REQUEST["name"]);
		$mandatory=$this->clean($_REQUEST["mandatory"]);
		$dbHelper->performOperation($mysqli, "sp_insertVersion", array($code,$name,$mandatory));
		header('Location: admin.php?action=master_version');
	}
	
	function updateVersion($mysqli,$dbHelper){
		$oldCode=$this->clean($_REQUEST["old_code"]);
		$code=$this->clean($_REQUEST["code"]);
		$name=$this->clean($_REQUEST["name"]);
		$mandatory=$this->clean($_REQUEST["mandatory"]);
		$dbHelper->performOperation($mysqli, "sp_updateVersion", array($code,$name,$mandatory,$oldCode));
		header('Location: admin.php?action=master_version');
	}
	
	function deleteVersion($mysqli,$dbHelper,$code){
		$dbHelper->performOperation($mysqli, "sp_deleteVersion", array($code));
		header('Location: admin.php?action=master_version');
	}
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
