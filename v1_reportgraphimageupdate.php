<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

// this caters for both report and mpdfreport situations
$inreporttype = $_REQUEST['ReportType']; // report or mpdfreport
$inreportmpdfreport_id = $_REQUEST['reportmpdfreport_id'];
$inreportmpdfreport_graphimage = $_REQUEST['reportmpdfreport_graphimage'];

Get_Data($inreporttype,$inreportmpdfreport_id);

$GLOBALS{$inreporttype.'_graphimage'} = $inreportmpdfreport_graphimage;

Write_Data($inreporttype,$inreportmpdfreport_id);

print "0|".$inreportmpdfreport_id."|Graph Image Successfully Updated";

?>