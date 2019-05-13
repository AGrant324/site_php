   <?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$incarousel_name = $_REQUEST['carousel_name'];

Webpage_CAROUSELIMGUPDATELIST_Output($incarousel_name);

XBR();
XHR();
XBR();
$link = YPGMLINK("webpagecarouselpublish.php");
$link = $link.YPGMSTDPARMS().YPGMPARM("carousel_name",$incarousel_name);
XLINKTXT($link,"republish this carousel on the website");
XBR();

Back_Navigator();
PageFooter("Default","Final");

?>

