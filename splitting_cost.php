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
	
	//$account_id = 'INDOSAT';
	//$account_id = 'TELKOMSEL';
	$account_id = 'XL';
	$sql = "DELETE FROM dsa_cost WHERE account_id='".$account_id."'";
	mysqli_query($conn, $sql);
	
	$sql = "SELECT * FROM dsa WHERE account_id ='".$account_id."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row['sc1_total_1']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_svc_1']."', '".$row['sc1_qty_1']."', '".$row['sc1_price_1']."',
											  '".$row['sc1_total_1']."','".$row['sc1_text_1']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc1_total_2']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_svc_2']."', '".$row['sc1_qty_2']."', '".$row['sc1_price_2']."',
											  '".$row['sc1_total_2']."','".$row['sc1_text_2']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc1_total_3']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_svc_3']."', '".$row['sc1_qty_3']."', '".$row['sc1_price_3']."',
											  '".$row['sc1_total_3']."','".$row['sc1_text_3']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc1_total_4']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_svc_4']."', '".$row['sc1_qty_4']."', '".$row['sc1_price_4']."',
											  '".$row['sc1_total_4']."','".$row['sc1_text_4']."'
											  )";
				mysqli_query($conn, $sql);
			}
			

			if($row['sc1_total_5']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_svc_5']."', '".$row['sc1_qty_5']."', '".$row['sc1_price_5']."',
											  '".$row['sc1_total_5']."','".$row['sc1_text_5']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc1_flatc_total_1']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_flatc_svc_1']."', '".$row['sc1_flatc_qty_1']."', '".$row['sc1_flatc_price_1']."',
											  '".$row['sc1_flatc_total_1']."','".$row['sc1_flatc_text_1']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc1_ret_total_1']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_ret_svc_1']."', '".$row['sc1_ret_qty_1']."', '".$row['sc1_ret_price_1']."',
											  '".$row['sc1_ret_total_1']."','".$row['sc1_ret_text_1']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc1_ret_total_2']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '1',
											  '".$row['sc1_ret_svc_2']."', '".$row['sc1_ret_qty_2']."', '".$row['sc1_ret_price_2']."',
											  '".$row['sc1_ret_total_2']."','".$row['sc1_ret_text_2']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc2_add_total_1']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_1']."', '".$row['sc2_add_qty_1']."', '".$row['sc2_add_price_1']."',
											  '".$row['sc2_add_total_1']."','".$row['sc2_add_text_1']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc2_add_total_2']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_2']."', '".$row['sc2_add_qty_2']."', '".$row['sc2_add_price_2']."',
											  '".$row['sc2_add_total_2']."','".$row['sc2_add_text_2']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc2_add_total_3']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_3']."', '".$row['sc2_add_qty_3']."', '".$row['sc2_add_price_3']."',
											  '".$row['sc2_add_total_3']."','".$row['sc2_add_text_3']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc2_add_total_4']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_4']."', '".$row['sc2_add_qty_4']."', '".$row['sc2_add_price_4']."',
											  '".$row['sc2_add_total_4']."','".$row['sc2_add_text_4']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc2_add_total_5']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_5']."', '".$row['sc2_add_qty_5']."', '".$row['sc2_add_price_5']."',
											  '".$row['sc2_add_total_5']."','".$row['sc2_add_text_5']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc2_add_total_6']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_6']."', '".$row['sc2_add_qty_6']."', '".$row['sc2_add_price_6']."',
											  '".$row['sc2_add_total_6']."','".$row['sc2_add_text_6']."'
											  )";
				mysqli_query($conn, $sql);
			} 
			
			if($row['sc2_add_total_7']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_7']."', '".$row['sc2_add_qty_7']."', '".$row['sc2_add_price_7']."',
											  '".$row['sc2_add_total_7']."','".$row['sc2_add_text_7']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc2_add_total_8']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_8']."', '".$row['sc2_add_qty_8']."', '".$row['sc2_add_price_8']."',
											  '".$row['sc2_add_total_8']."','".$row['sc2_add_text_8']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc2_add_total_9']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_9']."', '".$row['sc2_add_qty_9']."', '".$row['sc2_add_price_9']."',
											  '".$row['sc2_add_total_9']."','".$row['sc2_add_text_9']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc2_add_total_10']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_10']."', '".$row['sc2_add_qty_10']."', '".$row['sc2_add_price_10']."',
											  '".$row['sc2_add_total_10']."','".$row['sc2_add_text_10']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc2_add_total_11']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_11']."', '".$row['sc2_add_qty_11']."', '".$row['sc2_add_price_11']."',
											  '".$row['sc2_add_total_11']."','".$row['sc2_add_text_11']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc2_add_total_12']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_12']."', '".$row['sc2_add_qty_12']."', '".$row['sc2_add_price_12']."',
											  '".$row['sc2_add_total_12']."','".$row['sc2_add_text_12']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc2_add_total_13']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '2',
											  '".$row['sc2_add_svc_13']."', '".$row['sc2_add_qty_13']."', '".$row['sc2_add_price_13']."',
											  '".$row['sc2_add_total_13']."','".$row['sc2_add_text_13']."'
											  )";
				mysqli_query($conn, $sql);
			}
 
			if($row['sc3_price_1']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '3',
											  '".$row['sc3_type_cost_1']."', '1', '".$row['sc3_price_1']."',
											  '".$row['sc3_price_1']."','".$row['sc3_description_1']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc3_price_2']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '3',
											  '".$row['sc3_type_cost_2']."', '1', '".$row['sc3_price_2']."',
											  '".$row['sc3_price_2']."','".$row['sc3_description_2']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc3_price_3']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '3',
											  '".$row['sc3_type_cost_3']."', '1', '".$row['sc3_price_3']."',
											  '".$row['sc3_price_3']."','".$row['sc3_description_3']."'
											  )";
				mysqli_query($conn, $sql);
			}

			if($row['sc3_price_4']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '3',
											  '".$row['sc3_type_cost_4']."', '1', '".$row['sc3_price_4']."',
											  '".$row['sc3_price_4']."','".$row['sc3_description_4']."'
											  )";
				mysqli_query($conn, $sql);
			}
			
			if($row['sc3_price_5']>0){ 
				$sql = "INSERT INTO dsa_cost (mr_id, account_id, svc_section, 
											  svc_id, svc_qty, svc_price, 
											  svc_total, svc_text) VALUES (
											  '".$row['mr_id']."', '".$account_id."', '3',
											  '".$row['sc3_type_cost_5']."', '1', '".$row['sc3_price_5']."',
											  '".$row['sc3_price_5']."','".$row['sc3_description_5']."'
											  )";
				mysqli_query($conn, $sql);
			}
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