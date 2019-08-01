<<<<<<< HEAD
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_pdfroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,globalroutines,highcharts,exporting,jqueryhighcharttable,report,reportgraphcapture,highcharttable,jqueryconfirm";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
$inkeyvaluelist = $_REQUEST['keyvaluelist'];
$thisselectionlogic = "";

Get_Data("mpdfreport",$inmpdfreport_id);

if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
	ini_set('max_execution_time', $GLOBALS{'mpdfreport_maxexecutiontime'});
}

$thisselectionlogic = "";
if ( $GLOBALS{'mpdfreport_selectionlogic'} != "" ) {
    $thisselectionlogic = $GLOBALS{'mpdfreport_selectionlogic'};
    $seltestina = explodeAND($GLOBALS{'mpdfreport_selectionlogic'});
    $seltestouta = Array();
    $ori="1";$fi = 0; // CHECK Compatibility with OR logic
    foreach ( $seltestina as $seltestin) {
        // XH1($seltestin);
        $fi++;
        $selbits = explodeCOMP($seltestin);
        // field,comp,value,format
        if (isset($_REQUEST["PF".$ori.$fi."_".$selbits[0]])) { 
            $selbits[2] = $_REQUEST["PF".$ori.$fi."_".$selbits[0]];
            // XH1($_REQUEST["PF".$ori.$fi."_".$selbits[0]]);
        }
        array_push($seltestouta, $selbits[0].ShowFormat($selbits[3]).$selbits[1].$selbits[2]);
    }
    $thisselectionlogic = rebuildAND($seltestouta);
}

XH2("Custom PDF - ".$GLOBALS{'mpdfreport_title'});
XPTXT("Custom PDF id - ".$inmpdfreport_id);
XPTXT("Keys Used - ".$inkeyvaluelist);
XHRCLASS('underline');

Report_MPDFREPORTWEBVIEW_Output( $inmpdfreport_id, $inkeyvaluelist, $thisselectionlogic );

Back_Navigator();
PageFooter("Default","Final");




=======
<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_reportroutines.php');
require_once('v1_pdfroutines.php');
require_once('MPDF/mpdf.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,globalroutines,highcharts,exporting,jqueryhighcharttable,report,reportgraphcapture,highcharttable,jqueryconfirm";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$inmpdfreport_id = $_REQUEST['mpdfreport_id'];
$inkeyvaluelist = $_REQUEST['keyvaluelist'];
$thisselectionlogic = "";

Get_Data("mpdfreport",$inmpdfreport_id);

if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
	ini_set('max_execution_time', $GLOBALS{'mpdfreport_maxexecutiontime'});
}

$thisselectionlogic = "";
if ( $GLOBALS{'mpdfreport_selectionlogic'} != "" ) {
    $thisselectionlogic = $GLOBALS{'mpdfreport_selectionlogic'};
    $seltestina = explodeAND($GLOBALS{'mpdfreport_selectionlogic'});
    $seltestouta = Array();
    $ori="1";$fi = 0; // CHECK Compatibility with OR logic
    foreach ( $seltestina as $seltestin) {
        // XH1($seltestin);
        $fi++;
        $selbits = explodeCOMP($seltestin);
        // field,comp,value,format
        if (isset($_REQUEST["PF".$ori.$fi."_".$selbits[0]])) { 
            $selbits[2] = $_REQUEST["PF".$ori.$fi."_".$selbits[0]];
            // XH1($_REQUEST["PF".$ori.$fi."_".$selbits[0]]);
        }
        array_push($seltestouta, $selbits[0].ShowFormat($selbits[3]).$selbits[1].$selbits[2]);
    }
    $thisselectionlogic = rebuildAND($seltestouta);
}

XH2("Custom PDF - ".$GLOBALS{'mpdfreport_title'});
XPTXT("Custom PDF id - ".$inmpdfreport_id);
XPTXT("Keys Used - ".$inkeyvaluelist);
XHRCLASS('underline');

Report_MPDFREPORTWEBVIEW_Output( $inmpdfreport_id, $inkeyvaluelist, $thisselectionlogic );

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
