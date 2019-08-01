<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Action_TODOVIEWLIST_CSSJS ();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$intodo_id = $_REQUEST['todo_id'];

Delete_Data("todo",$GLOBALS{'LOGIN_org_id'},$intodo_id);
XPTXT('ToDo Item - "'.$intodo_id.'" deleted');

Action_TODOVIEWLIST_Output ("");

Back_Navigator();
PageFooter("Default","Final");


