<?php
include_once 'psl-config.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}
function forgotpassword($username,$email,$mysqli)
{
}
function changepassword($oldpassword,$newpassword,$mysqli)
{
	
	 if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members
       WHERE id = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $_SESSION["msf_admin_user_id"]);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $oldpassword . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
          
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                   
				$random_salt = hash('sha512', uniqid(rand(1,10000000), TRUE));

        		// Create salted password 
        		$newpassword = hash('sha512', $newpassword . $random_salt);
				if ($insert_stmt = $mysqli->prepare("UPDATE members set password=?, salt=? where  id=?")) {
				$insert_stmt->bind_param('sss', $newpassword, $random_salt, $_SESSION["msf_admin_user_id"]);
				// Execute the prepared query.
				if (! $insert_stmt->execute()) {
					
				}
				return true;
        }
						
                    
                } else {
                   
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    
}
function login($email, $password, $mysqli) {
	
	// Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt ,user_role
        FROM members
       WHERE username = ?  and user_status='Active'
	  
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
		
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt,$user_role);
        $stmt->fetch();
 		
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
		
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION["ps4a_admin_user_id"] = $user_id;
					 $_SESSION["ps4a_admin_user_role"] = $user_role;
					$_SESSION['timeout']=time();
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
					$_SESSION["msf_user_name"] = $username;
					$_SESSION['timeout'] = time();
					$country = visitor_country();
	
		 $mysqli->query("insert into login_history
						(
							ip_address,
							login_date,
							login_time,
							username,
							session_details,
							login_referrer,
							login_process_id,
							login_url,
							user_agent,
							user_country,
							login_status,
							login_page
						)
						values
						(
							'".$_SERVER['REMOTE_ADDR']."',
							'".date('Y-m-d')."',
							'".date('H:i:s')."',
							'".$email."',
							'',
							'".$_SERVER['HTTP_REFERER']."',
							'".getmypid()."',
							'".$_SERVER['HTTP_HOST']."/".$_SERVER["SCRIPT_NAME"]."',
							'".$_SERVER['HTTP_USER_AGENT']."',
							'".$country."',
							'SUCCESS',
							'USER'
							
							
							
							
							
						)");
						
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
					$country = visitor_country();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
									
									 $mysqli->query("insert into login_history
						(
							ip_address,
							login_date,
							login_time,
							username,
							session_details,
							login_referrer,
							login_process_id,
							login_url,
							user_agent,
							user_country,
							login_status,
							login_page
						)
						values
						(
							'".$_SERVER['REMOTE_ADDR']."',
							'".date('Y-m-d')."',
							'".date('H:i:s')."',
							'".$email."',
							'',
							'".$_SERVER['HTTP_REFERER']."',
							'".getmypid()."',
							'".$_SERVER['HTTP_HOST']."/".$_SERVER["SCRIPT_NAME"]."',
							'".$_SERVER['HTTP_USER_AGENT']."',
							'".$country."',
							'FAILED',
							'USER'
							
							
							
							
							
						)");
                    return false;
                }
            }
        } else {
            // No user exists.
			$country = visitor_country();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
									
									 $mysqli->query("insert into login_history
						(
							ip_address,
							login_date,
							login_time,
							username,
							session_details,
							login_referrer,
							login_process_id,
							login_url,
							user_agent,
							user_country,
							login_status,
							login_page
						)
						values
						(
							'".$_SERVER['REMOTE_ADDR']."',
							'".date('Y-m-d')."',
							'".date('H:i:s')."',
							'".$email."',
							'',
							'".$_SERVER['HTTP_REFERER']."',
							'".getmypid()."',
							'".$_SERVER['HTTP_HOST']."/".$_SERVER["SCRIPT_NAME"]."',
							'".$_SERVER['HTTP_USER_AGENT']."',
							'".$country."',
							'FAILED',
							'USER'
							
							
							
							
							
						)");
            return false;
        }
    }
}
function visitor_country()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		$result  = "Unknown";
		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
	
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
	
		if($ip_data && $ip_data->geoplugin_countryName != null)
		{
			$result = $ip_data->geoplugin_countryName;
		}
	
		return $result;
	}
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
 
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts <code><pre>
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
 
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['msf_admin_user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['msf_admin_user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}