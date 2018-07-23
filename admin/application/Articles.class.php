<?php

class Articles {

	function Articles() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getArticles($mysqli, $id) {
		$data = array();
		$sql = "";
		if ($id != "") {
			$sql = " where article_id='" . $id . "'";
		}

		$query = "SELECT *
						FROM articles
						$sql
						
						 order by article_id DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data;
	}

	function getArticleFrontEnd($mysqli, $id) {
		$data = array();
		$sql = "";
		if ($id != "") {
			$sql = " where article_id='" . $id . "'";
		}

		$query = "SELECT *
						FROM articles
						$sql
						
						 order by article_id DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			$row["content"] = str_replace("upload/", "http://skillchamps.in/admin/upload/", $row["content"]);

			array_push($data, $row);

		}

		return $data;
	}

	function ReplaceImageAricleFrontEnd($mysqli, $role) {
		$data = array();
		$sql = "";
		if ($role == "200") {
			$sql = " where c='1'";
		} else if ($role == "300") {
			$sql = " where tr='1'";
		} else if ($role == "400") {
			$sql = " where emp='1'";
		} else if ($role == "500") {
			$sql = " where guru='1'";
		} else if ($role == "600") {
			$sql = " where tp='1'";
		} else if ($role == "700") {
			$sql = " where sm='1'";
		}

		$query = "SELECT *
						FROM articles
						$sql
						
						 order by article_id DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			$row["content"] = html_entity_decode($row["content"]);
			$row["content"] = preg_replace("/<img[^>]+\>/i", "", $row["content"]);
			$row["content"] = strip_tags($row["content"]);
			$row["content"] = substr($row["content"], 0, 30);
			array_push($data, $row);
		}

		return $data;
	}

	function getArticlesByJobrole($mysqli, $role) {
		$data = array();
		$sql = "";
		if ($role == "200") {
			$sql = " where c='1'";
		} else if ($role == "300") {
			$sql = " where tr='1'";
		} else if ($role == "400") {
			$sql = " where emp='1'";
		} else if ($role == "500") {
			$sql = " where guru='1'";
		} else if ($role == "600") {
			$sql = " where tp='1'";
		} else if ($role == "700") {
			$sql = " where sm='1'";
		}

		$query = "SELECT *
						FROM articles
						$sql
						
						 order by article_id DESC
						";
		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data;
	}

	function save_article($mysqli) {
		$title = $this -> clean($_POST["title"]);
		$content = $this -> clean($_POST["content"]);
		$tp = $_POST['tp'] ? "1" : "0";
		$tr = $_POST['tr'] ? "1" : "0";
		$sm = $_POST['sm'] ? "1" : "0";
		$emp = $_POST['emp'] ? "1" : "0";
		$c = $_POST['c'] ? "1" : "0";
		$guru = $_POST['guru'] ? "1" : "0";
		$posted_on = $_POST['posted_on'];
		$posted_by = $_POST['posted_by'];
		$q = "insert into articles(title,content,tp,tr,sm,emp,c,guru,posted_on,posted_by)
			values('" . $title . "','" . $content . "','" . $tp . "','" . $tr . "','" . $sm . "','" . $emp . "','" . $c . "','" . $guru . "','" . $posted_on . "' ,'" . $posted_by . "')";
		$mysqli -> query($q);
		header('Location: admin.php?action=articles');
	}

	function update_article($mysqli) {
		$id = $this -> clean($_POST["id"]);
		$title = $this -> clean($_POST["title"]);
		$content = $this -> clean($_POST["content"]);
		$tp = $_POST['tp'] ? "1" : "0";
		$tr = $_POST['tr'] ? "1" : "0";
		$sm = $_POST['sm'] ? "1" : "0";
		$emp = $_POST['emp'] ? "1" : "0";
		$c = $_POST['c'] ? "1" : "0";
		$guru = $_POST['guru'] ? "1" : "0";
		$posted_on = $_POST['posted_on'];
		$posted_by = $_POST['posted_by'];
		$q = "update articles set title='" . $title . "',
				content='" . $content . "',
				tp='" . $tp . "',
				tr='" . $tr . "',
				sm='" . $sm . "',
				emp='" . $emp . "',
				c='" . $c . "',
				guru='" . $guru . "',
               posted_on='" . $posted_on . "',
               posted_by='" . $posted_by . "'
				
				where article_id='" . $id . "'";
		$mysqli -> query($q);
		header('Location: admin.php?action=articles');
	}

	function delete_article($mysqli, $id) {
		$q = "delete from articles
				where article_id='" . $id . "'";
		$mysqli -> query($q);
		header('Location: admin.php?action=articles');
	}

	function clean($data) {
        $data = stripslashes($data);
        $data = htmlentities($data, ENT_QUOTES);
        return $data;
    }

}
?>