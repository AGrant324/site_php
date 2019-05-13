<?php # personloginselectin.php

// Common libraries
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_setuproutines.php');
require_once('v1_webpageroutines.php');
require_once('v1_siteroutines.php');
require_once('v1_actionroutines.php');
require_once('v1_libraryroutines.php');
require_once('v1_reportroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');
// Specific libraries
if (file_exists('v1_bookingroutines.php')) { include_once('v1_bookingroutines.php'); }
if (file_exists('v1_shoproutines.php')) { include_once('v1_shoproutines.php'); }
if (file_exists('v1_reportroutines.php')) { include_once('v1_reportroutines.php'); }
if (file_exists('v1_processroutines.php')) { include_once('v1_processroutines.php'); }
if (file_exists('v1_finroutines.php')) { include_once('v1_finroutines.php'); }
if (file_exists('v1_auctionroutines.php')) { include_once('v1_auctionroutines.php'); }
if (file_exists('v1_posroutines.php')) { include_once('v1_posroutines.php'); }
if (file_exists('v1_frsroutines.php')) { include_once('v1_frsroutines.php'); }
if (file_exists('v1_corroutines.php')) { include_once('v1_corroutines.php'); }
if (file_exists('v1_dmwsroutines.php')) { include_once('v1_dmwsroutines.php'); }
if (file_exists('v1_grlroutines.php')) { include_once('v1_grlroutines.php'); }
if (file_exists('v1_careroutines.php')) { include_once('v1_careroutines.php'); }
if (file_exists('v1_sfmroutines.php')) { include_once('v1_sfmroutines.php'); }

Get_Common_Parameters();
GlobalRoutine();

$selectid = $_REQUEST['SelectId'];
$selectparm = ""; if (isset($_REQUEST['SelectParm'])) { $selectparm = $_REQUEST['SelectParm']; }
if ($selectid == "CLASSICMENU") { $GLOBALS{'LOGIN_menu_id'} = "Classic"; Person_Login_Select_CSSJS(); }
if ($selectid == "DASHBOARD") { $GLOBALS{'LOGIN_menu_id'} = "Dashboard"; Person_Login_Select_CSSJS(); }

if ($selectid == "ACCOUNT") { GenericHandler_CSSJS(); }
if ($selectid == "DOMAINMASTERS") { Setup_DOMAINMASTERS_CSSJS(); }
if ($selectid == "COMMSMASTERS") { Setup_COMMSMASTERS_CSSJS(); }
if ($selectid == "SPORT") { GenericHandler_CSSJS(); }

if ($selectid == "PERSONTYPES") { Setup_PERSONTYPES_CSSJS(); }
if ($selectid == "PERSONUSERLEVEL") { Setup_PERSONUSERLEVEL_CSSJS(); }
if ($selectid == "ETHNICITY") { Setup_ETHNICITY_CSSJS(); }
if ($selectid == "DISABILITY") { Setup_DISABILITY_CSSJS(); }
if ($selectid == "MEMBERSHIPFORMTEXT") { Setup_MEMBERSHIPFORMTEXT_CSSJS(); }
if ($selectid == "SETUPJOBROLE") { Setup_JOBROLE_CSSJS(); }
if ($selectid == "SETUPQUALIFICATION") { Setup_QUALIFICATION_CSSJS(); }
if ($selectid == "SETUPJOBROLEQUALIFICATION") {	Setup_JOBROLEQUALIFICATION_CSSJS(); }

if ($selectid == "MYPROFILE") { Person_MYPROFILE_CSSJS(); }
if ($selectid == "MYJOBROLE") { Person_MYJOBROLE_CSSJS(); }
if ($selectid == "MYQUALIFICATION") { Person_MYQUALIFICATION_CSSJS(); }
if ($selectid == "MYQUALIFICATIONREPORT") { Person_Qualification_Report_CSSJS();}
if ($selectid == "MYTEAM") { Person_MYTEAM_CSSJS(); }
if ($selectid == "MYGROUP") { Person_MYGROUP_CSSJS(); }
if ($selectid == "MYAVAILABILITY") { Person_MYAVAILABILITY_CSSJS(); }
if ($selectid == "MYSTATS") { Person_MYSTATS_CSSJS(); }
if ($selectid == "MYPREFERENCES") { Person_MYPREFERENCES_CSSJS(); }

if ($selectid == "PERSONCHANGESEARCH") { Person_CHANGESEARCH_CSSJS(); }
if ($selectid == "PERSONDELETESEARCH") { Person_DELETESEARCH_CSSJS(); }
if ($selectid == "PERSONSEARCH") { Person_SEARCH_CSSJS(); }
if ($selectid == "PERSONEMAIL") { Person_SE_CSSJS(); }
if ($selectid == "MYPASSWORD") { Person_PW_CSSJS(); }
if ($selectid == "PERSONJOBROLE") { Person_JOBROLE_CSSJS(); }
if ($selectid == "PERSONQUALIFICATION") { Person_QUALIFICATION_CSSJS(); }
if ($selectid == "PERSONQUALIFICATIONREPORT") { Person_Qualification_Report_CSSJS();}
if ($selectid == "MEMBERSHIPANALYSIS") { GenericHandler_CSSJS(); }

if ($selectid == "LIBRARYVIEW") { Library_LIBRARYINDEX_CSSJS(); }
if ($selectid == "LIBRARYMAINTAIN") { Library_LIBRARYINDEX_CSSJS(); }
if ($selectid == "ACCREDVIEW") { Library_ACCREDVIEWLIST_CSSJS(); }
if ($selectid == "LIBRARYSECTION") { Setup_LIBRARYSECTION_CSSJS(); }
if ($selectid == "ACCREDSCHEME") { Setup_ACCREDSCHEME_CSSJS(); } 
if ($selectid == "ACCREDMAINTAIN") { Library_ACCREDVIEWLIST_CSSJS(); }
if ($selectid == "ACCREDINSPECT") { Library_ACCREDVIEWLIST_CSSJS(); }

if ($selectid == "ORG") { Setup_ORG_CSSJS(); }
if ($selectid == "ORGDETAIL") { Setup_ORGDETAIL_CSSJS(); }
if ($selectid == "SECTION") { Setup_SECTION_CSSJS(); }
if ($selectid == "SECTIONGROUP") { Setup_SECTIONGROUP_CSSJS(); }
if ($selectid == "TEAM") { Setup_TEAM_CSSJS(); }
if ($selectid == "DEMOCALENDAR") { Demo_DEMOCALENDAR_CSSJS(); }
if ($selectid == "PAYMENTOPTION") { GenericHandler_CSSJS(); }
if ($selectid == "VENUE") { Setup_VENUE_CSSJS(); }

if ($selectid == "ADVERTISER") { Setup_ADVERTISER_CSSJS(); }
if ($selectid == "ADVERTISERCATEGORY") { GenericHandler_CSSJS(); }

if ($selectid == "SETUPAUCTIONEVENT") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPAUCTIONCATEGORY") { GenericHandler_CSSJS(); }
if ($selectid == "MANAGEAUCTIONINPUTS") { Auction_MANAGEAUCTIONINPUTS_CSSJS(); }
if ($selectid == "MANAGEAUCTIONCATALOGUE") { Auction_MANAGEAUCTIONCATALOGUE_CSSJS(); }
if ($selectid == "MANAGEAUCTIONSALES") { Auction_MANAGEAUCTIONSALES_CSSJS(); }
if ($selectid == "TEMPLATEUTILITY") { Webpage_TEMPLATEUTILITY_CSSJS(); }
if ($selectid == "TEMPLATEELEMENTUTILITY") { Webpage_TEMPLATEELEMENTUTILITY_CSSJS(); }
if ($selectid == "CAROUSELUPDATE") { GenericHandler_CSSJS(); }
if ($selectid == "WEBPAGEUTILITY") { Webpage_WEBPAGEUTILITY_CSSJS(); }
if ($selectid == "MENUUPDATE") { GenericHandler_CSSJS(); }
if ($selectid == "KBSECTION") { Setup_KBSECTION_CSSJS(); }
if ($selectid == "PLUGINCATEGORY") { Webpage_PLUGINCATEGORY_CSSJS(); }
if ($selectid == "PLUGINUTILITY") { Webpage_PLUGINUTILITY_CSSJS(); }

if ($selectid == "SETUPBULLETINBOARD") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPARTICLECATEGORY") { GenericHandler_CSSJS(); }
if ($selectid == "ARTICLEUTILITY") { Webpage_ARTICLEUTILITY_CSSJS(); }
if ($selectid == "SETUPEVENTCATEGORY") {  Webpage_SETUPEVENTCATEGORY_CSSJS(); }
if ($selectid == "EVENTUTILITY") { Webpage_EVENTUTILITY_CSSJS(); }
if ($selectid == "SETUPDRAWCATEGORY") {  Booking_SETUPDRAWCATEGORY_CSSJS(); }
if ($selectid == "DRAWUTILITY") { Booking_DRAWUTILITY_CSSJS(); }
if ($selectid == "DRAWTXNUTILITY") { Booking_DRAWTXNUTILITY_CSSJS(); }
if ($selectid == "NEWSLETTERCOMPOSER") { Webpage_NEWSLETTERCOMPOSER_CSSJS(); }
if ($selectid == "SETUPCOURSESCHOOL") { GenericHandler_CSSJS(); }
if ($selectid == "COURSEUTILITY") { Booking_COURSEUTILITY_CSSJS(); }
if ($selectid == "SETUPCOURSECATEGORY") { Booking_SETUPCOURSECATEGORY_CSSJS(); }
if ($selectid == "COURSEATTENDEEUTILITY") { GenericHandler_CSSJS(); }
if ($selectid == "BOOKINGVENUE") { Booking_BOOKINGVENUE_CSSJS(); }
if ($selectid == "MASTERSCHEDULER") { Booking_MASTERSCHEDULER_CSSJS(); }

if ($selectid == "CASHBOOK") { GenericHandler_CSSJS(); }
if ($selectid == "TRAVELLOG") { GenericHandler_CSSJS(); }
if ($selectid == "MILEAGE") { GenericHandler_CSSJS(); }
if ($selectid == "PAYROLL") { GenericHandler_CSSJS(); }
if ($selectid == "DIVIDEND") { GenericHandler_CSSJS(); }
if ($selectid == "SALESINVOICE") { GenericHandler_CSSJS(); }
if ($selectid == "PURCHASEINVOICE") { GenericHandler_CSSJS(); }
if ($selectid == "HOMEOFFICE") { GenericHandler_CSSJS(); }
if ($selectid == "FINASSET") { GenericHandler_CSSJS(); }
if ($selectid == "DEPRECIATIONTXN") { GenericHandler_CSSJS(); }
if ($selectid == "EXTRACTFORACCOUNTANT") { Fin_EXTRACTFORACCOUNTANT_CSSJS(); }
if ($selectid == "VATREPORT") { Fin_VATREPORT_CSSJS();}
if ($selectid == "SETUPCWDOMAIN") {	Fin_SETUPCWDOMAIN_CSSJS(); }
if ($selectid == "SETUPCOMPANY") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCOMPANYVATSTATUS") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPALLOCATION") { GenericHandler_CSSJS();}
if ($selectid == "SETUPBANK") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPBANKUPLOADFORMAT") { GenericHandler_CSSJS(); }
if ($selectid == "BANKUPLOADFORMATWIZARD") { Fin_BANKUPLOADFORMATWIZARD_CSSJS(); }
if ($selectid == "SETUPVATRATE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPVATFLATRATE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPFINCATEGORY") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPSUPPLIER") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCUSTOMER") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPJOB") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPMILEAGEPARM") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPFUELPARM") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPMILEAGEFAVOURITE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPHOMEOFFICE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCWPERSON") { GenericHandler_CSSJS(); }

if ($selectid == "SETUPTXNTEMPLATE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPTXNFAVOURITE") { GenericHandler_CSSJS(); }
 
if ($selectid == "SETUPPROCESSROLE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPPROCESSTEMPLATE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPNONWORKDAY") { GenericHandler_CSSJS(); }
if ($selectid == "VIEWTASKCALENDAR") { Process_VIEWTASKCALENDAR_CSSJS(); }

if ($selectid == "VIEWRECEIPT") { GenericHandler_CSSJS(); }
if ($selectid == "VIEWRECEIPTITEM") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPRECEIPT") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPRECEIPTITEM") { GenericHandler_CSSJS(); }
if ($selectid == "ADDTOSTOCK") { GenericHandler_CSSJS();  }
if ($selectid == "SETUPBCPRODUCTCATEGORY") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPBCOPTION") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPBCOPTIONSET") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPBCPRODUCTRULES") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPBCACCESS") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPPOS") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPPOSFEEDER") { GenericHandler_CSSJS();  }

if ($selectid == "FRSUPDATEMENU") { Frs_FRSUPDATEMENU_CSSJS(); }
if ($selectid == "FRSPERSONSTATTYPES") { Setup_FRSPERSONSTATTYPES_CSSJS(); }
if ($selectid == "FRSSELECTIONSUMMARYMENU") { Frs_FRSSELECTIONSUMMARYMENU_CSSJS(); }
if ($selectid == "TEAMREMINDER") { Frs_TEAMREMINDER_CSSJS(); }
if ($selectid == "SHIRTNUMBERADMIN") { Frs_SHIRTNUMBERADMIN_CSSJS(); }
if ($selectid == "SHIRTNUMBERCHOOSER") { Frs_SHIRTNUMBERCHOOSER_CSSJS(); }

if ($selectid == "SETUPEMAIL") { Setup_EMAIL_CSSJS(); }

if ($selectid == "PHPUTILITYG") { Setup_PHPUTILITYG_CSSJS(); }
if ($selectid == "PHPUTILITYJ") { Setup_PHPUTILITYJ_CSSJS(); }
if ($selectid == "TEST") { TEST_CSSJS(); }

if ($selectid == "SETUPSITE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPSERVICE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPPACKAGE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPSERVICEENABLED") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDOMAINSERVICE") {Setup_DOMAINSERVICE_CSSJS(); }
if ($selectid == "SETUPSITEEMAILMSG") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPSITEAPPVERSION") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDOMAIN") { GenericHandler_CSSJS(); }

if ($selectid == "CAREVISITCALENDAR") { GenericHandler_CSSJS(); }
if ($selectid == "CARECLIENTSETUP") { GenericHandler_CSSJS(); }
if ($selectid == "CARECLIENTLIST") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCARETITLE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCAREGENDER") { GenericHandler_CSSJS(); }

if ($selectid == "REPORTLIST") { Report_REPORTLIST_CSSJS(); }
if ($selectid == "MPDFREPORTLIST") { Report_MPDFREPORTLIST_CSSJS(); }
if ($selectid == "EXPORTLIST") { Report_EXPORTLIST_CSSJS(); }
if ($selectid == "MASSUPDATELIST") { Report_MASSUPDATELIST_CSSJS(); }

if ($selectid == "SETUPREPORTLIST") { Report_SETUPREPORTLIST_CSSJS(); }
if ($selectid == "SETUPMPDFREPORTLIST") { Report_SETUPMPDFREPORTLIST_CSSJS(); }
if ($selectid == "SETUPEXPORTLIST") { Report_SETUPEXPORTLIST_CSSJS(); }
if ($selectid == "SETUPMASSUPDATELIST") { Report_SETUPMASSUPDATELIST_CSSJS(); }
if ($selectid == "SETUPFIELDPRINT") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPFIELD") { GenericHandler_CSSJS(); }

if ($selectid == "CORSITELISTACTIVE") { Cor_CORSITELIST_CSSJS(); }
if ($selectid == "CORSITELISTFULL") { Cor_CORSITELIST_CSSJS(); }
if ($selectid == "CORRESETHISTORYUPLOAD") { Cor_CORRESETHISTORYUPLOAD_CSSJS(); }
if ($selectid == "CORMASTERHISTORYUPLOAD") { Cor_CORMASTERHISTORYUPLOAD_CSSJS(); }
if ($selectid == "CORSITEADHOCUPLOAD") { Cor_CORSITEADHOCUPLOAD_CSSJS(); }
if ($selectid == "CORARKUPLOAD") { Cor_CORARKUPLOAD_CSSJS(); }
if ($selectid == "CORSAGEUPLOAD") { Cor_CORSAGEUPLOAD_CSSJS(); }
if ($selectid == "CORLANDREGISTRYUPLOAD") { Cor_CORLANDREGISTRYUPLOAD_CSSJS(); }
if ($selectid == "SETUPCORUSER") { Cor_SETUPCORUSER_CSSJS(); }
if ($selectid == "SETUPCORPROGRAMME") { Cor_SETUPCORPROGRAMME_CSSJS(); }
if ($selectid == "SETUPCORSURVEYCATEGORY") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCOROUTLETCLASS") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCOROUTLETCO") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORSUPPLIER") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORACCOUNT") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORPHASE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORCLASSIFICATION") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPAPPROVALSTATUS") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORSCHEME") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORSITETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPCORDEFAULTVALUE") { GenericHandler_CSSJS(); }
if ($selectid == "CORSITERECALC") { Cor_CORSITERECALC_CSSJS(); }

if ($selectid == "SETUPDMWSTITLE") { GenericHandler_CSSJS(); }	
if ($selectid == "SETUPDMWSGENDER") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSCONTRACT") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSERVICE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSERVICESTATUS") { GenericHandler_CSSJS(); }	
if ($selectid == "SETUPDMWSLOCATIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSADMISSIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSADMISSIONREASON") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSERVICETYPE") { GenericHandler_CSSJS(); }	
if ($selectid == "SETUPDMWSREFERRALORG") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSCONTACTTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSCONSENTWITHDRAWALTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSVISITLOCATION") { GenericHandler_CSSJS(); }	
if ($selectid == "SETUPDMWSTIMEBAND") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSCOMPLEXITYTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSDISABILITYTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSCARINGRESPONSIBILITYTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSUFEEDBACKTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSPECIALISTREFERRALORG") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSMODSPECIFICTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSEQDIVOPTIONS") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSOCCUPATIONALISSUETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSPREVIOUSOCCUPATIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSREFERRERORGTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSPRIMARYCARETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSECONDARYCARETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSINDEPENDENTLIVINGTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSOCIALISOLATIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSEMPLOYMENTTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSUPPORTCOMMUNICATIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSEVENTSCOMMUNICATIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSREPORTCOMMUNICATIONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSAFEGUARDINGISSUETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSWOSAFEGUARDINGISSUETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSAFEGUARDEETYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSSAFEGUARDEEREASONTYPE") { GenericHandler_CSSJS(); }
if ($selectid == "SETUPDMWSCONTRACTLOCATION") { Dmws_SETUPDMWSCONTRACTLOCATION_CSSJS(); }

if ($selectid == "DMWSSULISTOPEN") { Dmws_DMWSSULIST_CSSJS(); }
if ($selectid == "DMWSSULISTCLOSED") { Dmws_DMWSSULIST_CSSJS(); }
if ($selectid == "DMWSCLIENTAPPSYNCHRONISE") { Dmws_DMWSCLIENTAPPSYNCHRONISE_CSSJS(); }
if ($selectid == "DMWSDATEFIX") { Dmws_DMWSDATEFIX_CSSJS(); }
if ($selectid == "DMWSLOCATIONFIX") { Dmws_DMWSLOCATIONFIX_CSSJS(); }
if ($selectid == "DMWSTIMEBANDFIX") { Dmws_DMWSTIMEBANDFIX_CSSJS(); }
if ($selectid == "DMWSMANDFIELDSFIX") { Dmws_DMWSMANDFIELDSFIX_CSSJS(); }
if ($selectid == "DMWSCOMPLEXITYUTILITY") { Dmws_DMWSCOMPLEXITYUTILITY_CSSJS(); }
if ($selectid == "DMWSWELLBEINGFIX") { Dmws_DMWSWELLBEINGFIX_CSSJS(); }

if ($selectid == "GRLUPDATEMENU") { Grl_GRLUPDATEMENU_CSSJS(); }
if ($selectid == "SETUPGRLLEAGUE") { Grl_SETUPGRLLEAGUE_CSSJS(); }
if ($selectid == "SETUPGRLCUP") { Grl_SETUPGRLCUP_CSSJS(); }
if ($selectid == "SETUPGRLCLUB") { Grl_SETUPGRLCLUB_CSSJS(); }
if ($selectid == "SETUPGRLTEAM") { Grl_SETUPGRLTEAM_CSSJS(); }
if ($selectid == "SETUPGRLVENUE") { Grl_SETUPGRLVENUE_CSSJS(); }
if ($selectid == "SETUPGRLPLAYER") { Grl_SETUPGRLPLAYER_CSSJS(); }
if ($selectid == "SETUPGRLOFFICIAL") { Grl_SETUPGRLOFFICIAL_CSSJS(); }
if ($selectid == "SETUPGRLPLAYERSTATTYPES") { Grl_SETUPGRLPLAYERSTATTYPES_CSSJS(); }
if ($selectid == "GRLPLUGINTEST") { Grl_GRLPLUGINTEST_CSSJS(); }
if ($selectid == "GRLRESULTSIMPORTER") { Grl_GRLRESULTSIMPORTER_CSSJS(); }
if ($selectid == "GRLMATCHAPP") { Grl_GRLMATCHAPP_CSSJS(); }

if ($selectid == "SFMCLUBLISTACTIVE") { SFM_SFMCLUBLIST_CSSJS(); }
if ($selectid == "SFMCLUBLISTFULL") { SFM_SFMCLUBLIST_CSSJS(); }

if ($selectid == "UPLOAD") { Setup_UPLOAD_CSSJS(); }

if ($selectid == "SETUPSHOP") { Shop_SETUPSHOP_CSSJS(); }

if ($selectid == "SETUPSFMSET") { SFM_SETUPSFMSET_CSSJS(); }
if ($selectid == "SETUPSFMCLUB") { SFM_SETUPSFMCLUB_CSSJS(); }
if ($selectid == "SETUPSFMLEAGUE") { SFM_SETUPSFMLEAGUE_CSSJS(); }
if ($selectid == "SETUPSFMDIVISION") { SFM_SETUPSFMDIVISION_CSSJS(); }
if ($selectid == "SETUPSFMCOUNTY") { SFM_SETUPSFMCOUNTY_CSSJS(); }
if ($selectid == "SETUPSFMNGB") { SFM_SETUPSFMNGB_CSSJS(); }

if ($selectid == "SETUPSFMPITCHTYPE") { SFM_SETUPSFMPITCHTYPE_CSSJS(); }
if ($selectid == "SETUPSFMPITCHMANUFACTURER") { SFM_SETUPSFMPITCHMANUFACTURER_CSSJS(); }
if ($selectid == "SETUPSFMPITCHCONTRACTOR") { SFM_SETUPSFMPITCHCONTRACTOR_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTGROUNDTYPE") { SFM_SETUPSFMFLOODLIGHTGROUNDTYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTBASETYPE") { SFM_SETUPSFMFLOODLIGHTBASETYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTCOLUMNTYPE") { SFM_SETUPSFMFLOODLIGHTCOLUMNTYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTBALLASTTYPE") { SFM_SETUPSFMFLOODLIGHTBALLASTTYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTCAPACITORTYPE") { SFM_SETUPSFMFLOODLIGHTCAPACITORTYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTLAMPTYPE") { SFM_SETUPSFMFLOODLIGHTLAMPTYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTIGNITERTYPE") { SFM_SETUPSFMFLOODLIGHTIGNITERTYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTFIXTURETYPE") { SFM_SETUPSFMFLOODLIGHTFIXTURETYPE_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTMANUFACTURER") { SFM_SETUPSFMFLOODLIGHTMANUFACTURER_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTCONTRACTOR") { SFM_SETUPSFMFLOODLIGHTCONTRACTOR_CSSJS(); }
if ($selectid == "SETUPSFMFLOODLIGHTMETER") { SFM_SETUPSFMFLOODLIGHTMETER_CSSJS(); }
if ($selectid == "SETUPSFMCOMPANY") { SFM_SETUPSFMCOMPANY_CSSJS(); }
if ($selectid == "SETUPSFMVISITTYPE") { SFM_SETUPSFMVISITTYPE_CSSJS(); }
if ($selectid == "SETUPSFMRECTIFICATIONTYPE") { SFM_SETUPSFMRECTIFICATIONTYPE_CSSJS(); }
if ($selectid == "SETUPSFMREVIEWCONDITIONS") { SFM_SETUPSFMREVIEWCONDITIONS_CSSJS(); }
if ($selectid == "SFMSETLIST") { SFM_SFMSETLIST_CSSJS(); }

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
Get_Person_Authority();

if ($selectid == "CLASSICMENU") {  Person_Login_Select_Output(); }
if ($selectid == "DASHBOARD") {  Person_Login_Select_Output(); }

if ($selectid == "ACCOUNT") { Site_ACCOUNT_Output(); }
if ($selectid == "DOMAINMASTERS") { Setup_DOMAINMASTERS_Output(); }
if ($selectid == "COMMSMASTERS") { Setup_COMMSMASTERS_Output(); }
if ($selectid == "SPORT") { Setup_SPORT_Output(); }

if ($selectid == "TITLES") { Setup_TITLES_Output(); }
if ($selectid == "PERIOD") { Setup_PERIOD_Output(); }

if ($selectid == "ACTIONSVIEWNEW") { Actions_VIEWLIST_Output(); } 
if ($selectid == "PERSONSEARCH") { Person_SEARCH_Output($GLOBALS{'LOGIN_person_id'});}
if ($selectid == "PERSONEMAIL") { Person_SE_Output(); } 
if ($selectid == "PERSONLIST") { Person_LIST_Output("Normal"); }
if ($selectid == "MYPASSWORD") { Person_PW_Output(); }
if ($selectid == "MYPREFERENCES") { Person_MYPREFERENCES_Output(); }

if ($selectid == "MYPROFILE") { Person_MYPROFILE_Output(); }
if ($selectid == "MYMEMBERSHIP") { Person_MYMEMBERSHIP_Output(); }
if ($selectid == "MYJOBROLE") { Person_MYJOBROLE_Output($GLOBALS{'LOGIN_person_id'});}
if ($selectid == "MYQUALIFICATION") { Person_MYQUALIFICATION_Output($GLOBALS{'LOGIN_person_id'});}
if ($selectid == "MYQUALIFICATIONREPORT") { Person_Qualification_Report($GLOBALS{'LOGIN_person_id'});}
if ($selectid == "MYTEAM") { Person_MYTEAM_Output($GLOBALS{'LOGIN_person_id'}); }
if ($selectid == "MYGROUP") { Person_MYGROUP_Output($GLOBALS{'LOGIN_person_id'}); }
if ($selectid == "MYAVAILABILITY") { Person_MYAVAILABILITY_Output($GLOBALS{'LOGIN_person_id'}); }
if ($selectid == "MYSTATS") { Person_MYSTATS_Output($GLOBALS{'LOGIN_person_id'}); }
if ($selectid == "TEAMCHAT") { Person_TEAMCHAT_Output("loggedin",$GLOBALS{'LOGIN_person_id'},"",""); }

if ($selectid == "PERSONADD1") { Person_ADD1_Output("Window"); }
if ($selectid == "PERSONCHANGESEARCH") { Person_CHANGESEARCH_Output(); }
if ($selectid == "PERSONDELETESEARCH") { Person_DELETESEARCH_Output(); }

if ($selectid == "MMNEW") { Person_MMNEW_Output(); }
if ($selectid == "PERSONPWDRESET") { Person_PWR_Output(); }
if ($selectid == "PERSONUPLOAD") { Setup_UPLOAD_Output(); }
if ($selectid == "PERSONADDUPLOAD") { Person_ADDUPLOAD_Output(); }
if ($selectid == "PERSONDOWNLOAD") { Setup_PERSONDOWNLOAD_Output(); }
if ($selectid == "PERSONEXTRADEFNEW") { Setup_PERSONEXTRADEF_Output(); }
if ($selectid == "MASSDETAILSNOTIFYNEW") { Person_MASSDETAILSNOTIFY_Output(); }
if ($selectid == "MASSMEMBERSHIPNOTIFY") { Person_MASSMEMBERSHIPNOTIFY_Output(); }
if ($selectid == "MEMBERSHIPANALYSIS") { Person_MEMBERSHIPANALYSIS_Output(); }
if ($selectid == "PERSONDBINTEGRITY") { Person_PERSONDBINTEGRITY_Output(); }

if ($selectid == "CAPTAINROLE") { Person_CAPTAINROLE_Output(); }
if ($selectid == "MEMBERSHIPFORMTEXT") { Setup_MEMBERSHIPFORMTEXT_Output(); }
if ($selectid == "PERSONTYPES") { Setup_PERSONTYPES_Output(); }
if ($selectid == "PERSONUSERLEVEL") { Setup_PERSONUSERLEVEL_Output(); }
if ($selectid == "ETHNICITY") { Setup_ETHNICITY_Output(); }
if ($selectid == "DISABILITY") { Setup_DISABILITY_Output(); }
if ($selectid == "PERSONEXTRADEF") { Setup_PERSONEXTRADEF_Output(); }

if ($selectid == "SETUPJOBROLE") { Setup_JOBROLE_Output(); }
if ($selectid == "SETUPQUALIFICATION") { Setup_QUALIFICATION_Output(); }
if ($selectid == "SETUPJOBROLEQUALIFICATION") {	Setup_JOBROLEQUALIFICATION_Output();}
if ($selectid == "PERSONJOBROLE") {	Person_JOBROLE_Output(); }
if ($selectid == "PERSONQUALIFICATION") { Person_QUALIFICATION_Output();}
if ($selectid == "PERSONQUALIFICATIONREPORT") { Person_Qualification_Report("all");}

if ($selectid == "LIBRARYVIEW") { Library_LIBRARYINDEX_Output("View",$GLOBALS{'LOGIN_domain_id'}); }
if ($selectid == "ACCREDVIEW") { Library_ACCREDVIEWLIST_Output("Active",$GLOBALS{'LOGIN_domain_id'},"View",""); } 
if ($selectid == "LIBRARYSECTION") { Setup_LIBRARYSECTION_Output(); }
if ($selectid == "LIBRARYMAINTAIN") { Library_LIBRARYINDEX_Output("Maintain",$GLOBALS{'LOGIN_domain_id'}); }
if ($selectid == "ACCREDSCHEME") { Setup_ACCREDSCHEME_Output(); } 
if ($selectid == "ACCREDMAINTAIN") { Library_ACCREDVIEWLIST_Output("Active",$GLOBALS{'LOGIN_domain_id'},"Maintain",""); } 
if ($selectid == "ACCREDINSPECT") { Library_ACCREDVIEWLIST_Output("Active",$GLOBALS{'LOGIN_domain_id'},"Inspect",""); }
 
if ($selectid == "ORG") { Setup_ORG_Output(); }
if ($selectid == "ORGDETAIL") { Setup_ORGDETAIL_Output(); }
if ($selectid == "SECTION") { Setup_SECTION_Output(); }
if ($selectid == "SECTIONGROUP") { Setup_SECTIONGROUP_Output(); }
if ($selectid == "TEAM") { Setup_TEAM_Output(); }
if ($selectid == "PAYMENTOPTION") { Setup_PAYMENTOPTION_Output(); }

if ($selectid == "SETUPEMAIL") { Setup_EMAIL_Output(); }

if ($selectid == "ADVERTISER") { Setup_ADVERTISER_Output(); }
if ($selectid == "ADVERTISERCATEGORY") { Setup_ADVERTISERCATEGORY_Output(); }

if ($selectid == "SETUPAUCTIONEVENT") { Auction_SETUPAUCTIONEVENT_Output(); }
if ($selectid == "SETUPAUCTIONCATEGORY") { Auction_SETUPAUCTIONCATEGORY_Output(); }
if ($selectid == "AUCTIONPAPERRECEIPT") { Auction_AUCTIONPAPERRECEIPT_Output(); }
if ($selectid == "AUCTIONONLINERECEIPT") { Auction_AUCTIONONLINERECEIPT_Output(); }
if ($selectid == "MANAGEAUCTIONINPUTS") { Auction_MANAGEAUCTIONINPUTS_Output(); }
if ($selectid == "MANAGEAUCTIONCATALOGUE") { Auction_MANAGEAUCTIONCATALOGUE_Output(); }
if ($selectid == "MANAGEAUCTIONSALES") { Auction_MANAGEAUCTIONSALES_Output(); }   
if ($selectid == "AUCTIONCATALOGUEPRINT") { Auction_AUCTIONCATALOGUEPRINT_Output(); }
if ($selectid == "AUCTIONAUCTIONEERPRINT") { Auction_AUCTIONAUCTIONEERPRINT_Output(); }
if ($selectid == "AUCTIONLOTADMINPRINT") { Auction_AUCTIONLOTADMINPRINT_Output(); }
if ($selectid == "AUCTIONINPUTIDADMINPRINT") { Auction_AUCTIONINPUTIDADMINPRINT_Output(); }
if ($selectid == "AUCTIONVENDORADMINPRINT") { Auction_AUCTIONVENDORADMINPRINT_Output(); }
if ($selectid == "AUCTIONSALEPRINT") { Auction_AUCTIONSALEPRINT_Output(); }

if ($selectid == "DEMOSQL") { Demo_DEMOSQL_Output(); }
if ($selectid == "DEMOBASE") { Demo_DEMOBASE_Output(); }
if ($selectid == "DEMOCALENDAR") { Demo_DEMOCALENDAR_Output(); }
if ($selectid == "DEMONAVIGATION") { Demo_DEMONAVIGATION_Output(); }
if ($selectid == "DEMOPOPUP") { Demo_DEMOPOPUP_Output(); }

if ($selectid == "TEMPLATEUPDATELIST") { Webpage_TEMPLATEUPDATELIST_Output(); }
if ($selectid == "TEMPLATEELEMENTUPDATELIST") { Webpage_TEMPLATEELEMENTUPDATELIST_Output(); }
if ($selectid == "TEMPLATEUTILITY") { Webpage_TEMPLATEUTILITY_Output(); }
if ($selectid == "TEMPLATEELEMENTUTILITY") { Webpage_TEMPLATEELEMENTUTILITY_Output(); }
if ($selectid == "SIDEBARCOMPOSERLIST") { Webpage_SIDEBARCOMPOSERLIST_Output(); }
if ($selectid == "CAROUSELUPDATE") { Webpage_CAROUSELUPDATE_Output(); }
if ($selectid == "WEBPAGEUTILITY") { Webpage_WEBPAGEUTILITY_Output(); }
if ($selectid == "WEBPAGECOMPOSERLIST") { Webpage_WEBPAGECOMPOSERLIST_Output(); }
if ($selectid == "WEBSITEPUBLISHALL") { Webpage_WEBSITEPUBLISHALL_Output(); }
if ($selectid == "WEBPAGEPUBLISHALL") { Webpage_WEBPAGEPUBLISHALL_Output(); }
if ($selectid == "MENUUPDATE") { Webpage_MENUUPDATE_Output(); }
if ($selectid == "KBSECTION") { Setup_KBSECTION_Output(); }
if ($selectid == "PLUGINCATEGORY") { Webpage_PLUGINCATEGORY_Output(); }
if ($selectid == "PLUGINUTILITY") { Webpage_PLUGINUTILITY_Output(); }

if ($selectid == "SETUPBULLETINBOARD") { Setup_BULLETINBOARD_Output(); }
if ($selectid == "SETUPARTICLECATEGORY") { Webpage_SETUPARTICLECATEGORY_Output(); }
if ($selectid == "ARTICLEUTILITY") { Webpage_ARTICLEUTILITY_Output(); }
if ($selectid == "SETUPEVENTCATEGORY") { Webpage_SETUPEVENTCATEGORY_Output(); }
if ($selectid == "EVENTUTILITY") { Webpage_EVENTUTILITY_Output(); }
if ($selectid == "SETUPDRAWCATEGORY") { Booking_SETUPDRAWCATEGORY_Output(); }
if ($selectid == "DRAWUTILITY") { Booking_DRAWUTILITY_Output(); }
if ($selectid == "DRAWTXNUTILITY") { Booking_DRAWTXNUTILITY_Output("D00001"); }
if ($selectid == "SETUPCOURSECATEGORY") { Booking_SETUPCOURSECATEGORY_Output(); }
if ($selectid == "COURSEUTILITY") { Booking_COURSEUTILITY_Output(); }

if ($selectid == "SETUPCOURSESCHOOL") { Booking_SETUPCOURSESCHOOL_Output(); }
if ($selectid == "NEWSLETTERCOMPOSER") { Webpage_NEWSLETTERCOMPOSER_Output("No"); }
if ($selectid == "ARTICLEUPDATELIST") { Webpage_ARTICLEUPDATELIST_Output(); }
if ($selectid == "EVENTUPDATELIST") { Webpage_EVENTUPDATELIST_Output(); }
if ($selectid == "DRAWUPDATELIST") { Booking_DRAWUPDATELIST_Output(); }
if ($selectid == "COURSEUPDATELIST") { Booking_COURSEUPDATELIST_Output(); }

if ($selectid == "COURSEDOWNLOADLIST") { Booking_COURSEDOWNLOADLIST_Output(); }
if ($selectid == "COURSEADMINLIST") { Booking_COURSEADMINLIST_Output(); }
if ($selectid == "COURSEATTENDEEUTILITY") { Booking_COURSEATTENDEEUTILITY_Output(); }

if ($selectid == "EVENTADMINLIST") { Booking_EVENTADMINLIST_Output(); }
if ($selectid == "DRAWADMINLIST") { Booking_DRAWADMINLIST_Output(); }

if ($selectid == "BOOKINGVENUE") { Booking_BOOKINGVENUE_Output(); }
if ($selectid == "BOOKINGADMINLIST") { Booking_BOOKINGADMINLIST_Output(); }
if ($selectid == "BOOKINGUTILITYLIST") { Booking_BOOKINGUTILITYLIST_Output(); }
if ($selectid == "VENUE") { Setup_VENUE_Output(); }
if ($selectid == "VENUESCHEDULELIST") { Booking_VENUESCHEDULELIST_Output(); }
if ($selectid == "MASTERSCHEDULER") { Booking_MASTERSCHEDULER_Output(); }

if ($selectid == "WUBul") { Webpage_BULLETINCREATEA_Output(); }

if ($selectid == "SQLMAINTAIN") { Setup_SQLMAINTAIN_Output1(); }
if ($selectid == "SQLBACKUP") { Setup_SQLBACKUP_Output(); }
if ($selectid == "SQLDUMPRECOVER") { Setup_SQLDUMPRECOVER_Output1(); }

if ($selectid == "UPLOADBANK") { Fin_MAINTAINBANKFILELIST_Output(); }
if ($selectid == "ALLOCATEBANK") { Fin_ALLOCATEBANK_Output1(); }
if ($selectid == "CASHBOOK") { Fin_PETTYCASH_Output(); }
if ($selectid == "TRAVELLOG") {	Fin_TRAVELLOG_Output(); }
if ($selectid == "MILEAGE") { Fin_MILEAGE_Output(); }
if ($selectid == "PAYROLL") { Fin_PAYROLL_Output(); }
if ($selectid == "DIVIDEND") { Fin_DIVIDEND_Output(); }
if ($selectid == "SALESINVOICE") { Fin_SALESINVOICE_Output(); }
if ($selectid == "PURCHASEINVOICE") { Fin_PURCHASEINVOICE_Output(); }
if ($selectid == "HOMEOFFICE") { Fin_HOMEOFFICE_Output(); }
if ($selectid == "FINASSET") { Fin_FINASSET_Output(); }
if ($selectid == "DEPRECIATIONTXN") { Fin_DEPRECIATIONTXN_Output(); }

if ($selectid == "EXTRACTFORACCOUNTANT") { Fin_EXTRACTFORACCOUNTANT_Output(); }
if ($selectid == "VATREPORT") { Fin_VATREPORT_Output(); }

if ($selectid == "SETUPCWDOMAIN") { Fin_SETUPCWDOMAIN_Output();}
if ($selectid == "SETUPCOMPANY") { Fin_SETUPCOMPANY_Output(); }
if ($selectid == "SETUPCOMPANYVATSTATUS") { Fin_SETUPCOMPANYVATSTATUS_Output(); }
if ($selectid == "SETUPALLOCATION") { Fin_SETUPALLOCATION_Output(); }
if ($selectid == "SETUPBANK") { Fin_SETUPBANK_Output(); }
if ($selectid == "SETUPBANKUPLOADFORMAT") { Fin_SETUPBANKUPLOADFORMAT_Output(); }
if ($selectid == "BANKUPLOADFORMATWIZARD") { Fin_BANKUPLOADFORMATWIZARD_Output(); }
if ($selectid == "SETUPVATRATE") { Fin_SETUPVATRATE_Output(); }
if ($selectid == "SETUPVATFLATRATE") { Fin_SETUPVATFLATRATE_Output(); }
if ($selectid == "SETUPFINCATEGORY") { Fin_SETUPFINCATEGORY_Output(); }
if ($selectid == "SETDEFAULTFINCATEGORIES") { Fin_SETDEFAULTFINCATEGORIES_Output(); }
if ($selectid == "SETUPSUPPLIER") { Fin_SETUPSUPPLIER_Output(); }
if ($selectid == "SETUPCUSTOMER") { Fin_SETUPCUSTOMER_Output(); }
if ($selectid == "SETUPJOB") { Fin_SETUPJOB_Output(); }
if ($selectid == "SETUPMILEAGEPARM") { Fin_SETUPMILEAGEPARM_Output(); }
if ($selectid == "SETUPFUELPARM") { Fin_SETUPFUELPARM_Output(); }
if ($selectid == "SETUPMILEAGEFAVOURITE") { Fin_SETUPMILEAGEFAVOURITE_Output(); }
if ($selectid == "SETUPHOMEOFFICE") { Fin_SETUPHOMEOFFICE_Output(); }
if ($selectid == "SETUPCWPERSON") { Fin_SETUPCWPERSON_Output(); }
if ($selectid == "UPDATECWREFERENCEDATA") {	Fin_UPDATECWREFERENCEDATA_Output(); }

if ($selectid == "SETUPTXNTEMPLATE") { Fin_SETUPTXNTEMPLATE_Output(); }
if ($selectid == "SETUPTXNFAVOURITE") { Fin_SETUPTXNFAVOURITE_Output(); }
if ($selectid == "IMPORTFINCATEGORY") { Fin_IMPORTFINCATEGORY_Output(); }
if ($selectid == "CONVERTFINCATEGORY") { Fin_CONVERTFINCATEGORY_Output(); }

if ($selectid == "VIEWTASKCALENDAR") { Process_VIEWTASKCALENDAR_Output(); }
if ($selectid == "SETUPTASKCALENDAR") { Process_SETUPTASKCALENDAR_Output(); }
if ($selectid == "SETUPPROCESSTEMPLATE") { Process_SETUPPROCESSTEMPLATE_Output(); }   
if ($selectid == "SETUPNONWORKDAY") { Process_SETUPNONWORKDAY_Output(); }
if ($selectid == "SETUPPROCESSROLE") { Process_SETUPPROCESSROLE_Output(); }  

if ($selectid == "NEWRECEIPT") { Pos_NEWRECEIPT_Output(); }
if ($selectid == "VIEWRECEIPT") { Pos_VIEWRECEIPT_Output(); }  
if ($selectid == "VIEWRECEIPTITEM") { Pos_VIEWRECEIPTITEM_Output(); }  
if ($selectid == "SETUPRECEIPT") { Pos_SETUPRECEIPT_Output(); }  
if ($selectid == "SETUPRECEIPTITEM") { Pos_SETUPRECEIPTITEM_Output(); } 
if ($selectid == "BCPOSTPOSSALES") { Pos_BCPOSTPOSSALES_Output(); } 
if ($selectid == "ADDTOSTOCK") { Pos_ADDTOSTOCK_Output(); }
if ($selectid == "BCSTOCKUPDATE") { Pos_BCSTOCKUPDATE_Output(); }
if ($selectid == "SETUPBCPRODUCTCATEGORY") { Pos_SETUPBCPRODUCTCATEGORY_Output(); }
if ($selectid == "SETUPBCOPTION") { Pos_SETUPBCOPTION_Output(); }
if ($selectid == "SETUPBCOPTIONSET") { Pos_SETUPBCOPTIONSET_Output(); }
if ($selectid == "SETUPBCPRODUCTRULES") { Pos_SETUPBCPRODUCT_Output(); }
if ($selectid == "BCPRODUCTRULESSYNCH") { Pos_BCPRODUCTRULESSYNCH_Output(); }
if ($selectid == "SETUPBCACCESS") { Pos_SETUPBCACCESS_Output(); }
if ($selectid == "SETUPPOS") { Pos_SETUPPOS_Output(); }
if ($selectid == "SETUPPOSFEEDER") { Pos_SETUPPOSFEEDER_Output();  }
if ($selectid == "BCWEBPAGES") { Pos_BCWEBPAGES_Output(); }

if ($selectid == "FRSUPDATEMENU") { Frs_FRSUPDATEMENU_Output(); }
if ($selectid == "FRSSQUADCHOOSER") { Frs_FRSSQUADCHOOSER_Output(); }
if ($selectid == "FRSPERSONSTATTYPES") { Setup_FRSPERSONSTATTYPES_Output(); }
if ($selectid == "FRSRECALCULATESTATS") { Frs_FRSRECALCULATESTATS_Output($GLOBALS{'currperiodid'}); }
// if ($selectid == "NEWSLASTWEEKSRESULTS") { Frs_NEWSLASTWEEKSRESULTS_Output($GLOBALS{'currperiodid'}); }
if ($selectid == "FBLASTWEEKSRESULTS") { Frs_FBLASTWEEKSRESULTS_Output($GLOBALS{'currperiodid'}); }
if ($selectid == "FBNEXTWEEKSSCHEDULE") { Frs_FBNEXTWEEKSSCHEDULE_Output($GLOBALS{'currperiodid'}); }
if ($selectid == "FRSSELECTIONSUMMARYMENU") { Frs_FRSSELECTIONSUMMARYMENU_Output($GLOBALS{'currperiodid'},"all"); }
if ($selectid == "TEAMREMINDER") { Frs_TEAMREMINDER_Output(); }
if ($selectid == "SHIRTNUMBERADMIN") { Frs_SHIRTNUMBERADMIN_Output("","","","","",""); }
if ($selectid == "SHIRTNUMBERCHOOSER") { Frs_SHIRTNUMBERCHOOSER_Output($GLOBALS{'LOGIN_person_id'}); }
if ($selectid == "SHIRTNUMBERPERSONRESET") { Frs_SHIRTNUMBERPERSONRESET_Output(); }
if ($selectid == "FRSUPLOAD") { Setup_UPLOAD_Output(); }
if ($selectid == "FRSDOWNLOAD") { Setup_FRSDOWNLOAD_Output(); }

if ($selectid == "SETUPSITE") {Setup_SITE_Output();}
if ($selectid == "SETUPSERVICE") {Setup_SERVICE_Output();}
if ($selectid == "SETUPPACKAGE") {Setup_PACKAGE_Output();}
if ($selectid == "SETUPSERVICEENABLED") { Setup_SERVICEENABLED_Output();}
if ($selectid == "SETUPDOMAINSERVICE") {Setup_DOMAINSERVICE_Output();}
if ($selectid == "SETUPSITEEMAILMSG") { Setup_SITEEMAIL_Output(); }
if ($selectid == "SETUPSITEAPPVERSION") { Setup_SETUPSITEAPPVERSION_Output(); }
if ($selectid == "SETUPDOMAIN") { Setup_DOMAIN_Output(); }
if ($selectid == "COOKIES") { Setup_COOKIES_Output(); }

if ($selectid == "UPLOAD") { Setup_UPLOAD_Output(); }
if ($selectid == "DOWNLOAD") { Setup_DOWNLOAD_Output(); }

if ($selectid == "TESTSLIM") { Setup_TESTSLIM_Output(); }

if ($selectid == "PHPUTILITY1") { Setup_PHPUTILITY1_Output(); }
if ($selectid == "PHPUTILITY2") { Setup_PHPUTILITY2_Output(); }
if ($selectid == "PHPUTILITY3") { Setup_PHPUTILITY3_Output(); }
if ($selectid == "PHPUTILITY4") { Setup_PHPUTILITY4_Output(); }
if ($selectid == "PHPUTILITY5") { Setup_PHPUTILITY5_Output(); }
if ($selectid == "PHPUTILITY6") { Setup_PHPUTILITY6_Output(); }
if ($selectid == "PHPUTILITY7") { Setup_PHPUTILITY7_Output(); }
if ($selectid == "PHPUTILITY8") { Setup_PHPUTILITY8_Output(); }
if ($selectid == "PHPUTILITY9") { Setup_PHPUTILITY9_Output(); }
if ($selectid == "PHPUTILITYA") { Setup_PHPUTILITYA_Output(); }
if ($selectid == "PHPUTILITYB") { Setup_PHPUTILITYB_Output(); }
if ($selectid == "PHPUTILITYC") { Setup_PHPUTILITYC_Output(); }
if ($selectid == "PHPUTILITYD") { Setup_PHPUTILITYD_Output(); }
if ($selectid == "PHPUTILITYE") { Setup_PHPUTILITYE_Output(); }
if ($selectid == "PHPUTILITYF") { Setup_PHPUTILITYF_Output(); }
if ($selectid == "PHPUTILITYG") { Setup_PHPUTILITYG_Output(); }
if ($selectid == "PHPUTILITYH") { Setup_PHPUTILITYH_Output(); }
if ($selectid == "PHPUTILITYI") { Setup_PHPUTILITYI_Output(); }
if ($selectid == "PHPUTILITYJ") { Setup_PHPUTILITYJ_Output(); }
if ($selectid == "TEST") { TEST_Output(); }

if ($selectid == "REPORTLIST") { Report_REPORTLIST_Output(); }
if ($selectid == "MPDFREPORTLIST") { Report_MPDFREPORTLIST_Output(); }
if ($selectid == "EXPORTLIST") { Report_EXPORTLIST_Output(); }
if ($selectid == "MASSUPDATELIST") { Report_MASSUPDATELIST_Output(); }

if ($selectid == "SETUPREPORTLIST") { Report_SETUPREPORTLIST_Output(); }
if ($selectid == "SETUPMPDFREPORTLIST") { Report_SETUPMPDFREPORTLIST_Output(); }
if ($selectid == "SETUPEXPORTLIST") { Report_SETUPEXPORTLIST_Output(); }
if ($selectid == "SETUPMASSUPDATELIST") { Report_SETUPMASSUPDATELIST_Output(); }
if ($selectid == "SETUPFIELDAUTO") { Report_SETUPFIELDAUTO_Output(); }
if ($selectid == "SETUPFIELDPRINT") { Report_SETUPFIELDPRINT_Output(); }
if ($selectid == "SETUPFIELD") { Report_SETUPFIELD_Output(); }

if ($selectid == "CORSITELISTACTIVE") { Cor_CORSITELIST_Output("Active",$selectparm); }
if ($selectid == "CORSITELISTFULL") { Cor_CORSITELIST_Output("Full",$selectparm); }
if ($selectid == "SETUPCORUSER") { Cor_SETUPCORUSER_Output(); }
if ($selectid == "SETUPCORPROGRAMME") { Cor_SETUPCORPROGRAMME_Output(); }
if ($selectid == "SETUPCORSURVEYCATEGORY") { Cor_SETUPCORSURVEYCATEGORY_Output(); } 
if ($selectid == "SETUPCOROUTLETCLASS") { Cor_SETUPCOROUTLETCLASS_Output(); }
if ($selectid == "SETUPCOROUTLETCO") { Cor_SETUPCOROUTLETCO_Output(); }
if ($selectid == "SETUPCORSUPPLIER") { Cor_SETUPCORSUPPLIER_Output(); }
if ($selectid == "SETUPCORACCOUNT") { Cor_SETUPCORACCOUNT_Output(); }
if ($selectid == "SETUPCORPHASE") { Cor_SETUPCORPHASE_Output(); }
if ($selectid == "SETUPCORCLASSIFICATION") { Cor_SETUPCORCLASSIFICATION_Output(); }
if ($selectid == "SETUPAPPROVALSTATUS") { Cor_SETUPAPPROVALSTATUS_Output(); }
if ($selectid == "SETUPCORSCHEME") { Cor_SETUPCORSCHEME_Output(); }
if ($selectid == "SETUPCORSITETYPE") { Cor_SETUPCORSITETYPE_Output(); }
if ($selectid == "SETUPCORDEFAULTVALUE") { Cor_SETUPCORDEFAULTVALUE_Output(); }
if ($selectid == "CORCOMMCREATE") { Cor_CORCOMMCREATE_Output(); }
if ($selectid == "CORRESETHISTORYUPLOAD") { Cor_CORRESETHISTORYUPLOAD_Output(); }
if ($selectid == "CORMASTERHISTORYUPLOAD") { Cor_CORMASTERHISTORYUPLOAD_Output(); }
if ($selectid == "CORSITEADHOCUPLOAD") { Cor_CORSITEADHOCUPLOAD_Output(); }
if ($selectid == "CORARKUPLOAD") { Cor_CORARKUPLOAD_Output(); }
if ($selectid == "CORIMGHISTORYUPLOAD") { Cor_CORIMGHISTORYUPLOAD_Output(); }
if ($selectid == "CORSAGEUPLOAD") { Cor_CORSAGEUPLOAD_Output(); }
if ($selectid == "CORLANDREGISTRYUPLOAD") { Cor_CORLANDREGISTRYUPLOAD_Output(); }
if ($selectid == "CORSITEUNLOCK") { Cor_CORSITEUNLOCK_Output(); }
if ($selectid == "CORSITECLASSIFY") { Cor_CORSITECLASSIFY_Output("T"); }
if ($selectid == "CORSITERECALC") { Cor_CORSITERECALC_Output("Test"); }

if ($selectid == "SETUPDMWSTITLE") { Dmws_SETUPDMWSTITLE_Output(); }
if ($selectid == "SETUPDMWSGENDER") { Dmws_SETUPDMWSGENDER_Output(); }
if ($selectid == "SETUPDMWSCONTRACT") { Dmws_SETUPDMWSCONTRACT_Output(); }
if ($selectid == "SETUPDMWSSERVICE") { Dmws_SETUPDMWSSERVICE_Output(); }
if ($selectid == "SETUPDMWSSERVICESTATUS") { Dmws_SETUPDMWSSERVICESTATUS_Output(); }	
if ($selectid == "SETUPDMWSLOCATIONTYPE") { Dmws_SETUPDMWSLOCATIONTYPE_Output(); }
if ($selectid == "SETUPDMWSADMISSIONTYPE") { Dmws_SETUPDMWSADMISSIONTYPE_Output(); }
if ($selectid == "SETUPDMWSADMISSIONREASON") { Dmws_SETUPDMWSADMISSIONREASON_Output(); }
if ($selectid == "SETUPDMWSSERVICETYPE") { Dmws_SETUPDMWSSERVICETYPE_Output(); }	
if ($selectid == "SETUPDMWSREFERRALORG") { Dmws_SETUPDMWSREFERRALORG_Output(); }
if ($selectid == "SETUPDMWSCONTACTTYPE") { Dmws_SETUPDMWSCONTACTTYPE_Output(); }
if ($selectid == "SETUPDMWSCONSENTWITHDRAWALTYPE") { Dmws_SETUPDMWSCONSENTWITHDRAWALTYPE_Output(); }
if ($selectid == "SETUPDMWSVISITLOCATION") { Dmws_SETUPDMWSVISITLOCATION_Output(); }	
if ($selectid == "SETUPDMWSTIMEBAND") { Dmws_SETUPDMWSTIMEBAND_Output(); }
if ($selectid == "SETUPDMWSCOMPLEXITYTYPE") { Dmws_SETUPDMWSCOMPLEXITYTYPE_Output(); }
if ($selectid == "SETUPDMWSDISABILITYTYPE") { Dmws_SETUPDMWSDISABILITYTYPE_Output(); }
if ($selectid == "SETUPDMWSCARINGRESPONSIBILITYTYPE") { Dmws_SETUPDMWSCARINGRESPONSIBILITYTYPE_Output(); }
if ($selectid == "SETUPDMWSSUFEEDBACKTYPE") {Dmws_SETUPDMWSSUFEEDBACKTYPE_Output();}
if ($selectid == "SETUPDMWSSPECIALISTREFERRALORG") {Dmws_SETUPDMWSSPECIALISTREFERRALORG_Output();}
if ($selectid == "SETUPDMWSMODSPECIFICTYPE") {Dmws_SETUPDMWSMODSPECIFICTYPE_Output();}
if ($selectid == "SETUPDMWSEQDIVOPTIONS") { Dmws_SETUPDMWSEQDIVOPTIONS_Output(); }
if ($selectid == "SETUPDMWSOCCUPATIONALISSUETYPE") { Dmws_SETUPDMWSOCCUPATIONALISSUETYPE_Output(); }
if ($selectid == "SETUPDMWSPREVIOUSOCCUPATIONTYPE") { Dmws_SETUPDMWSPREVIOUSOCCUPATIONTYPE_Output(); }
if ($selectid == "SETUPDMWSREFERRERORGTYPE") { Dmws_SETUPDMWSREFERRERORGTYPE_Output(); }
if ($selectid == "SETUPDMWSPRIMARYCARETYPE") { Dmws_SETUPDMWSPRIMARYCARETYPE_Output(); }
if ($selectid == "SETUPDMWSSECONDARYCARETYPE") { Dmws_SETUPDMWSSECONDARYCARETYPE_Output(); }
if ($selectid == "SETUPDMWSINDEPENDENTLIVINGTYPE") { Dmws_SETUPDMWSINDEPENDENTLIVINGTYPE_Output(); }
if ($selectid == "SETUPDMWSSOCIALISOLATIONTYPE") { Dmws_SETUPDMWSSOCIALISOLATIONTYPE_Output(); }
if ($selectid == "SETUPDMWSEMPLOYMENTTYPE") { Dmws_SETUPDMWSEMPLOYMENTTYPE_Output(); }
if ($selectid == "SETUPDMWSSUPPORTCOMMUNICATIONTYPE") { Dmws_SETUPDMWSSUPPORTCOMMUNICATIONTYPE_Output(); }
if ($selectid == "SETUPDMWSEVENTSCOMMUNICATIONTYPE") { Dmws_SETUPDMWSEVENTSCOMMUNICATIONTYPE_Output(); }
if ($selectid == "SETUPDMWSREPORTCOMMUNICATIONTYPE") { Dmws_SETUPDMWSREPORTCOMMUNICATIONTYPE_Output(); }
if ($selectid == "SETUPDMWSSAFEGUARDINGISSUETYPE") { Dmws_SETUPDMWSSAFEGUARDINGISSUETYPE_Output(); }
if ($selectid == "SETUPDMWSWOSAFEGUARDINGISSUETYPE") { Dmws_SETUPDMWSWOSAFEGUARDINGISSUETYPE_Output(); }
if ($selectid == "SETUPDMWSSAFEGUARDEETYPE") { Dmws_SETUPDMWSSAFEGUARDEETYPE_Output(); }
if ($selectid == "SETUPDMWSSAFEGUARDEEREASONTYPE") { Dmws_SETUPDMWSSAFEGUARDEEREASONTYPE_Output(); }
if ($selectid == "SETUPDMWSCONTRACTLOCATION") { Dmws_SETUPDMWSCONTRACTLOCATION_Output(); }

if ($selectid == "DMWSSULISTOPEN") { Dmws_DMWSSULIST_Output('Open'); }
if ($selectid == "DMWSSULISTCLOSED") { Dmws_DMWSSULIST_Output('Closed'); }
if ($selectid == "DMWSCLIENTSYNCHRONISE") { Dmws_DMWSCLIENTSYNCHRONISE_Output(); }
if ($selectid == "DMWSCLIENTAPPSYNCHRONISE") { Dmws_DMWSCLIENTAPPSYNCHRONISE_Output(); }
if ($selectid == "DMWSDATACLEANUP") { Dmws_DMWSDATACLEANUP_Output(); }
if ($selectid == "DMWSDATAREMOVE") { Dmws_DMWSDATAREMOVE_Output(); }
if ($selectid == "DMWSCLIENTAPPREPAIR") { Dmws_DMWSCLIENTAPPREPAIR_Output(); }
if ($selectid == "DMWSTRELLO") { Dmws_DMWSTRELLO_Output(); }
if ($selectid == "DMWSDATEFIX") { Dmws_DMWSDATEFIX_Output("Test"); }
if ($selectid == "DMWSMANDFIELDSFIX") { Dmws_DMWSMANDFIELDSFIX_Output("Test"); }
if ($selectid == "DMWSCOMPLEXITYUTILITY") { Dmws_DMWSCOMPLEXITYUTILITY_Output("Test"); }
if ($selectid == "DMWSWELLBEINGFIX") { Dmws_DMWSWELLBEINGFIX_Output("Test"); }

if ($selectid == "GRLUPDATEMENU") { Grl_GRLUPDATEMENU_Output(); }
if ($selectid == "SETUPGRLLEAGUE") { Grl_SETUPGRLLEAGUE_Output(); }
if ($selectid == "SETUPGRLCUP") { Grl_SETUPGRLCUP_Output(); }
if ($selectid == "SETUPGRLCLUB") { Grl_SETUPGRLCLUB_Output(); }
if ($selectid == "SETUPGRLTEAM") { Grl_SETUPGRLTEAM_Output(); }
if ($selectid == "SETUPGRLVENUE") { Grl_SETUPGRLVENUE_Output(); }
if ($selectid == "SETUPGRLPLAYER") { Grl_SETUPGRLPLAYER_Output(); }
if ($selectid == "SETUPGRLOFFICIAL") { Grl_SETUPGRLOFFICIAL_Output(); }
if ($selectid == "SETUPGRLPLAYERSTATTYPES") { Grl_SETUPGRLPLAYERSTATTYPES_Output(); }
if ($selectid == "GRLUPLOAD") { Grl_GRLUPLOAD_Output(); }
if ($selectid == "GRLDOWNLOAD") { Grl_GRLDOWNLOAD_Output(); }
if ($selectid == "GRLPLUGINTEST") { Grl_GRLPLUGINTEST_Output(); }
if ($selectid == "GRLRESULTSIMPORTER") { Grl_GRLRESULTSIMPORTER_Output(); }
if ($selectid == "GRLMATCHAPP") { Grl_GRLMATCHAPP_Output(); }

if ($selectid == "SFMCLUBLISTACTIVE") { SFM_SFMCLUBLIST_Output("Active",$selectparm); }
if ($selectid == "SFMCLUBLISTFULL") { SFM_SFMCLUBLIST_Output("Full",$selectparm); }

if ($selectid == "CORORIG2COPY") { Cor_CORORIG2COPY_Output(); }
if ($selectid == "CORCOPY2NEW") { Cor_CORCOPY2NEW_Output(); }

if ($selectid == "SETUPSHOP") { Shop_SETUPSHOP_Output(); }
if ($selectid == "SHOPPING") { Shop_SHOPPING_Output(); }

if ($selectid == "SETUPSFMSET") { SFM_SETUPSFMSET_Output(); }
if ($selectid == "SETUPSFMCLUB") { SFM_SETUPSFMCLUB_Output(); }
if ($selectid == "SETUPSFMLEAGUE") { SFM_SETUPSFMLEAGUE_Output(); }
if ($selectid == "SETUPSFMDIVISION") { SFM_SETUPSFMDIVISION_Output(); }
if ($selectid == "SETUPSFMCOUNTY") { SFM_SETUPSFMCOUNTY_Output(); }
if ($selectid == "SETUPSFMNGB") { SFM_SETUPSFMNGB_Output(); }

if ($selectid == "SETUPSFMPITCHTYPE") { SFM_SETUPSFMPITCHTYPE_Output(); }
if ($selectid == "SETUPSFMPITCHMANUFACTURER") { SFM_SETUPSFMPITCHMANUFACTURER_Output(); }
if ($selectid == "SETUPSFMPITCHCONTRACTOR") { SFM_SETUPSFMPITCHCONTRACTOR_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTGROUNDTYPE") { SFM_SETUPSFMFLOODLIGHTGROUNDTYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTBASETYPE") { SFM_SETUPSFMFLOODLIGHTBASETYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTCOLUMNTYPE") { SFM_SETUPSFMFLOODLIGHTCOLUMNTYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTBALLASTTYPE") { SFM_SETUPSFMFLOODLIGHTBALLASTTYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTCAPACITORTYPE") { SFM_SETUPSFMFLOODLIGHTCAPACITORTYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTLAMPTYPE") { SFM_SETUPSFMFLOODLIGHTLAMPTYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTFIXTURETYPE") { SFM_SETUPSFMFLOODLIGHTFIXTURETYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTIGNITERTYPE") { SFM_SETUPSFMFLOODLIGHTIGNITERTYPE_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTMANUFACTURER") { SFM_SETUPSFMFLOODLIGHTMANUFACTURER_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTCONTRACTOR") { SFM_SETUPSFMFLOODLIGHTCONTRACTOR_Output(); }
if ($selectid == "SETUPSFMFLOODLIGHTMETER") { SFM_SETUPSFMFLOODLIGHTMETER_Output(); }
if ($selectid == "SETUPSFMCOMPANY") { SFM_SETUPSFMCOMPANY_Output(); }
if ($selectid == "SETUPSFMVISITTYPE") { SFM_SETUPSFMVISITTYPE_Output(); }
if ($selectid == "SETUPSFMRECTIFICATIONTYPE") { SFM_SETUPSFMRECTIFICATIONTYPE_Output(); }
if ($selectid == "SETUPSFMREVIEWCONDITIONS") { SFM_SETUPSFMREVIEWCONDITIONS_Output(); }
if ($selectid == "SFMSETLIST") { SFM_SFMSETLIST_Output(); }
if ($selectid == "SFMCLUBSUMMARYGENERATE") { SFM_SFMCLUBSUMMARYGENERATE_Output(); }
if ($selectid == "SFMFLOODLIGHTSPECGENERATE") { SFM_SFMFLOODLIGHTSPECGENERATE_Output(); }
if ($selectid == "SFMREPLICATEALL") { SFM_SFMREPLICATEALL_Output(); }
if ($selectid == "SFMDEREPLICATEALL") { SFM_SFMDEREPLICATEALL_Output(); }
if ($selectid == "SFMACCREDCRITERIADATAUPLOAD") { SFM_ACCREDCRITERIADATAUPLOAD_Output(); }

Back_Navigator();
PageFooter("Default","Final");


?>
