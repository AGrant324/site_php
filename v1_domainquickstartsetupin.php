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

// ==== read the site related database records ===============
Get_Data("site_".$GLOBALS{'LOGIN_service_id'});
Get_Data('account_'.$inaccount_id);
if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
else { $serviceid = $GLOBALS{'LOGIN_service_id'}; } 
Get_Data("service_".$serviceid."DOMAIN");
Get_Data("quickstart",$account_id);

// ===== from this point on parameters relate to domain not site ====
$GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'account_id'};
$GLOBALS{'LOGIN_mode_id'} = "2";
$tperson_fname = strtolower($GLOBALS{'quickstart_contactfname'});
$tperson_sname = strtolower($GLOBALS{'quickstart_contactsname'});
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

$GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'quickstart_shortname'};
$GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'}."/".$GLOBALS{'quickstart_shortname'};
$GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'quickstart_shortname'}; 

// ============ Create the Directiries and Copy Theme files ================
mkdir($GLOBALS{'domainfilepath'}, 0777);
Synch_File_Directory ("assets",$GLOBALS{'quickstart_themename'});
Synch_File_Directory ("plugins",$GLOBALS{'quickstart_themename'});
Synch_File_Directory ("mpdfreports",$GLOBALS{'quickstart_themename'});
Synch_File_Directory ("personphotos",$GLOBALS{'quickstart_themename'});

mkdir($GLOBALS{'domainwwwpath'}, 0777);
Synch_Web_Directory ("domain_advertisers",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_frs",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_media",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_shop",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_style",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_temp",$GLOBALS{'quickstart_themename'});

// =========== Create the database tables =====================
Initialise_Data('person');
$randompassword = "Gem1n1";
$GLOBALS{'person_id'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'person_fname'} = $GLOBALS{'quickstart_contactfname'};
$GLOBALS{'person_sname'} = $GLOBALS{'quickstart_contactsname'};
$GLOBALS{'person_password'} = XCrypt($randompassword,$GLOBALS{'LOGIN_person_id'},"encrypt");
$GLOBALS{'person_passwordclue'} = "Initial Setup";
$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}; 
$GLOBALS{'person_menuitem'} = $GLOBALS{'LOGIN_domain_id'}; 
Write_Data("person",$GLOBALS{'LOGIN_person_id'});

$GLOBALS{'domain_id'} = $GLOBALS{'account_id'};
$GLOBALS{'domain_longname'} = $GLOBALS{'quickstart_longname'};
$GLOBALS{'domain_shortname'} = $GLOBALS{'quickstart_shortname'};
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
if ($GLOBALS{'quickstart_periodid'} == "") { $GLOBALS{'domain_currperiodid'} = "2018";  }
else { $GLOBALS{'domain_currperiodid'} = $GLOBALS{'quickstart_periodid'};  }
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
$GLOBALS{'domain_sportid'} = $GLOBALS{'quickstart_sportid'};
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

Get_Data('serviceenabled_'.$GLOBALS{'quickstart_themename'});
Write_Data('serviceenabled_'.$GLOBALS{'account_id'});


$plugina = Get_Array('plugin_'.$GLOBALS{'quickstart_themename'});
foreach ($plugina as $plugin_id) {
    Get_Data('plugin_'.$GLOBALS{'quickstart_themename'},$plugin_id);
    Write_Data("plugin",$plugin_id);
}

$plugincategorya = Get_Array('plugincategory_'.$GLOBALS{'quickstart_themename'});
foreach ($plugincategorya as $plugincategory_name) {
    Get_Data('plugincategory_'.$GLOBALS{'quickstart_themename'},$plugincategory_name);
    Write_Data("plugincategory",$plugincategory_name);
}

$librarysectiona = Get_Array('librarysection_'.$GLOBALS{'quickstart_themename'});
foreach ($librarysectiona as $librarysection_id) {   
    Get_Data('librarysection_'.$GLOBALS{'quickstart_themename'},$librarysection_id);    
    Write_Data("librarysection","libraryroot");
}

$teama = Get_Array('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'});
foreach ($teama as $qteam_code) {
    Get_Data('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'},$qteam_code);
    Initialise_Data("team");
    $GLOBALS{'team_name'} = $GLOBALS{'quickstartteam_name'};
    $GLOBALS{'team_seq'} = $GLOBALS{'quickstartteam_seq'};
    Write_Data("team",$GLOBALS{'domain_currperiodid'},$qteam_code);
}

$sectiona = Get_Array('quickstartsection_'.$orig_domain_id,$GLOBALS{'account_id'});
foreach ($sectiona as $qsection_name) {
    Get_Data('quickstartsection_'.$orig_domain_id,$GLOBALS{'account_id'},$qsection_name);
    Initialise_Data("section");    
    $GLOBALS{'section_name'} = $qsection_name;
    $GLOBALS{'section_leader'} = "";
    $GLOBALS{'section_seq'} = $GLOBALS{'quickstartsection_seq'};
    $GLOBALS{'section_sportid'} = $GLOBALS{'domain_sportid'};
    $sectionteamlist = ""; $sep = "";
    $teama = Get_Array('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'});
    foreach ($teama as $team_code) {
        Get_Data('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'},$team_code);
        if ( $GLOBALS{'quickstartteam_sectionname'} == $qsection_name) {
            $sectionteamlist = $sectionteamlist.$sep.$team_code;
            $sep = ",";
        }
    }
    $GLOBALS{'section_teams'} = $sectionteamlist;
    Write_Data("section",$GLOBALS{'domain_currperiodid'},$qsection_name);
}

$menua = Get_Array('menu_'.$GLOBALS{'quickstart_themename'});
foreach ($menua as $menu_id) {
    Get_Data('menu_'.$GLOBALS{'quickstart_themename'},$menu_id);
    Write_Data("menu",$menu_id);    
    $menuitema = Get_Array('menuitem_'.$GLOBALS{'quickstart_themename'},$menu_id);
    foreach ($menuitema as $menuitem_id) {
        Get_Data('menuitem_'.$GLOBALS{'quickstart_themename'},$menu_id,$menuitem_id);
        Write_Data("menuitem",$menu_id,$menuitem_id);
    }    
}


$carousela = Get_Array('carousel_'.$GLOBALS{'quickstart_themename'});
foreach ($carousela as $carousel_name) {
    Get_Data('carousel_'.$GLOBALS{'quickstart_themename'},$carousel_name);
    Write_Data("carousel",$carousel_name);
    $carouselindex = 1;
    $bannerindex = 1;
    $carouselimga = Get_Array('carouselimg_'.$GLOBALS{'quickstart_themename'},$carousel_name);
    foreach ($carouselimga as $carouselimg_id) {
        Get_Data('carouselimg_'.$GLOBALS{'quickstart_themename'},$carousel_name,$carouselimg_id);
        if ( $GLOBALS{'carousel_type'} == "Carousel") {
            if ( $carouselindex < 4 ) {            
                if ( $GLOBALS{'quickstart_carouselimage'.$carouselindex} != "" ) {
                    // Carousel_carouselref_oldimagename  Theme Image
                    // QuickstartCarouselImg_domainid_newimagename   Quickstart image
                    // Carousel_carouselref_newimagename  Domain Image
                    $thimg = $GLOBALS{'carouselimg_img'};
                    $thimga = explode("_",$thimg);
                    $qsimg = $GLOBALS{'quickstart_carouselimage'.$carouselindex};
                    $qsimga = explode("_",$qsimg);
                    if ($qsimga[0] == "tempf") {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_","",$qsimg);
                    } else {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_","",$qsimg);
                    }
                    $newimg = $thimga[0]."_".$thimga[1]."_".$qsimgend;
                    $qsimgb = explode(".",$qsimg);
                    $newimg = str_replace(".jpg",".".$qsimgb[1],$newimg);
                    $GLOBALS{'carouselimg_img'} = $newimg;           
                    Write_Data("carouselimg",$carousel_name,$carouselimg_id);
                    $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
                    $copyto = $GLOBALS{'domainwwwpath'}."/domain_style/".$newimg;
                    XPTXT($copyfrom." | ".$copyto);
                    copy($copyfrom, $copyto);
                }
                $carouselindex++;
            }
            
        }
        if ( $GLOBALS{'carousel_type'} == "Image") {
            if ( $bannerindex < 4 ) {
                if ( $GLOBALS{'quickstart_carouselimage'.$bannerindex} != "" ) {
                    // Carousel_carouselref_oldimagename  Theme Image
                    // QuickstartCarouselImg_domainid_newimagename   Quickstart image
                    // Carousel_carouselref_newimagename  Domain Image
                    $thimg = $GLOBALS{'carouselimg_img'};
                    $thimga = explode("_",$thimg);
                    $qsimg = $GLOBALS{'quickstart_bannerimage'.$bannerindex};
                    $qsimga = explode("_",$qsimg);
                    if ($qsimga[0] == "tempf") {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_","",$qsimg);
                    } else {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_","",$qsimg);
                    }
                    $newimg = $thimga[0]."_".$thimga[1]."_".$qsimgend;
                    $qsimgb = explode(".",$qsimg);
                    $newimg = str_replace(".jpg",".".$qsimgb[1],$newimg);
                    $GLOBALS{'carouselimg_img'} = $newimg;
                    Write_Data("carouselimg",$carousel_name,$carouselimg_id);
                    $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
                    $copyto = $GLOBALS{'domainwwwpath'}."/domain_style/".$newimg;
                    XPTXT($copyfrom." | ".$copyto);
                    copy($copyfrom, $copyto);
                }
                $bannerindex++;
            }
            
        }
    }
}

$templatea = Get_Array('template_'.$GLOBALS{'quickstart_themename'},"Final");
foreach ($templatea as $template_name) {
    Get_Data('template_'.$GLOBALS{'quickstart_themename'},"Final",$template_name);
    Write_Data("template","Final",$template_name);
}

$templateelementa = Get_Array('templateelement_'.$GLOBALS{'quickstart_themename'});
foreach ($templateelementa as $templateelement_name) {
    Get_Data('templateelement_'.$GLOBALS{'quickstart_themename'},$templateelement_name);
    Write_Data("templateelement",$templateelement_name);
}

$webpagea = Get_Array('webpage_'.$GLOBALS{'quickstart_themename'});
foreach ($webpagea as $webpage_name) {
    Get_Data('webpage_'.$GLOBALS{'quickstart_themename'},$webpage_name);
    $GLOBALS{'webpage_html'} = Webpage_DBHTMLQUICKSTART_Output($GLOBALS{'webpage_html'});
    Write_Data("webpage",$webpage_name);
}

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

function Webpage_DBHTMLQUICKSTART_Output($webpage_html) {
    
    $htmla = Array();
    // clean out the unnecessary extra html
    $webpage_html = str_replace('<p>&nbsp;</p>', '', $webpage_html);
    $webpage_html = str_replace('<p><!--', '<!--', $webpage_html);
    $webpage_html = str_replace('--></p>', '-->', $webpage_html);
    
    // print($webpage_html);
    
    $htmlrawa = explode('<',$webpage_html);
    $first = "1";
    $excludeline = "0";
    
    $hi = 0;
    while ( $hi < sizeof($htmlrawa) ) {
        $htmlrawline = $htmlrawa[$hi];
        $mustincludeline = "0";
        if ($first == "0") { $htmlrawline = '<'.$htmlrawline; }
        $first = "0";

        // ==== Quicksgtart "Introduction" ===============
        if (strlen(strstr($htmlrawline,'QuickstartTextIntroductionStart')) > 0) {
            // <div id="QuickstartTextIntroductionStart"></div>
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "1"; 
            array_push($htmla,$GLOBALS{'quickstart_introductiontext'});
        }
        if (strlen(strstr($htmlrawline,'QuickstartTextIntroductionEnd')) > 0) { 
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "2"; 
        }   
        if (strlen(strstr($htmlrawline,'_QuickstartIntroduction_')) > 0) { 
            $excludeline = "2";
            // ThHTML  <img class="img-responsive editableimg" src="//www.grassrootspower.club/ThemeA/domain_media/Webpage_Home_QuickstartIntroduction_FixedSize_750x450.jpg?1535370544175" alt="">
            // QS      QuickstartMedia_DemoClub1_OtherPage3_FixedSize_750x450.jpg
            // NewHTML <img class="img-responsive editableimg" src="//www.grassrootspower.club/[domain_id]/domain_media/Webpage_Home_[$qsimg]_FixedSize_750x450.jpg?1535370544175" alt="">            
            $qsimg = $GLOBALS{'quickstart_introductionimage'};
            $qsimga = explode("_",$qsimg);
            if ($qsimga[0] == "tempf") { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_"; } 
            else { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_"; }
            $qsremoveend = "_".$qsimga[sizeof($qsimga) - 2]."_".$qsimga[sizeof($qsimga) - 1];
            $qsimg1 = str_replace($qsremovestart,"",$qsimg);
            $qsimgmid = str_replace($qsremoveend,"",$qsimg1);
            $newline = str_replace("QuickstartIntroduction",$qsimgmid,$htmlrawline);
            $qsimgb = explode(".",$qsimg);
            $newline = str_replace(".jpg",".".$qsimgb[1],$newline);
            $newline = str_replace("/".$GLOBALS{'quickstart_themename'}."/","/".$GLOBALS{'account_id'}."/",$newline);           
            array_push($htmla,$newline);
            
            $himga = explode('/',$htmlrawline);
            $himgb = explode('?',$himga[sizeof($himga) - 1]);
            $oldimg = $himgb[0];
            $newimg = str_replace("QuickstartIntroduction",$qsimgmid,$oldimg);           
            $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
            $copyto = $GLOBALS{'domainwwwpath'}."/domain_media/".$newimg;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);  
        }
       
        // ==== Quicksgtart "AboutUs" ===============
        if (strlen(strstr($htmlrawline,'QuickstartTextAboutUsStart')) > 0) { 
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "1"; 
            array_push($htmla,$GLOBALS{'quickstart_aboutustext'});
        }
        if (strlen(strstr($htmlrawline,'QuickstartTextAboutUsEnd')) > 0) {
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "2"; 
        }          
        if (strlen(strstr($htmlrawline,'_QuickstartAboutUs_')) > 0) {
            $excludeline = "2";
            $qsimg = $GLOBALS{'quickstart_aboutusimage'};
            $qsimga = explode("_",$qsimg);
            if ($qsimga[0] == "tempf") { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_"; }
            else { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_"; }
            $qsremoveend = "_".$qsimga[sizeof($qsimga) - 2]."_".$qsimga[sizeof($qsimga) - 1];
            $qsimg1 = str_replace($qsremovestart,"",$qsimg);
            $qsimgmid = str_replace($qsremoveend,"",$qsimg1);
            $newline = str_replace("QuickstartAboutUs",$qsimgmid,$htmlrawline);
            $qsimgb = explode(".",$qsimg);
            $newline = str_replace(".jpg",".".$qsimgb[1],$newline);
            $newline = str_replace("/".$GLOBALS{'quickstart_themename'}."/","/".$GLOBALS{'account_id'}."/",$newline);
            array_push($htmla,$newline);
            
            $himga = explode('/',$htmlrawline);
            $himgb = explode('?',$himga[sizeof($himga) - 1]);
            $oldimg = $himgb[0];
            $newimg = str_replace("QuickstartAboutUs",$qsimgmid,$oldimg);
            $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
            $copyto = $GLOBALS{'domainwwwpath'}."/domain_media/".$newimg;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);  
        }
            
        if ($excludeline == "0") { array_push($htmla,$htmlrawline); }
        if ($mustincludeline == "1") { array_push($htmla,$htmlrawline); }
        if ($excludeline == "2") { $excludeline = "0"; }
        $hi++;
    };
    
    $htmlstring = "";
    foreach ($htmla as $message) {
        $htmlstring = $htmlstring.$message;
    }
    return $htmlstring;
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

// ==== read the site related database records ===============
Get_Data("site_".$GLOBALS{'LOGIN_service_id'});
Get_Data('account_'.$inaccount_id);
if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
else { $serviceid = $GLOBALS{'LOGIN_service_id'}; } 
Get_Data("service_".$serviceid."DOMAIN");
Get_Data("quickstart",$account_id);

// ===== from this point on parameters relate to domain not site ====
$GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'account_id'};
$GLOBALS{'LOGIN_mode_id'} = "2";
$tperson_fname = strtolower($GLOBALS{'quickstart_contactfname'});
$tperson_sname = strtolower($GLOBALS{'quickstart_contactsname'});
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

$GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'quickstart_shortname'};
$GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'}."/".$GLOBALS{'quickstart_shortname'};
$GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'quickstart_shortname'}; 

// ============ Create the Directiries and Copy Theme files ================
mkdir($GLOBALS{'domainfilepath'}, 0777);
Synch_File_Directory ("assets",$GLOBALS{'quickstart_themename'});
Synch_File_Directory ("plugins",$GLOBALS{'quickstart_themename'});
Synch_File_Directory ("mpdfreports",$GLOBALS{'quickstart_themename'});
Synch_File_Directory ("personphotos",$GLOBALS{'quickstart_themename'});

mkdir($GLOBALS{'domainwwwpath'}, 0777);
Synch_Web_Directory ("domain_advertisers",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_frs",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_media",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_shop",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_style",$GLOBALS{'quickstart_themename'});
Synch_Web_Directory ("domain_temp",$GLOBALS{'quickstart_themename'});

// =========== Create the database tables =====================
Initialise_Data('person');
$randompassword = "Gem1n1";
$GLOBALS{'person_id'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'person_fname'} = $GLOBALS{'quickstart_contactfname'};
$GLOBALS{'person_sname'} = $GLOBALS{'quickstart_contactsname'};
$GLOBALS{'person_password'} = XCrypt($randompassword,$GLOBALS{'LOGIN_person_id'},"encrypt");
$GLOBALS{'person_passwordclue'} = "Initial Setup";
$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}; 
$GLOBALS{'person_menuitem'} = $GLOBALS{'LOGIN_domain_id'}; 
Write_Data("person",$GLOBALS{'LOGIN_person_id'});

$GLOBALS{'domain_id'} = $GLOBALS{'account_id'};
$GLOBALS{'domain_longname'} = $GLOBALS{'quickstart_longname'};
$GLOBALS{'domain_shortname'} = $GLOBALS{'quickstart_shortname'};
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
if ($GLOBALS{'quickstart_periodid'} == "") { $GLOBALS{'domain_currperiodid'} = "2018";  }
else { $GLOBALS{'domain_currperiodid'} = $GLOBALS{'quickstart_periodid'};  }
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
$GLOBALS{'domain_sportid'} = $GLOBALS{'quickstart_sportid'};
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

Get_Data('serviceenabled_'.$GLOBALS{'quickstart_themename'});
Write_Data('serviceenabled_'.$GLOBALS{'account_id'});


$plugina = Get_Array('plugin_'.$GLOBALS{'quickstart_themename'});
foreach ($plugina as $plugin_id) {
    Get_Data('plugin_'.$GLOBALS{'quickstart_themename'},$plugin_id);
    Write_Data("plugin",$plugin_id);
}

$plugincategorya = Get_Array('plugincategory_'.$GLOBALS{'quickstart_themename'});
foreach ($plugincategorya as $plugincategory_name) {
    Get_Data('plugincategory_'.$GLOBALS{'quickstart_themename'},$plugincategory_name);
    Write_Data("plugincategory",$plugincategory_name);
}

$librarysectiona = Get_Array('librarysection_'.$GLOBALS{'quickstart_themename'});
foreach ($librarysectiona as $librarysection_id) {   
    Get_Data('librarysection_'.$GLOBALS{'quickstart_themename'},$librarysection_id);    
    Write_Data("librarysection","libraryroot");
}

$teama = Get_Array('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'});
foreach ($teama as $qteam_code) {
    Get_Data('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'},$qteam_code);
    Initialise_Data("team");
    $GLOBALS{'team_name'} = $GLOBALS{'quickstartteam_name'};
    $GLOBALS{'team_seq'} = $GLOBALS{'quickstartteam_seq'};
    Write_Data("team",$GLOBALS{'domain_currperiodid'},$qteam_code);
}

$sectiona = Get_Array('quickstartsection_'.$orig_domain_id,$GLOBALS{'account_id'});
foreach ($sectiona as $qsection_name) {
    Get_Data('quickstartsection_'.$orig_domain_id,$GLOBALS{'account_id'},$qsection_name);
    Initialise_Data("section");    
    $GLOBALS{'section_name'} = $qsection_name;
    $GLOBALS{'section_leader'} = "";
    $GLOBALS{'section_seq'} = $GLOBALS{'quickstartsection_seq'};
    $GLOBALS{'section_sportid'} = $GLOBALS{'domain_sportid'};
    $sectionteamlist = ""; $sep = "";
    $teama = Get_Array('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'});
    foreach ($teama as $team_code) {
        Get_Data('quickstartteam_'.$orig_domain_id,$GLOBALS{'account_id'},$team_code);
        if ( $GLOBALS{'quickstartteam_sectionname'} == $qsection_name) {
            $sectionteamlist = $sectionteamlist.$sep.$team_code;
            $sep = ",";
        }
    }
    $GLOBALS{'section_teams'} = $sectionteamlist;
    Write_Data("section",$GLOBALS{'domain_currperiodid'},$qsection_name);
}

$menua = Get_Array('menu_'.$GLOBALS{'quickstart_themename'});
foreach ($menua as $menu_id) {
    Get_Data('menu_'.$GLOBALS{'quickstart_themename'},$menu_id);
    Write_Data("menu",$menu_id);    
    $menuitema = Get_Array('menuitem_'.$GLOBALS{'quickstart_themename'},$menu_id);
    foreach ($menuitema as $menuitem_id) {
        Get_Data('menuitem_'.$GLOBALS{'quickstart_themename'},$menu_id,$menuitem_id);
        Write_Data("menuitem",$menu_id,$menuitem_id);
    }    
}


$carousela = Get_Array('carousel_'.$GLOBALS{'quickstart_themename'});
foreach ($carousela as $carousel_name) {
    Get_Data('carousel_'.$GLOBALS{'quickstart_themename'},$carousel_name);
    Write_Data("carousel",$carousel_name);
    $carouselindex = 1;
    $bannerindex = 1;
    $carouselimga = Get_Array('carouselimg_'.$GLOBALS{'quickstart_themename'},$carousel_name);
    foreach ($carouselimga as $carouselimg_id) {
        Get_Data('carouselimg_'.$GLOBALS{'quickstart_themename'},$carousel_name,$carouselimg_id);
        if ( $GLOBALS{'carousel_type'} == "Carousel") {
            if ( $carouselindex < 4 ) {            
                if ( $GLOBALS{'quickstart_carouselimage'.$carouselindex} != "" ) {
                    // Carousel_carouselref_oldimagename  Theme Image
                    // QuickstartCarouselImg_domainid_newimagename   Quickstart image
                    // Carousel_carouselref_newimagename  Domain Image
                    $thimg = $GLOBALS{'carouselimg_img'};
                    $thimga = explode("_",$thimg);
                    $qsimg = $GLOBALS{'quickstart_carouselimage'.$carouselindex};
                    $qsimga = explode("_",$qsimg);
                    if ($qsimga[0] == "tempf") {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_","",$qsimg);
                    } else {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_","",$qsimg);
                    }
                    $newimg = $thimga[0]."_".$thimga[1]."_".$qsimgend;
                    $qsimgb = explode(".",$qsimg);
                    $newimg = str_replace(".jpg",".".$qsimgb[1],$newimg);
                    $GLOBALS{'carouselimg_img'} = $newimg;           
                    Write_Data("carouselimg",$carousel_name,$carouselimg_id);
                    $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
                    $copyto = $GLOBALS{'domainwwwpath'}."/domain_style/".$newimg;
                    XPTXT($copyfrom." | ".$copyto);
                    copy($copyfrom, $copyto);
                }
                $carouselindex++;
            }
            
        }
        if ( $GLOBALS{'carousel_type'} == "Image") {
            if ( $bannerindex < 4 ) {
                if ( $GLOBALS{'quickstart_carouselimage'.$bannerindex} != "" ) {
                    // Carousel_carouselref_oldimagename  Theme Image
                    // QuickstartCarouselImg_domainid_newimagename   Quickstart image
                    // Carousel_carouselref_newimagename  Domain Image
                    $thimg = $GLOBALS{'carouselimg_img'};
                    $thimga = explode("_",$thimg);
                    $qsimg = $GLOBALS{'quickstart_bannerimage'.$bannerindex};
                    $qsimga = explode("_",$qsimg);
                    if ($qsimga[0] == "tempf") {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_","",$qsimg);
                    } else {
                        $qsimgend = str_replace($qsimga[0]."_".$qsimga[1]."_","",$qsimg);
                    }
                    $newimg = $thimga[0]."_".$thimga[1]."_".$qsimgend;
                    $qsimgb = explode(".",$qsimg);
                    $newimg = str_replace(".jpg",".".$qsimgb[1],$newimg);
                    $GLOBALS{'carouselimg_img'} = $newimg;
                    Write_Data("carouselimg",$carousel_name,$carouselimg_id);
                    $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
                    $copyto = $GLOBALS{'domainwwwpath'}."/domain_style/".$newimg;
                    XPTXT($copyfrom." | ".$copyto);
                    copy($copyfrom, $copyto);
                }
                $bannerindex++;
            }
            
        }
    }
}

$templatea = Get_Array('template_'.$GLOBALS{'quickstart_themename'},"Final");
foreach ($templatea as $template_name) {
    Get_Data('template_'.$GLOBALS{'quickstart_themename'},"Final",$template_name);
    Write_Data("template","Final",$template_name);
}

$templateelementa = Get_Array('templateelement_'.$GLOBALS{'quickstart_themename'});
foreach ($templateelementa as $templateelement_name) {
    Get_Data('templateelement_'.$GLOBALS{'quickstart_themename'},$templateelement_name);
    Write_Data("templateelement",$templateelement_name);
}

$webpagea = Get_Array('webpage_'.$GLOBALS{'quickstart_themename'});
foreach ($webpagea as $webpage_name) {
    Get_Data('webpage_'.$GLOBALS{'quickstart_themename'},$webpage_name);
    $GLOBALS{'webpage_html'} = Webpage_DBHTMLQUICKSTART_Output($GLOBALS{'webpage_html'});
    Write_Data("webpage",$webpage_name);
}

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

function Webpage_DBHTMLQUICKSTART_Output($webpage_html) {
    
    $htmla = Array();
    // clean out the unnecessary extra html
    $webpage_html = str_replace('<p>&nbsp;</p>', '', $webpage_html);
    $webpage_html = str_replace('<p><!--', '<!--', $webpage_html);
    $webpage_html = str_replace('--></p>', '-->', $webpage_html);
    
    // print($webpage_html);
    
    $htmlrawa = explode('<',$webpage_html);
    $first = "1";
    $excludeline = "0";
    
    $hi = 0;
    while ( $hi < sizeof($htmlrawa) ) {
        $htmlrawline = $htmlrawa[$hi];
        $mustincludeline = "0";
        if ($first == "0") { $htmlrawline = '<'.$htmlrawline; }
        $first = "0";

        // ==== Quicksgtart "Introduction" ===============
        if (strlen(strstr($htmlrawline,'QuickstartTextIntroductionStart')) > 0) {
            // <div id="QuickstartTextIntroductionStart"></div>
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "1"; 
            array_push($htmla,$GLOBALS{'quickstart_introductiontext'});
        }
        if (strlen(strstr($htmlrawline,'QuickstartTextIntroductionEnd')) > 0) { 
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "2"; 
        }   
        if (strlen(strstr($htmlrawline,'_QuickstartIntroduction_')) > 0) { 
            $excludeline = "2";
            // ThHTML  <img class="img-responsive editableimg" src="//www.grassrootspower.club/ThemeA/domain_media/Webpage_Home_QuickstartIntroduction_FixedSize_750x450.jpg?1535370544175" alt="">
            // QS      QuickstartMedia_DemoClub1_OtherPage3_FixedSize_750x450.jpg
            // NewHTML <img class="img-responsive editableimg" src="//www.grassrootspower.club/[domain_id]/domain_media/Webpage_Home_[$qsimg]_FixedSize_750x450.jpg?1535370544175" alt="">            
            $qsimg = $GLOBALS{'quickstart_introductionimage'};
            $qsimga = explode("_",$qsimg);
            if ($qsimga[0] == "tempf") { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_"; } 
            else { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_"; }
            $qsremoveend = "_".$qsimga[sizeof($qsimga) - 2]."_".$qsimga[sizeof($qsimga) - 1];
            $qsimg1 = str_replace($qsremovestart,"",$qsimg);
            $qsimgmid = str_replace($qsremoveend,"",$qsimg1);
            $newline = str_replace("QuickstartIntroduction",$qsimgmid,$htmlrawline);
            $qsimgb = explode(".",$qsimg);
            $newline = str_replace(".jpg",".".$qsimgb[1],$newline);
            $newline = str_replace("/".$GLOBALS{'quickstart_themename'}."/","/".$GLOBALS{'account_id'}."/",$newline);           
            array_push($htmla,$newline);
            
            $himga = explode('/',$htmlrawline);
            $himgb = explode('?',$himga[sizeof($himga) - 1]);
            $oldimg = $himgb[0];
            $newimg = str_replace("QuickstartIntroduction",$qsimgmid,$oldimg);           
            $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
            $copyto = $GLOBALS{'domainwwwpath'}."/domain_media/".$newimg;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);  
        }
       
        // ==== Quicksgtart "AboutUs" ===============
        if (strlen(strstr($htmlrawline,'QuickstartTextAboutUsStart')) > 0) { 
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "1"; 
            array_push($htmla,$GLOBALS{'quickstart_aboutustext'});
        }
        if (strlen(strstr($htmlrawline,'QuickstartTextAboutUsEnd')) > 0) {
            $hi++;
            $htmlrawline = $htmlrawa[$hi]; // skip </div>
            $excludeline = "2"; 
        }          
        if (strlen(strstr($htmlrawline,'_QuickstartAboutUs_')) > 0) {
            $excludeline = "2";
            $qsimg = $GLOBALS{'quickstart_aboutusimage'};
            $qsimga = explode("_",$qsimg);
            if ($qsimga[0] == "tempf") { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_".$qsimga[2]."_"; }
            else { $qsremovestart = $qsimga[0]."_".$qsimga[1]."_"; }
            $qsremoveend = "_".$qsimga[sizeof($qsimga) - 2]."_".$qsimga[sizeof($qsimga) - 1];
            $qsimg1 = str_replace($qsremovestart,"",$qsimg);
            $qsimgmid = str_replace($qsremoveend,"",$qsimg1);
            $newline = str_replace("QuickstartAboutUs",$qsimgmid,$htmlrawline);
            $qsimgb = explode(".",$qsimg);
            $newline = str_replace(".jpg",".".$qsimgb[1],$newline);
            $newline = str_replace("/".$GLOBALS{'quickstart_themename'}."/","/".$GLOBALS{'account_id'}."/",$newline);
            array_push($htmla,$newline);
            
            $himga = explode('/',$htmlrawline);
            $himgb = explode('?',$himga[sizeof($himga) - 1]);
            $oldimg = $himgb[0];
            $newimg = str_replace("QuickstartAboutUs",$qsimgmid,$oldimg);
            $copyfrom = $GLOBALS{'site_wwwpath'}."/domain_media/".$qsimg;
            $copyto = $GLOBALS{'domainwwwpath'}."/domain_media/".$newimg;
            XPTXT($copyfrom." | ".$copyto);
            copy($copyfrom, $copyto);  
        }
            
        if ($excludeline == "0") { array_push($htmla,$htmlrawline); }
        if ($mustincludeline == "1") { array_push($htmla,$htmlrawline); }
        if ($excludeline == "2") { $excludeline = "0"; }
        $hi++;
    };
    
    $htmlstring = "";
    foreach ($htmla as $message) {
        $htmlstring = $htmlstring.$message;
    }
    return $htmlstring;
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>