<?php
/**
 
 */


/**
 * Defines Host Name
 */


/**
 * DataBase Connection User
 */

/**
 * DataBase Connection Password
 */
	/*define("HOST_NAME", "dbmsf.db.8362700.hostedresource.com");
	define("DB_USER","dbmsf");
	define("DB_PASS","Msf@12345");
	define("DB_NAME","dbmsf");*/
	if($_SERVER['HTTP_HOST']=="localhost:90"){
	define("HOST_NAME", "localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_NAME","phoenix");
	}
	else
	{
		define("HOST_NAME", "localhost");
		define("DB_USER","vivektan_dwits");
		define("DB_PASS","P@ssw0rd");
		define("DB_NAME","vivektan_database");
			
		
	}
	
	define('SALT_LENGTH', 9);
	
	$alpha_numeric = '/^[A-Za-z0-9-_&., ]{1,500}$/';
	$mobile_num = '/^[0-9-+ ]{6,20}$/';
	$valid_priority = '/^[0-9]{1,2}$/';
	$valid_email = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
	$url = '/^[A-Za-z0-9-_://.]{3,500}$/';
	$image_file_extension = '/(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i';
	$valid_file_extension = '/(\.docx|\.DOCX|\.xsl|\.XSL|\.xsls|\.XSLX|\.doc|\.DOC|\.PDF|\.pdf|\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i';
	define("ALPHA_NUMERIC",$alpha_numeric);
	define("MOBILE_NUMBER",$mobile_num);	
	define("VALID_PRIORITY",$valid_priority);
	define("VALID_EMAIL",$valid_email);
	define("URL",$url);
	define("IMAGE_EXT",$image_file_extension);
	define("FILE_EXT",$valid_file_extension);
	
/**
 * DataBase Connection Database Name
 */

/**
 * 
 * You can add more email id's with comma separated
 */
define("EMAIL_TO","<faheem@globalenergy.net.in>");
?>