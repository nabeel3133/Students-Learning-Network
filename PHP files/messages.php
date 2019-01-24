<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
	$session = $_GET['session'];
	$sql = "Select Message,Sender_ID from message where Session_ID='$session'";
	$result = $conn->query($sql);
	$messages = array();
	$messages["AllMessages"] = array();
	//$messages["messages"] = array();
	//$messages["senders"] = array();
	while ($row = mysqli_fetch_array($result)) {
		$message =  array();
		$message['Message'] = $row['Message'];
		$message['Sender'] = $row['Sender_ID'];
		array_push($messages["AllMessages"] ,$message);
	}
	echo json_encode($messages);
	mysqli_close($conn);
?>