<?php
	$acc = '';
	$logv = '';
	
	//check if user is in session
	if(isset($_SESSION['mem_name']))
	{
		$gname = $_SESSION['mem_name'];
		$grole = $_SESSION['mem_role'];
		if($grole == "Admin")
		{
			$logv = '<div class="logv">Welcome <b>'.$gname.'</b> [ <a href="'.$root.'/logout.php">LogOut</a> ]</div>';
			$acc = '
				<div class="gadget">
					<div class="g_hd">Account Menu</div>
					<div class="g_cont">
						'.$logv.'
						<div class="menu">
							<ul>
								<li><a href="'.$root.'/">Home</a></li>
								<li><a href="'.$root.'/user/profile.php">Profile</a></li>
								<li><a href="'.$root.'/park.php">Car Park</a></li>
								<li><a href="'.$root.'/admin/sensor.php">Add Sensor</a></li>
								<li><a href="'.$root.'/admin/space.php">Manage Space</a></li>
								<li><a href="'.$root.'/user/space.php">Request Space</a></li>
								<li><a href="'.$root.'/admin/request.php">Requested Spaces</a></li>
								<li><a href="'.$root.'/user/monitor.php">Monitor My Car</a></li>
								<li><a href="'.$root.'/admin/monitor.php">Monitor Cars</a></li>
							</ul>
						</div>
					</div>
				</div>
			';
		} else if($grole == "User")
		{
			$logv = '<div class="logv">Welcome <b>'.$gname.'</b> [ <a href="'.$root.'/logout.php">LogOut</a> ]</div>';
			$acc = '
				<div class="gadget">
					<div class="g_hd">Account Menu</div>
					<div class="g_cont">
						'.$logv.'
						<div class="menu">
							<ul>
								<li><a href="'.$root.'/">Home</a></li>
								<li><a href="'.$root.'/user/profile.php">Profile</a></li>
								<li><a href="'.$root.'/park.php">Car Park</a></li>
								<li><a href="'.$root.'/user/space.php">Request Space</a></li>
								<li><a href="'.$root.'/user/monitor.php">Monitor My Car</a></li>
							</ul>
						</div>
					</div>
				</div>
			';
		}
	} else
	{
		$logv = '<div class="logv">Welcome Guest [ <a href="'.$root.'/login.php">LogIn</a> ] [ <a href="'.$root.'/register.php">Register</a> ]</div>';
		$acc = '
			<div class="gadget">
				<div class="g_hd">Account Login</div>
				<div class="g_cont">
					<div class="menu">
						<ul>
							<li><a href="'.$root.'/">Home</a></li>
							<li><a href="'.$root.'/park.php">Car Park</a></li>
						</ul>
					</div>
					'.$logv.'
					<form action="'.$root.'/login.php" method="post" enctype="multipart/form-data">
						Username:<br />
						<input type="text" name="l_name" />
						<br /><br />
						Password:<br />
						<input type="password" name="l_pass" />
						<br /><br />
						<input type="submit" name="btnLogin" value="Login Now" />
					</form>	
				</div>
			</div>
		';
	}
	
	echo $acc;
?>