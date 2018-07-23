<?php
/*

- Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
- Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
- Above details will be different for testing and production environment.

*/
define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
$PAYTM_DOMAIN = "pguat.paytm.com";
$PAYTM_MERCHANT_KEY = 'OEa48y&JiiPt0Ewx'; 
$PAYTM_MERCHANT_MID="CMCORP30762401552682";
$INDUSTRY_TYPE_ID="Retail";
$CHANNEL_ID="WEB";
$PAYTM_MERCHANT_WEBSITE="WEB_STAGING";
$CALLBACK_URL="http://localhost/skillchamps/flexihire/admin/application/PaytmKit/pgResponse.php";
//$CALLBACK_URL="http://192.168.1.24:8080/skillchamps_site/admin/application/PaytmKit/pgResponse.php";
//$CALLBACK_URL_SUBSCRIPTION="http://192.168.1.24:8080/skillchamps_site/admin/application/PaytmKit/pgResponseSubscription.php";
$CALLBACK_URL_SUBSCRIPTION="http://localhost/skillchamps/flexihire/admin/application/PaytmKit/pgResponseSubscription.php";
if (PAYTM_ENVIRONMENT == 'PROD') {
	$PAYTM_DOMAIN = 'secure.paytm.in';
    $PAYTM_MERCHANT_KEY = 'XX@4rs_lobbH4xKy'; 
    $PAYTM_MERCHANT_MID="CMCORP86785782812114";
    $INDUSTRY_TYPE_ID="Retail109";
    $CHANNEL_ID="WEB";
    $PAYTM_MERCHANT_WEBSITE="CMCORPSINWEB";
    $CALLBACK_URL="http://flexihire.co.in/admin/application/PaytmKit/pgResponse.php";
    $CALLBACK_URL_SUBSCRIPTION="http://flexihire.co.in/admin/application/PaytmKit/pgResponseSubscription.php";
}

define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_REFUND_STATUS_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/getRefundStatus');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
define('PAYTM_STATUS_QUERY_NEW_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/getTxnStatus');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');

?>