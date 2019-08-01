 <?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_slim.php');

Get_Common_Parameters();
GlobalRoutine();

# print "Content-type: text/html\n\n";
print "<title>Finish</title>\n";
print "<head>\n";

print '<script language="javascript" type="text/javascript" src="'.$GLOBALS{'site_jsurl'}.'/v1_jquerymin.js"></script>'."\n";
// print '<script language="javascript" type="text/javascript" src="'.$GLOBALS{'site_tinymceurl'}.'/tinymce.min.js"></script>'."\n";
// print '<script language="javascript" type="text/javascript" src="'.$GLOBALS{'site_tinymceurl'}.'/jscripts/tiny_mce/tiny_mce_popup.js"></script>'."\n";
print '<script language="javascript" type="text/javascript" src="'.$GLOBALS{'site_jsurl'}.'/v1_tinymceslimreturnfromupload.js"></script>'."\n";

/*
 print '<script type="text/javascript" language="javascript">'."\n";
print '$("#FinishUpload").click(function() {'."\n";
print '	alert("click bound directly");'."\n";
print '});'."\n";
print '</script>'."\n";
*/
print "</head>\n";

$maxwidth = "";
$filesuffix = "";
$uploadto = $_REQUEST["TinyMCEUploadTo"];
$uploadid = $_REQUEST["TinyMCEUploadId"];
$uploadwidth = $_REQUEST["TinyMCEUploadWidth"];
$uploadheight = $_REQUEST["TinyMCEUploadHeight"];
$uploadfixedsize = $_REQUEST["TinyMCEUploadFixedSize"];

// XH1($uploadfixedsize);
if ( $uploadfixedsize != "" ) {
	$bits = explode("x",$uploadfixedsize);
	$maxwidth = $bits[0];
	// ../xxxxx/domain_media/Webpage_Home_126_0219_FixedSize_750x450.JPG
	$filesuffix = "_FixedSize_".$uploadfixedsize;
}

$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_media";
$fileprefix = $uploadto."_".$uploadid."_";
if ( $maxwidth == "" ) { $maxwidth = "800"; }	

if ($uploadto == "TemplateElement") {
	$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_style";
	$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style";
}
if ($uploadto == "FRS") {
	$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_frs";
	$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_frs";
}

$maxfilesize = "30000000";
$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG,bmp,BMP,wbmp,WBMP,mp4,MP4,m4v,M4V,swf,SWF,doc,DOC,docx,DOCX,pdf,PDF,xls,XLS,xlsx,XLSX";

$uploadstring = Upload_SlimFile("slim",$fileuploadpath,"",$aft,$maxfilesize,"","",$fileprefix,$maxwidth,$filesuffix);
# uploadname filepath filename allowedfiletypes maxsize add/update tempprefix prefix maxwidth filesuffix
# Return string - Error(1/0)|Message|filename|added/updated|filesize|width|height
// print("XXXXX - ".$uploadstring." - XXXXX");
$ubits = explode('|', $uploadstring);

if ($ubits[0] == "0") {

	XBR();
	// XPTXT($ubits[1]);
	XPTXTCOLOUR("Image successfully loaded. Now continue to place this on the page. (Press OK at next step)","green");
	$uploadurl = $uploadurldir."/".$ubits[2];
	XINHID("uploadURL",$uploadurl);
	// print "<form>";
	print '<input type="button" id="FinishUpload" value="Continue"><br><br>';

	// print '<div id="FinishUpload">Finish</div>';

	// print "</form>";
	$upbits = explode('.', $uploadurl);
	$tfiletype = end($upbits);
	if (($tfiletype == "jpg")||($tfiletype == "JPG")||
	($tfiletype == "jpeg")||($tfiletype == "JPEG")||
	($tfiletype == "gif")||($tfiletype == "GIF")||
	($tfiletype == "png")||($tfiletype == "PNG")||
	($tfiletype == "bmp")||($tfiletype == "BMP")
	) {
		XIMGFLEX($uploadurl);
	}
	if (($tfiletype == "wmv")||($tfiletype == "WMV")||
	($tfiletype == "mov")||($tfiletype == "MPEG")||
	($tfiletype == "avi")||($tfiletype == "AVI")||
	($tfiletype == "3gp")||($tfiletype == "3GP")||
	($tfiletype == "3g2")||($tfiletype == "3G2")||
	($tfiletype == "mp4")||($tfiletype == "MP4")||
	($tfiletype == "m4v")||($tfiletype == "M4V")||
	($tfiletype == "m2v")||($tfiletype == "M2V")
	) {
		# 	print YMOVIEOBJECT($uploadurl,"200","200");
	}
	if (($tfiletype == "swf")||($tfiletype == "SWF")||
	($tfiletype == "flv")||($tfiletype == "FLV")
	) {
		# 	print YFLASHOBJECT($uploadurl,"300","300");
	}
	if (($tfiletype == "dcr")||($tfiletype == "DCR")) {
		# 	print YSHOCKWAVEOBJECT($uploadurl,"300","300");
	}
} else {
	XBR();
	if ($ubits[1] == "Return Code:1") {
		$ubits[1] = "Uploaded file too large";
	}
	XPTXT($ubits[1]);

	print "<form>";
	XINHID("uploadURL","UPLOADERROR");
	print '<input type="button" value="Finish" onClick="FileBrowserDialogue.mySubmit();">';
	print "</form>";
}


?>