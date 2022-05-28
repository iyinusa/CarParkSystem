<?php
	//include
	include('designs/connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Monitory System | LogOut</title>
<link rel="stylesheet" type="text/css" href="styles/lay.css"/>
</head>

<body>
	<div id="all">
    	<div id="cont">
            <div id="header">
                <?php include('designs/header.php'); ?>
            </div>
            <div id="contents">
            	<div class="cont_right">
                	<?php include('designs/right.php'); ?>
                </div>
                <div class="cont_left">
                	<div class="page_title">Log Out >></div>
                    <?php
						session_destroy();
						echo '
							<h3 style="text-align:center;">
								You have successfully logged out of the system<br />
								<a href="'.$root.'/">Click here</a> to continue or 
								<a href="login.php">Click here</a> to login again. Thank you
							</h3>
						';
					?>
                </div>
            </div>
        </div>
        
        <div id="footer">
			<?php include('designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>