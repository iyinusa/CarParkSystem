<?php
	$msg = '';
	
	//load selected sensor
	$l = mysql_query("SELECT * FROM cps_space ORDER BY space_id DESC");
	if((mysql_num_rows($l)) <= 0)
	{
		$msg = 'No Space Registered';
	} else
	{
		$msg = '
			<tr class="tb_hd">
				<td width="50px"></td>
				<td>SENSOR</td>
				<td>SPACE NAME</td>
				<td>STATUS</td>
				<td width="50px"></td>
			</tr>
		';
		
		while($lr = mysql_fetch_assoc($l))
		{
			$lid = $lr['space_id'];
			$lname = $lr['space_name'];
			$lstatus = $lr['space_status'];
			$lsid = $lr['sensor_id'];
			
			//get sensor info
			$ls = mysql_query("SELECT * FROM cps_sensor WHERE sensor_id='$lsid' LIMIT 1");
			if((mysql_num_rows($ls)) > 0)
			{
				while($lr = mysql_fetch_assoc($ls))
				{
					$lsname = $lr['sensor_name'];	
				}
			}
			
			if($lstatus == "Available")
			{
				$msg .= '
					<tr>
						<td align="center"><b><a href="space.php?del='.$lid.'">DELETE</a></b></td>
						<td>'.$lsname.'</td>
						<td>'.$lname.'</td>
						<td>'.$lstatus.'</td>
						<td align="center"><b><a href="space.php?space='.$lid.'">EDIT</a></b></td>
					</tr>
				';
			} else
			{
				$msg .= '
					<tr style="background-color:#925; color:#FFF;">
						<td align="center"><b><a href="space.php?del='.$lid.'">DELETE</a></b></td>
						<td>'.$lsname.'</td>
						<td>'.$lname.'</td>
						<td>'.$lstatus.'</td>
						<td align="center"><b><a href="space.php?space='.$lid.'">EDIT</a></b></td>
					</tr>
				';
	
			}
		}
	}
	
	echo '
		<div>
			<table class="utable">
				'.$msg.'
			</table>
		</div>
	';
?>