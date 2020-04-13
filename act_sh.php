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

require_once 'vendor/box/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

$reader = ReaderEntityFactory::createReaderFromFile('act_sh.xlsx');
$reader->setShouldFormatDates(true);
$reader->open('act_sh.xlsx');  
 
$row_data = 0;

$account_id = 'TELKOMSEL';
foreach ($reader->getSheetIterator() as $sheet) { 
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

	foreach ($sheet->getRowIterator() as $row) {
		if($row_data==0){
			$row_data = $row_data + 1;
			continue;
		}
		// do stuff with the row
		$act_code = array();
		$act_code = $row->toArray(); 
		if(empty($act_code)){
			break;
		}
		// print '<pre />';
		// print_r($act_code);
		// exit(); 
		
		$activity_id = $act_code[0]; 
		$activity_description = $act_code[1]; 
		$company_id = $act_code[3]; 
		$group_id = $act_code[4]; 
		
		$sql = "INSERT INTO activity_code VALUES ('".$activity_id."', '".$activity_description."', '".$company_id."', '".$group_id."')";
		mysqli_query($conn, $sql);
		
		$row_data = $row_data + 1;
	}  
	mysqli_close($conn);
}



$reader->close();
$endtime = microtime(true);
echo 'End : '.secondsToTime($endtime).'<br />';

$timediff = $endtime - $starttime;

echo 'Diff : '.secondsToTime($timediff).'<br />'; 
echo 'Qty : '.$row_data.'<br />'; 


?>