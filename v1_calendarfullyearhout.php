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


// // echo $_GET["OrgId"];
// $todo = Get_Array_select("todo",["todo_clubid",$_GET["OrgId"]],"*");
// $devPlan = Get_Array_select("accredaction",["accredaction_clubid",$_GET["OrgId"]],"*");
// echo "<div style='display:none'>";
// print_r($todo);
// print_r($devPlan);
// echo "</div>";

if (isset($_GET['year'])) {
  $_SESSION['year'] = $_GET['year'];
}else {
  $_SESSION['year'] = date('Y');
}

BROW();
BCOL("4");
ACTION_CAL_YEAR_PICKER("calendarfullyearhout.php");
B_COL();
// BCOLCENTER("2");
// XH2("Full Year Calendar Horiontal Prototype");
// B_COL();
ACTION_CAL_NAV();
B_ROW();
//start of year view
Action_CALENDARFULLYEAR_Output("horizontal");

Back_Navigator();
PageFooter("Default","Final");
