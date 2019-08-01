<?php # corhistoryuploadin.php

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

$fieldtytpehash = array();
$q = 'SHOW COLUMNS FROM corsite';
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# Field Type Null Key Default Extra
if (mysqli_num_rows($r) > 0) {
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
		// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
		$fieldtytpehash[$row[0]] = $row[1];
	}
}
$q = 'SHOW COLUMNS FROM corresi';
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# Field Type Null Key Default Extra
if (mysqli_num_rows($r) > 0) {
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
		// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
		$fieldtytpehash[$row[0]] = $row[1];
	}
}
$q = 'SHOW COLUMNS FROM corsurvey';
$r = mysqli_query($GLOBALS{'IOSQL'},$q);
# Field Type Null Key Default Extra
if (mysqli_num_rows($r) > 0) {
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
		// XPTXT($row[0].'|'.$row[1].'|'.$row[2].'|'.$row[3].'|');
		$fieldtytpehash[$row[0]] = $row[1];
	}
}

// print_r($fieldtytpehash);

$corsite_ida = Get_Array('corsite');
$highestcorsite_id = "SI00000";
foreach ($corsite_ida as $corsite_id) { 
	if ( $corsite_id > $highestcorsite_id ) { $highestcorsite_id = $corsite_id; } 
}
$highestcorsite_seq = str_replace("SI", "", $highestcorsite_id);

$corresi_ida = Get_Array('corresi');
$highestcorresi_id = "RE00000";
foreach ($corresi_ida as $corresi_id) { 
	if ( $corresi_id > $highestcorresi_id ) { $highestcorresi_id = $corresi_id; }
}
$highestcorresi_seq = str_replace("RE", "", $highestcorresi_id);

$corsurvey_ida = Get_Array('corsurvey');
$highestcorsurvey_id = "SU00000";
foreach ($corsurvey_ida as $corsurvey_id) { 
	if ( $corsurvey_id > $highestcorsurvey_id ) {$highestcorsurvey_id = $corsurvey_id;} 
}
$highestcorsurvey_seq = str_replace("SU", "", $highestcorsurvey_id);

$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Cordage Property Database Upload - ".$tortext);

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"masterupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/masterupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "Header" ) {;
			$headera = $uploadcsva;
		}
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			// XPTXT($upmessage);
			$dataa = $uploadcsva;
			Initialise_Data('corsite');
			$corresilist = ""; $corresisep = "";
			$corsurveylist = ""; $corsurveysep = "";
			$corplanlist = "";	$corplansep = ""; 			
			$highestcorsite_seq++;
			$corsite_id = "SI".substr(("00000".$highestcorsite_seq), -5);
			// XH4("========= start site ======== ".$corsite_id);				
			$scseq = 0;
			$hi = 0;
			foreach ($dataa as $dataelement) {
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
					if (strlen(strstr($headera[$hi],"corresi_"))>0) {
						// corresi_class[0]
						$nbits = explode("_",$headera[$hi]);
						$obits = explode("[",$nbits[1]);
						$pbits = explode("]",$obits[1]);
						$thisfield = $nbits[0]."_".$obits[0];
						if (strlen(strstr($headera[$hi],"_class"))>0) {
							Initialise_Data('corresi');
							$highestcorresi_seq++;	
							$corresi_id = "RE".substr(("00000".$highestcorresi_seq), -5);
						}
						$GLOBALS{$thisfield} = utf8_encode($dataelement);
						if (strlen(strstr($headera[$hi],"_postdiscountcalc"))>0) {
							$GLOBALS{'corresi_corsiteid'} = $corsite_id;												
							if ( $GLOBALS{'corresi_class'} != "" ) {
								$GLOBALS{'corresi_index'} = $pbits[0];								
								$corresilist = $corresilist.$corresisep.$corresi_id; 
								$corresisep = ",";										
								if ($testorreal == "R") { Write_Data('corresi',$corresi_id); }	
								// XH4("residence - ".$corresi_id." ".$GLOBALS{'corresi_class'});
							}
						}				
					}				
					if (strlen(strstr($headera[$hi],"corsurvey_"))>0) {
						// corsurvey_supplier[Marketing]
						$nbits = explode("_",$headera[$hi]);
						$obits = explode("[",$nbits[1]);
						$pbits = explode("]",$obits[1]);
						$thisfield = $nbits[0]."_".$obits[0];
						if (strlen(strstr($headera[$hi],"_reqd"))>0) {
							Initialise_Data('corsurvey');
							$highestcorsurvey_seq++;
							$corsurvey_id = "SU".substr(("00000".$highestcorsurvey_seq), -5);						
						}
						$GLOBALS{$thisfield} = utf8_encode($dataelement);
						if (strlen(strstr($headera[$hi],"_costvsquotevarcalc"))>0) {
							$GLOBALS{'corsurvey_corsiteid'} = $corsite_id;
							$GLOBALS{'corsurvey_corsurveycategoryid'} = $pbits[0];
							Check_Data('corsurveycategory',$GLOBALS{'corsurvey_corsurveycategoryid'});
							if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data('corsurveycategory'); } 						
							$GLOBALS{'corsurveycategory_description'} = $GLOBALS{'corsurvey_corsurveycategoryid'};
							$GLOBALS{'corsurveycategory_seq'} = "S".substr(("00".$scseq), -3);
							$scseq++;
							$GLOBALS{'corsurveycategory_showbydefault'} = "Yes";
							if ($testorreal == "R") { Write_Data('corsurveycategory',$GLOBALS{'corsurvey_corsurveycategoryid'}); }
							if ( $GLOBALS{'corsurvey_reqd'} == "Y") {
								$corsurveylist = $corsurveylist.$corsurveysep.$corsurvey_id;
								$corsurveysep = ",";						
								if ($testorreal == "R") { Write_Data('corsurvey',$corsurvey_id); }
							}
							// XH4("survey - ".$corsurvey_id." ".$GLOBALS{'corsurvey_corsurveycategoryid'});
						}					
					}				
				}
			
				$hi++;
			}
			
			$GLOBALS{'corsite_plgsurveylist'} = $corsurveylist;		
			$GLOBALS{'corsite_dispcorresiidlist'} = $corresilist;		
			if ($testorreal == "R") { Write_Data('corsite',$corsite_id,'Live'); }
			XH4("========= added site ======== ".$corsite_id." ".$GLOBALS{'corsite_site'});			
		}
	}
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



