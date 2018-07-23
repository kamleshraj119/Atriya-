<?php

	//$connection=mysql_connect(HOST, USER, PASSWORD, DATABASE);
		/*if ($this->connection)
			echo "connected";
		else 
			echo "not connected";	*/
		//mysql_select_db(DATABASE, $connection) or die(mysql_error());
		

function smarty_function_get_candidate_video($params, &$smarty)
{
	
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    /* This is for querystrings */
	
	$cid =  $params[cid];
	$q="select video from videos where uid='".$cid."' order by vid asc limit 0,1";
	$r = $link->query($q);
	$v=$r->fetch_array(MYSQLI_ASSOC);
	echo $v["video"];
}
?>