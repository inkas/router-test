<?php
	header("Access-Control-Allow-Origin: *");
	
	//Check if internet is available
	if(isset($_POST['is_internet_available']) && !empty($_POST['is_internet_available'])){
		echo 'Your Internet connection is OK.';
	}
	
	//Check if tunnel is up
	if(isset($_POST['tunnel_gateway']) && !empty($_POST['tunnel_gateway'])){
		/* 1. cURL method */
		function checkURL_curl($url){ 
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,      $url);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
			curl_setopt($ch, CURLOPT_HEADER,         true);
			curl_setopt($ch, CURLOPT_NOBODY,         true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
			curl_setopt($ch, CURLOPT_TIMEOUT, 120);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
			curl_setopt($ch, CURLOPT_ENCODING,"");
			curl_setopt($ch, CURLOPT_AUTOREFERER,true);
			
			$r = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			if($httpCode >= 200 && $httpCode < 400){
				echo 1;
			}else{
				echo 0;
			}
		} 
		checkURL_curl($_POST['tunnel_gateway']);
		
		/* 2. Get Headers Method with built-in function */
		/*	
		function checkURL($url){
			$headers = get_headers($url);
			$httpCode = substr($headers[0], 9, 3);
			if($httpCode >= 200 && $httpCode < 400){
				echo 1;
			}else{
				echo 0;
			}
		}
		checkURL($_POST['tunnel_gateway']);
		*/
	}
	