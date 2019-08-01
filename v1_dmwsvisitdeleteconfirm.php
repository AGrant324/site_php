<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$indmwssu_id = $_REQUEST['dmwssu_id'];$indmwsvisit_id = $_REQUEST['dmwsvisit_id'];
Dmws_DMWSVISITDELETECONFIRM_Output($indmwssu_id,$indmwsvisit_id);
Back_Navigator();
PageFooter("Default","Final");


