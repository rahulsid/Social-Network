<?php 
	include 'connect.php';
	session_start();
	$uid = $_SESSION['uid'];
?>
<html>
<head><title>Home</title>

</head>
<body>
<h2>Welcome <?php 
				$sql8 = "select name from usertable where uid = $uid";
				$result8 = mysqli_query($con,$sql8);
				if($result8)
				{
					while($row8 = mysqli_fetch_assoc($result8))
					{
						echo $row8["name"];
					}
				}
			?> </h2>
<!--form goes to search result page (friends page)-->

<form action="searchpage.php" method="post">
Search<input type="text" name="requestid"/>
<input type="submit" value="send request"/>
</form>
Friends:<?php 
			$sql2 = "select fid from friends where uid = $uid";
			$result2 = mysqli_query($con,$sql2);
			if(mysqli_num_rows($result2) > 0)
			{
				while($row2 = mysqli_fetch_assoc($result2))
				{
					$friend = $row2["fid"];
					$sql3 = "select name from usertable where uid=$friend";
					$result3 = mysqli_query($con,$sql3);
					if(mysqli_num_rows($result3) > 0)
					{
						while($row3 = mysqli_fetch_assoc($result3))
						{
							echo "</br>";
							echo $row3["name"];
						}
					}
				}
			} echo "</br>";
		?>
		
		
Requests:<?php 
			$sql = "select fromid from notifications where toid=$uid and reason=2";
			//$sql = "select fromid from requesttable where toid=$uid";
			$result = mysqli_query($con,$sql);
			if(mysqli_num_rows($result)>0)
			{
				while($row = mysqli_fetch_assoc($result))
				{
					echo "</br>";
					$fromid = $row["fromid"];
					$sql1 = "select name from usertable where uid=$fromid";
					$result1 = mysqli_query($con,$sql1);
					while($row1 = mysqli_fetch_assoc($result1))
					{
						echo $row1["name"];
						/*echo "<div><button value='accept' onclick='accept()'/>accept";
						echo "<button value='decline' onclick='decline()'/>decline</div>";
						echo "</br>";*/
						echo "<form action='processrequest.php' method='post'/>";
						echo "<input type='hidden' name='fromid' value='$fromid'/>";
						echo "<input type='submit' name='request' value='accept'/>";
						echo "<input type='submit' name='request' value='decline'/>";
						echo "</form>";
					}
				}
			}
			echo "</br>";
		?>
		
		
Notifications:<?php 
					$sql9 = "select * from notifications where toid=$uid";
					$result9 = mysqli_query($con,$sql9);
					if(mysqli_num_rows($result9)>0)
					{
						while($row9 = mysqli_fetch_assoc($result9))
						{
							echo "</br>";
							$reason = $row9["reason"];
							$fromid = $row9["fromid"];
							$projectname = $row9["projecttitle"];
							$sql10 = "select name,mail from usertable where uid=$fromid";
							$result10 = mysqli_query($con,$sql10);
							while($row10 = mysqli_fetch_assoc($result10))
							{
							$fromname = $row10["name"];
							$email = $row10["mail"];
							if($reason==='1')
							{
								echo "$fromname liked Your Project $projectname";
						
							}else if($reason==='3')
							{
								echo "$fromname wants to join your project $projectname";
								echo "</br>";
								echo "Email:$email";
								echo "<form action='updatenotification.php' method='post'>";
								echo "<input type='hidden' value='$projectname' name='projecttitle'/>";
								echo "<input type='hidden' value='$fromid' name='fromid'/>";
								echo "<input type='hidden' value='$reason' name='reason'/>";
								echo "<input type='submit' value='ok' name='ok'/>";
								echo "</form>";
							}else if($reason==='4')
							{
								echo "$fromname requested details of $projectname";
								echo "</br>";
								echo "Email:$email";
								echo "<form action='updatenotification.php' method='post'>";
								echo "<input type='hidden' value='$projectname' name='projecttitle'/>";
								echo "<input type='hidden' value='$fromid' name='fromid'/>";
								echo "<input type='hidden' value='$reason' name='reason'/>";
								echo "<input type='submit' value='ok' name='ok'/>";
								echo "</form>";
							}
							}
						}
					}
				?>		
		
		
		
		
		
		
		
</br><div><a href="myprojects.php">Myprojects</a></div>
</br></br></br>

NewsFeed:
		</br>
			<?php 
				$sql4 = "select fid from friends where uid=$uid";
				$result4 = mysqli_query($con,$sql4);
				if(mysqli_num_rows($result4) > 0)
				{
					while($row4 = mysqli_fetch_assoc($result4))
					{
						$matchid = $row4["fid"];
						$sql5 = "select * from projectslog";
						$result5 = mysqli_query($con,$sql5);
						if(mysqli_num_rows($result5)>0)
						{
							while($row5 = mysqli_fetch_assoc($result5))
							{
								$logmatch = $row5["uid"];
								if($matchid===$logmatch)
								{
									$sql7 = "select name from usertable where uid=$logmatch";
									$result7  = mysqli_query($con,$sql7);
									$row7  = mysqli_fetch_assoc($result7);
									$name = $row7["name"];
									$protitle = $row5["projecttitle"];
									$sql6="select * from myprojects where projecttitle='$protitle'";
									$result6=mysqli_query($con,$sql6);
									// output data of each row
									while($row6 = mysqli_fetch_assoc($result6)) 
									{
									$projecttitle = $row6["projecttitle"];
									$projectdescription= $row6["projectdescription"]; 
									$projectstatus = $row6["projectstatus"];
									$projectlikes = $row6["projectlikes"];
									echo "</br>";
									echo $projecttitle;
									echo "&nbsp&nbsp&nbsp&nbsp&nbsp-";
									echo $name;
									echo "</br>";
									echo $projectdescription;
									echo "</br>";
									echo "Status:";
									if( $projectstatus === '0')
									{
										echo "Completed";
										echo "&nbsp";
										echo "<form action='likesupdate.php' method='post'>";
										echo "<input type='hidden' value='$projecttitle' name='projecttitle'/>";
										echo "<input type='hidden' value='$projectstatus' name='projectstatus'/>";
										echo "<input type='hidden' value='$logmatch' name='ownerid'/>";
										echo "<input type='submit' name='details' value='thumbsup'></input>";
										echo $projectlikes;
										echo "<input type='submit' name='details' value='requestdetails'/>";
										echo "</form>";
										
										echo "</br>";
									}
									else if($projectstatus === '1'){
										echo "Ongoing";
										echo "&nbsp";
										echo "<form action='likesupdate.php' method='post'>";
										echo "<input type='hidden' value='$projecttitle' name='projecttitle'/>";
										echo "<input type='hidden' value='$projectstatus' name='projectstatus'/>";
										echo "<input type='hidden' value='$logmatch' name='ownerid'>";
										echo "<input type='submit' name='join' value='join Project'></input>";
										echo "</form>";
										}
								}
								}
							}
						}
					}
				}
			?>
</body>
</html>