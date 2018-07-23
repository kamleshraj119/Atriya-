<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include_once '../../include/psl-config.php';
include_once '../../include/functions.php';
require_once ('../DBHelper.class.php');
require_once '../HireCandidate.class.php';
$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$checkSum = "";
$paramList = array();
$type = isset($_POST["type"]) ? $_POST["type"] : "";
$ORDER_ID = $_POST["ORDER_ID"];
if($type=="dueComp"){
    $orderNumberNew=substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    generateNewManpowerOrderCreditNumber($dbHelper, $mysqli, $ORDER_ID, $orderNumberNew);
    $ORDER_ID=$orderNumberNew;
}


$CUST_ID = $_POST["CUST_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = $PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $_POST["INDUSTRY_TYPE_ID"];
$paramList["CHANNEL_ID"] = $_POST["CHANNEL_ID"];
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = $PAYTM_MERCHANT_WEBSITE;
$paramList["MSISDN"] = $_POST["MOBILE_NO"]; //Mobile number of customer
$paramList["EMAIL"] = $_POST["EMAIL"]; //Email ID of customer
$paramList["CALLBACK_URL"] = $_POST["CALLBACK_URL"]; 
$paramList["MERC_UNQ_REF"] = $_POST["MERC_UNQ_REF"];
$cartid = $_POST["cart_id"];
$manPowerCharge=$_POST["manpower_charge"];
$serviceCharge=$_POST["service_charge"];
$gst=$_POST["gst"];

/*
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,$PAYTM_MERCHANT_KEY);
if($type=="direct" || $type=="directComp")
    createOrder($dbHelper, $mysqli, $ORDER_ID, $CUST_ID, $manPowerCharge, $serviceCharge, $gst, $TXN_AMOUNT, $checkSum, $cartid);
function createOrder($dbHelper, $mysqli, $orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total,$checkSum,$cartid) {
    $cartArr=explode(",", $cartid);
    for($i=0;$i<count($cartArr);$i++){
        $dbHelper->performOperation($mysqli, "sp_insertInprocessCart", array($cartArr[$i]));
    }
    $result = $dbHelper -> performOperation($mysqli, 'sp_insertManpowerOrder', array($orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total,$checkSum,$cartid));
    return $result;
}
function generateNewManpowerOrderCreditNumber($dbHelper, $mysqli, $orderNumber, $orderNumberNew) {
    $result=$dbHelper->performOperation($mysqli, "sp_generateNewManpowerOrderCreditNumber", array($orderNumber, $orderNumberNew));
    return $result;
}
?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>