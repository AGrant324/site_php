<<<<<<< HEAD
<?php # ajaxdemologin.php

require_once('v1_globalroutines.php');
require_once('v1_globalparameters.php');
require_once('v1_ioroutines.php');

XPAGETOP();

XH1("Check that SQL is working OK");
// Validate the received userid and password:
$inuserid = ""; // Initialized value.
if (isset($_GET['Userid'])) { // Received by the page.
  $inuserid = $_GET['Userid']; 
}
$inpassword = ""; // Initialized value.
if (isset($_GET['Password'])) { // Received by the page.
  $inpasswpord = $_GET['Password']; 
}
XPTXT("Information requested for person_id-$inuserid  password-$inpasswpord");

$globaldbc = IODBCONNECT("contractorweb","localhost", "cwuser", "cwpassword");
Get_person($inuserid);
echo "<p><span class=\"name\">Name - $person_surname $person_firstname </span><br /><strong>password</strong>: $person_password <br /></p>\n";
IODBDISCONNECT($globaldbc);

# ------Set Variables -----------------------------------------------------------
$demolongstring = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam.";
$demoshortstring = "Lorem ipsum...";
# print_r ($yyyyarray); print_r ($yyarray); print_r ($yyyyhash);
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Text formatting"); XHR(); XBR();
XTXT("XTXT ".$demolongstring); XBR();
echo YTXT("YTXT ".$demolongstring); XBR();
XPTXT("XPTXT ".$demolongstring);
echo YPTXT("YPTXT ".$demolongstring);
XTEXTAREA("XTEXTAREA","5","20"); XTXT("XTEXTAREA ".$demolongstring); X_TEXTAREA(); XBR();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Header formatting"); XHR(); XBR();
XH1("XH1 Header");
XH2("XH2 Header");
XH3("XH3 Header");
XH4("XH4 Header");
XH5("XH5 Header");
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Table formatting"); XHR(); XBR();
XTABLE();
XTR(); XTHTXT("XTHTXT Header1");XTHTXT("XTHTXT Header2");XTHTXT("XTHTXT Header3");X_TR();
XTR(); XTDTXT("XTDTXT ".$demolongstring);XTDTXT("XTDTXT ".$demolongstring);XTDTXT("XTDTXT ".$demolongstring);X_TR();
X_TABLE();
XBR();
XTABLE();
XTR(); XTHTXTFIXED("XTHTXTFIXED","100"); XTHTXTFIXED("XTHTXTFIXED","150"); XTHTXTFIXED("XTHTXTFIXED","100"); X_TR();
XTR(); XTDTXTWIDTH("XTDTXTWIDTH 100 ".$demolongstring,"100"); XTDTXTWIDTH("XTDTXTWIDTH 150 ".$demolongstring,"150"); XTDTXTWIDTH("XTDTXTWIDTH 150 ".$demolongstring,"100"); X_TR();
X_TABLE();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Input Gathering - within Tables"); XHR(); XBR();
XTABLE();
XTR(); XTHTXT("Type"); XTHTXT("Format"); X_TR();
XTR(); XTDTXT("XTDINTXT"); XTDINTXT ("XTDINTXT",$demoshortstring,"15","30"); X_TR();
XTR(); XTDTXT("XTDINPSW"); XTDINPSW ("XTDINXTDINPSW",$demoshortstring,"15","30"); X_TR();
XTR(); XTDTXT("XTDINTEXTAREA"); XTDINTEXTAREA ("XTDINTXT",$demoshortstring,"5","20"); X_TR();
XTR(); XTDTXT("XTDINSELECTHASH"); XTDINSELECTHASH($monthhash,"XTDINSELECTHASH","04"); X_TR();

X_TABLE();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Input Gathering - outside Tables"); XHR(); XBR();
XTXT("Type-"); XTXT("Format"); XBR();
XTXT("XINTXT-"); XINTXT ("XINTXT",$demoshortstring,"15","30"); XBR();
# XTXT("XINPSW-"); XINPSW ("XINPSW",$demoshortstring,"15","30"); XBR();
XTXT("XINTEXTAREA-"); XINTEXTAREA ("XINTXT",$demoshortstring,"5","20"); XBR();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Navigation Tables"); XHR(); XBR();

# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("YUI examples"); XHR(); XBR();
XTABLE();
XTR(); XTHTXT("Date"); X_TR();
XTR(); XTDINDATEYYYY_MM_DD("Test01","2009-01-08"); X_TR();
XTR(); XTDINDATEYYYY_MM_DD("Test02","2009-02-08"); X_TR();
XTR(); XTDINDATEYYYY_MM_DD("Test03","2009-03-08"); X_TR();
X_TABLE();


XCLEARFLOAT();

XPAGETAIL();


?>

=======
<?php # ajaxdemologin.php

require_once('v1_globalroutines.php');
require_once('v1_globalparameters.php');
require_once('v1_ioroutines.php');

XPAGETOP();

XH1("Check that SQL is working OK");
// Validate the received userid and password:
$inuserid = ""; // Initialized value.
if (isset($_GET['Userid'])) { // Received by the page.
  $inuserid = $_GET['Userid']; 
}
$inpassword = ""; // Initialized value.
if (isset($_GET['Password'])) { // Received by the page.
  $inpasswpord = $_GET['Password']; 
}
XPTXT("Information requested for person_id-$inuserid  password-$inpasswpord");

$globaldbc = IODBCONNECT("contractorweb","localhost", "cwuser", "cwpassword");
Get_person($inuserid);
echo "<p><span class=\"name\">Name - $person_surname $person_firstname </span><br /><strong>password</strong>: $person_password <br /></p>\n";
IODBDISCONNECT($globaldbc);

# ------Set Variables -----------------------------------------------------------
$demolongstring = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam.";
$demoshortstring = "Lorem ipsum...";
# print_r ($yyyyarray); print_r ($yyarray); print_r ($yyyyhash);
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Text formatting"); XHR(); XBR();
XTXT("XTXT ".$demolongstring); XBR();
echo YTXT("YTXT ".$demolongstring); XBR();
XPTXT("XPTXT ".$demolongstring);
echo YPTXT("YPTXT ".$demolongstring);
XTEXTAREA("XTEXTAREA","5","20"); XTXT("XTEXTAREA ".$demolongstring); X_TEXTAREA(); XBR();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Header formatting"); XHR(); XBR();
XH1("XH1 Header");
XH2("XH2 Header");
XH3("XH3 Header");
XH4("XH4 Header");
XH5("XH5 Header");
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Table formatting"); XHR(); XBR();
XTABLE();
XTR(); XTHTXT("XTHTXT Header1");XTHTXT("XTHTXT Header2");XTHTXT("XTHTXT Header3");X_TR();
XTR(); XTDTXT("XTDTXT ".$demolongstring);XTDTXT("XTDTXT ".$demolongstring);XTDTXT("XTDTXT ".$demolongstring);X_TR();
X_TABLE();
XBR();
XTABLE();
XTR(); XTHTXTFIXED("XTHTXTFIXED","100"); XTHTXTFIXED("XTHTXTFIXED","150"); XTHTXTFIXED("XTHTXTFIXED","100"); X_TR();
XTR(); XTDTXTWIDTH("XTDTXTWIDTH 100 ".$demolongstring,"100"); XTDTXTWIDTH("XTDTXTWIDTH 150 ".$demolongstring,"150"); XTDTXTWIDTH("XTDTXTWIDTH 150 ".$demolongstring,"100"); X_TR();
X_TABLE();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Input Gathering - within Tables"); XHR(); XBR();
XTABLE();
XTR(); XTHTXT("Type"); XTHTXT("Format"); X_TR();
XTR(); XTDTXT("XTDINTXT"); XTDINTXT ("XTDINTXT",$demoshortstring,"15","30"); X_TR();
XTR(); XTDTXT("XTDINPSW"); XTDINPSW ("XTDINXTDINPSW",$demoshortstring,"15","30"); X_TR();
XTR(); XTDTXT("XTDINTEXTAREA"); XTDINTEXTAREA ("XTDINTXT",$demoshortstring,"5","20"); X_TR();
XTR(); XTDTXT("XTDINSELECTHASH"); XTDINSELECTHASH($monthhash,"XTDINSELECTHASH","04"); X_TR();

X_TABLE();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Input Gathering - outside Tables"); XHR(); XBR();
XTXT("Type-"); XTXT("Format"); XBR();
XTXT("XINTXT-"); XINTXT ("XINTXT",$demoshortstring,"15","30"); XBR();
# XTXT("XINPSW-"); XINPSW ("XINPSW",$demoshortstring,"15","30"); XBR();
XTXT("XINTEXTAREA-"); XINTEXTAREA ("XINTXT",$demoshortstring,"5","20"); XBR();
# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("Navigation Tables"); XHR(); XBR();

# ------------------------------------------------------------------------------
XBR(); XHR(); XTXT("YUI examples"); XHR(); XBR();
XTABLE();
XTR(); XTHTXT("Date"); X_TR();
XTR(); XTDINDATEYYYY_MM_DD("Test01","2009-01-08"); X_TR();
XTR(); XTDINDATEYYYY_MM_DD("Test02","2009-02-08"); X_TR();
XTR(); XTDINDATEYYYY_MM_DD("Test03","2009-03-08"); X_TR();
X_TABLE();


XCLEARFLOAT();

XPAGETAIL();


?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
