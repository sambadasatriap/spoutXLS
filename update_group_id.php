<?php
	date_default_timezone_set("Asia/Jakarta");


	$starttime = microtime(true);

	function secondsToTime($s)
	{
		$h = floor($s / 3600);
		$s -= $h * 3600;
		$m = floor($s / 60);
		$s -= $m * 60;
		return $h.':'.sprintf('%02d', $m).':'.sprintf('%02d', $s);
	}

	echo 'Start : '.secondsToTime($starttime).'<br />';

	// Connect to DB
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "eid";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db_name);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$row_data = 0;
	 
	
	$sql = "SELECT DISTINCT activity_id, group_id FROM activity_code ORDER BY activity_id ASC";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$sql = "UPDATE dsa_cost
					SET group_id = '".$row['group_id']."'
					WHERE svc_id LIKE '%".$row['activity_id']."%'";
			mysqli_query($conn, $sql); 
			 
			$row_data = $row_data + 1;
		}		
	}

	mysqli_close($conn);
	
	$endtime = microtime(true);
	echo 'End : '.secondsToTime($endtime).'<br />';

	$timediff = $endtime - $starttime;

	echo 'Diff : '.secondsToTime($timediff).'<br />'; 
	echo 'Qty : '.$row_data.'<br />'; 
?>