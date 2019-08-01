<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";
require_once "v1_actionroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Action_TODOUPDATE_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$intodo_id = $_REQUEST['todo_id'];

Action_TODOUPDATE_Output($intodo_id);

// echo("1".$_SESSION['referer']);
// // print_r($_SESSION);
Back_Navigator();
PageFooter("Default","Final");
