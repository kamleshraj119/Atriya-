<?php
class tampalate {
	public $url;
    public $title;
    public $des;
}    
$data=array();
$directory = '../assets/tamplate/';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));

foreach ($scanned_directory as &$value) {
	$temp=new tampalate;
	$temp->url='assets/tamplate/'.$value;
	$temp->title=$value;
	$temp->des=$value;
	array_push($data,$temp);
}
echo json_encode($data);
?>