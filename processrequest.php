<?php 
	include 'connect.php';
	session_start();
	$toid = $_SESSION['uid'];
	//uid->toid fromif->fid
	$fromid = $_POST["fromid"];
	$request = $_POST["request"];
	if($request==="accept")
	{
		$sql = "insert into friends values($toid,$fromid)";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			echo "Friend Added..!!";
			$sql1 = "delete from notifications where fromid=$fromid and toid=$toid";

			//$sql1 = "delete from requesttable where fromid=$fromid and toid=$toid";
		$result = mysqli_query($con,$sql1);
		}
	}
	else if($request==="decline")
	{
				$sql = "delete from notifications where fromid=$fromid and toid=$toid";

		//$sql = "delete from requesttable where fromid=$fromid and toid=$toid";
		$result = mysqli_query($con,$sql);
		if($result)
		{
			echo "Deleted Request..";
		}
	}
?>