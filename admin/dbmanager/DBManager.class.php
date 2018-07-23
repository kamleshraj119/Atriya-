<?php
/**
 * 
 * 
 * @author Sheikh Fahimuddin<faheem.sheikh@ebsworldwide.com>
 * @date 15 Oct, 2008
 * @version 1.0
 */
include_once ('configs/config.inc');
class DBManager
{
	/**
	 * get instance of databse connection
	 *
	 * @access private
	 */
	//private $connection;
	/**
	 * main function used as getinstance of databse connection
	 *
	 * @return DBManager instance
	 */
	function getInstance()
	{
		//The MySQL database connection
        
                
		$connection = mysql_connect(HOST_NAME, DB_USER, DB_PASS) or die(mysql_error());
		/*if ($this->connection)
			echo "connected";
		else 
			echo "not connected";	*/
		mysql_select_db(DB_NAME, $connection) or die(mysql_error());
	}
}
?>