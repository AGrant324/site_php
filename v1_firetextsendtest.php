<?php

/*
Sending SMS 
In order to send a message using the gateway, you will need to send a request to:
https://www.firetext.co.uk/api/sendsms
we recommend using https for secure SSL connection 

The following are a list of parameters to be sent via HTTP POST or GET:Name (cont.) Description 
username: 				Your FireText.co.uk username 
password: 				Your FireText.co.uk password 
message :				The text message body. This can be up to 612 characters in length. A single message is 160 characters, 
						longer messages are 153 each (2=306,3=459,4=612). 
from: 					The "Sender ID" that is displayed when the message arrives on handset. This can be your company name or reply number.
						This field can only be alpha numeric. [A-Z], [a-z], [0-9], Min 3 chars, max 11 chars. 
to: 					Comma separated list of up to 50 mobile numbers. Remove the ‘+’ sign and any leading zeros when using international codes. 
						A UK number can start ‘07’ or ‘447’. 
schedule(optional): 	The scheduled message date/time in the format YYYY-MM-DD HH:MM (e.g. 2010-05-20 17:00). 
						Scheduled messages can be viewed and deleted online at FireText.co.uk. 
reference(optional): 	If set, you can record a custom ID against the the message batch, which will be passed back in the delivery receipt. 
group(optional): 		This allows you to easily send a message to a pre-defined group within your FireText.co.uk account. 
						Simply include the APIKey for the group. Any duplicates or opt-outs will be ignored. 
receipt(optional) 		Alternate receipt URL. Instead of using the receipt URL as set within your FireText.co.uk account, receipts will be sent to this URL. 
subaccount(optional): 	Your sub-account ID. Include this variable to send a message via a specified sub account. 
						To enable the sub-accounts module, please email info@firetext.co.uk 

For example:
https://www.firetext.co.uk/api/sendsms? username=myusername&password=mypassword&message=This+is+a+test+message
&from=FireText&to=07123456789,447712345678&schedule=2010-0 5-22%2017:00&reference=1234567

*/
print "Content-type: text/html\n\n";
print "<br>";
$username = "firetext@havanthockeyclub.org.uk";
$password = "SF1hV2pvaSl4";
$message = "This is a test firetext message from barry A";
$from = "02393162462";
$to = "07738826189";

/*

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://localhost/site_php/sendsmspost.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "username=firetexthavanthockeyclub.org.uk&password=SF1hV2pvaSl4&message=This6&from=02393162462&to=07738826189");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);
print $server_output;

*/

/*
$params = array(
   "username" => $username,  
   "password" => $password,   
   "message" => $message,
   "from" => $from,   
   "to" => $to
);

# $geturlbase = "http://localhost/site_php/sendsmsget.php?";
$geturlbase = "http://www.firetext.co.uk/api/sendsms?";
$geturlparams = http_build_query($params, '', "&");
# $geturlparams = http_build_query($params, '', '&amp;');
$geturl = $geturlbase.$geturlparams;

print "<br>".$geturl;

$response = httpGet($geturl);
print "<br>"."<br>".$response;
*/

# $geturl = "http://localhost/site_php/sendsmspost.php";
$geturl = "http://www.firetext.co.uk/api/sendsms";
$params = array(
   "username" => urlencode($username),  
   "password" => urlencode($password),   
   "message" => urlencode($message),
   "from" => urlencode($from),   
   "to" => urlencode($to)
);
print httpPost($geturl,$params);


/*
$geturl = "http://textgoto.co.uk/api/webapi.aspx";
$params = array(   "m" => "1",   "n" => $number,   "u" => $username,   "p" => $password ); print httpPost($geturl,$params); print "<br>";
$params = array(   "m" => "2",   "n" => $number,   "u" => $username,   "p" => $password ); print httpPost($geturl,$params); print "<br>";
$params = array(   "m" => "3",   "n" => $number,   "u" => $username,   "p" => $password ); print httpPost($geturl,$params);
*/

function httpGet($url)
{
	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);
	//  curl_setopt($ch,CURLOPT_HEADER, false);

	$output=curl_exec($ch);

	curl_close($ch);
	return $output;
}

function httpPost($url,$params)
{
	$postData = '';
	//create name value pairs seperated by &
	foreach($params as $k => $v)
	{
		$postData .= $k . '='.$v.'&';
	}
	rtrim($postData, '&');

	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, count($postData));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);	

	$output=curl_exec($ch);

	curl_close($ch);
	return $output;

}


?>
