<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
	$user = $_GET['user'];
	$sql = "Select Quiz_ID,Marks,Student_ID from review where Quiz_ID IN (Select ID from quiz where Topic_ID IN (select ID from topic where Course_ID IN (select Subject_ID from instructor_subjects where Instructor_ID='$user')))";
	$result = $conn->query($sql);
	$news = array();
	$news["News"] = array();
		//$messages["messages"] = array();
		//$messages["senders"] = array();
	while ($row = mysqli_fetch_array($result)) 
	{
		$one =  array();
		$one['Marks'] = $row['Marks'];
		$temp = $row['Quiz_ID'];
		$sql2 = "select Name from topic where ID=(select Topic_ID from quiz where ID='$temp')";
		$result2 = $conn->query($sql2);
		$temp2 =mysqli_fetch_array($result2);
		$one['Quiz'] = $temp2['Name'];
		$one['Student'] = $row['Student_ID'];
		array_push($news["News"] ,$one);
	}
	echo json_encode($news);
	mysqli_close($conn);
?>