<?php

class BankDetails {

    function BankDetails() {
        set_time_limit(0);
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize', '256M');
        ini_set('post_max_size', '256M');
        ini_set('max_input_time', 600);
        ini_set('display_errors', 'on');
        error_reporting(E_ALL ^ E_NOTICE);
        error_reporting(E_ALL ^ E_NOTICE);
    }

    function clean($data) {
        $data = stripslashes($data);
        $data = htmlentities($data, ENT_QUOTES);
        return $data;
    }

    function getBankDetails($dbHelper, $mysqli, $id) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getBankDetails', array($id));
        return $data;
    }

    function saveBankDetails($dbHelper, $mysqli,$uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque) {
        return $dbHelper -> performOperation($mysqli, 'sp_saveBankDetails', array($uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque));
    }

    function deleteBankDetails($dbHelper, $mysqli, $uid) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteBankDetails', array($uid));
    }
    
    function saveBankDetailsAdmin($mysqli, $dbHelper,$redirect) {
        $uid = $this -> clean($_REQUEST["cid"]);
        $bankname = $this -> clean($_REQUEST["bank_name"]);
        $accountnumber = $this -> clean($_REQUEST["account_number"]);
        $ifsc = $this -> clean($_REQUEST["ifsc_code"]);
        $holdername = $this -> clean($_REQUEST["account_holder_name"]);
        $chaque = isset($_FILES["chequepic"]["name"])?$_FILES["chequepic"]["name"]:"";
        if (!is_dir("images/candidate/" . $uid)) {
            mkdir("images/candidate/" . $uid, 0777);
        }
        if ($chaque != '') {
            move_uploaded_file($_FILES["chequepic"]["tmp_name"], "images/candidate/" . $uid . "/" . $chaque);
        }
        $hdfc = "";
        if (strpos($bankname, 'hdfc') !== false || strpos($bankname, 'HDFC') !== false) 
            $hdfc='YES';
        else $hdfc='NO';
        $this->saveBankDetails($dbHelper, $mysqli, $uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque);
        header('Location: admin.php?action='.$redirect.'&id=' . $uid);
    }

    function deleteBankDetailsAdmin( $mysqli,$dbHelper, $uid,$redirect) {
        $this->deleteBankDetails($dbHelper, $mysqli, $uid);
        header('Location: admin.php?action='.$redirect.'&id=' . $uid);
    }

    function saveBankDetailsFront($dbHelper,$mysqli,$redirect) {
        $uid = $this -> clean($_REQUEST["cid"]);
        $bankname = $this -> clean($_REQUEST["bank_name"]);
        $accountnumber = $this -> clean($_REQUEST["account_number"]);
        $ifsc = $this -> clean($_REQUEST["ifsc_code"]);
        $holdername = $this -> clean($_REQUEST["account_holder_name"]);
        $hdfc = "";
        $chaque = isset($_FILES["chequepic"]["name"])?$_FILES["chequepic"]["name"]:"";
		
        if (!is_dir("../admin/images/candidate/" . $uid)) {
            mkdir("../admin/images/candidate/" . $uid, 0777);
        }
        if ($chaque != '') {
           
            move_uploaded_file($_FILES["chequepic"]["tmp_name"], "../admin/images/candidate/" . $uid . "/" . $chaque);
        }
        if (strpos($bankname, 'hdfc') !== false || strpos($bankname, 'HDFC') !== false) 
            $hdfc='YES';
        else $hdfc='NO';
        $this->saveBankDetails($dbHelper, $mysqli, $uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque);
        header('Location: candidate.php?action='.$redirect);
    }
    
    function deleteBankDetailsFront( $dbHelper,$mysqli, $uid,$redirect) {
        $this->deleteBankDetails($dbHelper, $mysqli, $uid);
        header('Location: candidate.php?action='.$redirect);
    }
    /*    update bank details   */
    function updateBankDetailsFront($dbHelper, $mysqli, $redirect){
    	$chaque='';	
    	$uid = $this -> clean($_REQUEST["cid"]);
        $bankname = $this -> clean($_REQUEST["bank_name"]);
        $accountnumber = $this -> clean($_REQUEST["account_number"]);
        $ifsc = $this -> clean($_REQUEST["ifsc_code"]);
        $holdername = $this -> clean($_REQUEST["account_holder_name"]);
        $chaque = isset($_FILES["chequepic"]["name"])?$_FILES["chequepic"]["name"]:"";
        if (!is_dir("../admin/images/candidate/" . $uid)) {
            mkdir("../admin/images/candidate/" . $uid, 0777);
        }
        if ($chaque != '') {
            move_uploaded_file($_FILES["chequepic"]["tmp_name"], "../admin/images/candidate/" . $uid . "/" . $chaque);
        }
        $hdfc = "";
        if (strpos($bankname, 'hdfc') !== false || strpos($bankname, 'HDFC') !== false) 
            $hdfc='YES';
        else $hdfc='NO';
		if($chaque == "" || $chaque == null){
			$result  = $this->getBankDetails($dbHelper, $mysqli, $uid);
		    $chaque=$result[0]['chaque'];
		}
    	$this->updateBankDetails($dbHelper, $mysqli, $uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque);
		header('Location: candidate.php?action='.$redirect);
    }
     function updateBankDetails($dbHelper, $mysqli,$uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque) {
        return $dbHelper -> performOperation($mysqli, 'sp_saveBankDetails', array($uid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc,$chaque));
    }
    
    /* end bank update   */
  
}
?>