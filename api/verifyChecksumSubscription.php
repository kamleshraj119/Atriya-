<?php
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
require_once ('PaytmRequest.class.php');
require_once ('ResponseCreator.php');
include "../include/psl-config.php";
require_once ('../admin/application/DBHelper.class.php');
require_once ('../admin/application/HireCandidate.class.php');
require_once ('../admin/application/Invoice.class.php');
require_once '../admin/application/GenerateInvoice.class.php';
require_once ('../admin/application/User.class.php');
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = FALSE;
$res = new ResponseCreator;
$paramList = $_REQUEST;// Array having paytm response

$param=array();
$paytmChecksum = isset($_REQUEST["CHECKSUMHASH"]) ? $_REQUEST["CHECKSUMHASH"] : "";
//echo $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
//Sent by Paytm pg
$authtoken = $_REQUEST["authtoken"];
//$paramJson = $_REQUEST["param_json"];
$mid=isset($_REQUEST["MID"]) ? $_REQUEST["MID"] : "";
$orderId = isset($_REQUEST["ORDERID"]) ? $_REQUEST["ORDERID"] : "";
$tranId = isset($_REQUEST["TXNID"]) ? $_REQUEST["TXNID"] : "";
$bankTranId = isset($_REQUEST["BANKTXNID"]) ? $_REQUEST["BANKTXNID"] : "";
$tranStatus = isset($_REQUEST["STATUS"]) ? $_REQUEST["STATUS"] : "";
$modifiedDate = isset($_REQUEST["TXNDATE"]) ? $_REQUEST["TXNDATE"] : "";
$gateway = isset($_REQUEST["GATEWAYNAME"]) ? $_REQUEST["GATEWAYNAME"] : "";
$bankName = isset($_REQUEST["BANKNAME"]) ? $_REQUEST["BANKNAME"] : "";
$amount = isset($_REQUEST["TXNAMOUNT"]) ? $_REQUEST["TXNAMOUNT"] : "";
$custom=isset($_REQUEST["MERC_UNQ_REF"]) ? $_REQUEST["MERC_UNQ_REF"] : "";

$param["MID"]=$mid;
$param["ORDERID"]=$orderId;
$param["TXNID"]=$tranId;
$param["BANKTXNID"]=$bankTranId;
$param["STATUS"]=$tranStatus;
$param["TXNDATE"]=$modifiedDate;
$param["GATEWAYNAME"]=$gateway;
$param["BANKNAME"]=$bankName;
$param["TXNAMOUNT"]=$amount;
$param["MERC_UNQ_REF"]=$custom;
$param["CHECKSUMHASH"]=$paytmChecksum;
$param["CURRENCY"]=$_REQUEST["CURRENCY"];
$param["RESPCODE"]=$_REQUEST["RESPCODE"];
$param["RESPMSG"]=$_REQUEST["RESPMSG"];
$param["PAYMENTMODE"]=$_REQUEST["PAYMENTMODE"];

$uid="";
$gstin="";
$email="";
if($custom!=""){
    $arr=split("_", $custom);
    $uid=$arr[0];
    $gstin=$arr[1];
    $email=$arr[2];
    $srId=$arr[3];
}
$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$user = new User;
$CUST_ID = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
if ($CUST_ID == '') {
        $res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
        $res -> message = "Invalid Access";
} else {
    $data = array();
    $data = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumber", array($orderId));
    $isValidChecksum = verifychecksum_e($param, $PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
    $data1=array();
    if($isValidChecksum=="TRUE"){
            $response=PaytmRequest::getTransactionStatus($mid, $orderId, $paytmChecksum);
            if($response["STATUS"]=="TXN_SUCCESS"){
                $orderData = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumber", array($orderId));
                updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate,"YES");
                $dataSubscriptionRate=$dbHelper->getData($mysqli, 'sp_getSubscriptionRate', array($srId));
                $sdId=$dataSubscriptionRate[0]['sd_id']; 
                $value=ceil($dataSubscriptionRate[0]['rate']); 
                $period=$dataSubscriptionRate[0]['period'];
                $unit=$dataSubscriptionRate[0]['unit'];
                $q="select member_details.mobile,member_details.name,member_details.company_name,member_details.address,member_details.gstin,states.state_name,states.code,members.user_role from member_details Left outer join members on member_details.uid=members.id LEFT outer join states on member_details.uid=states.id where member_details.uid='".$uid."'";
                $memberDetails=$dbHelper->getDataFromQuery($mysqli, $q);               
                $mobile=$memberDetails[0]['mobile'];
                subscribeUser($dbHelper, $mysqli, $sdId, $uid, $value, $period, $unit,$mobile);
                $consoleInvoiceNumberCis = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
                $tempInvoiceAmount = $orderData[0]["service_charge"];
                $tempCgst = 0;
                $tempSgst = 0;
                $tempIgst = 0;
                $tempTotal = 0;
                if ($memberDetails[0]["code"] == "07") {
                    $tempCgst = $tempInvoiceAmount * 9 / 100;
                    $tempSgst = $tempInvoiceAmount * 9 / 100;
                    $tempTotal = $tempInvoiceAmount + $tempCgst + $tempSgst;
                } else {
                    $tempIgst = $tempInvoiceAmount * 18 / 100;
                    $tempTotal = $tempInvoiceAmount + $tempIgst;
                }
                $customerName=$memberDetails[0]["name"];
                if($memberDetails[0]["user_role"]='400' || $memberDetails[0]["user_role"]='800')
                    $customerName=$memberDetails[0]["company_name"];    
                Invoice::insertInvoice($dbHelper, $mysqli, array("", $orderId, $consoleInvoiceNumberCis, $memberDetails[0]["code"], $memberDetails[0]["state_name"], $customerName, $memberDetails[0]["address"], $memberDetails[0]["gstin"], "CMCORPS INTEGRATED SERVICES PRIVATE LIMITED", "Service charge for using Skillchamps", "9973", "07", "Delhi", "", "", $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal));
                GenerateInvoice::generateCmcorpsInvoice("../../wkhtmltox/bin/",$dbHelper->getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consoleInvoiceNumberCis)),'../invoice/generated/');
                GenerateInvoice::emailInvoices($email, $customerName, $orderId, $dbHelper, $mysqli, '../invoice/generated/');    
                $res -> status = ResponseCreator::$RESPONSE_OK;
                $res -> message = "Success";
            }else {
                $tranId = isset($_POST["TXNID"]) ? $_POST["TXNID"] : "";
                $bankTranId = isset($_POST["BANKTXNID"]) ? $_POST["BANKTXNID"] : "";
                $tranStatus = isset($_POST["STATUS"]) ? $_POST["STATUS"] : "";
                $modifiedDate = isset($_POST["TXNDATE"]) ? $_POST["TXNDATE"] : "";
                $gateway = isset($_POST["GATEWAYNAME"]) ? $_POST["GATEWAYNAME"] : "";
                $bankName = isset($_POST["BANKNAME"]) ? $_POST["BANKNAME"] : "";
                $amount = isset($_POST["TXNAMOUNT"]) ? $_POST["TXNAMOUNT"] : "";
                
                updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate);
                $res->status=ResponseCreator::$OTHER_ERROR;
                $res->message="Transaction failed.Please try again later.";
            }
            
    }else{
        $res->status=ResponseCreator::$OTHER_ERROR;
        $res->message="Checksum mismatched.Please try again later.";
    }
}
echo json_encode($res);


function updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate) {
    $result = $dbHelper -> performOperation($mysqli, 'sp_updateManpowerOrder', array($orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate));
    return $result;
}

function subscribeUser($dbHelper, $mysqli, $sdId, $uid, $value,$period,$unit,$mobile) {
    $mode="BUY";
    $startDate=date('Y-m-d');
    $result=$dbHelper->performOperation($mysqli, "sp_insertUserSubscription", array($sdId,$uid,$value,$period,$unit,$mode));
    if ($result == "Success") {
        $message = "Thank%20you%20for%20choosing%20us.%20Your%20services%20is%20start%20from%20".$startDate."%20and%20will%20be%20available%20for%20next%20".$period."%20".$unit.".";
        sendSms($mobile, $message);
    }
    return $result;
}

function sendSms($varPhNo, $varMSG) {
    $varUserName = "t1cybssapi";
    $varPWD = "55200745";
    $varSenderID = "CHAMPS";
    $url = "http://nimbusit.co.in/api/swsendSingle.asp";
    $data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
    postData($url, $data);
}

function postdata($url, $data) {
    //The function uses CURL for posting data to
    $objURL = curl_init($url);
    curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($objURL, CURLOPT_POST, 1);
    curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
    $retval = trim(curl_exec($objURL));
    curl_close($objURL);
    return $retval;
}
?>
