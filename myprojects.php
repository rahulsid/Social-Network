<?php 
	include 'connect.php';
	session_start();
	echo $_SESSION['uid'];
	$uid = $_SESSION['uid'];
	$projecttitle=$projectdescription="";
	$projectstatus=$projectlikes=0;
	$sql="select * from myprojects where uid='$uid'";
	$result=mysqli_query($con,$sql);
    // output data of each row
		while($row = mysqli_fetch_assoc($result)) {
		$projecttitle = $row["projecttitle"];
		$projectdescription= $row["projectdescription"]; 
		$projectstatus = $row["projectstatus"];
		$projectlikes = $row["projectlikes"];
		echo $projecttitle;
		echo "</br>";
		echo $projectdescription;
		echo "</br>";
		echo "Status:";
		if( $projectstatus==='0')
		{
			echo "Completed";
		}
		else {
			echo "Ongoing";
			}
		echo "&nbsp";
		echo "Thumbsup:";
		echo $projectlikes;
		echo "</br>";
    }
 ?>
 <html>
 <body>
 <a href="addproject.html">Add Project</a>
 </body>
 <html>
