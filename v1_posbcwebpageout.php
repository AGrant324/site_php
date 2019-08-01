<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_posroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'TINYMCEJSOPTIONAL'} = "tinymce";
$GLOBALS{'SITEJSOPTIONAL'} = "tinymcecallupload,tinymceinit";
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inbcwebpage = $_REQUEST["BCWebPage"];
XH2($inbcwebpage." insert");
Get_Data('bcaccess','pos');
if ($inbcwebpage == "Homepage") {
	$dirurl = $GLOBALS{'bcaccess_homepagefolderurl'};	
	$filename = "homepageinsert.html";	
}
if ($inbcwebpage == "Stockpage") {
	$dirurl = $GLOBALS{'bcaccess_stockpagesfolderurl'};
	$filename = "stockpageinsert.html";
}
$user = $GLOBALS{'bcaccess_webdavuser'};
$password = $GLOBALS{'bcaccess_webdavpassword'};
$bcwebpagea = WebDav_Download_File_Array ($dirurl, $filename, $user, $password);
$totalstring = "";
foreach ($bcwebpagea as $element) {
	$totalstring = $totalstring.$element;
}
XH5("Existing View");
print '<table border="1">';
XTR();
XTD();
print $totalstring;
X_TD();
X_TR();
X_TABLE();
XH5("Edit Page Insert");	
XFORM("posbcwebpagein.php","BCWebPage");
XINSTDHID();
XINHID("BCWebPage",$inbcwebpage);
print '<textarea name="UpdateHTML" class="mceEditor" >'.$totalstring.'</textarea>';
XBR();
XINSUBMIT("Save");
X_FORM();

Back_Navigator();
PageFooter("Default","Final");

?>


