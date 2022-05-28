<?php
	$msg = '';
	$fmsg = '';
	
	if(isset($_GET['park']))
	{
		$park = $_GET['park'];
		
		if(isset($_POST['btnClose']))
		{
			header("location: request.php");
		}
		
		if(isset($_POST['btnManage']))
		{
			$r_set = $_POST['r_set'];
			
			if(mysql_query("UPDATE cps_space SET space_status='Available' WHERE space_id='$r_set' LIMIT 1"))
			{
				if(mysql_query("DELETE FROM cps_park WHERE park_id='$park' LIMIT 1"))
				{
					$fmsg = '<div class="msg">Space Manages Successfully</div>';
				} else
				{
					$fmsg = '<div class="msg">There is problem this time. Please try again later.</div>';
				}
			} else
			{
				$fmsg = '<div class="msg">There is problem this time. Please try again later.</div>';	
			}
			
		} else
		{
			//load selected request information
			$p = mysql_query("SELECT * FROM cps_park WHERE park_id='$park' LIMIT 1");
			if(mysql_num_rows($p) > 0)
			{
				while($pr = mysql_fetch_assoc($p))
				{
					$pid = $pr['park_id'];
					$psid = $pr['space_id'];
					$puid = $pr['user_id'];
					$pmake = $pr['car_make'];
					$pmodel = $pr['car_model'];
					$pnumber = $pr['car_number'];	
				}
			}
			
			$fmsg = '
				<form action="request.php?park='.$park.'" method="post" enctype="multipart/form-data">
					<fieldset>
						<legend><b style="color:Maroon;">Manage Allocated Space</b></legend>
						<table>
							<tr>
								<td><b>Car Name:</b></td>
								<td>'.$pmake.'</td>
							</tr>
							<tr>
								<td><b>Car Model:</b></td>
								<td>'.$pmodel.'</td>
							</tr>
							<tr>
								<td><b>Car Plate Number:</b></td>
								<td>'.$pnumber.'</td>
							</tr>
							<tr>
								<td><b>Set Availability:</b></td>
								<td>
									<select name="r_set">
										<option value="'.$psid.'">Available</option>
									</select>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="btnManage" value="Manage Space" />
									<input type="submit" name="btnClose" value="Close" />
								</td>
							</tr>
						</table>
					</fieldset>
				</form>
				<br />
			';
		}
	}
	
	//load allocated spaces
	$l = mysql_query("SELECT * FROM cps_park ORDER BY park_id DESC");
	if((mysql_num_rows($l)) <= 0)
	{
		$msg = 'No Space Allocation Yet';
	} else
	{
		$msg = '
			<tr class="tb_hd">
				<td width="50px" align="center">DATE</td>
				<td>SPACE</td>
				<td>PARK BY</td>
				<td>CAR</td>
				<td>PLATE No.</td>
				<td width="50px"></td>
			</tr>
		';
		
		while($lr = mysql_fetch_assoc($l))
		{
			$lid = $lr['park_id'];
			$lsid = $lr['space_id'];
			$luid = $lr['user_id'];
			$lmake = $lr['car_make'];
			$lmodel = $lr['car_model'];
			$lnumber = $lr['car_number'];
			$ldate = $lr['reg_date'];
			
			//get space info
			$ls = mysql_query("SELECT * FROM cps_space WHERE space_id='$lsid' LIMIT 1");
			if((mysql_num_rows($ls)) > 0)
			{
				while($lr = mysql_fetch_assoc($ls))
				{
					$lsname = $lr['space_name'];	
				}
			}
			
			//get user info
			$lu = mysql_query("SELECT * FROM cps_users WHERE user_id='$luid' LIMIT 1");
			if((mysql_num_rows($lu)) > 0)
			{
				while($lur = mysql_fetch_assoc($lu))
				{
					$luname = $lur['fullname'];	
				}
			}
			
			$msg .= '
				<tr style="background-color:#925; color:#FFF;">
					<td align="center"><b>'.$ldate.'</b></td>
					<td>'.$lsname.'</td>
					<td>'.$luname.'</td>
					<td>'.$lmake.' ('.$lmodel.')</td>
					<td>'.$lnumber.'</td>
					<td align="center"><b><a href="request.php?park='.$lid.'">MANAGE</a></b></td>
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