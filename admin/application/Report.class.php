<?php

class Report {

    static function getLocationWiseVolumeDailyDeliveryReport($dbHelper,$mysqli,$empLocId,$date) {
       return $dbHelper->getData($mysqli, 'sp_getLocationWiseVolumeDailyDeliveryReport', array($empLocId,$date));
    }
    
    static function sp_getActiveEmpJobLocation($dbHelper,$mysqli) {
       return $dbHelper->getData($mysqli, 'sp_getActiveEmpJobLocation', array());
    }
    
    static function getLocationWiseMTDReport($dbHelper,$mysqli,$empLocId,$date) {
       return $dbHelper->getData($mysqli, 'sp_getLocationWiseMTDReport', array($empLocId,$date));
    }
    
    static function getLocationWiseYTDReport($dbHelper,$mysqli,$empLocId,$date) {
       return $dbHelper->getData($mysqli, 'sp_getLocationWiseYTDReport', array($empLocId,$date));
    }
}
?>