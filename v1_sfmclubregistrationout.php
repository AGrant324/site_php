<?php
require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_sfmroutines.php";
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
SFM_ClubRegistration_Output();  
Back_Navigator();
PageFooter("Default","Final");
