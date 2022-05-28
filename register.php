<?php
	//include
	include('designs/connect.php');
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Monitory System | Register</title>
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
                	<div class="page_title">Register >></div>
                    <div>
                    	<?php include('logics/register.php'); ?>
                        <form action="register.php" method="post" enctype="multipart/form-data">
                        	<table>
                            	<tr>
                                	<td width="120px"><b>Username:</b></td>
                                    <td>
                                    	<input type="text" name="r_name" />
                                    </td>
                                </tr>
                                <tr>
                                	<td><b>Password:</b></td>
                                    <td>
                                    	<input type="password" name="r_pass" />
                                    </td>
                                </tr>
                                <tr>
                                	<td><b>Confirm Password:</b></td>
                                    <td>
                                    	<input type="password" name="r_cpass" />
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table>
                            	<tr>
                                	<td width="120px"><b>Fullname:</b></td>
                                    <td>
                                    	<input type="text" name="r_full" />
                                    </td>
                                </tr>
                                <tr>
                                	<td><b>Address:</b></td>
                                    <td>
                                    	<textarea name="r_address"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                	<td><b>Email:</b></td>
                                    <td>
                                    	<input type="text" name="r_email" />
                                    </td>
                                </tr>
                                <tr>
                                	<td><b>Phone:</b></td>
                                    <td>
                                    	<input type="text" name="r_phone" />
                                    </td>
                                </tr>
                            </table>
                            <div style="padding:5px; text-align:center; border-radius:5px; border:1px solid #999; margin:10px 0px;">
                            	<input type="submit" name="btnRegister" value="Register Me" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="footer">
			<?php include('designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>