<?php
	$reg = '';
	$space_form = '';
	$list_sensor = '';
	
	//delete space
	if(isset($_GET['del']))
	{
		$del = $_GET['del'];
		
		if(isset($_POST['btnClose']))
		{
			header('location: space.php');
		}
		
		if(isset($_POST['btnDelete']))
		{
			if(mysql_query("DELETE FROM cps_space WHERE space_id='$del' LIMIT 1"))
			{
				$reg = '<div class="msg">Space Deleted</div>';
			} else
			{
				$reg = '<div class="msg">There is problem deleting this Space this time. Please try again later.</div>';
			}
		} else
		{
			$reg = '
				<form action="space.php?del='.$del.'" method="post" enctype="multipart/form-data">
					<h2>Are you sure you wants to DELETE this Space. Once deleted you will no longer have access to it.</h2>
					<input type="submit" name="btnDelete" value="YES - Delete" />&nbsp;
					<input type="submit" name="btnClose" value="Close" />
				</form>
			';	
		}
	}
	
	//pull all sensors
	$ps = mysql_query("SELECT * FROM cps_sensor ORDER BY sensor_name ASC");
	if((mysql_num_rows($ps)) > 0)
	{
		while($psr = mysql_fetch_assoc($ps))
		{
			$psid = $psr['sensor_id'];
			$psname = $psr['sensor_name'];
			
			$list_sensor .= '
				<option value="'.$psid.'">'.$psname.'</option>
			';
		}
	}
	
	//manage space
	if(isset($_POST['btnAddSpace']))
	{
		$r_name = $_POST['r_name'];
		$r_status = $_POST['r_status'];
		$r_sensor = $_POST['r_sensor'];
		
		if(!$r_name)
		{
			$reg = '<div class="msg">All fields are required</div>';
		} else
		{
			//save information as new or update
			$img = 'images/sensors.jpg';
			if(isset($_GET['space']))
			{
				$space = $_GET['space'];
				if(mysql_query("UPDATE cps_space SET sensor_id='$r_sensor',space_name='$r_name',space_status='$r_status' WHERE space_id='$space'") or die(mysql_error()))
				{
					$reg = '<div class="msg">Space Updated</div>';
				} else
				{
					$reg = '<div class="msg">There is problem trying to updating Space this time. Please try again later</div>';
				}
			} else
			{
				if(mysql_query("INSERT INTO cps_space (sensor_id,space_name,space_status) VALUES ('$r_sensor','$r_name','$r_status')") or die(mysql_error()))
				{
					$reg = '<div class="msg">Space Registered</div>';
				} else
				{
					$reg = '<div class="msg">There is problem trying to register Space this time. Please try again later</div>';
				}
			}
		}
	}
	
	if(isset($_GET['space']))
	{
		$space = $_GET['space'];
		//load selected space
		$l = mysql_query("SELECT * FROM cps_space WHERE space_id='$space' LIMIT 1");
		if((mysql_num_rows($l)) > 0)
		{
			while($lr = mysql_fetch_assoc($l))
			{
				$gid = $lr['space_id'];
				$gsid = $lr['sensor_id'];
				$gname = $lr['space_name'];
				$gstatus = $lr['space_status'];	
			}
			
			//get sensor info
			$s = mysql_query("SELECT * FROM cps_sensor WHERE sensor_id='$gsid' LIMIT 1");
			if((mysql_num_rows($s)) > 0)
			{
				while($sr = mysql_fetch_assoc($s))
				{
					$gsname = $sr['sensor_name'];	
				}
			}
			
			$space_form = '
				<form action="space.php?space='.$space.'" method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td><b>Current Sensor:</b></td>
							<td>
								'.$gsname.'
							</td>
						</tr>
						<tr>
							<td><b>Select Sensor:</b></td>
							<td>
								<select name="r_sensor">
									'.$list_sensor.'
								</select>
							</td>
						</tr>
						<tr>
							<td><b>Space Name/ID:</b></td>
							<td>
								<input type="text" name="r_name" value="'.$gname.'" />&nbsp;<i>(i.e. SP1)</i>
							</td>
						</tr>
						<tr>
							<td><b>Current Status</b></td>
							<td>
								'.$gstatus.'
							</td>
						</tr>
						<tr>
							<td><b>Change Status</b></td>
							<td>
								<select name="r_status">
									<option value="Available">Available</option>
									<option value="Allocated">Allocated</option>
								</status>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" name="btnAddSpace" value="Update Sensor Category" />
							</td>
						</tr>
					</table>
				</form>
			';
		}	
	} else
	{
		$space_form = '
			<form action="space.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td><b>Select Sensor:</b></td>
						<td>
							<select name="r_sensor">
								'.$list_sensor.'
							</select>
						</td>
					</tr>
					<tr>
						<td><b>Space Name/ID:</b></td>
						<td>
							<input type="text" name="r_name" />&nbsp;<i>(i.e. SP1)</i>
						</td>
					</tr>
					<tr>
						<td><b>Status</b></td>
						<td>
							<select name="r_status">
								<option value="Available">Available</option>
								<option value="Allocated">Allocated</option>
							</status>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="btnAddSpace" value="Add Space to Sensor" />
						</td>
					</tr>
				</table>
			</form>
		';
	}
	
	echo $reg;
	echo $space_form;
?>