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
$respmsg=isset($_POST["RESPMSG"]) ? $_POST["RESPMSG"] : "";
$eid = "";
$gstin = "";
$email = "";
$type = "";
$redirect = "";
if ($custom != "") {
    $arr = split("_", $custom);
    $eid = $arr[0];
    $gstin = $arr[1];
    $email = $arr[2];
    $type = $arr[3];
}
if ($type == "direct")
    $redirect = "employer.php";
elseif ($type == "directComp")
    $redirect = "comp.php";
elseif ($type == "dueComp")
    $redirect = "comp.php";
//echo $redirect;
$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, $PAYTM_MERCHANT_KEY, $paytmChecksum);
//will return TRUE or FALSE string.

if ($isValidChecksum == "TRUE") {
    if ($tranStatus == "TXN_SUCCESS") {
        $response = PaytmRequest::getTransactionStatus($mid, $orderId, $paytmChecksum);
        $respmsg=$response["RESPMSG"];
        if ($response["STATUS"] == "TXN_SUCCESS") {
            $orderData = array();
            if ($type == "dueComp") {
                updateManpowerOrderSucccess($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, "YES");
                $orderData = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumberNew", array($orderId));
                $message="Dear Sir/Mam<br> Payment of Rs. ".$orderData[0]["total"].") for Order Number:".$orderData[0]["order_number"]." is recieved. Thank you. <br><br>Team FLEXIHIRE";
                sendEmail("Flexihire-Payment", $message, $email);
                header('Location: ../../../' . $redirect . '?action=employer_order&msg=' . urlencode("Thank you."));
            } else {
                $orderData = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumber", array($orderId));
                updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate,"YES");
                $cartIds = explode(",", $orderData[0]["cartid"]);
                $remain = 10 - intval(getHiredCandidatesByEmployerCount($mysqli, $eid));
                $refundAmount = 0;
                $refundCustomerName = "";
                $refundBillingAddress = "";
                $refundGstin = "";
                $refundHsn = "";
                $refundDescription = "";
                $refundStateCode = "";
                $refundStateName = "";
                $success = array();
                $failed = array();
                $consolInvoiceNumber = "";
                $consoleInvoiceNumberCis = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
                if (count($cartIds) > 0) {
                    for ($i = 0; $i < count($cartIds); $i++) {
                        $dataCart = array();
                        $dataCart = $dbHelper -> getData($mysqli, "sp_getInprocessTempCartById", array($cartIds[$i]));
                        if ($i == 0) {
                            $tempInvoiceAmount = $orderData[0]["service_charge"];
                            $tempCgst = 0;
                            $tempSgst = 0;
                            $tempIgst = 0;
                            $tempTotal = 0;
                            if ($dataCart[0]["state_code"] == "07") {
                                $tempCgst = $tempInvoiceAmount * 9 / 100;
                                $tempSgst = $tempInvoiceAmount * 9 / 100;
                                $tempTotal = $tempInvoiceAmount + $tempCgst + $tempSgst;
                            } else {
                                $tempIgst = $tempInvoiceAmount * 18 / 100;
                                $tempTotal = $tempInvoiceAmount + $tempIgst;
                            }

                            Invoice::insertInvoice($dbHelper, $mysqli, array("", $orderId, $consoleInvoiceNumberCis, $dataCart[0]["state_code"], $dataCart[0]["state_name"], $dataCart[0]["customer_name"], $dataCart[0]["billing_address"], $dataCart[0]["gstin"], "CMCORPS INTEGRATED SERVICES PRIVATE LIMITED", "Service charge for using Flexihire", "9997", "07", "Delhi", "", "", $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal));

                            $refundCustomerName = $dataCart[0]["customer_name"];
                            $refundBillingAddress = $dataCart[0]["billing_address"];
                            $refundGstin = $dataCart[0]["gstin"];
                            $refundHsn = $dataCart[0]["hsn"];
                            $refundDescription = $dataCart[0]["description"];
                            $refundStateCode = $dataCart[0]["state_code"];
                            $refundStateName = $dataCart[0]["state_name"];
                            $consolInvoiceNumber = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
                            GenerateInvoice::generateCmcorpsInvoice("../../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consoleInvoiceNumberCis)), '../../../invoice/generated/');
                        }

                        $invoiceNumber = Invoice::generateInvoiceNumber($dbHelper, $mysqli);
                        $tempInvoiceAmount = $dataCart[0]["period"] * $dataCart[0]["sal"];
                        $tempCgst = 0;
                        $tempSgst = 0;
                        $tempIgst = 0;
                        $tempTotal = 0;
                        if ($dataCart[0]["state_code"] == $dataCart[0]["provider_state_code"]) {
                            $tempCgst = $tempInvoiceAmount * 9 / 100;
                            $tempSgst = $tempInvoiceAmount * 9 / 100;
                            $tempTotal = $tempInvoiceAmount + $tempCgst + $tempSgst;
                        } else {
                            $tempIgst = $tempInvoiceAmount * 18 / 100;
                            $tempTotal = $tempInvoiceAmount + $tempIgst;
                        }
                        Invoice::insertInvoice($dbHelper, $mysqli, array($invoiceNumber, $orderId, $consolInvoiceNumber, $dataCart[0]["state_code"], $dataCart[0]["state_name"], $dataCart[0]["customer_name"], $dataCart[0]["billing_address"], $dataCart[0]["gstin"], $dataCart[0]["provider_name"], $dataCart[0]["description"], $dataCart[0]["hsn"], $dataCart[0]["provider_state_code"], $dataCart[0]["provider_state_name"], $dataCart[0]["period"], $dataCart[0]["sal"], $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal));
                        $result = hireCandidateCart($dbHelper, $mysqli, $dataCart[0]["cart_emp_job_id"], $dataCart[0]["cart_avid"], $orderData[0]["id"]);
                        if ($result[0] != "Success") {
                            array_push($failed, $cartIds[$i]);
                            $refundAmount = $refundAmount + $tempInvoiceAmount;
                        } else {
                            array_push($success, $result[6]);
                            $dbHelper -> performOperation($mysqli, "sp_deleteInprocessCart", array($cartIds[$i]));
                        }
                        if ($refundAmount > 0) {
                            $refundCgst = 0;
                            $refundSgst = 0;
                            $refundIgst = 0;
                            $refundTotal = 0;
                            if ($dataCart[0]["state_code"] == "07") {
                                $refundCgst = $refundAmount * 9 / 100;
                                $refundSgst = $refundAmount * 9 / 100;
                                $refundTotal = $refundAmount + $refundCgst + $refundSgst;
                            } else {
                                $refundIgst = $refundAmount * 18 / 100;
                                $refundTotal = $refundAmount + $refundIgst;
                            }
                            $dbHelper -> performOperation($mysqli, "sp_insertRefund", array($eid, $orderId, $refundTotal, $refundAmount, $refundCgst, $refundSgst, $refundIgst, $refundCustomerName, $refundBillingAddress, $refundGstin, $refundHsn, $refundDescription, $refundStateCode, $refundStateName, $consolInvoiceNumber));
                            $responseRefund = PaytmRequest::refundTransaction($tranId, $orderId, $refundAmount, "candidate not available");
                            $dbHelper -> performOperation($mysqli, "sp_updateRefund", array($responseRefund["ORDERID"], $responseRefund["STATUS"], $responseRefund["REFID"], $responseRefund["TXNID"]));
                        }
                    }

                }
                GenerateInvoice::generateConsoleInvoice("../../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consolInvoiceNumber)), '../../../invoice/generated/');
                $emailDeatil = array($email, $refundCustomerName, $orderId);
                header('Location: ../../../' . $redirect . '?action=order_success&success=' . urlencode(json_encode($success)) . '&failed=' . urldecode(json_encode($failed)) . '&email_detail=' . urlencode(json_encode($emailDeatil)));
            }
        } else {
            $paid="NO";
            if($type == "dueComp")
                $paid="CREDIT";
            $tranId = isset($_POST["TXNID"]) ? $_POST["TXNID"] : "";
            $bankTranId = isset($_POST["BANKTXNID"]) ? $_POST["BANKTXNID"] : "";
            $tranStatus = isset($_POST["STATUS"]) ? $_POST["STATUS"] : "";
            $modifiedDate = isset($_POST["TXNDATE"]) ? $_POST["TXNDATE"] : "";
            $gateway = isset($_POST["GATEWAYNAME"]) ? $_POST["GATEWAYNAME"] : "";
            $bankName = isset($_POST["BANKNAME"]) ? $_POST["BANKNAME"] : "";
            $amount = isset($_POST["TXNAMOUNT"]) ? $_POST["TXNAMOUNT"] : "";

            updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate,$paid);
            header('Location: ../../../' . $redirect . '?action=order_failed&msg=' . urlencode($respmsg."Transaction failed.Please try again later."));
        }

    } else {
        $paid="NO";
        if($type == "dueComp")
            $paid="CREDIT";
        updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate,$paid);
        header('Location: ../../../' . $redirect . '?action=order_failed&msg=' . urlencode($respmsg."Transaction failed.Please try again later."));
    }

     /*if (isset($_POST) && count($_POST) > 0) {
     foreach ($_POST as $paramName => $paramValue) {
     echo "<br/>" . $paramName . " = " . $paramValue;
     }
     }*/
} else {

    header('Location: ../../../' . $redirect .'?action=order_failed&msg=' . urlencode("Checksum mismatched.Please try again later."));
    //Process transaction as suspicious.
}

function updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate,$paid) {
    $result = $dbHelper -> performOperation($mysqli, 'sp_updateManpowerOrder', array($orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, $paid));
    return $result;
}

function updateManpowerOrderSucccess($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate,$paid) {
    $result = $dbHelper -> performOperation($mysqli, 'sp_updateManpowerOrderSucccess', array($orderId, $tranId, $tranStatus, $bankTranId, $bankName, $gateway, $modifiedDate, $paid));
    return $result;
}

function updateHired($dbHelper, $mysqli, $hid, $orderId) {
    $result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateOrder', array($hid, $orderId));
    return $result;
}

function hireCandidateCart($dbHelper, $mysqli, $empJobId, $avId, $orderId) {
    $mobilecode = sprintf("%06d", mt_rand(200000, 999999));
    $hireCandidate = new HireCandidate;
    $availability = array();
    $availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
    $job = array();
    $job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
    $params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $avId, $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode, $job[0]["emp_job_loc_id"]);
    $result = $dbHelper -> multiquery($mysqli, 'trs_hireCandidate', $params, "Select @fromdate,@toDate,@mobile,@comp,@address,@outId;", array('@fromdate', '@toDate', '@mobile', '@comp', '@address', '@outId'));
    if ($result[0] == "Success") {
        updateHired($dbHelper, $mysqli, $result[6], $orderId);
        //echo "Candidate hired successfully.";
        $mobile = $result[3];
        $compName = urlencode($result[4]);
        $address = urlencode($result[5]);
        $message = "You%20have%20been%20hired%20for%20period%20$result[1]%20to%20$result[2]%20by%20$compName.%20Reporting%20address%20is%20$address.%20OTP%20for%20joining%20is%20:%20$mobilecode.";
        sendSms($mobile, $message);
    }
    return $result;
}

function calulateServiceCharge($dbHelper, $mysqli, $totalAmount, $totalNum,$empJobId=0) {
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

function getHiredCandidatesByEmployerCount($mysqli, $employer) {
    $data = array();

    $query = "SELECT count(*) as count
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        inner join hired_candidates
                        on hired_candidates.hcid = member_details.uid
                        where members.user_role='200'
                        and hired_candidates.heid='" . $employer . "'
                        
                        
                         $sql order by members.id DESC
                        ";

    $result = $mysqli -> query($query);
    while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
        array_push($data, $row);
    }

    return $data[0]["count"];
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