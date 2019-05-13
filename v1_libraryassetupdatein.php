<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_ASSET_CSSJS();
PageHeader("Default","Final");
Back_Navigator();
Check_Session_Validity();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$acd = $_REQUEST['ACD'];
$inlibrarysection_id = $_REQUEST['LibrarySection'];
$inasset_clubid = $_REQUEST['asset_clubid'];
$inasset_code = $_REQUEST['asset_code'];
$inasset_title = $_REQUEST["asset_title"];
$inasset_description = $_REQUEST["asset_description"];
$inasset_librarysection = $_REQUEST['AssetLibrarySection'];
$inasset_link = $_REQUEST["asset_link"];
$inasset_author = $_REQUEST["asset_author"];
$inasset_createdate = $_REQUEST["asset_createdate_YYYYpart"].'-'.$_REQUEST["asset_createdate_MMpart"].'-'.$_REQUEST["asset_createdate_DDpart"];  
$inasset_reviewdate = $_REQUEST["asset_reviewdate_YYYYpart"].'-'.$_REQUEST["asset_reviewdate_MMpart"].'-'.$_REQUEST["asset_reviewdate_DDpart"];
$inasset_submitter = $_REQUEST["asset_submitter"];
$inasset_security = $_REQUEST["asset_security"];

// XH1($inlibrarysection_id." ".$inasset_clubid." ".$inasset_code);

if ((strlen(strstr($inasset_code,'&'))>0)||(strlen(strstr($inasset_code,'.'))>0)) {	
  print"<P>Error - special characters not allowed in name\n";
  Library_LIBRARYMAINTAIN_Output2($inlibrarysection_id,$inasset_clubid);
} else {
  if ($acd == "A1") {
    Initialise_Data("asset");
    Library_ASSET_Output($inlibrarysection_id,$inasset_clubid,$inasset_code,"A1");
  }
  if ($acd == "A2") {
    Initialise_Data("asset");
    $inasset_code = $GLOBALS{'currenttimestampunique'};
    $GLOBALS{'asset_submitter'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
    if ($inasset_title != "") { $GLOBALS{'asset_title'} = $inasset_title; }
	if ($inasset_description != "") { $GLOBALS{'asset_description'} = $inasset_description; }
	if ($inasset_librarysection != "") { $GLOBALS{'asset_librarysection'} = $inasset_librarysection; }
	if ($inasset_link == "") {
		$fileuploadpath = $GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets';
		$maxfilesize = "30000000";
		$continuewithupload  == "1";
		# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix - returns string - Error(1/0)|Message|filename|filesize|width|height
		$uploadstring = Upload_File("asset_file",$fileuploadpath,"","all",$maxfilesize,"","","","");
		$uploadstringa = explode("|",$uploadstring);
		$uploadfilename = $uploadstringa[2];
		if ($uploadstringa[0] == "1") {
		 	XH5("Warning:- File not uploaded. - ".$uploadstring);
		} else {
		 	$GLOBALS{'asset_file'} = $uploadfilename;	
		}
		$GLOBALS{'asset_link'} = "";
	}	
	if ($inasset_link != "") { $GLOBALS{'asset_link'} = $inasset_link; $GLOBALS{'asset_file'} = ""; }
	if ($inasset_author != "") { $GLOBALS{'asset_author'} = $inasset_author; }
	if ($inasset_submitter != "") { $GLOBALS{'asset_submitter'} = $inasset_submitter; }
	if ($inasset_security != "") { $GLOBALS{'asset_security'} = $inasset_security; }
	if ($inasset_createdate != "") { $GLOBALS{'asset_createdate'} = $inasset_createdate; }
	if ($inasset_reviewdate != "") { $GLOBALS{'asset_reviewdate'} = $inasset_reviewdate; }
	Write_Data("asset",$inasset_clubid,$inasset_code); 
	Library_ASSET_Output($GLOBALS{'asset_librarysection'},$inasset_clubid,$inasset_code,"A2");
  }  
  if ($acd == "C") {
	if ($inasset_code != "") {
	    Get_Data("asset",$inasset_clubid,$inasset_code);
	  	if ($inasset_title != "") { $GLOBALS{'asset_title'} = $inasset_title; }
		if ($inasset_description != "") { $GLOBALS{'asset_description'} = $inasset_description; }
		if ($inasset_librarysection != "") { $GLOBALS{'asset_librarysection'} = $inasset_librarysection; }
		if ($inasset_link == "") {		
			 $fileuploadpath = $GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets';
			 $maxfilesize = "30000000";
			 $continuewithupload  == "1";
			 # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix - returns string - Error(1/0)|Message|filename|filesize|width|height
			 $uploadstring = Upload_File("asset_file",$fileuploadpath,"","all",$maxfilesize,"","","","");
			 $uploadstringa = explode("|",$uploadstring);
			 $uploadfilename = $uploadstringa[2];
			 if ($uploadstringa[0] == "1") {
			 	XH5("Warning:- File not uploaded. - ".$uploadstring);
			 } else {
			 	$GLOBALS{'asset_file'} = $uploadfilename;	
			 }
			 $GLOBALS{'asset_link'} = "";
		} 
		if ($inasset_link != "") { $GLOBALS{'asset_link'} = $inasset_link; $GLOBALS{'asset_file'} = ""; } 
		if ($inasset_author != "") { $GLOBALS{'asset_author'} = $inasset_author; }
		if ($inasset_submitter != "") { $GLOBALS{'asset_submitter'} = $inasset_submitter; }
		if ($inasset_security != "") { $GLOBALS{'asset_security'} = $inasset_security; }
		if ($inasset_createdate != "") { $GLOBALS{'asset_createdate'} = $inasset_createdate; }
		if ($inasset_reviewdate != "") { $GLOBALS{'asset_reviewdate'} = $inasset_reviewdate; }
		Write_Data("asset",$inasset_clubid,$inasset_code);
	    $nextacd = "C";    
	    Library_ASSET_Output($GLOBALS{'asset_librarysection'},$inasset_clubid,$inasset_code,"C");
	}
  }
  if ($acd == "D") {
  	if ($inasset_code != "") {
  	 Get_Data("asset",$inasset_clubid,$inasset_code);  		
  	 Library_LIBRARYMAINTAINDELETE_Output($GLOBALS{'asset_librarysection'},$inasset_clubid,$inasset_code );
  	}
  }
}

Back_Navigator();
PageFooter("Default","Final");

