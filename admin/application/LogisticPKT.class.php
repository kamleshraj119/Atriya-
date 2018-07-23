<?php
class LogisticPKT {
	function LogisticPKT() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getLogisticPktType($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getLogisticPktType', array($id));
		return $data;
	}
    
    function insertLogistictPktType($dbHelper, $mysqli,$name) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertLogistictPktType', array($name));
    }

	function insertLogistictPktTypeAdmin($dbHelper, $mysqli) {
		$name = $this -> clean($_REQUEST["name"]);
		$this->insertLogistictPktType($dbHelper, $mysqli,$name);
		header('Location: admin.php?action=master_logistic_pkt_type');
	}

	function updateLogisticPktType($dbHelper, $mysqli, $id, $name) {
		return $dbHelper -> performOperation($mysqli, 'sp_updateLogisticPktType', array($id, $name));
	}

    function updateLogisticPktTypeAdmin($dbHelper, $mysqli) {
        $id = $this -> clean($_REQUEST["id"]);
        $name = $this -> clean($_REQUEST["name"]);
        $this->updateLogisticPktType($dbHelper, $mysqli, $id, $name);
        header('Location: admin.php?action=master_logistic_pkt_type');
    }

	function deleteLogisticPktType($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteLogisticPktType', array($id));
	}
    
    function deleteLogisticPktTypeAdmin($dbHelper, $mysqli, $id) {
        $this->deleteLogisticPktType($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=master_logistic_pkt_type');
    }
    
    
    function getLogisticPktTypeAtt($dbHelper, $mysqli, $id) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getLogisticPktTypeAtt', array($id));
        return $data;
    }
    
    function insertLogistictPktTypeAtt($dbHelper, $mysqli,$lid,$name,$value,$unit) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertLogistictPktTypeAtt', array($lid,$name,$value,$unit));
    }

    function insertLogistictPktTypeAttAdmin($dbHelper, $mysqli) {
        $lid = $this -> clean($_REQUEST["lid"]);
        $name = $this -> clean($_REQUEST["name"]);
        $value = $this -> clean($_REQUEST["val"]);
        $unit = $this -> clean($_REQUEST["unit"]);
        $this->insertLogistictPktTypeAtt($dbHelper, $mysqli, $lid, $name, $value, $unit);
        header('Location: admin.php?action=master_logistic_pkt_type_att');
    }

    function updateLogisticPktTypeAtt($dbHelper, $mysqli, $id, $name,$value,$unit,$lid) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateLogisticPktTypeAtt', array($id, $name,$value,$unit,$lid));
    }

    function updateLogisticPktTypeAttAdmin($dbHelper, $mysqli) {
        $id = $this -> clean($_REQUEST["id"]);
        $lid = $this -> clean($_REQUEST["lid"]);
        $name = $this -> clean($_REQUEST["name"]);
        $value = $this -> clean($_REQUEST["val"]);
        $unit = $this -> clean($_REQUEST["unit"]);
        $this->updateLogisticPktTypeAtt($dbHelper, $mysqli, $id, $name, $value, $unit, $lid);
        header('Location: admin.php?action=master_logistic_pkt_type_att');
    }

    function deleteLogisticPktTypeAtt($dbHelper, $mysqli, $id) {
        $dbHelper -> performOperation($mysqli, 'sp_deleteLogisticPktTypeAtt', array($id));
    }
    
    function deleteLogisticPktTypeAttAdmin($dbHelper, $mysqli, $id) {
        $this->deleteLogisticPktTypeAtt($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=master_logistic_pkt_type_att');
    }

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

	
}
?>