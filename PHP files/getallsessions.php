<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$user = $_GET['user'];
	$check ="select Type from user where Username='$user'";
	$check2 = $conn->query($check);
	$rowx = mysqli_fetch_array($check2);
	if ($rowx['Type']=='Student')
	{
	$sql = "select ID, Topic_ID from session where Stud2_ID='$user' or Stud1_ID='$user'";
	$result = $conn->query($sql);
	$sessions = array();
	$sessions["AllSessions"] = array();
	while ($row = mysqli_fetch_array($result)) 
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
		echo json_encode($sessions);
	}
	else// if (rowx['Type']=='Instructor')
	{
		$sqlb = "select ID,Refer1,Refer2,Topic_ID from session where Instructor_ID='$user'";
		$resultb = $conn->query($sqlb);
		$sessionsb = array();
		$sessionsb["AllSessions"] = array();
		//$messages["messages"] = array();
		//$messages["senders"] = array();
	while ($rowb = mysqli_fetch_array($resultb)) 
	{
		if ($rowb['Refer1']==1 && $rowb['Refer2']==1)
		{
		$sessionb =  array();
		$sessionb['id'] = $rowb['ID'];
		$tid = $rowb['Topic_ID'];
		$sqlc = "select Name from topic where ID='$tid'";
		$resultc = $conn->query($sqlc);
		$rowc = mysqli_fetch_array($resultc);
		$sessionb['topic'] = $rowc['Name'];
		array_push($sessionsb["AllSessions"] ,$sessionb);
		}
	}
	echo json_encode($sessionsb);
	}
	
	mysqli_close($conn);
?>