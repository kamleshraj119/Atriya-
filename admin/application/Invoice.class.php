<?php
class Invoice{
    static function generateConsoleInvoiceNumber($dbHelper,$mysqli){
        $prefix="CIS/".date("y")."-".(intval(date("y"))+1)."/SC/";
        $length=strlen($prefix);
        $result=$dbHelper->multiquery($mysqli, "sp_getConsoleInvoiceNumber", array($prefix,$length), "Select @outNumber;", array('@outNumber'));
        if($result[0]=="Success")
            return $result[1];
        else return "";
    }
    
    static function generateInvoiceNumber($dbHelper,$mysqli){
        $prefix="CIS/".date("y")."-".(intval(date("y"))+1)."/SCC/";
        $length=strlen($prefix);
        $result=$dbHelper->multiquery($mysqli, "sp_getInvoiceNumber", array($prefix,$length), "Select @outNumber;", array('@outNumber'));
        if($result[0]=="Success")
            return $result[1];
        else return "";
    }
    
    static function insertInvoice($dbHelper,$mysqli,$params){
        $result=$dbHelper->performOperation($mysqli, "sp_insertInvoice", $params);
        return $result;
    }
    
    static function updateInvoice($dbHelper,$mysqli,$params){
        $result=$dbHelper->performOperation($mysqli, "sp_updateInvoice", $params);
        return $result;
    }
}
?>