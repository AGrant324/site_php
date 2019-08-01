<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST['TestorReal'];
$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Accreditation Criteria Data Upload - ".$tortext);

$ggla = Array("A","B","C","D","E","F","G","H");
foreach ($ggla as $ggl) {
    XH1($ggl);
    $ida = Get_Array("accredcriteria","FAGroundGrading".$ggl,"sfm");
    foreach ($ida as $accredcriteria_id) {
        Get_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
        if ($GLOBALS{"accredcriteria_type"} == "data") {	
            XPTXT("Delete ".$accredcriteria_id);
            if ($testorreal == "R") {  
                Delete_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
            }
        }
    }
}

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"resetupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/resetupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ($uploadcsva[0] == "data") {
		    XPTXT($upmessage);
    		/*
    		0 dataheader
    		1 id
    		2 ref
    		3 title
    		4 database fields
    		5 datafieldtitle
    		6 dataradioquestions
    		7 A
    		8 B
    		9 C
    		l0 D
    		11 E
    		12 F
    		13 G
            14 H
            */
    		
    		Initialise_Data("accredcriteria");
    		$accredcriteria_id = $uploadcsva[1];
    		$accredcriteria_ref = $uploadcsva[2];
    		$accredcriteria_type = "data";
    		$accredcriteria_datafieldname = $uploadcsva[4];
    		$accredcriteria_datafieldtitle = $uploadcsva[5];
    		$accredcriteria_dataradioquestions = $uploadcsva[6];
    		$accredcriteria_datacheckboxquestions = "";
    		$accredcriteria_datatextquestion = "4";
    		
    		$accredcriteria_datatargetreqd = $uploadcsva[7];
    		XPTXT("A ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingA","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[8];
    		XPTXT("B ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingB","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[9];
    		XPTXT("C ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingC","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[10];
    		XPTXT("D ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingD","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[11];
    		XPTXT("E ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingE","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[12];
    		XPTXT("F ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingF","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[13];
    		XPTXT("G ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingG","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[14];
    		XPTXT("H ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingH","sfm",$accredcriteria_id);
		}
	}
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST['TestorReal'];
$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Accreditation Criteria Data Upload - ".$tortext);

$ggla = Array("A","B","C","D","E","F","G","H");
foreach ($ggla as $ggl) {
    XH1($ggl);
    $ida = Get_Array("accredcriteria","FAGroundGrading".$ggl,"sfm");
    foreach ($ida as $accredcriteria_id) {
        Get_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
        if ($GLOBALS{"accredcriteria_type"} == "data") {	
            XPTXT("Delete ".$accredcriteria_id);
            if ($testorreal == "R") {  
                Delete_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
            }
        }
    }
}

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"resetupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/resetupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ($uploadcsva[0] == "data") {
		    XPTXT($upmessage);
    		/*
    		0 dataheader
    		1 id
    		2 ref
    		3 title
    		4 database fields
    		5 datafieldtitle
    		6 dataradioquestions
    		7 A
    		8 B
    		9 C
    		l0 D
    		11 E
    		12 F
    		13 G
            14 H
            */
    		
    		Initialise_Data("accredcriteria");
    		$accredcriteria_id = $uploadcsva[1];
    		$accredcriteria_ref = $uploadcsva[2];
    		$accredcriteria_type = "data";
    		$accredcriteria_datafieldname = $uploadcsva[4];
    		$accredcriteria_datafieldtitle = $uploadcsva[5];
    		$accredcriteria_dataradioquestions = $uploadcsva[6];
    		$accredcriteria_datacheckboxquestions = "";
    		$accredcriteria_datatextquestion = "4";
    		
    		$accredcriteria_datatargetreqd = $uploadcsva[7];
    		XPTXT("A ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingA","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[8];
    		XPTXT("B ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingB","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[9];
    		XPTXT("C ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingC","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[10];
    		XPTXT("D ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingD","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[11];
    		XPTXT("E ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingE","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[12];
    		XPTXT("F ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingF","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[13];
    		XPTXT("G ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingG","sfm",$accredcriteria_id);
    		$accredcriteria_datatargetreqd = $uploadcsva[14];
    		XPTXT("H ".$accredcriteria_datatargetreqd);
    		// Write_Data("accredcriteria","FAGroundGradingH","sfm",$accredcriteria_id);
		}
	}
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
