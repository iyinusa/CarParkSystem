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
<title>Car Monitory System | Request Space</title>
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
                	<div class="page_title">Request Parking Space >></div>
                    <?php include('../logics/user/request.php'); ?>
                    <br />
                    <fieldset>
                    	<legend><b>Car Park Space Request</b></legend>
                        <form action="space.php" method="post" enctype="multipart/form-data">
                            <table style="width:100%;">
                                <tr style="background-color:#EEE;">
                                    <td><b>Select Available Space:</b></td>
                                    <td>
                                        <select name="r_space">
                                        	<?php echo $space; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Car Maker:</b></td>
                                    <td>
                                        <select name="r_maker">
                                        	<option value="Beijing">Beijing</option>
                                            <option value="BMW">BMW</option>
                                            <option value="Chrysler">Chrysler</option>
                                            <option value="Daimler AG">Daimler AG</option>
                                            <option value="Dongfeng">Dongfeng</option>
                                            <option value="Fiat">Fiat</option>
                                            <option value="Ford">Ford</option>
                                            <option value="Geely">Geely</option>
                                            <option value="GM">GM</option>
                                            <option value="Honda">Honda</option>
                                            <option value="Hyundai">Hyundai</option>
                                            <option value="Lexus">Lexus</option>
                                            <option value="Mazda">Mazda</option>
                                            <option value="Mecedes Benz">Mecedes Benz</option>
                                            <option value="Nissan">Nissan</option>
                                            <option value="PSA">PSA</option>
                                            <option value="Suzuki">Suzuki</option>
                                            <option value="Tata">Tata</option>
                                            <option value="Toyota">Toyota</option>
                                            <option value="Volkswagen">Volkswagen</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Car Model:</b></td>
                                    <td>
                                        <input type="text" name="r_model" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Plate Number:</b></td>
                                    <td>
                                        <input type="text" name="r_number" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Car Colour:</b></td>
                                    <td>
                                        <select name="r_colour">
                                        	<option value="Arch">Arch</option>
                                            <option value="Black">Black</option>
                                            <option value="Blue">Blue</option>
                                            <option value="Green">Green</option>
                                            <option value="White">White</option>
                                            <option value="Wine">Wine</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                	<td></td>
                                    <td>
                                    	<input type="submit" name="btnRequest" value="Request Parking Space Now" />
                                    </td>
                                </tr>	
                            </table>
                        </form>
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