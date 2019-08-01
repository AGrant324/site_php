<?php # finuploadbankin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqueryslick,jqueryslicktheme";
$GLOBALS{'SITEJSOPTIONAL'} = "jqueryslick,slickslider";
PageHeader("Default","Final");
Back_Navigator();


XH2("Slick Slider Tester");

$reqdcategory = "Slick";
$imgsmalla = Array();
$imglargea = Array();

$advertisersa = Get_Array("advertiser");
$imgi = 0;
foreach ($advertisersa as $advertiser_name) {
    Get_Data("advertiser",$advertiser_name);
    if ($GLOBALS{'advertiser_category'} == $reqdcategory) {
        $imgi++;
        $imglargea[$imgi] = $GLOBALS{'advertiser_banner'};
        $imgsmalla[$imgi] = $GLOBALS{'advertiser_thumb'};         
    }
}

print '<div class="slider slider-for" style="width: 100%;" >'."\n";
foreach ($imglargea as $imglarge) { 
    print '<div>'."\n";
    $imgsrc = $GLOBALS{'domainwwwurl'}."/domain_advertisers/".$imglarge;
    XIMG($imgsrc, "100%","flex","");
    print '</div>'."\n";    
}
print '</div>'."\n"; 
XBR();
print '<div class="slider slider-nav">'."\n";
foreach ($imgsmalla as $imgsmall) {
    print '<div>'."\n";
    $imgsrc = $GLOBALS{'domainwwwurl'}."/domain_advertisers/".$imgsmall;
    XIMG($imgsrc, "200","200","");
    print '</div>'."\n";
}
print '</div>'."\n"; 

Back_Navigator();
PageFooter("Default","Final");

?>


