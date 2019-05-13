<?php # frsteamresultin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$intemplateelement_name = $_REQUEST['templateelement_name'];
if( is_array($_REQUEST['templateelement_templatelist'])) {
	# one of checkboxes selected
	$intemplateelement_templatelist = Array2List($_REQUEST['templateelement_templatelist']);
} else {
	$intemplateelement_templatelist  = "";
}
$intemplateelement_div = $_REQUEST['templateelement_div'];
$intemplateelement_position = $_REQUEST['templateelement_position'];
$intemplateelement_insettop = $_REQUEST['templateelement_insettop'];
$intemplateelement_insetleft = $_REQUEST['templateelement_insetleft'];
$intemplateelement_borderwidth = $_REQUEST['templateelement_borderwidth'];
$intemplateelement_bordercolor = $_REQUEST['templateelement_bordercolor'];
$intemplateelement_height = $_REQUEST['templateelement_height'];
$intemplateelement_width = $_REQUEST['templateelement_width'];
$intemplateelement_html = $_REQUEST['templateelement_html'];
$inpublish = $_REQUEST['publish'];

XH2("Template Element Editor - ".$intemplateelement_name);
$action = "updated";
Check_Data("templateelement",$intemplateelement_name);
if ($GLOBALS{'IOWARNING'} == "1") { Initialise_Data("templateelement"); $action = "added"; }

$GLOBALS{'templateelement_name'} = $intemplateelement_name;
$GLOBALS{'templateelement_templatelist'} = $intemplateelement_templatelist;
$GLOBALS{'templateelement_div'} = $intemplateelement_div;
$GLOBALS{'templateelement_position'} = $intemplateelement_position;
$GLOBALS{'templateelement_insettop'} = $intemplateelement_insettop;
$GLOBALS{'templateelement_insetleft'} = $intemplateelement_insetleft;
$GLOBALS{'templateelement_borderwidth'} = $intemplateelement_borderwidth;
$GLOBALS{'templateelement_bordercolor'} = $intemplateelement_bordercolor;
$GLOBALS{'templateelement_height'} = $intemplateelement_height;
$GLOBALS{'templateelement_width'} = $intemplateelement_width;
$GLOBALS{'templateelement_html'} = $intemplateelement_html;

Write_Data("templateelement",$intemplateelement_name);
XH4("Template Element Updated");

if ( $inpublish == "Yes" ) {
	XHR();
	XH4("You have requested that all templates are republished");
  	Webpage_TEMPLATEPUBLISHALL_Output();
  	Webpage_WEBPAGEPUBLISHALLSELECTED_Output( $GLOBALS{'templateelement_templatelist'} );
}

XBR();
$link = YPGMLINK("personloginselectin.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","TEMPLATEELEMENTUPDATELIST");
XLINKTXT($link,"return to webpage templateelement menu");
XBR();
$link = YPGMLINK("webpagetemplateelementupdateout.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("templateelement_name",$templateelement_name);
XLINKTXT($link,"make further updates to ths template element");
XBR();

XHR();
XH2("This is how the template element will appear");
XPTXT("Included in the following templates - ".$GLOBALS{'templateelement_templatelist'});
XTABLE();
XTR();XTDTXT("Div");XTDTXT($GLOBALS{'templateelement_div'});
XTR();XTDTXT("Position");XTDTXT($GLOBALS{'templateelement_position'});
XTR();XTDTXT("Inset Top");XTDTXT($GLOBALS{'templateelement_insettop'});
XTR();XTDTXT("Inset Left");XTDTXT($GLOBALS{'templateelement_insetleft'});
XTR();XTDTXT("Border Width");XTDTXT($GLOBALS{'templateelement_borderwidth'});
XTR();XTDTXT("Border Color");XTDTXT($GLOBALS{'templateelement_bordercolor'});
XTR();XTDTXT("Height");XTDTXT($GLOBALS{'templateelement_height'});
XTR();XTDTXT("Width");XTDTXT($GLOBALS{'templateelement_width'});
X_TABLE();
XBR();
XHR();
print("<br>".$GLOBALS{'templateelement_html'});

Back_Navigator();
PageFooter("Default","Final");


