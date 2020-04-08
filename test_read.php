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

$reader = ReaderEntityFactory::createReaderFromFile('dsa_tsel.xlsx');
$reader->setShouldFormatDates(true);
$reader->open('dsa_tsel.xlsx');  
 
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
		$data_mr = array();
		$data_mr = $row->toArray(); 
		if(empty($data_mr)){
			break;
		}
		// print '<pre />';
		// print_r($data_mr);
		// exit();
		$mr_id = $data_mr[0].'_'.$account_id;
		
		$mr_number = $data_mr[0];
		$account_id = $account_id;
		$company_id = $data_mr[2];
		
		$mr_mot = $data_mr[142]; 
		$mr_type = $data_mr[152];
		$mr_po = $data_mr[3];

		$ata = null;
		if($data_mr[5]!=''){
			$ata = date('Y-m-d', strtotime($data_mr[5]));
		}
		
		$mr_gr = null;
		if($data_mr[9]!=''){
			$mr_gr = date('Y-m-d', strtotime($data_mr[9]));
		} 
		$mr_gr_number = $data_mr[192];
		$mr_gr_po = $data_mr[191];
		$mr_prebook = $data_mr[14];
		$mr_actual = $data_mr[15];
		$mr_status = $data_mr[16];
		$ldm_name = $data_mr[17];

		// /* SECTION 1 */
		// $sc1_svc_1 = $data_mr[20];
		// $sc1_qty_1 = $data_mr[21];
		// $sc1_price_1 = $data_mr[22];
		// $sc1_total_1 = $data_mr[23];
		// $sc1_text_1 = $data_mr[24];

		// $sc1_svc_2 = $data_mr[25];
		// $sc1_qty_2 = $data_mr[26];
		// $sc1_price_2 = $data_mr[27];
		// $sc1_total_2 = $data_mr[28];
		// $sc1_text_2 = $data_mr[29];

		// $sc1_svc_3 = $data_mr[30];
		// $sc1_qty_3 = $data_mr[31];
		// $sc1_price_3 = $data_mr[32];
		// $sc1_total_3 = $data_mr[33];
		// $sc1_text_3 = $data_mr[34];

		// $sc1_svc_4 = $data_mr[35];
		// $sc1_qty_4 = $data_mr[36];
		// $sc1_price_4 = $data_mr[37];
		// $sc1_total_4 = $data_mr[38];
		// $sc1_text_4 = $data_mr[39];

		// $sc1_svc_5 = $data_mr[40];
		// $sc1_qty_5 = $data_mr[41];
		// $sc1_price_5 = $data_mr[42];
		// $sc1_total_5 = $data_mr[43];
		// $sc1_text_5 = $data_mr[44];
		
		// $sc1_flatc_svc_1 = $data_mr[45];
		// $sc1_flatc_qty_1 = $data_mr[46];
		// $sc1_flatc_price_1 = $data_mr[47];
		// $sc1_flatc_total_1 = $data_mr[48];
		// $sc1_flatc_text_1 = $data_mr[49];

		// $sc1_ret_svc_1 = $data_mr[130];
		// $sc1_ret_qty_1 = $data_mr[131];
		// $sc1_ret_price_1 = $data_mr[132];
		// $sc1_ret_total_1 = $data_mr[133];
		// $sc1_ret_text_1 = $data_mr[134];
		
		// $sc1_ret_svc_2 = $data_mr[135];
		// $sc1_ret_qty_2 = $data_mr[136];
		// $sc1_ret_price_2 = $data_mr[137];
		// $sc1_ret_total_2 = $data_mr[138];
		// $sc1_ret_text_2 = $data_mr[139];

		// /* SECTION 2 */
		// $sc2_add_svc_1 = $data_mr[50];
		// $sc2_add_qty_1 = $data_mr[51];
		// $sc2_add_price_1 = $data_mr[52];
		// $sc2_add_total_1 = $data_mr[53];
		// $sc2_add_text_1 = $data_mr[54];

		// $sc2_add_svc_2 = $data_mr[55];
		// $sc2_add_qty_2 = $data_mr[56];
		// $sc2_add_price_2 = $data_mr[57];
		// $sc2_add_total_2 = $data_mr[58];
		// $sc2_add_text_2 = $data_mr[59];

		// $sc2_add_svc_3 = $data_mr[60];
		// $sc2_add_qty_3 = $data_mr[61];
		// $sc2_add_price_3 = $data_mr[62];
		// $sc2_add_total_3 = $data_mr[63];
		// $sc2_add_text_3 = $data_mr[64];

		// $sc2_add_svc_4 = $data_mr[65];
		// $sc2_add_qty_4 = $data_mr[66];
		// $sc2_add_price_4 = $data_mr[67];
		// $sc2_add_total_4 = $data_mr[68];
		// $sc2_add_text_4 = $data_mr[69];

		// $sc2_add_svc_5 = $data_mr[70];
		// $sc2_add_qty_5 = $data_mr[71];
		// $sc2_add_price_5 = $data_mr[72];
		// $sc2_add_total_5 = $data_mr[73];
		// $sc2_add_text_5 = $data_mr[74];

		// $sc2_add_svc_6 = $data_mr[75];
		// $sc2_add_qty_6 = $data_mr[76];
		// $sc2_add_price_6 = $data_mr[77];
		// $sc2_add_total_6 = $data_mr[78];
		// $sc2_add_text_6 = $data_mr[79];

		// $sc2_add_svc_7 = $data_mr[80];
		// $sc2_add_qty_7 = $data_mr[81];
		// $sc2_add_price_7 = $data_mr[82];
		// $sc2_add_total_7 = $data_mr[83];
		// $sc2_add_text_7 = $data_mr[84];

		// $sc2_add_svc_8 = $data_mr[85];
		// $sc2_add_qty_8 = $data_mr[86];
		// $sc2_add_price_8 = $data_mr[87];
		// $sc2_add_total_8 = $data_mr[88];
		// $sc2_add_text_8 = $data_mr[89];

		// $sc2_add_svc_9 = $data_mr[90];
		// $sc2_add_qty_9 = $data_mr[91];
		// $sc2_add_price_9 = $data_mr[92];
		// $sc2_add_total_9 = $data_mr[93];
		// $sc2_add_text_9 = $data_mr[94];

		// $sc2_add_svc_10 = $data_mr[95];
		// $sc2_add_qty_10 = $data_mr[96];
		// $sc2_add_price_10 = $data_mr[97];
		// $sc2_add_total_10 = $data_mr[98];
		// $sc2_add_text_10 = $data_mr[99];

		// $sc2_add_svc_11 = $data_mr[100];
		// $sc2_add_qty_11 = $data_mr[101];
		// $sc2_add_price_11 = $data_mr[102];
		// $sc2_add_total_11 = $data_mr[103];
		// $sc2_add_text_11 = $data_mr[104];

		// $sc2_add_svc_12 = $data_mr[105];
		// $sc2_add_qty_12 = $data_mr[106];
		// $sc2_add_price_12 = $data_mr[107];
		// $sc2_add_total_12 = $data_mr[108];
		// $sc2_add_text_12 = $data_mr[109];

		// $sc2_add_svc_13 = $data_mr[110];
		// $sc2_add_qty_13 = $data_mr[111];
		// $sc2_add_price_13 = $data_mr[112];
		// $sc2_add_total_13 = $data_mr[113];
		// $sc2_add_text_13 = $data_mr[114];

		// /* SECTION 3*/
		// $sc3_type_cost_1 = $data_mr[115];
		// $sc3_price_1 = $data_mr[116];
		// $sc3_description_1 = $data_mr[117];
		
		// $sc3_type_cost_2  = $data_mr[118];
		// $sc3_price_2 = $data_mr[119];
		// $sc3_description_2 = $data_mr[120];
		
		// $sc3_type_cost_3  = $data_mr[121];
		// $sc3_price_3 = $data_mr[122];
		// $sc3_description_3 = $data_mr[123];
		
		// $sc3_type_cost_4  = $data_mr[124];
		// $sc3_price_4 = $data_mr[125];
		// $sc3_description_4 = $data_mr[126];
		
		// $sc3_type_cost_5  = $data_mr[127];
		// $sc3_price_5 = $data_mr[128];
		// $sc3_description_5  = $data_mr[129];

		// $mdd = date('Y-m-d');

		$sql = "INSERT INTO dsa(mr_id, mr_number, account_id, 
								company_id, mr_mot, mr_type, 
								mr_po, ata, mr_gr, mr_gr_number, 
								mr_gr_po, mr_prebook, mr_actual, 
								sc1_svc_1, sc1_qty_1, sc1_price_1, sc1_total_1, sc1_text_1, 
								sc1_svc_2, sc1_qty_2, sc1_price_2, sc1_total_2, sc1_text_2, 
								sc1_svc_3, sc1_qty_3, sc1_price_3, sc1_total_3, sc1_text_3, 
								sc1_svc_4, sc1_qty_4, sc1_price_4, sc1_total_4, sc1_text_4, 
								sc1_svc_5, sc1_qty_5, sc1_price_5, sc1_total_5, sc1_text_5, 
								sc1_flatc_svc_1, sc1_flatc_qty_1, sc1_flatc_price_1, sc1_flatc_total_1, sc1_flatc_text_1, 
								sc1_ret_svc_1, sc1_ret_qty_1, sc1_ret_price_1, sc1_ret_total_1, sc1_ret_text_1, 
								sc1_ret_svc_2, sc1_ret_qty_2, sc1_ret_price_2, sc1_ret_total_2, sc1_ret_text_2, 
								sc2_add_svc_1, sc2_add_qty_1, sc2_add_price_1, sc2_add_total_1, sc2_add_text_1, 
								sc2_add_svc_2, sc2_add_qty_2, sc2_add_price_2, sc2_add_total_2, sc2_add_text_2, 
								sc2_add_svc_3, sc2_add_qty_3, sc2_add_price_3, sc2_add_total_3, sc2_add_text_3, 
								sc2_add_svc_4, sc2_add_qty_4, sc2_add_price_4, sc2_add_total_4, sc2_add_text_4, 
								sc2_add_svc_5, sc2_add_qty_5, sc2_add_price_5, sc2_add_total_5, sc2_add_text_5, 
								sc2_add_svc_6, sc2_add_qty_6, sc2_add_price_6, sc2_add_total_6, sc2_add_text_6, 
								sc2_add_svc_7, sc2_add_qty_7, sc2_add_price_7, sc2_add_total_7, sc2_add_text_7, 
								sc2_add_svc_8, sc2_add_qty_8, sc2_add_price_8, sc2_add_total_8, sc2_add_text_8, 
								sc2_add_svc_9, sc2_add_qty_9, sc2_add_price_9, sc2_add_total_9, sc2_add_text_9, 
								sc2_add_svc_10, sc2_add_qty_10, sc2_add_price_10, sc2_add_total_10, sc2_add_text_10, 
								sc2_add_svc_11, sc2_add_qty_11, sc2_add_price_11, sc2_add_total_11, sc2_add_text_11, 
								sc2_add_svc_12, sc2_add_qty_12, sc2_add_price_12, sc2_add_total_12, sc2_add_text_12, 
								sc2_add_svc_13, sc2_add_qty_13, sc2_add_price_13, sc2_add_total_13, sc2_add_text_13, 
								sc3_type_cost_1, sc3_price_1, sc3_description_1, 
								sc3_type_cost_2, sc3_price_2, sc3_description_2, 
								sc3_type_cost_3, sc3_price_3, sc3_description_3, 
								sc3_type_cost_4, sc3_price_4, sc3_description_4, 
								sc3_type_cost_5, sc3_price_5, sc3_description_5,
								mr_status, ldm_name, mdd) 
				VALUES ('".$mr_id."', '".$mr_number."', '".$account_id."', 
						'".$company_id."', '".$mr_mot."', '".$mr_type."', 
						'".$mr_po."', '".$ata."', '".$mr_gr."', '".$mr_gr_number."', 
						'".$mr_gr_po."', '".$mr_prebook."', '".$mr_actual."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$svc."', ".$qty.", ".$price.", , ".$total.", '".$text."', 
						'".$type_cost."', ".$price.", '".$text."', 
						'".$mr_status."', '".$ldm_name."', NOW())";
		// print $sql.'<br />';
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