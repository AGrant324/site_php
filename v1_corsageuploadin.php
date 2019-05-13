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


$corsage_ida = Get_Array('corsage');
foreach ($corsage_ida as $corsage_id) { 
	Delete_Data('corsage',$corsage_id);
	// XPTXT($corsage_id." - deleted"); 
}

$corsurvey_ida = Get_Array('corsurvey');
foreach ($corsurvey_ida as $corsurvey_id) { 
	Get_Data('corsurvey',$corsurvey_id);
	$GLOBALS{'corsurvey_costexvatsagecalc'} = 0;
	Write_Data('corsurvey',$corsurvey_id); 
}

$corsage_ida = Get_Array('corsage');
$highestcorsage_id = "SA00000";
foreach ($corsage_ida as $corsage_id) { 
	if ( $corsage_id > $highestcorsage_id ) { $highestcorsage_id = $corsage_id; }
}
$highestcorsage_seq = str_replace("SA", "", $highestcorsage_id);

$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Cordage SAGE Upload - ".$tortext);

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"sageupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sageupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "corsage_lookup" ) {;
			$headera = $uploadcsva;
		}
		if (($uploadcsva[0] != "")&&($uploadcsva[0] != "corsage_lookup")&&($uploadcsva[0] != "Lookup")) {
			// XPTXT($upmessage);
			$dataa = $uploadcsva;	
			$highestcorsage_seq++;
			$corsage_id = "SA".substr(("00000".$highestcorsage_seq), -5);		
			$hi = 0;
			foreach ($dataa as $dataelement) {
				if ( $headera[$hi] != "" ) {
					if (strlen(strstr($headera[$hi],"corsage_"))>0) {
						$GLOBALS{$headera[$hi]} = $dataelement;
					}			
				}
				$hi++;
			}	
			if ($testorreal == "R") { Write_Data('corsage',$corsage_id); }
			XH4("added SAGE record ==> "." ".$GLOBALS{'corsage_lookup'}.$corsage_id." ".$GLOBALS{'corsage_desc'});
	
			$matched = "0";
			foreach ($corsurvey_ida as $corsurvey_id) {
				Get_Data('corsurvey',$corsurvey_id);	
				Check_Data('corsite',$GLOBALS{'corsurvey_corsiteid'},'Live');	
				if ($GLOBALS{'IOWARNING'} == "0") {
					// XPTXT( $GLOBALS{'corsage_department'}.' vs '.$GLOBALS{'corsite_site'} );			
					if ($GLOBALS{'corsage_department'} == $GLOBALS{'corsite_sagedepartment'}) {
						// XPTXT( $GLOBALS{'corsage_account'}.' vs '.$GLOBALS{'corsurvey_account'} );
						if ($GLOBALS{'corsage_account'} == $GLOBALS{'corsurvey_account'}) {			
							$GLOBALS{'corsurvey_costexvatsagecalc'} = $GLOBALS{'corsurvey_costexvatsagecalc'} + $GLOBALS{'corsage_valueacc'};
							Write_Data('corsurvey',$corsurvey_id);
							$matched = "1";
							XPTXTCOLOR($GLOBALS{'corsage_desc'}." Matched - ".$GLOBALS{'corsage_account'},"Green");
						}
					}
				} else {
					XPTXTCOLOR("ERROR: Invalid Site Id for ".$corsurvey_id,"red");					
				}
			}
			if ( $matched == "0" ) {
				XPTXTCOLOR($GLOBALS{'corsage_desc'}." Not Matched - ".$GLOBALS{'corsage_account'},"red");
			}
		}
	}
} else {
	XPTXT($uploadmessage,"red");
}
	
Back_Navigator();
PageFooter("Default","Final");

?>

