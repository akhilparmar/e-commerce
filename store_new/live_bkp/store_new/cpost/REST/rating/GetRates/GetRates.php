<?php
 /**
 * Sample code for the GetRates Canada Post service.
 * 
 * The GetRates service returns a list of shipping services, prices and transit times 
 * for a given item to be shipped. 
 *
 * This sample is configured to access the Developer Program sandbox environment. 
 * Use your development key username and password for the web service credentials.
 * 
 **/

// Your username, password and customer number are imported from the following file    	
// CPCWS_Rating_PHP_Samples\REST\rating\user.ini 
$userProperties = parse_ini_file(realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../user.ini');

$username = $userProperties['username']; 
$password = $userProperties['password'];
$mailedBy = $userProperties['customerNumber'];

// REST URL
$service_url = 'https://ct.soa-gw.canadapost.ca/rs/ship/price';

// Create GetRates request xml
//$originPostalCode = 'H2B1A0'; //
$originPostalCode = 'K9J3W6'; //
//$postalCode = 'K1K4T3';//
$postalCode = 'L5R3M7';//
$weight = 1;

$xmlRequest = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<mailing-scenario xmlns="http://www.canadapost.ca/ws/ship/rate-v3">
  <customer-number>{$mailedBy}</customer-number>
  <parcel-characteristics>
    <weight>{$weight}</weight>
  </parcel-characteristics>
  <origin-postal-code>{$originPostalCode}</origin-postal-code>
  <destination>
    <domestic>
      <postal-code>{$postalCode}</postal-code>
    </domestic>
  </destination>
</mailing-scenario>
XML;

$curl = curl_init($service_url); // Create REST Request
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($curl, CURLOPT_CAINFO, realpath(dirname($_SERVER['SCRIPT_FILENAME'])) . '/../../../third-party/cert/cacert.pem');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlRequest);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.ship.rate-v3+xml', 'Accept: application/vnd.cpc.ship.rate-v3+xml'));
$curl_response = curl_exec($curl); // Execute REST Request
if(curl_errno($curl)){
	echo 'Curl error: ' . curl_error($curl) . "\n";
}

echo 'HTTP Response Status: ' . curl_getinfo($curl,CURLINFO_HTTP_CODE) . "\n";

// Example of using SimpleXML to parse xml response
libxml_use_internal_errors(true);

echo $curl_response;


$xml = simplexml_load_string('<root>' . preg_replace('/<\?xml.*\?>/','',$curl_response) . '</root>');

if (!$xml) {
	echo 'Failed loading XML' . "\n";
	echo $curl_response . "\n";
	foreach(libxml_get_errors() as $error) {
		echo "\t" . $error->message;
	}
} else {
	if ($xml->{'price-quotes'} ) {
		$priceQuotes = $xml->{'price-quotes'}->children('http://www.canadapost.ca/ws/ship/rate-v3');
		if ( $priceQuotes->{'price-quote'} ) {
			foreach ( $priceQuotes as $priceQuote ) {  
				echo 'Service Name: ' . $priceQuote->{'service-name'} . "\n";
				echo 'Price: ' . $priceQuote->{'price-details'}->{'due'} . "\n\n";	
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

//print_r($curl_response);
curl_close($curl);





?>

