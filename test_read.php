<?php
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

$reader = ReaderEntityFactory::createReaderFromFile('dsa_tsel.xlsx');
$reader->setShouldFormatDates(true);
$reader->open('dsa_tsel.xlsx');  
 
$row_data = 0;

foreach ($reader->getSheetIterator() as $sheet) {
	 
	foreach ($sheet->getRowIterator() as $row) {
        // do stuff with the row
        //$value = $row->toArray(); 
		$row_data = $row_data + 1;
		//	$Date = $value[5]->format('d/m/Y');
		//print($value[5]); 
    }  
}



$reader->close();
$endtime = microtime(true);
echo 'End : '.secondsToTime($endtime).'<br />';

$timediff = $endtime - $starttime;

echo 'Diff : '.secondsToTime($timediff).'<br />'; 
echo 'Qty : '.$row_data.'<br />'; 


?>