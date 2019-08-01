<<<<<<< HEAD
<?php # setupdownloadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();
$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/datadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
$GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);
Download_Instructions_Creator();
$derror = "0";

if((isset($_REQUEST['DownSelectSpecific'])&&$_REQUEST['DownSelectSpecific']!="")) {	
	$downloadrequestspecific = $_REQUEST["DownSelectSpecific"];
	$downloadrequest = Array($downloadrequestspecific);
} else {
	$downloadrequest = $_REQUEST["DownSelect"];	
}

if( count( $downloadrequest ) == 0 ) {
	$derror = "1"; print "<h5>No selection made</h5>\n";
} else {
	if (substr_count($downloadrequest[0], 'sel-all-') > 0) {	
		$tablearray = array();
		$q = 'SHOW TABLES';
		$r = mysqli_query($GLOBALS{'IOSQL'},$q);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				array_push($tablearray, $row[0]);
			}
		}
		foreach ($tablearray as $tablearrayelement) {
			Download_Data($tablearrayelement);
		}
	} else {	
		foreach ( $downloadrequest as $downloadrequestelement ) {
			if (substr_count($downloadrequestelement, 'sel-') > 0) {	
				$tablearray = array();
				$q = 'SHOW TABLES';
				$r = mysqli_query($GLOBALS{'IOSQL'},$q);
				if (mysqli_num_rows($r) > 0) { 
					 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
					  	array_push($tablearray, $row[0]); 
					 }
				}
				foreach ($tablearray as $tablearrayelement) {
					$selecttext = "sel-".$tablearrayelement."-";
					if (substr_count($downloadrequestelement, $selecttext) > 0) {
						Download_Data($tablearrayelement);
					}
				}
			}
		}
	}
}

Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

if ($derror == "0") {
	Download_File ($downloadfilename,"delete");
}

=======
<?php # setupdownloadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();
$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/datadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
$GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);
Download_Instructions_Creator();
$derror = "0";

if((isset($_REQUEST['DownSelectSpecific'])&&$_REQUEST['DownSelectSpecific']!="")) {	
	$downloadrequestspecific = $_REQUEST["DownSelectSpecific"];
	$downloadrequest = Array($downloadrequestspecific);
} else {
	$downloadrequest = $_REQUEST["DownSelect"];	
}

if( count( $downloadrequest ) == 0 ) {
	$derror = "1"; print "<h5>No selection made</h5>\n";
} else {
	if (substr_count($downloadrequest[0], 'sel-all-') > 0) {	
		$tablearray = array();
		$q = 'SHOW TABLES';
		$r = mysqli_query($GLOBALS{'IOSQL'},$q);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				array_push($tablearray, $row[0]);
			}
		}
		foreach ($tablearray as $tablearrayelement) {
			Download_Data($tablearrayelement);
		}
	} else {	
		foreach ( $downloadrequest as $downloadrequestelement ) {
			if (substr_count($downloadrequestelement, 'sel-') > 0) {	
				$tablearray = array();
				$q = 'SHOW TABLES';
				$r = mysqli_query($GLOBALS{'IOSQL'},$q);
				if (mysqli_num_rows($r) > 0) { 
					 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
					  	array_push($tablearray, $row[0]); 
					 }
				}
				foreach ($tablearray as $tablearrayelement) {
					$selecttext = "sel-".$tablearrayelement."-";
					if (substr_count($downloadrequestelement, $selecttext) > 0) {
						Download_Data($tablearrayelement);
					}
				}
			}
		}
	}
}

Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});

if ($derror == "0") {
	Download_File ($downloadfilename,"delete");
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>