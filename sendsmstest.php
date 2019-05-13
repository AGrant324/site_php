<?php 


print("<H2>FIRETEXT SMS TEST</H2>");
$username = "firetext@havanthockeyclub.org.uk";
$password = "SF1hV2pvaSl4";
$geturl = "https://www.firetext.co.uk/api/sendsms";
$params = array(
    "username" => urlencode($username),
    "password" => urlencode($password),
    "message" => urlencode("Test Message"),
    "from" => "447933248634",
    "to" => "447738826189",
    "reference" => urlencode("20171004164041-GroupBroadcast--bbra")
);
$smsresult = httpPost($geturl,$params);
print("SMSRESULT = ".$smsresult);



function httpPost($url,$params) {
    $GLOBALS{'IOERROR'} = "0";
    $postData = '';
    //create name value pairs seperated by &
    foreach($params as $k => $v) {
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
    if(curl_errno($ch)) {
        $GLOBALS{'IOERROR'} = "1";
        if (curl_errno($ch) == 28) { $output='Timeout error'; }
        else { $output='Error: ' . curl_error($ch); }
    }
    curl_close($ch);
    return $output;
}

?>