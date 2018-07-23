<?php

class GuruTree {

	function GuruTree() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getUnassignGuruFromTree($mysqli, $gid) {
		$data = array();
		$sql = '';
		$query = "SELECT t1.parent AS lev1, t2.parent as lev2, t3.parent as lev3, t4.parent as lev4
					FROM guru_tree AS t1
					LEFT JOIN guru_tree AS t2 ON t1.parent = t2.gid
					LEFT JOIN guru_tree AS t3 ON t2.parent = t3.gid
					LEFT JOIN guru_tree AS t4 ON t3.parent = t4.gid
					WHERE t1.gid ='" . $gid . "'";
		$r = mysqli_query($mysqli, $query);
		$v = mysqli_fetch_assoc($r);
		$lev1 = $v["lev1"];
		$lev2 = $v["lev2"];
		$lev3 = $v["lev3"];
		$lev4 = $v["lev4"];
		if ($lev1 != '') {
			$sql = $sql . " and members.id!='" . $lev1 . "'";
		}
		if ($lev2 != '') {
			$sql = $sql . " and members.id!='" . $lev2 . "'";
		}
		if ($lev3 != '') {
			$sql = $sql . " and members.id!='" . $lev1 . "'";
		}
		if ($lev4 != '') {
			$sql = $sql . " and members.id!='" . $lev1 . "'";
		}
		$query = "SELECT *
						FROM member_details
						inner join members
						on member_details.uid = members.id
						left outer join guru_tree on
						member_details.uid=guru_tree.gid
						where members.id!='' and members.user_role = '500' 
						and members.id!='" . $gid . "' and guru_tree.parent IS NULL
						$sql
						order by members.id DESC";
		echo $query;
		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getAssignedGuruFromTree($mysqli, $gid) {
		$data = array();
		$sql = "";
		if ($gid != "") {
			$sql = " where gt.parent='" . $gid . "'";
		}
		$query = "SELECT *
					FROM guru_tree as gt
					left outer join
					member_details as md
					on gt.gid=md.uid
					$sql
					 order by gt.gid DESC
					";
		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function assignGuruToTree($mysqli) {
		$parent = $_REQUEST["gid"];
		foreach ($_REQUEST['guru'] as $gid) {
			$query = "insert into guru_tree(gid,parent)
						values('" . $gid . "','" . $parent . "')";
			$mysqli -> query($query);
		}
		header('Location: admin.php?action=assign_guru_tree&id=' . $parent);
	}

	function removeGuruFromTree($mysqli, $uid, $page, $gid) {
		$query = "delete from guru_tree where gid='" . $uid . "' or parent='" . $uid . "'";
		$mysqli -> query($query);
		header('Location: admin.php?action=' . $page . '&id=' . $gid);
	}

	function getSiblingFromGuruTree($mysqli, $gid) {
		$data = array();
		$query = "SELECT * from 
				 (SELECT e.* FROM guru_tree e, guru_tree e2 
				 WHERE e.`parent` = e2.`parent` AND 
				 e2.`gid` = '" . $gid . "' AND e.`gid` <> e2.`gid`) gt 
				 left OUTER JOIN member_details md on gt.gid=md.uid";
		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

}
?>