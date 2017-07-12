<?php
if(isset($_SESSION['userId']))
{
	header("Location: index.php");
	exit();
}
include("admin/initUser.php");

if(isset($_POST['btnUserLogin']))
{
	$uname = trim($_POST['uname']);
	$pswd = trim($_POST['pswd']);
	$userExists = $users -> validateInfoUser($uname,$pswd);
	if($userExists)
	{
		//echo USERDISTRICT; die();
		//if($_SESSION['userType']==USERDISTRICT)
			header("location:index.php");
		//else
		//	header("location:reportcentral.php");
		//exit();
	}
	else
	{
		$errMsg = "Login failed!! Try again";
	}
}
?>