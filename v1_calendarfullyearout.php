<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";
require_once "v1_actionroutines.php";
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Action_CALENDARFULLYEAR_CSSJS();
PageHeader("Default","Final");
Back_Navigator();


XH2("Full Year Calendar Prototype");
XBR();
// // echo $_GET["OrgId"];
// $todo = Get_Array_select("todo",["todo_clubid",$_GET["OrgId"]],"*");
// $devPlan = Get_Array_select("accredaction",["accredaction_clubid",$_GET["OrgId"]],"*");
// echo "<div style='display:none'>";
// print_r($todo);
// print_r($devPlan);
// echo "</div>";
// ACTION_CAL_YEAR_PICKER("calendarfullyearhout.php");
BROW();
BCOL("4");
B_COL();
ACTION_CAL_NAV();
B_ROW();
// BCOLCENTER("2");
// XH2("Full Year Calendar Horiontal Prototype");
// B_COL();
//start of full list
Action_CALENDARFULLLIST_Output();
//end of full list
//start of year view
Action_CALENDARFULLYEAR_Output("horizontal");
Action_CALENDARFULLYEAR_Output("vertical");
// resetTimeoutHandle();
//end of year view


$calendarfilter = $_REQUEST['CalendarFilter'];
Action_CALENDAR_Output($calendarfilter);

Back_Navigator();
PageFooter("Default","Final");
