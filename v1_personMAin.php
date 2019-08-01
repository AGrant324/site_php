<<<<<<< HEAD
<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
Check_Session_Validity();

for ( $formseq = 0; $formseq < 100; $formseq++) {
 $frs_id = $_REQUEST['FormFrsId'.$formseq];
 $inavailability = $_REQUEST['Availability'.$formseq];
 $incomments = $_REQUEST['Comments'.$formseq];
 Check_Data("frsperson",$GLOBALS{'currperiodid'},$GLOBALS{'LOGIN_person_id'},$frs_id); 
 if ($GLOBALS{'IOWARNING'} == "1") {Initialise_Data("frsperson");}
 $GLOBALS{'frsperson_availability'} = $inavailability; 
 $GLOBALS{'frsperson_availabilitymessage'} = $incomments;  
 Write_Data("frsperson",$GLOBALS{'currperiodid'},$GLOBALS{'LOGIN_person_id'},$frs_id); 
}

Person_MA_Output();

Back_Navigator();
PageFooter("Default","Final");

?>
=======
<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();
Check_Session_Validity();

for ( $formseq = 0; $formseq < 100; $formseq++) {
 $frs_id = $_REQUEST['FormFrsId'.$formseq];
 $inavailability = $_REQUEST['Availability'.$formseq];
 $incomments = $_REQUEST['Comments'.$formseq];
 Check_Data("frsperson",$GLOBALS{'currperiodid'},$GLOBALS{'LOGIN_person_id'},$frs_id); 
 if ($GLOBALS{'IOWARNING'} == "1") {Initialise_Data("frsperson");}
 $GLOBALS{'frsperson_availability'} = $inavailability; 
 $GLOBALS{'frsperson_availabilitymessage'} = $incomments;  
 Write_Data("frsperson",$GLOBALS{'currperiodid'},$GLOBALS{'LOGIN_person_id'},$frs_id); 
}

Person_MA_Output();

Back_Navigator();
PageFooter("Default","Final");

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
