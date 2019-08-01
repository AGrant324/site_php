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
            if ($testorreal == "R") { Delete_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id); } 
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
    		$GLOBALS{'accredcriteria_id'} = $uploadcsva[1];
    		$GLOBALS{'accredcriteria_ref'} = $uploadcsva[2];
    		$GLOBALS{'accredcriteria_type'} = "data";
    		$GLOBALS{'accredcriteria_datafieldname'} = $uploadcsva[4];
    		$GLOBALS{'accredcriteria_datafieldtitle'} = $uploadcsva[5];
    		$GLOBALS{'accredcriteria_dataradioquestions'} = $uploadcsva[6];
    		$GLOBALS{'accredcriteria_datacheckboxquestions'} = "";
    		$GLOBALS{'accredcriteria_datatextquestion'} = $uploadcsva[5];
    		
                if ($GLOBALS{'accredcriteria_datatextquestion'} != "") { $GLOBALS{'accredcriteria_dataquestiontype'} = "Text"; }
                if ($GLOBALS{'accredcriteria_dataradioquestion'} != "") { $GLOBALS{'accredcriteria_dataquestiontype'} = "Radio"; }
                
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[7];
    		XPTXT("A ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingA","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[8];
    		XPTXT("B ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingB","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[9];
    		XPTXT("C ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingC","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[10];
    		XPTXT("D ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingD","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[11];
    		XPTXT("E ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingE","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[12];
    		XPTXT("F ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingF","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[13];
    		XPTXT("G ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingG","sfm",$GLOBALS{'accredcriteria_id'}); }
    		$GLOBALS{'accredcriteria_datatargetreqd'} = $uploadcsva[14];
    		XPTXT("H ".$GLOBALS{'accredcriteria_datatargetreqd'});
    		if ($testorreal == "R") { Write_Data("accredcriteria","FAGroundGradingH","sfm",$GLOBALS{'accredcriteria_id'}); }
		}
	}
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



