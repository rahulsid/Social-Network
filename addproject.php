<?php 
	include 'connect.php';
	session_start();
	$uid = $_SESSION['uid'];
	$title=$description=$status="";
	$title = $_POST["title"];
	$description =  $_POST["description"];
	$status = $_POST["status"];
	if($status === 'completed')
	{
	$sql = "insert into myprojects values ($uid,'$title','$description',0,0)";
	$res = mysqli_query($con,$sql);
	if($res)
	{
		echo $status;
		echo "Insertedd..!!";
	}
	}else if($status ==='ongoing')
	{
		$sql = "insert into myprojects values ($uid,'$title','$description',1,0)";
	$res = mysqli_query($con,$sql);
	if($res)
	{
		echo $status;
		echo "Insertedd..!!";
	}
	}
?>