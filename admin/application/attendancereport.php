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
	$data = array();
	for ($j = 0; $j < count($id); $j++) {
		$dataHiredCandidate = array();
		$dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateBetweenDate", array('', '', $id[$j]));
		for ($i = 0; $i < count($dataHiredCandidate); $i++) {
			$jobTypeId = $dataHiredCandidate[$i]["job_type_id"];
			$sal = calculateSalery($jobTypeId,$dataHiredCandidate[$i]["sal"]);
			$period = calculateTotalPeriod($jobTypeId,$dataHiredCandidate[$i]["period"]);
				
			$acNum = $dataHiredCandidate[$i]["account_number"];
			$ifsc = $dataHiredCandidate[$i]["ifsc_code"];
			$name = $dataHiredCandidate[$i]["name"];
			$pan = $dataHiredCandidate[$i]["pancard"];
			$dataAttendence = array();
			$dataAttendence = $dbHelper -> getData($mysqli, "sp_getAttendenceReport", array($jobTypeId, $dataHiredCandidate[$i]["from_date"], $dataHiredCandidate[$i]["to_date"], $dataHiredCandidate[$i]["to_time"], $dataHiredCandidate[$i]["hcid"]));
			$payablePeriod = $dataAttendence[0]["payable_period"];
			$amountPayable = $payablePeriod * $sal;
			$date=date('Y-m-d');
			$month = date('F Y',strtotime($date));
			array_push($data,array("Cmcorps salary $month" ,$name,$acNum,$ifsc,'02',$amountPayable,date("Ymd")));
			
		}
	}
	createCsv($data);
	header('Location: admin.php?action=get_attendance_report');
}

function calculateSalery($jobTypeId, $sal) {
		switch($jobTypeId) {
			case 1 :
				return $sal;
				break;
			case 2 :
				return $sal;
				break;
			case 3 :
				return round($sal / 7);
				break;
			case 4 :
				return round($sal / 30);
				break;
			default :
				return $sal;
				break;
		}
	}

	function calculateTotalPeriod($jobTypeId, $period) {
		switch($jobTypeId) {
			case 1 :
				return $period ;
				break;
			case 2 :
				return $period ;
				break;
			case 3 :
				return ($period * 7) ;
				break;
			case 4 :
				return ($period * 30);
				break;
			default :
				return $sal;
				break;
		}
	}

function createCsv($data) {
	$filename = "attendancereport.csv";
	$fp = fopen('php://output', 'w');


	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	

	
	// output the column headings
	fputcsv($fp, array('Customer Ref No ( Narration )', 'Beneficiary Name', 'Beneficary A/c No','IFSC Code','A/C Type','Amount','Value Date'));
	for($i=0;$i<count($data);$i++){
		fputcsv($fp, $data[$i]);
	}
		
	exit;
}
?>