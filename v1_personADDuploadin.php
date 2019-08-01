<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

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
XH3("Mass Person Upload".$tortext);

$maxfilesize = "10000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"peopleupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/peopleupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	$recordcount = 0;
	$updatecount = 0;
	$addcount = 0;
	
	// Step 1 - get existing records 
	$personnamea = Array();
	$persona = Get_Array("person");
	foreach ($persona as $person_id) {
		Get_Data("person",$person_id);
		array_push($personnamea, $person_id."|".$GLOBALS{'personfname'}."|".$GLOBALS{'personsname'});
	}
	
	// Step 2 - delete existing records in file	
	foreach ($records as $recordelement) {
		$recordcount++;
		$upmessage = CSV_In_Filter($recordelement);
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "Header" ) {
			$headera = $uploadcsva;
			$hi = 0;
			foreach ($headera as $dataelement) {
				if ( $dataelement == 'person_fname' ) {
					$person_fnameindex = $hi;
				}
				if ( $dataelement == 'person_sname' ) {
					$person_snameindex = $hi;
				}
				$hi++;
			}
		}		
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			$tempfname = $uploadcsva[$person_fnameindex];
			$tempsname = $uploadcsva[$person_snameindex];
			$tempfname = str_replace("'", "", $tempfname);					
			$tempsname = str_replace("'", "", $tempsname);	
			foreach ($personnamea as $personelement) {				
				$pbits = explode('|',$personelement);
				if (($tempfname == $pbits[1])&&($tempsname == $pbits[2])) {
					if ($testorreal == "R") {
						Delete_Data('person',$pbits[0]);						
					}
					XH4("========= delete ======== ".$pbits[0]);						
				}
			}
		}
	}
	
	foreach ($records as $recordelement) {	
		$recordcount++;
		$upmessage = CSV_In_Filter($recordelement);
		$uploadcsva = explode("|",$upmessage);
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			$tempfname = strtolower($uploadcsva[$person_fnameindex]);
			$tempsname = strtolower($uploadcsva[$person_snameindex]);
			$tempsname = str_replace("'", "", $inmatchsname."999");
			$tempsname = str_replace(" ", "", $tempsname."999");
			$tempfname = str_replace("'", "", $inmatchfname."999");
			$tempfname = str_replace(" ", "", $tempfname."999");
			$fnamebits = str_split($tempfname);
			$snamebits = str_split($tempsname);				
			$newspace = "0";
			$n = "";
			while ($newspace == "0") {
				$newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
				$newperson_id = strtolower($newperson_id);
				$lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
				Check_Data("person",$lookupnewperson_id);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if ($n == "") {
						$n = "1";
					} else { ++$n;
					}
				} else {
					$newspace = "1";
				}
			}	
			$hi = 0;
			foreach ($uploadcsva as $dataelement) {
				if ( $headera[$hi] != "" ) {
					if (strlen(strstr($headera[$hi],"person_"))>0) {
						$GLOBALS{$headera[$hi]} = utf8_encode($dataelement);
					}
				}
				$hi++;
			}
			
			$GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
			$randompassword = createRandomPassword();
			$GLOBALS{'person_password'} = XCrypt($randompassword,$lookupnewperson_id,"encrypt");
			$GLOBALS{'person_passwordclue'} = "Initial Password";
			$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'};
			$GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
			$GLOBALS{'person_locked'} = "";
			
			if ($testorreal == "R") {
				Write_Data('person',$lookupnewperson_id);				
			}
			XH4("========= write ======== ".$lookupnewperson_id);
		}		
	}
	
	XPTXT($updatecount." People Updated");
	XPTXT($addcount." People Added");
} else {
	XPTXTCOLOR($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

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
XH3("Mass Person Upload".$tortext);

$maxfilesize = "10000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"peopleupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/peopleupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	$recordcount = 0;
	$updatecount = 0;
	$addcount = 0;
	
	// Step 1 - get existing records 
	$personnamea = Array();
	$persona = Get_Array("person");
	foreach ($persona as $person_id) {
		Get_Data("person",$person_id);
		array_push($personnamea, $person_id."|".$GLOBALS{'personfname'}."|".$GLOBALS{'personsname'});
	}
	
	// Step 2 - delete existing records in file	
	foreach ($records as $recordelement) {
		$recordcount++;
		$upmessage = CSV_In_Filter($recordelement);
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "Header" ) {
			$headera = $uploadcsva;
			$hi = 0;
			foreach ($headera as $dataelement) {
				if ( $dataelement == 'person_fname' ) {
					$person_fnameindex = $hi;
				}
				if ( $dataelement == 'person_sname' ) {
					$person_snameindex = $hi;
				}
				$hi++;
			}
		}		
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			$tempfname = $uploadcsva[$person_fnameindex];
			$tempsname = $uploadcsva[$person_snameindex];
			$tempfname = str_replace("'", "", $tempfname);					
			$tempsname = str_replace("'", "", $tempsname);	
			foreach ($personnamea as $personelement) {				
				$pbits = explode('|',$personelement);
				if (($tempfname == $pbits[1])&&($tempsname == $pbits[2])) {
					if ($testorreal == "R") {
						Delete_Data('person',$pbits[0]);						
					}
					XH4("========= delete ======== ".$pbits[0]);						
				}
			}
		}
	}
	
	foreach ($records as $recordelement) {	
		$recordcount++;
		$upmessage = CSV_In_Filter($recordelement);
		$uploadcsva = explode("|",$upmessage);
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			$tempfname = strtolower($uploadcsva[$person_fnameindex]);
			$tempsname = strtolower($uploadcsva[$person_snameindex]);
			$tempsname = str_replace("'", "", $inmatchsname."999");
			$tempsname = str_replace(" ", "", $tempsname."999");
			$tempfname = str_replace("'", "", $inmatchfname."999");
			$tempfname = str_replace(" ", "", $tempfname."999");
			$fnamebits = str_split($tempfname);
			$snamebits = str_split($tempsname);				
			$newspace = "0";
			$n = "";
			while ($newspace == "0") {
				$newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
				$newperson_id = strtolower($newperson_id);
				$lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
				Check_Data("person",$lookupnewperson_id);
				if ($GLOBALS{'IOWARNING'} == "0") {
					if ($n == "") {
						$n = "1";
					} else { ++$n;
					}
				} else {
					$newspace = "1";
				}
			}	
			$hi = 0;
			foreach ($uploadcsva as $dataelement) {
				if ( $headera[$hi] != "" ) {
					if (strlen(strstr($headera[$hi],"person_"))>0) {
						$GLOBALS{$headera[$hi]} = utf8_encode($dataelement);
					}
				}
				$hi++;
			}
			
			$GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
			$randompassword = createRandomPassword();
			$GLOBALS{'person_password'} = XCrypt($randompassword,$lookupnewperson_id,"encrypt");
			$GLOBALS{'person_passwordclue'} = "Initial Password";
			$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'};
			$GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
			$GLOBALS{'person_locked'} = "";
			
			if ($testorreal == "R") {
				Write_Data('person',$lookupnewperson_id);				
			}
			XH4("========= write ======== ".$lookupnewperson_id);
		}		
	}
	
	XPTXT($updatecount." People Updated");
	XPTXT($addcount." People Added");
} else {
	XPTXTCOLOR($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");


?>



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
