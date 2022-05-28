<?php
	$msg = '';
	
	//check validation
	if(isset($_POST['btnLogin']))
	{
		$uname = mysql_real_escape_string($_POST['l_name']);
		$upass = mysql_real_escape_string($_POST['l_pass']);
		
		if(!$uname || !$upass)
		{
			$msg = '<div class="msg">All fields are required</div>';
		}
		else
		{
			//hash password
			$hash = md5($upass);
			//check authentication
			$auth = mysql_query("SELECT * FROM cps_users WHERE (username='$uname' OR email='$uname') AND pass='$hash' LIMIT 1");
			$auth_chk = mysql_num_rows($auth);
			if($auth_chk <= 0)
			{
				$msg .= '<div class="msg">Authentication Failed</div>';
			} else
			{
				//get member information
				$m_info = mysql_query("SELECT * FROM cps_users WHERE (username='$uname' OR email='$uname') AND pass='$hash' LIMIT 1");
				
				while($grow = mysql_fetch_assoc($m_info))
				{
					$gid = $grow['user_id'];
					$guser = $grow['username'];
					$gfull = $grow['fullname'];
					$gemail = $grow['email'];
					$gphone = $grow['phone'];
					$gaddress = $grow['address'];
					$greg = $grow['reg_date'];
					$grole = $grow['role'];
					
					//session_register('mem_id');
					//session_register('mem_name');
					//session_register('mem_full');
					//session_register('mem_email');
					//session_register('mem_phone');
					//session_register('mem_address');
					//session_register('mem_reg');
					//session_register('mem_role');
					
					$_SESSION['mem_id'] = $gid;
					$_SESSION['mem_name'] = $guser;
					$_SESSION['mem_full'] = $gfull;;
					$_SESSION['mem_email'] = $gemail;
					$_SESSION['mem_phone'] = $gphone;
					$_SESSION['mem_address'] = $gaddress;
					$_SESSION['mem_reg'] = $greg;
					$_SESSION['mem_role'] = $grole;
					  	
					//check if is redirected page
					if(isset($_GET['rf']))
					{
						$rf = $_GET['rf'];
						//redirect to page referer
						header("location: $rf");
					} else
					{
						header("location: user/profile.php");
					} ob_flush();
				}
			}
		}
		
		echo $msg;
	}
?>