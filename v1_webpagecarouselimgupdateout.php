   <?php #bulletinboardeditin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_CAROUSELIMGUPDATE_CSSJS();
PageHeader("Default","Final");

Check_Session_Validity();
Back_Navigator();

$incarousel_name = $_REQUEST['carousel_name'];
$incarouselimg_id = $_REQUEST['carouselimg_id'];

Webpage_CAROUSELIMGUPDATE_Output($incarousel_name, $incarouselimg_id);

Back_Navigator();
PageFooter("Default","Final");

?>

