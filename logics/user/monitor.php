<?php
	$msg = '';
	$fmsg = '';
	
	$of = $_SESSION['mem_name'];
	
	//load allocated spaces
	$l = mysql_query("SELECT * FROM cps_inventory WHERE inv_of='$of' ORDER BY inv_id DESC");
	if((mysql_num_rows($l)) <= 0)
	{
		$msg = 'No Inventory Records Yet';
	} else
	{
		$msg = '
			<tr class="tb_hd">
				<td width="50px" align="center">DATE/TIME</td>
				<td>TITLE</td>
				<td>DETAILS</td>
			</tr>
		';
		
		while($lr = mysql_fetch_assoc($l))
		{
			$inv_id = $lr['inv_id'];
			$inv_of = $lr['inv_of'];
			$inv_name = $lr['inv_name'];
			$inv_details = $lr['inv_details'];
			$inv_time = $lr['inv_time'];
			
			$msg .= '
				<tr>
					<td align="center"><b>'.$inv_time.'</b></td>
					<td>'.$inv_name.'</td>
					<td>'.$inv_details.'</td>
				</tr>
			';
		}
	}
	
	echo $fmsg;
	echo '
		<div>
			<table class="utable">
				'.$msg.'
			</table>
		</div>
	';
?>