<?php

class Blog {

    function Blog() {
        set_time_limit(0);
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize', '256M');
        ini_set('post_max_size', '256M');
        ini_set('max_input_time', 600);
        ini_set('display_errors', 'on');
        error_reporting(E_ALL ^ E_NOTICE);
        error_reporting(E_ALL ^ E_NOTICE);
    }

    function clean($data) {
        $data = stripslashes($data);
        $data = htmlentities($data, ENT_QUOTES);
        return $data;
    }

    function getBlogPage($mysqli,$dbHelper) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getBlogWithPaging', array('1', '4','800'));

        for ($i = 0; $i < count($data); $i++) {
            $data[$i]["title"] = html_entity_decode($data[$i]["title"]);
            $data[$i]["content"] = html_entity_decode($data[$i]["content"]);

            preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $data[$i]["content"], $image);
            if (!isset($image[1])) {
                $image[1] = null;
            }
            $data[$i]["img_path"] = "admin/" . $image[1];
            $data[$i]["content"] = "";
        }

        return $data;

    }

    function getBlogs($mysqli, $id) {
        $data = array();
        $sql = "";
        if ($id != "") {
            $sql = " where blog_id='" . $id . "'";
        }

        $query = "SELECT *
						FROM blogs
						$sql
						
						 order by blog_id DESC
						";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

    function getBlogsFrontEnd($mysqli, $id) {
        $data = array();
        $sql = "";
        if ($id != "") {
            $sql = " where blog_id='" . $id . "'";
        }

        $query = "SELECT   *
						FROM blogs  
						$sql
						
						 order by blog_id DESC
						";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            $row["content"] = str_replace("upload/", "http://skillchamps.in/admin/upload/", $row["content"]);

            array_push($data, $row);
        }

        return $data;
    }

    function ReplaceImageBlogsFrontEnd($mysqli, $role) {
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
        } else if ($role == "800") {
            $sql = " where toall='1'";
        }

        $query = "SELECT  *
						FROM blogs 
						$sql
						
						 order by blog_id DESC limit 5
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

    function getBlogsByJobrole($mysqli, $role) {
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

        } else if ($role == "800") {
            $sql = " where toall='1'";

        } else if ($role == "600") {
            $sql = " where tp='1'";
        } else if ($role == "700") {
            $sql = " where sm='1'";
        } else if ($role == "800") {
            $sql = " where toall='1'";
        }

        $query = "SELECT *
						FROM blogs
						$sql
						
						 order by blog_id DESC
						";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

    function save_blog($mysqli) {
        $title = $this -> clean($_POST["title"]);
        $content = $this -> clean($_POST["content"]);
        $tp = $_POST['tp'] ? "1" : "0";
        $tr = $_POST['tr'] ? "1" : "0";
        $sm = $_POST['sm'] ? "1" : "0";
        $emp = $_POST['emp'] ? "1" : "0";
        $c = $_POST['c'] ? "1" : "0";
        $guru = $_POST['guru'] ? "1" : "0";
        $toall = $_POST['toall'] ? "1" : "0";
        $posted_on = $_POST['posted_on'];
        $posted_by = $_POST['posted_by'];
        $q = "insert into blogs(title,content,tp,tr,sm,emp,c,guru,toall,posted_on,posted_by)
		values('" . $title . "','" . $content . "','" . $tp . "','" . $tr . "','" . $sm . "','" . $emp . "','" . $c . "','" . $guru . "','" . $toall . "','" . $posted_on . "' ,'" . $posted_by . "')";
        $mysqli -> query($q);
        header('Location: admin.php?action=blogs');
    }

    function update_blog($mysqli) {
        $id = $this -> clean($_POST["id"]);
        $title = $this -> clean($_POST["title"]);
        $content = $this -> clean($_POST["content"]);
        $tp = $_POST['tp'] ? "1" : "0";
        $tr = $_POST['tr'] ? "1" : "0";
        $sm = $_POST['sm'] ? "1" : "0";
        $emp = $_POST['emp'] ? "1" : "0";
        $c = $_POST['c'] ? "1" : "0";
        $guru = $_POST['guru'] ? "1" : "0";

        $toall = $_POST['toall'] ? "1" : "0";
        $posted_on = $_POST['posted_on'];
        $posted_by = $_POST['posted_by'];

        $q = "update blogs set title='" . $title . "',
				content='" . $content . "',
				tp='" . $tp . "',
				tr='" . $tr . "',
				sm='" . $sm . "',
				emp='" . $emp . "',
				c='" . $c . "',
				guru='" . $guru . "',
				toall='" . $toall . "',
				posted_on='" . $posted_on . "',
				posted_by='" . $posted_by . "'
				where blog_id='" . $id . "'";
        $mysqli -> query($q);
        header('Location: admin.php?action=blogs');
    }

    function delete_blog($mysqli, $blog_id) {
        $q = "delete from blogs
				where blog_id='" . $blog_id . "'";
        $mysqli -> query($q);
        header('Location: admin.php?action=blogs');
    }

}
?>