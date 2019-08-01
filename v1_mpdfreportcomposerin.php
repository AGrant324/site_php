<<<<<<< HEAD
<?php 

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
$inmenulist = $_REQUEST['menulist'];
$inmpdfreport_title = $_REQUEST['mpdfreport_title'];
$inmpdfreport_description = $_REQUEST['mpdfreport_description'];
$inmpdfreport_primetable = $_REQUEST['mpdfreport_primetable'];
$inmpdfreport_uniquekeyreport = $_REQUEST['mpdfreport_uniquekeyreport'];
$inmpdfreport_listkeys = $_REQUEST['mpdfreport_listkeys'];
$inmpdfreport_listkeytitlefields = $_REQUEST['mpdfreport_listkeytitlefields'];
$inmpdfreport_listtestkeyvalues = $_REQUEST['mpdfreport_listtestkeyvalues'];
$inmpdfreport_selectionlogic = $_REQUEST['mpdfreport_selectionlogic'];
$inmpdfreport_maxselection = $_REQUEST['mpdfreport_maxselection'];
$inmpdfreport_maxexecutiontime = $_REQUEST['mpdfreport_maxexecutiontime'];
$inmpdfreport_php = $_REQUEST['mpdfreport_php'];
$inmpdfreport_userlevel = $_REQUEST['mpdfreport_userlevel'];
$inmpdfreport_personidlist = $_REQUEST['mpdfreport_personidlist'];
$inmpdfreport_visibilityfilter = $_REQUEST['mpdfreport_visibilityfilter'];
$inmpdfreport_fontsize = $_REQUEST['mpdfreport_fontsize'];
$inmpdfreport_pagelayout = $_REQUEST['mpdfreport_pagelayout'];
$inmpdfreport_pagemargins = $_REQUEST['mpdfreport_pagemargins'];
$inmpdfreport_dashboardfavourite = $_REQUEST['mpdfreport_dashboardfavourite'];
$inmpdfreport_favouriteicontext = $_REQUEST['mpdfreport_favouriteicontext'];
$inmpdfreport_csvdownloadable = $_REQUEST['mpdfreport_csvdownloadable'];

$action = "updated";
Check_Data("mpdfreport",$inmpdfreport_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("mpdfreport"); $action = "added"; }

$GLOBALS{'mpdfreport_id'} = $inmpdfreport_id;
$GLOBALS{'mpdfreport_title'} = $inmpdfreport_title;
$GLOBALS{'mpdfreport_description'} = $inmpdfreport_description;
$GLOBALS{'mpdfreport_primetable'} = $inmpdfreport_primetable;
$GLOBALS{'mpdfreport_uniquekeyreport'} = $inmpdfreport_uniquekeyreport;
$GLOBALS{'mpdfreport_listkeys'} = $inmpdfreport_listkeys;
$GLOBALS{'mpdfreport_listkeytitlefields'} = $inmpdfreport_listkeytitlefields;
$GLOBALS{'mpdfreport_listtestkeyvalues'} = $inmpdfreport_listtestkeyvalues;
$GLOBALS{'mpdfreport_selectionlogic'} = $inmpdfreport_selectionlogic;
$GLOBALS{'mpdfreport_maxselection'} = $inmpdfreport_maxselection;
$GLOBALS{'mpdfreport_maxexecutiontime'} = $inmpdfreport_maxexecutiontime;
$GLOBALS{'mpdfreport_php'} = $inmpdfreport_php;
$GLOBALS{'mpdfreport_userlevel'} = $inmpdfreport_userlevel;
$GLOBALS{'mpdfreport_personidlist'} = $inmpdfreport_personidlist;
$GLOBALS{'mpdfreport_visibilityfilter'} = $inmpdfreport_visibilityfilter;
$GLOBALS{'mpdfreport_fontsize'} = $inmpdfreport_fontsize;
$GLOBALS{'mpdfreport_pagelayout'} = $inmpdfreport_pagelayout;
$GLOBALS{'mpdfreport_pagemargins'} = $inmpdfreport_pagemargins;
$GLOBALS{'mpdfreport_dashboardfavourite'} = $inmpdfreport_dashboardfavourite;
$GLOBALS{'mpdfreport_favouriteicontext'} = $inmpdfreport_favouriteicontext;
$GLOBALS{'mpdfreport_csvdownloadable'} = $inmpdfreport_csvdownloadable;

Write_Data("mpdfreport",$inmpdfreport_id);

$GLOBALS{'IOERRORcode'} = "MPDF001";
$GLOBALS{'IOERRORmessage'} = "mpdf file write error";
$mpdfphpfile = Open_File_Write ($GLOBALS{'domainfilepath'}."/mpdfreports/".$inmpdfreport_id.".php");
Write_File ($mpdfphpfile,$GLOBALS{'mpdfreport_php'});
Close_File_Write($mpdfphpfile);

XPTXTCOLOR("MPDF Report - ".$inmpdfreport_id." ".$inmpdfreport_title." ".$action,"green");

if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
	Report_MPDFREPORTWEBVIEW_Output( $inmpdfreport_id, "TESTKEYS", "");
} else {
	if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
		$link = YPGMLINK("mpdfreportwebviewsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("keyvaluelist",$GLOBALS{'mpdfreport_listtestkeyvalues'});
		XLINKTXTNEWWINDOW($link,"set filters and then view this report in browser","browser_view");	
	} else {
		Report_MPDFREPORTWEBVIEW_Output( $inmpdfreport_id, "", $GLOBALS{'mpdfreport_selectionlogic'});
	}
}

XBR();
XHR();
XBR();
$link = YPGMLINK("mpdfreportcomposerout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("action","update");
XLINKTXT($link,"make further composer changes to this report");
XBR();

/*
if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
    $link = YPGMLINK("mpdfreportpdfdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id);
    XLINKTXTNEWWINDOW($link,"download this report as pdf","pdf_view");
    XBR();
} else {
    if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
        $link = YPGMLINK("mpdfreportpdfdownloadsetfilter.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("keyvaluelist",$GLOBALS{'mpdfreport_listtestkeyvalues'});
        XLINKTXTNEWWINDOW($link,"set filters and then download this report as pdf","pdf_view");
        XBR();
        $link = YPGMLINK("mpdfreportcsvdownloadsetfilter.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("keyvaluelist",$GLOBALS{'mpdfreport_listtestkeyvalues'});
        XLINKTXTNEWWINDOW($link,"set filters and then download this report as csv","pdf_view");
        XBR();
    } else {
        if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
            $link = YPGMLINK("mpdfreportcsvdownload.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
            XLINKTXTNEWWINDOW($link,"download this report as csv","csv_view");
            XBR();
        }
    }
}
*/

if ( $inmenulist == 'mpdfreportupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMPDFREPORTLIST");
	XLINKTXT($link,"show my custom pdf list");
}

Back_Navigator();
PageFooter("Default","Final");




=======
<?php 

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
$inmenulist = $_REQUEST['menulist'];
$inmpdfreport_title = $_REQUEST['mpdfreport_title'];
$inmpdfreport_description = $_REQUEST['mpdfreport_description'];
$inmpdfreport_primetable = $_REQUEST['mpdfreport_primetable'];
$inmpdfreport_uniquekeyreport = $_REQUEST['mpdfreport_uniquekeyreport'];
$inmpdfreport_listkeys = $_REQUEST['mpdfreport_listkeys'];
$inmpdfreport_listkeytitlefields = $_REQUEST['mpdfreport_listkeytitlefields'];
$inmpdfreport_listtestkeyvalues = $_REQUEST['mpdfreport_listtestkeyvalues'];
$inmpdfreport_selectionlogic = $_REQUEST['mpdfreport_selectionlogic'];
$inmpdfreport_maxselection = $_REQUEST['mpdfreport_maxselection'];
$inmpdfreport_maxexecutiontime = $_REQUEST['mpdfreport_maxexecutiontime'];
$inmpdfreport_php = $_REQUEST['mpdfreport_php'];
$inmpdfreport_userlevel = $_REQUEST['mpdfreport_userlevel'];
$inmpdfreport_personidlist = $_REQUEST['mpdfreport_personidlist'];
$inmpdfreport_visibilityfilter = $_REQUEST['mpdfreport_visibilityfilter'];
$inmpdfreport_fontsize = $_REQUEST['mpdfreport_fontsize'];
$inmpdfreport_pagelayout = $_REQUEST['mpdfreport_pagelayout'];
$inmpdfreport_pagemargins = $_REQUEST['mpdfreport_pagemargins'];
$inmpdfreport_dashboardfavourite = $_REQUEST['mpdfreport_dashboardfavourite'];
$inmpdfreport_favouriteicontext = $_REQUEST['mpdfreport_favouriteicontext'];
$inmpdfreport_csvdownloadable = $_REQUEST['mpdfreport_csvdownloadable'];

$action = "updated";
Check_Data("mpdfreport",$inmpdfreport_id);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("mpdfreport"); $action = "added"; }

$GLOBALS{'mpdfreport_id'} = $inmpdfreport_id;
$GLOBALS{'mpdfreport_title'} = $inmpdfreport_title;
$GLOBALS{'mpdfreport_description'} = $inmpdfreport_description;
$GLOBALS{'mpdfreport_primetable'} = $inmpdfreport_primetable;
$GLOBALS{'mpdfreport_uniquekeyreport'} = $inmpdfreport_uniquekeyreport;
$GLOBALS{'mpdfreport_listkeys'} = $inmpdfreport_listkeys;
$GLOBALS{'mpdfreport_listkeytitlefields'} = $inmpdfreport_listkeytitlefields;
$GLOBALS{'mpdfreport_listtestkeyvalues'} = $inmpdfreport_listtestkeyvalues;
$GLOBALS{'mpdfreport_selectionlogic'} = $inmpdfreport_selectionlogic;
$GLOBALS{'mpdfreport_maxselection'} = $inmpdfreport_maxselection;
$GLOBALS{'mpdfreport_maxexecutiontime'} = $inmpdfreport_maxexecutiontime;
$GLOBALS{'mpdfreport_php'} = $inmpdfreport_php;
$GLOBALS{'mpdfreport_userlevel'} = $inmpdfreport_userlevel;
$GLOBALS{'mpdfreport_personidlist'} = $inmpdfreport_personidlist;
$GLOBALS{'mpdfreport_visibilityfilter'} = $inmpdfreport_visibilityfilter;
$GLOBALS{'mpdfreport_fontsize'} = $inmpdfreport_fontsize;
$GLOBALS{'mpdfreport_pagelayout'} = $inmpdfreport_pagelayout;
$GLOBALS{'mpdfreport_pagemargins'} = $inmpdfreport_pagemargins;
$GLOBALS{'mpdfreport_dashboardfavourite'} = $inmpdfreport_dashboardfavourite;
$GLOBALS{'mpdfreport_favouriteicontext'} = $inmpdfreport_favouriteicontext;
$GLOBALS{'mpdfreport_csvdownloadable'} = $inmpdfreport_csvdownloadable;

Write_Data("mpdfreport",$inmpdfreport_id);

$GLOBALS{'IOERRORcode'} = "MPDF001";
$GLOBALS{'IOERRORmessage'} = "mpdf file write error";
$mpdfphpfile = Open_File_Write ($GLOBALS{'domainfilepath'}."/mpdfreports/".$inmpdfreport_id.".php");
Write_File ($mpdfphpfile,$GLOBALS{'mpdfreport_php'});
Close_File_Write($mpdfphpfile);

XPTXTCOLOR("MPDF Report - ".$inmpdfreport_id." ".$inmpdfreport_title." ".$action,"green");

if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
	Report_MPDFREPORTWEBVIEW_Output( $inmpdfreport_id, "TESTKEYS", "");
} else {
	if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
		$link = YPGMLINK("mpdfreportwebviewsetfilter.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("keyvaluelist",$GLOBALS{'mpdfreport_listtestkeyvalues'});
		XLINKTXTNEWWINDOW($link,"set filters and then view this report in browser","browser_view");	
	} else {
		Report_MPDFREPORTWEBVIEW_Output( $inmpdfreport_id, "", $GLOBALS{'mpdfreport_selectionlogic'});
	}
}

XBR();
XHR();
XBR();
$link = YPGMLINK("mpdfreportcomposerout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("action","update");
XLINKTXT($link,"make further composer changes to this report");
XBR();

/*
if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
    $link = YPGMLINK("mpdfreportpdfdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id);
    XLINKTXTNEWWINDOW($link,"download this report as pdf","pdf_view");
    XBR();
} else {
    if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
        $link = YPGMLINK("mpdfreportpdfdownloadsetfilter.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("keyvaluelist",$GLOBALS{'mpdfreport_listtestkeyvalues'});
        XLINKTXTNEWWINDOW($link,"set filters and then download this report as pdf","pdf_view");
        XBR();
        $link = YPGMLINK("mpdfreportcsvdownloadsetfilter.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$inmpdfreport_id).YPGMPARM("keyvaluelist",$GLOBALS{'mpdfreport_listtestkeyvalues'});
        XLINKTXTNEWWINDOW($link,"set filters and then download this report as csv","pdf_view");
        XBR();
    } else {
        if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
            $link = YPGMLINK("mpdfreportcsvdownload.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
            XLINKTXTNEWWINDOW($link,"download this report as csv","csv_view");
            XBR();
        }
    }
}
*/

if ( $inmenulist == 'mpdfreportupdatelist' ) {
	$link = YPGMLINK("personloginselectin.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMPDFREPORTLIST");
	XLINKTXT($link,"show my custom pdf list");
}

Back_Navigator();
PageFooter("Default","Final");




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
