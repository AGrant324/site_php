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
BROW();
BCOL("4");
B_COL();
ACTION_CAL_NAV();
B_ROW();
Action_CALENDARFULLLIST_Output();
Action_CALENDARFULLYEAR_Output("horizontal");
Action_CALENDARFULLYEAR_Output("vertical");
//end of year view


$calendarfilter = $_REQUEST['CalendarFilter'];
Action_CALENDAR_Output($calendarfilter);

Back_Navigator();
PageFooter("Default","Final");
