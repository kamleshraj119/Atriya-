<?php
//Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
$PAYTM_DOMAIN = "pguat.paytm.com";
$PAYTM_MERCHANT_KEY = 'OEa48y&JiiPt0Ewx'; 
$PAYTM_MERCHANT_MID="CMCORP30762401552682";
$INDUSTRY_TYPE_ID="Retail";
$CHANNEL_ID="WAP";
$WEBSITE="APP_STAGING";
if (PAYTM_ENVIRONMENT == 'PROD') {
    $PAYTM_DOMAIN = 'secure.paytm.in';
    $PAYTM_MERCHANT_KEY = 'XX@4rs_lobbH4xKy'; 
    $PAYTM_MERCHANT_MID="CMCORP86785782812114";
    $INDUSTRY_TYPE_ID="Retail109";
    $CHANNEL_ID="WAP";
    $WEBSITE="CMCORPSINWAP";
}

define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_REFUND_STATUS_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/getRefundStatus');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
define('PAYTM_STATUS_QUERY_NEW_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/getTxnStatus');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');
define('PAYTM_STATUS_QUERY_NEW_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/getTxnStatus');
?>