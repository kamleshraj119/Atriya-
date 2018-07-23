<?php
    require_once ("lib/config_paytm.php");
    require_once ("lib/encdec_paytm.php");
    require_once ("TrasactionStatus.class.php");
    require_once ("RefundStatus.class.php");    
    define('PAYTM_MERCHANT_KEY',$PAYTM_MERCHANT_KEY);
    define('PAYTM_MERCHANT_MID',$PAYTM_MERCHANT_MID);
    class PaytmRequest{
        static function getTransactionStatus($mid,$orderId){
            $tranStatus=new TrasactionStatus;
            $tranStatus->MID=$mid;
            $tranStatus->ORDERID=$orderId;
            $paramList["MID"] = $mid;
            $paramList["ORDER_ID"] = $orderId;
            $tranStatus->CHECKSUMHASH=getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
            echo json_encode($tranStatus);
            return getTxnStatusNew($tranStatus);
        }
        
        static function getRefundStatus($orderId,$refid){
            $refundStatus=new RefundStatus;
            $refundStatus->MID=PAYTM_MERCHANT_MID;
            $refundStatus->ORDERID=$orderId;
            $refundStatus->REFID=$refid;
            $paramList["MID"] = $mid;
            $paramList["ORDER_ID"] = $orderId;
            $paramList["REFID"] = $refid;
            $refundStatus->CHECKSUMHASH=getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
            return getRefundStatus($refundStatus);
        }
        
        static function refundTransaction($tranId,$orderId,$refundAmount,$comments){
            $paramList["MID"] = PAYTM_MERCHANT_MID;
            $paramList["TXNID"] = $tranId;
            $paramList["ORDERID"] = $orderId;
            $paramList["REFUNDAMOUNT"] = $refundAmount;
            $paramList["TXNTYPE"] = "REFUND";
            $paramList["COMMENTS"] = $comments;
            $paramList["REFID"] = "refund".time();
            return initiateTxnRefund($paramList);
        }
    }
    
?>