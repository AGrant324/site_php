<?php # finallocatebank1.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


XH3("Financial Categories Upload");

$fincategorya = Get_Array('fincategory');
foreach ($fincategorya as $fincategoryid) {
 $firstchar = substr($fincategoryid, 0, 1);
 if ($firstchar == "F") { 
  print  $fincategoryid." - deleted<br>\n";  
  Delete_Data('fincategory',$fincategoryid);  
 }
}


$maxfilesize = "100000";
$continuewithupload  = "1";
# uploadname filepath filename allowdfiletypes maxsize add/update prefix
$uploadstring = Upload_File("FinCategoryFile",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"","text/csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
# Error(1/0)|Message|filename|filesize|width|height
$uploadstringa = explode("|",$uploadstring);
$uploadfilename = $uploadstringa[2];   
if ($uploadstringa[0] == "1") {
 XH5("Error:- Financial Categories not uploaded. - ".$uploadstring);
 $continuewithupload  == "0";
}  
if ($continuewithupload  == "1") {
 XH5("Financial Categories uploaded successfully.");
 $extranulls = array("","","","","","","","","","","","","","","","","","","","","","","");
 $records = Get_File_Array ($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$_FILES["FinCategoryFile"]["name"]);
 foreach ($records as $recordelement) {
  if ($recordelement != "") {	
   $upmessage = CSV_In_Filter($recordelement);
   $uploadcsv = explode("|",$upmessage);      		  	
   if ($uploadcsv[0] == "dataheader") {$dataheader = $uploadcsv;}
   if ($uploadcsv[0] == "datavalue") {$datavalue = $uploadcsv;}
   if (($uploadcsv[0] == "datarow")||($uploadcsv[0] == "datasubsection")) {
    Check_Data('fincategory',$uploadcsv[1]);    
    Initialise_Data('fincategory');  
    for ($uploadcsvindex=1; $uploadcsvindex<=sizeof($dataheader)-1; $uploadcsvindex++) {
     if ($dataheader[$uploadcsvindex] != "") {
      if ($uploadcsv[$uploadcsvindex] != "") {
       if ($datavalue[$uploadcsvindex] != "") {
        if ($GLOBALS{$dataheader[$uploadcsvindex]} == "") {$sep = "";} else {$sep = ",";} 
        $GLOBALS{$dataheader[$uploadcsvindex]} = $GLOBALS{$dataheader[$uploadcsvindex]}.$sep.$datavalue[$uploadcsvindex] ;
       } else {
        $GLOBALS{$dataheader[$uploadcsvindex]} = $uploadcsv[$uploadcsvindex];        
       }
      }
     }      
    }
    Write_Data('fincategory',$uploadcsv[1]);   
    print  $uploadcsv[1]." - updated<br>\n";       
   }
  }  
 }
}



Back_Navigator();
PageFooter("Default","Final");



?>


