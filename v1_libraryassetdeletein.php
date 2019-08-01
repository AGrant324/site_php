<<<<<<< HEAD
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_LIBRARYMAINTAIN_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inlibrarysection_id = $_REQUEST['LibrarySection'];
$asset_clubid = $_REQUEST['asset_clubid'];
$asset_code = $_REQUEST['asset_code'];
if ($asset_code != "") {
 Check_Data("asset",$asset_clubid,$asset_code);
 if ($GLOBALS{'IOWARNING'} == "0" ) {
     Delete_Data("asset",$asset_clubid,$asset_code);
     
     if ($GLOBALS{'asset_file'} != "") {
     	$assetfilename = $GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets/'.$GLOBALS{'asset_file'};
     	if (file_exists($assetfilename)) {
     		unlink($assetfilename);
     		XPTXTCOLOR($assetfilename." deleted","green");XBR();    		
     	} else {
     	    XPTXTCOLOR("Warning - ".$assetfilename." did not exist","orange");XBR();
     	}
     }
     XPTXTCOLOR('The library asset "'.$GLOBALS{'asset_title'}.'" has been successfully deleted',"green");
    } else {
        XPTXTCOLOR('Error: no asset code specified',"red");
    }
} else {
    XPTXTCOLOR('Error: Asset not found',"red");
}
Library_LIBRARYMAINTAIN_Output2($inlibrarysection_id,$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");
=======
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inlibrarysection_id = $_REQUEST['LibrarySection'];
$asset_clubid = $_REQUEST['asset_clubid'];
$asset_code = $_REQUEST['asset_code'];
if ($asset_code != "") {
 Check_Data("asset",$asset_clubid,$asset_code);
 if ($GLOBALS{'IOWARNING'} == "0" ) {
     Delete_Data("asset",$asset_clubid,$asset_code);
     
     if ($GLOBALS{'asset_file'} != "") {
     	$assetfilename = $GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets/'.$GLOBALS{'asset_file'};
     	if (file_exists($assetfilename)) {
     		unlink($assetfilename);
     		XPTXTCOLOR($assetfilename." deleted","green");XBR();    		
     	} else {
     	    XPTXTCOLOR("Warning - ".$assetfilename." did not exist","orange");XBR();
     	}
     }
     XPTXTCOLOR('The library asset "'.$GLOBALS{'asset_title'}.'" has been successfully deleted',"green");
    } else {
        XPTXTCOLOR('Error: no asset code specified',"red");
    }
} else {
    XPTXTCOLOR('Error: Asset not found',"red");
}
Library_LIBRARYMAINTAIN_Output2($inlibrarysection_id,$asset_clubid);

Back_Navigator();
PageFooter("Default","Final");
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
