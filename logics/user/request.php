<?php
	$reg = '';
	$space = '';
	
	if(isset($_POST['btnRequest']))
	{
		$by = $_SESSION['mem_id'];
		$inv_by = $_SESSION['mem_name'];
		$inv_phone = $_SESSION['mem_phone'];
		$inv_phone = '234'.substr($inv_phone, -10);
		$r_space = $_POST['r_space'];
		$r_maker = $_POST['r_maker'];
		$r_model = $_POST['r_model'];
		$r_number = $_POST['r_number'];
		$r_colour = $_POST['r_colour'];
		
		if(!$r_space || !$r_maker || !$r_model || !$r_number || !$r_colour)
		{
			$reg = '<div class="msg">All fields are required</div>';
		} else if((mysql_num_rows(mysql_query("SELECT * FROM cps_park WHERE user_id='$by' AND space_id='$r_space' LIMIT 1"))) <= 0)
		{
			if(mysql_query("INSERT INTO cps_park (space_id,user_id,car_make,car_model,car_number,car_colour,reg_date) VALUES ('$r_space','$by','$r_maker','$r_model','$r_number','$r_colour',now())"))
			{
				//change space availability
				if(mysql_query("UPDATE cps_space SET space_status='Allocated' WHERE space_id='$r_space' LIMIT 1"))
				{
					//get space name
					$sn = mysql_query("SELECT * FROM cps_space WHERE space_id='$r_space' LIMIT 1");
					if(mysql_num_rows($sn) > 0)
					{
						while($snr = mysql_fetch_assoc($sn))
						{
							$snam = $snr['space_name'];	
						}
					}
					
					//create car inventory
					$desc = $r_maker.' '.$r_model.' with Plate Number: '.$r_number.' and Colour: '.$r_colour.' Checked In on Space '.$snam;
					if(mysql_query("INSERT INTO cps_inventory (inv_of,inv_name,inv_details,inv_time) VALUES ('$inv_by','Car Checked In','$desc',now())"))
					{
						$reg = '<div class="msg">Space Allocated for you successfully</div>';

						// send sms
						$response = @file_get_contents('http://portal.nigeriabulksms.com/api/?username=iyinusa@yahoo.co.uk&password=access&message='.$desc.'&sender=CPMS&verbose=true&mobiles='.$inv_phone);

					} else
					{
						$reg = '<div class="msg">There is problem requesting for space this time. Please try again later.</div>';	
					}
				}
			} else
			{
				$reg = '<div class="msg">There is problem requesting for space this time. Please try again later.</div>';	
			}
		}
	}
	
	
	//pull all available spaces
	$av = mysql_query("SELECT * FROM cps_space WHERE space_status='Available' ORDER BY space_name ASC");
	$av_chk = mysql_num_rows($av);
	if($av_chk <= 0)
	{
		$space = '<option value="">No Space Available</option>';
	} else
	{
		while($avr = mysql_fetch_assoc($av))
		{
			$s_id = $avr['space_id'];
			$s_name = $avr['space_name'];
			
			$space .= '<option value="'.$s_id.'">'.$s_name.'</option>';
		}
	}
	
	echo $reg;
?>