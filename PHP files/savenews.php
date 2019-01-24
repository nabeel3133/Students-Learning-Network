<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$title = $_GET['title'];
	$news = $_GET['news'];
	$inst_id = $_GET['username'];
	$sql = "Insert into newsdata (Title,News,Instructor_ID) values('$title','$news','$inst_id')";
	$conn->query($sql);
	mysqli_close($conn);
?>