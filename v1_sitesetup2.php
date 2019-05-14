<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php"; 
require_once "v1_webpageroutines.php";


Get_Common_Parameters();
Set_Statics();

# ============= read input v2 ==================================
print "Content-type: text/html\n\n";

$insitename = $_REQUEST['SiteName'];
$insitescriptdirurl = "//".$_REQUEST{"SiteScriptDirURL"};
$inprotocol = $_REQUEST['Protocol'];

$instructure = $_REQUEST['Structure'];
$inrootextradirectory = "";
if (isset($_REQUEST['RootExtraDirectory'])) { $inrootextradirectory = $_REQUEST{"RootExtraDirectory"}; }
$inserver = $_REQUEST['Server'];

$inserviceid = $_REQUEST['ServiceId'];
$inserviceidsuffix = $_REQUEST['ServiceIdSuffix'];
if ( $inserviceidsuffix != "" ) { $GLOBALS{'LOGIN_service_id'} = $inserviceid."-".$inserviceidsuffix; }
else { $GLOBALS{'LOGIN_service_id'} = $inserviceid; }

$GLOBALS{'LOGIN_mode_id'} = $_REQUEST['ModeId'];
$GLOBALS{'LOGIN_domain_id'} = $_REQUEST['DomainId'];
if ($GLOBALS{'LOGIN_domain_id'} == "") {$GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'LOGIN_service_id'};}
if ($GLOBALS{'LOGIN_mode_id'} == "0") {$GLOBALS{'LOGIN_domain_id'} = $GLOBALS{'LOGIN_service_id'};}

$indbname = $_REQUEST['DBName'];
$indbhost = $_REQUEST['DBHost'];
$indbuser = $_REQUEST['DBUser'];
$indbpassword = $_REQUEST['DBPassword'];

$GLOBALS{'site_serviceid'} = $GLOBALS{'LOGIN_service_id'};
$GLOBALS{'site_wwwindexpage'} = "index.html";
$GLOBALS{'site_server'} = $inserver;
$GLOBALS{'site_protocol'} = $inprotocol;

$GLOBALS{'site_wwwurl'} = $insitescriptdirurl;
if ( $instructure == "Normal0" ) {
    $GLOBALS{'site_extradirectory'} = $inrootextradirectory;
    $GLOBALS{'site_filepath'} = "../../cgi-files";
    $GLOBALS{'site_wwwpath'} = "..";
}
if ( $instructure == "Normal1" ) {
    $GLOBALS{'site_extradirectory'} = $inrootextradirectory;
    $GLOBALS{'site_filepath'} = "../../../cgi-files";
    $GLOBALS{'site_wwwpath'} = "..";
}
if ( $instructure == "ExtraDir0" ) {
    $GLOBALS{'site_extradirectory'} = $inrootextradirectory;
    $GLOBALS{'site_filepath'} = "../../cgi-files";
    $GLOBALS{'site_wwwpath'} = "../".$inrootextradirectory;
}
if ( $instructure == "ExtraDir1" ) {
    $GLOBALS{'site_extradirectory'} = $inrootextradirectory;
    $GLOBALS{'site_filepath'} = "../../../cgi-files";
    $GLOBALS{'site_wwwpath'} = "../".$inrootextradirectory;
}
$GLOBALS{'site_phpurl'} =  $insitescriptdirurl."/site_php";	
$GLOBALS{'site_jsurl'} =  $insitescriptdirurl."/site_javascript";
$GLOBALS{'site_cssurl'} =  $insitescriptdirurl."/site_css";
$GLOBALS{'site_tinymceurl'} =  $insitescriptdirurl."/site_tinymce";
$GLOBALS{'site_asseturl'}= $insitescriptdirurl."/site_assets";
$GLOBALS{'site_templateurl'} =  $insitescriptdirurl."/site_template";
$GLOBALS{'site_studiourl'}= $insitescriptdirurl."/site_studio";
$GLOBALS{'site_modeid'} = $GLOBALS{'LOGIN_mode_id'};
$GLOBALS{'site_codeversion'} = "v1";
$GLOBALS{'site_systemdate'} = "SYSTEM";
$GLOBALS{'site_simulation'} = "OFF";
$GLOBALS{'site_testdata'} = "OFF";
$GLOBALS{'site_readonly'} = "OFF";
$GLOBALS{'site_mailserviceurl'} = "";
$GLOBALS{'site_mailservicetoken'} = "";
$GLOBALS{'site_defaultemailaddress'} = "";
$GLOBALS{'site_smsserviceurl'} = "";
$GLOBALS{'site_smsserviceusername'} = "";
$GLOBALS{'site_smsservicepassword'} = "";

$GLOBALS{'site_filepath'} = str_replace("DOT", ".", $GLOBALS{'site_filepath'});
$GLOBALS{'site_filepath'} = str_replace("SLASH", "/", $GLOBALS{'site_filepath'});
$GLOBALS{'site_wwwpath'} = str_replace("DOT", ".", $GLOBALS{'site_wwwpath'});
$GLOBALS{'site_wwwpath'} = str_replace("SLASH", "/", $GLOBALS{'site_wwwpath'});


# ============= replay input ================================
print '<style type="text/css">'."\n"; 
print 'body {background:url(../site_assets/back.jpg) no-repeat;margin-left:250px;margin-top:250px;color:navy;}'."\n"; 
print '</style>'."\n"; 
print '<body>'."\n";
print '<h1>Connective Solutions Site Setup - Part 2 of 2  (Version 1.2)</h1>'."\n";
print '<h2>You specified the following parameters</h2>'."\n";
print '<table border=2>'."\n";
print '<tr><td>Site WWW URL - Site Script Directory URL</td><td>&nbsp;'.$GLOBALS{'site_wwwurl'}.'</td></tr>'."\n";
print '<tr><td>Extra Directory - This is an optional extra directory for multi-site testing</td><td>&nbsp;'.$GLOBALS{'site_extradirectory'}.'</td></tr>'."\n";
print '<tr><td>Opening html page - eg xxx.html</td><td>&nbsp;'.$GLOBALS{'site_wwwindexpage'}.'</td></tr>'."\n";
print '<tr><td>Server name</td><td>&nbsp;'.$GLOBALS{'site_server'}.'</td></tr>'."\n";
print '<tr><td>Protocol</td><td>&nbsp;'.$GLOBALS{'site_protocol'}.'</td></tr>'."\n";
print '<tr><td>PHP Library URL</td><td>&nbsp;'.$GLOBALS{'site_phpurl'}.'</td></tr>'."\n";
print '<tr><td>Javascript Library URL</td><td>&nbsp;'.$GLOBALS{'site_jsurl'}.'</td></tr>'."\n";
print '<tr><td>CSS Library URL</td><td>&nbsp;'.$GLOBALS{'site_cssurl'}.'</td></tr>'."\n";
print '<tr><td>TinyMCE Library URL</td><td>&nbsp;'.$GLOBALS{'site_tinymceurl'}.'</td></tr>'."\n";
print '<tr><td>Assets Library URL</td><td>&nbsp;'.$GLOBALS{'site_asseturl'}.'</td></tr>'."\n";
print '<tr><td>Template Library URL</td><td>&nbsp;'.$GLOBALS{'site_templateurl'}.'</td></tr>'."\n";
print '<tr><td>Studio Library URL</td><td>&nbsp;'.$GLOBALS{'site_studiourl'}.'</td></tr>'."\n";
print '<tr><td>File Path</td><td>&nbsp;'.$GLOBALS{'site_filepath'}.'</td></tr>'."\n";
print '<tr><td>WWW Path</td><td>&nbsp;'.$GLOBALS{'site_wwwpath'}.'</td></tr>'."\n";
print '<tr><td>Service_id</td><td>&nbsp;'.$GLOBALS{'LOGIN_service_id'}.'</td></tr>'."\n";
print '<tr><td>Mode_id</td><td>&nbsp;'.$GLOBALS{'LOGIN_mode_id'}.'</td></tr>'."\n";
print '<tr><td>Domain_id</td><td>&nbsp;'.$GLOBALS{'LOGIN_domain_id'}.'</td></tr>'."\n";
print '<tr><td>FirstName</td><td>&nbsp;'.$_REQUEST['FirstName'].'</td></tr>'."\n";
print '<tr><td>SurName</td><td>&nbsp;'.$_REQUEST['SurName'].'</td></tr>'."\n";
print '<tr><td>DBName</td><td>&nbsp;'.$indbname.'</td></tr>'."\n";
print '<tr><td>DBHost</td><td>&nbsp;'.$indbhost.'</td></tr>'."\n";
print '<tr><td>DBUser</td><td>&nbsp;'.$indbuser.'</td></tr>'."\n";
print '<tr><td>DBPassword</td><td>&nbsp;'.$indbpassword.'</td></tr>'."\n";
print '</table>'."\n";

$password = $_REQUEST['Password'];
if ($password != "C0nnect1ve") {
 print "<h2>invalid password</h2>";
 exit;	
}


# ============= create direcories ================================
print "<p>Step 1 - Create Directories</p>\n";

if ($GLOBALS{'LOGIN_mode_id'} == "0") {$dirindex = $GLOBALS{'LOGIN_service_id'};} else {$dirindex = $GLOBALS{'LOGIN_domain_id'};}
print "<br>".$GLOBALS{'site_filepath'}."\n";
mkdir($GLOBALS{'site_filepath'});
print "<br>".$GLOBALS{'site_filepath'}."/".$dirindex."\n";
mkdir($GLOBALS{'site_filepath'}."/".$dirindex);
print "<br>".$GLOBALS{'site_filepath'}."/".$dirindex."/personphotos"."\n";
mkdir($GLOBALS{'site_filepath'}."/".$dirindex."/personphotos", 0777);
print "<br>".$GLOBALS{'site_filepath'}."/".$dirindex."/assets"."\n";
mkdir($GLOBALS{'site_filepath'}."/".$dirindex."/assets", 0777);
print "<br>".$GLOBALS{'site_filepath'}."/".$dirindex."/mpdfreports"."\n";
mkdir($GLOBALS{'site_filepath'}."/".$dirindex."/mpdfreports", 0777);
print "<br>".$GLOBALS{'site_filepath'}."/".$dirindex."/plugins"."\n";
mkdir($GLOBALS{'site_filepath'}."/".$dirindex."/plugins", 0777);

# ============= create databases ================================

print "<p>Step 2 - Create Database</p>\n";

$GLOBALS{'IOERRORcode'} = "G002";
$GLOBALS{'IOERRORmessage'} = "siteconfref.txt problem";
$siteconfref = Open_File_Write ("siteconfref.txt");
$siteconfreftext = str_replace("/cgi-files", "", $GLOBALS{'site_filepath'});
// XH1($siteconfreftext);
Write_File ($siteconfref,$siteconfreftext);
Close_File_Write($siteconfref);
$GLOBALS{'IOERRORcode'} = "G003";
$GLOBALS{'IOERRORmessage'} = "siteconf.txt problem";
// XH1($GLOBALS{'site_filepath'}."/siteconf.txt");
$sqlconnect = Open_File_Write ($GLOBALS{'site_filepath'}."/siteconf.txt");
$dbuser = XCrypt($indbuser,"c0nnect1ve","encrypt");
$dbpassword = XCrypt($indbpassword,"c0nnect1ve","encrypt");
// XH1($indbname."|".$indbhost."|".$dbuser."|".$dbpassword."|"."E");
Write_File ($sqlconnect,$indbname."|".$indbhost."|".$dbuser."|".$dbpassword."|"."E");
Close_File_Write($sqlconnect);

if (strlen(strstr($indbname,"multidb"))>0) {
    $indbname = str_replace("multidb", $GLOBALS{'LOGIN_service_id'}, $indbname); # for testing setup  
}
// XH2($indbname." ".$indbhost." ".$indbuser." ".$indbpassword);
IODBCONNECT($indbname,$indbhost,$indbuser,$indbpassword);
# print "connect successful";
Setup_SQL_DBSCHEMA($indbname);
print "<p>Step 2.1 - SQL dbschema loaded</p>\n";
Load_Site_Data("service");
if ( ($GLOBALS{'site_serviceid'} == "ocz" )||($GLOBALS{'site_serviceid'} == "grl" )) {
	Load_Site_Data("sport");
}
print "<p>Step 2.2 - Service Descriptions loaded</p>\n";
IOSETUP();

# ============= create site db record ================================
Write_Data("site_".$GLOBALS{'LOGIN_service_id'});

if ($GLOBALS{'LOGIN_mode_id'} == "0") {Get_Data("service_".$inserviceid."SITE");} 
else {Get_Data("service_".$inserviceid."DOMAIN");}

if ($GLOBALS{'site_extradirectory'} == "") {$slashplusurlrootdirectory = "";}
else {$slashplusurlrootdirectory = "/".$GLOBALS{'site_extradirectory'};}

if ($GLOBALS{'LOGIN_mode_id'} == "0") {
    $GLOBALS{'domainwwwurl'}= $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory;
    $GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory;
    $GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'};
    $GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'};
}
if ($GLOBALS{'LOGIN_mode_id'} == "1") {
    $GLOBALS{'domainwwwurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory;
    $GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory;
    $GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'};
    $GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'};
}

if ($GLOBALS{'domainwwwpath'} != "..") {
    print "<br>".$GLOBALS{'domainwwwpath'}."\n";
    mkdir($GLOBALS{'domainwwwpath'}, 0777);
}
print "<br>".$GLOBALS{'domainwwwpath'}."/domain_advertisers"."\n";
mkdir($GLOBALS{'domainwwwpath'}."/domain_advertisers", 0777);
print "<br>".$GLOBALS{'domainwwwpath'}."/domain_frs"."\n";
mkdir($GLOBALS{'domainwwwpath'}."/domain_frs", 0777);
print "<br>".$GLOBALS{'domainwwwpath'}."/domain_media"."\n";
mkdir($GLOBALS{'domainwwwpath'}."/domain_media", 0777);
print "<br>".$GLOBALS{'domainwwwpath'}."/domain_shop"."\n";
mkdir($GLOBALS{'domainwwwpath'}."/domain_shop", 0777);
print "<br>".$GLOBALS{'domainwwwpath'}."/domain_style"."\n";
mkdir($GLOBALS{'domainwwwpath'}."/domain_style", 0777);
print "<br>".$GLOBALS{'domainwwwpath'}."/domain_temp"."\n";
mkdir($GLOBALS{'domainwwwpath'}."/domain_temp", 0777);

$GLOBALS{'codeversion'} = "v1";

if ($GLOBALS{'site_systemdate'} == "SYSTEM") {	
 date_default_timezone_set('UTC');		
 $GLOBALS{'dd'}=date("d"); $GLOBALS{'mm'}=date("m"); $GLOBALS{'yyyy'}=date("Y"); $GLOBALS{'yy'}=date("y");
 $GLOBALS{'actdd'}=date("d"); $GLOBALS{'actmm'}=date("m"); $GLOBALS{'actyyyy'}=date("Y"); $GLOBALS{'actyy'}=date("y");
} else {
 $bits = str_split($GLOBALS{'site_systemdate'}); 		
 $GLOBALS{'dd'}=$bits[6].$bits[7]; $GLOBALS{'mm'}=$bits[4].$bits[5]; $GLOBALS{'yyyy'}=$bits[0].$bits[1].$bits[2].$bits[3]; $GLOBALS{'yy'}=$bits[2].$bits[3];  
 $GLOBALS{'actdd'}=date("d"); $GLOBALS{'actmm'}=date("m"); $GLOBALS{'actyyyy'}=date("Y"); $GLOBALS{'actyy'}=date("y");
}
$GLOBALS{'acthh'}=date("H");
$GLOBALS{'actmi'}=date("i");
$GLOBALS{'actss'}=date("s");
$GLOBALS{'currentYYYYMMDD'} = $GLOBALS{'yyyy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'};
$GLOBALS{'currentYYYYMMDDHHMMSS'} = $GLOBALS{'yyyy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'};
$GLOBALS{'currentYYYY-MM-DD'} = $GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}; 
$GLOBALS{'STATIC_1900'} = ""; $sep = "";
$dateyy=$GLOBALS{'yy'}; $datemm=$GLOBALS{'mm'}; $datedd=$GLOBALS{'dd'};

Initialise_Data('person');
$tperson_fname = strtolower($_REQUEST['FirstName']);
$tperson_sname = strtolower($_REQUEST['SurName']);
$fnamebits = str_split($tperson_fname);
$snamebits = str_split($tperson_sname);
$GLOBALS{'LOGIN_person_id'} = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2];
$randompassword = "Gem1n1";
$GLOBALS{'person_id'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'person_fname'} = $_REQUEST['FirstName'];
$GLOBALS{'person_sname'} = $_REQUEST['SurName'];
$GLOBALS{'person_password'} = XCrypt($randompassword,$GLOBALS{'LOGIN_person_id'},"encrypt");
$GLOBALS{'person_passwordclue'} = "Initial Setup";
$GLOBALS{'person_passworddate'} = $GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}; 
Write_Data("person",$GLOBALS{'LOGIN_person_id'});

$GLOBALS{'domain_id'} = $GLOBALS{'LOGIN_domain_id'};
$GLOBALS{'domain_longname'} = $insitename;
$GLOBALS{'domain_shortname'} = substr($insitename, 0, 12);
$GLOBALS{'domain_modeid'} = $GLOBALS{'LOGIN_mode_id'};
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
$GLOBALS{'domain_personmassnotifyintro'} = "";
$GLOBALS{'domain_contactid'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'domain_currperiodid'} = "20".$GLOBALS{'actyy'};
$GLOBALS{'domain_urlrootdirectory'} = $urlrootdirectory;  // CHECK
$GLOBALS{'domain_emailblocksize'} = "200";
$GLOBALS{'domain_timeoutminutes'} = "90";
Write_Data("domain");

$GLOBALS{'commsmasters_domainid'} = $GLOBALS{'LOGIN_domain_id'};
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
Write_Data("commsmasters");

$GLOBALS{'librarysection_domainid'} = $GLOBALS{'LOGIN_domain_id'};
$GLOBALS{'librarysection_id'} = "libraryroot";
$GLOBALS{'librarysection_title'} = "Library";
$GLOBALS{'librarysection_editor'} = "";
$GLOBALS{'librarysection_subeditors'} = "";
$GLOBALS{'librarysection_hide'} = "";
$GLOBALS{'librarysection_chain'} = "libraryroot";
$GLOBALS{'librarysection_sequence'} = "1010";
Write_Data("librarysection","libraryroot");

$GLOBALS{'section_domainid'} = $GLOBALS{'LOGIN_domain_id'};
$GLOBALS{'section_periodid'} = "20".$GLOBALS{'actyy'};
$GLOBALS{'section_name'} = $GLOBALS{'LOGIN_domain_id'};
$GLOBALS{'section_leader'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'section_personmgrs'} = "";
$GLOBALS{'section_type'} = "";
$GLOBALS{'section_exdir'} = "";
$GLOBALS{'section_seq'} = "1";
Write_Data("section","20".$GLOBALS{'actyy'},$GLOBALS{'LOGIN_domain_id'});

$GLOBALS{'menu_domainid'} = $dirindex;
$GLOBALS{'menu_id'} = "M00001";
$GLOBALS{'menu_position'} = "NavTopMenu";
$GLOBALS{'menu_style'} = "NavTopStyle";
$GLOBALS{'menu_title'} = "Main Menu";
$GLOBALS{'menu_hide'} = "Display";
Write_Data('menu',"M00001");
$GLOBALS{'menu_id'} = "M00002";
$GLOBALS{'menu_position'} = "FooterMenu1";
$GLOBALS{'menu_style'} = "FooterStyle";
$GLOBALS{'menu_title'} = "Footer 1";
$GLOBALS{'menu_hide'} = "Display";
Write_Data('menu',"M00002");
$GLOBALS{'menu_id'} = "M00003";
$GLOBALS{'menu_position'} = "FooterMenu2";
$GLOBALS{'menu_style'} = "FooterStyle";
$GLOBALS{'menu_title'} = "Footer 2";
$GLOBALS{'menu_hide'} = "Display";
Write_Data('menu',"M00003");
$GLOBALS{'menu_id'} = "M00004";
$GLOBALS{'menu_position'} = "FooterMenu3";
$GLOBALS{'menu_style'} = "FooterStyle";
$GLOBALS{'menu_title'} = "Footer 3";
$GLOBALS{'menu_hide'} = "Display";
Write_Data('menu',"M00004");
$GLOBALS{'menu_id'} = "M00005";
$GLOBALS{'menu_position'} = "FooterMenu4";
$GLOBALS{'menu_style'} = "FooterStyle";
$GLOBALS{'menu_title'} = "Footer 4";
$GLOBALS{'menu_hide'} = "Display";
Write_Data('menu',"M00005");

$GLOBALS{'menuitem_domainid'} = $dirindex;
$GLOBALS{'menuitem_menuid'} = "M00001";
$GLOBALS{'menuitem_id'} = "MI00001";
$GLOBALS{'menuitem_parentmenuitemname'} = "";
$GLOBALS{'menuitem_seq'} = "1";
$GLOBALS{'menuitem_text'} = "Home";
$GLOBALS{'menuitem_targettype'} = "Webpage";
$GLOBALS{'menuitem_webpagename'} = "Home";
$GLOBALS{'menuitem_url'} = "";
$GLOBALS{'menuitem_hide'} = "Display";
Write_Data('menuitem',"M00001","MI00001");

$GLOBALS{'menuitem_domainid'} = $dirindex;
$GLOBALS{'menuitem_menuid'} = "M00001";
$GLOBALS{'menuitem_id'} = "MI00002";
$GLOBALS{'menuitem_parentmenuitemname'} = "";
$GLOBALS{'menuitem_seq'} = "9";
$GLOBALS{'menuitem_text'} = "Login";
$GLOBALS{'menuitem_targettype'} = "Login";
$GLOBALS{'menuitem_webpagename'} = "";
$GLOBALS{'menuitem_url'} = "";
$GLOBALS{'menuitem_hide'} = "Display";
Write_Data('menuitem',"M00001","MI00002");

$GLOBALS{'menuitem_domainid'} = $dirindex;
$GLOBALS{'menuitem_menuid'} = "M00002";
$GLOBALS{'menuitem_id'} = "MI00003";
$GLOBALS{'menuitem_parentmenuitemname'} = "";
$GLOBALS{'menuitem_seq'} = "1";
$GLOBALS{'menuitem_text'} = "Footer1";
$GLOBALS{'menuitem_targettype'} = "Webpage";
$GLOBALS{'menuitem_webpagename'} = "Home";
$GLOBALS{'menuitem_url'} = "";
$GLOBALS{'menuitem_hide'} = "Display";
Write_Data('menuitem',"M00002","MI00003");

$GLOBALS{'menuitem_domainid'} = $dirindex;
$GLOBALS{'menuitem_menuid'} = "M00003";
$GLOBALS{'menuitem_id'} = "MI00004";
$GLOBALS{'menuitem_parentmenuitemname'} = "";
$GLOBALS{'menuitem_seq'} = "1";
$GLOBALS{'menuitem_text'} = "Footer2";
$GLOBALS{'menuitem_targettype'} = "Webpage";
$GLOBALS{'menuitem_webpagename'} = "Home";
$GLOBALS{'menuitem_url'} = "";
$GLOBALS{'menuitem_hide'} = "Display";
Write_Data('menuitem',"M00003","MI00004");

$GLOBALS{'menuitem_domainid'} = $dirindex;
$GLOBALS{'menuitem_menuid'} = "M00004";
$GLOBALS{'menuitem_id'} = "MI00005";
$GLOBALS{'menuitem_parentmenuitemname'} = "";
$GLOBALS{'menuitem_seq'} = "1";
$GLOBALS{'menuitem_text'} = "Footer3";
$GLOBALS{'menuitem_targettype'} = "Webpage";
$GLOBALS{'menuitem_webpagename'} = "Home";
$GLOBALS{'menuitem_url'} = "";
$GLOBALS{'menuitem_hide'} = "Display";
Write_Data('menuitem',"M00004","MI00005");

$GLOBALS{'menuitem_domainid'} = $dirindex;
$GLOBALS{'menuitem_menuid'} = "M00005";
$GLOBALS{'menuitem_id'} = "MI00006";
$GLOBALS{'menuitem_parentmenuitemname'} = "";
$GLOBALS{'menuitem_seq'} = "1";
$GLOBALS{'menuitem_text'} = "Footer4";
$GLOBALS{'menuitem_targettype'} = "Webpage";
$GLOBALS{'menuitem_webpagename'} = "Home";
$GLOBALS{'menuitem_url'} = "";
$GLOBALS{'menuitem_hide'} = "Display";
Write_Data('menuitem',"M00005","MI00006");

$GLOBALS{'carousel_domainid'} = $dirindex;
$GLOBALS{'carousel_name'} = "Home";
$GLOBALS{'carousel_height'} = "768";
$GLOBALS{'carousel_width'} = "1024";
$GLOBALS{'carousel_type'} = "Parallax";
$GLOBALS{'carousel_imagerandomise'} = "Yes";
$GLOBALS{'carousel_speed'} = "10000";
$GLOBALS{'carousel_headertextcolor'} = "black";
$GLOBALS{'carousel_textcolor'} = "black";
$GLOBALS{'carousel_buttonbordercolor'} = "black";
$GLOBALS{'carousel_buttonfillcolor'} = "white";
$GLOBALS{'carousel_buttontextcolor'} = "blabk";
Write_Data('carousel',"Home");

print "<br>../site_assets/cshomeback.png<br>".$GLOBALS{'domainwwwpath'}."/domain_style/Carousel_Home-CI00001_cshomeback_FixedSize_1024x768.png<br>";
copy("../site_assets/cshomeback.png", $GLOBALS{'domainwwwpath'}."/domain_style/Carousel_Home-CI00001_cshomeback_FixedSize_1024x768.png");
$GLOBALS{'carouselimg_domainid'} = $dirindex;
$GLOBALS{'carouselimg_carouselname'} = "Home";
$GLOBALS{'carouselimg_id'} = "CI00001";
$GLOBALS{'carouselimg_seq'} = "1";
$GLOBALS{'carouselimg_img'} = "Carousel_Home-CI00001_cshomeback_FixedSize_1024x768.png";
$GLOBALS{'carouselimg_header'} = "Welcome to ".$insitename;
$GLOBALS{'carouselimg_text'} = "The site is now ready for you to configure";
$GLOBALS{'carouselimg_buttontext'} = "Read More";
$GLOBALS{'carouselimg_buttonlink'} = "http://www.connectivesolutions.co.uk";
Write_Data('carouselimg',"Home","CI00001");

$GLOBALS{'carousel_domainid'} = $dirindex;
$GLOBALS{'carousel_name'} = "Default";
$GLOBALS{'carousel_height'} = "150";
$GLOBALS{'carousel_width'} = "1024";
$GLOBALS{'carousel_type'} = "Image";
$GLOBALS{'carousel_imagerandomise'} = "No";
$GLOBALS{'carousel_speed'} = "1000";
$GLOBALS{'carousel_headertextcolor'} = "black";
$GLOBALS{'carousel_textcolor'} = "";
$GLOBALS{'carousel_buttonbordercolor'} = "";
$GLOBALS{'carousel_buttonfillcolor'} = "";
$GLOBALS{'carousel_buttontextcolor'} = "";
Write_Data('carousel',"Default");

print "<br>../site_assets/csdefaultback.png<br>".$GLOBALS{'domainwwwpath'}."/domain_style/Carousel_Default-CI00002_csdefaultback_FixedSize_1024x150.png<br>";
copy("../site_assets/csdefaultback.png", $GLOBALS{'domainwwwpath'}."/domain_style/Carousel_Default-CI00002_csdefaultback_FixedSize_1024x150.png");
$GLOBALS{'carouselimg_domainid'} = $dirindex;
$GLOBALS{'carouselimg_carouselname'} = "Default";
$GLOBALS{'carouselimg_id'} = "CI00002";
$GLOBALS{'carouselimg_seq'} = "1";
$GLOBALS{'carouselimg_img'} = "Carousel_Default-CI00002_csdefaultback_FixedSize_1024x150.png";
$GLOBALS{'carouselimg_header'} = "";
$GLOBALS{'carouselimg_text'} = "";
$GLOBALS{'carouselimg_buttontext'} = "";
$GLOBALS{'carouselimg_buttonlink'} = "";
Write_Data('carouselimg',"Default","CI00002");

$GLOBALS{'template_domainid'} = $dirindex;
$GLOBALS{'template_status'} = "Final";
$GLOBALS{'template_name'} = "Home";
$GLOBALS{'template_navtopmenuenabled'} = "Yes";
// $GLOBALS{'template_carouselenabled'} = "Yes";
$GLOBALS{'template_fullwidthenabled'} = "Yes";
$GLOBALS{'template_headercarouselname'} = "Home";
$GLOBALS{'template_footermenuquantity'} = "4";
$GLOBALS{'template_sidebar'} = "";
$GLOBALS{'template_sidebarwidth'} = "";
Write_Data('template',"Final","Home");

$GLOBALS{'template_domainid'} = $dirindex;
$GLOBALS{'template_status'} = "Final";
$GLOBALS{'template_name'} = "Default";
$GLOBALS{'template_navtopmenuenabled'} = "Yes";
// $GLOBALS{'template_carouselenabled'} = "Yes";
$GLOBALS{'template_fullwidthenabled'} = "Yes";
$GLOBALS{'template_headercarouselname'} = "Default";
$GLOBALS{'template_footermenuquantity'} = "4";
$GLOBALS{'template_sidebar'} = "";
$GLOBALS{'template_sidebarwidth'} = "";
Write_Data('template',"Final","Default"); 

$GLOBALS{'template_domainid'} = $dirindex;
$GLOBALS{'template_status'} = "Final";
$GLOBALS{'template_name'} = "HomeSidebarRight";
$GLOBALS{'template_navtopmenuenabled'} = "Yes";
// $GLOBALS{'template_carouselenabled'} = "Yes";
$GLOBALS{'template_fullwidthenabled'} = "Yes";
$GLOBALS{'template_headercarouselname'} = "Home";
$GLOBALS{'template_footermenuquantity'} = "4";
$GLOBALS{'template_sidebar'} = "Right";
$GLOBALS{'template_sidebarwidth'} = "25%";
Write_Data('template',"Final","HomeSidebarRight");

$GLOBALS{'template_domainid'} = $dirindex;
$GLOBALS{'template_status'} = "Final";
$GLOBALS{'template_name'} = "DefaultSidebarRight";
$GLOBALS{'template_navtopmenuenabled'} = "Yes";
// $GLOBALS{'template_carouselenabled'} = "Yes";
$GLOBALS{'template_fullwidthenabled'} = "Yes";
$GLOBALS{'template_headercarouselname'} = "Default";
$GLOBALS{'template_footermenuquantity'} = "4";
$GLOBALS{'template_sidebar'} = "Right";
$GLOBALS{'template_sidebarwidth'} = "25%";
Write_Data('template',"Final","DefaultSidebarRight"); 

$GLOBALS{'template_domainid'} = $dirindex;
$GLOBALS{'template_status'} = "Final";
$GLOBALS{'template_name'} = "HomeSidebarLeft";
$GLOBALS{'template_navtopmenuenabled'} = "Yes";
// $GLOBALS{'template_carouselenabled'} = "Yes";
$GLOBALS{'template_fullwidthenabled'} = "Yes";
$GLOBALS{'template_headercarouselname'} = "Home";
$GLOBALS{'template_footermenuquantity'} = "4";
$GLOBALS{'template_sidebar'} = "Left";
$GLOBALS{'template_sidebarwidth'} = "25%";
Write_Data('template',"Final","HomeSidebarLeft");

$GLOBALS{'template_domainid'} = $dirindex;
$GLOBALS{'template_status'} = "Final";
$GLOBALS{'template_name'} = "DefaultSidebarLeft";
$GLOBALS{'template_navtopmenuenabled'} = "Yes";
// $GLOBALS{'template_carouselenabled'} = "Yes";
$GLOBALS{'template_fullwidthenabled'} = "Yes";
$GLOBALS{'template_headercarouselname'} = "Default";
$GLOBALS{'template_footermenuquantity'} = "4";
$GLOBALS{'template_sidebar'} = "Left";
$GLOBALS{'template_sidebarwidth'} = "25%";
Write_Data('template',"Final","DefaultSidebarLeft"); 

$GLOBALS{'webpage_domainid'} = $dirindex;
$GLOBALS{'webpage_name'} = "Home";
$GLOBALS{'webpage_userid'} = $GLOBALS{'LOGIN_person_id'};
$GLOBALS{'webpage_address'} = "index.html";
$GLOBALS{'webpage_hide'} = "Display";
$GLOBALS{'webpage_fixedformat'} = "";
$GLOBALS{'webpage_sequence'} = "1010";
$GLOBALS{'webpage_controller'} = "";
$GLOBALS{'webpage_buttext'} = "";
$GLOBALS{'webpage_bannertext'} = "";
$GLOBALS{'webpage_webstyleid'} = "";
$GLOBALS{'webpage_specialfilename'} = "";
$GLOBALS{'webpage_webstylename'} = "Default";
$GLOBALS{'webpage_format'} = "5";
$GLOBALS{'webpage_html'} = "";
$GLOBALS{'webpage_templatename'} = "Home";
$GLOBALS{'webpage_oldaddress'} = "";
$GLOBALS{'webpage_oldhtml'} = "";
Write_Data('webpage',"Home"); 
print "<p>Step 2.3 - SQL Data loaded\n";

Get_Data('menu',"M00001");
Webpage_MENUPUBLISH_Output("M00001");
Get_Data('menu',"M00002");
Webpage_MENUPUBLISH_Output("M00002");
Get_Data('menu',"M00003");
Webpage_MENUPUBLISH_Output("M00003");
Get_Data('menu',"M00004");
Webpage_MENUPUBLISH_Output("M00004");
Get_Data('menu',"M00005");
Webpage_MENUPUBLISH_Output("M00005");


print "<p>Step 2.4 - Website Menus created\n";

Webpage_TEMPLATEPUBLISH_Output("Final","Default");
Webpage_TEMPLATEPUBLISH_Output("Final","Home");
Webpage_WEBPAGEPUBLISHALL_Output();
print "<p>Step 2.5 - Web Style applied\n";

# SetPrivileges();
print "<p>Step 2.6 - File privileges checked\n";

print "<h3>Congratulations - your new site has now been established</h4>";
print 'Please take a note of the Initial Password for "'.$GLOBALS{'LOGIN_person_id'}.'" - "'.$randompassword.'" for future reference.</BR>';
$link = YPGMLINK("personloginout.php");
$link = $link.YPGMFIRSTPARM("ServiceId",$GLOBALS{'LOGIN_service_id'}).YPGMPARM("DomainId",$GLOBALS{'LOGIN_domain_id'}).YPGMPARM("PersonId",$GLOBALS{'LOGIN_person_id'}).YPGMPARM("ModeId",$GLOBALS{'LOGIN_mode_id'}).YPGMPARM("LoginModeId","");
XP();XLINKTXT($link,"This link will now take you there");X_P();
print '</body>'."\n";


function Setup_SQL_DBSCHEMA($dbname) {
$databaseschema = Array();
$fullfilename = "../site_sql/sqldesign.csv";
$GLOBALS{'IOERRORcode'} = "G033";
$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
$records = Get_File_Array("$fullfilename");
foreach ($records as $recordelement) {	
 $upmessage = CSV_In_Filter($recordelement);
 # end of the tidy up
 $ibits = explode("|",$upmessage);
 if ($ibits[0] == "databasename") {
# CREATE DATABASE contractorweb;
# USE contractorweb;
  $outmessage = "CREATE DATABASE ".$dbname.";";
  array_push ($databaseschema,$outmessage);
  $outmessage = "USE ".$dbname.";";
  array_push ($databaseschema,$outmessage);
  if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
  else { $serviceid = $GLOBALS{'LOGIN_service_id'}; } 
  for ($idb = 9; $idb < 22; $idb++) { 
    if ($ibits[$idb] == $serviceid) {$idbindex = $idb;}	
  }  
 }
 if (($ibits[0] == "structureheader")&&($ibits[$idbindex] == $serviceid)) {
# CREATE TABLE customers (
  $outmessage = "CREATE TABLE ".$ibits[1]." (";
  array_push ($databaseschema,$outmessage);
  $primarykeystring = ""; $sep = "";	
 }   
 if (($ibits[0] == "structurefield")&&($ibits[$idbindex] == $serviceid)) {
# user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  if ($ibits[4] == "NO") {$nullfield = "NOT NULL";} else {$nullfield = "";}    
  $outmessage = $ibits[2]." ".$ibits[3]." ".$nullfield." ".$ibits[7].",";
  array_push ($databaseschema,$outmessage);
  if ($ibits[5] == "PRI") {
   $primarykeystring = $primarykeystring.$sep.$ibits[2];
   $sep = ",";  	    
  }
 }
 if (($ibits[0] == "structureend")&&($ibits[$idbindex] == $serviceid)) {
# PRIMARY KEY (user_id)
# );
  $outmessage = "PRIMARY KEY (".$primarykeystring.")";
  array_push ($databaseschema,$outmessage);
  if ($ibits[7] != "") { $outmessage = "); ENGINE=".$ibits[7]; }
  else {$outmessage = ");";}
  array_push ($databaseschema,$outmessage);
 }
}
# print "<p>SQL dbschema input created\n";
# foreach ($databaseschema as $databaseschemaelement) {print "<br>$databaseschemaelement\n";}
$GLOBALS{'IOWARNING'} = "0";
$query = "DROP DATABASE ".$dbname.";";
XTXT($query);XBR();
IOSQLCMD($query);
if ($GLOBALS{'IOWARNING'} == "0") {print '<p>Step 2.0 - Existing "'.$dbname.'" DB deleted OK</p>'."\n";}

$query = ""; 
$GLOBALS{'IOERRORcode'} = "G005"; 
$GLOBALS{'IOERRORmessage'} = $query;
foreach ($databaseschema as $databaseschemaelement) {	
 $query = $query.$databaseschemaelement;
 if (strpos($query, ';') !== false) { 	
 	# print "<br>$query\n";
 	XTXT($query);XBR();
 	IOSQLCMD($query);
 	$query = "";
 } 
}
print "<p>SQL dbschema loaded</p>\n";
}

function Load_Site_Data($table) {
$fullfilename = "../site_sql/setup_".$table."_sql.txt";
$file_handle = fopen($fullfilename, "r");
while (!feof($file_handle)) {
    $query = fgets($file_handle);
    // INSERT INTO service VALUES ('kbSITE',
    if ((strlen(strstr($query,$_REQUEST['ServiceId']."SITE"))>0)||(strlen(strstr($query,$_REQUEST['ServiceId']."DOMAIN"))>0)) {
        XTXT($query);XBR();
        IOSQLCMD($query);
    }
}
fclose($file_handle);

print "<p>SQL setup data loaded</p>\n";
}


?>