<?php

// site dashboards for Mode 0 installations

function SiteDashboard () {
	XH2("Please use Advanced Dashboard");
}

// domain dashboards for Mode 1,2,3

function DomainDashboard_ocz () {
	XTABLEINVISIBLE();XTR();
	XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
	XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
	X_TR();X_TABLE();

	XCLEARFLOAT();
	XHR();

	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYMEMBERSHIP");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYMEMBERSHIP.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYPROFILE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYPROFILE.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYQUALIFICATION");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYQUALIFICATION.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYAVAILABILITY");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYAVAILABILITY.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYSTATS");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYSTATS.png","120","120","0");X_DIV("");
	$thisvisibility = "No";
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCaptain="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMgr="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCoach="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionRM="))>0) {
		$thisvisibility = "Yes";
	}
	if ($thisvisibility == "Yes") {
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYTEAM");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYTEAM.png","120","120","0");X_DIV("");
	}
	$thisvisibility = "No";
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM="))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) {
		$thisvisibility = "Yes";
	}
	if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) {
		$thisvisibility = "Yes";
	}
	$displaystring=$displaystring."MYGROUP[".$thisvisibility."]".",";
	if ($thisvisibility == "Yes") {
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYGROUP");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYGROUP.png","120","120","0");X_DIV("");
	}
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","TEAMCHAT");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/TEAMCHAT.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();

	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PERSONSEARCH");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/PERSONSEARCH.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","LIBRARYVIEW");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/LIBRARYVIEW.png","120","120","0");X_DIV("");
	// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PHOTOGALLERY");
	// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/PHOTOGALLERY.png","120","120","0");X_DIV("");
	// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","VIDEOGALLERY");
	// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/VIDEOGALLERY.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EVENTUPDATELIST");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EVENTS.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ARTICLEUPDATELIST");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ARTICLES.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PERSONEMAIL");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EMAILTEXT.png","120","120","0");X_DIV("");	
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SHOPPING");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SHOPPING.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();

	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
}

function DomainDashboard_pos () {
    
	XTABLEINVISIBLE();XTR();
	XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
	XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
	X_TR();X_TABLE();

	XCLEARFLOAT();
	XHR();

	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","NEWRECEIPT");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/NEWRECEIPT.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","VIEWRECEIPT");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/VIEWRECEIPT.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","VIEWRECEIPTITEM");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/VIEWRECEIPTITEM.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","BCPOSTPOSSALES");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/BCPOSTPOSSALES.png","120","120","0");X_DIV("");
	X_TR();
	X_TABLE();
	XTABLEINVISIBLE();
	XTR();
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ADDTOSTOCK");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ADDTOSTOCK.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","BCSTOCKUPDATE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/BCSTOCKUPDATE.png","120","120","0");X_DIV("");

	XCLEARFLOAT();
	XHR();

	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","BCWEBPAGES");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/BCWEBPAGES.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");

	XCLEARFLOAT();
	XHR();

}

function DomainDashboard_cor () {

	$corlevel = 0;
	if ( $GLOBALS{'service_cor'} != "" ) {
		Check_Data('coruser');
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) { $corlevel = 1; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) { $corlevel = 2; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) { $corlevel = 3; }
		if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) { $corlevel = 4; }
		if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $corlevel = 4; }
	}

	XTABLEINVISIBLE();XTR();
	XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
	XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
	X_TR();X_TABLE();
	XCLEARFLOAT();
	XHR();
	
	/*
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CORSITELISTACTIVE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CORSITEACTIVE.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CORSITELISTFULL");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CORSITEFULL.png","120","120","0");X_DIV("");
    */

	$corprogramme_namea = Get_Array_Hash_SortSelect ('corprogramme','corprogramme_seq',"","");
	foreach ($corprogramme_namea as $corprogramme_name) {
	    $personprogrammeauthorised = "0";
	    Check_Data("corprogramme",$corprogramme_name);
	    if ($GLOBALS{'IOWARNING'} == "0") {
	        if ( $GLOBALS{'corprogramme_authorised'} == "All" ) {
	            $personprogrammeauthorised = "1";
	        } else {
	            if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'corprogramme_authorisedpersonidlist'})) {
	                $personprogrammeauthorised = "1";
	            }
	        }
	    }
	    if ( $personprogrammeauthorised == "1" ) {
    	    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CORSITELISTACTIVE").YPGMPARM("SelectParm",$corprogramme_name);
            XDIV("","floathoriz");
            print '<div style="position: relative; font-size:9px; color: white;">'."\n";
            XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CORSITEACTIVE".$GLOBALS{'corprogramme_iconcolor'}.".png","120","120","0");
            print '<div style="position: absolute; top: 68px; left: 66px;">'.$GLOBALS{'corprogramme_icontext'}.'</div>'."\n";
            print '</div>'."\n";
            X_DIV("");
            
            
            $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CORSITELISTFULL").YPGMPARM("SelectParm",$corprogramme_name);
            XDIV("","floathoriz");
            print '<div style="position: relative; font-size:9px; color: white;">'."\n";
            XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CORSITEFULL".$GLOBALS{'corprogramme_iconcolor'}.".png","120","120","0");
            print '<div style="position: absolute; top: 68px; left: 66px;">'.$GLOBALS{'corprogramme_icontext'}.'</div>'."\n";
            print '</div>'."\n";
            X_DIV("");	        
	    }            
	}
	
	XCLEARFLOAT();
	XHR();
	// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MASSUPDATELIST");
	// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MASSUPDATES.png","120","120","0");X_DIV("");	
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EXPORTLIST");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EXPORT.png","120","120","0");X_DIV("");
	if ( $corlevel > 2 ) {
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","UPLOAD");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/IMPORT.png","120","120","0");X_DIV("");
	}
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","REPORTLIST");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/REPORTS.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MPDFREPORTLIST");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MPDFREPORTS.png","120","120","0");X_DIV("");
	
	$report_ida = Get_Array('report');
	foreach ($report_ida as $report_id) {
	    Get_Data("report",$report_id);
	    if ( ReportUserVisibility($GLOBALS{'report_userlevel'},$GLOBALS{'report_personidlist'},$GLOBALS{'report_selectionlogic'})) {	        
	        if ( $GLOBALS{'report_dashboardfavourite'} == "Yes" ) {	        
	            $link = YPGMLINK("reportwebview.php").YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
            	XDIV("","floathoriz");
            	print '<div style="position: relative; text-align: center; color: black;">'."\n";
            	XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/REPORTSFAV.png","120","120","0");
            	// print '<img src="'.$GLOBALS{'site_asseturl'}.'/REPORTSFAV.png"'.' style="width:120px;">'."\n";
            	print '<div style="position: absolute; top: 48px; left: 50px;">'.$GLOBALS{'report_favouriteicontext'}.'</div>'."\n";
            	print '</div>'."\n";
            	X_DIV("");
	        }
	    }
	}
	XCLEARFLOAT();
	XHR();
	if ( $corlevel > 2 ) {
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCORSUPPLIER");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCORSUPPLIER.png","120","120","0");X_DIV("");
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCORACCOUNT");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCORACCOUNT.png","120","120","0");X_DIV("");
		if ( $corlevel > 3 ) {
			$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCORSURVEYCATEGORY");
			XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCORSURVEYCATEGORY.png","120","120","0");X_DIV("");
			$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PERSONADD1");
			XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ADDPERSON.png","120","120","0");X_DIV("");
			$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCORUSER");
			XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCORUSER.png","120","120","0");X_DIV("");
		}
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPEXPORTLIST");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPEXPORTS.png","120","120","0");X_DIV("");
		// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMASSUPDATELIST");
		// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMASSUPDATES.png","120","120","0");X_DIV("");
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPREPORTLIST");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPREPORTS.png","120","120","0");X_DIV("");
		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMPDFREPORTLIST");
		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMPDFREPORTS.png","120","120","0");X_DIV("");
		XCLEARFLOAT();
		XHR();
	}
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
}


function DomainDashboard_dmws () {
    
    if ($GLOBALS{'LOGIN_person_id'} == "cset") {       
        XH3("Initial Setup");
        XPTXT("This will setup the DMWS client machine with your profile and cases.");
        XPTXT("Please provide the Personal Id and Password for the person you would like it setup for..");
        XFORM("dmwsclientsetup.php","clientsetup");
        XINSTDHID();
        XTABLE();
        XTR();XTDTXT("Personal Id or Email Address");XTDINTXT("SetupPersonId","","40","60");X_TR();
        XTR();
        XTDTXT("Password");
        XTD();
        XINPSW("SetupPersonPsw","","12","20");
        X_TD();
        X_TR();
        XTR();XTDTXT("");XTDINSUBMIT("Setup");X_TR();
        X_TABLE();
        X_FORM();      
    } else {   
    	$dmwslevel = 0;
    	if ( $GLOBALS{'service_dmws'} != "" ) {
    		$dmwslevel = $GLOBALS{'person_userlevel'};	
    		if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
    			$dmwslevel = 4;
    		}
    	}
    
    	XTABLEINVISIBLE();XTR();
    	XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
    	XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
    	X_TR();X_TABLE();
    	XCLEARFLOAT();
    	XHR();
    	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","DMWSSULISTOPEN");
    	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/OPENCASES.png","120","120","0");X_DIV("");   	
    	if ( $GLOBALS{'site_clientservermode'} != "Client") {
    	    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","DMWSSULISTCLOSED");
    	    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLOSEDCASES.png","120","120","0");X_DIV("");    
    	}   	
    	if ( $dmwslevel > 2 ) {	
    		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EXPORTLIST");
    		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EXPORT.png","120","120","0");X_DIV("");
    		$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","UPLOAD");
    		XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/IMPORT.png","120","120","0");X_DIV("");	
        	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","REPORTLIST");
        	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/REPORTS.png","120","120","0");X_DIV("");
        }
    	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MPDFREPORTLIST");
    	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MPDFREPORTS.png","120","120","0");X_DIV("");
    	// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ONLINE");
    	// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ONLINE.png","120","120","0");X_DIV("");
    	XCLEARFLOAT();
    	XHR();
    	// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","DMWSASDDSU1");
    	// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ADDSERVICEUSER.png","120","120","0");X_DIV("");	
    	if ( $dmwslevel > 2 ) {	       
    			// $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPDMWSREFDATA");
    			// XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPDMWSREFDATA.png","120","120","0");X_DIV("");
    			$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPEXPORTLIST");
    			XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPEXPORTS.png","120","120","0");X_DIV("");
    			$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPREPORTLIST");
    			XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPREPORTS.png","120","120","0");X_DIV("");
    			$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMPDFREPORTLIST");
    			XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMPDFREPORTS.png","120","120","0");X_DIV("");
    		
    		XCLEARFLOAT();
    		XHR();
    	}
    	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
    	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
    	if ( $GLOBALS{'site_clientservermode'} == "Client") {
        	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","DMWSCLIENTAPPSYNCHRONISE");
        	XDIV("","floathoriz");XLINKIMGID ($link,"APPSYNCH",$GLOBALS{'site_asseturl'}."/APPSYNCH.png","120","120","0");X_DIV("");
    	}
    	/*
    	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","DMWSTRELLO");
    	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/TRELLO.png","120","120","0");X_DIV("");
    	XCLEARFLOAT();
    	*/
    	XHR();
    	XINHID("site_synchroniseappversion",$GLOBALS{'site_synchroniseappversion'});
    }
}



function DomainDashboard_care () {
    
    
    XTABLEINVISIBLE();XTR();
    XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
    XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
    X_TR();X_TABLE();
    XCLEARFLOAT();
    XHR();
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CAREVISITCALENDAR");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CALENDAR.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MILEAGE");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MILEAGE.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EXPORTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EXPORT.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","UPLOAD");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/IMPORT.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","REPORTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/REPORTS.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MPDFREPORTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MPDFREPORTS.png","120","120","0");X_DIV("");
    XCLEARFLOAT();
    XHR();
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CARECLIENTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SERVICEUSERS.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CARECLIENTSETUP");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ADDSERVICEUSER.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMILEAGEFAVOURITE");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMILEAGEFAVOURITE.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPEXPORTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPEXPORTS.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPREPORTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPREPORTS.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMPDFREPORTLIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMPDFREPORTS.png","120","120","0");X_DIV("");
    
    XCLEARFLOAT();
    XHR();
    
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
    XCLEARFLOAT();
    XHR();
    XINHID("site_synchroniseappversion",$GLOBALS{'site_synchroniseappversion'});
}

function DomainDashboard_cw () {
	XTABLEINVISIBLE();XTR();
	XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
	XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
	X_TR();X_TABLE();

	XCLEARFLOAT();
	XHR();
	XH3("Bookkeeping");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","UPLOADBANK");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/UPLOADBANK.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ALLOCATEBANK");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ALLOCATEBANK.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CASHBOOK");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CASHBOOK.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","TRAVELLOG");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/TRAVELLOG.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MILEAGE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MILEAGE.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PAYROLL");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/PAYROLL.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","DIVIDEND");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/DIVIDEND.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SALESINVOICE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SALESINVOICE.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PURCHASEINVOICE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/PURCHASEINVOICE.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","HOMEOFFICE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/HOMEOFFICE.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();
	XH3("Analysis");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EXTRACTFORACCOUNTANT");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EXTRACTFORACCOUNTANT.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","VATREPORT");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/VATREPORT.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();
	XH3("Setup");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCWDOMAIN");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCWDOMAIN.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCOMPANY");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCOMPANY.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPALLOCATION");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPALLOCATION.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPBANK");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPBANK.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPSUPPLIER");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPSUPPLIER.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPCUSTOMER");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPCUSTOMER.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPHOMEOFFICE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPHOMEOFFICE.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMILEAGEFAVOURITE");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMILEAGEFAVOURITE.png","120","120","0");X_DIV("");
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","UPDATECWREFERENCEDATA");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/UPDATECWREFERENCEDATA.png","120","120","0");X_DIV("");
	XCLEARFLOAT();
	XHR();
	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
	XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");	
	XCLEARFLOAT();
}


function DomainDashboard_grl () {
    XTABLEINVISIBLE();XTR();
    XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
    XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
    X_TR();X_TABLE();
    
    XCLEARFLOAT();
    XHR();
    
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYPROFILE");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYPROFILE.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYCLUB");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYCLUB.png","120","120","0");X_DIV("");    
    $link = YPGMLINK("grlleagueregistrationout.php").YPGMSTDPARMS().YPGMPARM("SelectId","REGISTRATION");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/REGISTRATION.png","120","120","0");X_DIV("");
    $link = YPGMLINK("grlleagueresultsout.php").YPGMSTDPARMS().YPGMPARM("SelectId","RESULTS");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/RESULTS.png","120","120","0");X_DIV("");    
    $link = YPGMLINK("grlleagueofficialresultsout.php").YPGMSTDPARMS().YPGMPARM("SelectId","OFFICIALRESULTS");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/OFFICIALRESULTS.png","120","120","0");X_DIV("");
    XCLEARFLOAT();
    XHR();
    
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","LIBRARYVIEW");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/LIBRARYVIEW.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","PHOTOGALLERY");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/PHOTOGALLERY.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","VIDEOGALLERY");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/VIDEOGALLERY.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EVENTUPDATELIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EVENTS.png","120","120","0");X_DIV("");
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","ARTICLEUPDATELIST");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/ARTICLES.png","120","120","0");X_DIV("");
 
    XCLEARFLOAT();
    XHR();
    
    $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
    XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
    XCLEARFLOAT();
}

function DomainDashboard_sfm () {  
    
    /*
    XH5("User Authority - Test Trace");
    XPTXTCOLOR('club = '.$GLOBALS{'sfmuserclub'},"green");
    XPTXTCOLOR('league = '.$GLOBALS{'sfmuserleague'},"green");
    XPTXTCOLOR('division = '.$GLOBALS{'sfmuserdivision'},"green");
    XPTXTCOLOR('county = '.$GLOBALS{'sfmusercounty'},"green");
    XPTXTCOLOR('ngb = '.$GLOBALS{'sfmuserngb'},"green");
    XPTXTCOLOR('set = '.$GLOBALS{'sfmuserset'},"green");
    XPTXTCOLOR('role = '.$GLOBALS{'sfmuserrole'},"green");
    XPTXTCOLOR('level = '.$GLOBALS{'sfmuserlevel'},"green");
     */
    
    XTABLEINVISIBLE();XTR();
    XTDIMG($GLOBALS{'site_asseturl'}."/navdashboard.png","50","50","0");
    XTD();XH3("&nbsp;My Dashboard - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
    X_TR();X_TABLE();
    XBR();

       
    if ($GLOBALS{'sfmuserrole'} == "Club,") {
        XPTXTCOLOR("Role: Club Administrator - ".$GLOBALS{'sfmuserclub'},"#5499C7");  
        XHR();
        $thisclubid = str_replace(",","",$GLOBALS{'sfmuserclub'});
        $link = YPGMLINK("sfmclubupdateout.php").YPGMSTDPARMS().YPGMPARM("sfmclub_id",$thisclubid);
        XDIV("","floathoriz");
        XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MYCLUB.png","120","120","0");
        X_DIV("");
        XCLEARFLOAT();
        XHR();
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
        XCLEARFLOAT();
    } else {   
        if ( FoundInCommaList("League",$GLOBALS{'sfmuserrole'}) ) {
            XPTXTCOLOR("Role: League Administrator - ".$GLOBALS{'sfmuserleague'},"#5499C7"); 
        }
        if ( FoundInCommaList("Division",$GLOBALS{'sfmuserrole'}) ) {       
            XPTXTCOLOR("Role: Division Administrator - ".$GLOBALS{'sfmuserdivision'},"#5499C7"); 
        }
        if ( FoundInCommaList("County",$GLOBALS{'sfmuserrole'}) ) {    
            XPTXTCOLOR("Role: County Association Administrator - ".$GLOBALS{'sfmusercounty'},"#5499C7"); 
        }
        if ( FoundInCommaList("NGB",$GLOBALS{'sfmuserrole'}) ) {                
            XPTXTCOLOR("Role: NGB Administrator - ".$GLOBALS{'sfmuserngb'},"#5499C7"); 
        } 
        if ( FoundInCommaList("GroundInspector",$GLOBALS{'sfmuserrole'}) ) {    
            XPTXTCOLOR("Role: Ground Grading Inspector","#5499C7");    
        }
        if ( FoundInCommaList("FloodInspector",$GLOBALS{'sfmuserrole'}) ) {    
            XPTXTCOLOR("Role: Floodlighting Inspector","#5499C7");    
        }  

        XHR();
        
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SFMSETLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SFMCLUBS.png","120","120","0");X_DIV("");
        $link = YPGMLINK("sfmlltappsetlistout.php").YPGMSTDPARMS();
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SFMLLTAPP.png","120","120","0");X_DIV("");
        XCLEARFLOAT();
        XHR();
        
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","EXPORTLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/EXPORT.png","120","120","0");X_DIV("");
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","UPLOAD");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/IMPORT.png","120","120","0");X_DIV("");
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","REPORTLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/REPORTS.png","120","120","0");X_DIV("");
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MPDFREPORTLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/MPDFREPORTS.png","120","120","0");X_DIV("");
        XCLEARFLOAT();
        XHR();
        
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPEXPORTLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPEXPORTS.png","120","120","0");X_DIV("");
        // $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMASSUPDATELIST");
        // XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMASSUPDATES.png","120","120","0");X_DIV("");
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPREPORTLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPREPORTS.png","120","120","0");X_DIV("");
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","SETUPMPDFREPORTLIST");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/SETUPMPDFREPORTS.png","120","120","0");X_DIV("");
        XCLEARFLOAT();
        XHR();
        
        $link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
        XDIV("","floathoriz");XLINKIMG ($link,$GLOBALS{'site_asseturl'}."/CLASSICMENU.png","120","120","0");X_DIV("");
        XCLEARFLOAT();
    }
}

function Person_Login_Select_CSSJS () {
    if ( $GLOBALS{'LOGIN_menu_id'} == "Dashboard" ) {
        if ( $GLOBALS{'site_clientservermode'} == "Client") {
            $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
            $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,javascriptappversionchecker,bootstrappswupdate,jqueryconfirm";
        } else {
            $GLOBALS{'SITEJSOPTIONAL'} = "bootstrappswupdate";
        }
    } else {
        $GLOBALS{'SITEJSOPTIONAL'} = "rememberbtab,bootstrappswupdate";
    }
}

function Person_Login_Select_Output () {
$Q = '"';	

# # $helplink = "Person/Person_Login_Select_Output/Person_Login_Select_output.html"; Help_Link;
# if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
# XFORM("setuploginin.php","initialsetup");
#  XINSTDHID();
# print"<INPUT TYPE=SUBMIT VALUE=$Q Getting Started - Initial Site Setup Wizard $Q>\n";
# X_FORM();
#}

$peoplelevel = 0;
if (( $GLOBALS{'service_people'} != "" )||( $GLOBALS{'service_org'} != "" )) { 
 if (strlen(strstr($GLOBALS{'LOGIN_person_id'},"anonymous"))>0) {} else { $peoplelevel = 1; }  	
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $peoplelevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr="))>0) { $peoplelevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach="))>0) { $peoplelevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM="))>0) { $peoplelevel = 2; } 
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCaptain="))>0) { $peoplelevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMgr="))>0) { $peoplelevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCoach="))>0) { $peoplelevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $peoplelevel = 3; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $peoplelevel = 3; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) { $peoplelevel = 3; } 
}
$orglevel = 0;
if ($GLOBALS{'service_org'} != "" )  {  
 if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $orglevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $orglevel = 2; }
}
$webpageslevel = 0;
if ($GLOBALS{'service_webpages'} != "") { 
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM="))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCaptain="))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamMgr="))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCoach="))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) { $webpageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"WM#WebPage="))>0) { $webpageslevel = 3; }  
 if (strlen(strstr($GLOBALS{'person_authority'},"WM#Domain"))>0) { $webpageslevel = 4; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $webpageslevel = 4; }  
}
$mobilepageslevel = 0;
if ($GLOBALS{'service_mobilepages'} != "") { 
 if (strlen(strstr($GLOBALS{'person_authority'},"WM#Domain"))>0) { $mobilepageslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $mobilepageslevel = 2; }
}
$reportinglevel = 0;
if ($GLOBALS{'service_reporting'} != "") { 
    if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $reportinglevel = 2; }
    if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $reportinglevel = 2; }
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $reportinglevel = 2; }
}
$advertisinglevel = 0;
if ( $GLOBALS{'service_advertising'} != "" ) {
 if (strlen(strstr($GLOBALS{'person_authority'},"SM#Domain"))>0) { $advertisinglevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $advertisinglevel = 2; }
}
$auctionlevel = 0;
if ( $GLOBALS{'service_auction'} != "" ) {
 if (strlen(strstr($GLOBALS{'person_authority'},"PM#Domain"))>0) { $auctionlevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $auctionlevel = 2; }
}
$librarylevel = 0;
if ($GLOBALS{'service_library'} != "" )  { 
 $librarylevel = 1; #even for anonymous
 if (strlen(strstr($GLOBALS{'person_authority'},"WM#WebPage="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"WM#Domain"))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"SM#Domain"))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"PM#Domain"))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCaptain="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMgr="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCoach="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCaptain="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamMgr="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCoach="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"LU#SectionLU="))>0) { $librarylevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $librarylevel = 3; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $librarylevel = 3; }
}
$accreditationlevel = 0;
if ($GLOBALS{'service_accreditation'} != "" )  { 
 $accreditationlevel = 1; #even for anonymous
 if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $accreditationlevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $accreditationlevel = 2; }
}
$newsletterslevel = 0;
$actionslevel = 0;
if ($GLOBALS{'service_actions'} != "" )  {  	
 if (strlen(strstr($GLOBALS{'LOGIN_person_id'},"anonymous"))>0) {} else { $actionslevel = 1; }  
}
$bookingslevel = 0;
if ( $GLOBALS{'service_bookings'} != "" ) {
 if (strlen(strstr($GLOBALS{'LOGIN_person_id'},"anonymous"))>0) {} else { $bookingslevel = 1; }  		
 if ((strlen(strstr($GLOBALS{'person_authority'},"BM#Domain"))>0)) {$bookingslevel = 2;}
 if ((strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0)) {$bookingslevel = 2;} 
}
$shoplevel = 0;
if ( $GLOBALS{'service_shop'} != "" ) {
 if (strlen(strstr($GLOBALS{'LOGIN_person_id'},"anonymous"))>0) {} else { $shoplevel = 1; }  	
 if (strlen(strstr($GLOBALS{'person_authority'},"PM#Domain"))>0) { $shoplevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $shoplevel = 2; }
}
$sectionslevel = 0;
if ( $GLOBALS{'service_sections'} != "" ) {
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $sectionslevel = 2; }	
 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $sectionslevel = 2; }	
 if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $sectionslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) { $sectionslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $sectionslevel = 2; }
}
$frslevel = 0;
if ( $GLOBALS{'service_frs'} != "" ) {
 if (strlen(strstr($GLOBALS{'LOGIN_person_id'},"anonymous"))>0) {} else { $frslevel = 1; }  	
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM="))>0) { $frslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCaptain="))>0) { $frslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamMgr="))>0) { $frslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCoach="))>0) { $frslevel = 2; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $frslevel = 3; }
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $frslevel = 3; } 
 if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) { $frslevel = 3; }
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $frslevel = 3; }
}
$finlevel = 0; 
if ( $GLOBALS{'service_fin'} != "" ) {
 $finlevel = 1; 	
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $finlevel = 2; } 
}
$processlevel = 0; 
if ( $GLOBALS{'service_process'} != "" ) {
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $processlevel = 2; } 
}
$poslevel = 0; 
if ( $GLOBALS{'service_pos'} != "" ) {
 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $poslevel = 2; } 
}
$corlevel = 0;
if ( $GLOBALS{'service_cor'} != "" ) {
	Check_Data('coruser');
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) {$corlevel = 1;}
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) { $corlevel = 2; }	
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) { $corlevel = 3; }		
	if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) { $corlevel = 4; }	
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $corlevel = 4; }
}
$dmwslevel = 0;
if ( $GLOBALS{'service_dmws'} != "" ) {
	$dmwslevel = $GLOBALS{'person_userlevel'};
	if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
		$dmwslevel = 4;
	}
}
$grllevel = 0;
if ( $GLOBALS{'service_grl'} != "" ) {
    $grllevel = $GLOBALS{'person_userlevel'};
    if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
        $grllevel = 4;
    }
}

if ( $GLOBALS{'service_sfm'} != "" ) {
    $sfmlevel = 4;
}

$carelevel = 0;
if ( $GLOBALS{'service_care'} != "" ) {
    $grllevel = $GLOBALS{'person_userlevel'};
    if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
        $carelevel = 4;
    }
}

$advancedlevel = 0;
if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $advancedlevel = 5; }
$PHPlevel = 0;
# if  ($GLOBALS{'LOGIN_person_id'} == "bbra") {$PHPlevel = 1;}

$sortservices = Array();
array_push ($sortservices,"S010|".'service_fin');
array_push ($sortservices,"S011|".'service_pos');
array_push ($sortservices,"S012|".'service_cor');
array_push ($sortservices,"S013|".'service_auction');
array_push ($sortservices,"S014|".'service_dmws');
array_push ($sortservices,"S014|".'service_grl');
array_push ($sortservices,"S015|".'service_care');
array_push ($sortservices,"S015|".'service_sfm');

array_push ($sortservices,"S020|".'service_people');
array_push ($sortservices,"S030|".'service_org');
array_push ($sortservices,"S040|".'service_webpages');
array_push ($sortservices,"S050|".'service_mobilepages');
array_push ($sortservices,"S060|".'service_advertising');
array_push ($sortservices,"S070|".'service_library');
array_push ($sortservices,"S080|".'service_accreditation');
array_push ($sortservices,"S090|".'service_newsletters');
array_push ($sortservices,"S100|".'service_actions');
array_push ($sortservices,"S110|".'service_bookings');
array_push ($sortservices,"S120|".'service_shop');
array_push ($sortservices,"S130|".'service_sections');
array_push ($sortservices,"S120|".'service_frs');
array_push ($sortservices,"S150|".'service_process');
array_push ($sortservices,"S160|".'service_reporting');
sort($sortservices);


# =================================================================================
if ( $GLOBALS{'LOGIN_menu_id'} == "Dashboard" ) {	# Start of Custom Menu structure
     if ($GLOBALS{'LOGIN_mode_id'} == "0") { // shouldnt happen !
     	SiteDashboard();
     }
     if ($GLOBALS{'LOGIN_mode_id'} == "1") {
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) { DomainDashboard_ocz(); }
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"pos"))>0) { DomainDashboard_pos(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"cor"))>0) { DomainDashboard_cor(); }
      	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"dmws"))>0) { DomainDashboard_dmws(); }	
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"cw"))>0) { DomainDashboard_cw(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"grl"))>0) { DomainDashboard_grl(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"care"))>0) { DomainDashboard_care(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"sfm"))>0) { DomainDashboard_sfm(); } 
     }
     if (($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {
      	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) { DomainDashboard_ocz(); }
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"pos"))>0) { DomainDashboard_pos(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"cor"))>0) { DomainDashboard_cor(); } 
      	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"dmws"))>0) { DomainDashboard_dmws(); }  	
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"cw"))>0) { DomainDashboard_cw(); }
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"grl"))>0) { DomainDashboard_grl(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"care"))>0) { DomainDashboard_care(); } 
     	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"sfm"))>0) { DomainDashboard_sfm(); } 
     }  
} # End of Dashboard Menu structure
# =================================================================================

else { # Start of Classic Menu structure	
		
    XTABLEINVISIBLE();XTR();
    XTDIMG($GLOBALS{'site_asseturl'}."/navadvanced.png","50","50","0");
    XTD();XH3("&nbsp;My Advanced Menu - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TD();
    X_TR();X_TABLE();	
    BTABDIV('advancedmenu');
    BTABHEADERCONTAINER();
    BTABHEADERITEM("Introduction","Introduction","selected");
    foreach ($sortservices as $sortserviceelement) {
     $sbits = explode('|', $sortserviceelement);
     if (VSA($sbits,"people")) {
      if ( $peoplelevel > 0) { BTABHEADERITEM("People","People",""); } 
     }
     if (VSA($sbits,"org")) {
      if ( $orglevel > 0) { BTABHEADERITEM("Org","Organisation",""); } 	
     }
     if (VSA($sbits,"webpages")) {
      if ($webpageslevel > 0) { BTABHEADERITEM("Webpages","Webpages",""); } 	
     } 
     /*
     if (VSA($sbits,"mobilepages")) {
      if ($mobilepageslevel > 0) { BTABHEADERITEM("Mobile","Mobile",""); }  	
     } 
     */ 
     if (VSA($sbits,"reporting")) {
      if ( $reportinglevel > 0) { BTABHEADERITEM("Reporting","Reporting",""); } 	
     }
     if (VSA($sbits,"advertising")) {
      if ( $advertisinglevel > 0) { BTABHEADERITEM("Advertising","Advertising",""); } 	
     }
     if (VSA($sbits,"auction")) {
      if ( $auctionlevel > 0) {BTABHEADERITEM("Auction","Auction","");}  	
     }   
     if (VSA($sbits,"library")) {
      if ( $librarylevel > 0) {BTABHEADERITEM("Library","Library",""); } 	
     } 
     if (VSA($sbits,"accreditation")) {
      if ( $accreditationlevel > 0) {BTABHEADERITEM("Accreditation","Accreditation",""); }
     }
     if (VSA($sbits,"newsletters")) {
       if ( $newsletterslevel > 0) {BTABHEADERITEM("Newsletters","Newsletters",""); }		
     } 
     if (VSA($sbits,"actions")) {
       if ( $actionslevel > 0) { BTABHEADERITEM("Actions","Actions",""); } 	
     }
     if (VSA($sbits,"bookings")) {
       if ( $bookingslevel > 0) { BTABHEADERITEM("Bookings","Bookings",""); }	
     }
     if (VSA($sbits,"shop")) {
       if ( $shoplevel > 0) { BTABHEADERITEM("Shop","Shop",""); } 	
     } 
     if (VSA($sbits,"frs")) {
       if ( $frslevel > 0) { BTABHEADERITEM("Results","Fixtures, Results & Selection",""); }	
     } 
     if (VSA($sbits,"fin")) {
      if ( $finlevel > 0) {BTABHEADERITEM("Fin","Financial Management","");} 	
     } 
     if (VSA($sbits,"process")) {
      if ( $processlevel > 0) {BTABHEADERITEM("Process","Process Management","");}  	
     }
     if (VSA($sbits,"pos")) {
      if ( $poslevel > 0) {BTABHEADERITEM("Pos","Point of Sale","");}  	
     } 
     if (VSA($sbits,"cor")) {
      if ( $corlevel > 0) {BTABHEADERITEM("Cor","Property Management","");}  	
     }
     if (VSA($sbits,"dmws")) {
         if ( $dmwslevel > 0) {BTABHEADERITEM("DMWS","Service User Mgmt","");}  	
     }
     if (VSA($sbits,"grl")) {
         $grllevel = 1;
         if ( $grllevel > 0) { BTABHEADERITEM("GRL","League Management",""); }
     } 
     if (VSA($sbits,"sfm")) {
         if ( $sfmlevel > 0) {BTABHEADERITEM("SFM","Sports Facility Management","");}
     }
     if (VSA($sbits,"care")) {
         $carelevel = 1;
         if ( $carelevel > 0) {BTABHEADERITEM("CARE","Care Service Mgmt","");}
     }
    }   
    if ( $advancedlevel > 0) { BTABHEADERITEM("Advanced","Advanced",""); }
    if ( $PHPlevel > 0) { BTABHEADERITEM("PHP","PHP demo",""); }
    BTABHEADERITEM("Authority","Authority","");
    B_TABHEADERCONTAINER();
    
    BTABCONTENTCONTAINER();
    BTABCONTENTITEM("Introduction");
    $tabindex = 1;
    XTABLE();
    foreach ($sortservices as $sortserviceelement) {
     $sbits = explode('|', $sortserviceelement);
     if (VSA($sbits,"people")) {
      if ($peoplelevel > 0) {	
       XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/people.gif");
       XTD(); XTABLINKTXT($tabindex,"People"); $tabindex++;X_TD();
       XTDTXTWIDTH("Update or look up people information","400");X_TR(); 
      } 
     }
     if (VSA($sbits,"org")) {
      if ( $orglevel > 0) {
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/org.gif");  	 
      	XTD(); XTABLINKTXT($tabindex,"Organisation"); $tabindex++; 
      	XTDTXTWIDTH("Define the organisation and sections","400");X_TR();  	
      } 	
     }
     if (VSA($sbits,"webpages")) {
      if ($webpageslevel > 0) { 
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/webpages.gif");  	
      	XTD(); XTABLINKTXT($tabindex,"Webpages"); $tabindex++;
      	XTDTXTWIDTH("Change the style and content of the website","400");X_TR(); 
      } 	
     } 
     /*
     if (VSA($sbits,"mobilepages")) {
      if ($mobilepageslevel > 0) {
       	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/mobilepages.gif"); 	 
      	XTD(); XTABLINKTXT($tabindex,"Mobile"); $tabindex++;
      	XTDTXTWIDTH("Change the style of the mobile website","400");X_TR(); 
      }  	
     }
     */
     if (VSA($sbits,"reporting")) {
      if ( $reportinglevel > 0) {
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/reporting.gif");  	 
      	XTD(); XTABLINKTXT($tabindex,"Reporting"); $tabindex++; 
      	XTDTXTWIDTH("Setup the reports and extracts on the site","400");X_TR(); 
      } 	
     }
     if (VSA($sbits,"advertising")) {
      if ( $advertisinglevel > 0) {
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/advertising.gif");  	 
      	XTD(); XTABLINKTXT($tabindex,"Advertising"); $tabindex++; 
      	XTDTXTWIDTH("Setup the advertising on the site","400");X_TR(); 
      } 	
     }
     if (VSA($sbits,"auction")) {
      if ( $auctionlevel > 0) {
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/auction.gif");  	 
      	XTD();XTABLINKTXT($tabindex,"Auction"); $tabindex++; 
      	XTDTXTWIDTH("Manage an Auction","400");X_TR(); 
      } 	
     }  
     if (VSA($sbits,"library")) {
      if ( $librarylevel > 0) {
       	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/library.gif");	
        XTD(); XTABLINKTXT($tabindex,"Library"); $tabindex++;
      	XTDTXTWIDTH("Lookup or maintain information in the Library","400");X_TR(); 
      }
     } 
     if (VSA($sbits,"accreditation")) {
      if ( $accreditationlevel > 0) {
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/accreditation.gif"); 	
        XTD(); XTABLINKTXT($tabindex,"Accreditation"); $tabindex++;
        XTDTXTWIDTH("Lookup or maintain accreditation information ","400");X_TR();
      }   		
     }
     if (VSA($sbits,"newsletters")) {
      if ( $newsletterslevel > 0) { 	
    #  	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/newsletters.gif"); 	
    #   XTD(); XTABLINKTXT($tabindex,"Newsletters"); $tabindex++;
    #  	XTDTXTWIDTH("Edit and publish newsletters","400");X_TR(); 
      }
     } 
     if (VSA($sbits,"actions")) {
      if ( $actionslevel > 0) {
       XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/actions.gif");	
       XTD(); XTABLINKTXT($tabindex,"Actions"); $tabindex++;
       XTDTXTWIDTH("Review the status of your actions","400");X_TR();  	 	
      } 
     }
     if (VSA($sbits,"bookings")) {
      if ( $bookingslevel > 0) {
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/bookings.gif");  	 
      	XTD(); XTABLINKTXT($tabindex,"Bookings"); $tabindex++;
      	XTDTXTWIDTH("Booking service","400");X_TR();
      } 	
     }
     if (VSA($sbits,"shop")) {
      if ( $shoplevel > 0) {
       	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/shop.gif"); 	 
      	XTD(); XTABLINKTXT($tabindex,"Shop"); $tabindex++;
      	XTDTXTWIDTH("Order  or setup information in the shop","400");X_TR();
      }	 	 
     }
     if (VSA($sbits,"frs")) {
      if ( $frslevel > 0) { 
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/frs.gif");  	
      	XTD(); XTABLINKTXT($tabindex,"Fixtures, Results & Selection"); $tabindex++;
      	XTDTXTWIDTH("Lookup and maintain Fixtures, Selection or match reports","400");X_TR(); 
      }	 	 
     } 
     if (VSA($sbits,"fin")) {
      if ( $finlevel > 0) {
       	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/fin.gif"); 	
      	XTD(); XTABLINKTXT($tabindex,"Financial Management"); $tabindex++;
      	XTDTXTWIDTH("Financial Services","400");X_TR(); 	
      } 	
     } 
     if (VSA($sbits,"process")) {
      if ( $processlevel > 0) {
       	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/process.gif"); 	
      	XTD(); XTABLINKTXT($tabindex,"Process Management"); $tabindex++;
      	XTDTXTWIDTH("Process Services","400");X_TR(); 	
      }  	
     }
     if (VSA($sbits,"pos")) {
      if ( $poslevel > 0) {
        XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/pos.gif");
        XTD(); XTABLINKTXT($tabindex,"Point of Sale"); $tabindex++;
        XTDTXTWIDTH("Point of Sale","400");X_TR();
      }
     } 
     if (VSA($sbits,"cor")) {
     	if ( $corlevel > 0) {
     		XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/property.gif");
     		XTD(); XTABLINKTXT($tabindex,"Property Management"); $tabindex++;
     		XTDTXTWIDTH("Property Management","400");X_TR();
     	}
     }
     if (VSA($sbits,"dmws")) {
     	if ( $dmwslevel > 0) {
     		XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/people.gif");
     		XTD(); XTABLINKTXT($tabindex,"Service User Mgmt"); $tabindex++;
     		XTDTXTWIDTH("Service User Mgmt","400");X_TR();
     	}
     } 
     if (VSA($sbits,"grl")) {
         $grllevel = 1;
         if ( $grllevel > 0) {
             XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/frs.gif");
             XTD(); XTABLINKTXT($tabindex,"League Management"); $tabindex++;
             XTDTXTWIDTH("League Management","400");X_TR();
         }
     } 
     if (VSA($sbits,"sfm")) {
         if ( $sfmlevel > 0) {
             XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/facilities.gif");
             XTD(); XTABLINKTXT($tabindex,"Sports Facility Management"); $tabindex++;
             XTDTXTWIDTH("Sports Facility Management","400");X_TR();
         }
     }
     if (VSA($sbits,"care")) {
         $carelevel = 1;
         if ( $carelevel > 0) {
             XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/people.gif");
             XTD(); XTABLINKTXT($tabindex,"Care Service Mgmt"); $tabindex++;
             XTDTXTWIDTH("Care Service Mgmt","400");X_TR();
         }
     } 
     
    }   
    if ( $advancedlevel > 0) { 
      	XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/advanced.gif");	
    	XTD(); XTABLINKTXT($tabindex,"Advanced"); $tabindex++;
      	XTDTXTWIDTH("Advanced setup","400");X_TR();  
    }
    
    XTR();XTDTABLINKIMGFLEX($tabindex,$GLOBALS{'site_asseturl'}."/authority.gif");	
    XTD(); XTABLINKTXT($tabindex,"Authority"); $tabindex++;
    XTDTXTWIDTH("Shows what you are authorised to update on this site.","400");X_TR(); 
     
    X_TABLE();
    B_TABCONTENTITEM();
    
    foreach ($sortservices as $sortserviceelement) {
     $sbits = explode('|', $sortserviceelement);
     if (VSA($sbits,"people")) {
      if ($peoplelevel > 0) {
       BTABCONTENTITEM("People");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/people.gif");
       XH5("Update Information about myself");
       PHP_Link_Output("My Profile","MYPROFILE");  
       if (VSF("personmembership")) { PHP_Link_Output("My Membership Details","MYMEMBERSHIP"); }
       if (VSF("jobroles")) { PHP_Link_Output("My Job Roles","MYJOBROLE"); }
       if (VSF("qualifications")) {
    	   PHP_Link_Output("My Qualifications","MYQUALIFICATION");
    	   PHP_Link_Output("My Qualification Report","MYQUALIFICATIONREPORT");
       }
       PHP_Link_Output("Change my Password","MYPASSWORD"); 
       PHP_Link_Output("Change my Preferences","MYPREFERENCES"); 
       XH5("Lookup or communicate with other people");
       PHP_Link_Output("Search other People","PERSONSEARCH");
       PHP_Link_Output("Email other people","PERSONEMAIL");
       PHP_Link_Output("Download a People List/Label Print/Distribution List","PERSONLIST");
       if ($peoplelevel > 1) {
       	XH5("Update Information about other people");
       	PHP_Link_Output("Add a new person","PERSONADD1");
       	PHP_Link_Output("Update another person's profile","PERSONCHANGESEARCH");
       	if (VSF("jobroles")) {   	
    	   	PHP_Link_Output("Setup Job Roles","SETUPJOBROLE");
    	    PHP_Link_Output("Person Job Roles","PERSONJOBROLE"); 
       	}
       	if (VSF("qualifications")) {    
    	   	PHP_Link_Output("Setup Qualifications","SETUPQUALIFICATION");
    	   	PHP_Link_Output("Setup JobRole Qualifications","SETUPJOBROLEQUALIFICATION");
    	   	PHP_Link_Output("Person Qualifications","PERSONQUALIFICATION");
    	   	PHP_Link_Output("Qualification Report","PERSONQUALIFICATIONREPORT");
        }
    
       	if ($peoplelevel > 2) {
       		XH5("Advanced");
       		PHP_Link_Output("Password Reset","PERSONPWDRESET");
       		PHP_Link_Output("Delete a person","PERSONDELETESEARCH");
       		if (VSF("personmembership")) { PHP_Link_Output("Define the person types","PERSONTYPES"); }
       		if (VSF("personethnicity")) {
    	   		PHP_Link_Output("Define the ethnicity types","ETHNICITY");   		
    	   		PHP_Link_Output("Define the disability types","DISABILITY");  
       		}
       		if (array_key_exists("personuserlevel^FIELDS",$GLOBALS)) {
       		   PHP_Link_Output("Define User Levels","PERSONUSERLEVEL"); 
       		}   		
       		if (VSF("personextrafields")) { PHP_Link_Output("Define extra people database fields","PERSONEXTRADEF"); }
       		PHP_Link_Output("Upload a batch of people records to the site","PERSONUPLOAD");
    		PHP_Link_Output("Download a batch of people records from the site","PERSONDOWNLOAD");
    		PHP_Link_Output("Upload a batch of new people records","PERSONADDUPLOAD");		
       		if (VSF("personmembership")) {      		
    			PHP_Link_Output("Mass confirmation of people records information","MASSDETAILSNOTIFYNEW");
    	   		PHP_Link_Output("Set Membership Form Text","MEMBERSHIPFORMTEXT");
    	   		PHP_Link_Output("Send Membership Reminders","MASSMEMBERSHIPNOTIFY");
    	   		PHP_Link_Output("Payment Options","PAYMENTOPTION"); 
    	   		PHP_Link_Output("Membership Analysis","MEMBERSHIPANALYSIS");
    	   		PHP_Link_Output("Review Person Database Integrity","PERSONDBINTEGRITY");   
       		}		   		  		
       	}
       }
       B_TABCONTENTITEM();
      }    	
     }
     if (VSA($sbits,"org")) {
      if ( $orglevel > 1) { 
       BTABCONTENTITEM("Org");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/org.gif"); 
       XH5("Organisation");     	
       PHP_Link_Output("Update the Organisation","ORG");
       PHP_Link_Output("View All Organisation Roles","ORGDETAIL");
       XH5("Sections");
       PHP_Link_Output("Define the sections within the club","SECTION");
       PHP_Link_Output("Define the groups within the club","SECTIONGROUP");
       B_TABCONTENTITEM();
      }  	
     }
     
     if (VSA($sbits,"webpages")) {
      if ($webpageslevel > 1) {
       BTABCONTENTITEM("Webpages");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/webpages.gif"); 
       XH5("Webpage Tools");   
       if ($webpageslevel > 2) {PHP_Link_Output("Edit Menus","MENUUPDATE"); }    
       if ($webpageslevel > 2) {PHP_Link_Output("Edit Webpages","WEBPAGECOMPOSERLIST"); } 
       if (VSF("articles")) { PHP_Link_Output("Edit Articles","ARTICLEUPDATELIST"); }
       if (VSF("events")) { PHP_Link_Output("Edit Events","EVENTUPDATELIST"); }
       if (VSF("draws")) { PHP_Link_Output("Edit Raffles","DRAWUPDATELIST"); }
       if (VSF("courses")) { PHP_Link_Output("Edit Courses","COURSEUPDATELIST"); }  
       PHP_Link_Output("Bulletin Creation","WUBul");    
       if ($webpageslevel > 2) { PHP_Link_Output("Bulletin Board Management","SETUPBULLETINBOARD"); }
       if ($webpageslevel > 2) { PHP_Link_Output("Knowledgebase Structure","KBSECTION"); }
       // if ($webpageslevel > 2) {Perl_Link_Output("Download Web Survey Results","WEBSURVEYDOWNLOAD"); } 
       if ($webpageslevel > 1) { 
       	if (VSF("newsletters")) {  
    	    XH5("Newsletter Tools");   
    	   	// PHP_Link_Output("Latest Match Reports","NEWSLASTWEEKSRESULTS");	
    	   	PHP_Link_Output("Newsletter Composer","NEWSLETTERCOMPOSER");    	
    	    XH5("Facebook Tools");   	
    	   	PHP_Link_Output("Upcoming Fixtures","FBNEXTWEEKSSCHEDULE");
    	   	PHP_Link_Output("Latest Match Reports","FBLASTWEEKSRESULTS"); 
       	}	
       }       
       if ($webpageslevel > 3) {   
        XH5("Web Style Management");
        PHP_Link_Output("Edit Templates","TEMPLATEUPDATELIST");
        PHP_Link_Output("Edit Template Elements","TEMPLATEELEMENTUPDATELIST"); 
        PHP_Link_Output("Edit Side Bars","SIDEBARCOMPOSERLIST");
        PHP_Link_Output("Edit Carousel Images","CAROUSELUPDATE");
        PHP_Link_Output("Republish All Templates, Webpages and Menus","WEBSITEPUBLISHALL");
        PHP_Link_Output("Republish All Webpages","WEBPAGEPUBLISHALL");
        // Perl_Link_Output("WebPage Cleanup","WUClean"); # CHECK 
        if (VSF("articles")) { PHP_Link_Output("Setup Article Categories","SETUPARTICLECATEGORY");  }    
        if (VSF("events")) { PHP_Link_Output("Setup Event Categories","SETUPEVENTCATEGORY"); }    
    	if (VSF("courses")) { PHP_Link_Output("Setup Course Categories","SETUPCOURSECATEGORY"); }
       }
       if ($webpageslevel > 3) {
       	XH5("Utilities");
       	if ($GLOBALS{'LOGIN_person_id'} == "bbra") { PHP_Link_Output("Templates Utility - BBOnly","TEMPLATEUTILITY"); }
       	if ($GLOBALS{'LOGIN_person_id'} == "bbra") { PHP_Link_Output("Template Elements Utility - BBOnly","TEMPLATEELEMENTUTILITY"); }
    	PHP_Link_Output("WebPages Utility","WEBPAGEUTILITY");	
    	if (VSF("articles")) { PHP_Link_Output("Articles Utility","ARTICLEUTILITY"); }   	
    	if (VSF("events")) { PHP_Link_Output("Events Utility","EVENTUTILITY"); }
       }
       B_TABCONTENTITEM();
      }   	
     } 
    
     /*
     if (VSA($sbits,"mobilepages")) {
      if ($mobilepageslevel > 1) {
       BTABCONTENTITEM("Mobile");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/mobilepages.gif");      	 	
       XH5("Mobile Style Management"); 	
       if ( $GLOBALS{'service_mobilepages'} != "" ) { 
        Perl_Link_Output("Update mobile web style","MOBILESTYLE"); 
       }   
       if ($GLOBALS{'LOGIN_mode_id'} == "0" ) {  
        Perl_Link_Output("Update studio mobile web styles","STUDIOMOBILESTYLELIST"); 
       }   
       B_TABCONTENTITEM();
      }   	
     }  
     */
     
     if (VSA($sbits,"reporting")) {
         if ($reportinglevel > 0) {    
        	BTABCONTENTITEM("Reporting");
        	XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/reporting.gif");	
        	XH5("Run Reports");
        	PHP_Link_Output("Ad Hoc Reports","REPORTLIST");
        	PHP_Link_Output("Custom PDF Reports","MPDFREPORTLIST");
        	XH5("Mass Updates");
        	PHP_Link_Output("Mass Update Forms","MASSUPDATELIST");
        	XH5("Export Information");	 		
        	PHP_Link_Output("Export to Spreadsheet - CSV","EXPORTLIST");
          	if ($reportinglevel > 1) { 		  		
          		XH5("Setup Reports");		
          		PHP_Link_Output("Design Ad Hoc Reports","SETUPREPORTLIST");
          		PHP_Link_Output("Design Custom PDF Reports","SETUPMPDFREPORTLIST");
          		XH5("Setup Exports");
          		PHP_Link_Output("Setup CSV exports","SETUPEXPORTLIST");
          		XH5("Mass Update");
          		PHP_Link_Output("Setup Mass Update Forms","SETUPMASSUPDATELIST");
          		XH5("Field Definitions");
          		PHP_Link_Output("Print PDF of Report Field Names","SETUPFIELDPRINT");
          		PHP_Link_Output("Setup Report Field Names","SETUPFIELD");
          		PHP_Link_Output("Auto-Generate Report Field Names","SETUPFIELDAUTO");
         	}
         	B_TABCONTENTITEM();
        }
     } 
     
     if (VSA($sbits,"advertising")) {
      if ($advertisinglevel > 1) {
       BTABCONTENTITEM("Advertising");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/advertising.gif");      	 	
       XH5("Advertising Management"); 	   
       PHP_Link_Output("New - View, update or create advertiser information","ADVERTISER");
       PHP_Link_Output("New - View, update or create advertiser categories","ADVERTISERCATEGORY");      
       B_TABCONTENTITEM();
      } 	
     }
    
     if (VSA($sbits,"auction")) {
      if ($advertisinglevel > 1) {
       BTABCONTENTITEM("Auction");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/auction.gif");      	 	
       XH5("Auction Management"); 	    
       PHP_Link_Output("Setup Auction Event","SETUPAUCTIONEVENT");
       PHP_Link_Output("Setup Auction Categories","SETUPAUCTIONCATEGORY");
       PHP_Link_Output("Receive Item (Paper Input)","AUCTIONPAPERRECEIPT");
       PHP_Link_Output("Receive Item (Online Input)","AUCTIONONLINERECEIPT");         
       PHP_Link_Output("Manage Inputs","MANAGEAUCTIONINPUTS");
       PHP_Link_Output("Manage Catalogue","MANAGEAUCTIONCATALOGUE");
       PHP_Link_Output("Manage Sales","MANAGEAUCTIONSALES");        
       PHP_Link_Output("Generate Catalogue Print","AUCTIONCATALOGUEPRINT");
       PHP_Link_Output("Generate Print for Auctioneer","AUCTIONAUCTIONEERPRINT");
       PHP_Link_Output("Administration Print - sorted by Category/Lot number","AUCTIONLOTADMINPRINT");
       PHP_Link_Output("Administration Print - sorted by Input Ref","AUCTIONINPUTIDADMINPRINT");   
       PHP_Link_Output("Administration Print - sorted by Vendor Name","AUCTIONVENDORADMINPRINT");   
       PHP_Link_Output("Sales Receipt Print","AUCTIONSALEPRINT");     
       B_TABCONTENTITEM();
      } 	
     }
      
     if (VSA($sbits,"library")) {
      if ($librarylevel > 0) {    
       BTABCONTENTITEM("Library");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/library.gif");      	 	
       XH5("View Library"); 	    
       PHP_Link_Output("View Documents in Library","LIBRARYVIEW");
       if ($librarylevel > 1) {
        XH5("Update Library"); 	    	
        // PHP_Link_Output("View, update or create asset category information","ASSETCATEGORYLIST");
        PHP_Link_Output("Maintain or Add Documents to Library","LIBRARYMAINTAIN"); 
       }
       if ($librarylevel > 2) { PHP_Link_Output("Define Library Structure","LIBRARYSECTION"); }    
       B_TABCONTENTITEM();
      }    	
     } 
     if (VSA($sbits,"accreditation")) {
      if ($accreditationlevel > 0) {   
       BTABCONTENTITEM("Accreditation");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/accreditation.gif");      	 	
       XH5("View Accreditation");     
       PHP_Link_Output("View Accreditation Criteria and Documents","ACCREDVIEW");
       // if ($accreditationlevel > 1) {
        XH5("Update Accreditation");    	
        if ($accreditationlevel > 0) { PHP_Link_Output("Setup Accreditation Schemes","ACCREDSCHEME"); }    
        if ( $GLOBALS{'service_library'} != "" ) { PHP_Link_Output("Maintain Accreditation Information","ACCREDMAINTAIN");}
        if ( $GLOBALS{'service_library'} != "" ) { PHP_Link_Output("Inspect Accreditation Information","ACCREDINSPECT");}  
        XBR();XBR();
        if ($GLOBALS{'LOGIN_domain_id'} == "havanthockeyclub") {
            $link = YPGMLINK("accredmaintainlistout.php").YPGMSTDPARMS();
            $link = $link.YPGMPARM("accredscheme_id","ClubsFirstV5").YPGMPARM("accredcriteria_clubid","havanthockeyclub");
            XLINKTXT($link,"View Previous Clubs First Response");
        }
        
       // }
       B_TABCONTENTITEM();
      }    	
     }
     if (VSA($sbits,"newsletters")) {
      if ($newsletterslevel > 0) {   
    #  BTABCONTENTITEM("Newsletters");
    #  XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/newsletters.gif");      	 	
    #  XH5("View Newsletters");     	
    #  Perl_Link_Output("View previously published newsletters","ACTIONSVIEW"); 	
    #  B_TABCONTENTITEM();
      }	
     } 
     if (VSA($sbits,"actions")) {
      if ($actionslevel > 0) {   
       BTABCONTENTITEM("Actions");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/actions.gif");      	 	
       XH5("View Actions");     	
       PHP_Link_Output("View my actions list","ACTIONSVIEWNEW");    	
       B_TABCONTENTITEM();
      } 
     }
      
     if (VSA($sbits,"bookings")) {
      if ($bookingslevel > 0) {
       BTABCONTENTITEM("Bookings");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/bookings.gif");
       if (VSF("courses")) {      	 	
    	   XH5("Course Administration");    
    	   PHP_Link_Output("Course Admin","COURSEADMINLIST");
    	   PHP_Link_Output("Attendee Admin","COURSEATTENDEEUTILITY");
    	   PHP_Link_Output("Download Lists","COURSEDOWNLOADLIST");
    	   if ($bookingslevel > 1) {
    	   	PHP_Link_Output("Setup Courses","COURSEUPDATELIST");
    	   	PHP_Link_Output("Setup Course Categories","SETUPCOURSECATEGORY");
    	   	PHP_Link_Output("Setup Schools/Colleges","SETUPCOURSESCHOOL");
    	   	if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
    	   		PHP_Link_Output("Courses Utility - BBOnly","COURSEUTILITY");
    	   	}
    	   }
       }  
       if (VSF("events")) {
    	   XH5("Event Administration");
    	   PHP_Link_Output("Bookable Events Admin","EVENTADMINLIST");
    	   PHP_Link_Output("Edit Events","EVENTUPDATELIST");
       } 
       if (VSF("draws")) {
    	   XH5("Raffle Administration");   
    	   PHP_Link_Output("Raffle Admin","DRAWADMINLIST");      
    	   if ($bookingslevel > 1) {
    	   	   PHP_Link_Output("Setup Raffles","DRAWUPDATELIST");	   	
    	   	   PHP_Link_Output("Setup Raffle Categories","SETUPDRAWCATEGORY");    	    	
    	   	   PHP_Link_Output("Raffles Utility","DRAWUTILITY");
    	   	   PHP_Link_Output("Raffle Transactions Utility","DRAWTXNUTILITY");
    	   }
       }
       if (VSF("bookings")) {  
    	   XH5("Venue Bookings");
    	   	PHP_Link_Output("Manage Bookings","BOOKINGADMINLIST");
    	   	if ($bookingslevel > 1) {
    	   		PHP_Link_Output("Setup Venues","VENUE");
    	   		PHP_Link_Output("View Venue Schedules","VENUESCHEDULELIST");  
    	   		PHP_Link_Output("Master Scheduler","MASTERSCHEDULER");
    	   		PHP_Link_Output("Bookings Utility","BOOKINGUTILITYLIST");
    	   	}
       }
       	
       B_TABCONTENTITEM();
      }
      
     }
     if (VSA($sbits,"shop")) {
      if ($shoplevel > 0) { 
       BTABCONTENTITEM("Shop"); 
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/shop.gif");      	 	
       XH5("Shop");       
       PHP_Link_Output("Order items from the Shop","SHOPPING");
       if ($shoplevel > 1) {
        XH5("Shop Administation");      	
        PHP_Link_Output("Shop configuration","SETUPSHOP");
        // Perl_Link_Output("View, update or create shop catalogue information","CATALOGUELIST");
       }
       B_TABCONTENTITEM();
      }      	
     } 
     if (VSA($sbits,"frs")) {
      if ($frslevel > 0) { 
       BTABCONTENTITEM("Results");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/frs.gif");  
       XH5("My availability");      
       PHP_Link_Output("Update my Match Availability","MYAVAILABILITY");
       PHP_Link_Output("Choose my Shirt Number","SHIRTNUMBERCHOOSER");
       if ($frslevel > 1) {
        XH5("Update");       
        PHP_Link_Output("Update Team Fixtures, Selection and Results","FRSUPDATEMENU");    
        if ($GLOBALS{'LOGIN_person_id'} == "bbra") {  PHP_Link_Output("Team Squad","FRSSQUADCHOOSER");  }  
        PHP_Link_Output("Selection Summary","FRSSELECTIONSUMMARYMENU");   
        if ($frslevel > 2) {
         XH5("Advanced");        
         PHP_Link_Output("Define the teams within the club","TEAM");       
         PHP_Link_Output("Define the sections within the club","SECTION"); 
         PHP_Link_Output("Define the Clubs home match venues","VENUE");
         PHP_Link_Output("Define selection and match statistics","FRSPERSONSTATTYPES");
         PHP_Link_Output("Recalculate Statistics","FRSRECALCULATESTATS");     
         // Perl_Link_Output("Establish Network Links","NETWORKS"); 
         // Perl_Link_Output("Index of Opposition Clubs","OPPOCLUBSLIST"); 
         PHP_Link_Output("Upload a batch of fixtures to the site","FRSUPLOAD");
         PHP_Link_Output("Download a batch of fixtures from the site","FRSDOWNLOAD");
         PHP_Link_Output("Send Match Reminder Emails","TEAMREMINDER");
         PHP_Link_Output("Shirt Number Administration","SHIRTNUMBERADMIN");
         PHP_Link_Output("Shirt Number - Person Reset","SHIRTNUMBERPERSONRESET");
        }
       } 	
       B_TABCONTENTITEM();
      } 
     }
    
     if (VSA($sbits,"fin")) {
      if ( $finlevel > 0) {
       BTABCONTENTITEM("Fin");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/fin.gif");  
       XH5("Financial Management");       
       PHP_Link_Output("Upload Bank Transactions","UPLOADBANK");
       PHP_Link_Output("Allocate Bank Transactions","ALLOCATEBANK"); 
       PHP_Link_Output("Petty Cash","CASHBOOK");
       PHP_Link_Output("Travel Log","TRAVELLOG");    
       PHP_Link_Output("Mileage","MILEAGE"); 
       PHP_Link_Output("Payroll","PAYROLL");  
       PHP_Link_Output("Dividends","DIVIDEND");  
       PHP_Link_Output("Sales Invoices","SALESINVOICE");  
       PHP_Link_Output("Purchase Accounts","PURCHASEINVOICE");
       PHP_Link_Output("Home Office Expenses","HOMEOFFICE"); 
       PHP_Link_Output("Financial Assets","FINASSET");
       PHP_Link_Output("Depreciation","DEPRECIATIONTXN");          
       XH5("Accountant Interface and Reports");         
       PHP_Link_Output("Extract Information for Accountant","EXTRACTFORACCOUNTANT");
       PHP_Link_Output("VAT report","VATREPORT");   
       XH5("Setup"); 
       PHP_Link_Output("Setup Company","SETUPCOMPANY");
       PHP_Link_Output("Setup Company VAT Status","SETUPCOMPANYVATSTATUS");
       PHP_Link_Output("Setup Company Financial Categories","SETDEFAULTFINCATEGORIES");       
       PHP_Link_Output("Setup Allocation Rules","SETUPALLOCATION");             
       PHP_Link_Output("Setup Bank Accounts","SETUPBANK");
       PHP_Link_Output("Setup Suppliers","SETUPSUPPLIER"); 
       PHP_Link_Output("Setup Customers","SETUPCUSTOMER");  
       PHP_Link_Output("Setup Jobs","SETUPJOB"); 
       PHP_Link_Output("Setup Mileage Favourite Destinations","SETUPMILEAGEFAVOURITE");
       PHP_Link_Output("Setup Home Office Parameters","SETUPHOMEOFFICE");        
       PHP_Link_Output("Setup Payroll Status","SETUPCWPERSON");
       PHP_Link_Output("Update Reference Data","UPDATECWREFERENCEDATA");   
       XH5("Advanced");
       PHP_Link_Output("Setup Bank Upload Formats","SETUPBANKUPLOADFORMAT");  
       PHP_Link_Output("Bank Upload - CSV Format Wizard","BANKUPLOADFORMATWIZARD");    
       PHP_Link_Output("Setup Financial Categories","SETUPFINCATEGORY");      
       PHP_Link_Output("Import Financial Categories","IMPORTFINCATEGORY");     
       PHP_Link_Output("Convert Financial Categories","CONVERTFINCATEGORY");
       PHP_Link_Output("Setup VAT Rates","SETUPVATRATE");
       PHP_Link_Output("Setup VAT Flat Rates","SETUPVATFLATRATE");         
       PHP_Link_Output("Setup Mileage Parameters","SETUPMILEAGEPARM");
       PHP_Link_Output("Setup Fuel Parameters","SETUPFUELPARM");      
       PHP_Link_Output("Setup Transaction Templates","SETUPTXNTEMPLATE");             
       PHP_Link_Output("Setup Transaction Favourites","SETUPTXNFAVOURITE");         
       B_TABCONTENTITEM();
      } 	
     } 
     if (VSA($sbits,"process")) {
      if ( $processlevel > 0) {
       BTABCONTENTITEM("Process");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/process.gif");  
       XH5("Process Management");      
       PHP_Link_Output("View Task Calendar","VIEWTASKCALENDAR");
       XH5("Setup");      
       PHP_Link_Output("Refresh Task Calendar","SETUPTASKCALENDAR");
       PHP_Link_Output("Setup Process Templates","SETUPPROCESSTEMPLATE"); 
       PHP_Link_Output("Setup Non-Workdays","SETUPNONWORKDAY"); 
       PHP_Link_Output("Setup Roles","SETUPPROCESSROLE");
       B_TABCONTENTITEM();
      } 	
     }
     if (VSA($sbits,"pos")) {
      if ( $poslevel > 0) {
       BTABCONTENTITEM("Pos");
       XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/pos.gif");
       XH5("Point of Sale");      
       PHP_Link_Output("Create a New Receipt","NEWRECEIPT");
       PHP_Link_Output("List of Receipts","VIEWRECEIPT");
       PHP_Link_Output("Update Receipts","SETUPRECEIPT");   
       PHP_Link_Output("List of Receipt Items","VIEWRECEIPTITEM");
       PHP_Link_Output("Update Receipt Items","SETUPRECEIPTITEM");
       PHP_Link_Output("Post Sales on Big Commerce","BCPOSTPOSSALES");    
       XH5("Stock Management");      
       PHP_Link_Output("Update Local Stock List","ADDTOSTOCK");
       PHP_Link_Output("Update Stock and List an Big Commerce","BCSTOCKUPDATE");   
       XH5("Big Commerce Options and Rules");
       PHP_Link_Output("Product Categories","SETUPBCPRODUCTCATEGORY");    
       PHP_Link_Output("Product Options","SETUPBCOPTION");
       PHP_Link_Output("Product Option Sets","SETUPBCOPTIONSET");
       PHP_Link_Output("Product Rules","SETUPBCPRODUCTRULES");
       PHP_Link_Output("Synchronise Product Rules with Big Commerce","BCPRODUCTRULESSYNCH");
       XH5("Webpages");
       PHP_Link_Output("Big Commerce Custom  Webpages","BCWEBPAGES");
       XH5("Setup");
       PHP_Link_Output("Big Commerce communication settings","SETUPBCACCESS");   
       PHP_Link_Output("POS settings","SETUPPOS");   
       PHP_Link_Output("POS Feeder Devices","SETUPPOSFEEDER");        
       PHP_Link_Output("VAT Rates","SETUPVATRATE"); 
       B_TABCONTENTITEM();
      } 	
     }   
    
     if (VSA($sbits,"cor")) {
         if ( $corlevel > 0) {
             BTABCONTENTITEM("Cor");
             XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/property.gif");
             XH5("Property Management");
             PHP_Link_Output("Property Management - Active Sites","CORSITELISTACTIVE");
             PHP_Link_Output("Property Management - Full Site List","CORSITELISTFULL");
             if ( $corlevel > 2) {
                 XH5("Setup");
                 PHP_Link_Output("Setup Outlets","SETUPCOROUTLETCO");
                 if ( $corlevel > 3) {
                     PHP_Link_Output("Setup Suppliers","SETUPCORSUPPLIER");
                     PHP_Link_Output("Setup Accounts","SETUPCORACCOUNT");
                     PHP_Link_Output("Setup Outlet Classes","SETUPCOROUTLETCLASS");
                     PHP_Link_Output("Setup Survey Types","SETUPCORSURVEYCATEGORY");
                     PHP_Link_Output("Setup Project Phases","SETUPCORPHASE");
                     PHP_Link_Output("Setup Site Classifications","SETUPCORCLASSIFICATION");
                     PHP_Link_Output("Setup Approval Status Types","SETUPAPPROVALSTATUS");
                     PHP_Link_Output("Setup Schemes","SETUPCORSCHEME");
                     PHP_Link_Output("Setup Site Types","SETUPCORSITETYPE");
                     PHP_Link_Output("Setup Users","SETUPCORUSER");
                     PHP_Link_Output("Setup Programmes","SETUPCORPROGRAMME");
                 }
                 if ( $corlevel > 3) {
                     XH5("Default Values");
                     PHP_Link_Output("Default Values","SETUPCORDEFAULTVALUE");
                     XH5("Utilities");
                     PHP_Link_Output("Unlock All Sites","CORSITEUNLOCK");
                     PHP_Link_Output("Classify All Sites","CORSITECLASSIFY");
                     PHP_Link_Output("ReCalculate All Sites","CORSITERECALC");
                 }
                 if ($GLOBALS{'LOGIN_person_id'} == "bbra") {
                      XH5("Data Load");
                     PHP_Link_Output("ARK Data Load","CORARKUPLOAD");
                     PHP_Link_Output("SAGE Data Load","CORSAGEUPLOAD");
                     PHP_Link_Output("Land Registry Data Load","CORLANDREGISTRYUPLOAD");
                     PHP_Link_Output("Re-Import CSV files","UPLOAD");
                     PHP_Link_Output("Site Adhoc Data Load","CORSITEADHOCUPLOAD");                                 
                     XH5("Transition Data Loads - BB only");
                     PHP_Link_Output("Commercial Property Table Create","CORCOMMCREATE");
                     PHP_Link_Output("Initial Master Tracker Data Reset and Load","CORRESETHISTORYUPLOAD");
                     PHP_Link_Output("Master Tracker Data Load","CORMASTERHISTORYUPLOAD");
                     PHP_Link_Output("Image Data Load","CORIMGHISTORYUPLOAD");
                     PHP_Link_Output("ORIG 2 COPY","CORORIG2COPY");
                     PHP_Link_Output("COPY 2 NEW","CORCOPY2NEW");
                 }
             }
             B_TABCONTENTITEM();
         }
     } 
     
     
     if (VSA($sbits,"dmws")) {
     	if ( $dmwslevel > 0) {
     		BTABCONTENTITEM("DMWS");
     		XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/people.gif");
     		XH5("Service User Management");
     		PHP_Link_Output("Service User Management - My Open Cases","DMWSSULISTOPEN");
     		PHP_Link_Output("Service User Management - My Closed Cases","DMWSSULISTCLOSED");
     		PHP_Link_Output("Synchronise DMWS Data","DMWSCLIENTSYNCHRONISE");
     		PHP_Link_Output("Synchronise App Software","DMWSCLIENTAPPSYNCHRONISE");
     		
     		XBR();
     		if ( $dmwslevel > 2) {
     				XH5("Setup Reference Tables");
     				PHP_Link_Output("Setup Contracts","SETUPDMWSCONTRACT");
     				PHP_Link_Output("Setup Contract Locations","SETUPDMWSCONTRACTLOCATION");
     				PHP_Link_Output("Setup Services","SETUPDMWSSERVICE");
     				PHP_Link_Output("Setup Service Status","SETUPDMWSSERVICESTATUS");
     				XBR();
     				PHP_Link_Output("Setup Medical Location Types","SETUPDMWSLOCATIONTYPE");
     				PHP_Link_Output("Setup Admission Types","SETUPDMWSADMISSIONTYPE");
     				PHP_Link_Output("Setup Admission Reasons","SETUPDMWSADMISSIONREASON");
     				PHP_Link_Output("Setup DMWS Service Types","SETUPDMWSSERVICETYPE");
     				XBR();
     				PHP_Link_Output("Setup Referral Organisations","SETUPDMWSREFERRALORG");
     				PHP_Link_Output("Setup Contact Types","SETUPDMWSCONTACTTYPE");
     				PHP_Link_Output("Setup Visit Locations","SETUPDMWSVISITLOCATION");
     				XBR();
     				PHP_Link_Output("Setup Time Bands","SETUPDMWSTIMEBAND");
     				PHP_Link_Output("Setup Complexity Types","SETUPDMWSCOMPLEXITYTYPE");
     				XBR();
     				PHP_Link_Output("Setup Titles","SETUPDMWSTITLE");
     				PHP_Link_Output("Setup Genders","SETUPDMWSGENDER");
     				PHP_Link_Output("Setup Disability Types","SETUPDMWSDISABILITYTYPE");
     				PHP_Link_Output("Setup Caring Responsibility Types","SETUPDMWSCARINGRESPONSIBILITYTYPE");
     				PHP_Link_Output("Setup SU Feedback Types","SETUPDMWSSUFEEDBACKTYPE");
     				PHP_Link_Output("Setup Specialist Referral Org types","SETUPDMWSSPECIALISTREFERRALORG");
     				PHP_Link_Output("Setup MOD Specific Info types","SETUPDMWSMODSPECIFICTYPE");
     				PHP_Link_Output("Setup Equality and Diversity Options","SETUPDMWSEQDIVOPTIONS");
     				PHP_Link_Output("Setup Current Occupational Status Types","SETUPDMWSOCCUPATIONALISSUETYPE");
     				PHP_Link_Output("Setup Previous Occupation Types","SETUPDMWSPREVIOUSOCCUPATIONTYPE");
     				PHP_Link_Output("Setup Referrer Org Types","SETUPDMWSREFERRERORGTYPE");
     				PHP_Link_Output("Setup Consent Withdrawal Types","SETUPDMWSCONSENTWITHDRAWALTYPE");
     				XBR();
     				PHP_Link_Output("Setup Primary Care Types","SETUPDMWSPRIMARYCARETYPE");
     				PHP_Link_Output("Setup Secondary Care Types","SETUPDMWSSECONDARYCARETYPE");
     				PHP_Link_Output("Setup Independent Living Types","SETUPDMWSINDEPENDENTLIVINGTYPE");
     				PHP_Link_Output("Setup Social Isolation Types","SETUPDMWSSOCIALISOLATIONTYPE");
     				PHP_Link_Output("Setup Employment Types","SETUPDMWSEMPLOYMENTTYPE");
     				XBR();
     				PHP_Link_Output("Setup Support Communication Types","SETUPDMWSSUPPORTCOMMUNICATIONTYPE");
     				PHP_Link_Output("Setup Events Communication Types","SETUPDMWSEVENTSCOMMUNICATIONTYPE");
     				PHP_Link_Output("Setup Report Communication Types","SETUPDMWSREPORTCOMMUNICATIONTYPE");
     				XBR();
     				PHP_Link_Output("Setup SU Safeguarding Issue Types","SETUPDMWSSAFEGUARDINGISSUETYPE");
     				PHP_Link_Output("Setup WO Safeguarding Issue Types","SETUPDMWSWOSAFEGUARDINGISSUETYPE");
     				PHP_Link_Output("Setup SU Safeguardee Types","SETUPDMWSSAFEGUARDEETYPE");
     				PHP_Link_Output("Setup SU Safeguardee Reason Types","SETUPDMWSSAFEGUARDEEREASONTYPE");
     				
     				XH5("Utilities");
     				PHP_Link_Output("Data Cleanup","DMWSDATACLEANUP");
     				PHP_Link_Output("DMWS Data Remove","DMWSDATAREMOVE");
     				PHP_Link_Output("DMWS Client Application Updates","DMWSCLIENTAPPSYNCHRONISE");
     				PHP_Link_Output("DMWS Client Application Repair","DMWSCLIENTAPPREPAIR");
     				PHP_Link_Output("DMWS Date Fix","DMWSDATEFIX");
     				PHP_Link_Output("DMWS Location Fix","DMWSLOCATIONFIX");
     				PHP_Link_Output("DMWS Expected/Actual LOS Calculation Fix","DMWSCOMPLEXITYUTILITY");
     				PHP_Link_Output("DMWS Wellbeing Data Reset","DMWSWELLBEINGFIX");
     				PHP_Link_Output("DMWS Mandatory Fields Fix","DMWSMANDFIELDSFIX");
     		}
     		B_TABCONTENTITEM();
     	}
     } 
     
     if (VSA($sbits,"grl")) {
         if ($grllevel > 0) {
             BTABCONTENTITEM("GRL");
             XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/frs.gif");
             XH5("Update");
             PHP_Link_Output("Update Team Fixtures, Selection and Results","GRLUPDATEMENU");
             PHP_Link_Output("Recalculate Statistics","GRLRECALCULATESTATS");
             XH5("Setup");
             PHP_Link_Output("Setup League Competitions","SETUPGRLLEAGUE");
             PHP_Link_Output("Setup Cup Competitions","SETUPGRLCUP");
             PHP_Link_Output("Setup Clubs","SETUPGRLCLUB");
             PHP_Link_Output("Setup Teams","SETUPGRLTEAM");
             PHP_Link_Output("Setup Venues","SETUPGRLVENUE");
             PHP_Link_Output("Setup Players","SETUPGRLPLAYER");
             PHP_Link_Output("Setup Officials","SETUPGRLOFFICIAL");
             PHP_Link_Output("Setup Match Statistics","SETUPGRLPLAYERSTATTYPES");
    
             XH5("Advanced");
             PHP_Link_Output("Upload a batch of fixtures to the site","GRLUPLOAD");
             PHP_Link_Output("Download a batch of fixtures from the site","GRLDOWNLOAD");         
             PHP_Link_Output("Plugin Tester","GRLPLUGINTEST");
             PHP_Link_Output("Results Importer","GRLRESULTSIMPORTER");
             
             B_TABCONTENTITEM();
         }
     }
     
     if (VSA($sbits,"sfm")) {
         if ( $sfmlevel > 0) {
             BTABCONTENTITEM("SFM");
             XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/facilities.gif");
             XH5("Sports Property Management");
             PHP_Link_Output("Facilities Management - Club List","SFMSETLIST");
             if ( $sfmlevel > 2) {
                 
                 if ( $sfmlevel > 3) {
                     XH5("Setup");
                     PHP_Link_Output("Setup Sets","SETUPSFMSET");
                     PHP_Link_Output("Setup Club","SETUPSFMCLUB");
                     PHP_Link_Output("Setup Leagues/Divisions","SETUPSFMLEAGUE");
                     PHP_Link_Output("Setup County Associations","SETUPSFMCOUNTY");
                     PHP_Link_Output("Setup NGB","SETUPSFMNGB");
                     XBR();
                     PHP_Link_Output("Setup Pitch Types","SETUPSFMPITCH");
                     PHP_Link_Output("Setup Pitch Manufacturers","SETUPSFMPITCHMANUFACTURER");
                     PHP_Link_Output("Setup Pitch Contractors","SETUPSFMPITCHCONTRACTOR");                     
                     XBR();
                     PHP_Link_Output("Setup Floodlight Manufacturers","SETUPSFMFLOODLIGHTMANUFACTURER");
                     PHP_Link_Output("Setup Floodlight Contractors","SETUPSFMFLOODLIGHTCONTRACTOR");                     
                     PHP_Link_Output("Setup Floodlight Ground Type","SETUPSFMFLOODLIGHTGROUNDTYPE");
                     PHP_Link_Output("Setup Floodlight Base Type","SETUPSFMFLOODLIGHTBASETYPE");
                     PHP_Link_Output("Setup Floodlight Column Type","SETUPSFMFLOODLIGHTCOLUMNTYPE");
                     PHP_Link_Output("Setup Floodlight Ballast Type","SETUPSFMFLOODLIGHTBALLASTTYPE");
                     PHP_Link_Output("Setup Floodlight Capacitor Type","SETUPSFMFLOODLIGHTCAPACITORTYPE");
                     PHP_Link_Output("Setup Floodlight Lamp Type","SETUPSFMFLOODLIGHTLAMPTYPE");
                     PHP_Link_Output("Setup Floodlight Fixture Type","SETUPSFMFLOODLIGHTFIXTURETYPE");
                     PHP_Link_Output("Setup Floodlight Igniter Type","SETUPSFMFLOODLIGHTIGNITERTYPE");
                     PHP_Link_Output("Setup Floodlight Meters","SETUPSFMFLOODLIGHTMETER");
                     PHP_Link_Output("Setup Companies","SETUPSFMCOMPANY");
                     XBR();
                     PHP_Link_Output("Setup Visit Type","SETUPSFMVISITTYPE");
                     PHP_Link_Output("Setup Rectification Type","SETUPSFMRECTIFICATIONTYPE");                     
                     PHP_Link_Output("Setup Review Conditions","SETUPSFMREVIEWCONDITIONS");
               
                     XH5("Utilities");
                     PHP_Link_Output("Update Club Summary Data","SFMCLUBSUMMARYGENERATE");
                     PHP_Link_Output("Floodlight Spec Generate","SFMFLOODLIGHTSPECGENERATE");
                     PHP_Link_Output("Replicate Columns and Fixtures","SFMREPLICATEALL");
                     PHP_Link_Output("DeReplicate Columns and Fixtures","SFMDEREPLICATEALL");
                     PHP_Link_Output("Mass Load SFM Accreditation Criteria Data","SFMACCREDCRITERIADATAUPLOAD");
                 }
             }
             B_TABCONTENTITEM();
         }
     } 
     
     if (VSA($sbits,"care")) {
         if ( $carelevel > 0) {
             BTABCONTENTITEM("CARE");
             XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/people.gif");
             XH5("Care Service Management");
             
             B_TABCONTENTITEM();
             XH5("Setup Menu");
             PHP_Link_Output("Setup Titles","SETUPCARETITLE");
             PHP_Link_Output("Setup Genders","SETUPCAREGENDER");
         }
     } 
     
     
    }
      
    if ($advancedlevel > 0) {
     BTABCONTENTITEM("Advanced");
     XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/advanced.gif"); 
     
     if ( $GLOBALS{'LOGIN_mode_id'} == "0" ) {
     	XH5("Site Account Management");
     	PHP_Link_Output("Account Management","ACCOUNT"); 
     } 
     
     XH5("Update Control Information"); 
     PHP_Link_Output("Change the domain long and short titles","TITLES");
     PHP_Link_Output("Define the sections within the organisation","SECTION"); 
     PHP_Link_Output("Define the DomainMasters","DOMAINMASTERS");
     PHP_Link_Output("Define the CommsMasters","COMMSMASTERS"); 
     PHP_Link_Output("Set the current time period","PERIOD"); 
     PHP_Link_Output("Set cookies for this machine","COOKIES"); 
     if (VSA($sbits,"frs")) {
     	PHP_Link_Output("Configure Sport Parameters","SPORT");
     } 
     XH5("Backup/Recovery and other Tools");
     PHP_Link_Output("Download information from the site","DOWNLOAD"); 
     PHP_Link_Output("Upload information to the site","UPLOAD"); 
     // Perl_Link_Output("Remove information from the site - i.e. Reset","RESET");
     // Perl_Link_Output("Calculate the size of the site","SITESIZE");
     PHP_Link_Output("SQL Database Upgrade","SQLMAINTAIN");  
     PHP_Link_Output("Create Manual SQL Backup","SQLBACKUP");
     PHP_Link_Output("Recover data from SQL Dumps","SQLDUMPRECOVER"); 
     
     XH5("Configuration");
     PHP_Link_Output("Domain Service Configuration","SETUPDOMAINSERVICE");
     PHP_Link_Output("Email and Messaging Configuration","SETUPSITEEMAILMSG"); 
     PHP_Link_Output("Site Application Version","SETUPSITEAPPVERSION"); 
     PHP_Link_Output("Domain Configuration","SETUPDOMAIN");
     PHP_Link_Output("Plugin Categories","PLUGINCATEGORY");  
     PHP_Link_Output("Plugin Utility","PLUGINUTILITY");
     // Perl_Link_Output("Create a new Account","NEWACCOUNT");  
     // Perl_Link_Output("Update my account","CLUB");
     
     if (($GLOBALS{'LOGIN_mode_id'} == "0")||($GLOBALS{'LOGIN_person_id'} == "bbra")) {
         XH5("Configuration Utilities");
         PHP_Link_Output("Site Configuration","SETUPSITE");
         PHP_Link_Output("Service Configuration","SETUPSERVICE");
         PHP_Link_Output("Package Configuration","SETUPPACKAGE");
         PHP_Link_Output("Domain Service Enablement","SETUPSERVICEENABLED");
     }
     
    
     if (($GLOBALS{'LOGIN_person_id'} == "bbra")||($GLOBALS{'LOGIN_person_id'} == "mche") ) {
         XH5("Utilities");
         PHP_Link_Output("Special PHP Utility 1","PHPUTILITY1");
         PHP_Link_Output("Special PHP Utility 2","PHPUTILITY2");
         PHP_Link_Output("Special PHP Utility 3","PHPUTILITY3");
         PHP_Link_Output("Special PHP Utility 4 - Bulletin Converter","PHPUTILITY4");
         PHP_Link_Output("Special PHP Utility 5 - Webpage Converter","PHPUTILITY5");
         PHP_Link_Output("Special PHP Utility 6 - Course Converter","PHPUTILITY6");
         PHP_Link_Output("Special PHP Utility 7 - Away Venue & Date Converter","PHPUTILITY7");
         PHP_Link_Output("Special PHP Utility 8 - Library Asset Date converter","PHPUTILITY8");
         PHP_Link_Output("Special PHP Utility 9 - Reset Membership Records","PHPUTILITY9");
         PHP_Link_Output("Special PHP Utility A - Consolidate Paired Tables","PHPUTILITYA");
         PHP_Link_Output("Special PHP Utility B - BPMN2 Documenter","PHPUTILITYB");
         PHP_Link_Output("Special PHP Utility C - DMWS Complexity","PHPUTILITYC");
         PHP_Link_Output("Special PHP Utility D - Webpage Composer Upgrade","PHPUTILITYD");
         PHP_Link_Output("Special PHP Utility E - Create ServiceEnabled Table","PHPUTILITYE");
         PHP_Link_Output("Special PHP Utility F - Speech Recognition","PHPUTILITYF");
         PHP_Link_Output("Special PHP Utility G - Speech Recognition - Grid","PHPUTILITYG");
         PHP_Link_Output("Special PHP Utility H - Asset Converter","PHPUTILITYH");
         PHP_Link_Output("Special PHP Utility I - Accreditation Converter","PHPUTILITYI");
         PHP_Link_Output("Special PHP Utility J - Ground Grading Cleanup","PHPUTILITYJ");
     }
     B_TABCONTENTITEM();
    }
    
    if ($PHPlevel > 0) {
     BTABCONTENTITEM("PHP");
     PHP_Link_Output("Demo - SQL","DEMOSQL");
     PHP_Link_Output("Demo - Basic Formatting","DEMOBASE");
     PHP_Link_Output("Demo - Calendar","DEMOCALENDAR");
     PHP_Link_Output("Demo - Navigation","DEMONAVIGATION");
     PHP_Link_Output("Demo - Popup","DEMOPOPUP");
     B_TABCONTENTITEM();
    }
    
    BTABCONTENTITEM("Authority");
    XBR();XIMGFLEX($GLOBALS{'site_asseturl'}."/authority.gif");   
    XH5("Authority"); 
    XTXT($GLOBALS{'person_authoritymessage'});
    // XH5("Authority Text");
    // XTXT($GLOBALS{'person_authority'});
    B_TABCONTENTITEM();
    
    B_TABCONTENTCONTAINER();
    B_TABDIV();

} # End of Classic Menu structure

}

function Perl_Link_Output ($parm0, $parm1) {
XTXT("&nbsp;-&nbsp;");
$link = YPGMLINK("personloginselectin.cgi").YPGMSTDPARMS().YPGMPARM("SelectId",$parm1);
XLINKTXT($link,$parm0);XBR();
}
function PHP_Link_Output ($parm0, $parm1) {
XTXT("&nbsp;-&nbsp;");
$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId",$parm1);
XLINKTXT($link,$parm0);XBR();
}


?>
