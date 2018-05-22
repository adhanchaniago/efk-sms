<?php
error_reporting(0);
function tanggal($date){
	    
	    $str = explode('-',$date);
	    
	    $bulan = array('01' => 'Januari',
	                    '02' => 'Februari',
	                    '03' => 'Maret',
	                    '04' => 'April',
	                    '05' => 'Mei',
	                    '06' => 'Juni',
	                    '07' => 'Juli',
	                    '08' => 'Agustus',
	                    '09' => 'September',
	                    '10' => 'Oktober',
	                    '11' => 'November',
	                    '12' => 'Desember');
	                    
	   return $str['2'] . " " . $bulan[$str[1]]. " " .$str[0];
}
	   function tanggal_lengkap($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
	$jam = substr($date,11, 8);
		
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1];		
	return($result);
}