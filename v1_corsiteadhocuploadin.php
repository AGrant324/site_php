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

$corsite_ida = Get_Array('corsite');
$highestcorsite_id = "SI00000";
foreach ($corsite_ida as $corsite_id) { 
	if ( $corsite_id > $highestcorsite_id ) { $highestcorsite_id = $corsite_id; } 
}
$highestcorsite_seq = str_replace("SI", "", $highestcorsite_id);

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

$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Cordage Site Adhoc Upload - ".$tortext);

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"adhocupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

$corsite_tabnameindex = -1;
$corsite_siteindex = -1;
$corsite_arkpostcode = -1;

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/adhocupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "Header" ) {
			$headera = $uploadcsva;
			$hi = 0;
			foreach ($headera as $dataelement) {
				if ( $dataelement == 'corsite_tabname' ) { $corsite_tabnameindex = $hi; }
				if ( $dataelement == 'corsite_site' ) { $corsite_siteindex = $hi; }		
				if ( $dataelement == 'corsite_arkpostcode' ) { $corsite_arkpostcodeindex = $hi; }					
				$hi++;	
			}
			// print_r($headera);	
		}
	
		if ((strlen(strstr($uploadcsva[0],"Data"))>0)&&($uploadcsva[2] != "")) {
			$fcorsite_id = "";
			$found = "0";
			foreach ($corsite_ida as $xcorsite_id) {
				Get_Data('corsite',$xcorsite_id,'Live');
				// XPTXT($uploadcsva[8]." vs ".$GLOBALS{'corsite_tabname'});
				if ( $corsite_tabnameindex != -1 ) {
					if (($uploadcsva[$corsite_tabnameindex] != "")&&($uploadcsva[$corsite_tabnameindex] == $GLOBALS{'corsite_tabname'})) { $fcorsite_id = $xcorsite_id; $found = "1"; XPTXT("Tabname Match - ".$fcorsite_id);}
				}
				if ( $corsite_siteindex != -1 ) {					
					if (($uploadcsva[$corsite_siteindex] != "")&&($uploadcsva[$corsite_siteindex] == $GLOBALS{'corsite_site'})) { $fcorsite_id = $xcorsite_id; $found = "1"; XPTXT("Site Match - ".$fcorsite_id);}	
				}
				if ( $corsite_arkpostcodeindex != -1 ) {					
					if (($uploadcsva[$corsite_arkpostcodeindex] != "")&&($uploadcsva[$corsite_arkpostcodeindex] == $GLOBALS{'corsite_arkpostcode'})) { $fcorsite_id = $xcorsite_id; $found = "1"; XPTXT("PostCode Match - ".$fcorsite_id);}	
				}				
				// XPTXTCOLOR($fcorsite_id,"red");			
			}	
	
			if ( $found == "1" ) {
				XH4("========= update site ======== ".$uploadcsva[2]." - ".$fcorsite_id);			
				Get_Data('corsite',$fcorsite_id,'Live');
	
			} else {		
				Initialise_Data('corsite');
				$highestcorsite_seq++;
				$fcorsite_id = "SI".substr(("00000".$highestcorsite_seq), -5);			
				XH4("========= create site ======== ".$uploadcsva[2]." - ".$fcorsite_id);
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
				
			if ($testorreal == "R") {
				$GLOBALS{'corsite_landregistrylink'} = str_replace('https:','',$GLOBALS{'corsite_landregistrylink'}); // mod security
				Write_Data('corsite',$fcorsite_id,'Live');
				// XH4("========= write ======== ".$uploadcsva[2]." - ".$fcorsite_id." - ".$GLOBALS{'corsite_arkpostcode'});		
			}			
		}
	}
} else {
	XPTXT($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



