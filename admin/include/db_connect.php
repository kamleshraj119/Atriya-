<?php
date_default_timezone_set("Asia/Kolkata");
//include_once '../configs/config.inc';  
include_once 'psl-config.php';   // As functions.php is not included
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);