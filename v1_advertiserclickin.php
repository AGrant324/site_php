<<<<<<< HEAD
<?php # advertiserclickin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$advertiser_name = $_REQUEST["AdvertiserName"];
$aclass = $_REQUEST["AdvertiserClass"];

if ($aclass == "S" ) { $aref = "advertiser_".$GLOBALS{'LOGIN_service_id'}; } else { $aref = "advertiser"; }
Check_Data($aref,$advertiser_name);
if ($GLOBALS{'IOWARNING'} == "0" ) { 
 $GLOBALS{'advertiser_clicks'} = $GLOBALS{'advertiser_clicks'} + 1;
 $readonlyoverride = "Yes";
 Write_Data($aref,$advertiser_name);

 # print "Content-type: text/html\n\n";
 # print "Site - $advertiser_name $GLOBALS{'advertiser_website'}";

 $url = $GLOBALS{'advertiser_website'};
 header("Location: $url"); 
 exit;
=======
<?php # advertiserclickin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$advertiser_name = $_REQUEST["AdvertiserName"];
$aclass = $_REQUEST["AdvertiserClass"];

if ($aclass == "S" ) { $aref = "advertiser_".$GLOBALS{'LOGIN_service_id'}; } else { $aref = "advertiser"; }
Check_Data($aref,$advertiser_name);
if ($GLOBALS{'IOWARNING'} == "0" ) { 
 $GLOBALS{'advertiser_clicks'} = $GLOBALS{'advertiser_clicks'} + 1;
 $readonlyoverride = "Yes";
 Write_Data($aref,$advertiser_name);

 # print "Content-type: text/html\n\n";
 # print "Site - $advertiser_name $GLOBALS{'advertiser_website'}";

 $url = $GLOBALS{'advertiser_website'};
 header("Location: $url"); 
 exit;
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
} 