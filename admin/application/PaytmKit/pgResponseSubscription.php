<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once ("./lib/config_paytm.php");
require_once ("./lib/encdec_paytm.php");
include_once '../../include/psl-config.php';
include_once '../../include/functions.php';
require_once ('../DBHelper.class.php');
require_once ('PaytmRequest.class.php');
require_once '../HireCandidate.class.php';
require_once '../GenerateInvoice.class.php';
require_once '../Invoice.class.php';
require_once 'redirect_config.php';
//include ('Mailer.class.php');
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
//Sent by Paytm pg
$mid = isset($_POST["MID"]) ? $_POST["MID"] : "";
$orderId = isset($_POST["ORDERID"]) ? $_POST["ORDERID"] : "";
$tranId = isset($_POST["TXNID"]) ? $_POST["TXNID"] : "";
$bankTranId = isset($_POST["BANKTXNID"]) ? $_POST["BANKTXNID"] : "";
$tranStatus = isset($_POST["STATUS"]) ? $_POST["STATUS"] : "";
$modifiedDate = isset($_POST["TXNDATE"]) ? $_POST["TXNDATE"] : "";
$gateway = isset($_POST["GATEWAYNAME"]) ? $_POST["GATEWAYNAME"] : "";
$bankName = isset($_POST["BANKNAME"]) ? $_POST["BANKNAME"] : "";
$amount = isset($_POST["TXNAMOUNT"]) ? $_POST["TXNAMOUNT"] : "";
$custom = isset($_POST["MERC_UNQ_REF"]) ? $_POST["MERC_UNQ_REF"] : "";
$respmsg = isset($_POST["RESPMSG"]) ? $_POST["RESPMSG"] : "";
$eid = "";
$srId = "";
$email = "";
$type = "";
$redirect = "";
if ($custom != "") {
	$arr = split("_", $custom);
	$uid = $arr[0];
	$srId = $arr[1];
	$email = $arr[2];
	$type = $arr[3];
}

$redirect = RediectConfig::getRedirectUrl($type);

//echo $redirect;
$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, $PAYTM_MERCHANT_KEY, $paytmChecksum);
//will return TRUE or FALSE string.

if ($isValidChecksum == "TRUE") {
	if ($tranStatus == "TXN_SUCCESS") {
		$response = PaytmRequest::getTransactionStatus($mid, $orderId, $paytmChecksum);
		if ($response["STATUS"] == "TXN_SUCCESS") {
			$orderData = array();
			$orderData = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumber", array($orderId));
			updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, "YES");
			$dataSubscriptionRate = $dbHelper -> getData($mysqli, 'sp_getSubscriptionRate', array($srId));
			$sdId = $dataSubscriptionRate[0]['sd_id'];
			$value = ceil($dataSubscriptionRate[0]['rate']);
			$period = $dataSubscriptionRate[0]['period'];
			$unit = $dataSubscriptionRate[0]['unit'];
			$q = "select member_details.mobile,member_details.name,member_details.company_name,member_details.address,member_details.gstin,states.state_name,states.code,members.user_role from member_details Left outer join members on member_details.uid=members.id LEFT outer join states on member_details.uid=states.id where member_details.uid='" . $uid . "'";
			$memberDetails = $dbHelper -> getDataFromQuery($mysqli, $q);
			//print_r($memberDetails);
			$user_role = $memberDetails[0]['user_role'];
			$mobile = $memberDetails[0]['mobile'];
			subscribeUser($dbHelper, $mysqli, $sdId, $uid, $value, $period, $unit, $mobile);
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
			$customerName = $memberDetails[0]["name"];
			if ($memberDetails[0]["user_role"] = '200' || $memberDetails[0]["user_role"] == '400') {
				$customerName = $memberDetails[0]["company_name"];
				Invoice::insertInvoice($dbHelper, $mysqli, array("", $orderId, $consoleInvoiceNumberCis, $memberDetails[0]["code"], $memberDetails[0]["state_name"], $customerName, $memberDetails[0]["address"], $memberDetails[0]["gstin"], "CMCORPS INTEGRATED SERVICES PRIVATE LIMITED", "Service charge for using Flexihire", "9973", "07", "Delhi", "", "", $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal));
				GenerateInvoice::generateCmcorpsInvoice("../../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consoleInvoiceNumberCis)), '../../../invoice/generated/');
			}
			$emailDeatil = array($email, $customerName, $orderId);
			if ($user_role == '200') {
				header("Location: ../../../" . $redirect . "&msg=" . urlencode("you have subscribed successfully for plan.") . "&email_detail=$emailDeatil");
			} else if ($user_role == '400') {
				header("Location: ../../../employer.php?action=home&msg=" . urlencode("you have subscribed successfully for plan.") . "&email_detail=$emailDeatil");
			}
		}
	}

} else {

	header('Location: ../../../' . $redirect . '&msg=' . urlencode("Checksum mismatched.Please try again later."));
	//Process transaction as suspicious.
}

function updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, $paid) {
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateManpowerOrder', array($orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, $paid));
	return $result;
}

function updateManpowerOrderSucccess($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, $paid) {
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateManpowerOrderSucccess', array($orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, $paid));
	return $result;
}

function subscribeUser($dbHelper, $mysqli, $sdId, $uid, $value, $period, $unit, $mobile) {
	$mode = "BUY";
	$startDate = date('Y-m-d');
	$result = $dbHelper -> performOperation($mysqli, "sp_insertUserSubscription", array($sdId, $uid, $value, $period, $unit, $mode));
	if ($result == "Success") {
		$message = "Thank%20you%20for%20choosing%20us.%20Your%20services%20is%20start%20from%20" . $startDate . "%20and%20will%20be%20available%20for%20next%20" . $period . "%20" . $unit . ".";
		sendSms($mobile, $message);
	}
	return $result;
}

function calulateServiceCharge($dbHelper, $mysqli, $totalAmount, $totalNum, $empJobId = 0) {
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getServiceChargeApplied', array($empJobId));
	$serviceChargeFromPerHire = $data[0]["amount_per_hire"] * $totalNum;
	$serviceChargeFromPercetnatge = $data[0]["percentage_on_hire"] * $totalAmount / 100;

	if ($serviceChargeFromPerHire == $serviceChargeFromPercetnatge)
		return $serviceChargeFromPerHire;
	else if ($data[0]["rule_applied"] == "MinOfTwo")
		return $serviceChargeFromPerHire < $serviceChargeFromPercetnatge ? $serviceChargeFromPerHire : $serviceChargeFromPercetnatge;
	else
		return $serviceChargeFromPerHire > $serviceChargeFromPercetnatge ? $serviceChargeFromPerHire : $serviceChargeFromPercetnatge;
}

function calculateServiceChargeForFirstTen($totalAmount) {
	return $totalAmount * 2.5 / 100;
}

function calulateGst($totalAmount) {
	return $totalAmount * 18 / 100;
}

function sendEmail($subject, $message, $to) {
	$emailfrom = "admin@flexihire.co.in";
	$fromname = "FLEXIHIRE";
	$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
	$mailer = new Mailer;
	$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
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