<<<<<<< HEAD
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_webpageroutines.php";

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

// ===== save original parameters to originals for navigator & footer ====
$orig_domain_id = $GLOBALS{'LOGIN_domain_id'};
$orig_mode_id = $GLOBALS{'LOGIN_mode_id'};
$orig_person_id = $GLOBALS{'LOGIN_person_id'};
$orig_session_id = $GLOBALS{'LOGIN_session_id'};
$orig_loginmode_id = $GLOBALS{'LOGIN_loginmode_id'};

$inaccount_id = $_REQUEST['account_id'];
$indomain_longname = $_REQUEST['domain_longname'];
$indomain_shortname = $_REQUEST['domain_shortname'];
$indomain_themeid = "";
if (isset($_REQUEST['domain_themeid'])) { $indomain_themeid = $_REQUEST['domain_themeid']; }
$indomain_sportid = "";
if (isset($_REQUEST['domain_sportid'])) { $indomain_sportid = $_REQUEST['domain_sportid']; }

XH1($indomain_themeid." ".$indomain_longname." ".$indomain_shortname);

// ==== read the site related database records ===============
Get_Data("site_".$GLOBALS{'LOGIN_service_id'});
Get_Data('account_'.$inaccount_id);
if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
else { $serviceid = $GLOBALS{'LOGIN_service_id'}; } 
Get_Data("service_".$serviceid."DOMAIN");

// ===== from this point on parameters relate to domain not site ====
$GLOBALS{'LOGIN_domain_id'} = $indomain_shortname;
$GLOBALS{'LOGIN_mode_id'} = "2";
$tperson_fname = strtolower($GLOBALS{'account_contactfname'});
$tperson_sname = strtolower($GLOBALS{'account_contactsname'});
$fnamebits = str_split($tperson_fname);
$snamebits = str_split($tperson_sname);
$GLOBALS{'LOGIN_person_id'} = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2];
// $GLOBALS{'LOGIN_session_id'} = $orig_session_id;
$GLOBALS{'LOGIN_loginmode_id'} = "2";

if ($GLOBALS{'site_extradirectory'} == "") {$slashplusurlrootdirectory = "";}
else {$slashplusurlrootdirectory = "/".$GLOBALS{'site_extradirectory'};}  

$GLOBALS{'domain_actualurl'} = "";
if ($GLOBALS{'domain_actualurl'} == "") {  $GLOBALS{'domainwwwurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'account_shortname'}; }
else { $GLOBALS{'domainwwwurl'} = "//".$GLOBALS{'domain_actualurl'}; }


$GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'account_shortname'};
$GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'}."/".$GLOBALS{'account_shortname'};
$GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'account_shortname'}; 

Initialise_Data('person');
$randompassword = "Gem1n1";
$GLOBALS{'person_id'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'person_fname'} = $GLOBALS{'account_contactfname'};
$GLOBALS{'person_sname'} = $GLOBALS{'account_contactsname'};
$GLOBALS{'person_password'} = XCrypt($randompassword,$GLOBALS{'LOGIN_person_id'},"encrypt");
$GLOBALS{'person_passwordclue'} = "Initial Setup";
$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}; 
$GLOBALS{'person_menuitem'} = $GLOBALS{'LOGIN_domain_id'}; 
Write_Data("person",$GLOBALS{'LOGIN_person_id'});

$GLOBALS{'domain_id'} = $GLOBALS{'account_id'};
$GLOBALS{'domain_longname'} = $indomain_longname;
$GLOBALS{'domain_shortname'} = $indomain_shortname;
$GLOBALS{'domain_modeid'} = "2";
$GLOBALS{'domain_codeversion'} = "v1";  // CHECK
$GLOBALS{'domain_systemdate'} = "SYSTEM";  // CHECK
$GLOBALS{'domain_simulation'} = "OFF";  // CHECK
$GLOBALS{'domain_testdata'} = "OFF";  // CHECK
$GLOBALS{'domain_readonly'} = "OFF";  // CHECK
$GLOBALS{'domain_webstyle'} = "Default";
$GLOBALS{'domain_mobilestyle'} = "Default";
$GLOBALS{'domain_weblock'} = "";
$GLOBALS{'domain_domainmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_webmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_resultsmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_personmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_bookingmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_sponsormasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_salesmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_adminmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_commsmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_qualificationmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_personmassnotifyintro'} = "";
$GLOBALS{'domain_contactid'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_currperiodid'} = "20".$GLOBALS{'actyy'};
$GLOBALS{'domain_urlrootdirectory'} = $urlrootdirectory;  // CHECK
$GLOBALS{'domain_emailblocksize'} = "200";
$GLOBALS{'domain_personmembershipnotifyintro'} = "";
$GLOBALS{'domain_showforgottenpasswordemail'} = "";
$GLOBALS{'domain_showforgottenpasswordemailkey'} = "";
$GLOBALS{'domain_personmembershipintrotext'} = "";
$GLOBALS{'domain_personmembershipmedicaltext'} = "";
$GLOBALS{'domain_personmembershipminortext'} = "";
$GLOBALS{'domain_personmembershipethnicitytext'} = "";
$GLOBALS{'domain_personmembershipfinaltext'} = "";
$GLOBALS{'domain_personmembershiptermstext'} = "";
$GLOBALS{'domain_personmembershipreminderintro'} = "";
$GLOBALS{'domain_personmembershipexperiencetext'} = "";
$GLOBALS{'domain_personmembershiptypetext'} = "";
$GLOBALS{'domain_defaultemailaddress'} = "";
$GLOBALS{'domain_timeoutminutes'} = "90";
$GLOBALS{'domain_actualurl'} = "";
$GLOBALS{'domain_sportid'} = $indomain_sportid;
Write_Data("domain_".$inaccount_id);


$GLOBALS{'commsmasters_domainid'} = $GLOBALS{'account_id'};
$GLOBALS{'commsmasters_bulletineditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_eventeditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_draweditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_articleeditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_courseeditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_websitepublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_bulletinpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_newsletterpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_facebookpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_twitterpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
Write_Data("commsmasters_".$inaccount_id);

$plugina = Get_Array('plugin_'.$indomain_themeid);
foreach ($plugina as $plugin_id) {
    Get_Data('plugin_'.$indomain_themeid,$plugin_id);
    Write_Data("plugin",$plugin_id);
}

$plugincategorya = Get_Array('plugincategory_'.$indomain_themeid);
foreach ($plugincategorya as $plugincategory_name) {
    Get_Data('plugincategory_'.$indomain_themeid,$plugincategory_name);
    Write_Data("plugincategory",$plugincategory_name);
}



$librarysectiona = Get_Array('librarysection_'.$indomain_themeid);
foreach ($librarysectiona as $librarysection_id) {   
    Get_Data('librarysection_'.$indomain_themeid,$librarysection_id);    
    Write_Data("librarysection","libraryroot");
}

$sectiona = Get_Array('section_'.$indomain_themeid);
foreach ($sectiona as $section_name) {
    Get_Data('section_'.$indomain_themeid,$section_name);
    Write_Data("section",$section_name);
}

$menua = Get_Array('menu_'.$indomain_themeid);
foreach ($menua as $menu_id) {
    Get_Data('menu_'.$indomain_themeid,$menu_id);
    Write_Data("menu",$menu_id);    
    $menuitema = Get_Array('menuitem_'.$indomain_themeid,$menu_id);
    foreach ($menuitema as $menuitem_id) {
        Get_Data('menuitem_'.$indomain_themeid,$menu_id,$menuitem_id);
        Write_Data("menuitem",$menu_id,$menuitem_id);
    }    
}

$carousela = Get_Array('carousel_'.$indomain_themeid);
foreach ($carousela as $carousel_name) {
    Get_Data('carousel_'.$indomain_themeid,$carousel_name);
    Write_Data("carousel",$carousel_name);
    $carouselimga = Get_Array('carouselimg_'.$indomain_themeid,$carousel_name);
    foreach ($carouselimga as $carouselimg_id) {
        Get_Data('carouselimg_'.$indomain_themeid,$carousel_name,$carouselimg_id);
        Write_Data("carouselimg",$carousel_name,$carouselimg_id);
    }
}

$templatea = Get_Array('template_'.$indomain_themeid,"Final");
foreach ($templatea as $template_name) {
    Get_Data('template_'.$indomain_themeid,"Final",$template_name);
    Write_Data("template","Final",$template_name);
}

$templateelementa = Get_Array('templateelement_'.$indomain_themeid);
foreach ($templateelementa as $template_name) {
    Get_Data('templateelement_'.$indomain_themeid,$templateelement_name);
    Write_Data("templateelement",$templateelement_name);
}

$webpagea = Get_Array('webpage_'.$indomain_themeid);
foreach ($webpagea as $webpage_name) {
    Get_Data('webpage_'.$indomain_themeid,$webpage_name);
    Write_Data("webpage",$webpage_name);
}

mkdir($GLOBALS{'domainfilepath'}, 0777);
Synch_File_Directory ("assets",$indomain_themeid);
Synch_File_Directory ("plugins",$indomain_themeid);
Synch_File_Directory ("mpdfreports",$indomain_themeid);
Synch_File_Directory ("personphotos",$indomain_themeid);

mkdir($GLOBALS{'domainwwwpath'}, 0777);
Synch_Web_Directory ("domain_advertisers",$indomain_themeid);
Synch_Web_Directory ("domain_frs",$indomain_themeid);
Synch_Web_Directory ("domain_media",$indomain_themeid);
Synch_Web_Directory ("domain_shop",$indomain_themeid);
Synch_Web_Directory ("domain_style",$indomain_themeid);
Synch_Web_Directory ("domain_temp",$indomain_themeid);

Webpage_WEBSITEPUBLISHALL_Output( );


print "<h3>Congratulations - your new domain has now been created</h4>";
print 'Please take a note of the Initial Password for "'.$GLOBALS{'LOGIN_person_id'}.'" - "'.$randompassword.'" for future reference.</BR>';
$link = YPGMLINK("personloginout.php");
$link = $link.YPGMFIRSTPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("PersonId",$GLOBALS{'LOGIN_person_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'}).YPGMPARM("LoginModeId","");
XP();XLINKTXT($link,"This link will now take you there");X_P();
print '</body>'."\n";


// ===== revert parameters to originals for navigator & footer ====
$GLOBALS{'LOGIN_domain_id'} = $orig_domain_id;
$GLOBALS{'LOGIN_mode_id'} = $orig_mode_id;
$GLOBALS{'LOGIN_person_id'} = $orig_person_id;
$GLOBALS{'LOGIN_session_id'} = $orig_session_id;
$GLOBALS{'LOGIN_loginmode_id'} = $orig_loginmode_id;

Back_Navigator();
PageFooter("Default","Final");


function Synch_File_Directory ($dirname,$theme) {  
    if (is_dir($GLOBALS{'site_filepath'}."/".$theme."/".$dirname)) {
        mkdir($GLOBALS{'domainfilepath'}."/".$dirname, 0777);
        print "<br>".$GLOBALS{'domainfilepath'}."/".$dirname."\n";       
        $filesa = Get_Directory_Array ($GLOBALS{'site_filepath'}."/".$theme."/".$dirname);
        foreach ($filesa as $filename) {
            $copyfrom = $GLOBALS{'site_filepath'}."/".$theme."/".$dirname."/".$filename;
            $copyto = $GLOBALS{'domainfilepath'}."/".$dirname."/".$filename;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);
        }             
    }
}

function Synch_Web_Directory ($dirname,$theme) {
    if (is_dir($GLOBALS{'site_wwwpath'}."/".$theme."/".$dirname)) {
        mkdir($GLOBALS{'domainwwwpath'}."/".$dirname, 0777);
        print "<br>".$GLOBALS{'domainwwwpath'}."/".$dirname."\n";
        $filesa = Get_Directory_Array ($GLOBALS{'site_wwwpath'}."/".$theme."/".$dirname);
        foreach ($filesa as $filename) {
            $copyfrom = $GLOBALS{'site_wwwpath'}."/".$theme."/".$dirname."/".$filename;
            $copyto = $GLOBALS{'domainwwwpath'}."/".$dirname."/".$filename;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);
        }
    }
}

=======
<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_webpageroutines.php";

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Back_Navigator();

// ===== save original parameters to originals for navigator & footer ====
$orig_domain_id = $GLOBALS{'LOGIN_domain_id'};
$orig_mode_id = $GLOBALS{'LOGIN_mode_id'};
$orig_person_id = $GLOBALS{'LOGIN_person_id'};
$orig_session_id = $GLOBALS{'LOGIN_session_id'};
$orig_loginmode_id = $GLOBALS{'LOGIN_loginmode_id'};

$inaccount_id = $_REQUEST['account_id'];
$indomain_longname = $_REQUEST['domain_longname'];
$indomain_shortname = $_REQUEST['domain_shortname'];
$indomain_themeid = "";
if (isset($_REQUEST['domain_themeid'])) { $indomain_themeid = $_REQUEST['domain_themeid']; }
$indomain_sportid = "";
if (isset($_REQUEST['domain_sportid'])) { $indomain_sportid = $_REQUEST['domain_sportid']; }

XH1($indomain_themeid." ".$indomain_longname." ".$indomain_shortname);

// ==== read the site related database records ===============
Get_Data("site_".$GLOBALS{'LOGIN_service_id'});
Get_Data('account_'.$inaccount_id);
if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
else { $serviceid = $GLOBALS{'LOGIN_service_id'}; } 
Get_Data("service_".$serviceid."DOMAIN");

// ===== from this point on parameters relate to domain not site ====
$GLOBALS{'LOGIN_domain_id'} = $indomain_shortname;
$GLOBALS{'LOGIN_mode_id'} = "2";
$tperson_fname = strtolower($GLOBALS{'account_contactfname'});
$tperson_sname = strtolower($GLOBALS{'account_contactsname'});
$fnamebits = str_split($tperson_fname);
$snamebits = str_split($tperson_sname);
$GLOBALS{'LOGIN_person_id'} = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2];
// $GLOBALS{'LOGIN_session_id'} = $orig_session_id;
$GLOBALS{'LOGIN_loginmode_id'} = "2";

if ($GLOBALS{'site_extradirectory'} == "") {$slashplusurlrootdirectory = "";}
else {$slashplusurlrootdirectory = "/".$GLOBALS{'site_extradirectory'};}  

$GLOBALS{'domain_actualurl'} = "";
if ($GLOBALS{'domain_actualurl'} == "") {  $GLOBALS{'domainwwwurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'account_shortname'}; }
else { $GLOBALS{'domainwwwurl'} = "//".$GLOBALS{'domain_actualurl'}; }


$GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'account_shortname'};
$GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'}."/".$GLOBALS{'account_shortname'};
$GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'account_shortname'}; 

Initialise_Data('person');
$randompassword = "Gem1n1";
$GLOBALS{'person_id'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'person_fname'} = $GLOBALS{'account_contactfname'};
$GLOBALS{'person_sname'} = $GLOBALS{'account_contactsname'};
$GLOBALS{'person_password'} = XCrypt($randompassword,$GLOBALS{'LOGIN_person_id'},"encrypt");
$GLOBALS{'person_passwordclue'} = "Initial Setup";
$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}; 
$GLOBALS{'person_menuitem'} = $GLOBALS{'LOGIN_domain_id'}; 
Write_Data("person",$GLOBALS{'LOGIN_person_id'});

$GLOBALS{'domain_id'} = $GLOBALS{'account_id'};
$GLOBALS{'domain_longname'} = $indomain_longname;
$GLOBALS{'domain_shortname'} = $indomain_shortname;
$GLOBALS{'domain_modeid'} = "2";
$GLOBALS{'domain_codeversion'} = "v1";  // CHECK
$GLOBALS{'domain_systemdate'} = "SYSTEM";  // CHECK
$GLOBALS{'domain_simulation'} = "OFF";  // CHECK
$GLOBALS{'domain_testdata'} = "OFF";  // CHECK
$GLOBALS{'domain_readonly'} = "OFF";  // CHECK
$GLOBALS{'domain_webstyle'} = "Default";
$GLOBALS{'domain_mobilestyle'} = "Default";
$GLOBALS{'domain_weblock'} = "";
$GLOBALS{'domain_domainmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_webmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_resultsmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_personmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_bookingmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_sponsormasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_salesmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_adminmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_commsmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_qualificationmasters'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_personmassnotifyintro'} = "";
$GLOBALS{'domain_contactid'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_currperiodid'} = "20".$GLOBALS{'actyy'};
$GLOBALS{'domain_urlrootdirectory'} = $urlrootdirectory;  // CHECK
$GLOBALS{'domain_emailblocksize'} = "200";
$GLOBALS{'domain_personmembershipnotifyintro'} = "";
$GLOBALS{'domain_showforgottenpasswordemail'} = "";
$GLOBALS{'domain_showforgottenpasswordemailkey'} = "";
$GLOBALS{'domain_personmembershipintrotext'} = "";
$GLOBALS{'domain_personmembershipmedicaltext'} = "";
$GLOBALS{'domain_personmembershipminortext'} = "";
$GLOBALS{'domain_personmembershipethnicitytext'} = "";
$GLOBALS{'domain_personmembershipfinaltext'} = "";
$GLOBALS{'domain_personmembershiptermstext'} = "";
$GLOBALS{'domain_personmembershipreminderintro'} = "";
$GLOBALS{'domain_personmembershipexperiencetext'} = "";
$GLOBALS{'domain_personmembershiptypetext'} = "";
$GLOBALS{'domain_defaultemailaddress'} = "";
$GLOBALS{'domain_timeoutminutes'} = "90";
$GLOBALS{'domain_actualurl'} = "";
$GLOBALS{'domain_sportid'} = $indomain_sportid;
Write_Data("domain_".$inaccount_id);


$GLOBALS{'commsmasters_domainid'} = $GLOBALS{'account_id'};
$GLOBALS{'commsmasters_bulletineditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_eventeditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_draweditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_articleeditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_courseeditorlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_websitepublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_bulletinpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_newsletterpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_facebookpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'commsmasters_twitterpublisherlist'} = $GLOBALS{'LOGIN_person_id'};
Write_Data("commsmasters_".$inaccount_id);

$plugina = Get_Array('plugin_'.$indomain_themeid);
foreach ($plugina as $plugin_id) {
    Get_Data('plugin_'.$indomain_themeid,$plugin_id);
    Write_Data("plugin",$plugin_id);
}

$plugincategorya = Get_Array('plugincategory_'.$indomain_themeid);
foreach ($plugincategorya as $plugincategory_name) {
    Get_Data('plugincategory_'.$indomain_themeid,$plugincategory_name);
    Write_Data("plugincategory",$plugincategory_name);
}



$librarysectiona = Get_Array('librarysection_'.$indomain_themeid);
foreach ($librarysectiona as $librarysection_id) {   
    Get_Data('librarysection_'.$indomain_themeid,$librarysection_id);    
    Write_Data("librarysection","libraryroot");
}

$sectiona = Get_Array('section_'.$indomain_themeid);
foreach ($sectiona as $section_name) {
    Get_Data('section_'.$indomain_themeid,$section_name);
    Write_Data("section",$section_name);
}

$menua = Get_Array('menu_'.$indomain_themeid);
foreach ($menua as $menu_id) {
    Get_Data('menu_'.$indomain_themeid,$menu_id);
    Write_Data("menu",$menu_id);    
    $menuitema = Get_Array('menuitem_'.$indomain_themeid,$menu_id);
    foreach ($menuitema as $menuitem_id) {
        Get_Data('menuitem_'.$indomain_themeid,$menu_id,$menuitem_id);
        Write_Data("menuitem",$menu_id,$menuitem_id);
    }    
}

$carousela = Get_Array('carousel_'.$indomain_themeid);
foreach ($carousela as $carousel_name) {
    Get_Data('carousel_'.$indomain_themeid,$carousel_name);
    Write_Data("carousel",$carousel_name);
    $carouselimga = Get_Array('carouselimg_'.$indomain_themeid,$carousel_name);
    foreach ($carouselimga as $carouselimg_id) {
        Get_Data('carouselimg_'.$indomain_themeid,$carousel_name,$carouselimg_id);
        Write_Data("carouselimg",$carousel_name,$carouselimg_id);
    }
}

$templatea = Get_Array('template_'.$indomain_themeid,"Final");
foreach ($templatea as $template_name) {
    Get_Data('template_'.$indomain_themeid,"Final",$template_name);
    Write_Data("template","Final",$template_name);
}

$templateelementa = Get_Array('templateelement_'.$indomain_themeid);
foreach ($templateelementa as $template_name) {
    Get_Data('templateelement_'.$indomain_themeid,$templateelement_name);
    Write_Data("templateelement",$templateelement_name);
}

$webpagea = Get_Array('webpage_'.$indomain_themeid);
foreach ($webpagea as $webpage_name) {
    Get_Data('webpage_'.$indomain_themeid,$webpage_name);
    Write_Data("webpage",$webpage_name);
}

mkdir($GLOBALS{'domainfilepath'}, 0777);
Synch_File_Directory ("assets",$indomain_themeid);
Synch_File_Directory ("plugins",$indomain_themeid);
Synch_File_Directory ("mpdfreports",$indomain_themeid);
Synch_File_Directory ("personphotos",$indomain_themeid);

mkdir($GLOBALS{'domainwwwpath'}, 0777);
Synch_Web_Directory ("domain_advertisers",$indomain_themeid);
Synch_Web_Directory ("domain_frs",$indomain_themeid);
Synch_Web_Directory ("domain_media",$indomain_themeid);
Synch_Web_Directory ("domain_shop",$indomain_themeid);
Synch_Web_Directory ("domain_style",$indomain_themeid);
Synch_Web_Directory ("domain_temp",$indomain_themeid);

Webpage_WEBSITEPUBLISHALL_Output( );


print "<h3>Congratulations - your new domain has now been created</h4>";
print 'Please take a note of the Initial Password for "'.$GLOBALS{'LOGIN_person_id'}.'" - "'.$randompassword.'" for future reference.</BR>';
$link = YPGMLINK("personloginout.php");
$link = $link.YPGMFIRSTPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("PersonId",$GLOBALS{'LOGIN_person_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'}).YPGMPARM("LoginModeId","");
XP();XLINKTXT($link,"This link will now take you there");X_P();
print '</body>'."\n";


// ===== revert parameters to originals for navigator & footer ====
$GLOBALS{'LOGIN_domain_id'} = $orig_domain_id;
$GLOBALS{'LOGIN_mode_id'} = $orig_mode_id;
$GLOBALS{'LOGIN_person_id'} = $orig_person_id;
$GLOBALS{'LOGIN_session_id'} = $orig_session_id;
$GLOBALS{'LOGIN_loginmode_id'} = $orig_loginmode_id;

Back_Navigator();
PageFooter("Default","Final");


function Synch_File_Directory ($dirname,$theme) {  
    if (is_dir($GLOBALS{'site_filepath'}."/".$theme."/".$dirname)) {
        mkdir($GLOBALS{'domainfilepath'}."/".$dirname, 0777);
        print "<br>".$GLOBALS{'domainfilepath'}."/".$dirname."\n";       
        $filesa = Get_Directory_Array ($GLOBALS{'site_filepath'}."/".$theme."/".$dirname);
        foreach ($filesa as $filename) {
            $copyfrom = $GLOBALS{'site_filepath'}."/".$theme."/".$dirname."/".$filename;
            $copyto = $GLOBALS{'domainfilepath'}."/".$dirname."/".$filename;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);
        }             
    }
}

function Synch_Web_Directory ($dirname,$theme) {
    if (is_dir($GLOBALS{'site_wwwpath'}."/".$theme."/".$dirname)) {
        mkdir($GLOBALS{'domainwwwpath'}."/".$dirname, 0777);
        print "<br>".$GLOBALS{'domainwwwpath'}."/".$dirname."\n";
        $filesa = Get_Directory_Array ($GLOBALS{'site_wwwpath'}."/".$theme."/".$dirname);
        foreach ($filesa as $filename) {
            $copyfrom = $GLOBALS{'site_wwwpath'}."/".$theme."/".$dirname."/".$filename;
            $copyto = $GLOBALS{'domainwwwpath'}."/".$dirname."/".$filename;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);
        }
    }
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>