<?php 
	include 'connect.php';
	session_start();
	$uid= $_SESSION['uid'];
	$oid = $_POST["ownerid"];
	$projectname = $_POST["projecttitle"];
	$projectstatus = $_POST["projectstatus"];
	$valuedetails = $_POST["details"];
	if($projectstatus==='0')
	{
		echo $uid;
		echo "liked";
		echo $projectname;
		echo $valuedetails;
		if($valuedetails==="thumbsup")
		{
			$sql = "update myprojects set projectlikes = projectlikes + 1 where  uid = $oid and projecttitle= '$projectname' ";
			$result = mysqli_query($con,$sql);
			if($result)
			{
				$sql2 = "insert into notifications values($uid,$oid,1,'$projectname')";
				$result2 = mysqli_query($con,$sql2);
				if($result2)
				{
					header('location:home.php');
				}
			}
		}
		else if($valuedetails==="requestdetails")
		{
			$sql2 = "insert into notifications values($uid,$oid,4,'$projectname')";
			$result2 = mysqli_query($con,$sql2);
			if($result2)
			{
				header('location:home.php');
			}
		}
	}
	else if($projectstatus==='1')
	{
		$sql = "insert into notifications values($uid,$oid,3,'$projectname')";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			header('location:home.php');
		}
	}
?>