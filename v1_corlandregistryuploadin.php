<<<<<<< HEAD
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

// print_r($fieldtytpehash);
$postcodea = Array();
$fieldindexa = Array();


$corsite_ida = Get_Array('corsite');
foreach ($corsite_ida as $corsite_id) { 
	Get_Data('corsite',$corsite_id,'Live');
	if ( $GLOBALS{'corsite_arkpostcode'} != "") {
		$postcodea[$GLOBALS{'corsite_arkpostcode'}] = $corsite_id;
	}
}

if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Land Registry Links Upload - ".$tortext);

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"landregistryupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/landregistryupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "Header" ) {;
			$hi = 0;
			foreach ($uploadcsva as $field) {			
				$fieldindexa[$field] = $hi;
				$hi++;
			}
			// print_r($fieldindexa);
		}
		
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			// XPTXT($upmessage);
			$corsite_arkpostcode = $uploadcsva[$fieldindexa['corsite_arkpostcode']];
	
			if (array_key_exists($corsite_arkpostcode, $postcodea)) { 	
				XPTXT("PostCode Found - ".$corsite_arkpostcode);
				$corsite_id = $postcodea[$corsite_arkpostcode];
				Get_Data('corsite',$corsite_id,'Live');
	 			$GLOBALS{'corsite_landregistrylink'} = $uploadcsva[$fieldindexa['corsite_landregistrylink']];
	 			$GLOBALS{'corsite_landregistrylink'} = str_replace('https:','',$GLOBALS{'corsite_landregistrylink'});
				if ($testorreal == "R") {
					Write_Data('corsite',$corsite_id,'Live');
				}
				XH4("========= updated site ======== ".$corsite_id." ".$GLOBALS{'corsite_site'});
			}	
			
		}
	
	}
} else {
	XPTXT($uploadmessage,"red");
}



?>



=======
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

// print_r($fieldtytpehash);
$postcodea = Array();
$fieldindexa = Array();


$corsite_ida = Get_Array('corsite');
foreach ($corsite_ida as $corsite_id) { 
	Get_Data('corsite',$corsite_id,'Live');
	if ( $GLOBALS{'corsite_arkpostcode'} != "") {
		$postcodea[$GLOBALS{'corsite_arkpostcode'}] = $corsite_id;
	}
}

if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("Land Registry Links Upload - ".$tortext);

$maxfilesize = "1000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"landregistryupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/landregistryupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	foreach ($records as $recordelement) {	
		$upmessage = CSV_In_Filter($recordelement);
		# end of the tidy up
		$uploadcsva = explode("|",$upmessage);
		if ( $uploadcsva[0] == "Header" ) {;
			$hi = 0;
			foreach ($uploadcsva as $field) {			
				$fieldindexa[$field] = $hi;
				$hi++;
			}
			// print_r($fieldindexa);
		}
		
		if (strlen(strstr($uploadcsva[0],"Data"))>0) {
			// XPTXT($upmessage);
			$corsite_arkpostcode = $uploadcsva[$fieldindexa['corsite_arkpostcode']];
	
			if (array_key_exists($corsite_arkpostcode, $postcodea)) { 	
				XPTXT("PostCode Found - ".$corsite_arkpostcode);
				$corsite_id = $postcodea[$corsite_arkpostcode];
				Get_Data('corsite',$corsite_id,'Live');
	 			$GLOBALS{'corsite_landregistrylink'} = $uploadcsva[$fieldindexa['corsite_landregistrylink']];
	 			$GLOBALS{'corsite_landregistrylink'} = str_replace('https:','',$GLOBALS{'corsite_landregistrylink'});
				if ($testorreal == "R") {
					Write_Data('corsite',$corsite_id,'Live');
				}
				XH4("========= updated site ======== ".$corsite_id." ".$GLOBALS{'corsite_site'});
			}	
			
		}
	
	}
} else {
	XPTXT($uploadmessage,"red");
}



?>



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
