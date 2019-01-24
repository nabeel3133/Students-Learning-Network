<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
	$user = $_GET['user'];
	$sql;
		$sql = "select ID,Refer1,Refer2,Topic_ID from session where Instructor_ID='$user'";
		$result = $conn->query($sql);
		$sessions = array();
		$sessions["AllSessions"] = array();
		//$messages["messages"] = array();
		//$messages["senders"] = array();
	while ($row = mysqli_fetch_array($result)) 
	{
		if ($row['Refer1']==1 && $row['Refer2']==1)
		{
		$session =  array();
		$session['id'] = $row['ID'];
		$tid = $row['Topic_ID'];
		$sql2 = "select Name from topic where ID='$tid'";
		$result2 = $conn->query($sql2);
		$row2 = mysqli_fetch_array($result2);
		$session['topic'] = $row2['Name'];
		array_push($sessions["AllSessions"] ,$session);
	}
	}	
	// }
	
	echo json_encode($sessions);
	mysqli_close($conn);
?>