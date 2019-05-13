<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

print "Content-type: text/html\n\n";
print "<P>----- TRACE HEADER ------</P><BR>";

$source = $_REQUEST['source'];
$destination = $_REQUEST['destination'];
$message = $_REQUEST['message'];
$time = $_REQUEST['time'];


$GLOBALS{'LOGIN_domain_id'} = "havanthockeyclub";

$GLOBALS{'IOERRORcode'} = "G003";
$GLOBALS{'IOERRORmessage'} = "sqlconnect.txt not found";
$sqlconnecta = Get_File_Array("../cgi-bin/sqlconnect.txt");
$sqla = explode("|",$sqlconnecta[0]);

/*
$dbconnect = "ocz";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";
*/

$dbconnect = "havanthc_ocz";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

print "$dbconnect,$hostconnect,$userconnect,$pswconnect";
IODBCONNECT($dbconnect,$hostconnect,$userconnect,$pswconnect);
IOSETUP();

Get_Data('person','bbra');
$GLOBALS{'person_willingtohelp'} = "Receive ".$source."|".$destination."|".$message."|".$time;
Write_Data('person','bbra');

?>

