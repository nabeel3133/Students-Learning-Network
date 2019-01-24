<?php
	$row;
	$conn=mysqli_connect("localhost","root","","students_network");
//	$user = $_GET['user'];
	$sql = "select * from newsdata";
	$result = $conn->query($sql);
	$news = array();
	$news["News"] = array();
		//$messages["messages"] = array();
		//$messages["senders"] = array();
	while ($row = mysqli_fetch_array($result)) 
	{
		$one =  array();
		$one['title'] = $row['Title'];
		$one['inst'] = $row['Instructor_ID'];
		$one['news'] = $row['News'];
		array_push($news["News"] ,$one);
	}
	echo json_encode($news);
	mysqli_close($conn);
?>