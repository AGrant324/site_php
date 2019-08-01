<?php # personloginin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PopUpHeader();
Check_Session_Validity();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$changeperson_id = $_REQUEST['ActionPersonId'];
Get_Data("person",$changeperson_id);

Person_Form2Globals();
$GLOBALS{'person_activeplayer'} = $_REQUEST['person_activeplayer'];
$GLOBALS{'person_activeofficial'} = $_REQUEST['person_activeofficial'];
$GLOBALS{'person_lastupdate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}."-".$GLOBALS{'LOGIN_person_id'};
Write_Data("person",$changeperson_id);

XPTXTCOLOR("Updates Completed","green");
XPTXTCOLOR("Note that you will have to refresh working screen to see the effects of these updates","green");
Person_playoffupdate_Output($changeperson_id);
 
XINBUTTONCLOSEWINDOW("Close");
PopUpFooter();

?>


