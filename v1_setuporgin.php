<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Setup_ORG_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$formseq = 1;

while ($formseq != 100) {
 $inorg_title = $_REQUEST["OrgTitle".$formseq];
 $inorg_personid = $_REQUEST["OrgPersonId".$formseq];
 $inorg_section = $_REQUEST["OrgSection".$formseq];
 $inorg_contactvisible = $_REQUEST["OrgContactVisible".$formseq];
 $inorg_sequence = $_REQUEST["OrgSequence".$formseq];
 $acd = $_REQUEST["ACD".$formseq];
 if ($acd == "A") {
   if ($inorg_title != "") {
     $torg_code = $inorg_section.$inorg_title.$GLOBALS{'acthh'}.$GLOBALS{'mm'}.$GLOBALS{'actss'};
     $GLOBALS{'org_code'} = Remove_NonAplha($torg_code);        	
     $GLOBALS{'org_title'} = $inorg_title;
     $GLOBALS{'org_personid'} = $inorg_personid;
     $GLOBALS{'org_section'} = $inorg_section;
     $GLOBALS{'org_contactvisible'} = $inorg_contactvisible;
     $GLOBALS{'org_sequence'} = $inorg_sequence;
     Write_Data("org",$GLOBALS{'org_code'});
   }      
 }
 if ($acd == "C") {
     $GLOBALS{'org_code'} = $_REQUEST["OrgCode".$formseq];
     Get_Data("org",$GLOBALS{'org_code'});
     $GLOBALS{'org_title'} = $inorg_title;
     $GLOBALS{'org_personid'} = $inorg_personid;
     $GLOBALS{'org_section'} = $inorg_section;
     $GLOBALS{'org_contactvisible'} = $inorg_contactvisible;
     $GLOBALS{'org_sequence'} = $inorg_sequence;    
     Write_Data("org",$GLOBALS{'org_code'});
   }
 if ($acd == "D") {
     $GLOBALS{'org_code'} = $_REQUEST["OrgCode".$formseq];
     Delete_Data("org",$GLOBALS{'org_code'});
 }
 $formseq++;
}

Setup_ORG_Output();


Back_Navigator();
PageFooter("Default","Final");

?>

