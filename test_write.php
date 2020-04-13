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
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

$writer = WriterEntityFactory::createXLSXWriter(); 
$writer->openToFile("data_cost.xlsx");

$cells = [
    WriterEntityFactory::createCell('MR'),
    WriterEntityFactory::createCell('Account'),
    WriterEntityFactory::createCell('Section'),
	WriterEntityFactory::createCell('Service Code'),
	WriterEntityFactory::createCell('Qty'),
	WriterEntityFactory::createCell('Price'),
	WriterEntityFactory::createCell('Description'),
	WriterEntityFactory::createCell('Group ID')
];
/** add a row at a time */
$singleRow = WriterEntityFactory::createRow($cells);
$writer->addRow($singleRow);

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

$sql = "SELECT a.*, mr_gr
		FROM dsa_cost a JOIN dsa b ON a.mr_id=b.mr_id
		WHERE (YEAR(mr_gr) LIKE '2019' OR YEAR(mr_gr) LIKE '2020') 
		AND MONTH(mr_gr)<=3
		ORDER BY mr_gr, a.mr_id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$cells = [
			WriterEntityFactory::createCell($row['mr_id']),
			WriterEntityFactory::createCell($row['account_id']),
			WriterEntityFactory::createCell($row['svc_section']),
			WriterEntityFactory::createCell($row['svc_id']),
			WriterEntityFactory::createCell($row['svc_qty']),
			WriterEntityFactory::createCell($row['svc_price']),
			WriterEntityFactory::createCell($row['svc_total']),
			WriterEntityFactory::createCell($row['svc_text']),
			WriterEntityFactory::createCell($row['group_id'])
		];
		$singleRow = WriterEntityFactory::createRow($cells);
		$writer->addRow($singleRow);
	}		
}


mysqli_close($conn);

/*
$rows = [
	['SP-903923', '2017-11-12', '35'],
	['SP-6546', '2017-10-29', '7567'],
	['SP-546546', '2017-08-29', '3453'],
	['SP-675677', '2017-02-29', '4654'],
	['SP-324344', '2017-12-29', '9789']
];

$writer->addRows($rows); // add multiple rows at a time
*/
$writer->close();
		
$endtime = microtime(true);
echo 'End : '.secondsToTime($endtime).'<br />';

$timediff = $endtime - $starttime;

echo 'Diff : '.secondsToTime($timediff).'<br />'; 
//echo 'Qty : '.$row_data.'<br />'; 


?>