<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";
require_once "v1_actionroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Action_CALENDAR_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

$calendarfilter = $_REQUEST['CalendarFilter'];

BROW();
BCOL("4");
B_COL();
// BCOLCENTER("2");
// XH2("Calendar");
// B_COL();
ACTION_CAL_NAV();
B_ROW();


Action_CALENDAR_Output($calendarfilter);

Back_Navigator();
PageFooter("Default","Final");
