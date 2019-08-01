<?php # 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

XH1("Paypal Simulator Return");

$returnurl = $_REQUEST['returnurl'];
XPTXT("Return txn = ".$returnurl);

$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $returnurl);
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);


Back_Navigator();
PageFooter("Default","Final");
?>
