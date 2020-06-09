<?php
	class Utility{
		function __construct() {
			
		}
		
		function hashPassword($pass){
			$random_string = '!@#$%^PORTAL_SEKOLAH^&*()';
			$pass_fix = hash('sha256',$random_string.$pass);
			return $pass_fix;
		}
		
		function sendSms($telepon,$message){
			$userkey='4ydnsf';
			$passkey='doveriz';
			$url = 'https://reguler.zenziva.net/apps/smsapi.php';
			$curlHandle = curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $url);
			curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
			curl_setopt($curlHandle, CURLOPT_POST, 1);
			$results = curl_exec($curlHandle);
			curl_close($curlHandle);
		}
		
		function dateTimeNow(){
			$tanggal = gmdate("Y-m-d H:i:s", time()+60*60*7);
			return $tanggal;
		}
		
		function timeNow(){
			$time = gmdate("H:i:s", time()+60*60*7);
			return $time;
		}
		
		function dateNow(){
			$tanggal = gmdate("Y-m-d", time()+60*60*7);
			return $tanggal;
		}
		
		function base64_encode_fix($string){
			$base_64_string = base64_encode($string);
			$url_param = rtrim($base_64_string, '=');
		    return $url_param;
		}

		function base64_decode_fix($string){
			$base_64_string = $string . str_repeat('=', strlen($string) % 4);
		    return base64_decode($base_64_string);
		}
		
		function filterTag($text){
			$string = strip_tags($text);
			return $string;
		}
		
		function selisihTanggal($start,$end){
			$start_date = new DateTime($start);
			$end_date = new DateTime($end);
			$interval = $start_date->diff($end_date);
			return $interval->days;
		}
		
		function filterInput($content)
		{
			$karakter = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','/','\\',',','.','#',':',';','\'','"','[',']');
			$hapus_karakter_aneh = str_replace($karakter,"",$content);
			return $this->filterTag($hapus_karakter_aneh);
		}
	}
?>