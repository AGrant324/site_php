<?php # personLUin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();


print_r($_REQUEST);






/*
if((isset($_REQUEST['sfmclub_id'])&&$_REQUEST['sfmclub_id']!="")) { $keychangetable = "sfmclub"; $oldsfmclub_id = $_REQUEST['sfmclub_id'];  }   
if((isset($_REQUEST['sfmteam_id'])&&$_REQUEST['sfmteam_id']!="")) { $keychangetable = "sfmteam"; $oldsfmteam_id = $_REQUEST['sfmteam_id'];  }   
if((isset($_REQUEST['sfmfacility_id'])&&$_REQUEST['sfmfacility_id']!="")) { $keychangetable = "sfmfacility"; $oldsfmfacility_id = $_REQUEST['sfmfacility_id'];  }   
*/




?>