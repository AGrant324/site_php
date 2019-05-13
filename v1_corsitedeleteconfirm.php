<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$incorsite_id = $_REQUEST['corsite_id'];$incorsite_version = $_REQUEST['corsite_version'];$inlist = $_REQUEST['List'];
Cor_CORSITEDELETECONFIRM_Output($incorsite_id,$incorsite_version,$inlist);
Back_Navigator();
PageFooter("Default","Final");


