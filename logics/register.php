<?php
	$reg = '';
	
	if(isset($_POST['btnRegister']))
	{
		$r_name = $_POST['r_name'];
		$r_pass = $_POST['r_pass'];
		$r_cpass = $_POST['r_cpass'];
		$r_full = $_POST['r_full'];
		$r_address = $_POST['r_address'];
		$r_email = $_POST['r_email'];	
		$r_phone = $_POST['r_phone'];
		
		if(!$r_name || !$r_pass || !$r_cpass || !$r_full || !$r_address || !$r_phone)
		{
			$reg = '<div class="msg">All fields are required</div>';
		} else if($r_pass != $r_cpass)
		{
			$reg = '<div class="msg">Password not matched</div>';
		} else
		{
			//save information
			$r_pass = md5($r_pass);
			if(mysql_query("INSERT INTO cps_users (username,pass,fullname,address,email,phone,reg_date,role) VALUES ('$r_name','$r_pass','$r_full','$r_address','$r_email','$r_phone',now(),'User')") or die(mysql_error()))
			{
				$reg = '<div class="msg">Registration Successful</div>';
			} else
			{
				$reg = '<div class="msg">There is problem trying to register this time. Please try again later</div>';
			}
		}
	}
	
	echo $reg;
?>