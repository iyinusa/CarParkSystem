<?php
	//include
	include('../designs/connect.php');
	
	if(isset($_SESSION['mem_name']))
	{
		
	} else
	{
		header('location: ../login.php');	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Monitory System | Monitors</title>
<link rel="stylesheet" type="text/css" href="../styles/lay.css"/>
</head>

<body>
	<div id="all">
    	<div id="cont">
            <div id="header">
                <?php include('../designs/header.php'); ?>
            </div>
            <div id="contents">
            	<div class="cont_right">
                	<?php include('../designs/right.php'); ?>
                </div>
                <div class="cont_left">
                	<div class="page_title">Monitor My Car >></div>
                    <br />
                    Users can make use of this session to monitor his/her parking activities
                    <br /><br />
                    <fieldset>
                    	<legend><b>Your Parking Inventory</b></legend>
                        <?php include('../logics/user/monitor.php'); ?>
                    </fieldset>
                </div>
            </div>
        </div>
        
        <div id="footer">
			<?php include('../designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>