<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
	$session = $_GET['session'];
	$sql = "select Name from topic where ID = (select Topic_ID from session where ID='$session')";
	$result = $conn->query($sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
	mysqli_close($conn);
?>