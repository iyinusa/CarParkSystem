<?php
	$msg = '';
	
	//load selected sensor
	$l = mysql_query("SELECT * FROM cps_sensor ORDER BY sensor_id DESC");
	if((mysql_num_rows($l)) <= 0)
	{
		$msg = 'No Sensor Registered';
	} else
	{
		$msg = '
			<tr class="tb_hd">
				<td width="50px"></td>
				<td width="60px"></td>
				<td>SENSOR</td>
				<td>DESCRIPTION</td>
				<td width="50px"></td>
			</tr>
		';
		
		while($lr = mysql_fetch_assoc($l))
		{
			$gid = $lr['sensor_id'];
			$gname = $lr['sensor_name'];
			$gdesc = $lr['sensor_desc'];
			$gimg = $lr['sensor_img'];
			
			$msg .= '
				<tr>
					<td align="center"><b><a href="sensor.php?del='.$gid.'">DELETE</a></b></td>
					<td align="center"><img src="'.$root.'/' .$gimg.'" /></td>
					<td>'.$gname.'</td>
					<td>'.$gdesc.'</td>
					<td align="center"><b><a href="sensor.php?sensor='.$gid.'">EDIT</a></b></td>
				</tr>
			';
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