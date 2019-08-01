<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$intodo_id = $_REQUEST['todo_id'];

Action_TODODELETECONFIRM_Output ($intodo_id);

Back_Navigator();
PageFooter("Default","Final");


