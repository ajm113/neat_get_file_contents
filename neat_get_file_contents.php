<?php


//CREDIT http://25labs.com/alternative-for-file_get_contents-using-curl/

if(!function_exists('neat_get_file_content'))
{
	function neat_get_file_content($url, $timeout = 10)
	{
	
		//First check if curl is installed...
		if(!function_exists('curl_version'))
		{

			//Fallback encase curl isn't installed....
			$ctx = stream_context_create(array('http'=>
			array(
				'timeout' => $timeout,
			)
			));

			return file_get_contents($url, FALSE, $ctx);
		}
	
		 $curl = curl_init();
		 $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
 
		 curl_setopt($curl,CURLOPT_URL,$url); //The URL to fetch. This can also be set when initializing a session with curl_init().
		 curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		 curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5); //The number of seconds to wait while trying to connect.	
 
		 curl_setopt($curl, CURLOPT_USERAGENT, $userAgent); //The contents of the "User-Agent: " header to be used in a HTTP request.
		 curl_setopt($curl, CURLOPT_FAILONERROR, TRUE); //To fail silently if the HTTP code returned is greater than or equal to 400.
		 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); //To follow any "Location: " header that the server sends as part of the HTTP header.
		 curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE); //To automatically set the Referer: field in requests where it follows a Location: redirect.
		 curl_setopt($curl, CURLOPT_TIMEOUT, $timeout); //The maximum number of seconds to allow cURL functions to execute.	
		 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
 
		 $contents = curl_exec($curl);
		 curl_close($curl);
	 
		 return $contents;
	}
}

?>