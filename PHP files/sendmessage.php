<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
	$session = $_GET['session'];
	$user = $_GET['user'];
	$text = $_GET['message'];
	$sql = "Insert into message (Message,Session_ID,Sender_ID) values('$text','$session','$user')";
	$inserted = mysqli_query($conn, $sql);
	$json = "Inserted";
	echo json_encode($json);
	mysqli_close($conn);
?>