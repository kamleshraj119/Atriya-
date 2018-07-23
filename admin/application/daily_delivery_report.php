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
    $date = explode(" ", $_REQUEST["date"]);

    $data = array();
    for ($j = 0; $j < count($id); $j++) {
        $lst = explode("_", $id[$j]);
        $date = explode(" ", $lst[1]);
        $dataAtt = array();
        $dataAtt = $dbHelper->getData($mysqli, "sp_getDailyDeliveryReportAdminById", array($lst[0], $date[0]));
        for ($i = 0; $i < count($dataAtt); $i++) {
            $job = $dataAtt[$i]["title"] . " " . $dataAtt[$i]["address"];

            array_push($data, array($job, $dataAtt[$i]["mem_name"], $dataAtt[$i]["shift"], $dataAtt[$i]["type"], $dataAtt[$i]["total_pkt"], $dataAtt[$i]["done_pkt"], $dataAtt[$i]["attempt_pkt"], $dataAtt[$i]["reject_pkt"]
                , $dataAtt[$i]["eff_pkt"], $dataAtt[$i]["rate_per_pkt"], $dataAtt[$i]["sub_pkt"], $dataAtt[$i]["open_km"], $dataAtt[$i]["close_km"], $dataAtt[$i]["run_km"], $dataAtt[$i]["rate_km"], $dataAtt[$i]["incentive"]
                , $dataAtt[$i]["total"], $dataAtt[$i]["status"], $dataAtt[$i]["delivery_date"]));
        }
    }
    createCsv($data);
    header('Location: admin.php?action=daily_delivery');
}

function createCsv($data) {
    $filename = "dailydeliveryreport.csv";
    $fp = fopen('php://output', 'w');

    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename=' . $filename);

    // output the column headings
    fputcsv($fp, array('Job', 'Name', 'Shift', 'Type', 'Total Pkt', 'Done', 'Attempt', 'Reject', 'Effective', 'Rate/Pkt', 'Sub Total', 'Opening Km', 'Closing Km', 'Run Km', 'Rate/Km', 'Incentive', 'Total','Status','Date'));
    for ($i = 0; $i < count($data); $i++) {
        fputcsv($fp, $data[$i]);
    }
    exit;
}

?>