<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Report_MASSUPDATEFORM_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmassupdate_id = $_REQUEST['massupdate_id'];
$thisselectionlogic = "";
Get_Data("massupdate",$inmassupdate_id);

if ( $GLOBALS{'massupdate_selectionlogic'} != "" ) {
	$thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'};
	$seltestina = explodeAND($GLOBALS{'massupdate_selectionlogic'});
	$seltestouta = Array();
	foreach ( $seltestina as $seltestin) {
		$selbits = explodeCOMP($seltestin);
		if (isset($_REQUEST[$selbits[0]])) {
			$selbits[2] = $_REQUEST[$selbits[0]];
		}
		array_push($seltestouta, $selbits[0].$selbits[1].$selbits[2]);
	}
}
$thisselectionlogic = rebuildAND($seltestouta);

XH2("Mass Update Form - ".$inmassupdate_id." - ".$GLOBALS{'massupdate_title'});

Report_MASSUPDATEFORM_Output( $inmassupdate_id, $thisselectionlogic );

Back_Navigator();
PageFooter("Default","Final");




=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Report_MASSUPDATEFORM_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmassupdate_id = $_REQUEST['massupdate_id'];
$thisselectionlogic = "";
Get_Data("massupdate",$inmassupdate_id);

if ( $GLOBALS{'massupdate_selectionlogic'} != "" ) {
	$thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'};
	$seltestina = explodeAND($GLOBALS{'massupdate_selectionlogic'});
	$seltestouta = Array();
	foreach ( $seltestina as $seltestin) {
		$selbits = explodeCOMP($seltestin);
		if (isset($_REQUEST[$selbits[0]])) {
			$selbits[2] = $_REQUEST[$selbits[0]];
		}
		array_push($seltestouta, $selbits[0].$selbits[1].$selbits[2]);
	}
}
$thisselectionlogic = rebuildAND($seltestouta);

XH2("Mass Update Form - ".$inmassupdate_id." - ".$GLOBALS{'massupdate_title'});

Report_MASSUPDATEFORM_Output( $inmassupdate_id, $thisselectionlogic );

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
