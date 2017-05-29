<?php
	include 'connect.php';	
	$username=$userpassword=$uid=$userpassword1="";
		echo "validating..";
		$username=mysqli_real_escape_string($con,$_REQUEST["username"]);
		$userpassword=mysqli_real_escape_string($con,$_REQUEST["userpassword"]);
		$sql = "select uid,userpassword from usertable where name='$username'";
       $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$uid=$row["uid"];
        $userpassword1=$row["userpassword"];
    }
 }else {}
	if($userpassword1===$userpassword)
		{
			//redirect to home.php
			session_start();
			$_SESSION['uid'] = $uid;
			//echo $_SESSION['uid'];
			header('location:home.php');
		}else {
			$passworderr='wrong password..!!';
			header('location:login.html');
		}
?>