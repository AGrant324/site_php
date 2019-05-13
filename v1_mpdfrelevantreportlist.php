<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_pdfroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();
Report_MPDFRELEVANTREPORTLIST_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inkeynamelist = $_REQUEST['keynamelist'];
$inkeyvaluelist = $_REQUEST['keyvaluelist'];

Report_MPDFRELEVANTREPORTLIST_Output( $inkeynamelist, $inkeyvaluelist );

Back_Navigator();
PageFooter("Default","Final");




