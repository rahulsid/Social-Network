<?php 
	include 'connect.php';
	$username=$fromid=$toid="";
	$username=$_POST["requestid"];
	session_start();
	$fromid = $_SESSION['uid'];
	$sql = "select uid from usertable where name='$username'";
	$result = mysqli_query($con,$sql);
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$toid = $row["uid"];
			$sql1 = "insert into notifications values ($fromid,$toid,2,NULL)";
			//$sql1 = "insert into requesttable values ($fromid,$toid)";
			$result2 = mysqli_query($con,$sql1);
			if($result2)
			{
				echo "Inserted in requesttable...!!";
			}
		}
	}else {}
?>