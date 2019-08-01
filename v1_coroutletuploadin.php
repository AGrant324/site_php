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

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Cordage Property Database Upload (ARK Data)- ".$tortext);

$maxfilesize = "10000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"outletupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/outletupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	$recordcount = 0;
	$updatecount = 0;
	$addcount = 0;
	
	$corsite_arkpostcode = -1;
	
	$postcodearray = Array();
	foreach ($corsite_ida as $xcorsite_id) {
		Get_Data('corsite',$xcorsite_id,'Live');
		$postcodearray[$GLOBALS{'corsite_arkpostcode'}] = $xcorsite_id;
	}
	
	foreach ($records as $recordelement) {	
		$recordcount++;
		if ( $recordcount < 5000 ) {
			$upmessage = CSV_In_Filter($recordelement);
			# end of the tidy up
			$uploadcsva = explode("|",$upmessage);
			if ( $uploadcsva[0] == "Header" ) {
				$headera = $uploadcsva;
				// print_r($headera);
				$hi = 0;
				foreach ($headera as $dataelement) {
					if ( $dataelement == 'corsite_arkpostcode' ) { $corsite_arkpostcodeindex = $hi; }					
					$hi++;	
				}
			}
		
			if ((strlen(strstr($uploadcsva[0],"Data"))>0)&&($uploadcsva[2] != "")) {
				$fcorsite_id = "";
				$found = "0";
				if (($uploadcsva[$corsite_arkpostcodeindex] != "")&&(array_key_exists($uploadcsva[$corsite_arkpostcodeindex], $postcodearray))) { 
					$fcorsite_id = $postcodearray[$uploadcsva[$corsite_arkpostcodeindex]]; $found = "1"; 
					// XPTXT("PostCode Match - ".$uploadcsva[$corsite_arkpostcodeindex]." - ".$fcorsite_id);
				}	
		
				if ( $found == "1" ) {
					// XH4("========= SITE ALREADY LOADED ======== ".$uploadcsva[3]." - ".$fcorsite_id);
					Get_Data('corsite',$fcorsite_id,'Live');
					$updatecount++;			
				} else {
					// XH4("========= NEW SITE ======== ".$uploadcsva[3]." - ".$fcorsite_id);		
					Initialise_Data('corsite');
					$highestcorsite_seq++;
					$fcorsite_id = "SI".substr(("00000".$highestcorsite_seq), -5);			
					$addcount++;
				}
		
				$scseq = 0;
				$hi = 0;
				foreach ($uploadcsva as $dataelement) {
					if ( $headera[$hi] != "" ) {
						$hbits = explode("[",$headera[$hi]);
						if (strlen(strstr($fieldtytpehash[$hbits[0]],"decimal"))>0) {
							$dataelement = str_replace(',', '', $dataelement);
							// XPTXT($headera[$hi]." ".$fieldtytpehash[$headera[$hi]]);
						}
						if (strlen(strstr($headera[$hi],"percent"))>0) {
							$dataelement = str_replace('%', '', $dataelement);
						}
							
						if (strlen(strstr($headera[$hi],"corsite_"))>0) {
							$GLOBALS{$headera[$hi]} = utf8_encode($dataelement);	
						}
					}
					$hi++;
				}
				if ( $GLOBALS{'corsite_status'} == "" ) { $GLOBALS{'corsite_status'} = "Dormant";  }
				$GLOBALS{'corsite_site'} = $GLOBALS{'corsite_arkoutletname'};		
				// XH4("========= update site ======== ".$uploadcsva[3]." - ".$fcorsite_id)." - ".$GLOBALS{'corsite_arkoutletname'};
		
				if ($testorreal == "R") {
					Write_Data('corsite',$fcorsite_id,'Live');
					// XH4("========= write ======== ".$uploadcsva[3]." - ".$fcorsite_id." - ".$GLOBALS{'corsite_arkpostcode'});
				}
			}		
		}
	}
	
	XPTXT($updatecount." Sites Updated");
	XPTXT($addcount." Sites Added");
} else {
	XPTXTCOLOR($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



