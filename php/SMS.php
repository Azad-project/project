<?php

function sendSMS($mobile,$msg)
	{
		$username=urlencode("citysms");
		$password=urlencode("167400573");
		$sender=urlencode("citsms");
		
		
		// Prepare data for GET Parameters
		$data = "username=$username&password=$password&mobileno=$mobile&sendername=$sender&message=$msg";

		// Send the GET request to server using cURL
		$ch = curl_init('http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?'.$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		

		return $response;
	}
?>