<?php
include_once '../include/psl-config.php';
include_once '../include/functions.php';
require_once ('DBHelper.class.php');
sec_session_start();
getCsvData();

function getCsvData() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbHelper = new DBHelper;
	$id = $_REQUEST["id"];
    $date= explode(" ", $_REQUEST["date"]);
    
	$data = array();
	for ($j = 0; $j < count($id); $j++) {
	    $lst=explode("_", $id[$j]);
        $date=explode(" ", $lst[1]);
		$dataAtt = array();
		$dataAtt = $dbHelper -> getData($mysqli, "sp_getCandidateAtttendanceAdminById", array($lst[0],$date[0]));
       
		for ($i = 0; $i < count($dataAtt); $i++) {
		    $inLoc=$dataAtt[$i]["t1lat"].",".$dataAtt[$i]["t1long"];
            $outLoc=$dataAtt[$i]["t2lat"].",".$dataAtt[$i]["t2long"];
			array_push($data,array($dataAtt[$i]["title"]." ".$dataAtt[$i]["address"], $dataAtt[$i]["t3mobile"],$dataAtt[$i]["t3name"],$dataAtt[$i]["t1date"],$dataAtt[$i]["t2date"],$inLoc,$outLoc,$dataAtt[$i]["valid"]));
		}
	}
	createCsv($data);
	header('Location: admin.php?action=candidate_attendance');
}


function createCsv($data) {
	$filename = "dailyattendancereport.csv";
	$fp = fopen('php://output', 'w');


	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	

	
	// output the column headings
	fputcsv($fp, array('JOB','Mobile', 'Name', 'IN','OUT','IN LOC','OUT LOC','VALID'));
	for($i=0;$i<count($data);$i++){
		fputcsv($fp, $data[$i]);
	}
		
	exit;
}
?>