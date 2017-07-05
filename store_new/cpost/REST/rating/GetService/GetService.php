<?php
 /**
 * Sample code for the GetService Canada Post service.
 * 
 * The GetService service  returns details of a given postal service in 
 * terms of the min/max weight and dimensions offered by the postal service. 
 * Also returned are details about the available add-on options. 
 *
 * This sample is configured to access the Developer Program sandbox environment. 
 * Use your development key username and password for the web service credentials.
 * 
 **/

// Your username and password are imported from the following file
// CPCWS_Rating_PHP_Samples\REST\rating\user.ini 
$userProperties = parse_ini_file(realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../user.ini');

$username = $userProperties['username']; 
$password = $userProperties['password'];

// REST URL
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/ship/service/DOM.EP?country=CA';

$curl = curl_init($service_url); // Create REST Request
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_CAINFO, realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../../../third-party/cert/cacert.pem'); // Signer Certificate in PEM format
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept:application/vnd.cpc.ship.rate-v3+xml'));
$curl_response = curl_exec($curl); // Execute REST Request
if(curl_errno($curl)){
	echo 'Curl error: ' . curl_error($curl) . "\n";
}

echo 'HTTP Response Status: ' . curl_getinfo($curl,CURLINFO_HTTP_CODE) . "\n";

curl_close($curl);

// Example of using SimpleXML to parse xml response
libxml_use_internal_errors(true);
$xml = simplexml_load_string('<root>' . preg_replace('/<\?xml.*\?>/','',$curl_response) . '</root>');
if (!$xml) {
	echo 'Failed loading XML' . "\n";
	echo $curl_response . "\n";
	foreach(libxml_get_errors() as $error) {
		echo "\t" . $error->message;
	}
} else {
	if ($xml->{'service'} ) {	
		$service = $xml->{'service'}->children('http://www.canadapost.ca/ws/ship/rate-v3');
		if ( $service->{'service-code'} ) {
			echo 'Service Code: ' . $service->{'service-code'} . "\n";
			echo 'Service Name: ' . $service->{'service-name'} . "\n\n";
			foreach ( $service->{'options'}->{'option'} as $option ) {  
				echo 'Option Code: ' . $option->{'option-code'} . "\n";
				echo 'Option Name: ' . $option->{'option-name'} . "\n";			
				echo 'Href: ' . $option->{'link'}->attributes()->{'href'} . "\n\n";	
			}
		}
	}
	if ($xml->{'messages'} ) {					
		$messages = $xml->{'messages'}->children('http://www.canadapost.ca/ws/messages');		
		foreach ( $messages as $message ) {
			echo 'Error Code: ' . $message->code . "\n";
			echo 'Error Msg: ' . $message->description . "\n\n";
		}
	}
		
}

?>

