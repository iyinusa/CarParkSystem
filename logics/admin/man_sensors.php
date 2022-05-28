<?php
	$reg = '';
	$sensor_form = '';
	
	//delete sensor
	if(isset($_GET['del']))
	{
		$del = $_GET['del'];
		
		if(isset($_POST['btnClose']))
		{
			header('location: sensor.php');
		}
		
		if(isset($_POST['btnDelete']))
		{
			if(mysql_query("DELETE FROM cps_sensor WHERE sensor_id='$del' LIMIT 1"))
			{
				$reg = '<div class="msg">Sense Deleted</div>';
			} else
			{
				$reg = '<div class="msg">There is problem deleting this Sensor this time. Please try again later.</div>';
			}
		} else
		{
			$reg = '
				<form action="sensor.php?del='.$del.'" method="post" enctype="multipart/form-data">
					<h2>Are you sure you wants to DELETE this Sensor. Once deleted you will no longer have access to it.</h2>
					<input type="submit" name="btnDelete" value="YES - Delete" />&nbsp;
					<input type="submit" name="btnClose" value="Close" />
				</form>
			';	
		}
	}
	
	//manage sensor
	if(isset($_POST['btnAddSensor']))
	{
		$r_name = $_POST['r_name'];
		$r_desc = $_POST['r_desc'];
		
		if(!$r_name || !$r_desc)
		{
			$reg = '<div class="msg">All fields are required</div>';
		} else
		{
			//save information as new or update
			$img = 'images/sensors.jpg';
			if(isset($_GET['sensor']))
			{
				$sensor = $_GET['sensor'];
				if(mysql_query("UPDATE cps_sensor SET sensor_name='$r_name',sensor_desc='$r_desc' WHERE sensor_id='$sensor'") or die(mysql_error()))
				{
					$reg = '<div class="msg">Sensor Updated</div>';
				} else
				{
					$reg = '<div class="msg">There is problem trying to updating sensor this time. Please try again later</div>';
				}
			} else
			{
				if(mysql_query("INSERT INTO cps_sensor (sensor_name,sensor_desc,sensor_img) VALUES ('$r_name','$r_desc','$img')") or die(mysql_error()))
				{
					$reg = '<div class="msg">Sensor Registered</div>';
				} else
				{
					$reg = '<div class="msg">There is problem trying to register sensor this time. Please try again later</div>';
				}
			}
		}
	}
	
	if(isset($_GET['sensor']))
	{
		$sensor = $_GET['sensor'];
		//load selected sensor
		$l = mysql_query("SELECT * FROM cps_sensor WHERE sensor_id='$sensor' LIMIT 1");
		if((mysql_num_rows($l)) > 0)
		{
			while($lr = mysql_fetch_assoc($l))
			{
				$gid = $lr['sensor_id'];
				$gname = $lr['sensor_name'];
				$gdesc = $lr['sensor_desc'];
				$gimg = $lr['sensor_img'];	
			}
			
			$sensor_form = '
				<form action="sensor.php?sensor='.$sensor.'" method="post" enctype="multipart/form-data">
					<table>
						<tr>
							<td><b>Sensor Name:</b></td>
							<td>
								<input type="text" name="r_name" value="'.$gname.'" />
							</td>
						</tr>
						<tr>
							<td><b>Sensor Description:</b></td>
							<td>
								<textarea name="r_desc">'.$gdesc.'</textarea>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" name="btnAddSensor" value="Update Sensor Category" />
							</td>
						</tr>
					</table>
				</form>
			';
		}	
	} else
	{
		$sensor_form = '
			<form action="sensor.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td><b>Sensor Name:</b></td>
						<td>
							<input type="text" name="r_name" />
						</td>
					</tr>
					<tr>
						<td><b>Sensor Description:</b></td>
						<td>
							<textarea name="r_desc"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="btnAddSensor" value="Add Sensor Category" />
						</td>
					</tr>
				</table>
			</form>
		';
	}
	
	echo $reg;
	echo $sensor_form;
?>