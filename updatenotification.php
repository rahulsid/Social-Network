<?php 
	include 'connect.php';
	session_start();
	$uid = $_SESSION['uid'];
	$projectname = $_POST["projecttitle"];
	$fromid = $_POST["fromid"];
	$reason = $_POST["reason"];
	echo $projectname;
	echo $uid;
	echo $fromid;
	echo $reason;
	$sql = "delete from notifications where fromid = $fromid and toid=$uid and reason = $reason and projecttitle='$projectname'";
	$result = mysqli_query($con,$sql);
	if($result)
	{
		echo "deleted!!";
		//header("location:home.php");
	}
?>