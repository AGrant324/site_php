<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$inaccredaction_schemeid = $_REQUEST['accredaction_schemeid'];
$inaccredaction_clubid = $_REQUEST['accredaction_clubid'];
$inaccredaction_id = $_REQUEST['accredaction_id'];

Library_ACCREDACTIONDELETECONFIRM_Output ($inaccredaction_schemeid,$inaccredaction_clubid,$inaccredaction_id);

Back_Navigator();
PageFooter("Default","Final");


