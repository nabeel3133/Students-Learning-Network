<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
	$session = $_GET['session'];
	$user = $_GET['user'];
	$sql = "select Stud2_ID,Stud1_ID from session where ID='$session'";
	$result = $conn->query($sql);
	$row = mysqli_fetch_array($result);
	$sql2="UPDATE session SET Refer2=1 where ID='$session'";
	$sql3="UPDATE session SET Refer1=1 where ID='$session'";
	if ($row['Stud2_ID']==$user)
	{
		$conn->query($sql2);
	}
	else if ($row['Stud1_ID']==$user)
	{
		$conn->query($sql3);
	}
	mysqli_close($conn);
?>