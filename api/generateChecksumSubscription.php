<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include "../include/psl-config.php";
require_once ('ResponseCreator.php');
require_once ('../admin/application/DBHelper.class.php');
require_once ('../admin/application/User.class.php');
$checkSum = "";

// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
$dbHelper = new DBHelper;
    $mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $authtoken = $_REQUEST["authtoken"];
    $srId = $_REQUEST["sr_id"];
    $serviceCharge = $_REQUEST["service_charge"];
    $gst = $_REQUEST["gst"];
    $TXN_AMOUNT = $_REQUEST["amount_payable"];
    $ORDER_ID=substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    $mob=$_REQUEST["mobile"];
    $email=$_REQUEST["email"];
    $gstin=$_REQUEST["gstin"];
    $user = new User;
    $CUST_ID = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
    $paramList = array();
    $res = new ResponseCreator;
     if ($CUST_ID == '') {
        $res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED; 
        $res -> message = "Invalid Access";
    } else {
        $paramList["MID"] = $PAYTM_MERCHANT_MID; //Provided by Paytm
        $paramList["ORDER_ID"] = $ORDER_ID; //unique OrderId for every request
        $paramList["CUST_ID"] = $CUST_ID; // unique customer identifier 
        $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID; //Provided by Paytm
        $paramList["CHANNEL_ID"] = $CHANNEL_ID; //Provided by Paytm
        $paramList["TXN_AMOUNT"] = $TXN_AMOUNT; // transaction amount
        $paramList["WEBSITE"] = $WEBSITE;//Provided by Paytm
        $paramList["CALLBACK_URL"] = 'https://pguat.paytm.com/paytmchecksum/paytmCallback.jsp';//Provided by Paytm
        //$paramList["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID='.$ORDER_ID;//Provided by Paytm
        //$callback= "http://122.176.49.209:8080/skillchamps_site/api/verifyChecksum.php";
       // $paramList["CALLBACK_URL"] =""; 
        $paramList["EMAIL"] = $email; // customer email id
        $paramList["MOBILE_NO"] = $mob; // customer 10 digit mobile no.
        $extra=$CUST_ID.'_'.$gstin.'_'.$email.'_'.$srId;
        $paramList["MERC_UNQ_REF"] = $extra;
        $checkSum = getChecksumFromArray($paramList,$PAYTM_MERCHANT_KEY);
        $paramList["CHECKSUMHASH" ] = $checkSum;
        createOrder($dbHelper, $mysqli, $ORDER_ID, $CUST_ID, 0, $serviceCharge, $gst, $TXN_AMOUNT, $checkSum, $srId);
        $res -> status = ResponseCreator::$RESPONSE_OK;
        $res -> message = "Success";
    }
    $res -> data = $paramList;
    echo json_encode($res);
        //print_r($paramList);
function createOrder($dbHelper, $mysqli, $orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total,$checkSum,$srId) {
    $result = $dbHelper -> performOperation($mysqli, 'sp_insertManpowerOrder', array($orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total,$checkSum,$srId));
    return $result;
}

?>
