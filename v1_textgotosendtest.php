<?php


/*
To make a call to the HTTP API, simply make a HTTP GET or POST request to the following URL:
http://textgoto.co.uk/api/webapi.aspx? m=[MESSAGE]&n=[NUMBER]&u=[USERNAME]&p=[PASSWORD]

Obviously you should substitute the appropriate values. The message should be URL encoded, and will be decoded on receipt.

You will receive one of the following responses:
 
SUCCESS               The message has been accepted, and added to our queue.
INVALID_CREDENTIALS   Your userid/password were incorrect
INVALID_NUMBER        The phone number is invalid
MESSAGE_TOO_LONG      The message is longer than your current tariff permits
INSUFFICIENT_CREDIT   You need more credit on your account
NUMBER_STOPPED        This number is stopped on your account, and you may not send to it
NO_MERGE              You may not perform data merging in the API, which means no square brackets in the message!


BULK API 
To make a call to the Bulk API, you make a HTTP POST request to the following URL: 
http://textgoto.co.uk/api/bulkapi.aspx 

The headers should include the following: 
U   		Your TextGoto UserID
P 			Your password
RETURNURL 	(optional) A URL that will receive the asynchronous response from the TextGoto servers
DUPLICATE 	(optional) Set to “REMOVE” to reject duplicate numbers 

The body of the request should be UTF-8 encoded text, each line containing a pipe- separated send request in the following format: 
PHONE|MESSAGE|ORIGINATOR
e.g. 447700900000|This is an example message|EXAMPLE 

Your bulk send will then be loaded into a queue - you can see the progress of this in the Action Viewer. If you included the header “duplicate:remove” then any duplicate numbers in the list will be rejected. 
Once your bulk send has been processed, all accepted messages will be queued for sending on the TextGoto system. If you have provided a Return URL in the header, then at this point the system will send an asynchronous response to you containing any information concerning rejected messages. 

The response is a HTTP POST, including the following headers: 

USERID 		Your User ID.
ID 			A unique identifier for this API send.
SENT 		The number of messages accepted and queued. ERRORS 		The total number of rejected messages.
DUPLICATE 	The number of messages rejected due to duplication, if duplicate rejection is enabled.
STOPPED 	The number of messages stopped due to opt-outs. DTS The date and time that processing was completed. 

The body of the request is UTF-8 encoded text, pipe-separated, showing each rejected message, plus an extra field indicating the reason for the rejection, which are as follows: 

INVALID_RECORD 		The overall message record is badly formed
INVALID_ORIGINATOR 	The originator provided is invalid
MESSAGE_TOO_LONG 	The message is longer than your current tariff ermits 
DUPLICATE_NUMBER 	The number has already been used in this send (if duplicate rejection is enabled) 
NUMBER_STOPPED 		This number is stopped on your account, and you may not send to it 
NUMBER_BARRED 		This number is barred systemwide, and you may not send to it
NO_MERGE 			You may not perform data merging in the API, which means no square brackets in the message! 

*/
print "Content-type: text/html\n\n";
print "<br>";
$message = "This is a another test message";
$number = "07738826189";
$username = "havanthockeyclub";
$password = "Yt3xcXFD";

/*
$geturl = "http://textgoto.co.uk/api/webapi.aspx?";
$geturl = $geturl."m=".$message;
$geturl = $geturl."&n=".$number;
$geturl = $geturl."&u=".$username;
$geturl = $geturl."&p=".$password;

print "<br>".$geturl;
$response = httpGet($geturl);
print "<br>"."<br>".$response;
*/


$geturl = "http://textgoto.co.uk/api/webapi.aspx";
$params = array(
   "m" => $message,
   "n" => $number,
   "u" => $username,   
   "p" => $password
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

	$output=curl_exec($ch);

	curl_close($ch);
	return $output;

}


?>
