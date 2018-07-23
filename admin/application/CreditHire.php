<?php
include_once '../include/psl-config.php';
include_once '../include/functions.php';
require_once ('DBHelper.class.php');
require_once 'HireCandidate.class.php';
require_once 'HireCandidate.class.php';
require_once 'GenerateInvoice.class.php';
require_once 'Invoice.class.php';
$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$orderId = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$CUST_ID = $_POST["eid"];
$TXN_AMOUNT = $_POST["amount_payable"];
$cartid = isset($_REQUEST["cartid"]) ? implode(",", $_REQUEST["cartid"]) : "";
$manPowerCharge = $_POST["manpower_charge"];
$serviceCharge = $_POST["service_charge"];
$gst = $_POST["gst"];

$eid = $CUST_ID;
$mob = $_REQUEST["mobile"];
$email = $_REQUEST["email"];
$gstin = $_REQUEST["gstin"];
$type = $_REQUEST["type"];

createOrder($dbHelper, $mysqli, $orderId, $CUST_ID, $manPowerCharge, $serviceCharge, $gst, $TXN_AMOUNT, $checkSum, $cartid);
$orderData = array();
$orderData = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumber", array($orderId));
$success = array();
$failed = array();
$refundCustomerName = "";
$cartIds = explode(",", $orderData[0]["cartid"]);
$emailDeatil = array();
if (count($cartIds) > 0) {
    $consolInvoiceNumber = "";
    $newManPowerCharge = 0;
    $newServiceCharge = 0;
    $newGST = 0;
    $newTnxAmount = 0;
    
    $empJobId = "";
    $jobTypeId = "";
    for ($i = 0; $i < count($cartIds); $i++) {
        $dataCart = array();
        $dataCart = $dbHelper -> getData($mysqli, "sp_getInprocessTempCartById", array($cartIds[$i]));
        $refundCustomerName = $dataCart[0]["customer_name"];
        $empJobId = $dataCart[0]["cart_emp_job_id"];
        $jobTypeId = $dataCart[0]["job_type_id"];
        $result = hireCandidateCart($dbHelper, $mysqli, $dataCart[0]["cart_emp_job_id"], $dataCart[0]["cart_avid"], $orderData[0]["id"]);
        if ($result[0] != "Success") {
            array_push($failed, $cartIds[$i]);
        } else {
            if ($jobTypeId != "5") {
                $newManPowerCharge = $newManPowerCharge + $dataCart[0]["period"] * $dataCart[0]["sal"];
            }
            array_push($success, $result[6]);
            if ($jobTypeId != "5") {
                if (count($success) == 1)
                    $consolInvoiceNumber = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
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
            }

            $dbHelper -> performOperation($mysqli, "sp_deleteInprocessCart", array($cartIds[$i]));
        }
    }
    if ($jobTypeId != "5") {
        $hireCount = count($success);
        $newServiceCharge = calulateServiceCharge($dbHelper, $mysqli, $newManPowerCharge, $hireCount,$empJobId);
        $newManPowerCharge = $newManPowerCharge;
        $newGST = calulateGst($newManPowerCharge + $newServiceCharge);
        $manPowerCharge = $newManPowerCharge;
        $gst = $newGST;
        $serviceCharge = $newServiceCharge;
        $TXN_AMOUNT = round($manPowerCharge + $gst + $serviceCharge, 2);
        updateOrderAmount($dbHelper, $mysqli, $orderData[0]["id"], $manPowerCharge, $serviceCharge, $gst, $TXN_AMOUNT, $eid);
        $orderData = $dbHelper -> getData($mysqli, "sp_getManpowerOrderByOrderNumber", array($orderId));
        GenerateInvoice::generateConsoleInvoice("../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consolInvoiceNumber)), '../../invoice/generated/');
        $consoleInvoiceNumberCis = Invoice::generateConsoleInvoiceNumber($dbHelper, $mysqli);
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

        Invoice::insertInvoice($dbHelper, $mysqli, array("", $orderId, $consoleInvoiceNumberCis, $dataCart[0]["state_code"], $dataCart[0]["state_name"], $dataCart[0]["customer_name"], $dataCart[0]["billing_address"], $dataCart[0]["gstin"], "CMCORPS INTEGRATED SERVICES PRIVATE LIMITED", "Service charge for using Skillchamps", "9997", "07", "Delhi", "", "", $tempInvoiceAmount, $tempCgst, $tempSgst, $tempIgst, $tempTotal));
        GenerateInvoice::generateCmcorpsInvoice("../../../wkhtmltox/bin/", $dbHelper -> getData($mysqli, "sp_getInvoiceByConsoleInvoiceNumber", array($consoleInvoiceNumberCis)), '../../invoice/generated/');
        $emailDeatil = array($email, $refundCustomerName, $orderId);
    } else{
        updateOrderAmount($dbHelper, $mysqli, $orderData[0]["id"], 0, 0, 0, 0, $eid);
        $emailDeatil = array();
    }
       
    if ($type == "comp_credit") {
        header('Location: ../../comp.php?action=order_success&success=' . urlencode(json_encode($success)) . '&failed=' . urldecode(json_encode($failed)) . '&email_detail=' . urlencode(json_encode($emailDeatil)));
    } else {
        header('Location: ../admin.php?action=order_success&emp_id=' . $eid . '&emp_job_id=' . $empJobId . '&success=' . urlencode(json_encode($success)) . '&failed=' . urldecode(json_encode($failed)) . '&email_detail=' . urlencode(json_encode($emailDeatil)));
    }
} else {
    if ($type == "comp_credit") {
        header('Location: ../../comp.php?action=order_failed&msg=' . urlencode("No items in cart.Please try again later."));
    } else {
        header('Location: ../admin.php?action=order_failed&emp_id=' . $eid . '&emp_job_id=' . $empJobId . '&msg=' . urlencode("No items in cart.Please try again later."));
    }
}

function createOrder($dbHelper, $mysqli, $orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total, $checkSum, $cartid) {
    $cartArr = explode(",", $cartid);
    for ($i = 0; $i < count($cartArr); $i++) {
        $dbHelper -> performOperation($mysqli, "sp_insertInprocessCart", array($cartArr[$i]));
    }
    $result = $dbHelper -> performOperation($mysqli, 'sp_insertManpowerOrder', array($orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total, $checkSum, $cartid));
    return $result;
}

function updateOrderAmount($dbHelper, $mysqli, $orderId, $manpowerCharge, $serviceCharge, $gst, $total, $eid) {
    return $dbHelper -> performOperation($mysqli, "sp_updateManpowerOrderCredit", array($orderId, $manpowerCharge, $serviceCharge, $gst, $total, $eid));
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