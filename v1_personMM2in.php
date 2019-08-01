<?php # personAMin.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Person_Mass_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$massupdateselect = $_REQUEST['MassUpdateSelect'];
$section = $_REQUEST['Section'];
$formseq = 1;
while ($formseq <= ($GLOBALS{'personbite'})) {
 $acd = $_REQUEST['ACD'.$formseq];
 if ($acd == "C") {
  $chgperson_id = $_REQUEST['ActionPersonId'.$formseq];
  Check_Data("person",$chgperson_id);
  if ($GLOBALS{'IOWARNING'} == "0") {	
   if (strlen(strstr($massupdateselect,"NAME"))>0) {   	
    $GLOBALS{'person_title'} = $_REQUEST['PersonTitle'.$formseq];
    $GLOBALS{'person_sname'} = $_REQUEST['PersonSName'.$formseq];
    $GLOBALS{'person_midinits'} = $_REQUEST['PersonMidInits'.$formseq];
    $GLOBALS{'person_fname'} = $_REQUEST['PersonFName'.$formseq];
   }
   	if (strlen(strstr($massupdateselect,"ADDRESS"))>0) {   	 	
    $GLOBALS{'person_addr1'} = $_REQUEST['PersonAddr1'.$formseq];
    $GLOBALS{'person_addr2'} = $_REQUEST['PersonAddr2'.$formseq];
    $GLOBALS{'person_addr3'} = $_REQUEST['PersonAddr3'.$formseq];
    $GLOBALS{'person_addr4'} = $_REQUEST['PersonAddr4'.$formseq];
    $GLOBALS{'person_postcode'} = $_REQUEST['PersonPostCode'.$formseq];
   }
   if (strlen(strstr($massupdateselect,"PHONEEMAIL"))>0) {   	 
    $GLOBALS{'person_hometel'} = $_REQUEST['PersonHomeTel'.$formseq];;
    $GLOBALS{'person_worktel'} = $_REQUEST['PersonWorkTel'.$formseq];
    $GLOBALS{'person_mobiletel'} = $_REQUEST['PersonMobileTel'.$formseq];
    $GLOBALS{'person_faxtel'} = $_REQUEST['PersonFaxTel'.$formseq];
    $GLOBALS{'person_email1'} = $_REQUEST['PersonEmail'.$formseq];
    $GLOBALS{'person_email2'} = $_REQUEST['PersonSecEmail'.$formseq];
    $GLOBALS{'person_twitterusername'} = $_REQUEST['PersonTwitterUserName'.$formseq];   
#    $GLOBALS{'person_facebookusername'} = $_REQUEST['PersonFacebookUserName'.$formseq];   
   }
   if (strlen(strstr($massupdateselect,"DIR"))>0) {   	
    $GLOBALS{'person_exdirectory'} = $_REQUEST['PersonExDirectory'.$formseq];
    $GLOBALS{'person_dob'} = $_REQUEST['PersonDOB'.$formseq];
    $GLOBALS{'person_occupation'} = $_REQUEST['PersonOccupation'.$formseq];
   }
   if (strlen(strstr($massupdateselect,"MEMB"))>0) {   	
    $inperson_section = ""; $s = "";
    foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","") as $tsection_name) {    	
     $tinperson_sectionelement = $_REQUEST['PersonSection'.$formseq."_".$tsection_name];
     if ($tinperson_sectionelement != "") {$inperson_section=$inperson_section.$s.$tinperson_sectionelement; $s=",";}
    }
    $GLOBALS{'person_section'} = $inperson_section; 
    $GLOBALS{'person_type'} = $_REQUEST['PersonType'.$formseq];
    $GLOBALS{'person_paid'} = $_REQUEST['PersonPaid'.$formseq];
   }
   if (strlen(strstr($massupdateselect,"PLAYOFF"))>0) {   	
    $GLOBALS{'person_playersquad'} = $_REQUEST['PersonSquad'.$formseq];
    $GLOBALS{'person_position'} = $_REQUEST['PersonPosition'.$formseq];
    $GLOBALS{'person_shirtnumber'} = $_REQUEST['PersonShirtnumber'.$formseq];
    $GLOBALS{'person_activeplayer'} = $_REQUEST['PersonActivePlayer'.$formseq];
    $GLOBALS{'person_activeofficial'} = $_REQUEST['PersonActiveOfficial'.$formseq];
   }
   if (strlen(strstr($massupdateselect,"QUALIFICATIONS"))>0) {	   
#    $inperson_qualificationid = ""; $s = "";
#    foreach $tqualificationid (Get_Array_Hash_SortSelect("qualification","qualification_id","","")) {
#     $tinperson_qualificationidelement = $_REQUEST['PersonQualificationid".$formseq."_".$tqualificationid];
#     if ($tinperson_qualificationidelement ne "") {$inperson_qualificationid=$inperson_qualificationid.$s.$tinperson_qualificationidelement; $s=",";}
 #   }
    $GLOBALS{'person_qualificationid'} = $inperson_qualificationid; 
    $GLOBALS{'person_qualificationotherdescription'} = $_REQUEST['PersonQualificationotherdescription'.$formseq];
    $GLOBALS{'person_qualificationdate'} = $_REQUEST['PersonQualificationdate'.$formseq];
    $GLOBALS{'person_canyouhelp'} = $_REQUEST['PersonCanyouhelp'.$formseq];
    $GLOBALS{'person_crbcheck'} = $_REQUEST['PersonCrbcheck'.$formseq];
    $GLOBALS{'person_crbcheckdate'} = $_REQUEST['PersonCrbcheckdate'.$formseq];
   }   
   if (strlen(strstr($massupdateselect,"EXTRA"))>0) {   	
    for ( $ix = 0; $ix < 10; $ix++) {
     $GLOBALS{'person_extra'.$ix} = $_REQUEST['PersonExtra'.$ix.$formseq];
    }
   }
   $GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};	   
   Write_Data("person",$chgperson_id);
  }    
 }
 ++$formseq;
}

$marker = $_REQUEST['FormMarker'];
$minmarker = $_REQUEST['FormMinMarker'];
$maxmarker = $_REQUEST['FormMaxMarker'];
$markerdelta = $_REQUEST['Navigator'];
if ($markerdelta == "-1") {
  $marker = $marker - 1;
  if (($marker*-1) > ($minmarker*-1)) {
    $marker = $minmarker;
  }
}
if ($markerdelta == "+1") {
  $marker = $marker +1;
  if ($marker > $maxmarker) {
    $marker = $maxmarker;
  }
}

Person_Mass_Output();
Back_Navigator();
PageFooter("Default","Final");
?>
