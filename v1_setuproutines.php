<<<<<<< HEAD
<?php # setuproutines.inc

function Setup_SITE_Output() {
	$parm0 = "Site Settings|site[site=unique]||site_serviceid|site_serviceid|25|NoAdd";
	$parm1 = "";
	$parm1 = $parm1."site_serviceid|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
	$parm1 = $parm1."site_wwwurl|Yes|www URL|150|Yes|www URL|InputText,30,60^";
	$parm1 = $parm1."site_wwwindexpage|index page|Description|200|Yes|index page|InputText,20,60^";
	$parm1 = $parm1."site_server|Yes|Server|80|Yes|Server|InputText,10,60^";
	$parm1 = $parm1."site_protocol|Yes|Protocol|70|Yes|Protocol|InputSelectFromList,http+https^";
	$parm1 = $parm1."site_perlurl||||Yes|perl URL|InputText,30,60^";
	$parm1 = $parm1."site_phpurl||||Yes|php URL|InputText,30,60^";
	$parm1 = $parm1."site_jsurl||||Yes|js URL|InputText,30,60^";
	$parm1 = $parm1."site_cssurl||||Yes|css URL|InputText,30,60^";
	$parm1 = $parm1."site_yuiurl||||Yes|yui URL|InputText,30,60^";
	$parm1 = $parm1."site_asseturl||||Yes|site_asset URL|InputText,30,60^";
	$parm1 = $parm1."site_tinymceurl||||Yes|tinymce URL|InputText,30,60^";
	$parm1 = $parm1."site_templateurl||||Yes|template URL|InputText,30,60^";	
	$parm1 = $parm1."site_studiourl||||Yes|studio URL|InputText,30,60^";	
	$parm1 = $parm1."site_filepath||||Yes|filepath|InputText,30,60^";
	$parm1 = $parm1."site_wwwpath||||Yes|wwwpath|InputText,30,60^";	
	$parm1 = $parm1."site_modeid||||Yes|Mode|InputText,1,1^";	
	$parm1 = $parm1."site_extradirectory||||Yes|Extra Directory|InputText,20,60^";	
	$parm1 = $parm1."site_codeversion||||Yes|Code Version|InputText,5,5^";	
	$parm1 = $parm1."site_systemdate||||Yes|Syatem Date (SYSTEM or YYYYMMDD)|InputText,8,8^";	
	$parm1 = $parm1."site_simulation||||Yes|Simulation ON/OFF|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."site_testdata||||Yes|Test Data ON/OFF|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."site_readonly||||Yes|Read Only ON/OFF|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."site_mailsendmethod||||Yes|Mail Send Method|InputSelectFromList,Basic+PHPMailer+PostMark^";			
	$parm1 = $parm1."site_mailssmtppassword||||Yes|SMTP Password(PHPMailer)|InputText,30,60^";	
	$parm1 = $parm1."site_mailserviceurl||||Yes|Service URL(PostMark)|InputText,30,60^";	
	$parm1 = $parm1."site_mailservicetoken||||Yes|Service Token(PostMark)|InputText,30,60^";	
	$parm1 = $parm1."site_defaultemailaddress||||Yes|Default Mail Address|InputText,30,60^";	
	$parm1 = $parm1."site_smsserviceurl||||Yes|SMS Service URL|InputText,30,60^";
	$parm1 = $parm1."site_smsserviceusername||||Yes|SMS Service Username|InputText,30,60^";
	$parm1 = $parm1."site_smsservicepassword||||Yes|SMS Service Password|InputText,20,60^";
	$parm1 = $parm1."site_registrationmethod||||Yes|Registration Method|InputSelectFromList,Key+NoKey^";
	$parm1 = $parm1."site_registrationkey||||Yes|Registration Key|InputText,20,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_PACKAGE_Output() {
    $parm0 = "Site Packages|package[site=unique]||package_id|package_id|25|Add";
    $parm1 = "";
    $parm1 = $parm1."package_id|Yes|Package id|80|Yes|Package Id|KeyText,15,30^";
    $parm1 = $parm1."package_name|Yes|Package Name|100|Yes|Package Name|InputText,30,60^";
    // $parm1 = $parm1."package_mode||||Yes|Package Mode|InputText,30,60^";
    $parm1 = $parm1."package_webpagemax||||Yes|Max Webpages|InputText,3,3^";
    $parm1 = $parm1."package_peoplemax||||Yes|Max People|InputText,3,3^";
    $parm1 = $parm1."package_teamsmax||||Yes|Max Teams|InputText,3,3^";
    // $parm1 = $parm1."package_mobile||||Yes|site_asset URL|InputText,3,3^";
    $parm1 = $parm1."package_emailbundled||||Yes|Max Emails|InputText,3,3^";
    $parm1 = $parm1."package_smsbundled||||Yes|Max SMS|InputText,3,3^";
    $parm1 = $parm1."package_bookingsmax||||Yes|Max Bookings|InputText,3,3^";
    $parm1 = $parm1."package_advertsmax||||Yes|Max Adverts|InputText,3,3^";
    $parm1 = $parm1."package_setupprice||||Yes|Setup Price|InputText,7,7^";
    $parm1 = $parm1."package_mthlyprice||||Yes|Monthly Price|InputText,7,7^";
    $parm1 = $parm1."package_servicebar|Yes|Service Bar|60|Yes|Service Bar|InputText,1,1^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_SERVICE_Output() {
    $parm0 = "Service|service[site=unique]||service_id|service_id|25|NoAdd";
    $parm1 = "";
    $parm1 = $parm1."service_id|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
    $parm1 = $parm1."service_people||||Yes|People|InputText,3,5^";
    $parm1 = $parm1."service_personexdirectory||||Yes|Person Ex Dir|InputText,3,5^";
    $parm1 = $parm1."service_personextrafields||||Yes|Person Extra Fields|InputText,3,5^";
    $parm1 = $parm1."service_personmembership||||Yes|Person Membership|InputText,3,5^";
    $parm1 = $parm1."service_personsafeguarding||||Yes|Person Safeguarding|InputText,3,5^";
    $parm1 = $parm1."service_personethnicity||||Yes|Person Ethnicity|InputText,3,5^";
    $parm1 = $parm1."service_persondisability||||Yes|Person Disability|InputText,3,5^";
    $parm1 = $parm1."service_personmedical||||Yes|Person Medical|InputText,3,5^";
    $parm1 = $parm1."service_jobroles||||Yes|Jobroles|InputText,3,5^";
    $parm1 = $parm1."service_qualifications||||Yes|Qualifications|InputText,3,5^";
    $parm1 = $parm1."service_org||||Yes|Organisation|InputText,3,5^";
    $parm1 = $parm1."service_webpages||||Yes|Webpages|InputText,3,5^";
    $parm1 = $parm1."service_mobilepages||||Yes|Mobile Pages|InputText,3,5^";
    $parm1 = $parm1."service_advertising||||Yes|Advertising|InputText,3,5^";
    $parm1 = $parm1."service_email||||Yes|Email|InputText,3,5^";
    $parm1 = $parm1."service_sms||||Yes|SMS|InputText,3,5^";
    $parm1 = $parm1."service_library||||Yes|Library|InputText,3,5^";
    $parm1 = $parm1."service_accreditation||||Yes|Acccreditation|InputText,3,5^";
    $parm1 = $parm1."service_newsletters||||Yes|Newsletters|InputText,3,5^";
    $parm1 = $parm1."service_articles||||Yes|Articles|InputText,3,5^";
    $parm1 = $parm1."service_events||||Yes|Events|InputText,3,5^";
    $parm1 = $parm1."service_actions||||Yes|Actions|InputText,3,5^";
    $parm1 = $parm1."service_bookings||||Yes|Bookings|InputText,3,5^";
    $parm1 = $parm1."service_courses||||Yes|Courses|InputText,3,5^";
    $parm1 = $parm1."service_draws||||Yes|Draws|InputText,3,5^";
    $parm1 = $parm1."service_shop||||Yes|Shop|InputText,3,5^";
    $parm1 = $parm1."service_sections||||Sections|People|InputText,3,5^";
    $parm1 = $parm1."service_frs||||Yes|Fixtures Results and Selection|InputText,3,5^";
    $parm1 = $parm1."service_fin||||Yes|Financial Management|InputText,3,5^";
    $parm1 = $parm1."service_process||||Yes|Process|InputText,3,5^";
    $parm1 = $parm1."service_auction||||Yes|Auction|InputText,3,5^";
    $parm1 = $parm1."service_pos||||Yes|Point of Sale|InputText,3,5^";
    $parm1 = $parm1."service_cor||||Yes|Cordage|InputText,3,5^";
    $parm1 = $parm1."service_reporting||||Yes|Reporting|InputText,3,5^";
    $parm1 = $parm1."service_dmws||||Yes|DMWS|InputText,3,5^";
    $parm1 = $parm1."service_grl||||Yes|League|InputText,3,5^";
    $parm1 = $parm1."service_care||||Yes|Care|InputText,3,5^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_SERVICEENABLED_Output() {
    
    Get_Data("serviceenabled");

    $parm0 = "Service Enabled|serviceenabled[site=unique]||serviceenabled_id|serviceenabled_id|25|No";
    $parm1 = "";
    $parm1 = $parm1."serviceenabled_id|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
    if ($GLOBALS{'service_people'} != "") { $parm1 = $parm1."serviceenabled_people||||Yes|People|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personexdirectory'} != "") { $parm1 = $parm1."serviceenabled_personexdirectory||||Yes|Person Ex Dir|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personextrafields'} != "") { $parm1 = $parm1."serviceenabled_personextrafields||||Yes|Person Extra Fields|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personmembership'} != "") { $parm1 = $parm1."serviceenabled_personmembership||||Yes|Person Membership|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personsafeguarding'} != "") { $parm1 = $parm1."serviceenabled_personsafeguarding||||Yes|Person Safeguarding|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personethnicity'} != "") { $parm1 = $parm1."serviceenabled_personethnicity||||Yes|Person Ethnicity|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_persondisability'} != "") { $parm1 = $parm1."serviceenabled_persondisability||||Yes|Person Disability|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personmedical'} != "") { $parm1 = $parm1."serviceenabled_personmedical||||Yes|Person Medical|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_jobroles'} != "") { $parm1 = $parm1."serviceenabled_jobroles||||Yes|Jobroles|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_qualifications'} != "") { $parm1 = $parm1."serviceenabled_qualifications||||Yes|Qualifications|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_org'} != "") { $parm1 = $parm1."serviceenabled_org||||Yes|Organisation|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_webpages'} != "") { $parm1 = $parm1."serviceenabled_webpages||||Yes|Webpages|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_mobilepages'} != "") { $parm1 = $parm1."serviceenabled_mobilepages||||Yes|Mobile Pages|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_advertising'} != "") { $parm1 = $parm1."serviceenabled_advertising||||Yes|Advertising|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_email'} != "") { $parm1 = $parm1."serviceenabled_email||||Yes|Email|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_sms'} != "") { $parm1 = $parm1."serviceenabled_sms||||Yes|SMS|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_library'} != "") { $parm1 = $parm1."serviceenabled_library||||Yes|Library|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_accreditation'} != "") { $parm1 = $parm1."serviceenabled_accreditation||||Yes|Acccreditation|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_newsletters'} != "") { $parm1 = $parm1."serviceenabled_newsletters||||Yes|Newsletters|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_articles'} != "") { $parm1 = $parm1."serviceenabled_articles||||Yes|Articles|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_events'} != "") { $parm1 = $parm1."serviceenabled_events||||Yes|Events|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_actions'} != "") { $parm1 = $parm1."serviceenabled_actions||||Yes|Actions|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_bookings'} != "") { $parm1 = $parm1."serviceenabled_bookings||||Yes|Bookings|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_courses'} != "") { $parm1 = $parm1."serviceenabled_courses||||Yes|Courses|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_draws'} != "") { $parm1 = $parm1."serviceenabled_draws||||Yes|Draws|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_shop'} != "") { $parm1 = $parm1."serviceenabled_shop||||Yes|Shop|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_sections'} != "") { $parm1 = $parm1."serviceenabled_sections||||Sections|People|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_frs'} != "") { $parm1 = $parm1."serviceenabled_frs||||Yes|Fixtures Results and Selection|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_fin'} != "") { $parm1 = $parm1."serviceenabled_fin||||Yes|Financial Management|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_process'} != "") { $parm1 = $parm1."serviceenabled_process||||Yes|Process|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_auction'} != "") { $parm1 = $parm1."serviceenabled_auction||||Yes|Auction|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_pos'} != "") { $parm1 = $parm1."serviceenabled_pos||||Yes|Point of Sale|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_cor'} != "") { $parm1 = $parm1."serviceenabled_cor||||Yes|Cordage|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_reporting'} != "") { $parm1 = $parm1."serviceenabled_reporting||||Yes|Reporting|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_dmws'} != "") { $parm1 = $parm1."serviceenabled_dmws||||Yes|DMWS|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_grl'} != "") { $parm1 = $parm1."serviceenabled_grl||||Yes|League|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_care'} != "") { $parm1 = $parm1."serviceenabled_care||||Yes|Care|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_SITEEMAIL_Output() {
	$parm0 = "Email and Messaging Settings|site[site=unique]||site_serviceid|site_serviceid|25|NoAdd";
	$parm1 = "";
	$parm1 = $parm1."site_serviceid|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
	$parm1 = $parm1."site_mailsendmethod||||Yes|Mail Send Method|InputSelectFromList,Basic+PHPMailer+PostMark^";
	$parm1 = $parm1."site_mailssmtppassword||||Yes|SMTP Password(PHPMailer)|InputText,30,60^";
	$parm1 = $parm1."site_mailserviceurl||||Yes|Service URL(PostMark)|InputText,30,60^";
	$parm1 = $parm1."site_mailservicetoken||||Yes|Service Token(PostMark)|InputText,30,60^";
	$parm1 = $parm1."site_defaultemailaddress||||Yes|Default Mail Address|InputText,30,60^";
	$parm1 = $parm1."site_smssendmethod||||Yes|Mail Send Method|InputSelectFromList,FireText+WhatsAppn^";
	$parm1 = $parm1."site_smsserviceurl||||Yes|SMS Service URL|InputText,30,60^";
	$parm1 = $parm1."site_smsserviceusername||||Yes|SMS Service Username|InputText,30,60^";
	$parm1 = $parm1."site_smsservicepassword||||Yes|SMS Service Password|InputText,20,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Email and Messaging Settings|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_SETUPSITEAPPVERSION_Output() {
    $parm0 = "Site Application Version|site[site=unique]||site_serviceid|site_serviceid|25|NoAdd";
    $parm1 = "";
    $parm1 = $parm1."site_serviceid|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
    $parm1 = $parm1."site_synchroniseappversion||||Yes|Site Application Version|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Email and Messaging Settings|UpdateButton";
    // $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_DOMAINSERVICE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "bootstraptogglemin";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstraptogglemin";	
}

function Setup_DOMAINSERVICE_Output() {
    XH2("Domain Service Options");
    XBR();   
    Get_Data('account_'.$GLOBALS{'LOGIN_domain_id'});  
    Get_Data('package_'.$GLOBALS{'account_packageid'});
    
    XPTXT("You currently have the ".$GLOBALS{'account_packageid'}." version.");
    
    XFORM("setupdomainservicein.php","setupservicein");
    XINSTDHID();   
    XH3("People");
    ServiceEnabledOut('Ex Directory','personextdirectory');
    ServiceEnabledOut('Additional Database Fields','personextrafields');
    ServiceEnabledOut('Membership Management','personmembership');
    ServiceEnabledOut('Safeguarding','personsafeguarding');
    ServiceEnabledOut('Ethnicity','personethnicity');
    ServiceEnabledOut('Disability','persondisability');
    ServiceEnabledOut('Medical','personmedical');
    
    if ( ServiceAvailable('jobroles,qualifications') ) {
        XH3("Job Roles and Qualifications");
        ServiceEnabledOut('Job Roles','jobroles');
        ServiceEnabledOut('Qualifications','qualifications');
    }   
    if ( ServiceAvailable('org,sections,actions,reporting') ) {        
        XH3("Organisation and Administration");
        ServiceEnabledOut('Organisation','org');
        ServiceEnabledOut('Sections and Groups','sections');
        ServiceEnabledOut('Action Log','actions');
        ServiceEnabledOut('Reporting','reporting');
    }   
    if ( ServiceAvailable('email,sms,newsletters') ) {        
        XH3("Communications");
        ServiceEnabledOut('EMail','email');
        ServiceEnabledOut('SMS Texts','sms');
        ServiceEnabledOut('Newsletter Composition','newsletters');
    }
    if ( ServiceAvailable('library,accreditation') ) {        
        XH3("Records Keeping");
        ServiceEnabledOut('Library','library');
        ServiceEnabledOut('Accreditation','accreditation');
    }
    if ( ServiceAvailable('advertising,articles,events,courses,draws') ) {        
        XH3("Website Services");
        ServiceEnabledOut('Sponsor Advertising','advertising');
        ServiceEnabledOut('News Articles','articles');
        ServiceEnabledOut('Events','events');
        ServiceEnabledOut('Bookable Courses','courses');
        ServiceEnabledOut('Raffles','draws');        
    }
    if ( ServiceAvailable('bookings,shop') ) {
        XH3("Bookable Facilities and Shop");
        ServiceEnabledOut('Bookable Facilities','bookings');
        ServiceEnabledOut('Shop','shop');
    }
    if ( ServiceAvailable('fin') ) {
        XH3("Financial Management");
        ServiceEnabledOut('Bookeeping','fin');
    }
        
    XBR();
    XINSUBMIT("Update");
    X_FORM();
}

function ServiceAvailable($servicelist) {
    $found = "0";
    $tstring = $GLOBALS{"service^FIELDS"}; $tfields = explode('|', $tstring);
    foreach ($tfields as $tfield) {
        $tbits = explode('_',$tfield);
        if (FoundInCommaList($tbits[1],$servicelist)) {           
            if ( $GLOBALS{'service_'.$tbits[1]} != "" ) { $found = "1"; }
        }
    }
    if ( $found == "1" ) {return true;} else {return false;}
}

function ServiceEnabledOut($description,$serviceref) {    
    if ( $GLOBALS{'service_'.$serviceref} != ""  ) {
        // XPTXT($GLOBALS{'package_servicebar'}." vs ".$GLOBALS{'service_'.$serviceref});
        if ($GLOBALS{'package_servicebar'} >= $GLOBALS{'service_'.$serviceref} ) {
            if ( ($GLOBALS{'serviceenabled_'.$serviceref} == "Enabled" )||($GLOBALS{'serviceenabled_'.$serviceref} == "Yes")) {
                $togglestatus = "Yes";               
            } else {
                $togglestatus = "No";     
            }
            BROW();
            BCOLTXT("","1");
            BCOLTXT($description,"2");
            BCOLINTOGGLEYESNO ("serviceenabled_".$serviceref,$togglestatus,"1");
            B_ROW();  
        } else {          
            BROW();
            BCOLTXT("","1");
            BCOLTXTCOLOR($description,"2","white","silver");
            BCOLTXTCOLOR("Upgrade Required","2","white","silver");
            B_ROW();             
        }
    }
}

function Setup_SPORT_Output() {
	$parm0 = "Sport Configuration|sport[site=all]||sport_id|sport_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."sport_id|Yes|Sport id|80|Yes|Sport Id|KeyText,2,2^";
	$parm1 = $parm1."sport_name|Yes|Name|150|Yes|Sport Name|InputText,30,60^";
	$parm1 = $parm1."sport_officialsname|Yes|Officials Name|150|Yes|Officials Title|InputText,30,60^";
	$parm1 = $parm1."sport_resultunit|Yes|Result Unit|150|Yes|Result Unit|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_DOMAIN_Output() {

	$parm0 = "Domain Configuration|domain|sport|domain_id|domain_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."domain_id|Yes|Domain id|120|Yes|Domain Id|KeyText,6,15^";
	$parm1 = $parm1."domain_longname||||Yes|Longname|InputText,25,50^";
	$parm1 = $parm1."domain_shortname||||Yes|Shortname|InputText,15,20^";
	/*
	$parm1 = $parm1."domain_modeid||||Yes|Mode|InputFixed,2^";
	*/
	$parm1 = $parm1."domain_codeversion||||Yes|Code Version|InputText,5,5^";
	$parm1 = $parm1."domain_systemdate||||Yes|Syatem Date (SYSTEM or YYYYMMDD)|InputText,8,8^";
	$parm1 = $parm1."domain_simulation||||Yes|Simulation|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."domain_testdata||||Yes|Test Data|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."domain_readonly||||Yes|Read Only|InputSelectFromList,OFF+ON^";
	/*
	$parm1 = $parm1."domain_webstyle||||Yes|WebStyle|InputFixed,Default^";
	$parm1 = $parm1."domain_mobilestyle||||Yes|Mobile Style|InputFixed,Default^";
	$parm1 = $parm1."domain_weblock||||Yes|Weblock|InputFixed,^";
	$parm1 = $parm1."domain_domainmasters||||Yes|Domain Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_webmasters||||Yes|Web Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_resultsmasters||||Yes|Results Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_personmasters||||Yes|Person Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_bookingmasters||||Yes|Booking Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_sponsormasters||||Yes|Sponsor Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_salesmasters||||Yes|Sales Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_adminmasters||||Yes|Admin Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_commsmasters||||Yes|Comms Masters|InputFixed,".$domain_contactid."^";
	// $parm1 = $parm1."domain_personmassnotifyintro||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_contactid||||Yes|Test Data ON/OFF|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_currperiodid||||Yes|Current Period|InputText,10,12^";
	// $parm1 = $parm1."domain_urlrootdirectory||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_emailblocksize||||Yes|Email Blocksize|InputFixed,200^";
	$parm1 = $parm1."domain_personmembershipnotifyintro||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_showforgottenpasswordemail||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_showforgottenpasswordemailkey||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipintrotext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipmedicaltext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipminortext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipethnicitytext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipfinaltext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershiptermstext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipreminderintro||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipexperiencetext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershiptypetext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_defaultemailaddress||||Yes|Test Data ON/OFF|InputText,3,3^";
	*/
	$parm1 = $parm1."domain_defaultemailaddress||||Yes|Default Email Address|InputText,60,100^";
	$parm1 = $parm1."domain_timeoutminutes||||Yes|Timeout (Minutes)|InputText,4,6^";
	$parm1 = $parm1."domain_actualurl||||Yes|Organisation URL|InputText,50,100^";
	$parm1 = $parm1."domain_sportid|Yes|Sport|100|Yes|Sport|InputSelectFromTable,sport,sport_id,sport_name,sport_id^";
	// $parm1 = $parm1."generic_programbutton|Yes|Create|100|No|Create Domain|ProgramButton,domainsetup.php,domain_id,domain_id,800,600^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_COOKIES_Output() {
 	XH2("Setup Cookie");
	XTABLE();
	XFORM("setupcookiesin.php","cookies");
	XINSTDHID();
	XTR();XTDTXT("Name");XTDINTXT ("CookieName","","15","30"); X_TR();
	XTR();XTDTXT("Value");XTDINTXT ("CookieValue","","15","30"); X_TR();	
	XTR();XTDTXT("Duration - Hours");XTDINTXT("CookieHours","","3","30"); X_TR();	
	XTR();XTDTXT("");XTDINSUBMIT("Send");X_TR();
	X_TABLE();
	X_FORM();
}

function Setup_DOMAINMASTERS_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Setup_DOMAINMASTERS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Domain Masters"."|"; # pagetitle
	$parm0 = $parm0."domain"."|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."domain_id|"; # keyfieldname
	$parm0 = $parm0."domain_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."domain_id|Yes|Domain id|120|Yes|Domain Id|KeyText,6,15^";
	$parm1 = $parm1."domain_domainmasters||||Yes|Domain Masters|InputPerson,40,80,domainmasters,Lookup^";
	$parm1 = $parm1."domain_webmasters||||Yes|Web Masters|InputPerson,40,80,webmasters,Lookup^";
	if ( $GLOBALS{'service_frs'} != "" ) {
		$parm1 = $parm1."domain_resultsmasters||||Yes|Results Masters|InputPerson,40,80,resultsmasters,Lookup^";
	}
	$parm1 = $parm1."domain_personmasters||||Yes|Person Masters|InputPerson,40,80,personmasters,Lookup^";
	if ( $GLOBALS{'service_bookings'} != "" ) {	
		$parm1 = $parm1."domain_bookingmasters||||Yes|Booking Masters|InputPerson,40,80,bookingmasters,Lookup^";
	}
	if ( $GLOBALS{'service_advertising'} != "" ) {
		$parm1 = $parm1."domain_sponsormasters||||Yes|Sponsor Masters|InputPerson,40,80,sponsormasters,Lookup^";
	}
	if ( $GLOBALS{'service_shop'} != "" ) {
		$parm1 = $parm1."domain_salesmasters||||Yes|Sales Masters|InputPerson,40,80,salesmasters,Lookup^";
	}
	$parm1 = $parm1."domain_adminmasters||||Yes|Admin Masters|InputPerson,40,80,adminmasters,Lookup^";
	$parm1 = $parm1."domain_commsmasters||||Yes|Comms Masters|InputPerson,40,80,commsmasters,Lookup^";
	$parm1 = $parm1."domain_qualificationmasters||||Yes|Qualification Masters|InputPerson,40,80,qualificationmasters,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,domainmasters,Select,domain_domainmasters_input,domain_domainmasters_personlist,80|
field,webmasters,Select,domain_webmasters_input,domain_webmasters_personlist,80|
field,resultsmasters,Select,domain_resultsmasters_input,domain_resultsmasters_personlist,80|
field,personmasters,Select,domain_personmasters_input,domain_personmasters_personlist,80|
field,bookingmasters,Select,domain_bookingmasters_input,domain_bookingmasters_personlist,80|
field,sponsormasters,Select,domain_sponsormasters_input,domain_sponsormasters_personlist,80|
field,salesmasters,Select,domain_salesmasters_input,domain_salesmasters_personlist,80|
field,adminmasters,Select,domain_adminmasters_input,domain_adminmasters_personlist,80|
field,commsmasters,Select,domain_commsmasters_input,domain_commsmasters_personlist,80|
field,qualificationmasters,Select,domain_qualificationmasters_input,domain_qualificationmasters_personlist,80",
"person_id",
"active",
"domainmasters,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_COMMSMASTERS_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Setup_COMMSMASTERS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Comms Masters"."|"; # pagetitle
	$parm0 = $parm0."commsmasters"."|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."commsmasters_domainid|"; # keyfieldname
	$parm0 = $parm0."commsmasters_domainid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."commsmasters_domainid|Yes|Domain id|120|Yes|Domain Id (".$GLOBALS{'domain_id'}.")|KeyText,25,50^";
	$parm1 = $parm1."commsmasters_bulletineditorlist||||Yes|Bulletin Editor|InputPerson,25,50,bulletineditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_eventeditorlist||||Yes|Events Editor|InputPerson,25,50,eventeditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_articleeditorlist||||Yes|Articles Editor|InputPerson,25,50,articleeditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_courseeditorlist||||Yes|Courses Editor|InputPerson,25,50,courseeditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_websitepublisherlist||||Yes|Website Publisher|InputPerson,25,50,websitepublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_bulletinpublisherlist||||Yes|Bulletin Publisher|InputPerson,25,50,bulletinpublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_newsletterpublisherlist||||Yes|Newsletter Publisher|InputPerson,25,50,newsletterpublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_facebookpublisherlist||||Yes|Facebook Publisher|InputPerson,25,50,facebookpublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_twitterpublisherlist||||Yes|Twitter Publisher|InputPerson,25,50,twitterpublisherlist,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,bulletineditorlist,Select,commsmasters_bulletineditorlist_input,commsmasters_bulletineditorlist_personlist,80|
field,eventeditorlist,Select,commsmasters_eventeditorlist_input,commsmasters_eventeditorlist_personlist,80|
field,articleeditorlist,Select,commsmasters_articleeditorlist_input,commsmasters_articleeditorlist_personlist,80|
field,courseeditorlist,Select,commsmasters_courseeditorlist_input,commsmasters_courseeditorlist_personlist,80|
field,websitepublisherlist,Select,commsmasters_websitepublisherlist_input,commsmasters_websitepublisherlist_personlist,80|
field,bulletinpublisherlist,Select,commsmasters_bulletinpublisherlist_input,commsmasters_bulletinpublisherlist_personlist,80|
field,newsletterpublisherlist,Select,commsmasters_newsletterpublisherlist_input,commsmasters_newsletterpublisherlist_personlist,80|
field,facebookpublisherlist,Select,commsmasters_facebookpublisherlist_input,commsmasters_facebookpublisherlist_personlist,80|
field,twitterpublisherlist,Select,commsmasters_twitterpublisherlist_input,commsmasters_twitterpublisherlist_personlist,80",  
"person_id",
"active",
"commsmasters,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_PERSONTYPES_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_PERSONTYPES_Output() {
	$parm0 = "Membership Types - ".$GLOBALS{'currperiodid'}."|persontype[rootkey=".$GLOBALS{'currperiodid'}."]||persontype_code|persontype_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."persontype_code|Yes|Id|60|Yes|Membership type Id|KeyText,12,15^";
	$parm1 = $parm1."persontype_name|Yes|Description|200|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."persontype_criteria|No|Criteria|60|Yes|Criteria|InputTextArea,3,40^";
	$parm1 = $parm1."persontype_eventfee|No|Event Fee|60|Yes|Match Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_seq|Yes|Seq|60|Yes|Seq|InputText,4,4^";
	$parm1 = $parm1."persontype_selectable|Yes|Selectable|60|Yes|Selectable|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."persontype_annualoneofffee|Yes|Annual Fee|60|Yes|One Off Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedfee|Yes|Staged Fee|60|Yes|Staged Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedinitialfee|No|IF|60|Yes|Staged Initial Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedrecurringfee|No|RF|60|Yes|Staged Recurring Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedrecurringpayments|No|NoRP|60|Yes|Staged Payments|InputText,7,7^";
	$parm1 = $parm1."persontype_multimember|No|Multi|60|Yes|Multi Member|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."persontype_multimemberquantity|No|Multi|60|Yes|Multi Member Quantity|InputSelectFromList,1+2+3+4+5+6+7+8^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_PERSONUSERLEVEL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_PERSONUSERLEVEL_Output() {
    $parm0 = "User levels|personuserlevel||personuserlevel_code|personuserlevel_code|25|No";
    $parm1 = "";
    $parm1 = $parm1."personuserlevel_code|Yes|User Level|60|Yes|User Level|KeyText,1,1^";
    $parm1 = $parm1."personuserlevel_description|Yes|Description|200|Yes|Description|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_ETHNICITY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_ETHNICITY_Output() {
	$parm0 = "Ethnicity Types|ethnicity||ethnicity_code|ethnicity_seq|25|No";
	$parm1 = "";
	$parm1 = $parm1."ethnicity_code|Yes|Id|60|Yes|Ethnicity Code|KeyText,12,15^";
	$parm1 = $parm1."ethnicity_title|Yes|Title|250|Yes|Title|InputText,30,60^";
	$parm1 = $parm1."ethnicity_seq|Yes|Seq|60|Yes|Seq|InputText,4,4^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_DISABILITY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_DISABILITY_Output() {
	$parm0 = "Disability Types|disability||disability_code|disability_seq|25|No";
	$parm1 = "";
	$parm1 = $parm1."disability_code|Yes|Id|60|Yes|Ethnicity Code|KeyText,12,15^";
	$parm1 = $parm1."disability_title|Yes|Title|250|Yes|Title|InputText,30,60^";
	$parm1 = $parm1."disability_seq|Yes|Seq|60|Yes|Seq|InputText,4,4^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Setup_MEMBERSHIPFORMTEXT_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_MEMBERSHIPFORMTEXT_Output() {
	$parm0 = "Membership Form Text|domain||domain_id||25|No";
	$parm1 = "";
	$parm1 = $parm1."domain_id|Yes|Id|150|Yes|Domain Id|KeyText,12,15^";
	$parm1 = $parm1."|No|||Yes|Text on Membership Form|Divider^";
	$parm1 = $parm1."domain_personmembershipintrotext|No|||Yes|Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershiptypetext|No|||Yes|Section/Type Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipexperiencetext|No|||Yes|Experience Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipmedicaltext|No|||Yes|Medical Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipminortext|No|||Yes|Under 18 Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipethnicitytext|No|||Yes|Ethnicity/Disability Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipfinaltext|No|||Yes|Closing Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershiptermstext|No|||Yes|Terms and Conditions|InputTextArea,4,50^";
	$parm1 = $parm1."|No|||Yes|Text on Mass Membership Notifiers|Divider^";
	$parm1 = $parm1."domain_personmembershipnotifyintro|No|||Yes|Initial Notifier Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipreminderintro|No|||Yes|Reminder Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."|No|||Yes|Text on Mass Info Notifiers|Divider^";
	$parm1 = $parm1."domain_personmassnotifyintro|No|||Yes|Introduction Text|InputTextArea,4,50^";
	// $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_SECTION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Setup_SECTION_Output() {

	$parm0 = "";
	$parm0 = $parm0."Section Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."section[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
	if ( $GLOBALS{'service_frs'} != "" ) {
		$parm0 = $parm0."sport,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	} else {
		$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section|"; # othertables
	}	
	$parm0 = $parm0."section_name|"; # keyfieldname
	$parm0 = $parm0."section_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."section_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."section_name|Yes|Name|90|Yes|Section Name|KeyText,12,15^";
	$parm1 = $parm1."section_seq|Yes|Seq|40|Yes|Sequence|InputText,10,20^";
	$parm1 = $parm1."section_leader|No|||Yes|Leader|InputPerson,10,20,Ldr,Lookup^";
	$parm1 = $parm1."section_personmgrs|No|||Yes|People Authorised to Update<BR>Section Person Information|InputPerson,45,100,PMgrs,Lookup^";
	$tsyntax = "InputSelectFromList,0[Section treated as Ex Directory]+1[Visible only to people in this section]+2[Visible to people in other sections]";
	$parm1 = $parm1."section_exdir|Yes|Confidentiality|100|Yes|Confidentiality Control|$tsyntax^";
	$tsyntax = "InputSelectFromList,Yes[Library Update open to all people in this section]+No[Library Update restricted]";
	$parm1 = $parm1."section_libraryupdateall|No|||Yes|Library Update|$tsyntax^";
	$parm1 = $parm1."section_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."section_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."section_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."section_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	if ( $GLOBALS{'service_frs'} != "" ) {
		$parm1 = $parm1."section_teams|No|||Yes|Teams|InputText,30,60^";
		$parm1 = $parm1."section_resmgrs|No|||Yes|People Authorised to Update<BR>Subsection Results|InputPerson,45,100,RMgrs,Lookup^";
		$parm1 = $parm1."section_sportid|Yes|Sport|100|Yes|Sport|InputSelectFromTable,sport,sport_id,sport_name,sport_id^";
		$parm1 = $parm1."section_frs|Yes|Fix-Res|60|Yes|Fixtures/Results<br/>Functionalty Enabled|InputSelectFromList,Yes+No^";
		$parm1 = $parm1."section_seasonstartdate|Yes|Start|80|Yes|Season Start Date|InputDate^";
		$parm1 = $parm1."section_seasonenddate|Yes|End|80|Yes|Season End Date|InputDate^";
		$parm1 = $parm1."section_showdateavailability|Yes|AvailDates|80|Yes|Show All Dates on<br>Availability Input|InputSelectFromList,Yes+No^";
	}
	$parm1 = $parm1."section_archive|Yes|Arch|50|Yes|Archive|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."section_paypalemail|No|||Yes|PayPal email|InputText,40,80^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|75|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	
$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Ldr,Ldr..,section_leader_input,section_leader_personlist,50|
field,PMgrs,PMgrs..,section_personmgrs_input,section_personmgrs_personlist,65|
field,RMgrs,RMgrs..,section_resmgrs_input,section_resmgrs_personlist,65|
field,Treasurer,Treasurer..,section_treasurer_input,section_treasurer_personlist,65",
 "person_id",
 "active",
 "section,50,50,200,200",
 "view",
 "buildfulllist"
);	
	
}

function Setup_TEAM_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Setup_TEAM_Output() {
	XH3('Please note that Team Codes are 2 character Alphanumeric. eg "M2" or "CC"');
	XH4('Dont forget to assign the team to a section once you have set it up.');
	$parm0 = "";
	$parm0 = $parm0."Team Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."team[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."team_code|"; # keyfieldname
	$parm0 = $parm0."team_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."team_code|Yes|Code|90|Yes|Team Code|KeyText,2,2^";
	$parm1 = $parm1."team_name|Yes|Name|150|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."team_mgr|Yes|Manager|100|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."team_captain|Yes|Captain|100|Yes|Captain|InputPerson,10,25,Captain,Lookup^";
	$parm1 = $parm1."team_coach|Yes|Coach|100|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."team_resmgrs|No|Results Managers|90|Yes|Other Team members authorised to enter match results etc|InputPerson,45,100,ResMgrs,Lookup^";
	$parm1 = $parm1."team_leaguename|Yes|League Name|150|Yes|League Name|InputText,50,150^";
	$parm1 = $parm1."team_leaguelink|No|League Link|90|Yes|League Link|InputTextArea,3,50^";
	// $parm1 = $parm1."team_netref|No|Net Ref|90|Yes|Net Ref|InputText,50,150^";
	// $parm1 = $parm1."team_netcompref|No|Net Comp Ref|90|Yes|Net Comp Ref|InputText,50,150^";
	$parm1 = $parm1."team_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	$parm1 = $parm1."team_squadlist|No|Squad|90|Yes|Squad|InputPerson,45,200,Squad,Lookup^";
	$parm1 = $parm1."team_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."team_photo|No|Photo|30|Yes|Team Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,1000,200,Team,team_code^";
	$parm1 = $parm1."team_selectionreminder|No|Reminder|50|Yes|Selection Reminder|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."team_videostreamvisibility|No|||Yes|Video Stream Visibility|InputSelectFromList,Public+Members^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,60",
"field,Manager,Select,team_mgr_input,team_mgr_personlist,70|
field,Captain,Select,team_captain_input,team_captain_personlist,70|
field,Coach,Select,team_coach_input,team_coach_personlist,70|
field,ResMgrs,Select,team_resmgrs_input,team_resmgrs_personlist,80|
field,Squad,Select,team_squadlist_input,team_squadlist_personlist,80|
field,Hlprs,Select,team_helpers_input,team_helpers_personlist,80",
"person_id",
"active",
"team,50,50,400,400",
"view",
"buildfulllist"
	);	
	
}

function Setup_MYTEAM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Setup_MYTEAM_Output($teamcode) {
	$parm0 = "";
	$parm0 = $parm0."My Team Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."team[rootkey=".$GLOBALS{'currperiodid'}."][fieldvalue=team_code:".$teamcode."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."team_code|"; # keyfieldname
	$parm0 = $parm0."team_seq|"; # sortfieldname
	$parm0 = $parm0."No|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."team_code|Yes|Team Code|90|Yes|Team Code|KeyText,5,15^";
	$parm1 = $parm1."team_name|Yes|Name|150|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."team_mgr|Yes|Manager|100|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."team_captain|Yes|Captain|100|Yes|Captain|InputPerson,10,25,Captain,Lookup^";
	$parm1 = $parm1."team_coach|Yes|Coach|100|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."team_resmgrs|No|Results Managers|90|Yes|Other Team members authorised to enter match results etc|InputPerson,45,100,ResMgrs,Lookup^";
	$parm1 = $parm1."team_leaguename|No|League Name|90|Yes|League Name|InputText,50,150^";
	$parm1 = $parm1."team_leaguelink|No|League Link|90|Yes|League Link|InputTextArea,3,50^";
	//	$parm1 = $parm1."team_netref|No|Net Ref|90|Yes|Net Ref|InputText,50,150^";
	//	$parm1 = $parm1."team_netcompref|No|Net Comp Ref|90|Yes|Net Comp Ref|InputText,50,150^";
	//	$parm1 = $parm1."team_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	//	$parm1 = $parm1."team_squadlist|No|Squad|90|Yes|Squad|InputPerson,45,100,Squad,Lookup^";
	$parm1 = $parm1."team_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."team_photo|No|Photo|30|Yes|Team Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,1000,200,Team,team_code^";
	$parm1 = $parm1."team_selectionreminder|No|Reminder|50|Yes|Selection Reminder|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."team_videostreamvisibility|No|||Yes|Video Stream Visibility|InputSelectFromList,Public+Members^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Manager,Select,team_mgr_input,team_mgr_personlist,70|
field,Captain,Select,team_captain_input,team_captain_personlist,70| 
field,Coach,Select,team_coach_input,team_coach_personlist,70|
field,ResMgrs,Select,team_resmgrs_input,team_resmgrs_personlist,80|
field,Squad,Select,team_squadlist_input,team_squadlist_personlist,80|
field,Hlprs,Select,team_helpers_input,team_helpers_personlist,80",
"person_id",
"active",
"team,50,50,400,400",
"view",
"buildfulllist"
	);
	
	XHRCLASS("underline");
	XH3("Notes:");
	XPTXT("Team Setup is used to define the Managers, Coaches, Captains and other helpers associated with your team.");
	XPTXT("It also allows you to enter the League/Cup that your team plays in, and the link to League/Cup Results.");
}



function Setup_SECTIONGROUP_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

Function Setup_SECTIONGROUP_Output() {
	$parm0 = "";
	$parm0 = $parm0."Group Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."sectiongroup[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."sectiongroup_code|"; # keyfieldname
	$parm0 = $parm0."sectiongroup_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."sectiongroup_code|Yes|Group Code|90|Yes|Group Code|KeyText,5,15^";
	$parm1 = $parm1."sectiongroup_name|Yes|Name|120|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."sectiongroup_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	$parm1 = $parm1."sectiongroup_mgr|Yes|Manager|90|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."sectiongroup_coach|Yes|Coach|90|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."sectiongroup_personmgrs|No|People Managers|90|Yes|Administrators - Other people who need access to group records|InputPerson,45,100,PMgrs,Lookup^";
	$parm1 = $parm1."sectiongroup_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Manager,Select,sectiongroup_mgr_input,sectiongroup_mgr_personlist,70|
field,Coach,Select,sectiongroup_coach_input,sectiongroup_coach_personlist,70|
field,PMgrs,Select,sectiongroup_personmgrs_input,sectiongroup_personmgrs_personlist,80|
field,Hlprs,Select,sectiongroup_helpers_input,sectiongroup_helpers_personlist,80",
"person_id",
"active",
"group,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_MYSECTIONGROUP_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,viewaspopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

Function Setup_MYSECTIONGROUP_Output($sectiongroupcode) {
	$parm0 = "";
	$parm0 = $parm0."My Group Setup ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."sectiongroup[rootkey=".$GLOBALS{'currperiodid'}."][fieldvalue=sectiongroup_code:".$sectiongroupcode."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."sectiongroup_code|"; # keyfieldname
	$parm0 = $parm0."sectiongroup_seq|"; # sortfieldname
	$parm0 = $parm0."No|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."sectiongroup_code|Yes|Group Code|90|Yes|Group Code|KeyText,5,15^";
	$parm1 = $parm1."sectiongroup_name|Yes|Name|120|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."sectiongroup_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	$parm1 = $parm1."sectiongroup_mgr|Yes|Manager|90|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."sectiongroup_coach|Yes|Coach|90|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."sectiongroup_personmgrs|No|People Managers|90|Yes|Administrators - Other people who need access to group records|InputPerson,45,100,PMgrs,Lookup^";
	$parm1 = $parm1."sectiongroup_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Manager,Select,sectiongroup_mgr_input,sectiongroup_mgr_personlist,70|
field,Coach,Select,sectiongroup_coach_input,sectiongroup_coach_personlist,70|
field,PMgrs,Select,sectiongroup_personmgrs_input,sectiongroup_personmgrs_personlist,80|
field,Hlprs,Select,sectiongroup_helpers_input,sectiongroup_helpers_personlist,80",
"person_id",
"active",
"group,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_VENUE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

Function Setup_VENUE_Output() {
	$parm0 = "Venue Update New|venue|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|venue_code|venue_code|No|No";
	$parm1 = "";
	$parm1 = $parm1."venue_code|Yes|Venue Code|90|Yes|Venue Code|KeyText,5,15^";
	$parm1 = $parm1."venue_name|Yes|Name|100|Yes|Venue Name|InputText,25,50^";
	$parm1 = $parm1."venue_link||||Yes|Link|InputText,50,100^";
	$parm1 = $parm1."venue_netref||||Yes|NetRef|InputText,50,100^";
	$parm1 = $parm1."venue_facility||||Yes|Facility Description|InputTextArea,3,50^";
	$parm1 = $parm1."venue_bookable|Yes|Bookable|70|Yes|Venue Bookable|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."venue_owner|Yes|Contact|80|Yes|Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."venue_daytimestart|No||40|Yes|Time Start|InputText,5,5^";
	$parm1 = $parm1."venue_daytimeend|No||40|Yes|Time End|InputText,5,5^";
	$parm1 = $parm1."venue_timeslice|No||40|Yes|Time Slice|InputText,5,5^";
	$parm1 = $parm1."venue_leadtimedays|No||40|Yes|Leadtime Days|InputText,2,2^";
	$parm1 = $parm1."venue_authorisation|No||40|Yes|Authorised Administrators|InputPerson,10,20,Administrator,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,venue_owner_input,venue_owner_personlist,50|field,Administrator,Administrator..,venue_authorisation_input,venue_authorisation_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "venue,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Setup_PAYMENTOPTION_Output() {
	$parm0 = "Payment Options|paymentoption||paymentoption_name|paymentoption_name|No|No";
	$parm1 = "";
	$parm1 = $parm1."paymentoption_name|Yes|Name|100|Yes|Payment Option Name|KeyText,25,50^";
	$parm1 = $parm1."paymentoption_description|No|Description|150|Yes|Description|InputTextArea,4,50^";
	$parm1 = $parm1."paymentoption_type|Yes|Type|80|Yes|Payment Option Type|InputSelectFromList,BankTransfer+Merchant+Cheque+Cash^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_ADVERTISERCATEGORY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_ADVERTISERCATEGORY_Output() {
	$parm0 = "Advertiser Category Update|advertisercategory||advertisercategory_name|advertisercategory_name|No|No";
	$parm1 = "";
	$parm1 = $parm1."advertisercategory_name|Yes|Category Name|100|Yes|Advertiser Category Name|KeyText,25,50^";
	$parm1 = $parm1."advertisercategory_title|Yes|Description|150|Yes|Description|InputText,50,90^";
	$parm1 = $parm1."advertisercategory_imagewidth|Yes|Width|150|Yes|Image Width|InputText,06,10^";	
	$parm1 = $parm1."advertisercategory_imageheight|Yes|Height|150|Yes|Image Height|InputText,06,10^";
	$parm1 = $parm1."advertisercategory_thumbimagewidth|Yes|Thumb Width|150|Yes|Thumbnail Image Width|InputText,06,10^";
	$parm1 = $parm1."advertisercategory_thumbimageheight|Yes|Thumb Height|150|Yes|Thumbnail Image Height|InputText,06,10^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Setup_ADVERTISER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ADVERTISER_Output() {
	$parm0 = "Advertiser Update|advertiser|advertisercategory|advertiser_name|advertiser_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."advertiser_name|Yes|Name|140|Yes|Advertiser Name|KeyText,15,25^";
	$parm1 = $parm1."advertiser_category|Yes|Category|100|Yes|Category|InputSelectFromTable,advertisercategory,advertisercategory_name,advertisercategory_title,advertisercategory_name^";
	$parm1 = $parm1."advertiser_freq|Yes|Freq|30|Yes|Frequency|InputText,6,20^";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) { $bannerurlbase = "GLOBALSITEWWWURL"; } 
	else { $bannerurlbase = "GLOBALDOMAINWWWURL"; }
	$bannerurldir = $bannerurlbase."/domain_advertisers";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) { $bannerfilebase = "GLOBALSITEWWWPATH"; } 
	else { $bannerfilebase = "GLOBALDOMAINWWWPATH"; }
	$bannerfiledir = $bannerfilebase."/domain_advertisers";
	$parm1 = $parm1."advertiser_banner|No|Banner|30|Yes|Banner Image|InputImage,$bannerurldir,$bannerfiledir,advertisercategory_imagewidth[advertiser_category_input],advertisercategory_imageheight[advertiser_category_input],Advertiser,advertiser_name,advertiser_category^";	
	$parm1 = $parm1."advertiser_thumb|No|Thumb|30|Yes|Thumbnail Image (Optional)|InputImage,$bannerurldir,$bannerfiledir,advertisercategory_thumbimagewidth[advertiser_category_input],advertisercategory_thumbimageheight[advertiser_category_input],Advertiser,advertiser_name,advertiser_category^";
	$parm1 = $parm1."advertiser_website|No|Website|30|Yes|Website|InputText,25,50^";
	$parm1 = $parm1."advertiser_email|No|eMail|30|Yes|eMail|InputText,40,80^";
	$parm1 = $parm1."advertiser_text|Yes|Descriptioo|100|Yes|Description|InputTextArea,4,50^";
	$parm1 = $parm1."advertiser_clicksresetdate|No|Reset Date|30|Yes|Click counter reset date|InputDate^";
	$parm1 = $parm1."advertiser_clicks|Yes|Clicks|30|Yes|Clicks|InputText,10,20^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_BULLETINBOARD_Output() {
	$parm0 = "Bulletin Board Management|bulletinboard|webpage|bulletinboard_name|bulletinboard_name|No|No";
	$parm1 = "";
	$parm1 = $parm1."bulletinboard_name|Yes|Id|90|Yes|Board Name|KeyText,12,15^";
	$parm1 = $parm1."bulletinboard_webpagename|Yes|Webpage|100|Yes|Webpage|InputSelectFromTable,webpage,webpage_name,webpage_name,webpage_name^";
	$parm1 = $parm1."bulletinboard_controllers|Yes|Controllers|120|Yes|Controllers|InputText,10,20^";
	$parm1 = # $parm1."bulletinboard_users|Yes|Users|150|Yes|Users allowed to post on this board|InputText,40,60^";
	$parm1 = $parm1."bulletinboard_max|Yes|Max|40|Yes|Max Bulletins shown on this board|InputSelectFromList,1+2+3+4+5+6+7+8+9+10+11+12^";
	$parm1 = $parm1."bulletinboard_keepmax|No|||Yes|Keep before deleting|InputSelectFromList,5+10+15+20+25+30^";
	$parm1 = $parm1."|No|||Yes||Divider^";
	$parm1 = $parm1."bulletinboard_fontcolor|No|||Yes|Font Color|InputSelectFromList,Black+Blue+Red+Green+Yellow+White+Silver+Gray+Maroon+Lime+Cyan+Teal+Purple+Navy+Magneta+Fuchsia+Olive+Aqua^";
	$parm1 = $parm1."bulletinboard_fonthovercolor|No|||Yes|Hover Color|InputSelectFromList,Black+Blue+Red+Green+Yellow+White+Silver+Gray+Maroon+Lime+Cyan+Teal+Purple+Navy+Magneta+Fuchsia+Olive+Aqua^";
	$parm1 = $parm1."bulletinboard_fontsize|No|||Yes|Font Size|InputSelectFromList,4+5+6+7+8+9+10+11+12+13+14+15+16+17+18^";
	$parm1 = $parm1."bulletinboard_showdates|No|||Yes|Show Dates|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."bulletinboard_textmax|No|||Yes|Max characters in text|InputText,4,4^";
	$parm1 = $parm1."|No|||Yes||Divider^";
	$parm1 = $parm1."bulletinboard_topstoryenabled|Yes|Top Story Enabled|120|Yes|Top Story Enabled|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."bulletinboard_topstorytextposition|No|||Yes|Top Story Text Position|InputSelectFromList,Above image+Below image^";
	$parm1 = $parm1."bulletinboard_topstoryimagewidth|No|||Yes|Top Story Image Width|InputText,4,4^";
	$parm1 = $parm1."|No|||Yes||Divider^";
	$parm1 = $parm1."bulletinboard_imagewidth|No|||Yes|Image Width|InputText,4,4^";
	$parm1 = $parm1."generic_programbutton|Yes|Review Content|130|No|Review Content|ProgramButton,bulletinboardeditout.php,bulletinboard_name,bulletinboard_name,samewindow,,^";
	$parm1 = $parm1."generic_updatebutton|Yes|Settings|90|No|Settings|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|75|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_QUALIFICATION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_QUALIFICATION_Output() {
	$parm0 = "Qualification Update|qualification||qualification_id|qualification_title|25|No";
	$parm1 = "";
	$parm1 = $parm1."qualification_id|Yes|Id|120|Yes|Qualification Id|KeyText,12,15^";
	$parm1 = $parm1."qualification_title|Yes|Title|100|Yes|Qualification Title|InputText,20,40^";
	$parm1 = $parm1."qualification_description|Yes|Description|300|Yes|Qualification Description|InputTextArea,4,50^";
	$parm1 = $parm1."qualification_renewalperiod|Yes|Renewal Period - Yrs|130|Yes|Renewal Period - Years|InputSelectFromList,1+2+3+4+5+6+7+8+9+10+Indefinite^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_JOBROLE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqueryui,jqdatatables,jqueryconfirm";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_JOBROLE_Output() {
	$parm0 = "Job Role Update|jobrole||jobrole_id|jobrole_title|25|No";
	$parm1 = "";
	$parm1 = $parm1."jobrole_id|Yes|Job Role Id|90|Yes|Job Role Id|KeyText,12,15^";
	$parm1 = $parm1."jobrole_title|Yes|Title|100|Yes|Job Role Title|InputText,20,40^";
	$parm1 = $parm1."jobrole_description|Yes|Description|400|Yes|Job Role Description|InputTextArea,4,50^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_JOBROLEQUALIFICATION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
}

function Setup_JOBROLEQUALIFICATION_Output() {
	$parm0 = "";
	$parm0 = $parm0."JobRole/Qualification Update|"; # pagetitle
	$parm0 = $parm0."jobrolequalification[mergedkey=jobrolequalification_jobroleid+jobrolequalification_qualificationid]|"; # primetable
	$parm0 = $parm0."jobrole,qualification|"; # othertables
	$parm0 = $parm0."jobrolequalification_jobroleid+jobrolequalification_qualificationid|"; # keyfieldname
	$parm0 = $parm0."jobrolequalification_jobroleid+jobrolequalification_qualificationid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."jobrolequalification_jobroleid|Yes|JobRole|100|Yes|JobRole|KeySelectFromTable,jobrole,jobrole_id,jobrole_title,jobrole_title^";
	$parm1 = $parm1."jobrolequalification_qualificationid|Yes|Qualification|100|Yes|Qualification|KeySelectFromTable,qualification,qualification_id,qualification_title,qualification_title^";
	$parm1 = $parm1."jobrolequalification_requirementlevel|Yes|Requirement|100|Yes|Requirement|InputSelectFromList,Required+Recommended^";
	$parm1 = $parm1."jobrolequalification_comments|Yes|Comments|150|Yes|Comments|InputText,40,80^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_TESTSLIM_Output () {
	XH2("Test Slim Image Cropper");
	XPTXT("This checks that this facility works correctly on this server.");
	XH2('Server Parameters');
	$max_upload = (int)(ini_get('upload_max_filesize'));
	XBR();XTXT("max_upload - ".$max_upload);
	$max_post = (int)(ini_get('post_max_size'));
	XBR();XTXT("max_post - ".$max_post);
	$memory_limit = (int)(ini_get('memory_limit'));
	XBR();XTXT("memory_limit - ".$memory_limit);
	XBR();XBR();
	XFORM("slimtestout.php","");
	XINSTDHID();
	XHR();
	XTDINSUBMIT("Go - Slim via Form returning Input plus Crop");	
	X_FORM();	
}

function Setup_PHPUTILITY1_Output () {
	XH3("Special PHP Utility Launcher - 1");
	for ($i = 1; $i <= 1000; $i++) {
		$pswclear = createRandomPassword();
		if (strpos($pswclear,' ') !== false) {
			XHR();
			XPTXT($person_id." "."'".$pswclear."'");
			XH5("BLANK");
			$newpswclear = str_replace(" ", "x", $pswclear);
			$GLOBALS{'person_password'} = XCrypt($newpswclear,$person_id,"encrypt");
			XPTXT($person_id." "."'".XCrypt($GLOBALS{'person_password'},$person_id,"decrypt")."'");
			Write_Data('person',$person_id);
		}
	}
}
function Setup_PHPUTILITY2_Output () {
	XH3("Special PHP Utility Launcher - 2");
	$persona = Get_Array('person');
	foreach ($persona as $person_id) {

		Get_Data('person',$person_id);
		$pswclear = XCrypt($GLOBALS{'person_password'},$person_id,"decrypt");
		if (strpos($pswclear,' ') !== false) {
			XHR();
			XPTXT($person_id." "."'".$pswclear."'");
			XH5("BLANK");
			$newpswclear = str_replace(" ", "x", $pswclear);
			$GLOBALS{'person_password'} = XCrypt($newpswclear,$person_id,"encrypt");
			XPTXT($person_id." "."'".XCrypt($GLOBALS{'person_password'},$person_id,"decrypt")."'");
			Write_Data('person',$person_id);
		}

	}
}
function Setup_PHPUTILITY3_Output () {
	XH3("Special PHP Utility Launcher - 3");

	foreach (Get_Array("section",$GLOBALS{'currperiodid'}) as $tsection_name) {
		Get_Data("section",$GLOBALS{'currperiodid'},$tsection_name);
		$teama = List2Array($GLOBALS{'section_teams'});
		foreach ($teama as $teamcode) {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'},$teamcode);
			foreach ($frsa as $frsid) {
				XHR();
				Get_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);
				XPTXT($frsid." ".$GLOBALS{'frs_personavailabilitylist'});
				XPTXT($frsid." ".$GLOBALS{'frs_playerselectedlist'});

				$GLOBALS{'frs_personavailabilitylist'} = str_replace("Yes", "Y", $GLOBALS{'frs_personavailabilitylist'});
				$GLOBALS{'frs_personavailabilitylist'} = str_replace("No", "N", $GLOBALS{'frs_personavailabilitylist'});
				$GLOBALS{'frs_personavailabilitylist'} = str_replace("Meet", "M", $GLOBALS{'frs_personavailabilitylist'});
				$GLOBALS{'frs_personavailabilitylist'} = str_replace("Direct", "D", $GLOBALS{'frs_personavailabilitylist'});

				$GLOBALS{'frs_playerselectedlist'} = str_replace("Yes", "Y", $GLOBALS{'frs_playerselectedlist'});
				$GLOBALS{'frs_playerselectedlist'} = str_replace("No", "N", $GLOBALS{'frs_playerselectedlist'});
				$GLOBALS{'frs_playerselectedlist'} = str_replace("Meet", "M", $GLOBALS{'frs_playerselectedlist'});
				$GLOBALS{'frs_playerselectedlist'} = str_replace("Direct", "D", $GLOBALS{'frs_playerselectedlist'});

				XPTXT(" ");
				XPTXT($frsid." ".$GLOBALS{'frs_personavailabilitylist'});
				XPTXT($frsid." ".$GLOBALS{'frs_playerselectedlist'});
				Write_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);

			}
		}
	}


}

function Setup_PHPUTILITY4_Output () {
	XH3("Special PHP Utility Launcher - 4");

	XH2("domainwwwurl - ".$GLOBALS{'domainwwwurl'});
	XH2("domainwwwpath - ".$GLOBALS{'domainwwwpath'});

	$bulletina = Get_Array("bulletin");
	foreach ($bulletina as $bulletin_id) {
		Get_Data("bulletin",$bulletin_id);
		if ($GLOBALS{'bulletin_image'} != "") {
			if (strpos($GLOBALS{'bulletin_image'}, 'Bulletin_') !== false) {
				XHR();
				XPTXT($bulletin_id." ".$GLOBALS{'bulletin_image'}." - <b>Image already in domain_media</b>");
			}
			else {
				XHR();
				XPTXT($bulletin_id." ".$GLOBALS{'bulletin_image'}." - <b>Image requires copy to domain_media</b>");
				$ibits = explode('/',$GLOBALS{'bulletin_image'});
				$endindex = count($ibits)-1;
				$filename = $ibits[$endindex];
				$dirname = $ibits[$endindex-1];
				$fbits = explode('_',$filename);
				$bulletinimage = "Bulletin_".$bulletin_id."_".end($fbits);
				copy($GLOBALS{'domainwwwpath'}.'/'.$dirname.'/'.$filename, $GLOBALS{'domainwwwpath'}."/domain_media/".$bulletinimage);
				XH4("From ".$GLOBALS{'domainwwwpath'}.'/'.$dirname.'/'.$filename);
				XH4("To ".$GLOBALS{'domainwwwpath'}."/domain_media/".$bulletinimage);
				$GLOBALS{'bulletin_image'} = $bulletinimage;
				Write_Data("bulletin",$bulletin_id);
			}
		}
	}
}

function Setup_PHPUTILITY5_Output () {
	XH3("Special PHP Utility Launcher - 5");

	XH2("domainwwwurl - ".$GLOBALS{'domainwwwurl'});
	XH2("domainwwwpath - ".$GLOBALS{'domainwwwpath'});

	$webpagea = Get_Array("webpage");
	foreach ($webpagea as $webpage_name) {
		Get_Data("webpage",$webpage_name);
		if ($GLOBALS{'webpage_oldaddress'} == "") {
			$GLOBALS{'webpage_oldaddress'} = $GLOBALS{'webpage_address'};
		}
		if ($GLOBALS{'webpage_oldhtml'} == "") {
			$GLOBALS{'webpage_oldhtml'} = $GLOBALS{'webpage_html'};
		}
		$GLOBALS{'webpage_html'} = $GLOBALS{'webpage_oldhtml'}; // starting point

		XH2($webpage_name." - ".$GLOBALS{'webpage_oldaddress'});
		// Convert the webpage address
		$abits = explode('/',$GLOBALS{'webpage_oldaddress'});
		$newaddress = end($abits);
		$olddirectory = str_replace($newaddress, "", $GLOBALS{'webpage_oldaddress'});

		XPTXT('directory - '.count($abits)." - ".$olddirectory);
		XPTXT('address truncated from '.$GLOBALS{'webpage_oldaddress'}.' to '.$newaddress);
		$GLOBALS{'webpage_address'} = $newaddress;

		// convert any src references in html

		if (strpos($GLOBALS{'webpage_html'}, 'src=') !== false) {
			$sbits = explode('src=',$GLOBALS{'webpage_html'});
			foreach ($sbits as $sbit) {
				$convertablesrcfound = "0";
				if (strpos($sbit, '"') !== false) {
					$sbit2s = explode('"',$sbit);
					if (($olddirectory != "")&&(strpos($sbit2s[1], $olddirectory) !== false)) {
						XHR();
						// ==== modify the html ===========
						$oldhtmlsrcstring = $sbit2s[1];
						$sbit3s = explode('/',$sbit2s[1]);
						$oldfilename = end($sbit3s);
						$convertablesrcfound = "1";
						XPTXT("convertable src  filename found - ".$oldfilename);
						$newfilename = "Webpage"."_".$webpage_name."_".$oldfilename;
						$newhtmlsrcstring = "domain_media/".$newfilename;
						$GLOBALS{'webpage_html'} = str_replace($oldhtmlsrcstring, $newhtmlsrcstring, $GLOBALS{'webpage_html'});
						XPTXT('html modified from '.$oldhtmlsrcstring.' to '.$newhtmlsrcstring);

						// ==== copy the media ===========
						$from = urldecode($GLOBALS{'domainwwwpath'}.'/'.$olddirectory.$oldfilename);
						$to = urldecode($GLOBALS{'domainwwwpath'}."/domain_media/".$newfilename);
						copy($from, $to);
						XPTXT("From ".$from);
						XPTXT("To ".$to);

					} else {
						XPTXT("non-converted src found - ".$sbit2s[1]);
					}
				}
			}
		}
		Write_Data("webpage",$webpage_name);
	}
}


function Setup_PHPUTILITY6_Output () {
	XH3("Special PHP Utility Launcher - 6");

	$coursea = Get_Array("course");

	foreach ($coursea as $courseid) {
		Get_Data("course",$courseid);
		$GLOBALS{'course_attendeestatuslist'} = "";
		XH1($courseid);
		XH1("Attendees ".$GLOBALS{'course_attendeelist'});
		$courseattendeea = List2Array($GLOBALS{'course_attendeelist'});
		foreach ($courseattendeea as $courseattendeeid) {
			// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
			UpdateCourseAttendeeStatus($courseattendeeid,"","","","");
		}
		XH1("Paid Attendees ".$GLOBALS{'course_attendeepaidlist'});
		$courseattendeepaida = List2Array($GLOBALS{'course_attendeepaidlist'});
		foreach ($courseattendeepaida as $courseattendeepaidid) {
			// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
			UpdateCourseAttendeeStatus($courseattendeepaidid,"Card",$GLOBALS{'course_charge'},"Yes","");
		}
		Write_Data("course",$courseid);
	}
}

function Setup_PHPUTILITY7_Output () {
	XH3("Special PHP Utility Launcher - 7");
	foreach (Get_Array_Hash("period") as $xperiodid)  {
		XH2("=================== ".$xperiodid." ===================");
		foreach (Get_Array("section",$xperiodid) as $tsection_name) {
			Get_Data("section",$xperiodid,$tsection_name);
			$teama = List2Array($GLOBALS{'section_teams'});
			foreach ($teama as $teamcode) {
				$frsa = Get_Array('frs',$xperiodid,$teamcode);
				foreach ($frsa as $frsid) {
					Get_Data('frs',$xperiodid,$teamcode,$frsid);
					XHR();
						
					if (strlen(strstr($GLOBALS{'frs_date'},"-"))>0) {
						XPTXT($frsid." - date already converted - ".$GLOBALS{'frs_date'});
					}
					else {
						$olddate = $GLOBALS{'frs_date'};
						$newdate = YYbMMbDDtoYYYYsMMsDD($GLOBALS{'frs_date'});
						$GLOBALS{'frs_date'} = $newdate;
						XPTXT('<span style="color:red"><B>'.$frsid." - date converted - ".$olddate." - ".$newdate.'</B></span>');
					}
					if (($GLOBALS{'frs_time'} == "")||($GLOBALS{'frs_time'} == "TBD")) {
						if ($GLOBALS{'frs_time'} == ""){
							XPTXT($frsid." - time is NULL");
						}
						if ($GLOBALS{'frs_time'} == "TBD"){
							XPTXT($frsid." - time is TBD");
						}
					} else {
						if ((strlen(strstr($GLOBALS{'frs_time'},":"))>0)&&(strlen($GLOBALS{'frs_time'}) == 5)) {
							XPTXT($frsid." - time wellformed - ".$GLOBALS{'frs_time'});
						} else {
							$oldtime = $GLOBALS{'frs_time'};
							$newtime = StandardTime ($oldtime);
							$GLOBALS{'frs_time'} = $newtime;
							XPTXT('<span style="color:red"><B>'.$frsid." - time converted - ".$oldtime." - ".$newtime.'</B></span>');
						}
					}
						
					if (($GLOBALS{'frs_ha'} == "A")&&($GLOBALS{'frs_venue'} != "")) {
						$GLOBALS{'frs_awayvenue'} = $GLOBALS{'frs_venue'};
						XPTXT('<span style="color:red"><B>'.$frsid." - ".$GLOBALS{'frs_ha'}." - ".$GLOBALS{'frs_awayvenue'}." updated".'</B></span>');
						$GLOBALS{'frs_venue'} = "";
					}
					else  {
						XPTXT($frsid." - ".$GLOBALS{'frs_ha'}." - ".$GLOBALS{'frs_venue'}." retained");
						$GLOBALS{'frs_awayvenue'} = "";
					}
						
					Write_Data('frs',$xperiodid,$teamcode,$frsid);
				}
			}
		}
	}
}


function Setup_PHPUTILITY8_Output () {
	XH3("Special PHP Utility Launcher - 8");

	$asseta = Get_Array("asset",$GLOBALS{'LOGIN_domain_id'});
	foreach ($asseta as $asset_code) {
	    Get_Data("asset",$GLOBALS{'LOGIN_domain_id'},$asset_code);
		// Old = YYMMDD  New = YYYY-MM-DD
		if (($GLOBALS{'asset_createdate'} != "")&&(strlen($GLOBALS{'asset_createdate'}) != 10)) {
			$existingasset_createdate = $GLOBALS{'asset_createdate'};
			$aca = str_split($existingasset_createdate);
			if ( count($aca) == 6 ) {
				$GLOBALS{'asset_createdate'} = "20".$aca[0].$aca[1]."-".$aca[2].$aca[3]."-".$aca[4].$aca[5];
			} else {
				$GLOBALS{'asset_createdate'} = "";
			}
			if ( $existingasset_createdate == "      " ) {
				$GLOBALS{'asset_createdate'} = "";
			}
			XPTXT(count($aca).'|'.$existingasset_createdate."| => |".$GLOBALS{'asset_createdate'}.'|');
		}
		if (($GLOBALS{'asset_reviewdate'} != "")&&(strlen($GLOBALS{'asset_reviewdate'}) != 10)) {
			$existingasset_reviewdate = $GLOBALS{'asset_reviewdate'};
			$ara = str_split($existingasset_reviewdate);
			if ( count($ara) == 6 ) {
				$GLOBALS{'asset_reviewdate'} = "20".$ara[0].$ara[1]."-".$ara[2].$ara[3]."-".$ara[4].$ara[5];
			} else {
				$GLOBALS{'asset_reviewdate'} = "";
			}
			if ( $existingasset_reviewdate == "      " ) {
				$GLOBALS{'asset_reviewdate'} = "";
			}
			XPTXT(count($ara).'|'.$existingasset_reviewdate."| => |".$GLOBALS{'asset_reviewdate'}.'|');
		}
		Write_Data("asset",$GLOBALS{'LOGIN_domain_id'},$asset_code);
	}
}

function Setup_PHPUTILITY9_Output () {
	XH3("Special PHP Utility Launcher - 9");
	for ($i = 0; $i < 100; $i++) {
	    $codea = PWFLinkCodeGenerate("bbra");
	    
	    $resetlinkcode = $codea[0]; 
	    $resetcode = $codea[1];
	     $resetlinkcodex = $codea[2];
	    $resetcodex = $codea[3];
	    
	    $recreatedresetlinkcode = XCrypt($resetlinkcodex,"bbra","decrypt");
	    $recreatedresetcode = XCrypt($resetcodex,"bbra","decrypt");

	    $resetlinkcodematch = "No"; $resetcodematch = "No";
	    if ($recreatedresetlinkcode == $resetlinkcode) { $resetlinkcodematch = "Yes"; }
	    if ($outkeycode == $keycode) { $resetcodematch = "Yes"; }
	    XTABLE();
	    XTR();XTDTXT("In");XTDTXT($resetlinkcode);XTDTXT($resetlinkcodex);XTDTXT($resetcode);XTDTXT($resetcodex);X_TR();
	    XTR();XTDTXT("Out");XTDTXT($recreatedresetlinkcode);XTDTXT("");XTDTXT($recreatedresetcode);XTDTXT("");X_TR();
	    XTR();XTDTXT("Status");XTDTXT($resetlinkcodematch);XTDTXT("");XTDTXT($resetcodematch);XTDTXT("");X_TR();	    
	    X_TABLE();
	}
}

function Setup_PHPUTILITYA_Output () {
	XH3("Special PHP Utility Launcher - A");
	
	XH3("Domain");
	Get_Data("domain");
	$GLOBALS{'domain_sportid'} = $GLOBALS{'domain_sportid'};
	Write_Data("domain");
	XPTXT($GLOBALS{'domain_id'}." - updated");

	$perioda = Get_Array_Hash("period");
	foreach ($perioda as $periodid) {
		foreach (Get_Array('section',$periodid) as $tsection ) {
			Get_Data('section',$periodid,$tsection);

			$GLOBALS{'section_teams'} = $GLOBALS{'sectionocz_teams'};
			$GLOBALS{'section_resmgrs'} = $GLOBALS{'sectionocz_resmgrs'};
			$GLOBALS{'section_sportid'} = $GLOBALS{'sectionocz_sportid'};			
			$GLOBALS{'section_frs'} = $GLOBALS{'sectionocz_frs'};
			$GLOBALS{'section_seasonstartdate'} = $GLOBALS{'sectionocz_seasonstartdate'};
			$GLOBALS{'section_seasonenddate'} = $GLOBALS{'sectionocz_seasonenddate'};			
			$GLOBALS{'section_showdateavailability'} = $GLOBALS{'sectionocz_showdateavailability'};		
			
			Write_Data('section',$periodid,$tsection);
			XPTXT($periodid." ".$tsection." - updated");
		}	
	}

	$persona = Get_Array('person');
	foreach ($persona as $tperson_id) {
		Get_Data("person",$tperson_id);
	
		$GLOBALS{'person_cwauthority'} = $GLOBALS{'personcw_authority'};
		$GLOBALS{'person_director'} = $GLOBALS{'personcw_director'};
		$GLOBALS{'person_labourtype'} = $GLOBALS{'personcw_labourtype'};
		$GLOBALS{'person_irissubcode'} = $GLOBALS{'personcw_irissubcode'};

		$GLOBALS{'person_playersquad'} = $GLOBALS{'personocz_playersquad'};
		$GLOBALS{'person_officialsquad'} = $GLOBALS{'personocz_officialsquad'};
		$GLOBALS{'person_position'} = $GLOBALS{'personocz_position'};
		$GLOBALS{'person_activeplayer'} = $GLOBALS{'personocz_activeplayer'};
		$GLOBALS{'person_activeofficial'} = $GLOBALS{'personocz_activeofficial'};
		$GLOBALS{'person_publicprofile'} = $GLOBALS{'personocz_publicprofile'};
		$GLOBALS{'person_sponsor'} = $GLOBALS{'personocz_sponsor'};
		$GLOBALS{'person_sponsorlink'} = $GLOBALS{'personocz_sponsorlink'};
		$GLOBALS{'person_team'} = $GLOBALS{'personocz_team'};
		$GLOBALS{'person_dateavailability'} = $GLOBALS{'personocz_dateavailability'};

		Write_Data("person",$tperson_id);
		XPTXT($tperson_id." - updated");
	}
}

function Setup_PHPUTILITYB_Output () {
	XH3("BPMN2 Documenter");
	XFORM("setupbpmn2documenterin.php","");
	XTABLEINVISIBLE();
	XTR();XTDINTEXTAREA("BPMN2SOURCE","","20","50");X_TR();
	XTR();XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
	
}

function Setup_PHPUTILITYC_Output () {
    XH3("DMWS Complexity");
 
    XH3("Step 1: Create Latest Records");
    $dmwssua = Get_Array('dmwssu');
    foreach ($dmwssua as $dmwssu_id) {
        XPTXT("========".$dmwssu_id."=============================");
        Check_Data('dmwssu',$dmwssu_id);
    
        $thiscomplexityvisitid = "";
        Check_Data('dmwscomplexity',$dmwssu_id,"Latest");
        if ($GLOBALS{'IOWARNING'} == "0") {
            $thiscomplexityvisitid = "Latest";
            XPTXTCOLOR($dmwssu_id." Found Latest","green");
        } else {
            $complexityvisita = Get_Array('dmwscomplexity',$dmwssu_id);
            foreach ($complexityvisita as $complexityvisit_id) {
                Check_Data('dmwscomplexity',$dmwssu_id,$complexityvisit_id);              
                if ( $GLOBALS{'dmwscomplexity_score'} > 0) {
                    $thiscomplexityvisitid = $complexityvisit_id;
                    XPTXT($dmwssu_id." ".$complexityvisit_id." ".$GLOBALS{'dmwscomplexity_score'});
                } else {
                    XPTXT($dmwssu_id." ".$complexityvisit_id." Zero Score");
                    
                }
            }
        }
        if (($thiscomplexityvisitid != "Latest")&&($thiscomplexityvisitid != "")) {
            Get_Data('dmwscomplexity',$dmwssu_id,$thiscomplexityvisitid);
            if ($GLOBALS{'dmwscomplexity_score'} > 0) {
                Write_Data('dmwscomplexity',$dmwssu_id,"Latest");
                XPTXTCOLOR($dmwssu_id." Create Latest From ".$thiscomplexityvisitid." ".$GLOBALS{'dmwscomplexity_score'},"green");
            } else {
                XPTXTCOLOR($dmwssu_id." Cannot Create Latest From ".$thiscomplexityvisitid." ".$GLOBALS{'dmwscomplexity_score'},"red");
            }
        }
    }
    
    XH3("Step 1: Delete Redundant Records");
    $dmwssua = Get_Array('dmwssu');
    foreach ($dmwssua as $dmwssu_id) {
        XPTXT("========".$dmwssu_id."=============================");
        Check_Data('dmwssu',$dmwssu_id);        
        $complexityvisita = Get_Array('dmwscomplexity',$dmwssu_id);
        foreach ($complexityvisita as $complexityvisit_id) {
            if ( $complexityvisit_id != "Latest") {
                Get_Data('dmwscomplexity',$dmwssu_id,$complexityvisit_id);
                Delete_Data('dmwscomplexity',$dmwssu_id,$complexityvisit_id);
                if ($GLOBALS{'dmwscomplexity_score'} > 0) {
                    XPTXTCOLOR($dmwssu_id." ".$complexityvisit_id." Deleted","red");
                } else {
                    XPTXTCOLOR($dmwssu_id." ".$complexityvisit_id." Deleted - Zero Score","red");
                }
            } else {
                XPTXTCOLOR($dmwssu_id." ".$complexityvisit_id." Kept","green");
            }
        }
    }
}

function Setup_PHPUTILITYD_Output () {
    XH3("Webpage - Editor to Composer");
    
    $webpagea = Get_Array("webpage");
    foreach ($webpagea as $webpage_name) {
        Get_Data("webpage",$webpage_name);
        XH2($webpage_name);
        $GLOBALS{'webpage_oldhtml'} = $GLOBALS{'webpage_html'}; // Backup
        if ($GLOBALS{'webpage_templatename'} == "") {
            $GLOBALS{'webpage_templatename'} = "Default";
            XPTXT("Template set to Default");
        }
        if (strlen(strstr($GLOBALS{'webpage_html'},"<!-- FSSTART_"))>0) {            
            XPTXT("Already in Composer Mode");
        } else {
            $prehtml = '<!-- FSSTART_1 -->'."\n";
            $prehtml =  $prehtml.'<span id="fstitle_1" class="fstitle" style="color:navy">Formatted Section - 1 ( Type[TextColumns], Header[No], BackgroundColor[White], Cols[1], PaddingTop[0], PaddingBottom[0] )</span>'."\n";
            $prehtml =  $prehtml.'<!-- /FSSTART -->'."\n";
            $prehtml =  $prehtml.'<!-- Start TextColumns_1 -->'."\n";
            $prehtml =  $prehtml.'<div class="row">'."\n";
            $prehtml =  $prehtml.'<div class="col-md-12">'."\n";
            $prehtml =  $prehtml.'<div class="editabletextarea" style="color: rgb(0, 0, 0);">'."\n";
            
            $posthtml = '</div>'."\n";
            $posthtml = $posthtml.'</div>'."\n";
            $posthtml = $posthtml.'</div>'."\n";
            $posthtml = $posthtml.'<!-- End TextColumns_1 -->'."\n";
            $posthtml = $posthtml.'<!-- FSEND_1 -->'."\n";
            $posthtml = $posthtml.'<!-- /FSEND -->'."\n";
            
            $GLOBALS{'webpage_html'} = $prehtml.$GLOBALS{'webpage_html'}.$posthtml;
            XPTXT("Converted to Composer Mode");
        }
        Write_Data("webpage",$webpage_name);
    }
}

function Setup_PHPUTILITYE_Output () {
    if (($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {        
        XH3("Create ServiceEnabled Table");
        Check_Data("serviceenabled");
        if ($GLOBALS{'IOWARNING'} == "0") {
            XPTXTCOLOR("serviceenabled Table already exists","green");
        } else {           
            Initialise_Data("serviceenabled");
            Write_Data("serviceenabled");
            XPTXTCOLOR("Creation of serviceenabled Table Completed","green");           
        }
    }
}


function Setup_PHPUTILITYF_Output () {

XH1("Speech Recognition Test");
XBR();

print '<img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />';
XBR();
XINTEXTAREAID("transcript","q","","15","100"); 
XPTXT("Output");
XINTEXTAREAID("output","output","","15","100"); 

}

function Setup_PHPUTILITYG_CSSJS () {
    $GLOBALS{'SITEJSOPTIONAL'} = "speechtotext"; 
}

function Setup_PHPUTILITYG_Output () {
    
    XH1("Speech Recognition Test");
    XBR();
    
    XHR();
    BROW();
    BCOL("3");
    BINSUBMITNAMESPECIALICON ("SpeechStart","success","Start","microphone");
    BINSUBMITNAMESPECIALICON ("SpeechStop","danger","Stop","microphone-slash");
    XBR();
    XBR();
    BINTXTID("SpeechIn","SpeechIn","");
    B_COL();
    BCOLTXT("","6");
    BCOL("2");
    BIMGID("synchronise","../site_assets/North.gif","100");
    B_COL();
    B_ROW();
    XHR();
    BROW();
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("GOAL","1","gray","white");
    BCOLTXTCOLOR("LINE","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    B_ROW();
    for ($yi=1; $yi<=11; $yi++) {
        BROW();
        BCOLTXTCOLOR("","1","gray","white");
        for ($xi=1; $xi<=8; $xi++) {
            BCOLTXT("&nbsp;","1");
        }
        BCOLTXTCOLOR("","1","gray","white");
        B_ROW();        
        BROW();
        BCOLTXTCOLOR("","1","gray","white");
        for ($xi=1; $xi<=8; $xi++) {
            BCOLTXT($yi.".".$xi.".xxx","1");
        }
        BCOLTXTCOLOR("","1","gray","white");
        B_ROW();
        BROW();
        BCOLTXTCOLOR("","1","gray","white");
        for ($xi=1; $xi<=8; $xi++) {
            $ys = substr(("0000".(string) $yi), -2);
            $xs = substr(("0000".(string) $xi), -2);
            $gridyxs = $ys."-".$xs;
            BCOLINTXTID($gridyxs,$gridyxs,"","1");
        }
        BCOLTXTCOLOR("","1","gray","white");
        B_ROW();
    }
    BROW();
    BCOLTXTCOLOR("","1","gray","white");
    for ($xi=1; $xi<=8; $xi++) {
        BCOLTXT("&nbsp;","1");
    }
    BCOLTXTCOLOR("","1","gray","white");
    B_ROW();   
    BROW();
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("GOAL","1","gray","white");
    BCOLTXTCOLOR("LINE","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    B_ROW();
}

function Setup_PHPUTILITYH_Output () {
    XH3("Asset Converter");
    $asseta = Get_Array("asset","");
    $assetfound = "0";
    foreach ($asseta as $asset_code) {
        Get_Data("asset","",$asset_code);
        XPTXT($GLOBALS{'asset_title'}."Converted");
        Write_Data("asset",$GLOBALS{'LOGIN_domain_id'},$asset_code);
        Delete_Data("asset","",$asset_code);
        $assetfound = "1";
    }
    if ( $assetfound == "0" ) { XPTXT("No assets found to convert"); }
}

function Setup_PHPUTILITYI_Output () {
    XH3("Accreditation Converter");

    /*
    $nkeya = Get_NKey_Array('accredcriteria');
    foreach ($nkeya as $nkey) {       
        $ka = explode('|',$nkey);
        Get_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        $thisaccredcriteria_id = $ka[2];
        if ($GLOBALS{'accredcriteria_type'} == "section") {
            XPTXT($ka[0]." ".$ka[1]);
        }
        if ($GLOBALS{'accredcriteria_type'} == "evidence") {
            if (strlen(strstr($thisaccredcriteria_id,"e0"))>0) {} else {  // already done              
                if (strlen(strstr($thisaccredcriteria_id,"_a"))>0) {
                    $newaccredcriteria_id = str_replace("_a","_e01",$thisaccredcriteria_id);
                }
                if (strlen(strstr($thisaccredcriteria_id,"_b"))>0) {
                    $newaccredcriteria_id = str_replace("_b","_e02",$thisaccredcriteria_id);
                }
                if (strlen(strstr($thisaccredcriteria_id,"_c"))>0) {
                    $newaccredcriteria_id = str_replace("_c","_e03",$thisaccredcriteria_id);
                }
                if (strlen(strstr($thisaccredcriteria_id,"_e1"))>0) {
                    $newaccredcriteria_id = str_replace("_e1","_e01",$thisaccredcriteria_id);
                }
                
                XPTXTCOLOR($newaccredcriteria_id." <= ".$thisaccredcriteria_id,"orange");
                $lastevidenceaccredcriteria_id = $newaccredcriteria_id;
                Write_Data("accredcriteria",$ka[0],$ka[1],$newaccredcriteria_id);
                Delete_Data("accredcriteria",$ka[0],$ka[1],$thisaccredcriteria_id);
                
                
            }
        }
        if ($GLOBALS{'accredcriteria_type'} == "data") {
            if (strlen(strstr($thisaccredcriteria_id,"e"))>0) {} else {  // already done
                $ibits = explode('_',$thisaccredcriteria_id);
                $istring = end($ibits);
                if (strlen($istring) == 2) {
                    $istring = str_replace("i","i0",$istring);
                }
                $newaccredcriteria_id = $lastevidenceaccredcriteria_id."_".$istring;
                XPTXTCOLOR($newaccredcriteria_id." <= ".$thisaccredcriteria_id,"blue");
                Write_Data("accredcriteria",$ka[0],$ka[1],$newaccredcriteria_id);
                Delete_Data("accredcriteria",$ka[0],$ka[1],$thisaccredcriteria_id);
            }
        }
        
    }
    */
    
    $nkeya = Get_NKey_Array('accredcriteria');
    foreach ($nkeya as $nkey) {       
        $ka = explode('|',$nkey);
        Get_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        
        $thisaccredcriteria_id = $ka[2];
        if ($GLOBALS{'accredcriteria_type'} == "data") {
            XPTXTCOLOR($ka[0]." ".$ka[1]." | ".$GLOBALS{'accredcriteria_dataradioquestions'}." | ".$GLOBALS{'accredcriteria_datatextquestion'},"green");
            if ($GLOBALS{'accredcriteria_dataradioquestions'} != "") {
                $GLOBALS{'accredcriteria_dataquestiontype'} = "Radio";
                XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." updated type = Radio","blue");     
                if ($GLOBALS{'accredcriteria_datatextquestion'} != "") {
                    $GLOBALS{'accredcriteria_datatextquestion'} = "";
                    XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." text reset","red"); 
                } 
            } else {
                if ($GLOBALS{'accredcriteria_datatextquestion'} != "") {
                    $GLOBALS{'accredcriteria_dataquestiontype'} = "Text";
                    XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." updated type = Text","blue");     
                }   
            }
            Write_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        }
        
        if ($GLOBALS{'accredcriteria_ref'} != "") {
            if (substr($thisaccredcriteria_id,0,1) != "S") {
                $GLOBALS{'accredcriteria_ref'} = "S".$GLOBALS{'accredcriteria_ref'};
                XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." Corrected Ref to ".$GLOBALS{'accredcriteria_ref'},"orange"); 
                Write_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
             }
        }
        
        
        
        
        
    }    
    
    
}

function Setup_PHPUTILITYJ_CSSJS () {
}

function Setup_PHPUTILITYJ_Output () {   
    $LF=chr(10);
    $ggla = Array("A","B","C","D","E","F","G","H");
    foreach ($ggla as $ggl) {
        XH1($ggl);
        $ida = Get_Array("accredcriteria","FAGroundGrading".$ggl,"sfm");
        foreach ($ida as $accredcriteria_id) {
            Get_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
            if ($GLOBALS{"accredcriteria_type"} == "criteria") {	
                $ca = str_split($GLOBALS{"accredcriteria_criteria"});
                XHR();
                XPTXT(Replace_CRandLF($GLOBALS{'accredcriteria_criteria'},"<br>"));
                XHR();
                $outca = "";
                $prevcac = ".";
                foreach ($ca as $cac) {
                    if ($cac == $LF) {
                        if ($prevcac == ".") { $outca = $outca.$LF.$LF;  }
                        else {$outca = $outca." ";}
                    } else {
                        $outca = $outca.$cac;
                    }
                    $prevcac = $cac;
                }
                $GLOBALS{"accredcriteria_criteria"} = $outca;
                XPTXTCOLOR(Replace_CRandLF($GLOBALS{"accredcriteria_criteria"},"<br>"),"navy");
                Write_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
            }                  
        }
    }
}

function Setup_SQLMAINTAIN_Output1 () {
	XH3("SQL Database Maintenance");
	XPTXT("This action will re-apply the latest SQL structure to the site.");
	XBR();
	XFORM("setupsqlmaintainout.php","");
	XH5("Decide whether to preview the results before finalising.");
	XTABLEINVISIBLE();
	XTR();XTDINRADIO("TestorReal","T","checked","Test Mode - view proposed updates");X_TR();
	XTR();XTDINRADIO("TestorReal","R","","Real Mode - make updates permanent");X_TR();
	XTR();XTDTXT("&nbsp;");X_TR();
	XTR();XTD();XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");X_TD();X_TR();
	XTR();XTDTXT("&nbsp;");X_TR();
	XTR();XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
}

function Setup_SQLMAINTAIN_Output2 ($testorreal,$extendedtrace) {
	if ($testorreal == "T") { $tortext = "Test Mode"; }
	if ($testorreal == "R") { $tortext = "Real Mode"; }
	XH3("SQL Database Maintenance - ".$tortext);
	# print "SQL_Maintain Called<br>\n";
	#     0     1                         2                     3     4    5    6     7      8        9
	# datatype seq structureheader/structurefield/structureend Field Type Null Key Default Extra OldField
	$existingsql = array(); $existingtables = array();
	$tobesql = array(); $tobetables = array();
	
	$b50 = "                                                  ";
	$sqlupdatesmade = "0";
	# Get tobe SQL tables info
	#                       0                        1       2    3    4    5     6      7      8     9
	# structureheader/structurefield/structureend datatype Field Type Null Key Default Extra OldField s1 s2 etc
	$fullfilename = "../site_sql/sqldesign.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	// XH3("SQL Database Maintenance - ".$fullfilename." size - ".sizeof($records));
	foreach ($records as $recordelement) {
		$upmessage = CSV_In_Filter($recordelement);
		// XPTXT($upmessage);
		# end of the tidy up
		$uploadcsv = explode("|",$upmessage);
		$forthisservice = "0";
	
		if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
		else { $serviceid = $GLOBALS{'LOGIN_service_id'}; }
		for ($idb = 9; $idb < 21; $idb++) { 
			if ( $uploadcsv[$idb] == $serviceid ) { $forthisservice = "1"; }
		}
		$tablearrayelement50 = substr($uploadcsv[1].$b50,0,50);
		$field50 = substr($uploadcsv[2].$b50,0,50);
		$controlfield50 = substr($uploadcsv[8].$b50,0,50);
		if ($forthisservice == "1") {
			if ($uploadcsv[0] == "structureheader") {
	   			$seq = 0;
	   			$tsqlstring = $tablearrayelement50."|0000|structureheader||||||||";
	   			array_push($tobesql, $tsqlstring); $seq++;
	   			array_push($tobetables, $uploadcsv[1]);
			}
			if ($uploadcsv[0] == "structurefield") {
				$tsqlstring = $tablearrayelement50."|1".substr("000".$seq,-3,3)."|structurefield|".$field50."|".$uploadcsv[3]."|".$uploadcsv[4]."|".$uploadcsv[5]."|".$uploadcsv[6]."|".$uploadcsv[7]."|".$controlfield50;
				array_push($tobesql, $tsqlstring); $seq++;
	
			}
			if ($uploadcsv[0] == "structureend") {
				$tsqlstring = $tablearrayelement50."|2000|structureend||||||||";
				array_push($tobesql, $tsqlstring); $seq++;
			}
		}
	}
	
	sort ($tobesql);
	// foreach ($tobesql as $recordelement) { print"<P>TOBESQL $recordelement|\n"; }
	# Get existing SQL tables info
	$tablearray = array();
	$q = 'SHOW TABLES';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tablearray, $row[0]); }
	}
	foreach ($tablearray as $tablearrayelement) {
		$tablearrayelement50 = substr($tablearrayelement.$b50,0,50);
		$seq = 0;
		$tsqlstring = $tablearrayelement50."|0000|structureheader||||||||";
		array_push($existingsql, $tsqlstring); $seq++;
		array_push($existingtables, $tablearrayelement);
		$colarray = array();
		$q = 'SHOW COLUMNS FROM '.$tablearrayelement;
		$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	 	# Field Type Null Key Default Extra
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				$field50 = substr($row[0].$b50,0,50);
				$tsqlstring = $tablearrayelement50."|1".substr("000".$seq,-3,3)."|structurefield|".$field50."|".$row[1]."|".$row[2]."|".$row[3]."|".$row[4]."|".$row[5]."|";
				array_push($existingsql, $tsqlstring); $seq++;
			}
		}
		$tsqlstring = $tablearrayelement50."|2000|structureend||||||||";
		array_push($existingsql, $tsqlstring); $seq++;
	}
	sort ($existingsql);
	# foreach ($existingsql as $recordelement) { print"<P>EXISTINGSQL $recordelement|\n"; }
	#     0     1                         2                     3     4    5    6     7      8        9
	# datatype seq structureheader/structurefield/structureend Field Type Null Key Default Extra ADD/CHANGE
	$tmaxi = sizeof($tobesql)-1; 
	$emaxi = sizeof($existingsql)-1;
	
	foreach ($existingtables as $existingtable) {
		if (in_array($existingtable, $tobetables)) {} else {
		    // XPTXTCOLOR('Existing Table "'.$existingtable.'" is now redundant and has been deleted.',"orange");
		    TORSQLCMD ($testorreal,"DROP TABLE ".$existingtable.";");
		    $sqlupdatesmade = "1";
		    $newexistingsql = Array();
		    foreach ($existingsql as $tsqlstring) {
		        $eka = explode ("|",$tsqlstring);
		        $edatatype = str_replace(" ", "", $eka[0]);
		        if ( $edatatype != $existingtable ) { array_push($newexistingsql, $tsqlstring); }
		        // else {XPTXTCOLOR('Dropped Line "'.$existingtable,"orange");}
		    }
		    $existingsql = $newexistingsql;
		}
	}
	
	# print "<BR>TOMAXI ".$tmaxi;
	$more = "1"; $ti = 0;$ei = 0;
	$oldtfield = "";
	$counter = 0;
	$updatetablepka = array();
	while (($more == "1")&&($counter <= 10000)) {
		$counter++;
		# print "<BR>TOBESQL ".$tmaxi." ".$ti." ".$tobesql[$ti];
		$tka = explode ("|",$tobesql[$ti]);
		$tk = $tka[0]." ".$tka[2]." ".$tka[3];
		$tdatatype = str_replace(" ", "", $tka[0]);
		$tfield = str_replace(" ", "", $tka[3]);
		$eka = explode ("|",$existingsql[$ei]);
		$ek = $eka[0]." ".$eka[2]." ".$eka[3];
		$edatatype = str_replace(" ", "", $eka[0]);
		$efield = str_replace(" ", "", $eka[3]);
		$controlfield = str_replace(" ", "", $tka[9]);
	 	# if ($controlfield == "") {$controlfield = "ADD";} 
		if ( $extendedtrace == "Yes" ) { print "<hr>TRACE - KEY MATCH  -----"."   TK= ".$tk." ".$controlfield."   EK= ".$ek."\n"; }   
	    if ($tk == $ek) {  
			# simple update to existing field characteristics ===========================================
	        if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - SIMPLE UPDATE TO EXISTING FIELD\n"; }   
			$temps=$eka[4]; 
			if (strlen(strstr($temps,"varchar"))>0) {
				$eka[4]=str_replace("varchar","char",$temps);
			}
		    $temps=$eka[5]; if (($eka[2]=="structurefield")&&($temps == "")) { $eka[5]="NO"; }
		    if ( $extendedtrace == "Yes" ) { print "<br>..TRACE - NO CHANGE - ".$tka[0]." ".$tka[1]." ".$tka[2]." ".$tka[3]." ".$tka[4]." ".$tka[5]." ".$tka[6]." ".$tka[7]." ".$tka[8]." ".""; }
			if ($tka[4].$tka[5].$tka[6].$tka[7].$tka[8] != $eka[4].$eka[5].$eka[6].$eka[7].$eka[8]) {
				XBR();
				XTXT($tobesql[$ti]." - Target");XBR();
				XTXT($existingsql[$ei]." - Existing");XBR();
		   		XTXT($tka[4].$tka[5].$tka[6].$tka[7].$tka[8]." - Target");XBR();  
				XTXT($eka[4].$eka[5].$eka[6].$eka[7].$eka[8]." - Existing");XBR();
				if ($tka[5] == "NO") { $nullfield = "NOT NULL"; } else { $nullfield = ""; }
				TORSQLCMD ($testorreal,"ALTER TABLE ".$tdatatype." MODIFY COLUMN ".$tfield. " ".$tka[4]." ".$nullfield." ;");$sqlupdatesmade = "1";
				if ($tka[6] == "PRI") {
					if (in_array($tdatatype, $updatetablepka)) { } else { array_push($updatetablepka, $tdatatype); }
				}
			}
			$oldtfield = $tfield;
			$ti++;$ei++;
		} else {
		    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - DATATYPE MATCH  -----"."   TD= ".$tdatatype." "."   ED= ".$edatatype."\n"; }    
  			if ($tdatatype == $edatatype) {
  			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - SAME DATATYPE ".$controlfield."\n"; }
	   			if ($controlfield != "") {
	   			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - ADD/CHANGE\n"; }
					if ($controlfield == "ADD") {
						# add field in existing table
						XBR();
						if ($tka[5] == "NO") { $nullfield = "NOT NULL"; } else {$nullfield = ""; }
						TORSQLCMD ($testorreal,"ALTER TABLE ".$tdatatype." ADD COLUMN ".$tfield." ".$tka[4]." ".$nullfield." AFTER ".$oldtfield.";");$sqlupdatesmade = "1";
						if ($tka[6] == "PRI") {
							if (in_array($tdatatype, $updatetablepka)) { } else { array_push($updatetablepka, $tdatatype); }
						}
						$oldtfield = $tfield;
						$ti++;
					} else { # field name change in existing table
						XBR();
						TORSQLCMD ($testorreal,"ALTER TABLE ".$tdatatype." CHANGE ".$controlfield." ".$tfield. " ".$tka[4].";");$sqlupdatesmade = "1";
		     			$oldtfield = $tfield;        
						$ti++;$ei++;
		    		} 	
				}
	   			else { # delete field in existing table
	   			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - DELETE\n"; }
					XBR();
					TORSQLCMD ($testorreal,"ALTER TABLE ".$edatatype." DROP COLUMN ".$efield.";");$sqlupdatesmade = "1";
					if ($eka[5] == "NO") {
	     				if (in_array($tdatatype, $updatetablepka)) { } else { array_push($updatetablepka, $tdatatype); }
					}
					$ei++;
				}
			}
			if ($tdatatype != $edatatype) {		
			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - DIFFERENT DATATYPE ".$controlfield."\n"; }
				if ($tdatatype > $edatatype) {
					XH2("Should never happen - ".$edatatype);		
				}
				if ($tdatatype < $edatatype) {				
					# add new table ===========================================
					if ($tka[2] == "structureheader") {
					    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - CREATE TABLE (Start) ".$controlfield."\n"; }      	
						$createstring = "CREATE TABLE ".$tdatatype." (";
		    			$primarykeystring = ""; $pksep = "";	
		   			}   	
					if ($tka[2] == "structurefield") {
					    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE -   ".$controlfield."\n"; }
			    		if ($tka[5] == "NO") { $nullfield = "NOT NULL"; } else {$nullfield = ""; }
			    		$createstring .= $tfield." ".$tka[4]." ".$nullfield." ".$tka[8].",";
						if ($tka[6] == "PRI") {
							$primarykeystring = $primarykeystring.$pksep.$tfield;
							$pksep = ",";
						}								
					}
				}
				if ($tka[2] == "structureend") {
				    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - CREATE TABLE (End) ".$controlfield."\n"; }
					$createstring .= "PRIMARY KEY (".$primarykeystring."));";
		    		XBR(); 
					TORSQLCMD ($testorreal,$createstring); $sqlupdatesmade = "1";$sqlupdatesmade = "1";
				}
				$oldtfield = $tfield;
				$ti++;
  			}   	    
		}
		if ($ti == $tmaxi) { $more = "0"; }
	}
	if (empty($updatetablepka)) { } else {XH5("Primary Key Maintenance Required"); }
	foreach ($updatetablepka as $updatetablepk) {
 		$primarykeystring = ""; $pksep = "";	
		$q = 'SHOW COLUMNS FROM '.$updatetablepk;
		$r = mysqli_query($GLOBALS{'IOSQL'},$q);
 		# Field Type Null Key Default Extr
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[2] == "NO") {
					$primarykeystring = $primarykeystring.$pksep.$row[0]; $pksep = ",";
				}
			}
		}
		TORSQLCMD ($testorreal,"ALTER TABLE ".$updatetablepk." DROP PRIMARY KEY;");
 		TORSQLCMD ($testorreal,"ALTER TABLE ".$updatetablepk." ADD PRIMARY KEY (".$primarykeystring.");"); 
	}
	if ($sqlupdatesmade != "1") {
		XH5("No Changes Required");
	}
}

function TORSQLCMD ($testorreal,$query) {
	if ($testorreal == "T") {
		XPTXTCOLOR($query,"green");
	}
	if ($testorreal == "R") {
	    XPTXTCOLOR($query,"green");IOSQLCMD($query);
	}
}

function Setup_SQLBACKUP_Output () {
   XH3("Manual Backup");
   Backup_Domain ();
   XPTXTCOLOR("Backup Successfully Created","green");
}

function Setup_SQLDUMPRECOVER_Output1 () {
    XH3("Recover Data from SQL Backup");
    XPTXT("This tool reads an SQL backup and generates a csv file that can be reimported into the site.");
    XPTXT("It is useful when partial recovery of information is required.");
    $helplink = "Setup/Setup_UPLOAD_Output/setup_upload_output.html"; Help_Link;
    XFORMUPLOAD("setupsqlbackuprecoverin.php","sqlbackuprecover");
    XINSTDHID();
    XPTXT("SQL Backup (in gz or sql format):-");
    XINFILE("file","10000000") ;XBR();XBR();
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
}

function Setup_FRSPERSONSTATTYPES_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_FRSPERSONSTATTYPES_Output() {
	$parm0 = "Match Stat Types - ".$GLOBALS{'currperiodid'}."|frspersonstattype[rootkey=".$GLOBALS{'currperiodid'}."]|section[rootkey=".$GLOBALS{'currperiodid'}."]|frspersonstattype_code|frspersonstattype_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."frspersonstattype_code|Yes|Id|60|Yes|Match Stat Id|KeyText,2,2^";
	$parm1 = $parm1."frspersonstattype_title|No||60|Yes|Header Title|InputText,30,60^";
	$parm1 = $parm1."frspersonstattype_name|Yes|Description|200|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."frspersonstattype_values|No||60|Yes|Code Values|InputSelectFromList,Numeric+Checkbox^";
	$parm1 = $parm1."frspersonstattype_msdisplay|Yes|Display|60|Yes|Display on Match Stats|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."frspersonstattype_mscount|Yes|Max|60|Yes|Match Stats Display Max|InputText,2,2^";
	$parm1 = $parm1."frspersonstattype_mrdisplay|No||60|Yes|Display on Match Results|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."frspersonstattype_playoff|No||60|Yes|Player/Official|InputSelectFromList,P+O^";
	$parm1 = $parm1."frspersonstattype_sectionlist|Yes|Section|150|Yes|Section|InputCheckboxFromTable,section,section_name,section_name,section_seq^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_EMAIL_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_EMAIL_Output() {
	$parm0 = "EMail Style|emailstyle||emailstyle_name|emailstyle_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."emailstyle_name|Yes|Name|60|Yes|Name|KeyText,25,25^";
	$parm1 = $parm1."emailstyle_fontface|No||60|Yes|Font Face|InputSelectFromList,Arial+Times New Roman^";
	$parm1 = $parm1."emailstyle_fontsize|No||60|Yes|Font Size|InputSelectFromList,8px+10px+12px+14px+16px^";
	$parm1 = $parm1."emailstyle_fontcolor|No||60|Yes|Font Colour|InputSelectFromList,Black+Blue+Gray+Navy^";
	$parm1 = $parm1."emailstyle_hfontface|No||60|Yes|Header Font Face|InputSelectFromList,Arial+Times New Roman^";
	$parm1 = $parm1."emailstyle_hfontsize|No||60|Yes|Header Font Size|InputSelectFromList,8px+10px+12px+14px+16px+18px+20px+22px^";
	$parm1 = $parm1."emailstyle_hfontcolor|No||60|Yes|Header Font Colour|InputSelectFromList,Black+Blue+Gray+Navy^";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {
		$bannerurlbase = "GLOBALSITEWWWURL";
	} else { $bannerurlbase = "GLOBALDOMAINWWWURL";
	}
	$bannerurldir = $bannerurlbase."/domain_style";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {
		$bannerfilebase = "GLOBALSITEWWWPATH";
	} else { $bannerfilebase = "GLOBALDOMAINWWWPATH";
	}
	$bannerfiledir = $bannerfilebase."/domain_style";
	$parm1 = $parm1."emailstyle_headerimage|No||60|Yes|Header Image - 500x50|InputImage,$bannerurldir,$bannerfiledir,500,50,EmailHeaderImage,emailstyle_headerimage^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Setup_LIBRARYSECTION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jquerynestable";
    $GLOBALS{'SITEJSOPTIONAL'} = "jquerynestable,jqueryconfirm,globalroutines,librarysectionupdate";
    $GLOBALS{'SITEPOPUPHTML'} = "LibrarySection_Popup";
}

function Setup_LIBRARYSECTION_Output() {
    
    $librarysectiona = Get_Array("librarysection");
    $librarysectiontemparray = Array();
    foreach ( $librarysectiona as $librarysection_id ) {
        Get_Data("librarysection",$librarysection_id);
        $liblevela = explode('/',$GLOBALS{'librarysection_sequence'});
        $liblevel = count($liblevela);
        $arrayelement = $GLOBALS{'librarysection_sequence'}."#".$librarysection_id."#".$liblevel;
        array_push($librarysectiontemparray, $arrayelement);
    }
    sort ($librarysectiontemparray);
    
    XH2('Library Structure');
    XPTXT("Drag and Drop the folder items until you get the structure you require.");
    XHRCLASS("underline");
    $oldlibrarysection_level = 0;
    $nid = 0;
    XNESTCONTAINER();
    foreach ($librarysectiontemparray as $arrayelement) {
        // print("========= ".$arrayelement."<br>");
        $mibit3s = explode("#",$arrayelement);
        $librarysection_id = $mibit3s[1];
        $librarysection_level = intval($mibit3s[2]);
        Get_Data("librarysection",$librarysection_id);
        
        if (($librarysection_level - $oldlibrarysection_level) > 0) {
            // Open First in new list
            XNESTOL();
            $nid++;
            XNESTLIBSECTIONLI($nid,$GLOBALS{'librarysection_id'},$GLOBALS{'librarysection_title'},$GLOBALS{'librarysection_hide'},$GLOBALS{'librarysection_security'});
            XNESTLIBSECTIONITEM($nid,$GLOBALS{'librarysection_title'});
        }
        if (($librarysection_level - $oldlibrarysection_level) == 0) {
            // Continue list
            X_NESTLI();
            $nid++;
            XNESTLIBSECTIONLI($nid,$GLOBALS{'librarysection_id'},$GLOBALS{'librarysection_title'},$GLOBALS{'librarysection_hide'},$GLOBALS{'librarysection_security'});
            XNESTLIBSECTIONITEM($nid,$GLOBALS{'librarysection_title'});
        }
        if (($librarysection_level - $oldlibrarysection_level) < 0) {
            // End Old list and Open First in new list
            X_NESTLI();
            X_NESTOL();
            X_NESTLI();
            $nid++;
            XNESTLIBSECTIONLI($nid,$GLOBALS{'librarysection_id'},$GLOBALS{'librarysection_title'},$GLOBALS{'librarysection_hide'},$GLOBALS{'librarysection_security'});
            XNESTLIBSECTIONITEM($nid,$GLOBALS{'librarysection_title'});
        }
        $oldlibrarysection_level = $librarysection_level;
    }
    // End nestings
    X_NESTLI();
    X_NESTOL();
    X_NESTCONTAINER ();
    XBR();
    XINBUTTONIDSPECIAL ("librarysection-add","success","Add New Library Folder.");
    XBR();
    XFORM("librarysectionupdatein.php","librarysectionupdatein");
    XINSTDHID();
    XHRCLASS("underline");
    XBR();
    // print '<textarea class="form-control" id="json_outputview" rows="5"></textarea>'."\n";
    XINHIDID("json_output","json_output","");
    XBR();
    XINSUBMIT ("Update Library Structure");
    X_FORM();
}

function LibrarySection_Popup () {
    XDIVPOPUP("librarysectionpopup","Menu Item");
    XINHIDID("nid","nid","");
    XINHIDID("LibrarySectionId","LibrarySectionId","");
    XDIV("LibrarySectionTitleDiv","librarysectiontitlediv");
    XH3("Title");
    XINTXTID("LibrarySectionTitle","LibrarySectionTitle","","25","50");
    X_DIV("LibrarySectionTitleDiv");
    XDIV("LibrarySectionEditorDiv","librarysectioneditordiv");
    XH3("Display");
    XINSELECTHASH (List2Hash("Display,Hide"),"LibrarySectionHide","");
    X_DIV("LibrarySectionHideDiv");
    XDIV("LibrarySectionSecurityDiv","librarysectionsecuritydiv");
    XH3("Visibility");
    $listk = "0,1,2,3";
    $listv = "Public,Internal only,Committee only,Personal or Welfare Only";
    XINSELECTHASH (Lists2Hash($listk,$listv),"LibrarySectionSecurity","");
    X_DIV("LibrarySectionSecurityDiv");
    XBR();
    XINBUTTONIDSPECIAL("librarysectionupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("librarysectioncancelbutton","warning","Cancel");
    XBR();
    X_DIV("librarysectionpopup");
}

function Setup_ACCREDSCHEME_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ACCREDSCHEME_Output() {
    $parm0 = "";
    $parm0 = $parm0."Accreditation Schemes|"; # pagetitle
    $parm0 = $parm0."accredscheme|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."accredscheme_id|"; # keyfieldname
    $parm0 = $parm0."accredscheme_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."accredscheme_id|Yes|Id|60|Yes|Id|KeyText,15,25-^";
    $parm1 = $parm1."accredscheme_name|Yes|Name|60|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."accredscheme_version|Yes|Version|60|Yes|Version|InputText,5,10^";
    $parm1 = $parm1."accredscheme_shortname|Yes||20|Yes|Shortname|InputText,4,4^";
    $parm1 = $parm1."accredscheme_type|Yes|Type|60|Yes|Type|InputSelectFromList,Normal+Grading^";   
    $parm1 = $parm1."accredscheme_ranking|Yes|Ranking|60|Yes|Ranking|InputText,5,10^";    
    $parm1 = $parm1."accredscheme_authority|Yes|Authority|60|Yes|Authority|InputText,30,60^";
    $parm1 = $parm1."accredscheme_weblink||||Yes|Webpage|InputText,50,100^";
    $parm1 = $parm1."accredscheme_logolink||||Yes|Logo|InputText,50,100^";
    $parm1 = $parm1."accredscheme_active|Yes|Active|60|Yes|Active|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."|No|||Yes|Accreditation Options|Divider^";
    $parm1 = $parm1."accredscheme_ownerenabled||||Yes|Owner Enabled|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."accredscheme_reviewenabled||||Yes|Review Enabled|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."accredscheme_inspectionenabled||||Yes|Inspection Enabled|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."accredscheme_clubconditionenabled||||Yes|Condition Enabled|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."accredscheme_helpenabled||||Yes|Help Links Enabled|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."accredscheme_templatesenabled||||Yes|Templates Enabled|InputCheckboxFromList,Yes^"; 
    $parm1 = $parm1."|No|||Yes|Development Plan Options|Divider^";
    $parm1 = $parm1."accredscheme_costtextreqd||||Yes|Cost Text|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_costvaluereqd||||Yes|Cost Value|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_fundingapproachreqd||||Yes|Funding Approach Text|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_fundingvalueselfreqd||||Yes|Sellf Funding Value|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_fundingvaluegrantreqd||||Yes|Grant Funding Value|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_fundingvaluesponsorreqd||||Yes|Sponsor Funding Value|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_achievementindicatorsreqd||||Yes|Achievement Indicators|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_dateraisedreqd||||Yes|Date Raised|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_duedatereqd||||Yes|Date Due|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_timescalereqd||||Yes|Timescale - Free Text|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_actioneesreqd||||Yes|Actionees - Free Text|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_personidreqd||||Yes|Actionee Person Id|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_responsereqd||||Yes|Response|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."accredscheme_statusreqd||||Yes|Status|InputCheckboxFromList,Yes^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
    $parm1 = $parm1."generic_programbutton1|Yes|View Criteria|80|No|View Criteria|ProgramButton,accredcriteriaviewout.php,accredscheme_id,accredscheme_id,samewindow,,^";
    $parm1 = $parm1."generic_programbutton2|Yes|Setup Criteria|80|No|Update Criteria|ProgramButton,accredcriteriasetupout.php,accredscheme_id,accredscheme_id,samewindow,,^";
    $parm1 = $parm1."generic_programbutton3|Yes|New Setup|80|No|New Setup|ProgramButton,accredschemecomposerout.php,accredscheme_id,accredscheme_id,samewindow,,^";
    //$parm1 = $parm1."generic_programbutton3|Yes|Delete All Criteria|80|No|Delete All Criteria|ProgramButton,accredcriteriadeleteallconfirm.php,accredscheme_id,accredscheme_id,samewindow,,^";
    $parm1 = $parm1."generic_programbutton4|Yes|Setup Development Plans|80|No|Setup Devt Plans|ProgramButton,accredactionsectionsetupout.php,accredscheme_id,accredscheme_id,samewindow,,^";
    $parm1 = $parm1."generic_programbutton5|Yes|View Development Plans|80|No|View Devt Plans|ProgramButton,accredactionlistout.php,accredscheme_id,accredscheme_id,samewindow,,"; 
    GenericHandler_Output ($parm0,$parm1);
}
function Setup_ACCREDSCHEMECRITERIA_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ACCREDSCHEMECRITERIA_Output($schemeid) {
    $parm0 = "";
    $parm0 = $parm0."Accreditation Criteria - ".$schemeid."|"; # pagetitle
    $parm0 = $parm0."accredcriteria[rootkey=".$schemeid."+".$GLOBALS{'LOGIN_domain_id'}."]|"; # primetable (using domainid as clubid)
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."accredcriteria_id|"; # keyfieldname
    $parm0 = $parm0."accredcriteria_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."accredcriteria_id|Yes|Sequence|50|Yes|Sequence|KeyText,18,18^";
    $parm1 = $parm1."accredcriteria_ref|Yes|Ref|50|Yes|ref|InputText,30,60^";
    $parm1 = $parm1."accredcriteria_type|Yes|Type|70|Yes|Type|InputSelectFromList,section+criteria+evidence+data^";
    $parm1 = $parm1."|No|||Yes|section|Divider^";
    $parm1 = $parm1."accredcriteria_section|Yes|Section|100|Yes|Section|InputText,30,60^";
    $parm1 = $parm1."|No|||Yes|criteria|Divider^";
    $parm1 = $parm1."accredcriteria_criteria|Yes|Criteria|250|Yes|Criteria|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_subcriteria||||Yes|Sub-Criteria|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_help||||Yes|Help|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_templates||||Yes|Templates|InputTextArea,5,80^";         
    $parm1 = $parm1."|No|||Yes|evidence requirements|Divider^";
    $parm1 = $parm1."accredcriteria_evidencerequirement|Yes|Evidence Reqmt|250|Yes|Evidence Requirement|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_evidenceassetcodesreqd|Yes|Docs Reqd|70|Yes|Documents Required|InputSelectFromList,Yes+Optional+No^";
    $parm1 = $parm1."accredcriteria_evidenceimagelistreqd|Yes|Imgs Reqd|70|Yes|Images Required|InputSelectFromList,Yes+Optional+No^";
    $parm1 = $parm1."|No|||Yes|data collection requirements|Divider^";
    $parm1 = $parm1."accredcriteria_datafieldname||||Yes|Data: Field Name|InputText,30,100^";
    $parm1 = $parm1."accredcriteria_datafieldtitle|Yes|Data|50|Yes|Data: Field Title|InputText,30,100^";
    $parm1 = $parm1."accredcriteria_dataquestionTYPE||||Yes|Data Question Type|InputSelectFromList,Text+Radio+Checkbox^";
    $parm1 = $parm1."accredcriteria_datatextquestion||||Yes|Data: Text Question|InputText,30,100^";   
    $parm1 = $parm1."accredcriteria_dataradioquestions||||Yes|Data: Radio Questions<br>Q1val=Q1Text,Q2val=Q2text|InputText,80,100^";
    $parm1 = $parm1."accredcriteria_datacheckboxquestions||||Yes|Data: Checkbox Questions<br>Q1val=Q1Text,Q2val=Q2text|InputText,80,100^";
    $parm1 = $parm1."accredcriteria_datatargetreqd|Yes|Target|70|Yes|Required Data Value|InputText,30,100^";  
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_ACCREDACTIONSECTION_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ACCREDACTIONSECTION_Output($schemeid) {
    $parm0 = "";
    $parm0 = $parm0."Development Plan Sections - ".$schemeid."|"; # pagetitle
    $parm0 = $parm0."accredactionsection[rootkey=".$schemeid."]|"; # primetable (using domainid as clubid)
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."accredactionsection_id|"; # keyfieldname
    $parm0 = $parm0."accredactionsection_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";  
    $parm1 = $parm1."accredactionsection_id|Yes|Section|50|Yes|Section|KeyText,25,25^";
    $parm1 = $parm1."accredactionsection_title|Yes|Title|50|Yes|Title|InputText,40,60^";
    $parm1 = $parm1."accredactionsection_seq|Yes|Seq|50|Yes|Seq|InputText,5,10^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Setup_ACCREDCRITERIADELETEALLCONFIRM_Output ($taccredscheme_id) {
    XH3('Delete All Accreditation Criteria - "'.$taccredscheme_id.'"');
    XPTXT("Are you sure you want to delete all criteria for this scheme");
    XBR();
    XFORM("accredcriteriadeleteallaction.php","deleteallcriteria");
    XINSTDHID();
    XINHID("accredscheme_id",$taccredscheme_id);
    XINSUBMIT("Confirm Deletion of Scheme Criteria");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}


function Setup_ACCREDSCHEMECOMPOSER_CSSJS(){
    /*$GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jquerynestable";
    $GLOBALS{'SITEJSOPTIONAL'} = "jquerynestable,jqueryconfirm,accredschemecomposer";
    $GLOBALS{'SITEPOPUPHTML'} = "WebPageMenuItem_Popup";*/
}


function Setup_ACCREDSCHEMECOMPOSER_Output ($inaccredscheme_id) {
    $club_id = $GLOBALS{'LOGIN_domain_id'};
    
    // Note: this works for a 1 or 2 level structure
    $accredcriteriaa = Get_Array('accredcriteria',$inaccredscheme_id,$club_id);
    // ===== select relevant menu items =============    
    $accreditemtemparray = Array();
    foreach ($accredcriteriaa as $accredcriteria_id) {
        $accredlevela = explode('_',$accredcriteria_id);
        $accreditem_level = count($accredlevela)-1;
        $arrayelement = $accredcriteria_id."#".$accreditem_level;
        array_push($accreditemtemparray, $arrayelement);
    }
    XH2('Update Menu');
    XPTXT("Drag and Drop the menu items until you get the structure you require. ".$inaccredscheme_id);
    XHRCLASS("underline");
    $oldcriteriaitem_level = 0;
    $nid = 0;
    
    XNESTCONTAINER();
    foreach ($accreditemtemparray as $arrayelement) {
        // print("========= ".$arrayelement."<br>");
        $mibit3s = explode("#",$arrayelement);
        $criteriaitem_id = $mibit3s[0];
        $criteriaitem_level = intval($mibit3s[1]);
        Get_Data("accredcriteria",$inaccredscheme_id,$club_id,$criteriaitem_id);
        $type = $GLOBALS{'accredcriteria_type'};
        
        if (($criteriaitem_level - $oldcriteriaitem_level) > 0) {
            $leveldifference = $criteriaitem_level - $oldcriteriaitem_level;
            if($criteriaitem_level == 4){
                XNESTOL();
                XLI("","");
                $nid++;
                XNESTDATAITEM ($nid,$GLOBALS{'accredcriteria_datafieldtitle'},$GLOBALS{'accredcriteria_dataquestiontype'});               
                XNESTDATALI ($nid,$GLOBALS{'accredcriteria_datafieldname'},$GLOBALS{'accredcriteria_datafieldtitle'},$GLOBALS{'accredcriteria_dataquestiontype'},$GLOBALS{'accredcriteria_datatextquestion'},$GLOBALS{'accredcriteria_dataradioquestions'},$GLOBALS{'accredcriteria_datacheckboxquestions'},$GLOBALS{'accredcriteria_datatargetreqd_input'}); 
                X_LI();
            }                 
            else if ($criteriaitem_level == 4) {
                X_NESTLI();
                $nid++;
                XNESTDATAITEM ($nid,$GLOBALS{'accredcriteria_datafieldtitle'},$GLOBALS{'accredcriteria_dataquestiontype'});
                //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
            }
            elseif ($criteriaitem_level == 3) {
                X_NESTLI();
                $nid++;
                XNESTEVIDENCEITEM ($nid,$GLOBALS{'accredcriteria_evidencerequirement'});
                //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
            }
            elseif ($criteriaitem_level == 2) {
                    X_NESTLI();
                    $nid++;
                    XNESTCRITERIAITEM ($nid,$GLOBALS{'accredcriteria_section'},$GLOBALS{'accredcriteria_criteria'});
                    //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                    //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
                    }
            elseif ($criteriaitem_level == 1) {
                X_NESTLI();
                $nid++;
                XNESTSECTIONITEM ($nid,$GLOBALS{'accredcriteria_section'},$GLOBALS{'accredcriteria_criteria'});
                //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
            }
            else{
                // Open First in new list
                XNESTOL();
                $nid++;
                XH1($type);
                //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
            }
        }
        if (($criteriaitem_level - $oldcriteriaitem_level) == 0) {
            if ($criteriaitem_level == 4) {
                X_NESTLI();
                $nid++;
                XNESTDATAITEM ($nid,$GLOBALS{'accredcriteria_datafieldtitle'},$GLOBALS{'accredcriteria_dataquestiontype'});
                //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
            }
            else{
            // Continue list
            XLI("","");
            $nid++;
            XH1($type);
            X_LI();
            //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
            //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
            }
        }
        if (($criteriaitem_level - $oldcriteriaitem_level) < 0) {
            $leveldifference = $oldcriteriaitem_level - $criteriaitem_level;           
                // End Old list and Open First in new list
                for ($i=0;$i<$leveldifference;$i++){
                    X_NESTOL();
                }
                if ($criteriaitem_level == 1) {
                    X_NESTLI();
                    $nid++;
                    XNESTSECTIONITEM ($nid,$GLOBALS{'accredcriteria_section'},$GLOBALS{'accredcriteria_criteria'});
                    //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                    //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
                } 
                elseif ($criteriaitem_level == 2) {
                    X_NESTLI();
                    $nid++;
                    XNESTCRITERIAITEM ($nid,$GLOBALS{'accredcriteria_section'},$GLOBALS{'accredcriteria_criteria'});
                    //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                    //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
                }
                elseif ($criteriaitem_level == 3) {
                    X_NESTLI();
                    $nid++;
                    XNESTEVIDENCEITEM ($nid,$GLOBALS{'accredcriteria_evidencerequirement'});
                    //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                    //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
                }
                else{
                    X_NESTLI();
                    $nid++;
                    XH1($type);
                    //XNESTMENULI($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'},$GLOBALS{'menuitem_webpagename'},$GLOBALS{'menuitem_url'},$GLOBALS{'menuitem_hide'});
                    //XNESTMENUITEM($nid,$GLOBALS{'menuitem_text'},$GLOBALS{'menuitem_targettype'});
                }
            
        }
        $oldcriteriaitem_level = $criteriaitem_level;
    }
    // End nestings
    X_NESTLI();
    X_NESTOL();
    X_NESTCONTAINER ();
    XBR();
    XINBUTTONIDSPECIAL ("menu-add","success","Add New Menu Item.");
    XBR();
    /*
    XFORM("webpagemenuitemupdatein.php","webpagemenuitemupdatein");
    XINSTDHID();
    XINHID("menu_id",$menu_id);
    XHRCLASS("underline");
    XBR();
    // print '<textarea class="form-control" id="json_outputview" rows="5"></textarea>'."\n";
    XINHIDID("json_output","json_output","");
    XBR();
    XINCHECKBOXYESNO("publish","Yes","Publish this menu after update");
    XBR();XBR();
    XINSUBMIT ("Update Menu");
    X_FORM();
    */
    
}

function Setup_DOWNLOAD_Output() {
	XH3("Data Download");
	$helplink = "Setup/Setup_DOWNLOAD_Output/setup_download_output.html"; Help_Link;
	XFORM("setupdownloadin.php","download");
	XINSTDHID();
	XPTXT("The download file will be in CSV format<BR><BR>");
	XTABLE();
	XTR();
	XTDTXT("All Data");
	XTD();XINCHECKBOX("DownSelect[]","sel-all-","","All Data");X_TD();
	X_TR();XTR();
	XTDTXT("Selected Data");
	XTD();
	$tablearray = array();
	$q = 'SHOW TABLES';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	if (mysqli_num_rows($r) > 0) { 
	 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
	  array_push($tablearray, $row[0]); 
	 }
	}
	foreach ($tablearray as $tablearrayelement) {
		XINCHECKBOX("DownSelect[]","sel-".$tablearrayelement."-","",$tablearrayelement."<BR>");
	}
	X_TD();
	X_TR();
	X_TABLE();
	XBR();
	XINSUBMIT("Download File!");
	X_FORM();
}

function Setup_PERSONDOWNLOAD_Output() {
	XH3("People Details Download");
	$helplink = "Setup/Setup_DOWNLOAD_Output/setup_download_output.html"; Help_Link;
	XFORM("setupdownloadin.php","download");
	XINSTDHID();
	XINHID("DownSelectSpecific","sel-person-");	
	XPTXT("The download file will be in CSV format<BR><BR>");
	XINSUBMIT("Download File!");
	X_FORM();
}

function Setup_FRSDOWNLOAD_Output() {
	XH3("Fixtures Details Download");
	$helplink = "Setup/Setup_DOWNLOAD_Output/setup_download_output.html"; Help_Link;
	XFORM("setupdownloadin.php","download");
	XINSTDHID();
	XINHID("DownSelectSpecific","sel-frs-");
	XPTXT("The download file will be in CSV format<BR><BR>");
	XINSUBMIT("Download File!");
	X_FORM();
}

function Setup_UPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Setup_UPLOAD_Output() {
	
	XH3("Data Upload");
	$helplink = "Setup/Setup_UPLOAD_Output/setup_upload_output.html"; Help_Link;
	XFORMUPLOAD("setupuploadin.php","upload");
	XINSTDHID();
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XPTXT("File Containing Data:-");
	XINFILE("file","10000000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");
	XINHID("FirstOrConfirm","First");
	XBR();XBR();
	XINSUBMIT("Upload!");
	X_FORM();
}

function Setup_TITLES_Output() {
	XH3("Club Titles Update");
	$helplink = "Setup/Setup_TITLES_Output/setup_titles_output.html"; Help_Link;
	XFORM("setuptitlesin.php","setuptitles");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Description");XTDHTXT("Value");X_TR();
	XTR();
	XTDTXT("Club Long Name");
	XTDINTXT("AccountLongName",$GLOBALS{'domain_longname'},"40","40");
	X_TR();	
	XTR();
	XTDTXT("Club Short Name - Used for Mobile site<BR> - max 12 characters");
	XTDINTXT("AccountShortName",$GLOBALS{'domain_shortname'},"12","12");
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Setup_PERIOD_Output() {
	XH3("Current Season Update");
	$helplink = "Setup/Setup_SEASON_Output/setup_season_output.html"; Help_Link;
	XFORM("setupperiodin.php","setupperiod1");
	XINSTDHID();
	XBR();
	XH4("Option 1. Select the current season from one of the existing seasons.");
	XTXT("This will become the default for all section, team and fixtures presentation.<BR><BR>");
	XTABLE();
	XTR();XTDHTXT("Available Seasons");XTDHTXT("Current Season");X_TR();
	XTR();
	$periodidsa = Get_Array_Hash("period");
	foreach ($periodidsa as $xperiodid) {	
		XTR();XTDTXT($xperiodid);
		if ($xperiodid == $GLOBALS{'currperiodid'}) {
			$ch = "checked";
		}
		else {$ch = "";
		}
		XTDINRADIO("CurrPeriod",$xperiodid,$ch,"");
		X_TR();
	}
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XFORM("setupperiodin.php","setupperiod2");
	XINSTDHID();
	XBR();
	XH4("Option 2. Delete information from an old season to make more space available.");
	XTXT("Caution: if you delete a season it will delete all fixtures, sections and teams for that season as well. You will be asked to confirm this action.<BR><BR>");
	XTABLE();
	XTR();XTDHTXT("Available Seasons");XTDHTXT("Delete Season");X_TR();
	XTR();
	$periodidsa = Get_Array_Hash("period");
	foreach ($periodidsa as $xperiodid) {	
		XTR();XTDTXT($xperiodid);
		XTDINRADIO("DeletePeriod",$xperiodid,"","");
		X_TR();
	}
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	XH4("Option 3. Create a new season - including section, teams and fixtures information.");
	XTXT("Subsection and team information will be initialised from current season.<BR><BR>");
	XFORM("setupperiodin.php","setupperiod3");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Description");XTDHTXT("New Value");X_TR();
	XTR();
	XTDTXT("<B>New Season</B><BR>Recommended format is <B>2009</B> or <B>2009-2010</B>");
	XTDINTXT("NewPeriod","","9","9");
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XBR();XBR();
}

function Setup_PERIOD_Delete_Check($deleteperiodid) {
	XH3("Delete old information for season - ".$deleteperiodid);
	$helplink = "Setup/Setup_SEASON_Output/setup_team_output.html"; Help_Link;
	XH5("This will delete the $indeleteperiodid season and all section, team and fixture information - please confirm");
	XFORM("setupperioddeletein.php","setupperioddelete");
	XINSTDHID();
	XINHID("DeletePeriod",$deleteperiodid);
	XBR();XINSUBMIT("Confirm Delete");
	X_FORM();
	XBR();XBR();	
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS;
	$link = $link.YPGMPARM("SelectId","PERIOD");
	XLINKTXT($link,"Return to Season List");
}


function Setup_ORG_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Setup_ORG_Output() {
	XH3("Organisation");
	$helplink = "Setup/Setup_ORG_Output/setup_sections_output.html"; Help_Link;
	XFORM("setuporgin.php","setuporg");
	XINSTDHID();
	$sortstructure = Array();
	$tglobalsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
	$orga = Get_Array('org');
	$formseq = 0;
	foreach ($orga as $org_code) {	
		$formseq++;
		Get_Data("org",$org_code);
		$section_seq = "";
		for ($si = 0; $si <= sizeof($tglobalsectionsarray); $si++) {
			if ($GLOBALS{'org_section'} == $tglobalsectionsarray[$si]){
				$section_seq = $si;
			}
		}
		$tseq1 = $GLOBALS{'org_sequence'}."0000";
		$tseq2 = substr($tseq1, 0, 4);
		$tsortstring = $section_seq."#".$GLOBALS{'org_section'}."#".$tseq2."#".$org_code;
		array_push($sortstructure, $tsortstring);
	}
	sort($sortstructure);
	$formseq = 0;
	foreach ($sortstructure as $tsortstring) {		
		$formseq++;
		$obits = explode ('#', $tsortstring);
		XINHID("OrgCode$formseq",$obits[3]);
	}
	XTABLE();
	XTR();
	XTDHTXT("Add<BR>Change<BR>Delete");
	XTDHTXT("Title");
	XTDHTXT("Personal Id");
	XTDHTXT("Section");
	XTDHTXT("Visible<BR>on Contacts<BR>List");
	XTDHTXT("Sequence<BR>within<BR>section<BR>list");
	X_TR();
	sort($sortstructure);
	$formseq = 0;
	$personselectfields = ""; $psep = "";
	foreach ($sortstructure as $tsortstring) {
		$formseq++;
		$obits = explode ('#', $tsortstring);
		$newsection = $obits[1];
		if ($newsection != $oldsection){
			XTR();XTDHTXT("");XTDHTXT("$newsection");XTDHTXT(""); XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
		}
		$oldsection = $newsection;
		$GLOBALS{'org_code'} = $obits[3];
		// $GLOBALS{'org_code'} =~ s/\.txt//;
		Get_Data("org",$GLOBALS{'org_code'});
		XTR();
		XTDINSELECTHASH(List2Hash("C,D"),"ACD".$formseq,"");
		XTDINTXT("OrgTitle".$formseq,$GLOBALS{'org_title'},"30","60");
		XTDINPERSONID ("OrgPersonId".$formseq,"OrgPersonId".$formseq,$GLOBALS{'org_personid'},"6","12");
		// $parm2 = Buttons Id  field,To,To..,ToPersonIdList,ToPersonNameList,70|field,Cc,CC..,CcDistList,CcPersonList,70		
		$fieldstring = "field".","."OrgPersonId".$formseq."_lookupbutton".",".$GLOBALS{'org_title'}.","."OrgPersonId".$formseq.","."OrgPersonId".$formseq."_personlist".",150";
		$personselectfields = $personselectfields.$psep.$fieldstring;$psep = "|";
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XTDINSELECTHASH($xhash,"OrgSection".$formseq,$GLOBALS{'org_section'});
		XTDINSELECTHASH(List2Hash("Yes,No"),"OrgContactVisible".$formseq,$GLOBALS{'org_contactvisible'});		
		XTDINTXT("OrgSequence$formseq",$GLOBALS{'org_sequence'},"4","4");
		X_TR();
	}
	XTR();XTDHTXT("");XTDHTXT("add new roles");XTDHTXT(""); XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
	$addseq = 0;
	while ($addseq != 4) {
		$addseq++;
		$formseq++;
		XTR();
		XTDINSELECTHASH(List2Hash("A"),"ACD".$formseq,"");
		XTDINTXT("OrgTitle".$formseq,"","30","60");
		XTDINPERSONID ("OrgPersonId".$formseq,"OrgPersonId".$formseq,"","6","12");	
		$fieldstring = "field".","."OrgPersonId".$formseq."_lookupbutton".","."New Role".","."OrgPersonId".$formseq.","."OrgPersonId".$formseq."_personlist".",150";
		$personselectfields = $personselectfields.$psep.$fieldstring;$psep = "|";			
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XTDINSELECTHASH($xhash,"OrgSection".$formseq,"");
		XTDINSELECTHASH(List2Hash("Yes,No"),"OrgContactVisible".$formseq,"");		
		XTDINTXT("OrgSequence$formseq","","4","4");
		X_TR();
	}
	X_TABLE();
	XBR();XTDINSUBMIT("Enter");	
	X_FORM();

	$p0 = "this,person_id|person_sname|person_fname|person_section";
	$p1 = "person_id,Id,50|person_sname,SurName,100|person_fname,FirstName,100|person_section,Section,100";
	$p2 = $personselectfields;
	$p3 = "person_id";
	$p4 = "active";
	$p5 = "person_change,center,center,900,900";
	$p6 = "view";
	$p7 = "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);	
}

function Setup_ORGDETAIL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Setup_ORGDETAIL_Output () {
    XH3("Organisation");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ORGDETAIL");
    
    XLINKBUTTONRIGHT($link,"Refresh List to see Updates");	
    XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Seq");
    XTDHTXT("Section");
    XTDHTXT("Org");
    XTDHTXT("");
    XTDHTXT("Title");
    XTDHTXT("Name");
    XTDHTXT("Job Role Type");
    XTDHTXT("Roles");
    XTDHTXT("Report");
    XTDHTXT("Job Role Type");
    XTDHTXT("Qualification");
    
    X_TR();
    X_THEAD();
    XTBODY();
    $GLOBALS{"reportseq"} = 0;
    $sortstructure = Array();
    $tglobalsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
    $orga = Get_Array('org');
    foreach ( $orga as $org_code ) {
        Get_Data("org",$org_code);
        $section_seq = "";
        for ($si = 0; $si <= sizeof($tglobalsectionsarray); $si++) {
            if ($GLOBALS{'org_section'} == $tglobalsectionsarray[$si]){$section_seq = $si;}
        }
        $tseq1 = $GLOBALS{'org_sequence'}."0000";
        $tseq2 = substr($tseq1, 0, 4);
        $tsortstring = $section_seq."#".$GLOBALS{'org_section'}."#".$tseq2."#".$org_code;
        array_push($sortstructure, $tsortstring);
    }
    sort($sortstructure);
    foreach ( $tglobalsectionsarray as $section_name ) {
        Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
        if ($GLOBALS{'section_archive'} != "Yes") {
            $GLOBALS{"reportseq"}++;
            XTRJQDT();
            XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR ('<b>'.$GLOBALS{'section_name'}." Section".'</b>',"#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            $link = YPGMLINK("personloginselectin.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","ORG");
            XTDBACKTXTCOLOR ("#dddddd","#2F79B9");
            XLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
            X_TD();
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            X_TR();
            
            $rolepersonarray = Array();
            foreach ( $sortstructure as $tsortstring ) {
                $obits = explode ('#', $tsortstring);
                $torg_section = $obits[1];
                $org_code = $obits[3];
                Get_Data("org",$org_code);
                if ($torg_section == $section_name) {
                    $GLOBALS{"reportseq"}++;
                    XTRJQDT();
                    XTDTXTCOLOR($GLOBALS{"reportseq"},"#cccccc");
                    XTDTXTCOLOR($GLOBALS{'section_name'},"#cccccc");
                    XTDTXTCOLOR("Org","#cccccc");
                    XTDTXTCOLOR("Org","#cccccc");
                    XTDTXT($GLOBALS{'org_title'});
                    Check_Data("person",$GLOBALS{'org_personid'});
                    if ($GLOBALS{'IOWARNING'} == "0" ) { XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); }
                    else { XTDTXT($GLOBALS{'org_personid'}); }
                    XTDTXT("");
                    XTDTXT(""); 
                    $link = YPGMLINK("personqualificationreportout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("ReportParm",$GLOBALS{'org_personid'});;
                    XTDLINKTXTNEWPOPUP($link,"Report","view","center","center","800","800");
                    $link = YPGMLINK("personjobroleout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$GLOBALS{'org_personid'});;
                    XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
                    $link = YPGMLINK("personqualificationout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$GLOBALS{'org_personid'});;
                    XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
                    X_TR();
                }
            }
            $tteamarray = explode(',', $GLOBALS{'section_teams'});
            foreach ( $tteamarray as $team_code ) {
                Check_Data("team",$GLOBALS{'currperiodid'},$team_code);
                if ($GLOBALS{'IOWARNING'} == "0" ) {
                    XTRJQDT();
                    XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR('<b>'.$GLOBALS{'section_name'}.'</b>',"#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR('<b>'."Team".'</b>',"#eeeeee","#2F79B9");
                    XTDTXTBACKTXTCOLOR('<b>'.$GLOBALS{'team_name'}.'</b>',"#eeeeee","#2F79B9");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    $link = YPGMLINK("frsSETUPTEAMpopupout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$team_code);;
                    XTDBACKTXTCOLOR ("#eeeeee","#2F79B9");
                    XLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
                    X_TD();
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    X_TR();
                    OutPersonRows ($GLOBALS{'team_mgr'},"Team",$team_code,$GLOBALS{'team_name'},"Team Manager","Team Manager");
                    OutPersonRows ($GLOBALS{'team_captain'},"Team",$team_code,$GLOBALS{'team_name'},"Team Captain","Team Captain");
                    OutPersonRows ($GLOBALS{'team_coach'},"Team",$team_code,$GLOBALS{'team_name'},"Team Coach","Team Coach");
                    OutPersonRows ($GLOBALS{'team_resmgrs'},"Team",$team_code,$GLOBALS{'team_resmgrs'},"ResMgrs","ResMgrs");
                    OutPersonRows ($GLOBALS{'team_helpers'},"Team",$team_code,$GLOBALS{'team_helpers'},"Helpers","Helpers");
                }
            }
        }
    }
    
    $GLOBALS{"reportseq"}++;
    XTRJQDT();
    XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR ('<b>Groups</b>',"#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    X_TR();
    
    foreach (Get_Array_Hash_SortSelect("sectiongroup",$GLOBALS{'currperiodid'},"sectiongroup_name","","") as $sectiongroup_code) {
        Check_Data("sectiongroup",$GLOBALS{'currperiodid'},$sectiongroup_code);
        if ($GLOBALS{'IOWARNING'} == "0" ) {
            XTRJQDT();
            XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR('',"#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR('<b>'."Group".'</b>',"#eeeeee","#2F79B9");
            XTDTXTBACKTXTCOLOR('<b>'.$GLOBALS{'sectiongroup_name'}.'</b>',"#eeeeee","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            $link = YPGMLINK("personSETUPGROUPpopupout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$sectiongroup_code);;
            XTDBACKTXTCOLOR ("#eeeeee","#2F79B9");
            XLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
            X_TD();
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            X_TR();
            OutPersonRows ($GLOBALS{'sectiongroup_mgr'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_name'},"Group Manager","Group Manager");
            OutPersonRows ($GLOBALS{'sectiongroup_coach'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_coach'},"Group Coach","Group Coach");
            OutPersonRows ($GLOBALS{'sectiongroup_personmgrs'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_personmgrs'},"Admin","Admin");
            OutPersonRows ($GLOBALS{'sectiongroup_helpers'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_helpers'},"Helpers","Helpers");
        }
    };
    
    
    
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
    XINHID("list_sortcol",0);
}


function OutPersonRows ($personlist,$orgsectiontype,$orgsectioncode,$orgsectiontitle,$roletitle,$jobroletype) {
    $persona = List2Array($personlist);
    foreach ( $persona as $personid ) {
        Check_Data("person",$personid);
        if ($GLOBALS{'IOWARNING'} == "0" ) { $nametext = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
        else { $nametext = "Person Not Found"; }
        $GLOBALS{"reportseq"}++;
        XTRJQDT();
        XTDTXTCOLOR($GLOBALS{"reportseq"},"#cccccc");
        XTDTXTCOLOR($GLOBALS{'section_name'},"#cccccc");
        XTDTXTCOLOR($orgsectiontype,"#cccccc");
        XTDTXTCOLOR($orgsectiontitle,"#cccccc");
        XTDTXT($roletitle);
        XTDTXT($nametext);
        XTDTXT($roletype);
        XTDTXT("");
        $link = YPGMLINK("personqualificationreportout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("ReportParm",$personid);;
        XTDLINKTXTNEWPOPUP($link,"Report","view","center","center","800","800");    
        $link = YPGMLINK("personjobroleout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$personid);;
        XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");       
        $link = YPGMLINK("personqualificationout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$personid);;
        XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
        X_TR();
        
    }
}

function Setup_KBSECTION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jquerynestable";
    $GLOBALS{'SITEJSOPTIONAL'} = "jquerynestable,jqueryconfirm,globalroutines,kbsectionupdate";
    $GLOBALS{'SITEPOPUPHTML'} = "KBSection_Popup";
}

function Setup_KBSECTION_Output() {
    
    $kbsectiona = Get_Array("kbsection");
    $kbsectiontemparray = Array();
    foreach ( $kbsectiona as $kbsection_id ) {
        Get_Data("kbsection",$kbsection_id);
        $kblevela = explode('/',$GLOBALS{'kbsection_sequence'});
        $kblevel = count($kblevela);
        $arrayelement = $GLOBALS{'kbsection_sequence'}."#".$kbsection_id."#".$kblevel;
        array_push($kbsectiontemparray, $arrayelement);
    }
    sort ($kbsectiontemparray);
    
    XH2('KnowledgeBase Structure');
    XPTXT("Drag and Drop the folder items until you get the structure you require.");
    XHRCLASS("underline");
    $oldkbsection_level = 0;
    $found = "0";
    $nid = 0;
    XNESTCONTAINER();
    foreach ($kbsectiontemparray as $arrayelement) {       
        $found = "1";
        $mibit3s = explode("#",$arrayelement);
        $kbsection_id = $mibit3s[1];
        $kbsection_level = intval($mibit3s[2]);
        Get_Data("kbsection",$kbsection_id);
        // print("========= ".$arrayelement." ".$kbsection_level." ".$oldkbsection_level."<br>");
        
        if (($kbsection_level - $oldkbsection_level) > 0) {
            // Open First in new list
            XNESTOL();
            $nid++;
            XNESTKBSECTIONLI($nid,$GLOBALS{'kbsection_id'},$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
            XNESTKBSECTIONITEM($nid,$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
        }
        if (($kbsection_level - $oldkbsection_level) == 0) {
            // Continue list
            X_NESTLI();
            $nid++;
            XNESTKBSECTIONLI($nid,$GLOBALS{'kbsection_id'},$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
            XNESTKBSECTIONITEM($nid,$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
        }
        if (($kbsection_level - $oldkbsection_level) < 0) {
            // End Old list and Open First in new list
            X_NESTLI();
            X_NESTOL();
            X_NESTLI();
            $nid++;
            XNESTKBSECTIONLI($nid,$GLOBALS{'kbsection_id'},$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_ref'});
            XNESTKBSECTIONITEM($nid,$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
        }
        $oldkbsection_level = $kbsection_level;
    }
    // End nestings
    if ( $found == "1" ) {
        X_NESTLI();
        X_NESTOL();
    } else {
        XNESTOL();
        $nid++;
        XNESTKBSECTIONLI($nid,$GLOBALS{'currenttimestamp'},"Title goes here","HelpSection","","");
        XNESTKBSECTIONITEM($nid,"Title goes here","HelpSection","");
        X_NESTLI();
    }
    X_NESTCONTAINER ();
    XBR();
    XINBUTTONIDSPECIAL ("kbsection-add","success","Add New Knowledgebase Section.");
    XBR();
    XFORM("kbsectionupdatein.php","kbsectionupdatein","");
    XINSTDHID();
    XHRCLASS("underline");
    XBR();
    // print '<textarea class="form-control" id="json_outputview" rows="5"></textarea>'."\n";
    XINHIDID("json_output","json_output","");
    XBR();
    XINSUBMIT ("Update Knowledgebase Structure");
    X_FORM();
}

function KBSection_Popup () {
    XDIVPOPUP("kbsectionpopup","KnowledgeBase Section");
    XINHIDID("nid","nid","");
    XINHIDID("KBSectionId","KBSectionId","");
    XDIV("KBSectionTitleDiv","kbsectiontitlediv");
    XH3("Title");
    XINTXTID("KBSectionTitle","KBSectionTitle","","25","50");
    X_DIV("KBSectionTitleDiv");
    XDIV("KBSectionTypeDiv","kbsectiontypediv");
    XH3("Help Section or Item");
    XINSELECTHASH (List2Hash("HelpSection,HelpItem"),"KBSectionType","HelpItem");
    X_DIV("KBSectionTypeDiv");
    XDIV("KBSectionRefDiv","kbsectionrefdiv");
    XH3('Reference - eg "Introduction" (no spaces) ');
    XINTXTID("KBSectionRef","KBSectionRef","","25","50");
    X_DIV("KBSectionRefDiv");
    XBR();
    XINBUTTONIDSPECIAL("kbsectionupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("kbsectioncancelbutton","warning","Cancel");
    XBR();
    X_DIV("kbsectionpopup");
}

/*
function Setup_PROBLEMLOGCLIENT_Output($clubid) {
    $parm0 = "";
    $parm0 = $parm0."Problem Log - ".clubid."|"; # pagetitle
    $parm0 = $parm0."problem|"; # primetable (using domainid as clubid)
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."problem_id|"; # keyfieldname
    $parm0 = $parm0."problrm_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";  
    $parm1 = $parm1."problem_id|Yes|Section|50|Yes|Section|KeyText,25,25^";
    $parm1 = $parm1."problem_title|Yes|Title|50|Yes|Title|InputText,40,60^";
    $parm1 = $parm1."problem_description|No|Description|60|Yes|Description|InputTextArea,3,40^";    
    $parm1 = $parm1."problem_priority|Yes|Priority|60|Yes|Priority|InputSelectFromList,1[Critical]+2[High]+3[Medium]+4[Low]^"; 



    
    
    
problem_priority
problem_clubid
problem_raisedbypersonid
problem_raiseddate
problem_assignedtopersonid
problem_status
problem_fixdescription
problem_fixdate    
    
    
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

*/




?>
=======
<?php # setuproutines.inc

function Setup_SITE_Output() {
	$parm0 = "Site Settings|site[site=unique]||site_serviceid|site_serviceid|25|NoAdd";
	$parm1 = "";
	$parm1 = $parm1."site_serviceid|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
	$parm1 = $parm1."site_wwwurl|Yes|www URL|150|Yes|www URL|InputText,30,60^";
	$parm1 = $parm1."site_wwwindexpage|index page|Description|200|Yes|index page|InputText,20,60^";
	$parm1 = $parm1."site_server|Yes|Server|80|Yes|Server|InputText,10,60^";
	$parm1 = $parm1."site_protocol|Yes|Protocol|70|Yes|Protocol|InputSelectFromList,http+https^";
	$parm1 = $parm1."site_perlurl||||Yes|perl URL|InputText,30,60^";
	$parm1 = $parm1."site_phpurl||||Yes|php URL|InputText,30,60^";
	$parm1 = $parm1."site_jsurl||||Yes|js URL|InputText,30,60^";
	$parm1 = $parm1."site_cssurl||||Yes|css URL|InputText,30,60^";
	$parm1 = $parm1."site_yuiurl||||Yes|yui URL|InputText,30,60^";
	$parm1 = $parm1."site_asseturl||||Yes|site_asset URL|InputText,30,60^";
	$parm1 = $parm1."site_tinymceurl||||Yes|tinymce URL|InputText,30,60^";
	$parm1 = $parm1."site_templateurl||||Yes|template URL|InputText,30,60^";	
	$parm1 = $parm1."site_studiourl||||Yes|studio URL|InputText,30,60^";	
	$parm1 = $parm1."site_filepath||||Yes|filepath|InputText,30,60^";
	$parm1 = $parm1."site_wwwpath||||Yes|wwwpath|InputText,30,60^";	
	$parm1 = $parm1."site_modeid||||Yes|Mode|InputText,1,1^";	
	$parm1 = $parm1."site_extradirectory||||Yes|Extra Directory|InputText,20,60^";	
	$parm1 = $parm1."site_codeversion||||Yes|Code Version|InputText,5,5^";	
	$parm1 = $parm1."site_systemdate||||Yes|Syatem Date (SYSTEM or YYYYMMDD)|InputText,8,8^";	
	$parm1 = $parm1."site_simulation||||Yes|Simulation ON/OFF|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."site_testdata||||Yes|Test Data ON/OFF|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."site_readonly||||Yes|Read Only ON/OFF|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."site_mailsendmethod||||Yes|Mail Send Method|InputSelectFromList,Basic+PHPMailer+PostMark^";			
	$parm1 = $parm1."site_mailssmtppassword||||Yes|SMTP Password(PHPMailer)|InputText,30,60^";	
	$parm1 = $parm1."site_mailserviceurl||||Yes|Service URL(PostMark)|InputText,30,60^";	
	$parm1 = $parm1."site_mailservicetoken||||Yes|Service Token(PostMark)|InputText,30,60^";	
	$parm1 = $parm1."site_defaultemailaddress||||Yes|Default Mail Address|InputText,30,60^";	
	$parm1 = $parm1."site_smsserviceurl||||Yes|SMS Service URL|InputText,30,60^";
	$parm1 = $parm1."site_smsserviceusername||||Yes|SMS Service Username|InputText,30,60^";
	$parm1 = $parm1."site_smsservicepassword||||Yes|SMS Service Password|InputText,20,60^";
	$parm1 = $parm1."site_registrationmethod||||Yes|Registration Method|InputSelectFromList,Key+NoKey^";
	$parm1 = $parm1."site_registrationkey||||Yes|Registration Key|InputText,20,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_PACKAGE_Output() {
    $parm0 = "Site Packages|package[site=unique]||package_id|package_id|25|Add";
    $parm1 = "";
    $parm1 = $parm1."package_id|Yes|Package id|80|Yes|Package Id|KeyText,15,30^";
    $parm1 = $parm1."package_name|Yes|Package Name|100|Yes|Package Name|InputText,30,60^";
    // $parm1 = $parm1."package_mode||||Yes|Package Mode|InputText,30,60^";
    $parm1 = $parm1."package_webpagemax||||Yes|Max Webpages|InputText,3,3^";
    $parm1 = $parm1."package_peoplemax||||Yes|Max People|InputText,3,3^";
    $parm1 = $parm1."package_teamsmax||||Yes|Max Teams|InputText,3,3^";
    // $parm1 = $parm1."package_mobile||||Yes|site_asset URL|InputText,3,3^";
    $parm1 = $parm1."package_emailbundled||||Yes|Max Emails|InputText,3,3^";
    $parm1 = $parm1."package_smsbundled||||Yes|Max SMS|InputText,3,3^";
    $parm1 = $parm1."package_bookingsmax||||Yes|Max Bookings|InputText,3,3^";
    $parm1 = $parm1."package_advertsmax||||Yes|Max Adverts|InputText,3,3^";
    $parm1 = $parm1."package_setupprice||||Yes|Setup Price|InputText,7,7^";
    $parm1 = $parm1."package_mthlyprice||||Yes|Monthly Price|InputText,7,7^";
    $parm1 = $parm1."package_servicebar|Yes|Service Bar|60|Yes|Service Bar|InputText,1,1^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_SERVICE_Output() {
    $parm0 = "Service|service[site=unique]||service_id|service_id|25|NoAdd";
    $parm1 = "";
    $parm1 = $parm1."service_id|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
    $parm1 = $parm1."service_people||||Yes|People|InputText,3,5^";
    $parm1 = $parm1."service_personexdirectory||||Yes|Person Ex Dir|InputText,3,5^";
    $parm1 = $parm1."service_personextrafields||||Yes|Person Extra Fields|InputText,3,5^";
    $parm1 = $parm1."service_personmembership||||Yes|Person Membership|InputText,3,5^";
    $parm1 = $parm1."service_personsafeguarding||||Yes|Person Safeguarding|InputText,3,5^";
    $parm1 = $parm1."service_personethnicity||||Yes|Person Ethnicity|InputText,3,5^";
    $parm1 = $parm1."service_persondisability||||Yes|Person Disability|InputText,3,5^";
    $parm1 = $parm1."service_personmedical||||Yes|Person Medical|InputText,3,5^";
    $parm1 = $parm1."service_jobroles||||Yes|Jobroles|InputText,3,5^";
    $parm1 = $parm1."service_qualifications||||Yes|Qualifications|InputText,3,5^";
    $parm1 = $parm1."service_org||||Yes|Organisation|InputText,3,5^";
    $parm1 = $parm1."service_webpages||||Yes|Webpages|InputText,3,5^";
    $parm1 = $parm1."service_mobilepages||||Yes|Mobile Pages|InputText,3,5^";
    $parm1 = $parm1."service_advertising||||Yes|Advertising|InputText,3,5^";
    $parm1 = $parm1."service_email||||Yes|Email|InputText,3,5^";
    $parm1 = $parm1."service_sms||||Yes|SMS|InputText,3,5^";
    $parm1 = $parm1."service_library||||Yes|Library|InputText,3,5^";
    $parm1 = $parm1."service_accreditation||||Yes|Acccreditation|InputText,3,5^";
    $parm1 = $parm1."service_newsletters||||Yes|Newsletters|InputText,3,5^";
    $parm1 = $parm1."service_articles||||Yes|Articles|InputText,3,5^";
    $parm1 = $parm1."service_events||||Yes|Events|InputText,3,5^";
    $parm1 = $parm1."service_actions||||Yes|Actions|InputText,3,5^";
    $parm1 = $parm1."service_bookings||||Yes|Bookings|InputText,3,5^";
    $parm1 = $parm1."service_courses||||Yes|Courses|InputText,3,5^";
    $parm1 = $parm1."service_draws||||Yes|Draws|InputText,3,5^";
    $parm1 = $parm1."service_shop||||Yes|Shop|InputText,3,5^";
    $parm1 = $parm1."service_sections||||Sections|People|InputText,3,5^";
    $parm1 = $parm1."service_frs||||Yes|Fixtures Results and Selection|InputText,3,5^";
    $parm1 = $parm1."service_fin||||Yes|Financial Management|InputText,3,5^";
    $parm1 = $parm1."service_process||||Yes|Process|InputText,3,5^";
    $parm1 = $parm1."service_auction||||Yes|Auction|InputText,3,5^";
    $parm1 = $parm1."service_pos||||Yes|Point of Sale|InputText,3,5^";
    $parm1 = $parm1."service_cor||||Yes|Cordage|InputText,3,5^";
    $parm1 = $parm1."service_reporting||||Yes|Reporting|InputText,3,5^";
    $parm1 = $parm1."service_dmws||||Yes|DMWS|InputText,3,5^";
    $parm1 = $parm1."service_grl||||Yes|League|InputText,3,5^";
    $parm1 = $parm1."service_care||||Yes|Care|InputText,3,5^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_SERVICEENABLED_Output() {
    
    Get_Data("serviceenabled");

    $parm0 = "Service Enabled|serviceenabled[site=unique]||serviceenabled_id|serviceenabled_id|25|No";
    $parm1 = "";
    $parm1 = $parm1."serviceenabled_id|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
    if ($GLOBALS{'service_people'} != "") { $parm1 = $parm1."serviceenabled_people||||Yes|People|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personexdirectory'} != "") { $parm1 = $parm1."serviceenabled_personexdirectory||||Yes|Person Ex Dir|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personextrafields'} != "") { $parm1 = $parm1."serviceenabled_personextrafields||||Yes|Person Extra Fields|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personmembership'} != "") { $parm1 = $parm1."serviceenabled_personmembership||||Yes|Person Membership|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personsafeguarding'} != "") { $parm1 = $parm1."serviceenabled_personsafeguarding||||Yes|Person Safeguarding|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personethnicity'} != "") { $parm1 = $parm1."serviceenabled_personethnicity||||Yes|Person Ethnicity|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_persondisability'} != "") { $parm1 = $parm1."serviceenabled_persondisability||||Yes|Person Disability|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_personmedical'} != "") { $parm1 = $parm1."serviceenabled_personmedical||||Yes|Person Medical|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_jobroles'} != "") { $parm1 = $parm1."serviceenabled_jobroles||||Yes|Jobroles|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_qualifications'} != "") { $parm1 = $parm1."serviceenabled_qualifications||||Yes|Qualifications|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_org'} != "") { $parm1 = $parm1."serviceenabled_org||||Yes|Organisation|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_webpages'} != "") { $parm1 = $parm1."serviceenabled_webpages||||Yes|Webpages|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_mobilepages'} != "") { $parm1 = $parm1."serviceenabled_mobilepages||||Yes|Mobile Pages|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_advertising'} != "") { $parm1 = $parm1."serviceenabled_advertising||||Yes|Advertising|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_email'} != "") { $parm1 = $parm1."serviceenabled_email||||Yes|Email|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_sms'} != "") { $parm1 = $parm1."serviceenabled_sms||||Yes|SMS|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_library'} != "") { $parm1 = $parm1."serviceenabled_library||||Yes|Library|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_accreditation'} != "") { $parm1 = $parm1."serviceenabled_accreditation||||Yes|Acccreditation|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_newsletters'} != "") { $parm1 = $parm1."serviceenabled_newsletters||||Yes|Newsletters|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_articles'} != "") { $parm1 = $parm1."serviceenabled_articles||||Yes|Articles|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_events'} != "") { $parm1 = $parm1."serviceenabled_events||||Yes|Events|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_actions'} != "") { $parm1 = $parm1."serviceenabled_actions||||Yes|Actions|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_bookings'} != "") { $parm1 = $parm1."serviceenabled_bookings||||Yes|Bookings|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_courses'} != "") { $parm1 = $parm1."serviceenabled_courses||||Yes|Courses|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_draws'} != "") { $parm1 = $parm1."serviceenabled_draws||||Yes|Draws|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_shop'} != "") { $parm1 = $parm1."serviceenabled_shop||||Yes|Shop|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_sections'} != "") { $parm1 = $parm1."serviceenabled_sections||||Sections|People|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_frs'} != "") { $parm1 = $parm1."serviceenabled_frs||||Yes|Fixtures Results and Selection|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_fin'} != "") { $parm1 = $parm1."serviceenabled_fin||||Yes|Financial Management|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_process'} != "") { $parm1 = $parm1."serviceenabled_process||||Yes|Process|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_auction'} != "") { $parm1 = $parm1."serviceenabled_auction||||Yes|Auction|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_pos'} != "") { $parm1 = $parm1."serviceenabled_pos||||Yes|Point of Sale|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_cor'} != "") { $parm1 = $parm1."serviceenabled_cor||||Yes|Cordage|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_reporting'} != "") { $parm1 = $parm1."serviceenabled_reporting||||Yes|Reporting|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_dmws'} != "") { $parm1 = $parm1."serviceenabled_dmws||||Yes|DMWS|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_grl'} != "") { $parm1 = $parm1."serviceenabled_grl||||Yes|League|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    if ($GLOBALS{'service_care'} != "") { $parm1 = $parm1."serviceenabled_care||||Yes|Care|InputSelectFromList,Enabled+Disabled+UpgradeReqd^"; }
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_SITEEMAIL_Output() {
	$parm0 = "Email and Messaging Settings|site[site=unique]||site_serviceid|site_serviceid|25|NoAdd";
	$parm1 = "";
	$parm1 = $parm1."site_serviceid|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
	$parm1 = $parm1."site_mailsendmethod||||Yes|Mail Send Method|InputSelectFromList,Basic+PHPMailer+PostMark^";
	$parm1 = $parm1."site_mailssmtppassword||||Yes|SMTP Password(PHPMailer)|InputText,30,60^";
	$parm1 = $parm1."site_mailserviceurl||||Yes|Service URL(PostMark)|InputText,30,60^";
	$parm1 = $parm1."site_mailservicetoken||||Yes|Service Token(PostMark)|InputText,30,60^";
	$parm1 = $parm1."site_defaultemailaddress||||Yes|Default Mail Address|InputText,30,60^";
	$parm1 = $parm1."site_smssendmethod||||Yes|Mail Send Method|InputSelectFromList,FireText+WhatsAppn^";
	$parm1 = $parm1."site_smsserviceurl||||Yes|SMS Service URL|InputText,30,60^";
	$parm1 = $parm1."site_smsserviceusername||||Yes|SMS Service Username|InputText,30,60^";
	$parm1 = $parm1."site_smsservicepassword||||Yes|SMS Service Password|InputText,20,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Email and Messaging Settings|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_SETUPSITEAPPVERSION_Output() {
    $parm0 = "Site Application Version|site[site=unique]||site_serviceid|site_serviceid|25|NoAdd";
    $parm1 = "";
    $parm1 = $parm1."site_serviceid|Yes|Service id|80|Yes|Service Id|KeyText,6,15^";
    $parm1 = $parm1."site_synchroniseappversion||||Yes|Site Application Version|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Email and Messaging Settings|UpdateButton";
    // $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_DOMAINSERVICE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "bootstraptogglemin";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstraptogglemin";	
}

function Setup_DOMAINSERVICE_Output() {
    XH2("Domain Service Options");
    XBR();   
    Get_Data('account_'.$GLOBALS{'LOGIN_domain_id'});  
    Get_Data('package_'.$GLOBALS{'account_packageid'});
    
    XPTXT("You currently have the ".$GLOBALS{'account_packageid'}." version.");
    
    XFORM("setupdomainservicein.php","setupservicein");
    XINSTDHID();   
    XH3("People");
    ServiceEnabledOut('Ex Directory','personextdirectory');
    ServiceEnabledOut('Additional Database Fields','personextrafields');
    ServiceEnabledOut('Membership Management','personmembership');
    ServiceEnabledOut('Safeguarding','personsafeguarding');
    ServiceEnabledOut('Ethnicity','personethnicity');
    ServiceEnabledOut('Disability','persondisability');
    ServiceEnabledOut('Medical','personmedical');
    
    if ( ServiceAvailable('jobroles,qualifications') ) {
        XH3("Job Roles and Qualifications");
        ServiceEnabledOut('Job Roles','jobroles');
        ServiceEnabledOut('Qualifications','qualifications');
    }   
    if ( ServiceAvailable('org,sections,actions,reporting') ) {        
        XH3("Organisation and Administration");
        ServiceEnabledOut('Organisation','org');
        ServiceEnabledOut('Sections and Groups','sections');
        ServiceEnabledOut('Action Log','actions');
        ServiceEnabledOut('Reporting','reporting');
    }   
    if ( ServiceAvailable('email,sms,newsletters') ) {        
        XH3("Communications");
        ServiceEnabledOut('EMail','email');
        ServiceEnabledOut('SMS Texts','sms');
        ServiceEnabledOut('Newsletter Composition','newsletters');
    }
    if ( ServiceAvailable('library,accreditation') ) {        
        XH3("Records Keeping");
        ServiceEnabledOut('Library','library');
        ServiceEnabledOut('Accreditation','accreditation');
    }
    if ( ServiceAvailable('advertising,articles,events,courses,draws') ) {        
        XH3("Website Services");
        ServiceEnabledOut('Sponsor Advertising','advertising');
        ServiceEnabledOut('News Articles','articles');
        ServiceEnabledOut('Events','events');
        ServiceEnabledOut('Bookable Courses','courses');
        ServiceEnabledOut('Raffles','draws');        
    }
    if ( ServiceAvailable('bookings,shop') ) {
        XH3("Bookable Facilities and Shop");
        ServiceEnabledOut('Bookable Facilities','bookings');
        ServiceEnabledOut('Shop','shop');
    }
    if ( ServiceAvailable('fin') ) {
        XH3("Financial Management");
        ServiceEnabledOut('Bookeeping','fin');
    }
        
    XBR();
    XINSUBMIT("Update");
    X_FORM();
}

function ServiceAvailable($servicelist) {
    $found = "0";
    $tstring = $GLOBALS{"service^FIELDS"}; $tfields = explode('|', $tstring);
    foreach ($tfields as $tfield) {
        $tbits = explode('_',$tfield);
        if (FoundInCommaList($tbits[1],$servicelist)) {           
            if ( $GLOBALS{'service_'.$tbits[1]} != "" ) { $found = "1"; }
        }
    }
    if ( $found == "1" ) {return true;} else {return false;}
}

function ServiceEnabledOut($description,$serviceref) {    
    if ( $GLOBALS{'service_'.$serviceref} != ""  ) {
        // XPTXT($GLOBALS{'package_servicebar'}." vs ".$GLOBALS{'service_'.$serviceref});
        if ($GLOBALS{'package_servicebar'} >= $GLOBALS{'service_'.$serviceref} ) {
            if ( ($GLOBALS{'serviceenabled_'.$serviceref} == "Enabled" )||($GLOBALS{'serviceenabled_'.$serviceref} == "Yes")) {
                $togglestatus = "Yes";               
            } else {
                $togglestatus = "No";     
            }
            BROW();
            BCOLTXT("","1");
            BCOLTXT($description,"2");
            BCOLINTOGGLEYESNO ("serviceenabled_".$serviceref,$togglestatus,"1");
            B_ROW();  
        } else {          
            BROW();
            BCOLTXT("","1");
            BCOLTXTCOLOR($description,"2","white","silver");
            BCOLTXTCOLOR("Upgrade Required","2","white","silver");
            B_ROW();             
        }
    }
}

function Setup_SPORT_Output() {
	$parm0 = "Sport Configuration|sport[site=all]||sport_id|sport_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."sport_id|Yes|Sport id|80|Yes|Sport Id|KeyText,2,2^";
	$parm1 = $parm1."sport_name|Yes|Name|150|Yes|Sport Name|InputText,30,60^";
	$parm1 = $parm1."sport_officialsname|Yes|Officials Name|150|Yes|Officials Title|InputText,30,60^";
	$parm1 = $parm1."sport_resultunit|Yes|Result Unit|150|Yes|Result Unit|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_DOMAIN_Output() {

	$parm0 = "Domain Configuration|domain|sport|domain_id|domain_id|25|No";
	$parm1 = "";
	$parm1 = $parm1."domain_id|Yes|Domain id|120|Yes|Domain Id|KeyText,6,15^";
	$parm1 = $parm1."domain_longname||||Yes|Longname|InputText,25,50^";
	$parm1 = $parm1."domain_shortname||||Yes|Shortname|InputText,15,20^";
	/*
	$parm1 = $parm1."domain_modeid||||Yes|Mode|InputFixed,2^";
	*/
	$parm1 = $parm1."domain_codeversion||||Yes|Code Version|InputText,5,5^";
	$parm1 = $parm1."domain_systemdate||||Yes|Syatem Date (SYSTEM or YYYYMMDD)|InputText,8,8^";
	$parm1 = $parm1."domain_simulation||||Yes|Simulation|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."domain_testdata||||Yes|Test Data|InputSelectFromList,OFF+ON^";
	$parm1 = $parm1."domain_readonly||||Yes|Read Only|InputSelectFromList,OFF+ON^";
	/*
	$parm1 = $parm1."domain_webstyle||||Yes|WebStyle|InputFixed,Default^";
	$parm1 = $parm1."domain_mobilestyle||||Yes|Mobile Style|InputFixed,Default^";
	$parm1 = $parm1."domain_weblock||||Yes|Weblock|InputFixed,^";
	$parm1 = $parm1."domain_domainmasters||||Yes|Domain Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_webmasters||||Yes|Web Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_resultsmasters||||Yes|Results Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_personmasters||||Yes|Person Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_bookingmasters||||Yes|Booking Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_sponsormasters||||Yes|Sponsor Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_salesmasters||||Yes|Sales Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_adminmasters||||Yes|Admin Masters|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_commsmasters||||Yes|Comms Masters|InputFixed,".$domain_contactid."^";
	// $parm1 = $parm1."domain_personmassnotifyintro||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_contactid||||Yes|Test Data ON/OFF|InputFixed,".$domain_contactid."^";
	$parm1 = $parm1."domain_currperiodid||||Yes|Current Period|InputText,10,12^";
	// $parm1 = $parm1."domain_urlrootdirectory||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_emailblocksize||||Yes|Email Blocksize|InputFixed,200^";
	$parm1 = $parm1."domain_personmembershipnotifyintro||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_showforgottenpasswordemail||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_showforgottenpasswordemailkey||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipintrotext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipmedicaltext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipminortext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipethnicitytext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipfinaltext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershiptermstext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipreminderintro||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershipexperiencetext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_personmembershiptypetext||||Yes|Test Data ON/OFF|InputText,3,3^";
	$parm1 = $parm1."domain_defaultemailaddress||||Yes|Test Data ON/OFF|InputText,3,3^";
	*/
	$parm1 = $parm1."domain_defaultemailaddress||||Yes|Default Email Address|InputText,60,100^";
	$parm1 = $parm1."domain_timeoutminutes||||Yes|Timeout (Minutes)|InputText,4,6^";
	$parm1 = $parm1."domain_actualurl||||Yes|Organisation URL|InputText,50,100^";
	$parm1 = $parm1."domain_sportid|Yes|Sport|100|Yes|Sport|InputSelectFromTable,sport,sport_id,sport_name,sport_id^";
	// $parm1 = $parm1."generic_programbutton|Yes|Create|100|No|Create Domain|ProgramButton,domainsetup.php,domain_id,domain_id,800,600^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_COOKIES_Output() {
 	XH2("Setup Cookie");
	XTABLE();
	XFORM("setupcookiesin.php","cookies");
	XINSTDHID();
	XTR();XTDTXT("Name");XTDINTXT ("CookieName","","15","30"); X_TR();
	XTR();XTDTXT("Value");XTDINTXT ("CookieValue","","15","30"); X_TR();	
	XTR();XTDTXT("Duration - Hours");XTDINTXT("CookieHours","","3","30"); X_TR();	
	XTR();XTDTXT("");XTDINSUBMIT("Send");X_TR();
	X_TABLE();
	X_FORM();
}

function Setup_DOMAINMASTERS_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Setup_DOMAINMASTERS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Domain Masters"."|"; # pagetitle
	$parm0 = $parm0."domain"."|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."domain_id|"; # keyfieldname
	$parm0 = $parm0."domain_id|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."domain_id|Yes|Domain id|120|Yes|Domain Id|KeyText,6,15^";
	$parm1 = $parm1."domain_domainmasters||||Yes|Domain Masters|InputPerson,40,80,domainmasters,Lookup^";
	$parm1 = $parm1."domain_webmasters||||Yes|Web Masters|InputPerson,40,80,webmasters,Lookup^";
	if ( $GLOBALS{'service_frs'} != "" ) {
		$parm1 = $parm1."domain_resultsmasters||||Yes|Results Masters|InputPerson,40,80,resultsmasters,Lookup^";
	}
	$parm1 = $parm1."domain_personmasters||||Yes|Person Masters|InputPerson,40,80,personmasters,Lookup^";
	if ( $GLOBALS{'service_bookings'} != "" ) {	
		$parm1 = $parm1."domain_bookingmasters||||Yes|Booking Masters|InputPerson,40,80,bookingmasters,Lookup^";
	}
	if ( $GLOBALS{'service_advertising'} != "" ) {
		$parm1 = $parm1."domain_sponsormasters||||Yes|Sponsor Masters|InputPerson,40,80,sponsormasters,Lookup^";
	}
	if ( $GLOBALS{'service_shop'} != "" ) {
		$parm1 = $parm1."domain_salesmasters||||Yes|Sales Masters|InputPerson,40,80,salesmasters,Lookup^";
	}
	$parm1 = $parm1."domain_adminmasters||||Yes|Admin Masters|InputPerson,40,80,adminmasters,Lookup^";
	$parm1 = $parm1."domain_commsmasters||||Yes|Comms Masters|InputPerson,40,80,commsmasters,Lookup^";
	$parm1 = $parm1."domain_qualificationmasters||||Yes|Qualification Masters|InputPerson,40,80,qualificationmasters,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,domainmasters,Select,domain_domainmasters_input,domain_domainmasters_personlist,80|
field,webmasters,Select,domain_webmasters_input,domain_webmasters_personlist,80|
field,resultsmasters,Select,domain_resultsmasters_input,domain_resultsmasters_personlist,80|
field,personmasters,Select,domain_personmasters_input,domain_personmasters_personlist,80|
field,bookingmasters,Select,domain_bookingmasters_input,domain_bookingmasters_personlist,80|
field,sponsormasters,Select,domain_sponsormasters_input,domain_sponsormasters_personlist,80|
field,salesmasters,Select,domain_salesmasters_input,domain_salesmasters_personlist,80|
field,adminmasters,Select,domain_adminmasters_input,domain_adminmasters_personlist,80|
field,commsmasters,Select,domain_commsmasters_input,domain_commsmasters_personlist,80|
field,qualificationmasters,Select,domain_qualificationmasters_input,domain_qualificationmasters_personlist,80",
"person_id",
"active",
"domainmasters,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_COMMSMASTERS_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Setup_COMMSMASTERS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Comms Masters"."|"; # pagetitle
	$parm0 = $parm0."commsmasters"."|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."commsmasters_domainid|"; # keyfieldname
	$parm0 = $parm0."commsmasters_domainid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."commsmasters_domainid|Yes|Domain id|120|Yes|Domain Id (".$GLOBALS{'domain_id'}.")|KeyText,25,50^";
	$parm1 = $parm1."commsmasters_bulletineditorlist||||Yes|Bulletin Editor|InputPerson,25,50,bulletineditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_eventeditorlist||||Yes|Events Editor|InputPerson,25,50,eventeditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_articleeditorlist||||Yes|Articles Editor|InputPerson,25,50,articleeditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_courseeditorlist||||Yes|Courses Editor|InputPerson,25,50,courseeditorlist,Lookup^";
	$parm1 = $parm1."commsmasters_websitepublisherlist||||Yes|Website Publisher|InputPerson,25,50,websitepublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_bulletinpublisherlist||||Yes|Bulletin Publisher|InputPerson,25,50,bulletinpublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_newsletterpublisherlist||||Yes|Newsletter Publisher|InputPerson,25,50,newsletterpublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_facebookpublisherlist||||Yes|Facebook Publisher|InputPerson,25,50,facebookpublisherlist,Lookup^";
	$parm1 = $parm1."commsmasters_twitterpublisherlist||||Yes|Twitter Publisher|InputPerson,25,50,twitterpublisherlist,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,bulletineditorlist,Select,commsmasters_bulletineditorlist_input,commsmasters_bulletineditorlist_personlist,80|
field,eventeditorlist,Select,commsmasters_eventeditorlist_input,commsmasters_eventeditorlist_personlist,80|
field,articleeditorlist,Select,commsmasters_articleeditorlist_input,commsmasters_articleeditorlist_personlist,80|
field,courseeditorlist,Select,commsmasters_courseeditorlist_input,commsmasters_courseeditorlist_personlist,80|
field,websitepublisherlist,Select,commsmasters_websitepublisherlist_input,commsmasters_websitepublisherlist_personlist,80|
field,bulletinpublisherlist,Select,commsmasters_bulletinpublisherlist_input,commsmasters_bulletinpublisherlist_personlist,80|
field,newsletterpublisherlist,Select,commsmasters_newsletterpublisherlist_input,commsmasters_newsletterpublisherlist_personlist,80|
field,facebookpublisherlist,Select,commsmasters_facebookpublisherlist_input,commsmasters_facebookpublisherlist_personlist,80|
field,twitterpublisherlist,Select,commsmasters_twitterpublisherlist_input,commsmasters_twitterpublisherlist_personlist,80",  
"person_id",
"active",
"commsmasters,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_PERSONTYPES_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_PERSONTYPES_Output() {
	$parm0 = "Membership Types - ".$GLOBALS{'currperiodid'}."|persontype[rootkey=".$GLOBALS{'currperiodid'}."]||persontype_code|persontype_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."persontype_code|Yes|Id|60|Yes|Membership type Id|KeyText,12,15^";
	$parm1 = $parm1."persontype_name|Yes|Description|200|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."persontype_criteria|No|Criteria|60|Yes|Criteria|InputTextArea,3,40^";
	$parm1 = $parm1."persontype_eventfee|No|Event Fee|60|Yes|Match Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_seq|Yes|Seq|60|Yes|Seq|InputText,4,4^";
	$parm1 = $parm1."persontype_selectable|Yes|Selectable|60|Yes|Selectable|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."persontype_annualoneofffee|Yes|Annual Fee|60|Yes|One Off Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedfee|Yes|Staged Fee|60|Yes|Staged Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedinitialfee|No|IF|60|Yes|Staged Initial Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedrecurringfee|No|RF|60|Yes|Staged Recurring Fee|InputText,7,7^";
	$parm1 = $parm1."persontype_annualstagedrecurringpayments|No|NoRP|60|Yes|Staged Payments|InputText,7,7^";
	$parm1 = $parm1."persontype_multimember|No|Multi|60|Yes|Multi Member|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."persontype_multimemberquantity|No|Multi|60|Yes|Multi Member Quantity|InputSelectFromList,1+2+3+4+5+6+7+8^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_PERSONUSERLEVEL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_PERSONUSERLEVEL_Output() {
    $parm0 = "User levels|personuserlevel||personuserlevel_code|personuserlevel_code|25|No";
    $parm1 = "";
    $parm1 = $parm1."personuserlevel_code|Yes|User Level|60|Yes|User Level|KeyText,1,1^";
    $parm1 = $parm1."personuserlevel_description|Yes|Description|200|Yes|Description|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_ETHNICITY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_ETHNICITY_Output() {
	$parm0 = "Ethnicity Types|ethnicity||ethnicity_code|ethnicity_seq|25|No";
	$parm1 = "";
	$parm1 = $parm1."ethnicity_code|Yes|Id|60|Yes|Ethnicity Code|KeyText,12,15^";
	$parm1 = $parm1."ethnicity_title|Yes|Title|250|Yes|Title|InputText,30,60^";
	$parm1 = $parm1."ethnicity_seq|Yes|Seq|60|Yes|Seq|InputText,4,4^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_DISABILITY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_DISABILITY_Output() {
	$parm0 = "Disability Types|disability||disability_code|disability_seq|25|No";
	$parm1 = "";
	$parm1 = $parm1."disability_code|Yes|Id|60|Yes|Ethnicity Code|KeyText,12,15^";
	$parm1 = $parm1."disability_title|Yes|Title|250|Yes|Title|InputText,30,60^";
	$parm1 = $parm1."disability_seq|Yes|Seq|60|Yes|Seq|InputText,4,4^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Setup_MEMBERSHIPFORMTEXT_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_MEMBERSHIPFORMTEXT_Output() {
	$parm0 = "Membership Form Text|domain||domain_id||25|No";
	$parm1 = "";
	$parm1 = $parm1."domain_id|Yes|Id|150|Yes|Domain Id|KeyText,12,15^";
	$parm1 = $parm1."|No|||Yes|Text on Membership Form|Divider^";
	$parm1 = $parm1."domain_personmembershipintrotext|No|||Yes|Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershiptypetext|No|||Yes|Section/Type Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipexperiencetext|No|||Yes|Experience Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipmedicaltext|No|||Yes|Medical Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipminortext|No|||Yes|Under 18 Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipethnicitytext|No|||Yes|Ethnicity/Disability Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipfinaltext|No|||Yes|Closing Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershiptermstext|No|||Yes|Terms and Conditions|InputTextArea,4,50^";
	$parm1 = $parm1."|No|||Yes|Text on Mass Membership Notifiers|Divider^";
	$parm1 = $parm1."domain_personmembershipnotifyintro|No|||Yes|Initial Notifier Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."domain_personmembershipreminderintro|No|||Yes|Reminder Introduction Text|InputTextArea,4,50^";
	$parm1 = $parm1."|No|||Yes|Text on Mass Info Notifiers|Divider^";
	$parm1 = $parm1."domain_personmassnotifyintro|No|||Yes|Introduction Text|InputTextArea,4,50^";
	// $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_SECTION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Setup_SECTION_Output() {

	$parm0 = "";
	$parm0 = $parm0."Section Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."section[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
	if ( $GLOBALS{'service_frs'} != "" ) {
		$parm0 = $parm0."sport,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	} else {
		$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section|"; # othertables
	}	
	$parm0 = $parm0."section_name|"; # keyfieldname
	$parm0 = $parm0."section_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."section_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."section_name|Yes|Name|90|Yes|Section Name|KeyText,12,15^";
	$parm1 = $parm1."section_seq|Yes|Seq|40|Yes|Sequence|InputText,10,20^";
	$parm1 = $parm1."section_leader|No|||Yes|Leader|InputPerson,10,20,Ldr,Lookup^";
	$parm1 = $parm1."section_personmgrs|No|||Yes|People Authorised to Update<BR>Section Person Information|InputPerson,45,100,PMgrs,Lookup^";
	$tsyntax = "InputSelectFromList,0[Section treated as Ex Directory]+1[Visible only to people in this section]+2[Visible to people in other sections]";
	$parm1 = $parm1."section_exdir|Yes|Confidentiality|100|Yes|Confidentiality Control|$tsyntax^";
	$tsyntax = "InputSelectFromList,Yes[Library Update open to all people in this section]+No[Library Update restricted]";
	$parm1 = $parm1."section_libraryupdateall|No|||Yes|Library Update|$tsyntax^";
	$parm1 = $parm1."section_treasurer|No|||Yes|Treasurer|InputPerson,10,20,Treasurer,Lookup^";
	$parm1 = $parm1."section_banksort|No||30|Yes|Bank Sort Code|InputText,8,8^";
	$parm1 = $parm1."section_bankaccount|No||30|Yes|Bank Account Code|InputText,8,8^";
	$parm1 = $parm1."section_bankaccountname|No||30|Yes|Bank Account Name|InputText,25,50^";
	if ( $GLOBALS{'service_frs'} != "" ) {
		$parm1 = $parm1."section_teams|No|||Yes|Teams|InputText,30,60^";
		$parm1 = $parm1."section_resmgrs|No|||Yes|People Authorised to Update<BR>Subsection Results|InputPerson,45,100,RMgrs,Lookup^";
		$parm1 = $parm1."section_sportid|Yes|Sport|100|Yes|Sport|InputSelectFromTable,sport,sport_id,sport_name,sport_id^";
		$parm1 = $parm1."section_frs|Yes|Fix-Res|60|Yes|Fixtures/Results<br/>Functionalty Enabled|InputSelectFromList,Yes+No^";
		$parm1 = $parm1."section_seasonstartdate|Yes|Start|80|Yes|Season Start Date|InputDate^";
		$parm1 = $parm1."section_seasonenddate|Yes|End|80|Yes|Season End Date|InputDate^";
		$parm1 = $parm1."section_showdateavailability|Yes|AvailDates|80|Yes|Show All Dates on<br>Availability Input|InputSelectFromList,Yes+No^";
	}
	$parm1 = $parm1."section_archive|Yes|Arch|50|Yes|Archive|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."section_paypalemail|No|||Yes|PayPal email|InputText,40,80^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|75|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	
$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Ldr,Ldr..,section_leader_input,section_leader_personlist,50|
field,PMgrs,PMgrs..,section_personmgrs_input,section_personmgrs_personlist,65|
field,RMgrs,RMgrs..,section_resmgrs_input,section_resmgrs_personlist,65|
field,Treasurer,Treasurer..,section_treasurer_input,section_treasurer_personlist,65",
 "person_id",
 "active",
 "section,50,50,200,200",
 "view",
 "buildfulllist"
);	
	
}

function Setup_TEAM_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Setup_TEAM_Output() {
	XH3('Please note that Team Codes are 2 character Alphanumeric. eg "M2" or "CC"');
	XH4('Dont forget to assign the team to a section once you have set it up.');
	$parm0 = "";
	$parm0 = $parm0."Team Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."team[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."team_code|"; # keyfieldname
	$parm0 = $parm0."team_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."team_code|Yes|Code|90|Yes|Team Code|KeyText,2,2^";
	$parm1 = $parm1."team_name|Yes|Name|150|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."team_mgr|Yes|Manager|100|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."team_captain|Yes|Captain|100|Yes|Captain|InputPerson,10,25,Captain,Lookup^";
	$parm1 = $parm1."team_coach|Yes|Coach|100|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."team_resmgrs|No|Results Managers|90|Yes|Other Team members authorised to enter match results etc|InputPerson,45,100,ResMgrs,Lookup^";
	$parm1 = $parm1."team_leaguename|Yes|League Name|150|Yes|League Name|InputText,50,150^";
	$parm1 = $parm1."team_leaguelink|No|League Link|90|Yes|League Link|InputTextArea,3,50^";
	// $parm1 = $parm1."team_netref|No|Net Ref|90|Yes|Net Ref|InputText,50,150^";
	// $parm1 = $parm1."team_netcompref|No|Net Comp Ref|90|Yes|Net Comp Ref|InputText,50,150^";
	$parm1 = $parm1."team_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	$parm1 = $parm1."team_squadlist|No|Squad|90|Yes|Squad|InputPerson,45,200,Squad,Lookup^";
	$parm1 = $parm1."team_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."team_photo|No|Photo|30|Yes|Team Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,1000,200,Team,team_code^";
	$parm1 = $parm1."team_selectionreminder|No|Reminder|50|Yes|Selection Reminder|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."team_videostreamvisibility|No|||Yes|Video Stream Visibility|InputSelectFromList,Public+Members^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,60",
"field,Manager,Select,team_mgr_input,team_mgr_personlist,70|
field,Captain,Select,team_captain_input,team_captain_personlist,70|
field,Coach,Select,team_coach_input,team_coach_personlist,70|
field,ResMgrs,Select,team_resmgrs_input,team_resmgrs_personlist,80|
field,Squad,Select,team_squadlist_input,team_squadlist_personlist,80|
field,Hlprs,Select,team_helpers_input,team_helpers_personlist,80",
"person_id",
"active",
"team,50,50,400,400",
"view",
"buildfulllist"
	);	
	
}

function Setup_MYTEAM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Setup_MYTEAM_Output($teamcode) {
	$parm0 = "";
	$parm0 = $parm0."My Team Setup - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."team[rootkey=".$GLOBALS{'currperiodid'}."][fieldvalue=team_code:".$teamcode."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."team_code|"; # keyfieldname
	$parm0 = $parm0."team_seq|"; # sortfieldname
	$parm0 = $parm0."No|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."team_code|Yes|Team Code|90|Yes|Team Code|KeyText,5,15^";
	$parm1 = $parm1."team_name|Yes|Name|150|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."team_mgr|Yes|Manager|100|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."team_captain|Yes|Captain|100|Yes|Captain|InputPerson,10,25,Captain,Lookup^";
	$parm1 = $parm1."team_coach|Yes|Coach|100|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."team_resmgrs|No|Results Managers|90|Yes|Other Team members authorised to enter match results etc|InputPerson,45,100,ResMgrs,Lookup^";
	$parm1 = $parm1."team_leaguename|No|League Name|90|Yes|League Name|InputText,50,150^";
	$parm1 = $parm1."team_leaguelink|No|League Link|90|Yes|League Link|InputTextArea,3,50^";
	//	$parm1 = $parm1."team_netref|No|Net Ref|90|Yes|Net Ref|InputText,50,150^";
	//	$parm1 = $parm1."team_netcompref|No|Net Comp Ref|90|Yes|Net Comp Ref|InputText,50,150^";
	//	$parm1 = $parm1."team_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	//	$parm1 = $parm1."team_squadlist|No|Squad|90|Yes|Squad|InputPerson,45,100,Squad,Lookup^";
	$parm1 = $parm1."team_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."team_photo|No|Photo|30|Yes|Team Photo|InputImage,GLOBALDOMAINWWWURL/domain_media,GLOBALDOMAINWWWPATH/domain_media,1000,200,Team,team_code^";
	$parm1 = $parm1."team_selectionreminder|No|Reminder|50|Yes|Selection Reminder|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."team_videostreamvisibility|No|||Yes|Video Stream Visibility|InputSelectFromList,Public+Members^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Manager,Select,team_mgr_input,team_mgr_personlist,70|
field,Captain,Select,team_captain_input,team_captain_personlist,70| 
field,Coach,Select,team_coach_input,team_coach_personlist,70|
field,ResMgrs,Select,team_resmgrs_input,team_resmgrs_personlist,80|
field,Squad,Select,team_squadlist_input,team_squadlist_personlist,80|
field,Hlprs,Select,team_helpers_input,team_helpers_personlist,80",
"person_id",
"active",
"team,50,50,400,400",
"view",
"buildfulllist"
	);
	
	XHRCLASS("underline");
	XH3("Notes:");
	XPTXT("Team Setup is used to define the Managers, Coaches, Captains and other helpers associated with your team.");
	XPTXT("It also allows you to enter the League/Cup that your team plays in, and the link to League/Cup Results.");
}



function Setup_SECTIONGROUP_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

Function Setup_SECTIONGROUP_Output() {
	$parm0 = "";
	$parm0 = $parm0."Group Update - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."sectiongroup[rootkey=".$GLOBALS{'currperiodid'}."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."sectiongroup_code|"; # keyfieldname
	$parm0 = $parm0."sectiongroup_seq|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."sectiongroup_code|Yes|Group Code|90|Yes|Group Code|KeyText,5,15^";
	$parm1 = $parm1."sectiongroup_name|Yes|Name|120|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."sectiongroup_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	$parm1 = $parm1."sectiongroup_mgr|Yes|Manager|90|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."sectiongroup_coach|Yes|Coach|90|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."sectiongroup_personmgrs|No|People Managers|90|Yes|Administrators - Other people who need access to group records|InputPerson,45,100,PMgrs,Lookup^";
	$parm1 = $parm1."sectiongroup_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Manager,Select,sectiongroup_mgr_input,sectiongroup_mgr_personlist,70|
field,Coach,Select,sectiongroup_coach_input,sectiongroup_coach_personlist,70|
field,PMgrs,Select,sectiongroup_personmgrs_input,sectiongroup_personmgrs_personlist,80|
field,Hlprs,Select,sectiongroup_helpers_input,sectiongroup_helpers_personlist,80",
"person_id",
"active",
"group,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_MYSECTIONGROUP_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,viewaspopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

Function Setup_MYSECTIONGROUP_Output($sectiongroupcode) {
	$parm0 = "";
	$parm0 = $parm0."My Group Setup ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	$parm0 = $parm0."sectiongroup[rootkey=".$GLOBALS{'currperiodid'}."][fieldvalue=sectiongroup_code:".$sectiongroupcode."]|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."sectiongroup_code|"; # keyfieldname
	$parm0 = $parm0."sectiongroup_seq|"; # sortfieldname
	$parm0 = $parm0."No|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	// $parm1 = $parm1."team_periodid|Yes|Year|90|Yes|Year|KeyText,12,15^";
	$parm1 = $parm1."sectiongroup_code|Yes|Group Code|90|Yes|Group Code|KeyText,5,15^";
	$parm1 = $parm1."sectiongroup_name|Yes|Name|120|Yes|Name|InputText,20,50^";
	$parm1 = $parm1."sectiongroup_seq|Yes|Seq|40|Yes|Seq|InputText,5,10^";
	$parm1 = $parm1."sectiongroup_mgr|Yes|Manager|90|Yes|Manager|InputPerson,10,25,Manager,Lookup^";
	$parm1 = $parm1."sectiongroup_coach|Yes|Coach|90|Yes|Coach|InputPerson,10,25,Coach,Lookup^";
	$parm1 = $parm1."sectiongroup_personmgrs|No|People Managers|90|Yes|Administrators - Other people who need access to group records|InputPerson,45,100,PMgrs,Lookup^";
	$parm1 = $parm1."sectiongroup_helpers|No|Voluntary Helpers|90|Yes|Voluntary Helpers - Other people who may need DBS accreditation|InputPerson,45,100,Hlprs,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname|person_section",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40|
person_section,Section,60",
"field,Manager,Select,sectiongroup_mgr_input,sectiongroup_mgr_personlist,70|
field,Coach,Select,sectiongroup_coach_input,sectiongroup_coach_personlist,70|
field,PMgrs,Select,sectiongroup_personmgrs_input,sectiongroup_personmgrs_personlist,80|
field,Hlprs,Select,sectiongroup_helpers_input,sectiongroup_helpers_personlist,80",
"person_id",
"active",
"group,50,50,400,400",
"view",
"buildfulllist"
	);
}

function Setup_VENUE_CSSJS() {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

Function Setup_VENUE_Output() {
	$parm0 = "Venue Update New|venue|person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|venue_code|venue_code|No|No";
	$parm1 = "";
	$parm1 = $parm1."venue_code|Yes|Venue Code|90|Yes|Venue Code|KeyText,5,15^";
	$parm1 = $parm1."venue_name|Yes|Name|100|Yes|Venue Name|InputText,25,50^";
	$parm1 = $parm1."venue_link||||Yes|Link|InputText,50,100^";
	$parm1 = $parm1."venue_netref||||Yes|NetRef|InputText,50,100^";
	$parm1 = $parm1."venue_facility||||Yes|Facility Description|InputTextArea,3,50^";
	$parm1 = $parm1."venue_bookable|Yes|Bookable|70|Yes|Venue Bookable|InputCheckboxFromList,Yes+No^";
	$parm1 = $parm1."venue_owner|Yes|Contact|80|Yes|Contact|InputPerson,10,20,Contact,Lookup^";
	$parm1 = $parm1."venue_daytimestart|No||40|Yes|Time Start|InputText,5,5^";
	$parm1 = $parm1."venue_daytimeend|No||40|Yes|Time End|InputText,5,5^";
	$parm1 = $parm1."venue_timeslice|No||40|Yes|Time Slice|InputText,5,5^";
	$parm1 = $parm1."venue_leadtimedays|No||40|Yes|Leadtime Days|InputText,2,2^";
	$parm1 = $parm1."venue_authorisation|No||40|Yes|Authorised Administrators|InputPerson,10,20,Administrator,Lookup^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$p0 = "other,person_domainid|person_id|person_sname|person_fname|person_section";
	$p1 =  "person_id,Id,40|person_sname,SurName,70|person_fname,FirstName,70";
	$p2 =  "field,Contact,Contact..,venue_owner_input,venue_owner_personlist,50|field,Administrator,Administrator..,venue_authorisation_input,venue_authorisation_personlist,50";
	$p3 =  "person_id";
	$p4 =  "all";
	$p5 =  "venue,50,50,900,900";
	$p6 =  "view";
	$p7 =  "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);
}

function Setup_PAYMENTOPTION_Output() {
	$parm0 = "Payment Options|paymentoption||paymentoption_name|paymentoption_name|No|No";
	$parm1 = "";
	$parm1 = $parm1."paymentoption_name|Yes|Name|100|Yes|Payment Option Name|KeyText,25,50^";
	$parm1 = $parm1."paymentoption_description|No|Description|150|Yes|Description|InputTextArea,4,50^";
	$parm1 = $parm1."paymentoption_type|Yes|Type|80|Yes|Payment Option Type|InputSelectFromList,BankTransfer+Merchant+Cheque+Cash^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_ADVERTISERCATEGORY_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_ADVERTISERCATEGORY_Output() {
	$parm0 = "Advertiser Category Update|advertisercategory||advertisercategory_name|advertisercategory_name|No|No";
	$parm1 = "";
	$parm1 = $parm1."advertisercategory_name|Yes|Category Name|100|Yes|Advertiser Category Name|KeyText,25,50^";
	$parm1 = $parm1."advertisercategory_title|Yes|Description|150|Yes|Description|InputText,50,90^";
	$parm1 = $parm1."advertisercategory_imagewidth|Yes|Width|150|Yes|Image Width|InputText,06,10^";	
	$parm1 = $parm1."advertisercategory_imageheight|Yes|Height|150|Yes|Image Height|InputText,06,10^";
	$parm1 = $parm1."advertisercategory_thumbimagewidth|Yes|Thumb Width|150|Yes|Thumbnail Image Width|InputText,06,10^";
	$parm1 = $parm1."advertisercategory_thumbimageheight|Yes|Thumb Height|150|Yes|Thumbnail Image Height|InputText,06,10^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Setup_ADVERTISER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ADVERTISER_Output() {
	$parm0 = "Advertiser Update|advertiser|advertisercategory|advertiser_name|advertiser_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."advertiser_name|Yes|Name|140|Yes|Advertiser Name|KeyText,15,25^";
	$parm1 = $parm1."advertiser_category|Yes|Category|100|Yes|Category|InputSelectFromTable,advertisercategory,advertisercategory_name,advertisercategory_title,advertisercategory_name^";
	$parm1 = $parm1."advertiser_freq|Yes|Freq|30|Yes|Frequency|InputText,6,20^";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) { $bannerurlbase = "GLOBALSITEWWWURL"; } 
	else { $bannerurlbase = "GLOBALDOMAINWWWURL"; }
	$bannerurldir = $bannerurlbase."/domain_advertisers";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) { $bannerfilebase = "GLOBALSITEWWWPATH"; } 
	else { $bannerfilebase = "GLOBALDOMAINWWWPATH"; }
	$bannerfiledir = $bannerfilebase."/domain_advertisers";
	$parm1 = $parm1."advertiser_banner|No|Banner|30|Yes|Banner Image|InputImage,$bannerurldir,$bannerfiledir,advertisercategory_imagewidth[advertiser_category_input],advertisercategory_imageheight[advertiser_category_input],Advertiser,advertiser_name,advertiser_category^";	
	$parm1 = $parm1."advertiser_thumb|No|Thumb|30|Yes|Thumbnail Image (Optional)|InputImage,$bannerurldir,$bannerfiledir,advertisercategory_thumbimagewidth[advertiser_category_input],advertisercategory_thumbimageheight[advertiser_category_input],Advertiser,advertiser_name,advertiser_category^";
	$parm1 = $parm1."advertiser_website|No|Website|30|Yes|Website|InputText,25,50^";
	$parm1 = $parm1."advertiser_email|No|eMail|30|Yes|eMail|InputText,40,80^";
	$parm1 = $parm1."advertiser_text|Yes|Descriptioo|100|Yes|Description|InputTextArea,4,50^";
	$parm1 = $parm1."advertiser_clicksresetdate|No|Reset Date|30|Yes|Click counter reset date|InputDate^";
	$parm1 = $parm1."advertiser_clicks|Yes|Clicks|30|Yes|Clicks|InputText,10,20^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_BULLETINBOARD_Output() {
	$parm0 = "Bulletin Board Management|bulletinboard|webpage|bulletinboard_name|bulletinboard_name|No|No";
	$parm1 = "";
	$parm1 = $parm1."bulletinboard_name|Yes|Id|90|Yes|Board Name|KeyText,12,15^";
	$parm1 = $parm1."bulletinboard_webpagename|Yes|Webpage|100|Yes|Webpage|InputSelectFromTable,webpage,webpage_name,webpage_name,webpage_name^";
	$parm1 = $parm1."bulletinboard_controllers|Yes|Controllers|120|Yes|Controllers|InputText,10,20^";
	$parm1 = # $parm1."bulletinboard_users|Yes|Users|150|Yes|Users allowed to post on this board|InputText,40,60^";
	$parm1 = $parm1."bulletinboard_max|Yes|Max|40|Yes|Max Bulletins shown on this board|InputSelectFromList,1+2+3+4+5+6+7+8+9+10+11+12^";
	$parm1 = $parm1."bulletinboard_keepmax|No|||Yes|Keep before deleting|InputSelectFromList,5+10+15+20+25+30^";
	$parm1 = $parm1."|No|||Yes||Divider^";
	$parm1 = $parm1."bulletinboard_fontcolor|No|||Yes|Font Color|InputSelectFromList,Black+Blue+Red+Green+Yellow+White+Silver+Gray+Maroon+Lime+Cyan+Teal+Purple+Navy+Magneta+Fuchsia+Olive+Aqua^";
	$parm1 = $parm1."bulletinboard_fonthovercolor|No|||Yes|Hover Color|InputSelectFromList,Black+Blue+Red+Green+Yellow+White+Silver+Gray+Maroon+Lime+Cyan+Teal+Purple+Navy+Magneta+Fuchsia+Olive+Aqua^";
	$parm1 = $parm1."bulletinboard_fontsize|No|||Yes|Font Size|InputSelectFromList,4+5+6+7+8+9+10+11+12+13+14+15+16+17+18^";
	$parm1 = $parm1."bulletinboard_showdates|No|||Yes|Show Dates|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."bulletinboard_textmax|No|||Yes|Max characters in text|InputText,4,4^";
	$parm1 = $parm1."|No|||Yes||Divider^";
	$parm1 = $parm1."bulletinboard_topstoryenabled|Yes|Top Story Enabled|120|Yes|Top Story Enabled|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."bulletinboard_topstorytextposition|No|||Yes|Top Story Text Position|InputSelectFromList,Above image+Below image^";
	$parm1 = $parm1."bulletinboard_topstoryimagewidth|No|||Yes|Top Story Image Width|InputText,4,4^";
	$parm1 = $parm1."|No|||Yes||Divider^";
	$parm1 = $parm1."bulletinboard_imagewidth|No|||Yes|Image Width|InputText,4,4^";
	$parm1 = $parm1."generic_programbutton|Yes|Review Content|130|No|Review Content|ProgramButton,bulletinboardeditout.php,bulletinboard_name,bulletinboard_name,samewindow,,^";
	$parm1 = $parm1."generic_updatebutton|Yes|Settings|90|No|Settings|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|75|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_QUALIFICATION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_QUALIFICATION_Output() {
	$parm0 = "Qualification Update|qualification||qualification_id|qualification_title|25|No";
	$parm1 = "";
	$parm1 = $parm1."qualification_id|Yes|Id|120|Yes|Qualification Id|KeyText,12,15^";
	$parm1 = $parm1."qualification_title|Yes|Title|100|Yes|Qualification Title|InputText,20,40^";
	$parm1 = $parm1."qualification_description|Yes|Description|300|Yes|Qualification Description|InputTextArea,4,50^";
	$parm1 = $parm1."qualification_renewalperiod|Yes|Renewal Period - Yrs|130|Yes|Renewal Period - Years|InputSelectFromList,1+2+3+4+5+6+7+8+9+10+Indefinite^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_JOBROLE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqueryui,jqdatatables,jqueryconfirm";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_JOBROLE_Output() {
	$parm0 = "Job Role Update|jobrole||jobrole_id|jobrole_title|25|No";
	$parm1 = "";
	$parm1 = $parm1."jobrole_id|Yes|Job Role Id|90|Yes|Job Role Id|KeyText,12,15^";
	$parm1 = $parm1."jobrole_title|Yes|Title|100|Yes|Job Role Title|InputText,20,40^";
	$parm1 = $parm1."jobrole_description|Yes|Description|400|Yes|Job Role Description|InputTextArea,4,50^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_JOBROLEQUALIFICATION_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
}

function Setup_JOBROLEQUALIFICATION_Output() {
	$parm0 = "";
	$parm0 = $parm0."JobRole/Qualification Update|"; # pagetitle
	$parm0 = $parm0."jobrolequalification[mergedkey=jobrolequalification_jobroleid+jobrolequalification_qualificationid]|"; # primetable
	$parm0 = $parm0."jobrole,qualification|"; # othertables
	$parm0 = $parm0."jobrolequalification_jobroleid+jobrolequalification_qualificationid|"; # keyfieldname
	$parm0 = $parm0."jobrolequalification_jobroleid+jobrolequalification_qualificationid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."jobrolequalification_jobroleid|Yes|JobRole|100|Yes|JobRole|KeySelectFromTable,jobrole,jobrole_id,jobrole_title,jobrole_title^";
	$parm1 = $parm1."jobrolequalification_qualificationid|Yes|Qualification|100|Yes|Qualification|KeySelectFromTable,qualification,qualification_id,qualification_title,qualification_title^";
	$parm1 = $parm1."jobrolequalification_requirementlevel|Yes|Requirement|100|Yes|Requirement|InputSelectFromList,Required+Recommended^";
	$parm1 = $parm1."jobrolequalification_comments|Yes|Comments|150|Yes|Comments|InputText,40,80^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_TESTSLIM_Output () {
	XH2("Test Slim Image Cropper");
	XPTXT("This checks that this facility works correctly on this server.");
	XH2('Server Parameters');
	$max_upload = (int)(ini_get('upload_max_filesize'));
	XBR();XTXT("max_upload - ".$max_upload);
	$max_post = (int)(ini_get('post_max_size'));
	XBR();XTXT("max_post - ".$max_post);
	$memory_limit = (int)(ini_get('memory_limit'));
	XBR();XTXT("memory_limit - ".$memory_limit);
	XBR();XBR();
	XFORM("slimtestout.php","");
	XINSTDHID();
	XHR();
	XTDINSUBMIT("Go - Slim via Form returning Input plus Crop");	
	X_FORM();	
}

function Setup_PHPUTILITY1_Output () {
	XH3("Special PHP Utility Launcher - 1");
	for ($i = 1; $i <= 1000; $i++) {
		$pswclear = createRandomPassword();
		if (strpos($pswclear,' ') !== false) {
			XHR();
			XPTXT($person_id." "."'".$pswclear."'");
			XH5("BLANK");
			$newpswclear = str_replace(" ", "x", $pswclear);
			$GLOBALS{'person_password'} = XCrypt($newpswclear,$person_id,"encrypt");
			XPTXT($person_id." "."'".XCrypt($GLOBALS{'person_password'},$person_id,"decrypt")."'");
			Write_Data('person',$person_id);
		}
	}
}
function Setup_PHPUTILITY2_Output () {
	XH3("Special PHP Utility Launcher - 2");
	$persona = Get_Array('person');
	foreach ($persona as $person_id) {

		Get_Data('person',$person_id);
		$pswclear = XCrypt($GLOBALS{'person_password'},$person_id,"decrypt");
		if (strpos($pswclear,' ') !== false) {
			XHR();
			XPTXT($person_id." "."'".$pswclear."'");
			XH5("BLANK");
			$newpswclear = str_replace(" ", "x", $pswclear);
			$GLOBALS{'person_password'} = XCrypt($newpswclear,$person_id,"encrypt");
			XPTXT($person_id." "."'".XCrypt($GLOBALS{'person_password'},$person_id,"decrypt")."'");
			Write_Data('person',$person_id);
		}

	}
}
function Setup_PHPUTILITY3_Output () {
	XH3("Special PHP Utility Launcher - 3");

	foreach (Get_Array("section",$GLOBALS{'currperiodid'}) as $tsection_name) {
		Get_Data("section",$GLOBALS{'currperiodid'},$tsection_name);
		$teama = List2Array($GLOBALS{'section_teams'});
		foreach ($teama as $teamcode) {
			$frsa = Get_Array('frs',$GLOBALS{'currperiodid'},$teamcode);
			foreach ($frsa as $frsid) {
				XHR();
				Get_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);
				XPTXT($frsid." ".$GLOBALS{'frs_personavailabilitylist'});
				XPTXT($frsid." ".$GLOBALS{'frs_playerselectedlist'});

				$GLOBALS{'frs_personavailabilitylist'} = str_replace("Yes", "Y", $GLOBALS{'frs_personavailabilitylist'});
				$GLOBALS{'frs_personavailabilitylist'} = str_replace("No", "N", $GLOBALS{'frs_personavailabilitylist'});
				$GLOBALS{'frs_personavailabilitylist'} = str_replace("Meet", "M", $GLOBALS{'frs_personavailabilitylist'});
				$GLOBALS{'frs_personavailabilitylist'} = str_replace("Direct", "D", $GLOBALS{'frs_personavailabilitylist'});

				$GLOBALS{'frs_playerselectedlist'} = str_replace("Yes", "Y", $GLOBALS{'frs_playerselectedlist'});
				$GLOBALS{'frs_playerselectedlist'} = str_replace("No", "N", $GLOBALS{'frs_playerselectedlist'});
				$GLOBALS{'frs_playerselectedlist'} = str_replace("Meet", "M", $GLOBALS{'frs_playerselectedlist'});
				$GLOBALS{'frs_playerselectedlist'} = str_replace("Direct", "D", $GLOBALS{'frs_playerselectedlist'});

				XPTXT(" ");
				XPTXT($frsid." ".$GLOBALS{'frs_personavailabilitylist'});
				XPTXT($frsid." ".$GLOBALS{'frs_playerselectedlist'});
				Write_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);

			}
		}
	}


}

function Setup_PHPUTILITY4_Output () {
	XH3("Special PHP Utility Launcher - 4");

	XH2("domainwwwurl - ".$GLOBALS{'domainwwwurl'});
	XH2("domainwwwpath - ".$GLOBALS{'domainwwwpath'});

	$bulletina = Get_Array("bulletin");
	foreach ($bulletina as $bulletin_id) {
		Get_Data("bulletin",$bulletin_id);
		if ($GLOBALS{'bulletin_image'} != "") {
			if (strpos($GLOBALS{'bulletin_image'}, 'Bulletin_') !== false) {
				XHR();
				XPTXT($bulletin_id." ".$GLOBALS{'bulletin_image'}." - <b>Image already in domain_media</b>");
			}
			else {
				XHR();
				XPTXT($bulletin_id." ".$GLOBALS{'bulletin_image'}." - <b>Image requires copy to domain_media</b>");
				$ibits = explode('/',$GLOBALS{'bulletin_image'});
				$endindex = count($ibits)-1;
				$filename = $ibits[$endindex];
				$dirname = $ibits[$endindex-1];
				$fbits = explode('_',$filename);
				$bulletinimage = "Bulletin_".$bulletin_id."_".end($fbits);
				copy($GLOBALS{'domainwwwpath'}.'/'.$dirname.'/'.$filename, $GLOBALS{'domainwwwpath'}."/domain_media/".$bulletinimage);
				XH4("From ".$GLOBALS{'domainwwwpath'}.'/'.$dirname.'/'.$filename);
				XH4("To ".$GLOBALS{'domainwwwpath'}."/domain_media/".$bulletinimage);
				$GLOBALS{'bulletin_image'} = $bulletinimage;
				Write_Data("bulletin",$bulletin_id);
			}
		}
	}
}

function Setup_PHPUTILITY5_Output () {
	XH3("Special PHP Utility Launcher - 5");

	XH2("domainwwwurl - ".$GLOBALS{'domainwwwurl'});
	XH2("domainwwwpath - ".$GLOBALS{'domainwwwpath'});

	$webpagea = Get_Array("webpage");
	foreach ($webpagea as $webpage_name) {
		Get_Data("webpage",$webpage_name);
		if ($GLOBALS{'webpage_oldaddress'} == "") {
			$GLOBALS{'webpage_oldaddress'} = $GLOBALS{'webpage_address'};
		}
		if ($GLOBALS{'webpage_oldhtml'} == "") {
			$GLOBALS{'webpage_oldhtml'} = $GLOBALS{'webpage_html'};
		}
		$GLOBALS{'webpage_html'} = $GLOBALS{'webpage_oldhtml'}; // starting point

		XH2($webpage_name." - ".$GLOBALS{'webpage_oldaddress'});
		// Convert the webpage address
		$abits = explode('/',$GLOBALS{'webpage_oldaddress'});
		$newaddress = end($abits);
		$olddirectory = str_replace($newaddress, "", $GLOBALS{'webpage_oldaddress'});

		XPTXT('directory - '.count($abits)." - ".$olddirectory);
		XPTXT('address truncated from '.$GLOBALS{'webpage_oldaddress'}.' to '.$newaddress);
		$GLOBALS{'webpage_address'} = $newaddress;

		// convert any src references in html

		if (strpos($GLOBALS{'webpage_html'}, 'src=') !== false) {
			$sbits = explode('src=',$GLOBALS{'webpage_html'});
			foreach ($sbits as $sbit) {
				$convertablesrcfound = "0";
				if (strpos($sbit, '"') !== false) {
					$sbit2s = explode('"',$sbit);
					if (($olddirectory != "")&&(strpos($sbit2s[1], $olddirectory) !== false)) {
						XHR();
						// ==== modify the html ===========
						$oldhtmlsrcstring = $sbit2s[1];
						$sbit3s = explode('/',$sbit2s[1]);
						$oldfilename = end($sbit3s);
						$convertablesrcfound = "1";
						XPTXT("convertable src  filename found - ".$oldfilename);
						$newfilename = "Webpage"."_".$webpage_name."_".$oldfilename;
						$newhtmlsrcstring = "domain_media/".$newfilename;
						$GLOBALS{'webpage_html'} = str_replace($oldhtmlsrcstring, $newhtmlsrcstring, $GLOBALS{'webpage_html'});
						XPTXT('html modified from '.$oldhtmlsrcstring.' to '.$newhtmlsrcstring);

						// ==== copy the media ===========
						$from = urldecode($GLOBALS{'domainwwwpath'}.'/'.$olddirectory.$oldfilename);
						$to = urldecode($GLOBALS{'domainwwwpath'}."/domain_media/".$newfilename);
						copy($from, $to);
						XPTXT("From ".$from);
						XPTXT("To ".$to);

					} else {
						XPTXT("non-converted src found - ".$sbit2s[1]);
					}
				}
			}
		}
		Write_Data("webpage",$webpage_name);
	}
}


function Setup_PHPUTILITY6_Output () {
	XH3("Special PHP Utility Launcher - 6");

	$coursea = Get_Array("course");

	foreach ($coursea as $courseid) {
		Get_Data("course",$courseid);
		$GLOBALS{'course_attendeestatuslist'} = "";
		XH1($courseid);
		XH1("Attendees ".$GLOBALS{'course_attendeelist'});
		$courseattendeea = List2Array($GLOBALS{'course_attendeelist'});
		foreach ($courseattendeea as $courseattendeeid) {
			// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
			UpdateCourseAttendeeStatus($courseattendeeid,"","","","");
		}
		XH1("Paid Attendees ".$GLOBALS{'course_attendeepaidlist'});
		$courseattendeepaida = List2Array($GLOBALS{'course_attendeepaidlist'});
		foreach ($courseattendeepaida as $courseattendeepaidid) {
			// $courseattendeeid,$paymenttype,$paymentdue,$paymentreceived,$paymentcomments
			UpdateCourseAttendeeStatus($courseattendeepaidid,"Card",$GLOBALS{'course_charge'},"Yes","");
		}
		Write_Data("course",$courseid);
	}
}

function Setup_PHPUTILITY7_Output () {
	XH3("Special PHP Utility Launcher - 7");
	foreach (Get_Array_Hash("period") as $xperiodid)  {
		XH2("=================== ".$xperiodid." ===================");
		foreach (Get_Array("section",$xperiodid) as $tsection_name) {
			Get_Data("section",$xperiodid,$tsection_name);
			$teama = List2Array($GLOBALS{'section_teams'});
			foreach ($teama as $teamcode) {
				$frsa = Get_Array('frs',$xperiodid,$teamcode);
				foreach ($frsa as $frsid) {
					Get_Data('frs',$xperiodid,$teamcode,$frsid);
					XHR();
						
					if (strlen(strstr($GLOBALS{'frs_date'},"-"))>0) {
						XPTXT($frsid." - date already converted - ".$GLOBALS{'frs_date'});
					}
					else {
						$olddate = $GLOBALS{'frs_date'};
						$newdate = YYbMMbDDtoYYYYsMMsDD($GLOBALS{'frs_date'});
						$GLOBALS{'frs_date'} = $newdate;
						XPTXT('<span style="color:red"><B>'.$frsid." - date converted - ".$olddate." - ".$newdate.'</B></span>');
					}
					if (($GLOBALS{'frs_time'} == "")||($GLOBALS{'frs_time'} == "TBD")) {
						if ($GLOBALS{'frs_time'} == ""){
							XPTXT($frsid." - time is NULL");
						}
						if ($GLOBALS{'frs_time'} == "TBD"){
							XPTXT($frsid." - time is TBD");
						}
					} else {
						if ((strlen(strstr($GLOBALS{'frs_time'},":"))>0)&&(strlen($GLOBALS{'frs_time'}) == 5)) {
							XPTXT($frsid." - time wellformed - ".$GLOBALS{'frs_time'});
						} else {
							$oldtime = $GLOBALS{'frs_time'};
							$newtime = StandardTime ($oldtime);
							$GLOBALS{'frs_time'} = $newtime;
							XPTXT('<span style="color:red"><B>'.$frsid." - time converted - ".$oldtime." - ".$newtime.'</B></span>');
						}
					}
						
					if (($GLOBALS{'frs_ha'} == "A")&&($GLOBALS{'frs_venue'} != "")) {
						$GLOBALS{'frs_awayvenue'} = $GLOBALS{'frs_venue'};
						XPTXT('<span style="color:red"><B>'.$frsid." - ".$GLOBALS{'frs_ha'}." - ".$GLOBALS{'frs_awayvenue'}." updated".'</B></span>');
						$GLOBALS{'frs_venue'} = "";
					}
					else  {
						XPTXT($frsid." - ".$GLOBALS{'frs_ha'}." - ".$GLOBALS{'frs_venue'}." retained");
						$GLOBALS{'frs_awayvenue'} = "";
					}
						
					Write_Data('frs',$xperiodid,$teamcode,$frsid);
				}
			}
		}
	}
}


function Setup_PHPUTILITY8_Output () {
	XH3("Special PHP Utility Launcher - 8");

	$asseta = Get_Array("asset",$GLOBALS{'LOGIN_domain_id'});
	foreach ($asseta as $asset_code) {
	    Get_Data("asset",$GLOBALS{'LOGIN_domain_id'},$asset_code);
		// Old = YYMMDD  New = YYYY-MM-DD
		if (($GLOBALS{'asset_createdate'} != "")&&(strlen($GLOBALS{'asset_createdate'}) != 10)) {
			$existingasset_createdate = $GLOBALS{'asset_createdate'};
			$aca = str_split($existingasset_createdate);
			if ( count($aca) == 6 ) {
				$GLOBALS{'asset_createdate'} = "20".$aca[0].$aca[1]."-".$aca[2].$aca[3]."-".$aca[4].$aca[5];
			} else {
				$GLOBALS{'asset_createdate'} = "";
			}
			if ( $existingasset_createdate == "      " ) {
				$GLOBALS{'asset_createdate'} = "";
			}
			XPTXT(count($aca).'|'.$existingasset_createdate."| => |".$GLOBALS{'asset_createdate'}.'|');
		}
		if (($GLOBALS{'asset_reviewdate'} != "")&&(strlen($GLOBALS{'asset_reviewdate'}) != 10)) {
			$existingasset_reviewdate = $GLOBALS{'asset_reviewdate'};
			$ara = str_split($existingasset_reviewdate);
			if ( count($ara) == 6 ) {
				$GLOBALS{'asset_reviewdate'} = "20".$ara[0].$ara[1]."-".$ara[2].$ara[3]."-".$ara[4].$ara[5];
			} else {
				$GLOBALS{'asset_reviewdate'} = "";
			}
			if ( $existingasset_reviewdate == "      " ) {
				$GLOBALS{'asset_reviewdate'} = "";
			}
			XPTXT(count($ara).'|'.$existingasset_reviewdate."| => |".$GLOBALS{'asset_reviewdate'}.'|');
		}
		Write_Data("asset",$GLOBALS{'LOGIN_domain_id'},$asset_code);
	}
}

function Setup_PHPUTILITY9_Output () {
	XH3("Special PHP Utility Launcher - 9");
	for ($i = 0; $i < 100; $i++) {
	    $codea = PWFLinkCodeGenerate("bbra");
	    
	    $resetlinkcode = $codea[0]; 
	    $resetcode = $codea[1];
	     $resetlinkcodex = $codea[2];
	    $resetcodex = $codea[3];
	    
	    $recreatedresetlinkcode = XCrypt($resetlinkcodex,"bbra","decrypt");
	    $recreatedresetcode = XCrypt($resetcodex,"bbra","decrypt");

	    $resetlinkcodematch = "No"; $resetcodematch = "No";
	    if ($recreatedresetlinkcode == $resetlinkcode) { $resetlinkcodematch = "Yes"; }
	    if ($outkeycode == $keycode) { $resetcodematch = "Yes"; }
	    XTABLE();
	    XTR();XTDTXT("In");XTDTXT($resetlinkcode);XTDTXT($resetlinkcodex);XTDTXT($resetcode);XTDTXT($resetcodex);X_TR();
	    XTR();XTDTXT("Out");XTDTXT($recreatedresetlinkcode);XTDTXT("");XTDTXT($recreatedresetcode);XTDTXT("");X_TR();
	    XTR();XTDTXT("Status");XTDTXT($resetlinkcodematch);XTDTXT("");XTDTXT($resetcodematch);XTDTXT("");X_TR();	    
	    X_TABLE();
	}
}

function Setup_PHPUTILITYA_Output () {
	XH3("Special PHP Utility Launcher - A");
	
	XH3("Domain");
	Get_Data("domain");
	$GLOBALS{'domain_sportid'} = $GLOBALS{'domain_sportid'};
	Write_Data("domain");
	XPTXT($GLOBALS{'domain_id'}." - updated");

	$perioda = Get_Array_Hash("period");
	foreach ($perioda as $periodid) {
		foreach (Get_Array('section',$periodid) as $tsection ) {
			Get_Data('section',$periodid,$tsection);

			$GLOBALS{'section_teams'} = $GLOBALS{'sectionocz_teams'};
			$GLOBALS{'section_resmgrs'} = $GLOBALS{'sectionocz_resmgrs'};
			$GLOBALS{'section_sportid'} = $GLOBALS{'sectionocz_sportid'};			
			$GLOBALS{'section_frs'} = $GLOBALS{'sectionocz_frs'};
			$GLOBALS{'section_seasonstartdate'} = $GLOBALS{'sectionocz_seasonstartdate'};
			$GLOBALS{'section_seasonenddate'} = $GLOBALS{'sectionocz_seasonenddate'};			
			$GLOBALS{'section_showdateavailability'} = $GLOBALS{'sectionocz_showdateavailability'};		
			
			Write_Data('section',$periodid,$tsection);
			XPTXT($periodid." ".$tsection." - updated");
		}	
	}

	$persona = Get_Array('person');
	foreach ($persona as $tperson_id) {
		Get_Data("person",$tperson_id);
	
		$GLOBALS{'person_cwauthority'} = $GLOBALS{'personcw_authority'};
		$GLOBALS{'person_director'} = $GLOBALS{'personcw_director'};
		$GLOBALS{'person_labourtype'} = $GLOBALS{'personcw_labourtype'};
		$GLOBALS{'person_irissubcode'} = $GLOBALS{'personcw_irissubcode'};

		$GLOBALS{'person_playersquad'} = $GLOBALS{'personocz_playersquad'};
		$GLOBALS{'person_officialsquad'} = $GLOBALS{'personocz_officialsquad'};
		$GLOBALS{'person_position'} = $GLOBALS{'personocz_position'};
		$GLOBALS{'person_activeplayer'} = $GLOBALS{'personocz_activeplayer'};
		$GLOBALS{'person_activeofficial'} = $GLOBALS{'personocz_activeofficial'};
		$GLOBALS{'person_publicprofile'} = $GLOBALS{'personocz_publicprofile'};
		$GLOBALS{'person_sponsor'} = $GLOBALS{'personocz_sponsor'};
		$GLOBALS{'person_sponsorlink'} = $GLOBALS{'personocz_sponsorlink'};
		$GLOBALS{'person_team'} = $GLOBALS{'personocz_team'};
		$GLOBALS{'person_dateavailability'} = $GLOBALS{'personocz_dateavailability'};

		Write_Data("person",$tperson_id);
		XPTXT($tperson_id." - updated");
	}
}

function Setup_PHPUTILITYB_Output () {
	XH3("BPMN2 Documenter");
	XFORM("setupbpmn2documenterin.php","");
	XTABLEINVISIBLE();
	XTR();XTDINTEXTAREA("BPMN2SOURCE","","20","50");X_TR();
	XTR();XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
	
}

function Setup_PHPUTILITYC_Output () {
    XH3("DMWS Complexity");
 
    XH3("Step 1: Create Latest Records");
    $dmwssua = Get_Array('dmwssu');
    foreach ($dmwssua as $dmwssu_id) {
        XPTXT("========".$dmwssu_id."=============================");
        Check_Data('dmwssu',$dmwssu_id);
    
        $thiscomplexityvisitid = "";
        Check_Data('dmwscomplexity',$dmwssu_id,"Latest");
        if ($GLOBALS{'IOWARNING'} == "0") {
            $thiscomplexityvisitid = "Latest";
            XPTXTCOLOR($dmwssu_id." Found Latest","green");
        } else {
            $complexityvisita = Get_Array('dmwscomplexity',$dmwssu_id);
            foreach ($complexityvisita as $complexityvisit_id) {
                Check_Data('dmwscomplexity',$dmwssu_id,$complexityvisit_id);              
                if ( $GLOBALS{'dmwscomplexity_score'} > 0) {
                    $thiscomplexityvisitid = $complexityvisit_id;
                    XPTXT($dmwssu_id." ".$complexityvisit_id." ".$GLOBALS{'dmwscomplexity_score'});
                } else {
                    XPTXT($dmwssu_id." ".$complexityvisit_id." Zero Score");
                    
                }
            }
        }
        if (($thiscomplexityvisitid != "Latest")&&($thiscomplexityvisitid != "")) {
            Get_Data('dmwscomplexity',$dmwssu_id,$thiscomplexityvisitid);
            if ($GLOBALS{'dmwscomplexity_score'} > 0) {
                Write_Data('dmwscomplexity',$dmwssu_id,"Latest");
                XPTXTCOLOR($dmwssu_id." Create Latest From ".$thiscomplexityvisitid." ".$GLOBALS{'dmwscomplexity_score'},"green");
            } else {
                XPTXTCOLOR($dmwssu_id." Cannot Create Latest From ".$thiscomplexityvisitid." ".$GLOBALS{'dmwscomplexity_score'},"red");
            }
        }
    }
    
    XH3("Step 1: Delete Redundant Records");
    $dmwssua = Get_Array('dmwssu');
    foreach ($dmwssua as $dmwssu_id) {
        XPTXT("========".$dmwssu_id."=============================");
        Check_Data('dmwssu',$dmwssu_id);        
        $complexityvisita = Get_Array('dmwscomplexity',$dmwssu_id);
        foreach ($complexityvisita as $complexityvisit_id) {
            if ( $complexityvisit_id != "Latest") {
                Get_Data('dmwscomplexity',$dmwssu_id,$complexityvisit_id);
                Delete_Data('dmwscomplexity',$dmwssu_id,$complexityvisit_id);
                if ($GLOBALS{'dmwscomplexity_score'} > 0) {
                    XPTXTCOLOR($dmwssu_id." ".$complexityvisit_id." Deleted","red");
                } else {
                    XPTXTCOLOR($dmwssu_id." ".$complexityvisit_id." Deleted - Zero Score","red");
                }
            } else {
                XPTXTCOLOR($dmwssu_id." ".$complexityvisit_id." Kept","green");
            }
        }
    }
}

function Setup_PHPUTILITYD_Output () {
    XH3("Webpage - Editor to Composer");
    
    $webpagea = Get_Array("webpage");
    foreach ($webpagea as $webpage_name) {
        Get_Data("webpage",$webpage_name);
        XH2($webpage_name);
        $GLOBALS{'webpage_oldhtml'} = $GLOBALS{'webpage_html'}; // Backup
        if ($GLOBALS{'webpage_templatename'} == "") {
            $GLOBALS{'webpage_templatename'} = "Default";
            XPTXT("Template set to Default");
        }
        if (strlen(strstr($GLOBALS{'webpage_html'},"<!-- FSSTART_"))>0) {            
            XPTXT("Already in Composer Mode");
        } else {
            $prehtml = '<!-- FSSTART_1 -->'."\n";
            $prehtml =  $prehtml.'<span id="fstitle_1" class="fstitle" style="color:navy">Formatted Section - 1 ( Type[TextColumns], Header[No], BackgroundColor[White], Cols[1], PaddingTop[0], PaddingBottom[0] )</span>'."\n";
            $prehtml =  $prehtml.'<!-- /FSSTART -->'."\n";
            $prehtml =  $prehtml.'<!-- Start TextColumns_1 -->'."\n";
            $prehtml =  $prehtml.'<div class="row">'."\n";
            $prehtml =  $prehtml.'<div class="col-md-12">'."\n";
            $prehtml =  $prehtml.'<div class="editabletextarea" style="color: rgb(0, 0, 0);">'."\n";
            
            $posthtml = '</div>'."\n";
            $posthtml = $posthtml.'</div>'."\n";
            $posthtml = $posthtml.'</div>'."\n";
            $posthtml = $posthtml.'<!-- End TextColumns_1 -->'."\n";
            $posthtml = $posthtml.'<!-- FSEND_1 -->'."\n";
            $posthtml = $posthtml.'<!-- /FSEND -->'."\n";
            
            $GLOBALS{'webpage_html'} = $prehtml.$GLOBALS{'webpage_html'}.$posthtml;
            XPTXT("Converted to Composer Mode");
        }
        Write_Data("webpage",$webpage_name);
    }
}

function Setup_PHPUTILITYE_Output () {
    if (($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {        
        XH3("Create ServiceEnabled Table");
        Check_Data("serviceenabled");
        if ($GLOBALS{'IOWARNING'} == "0") {
            XPTXTCOLOR("serviceenabled Table already exists","green");
        } else {           
            Initialise_Data("serviceenabled");
            Write_Data("serviceenabled");
            XPTXTCOLOR("Creation of serviceenabled Table Completed","green");           
        }
    }
}


function Setup_PHPUTILITYF_Output () {

XH1("Speech Recognition Test");
XBR();

print '<img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />';
XBR();
XINTEXTAREAID("transcript","q","","15","100"); 
XPTXT("Output");
XINTEXTAREAID("output","output","","15","100"); 

}

function Setup_PHPUTILITYG_CSSJS () {
    $GLOBALS{'SITEJSOPTIONAL'} = "speechtotext"; 
}

function Setup_PHPUTILITYG_Output () {
    
    XH1("Speech Recognition Test");
    XBR();
    
    XHR();
    BROW();
    BCOL("3");
    BINSUBMITNAMESPECIALICON ("SpeechStart","success","Start","microphone");
    BINSUBMITNAMESPECIALICON ("SpeechStop","danger","Stop","microphone-slash");
    XBR();
    XBR();
    BINTXTID("SpeechIn","SpeechIn","");
    B_COL();
    BCOLTXT("","6");
    BCOL("2");
    BIMGID("synchronise","../site_assets/North.gif","100");
    B_COL();
    B_ROW();
    XHR();
    BROW();
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("GOAL","1","gray","white");
    BCOLTXTCOLOR("LINE","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    B_ROW();
    for ($yi=1; $yi<=11; $yi++) {
        BROW();
        BCOLTXTCOLOR("","1","gray","white");
        for ($xi=1; $xi<=8; $xi++) {
            BCOLTXT("&nbsp;","1");
        }
        BCOLTXTCOLOR("","1","gray","white");
        B_ROW();        
        BROW();
        BCOLTXTCOLOR("","1","gray","white");
        for ($xi=1; $xi<=8; $xi++) {
            BCOLTXT($yi.".".$xi.".xxx","1");
        }
        BCOLTXTCOLOR("","1","gray","white");
        B_ROW();
        BROW();
        BCOLTXTCOLOR("","1","gray","white");
        for ($xi=1; $xi<=8; $xi++) {
            $ys = substr(("0000".(string) $yi), -2);
            $xs = substr(("0000".(string) $xi), -2);
            $gridyxs = $ys."-".$xs;
            BCOLINTXTID($gridyxs,$gridyxs,"","1");
        }
        BCOLTXTCOLOR("","1","gray","white");
        B_ROW();
    }
    BROW();
    BCOLTXTCOLOR("","1","gray","white");
    for ($xi=1; $xi<=8; $xi++) {
        BCOLTXT("&nbsp;","1");
    }
    BCOLTXTCOLOR("","1","gray","white");
    B_ROW();   
    BROW();
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("GOAL","1","gray","white");
    BCOLTXTCOLOR("LINE","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    BCOLTXTCOLOR("","1","gray","white");
    B_ROW();
}

function Setup_PHPUTILITYH_Output () {
    XH3("Asset Converter");
    $asseta = Get_Array("asset","");
    $assetfound = "0";
    foreach ($asseta as $asset_code) {
        Get_Data("asset","",$asset_code);
        XPTXT($GLOBALS{'asset_title'}."Converted");
        Write_Data("asset",$GLOBALS{'LOGIN_domain_id'},$asset_code);
        Delete_Data("asset","",$asset_code);
        $assetfound = "1";
    }
    if ( $assetfound == "0" ) { XPTXT("No assets found to convert"); }
}

function Setup_PHPUTILITYI_Output () {
    XH3("Accreditation Converter");

    /*
    $nkeya = Get_NKey_Array('accredcriteria');
    foreach ($nkeya as $nkey) {       
        $ka = explode('|',$nkey);
        Get_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        $thisaccredcriteria_id = $ka[2];
        if ($GLOBALS{'accredcriteria_type'} == "section") {
            XPTXT($ka[0]." ".$ka[1]);
        }
        if ($GLOBALS{'accredcriteria_type'} == "evidence") {
            if (strlen(strstr($thisaccredcriteria_id,"e0"))>0) {} else {  // already done              
                if (strlen(strstr($thisaccredcriteria_id,"_a"))>0) {
                    $newaccredcriteria_id = str_replace("_a","_e01",$thisaccredcriteria_id);
                }
                if (strlen(strstr($thisaccredcriteria_id,"_b"))>0) {
                    $newaccredcriteria_id = str_replace("_b","_e02",$thisaccredcriteria_id);
                }
                if (strlen(strstr($thisaccredcriteria_id,"_c"))>0) {
                    $newaccredcriteria_id = str_replace("_c","_e03",$thisaccredcriteria_id);
                }
                if (strlen(strstr($thisaccredcriteria_id,"_e1"))>0) {
                    $newaccredcriteria_id = str_replace("_e1","_e01",$thisaccredcriteria_id);
                }
                
                XPTXTCOLOR($newaccredcriteria_id." <= ".$thisaccredcriteria_id,"orange");
                $lastevidenceaccredcriteria_id = $newaccredcriteria_id;
                Write_Data("accredcriteria",$ka[0],$ka[1],$newaccredcriteria_id);
                Delete_Data("accredcriteria",$ka[0],$ka[1],$thisaccredcriteria_id);
                
                
            }
        }
        if ($GLOBALS{'accredcriteria_type'} == "data") {
            if (strlen(strstr($thisaccredcriteria_id,"e"))>0) {} else {  // already done
                $ibits = explode('_',$thisaccredcriteria_id);
                $istring = end($ibits);
                if (strlen($istring) == 2) {
                    $istring = str_replace("i","i0",$istring);
                }
                $newaccredcriteria_id = $lastevidenceaccredcriteria_id."_".$istring;
                XPTXTCOLOR($newaccredcriteria_id." <= ".$thisaccredcriteria_id,"blue");
                Write_Data("accredcriteria",$ka[0],$ka[1],$newaccredcriteria_id);
                Delete_Data("accredcriteria",$ka[0],$ka[1],$thisaccredcriteria_id);
            }
        }
        
    }
    */
    
    $nkeya = Get_NKey_Array('accredcriteria');
    foreach ($nkeya as $nkey) {       
        $ka = explode('|',$nkey);
        Get_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        
        $thisaccredcriteria_id = $ka[2];
        if ($GLOBALS{'accredcriteria_type'} == "data") {
            XPTXTCOLOR($ka[0]." ".$ka[1]." | ".$GLOBALS{'accredcriteria_dataradioquestions'}." | ".$GLOBALS{'accredcriteria_datatextquestion'},"green");
            if ($GLOBALS{'accredcriteria_dataradioquestions'} != "") {
                $GLOBALS{'accredcriteria_dataquestiontype'} = "Radio";
                XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." updated type = Radio","blue");     
                if ($GLOBALS{'accredcriteria_datatextquestion'} != "") {
                    $GLOBALS{'accredcriteria_datatextquestion'} = "";
                    XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." text reset","red"); 
                } 
            } else {
                if ($GLOBALS{'accredcriteria_datatextquestion'} != "") {
                    $GLOBALS{'accredcriteria_dataquestiontype'} = "Text";
                    XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." updated type = Text","blue");     
                }   
            }
            Write_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
        }
        
        if ($GLOBALS{'accredcriteria_ref'} == "1.1") {
             if (substr($thisaccredcriteria_id,0,7) == "a_01_10") {
                $GLOBALS{'accredcriteria_ref'} = "1.10";
                XPTXTCOLOR($ka[0]." ".$thisaccredcriteria_id." Corrected Ref to ".$GLOBALS{'accredcriteria_ref'},"orange"); 
                Write_Data("accredcriteria",$ka[0],$ka[1],$ka[2]);
             }
        }
    }    
    
    
}

function Setup_PHPUTILITYJ_CSSJS () {
}

function Setup_PHPUTILITYJ_Output () {   
    $LF=chr(10);
    $ggla = Array("A","B","C","D","E","F","G","H");
    foreach ($ggla as $ggl) {
        XH1($ggl);
        $ida = Get_Array("accredcriteria","FAGroundGrading".$ggl,"sfm");
        foreach ($ida as $accredcriteria_id) {
            Get_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
            if ($GLOBALS{"accredcriteria_type"} == "criteria") {	
                $ca = str_split($GLOBALS{"accredcriteria_criteria"});
                XHR();
                XPTXT(Replace_CRandLF($GLOBALS{'accredcriteria_criteria'},"<br>"));
                XHR();
                $outca = "";
                $prevcac = ".";
                foreach ($ca as $cac) {
                    if ($cac == $LF) {
                        if ($prevcac == ".") { $outca = $outca.$LF.$LF;  }
                        else {$outca = $outca." ";}
                    } else {
                        $outca = $outca.$cac;
                    }
                    $prevcac = $cac;
                }
                $GLOBALS{"accredcriteria_criteria"} = $outca;
                XPTXTCOLOR(Replace_CRandLF($GLOBALS{"accredcriteria_criteria"},"<br>"),"navy");
                Write_Data("accredcriteria","FAGroundGrading".$ggl,"sfm",$accredcriteria_id);
            }                  
        }
    }
}

function Setup_SQLMAINTAIN_Output1 () {
	XH3("SQL Database Maintenance");
	XPTXT("This action will re-apply the latest SQL structure to the site.");
	XBR();
	XFORM("setupsqlmaintainout.php","");
	XH5("Decide whether to preview the results before finalising.");
	XTABLEINVISIBLE();
	XTR();XTDINRADIO("TestorReal","T","checked","Test Mode - view proposed updates");X_TR();
	XTR();XTDINRADIO("TestorReal","R","","Real Mode - make updates permanent");X_TR();
	XTR();XTDTXT("&nbsp;");X_TR();
	XTR();XTD();XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");X_TD();X_TR();
	XTR();XTDTXT("&nbsp;");X_TR();
	XTR();XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
}

function Setup_SQLMAINTAIN_Output2 ($testorreal,$extendedtrace) {
	if ($testorreal == "T") { $tortext = "Test Mode"; }
	if ($testorreal == "R") { $tortext = "Real Mode"; }
	XH3("SQL Database Maintenance - ".$tortext);
	# print "SQL_Maintain Called<br>\n";
	#     0     1                         2                     3     4    5    6     7      8        9
	# datatype seq structureheader/structurefield/structureend Field Type Null Key Default Extra OldField
	$existingsql = array(); $existingtables = array();
	$tobesql = array(); $tobetables = array();
	
	$b50 = "                                                  ";
	$sqlupdatesmade = "0";
	# Get tobe SQL tables info
	#                       0                        1       2    3    4    5     6      7      8     9
	# structureheader/structurefield/structureend datatype Field Type Null Key Default Extra OldField s1 s2 etc
	$fullfilename = "../site_sql/sqldesign.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	// XH3("SQL Database Maintenance - ".$fullfilename." size - ".sizeof($records));
	foreach ($records as $recordelement) {
		$upmessage = CSV_In_Filter($recordelement);
		// XPTXT($upmessage);
		# end of the tidy up
		$uploadcsv = explode("|",$upmessage);
		$forthisservice = "0";
	
		if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
		else { $serviceid = $GLOBALS{'LOGIN_service_id'}; }
		for ($idb = 9; $idb < 21; $idb++) { 
			if ( $uploadcsv[$idb] == $serviceid ) { $forthisservice = "1"; }
		}
		$tablearrayelement50 = substr($uploadcsv[1].$b50,0,50);
		$field50 = substr($uploadcsv[2].$b50,0,50);
		$controlfield50 = substr($uploadcsv[8].$b50,0,50);
		if ($forthisservice == "1") {
			if ($uploadcsv[0] == "structureheader") {
	   			$seq = 0;
	   			$tsqlstring = $tablearrayelement50."|0000|structureheader||||||||";
	   			array_push($tobesql, $tsqlstring); $seq++;
	   			array_push($tobetables, $uploadcsv[1]);
			}
			if ($uploadcsv[0] == "structurefield") {
				$tsqlstring = $tablearrayelement50."|1".substr("000".$seq,-3,3)."|structurefield|".$field50."|".$uploadcsv[3]."|".$uploadcsv[4]."|".$uploadcsv[5]."|".$uploadcsv[6]."|".$uploadcsv[7]."|".$controlfield50;
				array_push($tobesql, $tsqlstring); $seq++;
	
			}
			if ($uploadcsv[0] == "structureend") {
				$tsqlstring = $tablearrayelement50."|2000|structureend||||||||";
				array_push($tobesql, $tsqlstring); $seq++;
			}
		}
	}
	
	sort ($tobesql);
	// foreach ($tobesql as $recordelement) { print"<P>TOBESQL $recordelement|\n"; }
	# Get existing SQL tables info
	$tablearray = array();
	$q = 'SHOW TABLES';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { array_push($tablearray, $row[0]); }
	}
	foreach ($tablearray as $tablearrayelement) {
		$tablearrayelement50 = substr($tablearrayelement.$b50,0,50);
		$seq = 0;
		$tsqlstring = $tablearrayelement50."|0000|structureheader||||||||";
		array_push($existingsql, $tsqlstring); $seq++;
		array_push($existingtables, $tablearrayelement);
		$colarray = array();
		$q = 'SHOW COLUMNS FROM '.$tablearrayelement;
		$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	 	# Field Type Null Key Default Extra
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				$field50 = substr($row[0].$b50,0,50);
				$tsqlstring = $tablearrayelement50."|1".substr("000".$seq,-3,3)."|structurefield|".$field50."|".$row[1]."|".$row[2]."|".$row[3]."|".$row[4]."|".$row[5]."|";
				array_push($existingsql, $tsqlstring); $seq++;
			}
		}
		$tsqlstring = $tablearrayelement50."|2000|structureend||||||||";
		array_push($existingsql, $tsqlstring); $seq++;
	}
	sort ($existingsql);
	# foreach ($existingsql as $recordelement) { print"<P>EXISTINGSQL $recordelement|\n"; }
	#     0     1                         2                     3     4    5    6     7      8        9
	# datatype seq structureheader/structurefield/structureend Field Type Null Key Default Extra ADD/CHANGE
	$tmaxi = sizeof($tobesql)-1; 
	$emaxi = sizeof($existingsql)-1;
	
	foreach ($existingtables as $existingtable) {
		if (in_array($existingtable, $tobetables)) {} else {
		    // XPTXTCOLOR('Existing Table "'.$existingtable.'" is now redundant and has been deleted.',"orange");
		    TORSQLCMD ($testorreal,"DROP TABLE ".$existingtable.";");
		    $sqlupdatesmade = "1";
		    $newexistingsql = Array();
		    foreach ($existingsql as $tsqlstring) {
		        $eka = explode ("|",$tsqlstring);
		        $edatatype = str_replace(" ", "", $eka[0]);
		        if ( $edatatype != $existingtable ) { array_push($newexistingsql, $tsqlstring); }
		        // else {XPTXTCOLOR('Dropped Line "'.$existingtable,"orange");}
		    }
		    $existingsql = $newexistingsql;
		}
	}
	
	# print "<BR>TOMAXI ".$tmaxi;
	$more = "1"; $ti = 0;$ei = 0;
	$oldtfield = "";
	$counter = 0;
	$updatetablepka = array();
	while (($more == "1")&&($counter <= 10000)) {
		$counter++;
		# print "<BR>TOBESQL ".$tmaxi." ".$ti." ".$tobesql[$ti];
		$tka = explode ("|",$tobesql[$ti]);
		$tk = $tka[0]." ".$tka[2]." ".$tka[3];
		$tdatatype = str_replace(" ", "", $tka[0]);
		$tfield = str_replace(" ", "", $tka[3]);
		$eka = explode ("|",$existingsql[$ei]);
		$ek = $eka[0]." ".$eka[2]." ".$eka[3];
		$edatatype = str_replace(" ", "", $eka[0]);
		$efield = str_replace(" ", "", $eka[3]);
		$controlfield = str_replace(" ", "", $tka[9]);
	 	# if ($controlfield == "") {$controlfield = "ADD";} 
		if ( $extendedtrace == "Yes" ) { print "<hr>TRACE - KEY MATCH  -----"."   TK= ".$tk." ".$controlfield."   EK= ".$ek."\n"; }   
	    if ($tk == $ek) {  
			# simple update to existing field characteristics ===========================================
	        if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - SIMPLE UPDATE TO EXISTING FIELD\n"; }   
			$temps=$eka[4]; 
			if (strlen(strstr($temps,"varchar"))>0) {
				$eka[4]=str_replace("varchar","char",$temps);
			}
		    $temps=$eka[5]; if (($eka[2]=="structurefield")&&($temps == "")) { $eka[5]="NO"; }
		    if ( $extendedtrace == "Yes" ) { print "<br>..TRACE - NO CHANGE - ".$tka[0]." ".$tka[1]." ".$tka[2]." ".$tka[3]." ".$tka[4]." ".$tka[5]." ".$tka[6]." ".$tka[7]." ".$tka[8]." ".""; }
			if ($tka[4].$tka[5].$tka[6].$tka[7].$tka[8] != $eka[4].$eka[5].$eka[6].$eka[7].$eka[8]) {
				XBR();
				XTXT($tobesql[$ti]." - Target");XBR();
				XTXT($existingsql[$ei]." - Existing");XBR();
		   		XTXT($tka[4].$tka[5].$tka[6].$tka[7].$tka[8]." - Target");XBR();  
				XTXT($eka[4].$eka[5].$eka[6].$eka[7].$eka[8]." - Existing");XBR();
				if ($tka[5] == "NO") { $nullfield = "NOT NULL"; } else { $nullfield = ""; }
				TORSQLCMD ($testorreal,"ALTER TABLE ".$tdatatype." MODIFY COLUMN ".$tfield. " ".$tka[4]." ".$nullfield." ;");$sqlupdatesmade = "1";
				if ($tka[6] == "PRI") {
					if (in_array($tdatatype, $updatetablepka)) { } else { array_push($updatetablepka, $tdatatype); }
				}
			}
			$oldtfield = $tfield;
			$ti++;$ei++;
		} else {
		    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - DATATYPE MATCH  -----"."   TD= ".$tdatatype." "."   ED= ".$edatatype."\n"; }    
  			if ($tdatatype == $edatatype) {
  			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - SAME DATATYPE ".$controlfield."\n"; }
	   			if ($controlfield != "") {
	   			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - ADD/CHANGE\n"; }
					if ($controlfield == "ADD") {
						# add field in existing table
						XBR();
						if ($tka[5] == "NO") { $nullfield = "NOT NULL"; } else {$nullfield = ""; }
						TORSQLCMD ($testorreal,"ALTER TABLE ".$tdatatype." ADD COLUMN ".$tfield." ".$tka[4]." ".$nullfield." AFTER ".$oldtfield.";");$sqlupdatesmade = "1";
						if ($tka[6] == "PRI") {
							if (in_array($tdatatype, $updatetablepka)) { } else { array_push($updatetablepka, $tdatatype); }
						}
						$oldtfield = $tfield;
						$ti++;
					} else { # field name change in existing table
						XBR();
						TORSQLCMD ($testorreal,"ALTER TABLE ".$tdatatype." CHANGE ".$controlfield." ".$tfield. " ".$tka[4].";");$sqlupdatesmade = "1";
		     			$oldtfield = $tfield;        
						$ti++;$ei++;
		    		} 	
				}
	   			else { # delete field in existing table
	   			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - DELETE\n"; }
					XBR();
					TORSQLCMD ($testorreal,"ALTER TABLE ".$edatatype." DROP COLUMN ".$efield.";");$sqlupdatesmade = "1";
					if ($eka[5] == "NO") {
	     				if (in_array($tdatatype, $updatetablepka)) { } else { array_push($updatetablepka, $tdatatype); }
					}
					$ei++;
				}
			}
			if ($tdatatype != $edatatype) {		
			    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - DIFFERENT DATATYPE ".$controlfield."\n"; }
				if ($tdatatype > $edatatype) {
					XH2("Should never happen - ".$edatatype);		
				}
				if ($tdatatype < $edatatype) {				
					# add new table ===========================================
					if ($tka[2] == "structureheader") {
					    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - CREATE TABLE (Start) ".$controlfield."\n"; }      	
						$createstring = "CREATE TABLE ".$tdatatype." (";
		    			$primarykeystring = ""; $pksep = "";	
		   			}   	
					if ($tka[2] == "structurefield") {
					    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE -   ".$controlfield."\n"; }
			    		if ($tka[5] == "NO") { $nullfield = "NOT NULL"; } else {$nullfield = ""; }
			    		$createstring .= $tfield." ".$tka[4]." ".$nullfield." ".$tka[8].",";
						if ($tka[6] == "PRI") {
							$primarykeystring = $primarykeystring.$pksep.$tfield;
							$pksep = ",";
						}								
					}
				}
				if ($tka[2] == "structureend") {
				    if ( $extendedtrace == "Yes" ) { print "<BR>..TRACE - CREATE TABLE (End) ".$controlfield."\n"; }
					$createstring .= "PRIMARY KEY (".$primarykeystring."));";
		    		XBR(); 
					TORSQLCMD ($testorreal,$createstring); $sqlupdatesmade = "1";$sqlupdatesmade = "1";
				}
				$oldtfield = $tfield;
				$ti++;
  			}   	    
		}
		if ($ti == $tmaxi) { $more = "0"; }
	}
	if (empty($updatetablepka)) { } else {XH5("Primary Key Maintenance Required"); }
	foreach ($updatetablepka as $updatetablepk) {
 		$primarykeystring = ""; $pksep = "";	
		$q = 'SHOW COLUMNS FROM '.$updatetablepk;
		$r = mysqli_query($GLOBALS{'IOSQL'},$q);
 		# Field Type Null Key Default Extr
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[2] == "NO") {
					$primarykeystring = $primarykeystring.$pksep.$row[0]; $pksep = ",";
				}
			}
		}
		TORSQLCMD ($testorreal,"ALTER TABLE ".$updatetablepk." DROP PRIMARY KEY;");
 		TORSQLCMD ($testorreal,"ALTER TABLE ".$updatetablepk." ADD PRIMARY KEY (".$primarykeystring.");"); 
	}
	if ($sqlupdatesmade != "1") {
		XH5("No Changes Required");
	}
}

function TORSQLCMD ($testorreal,$query) {
	if ($testorreal == "T") {
		XPTXTCOLOR($query,"green");
	}
	if ($testorreal == "R") {
	    XPTXTCOLOR($query,"green");IOSQLCMD($query);
	}
}

function Setup_SQLBACKUP_Output () {
   XH3("Manual Backup");
   Backup_Domain ();
   XPTXTCOLOR("Backup Successfully Created","green");
}

function Setup_SQLDUMPRECOVER_Output1 () {
    XH3("Recover Data from SQL Backup");
    XPTXT("This tool reads an SQL backup and generates a csv file that can be reimported into the site.");
    XPTXT("It is useful when partial recovery of information is required.");
    $helplink = "Setup/Setup_UPLOAD_Output/setup_upload_output.html"; Help_Link;
    XFORMUPLOAD("setupsqlbackuprecoverin.php","sqlbackuprecover");
    XINSTDHID();
    XPTXT("SQL Backup (in gz or sql format):-");
    XINFILE("file","10000000") ;XBR();XBR();
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
}

function Setup_FRSPERSONSTATTYPES_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Setup_FRSPERSONSTATTYPES_Output() {
	$parm0 = "Match Stat Types - ".$GLOBALS{'currperiodid'}."|frspersonstattype[rootkey=".$GLOBALS{'currperiodid'}."]|section[rootkey=".$GLOBALS{'currperiodid'}."]|frspersonstattype_code|frspersonstattype_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."frspersonstattype_code|Yes|Id|60|Yes|Match Stat Id|KeyText,2,2^";
	$parm1 = $parm1."frspersonstattype_title|No||60|Yes|Header Title|InputText,30,60^";
	$parm1 = $parm1."frspersonstattype_name|Yes|Description|200|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."frspersonstattype_values|No||60|Yes|Code Values|InputSelectFromList,Numeric+Checkbox^";
	$parm1 = $parm1."frspersonstattype_msdisplay|Yes|Display|60|Yes|Display on Match Stats|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."frspersonstattype_mscount|Yes|Max|60|Yes|Match Stats Display Max|InputText,2,2^";
	$parm1 = $parm1."frspersonstattype_mrdisplay|No||60|Yes|Display on Match Results|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."frspersonstattype_playoff|No||60|Yes|Player/Official|InputSelectFromList,P+O^";
	$parm1 = $parm1."frspersonstattype_sectionlist|Yes|Section|150|Yes|Section|InputCheckboxFromTable,section,section_name,section_name,section_seq^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Setup_EMAIL_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_EMAIL_Output() {
	$parm0 = "EMail Style|emailstyle||emailstyle_name|emailstyle_name|25|No";
	$parm1 = "";
	$parm1 = $parm1."emailstyle_name|Yes|Name|60|Yes|Name|KeyText,25,25^";
	$parm1 = $parm1."emailstyle_fontface|No||60|Yes|Font Face|InputSelectFromList,Arial+Times New Roman^";
	$parm1 = $parm1."emailstyle_fontsize|No||60|Yes|Font Size|InputSelectFromList,8px+10px+12px+14px+16px^";
	$parm1 = $parm1."emailstyle_fontcolor|No||60|Yes|Font Colour|InputSelectFromList,Black+Blue+Gray+Navy^";
	$parm1 = $parm1."emailstyle_hfontface|No||60|Yes|Header Font Face|InputSelectFromList,Arial+Times New Roman^";
	$parm1 = $parm1."emailstyle_hfontsize|No||60|Yes|Header Font Size|InputSelectFromList,8px+10px+12px+14px+16px+18px+20px+22px^";
	$parm1 = $parm1."emailstyle_hfontcolor|No||60|Yes|Header Font Colour|InputSelectFromList,Black+Blue+Gray+Navy^";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {
		$bannerurlbase = "GLOBALSITEWWWURL";
	} else { $bannerurlbase = "GLOBALDOMAINWWWURL";
	}
	$bannerurldir = $bannerurlbase."/domain_style";
	if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {
		$bannerfilebase = "GLOBALSITEWWWPATH";
	} else { $bannerfilebase = "GLOBALDOMAINWWWPATH";
	}
	$bannerfiledir = $bannerfilebase."/domain_style";
	$parm1 = $parm1."emailstyle_headerimage|No||60|Yes|Header Image - 500x50|InputImage,$bannerurldir,$bannerfiledir,500,50,EmailHeaderImage,emailstyle_headerimage^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Setup_LIBRARYSECTION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jquerynestable";
    $GLOBALS{'SITEJSOPTIONAL'} = "jquerynestable,jqueryconfirm,globalroutines,librarysectionupdate";
    $GLOBALS{'SITEPOPUPHTML'} = "LibrarySection_Popup";
}

function Setup_LIBRARYSECTION_Output() {
    
    $librarysectiona = Get_Array("librarysection");
    $librarysectiontemparray = Array();
    foreach ( $librarysectiona as $librarysection_id ) {
        Get_Data("librarysection",$librarysection_id);
        $liblevela = explode('/',$GLOBALS{'librarysection_sequence'});
        $liblevel = count($liblevela);
        $arrayelement = $GLOBALS{'librarysection_sequence'}."#".$librarysection_id."#".$liblevel;
        array_push($librarysectiontemparray, $arrayelement);
    }
    sort ($librarysectiontemparray);
    
    XH2('Library Structure');
    XPTXT("Drag and Drop the folder items until you get the structure you require.");
    XHRCLASS("underline");
    $oldlibrarysection_level = 0;
    $nid = 0;
    XNESTCONTAINER();
    foreach ($librarysectiontemparray as $arrayelement) {
        // print("========= ".$arrayelement."<br>");
        $mibit3s = explode("#",$arrayelement);
        $librarysection_id = $mibit3s[1];
        $librarysection_level = intval($mibit3s[2]);
        Get_Data("librarysection",$librarysection_id);
        
        if (($librarysection_level - $oldlibrarysection_level) > 0) {
            // Open First in new list
            XNESTOL();
            $nid++;
            XNESTLIBSECTIONLI($nid,$GLOBALS{'librarysection_id'},$GLOBALS{'librarysection_title'},$GLOBALS{'librarysection_hide'},$GLOBALS{'librarysection_security'});
            XNESTLIBSECTIONITEM($nid,$GLOBALS{'librarysection_title'});
        }
        if (($librarysection_level - $oldlibrarysection_level) == 0) {
            // Continue list
            X_NESTLI();
            $nid++;
            XNESTLIBSECTIONLI($nid,$GLOBALS{'librarysection_id'},$GLOBALS{'librarysection_title'},$GLOBALS{'librarysection_hide'},$GLOBALS{'librarysection_security'});
            XNESTLIBSECTIONITEM($nid,$GLOBALS{'librarysection_title'});
        }
        if (($librarysection_level - $oldlibrarysection_level) < 0) {
            // End Old list and Open First in new list
            X_NESTLI();
            X_NESTOL();
            X_NESTLI();
            $nid++;
            XNESTLIBSECTIONLI($nid,$GLOBALS{'librarysection_id'},$GLOBALS{'librarysection_title'},$GLOBALS{'librarysection_hide'},$GLOBALS{'librarysection_security'});
            XNESTLIBSECTIONITEM($nid,$GLOBALS{'librarysection_title'});
        }
        $oldlibrarysection_level = $librarysection_level;
    }
    // End nestings
    X_NESTLI();
    X_NESTOL();
    X_NESTCONTAINER ();
    XBR();
    XINBUTTONIDSPECIAL ("librarysection-add","success","Add New Library Folder.");
    XBR();
    XFORM("librarysectionupdatein.php","librarysectionupdatein");
    XINSTDHID();
    XHRCLASS("underline");
    XBR();
    // print '<textarea class="form-control" id="json_outputview" rows="5"></textarea>'."\n";
    XINHIDID("json_output","json_output","");
    XBR();
    XINSUBMIT ("Update Library Structure");
    X_FORM();
}

function LibrarySection_Popup () {
    XDIVPOPUP("librarysectionpopup","Menu Item");
    XINHIDID("nid","nid","");
    XINHIDID("LibrarySectionId","LibrarySectionId","");
    XDIV("LibrarySectionTitleDiv","librarysectiontitlediv");
    XH3("Title");
    XINTXTID("LibrarySectionTitle","LibrarySectionTitle","","25","50");
    X_DIV("LibrarySectionTitleDiv");
    XDIV("LibrarySectionEditorDiv","librarysectioneditordiv");
    XH3("Display");
    XINSELECTHASH (List2Hash("Display,Hide"),"LibrarySectionHide","");
    X_DIV("LibrarySectionHideDiv");
    XDIV("LibrarySectionSecurityDiv","librarysectionsecuritydiv");
    XH3("Visibility");
    $listk = "0,1,2,3";
    $listv = "Public,Internal only,Committee only,Personal or Welfare Only";
    XINSELECTHASH (Lists2Hash($listk,$listv),"LibrarySectionSecurity","");
    X_DIV("LibrarySectionSecurityDiv");
    XBR();
    XINBUTTONIDSPECIAL("librarysectionupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("librarysectioncancelbutton","warning","Cancel");
    XBR();
    X_DIV("librarysectionpopup");
}

function Setup_ACCREDSCHEME_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ACCREDSCHEME_Output() {
    $parm0 = "";
    $parm0 = $parm0."Accreditation Schemes|"; # pagetitle
    $parm0 = $parm0."accredscheme|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."accredscheme_id|"; # keyfieldname
    $parm0 = $parm0."accredscheme_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."accredscheme_id|Yes|Id|60|Yes|Id|KeyText,15,25-^";
    $parm1 = $parm1."accredscheme_name|Yes|Name|60|Yes|Name|InputText,30,60^";
    $parm1 = $parm1."accredscheme_version|Yes|Version|60|Yes|Version|InputText,5,10^";
    $parm1 = $parm1."accredscheme_authority|Yes|Authority|60|Yes|Authority|InputText,30,60^";
    $parm1 = $parm1."accredscheme_weblink||||Yes|Webpage|InputText,50,100^";
    $parm1 = $parm1."accredscheme_logolink||||Yes|Logo|InputText,50,100^";
    $parm1 = $parm1."accredscheme_active|Yes|Active|60|Yes|Active|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."accredscheme_ownerenabled||||Yes|Owner Enabled|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."accredscheme_reviewenabled||||Yes|Review Enabled|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."accredscheme_inspectionenabled||||Yes|Inspection Enabled|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."accredscheme_clubconditionenabled||||Yes|Condition Enabled|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."accredscheme_helpenabled||||Yes|Help Links Enabled|InputSelectFromList,Yes+No^"; 
    $parm1 = $parm1."accredscheme_templatesenabled||||Yes|Templates Enabled|InputSelectFromList,Yes+No^";  
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
    $parm1 = $parm1."generic_programbutton1|Yes|View Criteria|80|No|View Criteria|ProgramButton,accredcriteriaviewout.php,accredscheme_id,accredscheme_id,samewindow,,^";
    $parm1 = $parm1."generic_programbutton2|Yes|Setup Criteria|80|No|Update Criteria|ProgramButton,accredcriteriasetupout.php,accredscheme_id,accredscheme_id,samewindow,,^";
    $parm1 = $parm1."generic_programbutton3|Yes|Delete All Criteria|80|No|Delete All Criteria|ProgramButton,accredcriteriadeleteallconfirm.php,accredscheme_id,accredscheme_id,samewindow,,";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_ACCREDSCHEMECRITERIA_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "slim,jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Setup_ACCREDSCHEMECRITERIA_Output($schemeid) {
    $parm0 = "";
    $parm0 = $parm0."Accreditation Criteria - ".$schemeid."|"; # pagetitle
    $parm0 = $parm0."accredcriteria[rootkey=".$schemeid."+".$GLOBALS{'LOGIN_domain_id'}."]|"; # primetable (using domainid as clubid)
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."accredcriteria_id|"; # keyfieldname
    $parm0 = $parm0."accredcriteria_id|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."accredcriteria_id|Yes|Sequence|50|Yes|Sequence|KeyText,18,18^";
    $parm1 = $parm1."accredcriteria_ref|Yes|Ref|50|Yes|ref|InputText,30,60^";
    $parm1 = $parm1."accredcriteria_type|Yes|Type|70|Yes|Type|InputSelectFromList,section+criteria+evidence+data^";
    $parm1 = $parm1."|No|||Yes|section|Divider^";
    $parm1 = $parm1."accredcriteria_section|Yes|Section|100|Yes|Section|InputText,30,60^";
    $parm1 = $parm1."|No|||Yes|criteria|Divider^";
    $parm1 = $parm1."accredcriteria_criteria|Yes|Criteria|250|Yes|Criteria|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_subcriteria||||Yes|Sub-Criteria|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_help||||Yes|Help|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_templates||||Yes|Templates|InputTextArea,5,80^";         
    $parm1 = $parm1."|No|||Yes|evidence requirements|Divider^";
    $parm1 = $parm1."accredcriteria_evidencerequirement|Yes|Evidence Reqmt|250|Yes|Evidence Requirement|InputTextArea,5,80^";
    $parm1 = $parm1."accredcriteria_evidenceassetcodesreqd|Yes|Docs Reqd|70|Yes|Documents Required|InputSelectFromList,Yes+Optional+No^";
    $parm1 = $parm1."accredcriteria_evidenceimagelistreqd|Yes|Imgs Reqd|70|Yes|Images Required|InputSelectFromList,Yes+Optional+No^";
    $parm1 = $parm1."|No|||Yes|data collection requirements|Divider^";
    $parm1 = $parm1."accredcriteria_datafieldname||||Yes|Data: Field Name|InputText,30,100^";
    $parm1 = $parm1."accredcriteria_datafieldtitle|Yes|Data|50|Yes|Data: Field Title|InputText,30,100^";
    $parm1 = $parm1."accredcriteria_dataquestionTYPE||||Yes|Data Question Type|InputSelectFromList,Text+Radio+Checkbox^";
    $parm1 = $parm1."accredcriteria_datatextquestion||||Yes|Data: Text Question|InputText,30,100^";   
    $parm1 = $parm1."accredcriteria_dataradioquestions||||Yes|Data: Radio Questions<br>Q1val=Q1Text,Q2val=Q2text|InputText,80,100^";
    $parm1 = $parm1."accredcriteria_datacheckboxquestions||||Yes|Data: Checkbox Questions<br>Q1val=Q1Text,Q2val=Q2text|InputText,80,100^";
    $parm1 = $parm1."accredcriteria_datatargetreqd|Yes|Target|70|Yes|Required Data Value|InputText,30,100^";  
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update Site Settings|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Setup_ACCREDCRITERIADELETEALLCONFIRM_Output ($taccredscheme_id) {
    XH3('Delete All Accreditation Criteria - "'.$taccredscheme_id.'"');
    XPTXT("Are you sure you want to delete all criteria for this scheme");
    XBR();
    XFORM("accredcriteriadeleteallaction.php","deleteallcriteria");
    XINSTDHID();
    XINHID("accredscheme_id",$taccredscheme_id);
    XINSUBMIT("Confirm Deletion of Scheme Criteria");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Setup_DOWNLOAD_Output() {
	XH3("Data Download");
	$helplink = "Setup/Setup_DOWNLOAD_Output/setup_download_output.html"; Help_Link;
	XFORM("setupdownloadin.php","download");
	XINSTDHID();
	XPTXT("The download file will be in CSV format<BR><BR>");
	XTABLE();
	XTR();
	XTDTXT("All Data");
	XTD();XINCHECKBOX("DownSelect[]","sel-all-","","All Data");X_TD();
	X_TR();XTR();
	XTDTXT("Selected Data");
	XTD();
	$tablearray = array();
	$q = 'SHOW TABLES';
	$r = mysqli_query($GLOBALS{'IOSQL'},$q);
	if (mysqli_num_rows($r) > 0) { 
	 while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
	  array_push($tablearray, $row[0]); 
	 }
	}
	foreach ($tablearray as $tablearrayelement) {
		XINCHECKBOX("DownSelect[]","sel-".$tablearrayelement."-","",$tablearrayelement."<BR>");
	}
	X_TD();
	X_TR();
	X_TABLE();
	XBR();
	XINSUBMIT("Download File!");
	X_FORM();
}

function Setup_PERSONDOWNLOAD_Output() {
	XH3("People Details Download");
	$helplink = "Setup/Setup_DOWNLOAD_Output/setup_download_output.html"; Help_Link;
	XFORM("setupdownloadin.php","download");
	XINSTDHID();
	XINHID("DownSelectSpecific","sel-person-");	
	XPTXT("The download file will be in CSV format<BR><BR>");
	XINSUBMIT("Download File!");
	X_FORM();
}

function Setup_FRSDOWNLOAD_Output() {
	XH3("Fixtures Details Download");
	$helplink = "Setup/Setup_DOWNLOAD_Output/setup_download_output.html"; Help_Link;
	XFORM("setupdownloadin.php","download");
	XINSTDHID();
	XINHID("DownSelectSpecific","sel-frs-");
	XPTXT("The download file will be in CSV format<BR><BR>");
	XINSUBMIT("Download File!");
	X_FORM();
}

function Setup_UPLOAD_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
	// $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin,dropzonesettings";
}

function Setup_UPLOAD_Output() {
	
	XH3("Data Upload");
	$helplink = "Setup/Setup_UPLOAD_Output/setup_upload_output.html"; Help_Link;
	XFORMUPLOAD("setupuploadin.php","upload");
	XINSTDHID();
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XPTXT("File Containing Data:-");
	XINFILE("file","10000000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");
	XINHID("FirstOrConfirm","First");
	XBR();XBR();
	XINSUBMIT("Upload!");
	X_FORM();
}

function Setup_TITLES_Output() {
	XH3("Club Titles Update");
	$helplink = "Setup/Setup_TITLES_Output/setup_titles_output.html"; Help_Link;
	XFORM("setuptitlesin.php","setuptitles");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Description");XTDHTXT("Value");X_TR();
	XTR();
	XTDTXT("Club Long Name");
	XTDINTXT("AccountLongName",$GLOBALS{'domain_longname'},"40","40");
	X_TR();	
	XTR();
	XTDTXT("Club Short Name - Used for Mobile site<BR> - max 12 characters");
	XTDINTXT("AccountShortName",$GLOBALS{'domain_shortname'},"12","12");
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Setup_PERIOD_Output() {
	XH3("Current Season Update");
	$helplink = "Setup/Setup_SEASON_Output/setup_season_output.html"; Help_Link;
	XFORM("setupperiodin.php","setupperiod1");
	XINSTDHID();
	XBR();
	XH4("Option 1. Select the current season from one of the existing seasons.");
	XTXT("This will become the default for all section, team and fixtures presentation.<BR><BR>");
	XTABLE();
	XTR();XTDHTXT("Available Seasons");XTDHTXT("Current Season");X_TR();
	XTR();
	$periodidsa = Get_Array_Hash("period");
	foreach ($periodidsa as $xperiodid) {	
		XTR();XTDTXT($xperiodid);
		if ($xperiodid == $GLOBALS{'currperiodid'}) {
			$ch = "checked";
		}
		else {$ch = "";
		}
		XTDINRADIO("CurrPeriod",$xperiodid,$ch,"");
		X_TR();
	}
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XFORM("setupperiodin.php","setupperiod2");
	XINSTDHID();
	XBR();
	XH4("Option 2. Delete information from an old season to make more space available.");
	XTXT("Caution: if you delete a season it will delete all fixtures, sections and teams for that season as well. You will be asked to confirm this action.<BR><BR>");
	XTABLE();
	XTR();XTDHTXT("Available Seasons");XTDHTXT("Delete Season");X_TR();
	XTR();
	$periodidsa = Get_Array_Hash("period");
	foreach ($periodidsa as $xperiodid) {	
		XTR();XTDTXT($xperiodid);
		XTDINRADIO("DeletePeriod",$xperiodid,"","");
		X_TR();
	}
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	XH4("Option 3. Create a new season - including section, teams and fixtures information.");
	XTXT("Subsection and team information will be initialised from current season.<BR><BR>");
	XFORM("setupperiodin.php","setupperiod3");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Description");XTDHTXT("New Value");X_TR();
	XTR();
	XTDTXT("<B>New Season</B><BR>Recommended format is <B>2009</B> or <B>2009-2010</B>");
	XTDINTXT("NewPeriod","","9","9");
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XBR();XBR();
}

function Setup_PERIOD_Delete_Check($deleteperiodid) {
	XH3("Delete old information for season - ".$deleteperiodid);
	$helplink = "Setup/Setup_SEASON_Output/setup_team_output.html"; Help_Link;
	XH5("This will delete the $indeleteperiodid season and all section, team and fixture information - please confirm");
	XFORM("setupperioddeletein.php","setupperioddelete");
	XINSTDHID();
	XINHID("DeletePeriod",$deleteperiodid);
	XBR();XINSUBMIT("Confirm Delete");
	X_FORM();
	XBR();XBR();	
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS;
	$link = $link.YPGMPARM("SelectId","PERIOD");
	XLINKTXT($link,"Return to Season List");
}


function Setup_ORG_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";	
}

function Setup_ORG_Output() {
	XH3("Organisation");
	$helplink = "Setup/Setup_ORG_Output/setup_sections_output.html"; Help_Link;
	XFORM("setuporgin.php","setuporg");
	XINSTDHID();
	$sortstructure = Array();
	$tglobalsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
	$orga = Get_Array('org');
	$formseq = 0;
	foreach ($orga as $org_code) {	
		$formseq++;
		Get_Data("org",$org_code);
		$section_seq = "";
		for ($si = 0; $si <= sizeof($tglobalsectionsarray); $si++) {
			if ($GLOBALS{'org_section'} == $tglobalsectionsarray[$si]){
				$section_seq = $si;
			}
		}
		$tseq1 = $GLOBALS{'org_sequence'}."0000";
		$tseq2 = substr($tseq1, 0, 4);
		$tsortstring = $section_seq."#".$GLOBALS{'org_section'}."#".$tseq2."#".$org_code;
		array_push($sortstructure, $tsortstring);
	}
	sort($sortstructure);
	$formseq = 0;
	foreach ($sortstructure as $tsortstring) {		
		$formseq++;
		$obits = explode ('#', $tsortstring);
		XINHID("OrgCode$formseq",$obits[3]);
	}
	XTABLE();
	XTR();
	XTDHTXT("Add<BR>Change<BR>Delete");
	XTDHTXT("Title");
	XTDHTXT("Personal Id");
	XTDHTXT("Section");
	XTDHTXT("Visible<BR>on Contacts<BR>List");
	XTDHTXT("Sequence<BR>within<BR>section<BR>list");
	X_TR();
	sort($sortstructure);
	$formseq = 0;
	$personselectfields = ""; $psep = "";
	foreach ($sortstructure as $tsortstring) {
		$formseq++;
		$obits = explode ('#', $tsortstring);
		$newsection = $obits[1];
		if ($newsection != $oldsection){
			XTR();XTDHTXT("");XTDHTXT("$newsection");XTDHTXT(""); XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
		}
		$oldsection = $newsection;
		$GLOBALS{'org_code'} = $obits[3];
		// $GLOBALS{'org_code'} =~ s/\.txt//;
		Get_Data("org",$GLOBALS{'org_code'});
		XTR();
		XTDINSELECTHASH(List2Hash("C,D"),"ACD".$formseq,"");
		XTDINTXT("OrgTitle".$formseq,$GLOBALS{'org_title'},"30","60");
		XTDINPERSONID ("OrgPersonId".$formseq,"OrgPersonId".$formseq,$GLOBALS{'org_personid'},"6","12");
		// $parm2 = Buttons Id  field,To,To..,ToPersonIdList,ToPersonNameList,70|field,Cc,CC..,CcDistList,CcPersonList,70		
		$fieldstring = "field".","."OrgPersonId".$formseq."_lookupbutton".",".$GLOBALS{'org_title'}.","."OrgPersonId".$formseq.","."OrgPersonId".$formseq."_personlist".",150";
		$personselectfields = $personselectfields.$psep.$fieldstring;$psep = "|";
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XTDINSELECTHASH($xhash,"OrgSection".$formseq,$GLOBALS{'org_section'});
		XTDINSELECTHASH(List2Hash("Yes,No"),"OrgContactVisible".$formseq,$GLOBALS{'org_contactvisible'});		
		XTDINTXT("OrgSequence$formseq",$GLOBALS{'org_sequence'},"4","4");
		X_TR();
	}
	XTR();XTDHTXT("");XTDHTXT("add new roles");XTDHTXT(""); XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
	$addseq = 0;
	while ($addseq != 4) {
		$addseq++;
		$formseq++;
		XTR();
		XTDINSELECTHASH(List2Hash("A"),"ACD".$formseq,"");
		XTDINTXT("OrgTitle".$formseq,"","30","60");
		XTDINPERSONID ("OrgPersonId".$formseq,"OrgPersonId".$formseq,"","6","12");	
		$fieldstring = "field".","."OrgPersonId".$formseq."_lookupbutton".","."New Role".","."OrgPersonId".$formseq.","."OrgPersonId".$formseq."_personlist".",150";
		$personselectfields = $personselectfields.$psep.$fieldstring;$psep = "|";			
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XTDINSELECTHASH($xhash,"OrgSection".$formseq,"");
		XTDINSELECTHASH(List2Hash("Yes,No"),"OrgContactVisible".$formseq,"");		
		XTDINTXT("OrgSequence$formseq","","4","4");
		X_TR();
	}
	X_TABLE();
	XBR();XTDINSUBMIT("Enter");	
	X_FORM();

	$p0 = "this,person_id|person_sname|person_fname|person_section";
	$p1 = "person_id,Id,50|person_sname,SurName,100|person_fname,FirstName,100|person_section,Section,100";
	$p2 = $personselectfields;
	$p3 = "person_id";
	$p4 = "active";
	$p5 = "person_change,center,center,900,900";
	$p6 = "view";
	$p7 = "buildfulllist";
	$GLOBALS{'PersonSelectPopupParameters'} = array($p0,$p1,$p2,$p3,$p4,$p5,$p6,$p7);	
}

function Setup_ORGDETAIL_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Setup_ORGDETAIL_Output () {
    XH3("Organisation");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ORGDETAIL");
    
    XLINKBUTTONRIGHT($link,"Refresh List to see Updates");	
    XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Seq");
    XTDHTXT("Section");
    XTDHTXT("Org");
    XTDHTXT("");
    XTDHTXT("Title");
    XTDHTXT("Name");
    XTDHTXT("Job Role Type");
    XTDHTXT("Roles");
    XTDHTXT("Report");
    XTDHTXT("Job Role Type");
    XTDHTXT("Qualification");
    
    X_TR();
    X_THEAD();
    XTBODY();
    $GLOBALS{"reportseq"} = 0;
    $sortstructure = Array();
    $tglobalsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
    $orga = Get_Array('org');
    foreach ( $orga as $org_code ) {
        Get_Data("org",$org_code);
        $section_seq = "";
        for ($si = 0; $si <= sizeof($tglobalsectionsarray); $si++) {
            if ($GLOBALS{'org_section'} == $tglobalsectionsarray[$si]){$section_seq = $si;}
        }
        $tseq1 = $GLOBALS{'org_sequence'}."0000";
        $tseq2 = substr($tseq1, 0, 4);
        $tsortstring = $section_seq."#".$GLOBALS{'org_section'}."#".$tseq2."#".$org_code;
        array_push($sortstructure, $tsortstring);
    }
    sort($sortstructure);
    foreach ( $tglobalsectionsarray as $section_name ) {
        Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
        if ($GLOBALS{'section_archive'} != "Yes") {
            $GLOBALS{"reportseq"}++;
            XTRJQDT();
            XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR ('<b>'.$GLOBALS{'section_name'}." Section".'</b>',"#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            $link = YPGMLINK("personloginselectin.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("SelectId","ORG");
            XTDBACKTXTCOLOR ("#dddddd","#2F79B9");
            XLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
            X_TD();
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
            X_TR();
            
            $rolepersonarray = Array();
            foreach ( $sortstructure as $tsortstring ) {
                $obits = explode ('#', $tsortstring);
                $torg_section = $obits[1];
                $org_code = $obits[3];
                Get_Data("org",$org_code);
                if ($torg_section == $section_name) {
                    $GLOBALS{"reportseq"}++;
                    XTRJQDT();
                    XTDTXTCOLOR($GLOBALS{"reportseq"},"#cccccc");
                    XTDTXTCOLOR($GLOBALS{'section_name'},"#cccccc");
                    XTDTXTCOLOR("Org","#cccccc");
                    XTDTXTCOLOR("Org","#cccccc");
                    XTDTXT($GLOBALS{'org_title'});
                    Check_Data("person",$GLOBALS{'org_personid'});
                    if ($GLOBALS{'IOWARNING'} == "0" ) { XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}); }
                    else { XTDTXT($GLOBALS{'org_personid'}); }
                    XTDTXT("");
                    XTDTXT(""); 
                    $link = YPGMLINK("personqualificationreportout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("ReportParm",$GLOBALS{'org_personid'});;
                    XTDLINKTXTNEWPOPUP($link,"Report","view","center","center","800","800");
                    $link = YPGMLINK("personjobroleout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$GLOBALS{'org_personid'});;
                    XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
                    $link = YPGMLINK("personqualificationout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$GLOBALS{'org_personid'});;
                    XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
                    X_TR();
                }
            }
            $tteamarray = explode(',', $GLOBALS{'section_teams'});
            foreach ( $tteamarray as $team_code ) {
                Check_Data("team",$GLOBALS{'currperiodid'},$team_code);
                if ($GLOBALS{'IOWARNING'} == "0" ) {
                    XTRJQDT();
                    XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR('<b>'.$GLOBALS{'section_name'}.'</b>',"#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR('<b>'."Team".'</b>',"#eeeeee","#2F79B9");
                    XTDTXTBACKTXTCOLOR('<b>'.$GLOBALS{'team_name'}.'</b>',"#eeeeee","#2F79B9");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    $link = YPGMLINK("frsSETUPTEAMpopupout.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$team_code);;
                    XTDBACKTXTCOLOR ("#eeeeee","#2F79B9");
                    XLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
                    X_TD();
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
                    X_TR();
                    OutPersonRows ($GLOBALS{'team_mgr'},"Team",$team_code,$GLOBALS{'team_name'},"Team Manager","Team Manager");
                    OutPersonRows ($GLOBALS{'team_captain'},"Team",$team_code,$GLOBALS{'team_name'},"Team Captain","Team Captain");
                    OutPersonRows ($GLOBALS{'team_coach'},"Team",$team_code,$GLOBALS{'team_name'},"Team Coach","Team Coach");
                    OutPersonRows ($GLOBALS{'team_resmgrs'},"Team",$team_code,$GLOBALS{'team_resmgrs'},"ResMgrs","ResMgrs");
                    OutPersonRows ($GLOBALS{'team_helpers'},"Team",$team_code,$GLOBALS{'team_helpers'},"Helpers","Helpers");
                }
            }
        }
    }
    
    $GLOBALS{"reportseq"}++;
    XTRJQDT();
    XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR ('<b>Groups</b>',"#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    XTDTXTBACKTXTCOLOR("","#dddddd","#2F79B9");
    X_TR();
    
    foreach (Get_Array_Hash_SortSelect("sectiongroup",$GLOBALS{'currperiodid'},"sectiongroup_name","","") as $sectiongroup_code) {
        Check_Data("sectiongroup",$GLOBALS{'currperiodid'},$sectiongroup_code);
        if ($GLOBALS{'IOWARNING'} == "0" ) {
            XTRJQDT();
            XTDTXTBACKTXTCOLOR($GLOBALS{"reportseq"},"#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR('',"#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR('<b>'."Group".'</b>',"#eeeeee","#2F79B9");
            XTDTXTBACKTXTCOLOR('<b>'.$GLOBALS{'sectiongroup_name'}.'</b>',"#eeeeee","#2F79B9");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            $link = YPGMLINK("personSETUPGROUPpopupout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$sectiongroup_code);;
            XTDBACKTXTCOLOR ("#eeeeee","#2F79B9");
            XLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
            X_TD();
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            XTDTXTBACKTXTCOLOR("","#eeeeee","#cccccc");
            X_TR();
            OutPersonRows ($GLOBALS{'sectiongroup_mgr'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_name'},"Group Manager","Group Manager");
            OutPersonRows ($GLOBALS{'sectiongroup_coach'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_coach'},"Group Coach","Group Coach");
            OutPersonRows ($GLOBALS{'sectiongroup_personmgrs'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_personmgrs'},"Admin","Admin");
            OutPersonRows ($GLOBALS{'sectiongroup_helpers'},"Group",$sectiongroup_code,$GLOBALS{'sectiongroup_helpers'},"Helpers","Helpers");
        }
    };
    
    
    
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
    XINHID("list_sortcol",0);
}


function OutPersonRows ($personlist,$orgsectiontype,$orgsectioncode,$orgsectiontitle,$roletitle,$jobroletype) {
    $persona = List2Array($personlist);
    foreach ( $persona as $personid ) {
        Check_Data("person",$personid);
        if ($GLOBALS{'IOWARNING'} == "0" ) { $nametext = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
        else { $nametext = "Person Not Found"; }
        $GLOBALS{"reportseq"}++;
        XTRJQDT();
        XTDTXTCOLOR($GLOBALS{"reportseq"},"#cccccc");
        XTDTXTCOLOR($GLOBALS{'section_name'},"#cccccc");
        XTDTXTCOLOR($orgsectiontype,"#cccccc");
        XTDTXTCOLOR($orgsectiontitle,"#cccccc");
        XTDTXT($roletitle);
        XTDTXT($nametext);
        XTDTXT($roletype);
        XTDTXT("");
        $link = YPGMLINK("personqualificationreportout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("ReportParm",$personid);;
        XTDLINKTXTNEWPOPUP($link,"Report","view","center","center","800","800");    
        $link = YPGMLINK("personjobroleout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$personid);;
        XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");       
        $link = YPGMLINK("personqualificationout.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("person_id",$personid);;
        XTDLINKTXTNEWPOPUP($link,"Update","view","center","center","800","800");
        X_TR();
        
    }
}

function Setup_KBSECTION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm,jquerynestable";
    $GLOBALS{'SITEJSOPTIONAL'} = "jquerynestable,jqueryconfirm,globalroutines,kbsectionupdate";
    $GLOBALS{'SITEPOPUPHTML'} = "KBSection_Popup";
}

function Setup_KBSECTION_Output() {
    
    $kbsectiona = Get_Array("kbsection");
    $kbsectiontemparray = Array();
    foreach ( $kbsectiona as $kbsection_id ) {
        Get_Data("kbsection",$kbsection_id);
        $kblevela = explode('/',$GLOBALS{'kbsection_sequence'});
        $kblevel = count($kblevela);
        $arrayelement = $GLOBALS{'kbsection_sequence'}."#".$kbsection_id."#".$kblevel;
        array_push($kbsectiontemparray, $arrayelement);
    }
    sort ($kbsectiontemparray);
    
    XH2('KnowledgeBase Structure');
    XPTXT("Drag and Drop the folder items until you get the structure you require.");
    XHRCLASS("underline");
    $oldkbsection_level = 0;
    $found = "0";
    $nid = 0;
    XNESTCONTAINER();
    foreach ($kbsectiontemparray as $arrayelement) {       
        $found = "1";
        $mibit3s = explode("#",$arrayelement);
        $kbsection_id = $mibit3s[1];
        $kbsection_level = intval($mibit3s[2]);
        Get_Data("kbsection",$kbsection_id);
        // print("========= ".$arrayelement." ".$kbsection_level." ".$oldkbsection_level."<br>");
        
        if (($kbsection_level - $oldkbsection_level) > 0) {
            // Open First in new list
            XNESTOL();
            $nid++;
            XNESTKBSECTIONLI($nid,$GLOBALS{'kbsection_id'},$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
            XNESTKBSECTIONITEM($nid,$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
        }
        if (($kbsection_level - $oldkbsection_level) == 0) {
            // Continue list
            X_NESTLI();
            $nid++;
            XNESTKBSECTIONLI($nid,$GLOBALS{'kbsection_id'},$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
            XNESTKBSECTIONITEM($nid,$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
        }
        if (($kbsection_level - $oldkbsection_level) < 0) {
            // End Old list and Open First in new list
            X_NESTLI();
            X_NESTOL();
            X_NESTLI();
            $nid++;
            XNESTKBSECTIONLI($nid,$GLOBALS{'kbsection_id'},$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'},$GLOBALS{'kbsection_ref'});
            XNESTKBSECTIONITEM($nid,$GLOBALS{'kbsection_title'},$GLOBALS{'kbsection_type'},$GLOBALS{'kbsection_ref'});
        }
        $oldkbsection_level = $kbsection_level;
    }
    // End nestings
    if ( $found == "1" ) {
        X_NESTLI();
        X_NESTOL();
    } else {
        XNESTOL();
        $nid++;
        XNESTKBSECTIONLI($nid,$GLOBALS{'currenttimestamp'},"Title goes here","HelpSection","","");
        XNESTKBSECTIONITEM($nid,"Title goes here","HelpSection","");
        X_NESTLI();
    }
    X_NESTCONTAINER ();
    XBR();
    XINBUTTONIDSPECIAL ("kbsection-add","success","Add New Knowledgebase Section.");
    XBR();
    XFORM("kbsectionupdatein.php","kbsectionupdatein","");
    XINSTDHID();
    XHRCLASS("underline");
    XBR();
    // print '<textarea class="form-control" id="json_outputview" rows="5"></textarea>'."\n";
    XINHIDID("json_output","json_output","");
    XBR();
    XINSUBMIT ("Update Knowledgebase Structure");
    X_FORM();
}

function KBSection_Popup () {
    XDIVPOPUP("kbsectionpopup","KnowledgeBase Section");
    XINHIDID("nid","nid","");
    XINHIDID("KBSectionId","KBSectionId","");
    XDIV("KBSectionTitleDiv","kbsectiontitlediv");
    XH3("Title");
    XINTXTID("KBSectionTitle","KBSectionTitle","","25","50");
    X_DIV("KBSectionTitleDiv");
    XDIV("KBSectionTypeDiv","kbsectiontypediv");
    XH3("Help Section or Item");
    XINSELECTHASH (List2Hash("HelpSection,HelpItem"),"KBSectionType","HelpItem");
    X_DIV("KBSectionTypeDiv");
    XDIV("KBSectionRefDiv","kbsectionrefdiv");
    XH3('Reference - eg "Introduction" (no spaces) ');
    XINTXTID("KBSectionRef","KBSectionRef","","25","50");
    X_DIV("KBSectionRefDiv");
    XBR();
    XINBUTTONIDSPECIAL("kbsectionupdatebutton","primary","Update");
    XINBUTTONIDSPECIAL("kbsectioncancelbutton","warning","Cancel");
    XBR();
    X_DIV("kbsectionpopup");
}

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
