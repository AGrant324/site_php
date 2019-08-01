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
BROW();
BCOL("2");
XLABELF("Title","Title");
B_COL();
BCOL("2");
XINTXTP("Title","Title","255","255","Issue title");
B_COL();
B_ROW();
BROW();
BCOL("2");
XLABELF("Description","Description");
B_COL();
BCOL("2");
XINTXTP("Description","Description","255","255","Description");
B_COL();
B_ROW();
X_FORM();

Back_Navigator();
PageFooter("Default","Final");
