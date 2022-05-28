<?php
	//include
	include('designs/connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Monitory System | Log In</title>
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
                	<div class="page_title">Log In >></div>
                    <div>
                    	<?php include('logics/login.php'); ?>
                        <form action="login.php" method="post" enctype="multipart/form-data">
                        	<table>
                            	<tr>
                                	<td width="120px"><b>Username:</b></td>
                                    <td>
                                    	<input type="text" name="l_name" />
                                    </td>
                                </tr>
                                <tr>
                                	<td><b>Password:</b></td>
                                    <td>
                                    	<input type="password" name="l_pass" />
                                    </td>
                                </tr>
                            </table>
                            <div style="padding:5px; text-align:center; border-radius:5px; border:1px solid #999; margin:10px 0px;">
                            	<input type="submit" name="btnLogin" value="Login Me" />
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