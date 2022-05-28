<?php
	//include
	include('../designs/connect.php');
	
	if(isset($_SESSION['mem_name']))
	{
        $edit = false;
        if(isset($_GET['edit'])) {
            if($_GET['edit'] == 1) {
                $edit = true;

                if(isset($_POST['btnUpdate'])) {
                    $user_id = $_SESSION['mem_id'];
                    $password = $_POST['password'];
                    $fullname = mysql_real_escape_string($_POST['fullname']);
                    $address = mysql_real_escape_string($_POST['address']);
                    $email = mysql_real_escape_string($_POST['email']);
                    $phone = mysql_real_escape_string($_POST['phone']);

                    if($password != '') {
                        $password = mysql_real_escape_string($password);
                        $password = md5($password);
                        $dquery = "UPDATE cps_users SET fullname='$fullname',address='$address',phone='$phone',email='$email',pass='$password' WHERE user_id='$user_id'";
                    } else {
                        $dquery = "UPDATE cps_users SET fullname='$fullname',address='$address',phone='$phone',email='$email' WHERE user_id='$user_id'";
                    }

                    if(mysql_query($dquery) or die(mysql_error())) {
                        $_SESSION['mem_full'] = $fullname;
                        $_SESSION['mem_address'] = $address;
                        $_SESSION['mem_email'] = $email;
                        $_SESSION['mem_phone'] = $phone;
                        
                        header("location: ".$root."/user/profile.php");
                    } 
                }
            }
        }
	} else
	{
		header('location: ../login.php');	
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Monitory System | Profile</title>
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
                    <div class="page_title">Profile <small style="color:red; font-size:14px;">[ <a href="<?php echo $root; ?>/user/profile.php?edit=1">Edit</a> ]</small></div>
                    
                    <?php if($edit == false){ ?>
                        <table>
                            <tr>
                                <td width="120px"><b>Username:</b></td>
                                <td>
                                    <?php echo $_SESSION['mem_name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="120px"><b>Password:</b></td>
                                <td>
                                    <i>**Protected</i>
                                </td>
                            </tr>
                        </table>
                        <hr />
                        <table>
                            <tr>
                                <td width="120px"><b>Full Name:</b></td>
                                <td>
                                    <?php echo $_SESSION['mem_full']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="120px"><b>Address:</b></td>
                                <td>
                                    <?php echo $_SESSION['mem_address']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="120px"><b>Email:</b></td>
                                <td>
                                    <?php echo $_SESSION['mem_email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="120px"><b>Phone:</b></td>
                                <td>
                                    <?php echo $_SESSION['mem_phone']; ?>
                                </td>
                            </tr>
                        </table>
                    <?php } else { ?>
                        <form action="<?php echo $root; ?>/user/profile.php?edit=1" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td width="120px"><b>Change Password:</b></td>
                                    <td>
                                        <input type="password" name="password" style="width: 100%" />
                                    </td>
                                </tr>
                            </table>
                            <hr />
                            <table>
                                <tr>
                                    <td width="120px"><b>Change Full Name:</b></td>
                                    <td>
                                        <input type="text" name="fullname" value="<?php echo $_SESSION['mem_full']; ?>" style="width: 100%" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="120px"><b>Change Address:</b></td>
                                    <td>
                                        <textarea rows="2" name="address" style="width: 100%"><?php echo $_SESSION['mem_address']; ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="120px"><b>Change Email:</b></td>
                                    <td>
                                        <input type="text" name="email" value="<?php echo $_SESSION['mem_email']; ?>" style="width: 100%" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="120px"><b>Change Phone:</b></td>
                                    <td>
                                        <input type="text" name="phone" value="<?php echo $_SESSION['mem_phone']; ?>" style="width: 100%" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input type="submit" name="btnUpdate" value="Update Profile" /></td>
                                </tr>
                            </table>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <div id="footer">
			<?php include('../designs/footer.php'); ?>
        </div>
    </div>
</body>
</html>