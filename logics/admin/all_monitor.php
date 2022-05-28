<?php
	$msg = '';
	
	//load allocated spaces
	$l = mysql_query("SELECT * FROM cps_inventory ORDER BY inv_id DESC");
	if((mysql_num_rows($l)) <= 0)
	{
		$msg = 'No Inventory Records Yet';
	} else
	{
		$msg = '
			<tr class="tb_hd">
				<td width="50px" align="center">DATE/TIME</td>
				<td width="70px">INV. OF</td>
				<td width="60px">TITLE</td>
				<td>DETAILS</td>
				<td width="60px">PHONE NO.</td>
			</tr>
		';
		
		while($lr = mysql_fetch_assoc($l))
		{
			$inv_id = $lr['inv_id'];
			$inv_of = $lr['inv_of'];
			$inv_name = $lr['inv_name'];
			$inv_details = $lr['inv_details'];
			$inv_time = $lr['inv_time'];
			
			//load user information
			$u = mysql_query("SELECT * FROM cps_users WHERE username='$inv_of' LIMIT 1");
			if(mysql_num_rows($u))
			{
				while($ur = mysql_fetch_assoc($u))
				{
					$inv_of = $ur['fullname'];
					$inv_phone = $ur['phone'];	
				}
			}
			
			$msg .= '
				<tr>
					<td align="center"><b>'.$inv_time.'</b></td>
					<td><b>'.$inv_of.'</b></td>
					<td>'.$inv_name.'</td>
					<td>'.$inv_details.'</td>
					<td align="center">'.$inv_phone.'</td>
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