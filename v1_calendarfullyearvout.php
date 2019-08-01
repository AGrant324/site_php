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

if (isset($_GET['year'])) {
  $_SESSION['year'] = $_GET['year'];
}else {
  $_SESSION['year'] = date('Y');
}

// XH2("Full Year Calendar Vertical Prototype");
BROW();
BCOL("4");
ACTION_CAL_YEAR_PICKER("calendarfullyearvout.php");
B_COL();
// BCOLCENTER("2");
// B_COL();
ACTION_CAL_NAV();
B_ROW();
//start of year view
Action_CALENDARFULLYEAR_Output("vertical");
// resetTimeoutHandle();
//end of year view


Back_Navigator();
PageFooter("Default","Final");
