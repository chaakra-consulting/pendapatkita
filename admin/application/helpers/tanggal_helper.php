<?php defined('BASEPATH') OR exit('No direct script access allowed.');
if ( ! function_exists('Tanggal'))
{
	function Tanggal($teks) { 
		$teks = explode("-",$teks);
		
		return $teks;
	}
}

if ( ! function_exists('JStoDB'))
{
	function JStoDB($teks) { 
		$teks = explode("/",$teks); //03/25/2022
		$teks = $teks[2].'-'.$teks[0].'-'.$teks[1];
		
		return $teks;
	}
}
if ( ! function_exists('DBtoJS'))
{
	function DBtoJS($teks) { 
		$teks = explode("-",$teks); //2022-05-22
		$teks = $teks[1].'/'.$teks[2].'/'.$teks[0];
		
		return $teks;
	}
}


if ( ! function_exists('TglInvoice'))
{
	function TglInvoice($teks) { 
		$teks = explode(" ",$teks);
		$tgl=TglDbJs($teks[0]); 		
		
		return $tgl;
	}
}

if ( ! function_exists('TglIndo'))
{
	function TglIndo($teks) { 
		$teks = explode(" ",$teks);
		$tgl=TglDbIndo($teks[0]); 		
		
		return $tgl;
	}
}

if ( ! function_exists('firstsurveillance'))
{
	function firstsurveillance($teks) { 
		 
		$tgl=date('Y-m-d', strtotime('+1 year', strtotime( $teks ))); 
	
		return $tgl;
	}
}


if ( ! function_exists('secondsurveillance'))
{
	function secondsurveillance($teks) { 
		
		$tgl=date('Y-m-d', strtotime('+2 year', strtotime( $teks ))); 
	
		return $tgl;
	}
}

if ( ! function_exists('TglViewUser'))
{
	function TglViewUser($teks) { 
		$teks = explode(" ",$teks);
		$tgl=TglDbJs($teks[0]);
		$jam=$teks[1];
		$jam=explode(":",$jam);
		$jam=$jam[0].":".$jam[1];
		
		
		return $tgl." ".$jam;
	}
}

if ( ! function_exists('TanggalJam'))
{
	function TanggalJam($teks) { 
		$teks = explode(" ",$teks);
		
		return $teks;
	}
}

if ( ! function_exists('PisahTgl'))
{
	function PisahTgl($teks){
		$teks = explode("-",$teks);	
		return $teks;
	}		
}

	function BuangSpasi($teks){
		$teks= trim($teks);	
		while( strpos($teks, ' ') ){
			$hasil= str_replace(' ','', $teks);
		}
		return $teks;
	}

if ( ! function_exists('TglJsDbSUI'))
{
	function TglJsDbSUI($teks){
		//$teks=BuangSpasi($teks);
		$teks = explode("/",$teks);	
		$teks=$teks[2]."-".$teks[0]."-".$teks[1];
		return $teks;		
	}		
}

if ( ! function_exists('TglJsDb'))
{
	function TglJsDb($teks){
		$teks=BuangSpasi($teks);
		$teks = explode("/",$teks);	
		$teks=$teks[2]."-".$teks[1]."-".$teks[0];
		return $teks;		
	}		
}

if ( ! function_exists('TglDbIndo'))
{
	function TglDbIndo($teks){
		$teks=BuangSpasi($teks);
		$teks = explode("-",$teks);	
		$teks=$teks[2]." ".BulanInd($teks[1])." ".$teks[0];
		return $teks;
	}		
}


if ( ! function_exists('TglDbJs'))
{
	function TglDbJs($teks){
		$teks=BuangSpasi($teks);
		$teks = explode("-",$teks);	
		$teks=$teks[2]."/".$teks[1]."/".$teks[0];
		return $teks;
	}		
}


if ( ! function_exists('TglDp'))
{
	function TglDP($teks){
		$teks=BuangSpasi($teks);
		$teks = explode("-",$teks);	
		$teks=$teks[2]."-".$teks[1]."-".$teks[0];
		return $teks;		
	}		
}

function SufDate($text){
	if($text=="1"||$text=="21"||$text=="31"){
		return $text."<sup>st</sup>";
	}elseif($text=="2"||$text=="22"){
		return $text."<sup>nd</sup>";
	}elseif($text=="3"||$text=="23"){
		return $text."<sup>rd</sup>";
	}else{
		return $text."<sup>th</sup>";
	}
}


if ( ! function_exists('TglDpMonth'))
{
	function TglDpMonth($teks){
		$teks=BuangSpasi($teks);
		$teks = explode("-",$teks);	
		$teks=SufDate($teks[2])."&nbsp;".BulanEng($teks[1])."&nbsp;".$teks[0];
		return $teks;		
	}		
}

if ( ! function_exists('TglDpMonthNoSuf'))
{
	function TglDpMonthNoSuf($teks){
		$teks=BuangSpasi($teks);
		$teks = explode("-",$teks);	
		$teks=$teks[2]."&nbsp;".MonEng($teks[1])."&nbsp;".$teks[0];
		return $teks;		
	}		
}

if ( ! function_exists('BulanInd'))
{
	function BulanInd($teks){
		$teks=intval($teks);
		$bulan=array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $bulan[$teks];
	}		
}

if ( ! function_exists('BulanEng'))
{
	function BulanEng($teks){
		$teks=intval($teks);
		$bulan=array("","January","February","March","April","May","June","July","August","September","October","November","December");
		return $bulan[$teks];
	}		
}
if ( ! function_exists('MonEng'))
{
	function MonEng($teks){
		$teks=intval($teks);
		$bulan=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		return $bulan[$teks];
	}		
}


if ( ! function_exists('Romawi'))
{
	function Romawi($teks){
		$teks=intval($teks);
		$bulan=array("","I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
		return $bulan[$teks];
	}		
}
