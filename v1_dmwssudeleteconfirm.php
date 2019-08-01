<<<<<<< HEAD
<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$indmwssu_id = $_REQUEST['dmwssu_id'];$inlist = $_REQUEST['List'];$inliststatus = $_REQUEST['ListStatus'];
Dmws_DMWSSUDELETECONFIRM_Output($indmwssu_id,$inlist,$inliststatus);
Back_Navigator();
PageFooter("Default","Final");


=======
<?php # frsteamresultin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_dmwsroutines.php');
Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$indmwssu_id = $_REQUEST['dmwssu_id'];$inlist = $_REQUEST['List'];$inliststatus = $_REQUEST['ListStatus'];
Dmws_DMWSSUDELETECONFIRM_Output($indmwssu_id,$inlist,$inliststatus);
Back_Navigator();
PageFooter("Default","Final");


>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
