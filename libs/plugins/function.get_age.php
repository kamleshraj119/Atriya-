<?php

	//$connection=mysql_connect(HOST, USER, PASSWORD, DATABASE);
		/*if ($this->connection)
			echo "connected";
		else 
			echo "not connected";	*/
		//mysql_select_db(DATABASE, $connection) or die(mysql_error());
		

function smarty_function_get_age($params, &$smarty)
{
	
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    /* This is for querystrings */
	
	$dob =  $params[dob];
	if($dob=="")
	{
		echo "";
	}
	else
	{
		try {
			$from = new DateTime($dob);
			$to   = new DateTime('today');
			echo $from->diff($to)->y;
		} catch (Exception $e) {
			//echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		
	}
		
}
?>