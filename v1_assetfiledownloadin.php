<<<<<<< HEAD
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 

Get_Common_Parameters();
GlobalRoutine();

// Check_Session_Validity();

$inassetfilename = $_REQUEST["AssetFileName"];

Download_File ($GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets/'.$inassetfilename,"");
=======
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 

Get_Common_Parameters();
GlobalRoutine();

// Check_Session_Validity();

$inassetfilename = $_REQUEST["AssetFileName"];

Download_File ($GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets/'.$inassetfilename,"");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
