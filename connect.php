<!--
	projectstatus
	0-project completed;
	1-project ongoing;
	
	notifications
	1-likes
	2-friend request
	3-join project
	4-get details of project
-->
<?php
	$username="root";
	$password="";
	$db_name="project.com";
	$con = mysqli_connect("localhost","$username","$password","$db_name");
	if(!$con)
	die("Error:". mysqli_connect_error());
else echo "connected..";
?>