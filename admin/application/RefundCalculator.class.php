<?php
date_default_timezone_set('Asia/Kolkata');
require_once ('PaytmKit/PaytmRequest.class.php');
/*include_once '../include/psl-config.php';
include_once '../include/functions.php';
require_once ('DBHelper.class.php');
$dbHelper = new DBHelper;
$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
RefundCalculator::cancelOrderEmployer($dbHelper, $mysqli, '15');*/

class RefundCalculator{
    static $WITHIN_LAST_PERIOD=1;
    static $WITHIN_SECOND_PERIOD=2;
    static $WITHIN_FIRST_PERIOD=3; 
            
    public static function cancelOrderEmployer($dbHelper,$mysqli,$orderId){
        $data=array();
        $data=$dbHelper->getData($mysqli, "sp_getOrderDetailById", array($orderId));
        $jobTypeId=$data[0]["job_type_id"];
        $addedDate=$data[0]["added_date"];
        $fromDate=$data[0]["from_date"];
        $fromTime=$data[0]["from_time"];
        $total=$data[0]["manpower_charge"];
        $orderNumber=$data[0]["order_number"];
        $eid=$data[0]["eid"];
        $tranId=$data[0]["transaction_id"];
        $dataInvoice=array();
        $dataInvoice=$dbHelper->getData($mysqli, "sp_getConsoleInvoiceByOrderNumber", array($orderNumber));
        $refundCustomerName=$dataInvoice[0]["customer_name"];
        $refundBillingAddress=$dataInvoice[0]["billing_address"];
        $refundGstin=$dataInvoice[0]["gstin"];
        $refundHsn=$dataInvoice[0]["hsn_code"];
        $refundDescription="refund against cancel";
        $refundStateCode=$dataInvoice[0]["state_code"];
        $refundStateName=$dataInvoice[0]["state_name"];
        $consolInvoiceNumber=$dataInvoice[0]["consol_invoice_number"];
        $type=RefundCalculator::getCancelationPeriod($addedDate,$jobTypeId,$fromDate,$fromTime);
        $result;
        switch($type){
            case RefundCalculator::$WITHIN_LAST_PERIOD:
                $oneDayCharge=RefundCalculator::getOnePeriodCharge($dbHelper, $mysqli, $jobTypeId, $orderId);
                $remainingAmount=$total-$oneDayCharge;
                $refundAmount=$remainingAmount*75/100;
                $refundCgst=0;
                $refundSgst=0;
                $refundIgst=0;
                $refundTotal=0;
                if($refundStateCode=="07"){
                    $refundCgst=$refundAmount*9/100;
                    $refundSgst=$refundAmount*9/100;
                    $refundTotal=$refundAmount+$refundCgst+$refundSgst;
                }else{
                    $refundIgst=$refundAmount*18/100;
                    $refundTotal=$refundAmount+$refundIgst;
                }
                $retainedAmount=$remainingAmount-$refundTotal;
                $result=RefundCalculator::initiateRefund($dbHelper, $mysqli, $eid, $orderNumber, $refundTotal, $refundAmount, $refundCgst, $refundSgst, $refundIgst, $refundCustomerName, 
                $refundBillingAddress, $refundGstin, $refundHsn, $refundDescription, $refundStateCode, $refundStateName, $consolInvoiceNumber,$tranId);
                RefundCalculator::initiateRetained($dbHelper, $mysqli, $eid, $orderId, $retainedAmount);
                break;
            case RefundCalculator::$WITHIN_SECOND_PERIOD:
                $remainingAmount=$total;
                $refundAmount=$remainingAmount*75/100;
                $refundCgst=0;
                $refundSgst=0;
                $refundIgst=0;
                $refundTotal=0;
                if($refundStateCode=="07"){
                    $refundCgst=$refundAmount*9/100;
                    $refundSgst=$refundAmount*9/100;
                    $refundTotal=$refundAmount+$refundCgst+$refundSgst;
                }else{
                    $refundIgst=$refundAmount*18/100;
                    $refundTotal=$refundAmount+$refundIgst;
                }
                $retainedAmount=$remainingAmount-$refundTotal;
                $result=RefundCalculator::initiateRefund($dbHelper, $mysqli, $eid, $orderNumber, $refundTotal, $refundAmount, $refundCgst, $refundSgst, $refundIgst, $refundCustomerName, 
                $refundBillingAddress, $refundGstin, $refundHsn, $refundDescription, $refundStateCode, $refundStateName, $consolInvoiceNumber,$tranId);
                RefundCalculator::initiateRetained($dbHelper, $mysqli, $eid, $orderId, $retainedAmount);
                break;
            case RefundCalculator::$WITHIN_FIRST_PERIOD:
                $refundAmount=$total;
                $refundCgst=0;
                $refundSgst=0;
                $refundIgst=0;
                $refundTotal=0;
                if($refundStateCode=="07"){
                    $refundCgst=$refundAmount*9/100;
                    $refundSgst=$refundAmount*9/100;
                    $refundTotal=$refundAmount+$refundCgst+$refundSgst;
                }else{
                    $refundIgst=$refundAmount*18/100;
                    $refundTotal=$refundAmount+$refundIgst;
                }
                $result=RefundCalculator::initiateRefund($dbHelper, $mysqli, $eid, $orderNumber, $refundTotal, $refundAmount, $refundCgst, $refundSgst, $refundIgst, $refundCustomerName, 
                $refundBillingAddress, $refundGstin, $refundHsn, $refundDescription, $refundStateCode, $refundStateName, $consolInvoiceNumber,$tranId);
                break;
        }
        return $result;
    }

   public static function cancelationAgainstCandidateRejection($dbHelper,$mysqli,$hid){
        $dataHired=array();
        $dataHired=$dbHelper->getData($mysqli, "sp_getHiredCandidateById", array($hid));
        $orderId=$dataHired[0]["order_id"];
        
        $data=array();
        $data=$dbHelper->getData($mysqli, "sp_getOrderDetailById", array($orderId));
        $orderNumber=$data[0]["order_number"];
        $eid=$data[0]["eid"];
        $tranId=$data[0]["transaction_id"];
        
        $dataInvoice=array();
        $dataInvoice=$dbHelper->getData($mysqli, "sp_getConsoleInvoiceByOrderNumber", array($orderNumber));
        $refundCustomerName=$dataInvoice[0]["customer_name"];
        $refundBillingAddress=$dataInvoice[0]["billing_address"];
        $refundGstin=$dataInvoice[0]["gstin"];
        $refundHsn=$dataInvoice[0]["hsn_code"];
        $refundDescription="refund against candidate rejection";
        $refundStateCode=$dataInvoice[0]["state_code"];
        $refundStateName=$dataInvoice[0]["state_name"];
        $consolInvoiceNumber=$dataInvoice[0]["consol_invoice_number"];
        
        $refundAmount=($dataHired[0]["period"]*$dataHired[0]["sal"]);
        $refundCgst=0;
        $refundSgst=0;
        $refundIgst=0;
        $refundTotal=0;
        if($refundStateCode=="07"){
            $refundCgst=$refundAmount*9/100;
            $refundSgst=$refundAmount*9/100;
            $refundTotal=$refundAmount+$refundCgst+$refundSgst;
        }else{
            $refundIgst=$refundAmount*18/100;
            $refundTotal=$refundAmount+$refundIgst;
        }
        
       return RefundCalculator::initiateRefund($dbHelper, $mysqli, $eid, $orderNumber, $refundTotal, $refundAmount, $refundCgst, $refundSgst, $refundIgst, $refundCustomerName, 
       $refundBillingAddress, $refundGstin, $refundHsn, $refundDescription, $refundStateCode, $refundStateName, $consolInvoiceNumber,$tranId);
    }
    
   public static function cancelationAgainstTermination($dbHelper,$mysqli,$hid){
        $dataHired=array();
        $dataHired=$dbHelper->getData($mysqli, "sp_getHiredCandidateById", array($hid));
        $orderId=$dataHired[0]["order_id"];
        
        $data=array();
        $data=$dbHelper->getData($mysqli, "sp_getOrderDetailById", array($orderId));
        $jobTypeId=$data[0]["job_type_id"];
        $addedDate=$data[0]["added_date"];
        $fromDate=$data[0]["from_date"];
        $fromTime=$data[0]["from_time"];
        $total=$data[0]["manpower_charge"];
        $orderNumber=$data[0]["order_number"];
        $eid=$data[0]["eid"];
        $tranId=$data[0]["transaction_id"];
        
        $dataInvoice=array();
        $dataInvoice=$dbHelper->getData($mysqli, "sp_getConsoleInvoiceByOrderNumber", array($orderNumber));
        $refundCustomerName=$dataInvoice[0]["customer_name"];
        $refundBillingAddress=$dataInvoice[0]["billing_address"];
        $refundGstin=$dataInvoice[0]["gstin"];
        $refundHsn=$dataInvoice[0]["hsn_code"];
        $refundDescription="refund against termination";
        $refundStateCode=$dataInvoice[0]["state_code"];
        $refundStateName=$dataInvoice[0]["state_name"];
        $consolInvoiceNumber=$dataInvoice[0]["consol_invoice_number"];
        
        $notRefundableAmount=RefundCalculator::getNotRefundableAmount($jobTypeId, $dataHired[0]["from_date"], $dataHired[0]["from_time"], $dataHired[0]["sal"]);
        $oneDayCharge=RefundCalculator::getOnePeriodCharge($dbHelper, $mysqli, $jobTypeId, $orderId);
        $sub=$notRefundableAmount+($oneDayCharge/2);
        $refundAmount=$total-$sub;
        
        $refundCgst=0;
        $refundSgst=0;
        $refundIgst=0;
        $refundTotal=0;
        if($refundStateCode=="07"){
            $refundCgst=$refundAmount*9/100;
            $refundSgst=$refundAmount*9/100;
            $refundTotal=$refundAmount+$refundCgst+$refundSgst;
        }else{
            $refundIgst=$refundAmount*18/100;
            $refundTotal=$refundAmount+$refundIgst;
        }
        
       return RefundCalculator::initiateRefund($dbHelper, $mysqli, $eid, $orderNumber, $refundTotal, $refundAmount, $refundCgst, $refundSgst, $refundIgst, $refundCustomerName, 
       $refundBillingAddress, $refundGstin, $refundHsn, $refundDescription, $refundStateCode, $refundStateName, $consolInvoiceNumber,$tranId);   
    }

    static function getNotRefundableAmount($jobTypeId,$fromDate,$fromTime,$sal){
        $retVal=0;
        $period=RefundCalculator::calculatePeriod($jobTypeId,$fromDate,$fromTime);
        if($period>0){
            if($jobTypeId==1 || $jobTypeId==2)
            $retVal=$retVal+($sal*$period);
            else if($jobTypeId==3) 
                $retVal=$retVal+($period*$sal/7);
            else $retVal=$retVal+($period*$sal/30);
        }
        return $retVal;
    }
    
    static function calculatePeriod($jobTypeId,$fromDate,$fromTime){
        $interval=0;
        $datetime2 = date_create();
        $datetime1 = date_create($fromDate." ".$fromTime);
        if($jobTypeId==1){
            $interval = date_diff($datetime2, $datetime1)->format('%h');
        }else{
            $interval = date_diff($datetime2, $datetime1)->format('%a');
        }
        $interval=$datetime2>$datetime1?$interval:-$interval;
        return $interval;
    }
    
    static function getOnePeriodCharge($dbHelper,$mysqli,$jobTypeId,$orderId){
        $retVal=0;
        $data=array();
        $data=$dbHelper->getData($mysqli, "sp_getHiredCandidateByOrder", array($orderId));
        if($jobTypeId==1 || $jobTypeId==2){
            for($i=0;$i<count($data);$i++){
                $retVal=$retVal+$data[$i]["sal"];
            }
        }else if($jobTypeId==3){
            for($i=0;$i<count($data);$i++){
                $retVal=$retVal+($data[$i]["sal"]/7);
            }
        }else{
            for($i=0;$i<count($data);$i++){
                $retVal=$retVal+($data[$i]["sal"]/30);
            }
        }
        return $retVal;
    }
    
    static function getCancelationPeriod($addedDate,$jobTypeId,$jobStartDate,$jobStartTime){
        $interval=0;
        $datetime1 = date_create($addedDate);
        $datetime2 = date_create($jobStartDate." ".$jobStartTime);
        if($jobTypeId==1){
            $interval = date_diff($datetime2, $datetime1)->format('%h');
        }else{
            $interval = date_diff($datetime2, $datetime1)->format('%a');
        }
        $interval=$datetime2>$datetime1?$interval:-$interval;
        if($interval<1)
            return RefundCalculator::$WITHIN_LAST_PERIOD;
        else if($interval>1 && $interval<($interval-1))
            return RefundCalculator::$WITHIN_SECOND_PERIOD;
        else return RefundCalculator::$WITHIN_FIRST_PERIOD;
    }
    
    static function initiateRefund($dbHelper,$mysqli,$eid,$orderNumber,$refundTotal,$refundAmount,$refundCgst,$refundSgst,$refundIgst,
        $refundCustomerName,$refundBillingAddress,$refundGstin,$refundHsn,$refundDescription,$refundStateCode,$refundStateName,$consolInvoiceNumber,$tranId){
        $result=$dbHelper->performOperation($mysqli, "sp_insertRefund", array($eid,$orderNumber,$refundTotal,$refundAmount,$refundCgst,$refundSgst,$refundIgst,
        $refundCustomerName,$refundBillingAddress,$refundGstin,$refundHsn,$refundDescription,$refundStateCode,$refundStateName,$consolInvoiceNumber));
        if($result=="Success"){
            $responseRefund=PaytmRequest::refundTransaction($tranId, $orderNumber, $refundAmount,$refundDescription);
            $dbHelper->performOperation($mysqli, "sp_updateRefund", array($responseRefund["ORDERID"],$responseRefund["STATUS"],$responseRefund["REFID"],$responseRefund["TXNID"]));
        }
        return $result;      
    }
    
    static function initiateRetained($dbHelper,$mysqli,$eid,$orderId,$retainedAmount){
        return $dbHelper->performOperation($mysqli, "sp_insertRetained", array($eid,$orderId,$retainedAmount));
    }
    
}

?>