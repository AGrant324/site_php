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


XH2("Issue reporting");
XBR();
BROW();
B_ROW();
XFORM("php","issueReport");
#name, value, size, maxlength, placeholder
XLABEL("Title","Title");
XINTXTP("Title","","255","255","Issue title");
X_FORM();

Back_Navigator();
PageFooter("Default","Final");
