<?php
	//include
	include('designs/connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Monitory System</title>
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
                	<img src="images/carparking.jpg" />
                    <br />
                    <h2>Car Park Management System</h2>
                    Car-park management systems operate by monitoring the availability of car-parking spaces and making that information available to customers and facility administrators.
                    <br /><br />
                    Customers use it for guiding them in their choice of parking space and Administrators use it to aid in overall management and planning.
                </div>
            </div>
        </div>
        
        <div id="footer">
			<?php include('designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>