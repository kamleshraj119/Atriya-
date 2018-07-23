<?php
include_once 'PaytmKit/lib/config_paytm.php';
include_once '../include/psl-config.php';
include_once '../include/functions.php';
require_once ('DBHelper.class.php');
require_once 'HireCandidate.class.php';

$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$eid = $_REQUEST["eid"];
$cartId = isset($_REQUEST["cartid"])?implode(",", $_REQUEST["cartid"]):"";
$manPowerCharge = $_REQUEST["manpower_charge"];
$serviceCharge = $_REQUEST["service_charge"];
$gst = $_REQUEST["gst"];
$totalAmountPayable = $_REQUEST["amount_payable"];
$orderNumber=isset($_REQUEST["order_number"])?$_REQUEST["order_number"]:substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$mob=$_REQUEST["mobile"];
$email=$_REQUEST["email"];
$gstin=$_REQUEST["gstin"];
$type=isset($_REQUEST["type"])?$_REQUEST["type"]:"direct";
?>

<h2>Please wait while we process your transaction.Please do not refersh the page.</h2>
<form method="post" name="payuForm" id="payuForm" style="display: none">
    <input type="hidden" id="ORDER_ID" name="ORDER_ID" value="<?php echo $orderNumber ?>" />
    <input type="hidden" id="CUST_ID" name="CUST_ID" value="<?php echo $eid ?>"/>
    <input type="hidden" id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" value="<?php echo $INDUSTRY_TYPE_ID ?>" />
    <input type="hidden" id="CHANNEL_ID" name="CHANNEL_ID"  value="<?php echo $CHANNEL_ID; ?>" />
    <input type="number" name="TXN_AMOUNT" id="TXN_AMOUNT" value="<?php echo round($totalAmountPayable, 2); ?>" />
    <input type="hidden" name="CALLBACK_URL" id="CALLBACK_URL" value="<?php echo $CALLBACK_URL; ?>" />
    <input type="hidden" name="MERC_UNQ_REF" id="MERC_UNQ_REF" value="<?php echo $eid.'_'.$gstin.'_'.$email.'_'.$type; ?>" />
    <input type="hidden" name="type" id="type" value="<?php echo $type; ?>" />
    <input type="number" name="MOBILE_NO" id="MOBILE_NO" value="<?php echo $mob; ?>" />
    <input type="email" name="EMAIL" id="EMAIL" value="<?php echo $email; ?>" />
    <input type="number" name="manpower_charge" id="manpower_charge" value="<?php echo $manPowerCharge; ?>" />
    <input type="number" name="service_charge" id="service_charge" value="<?php echo $serviceCharge; ?>" />
    <input type="number" name="gst" id="gst" value="<?php echo $gst; ?>" />
    <input type="hidden" name="cart_id" id="cart_id" value="<?php echo $cartId; ?>" />
    
</form>
<script type="text/javascript">
   var payuForm = document.forms.payuForm;
   payuForm.action="PaytmKit/pgRedirect.php";
   payuForm.submit();
</script>



