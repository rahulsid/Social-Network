<?php 
	$fromid = $_POST["fromid"];
	$request = $_POST["submit"];
	if($request==="accept")
	{
		echo "accepted";
	}
	else if($request==="decline")
	{
		echo "declined";
	}
?>