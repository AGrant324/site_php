<?php
/*
$con=mysqli_connect("localhost","cvkrcmz_archival","FgPNI6]Ys;uI","cvkrcmz_dmws");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
*/

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


$thisurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$GLOBALS{'LOGIN_service_id'} = "dmws";
if (strlen(strstr($thisurl,"localhost")) > 0) { $GLOBALS{'LOGIN_domain_id'} = "dmws"; } // test 
else { $GLOBALS{'LOGIN_domain_id'} = "dmwsportal"; } // production 
$GLOBALS{'LOGIN_mode_id'} = "1";   
$GLOBALS{'LOGIN_person_id'} = "";
$GLOBALS{'LOGIN_session_id'} = "";
$GLOBALS{'LOGIN_loginmode_id'} = "";
$GLOBALS{'LOGIN_menu_id'} = ""; 
GlobalRoutine();

// Perform queries

/*
$query = "
update
	dmwssu
	set dmwssu_casestatus = 'open'
	where dmwssu_casecloseddate = '0000-00-00'
	AND dmwssu_casestatus != 'open';
";
$result = mysqli_query($GLOBALS{'IOSQL'},$query);

if (!mysqli_query($GLOBALS{'IOSQL'},$query))  {
  echo("Error description: " . mysqli_error($con));
}
*/

$dmwssua = Get_Array("dmwssu");
foreach ($dmwssua as $dmwssuid) { 
    Get_Data("dmwssu",$dmwssuid);
    if (($GLOBALS{'dmwssu_casecloseddate'} == '0000-00-00')&&($GLOBALS{'dmwssu_casestatus'} != "open")) {
        XPTXT($dmwssuid."|".$GLOBALS{'dmwssu_casestatus'}."|".$GLOBALS{'dmwssu_casecloseddate'}."|Make Open");
        $GLOBALS{'dmwssu_casestatus'} = "open";
        Write_Data("dmwssu",$dmwssuid);
    }
}    

/*
$query = "
update
  dmwssu
	set dmwssu_casestatus = 'closed'
	where dmwssu_casecloseddate != '0000-00-00'
	AND dmwssu_casestatus != 'closed';
";
$result = mysqli_query($GLOBALS{'IOSQL'},$query);

if (!mysqli_query($GLOBALS{'IOSQL'},$query)){
echo("Error description: " . mysqli_error($con));
}
*/

$dmwssua = Get_Array("dmwssu");
foreach ($dmwssua as $dmwssuid) { 
    Get_Data("dmwssu",$dmwssuid);
    if (($GLOBALS{'dmwssu_casecloseddate'} != '0000-00-00')&&($GLOBALS{'dmwssu_casestatus'} != "closed")) {
        XPTXT($dmwssuid."|".$GLOBALS{'dmwssu_casestatus'}."|".$GLOBALS{'dmwssu_casecloseddate'}."|Make Closed");
        $GLOBALS{'dmwssu_casestatus'} = "closed";
        Write_Data("dmwssu",$dmwssuid);
    }
}   

/*
$query = "
  update
  dmwssu
  set dmwssu_casestatus = 'archived'
  where dmwssu_casecloseddate < CURDATE() - INTERVAL 395 DAY
  AND dmwssu_casecloseddate != '0000-00-00'
  AND dmwssu_casestatus != 'archived';
";
$result = mysqli_query($GLOBALS{'IOSQL'},$query);

if (!mysqli_query($GLOBALS{'IOSQL'},$query)){
  echo("Error description: " . mysqli_error($GLOBALS{'IOSQL'}));
}
*/

$dmwssua = Get_Array("dmwssu");
foreach ($dmwssua as $dmwssuid) { 
    Get_Data("dmwssu",$dmwssuid);
    if (($GLOBALS{'dmwssu_casecloseddate'} != '0000-00-00')
    &&(DaysDifference($GLOBALS{'currentYYYY-MM-DD'},$GLOBALS{'dmwssu_casecloseddate'}) > 395)
    &&($GLOBALS{'dmwssu_casestatus'} != "archived")) {
        XPTXT($dmwssuid."|".$GLOBALS{'dmwssu_casestatus'}."|".$GLOBALS{'dmwssu_casecloseddate'}."|Make Archived");
        $GLOBALS{'dmwssu_casestatus'} = "archived";
        Write_Data("dmwssu",$dmwssuid);
    }
}  

/*
mysqli_close($GLOBALS{'IOSQL'});
*/
IODBDISCONNECT ();

?>
