<?php
	$list = '';
	$slist = '';
	$remove = '';
	$rm = '';
	$car = '';
	$model = '';
	$space = '';
	$car_make = '';
	$car_model = '';
	$car_number = '';
	$space_name = '';
	$park_id = '';
	$user_id = '';
	
	//remove car from packing space
	if(isset($_SESSION['mem_name']))
	{
		$inv_by = $_SESSION['mem_name'];
		$inv_phone = $_SESSION['mem_phone'];
		$inv_phone = '234'.substr($inv_phone, -10);
		
		if(isset($_GET['rm']) && isset($_GET['car']) && isset($_GET['model']) && isset($_GET['num']) && isset($_GET['space']))
		{
			$rm = $_GET['rm'];
			$car = $_GET['car'];
			$model = $_GET['model'];
			$num = $_GET['num'];
			$space = $_GET['space'];
			
			if(mysql_query("DELETE FROM cps_park WHERE park_id='$rm'"))
			{
				//update space status
				if(mysql_query("UPDATE cps_space SET space_status='Available' WHERE space_name='$space' LIMIT 1"))
				{
					//update inventory
					$desc = $car.' '.$model.' with Plate Number: '.$num.' Checked Out on Space '.$space;
					if(mysql_query("INSERT INTO cps_inventory (inv_of,inv_name,inv_details,inv_time) VALUES ('$inv_by','Car Checked Out','$desc',now())"))
					{
						// send sms
						$response = @file_get_contents('https://portal.nigeriabulksms.com/api/?username=iyinusa@yahoo.co.uk&password=&message='.$desc.'&sender=CPMS&verbose=true&mobiles='.$inv_phone);

						//redirect back to page
						header("location: park.php"); 
					}
				}
			}
		}
	}
	
	//list all spaces
	$s = mysql_query("SELECT * FROM cps_sensor ORDER BY sensor_name ASC");
	$s_chk = mysql_num_rows($s);
	if($s_chk > 0)
	{
		while($sr = mysql_fetch_assoc($s))
		{
			$sensor_id = $sr['sensor_id'];
			$sensor_name = $sr['sensor_name'];
			
			//list spaces
			$sp = mysql_query("SELECT * FROM cps_space WHERE sensor_id='$sensor_id'");
			$sp_chk = mysql_num_rows($sp);
			
			$line = 1;
			$list = '';
			while($spr = mysql_fetch_assoc($sp))
			{
				$space_id = $spr['space_id'];
				$space_name = $spr['space_name'];
				$space_status = $spr['space_status'];
				
				//get pack information
				$pk = mysql_query("SELECT * FROM cps_park WHERE space_id='$space_id' LIMIT 1");
				if((mysql_num_rows($pk)) > 0)
				{
					while($pkr = mysql_fetch_assoc($pk))
					{
						$park_id = $pkr['park_id'];
						$user_id = $pkr['user_id'];
						$car_make = $pkr['car_make'];
						$car_model = $pkr['car_model'];
						$car_number = $pkr['car_number'];
						$car_colour = $pkr['car_colour'];
						$reg_date = $pkr['reg_date'];
					}
				}	
			
				if(isset($_SESSION['mem_id']))
				{
					if(($_SESSION['mem_id']) == $user_id)
					{
						$remove = '<a href="park.php?car='.$car_make.'&amp;model='.$car_model.'&amp;num='.$car_number.'&amp;space='.$space_name.'&amp;rm='.$park_id.'">Remove Car</a>';
					} else
					{
						$remove = '';
					}
				} else {$remove = '';}
				
				if($space_status == "Available")
				{
					if($line <= 4)
					{
						$list .= '
							<div class="sp_cat">
								<div style="font-size:x-large; text-align:center; color:#CCC; padding-top:10px;">
									'.$space_name.'
								</div>
							</div>
						';
					} else
					{
						$list .= '
							<div class="sp_cat_alt">
								<div style="font-size:x-large; text-align:center; color:#CCC; padding-top:10px;">
									'.$space_name.'
								</div>
							</div>
						';
					}
				} else
				{
					if($line <= 4)
					{
						$list .= '
							<div class="sp_cat">
								<img src="images/car-'.$car_colour.'.gif" />
								<div style="font-size:x-small; font-weight:bold;">'.$car_make.' ['.$car_model.']</div>
								<div style="padding:3px; font-size:xx-small;">'.$car_number.'</div>
								<div style="font-size:x-small; color:Maroon;">
									'.$remove.'
								</div>
							</div>
						';
					} else
					{
						$list .= '
							<div class="sp_cat_alt">
								<img src="images/car-'.$car_colour.'.gif" />
								<div style="font-size:x-small; font-weight:bold;">'.$car_make.' ['.$car_model.']</div>
								<div style="padding:3px; font-size:xx-small;">'.$car_number.'</div>
								<div style="font-size:x-small; color:Maroon;">
									'.$remove.'
								</div>
							</div>
						';
					}
				}
				
				$line += 1;
			}
			$slist .= '
				  <div class="space">
					  '.$list.'
				  </div>
			  ';
		}
	}
	
	echo $slist;
?>