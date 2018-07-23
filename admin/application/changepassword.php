<?php

include_once '../include/psl-config.php';
error_reporting(E_ALL);
$connection = mysql_connect(HOST, USER, PASSWORD, DATABASE);
mysql_select_db(DATABASE, $connection) or die(mysql_error());

$uid = $_REQUEST["uid"];
$password = $_REQUEST["p"];
$oldpassword = $_REQUEST["op"];
$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
$password = hash('sha512', $password . $random_salt);

$q1 = "select * from members where id = '" . $uid . "'";
$r1 = mysql_query($q1);
$v1 = mysql_fetch_assoc($r1);
$dbpassword = $v1["password"];
$oldsalt = $v1["salt"];
$oldpassword = hash('sha512', $oldpassword . $oldsalt);

if ($dbpassword == $oldpassword) {
	$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $uid . "'";
	mysql_query($q);
	echo "Password changed successfully";
} else {
	echo "Wrong old password";
}
?>

