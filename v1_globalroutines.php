<?php

function GlobalRoutine () {
    //   print "Content-type: text/html\n\n";		
    //   print "<P>----- TRACE HEADER ------<BR>";
    
    Set_Statics();	
    
    $GLOBALS{'IOERRORcode'} = "G002";
    $GLOBALS{'IOERRORmessage'} = "siteconfref.txt not found";
    $siteconfrefa = Get_File_Array("siteconfref.txt");
    $siteconfref = $siteconfrefa[0];
    
    Check_File("$siteconfref/cgi-files/".$GLOBALS{'LOGIN_service_id'}."siteconf.txt");
    if ( $GLOBALS{'IOWARNING'} == "0" ) {	
    	$GLOBALS{'IOERRORcode'} = "G003a";
    	$GLOBALS{'IOERRORmessage'} = $GLOBALS{'LOGIN_service_id'}."siteconf.txt not found";
    	$sqlconnecta = Get_File_Array("$siteconfref/cgi-files/".$GLOBALS{'LOGIN_service_id'}."siteconf.txt");	
    } else {
    	$GLOBALS{'IOERRORcode'} = "G003b";
    	$GLOBALS{'IOERRORmessage'} = "siteconf.txt not found";
    	$sqlconnecta = Get_File_Array("$siteconfref/cgi-files/siteconf.txt");
    }
    
    $sqla = explode("|",$sqlconnecta[0]);
    $dbconnect = $sqla[0];    
    if (strlen(strstr($dbconnect,"multidb"))>0) {
        $dbconnect = str_replace("multidb", $GLOBALS{'LOGIN_service_id'}, $dbconnect); # for testing setup
    }
    $hostconnect = $sqla[1];
    if ((sizeof($sqla) == 5)&&($sqla[4] == "E")) {
     $userconnect = XCrypt($sqla[2],"c0nnect1ve","decrypt");
     $pswconnect = XCrypt($sqla[3],"c0nnect1ve","decrypt");
    } else {
     $userconnect = $sqla[2];
     $pswconnect = $sqla[3];
    }
    IODBCONNECT($dbconnect,$hostconnect,$userconnect,$pswconnect);
    IOSETUP();      
    Get_Data("site_".$GLOBALS{'LOGIN_service_id'});
    $GLOBALS{'codeversion'} = 'v1';
    Get_Data("domain");

    if ($GLOBALS{'site_extradirectory'} == "") {$slashplusurlrootdirectory = "";}
    else {$slashplusurlrootdirectory = "/".$GLOBALS{'site_extradirectory'};}  
    
    if ($GLOBALS{'LOGIN_mode_id'} == "0") {
     if ($GLOBALS{'domain_actualurl'} == "") { $GLOBALS{'domainwwwurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory; }
     else { $GLOBALS{'domainwwwurl'} = "//".$GLOBALS{'domain_actualurl'}; }
     $GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory; // route from site to avoid cors issue
     $GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'};
     $GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}; 
    } 
    if ($GLOBALS{'LOGIN_mode_id'} == "1") {
     if ($GLOBALS{'domain_actualurl'} == "") {  $GLOBALS{'domainwwwurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory; }
     else { $GLOBALS{'domainwwwurl'} = "//".$GLOBALS{'domain_actualurl'}; }
     $GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory;
     $GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'};
     $GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}; 
    } 
    if (($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {
     if ($GLOBALS{'domain_actualurl'} == "") {  $GLOBALS{'domainwwwurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'LOGIN_domain_id'}; }
     else { $GLOBALS{'domainwwwurl'} = "//".$GLOBALS{'domain_actualurl'}; }
     $GLOBALS{'domainwwwcorsurl'} = $GLOBALS{'site_wwwurl'}.$slashplusurlrootdirectory."/".$GLOBALS{'LOGIN_domain_id'};
     $GLOBALS{'domainwwwpath'} = $GLOBALS{'site_wwwpath'}."/".$GLOBALS{'LOGIN_domain_id'};
     $GLOBALS{'domainfilepath'} = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}; 
    }

    if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"-"))>0) { $bits = explode("-",$GLOBALS{'LOGIN_service_id'}); $serviceid = $bits[0]; }
    else { $serviceid = $GLOBALS{'LOGIN_service_id'};  }
    if ($GLOBALS{'LOGIN_mode_id'} == "0") {Get_Data("service_".$serviceid."SITE");} 
    else {Get_Data("service_".$serviceid."DOMAIN");}
    if ($GLOBALS{'LOGIN_mode_id'} != "1") { Check_Data("serviceenabled"); } 
    
    $GLOBALS{'markerbite'} = 4;
    $GLOBALS{'resultsbite'} = 4;
    $GLOBALS{'personbite'} = 20;
    $GLOBALS{'adderbite'} = 3;
    $GLOBALS{'countrytel'} = "44";
    $GLOBALS{'countrycurrencysymbol'} = '&pound;';
    $GLOBALS{'webstyletroddeven'} = "even";
    $GLOBALS{'webstyletableinvisible'} = "0";
    
    # ------------- Set Global Dates -----------------------------------------
    $systemdate = $GLOBALS{'site_systemdate'} ;
    if ($GLOBALS{'domain_systemdate'} != "") { $systemdate = $GLOBALS{'domain_systemdate'}; }
    if ($systemdate == "SYSTEM") {	
     date_default_timezone_set('UTC');		
     $GLOBALS{'dd'}=date("d"); $GLOBALS{'mm'}=date("m"); $GLOBALS{'yyyy'}=date("Y"); $GLOBALS{'yy'}=date("y");
     $GLOBALS{'actdd'}=date("d"); $GLOBALS{'actmm'}=date("m"); $GLOBALS{'actyyyy'}=date("Y"); $GLOBALS{'actyy'}=date("y");
    } else {
        $bits = str_split($systemdate); 		
     $GLOBALS{'dd'}=$bits[6].$bits[7]; $GLOBALS{'mm'}=$bits[4].$bits[5]; $GLOBALS{'yyyy'}=$bits[0].$bits[1].$bits[2].$bits[3]; $GLOBALS{'yy'}=$bits[2].$bits[3];  
     $GLOBALS{'actdd'}=date("d"); $GLOBALS{'actmm'}=date("m"); $GLOBALS{'actyyyy'}=date("Y"); $GLOBALS{'actyy'}=date("y");
    }
    $GLOBALS{'acthh'}=date("H");
    $GLOBALS{'actmi'}=date("i");
    $GLOBALS{'actss'}=date("s");
    $GLOBALS{'currentYYYYMMDD'} = $GLOBALS{'yyyy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'};
    $GLOBALS{'currentYYYYMMDDHHMMSS'} = $GLOBALS{'yyyy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'};
    $GLOBALS{'currenttimestamp'} = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'};
    $GLOBALS{'currenttimestampunique'} = "T".$GLOBALS{'currentYYYYMMDDHHMMSS'}.substr(str_shuffle("0123456789"), 0, 4);
    $GLOBALS{'currentYYYY-MM-DD'} = $GLOBALS{'yyyy'}."-".$GLOBALS{'mm'}."-".$GLOBALS{'dd'}; 
    $GLOBALS{'STATIC_1900'} = ""; $sep = "";
    for ($x = 1900; $x <= intval($GLOBALS{'yyyy'});  $x++) {
    	$GLOBALS{'STATIC_1900'} = $GLOBALS{'STATIC_1900'}.$sep.$x;	$sep = ",";
    }
    $GLOBALS{'STATIC_1990'} = ""; $sep = "";
    for ($x = 1990; $x <= intval($GLOBALS{'yyyy'})+5;  $x++) {
    	$GLOBALS{'STATIC_1990'} = $GLOBALS{'STATIC_1990'}.$sep.$x;	$sep = ",";
    }
    // Get_Data("webstyle","Final");
    $GLOBALS{'currperiodid'} = $GLOBALS{'domain_currperiodid'};
    $GLOBALS{'specialkey'} = "KB8Aw17N71";

}

// ------------- Header & Footer -----------------------------------------

function PageHeader ($parm0, $parm1){ 

    if ($GLOBALS{'domain_actualurl'} != "") {  
        header("Access-Control-Allow-Origin: http://".$GLOBALS{'domain_actualurl'});
    }
    global $globaldynamicadvertiser;
    $GLOBALS{'LOGIN_frame_id'} = "D";
    # webstyle_name Temp/Final
    $GLOBALS{'headertype'} = "PageHeader";
    $filename = "Template"."_".$parm0."_".$parm1.".html";
    $fullfilename = $GLOBALS{'domainwwwpath'}."/domain_style/".$filename;
    $GLOBALS{'IOERRORcode'} = "G033";
    $GLOBALS{'IOERRORmessage'} = $GLOBALS{'domainwwwpath'}."/domain_style/$filename not found";
    $hpage = Get_File_Array("$fullfilename");
    $section=1;
    foreach ($hpage as $message) {
     if (strlen(strstr($message,"START_CSSJSOPTIONAL"))>0) {
      print "<!-- START_CSSJSOPTIONAL -->\n";
      XTINYMCEJS ($GLOBALS{'TINYMCEJSOPTIONAL'});  
      XYUICSS ($GLOBALS{'YUICSSOPTIONAL'});
      XYUI3CSS ($GLOBALS{'YUI3CSSOPTIONAL'});  
      XYUIJS ($GLOBALS{'YUIJSOPTIONAL'});
      XYUI3JS ($GLOBALS{'YUI3JSOPTIONAL'});  
      XSITECSS ($GLOBALS{'SITECSSOPTIONAL'});
      XSITEJS ($GLOBALS{'SITEJSOPTIONAL'});
      XEXTERNALJS ($GLOBALS{'EXTERNALJSOPTIONAL'});
     }	
     if (strlen(strstr($message,'START_MAINCONTENT'))>0) {
     	print "<!-- START_MAINCONTENT -->\n"; $section=2;
     }
     if (strlen(strstr($message,'END_MAINCONTENT'))>0) { $section=3;}
     if ($section == 1) {print "$message\n";}
    }
    if (($GLOBALS{'site_testdata'} == "ON")||($GLOBALS{'site_simulation'} != "OFF")||($GLOBALS{'site_readonly'} == "ON")||
    	($GLOBALS{'domain_testdata'} == "ON")||($GLOBALS{'domain_simulation'} != "OFF")||($GLOBALS{'domain_readonly'} == "ON")) {	
    	print '<TABLE width = "100%" BORDER=0 CELLSPACING=0 CELLPADDING=0>'."\n";
    	print '<TR align="right">'."\n";
    	print '<TD width = "100%" bgcolor="#EEEEEE">'."\n";
    	if (($GLOBALS{'site_testdata'} == "ON")||($GLOBALS{'domain_testdata'} == "ON")) {
    	  $tabname = $GLOBALS{'site_asseturl'}."/testdata.gif";
    	  print "<IMG WIDTH=200 HEIGHT=20 SRC=$Q$tabname$Q>\n";
    	}
    	if (($GLOBALS{'site_simulation'} == "ON")||($GLOBALS{'domain_simulation'} == "ON")) {		
    	  $tabname = $GLOBALS{'site_asseturl'}."/simulation.gif";
    	  print "<IMG WIDTH=200 HEIGHT=20 SRC=$Q$tabname$Q>\n";
    	}
    	if (($GLOBALS{'site_readonly'} == "ON")||($GLOBALS{'domain_readonly'} == "ON")) {	
    	  $tabname = $GLOBALS{'site_asseturl'}."/readonly.gif";
    	  print "<IMG WIDTH=200 HEIGHT=20 SRC=$Q$tabname$Q>\n";
    	}
    	X_TD();X_TR();
    	XTR();XTD();
    	$noadvertising = "0";
    	X_TD();X_TR();
    	X_TABLE();
    }
    // XPTXT("");
}

function PageFooter ($parm0, $parm1) {
    # webstyle_name Temp/Final	
    print "<P></P>\n";
    $filename = "Template"."_".$parm0."_".$parm1.".html";   
    $fullfilename = $GLOBALS{'domainwwwpath'}."/domain_style/".$filename;
    $GLOBALS{'IOERRORcode'} = "G034";
    $GLOBALS{'IOERRORmessage'} = $GLOBALS{'domainwwwpath'}."/domain_style/$filename not found";
    $fpage = Get_File_Array("$fullfilename");
    $section=1;
    $endflag = "0";
    foreach ($fpage as $message) {
     if (strlen(strstr($message,"START_POPUPCORE"))>0) {
      print "<!-- START_POPUPCORE -->\n";
      // if ($GLOBALS{'LOGIN_session_id'} != "") {
      	# Logged in
      	XSITEPOPUPS ($GLOBALS{'SITEPOPUPHTML'});
      }
     // }	
     if (strlen(strstr($message,'START_MAINCONTENT'))>0) {$section=2;}
     if (strlen(strstr($message,'END_MAINCONTENT'))>0) {
     	XINHIDID ("JSLoginModeId","JSLoginModeId",$GLOBALS{'LOGIN_loginmode_id'});
      	XINHIDID ("JSFrameId","JSFrameId",$GLOBALS{'LOGIN_frame_id'}); 	
     	XINHIDID ("JSMenuId","JSMenuId",$GLOBALS{'LOGIN_menu_id'});
     	XINHIDID ("JSCanvasId","JSCanvasId",$GLOBALS{'LOGIN_canvas_id'});
      	if ($GLOBALS{'LOGIN_session_id'} != "") {   # Logged in
     		XINHIDID ("JSPersonId","JSPersonId",$GLOBALS{'LOGIN_person_id'});
     		XINHIDID ("JSSessionId","JSSessionId",$GLOBALS{'LOGIN_session_id'});
     		XINHIDID ("JSTimeOut","JSTimeOut",$GLOBALS{'domain_timeoutminutes'});
     	}	 	 	
     	print "<!-- END_MAINCONTENT -->\n"; $section=3;
     }
     if ($section == 3) {
      if ($endflag == "0") {$endflag = "1";} else {print "$message\n";}
     }
    }
}

function FBHeader () {
    // print "Content-type: text/html\n\n";
    $GLOBALS{'LOGIN_frame_id'} = "F";
    $GLOBALS{'headertype'} = "FBHeader";
    XHEAD();
    // XDOMAINCSS ("webstyle");
    XSITEJS ($GLOBALS{'SITEJSPOPUPCORE'});
    XSITEJS ($GLOBALS{'SITEJSOPTIONAL'});
    XCSS();
    XTXT("body { background-image: none;}");
    XTXT("body { background-color: white;}"); 
    XTXT(".bodyclass #pagecontainer { background-image: none;}");
    XTXT(".bodyclass #pagecontainer { background-color: white;}"); 
    XTXT(".bodyclass #header { background-image: none;}");
    XTXT(".bodyclass #header { background-color: white;}"); 
    XTXT(".bodyclass #page { background-image: none;}");
    XTXT(".bodyclass #page { background-color: white;}");
    
    if ( $GLOBALS{'LOGIN_canvas_id'} == "F" ) {
    	print '
    	body { 
    	   font-size:10pt; 
    	   font-family:Arial; 
    	   color:Navy; 
    	   text-align: left; 
    	}
    	p { 
    	   font-size:10pt; 
    	   font-family:Arial; 
    	   color:Navy; 
    	   text-align: left; 
    	} 
    	h1.h1main { text-align: left; font-size:14pt; font-family:Arial; color:Navy;} 
    	h2.h2main { text-align: left; font-size:13pt; font-family:Arial; color:Green;} 
    	h3.h3main { text-align: left; font-size:12pt; font-family:Arial; color:Navy;} 
    	h4.h4main { text-align: left; font-size:11pt; font-family:Arial; color:Navy;} 
    	h5.h5main { text-align: left; font-size:10pt; font-family:Arial; color:Navy;} 
    	h6.h6main { text-align: left; font-size:9pt; font-family:Arial; color:Navy;} 
    	a:link { 
    	   color:Navy; 
    	   text-decoration:none;  
    	   font-weight:normal;
    	   font-family:Arial; 
    	} 
    	a:active { 
    	   color:Blue; 
    	   text-decoration:none;   
    	   font-weight:normal;
    	   font-family:Arial; 
    	} 
    	a:visited { 
    	   color:Navy; 
    	   text-decoration:none;  
    	   font-weight:normal;
    	   font-family:Arial;
    	} 
    	a:hover { 
    	   color:Green; 
    	   text-decoration:none;   
    	   font-weight:normal;
    	   font-family:Arial; 
    	} 
    	.tablemain {
    	    border-collapse: collapse;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 1px;
    	    margin: 1px;
    	    text-align: left;
    	}
    	.tablemain th {
    	    background-color: #d9d9db;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 1px;
    	    color: Black;
    	    font-family: Arial;
    	    font-size: 10pt;
    	    font-weight: normal;
    	    padding: 4px;
    	    vertical-align: top;
    	}
    	.tablemain .even td {
    	    background-color: #edf5ff;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 0 1px 0 0;
    	    color: Navy;
    	    font-family: Arial;
    	    font-size: 10pt;
    	    padding: 4px;
    	    vertical-align: top;
    	}
    	.tablemain .odd td {
    	    background-color: white;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 0 1px 0 0;
    	    color: Navy;
    	    font-family: Arial;
    	    font-size: 10pt;
    	    padding: 4px;
    	    vertical-align: top;
    	}
    	.tablemain tr:hover td {
    	    background-color: #dbeaff;
    	}
    	.tablemain .tableinvisible table {
    	    border-width: 0;
    	}
    	.tablemain .tableinvisible td {
    	    border-width: 0;
    	}
    	';	
    } else {  // mobile
    	print '
    	body { 
    	   font-size:30pt; 
    	   font-family:Arial; 
    	   color:Navy; 
    	   text-align: left; 
    	} 
    	p { 
    	   font-size:30pt; 
    	   font-family:Arial; 
    	   color:Navy; 
    	   text-align: left; 
    	} 
    	h1.h1main { text-align: left; font-size:42pt; font-family:Arial; color:Navy;} 
    	h2.h2main { text-align: left; font-size:38pt; font-family:Arial; color:Green;} 
    	h3.h3main { text-align: left; font-size:34pt; font-family:Arial; color:Navy;} 
    	h4.h4main { text-align: left; font-size:30pt; font-family:Arial; color:Navy;} 
    	h5.h5main { text-align: left; font-size:26pt; font-family:Arial; color:Navy;} 
    	h6.h6main { text-align: left; font-size:22pt; font-family:Arial; color:Navy;} 
    	a:link { 
    	   color:Navy; 
    	   text-decoration:none;  
    	   font-weight:normal;
    	   font-family:Arial; 
    	} 
    	a:active { 
    	   color:Blue; 
    	   text-decoration:none;   
    	   font-weight:normal;
    	   font-family:Arial; 
    	} 
    	a:visited { 
    	   color:Navy; 
    	   text-decoration:none;  
    	   font-weight:normal;
    	   font-family:Arial;
    	} 
    	a:hover { 
    	   color:Green; 
    	   text-decoration:none;   
    	   font-weight:normal;
    	   font-family:Arial; 
    	} 
    	.tablemain {
    	    border-collapse: collapse;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 1px;
    	    margin: 1px;
    	    text-align: left;
    	}
    	.tablemain th {
    	    background-color: #d9d9db;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 1px;
    	    color: Black;
    	    font-family: Arial;
    	    font-size: 30pt;
    	    font-weight: normal;
    	    padding: 4px;
    	    vertical-align: top;
    	}
    	.tablemain .even td {
    	    background-color: #edf5ff;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 0 1px 0 0;
    	    color: Navy;
    	    font-family: Arial;
    	    font-size: 30pt;
    	    padding: 4px;
    	    vertical-align: top;
    	}
    	.tablemain .odd td {
    	    background-color: white;
    	    border-color: Gray;
    	    border-style: solid;
    	    border-width: 0 1px 0 0;
    	    color: Navy;
    	    font-family: Arial;
    	    font-size: 30pt;
    	    padding: 4px;
    	    vertical-align: top;
    	}
    	.tablemain tr:hover td {
    	    background-color: #dbeaff;
    	}
    	.tablemain .tableinvisible table {
    	    border-width: 0;
    	}
    	.tablemain .tableinvisible td {
    	    border-width: 0;
    	}
    	';	
    }
    
    
    
    
    X_CSS();
    X_HEAD();
    XBODY("bodyclass");
    
    XDIV("page","");
}

function FBFooter () {
 	if ($GLOBALS{'LOGIN_session_id'} != "") {   # Logged in
 		XINHIDID ("JSPersonId","JSPersonId",$GLOBALS{'LOGIN_person_id'});
 		XINHIDID ("JSSessionId","JSSessionId",$GLOBALS{'LOGIN_session_id'}); 	 
 	}
	X_DIV("page");
	X_BODY();
	if ($GLOBALS{'LOGIN_session_id'} != "") {   # Logged in
		XSITEPOPUPS ($GLOBALS{'SITEPOPUPHTML'});
	}
	X_HTML();
}


function PopUpHeader () {
    $GLOBALS{'LOGIN_frame_id'} = "P";
    $GLOBALS{'headertype'} = "PopUpHeader";
    // print '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'."\n";
    print '<!DOCTYPE html>'."\n";
    print '<html>'."\n";
    print '<head>'."\n";    
    print '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >'."\n";
    print '<meta name="viewport" content="width=device-width, initial-scale=1"  >'."\n"; 
    echo '<script src="'.$GLOBALS{'site_templateurl'}.'/js/v1_jquery.js"></script>'."\n";
    echo '<script src="'.$GLOBALS{'site_templateurl'}.'/js/v1_bootstrap.min.js"></script>'."\n";
    echo '<script src="'.$GLOBALS{'site_jsurl'}.'/v1_jqueryuimin.js"></script>'."\n";
    echo '<link href="'.$GLOBALS{'site_templateurl'}.'/css/v1_bootstrap.css" rel="stylesheet">'."\n";
    echo '<link href="'.$GLOBALS{'site_templateurl'}.'/css/v1_template.css" rel="stylesheet">'."\n";
    echo '<link href="'.$GLOBALS{'site_templateurl'}.'/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">'."\n";
    echo '<link href="'.$GLOBALS{'site_cssurl'}.'/v1_jqpopup.css" rel="stylesheet">'."\n";
    echo '<link href="'.$GLOBALS{'site_cssurl'}.'/v1_jqueryui.css" rel="stylesheet">'."\n";
    echo '<link rel="stylesheet" type="text/css" href="'.$GLOBALS{'domainwwwurl'}.'/domain_style/Webstyle_Default_Final.css" />'."\n";
    // XDOMAINCSS ("Webstyle_Default_Final");
    XTINYMCEJS ($GLOBALS{'TINYMCEJSOPTIONAL'});  
    // XYUICSS ($GLOBALS{'YUICSSOPTIONAL'});
    // XYUIJS ($GLOBALS{'YUIJSOPTIONAL'});
    XSITECSS ($GLOBALS{'SITECSSOPTIONAL'});
    XSITEJS ($GLOBALS{'SITEJSPOPUPCORE'});
    XSITEJS ($GLOBALS{'SITEJSOPTIONAL'});
    
    XCSS();
    XTXT("body { background-image: none;}");
    XTXT("body { background-color: white;}");
    XTXT("body { padding-top: 0px;}"); 
    XTXT(".bodyclass #pagecontainer { background-image: none;}");
    XTXT(".bodyclass #pagecontainer { background-color: white;}"); 
    XTXT(".bodyclass #header { background-image: none;}");
    XTXT(".bodyclass #header { background-color: white;}"); 
    XTXT(".bodyclass #page { background-image: none; }");
    XTXT(".bodyclass #page { background-color: white;}");
    XTXT(".bodyclass #page { margin: 25px;}"); 
    X_CSS();
    X_HEAD();
    XBODY("bodyclass");
    XINHIDID ("JSServiceId","JSServiceId",$GLOBALS{'LOGIN_service_id'});
    XINHIDID ("JSDomainId","JSDomainId",$GLOBALS{'LOGIN_domain_id'});
    XINHIDID ("JSModeId","JSModeId",$GLOBALS{'LOGIN_mode_id'});
    XINHIDID ("JSSitePHPURL","JSSitePHPURL",$GLOBALS{'site_phpurl'});
    XINHIDID ("JSSitePerlURL","JSSitePerlURL",$GLOBALS{'site_perlurl'});
    XINHIDID ("JSSiteWWWURL","JSSiteWWWURL",$GLOBALS{'site_wwwurl'});
    XINHIDID ("JSSiteWWWPath","JSSiteWWWPath",$GLOBALS{'site_wwwpath'});
    XINHIDID ("JSSiteFilePath","JSSiteFilePath",$GLOBALS{'site_filepath'});
    XINHIDID ("JSDomainWWWURL","JSDomainWWWURL",$GLOBALS{'domainwwwurl'});
    XINHIDID ("JSDomainWWWPath","JSDomainWWWPath",$GLOBALS{'domainwwwpath'});
    XINHIDID ("JSDomainFilePath","JSDomainFilePath",$GLOBALS{'domainfilepath'});
    XINHIDID ("JSCodeVersion","JSCodeVersion",$GLOBALS{'codeversion'});
    XINHIDID ("JSTimeOut","JSTimeOut",$GLOBALS{'domain_timeoutminutes'});
    XINHIDID ("JSActualURL","JSActualURL",$GLOBALS{'domain_actualurl'});
    XINHIDID ("JSCanvasId","JSCanvasId",$GLOBALS{'LOGIN_canvas_id'});
    XDIV("page","");
}

function PopUpFooter () {
    if ($GLOBALS{'LOGIN_session_id'} != "") {   # Logged in
     	XINHIDID ("JSPersonId","JSPersonId",$GLOBALS{'LOGIN_person_id'});
     	XINHIDID ("JSSessionId","JSSessionId",$GLOBALS{'LOGIN_session_id'}); 
     	XINHIDID ("JSCanvasId","JSCanvasId",$GLOBALS{'LOGIN_canvas_id'});
    }
    X_DIV("page");
    X_BODY();
    if ($GLOBALS{'LOGIN_session_id'} != "") {   # Logged in
    	XSITEPOPUPS ($GLOBALS{'SITEPOPUPHTML'});
    }
    X_HTML();
}

function ForcedExit () {
	$GLOBALS{'LOGIN_person_id'} = "";	
	$GLOBALS{'LOGIN_session_id'} = "";		
	if ( $GLOBALS{'headertype'} == "PageHeader") { PageFooter("Default", "Final"); }
	if ( $GLOBALS{'headertype'} == "PopUpHeader") { PopUpFooter(); }
	if ( $GLOBALS{'headertype'} == "FBHeader") { FBFooter(); }
	exit;
}

function Back_Navigator () {    
    if ($GLOBALS{'person_navigationpref'} == "Left") {
        $extraspace = '';
        if (array_key_exists('backnavigator', $GLOBALS)) { $extraspace = '<br>'; } else { $GLOBALS{'backnavigator'} = "TopDisplayed"; }
        print $extraspace.'<br><div align="left">'."\n"; 
    }
    else { print '<br><div align="right">'."\n"; }
    print '<table><tr>'."\n";
    if ( $GLOBALS{'LOGIN_canvas_id'} == "M" ) { $iconsize = "80"; } else { $iconsize = "30"; }
    $iconsize = "30";
    print '<td><a onClick="history.go(-1)"><img src="'.$GLOBALS{'site_asseturl'}."/navback.png".'" width="'.$iconsize.'" height="'.$iconsize.'" border="0" title="Go Back"/></a></td>';

    if ($GLOBALS{'LOGIN_session_id'} != "") {
        if (( $GLOBALS{'domain_sportid'} == "SO" )||($GLOBALS{'domain_sportid'} == "FH" )) {
            print '<td><a href="http://www.grassrootspower.club/Help.html" target="_help"><img src="'.$GLOBALS{'site_asseturl'}."/help.png".'" width="'.$iconsize.'" height="'.$iconsize.'" border="0" title="Help"/></a></td>';
        }        
        Go_Back_To_Menu("personreloginin.php","Classic");
        Go_Back_To_Menu("personreloginin.php","Dashboard");
    }
    print "</tr></table>\n";
    print "</div>\n";
    if ($GLOBALS{'person_navigationpref'} == "Left") { print '<br>'."\n"; }
}

function Go_Back_To_Menu ($parm1,$parm2) { # text pgm menu
    $link = YPGMLINK($parm1).YPGMSTDPARMS();
    if ($parm2 == "Classic") { 
    	$link = str_replace("MenuId=Dashboard","MenuId=Classic",$link);
    	$imgsrc = $GLOBALS{'site_asseturl'}."/navadvanced.png";
    	$tooltip = "Go To Advanced Menu";
    }
    if ($parm2 == "Dashboard") { 
    	$link = str_replace("MenuId=Classic","MenuId=Dashboard",$link);
    	$imgsrc = $GLOBALS{'site_asseturl'}."/navdashboard.png";
    	$tooltip = "Go To Dashboard";
    }	
    print '<td><a href="'.$link.'"><img src="'.$imgsrc.'" width="30" height="30" border="0" title="'.$tooltip.'"/></a></td>'."\n";
}

// ------------- common subroutines -----------------------------------------
function Get_Common_Parameters () {	
    require_once('Mobile_Detect.php');
    $detect = new Mobile_Detect;	
    $GLOBALS{'LOGIN_service_id'} = $_REQUEST["ServiceId"];
    $GLOBALS{'LOGIN_domain_id'} = $_REQUEST["DomainId"];
    $GLOBALS{'LOGIN_mode_id'} = $_REQUEST["ModeId"];
    if((isset($_REQUEST['PersonId'])&&$_REQUEST['PersonId']!="")) {$GLOBALS{'LOGIN_person_id'} = $_REQUEST["PersonId"];} else {$GLOBALS{'LOGIN_person_id'} ="";}
    if((isset($_REQUEST['SessionId'])&&$_REQUEST['SessionId']!="")) {$GLOBALS{'LOGIN_session_id'} = $_REQUEST["SessionId"];} else {$GLOBALS{'LOGIN_session_id'} ="";}
    if((isset($_REQUEST['LoginModeId'])&&$_REQUEST['LoginModeId']!="")) {$GLOBALS{'LOGIN_loginmode_id'} = $_REQUEST["LoginModeId"];} else {$GLOBALS{'LOGIN_loginmode_id'} ="";}
    if((isset($_REQUEST['MenuId'])&&$_REQUEST['MenuId']!="")) {$GLOBALS{'LOGIN_menu_id'} = $_REQUEST["MenuId"];} else {$GLOBALS{'LOGIN_menu_id'} =""; } 
    if((isset($_REQUEST['FrameId'])&&$_REQUEST['FrameId']!="")) {$GLOBALS{'LOGIN_frame_id'} = $_REQUEST["FrameId"];} else {$GLOBALS{'LOGIN_frame_id'} =""; }
    if( $detect->isMobile() && !$detect->isTablet() ) { $GLOBALS{'LOGIN_canvas_id'} = "M";}
    else {$GLOBALS{'LOGIN_canvas_id'} = "F";}
}

function Set_Person_Session () {
     $GLOBALS{'person_session'} = XCrypt($GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'},$GLOBALS{'LOGIN_person_id'},"encrypt");
     $GLOBALS{'person_sessiontime'} = time(); 
     $GLOBALS{'LOGIN_session_id'} = $GLOBALS{'person_session'};
     $GLOBALS{'readonlyoverride'} = "Yes";
     Write_Data("person",$GLOBALS{'LOGIN_person_id'});
     $GLOBALS{'readonlyoverride'} = "No";
}

function Set_Person_Mobile_Session () {
     $GLOBALS{'person_mobilesession'} = XCrypt($GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'},$GLOBALS{'LOGIN_person_id'},"encrypt");
     $mobilesession_id = $GLOBALS{'person_mobilesession'};
     $GLOBALS{'readonlyoverride'} = "Yes";
     Write_Data("person",$GLOBALS{'LOGIN_person_id'});
     $GLOBALS{'readonlyoverride'} = "No";
}

function Set_Menu () {
     $GLOBALS{'LOGIN_menu_id'} = "Classic";
     if (($GLOBALS{'LOGIN_mode_id'} == "1")||($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {
      $GLOBALS{'LOGIN_menu_id'} = "Dashboard";
     }
}

function ErrorRoutine () {
     echo "Content-type: text/html\n\n";	
     echo "<P>ErrorRoutine - An error has been encountered.";
    # if ($GLOBALS['context'] != "") { echo $GLOBALS['context'];  }
     echo "<P>Error Code - ".$GLOBALS{'IOERRORcode'};
     echo "<P>Error Message - ".$GLOBALS{'IOERRORmessage'};
     exit();
}
function WarningRoutine () {
     echo "<P>Warning - ".$GLOBALS{'IOWARNINGmessage'}."<BR>";
     $GLOBALS['IOWARNING'] = "1";
}
function SilentWarningRoutine () {
     $GLOBALS['IOWARNING'] = "1";
}

function Check_Session_Validity () {
    if ($GLOBALS{'LOGIN_loginmode_id'} == "0") {Check_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'}); } 
    else {Check_Data("person",$GLOBALS{'LOGIN_person_id'});}
    if ($GLOBALS{'IOWARNING'} == "0") {	
    	$validsession = "0";
    	if ($GLOBALS{'LOGIN_session_id'} == $GLOBALS{'person_session'}) {
    		$validsession = "1";
    	} else {
    		if (XCrypt($GLOBALS{'LOGIN_session_id'},$GLOBALS{'LOGIN_person_id'},"decrypt") == Remove_NonAplha($GLOBALS{'person_email1'})) {
    			$validsession = "1";
    		}
    		if (XCrypt($GLOBALS{'LOGIN_session_id'},$GLOBALS{'LOGIN_person_id'},"decrypt") == Remove_NonAplha($GLOBALS{'person_email2'})) {
    			$validsession = "1";
    		}
    		if (XCrypt($GLOBALS{'LOGIN_session_id'},$GLOBALS{'LOGIN_person_id'},"decrypt") == Remove_NonAplha($GLOBALS{'person_email3'})) {
    			$validsession = "1";
    		}
    		if ($GLOBALS{'LOGIN_session_id'} == "anonymous") {
    			$validsession = "1";
    		}
    	}
    	if ($validsession == "1") {
    		$thistime = time();
    		
    		$timediff = $thistime - $GLOBALS{'person_sessiontime'};
    		if ($GLOBALS{'domain_timeoutminutes'} == "") { $GLOBALS{'domain_timeoutminutes'} = "60"; }
    		$timediffmax = $GLOBALS{'domain_timeoutminutes'}*60;
    		// if ($GLOBALS{'LOGIN_person_id'} == "bbra") { $timediffmax = 30; }
    		if ($timediff > $timediffmax) {
    			XH3("Session Timed Out - Please Login again"); 
    			ForcedExit();
    		} else {
    			// XH3("OK - Still within timeout limit ".$timediff." of ".$timediffmax);
    			$GLOBALS{'person_sessiontime'} = $thistime;
    			Write_Data("person",$GLOBALS{'LOGIN_person_id'});
    		}	
    	} else { 
    		XH3("Error - Invalid Session"); 
    		ForcedExit();
    	}
    	
    } else {
    	XH3("Error - Invalid Personal Id"); 
    	ForcedExit();
    }
}	


function Check_UtilitySession_Validity () { 
	$validitystatus = false;
	if ($GLOBALS{'LOGIN_loginmode_id'} == "0") { Check_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'}); }
	else { Check_Data("person",$GLOBALS{'LOGIN_person_id'}); }
	if ($GLOBALS{'IOWARNING'} == "0") {
		$validsession = "0";
		if ($GLOBALS{'LOGIN_session_id'} == $GLOBALS{'person_session'}) {
			$validsession = "1";
		} else {
			if (XCrypt($GLOBALS{'LOGIN_session_id'},$GLOBALS{'LOGIN_person_id'},"decrypt") == Remove_NonAplha($GLOBALS{'person_email1'})) {
				$validsession = "1";
			}
			if (XCrypt($GLOBALS{'LOGIN_session_id'},$GLOBALS{'LOGIN_person_id'},"decrypt") == Remove_NonAplha($GLOBALS{'person_email2'})) {
				$validsession = "1";
			}
			if (XCrypt($GLOBALS{'LOGIN_session_id'},$GLOBALS{'LOGIN_person_id'},"decrypt") == Remove_NonAplha($GLOBALS{'person_email3'})) {
				$validsession = "1";
			}
			if ($GLOBALS{'LOGIN_session_id'} == "anonymous") {
				$validsession = "1";
			}
		}
		if ($validsession == "1") {
			$thistime = time();
			$timediff = $thistime - $GLOBALS{'person_sessiontime'};
			$timediffmax = 900;
			if ($timediff > $timediffmax) {
				$validitystatus = false;
			} else {
				$validitystatus = true;
				$GLOBALS{'person_sessiontime'} = $thistime;
				Write_Data("person",$GLOBALS{'LOGIN_person_id'});
			}
		} else {
			$validitystatus = false;
		}
	} else {
		$validitystatus = false;
	}
	return $validitystatus;
}


function Keep_Alive () {
	$validitystatus = "1";
	if ($GLOBALS{'LOGIN_loginmode_id'} == "0") {
		Check_Data("person_".$GLOBALS{'LOGIN_service_id'},$GLOBALS{'LOGIN_person_id'});
	}
	else { Check_Data("person",$GLOBALS{'LOGIN_person_id'}); }
	if ($GLOBALS{'IOWARNING'} == "0") {
		if ($GLOBALS{'LOGIN_session_id'} == $GLOBALS{'person_session'}) {
			$thistime = time();
			$GLOBALS{'person_sessiontime'} = $thistime;
			Write_Data("person",$GLOBALS{'LOGIN_person_id'});
			$validitystatus = "1";
		} else {
			$validitystatus = "0";
		}
	} else {
		$validitystatus = "0";
	}
	return $validitystatus;
}


function Get_Person_Authority () {
Get_Data('person',$GLOBALS{'LOGIN_person_id'});
$GLOBALS{'askingperson_fname'} = $GLOBALS{'person_fname'};
$GLOBALS{'askingperson_sname'} = $GLOBALS{'person_sname'};
$GLOBALS{'askingperson_section'} = $GLOBALS{'person_section'}.",";
$GLOBALS{'person_authority'} = ""; $GLOBALS{'person_authoritymessage'} = "";
$GLOBALS{'person_authoritymessage'} = "You have the following authorities assigned to you. <br/><br/>";
if ($GLOBALS{'LOGIN_person_id'} == "anonymous") {
 foreach (Get_Array_Hash("section",$GLOBALS{'currperiodid'}) as $section_name ) {
  Get_Data_Hash("section",$GLOBALS{'currperiodid'},$section_name);
  if ($GLOBALS{'section_libraryupdateall'} == "Yes") {
   $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."LU#SectionLU=".$section_name."#,";    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-Library Update<br/>";   	
  }  	
 } 
} else {
 $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-General Access<br/>";
 if (Authority_Scan($GLOBALS{'domain_domainmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."DM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-DomainMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_webmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."WM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-WebMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_resultsmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-ResultsMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_personmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-PersonMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_bookingmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."BM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-BookingMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_sponsormasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."SM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-SponsorMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_salesmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."PM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-SalesMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_adminmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."AM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-AdminMaster Authority<br/>";
 }
 if (Authority_Scan($GLOBALS{'domain_commsmasters'},$GLOBALS{'LOGIN_person_id'}) == "1") {
  $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."NM#Domain#,";
  $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-CommsMaster Authority<br/>";
 }
 foreach (Get_Array_Hash("section",$GLOBALS{'currperiodid'}) as $section_name ) {
  Get_Data_Hash("section",$GLOBALS{'currperiodid'},$section_name);
  if ($GLOBALS{'person_section'} == $section_name) {
   if ($GLOBALS{'section_libraryupdateall'} == "Yes") {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."LU#SectionLU=".$section_name."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-Library Update<br/>";   	
   }	  	
  }
 } 
 foreach (Get_Array_Hash("org") as $org_code ) {
  Get_Data_Hash("org",$org_code);	
  $targetstring = $GLOBALS{'org_personid'}.",";
  $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
  if (strlen(strstr($targetstring,"$searchstring"))>0) {
   $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."ORG#Domain#,";
  }
 }
 if ( $GLOBALS{'service_sections'} != "" ) {     
  foreach (Get_Array_Hash("section",$GLOBALS{'currperiodid'}) as $section_name ) {
   Get_Data_Hash("section",$GLOBALS{'currperiodid'},$section_name);
   $targetstring = $GLOBALS{'section_leader'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#SectionLeader=".$section_name."#,";
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#SectionLeader=".$section_name."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-$section_name Subsection Leader<br/>";
   }
   $targetstring = $GLOBALS{'section_resmgrs'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#SectionRM=".$section_name."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-Results Update for all teams in $section_name Subsection<br/>";
   }
   $targetstring = $GLOBALS{'section_personmgrs'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#SectionMM=".$section_name."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-People Update for $section_name Subsection<br/>";
   }
   $GLOBALS{'section_exdir_'.$section_name} = $GLOBALS{'section_exdir'};
  }
 }
 if ( $GLOBALS{'service_frs'} != "" ) {    
  foreach (Get_Array_Hash("team",$GLOBALS{'currperiodid'}) as $team_code) {
   Get_Data_Hash("team",$GLOBALS{'currperiodid'},$team_code);
   $targetstring = $GLOBALS{'team_resmgrs'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#TeamRM=".$team_code."#,";
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#TeamMM=".$team_code."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-People/Results Update for $GLOBALS{'team_name'} Team<br/>";
   }
   $targetstring = $GLOBALS{'team_captain'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#TeamCaptain=".$team_code."#,";
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#TeamCaptain=".$team_code."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-".$GLOBALS{'team_name'}." Team Captain<br/>";
   }
   $targetstring = $GLOBALS{'team_mgr'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#TeamMgr=".$team_code."#,";
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#TeamMgr=".$team_code."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-".$GLOBALS{'team_name'}." Team Manager<br/>";
   }
   $targetstring = $GLOBALS{'team_coach'}.",";
   $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#TeamCoach=".$team_code."#,";
    $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."RM#TeamCoach=".$team_code."#,";
    $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-".$GLOBALS{'team_name'}." Team Coach<br/>";
   }
  }  
 }
 
 if ( $GLOBALS{'service_sfm'} != "" ) {  
    $thisperson_id = $GLOBALS{'LOGIN_person_id'};
    $GLOBALS{'sfmuserclub'} = "";
    $GLOBALS{'sfmuserleague'} = "";
    $GLOBALS{'sfmuserdivision'} = "";
    $GLOBALS{'sfmusercounty'} = "";
    $GLOBALS{'sfmuserngb'} = "";
    $GLOBALS{'sfmuserset'} = "";
    $GLOBALS{'sfmuserrole'} = "";
    $GLOBALS{'sfmuserlevel'} = "";

    $sfmcluba = Get_Array('sfmclub');	
    foreach ($sfmcluba as $sfmclub_id) {
       Get_Data('sfmclub',$sfmclub_id);
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_adminpersonid'}) ) {
           $GLOBALS{'sfmuserclub'} = $GLOBALS{'sfmuserclub'}.$sfmclub_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Club".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_otheradminpersonidlist'}) ) {
           $GLOBALS{'sfmuserclub'} = $GLOBALS{'sfmuserclub'}.$sfmclub_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Club".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_otherreadonlypersonidlist'}) ) {
           $GLOBALS{'sfmuserclub'} = $GLOBALS{'sfmuserclub'}.$sfmclub_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Club".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."ReadOnly".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_floodinspectoridlist'}) ) {
           $GLOBALS{'sfmuserclub'} = $GLOBALS{'sfmuserclub'}.$sfmclub_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."FloodInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }      
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmclub_groundinspectoridlist'}) ) {
           $GLOBALS{'sfmuserclub'} = $GLOBALS{'sfmuserclub'}.$sfmclub_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."GroundInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
    }    
    
    $sfmleaguea = Get_Array('sfmleague');	
    foreach ($sfmleaguea as $sfmleague_id) {
        Get_Data('sfmleague',$sfmleague_id);
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmleague_adminpersonid'}) ) {
           $GLOBALS{'sfmuserleague'} = $GLOBALS{'sfmuserleague'}.$sfmleague_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."League".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
        }
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmleague_otheradminpersonidlist'}) ) {
           $GLOBALS{'sfmuserleague'} = $GLOBALS{'sfmuserleague'}.$sfmleague_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."League".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
        }
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmleague_otherreadonlypersonidlist'}) ) {
           $GLOBALS{'sfmuserleague'} = $GLOBALS{'sfmuserleague'}.$sfmleague_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."League".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."ReadOnly".",";
        }
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmleague_floodinspectoridlist'}) ) {
           $GLOBALS{'sfmuserleague'} = $GLOBALS{'sfmuserleague'}.$sfmleague_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."FloodInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
        }      
        if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmleague_groundinspectoridlist'}) ) {
           $GLOBALS{'sfmuserleague'} = $GLOBALS{'sfmuserleague'}.$sfmleague_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."GroundInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
        }
        $sfmdivisiona = Get_Array('sfmdivision',$sfmleague_id);	
        foreach ($sfmdivisiona as $sfmdivision_id) {
            Get_Data('sfmdivision',$sfmleague_id,$sfmdivision_id);
            if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmdivision_adminpersonid'}) ) {
               $GLOBALS{'sfmuserdivision'} = $GLOBALS{'sfmuserdivision'}.$sfmdivision_id.",";
               $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Division".",";
               $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
            }
            if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmdivision_otheradminpersonidlist'}) ) {
               $GLOBALS{'sfmuserdivision'} = $GLOBALS{'sfmuserdivision'}.$sfmdivision_id.",";
               $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Division".",";
               $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
            }
            if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmdivision_otherreadonlypersonidlist'}) ) {
               $GLOBALS{'sfmuserdivision'} = $GLOBALS{'sfmuserdivision'}.$sfmdividion_id.",";
               $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Division".",";
               $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."ReadOnly".",";
            }
            if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmdividion_floodinspectoridlist'}) ) {
               $GLOBALS{'sfmuserdividion'} = $GLOBALS{'sfmuserdividion'}.$sfmdividion_id.",";
               $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Flood".",";
               $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
           }      
           if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmdividion_groundinspectoridlist'}) ) {
               $GLOBALS{'sfmuserdividion'} = $GLOBALS{'sfmuserdividion'}.$sfmdividion_id.",";
               $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Ground".",";
               $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
           }           
        }
    }
    
    $sfmcountya = Get_Array('sfmcounty');	
    foreach ($sfmcountya as $sfmcounty_id) {
       Get_Data('sfmcounty',$sfmcounty_id);
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmcounty_adminpersonid'}) ) {
           $GLOBALS{'sfmusercounty'} = $GLOBALS{'sfmusercounty'}.$sfmcounty_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."County".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmcounty_otheradminpersonidlist'}) ) {
           $GLOBALS{'sfmusercounty'} = $GLOBALS{'sfmusercounty'}.$sfmcounty_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."County".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmcounty_otherreadonlypersonidlist'}) ) {
           $GLOBALS{'sfmusercounty'} = $GLOBALS{'sfmusercounty'}.$sfmcounty_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."County".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."ReadOnly".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmcounty_floodinspectoridlist'}) ) {
           $GLOBALS{'sfmusercounty'} = $GLOBALS{'sfmusercounty'}.$sfmcounty_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."FloodInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }      
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmcounty_groundinspectoridlist'}) ) {
           $GLOBALS{'sfmusercounty'} = $GLOBALS{'sfmusercounty'}.$sfmcounty_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."GroundInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
    }    

    $sfmngba = Get_Array('sfmngb');	
    foreach ($sfmngba as $sfmngb_id) {
       Get_Data('sfmngb',$sfmngb_id);
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmngb_adminpersonid'}) ) {
           $GLOBALS{'sfmuserngb'} = $GLOBALS{'sfmuserngb'}.$sfmngb_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."NGB".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmngb_otheradminpersonidlist'}) ) {
           $GLOBALS{'sfmuserngb'} = $GLOBALS{'sfmuserngb'}.$sfmngb_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."NGB".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmngb_otherreadonlypersonidlist'}) ) {
           $GLOBALS{'sfmuserngb'} = $GLOBALS{'sfmuserngb'}.$sfmngb_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."NGB".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."ReadOnly".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmngb_floodinspectoridlist'}) ) {
           $GLOBALS{'sfmuserngb'} = $GLOBALS{'sfmuserngb'}.$sfmngb_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."FloodInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }      
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmngb_groundinspectoridlist'}) ) {
           $GLOBALS{'sfmuserngb'} = $GLOBALS{'sfmuserngb'}.$sfmngb_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."GroundInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
    }    
    
    $sfmseta = Get_Array('sfmset');	
    foreach ($sfmseta as $sfmset_id) {
       Get_Data('sfmset',$sfmset_id);
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmset_adminpersonid'}) ) {
           $GLOBALS{'sfmuserset'} = $GLOBALS{'sfmuserset'}.$sfmset_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Set".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmset_otheradminpersonidlist'}) ) {
           $GLOBALS{'sfmuserset'} = $GLOBALS{'sfmuserset'}.$sfmset_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Set".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmset_otherreadonlypersonidlist'}) ) {
           $GLOBALS{'sfmuserset'} = $GLOBALS{'sfmuserset'}.$sfmset_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."Set".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."ReadOnly".",";
       }
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmset_floodinspectoridlist'}) ) {
           $GLOBALS{'sfmuserset'} = $GLOBALS{'sfmuserset'}.$sfmset_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."FloodInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }      
       if ( FoundInCommaList($thisperson_id,$GLOBALS{'sfmset_groundinspectoridlist'}) ) {
           $GLOBALS{'sfmuserset'} = $GLOBALS{'sfmuserset'}.$sfmset_id.",";
           $GLOBALS{'sfmuserrole'} = $GLOBALS{'sfmuserrole'}."GroundInspector".",";
           $GLOBALS{'sfmuserlevel'} = $GLOBALS{'sfmuserlevel'}."Update".",";
       }
    }     
}
 

 if (FoundInPipeList("sectiongroup",$GLOBALS{"TABLES"})) { 
     foreach (Get_Array_Hash("sectiongroup",$GLOBALS{'currperiodid'}) as $sectiongroup_code) {
     	Get_Data_Hash("sectiongroup",$GLOBALS{'currperiodid'},$sectiongroup_code);
     	$targetstring = $GLOBALS{'sectiongroup_mgr'}.",";
     	$searchstring = $GLOBALS{'LOGIN_person_id'}.",";
     	if (strlen(strstr($targetstring,"$searchstring"))>0) {
     		$GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#GroupMgr=".$sectiongroup_code."#,";
     		$GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-".$GLOBALS{'sectiongroup_name'}." Group Manager<br/>";
     	}
     	$targetstring = $GLOBALS{'sectiongroup_coach'}.",";
     	$searchstring = $GLOBALS{'LOGIN_person_id'}.",";
     	if (strlen(strstr($targetstring,"$searchstring"))>0) {
     		$GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#GroupCoach=".$sectiongroup_code."#,";
     		$GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-".$GLOBALS{'sectiongroup_name'}." Group Coach<br/>";
     	}
     	$targetstring = $GLOBALS{'sectiongroup_personmgrs'}.",";
     	$searchstring = $GLOBALS{'LOGIN_person_id'}.",";
     	if (strlen(strstr($targetstring,"$searchstring"))>0) {
     		$GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."MM#GroupMM=".$sectiongroup_code."#,";
     		$GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-".$GLOBALS{'sectiongroup_name'}." Group Administrator<br/>";
     	} 		
     }

 }
 
 foreach (Get_Array_Hash("webpage") as $webpage_name) {
  Get_Data("webpage",$webpage_name);
  $targetstring = $GLOBALS{'webpage_userid'}.",".$GLOBALS{'webpage_controller'}.",";
  $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
  if (strlen(strstr($targetstring,"$searchstring"))>0) {
     $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."WM#WebPage=".$webpage_name."#,";
     $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-WebPage Update for $webpage_name page<br/>";
  }
 }
 
 foreach  (Get_Array_Hash("bulletinboard") as $bulletinboard_name) {
  Get_Data("bulletinboard",$bulletinboard_name);
  $targetstring = $GLOBALS{'bulletinboard_controllers'}.",";
  $searchstring = $GLOBALS{'LOGIN_person_id'}.",";  
   if (strlen(strstr($targetstring,"$searchstring"))>0) {
   $GLOBALS{'person_authority'} = $GLOBALS{'person_authority'}."WM#Board=".$bulletinboard_name."#,";
   $GLOBALS{'person_authoritymessage'} = $GLOBALS{'person_authoritymessage'}."-Bulletin Board Controller for $bulletinboard_name Board<br/>";
  }
 }
} 
# print "Authority PHP = ".$GLOBALS{'person_authority'}."\n";
}

function Authority_Scan ($parm0, $parm1) {
    # masterlist person_id
    $authperson_ids = explode(",", $parm0);
    $tauthflag = "0";	
    foreach ($authperson_ids as $authperson_id) {
     if ($authperson_id == $parm1) {$tauthflag = "1";}
    }
    return $tauthflag;  
}

function HTMLEmail_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2) { 
	$emailtoa = explode(',',$emailto);
	$emailcca = explode(',',$emailcc);
	$emailbcca = explode(',',$emailbcc);
	if (count($emailtoa)+count($emailcca)+count($emailbcca) >= 50) { // Post mark limit
		// Send transactional emails in blocks of 40
		XPTXT("Emails have been sent in blocks of 40");
		$blocki = 1;$counter = 0;$block = "";$sep = "";	
		foreach ($emailtoa as $emailto) {
			$counter++;
			if ($counter < 41) {
				$block = $block.$sep.$emailto; $sep = ",";
			} else {
				// XPTXT($blocki." - ".$block);
				HTMLEmail_GenericHandler_Output($display,$emailfrom,$block,"","",$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
				$counter = 0;$block = "";$sep = "";$blocki++;
			}
		}
		if ($block != "") {
			// XPTXT($blocki." = ".$block);
			HTMLEmail_GenericHandler_Output($display,$emailfrom,$block,"","",$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}
		$blocki = 1;$counter = 0;$block = "";$sep = "";
		foreach ($emailcca as $emailcc) {
			$counter++;
			if ($counter < 41) {
				$block = $block.$sep.$emailcc; $sep = ",";
			} else {
				// XPTXT($blocki." - ".$block);
				HTMLEmail_GenericHandler_Output($display,$emailfrom,"",$block,"",$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
				$counter = 0;$block = "";$sep = "";$blocki++;
			}
		}
		if ($block != "") {
			// XPTXT($blocki." = ".$block);
			HTMLEmail_GenericHandler_Output($display,$emailfrom,"",$block,"",$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}		
		$blocki = 1;$counter = 0;$block = "";$sep = "";	
		foreach ($emailbcca as $emailbcc) {
			$counter++;
			if ($counter < 41) {
				$block = $block.$sep.$emailbcc; $sep = ",";
			} else {
				// XPTXT($blocki." - ".$block);
				HTMLEmail_GenericHandler_Output($display,$emailfrom,"","",$block,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
				$counter = 0;$block = "";$sep = "";$blocki++;
			}
		}
		if ($block != "") {
			// XPTXT($blocki." = ".$block);
			HTMLEmail_GenericHandler_Output($display,$emailfrom,"","",$block,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}		
	} else {
		// Send all at once
		HTMLEmail_GenericHandler_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
	}
}

function HTMLEmail_GenericHandler_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2) {
	$found = "0";
	if ( $GLOBALS{'site_mailsendmethod'} == "PostMark" ) {
		$found = "1";
		HTMLEmail_PostMark_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); 
	}	
	if ( $GLOBALS{'site_mailsendmethod'} == "PHPMailer" ) {
		$found = "1";
		HTMLEmail_PHPMailer_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}	
	if ( $GLOBALS{'site_mailsendmethod'} == "Basic" ) {
		$found = "1";
		HTMLEmail_Basic_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
	if (($GLOBALS{'site_simulation'} == "ON") || ($GLOBALS{'domain_simulation'} == "ON") ||($GLOBALS{'site_server'} == "W")  )  {
	    $found = "1";
	    HTMLEmail_Basic_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
	if ($found == "0") {XPTXTCOLOR("Error: No mail send method setup","red");}
}

function HTMLEmail_Basic_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2) {
	$emailcontent = str_replace(array("\r\n", "\r", "\n"), "<br>", $emailcontent);
	if (($GLOBALS{'site_simulation'} == "ON") || ($GLOBALS{'domain_simulation'} == "ON") ||($GLOBALS{'site_server'} == "W")  )  {
		$reason = "";
		XBR();XTXTCOLOR("Note:- This is a simulation of the email that would be sent.","red");
		if ($display == "display") {
            // print "<P>Email sent to ".$emailto.".\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
            // print "<P>Email sent to ".$emailto.".\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}
	} else {
		Check_Data('emailstyle',"XDefault");
		$GLOBALS{'emailstyle_headerimage'} = "";
		if ( $GLOBALS{'emailstyle_headerimage'} != "") {
			$headerurl = $GLOBALS{'domainwwwurl'}."/domain_style/".$GLOBALS{'emailstyle_headerimage'};
			print YIMGFLEX($headerurl).'<br><br>'."\n";
		}
	
		$headers  = YIMGFLEX($headerurl).'<br><br>'."\n";
		$headers  = "From: $emailfrom\r\n";
		$headers .= "Content-type: text/html\r\n";
		$headers .= "Cc: $emailcc\r\n";
		$headers .= "Bcc: $emailbcc\r\n";
		$message = $emailcontent."<br>"."<br>".$emailfooter1."<br>".$emailfooter2;
		if (mail($emailto, $emailsubject, wordwrap($message), $headers)) { }
		else {print("<p>Email server not working correctly - email not sent</p>");}
		if ($display == "display") {
			print "<p>The following email has been sent</p>\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			print "<P>Email sent to ".$emailto.".\n";
		}
	}
}

function HTMLEmail_PHPMailer_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2) {
	$emailcontent = str_replace(array("\r\n", "\r", "\n"), "<br>", $emailcontent);
	if (($GLOBALS{'site_simulation'} == "ON") || ($GLOBALS{'domain_simulation'} == "ON") ||($GLOBALS{'site_server'} == "W")  )  { 
	 $reason = "";
	 XBR();XTXTCOLOR("Note:- This is a simulation of the email that would be sent.","red");
	 if ($display == "display") {
        //�print "<P>Email sent to ".$emailto.".\n";
        Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	 } else {
        //�print "<P>Email sent to ".$emailto.".\n";
        Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);	
	 }
	} else {
		$mail = new PHPMailer;
		// $mail->SMTPDebug = 1;                               		// Enable verbose debug output
		$mail->isSMTP();                                     		// Set mailer to use SMTP
		$mail->Host = 'localhost';  								// Specify main and backup SMTP servers
		$mail->SMTPAuth = true; 									// Enable SMTP authentication
		$mail->Username = $GLOBALS{'domain_defaultemailaddress'};   // SMTP username
		$mail->Password = 'd7L25YQuyW';                       		// SMTP password
		$mail->SMTPSecure = 'tls';                            		// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 25;                                    		// TCP port to connect to
		
		// $mail->setFrom($emailfrom);
		$mail->setFrom($GLOBALS{'domain_defaultemailaddress'});
		$mail->addAddress($emailto);     				// Add a recipient
		// $mail->addAddress('ellen@example.com');      // Name is optional
		$mail->addReplyTo($emailfrom);
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
	
		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                     // Set email format to HTML
	
		$mail->Subject = $emailsubject;
		$mail->Body    = $emailcontent;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			 if ($display == "display") {
			  print "<p>The following email has been sent...</p>\n";   
			  Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
			 } else {
			  print "<P>Email sent to ".$emailto.".\n";  	
			 }
		}
	}
}

function HTMLEmail_PostMark_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2) {
	$emailcontent = str_replace(array("\r\n", "\r", "\n"), "<br>", $emailcontent);
	if (($GLOBALS{'site_simulation'} == "ON") || ($GLOBALS{'domain_simulation'} == "ON") ||($GLOBALS{'site_server'} == "W")  )  {
		$reason = "";
		XBR();XTXTCOLOR("Note:- This is a simulation of the email that would be sent.","red");
		if ($display == "display") {
			#�print "<P>Email sent to ".$emailto.".\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			#�print "<P>Email sent to ".$emailto.".\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}
	} else {
		$json = json_encode(array(
 			'From' => $GLOBALS{'domain_defaultemailaddress'},		
	        'To' => $emailto,
			'Cc' => $emailcc,
		    'Bcc' => $emailbcc,	        
	        'Subject' => $emailsubject,
	        'HtmlBody' => $emailcontent."<br>"."<br>".$emailfooter1."<br>".$emailfooter2,
	        'TextBody' => convert_html_to_text($emailcontent."<br>"."<br>".$emailfooter1."<br>".$emailfooter2),
	        'ReplyTo' => $emailfrom
		));
		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL, $GLOBALS{'site_mailserviceurl'});
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Accept: application/json',
	        'Content-Type: application/json',
	        'X-Postmark-Server-Token: ' . $GLOBALS{'site_mailservicetoken'}        
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		$response = json_decode(curl_exec($ch), true);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ( $http_code === 200 ) { 
			if ($display == "display") {
				print "<p>The following email has been sent...</p>\n";
				Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
			} 
			if ($display == "nodisplay") {
				print "<P>Email sent to ".$emailto.".\n";
			}
			if ($display == "nomessage") {}
		} else {			
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;			
		}
	}		
}	
	
function HTMLEmailRecorded_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate) {
	// if ($GLOBALS{'LOGIN_person_id'} == "bbra") { HTMLEmail_PostMarkRecorded_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate); }
	// else { HTMLEmail_PostMark_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2); }
	HTMLEmail_PostMarkRecorded_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate);
}

function HTMLEmail_PostMarkRecorded_Output($display,$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2,$emailfrompersonid,$emailtopersonid,$emailreference,$emailexpirydate) {
	$emailcontent = str_replace(array("\r\n", "\r", "\n"), "<br>", $emailcontent);
	if (($GLOBALS{'site_simulation'} == "ON") || ($GLOBALS{'site_server'} == "W")  )  {
		XBR();XTXTCOLOR("Note:- This is a simulation of the email that would be sent.","red");
		if ($display == "display") {
			#�print "<P>Email sent to ".$emailto.".\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			#�print "<P>Email sent to ".$emailto.".\n";
			Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		}
		$GLOBALS{'emailout_domainid'} = $GLOBALS{'LOGIN_domain_id'};
		$GLOBALS{'emailout_topersonid'} = $emailtopersonid;		
		$GLOBALS{'emailout_from'} = $emailfrom;		
		$GLOBALS{'emailout_frompersonid'} = $emailfrompersonid;
		$GLOBALS{'emailout_message'} = $emailcontent;
		$GLOBALS{'emailout_reference'} = $emailreference;
		$GLOBALS{'emailout_expirytimestamp'} = YYYY_MM_DDtoTimestamp($emailexpirydate);
		$GLOBALS{'emailout_result'} = "200:OK:simulation";
		Write_Data("emailout_".$emailto,$GLOBALS{'currentYYYYMMDDHHMMSS'});
	} else {
		$json = json_encode(array(
 			'From' => $GLOBALS{'domain_defaultemailaddress'},		
	        'To' => $emailto,
			'Cc' => $emailcc,
		    'Bcc' => $emailbcc,	        
	        'Subject' => $emailsubject,
	        'HtmlBody' => $emailcontent."<br>"."<br>".$emailfooter1."<br>".$emailfooter2,
	        'TextBody' => convert_html_to_text($emailcontent."<br>"."<br>".$emailfooter1."<br>".$emailfooter2),
	        'ReplyTo' => $emailfrom
		));
		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_URL, $GLOBALS{'site_mailserviceurl'});
//		curl_setopt($ch, CURLOPT_URL, 'http://api.postmarkapp.com/email');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Accept: application/json',
	        'Content-Type: application/json',
            'X-Postmark-Server-Token: ' . $GLOBALS{'site_mailservicetoken'}	        
		));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		// $response = json_decode(curl_exec($ch), true);
		// $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);		
		$ch_return  = curl_exec($ch);
		$curl_error = curl_error($ch);
		$http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);		
		curl_close($ch);
		$emailresult = $http_code.":".$ch_return.":".$curl_error;
		
		if ( $http_code === 200 ) {
			if ($display == "display") {
				XTXTCOLOR("The following email has been successfully queued","green"); XBR(); $GLOBALS{'IOWARNING'} = "1";
				Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
			}
			if ($display == "nodisplay") {
				XTXTCOLOR("Mail successfully queued to ".$emailto,"green"); XBR(); $GLOBALS{'IOWARNING'} = "1";
			}
			if ($display == "silent") {	}			
		} else {
			if (($display == "display")||($display == "nodisplay")) {
				XTXTCOLOR("Send Error - ".$emailresult,"red"); XBR(); $GLOBALS{'IOWARNING'} = "1";
				Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
			}
			if ($display == "silent") {	}			
		}
		$GLOBALS{'emailout_domainid'} = $GLOBALS{'LOGIN_domain_id'};
		$GLOBALS{'emailout_topersonid'} = $emailtopersonid;
		$GLOBALS{'emailout_from'} = $emailfrom;
		$GLOBALS{'emailout_frompersonid'} = $emailfrompersonid;
		$GLOBALS{'emailout_message'} = $emailcontent;
		$GLOBALS{'emailout_reference'} = $emailreference;
		$GLOBALS{'emailout_expirytimestamp'} = YYYY_MM_DDtoTimestamp($emailexpirydate);
		$GLOBALS{'emailout_result'} = $emailresult;
		Write_Data("emailout_".$emailto,$GLOBALS{'currentYYYYMMDDHHMMSS'});
	}
}

function Email_Display ($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2) {
    $emailcontent = str_replace(array("\r\n", "\r", "\n"), "<br>", $emailcontent);
    $emailto = Replace_GT($emailto,">");
    $emailto = Replace_LT($emailto,"<");
    $emailcc = Replace_GT($emailcc,">");
    $emailcc = Replace_LT($emailcc,"<");
    $emailbcc = Replace_GT($emailbcc,">");
    $emailbcc = Replace_LT($emailbcc,"<");
    $emailcontent = Replace_CRandLF($emailcontent,"");
    $emailto = Replace_COMMA($emailto,", ");
    $emailcc = Replace_COMMA($emailcc,", ");
    $emailbcc = Replace_COMMA($emailbcc,", ");
    XBR();
    XTABLE();
    XTREVEN();XTDTXTWIDTH("<b>To:</b> $emailto","600");X_TR();
    if ($emailcc != "") {XTREVEN();XTDTXTWIDTH("<b>Cc:</b> $emailcc","600"); X_TR();}
    if ($emailbcc != "") {XTREVEN();XTDTXTWIDTH("<b>Bcc:</b> $emailbcc","600"); X_TR();}
    XTRODD();XTDTXTWIDTH("<b>From:</b> $emailfrom","600");X_TR();
    	XTREVEN();XTD();
    	XTABLE();
    	XTREVEN();XTDTXTWIDTH("<b>Subject:</b> $emailsubject","600");X_TR();
    #	XTRODD();XTDTXTWIDTH("<hr>".$emailcontent."<hr>","600");X_TR();
    	XTRODD();XTDTXTWIDTH(YBR().$emailcontent,"600");X_TR();	
    	X_TABLE();
    	X_TD();X_TR();
    XTREVEN();XTDTXTWIDTH($emailfooter1."<BR>".$emailfooter2,"600");X_TR();
    X_TABLE();
}

function SMS_Output($display,$smsfrom,$smsfrompersonid,$smsfromfname,$smsfromsname,$smsto,$smstopersonid,$smstofname,$smstosname,$smsmessage,$smsreference,$smsexpirydate) {
    # expirydate = YYYY-MM-DD
    $GLOBALS{'IOWARNING'} = "0";
    if (($smsfrom != "")&&($smsto != "")&&($smsfrom != " ")&&($smsto != " ")) {
    	if (($GLOBALS{'site_simulation'} == "ON") || ($GLOBALS{'domain_simulation'} == "ON") ||($GLOBALS{'site_server'} == "W")  )  {
    		XBR();XTXTCOLOR("Note:- This is a simulation of the Message that would be sent.","red");
    		$GLOBALS{'smsout_domainid'} = $GLOBALS{'LOGIN_domain_id'};		
    		$GLOBALS{'smsout_topersonid'} = $smstopersonid;
    		$GLOBALS{'smsout_from'} = IntlPhoneNumber($smsfrom);
    		$GLOBALS{'smsout_frompersonid'} = $smsfrompersonid;
    		$GLOBALS{'smsout_message'} = $smsmessage;
    		# timestampout-txntype-groupref-personid		
    		$GLOBALS{'smsout_reference'} = $smsreference;
    		$GLOBALS{'smsout_expirytimestamp'} = YYYY_MM_DDtoTimestamp($smsexpirydate);	
    		$GLOBALS{'smsout_result'} = "0:simulation";
    		Write_Data("smsout_".IntlPhoneNumber($smsto),$GLOBALS{'currentYYYYMMDDHHMMSS'});
    		SMS_Display($smsfrom,$smsfrompersonid,$smsfromfname,$smsfromsname,IntlPhoneNumber($smsto),$smstopersonid,$smstofname,$smstosname,$smsmessage,$smsreference);
    	} else {
    		$username = $GLOBALS{'site_smsserviceusername'};
    		$password = $GLOBALS{'site_smsservicepassword'};
    		$geturl = $GLOBALS{'site_smsserviceurl'};
    //		$username = "firetext@havanthockeyclub.org.uk";
    //		$password = "SF1hV2pvaSl4";
    //		$geturl = "http://www.firetext.co.uk/api/sendsms";		
    		$params = array(
    		   "username" => urlencode($username),  
    		   "password" => urlencode($password),   
    		   "message" => urlencode($smsmessage),
    		   "from" => IntlPhoneNumber($smsfrom),   
    		   "to" => IntlPhoneNumber($smsto),
    		   "reference" => urlencode($smsreference)
    		);
    		$smsresult = httpPost($geturl,$params);
    		if ($GLOBALS{'IOERROR'} == "1") { $smsresult = "99:".$smsresult; }
    		$smsresulta = explode(':', $smsresult);
    		/*
    		0:  SMS successfully queued
    		1:  Authentication error
    		2:  Destination number(s) error
    		3:  From error
    		4:  Group not recognised
    		5:  Message error
    		6:  Send time error (YYYY-MM-DD HH:MM)
    		7:  Insufficient credit
    		8:  Invalid delivery receipt URL
    		9:  Sub-account error (not recognised
    		10: Repeat expiry/interval error (not recognised)
    		11: Repeat expiry error (YYYY-MM-DD)
    		99: httpPost error message
    		*/
    		$GLOBALS{'smsout_domainid'} = $GLOBALS{'LOGIN_domain_id'};		
    		$GLOBALS{'smsout_topersonid'} = $smstopersonid;
    		$GLOBALS{'smsout_from'} = IntlPhoneNumber($smsfrom);
    		$GLOBALS{'smsout_frompersonid'} = $smsfrompersonid;
    		$GLOBALS{'smsout_message'} = $smsmessage;
    		# timestampout-txntype-groupref-personid 
    		$GLOBALS{'smsout_reference'} = $smsreference;
    		$GLOBALS{'smsout_expirytimestamp'} = YYYY_MM_DDtoTimestamp($smsexpirydate);
    		$GLOBALS{'smsout_result'} = $smsresult;
    		Write_Data("smsout_".IntlPhoneNumber($smsto),$GLOBALS{'currentYYYYMMDDHHMMSS'});
    		if ($smsresulta[0] == "0") { 
    			if ($display == "display") {
    			  XTXTCOLOR("The following SMS has been successfully queued","green"); XBR(); $GLOBALS{'IOWARNING'} = "1";
    			  SMS_Display($smsfrom,$smsfrompersonid,$smsfromfname,$smsfromsname,IntlPhoneNumber($smsto),$smstopersonid,$smstofname,$smstosname,$smsmessage,$smsreference);
    			} else {
    			  XTXTCOLOR("SMS successfully queued to ".$smsto,"green"); XBR(); $GLOBALS{'IOWARNING'} = "1";	
    			}			
    		} else {
    			  XTXTCOLOR("Send Error - ".$smsresult,"red"); XBR(); $GLOBALS{'IOWARNING'} = "1"; 
    			  SMS_Display($smsfrom,$smsfrompersonid,$smsfromfname,$smsfromsname,IntlPhoneNumber($smsto),$smstopersonid,$smstofname,$smstosname,$smsmessage,$smsreference);	
    		}
    	}
    } else {
    	if (($smsfrom == "")||($smsfrom == " ")) { XTXTCOLOR("No Mobile number found for ".$smsfromfname." ".$smsfromsname,"red"); XBR(); $GLOBALS{'IOWARNING'} = "1"; }
    	if (($smsto == "")||($smsto == " ")) {  XTXTCOLOR("No Mobile number found for ".$smstofname." ".$smstosname,"red"); XBR(); $GLOBALS{'IOWARNING'} = "1"; }
    }
}

function SMS_Display ($smsfrom,$smsfrompersonid,$smsfromfname,$smsfromsname,$smsto,$smstopersonid,$smstofname,$smstosname,$smsmessage,$smsreference) {
    XBR();
    XTABLE();
    $header = "To: ".IntlPhoneNumber($smsto)." ".$smstofname." ".$smstosname;
    XTR();
    XTDTXTWIDTH($header,"600");
    X_TR();XTR();
    XTDTXTWIDTH($smsmessage,"600");
    X_TR();
    X_TABLE();
}

function httpGet($url) {
	$GLOBALS{'IOERROR'} = "0";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);
	//  curl_setopt($ch,CURLOPT_HEADER, false);
	$output=curl_exec($ch);
	curl_close($ch);
	return $output;
}

function httpPost($url,$params) {
	$GLOBALS{'IOERROR'} = "0";
	$postData = '';
	//create name value pairs seperated by &
	foreach($params as $k => $v) {
		$postData .= $k . '='.$v.'&';
	}
	rtrim($postData, '&');
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, count($postData));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10);
	$output=curl_exec($ch);
	if(curl_errno($ch)) { 
		$GLOBALS{'IOERROR'} = "1";
		if (curl_errno($ch) == 28) { $output='Timeout error'; }
		else { $output='Error: ' . curl_error($ch); }
	}
	curl_close($ch);
	return $output;
}

function httpPostTest($url,$params) {  // Modify and use to test
	$GLOBALS{'IOERROR'} = "0";
	return '1:  Authentication error';
}

# array return list - comma separated
function Array2List ($tarray) {
    $tlist = ""; $tsep = "";
    foreach ($tarray as $tarrayelement) {
     $tlist = $tlist.$tsep.$tarrayelement;
     $tsep = ",";
    }
    return $tlist;
}

# keyvaluearray return hash
function Array2Hash ($keyvaluearray) { foreach ($keyvaluearray as $keyvalueelement) {
 $thash[$keyvalueelement] = $keyvalueelement;
}
return $thash;
}
# keyarray valuearray return hash
function Arrays2Hash ($keyarray, $valuearray) { 
    $i=0;
    foreach ($keyarray as $keyarrayelement) {
     $thash[$keyarrayelement] = $valuearray[$i]; $i++;
    }
    return $thash;
}
function List2Hash ($keyvaluelist) { 
    $keyvaluearray=explode(",",$keyvaluelist);
    foreach ($keyvaluearray as $keyvalueelement) {$thash[$keyvalueelement]=$keyvalueelement;}
    return $thash;
}
# keyarray valuearray return hash
function Lists2Hash ($keylist, $valuelist) {
    $keyarray=explode(",",$keylist); $valuearray=explode(",",$valuelist);	 
    $i=0;foreach ($keyarray as $keyarrayelement) {$thash[$keyarrayelement]=$valuearray[$i];$i++;}
    return $thash;
}
# list return array
function List2Array ($tlist) {
    if ($tlist == "") { $tarray = Array(); } 
    else  { $tarray=explode(",",$tlist); }
    return $tarray;
}

function Imagename2Thumbname($imagename) {
	$mbits = explode(".", $imagename);
	$imagetype = end($mbits);
	$imagefirstname = str_replace(".".$imagetype, "", $imagename);
	$thumbname = $imagefirstname."_thumb.".$imagetype;
	return $thumbname;
}

function Field2URL($fieldvalue) {
    $urlvalue = $fieldvalue;
    if ($urlvalue != "") {
        $found = "0";
        if ( strlen($urlvalue) >= 2) {
            if ( substr($urlvalue,0,2) == "//" ) { $urlvalue = str_replace("//", "http://", $urlvalue); $found = "1"; }
        }
        if ( strlen($urlvalue) >= 7) {
            if ( substr($urlvalue,0,7) == "http://" ) { $found = "1"; }
        }
        if ( strlen($urlvalue) >= 8) {
            if ( substr($urlvalue,0,8) == "https://" ) { $found = "1"; }
        }            
        if ($found == "0") { $urlvalue = "http://".$urlvalue; }
    }
    return $urlvalue;
}

function FoundInCommaList($parm0,$parm1) {
	// key list 
	$ffound = "0";
	$parm1 = str_replace(" ","",$parm1);
	if ($parm1 != "") {
	 $farray = explode(",",$parm1); 
	 foreach ($farray as $farrayelement) {  
	  if ($parm0 == $farrayelement) {$ffound = "1"; }
	 }
	}
	// print "<br>----- |$parm0|$parm1|  =  $ffound";
	if ($ffound == "1") {return true;} else {return false;}
}

function FoundInPipeList($parm0,$parm1) {
    // key list
    $ffound = "0";
    $parm1 = str_replace(" ","",$parm1);
    if ($parm1 != "") {
        $farray = explode("|",$parm1);
        foreach ($farray as $farrayelement) {
            if ($parm0 == $farrayelement) {$ffound = "1"; }
        }
    }
    // print "<br>----- |$parm0|$parm1|  =  $ffound";
    if ($ffound == "1") {return true;} else {return false;}
}

function CommaList_Add ($inlist, $newelement) {
    $inlist = str_replace(" ","",$inlist);
	if ($inlist != "") { $lista = explode(',',$inlist); }
	else { $lista = Array(); }
	array_push($lista,$newelement);
	$listau = array_unique($lista);
	$outlist = "";
	$sep = "";
	foreach ($listau as $element)  {
		$outlist = $outlist.$sep.$element;
		$sep = ",";
	}
	return $outlist;
}

function CommaList_Delete ($inlist, $deleteelement) {
    $inlist = str_replace(" ","",$inlist);
	if ($inlist != "") { $lista = explode(',',$inlist); }
	else { $lista = Array();  }
	$listau = array_unique($lista);
	$outlist = "";
	$sep = "";
	foreach ($listau as $element)  {
		if ($element == $deleteelement) {}
		else {
			$outlist = $outlist.$sep.$element;
			$sep = ",";
		}
	}
	return $outlist;
}

function CommaLists_Merge ($inlist1, $inlist2) {
    $inlist1 = str_replace(" ","",$inlist1);
    $inlist2 = str_replace(" ","",$inlist2);
    if ($inlist1 != "") { $list1a = explode(',',$inlist1); } else { $list1a = Array(); }
    if ($inlist2 != "") { $list2a = explode(',',$inlist2); } else { $list2a = Array(); }
    $list3a = array_unique(array_merge($list1a, $list2a));
    $outlist = "";
    $sep = "";
    foreach ($list3a as $element)  {
        $outlist = $outlist.$sep.$element;
        $sep = ",";
    }
    // XPTXT("|".$inlist1."|".$inlist2."|".$outlist."|");
    return $outlist;
}

function CheckedInCommaList($parm0,$parm1) {
    // key list
    $ffound = "0";
    $parm1 = str_replace(" ","",$parm1);
    if ($parm1 != "") {
        $farray = explode(",",$parm1);
        foreach ($farray as $farrayelement) {
            if ($parm0 == $farrayelement) {$ffound = "1"; }
        }
    }
    // print "<br>----- |$parm0|$parm1|  =  $ffound";
    if ($ffound == "1") {return "checked";} else {return "";}
}

# searchinlist searchforlist
function MatchLists ($inlist, $forlist) {
	$foundstring = false;
	if ($forlist != "") {
		$inarray = explode(",",$inlist);
		$forarray = explode(",",$forlist);
		foreach ($inarray as $instring) {
			foreach ($forarray as $forstring) {	
				if ($instring == $forstring) { $foundstring = true; }
			}
		}
	}
	return $foundstring;
}


function SyntaxListToHash ($parm0) {
# InputCheckboxFromList    xk+yk        <--- OR xk[xt]+yk[yt]
 $tsyntax0a = explode(',', $parm0); 
 $tsyntax1a = explode('+', $tsyntax0a[1]);
 $sep = ""; $tklist = ""; $ttlist = "";
 for ($si = 0; $si < sizeof($tsyntax1a); $si++) {
  if (strlen(strstr($tsyntax1a[$si],"[")) > 0) { // xk[xt]+yk[yt] 
   $tsyntax2a = explode('[', $tsyntax1a[$si]);
   $tsyntax3a = explode(']', $tsyntax2a[1]);
   $tklist = $tklist.$sep.$tsyntax2a[0];		
   $ttlist = $ttlist.$sep.$tsyntax3a[0]; 	
  } else { // xk+yk 
   $tklist = $tklist.$sep.$tsyntax1a[$si];		
   $ttlist = $ttlist.$sep.$tsyntax1a[$si];
  }
  $sep = ",";
 } 
 $temphash = Lists2Hash($tklist,$ttlist);
 return $temphash;
}

function IntlPhoneNumber($phoneno){
	$thisintlcode = "44";
	$intlphoneno = "";
	$ibits = str_split($phoneno);
	$firstzero = "1";
	foreach ($ibits as $ibit) {
		if ($ibit == " ") { }
		else {
			if (($ibit == "0")&&($firstzero == "1")) { $intlphoneno = $thisintlcode; }
			else {$intlphoneno = $intlphoneno.$ibit; }
			$firstzero = "0";
		}
	}
	return $intlphoneno;
}

function GenericSyntaxTableToHash ($parm0) {
    # InputSelectFromTable   tablename     keyfieldname  textfieldname sortfieldname
     $temphash = array(); 
     return $temphash;
}

function Help_Link () {
}
function Strip_BLCRandLF($parm0){$BL=chr(32);$CR=chr(13);$LF=chr(10);$s=array($BL,$CR,$LF);$r=array("","","");return str_replace($s,$r,$parm0);}
function Strip_CRandLF($parm0){$CR=chr(13);$LF=chr(10);$s=array($CR,$LF);$r=array("","");return str_replace($s,$r,$parm0);}
function Replace_CRandLF($parm0,$parm1){$CR=chr(13);$LF=chr(10);$s=array($CR,$LF);$r=array($parm1,$parm1);return str_replace($s,$r,$parm0);}
function Replace_CR($parm0,$parm1){$CR=chr(13);$s=$CR;$r=$parm1;return str_replace($s,$r,$parm0);}
function Replace_LF($parm0,$parm1){$LF=chr(10);$s=$LF;$r=$parm1;return str_replace($s,$r,$parm0);}
function Replace_COMMA($parm0,$parm1){$COMMA = ",";$s=$COMMA;$r=$parm1;return str_replace($s,$r,$parm0);}
function Replace_LT($parm0,$parm1){$LT="<";$s=$LT;$r=$parm1;return str_replace($s,$r,$parm0);}
function Replace_GT($parm0,$parm1){$GT=">";$s=$GT;$r=$parm1;return str_replace($s,$r,$parm0);}
function Replace_PARA($parm0,$parm1){$PARA=chr(182);$s=$PARA;$r=$parm1;return str_replace($s,$r,$parm0);}
function Replace($parm0,$parm1,$parm2){return str_replace($parm1,$parm2,$parm0);}

function str_replace_first($from, $to, $subject) {
	$from = '/'.preg_quote($from, '/').'/';
	return preg_replace($from, $to, $subject, 1);
}

function MakeUrlHTTP($parm0){
    $pbits = explode('/', $parm0);
    if ($pbits[0] == "") {	$parm0 = "http:".$parm0; }
    return $parm0;
}
	
function Remove_NonAplha($instring) {
    $outstring = "";
    $inarray = str_split($instring);
    foreach ($inarray as $bit) {
    	$echarn = ord($bit);
    	$inalphanuma = "0";
    	if (($echarn > 96)&&($echarn < 123)) {$inalphanuma = "1";}
    	if (($echarn > 64)&&($echarn < 91)) {$inalphanuma = "1";}
    	if (($echarn > 47)&&($echarn < 58)) {$inalphanuma = "1";}	
    	if ($inalphanuma == "1") { $outstring = $outstring.$bit; }	
    }
    return $outstring;
}

function emailtolower ($inemail) {
	$loweremail = "";
	$ibits = str_split($inemail);
	foreach ($ibits as $ibit) {
		if ($ibit == "@") { $jbit = "@"; }
		else {
			if ($ibit == ".") { $jbit = "."; }
			else {$jbit = strtolower($ibit); }
		}
		$loweremail = $loweremail.$jbit;
	}
	return $loweremail;
}

function ValidEmail ($email) {
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false) { return true; }
	else { return false; }
}

function ValidMobile ($inmobile) {
	$validmobile = true;
	$numbercount = 0;
	$numberstring = "";
	$ibits = str_split($inmobile);
	foreach ($ibits as $ibit) {
		if ($ibit == " ") {}
		else {
			if (($ibit >= "0")&&($ibit <= "9")) { $numbercount++; $numberstring = $numberstring.$ibit; }
			else { $validmobile = false; }
		}
	}
	if ($numberstring[0] == "0") {
		if ( $numbercount != 11 ) { $validmobile = false; }
	}
	if ( $numbercount < 11 ) { $validmobile = false; }
	return $validmobile;
}



function XCrypt ($parm0,$parm1,$parm2) {
    // result <= instring key encrypt/decrypt
    // if ($testcrypt == "1") { print"<P>Instring - $parm0\n"; }
    $inarray = str_split($parm0);
    $ekey = $parm1.$parm1.$parm1.$parm1.$parm1.$parm1.$parm1.$parm1;
    $ekeyarray = str_split($ekey);
    $nemax = sizeof($inarray);
    $outarray = array(); $outstring = "";
    $blank = array(" ");
    $alphanuma = array_merge(explode(",",$GLOBALS{'STATIC_numerica'}), 
                             explode(",",$GLOBALS{'STATIC_upperalpha'}));
    $alphanuma = array_merge($blank, $alphanuma);
    for ($ne = 0; $ne < $nemax; $ne++) {
      $echar = $inarray[$ne];
      $ekeychar = $ekeyarray[$ne];
      $echarn = ord($echar);
      $ekeycharn = ord($ekeychar); 
      $inalphanuma = "0";
      if (($echarn > 96)&&($echarn < 123)) {$echarni = $echarn - 60; $inalphanuma = "1"; }
      if (($echarn > 64)&&($echarn < 91)) {$echarni = $echarn - 54; $inalphanuma = "1"; }  
      if (($echarn > 47)&&($echarn < 58)) {$echarni = $echarn - 47; $inalphanuma = "1"; }  
      if ($echarn == 32) {$echarni = 0; $inalphanuma = "1"; } 
      if (($ekeycharn > 96)&&($ekeycharn < 123)) {$ekeycharni = $ekeycharn - 60; }
      if (($ekeycharn > 64)&&($ekeycharn < 91)) {$ekeycharni = $ekeycharn - 54; }  
      if (($ekeycharn > 47)&&($ekeycharn < 58)) {$ekeycharni = $ekeycharn - 47; }  
      if ($ekeycharn == 32) {$ekeycharni = 0; $keyinalphanuma = "1"; }
      if ( $inalphanuma == "1" ) {
       if ($parm2 == "encrypt" ) { $rcharni = $echarni - $ekeycharni;} else { $rcharni = $echarni + $ekeycharni; }
       if ($rcharni < 0) { $rcharni = $rcharni + 63; }
       if ($rcharni > 62) { $rcharni = $rcharni - 63; }
       array_push($outarray, $alphanuma[$rcharni]);
      } else {
       array_push($outarray, $echar);	
      } 
    }
    foreach ($outarray as $bit) {
       $outstring = $outstring.$bit;
    }
    // if ($testcrypt == "1") { print"<P>Outstring - $outstring\n"; }
    // print"<P>Outstring - |$outstring|\n";
    return $outstring;
}

function createRandomPassword() { 
     $chars = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ"; 
     srand((double)microtime()*1000000); 
     $i = 0; 
     $pass = '' ; 
     while ($i <= 7) { 
      $num = rand() % 55; 
      $tmp = substr($chars, $num, 1); 
      $pass = $pass . $tmp; 
      $i++; 
     } 
     return $pass; 
} 

function createRandomString($length) {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    srand((double)microtime()*1000000);
    $i = 0;
    $rstring = '' ;
    while ($i <= $length) {
        $num = rand() % 62;
        $tmp = substr($chars, $num, 1);
        $rstring = $rstring . $tmp;
        $i++;
    }
    return $rstring;
} 

function Calculate ($xfield,$operator,$yfield) {
     $xfieldnum = floatval($xfield);	
     $yfieldnum = floatval($yfield);		
     if ($operator == "+") {$resultnum = $xfieldnum + $yfieldnum;}
     if ($operator == "-") {$resultnum = $xfieldnum - $yfieldnum;}
     if ($operator == "*") {$resultnum = $xfieldnum * $yfieldnum;}
     if ($operator == "/") {$resultnum = $xfieldnum / $yfieldnum;}	
     return strval($resultnum);	
}



// ------------- Set Static Fields -----------------------------------------
function Set_Statics () {
    $GLOBALS{'SITEJSPOPUPCORE'} = "setglobals,viewaspopup";	
    $GLOBALS{'TINYMCEJSOPTIONAL'} = "";
    $GLOBALS{'YUICSSOPTIONAL'} = ""; $GLOBALS{'YUI3CSSOPTIONAL'} = "";
    $GLOBALS{'YUIJSOPTIONAL'} = ""; $GLOBALS{'YUI3JSOPTIONAL'} = "";
    $GLOBALS{'SITECSSOPTIONAL'} = "";
    $GLOBALS{'SITEJSOPTIONAL'} = "";
    $GLOBALS{'SITEPOPUPHTML'} = "";
    
    $GLOBALS{'STATIC_TINYMCEJS_tinymce'} = 'tinymce.min.js';
    
    $GLOBALS{'STATIC_YUICSS_menu'} = 'menu/assets/skins/sam/menu.css';
    $GLOBALS{'STATIC_YUICSS_reset-fonts-grids'} = 'reset-fonts-grids/reset-fonts-grids.css';
    $GLOBALS{'STATIC_YUICSS_fonts'} = 'fonts/fonts-min.css';
    $GLOBALS{'STATIC_YUICSS_logger'} = 'logger/assets/skins/sam/logger.css';
    $GLOBALS{'STATIC_YUICSS_button'} = 'button/assets/skins/sam/button.css';
    $GLOBALS{'STATIC_YUICSS_container'} = 'container/assets/skins/sam/container.css';
    $GLOBALS{'STATIC_YUICSS_calendar'} = 'calendar/assets/skins/sam/calendar.css';
    $GLOBALS{'STATIC_YUICSS_tabview'} = 'tabview/assets/skins/sam/tabview.css';
    $GLOBALS{'STATIC_YUICSS_paginator'} = 'paginator/assets/skins/sam/paginator.css';
    $GLOBALS{'STATIC_YUICSS_datatable'} = 'datatable/assets/skins/sam/datatable.css';
    $GLOBALS{'STATIC_YUICSS_resize'} = 'resize/assets/skins/sam/resize.css';
    $GLOBALS{'STATIC_YUICSS_imagecropper'} = 'imagecropper/assets/skins/sam/imagecropper.css';
    
    $GLOBALS{'STATIC_YUIJS_yahoo-dom-event'} = 'yahoo-dom-event/yahoo-dom-event.js';
    $GLOBALS{'STATIC_YUIJS_container'} = 'container/container-min.js';
    $GLOBALS{'STATIC_YUIJS_menu'} = 'menu/menu.js';
    $GLOBALS{'STATIC_YUIJS_logger'} = 'logger/logger-min.js';
    $GLOBALS{'STATIC_YUIJS_animation'} = 'animation/animation-min.js';
    $GLOBALS{'STATIC_YUIJS_dragdrop'} = 'dragdrop/dragdrop-min.js';
    $GLOBALS{'STATIC_YUIJS_element'} = 'element/element-min.js';
    $GLOBALS{'STATIC_YUIJS_connection'} = 'connection/connection.js';
    $GLOBALS{'STATIC_YUIJS_button'} = 'button/button-min.js';
    $GLOBALS{'STATIC_YUIJS_calendar'} = 'calendar/calendar-min.js';
    $GLOBALS{'STATIC_YUIJS_cookie'} = 'cookie/cookie-min.js';
    $GLOBALS{'STATIC_YUIJS_tabview'} = 'tabview/tabview-min.js';
    $GLOBALS{'STATIC_YUIJS_paginator'} = 'paginator/paginator-min.js';
    $GLOBALS{'STATIC_YUIJS_datasource'} = 'datasource/datasource-min.js';
    $GLOBALS{'STATIC_YUIJS_datatable'} = 'datatable/datatable-min.js';
    $GLOBALS{'STATIC_YUIJS_resize'} = 'resize/resize-min.js';
    $GLOBALS{'STATIC_YUIJS_imagecropper'} = 'imagecropper/imagecropper-min.js';
    
    $GLOBALS{'STATIC_fontface'} = "Arial,Times New Roman";
    $GLOBALS{'STATIC_fontstyle'} = "normal,italic";
    $GLOBALS{'STATIC_fontsize'} = "6pt,7pt,8pt,9pt,10pt,11pt,12pt,14pt,16pt,18pt,20pt,22pt,24pt";
    $GLOBALS{'STATIC_fontweight'} = "normal,bold";
    $GLOBALS{'STATIC_fontdecoration'} = "none,underline";
    $GLOBALS{'STATIC_color'} = "Black,Blue,Red,Green,Yellow,White,Silver,Gray,Maroon,Lime,Cyan,Teal,Purple,Navy,Magneta,Fuchsia,Olive,Aqua";
    $GLOBALS{'STATIC_numerica'} = "0,1,2,3,4,5,6,7,8,9";
    $GLOBALS{'STATIC_uppercasea'} = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
    $GLOBALS{'STATIC_upperalpha'} = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
    $GLOBALS{'STATIC_loweralpha'} = "a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z";
    $GLOBALS{'STATIC_null'} = ",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,";
    $GLOBALS{'STATIC_dd'} = "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31";
    $GLOBALS{'STATIC_ddth'} = "st,nd,rd,th,th,th,th,th,th,th,th,th,th,th,th,th,th,th,th,th,st,nd,rd,th,th,th,th,th,th,th,st";
    $GLOBALS{'STATIC_days'} = "Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday";
    $GLOBALS{'STATIC_mm'} = "01,02,03,04,05,06,07,08,09,10,11,12";
    $GLOBALS{'STATIC_mmm'} = "Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec";
    $GLOBALS{'STATIC_months'} = "January,February,March,April,May,June,July,August,September,October,November,December";
    $GLOBALS{'STATIC_monthdays'} = "31,28,31,30,31,30,31,31,30,31,30,31";
    $GLOBALS{'STATIC_20010101dayindex'} = "0"; // Monday
    $GLOBALS{'STATIC_yeardays'} = "365,365,365,366,365,365,365,366,365,365,365,366,365,365,365,366,365,365,365,366";
    // $CR = chr(13); $LF = chr(10); $NULL = chr(0); $COMMA = ","; $LT = "<"; $GT = ">"; $zero="0"; $SQ = chr(39); $Q = '"'; $QCQ = '","'; $AND = "&amp;";
    // $PP = chr(37).chr(37); $AT = chr(64); $HASH = "#"; $APOS = chr(39); $PARA = chr(182);
    // $OB = chr(40); $CB = chr(41);
    // $SC = chr(59); $NBSP = chr(160);
}

// ------------- Date Conversions -----------------------------------------

function YYYY_MM_DDtoDDsMMsYYYY ($yyyyummudda) {
    if ($yyyyummudda == "0000-00-00") { return ""; }
    if ($yyyyummudda == "") { return ""; }
    else {
         $dd=$yyyyummudda[8].$yyyyummudda[9];
         $mm=$yyyyummudda[5].$yyyyummudda[6];
         $yyyy=$yyyyummudda[0].$yyyyummudda[1].$yyyyummudda[2].$yyyyummudda[3];
         return $dd."/".$mm."/".$yyyy;
    }
}

function YYYY_MM_DDtoDDsMMsYY ($yyyyummudda) {
 $dd=$yyyyummudda[8].$yyyyummudda[9];
 $mm=$yyyyummudda[5].$yyyyummudda[6];
 $yy=$yyyyummudda[2].$yyyyummudda[3];
 return $dd."/".$mm."/".$yy;
}

function YYYY_MM_DDtoYYMMDD ($yyyyummudda) {
	$dd=$yyyyummudda[8].$yyyyummudda[9];
	$mm=$yyyyummudda[5].$yyyyummudda[6];
	$yy=$yyyyummudda[2].$yyyyummudda[3];
	return $yy.$mm.$dd;
}

function YYYY_MM_DDtoDDbMMMbYY ($yyyyummudda) {
	$dd=$yyyyummudda[8].$yyyyummudda[9];
	$mm=$yyyyummudda[5].$yyyyummudda[6];
	$yy=$yyyyummudda[2].$yyyyummudda[3];
	$mhash = List2Array($GLOBALS{'STATIC_mmm'});
	return $dd." ".$mhash[intval($mm-1)]." ".$yy;
}

function YYYY_MM_DDtoDDDbDDbMMMbYY ($yyyyummudda) {
	$dd=$yyyyummudda[8].$yyyyummudda[9];
	$mm=$yyyyummudda[5].$yyyyummudda[6];
	$yy=$yyyyummudda[2].$yyyyummudda[3];
	$mhash = List2Array($GLOBALS{'STATIC_mmm'});
	$unixTimestamp = strtotime($yyyyummudda);
	$dayOfWeek = date("D", $unixTimestamp);
	return $dayOfWeek." ".$dd." ".$mhash[intval($mm-1)]." ".$yy;
}

function YYYY_MM_DDtoDDDbDDbMMMbYYYY ($yyyyummudda) {
    $dd=$yyyyummudda[8].$yyyyummudda[9];
    $mm=$yyyyummudda[5].$yyyyummudda[6];
    $yyyy=$yyyyummudda[0].$yyyyummudda[1].$yyyyummudda[2].$yyyyummudda[3];
    $mhash = List2Array($GLOBALS{'STATIC_mmm'});
    $unixTimestamp = strtotime($yyyyummudda);
    $dayOfWeek = date("D", $unixTimestamp);
    return $dayOfWeek." ".$dd." ".$mhash[intval($mm-1)]." ".$yyyy;
}

function YYYY_MM_DDtoDDMMYY ($yyyyummudda) {
 $dd=$yyyyummudda[8].$yyyyummudda[9];
 $mm=$yyyyummudda[5].$yyyyummudda[6];
 $yy=$yyyyummudda[2].$yyyyummudda[3];
 return $dd.$mm.$yy;
}

function YYbMMbDDtoDDsMMsYY ($yybmmbdda) {
	$dd=$yybmmbdda[6].$yybmmbdda[7];
	$mm=$yybmmbdda[3].$yybmmbdda[4];
	$yy=$yybmmbdda[0].$yybmmbdda[1];
	return $dd."/".$mm."/".$yy;
}

function YYbMMbDDtoDDsMMsYYYY ($yybmmbdda) {
	$dd=$yybmmbdda[6].$yybmmbdda[7];
	$mm=$yybmmbdda[3].$yybmmbdda[4];
	$yyyy="20".$yybmmbdda[0].$yybmmbdda[1];
	return $dd."/".$mm."/".$yyyy;
}

function DDbMMbYYtoDDsMMsYY ($ddbmmbyya) {
	$dd=$yyyyummudda[0].$ddbmmbyya[1];
	$mm=$yyyyummudda[3].$ddbmmbyya[4];
	$yy=$yyyyummudda[6].$ddbmmbyya[7];
	return $dd."/".$mm."/".$yy;
}

function TimestamptoDDMMMbHHcMM ($timestamp) {
    if ($timestamp[0] != "T") { $timestamp = "T".$timestamp; }	
    // TYYYYMMDDHHMMSS
    $dd=$timestamp[7].$timestamp[8];
    $momo=$timestamp[5].$timestamp[6];
    $hh=$timestamp[9].$timestamp[10];
    $mimi=$timestamp[11].$timestamp[12];
    return $dd.Monthmmm($momo)." ".$hh.":".$mimi;
}

function TimestamptoDDMMMYYYYbHHcMM ($timestamp) {
    if ($timestamp[0] != "T") { $timestamp = "T".$timestamp; }
    // TYYYYMMDDHHMMSS
    $yyyy=$timestamp[1].$timestamp[2].$timestamp[3].$timestamp[4];
    $dd=$timestamp[7].$timestamp[8];
    $momo=$timestamp[5].$timestamp[6];
    $hh=$timestamp[9].$timestamp[10];
    $mimi=$timestamp[11].$timestamp[12];
    return $dd." ".Monthmmm($momo)." ".$yyyy." ".$hh.":".$mimi;
}

function TimestamptoYYYYhMMhDD ($timestamp) {
    if ($timestamp[0] != "T") { $timestamp = "T".$timestamp; }
    // TYYYYMMDDHHMMSS
    $yyyy=$timestamp[1].$timestamp[2].$timestamp[3].$timestamp[4];
    $momo=$timestamp[5].$timestamp[6];    
    $dd=$timestamp[7].$timestamp[8];
    return $yyyy."-".$momo."-".$dd;
}

function DDbMMbYYYYtoYYYYhMMhDD ($ddbmmbyyyya) {
    $dd=$ddbmmbyyyya[0].$ddbmmbyyyya[1];
    $mm=$ddbmmbyyyya[3].$ddbmmbyyyya[4];
    $yyyy=$ddbmmbyyyya[6].$ddbmmbyyyya[7].$ddbmmbyyyya[8].$ddbmmbyyyya[9];
    return $yyyy."-".$mm."-".$dd;
}

function YYbMMbDDtoYYYYsMMsDD ($yyummudda) {
	$yyyy="20".$yyummudda[0].$yyummudda[1];
	$mm=$yyummudda[3].$yyummudda[4];
	$dd=$yyummudda[6].$yyummudda[7];
	return $yyyy."-".$mm."-".$dd;
}

function YYbMMbDDtoYYYYMMDD ($yyummudda) {
	$yyyy="20".$yyummudda[0].$yyummudda[1];	
	$mm=$yyummudda[3].$yyummudda[4];
	$dd=$yyummudda[6].$yyummudda[7];
	return $yyyy.$mm.$dd;
}

function YYYY_MM_DDtoTimestamp ($yyyyummudda) {
	$yyyy=$yyyyummudda[0].$yyyyummudda[1].$yyyyummudda[2].$yyyyummudda[3];	
	$mm=$yyyyummudda[5].$yyyyummudda[6];
	$dd=$yyyyummudda[8].$yyyyummudda[9];
	return $yyyy.$mm.$dd."235959";
}

function TimestamptoDDthMMMhhmm ($yyyymmddhhmmss) {
	$momo=$yyyymmddhhmmss[4].$yyyymmddhhmmss[5];
	$dd=$yyyymmddhhmmss[6].$yyyymmddhhmmss[7];
	$hh=$yyyymmddhhmmss[8].$yyyymmddhhmmss[9];	
	$mimi=$yyyymmddhhmmss[10].$yyyymmddhhmmss[11];
	// return $dd."/".$momo." ".$hh.":".$mimi;
	return Dayth($dd)." ".Monthmmm($momo)." ".$hh.":".$mimi;
}

function Dayth ($dd) {
	$dbits = explode(',',$GLOBALS{'STATIC_ddth'});
	return $dd.$dbits[$dd-1];
}

function Monthmmm ($mm) {
	$mbits = explode(',',$GLOBALS{'STATIC_mmm'});
	return $mbits[$mm-1];
}

function AddMonth ($thisdate,$addmonths) {
	if  (($thisdate == "")||($thisdate == "0000-00-00")) {
		return $thisdate;		
	}
	else {
		$dbits = explode ('-',$thisdate);
		$year = intval($dbits[0]);
		$month = intval($dbits[1]);
		$day = intval($dbits[2]);
		$month = $month + $addmonths;
		if (($day > 28)&($addmonths > 0)) {
			$month = $month + 1;
			$day = 1;
		}		
		if ($month > 12) {
			$month = $month - 12;			
			$year = $year +1;
		}
		//�XH5($year." ".$month." ".$day);
		$montha = List2Array("00,".$GLOBALS{'STATIC_mm'});
		$daya = List2Array("00,".$GLOBALS{'STATIC_dd'});		
		$newdate = strval($year)."-".$montha[$month]."-".$daya[$day];
		//�XH5($thisdate." ".$addmonths." ".$newdate);
		return $newdate;		
	}
}


function DaysDifference ($laterdate,$earlierdate) {
	// date formats YYYY-MM-DD
	// XH2($laterdate." ".$earlierdate);
	$epochlaterdate = strtotime($laterdate);
	$epochearlierdate = strtotime($earlierdate);
	$daysdifference = (int)(($epochlaterdate - $epochearlierdate) / 86400);
	// XH2($daysdifference);
	return $daysdifference;
}	

function OffsetDays ($basedate,$offsetdays) {
	// YYYY-MM-DD +/- 
	// XH2("IN = ".$basedate."|".$offsetdays);
	$epochbasedate = strtotime($basedate);
	$epochoffsetdate = $epochbasedate + ($offsetdays*86400);
	$offsetdate = date("Y", $epochoffsetdate)."-".date("m", $epochoffsetdate)."-".date("d", $epochoffsetdate);
	// XH2("OUT = ".$offsetdate);
	return $offsetdate;
}

function OffsetMinutes ($basetime,$offsetminutes) {
	// HH:MM +
	// XH2("IN = ".$basetime."|".$offsetminutes);
	$bits = explode(':',$basetime);
	$hh = (int)$bits[0]; 
	$mm = (int)$bits[1];
	$mm = $mm + $offsetminutes;
	$newmm = (int)($mm % 60);
	$carryhh = (int)($mm / 60);
	$newhh = $hh + $carryhh;
	$offsettime = substr("00".(string)$newhh,-2).':'.substr("00".(string)$newmm,-2);
	// XH2("OUT = ".$offsettime);
	return $offsettime;
}

function StandardTime ($intime) {
	if (($intime == "")||($intime == "TBD")||($intime == "TBC")) { $outtime = $intime; }
	else {
		// replace any spectal characters by ":" and remove blanks
		$intime = str_replace(".", ":", $intime);
		$intime = str_replace(",", ":", $intime);
		$intime = str_replace("-", ":", $intime);				
		$intime = str_replace(" ", "", $intime);		
		if (strlen(strstr($intime,":"))>0) { // wellformed
			$intimea = explode(':',$intime);
			$hh = $intimea[0]; $mm = $intimea[1];
			if (strlen($hh) == 1) {	$hh = '0'.$hh;	}			
			if (strlen($mm) == 1) {	$mm = '0'.$mm;	}			
			$outtime = $hh.':'.$mm;
		} else { // poorly formed
			$intimea = str_split($intime);
			if (count($intimea) == 1) { $outtime = "0".$intime.':00'; } // 9  = 09:00	
			if (count($intimea) == 2) { $outtime = $intime.':00'; } // 12 = 12:00
			if (count($intimea) == 3) { $outtime = (string)($intimea[0]+12).':'.$intimea[1].$intimea[2]; } // 145 = 13:45
			if (count($intimea) == 4) { $outtime = $intimea[0].$intimea[1].':'.$intimea[2].$intimea[3]; } // 1245 = 12:45		
		}
	}
	return $outtime;
}


	
function UnderAge ($agelimit,$dob) {
	$underage = false;
	if  (($dob == "")||($dob == "0000-00-00")) { } // assume over 18
	else {
		$dbits = explode ('-',$dob);
		$birthday18 = (strval(intval($dbits[0])+$agelimit))."-".$dbits[1]."-".$dbits[2];
		if ( $GLOBALS{'currentYYYY-MM-DD'} < $birthday18 ) { $underage = true; }
	}
	return $underage;
}

function CurrentAge ($dob) {
	$age = "";
	if  (($dob == "")||($dob == "0000-00-00")) { } 
	else {
		$dbits = explode ('-',$dob);
		$yearoffset = intval($GLOBALS{'yyyy'}) - intval($dbits[0]);
		$monthoffset = intval($GLOBALS{'mm'}) - intval($dbits[1]);		
		if ( $monthoffset < 0 ) {
			$monthoffset = 12 + $monthoffset;
			$yearoffset = $yearoffset - 1;
		}
		$age = 	strval($yearoffset).":".strval($monthoffset);	
	}
	return $age;
}

function CurrentAgeYr ($dob) {
    $age = "";
    if  (($dob == "")||($dob == "0000-00-00")) { }
    else {
        $dbits = explode ('-',$dob);
        $yearoffset = intval($GLOBALS{'yyyy'}) - intval($dbits[0]);
        $monthoffset = intval($GLOBALS{'mm'}) - intval($dbits[1]);
        if ( $monthoffset < 0 ) {
            $monthoffset = 12 + $monthoffset;
            $yearoffset = $yearoffset - 1;
        }
        $age = 	strval($yearoffset);
    }
    return $age;
}

function Age ($dob, $agelimit) {
	$age = "";
	if  (($dob == "")||($dob == "0000-00-00")) {
	}
	else {
		$dbits = explode ('-',$dob);
		$yearoffset = intval($GLOBALS{'yyyy'}) - intval($dbits[0]);
		$monthoffset = intval($GLOBALS{'mm'}) - intval($dbits[1]);
		if ( $monthoffset < 0 ) {
			$monthoffset = 12 + $monthoffset;
			$yearoffset = $yearoffset - 1;
		}
		$age = 	strval($yearoffset).":".strval($monthoffset);
	}
	if ($yearoffset >= $agelimit) {return ""; }
	else return $age;
}

function RemoveLeadingZeros ($instring) {
	$outstring = ""; $leading = "1";
	$rbits = str_split($instring);
	foreach ($rbits as $rbit) {
		if (($rbit == "0")&&($leading == "1")) {
		}
		else { $leading = "0"; $outstring = $outstring.$rbit;
		}
	}
	return $outstring;
}

function GetSectionFromTeamCode ($teamcode) {
	$fsection = "";
	foreach (Get_Array('section',$GLOBALS{'currperiodid'}) as $tsection ) {
		Get_Data('section',$GLOBALS{'currperiodid'},$tsection);
		if ( FoundInCommaList($teamcode,$GLOBALS{'section_teams'}) ) {
			$fsection = $tsection;
		}
	}
	return $fsection;
}

function removeNamePrefixes ($xfilename) {
    // remove prefixes to get back to original file name - including case when filename contains underscores
    $fnbitsa = explode("_",$xfilename);
    if ($fnbitsa[0] == "temp") { array_shift($fnbitsa); }
    if ($fnbitsa[0] == "tempc") { array_shift($fnbitsa); }
    if ($fnbitsa[0] == "tempf") { array_shift($fnbitsa); }
    array_shift($fnbitsa);
    array_shift($fnbitsa);
    $xoutname = "";
    $xsep = "";
    foreach ($fnbitsa as $fnbit ) {
        $xoutname = $xoutname . $xsep . $fnbit;
    $xsep = "_";
    }
    return $xoutname;
}


// ========== Outputs for Javascript aided routines  ===========

// GenericReportTable provides for displaying any report in table format
function GenericReportTable_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,jqdatatablesmin,generictablepopup";
	$GLOBALS{'SITEPOPUPHTML'} = "GenericTable_Popup";	
}

// parm0 "|" ------------------------------------------------------------------------------
//    0        1          2           3
// divid   tableid   sortcolname   pagination
//                                 number/No
// parm1 "|" ---------------------------------------------
//     0             1               2            3
// colname       colheader        colwidth        colsyntax

function GenericReportTable_Parameters ($parm0a,$parm1a) {
    $tablemax = sizeof($parm0a);
    //�$mergedkeyseparator = '+';;
    //�$parm0a = explode("|",$parm0);
    //�$genericdivid = $parm0a[0];
    // $generictableid = $parm0a[1];
    // $genericsortcolname = $parm0a[2];
    // $genericpagination = $parm0a[3];
    
    //�$parm1a = explode("^",$parm1);
    	
    XINSTDHID();
    for($i = 0; $i < $tablemax;$i++) {
    	XINHID("GRT_".$i."parm0",$parm0a[$i]);
    	XINHID("GRT_".$i."parm1",$parm1a[$i]);
    }
    XINHID("GRT_parm2",$tablemax);
}

// GenericHandler CSSJS provides for basic functions including Calendar
function GenericHandler_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";	
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,jqueryconfirm";
}

// GenericHandler_Output is a general routine to maintain tables
function GenericHandler_Output ($parm0,$parm1) {
	$parms = func_get_arg(0);
	if (!is_array($parms)){
		$parms=array();for($i=0;$i<func_num_args();$i++){
			$ts=func_get_arg($i);array_push($parms,$ts);
		}
	}
	$parm0 = $parms[0];
	$parm1 = $parms[1];
	if (isset($parms[2])) {
		$parm2 = $parms[2];
	} else { $parm2 = "Close|personreloginin.php|";
	}
	$mergedkeyseparator = '+';;
	$parm0a = explode("|",$parm0);
	$genericpagetitle = $parm0a[0];
	$genericprimetable = $parm0a[1];
	$genericothertables = $parm0a[2];
	$genericprimekeyfieldname = $parm0a[3];
	$genericprimekeyfieldtitle  = "";
	$genericprimekeyfieldsize  = "";
	$genericprimekeyfieldmax  = "";
	$genericlistsortfieldname = $parm0a[4];
	$genericpagination = $parm0a[5];
	$generickeyroot = "";
	$genericaddcopy = $parm0a[6];

	$parm1a = explode("^",$parm1);
	$imagearray = Array();
	$filearray = Array();	

	XDIVPOPUP("genericdiv","");	
	$pagetitleaa = explode("[",$genericpagetitle);
	XH2($pagetitleaa[0]);
	if (sizeof($pagetitleaa) == 2) {
		$pagetitleab = explode("]",$pagetitleaa[1]);
		XPTXT($pagetitleab[0]);
	}
	
	XTABLEJQDTID("genericPrimeDataTable");
	XTHEAD();
	XTRJQDT();
	foreach ($parm1a as $parm1astring) {
		if ($parm1astring != "") {
			$parm1astringa = explode("|",$parm1astring);
			$genericfieldname = $parm1astringa[0];
			$genericfieldlisted = $parm1astringa[1];
			$genericfieldlisttitle = $parm1astringa[2];
			$genericfieldlistwidth = $parm1astringa[3];
			$genericfieldupdated = $parm1astringa[4];
			$genericfieldinputtitle = $parm1astringa[5];
			$genericfieldinputsyntax = $parm1astringa[6];
			if ($genericfieldlisted == "Yes") {
				XTDHTXTFIXED($genericfieldlisttitle,$genericfieldlistwidth);
			}	
		}
	}
	X_TR();
	X_THEAD();
	XTBODY();
	X_TBODY();
	X_TABLE();	

	$addenabled = "0";
	$keyfieldnamea = explode("+",$genericprimekeyfieldname);  // === Suppress Add buttons if View Only ====
	foreach ($keyfieldnamea as $keyfieldname) {
		foreach ($parm1a as $parm1astring) {		    
			$parm1astringa = explode("|",$parm1astring);
			$genericfieldname = $parm1astringa[0];
			$genericfieldinputsyntax = $parm1astringa[6];
			if ($genericfieldname == $keyfieldname) {
				$syntaxa = explode(",",$genericfieldinputsyntax);
				if ($syntaxa[0] == "KeyText") {
					$addenabled = "1";
				}
				if ($syntaxa[0] == "KeyDate") {
					$addenabled = "1";
				}
				if ($syntaxa[0] == "KeyTimestamp") {
				    $addenabled = "1";
				}
				if ($syntaxa[0] == "KeySelectFromTable") {
					$addenabled = "1";
				}
				if ($syntaxa[0] == "KeySelectFromList") {
					$addenabled = "1";
				}
				if ($syntaxa[0] == "KeyGenerated") {
					$addenabled = "1";
				}
				if ($syntaxa[0] == "KeyPerson") {
					$addenabled = "1";
				}
			}
		}
	}

	if (($addenabled == "1")&&($genericaddcopy != "NoAdd")) {

		XDIV("generickeyinputform","");
		if ($genericprimekeyfieldname != "") {
			XBR();XTXTBOLD("Add a new item");XBR();XBR();			
			XTABLE();
			XTR();
			
			$keyfieldnamea = explode("+",$genericprimekeyfieldname);  // === Add Headings ====			
			foreach ($keyfieldnamea as $keyfieldname) {
				foreach ($parm1a as $parm1astring) {
					$parm1astringa = explode("|",$parm1astring);
					$genericfieldname = $parm1astringa[0];
					$genericfieldinputtitle = $parm1astringa[5];
					$genericfieldinputsyntax = $parm1astringa[6];
					if ($genericfieldname == $keyfieldname) {
						$syntaxa = explode(",",$genericfieldinputsyntax);
						if ($syntaxa[0] == "KeyText") {
							XTDHTXT($genericfieldinputtitle);
						}
						if ($syntaxa[0] == "KeyDate") {
							XTDHTXT($genericfieldinputtitle);
						}
						if ($syntaxa[0] == "KeyTimestamp") {
						    XTDHTXT($genericfieldinputtitle);
						}
						if ($syntaxa[0] == "KeySelectFromTable") {
							XTDHTXT($genericfieldinputtitle);
						}
						if ($syntaxa[0] == "KeySelectFromList") {
							XTDHTXT($genericfieldinputtitle);
						}
						if ($syntaxa[0] == "KeyGenerated") {
							XTDHTXT($genericfieldinputtitle);
						}
						if ($syntaxa[0] == "KeyPerson") {
							XTDHTXT($genericfieldinputtitle);
						}
					}
				}
			}

			XTDHTXT("");
			// if ($genericaddcopy == "Yes") {XTDHTXT("Use Copied Item");}
			X_TR();


			XTR();
			$nullhash = array();
			$keyfieldnamea = explode("+",$genericprimekeyfieldname);  // === Add Fields ====
			$keycounter = 0;
			foreach ($keyfieldnamea as $keyfieldname) {
			   $keycounter++;
			   $inputkeyname = "addkeyinput".$keycounter;
			   foreach ($parm1a as $parm1astring) {
			   	if ($parm1astring != "") {
			     $parm1astringa = explode("|",$parm1astring);
			     $genericfieldname = $parm1astringa[0];
			     $genericfieldlisted = $parm1astringa[1];
			     $genericfieldlisttitle = $parm1astringa[2];
			     $genericfieldlistwidth = $parm1astringa[3];
			     $genericfieldupdated = $parm1astringa[4];
			     $genericfieldinputtitle = $parm1astringa[5];
			     $genericfieldinputsyntax = $parm1astringa[6];
			     if ($genericfieldname == $keyfieldname) {
			      $syntaxa = explode(",",$genericfieldinputsyntax);
			      XTD();XTABLEINVISIBLE();XTRINVISIBLE();
			      if ($syntaxa[0] == "KeyText") {
			      	XTD();XINTXTID($inputkeyname,$inputkeyname,"",$syntaxa[1],$syntaxa[2]); X_TD();
			      }
			      if ($syntaxa[0] == "KeyDate") {
			      	XTD();XINDATEYYYY_MM_DD ($inputkeyname,$GLOBALS{'currentYYYY-MM-DD'}); X_TD();
			      }
			      if ($syntaxa[0] == "KeyTimestamp") {
			          XTDTXT("Auto Generated");
			      }
			      if ($syntaxa[0] == "KeySelectFromTable") {
			      	XTD();
			      	XINSELECTHASH ($nullhash,$inputkeyname,"");
			      	XTXTIDUNDERLINE($syntaxa[5],$syntaxa[6]);
			      	X_TD();
			      }
			      if ($syntaxa[0] == "KeySelectFromList") {
			      	XTD();XINSELECTHASH ($nullhash,$inputkeyname,""); X_TD();
			      }
			      if ($syntaxa[0] == "KeyGenerated") {
			          XTDTXT("Auto Generated");
			      }
			      if ($syntaxa[0] == "KeyPerson") {
			      	XTD();
			      	XTD();XINTXTID($inputkeyname,$inputkeyname,"",$syntaxa[1],$syntaxa[2]);XBR();XTXTID($inputkeyname."_personlist","");X_TD();
			      	XTDTXTIDUNDERLINE($syntaxa[3],$syntaxa[4]);
			      	// XTDINBUTTONID($syntaxa[3],$syntaxa[4]);
			      }
			      X_TR();X_TABLE();X_TD();
			     }
			   	}
			   }
			}
			XTDINBUTTONID("addkeybutton","Add");
			// if ($genericaddcopy == "Yes") {XTDINBUTTONID("addcopykeybutton","AddCopy");}
			X_TR();
			X_TABLE();
		}
		X_DIV("generickeyinputform");
	}

	// ------ Finish ------------
	XBR();
	$parm2a = explode("^",$parm2);	
	$pindex = 0;
	foreach ($parm2a as $parm2astring) {
	 if ($parm2astring != "") {	
	  $parm2astringa = explode("|",$parm2astring); 
	  $genericfinishbuttontext = $parm2astringa[0];
	  $genericfinishprogram = $parm2astringa[1];
	  $genericfinishspecialaction = $parm2astringa[2];  
	  XFORM($genericfinishprogram,"genericmasterform".$pindex);
	  XINSTDHID();
	  if ($genericfinishspecialaction != "") {
	  	$saa = explode("=",$genericfinishspecialaction);  	
	  	XINHID($saa[0],$saa[1]);  	
	  }
	  XINSUBMIT($genericfinishbuttontext);
	  X_FORM();   	
	  $pindex++;	
	 }	
	}
	
	XDIV("genericDialog","");
	XFORM("genericin.php","genericinputform");
	XINSTDHID();
	XINHID("G_parm0",$parm0);
	XINHID("G_parm1",$parm1);
	XINHID("idinput","idinput","XXXX");
	XTABLE();
	$nullhash = array();
	foreach ($parm1a as $parm1astring) {
	 if ($parm1astring != "") {	
	  $parm1astringa = explode("|",$parm1astring); 
	  $genericfieldname = $parm1astringa[0];
	  $genericfieldlisted = $parm1astringa[1];
	  $genericfieldlisttitle = $parm1astringa[2];
	  $genericfieldlistwidth = $parm1astringa[3];  
	  $genericfieldupdated = $parm1astringa[4];
	  $genericfieldinputtitle = $parm1astringa[5];
	  $genericfieldinputsyntax = $parm1astringa[6];
	  if ($genericfieldupdated == "Yes") {
	   $syntaxa = explode(",",$genericfieldinputsyntax); 
	   if ($syntaxa[0] == "Divider") {
	    XTR();XTH();X_TH();XTH();XTXT($genericfieldinputtitle);X_TH();X_TR();
	   } else {     	
	    XTRID($genericfieldname."_row");XTD();XTXT($genericfieldinputtitle);X_TD();XTD();
	    if ($syntaxa[0] == "KeyText") {
	     XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "KeyDate") {
	       XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "KeyTimestamp") {
	        XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "KeySelectFromList") {
	    	XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "KeySelectFromTable") {
	    	XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "KeyGenerated") {
	      XTXTID($genericfieldname."_input","");
	    } 
	    if ($syntaxa[0] == "KeyPerson") {
	     XTXTID($genericfieldname."_input","");
	    } 
	    if ($syntaxa[0] == "Text") {
	      XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "Date") {
	        XTXTID($genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "InputText") {
	     XINTXTID($genericfieldname."_input",$genericfieldname."_input","",$syntaxa[1],$syntaxa[2]);
	    }
	    if ($syntaxa[0] == "InputTextArea") {
	    	XINTEXTAREAID($genericfieldname."_input",$genericfieldname."_input","",$syntaxa[1],$syntaxa[2]);
	    }
	    if ($syntaxa[0] == "InputHidden") {  	 
	     XINHID ($genericfieldname."_input",$syntaxa[1]);
	     XTXTID($genericfieldname."_input",$syntaxa[1]); 
	    }
	    if ($syntaxa[0] == "InputFixed") {
	     XINHID ($genericfieldname."_input",$syntaxa[1]);   	  	 
	     XTXTID($genericfieldname."_input",$syntaxa[1]);
	    } 
	    if ($syntaxa[0] == "InputTextCalc") {
	     XTXT("calculated ==>");
	    	XINTXTID($genericfieldname."_input",$genericfieldname."_input","",$syntaxa[1],$syntaxa[2]);
	    }        
	    if ($syntaxa[0] == "InputSelectFromTable") {   	
	     XINSELECTHASH ($nullhash,$genericfieldname."_input",""); 
	    }
	    if ($syntaxa[0] == "InputSelectFromTableDateEffective") {
	     XINSELECTHASH ($nullhash,$genericfieldname."_input","");
	    }
	    if ($syntaxa[0] == "InputSelectFromTableCustom") {   	
	     XINSELECTHASH ($nullhash,$genericfieldname."_input",""); 
	    }   
	    if ($syntaxa[0] == "InputRadioFromTable") { 
	     XINRADIOHASH ($nullhash,$genericfieldname."_input",""); 
	    } 
	    if ($syntaxa[0] == "InputCheckboxFromTable") {
	     XINCHECKBOXHASH ($nullhash,$genericfieldname."_input",""); 
	    }   
	    if ($syntaxa[0] == "InputSelectFromList") { 
	//    $nullhash = SyntaxListToHash($genericfieldinputsyntax);	   	
	     XINSELECTHASH ($nullhash,$genericfieldname."_input",""); 
	    }
	    if ($syntaxa[0] == "InputRadioFromList") {
	//    $nullhash = SyntaxListToHash($genericfieldinputsyntax);	 
	     XINRADIOHASH ($nullhash,$genericfieldname."_input",""); 
	    } 
	    if ($syntaxa[0] == "InputCheckboxFromList") {
	//    $nullhash = SyntaxListToHash($genericfieldinputsyntax);	   	 
	     XINCHECKBOXHASH ($nullhash,$genericfieldname."_input",""); 
	    }
	    if ($syntaxa[0] == "InputPerson") { 
	     XTABLEINVISIBLE();XTRINVISIBLE();   
	     XTD();XINTXTID($genericfieldname."_input",$genericfieldname."_input","",$syntaxa[1],$syntaxa[2]);XBR();XTXTID($genericfieldname."_personlist","");X_TD();
	     XTDINBUTTONIDSPECIAL($syntaxa[3],"info",$syntaxa[4]);     
	     X_TR();X_TABLE();
	    }
	    if ($syntaxa[0] == "InputPersonArea") {
	        XTABLEINVISIBLE();XTRINVISIBLE();
	        XTD();XINTEXTAREAID($genericfieldname."_input",$genericfieldname."_input","",$syntaxa[1],$syntaxa[2]);XBR();XTXTID($genericfieldname."_personlist","");X_TD();
	        XTDINBUTTONIDSPECIAL($syntaxa[3],"info",$syntaxa[4]);
	        X_TR();X_TABLE();
	    }
	    if ($syntaxa[0] == "InputDate") {
	     if ((count($syntaxa) > 1)&&($syntaxa[1] == "Today")){ XINDATEYYYY_MM_DD ($genericfieldname."_input",$GLOBALS{'currentYYYY-MM-DD'}); }
	     else { XINDATEYYYY_MM_DD ($genericfieldname."_input",""); }	  	 
	    }
	    if ($syntaxa[0] == "InputFile") { 
		    /*
		    0 InputFile,
		    1 GLOBALDOMAINWWWPATH/domain_temp,
		    2 GLOBALDOMAINFILEPATH/assets,
		    3 Qualification,
		    4 personqualification_personid^"
		    */
		    // THIS IMPLEMENTATION IS ONE IMAGE ONLY PER GENERIC INPUT
		    // =================== Dropzone File Output =======================
		    $filefieldname = $genericfieldname;
		    $fileviewwidth = "300";
		    $filename = "";
		    $fileuploadto = $syntaxa[3];
		    $fileuploadid = "";
		    $fileuploadmaxwidth = "800";
		    XINDROPZONEFILE($filefieldname, $fileviewwidth, $filename, $fileuploadto);
		    array_push($filearray, $filefieldname."|".$filename."|".$fileuploadto."|".$fileuploadid."|".$fileuploadmaxwidth);
	    } 
	    if ($syntaxa[0] == "InputImage") {
		    /*
		    0 InputImage,
		    1 GLOBALDOMAINWWWURL/domain_media,
		    2 GLOBALDOMAINWWWPATH/domain_media,
		    3 600,
		    4 flex,
		    5 Article,
		    6 article_id^"
		    */	    	
	    	// THIS IMPLEMENTATION IS ONE IMAGE ONLY PER GENERIC INPUT
		    // =================== Slim Image Cropper Output =======================
		    $imagefieldname = $genericfieldname; 
	    	$imageviewwidth = "300";
	    	$imagename = "";
	    	$imageuploadto = $syntaxa[5];
	    	$imageuploadid = "";
	    	$imageuploadwidth = $syntaxa[3];
	    	$imageuploadheight = $syntaxa[4];
	    	$imageuploadfixedsize = "";
	    	if (($imageuploadwidth != "flex")&&($imageuploadheight != "flex")) {$imageuploadfixedsize = $imageuploadwidth."x".$imageuploadheight;}
	    	$imagethumbwidth = "200";	    	
		    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
		    array_push($imagearray, $imagefieldname."|".$imageviewwidth."|".$imagename."|".$imageuploadto."|".$imageuploadid."|".$imageuploadwidth."|".$imageuploadheight."|".$imageuploadfixedsize."|".$imagethumbwidth);
	    }            
	    X_TD();X_TR();
	   }  
	  }
	 }
	}
	X_TABLE();
	X_FORM();
	X_DIV("genericDialog");
	
	XH5("Update Log");
	XDIV("updateLog","");
	XTXT("No updates have been made in this session so far");
	X_DIV("updateLog");
	XTXTID("TRACETEXT","");
	X_DIV("genericdiv");
		
	foreach ($filearray as $element) {
		$filea = explode("|",$element);
		// $filefieldname."|".$filename."|".$fileuploadto."|".$fileuploadid."|".$fileuploadmaxwidth
		// DropZoneFileUpload_Popup($filea[0],$filea[1],$filea[2],$filea[3],$filea[4]);
		DropZoneBasicFileUpload_Popup($filea[0],$filea[1],$filea[2],$filea[3],$filea[4]); // DROPZONEBASIC
	}
	foreach ($imagearray as $element) {		
		$imga = explode("|",$element);
		SlimImageCropper_Popup($imga[0],$imga[1],$imga[2],$imga[3],$imga[4],$imga[5],$imga[6],$imga[7],$imga[8]);
	}		
}


function Information_Popup () {
    XDIVPOPUP("informationpopup","Information");
    XDIV("informationcontainer","");
    X_DIV("informationcontainer");	
    XBR();XBR();
    XINBUTTONID("informationclosebutton","Close");
    X_DIV("informationpopup");
}

function Calendar_Popup () {
    XDIV("cal1Containerouter","yui-skin-sam");
    XDIV("cal1Container","");
    X_DIV("cal1Container");
    X_DIV("cal1Containerouter");
}

function XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto ) {
    $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_media";
    if ($imageuploadto == "TemplateElement") { $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style"; }
    if ($imageuploadto == "FRS") { $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_frs"; }
    if ($imageuploadto == "Carousel") { $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style"; }
    if ($imageuploadto == "Plugin") { $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_style"; }
    if ($imageuploadto == "PersonPhoto") {      
        $from = $GLOBALS{'domainfilepath'}."/personphotos/".$imagename;
        if (($imagename != "")&&(file_exists($from))) {
            $to = $GLOBALS{'domainwwwpath'}."/domain_temp/".$imagename;
            copy($from, $to);
        }
        $uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_temp";        
    }
    XINHID($imagefieldname."_imagename",$imagename);
    if ( $imagename != "" ) {
        XIMGID($imagefieldname."_view",$uploadurldir.'/'.$imagename, $imageviewwidth, "", "");
        XBR();XBR();
        XINBUTTONIDCLASSSPECIAL($imagefieldname."_slimimageupdatebutton","slimimageupdatebutton","info","Update Image");
        XINBUTTONIDCLASSSPECIAL($imagefieldname."_slimimageremovebutton","slimimageremovebutton","info","Remove");
    } else {
        XIMGID($imagefieldname."_view","../site_assets/NoImage_800x500.png", $imageviewwidth, "", "");
        XBR();XBR();
        XINBUTTONIDCLASSSPECIAL($imagefieldname."_slimimageupdatebutton","slimimageupdatebutton","info","Add Image");
        XINBUTTONIDCLASSSPECIAL($imagefieldname."_slimimageremovebutton","slimimageremovebutton","info","Remove");
    }
}

function SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename,  
				$imageuploadto, $imageuploadid, $imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth) {
	
	XDIVCLASSPOPUP($imagefieldname."_slimimagepopup","slimimagepopup","Image Cropper - ".$imagefieldname);
	XH5ID($imagefieldname."_imagereqmts","Image Cropper");
	XFORMUPLOAD("slimimageupload.php",$imagefieldname."_slimform");
	XINSTDHID();
	XINHID("ImageFieldName",$imagefieldname);	
	XINHID($imagefieldname."_ImageUploadTo",$imageuploadto);
	XINHID($imagefieldname."_ImageUploadId",$imageuploadid);
	XINHID($imagefieldname."_ImageUploadWidth",$imageuploadwidth);
	XINHID($imagefieldname."_ImageUploadHeight",$imageuploadheight);
	XINHID($imagefieldname."_ImageUploadFixedSize",$imageuploadfixedsize);
	XINHID($imagefieldname."_ImageThumbWidth",$imagethumbwidth);
	$max_upload = (int)(ini_get('upload_max_filesize'));
	$max_post = (int)(ini_get('post_max_size'));
	$memory_limit = (int)(ini_get('memory_limit'));
	$upload_mb = min($max_upload, $max_post, $memory_limit);	
	XINHID($imagefieldname."_MaxUploadFileSize",$upload_mb*1000000);
	/*
	if ($imageuploadfixedsize != "") { 
	    $dima = explode('x',$imageuploadfixedsize);
	    // print '<div class="slim" data-ratio="'.$dima[0].':'.$dima[1].'" data-size="'.$dima[0].','.$dima[1].'">';
	    print '<div class="slim" data-ratio="'.$dima[0].':'.$dima[1].'" data-force-size="'.$dima[0].','.$dima[1].'">';
	} else {
	    print '<div class="slim">';
	}
	*/
	print '<div class="slim">';
	print '	<input type="file" class="slim" id="'.$imagefieldname.'_mySlimImageCropper"'.' name="slim'.'[]"/>'."\n";
	print '	</div>'."\n";
	
	XBR();
	// XTXTID($imagefieldname."_imagesizemesssage","");
	// XBR();XBR();
	XINBUTTONID($imagefieldname."_upload_button","Upload");
	XINBUTTONIDSPINNER($imagefieldname."_loading_button",'Loading');	
	XINBUTTONID($imagefieldname."_cancel_button","Cancel");
	X_FORM();
	print '<canvas id="'.$imagefieldname.'_copycanvas" width="800" height="500">'."\n";
	print '</canvas>'."\n";
	X_DIV("slimimagepopup");
}

function XINDROPZONEFILE($filefieldname, $fileviewwidth, $filename, $fileuploadto ) {
	$uploadurldir = $GLOBALS{'domainwwwurl'}."/domain_temp";
	XINHID($filefieldname."_filename",$filename);
    if ( $filename != "" ) { 
    	if ((file_exists($expfilepath."/".$filename))&&(strlen(strstr($filefilebits[sizeof($filefilebits)-1],"."))>0)) {
    		$filebits = explode('.',$filefilebits[sizeof($filefilebits)-1]);
    		$filetype = $filebits[1];
    		$filetypeidentified = "0";
    		if (($filetype == "pdf")||($filetype == "pdf")) {
    			XTRINVISIBLE();XTD();
    			XIMGID($filefieldname."_imageview","","","","");
    			X_TD();X_TR();
    			XTRINVISIBLE();XTD();
    			$width = "300"; $height = "400";
    			XOBJECTID($filefieldname."_objectview",$uploadurldir.'/'.$filename, $width,$height, ""); 
    			XBR();
    			XASSETFILEDOWNLOADLINKNEWWINDOWID($filefieldname."_downloadlink",$filename);
    			X_TD();X_TR();
    			$filetypeidentified = "1";
    		}
    		if (($filetype == "jpg")||($filetype == "JPG")||
    			($filetype == "jpeg")||($filetype == "JPEG")||
    			($filetype == "gif")||($filetype == "GIF")||
    			($filetype == "png")||($filetype == "PNG")) {
    			XTRINVISIBLE();XTD();
    			XIMGID($filefieldname."_imageview",$uploadurldir.'/'.$filename, $fileviewwidth, "", "");
    			X_TD();X_TR();
    			XTRINVISIBLE();XTD();
    			XOBJECTID($filefieldname."_objectview","",$width,$height,"");
    			XBR();
    			XASSETFILEDOWNLOADLINKNEWWINDOWID($filefieldname."_downloadlink",$filename);
    			X_TD();X_TR();
    			$filetypeidentified = "1";
    		}
    		if ($filetypeidentified == "0") {
    			XTRINVISIBLE(); XTDTXT("Cannot Display File"); X_TR();
    		}
    	} else {
    		XTRINVISIBLE();XTD();
    		XIMGID($filefieldname."_imageview","../site_assets/nofile.gif","","","");
    		//�X_TD();X_TR();
    		//�XTRINVISIBLE();XTD();
    		XOBJECTID($filefieldname."_objectview","","0","0","");
    		XBR();
    		XASSETFILEDOWNLOADLINKNEWWINDOWID($filefieldname."_downloadlink","");
    		X_TD();X_TR();
    	}
    	XBR();XBR();
    	XINBUTTONIDCLASSSPECIAL($filefieldname."_dropzonefileupdatebutton","dropzonefileupdatebutton","info","Update File");
    	XINBUTTONIDCLASSSPECIAL($filefieldname."_dropzonefileremovebutton","dropzonefileremovebutton","info","Remove");    	
    } else { 
    	XIMGID($filefieldname."_imageview","../site_assets/nofile.gif", $fileviewwidth, "", "");
    	XOBJECTID($filefieldname."_objectview","","0","0","");
    	XBR();
    	XASSETFILEDOWNLOADLINKNEWWINDOWID($filefieldname."_downloadlink","");
    	XBR();XBR();
    	XINBUTTONIDCLASSSPECIAL($filefieldname."_dropzonefileupdatebutton","dropzonefileupdatebutton","info","Add File");
    	XINBUTTONIDCLASSSPECIAL($filefieldname."_dropzonefileremovebutton","dropzonefileremovebutton","info","Remove");    	  	
    }
}

function DropZoneFileUpload_Popup ($filefieldname,$filename,$fileuploadto,$fileuploadid,$fileuploadmaxwidth) {
	XDIVCLASSPOPUP($filefieldname."_dropzonefilepopup","dropzonefilepopup","File Upload");
    XFORMDROPZONE("dropzonefileupload.php","dropzoneform");
    XINSTDHID();
	XINHID("FileFieldName",$filefieldname);
	XINHID($filefieldname."_FileUploadTo",$fileuploadto);
	XINHID($filefieldname."_FileUploadId",$fileuploadid);
	XINHID($filefieldname."_FileUploadMaxWidth",$fileuploadmaxwidth);
	$max_upload = (int)(ini_get('upload_max_filesize'));
	$max_post = (int)(ini_get('post_max_size'));
	$memory_limit = (int)(ini_get('memory_limit'));
	$upload_mb = min($max_upload, $max_post, $memory_limit);
	XINHID($filefieldname."_MaxUploadFileSize",$upload_mb*1000000);	
	
	print '<input id="'.$filefieldname.'_FileUploadName" name="FileUploadName" type="file" />'."\n";
	print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
	print '<span>Drop file here to upload.. or click to browse.</span>'."\n";
	print '</div>'."\n";
	XBR();
	
	XINBUTTONID($filefieldname."_upload_button","Upload");
	XINBUTTONIDSPINNER($filefieldname."_loading_button",'Loading');
	XINBUTTONIDCLASS($filefieldname."_clear_button","dropzone_clear_button","Clear");
	XBR();
	X_FORM();	
	XBR();
	XTXTID($filefieldname."_upload_message","Message goes Here");
	XBR();
	X_DIV($filefieldname."_dropzonefilepopup");
}

function DropZoneBasicFileUpload_Popup ($filefieldname,$filename,$fileuploadto,$fileuploadid,$fileuploadmaxwidth) {	 
    XDIVCLASSPOPUP($filefieldname."_dropzonebasicfilepopup","dropzonebasicfilepopup","File Upload");
    XFORMDROPZONE("dropzonefileupload.php","dropzoneform");
    XINSTDHID();
	XINHID("FileFieldName",$filefieldname);
	XINHID($filefieldname."_FileUploadTo",$fileuploadto);
	XINHID($filefieldname."_FileUploadId",$fileuploadid);
	XINHID($filefieldname."_FileUploadMaxWidth",$fileuploadmaxwidth);
	$max_upload = (int)(ini_get('upload_max_filesize'));
	$max_post = (int)(ini_get('post_max_size'));
	$memory_limit = (int)(ini_get('memory_limit'));
	$upload_mb = min($max_upload, $max_post, $memory_limit);
	XINHID($filefieldname."_MaxUploadFileSize",$upload_mb*1000000);

	print '<input id="dropzoneBrowse" name="FileUploadName" type="file" />'."\n";
	XBR();

	XINBUTTONID($filefieldname."_upload_button","Upload");
	// XINBUTTONIDSPINNER($filefieldname."_loading_button",'Loading');
	// XINBUTTONIDCLASS($filefieldname."_clear_button","dropzone_clear_button","Clear");
	XBR();
	X_FORM();
	X_DIV($filefieldname."_dropzonefilepopup");
}



function File_Popup () {
    XDIV("genericFileDialogouter","yui-skin-sam");
    XDIV("genericFileDialog","");
    XDIV("genericFileDialoghd","hd");
    XTXT("Upload/Modify File");
    X_DIV("genericFileDialoghd");
    XDIV("genericFileDialogbd","bd");
    XH3("Upload/Modify File");
    XTABLEFIXEDID("FUTable","500");
    XTR();XTD();
    XTXT("File Name - ");XTXTID("filename","No file loaded yet");
    X_TD();X_TR();
    XTR();XTD();
    XIMGFLEXID("genericImage","");
    XOBJECTFLEXID("genericObject","");
    X_TD();X_TR();
    XTR();XTD();
    XFORMUPLOAD ("fileupload.php", "fileuploadform");
    XINSTDHID();
    XINHID("FileUploadPath","");
    XINHID("FileReplaced","");
    XINHID("AllowedFileUploadTypes","all");
    XINHID("TempPrefix","tempc_");
    XINHID("Prefix","PRE1_PRE2_");
    XBR();XBR();XINFILEID("filebrowse_button","FileUploadName","1000000");XTXT(" ==> ");XINBUTTONID("fileupload_button","Upload New File");
    X_FORM();
    X_TD();X_TR();
    XTR();XTD();
    XTXTID("genericFileMessage","Message goes Here");
    X_TD();X_TR();
    X_TABLE();
    X_DIV("genericFileDialogbd");
    X_DIV("genericFileDialog");
    X_DIV("genericFileDialogouter");
}

function GenericTable_Popup () {
	$parm0 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[0]);
	$parm1 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[1]);
	$parm2 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[2]);
	$parm3 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[3]);
	$parm4 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[4]);
	$parm5 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[5]);
	$parm6 = Strip_CRandLF($GLOBALS{'GenericTablePopupParameters'}[6]);
	// $parm0 = pagetitle
	// $parm1 = table
	// $parm2 = sortfieldname
	// $parm3 = linkfield id
	// $parm4 = field1,title1,width1|field2,title2,width2|field3,title3,width3
	// $parm5 = pagination
	// $parm6= New Window positioning name|topx|topy|width|height
	
	$tbits = explode(',', $parm6);
	XDIVPOPUP("genericTableDialog",$tbits[0]);
	XINHID("GTP_parm0",$parm0);
	XINHID("GTP_parm1",$parm1);
	XINHID("GTP_parm2",$parm2);
	XINHID("GTP_parm3",$parm3);
	XINHID("GTP_parm4",$parm4);
	XINHID("GTP_parm5",$parm5);
	XINHID("GTP_parm6",$parm6);
	XTABLEJQDTID("genericTable");
	XTHEAD();
	XTRJQDT();
	$bbits = explode('|', $parm4);
	foreach ($bbits as $bbit ) {
		$cbits = explode(',', $bbit);
		$tfieldtitle = $cbits[1];
		$tfieldwidth = $cbits[2];
		// XTDHTXTFIXED($tfieldtitle,$tfieldwidth/10);
		XTDHTXT($tfieldtitle);
	}
	X_TR();
	X_TBODY();
	X_TABLE();	
	
	X_DIV("genericTableDialog");

}

function PersonSelect_Popup () {	
    $parm0 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[0]);
    $parm1 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[1]);
    $parm2 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[2]);
    $parm3 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[3]);
    $parm4 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[4]);
    $parm5 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[5]);
    $parm6 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[6]);
    $parm7 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[7]);
    
    XDIV("personSelectDialogouter","yui-skin-sam");
    XDIV("personSelectDialog","");
    XDIV("personSelectDialoghd","hd");
    XTXT("Person Selection Wizard");
    X_DIV("personSelectDialoghd");
    XDIV("personSelectDialogbd","bd");
    XFORM("personjsselectin.php","personjsselectinputform");
    if ($parm0 != "") { // parameters not already loaded by generic output
     XINSTDHID();
    }
    XINHID("PSP_parm0",$parm0);
    XINHID("PSP_parm1",$parm1);
    XINHID("PSP_parm2",$parm2);
    XINHID("PSP_parm3",$parm3);
    XINHID("PSP_parm4",$parm4);
    XINHID("PSP_parm5",$parm5);
    XINHID("PSP_parm6",$parm6);
    XINHID("PSP_parm7",$parm7);
    XTABLE();
    XTR();
    XTDTXT("Search");
    XTD();
    XDIV("personSearchTable","");
    XTABLE();XTR();
    $bbits = explode('|', $parm1);
    foreach ($bbits as $bbit ) {
     $cbits = explode(',', $bbit);	
     $tfieldtitle = $cbits[1]; 
     $tfieldwidth = $cbits[2]; 
     XTDHTXTFIXED($tfieldtitle,$tfieldwidth/10);
    }
    XTDTXT("");XTDTXT("");
    X_TR();XTR();
    foreach ($bbits as $bbit ) {
     $cbits = explode(',', $bbit);	
     $tfieldname = $cbits[0];
     $tfieldwidth = $cbits[2];  
     XTDINTXTID($tfieldname."_search",$tfieldname."_search","",$tfieldwidth/10,$tfieldwidth/3);
    }
    XTDINBUTTONID("search_button","Search");
    XTDINBUTTONID("searchclear_button","Clear Search");
    X_TR();X_TABLE();
    X_DIV("personSearchTable");
    X_TD();
    X_TR();
    
    XTR();
    XTDTXT("Select");
    XTD();
    XDIV("personSelectTable","");
    X_DIV("personSelectTable");
    X_TD();
    X_TR();
    
    if ($parm7 == "buildfulllist") {
     XTR();
     XTDTXT("Results");
     XTD();
     XDIV("personResultsTable","");
     XTABLE();
     $bbits = explode('|', $parm2); 
     foreach ($bbits as $bbit ) {
      $cbits = explode(',', $bbit);
      $tbuttontype = $cbits[0];  
      $tbuttonid = $cbits[1];
      $tbuttontxt = $cbits[2];
      $tbuttonaction = $cbits[3];  
      if (($tbuttontype == "field")||($tbuttontype == "row")||($tbuttontype == "div")) {
       XTRID($tbuttonid."_row");
       // if ((sizeof($bbits) > 1)&&($parm4 == "all")) {XTDHTXT($tbuttontxt);}
       XTDHTXT($tbuttontxt);
       XTD();XINTXTID($tbuttonid."_result",$tbuttonid."_result","","50","300");X_TD();X_TR();  // CHECK changed from xtarea
      }
     }
     X_TABLE();
     X_DIV("personResultsTable");
     X_TD();
     X_TR();
    }
    
    X_TABLE();
    X_FORM();
    X_DIV("personSelectDialogbd");
    X_DIV("personSelectDialog");
    X_DIV("personSelectDialogouter");

}


function PersonSelection_Popup () {
	$parm0 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[0]);
	$parm1 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[1]);
	$parm2 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[2]);
	$parm3 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[3]);
	$parm4 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[4]);
	$parm5 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[5]);
	$parm6 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[6]);
	$parm7 = Strip_BLCRandLF($GLOBALS{'PersonSelectPopupParameters'}[7]);

	XDIVPOPUP("personSelectDialog","Person Selection Wizard");
	if ($parm0 != "") {
		// parameters not already loaded by generic output
		XINSTDHID();
	}
	XINHID("PSP_parm0",$parm0);
	XINHID("PSP_parm1",$parm1);
	XINHID("PSP_parm2",$parm2);
	XINHID("PSP_parm3",$parm3);
	XINHID("PSP_parm4",$parm4);
	XINHID("PSP_parm5",$parm5);
	XINHID("PSP_parm6",$parm6);
	XINHID("PSP_parm7",$parm7);
	
	// ----- results list
	if ($parm7 == "buildfulllist") {;
		XHR();
		XTXTCOLOR("<b>Selection Wizard Results</b>","navy");
		XBR();XBR();
		XTABLE();
		// BROW();
		$bbits = explode('|', $parm2);
		foreach ($bbits as $bbit ) {
			$cbits = explode(',', $bbit);
			$tbuttontype = $cbits[0];
			$tbuttonid = $cbits[1];
			$tbuttontxt = $cbits[2];
			$tbuttonaction = $cbits[3];
			if (($tbuttontype == "field")||($tbuttontype == "row")||($tbuttontype == "div")) {
			    XTRID($tbuttonid."_row");
				XTDHTXT($tbuttontxt);
				XTD();XINTEXTAREAID($tbuttonid."_result",$tbuttonid."_result","","2","100");X_TD();
				X_TR();
			    /*
			    BCOLTXT($tbuttontxt,"2");
			    BCOLINTEXTAREAID($tbuttonid."_result",$tbuttonid."_result","","2","10");
			    */
			}
		}
		// B_ROW();
		X_TABLE();
	}	
	
	// -----  search tables
	XHR();
	XTXTCOLOR("<b>Search Criteria</b>","navy");
	XTABLEJQDTID("personSearchTable");
	XTHEAD();
	XTRJQDT();
	$bbits = explode('|', $parm1);
	foreach ($bbits as $bbit ) {
		$cbits = explode(',', $bbit);
		$tfieldtitle = $cbits[1];
		$tfieldwidth = $cbits[2];
		XTDHTXTFIXED($tfieldtitle,$tfieldwidth/10);
	}
	XTDTXT("");
	if ($GLOBALS{'LOGIN_canvas_id'} != "M") {XTDTXT("");}
	X_TR();
	X_THEAD();
	XTBODY();
	XTRJQDT();
	foreach ($bbits as $bbit ) {
		$cbits = explode(',', $bbit);
		$tfieldname = $cbits[0];
		$tfieldwidth = $cbits[2];
		XTDINTXTID($tfieldname."_search",$tfieldname."_search","",$tfieldwidth/10,$tfieldwidth/3);
	}
	XTD(); 
	XINBUTTONIDSPECIAL("search_button","success","Search");
	XINBUTTONIDSPINNER("search_button_spinner",'Search'); 
	X_TD();	
	if ($GLOBALS{'LOGIN_canvas_id'} != "M") {XTDINBUTTONIDSPECIAL("searchclear_button","info","Clear Search");}
	X_TR();
	X_TBODY();
	X_TABLE();

	// -----  search results tables	
	XHR();	
	XTXTCOLOR("<b>Search Results</b>","navy");
	XBR();

	XDIV("personSelectTableContainer","");
	XTABLEJQDTID("personSelectTable");
	XTHEAD();
	XTRJQDT();
	$bbits = explode('|', $parm1);
	foreach ($bbits as $bbit ) {
		$cbits = explode(',', $bbit);
		$tfieldtitle = $cbits[1];
		$tfieldwidth = $cbits[2];
		XTDHTXTFIXED($tfieldtitle,$tfieldwidth/10);
	}
	
	if ($parm4 == "all") {
		$bbits = explode('|', $parm2);
		foreach ($bbits as $bbit ) {
			$cbits = explode(',', $bbit);
			$tfieldtitle = $cbits[1];
			$tfieldwidth = $cbits[2];
			XTDHTXTFIXED("","8");
		}
	} else {
		XTDHTXTFIXED("","8");
	}
	
	X_TR();
	X_THEAD();
	XTBODY();
	X_TBODY();
	X_TABLE();
	X_DIV("personSelectTableContainer");
		
	XDIV("emptyPersonSelectTableContainer","");	
	XBR();XPTXTCOLOR("Please supply some Search Criteria","Orange");
	X_DIV("emptyPersonSelectTableContainer");
	
	X_DIV("personSelectDialog");

}

function ChatMessage_Popup () {
	XDIVPOPUP("chatmessagepopup","Chat Message");
	XH5("Topic");
	XTXTID("chatmessage_threadtitlefixed","");
	XINTXTID("chatmessage_threadtitle","chatmessage_threadtitle","","50","100");
	XH5("My Message");
	XINTEXTAREAID("chatmessage_message","chatmessage_message","","3","50");
	if ($GLOBALS{'LOGIN_person_id'} == "bbra") { // for testing purposes
		XH5("Sent From (BBOnly)");
		XINTXTID("testchatmessage_personid","testchatmessage_personid","","5","5");
		XH5("Test Update (BBOnly)");
		XINCHECKBOXYESNOID("testchatmessage_test","testchatmessage_test","Yes","Dont send out email messages");
	}	
	XBR();XBR();
	XINBUTTONID("chatsend","Send");
	X_DIV("chatmessagepopup");
}


function Utility_DeleteDomainTempFiles () {	
    if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XH3("Tidy up Temporary Files"); }
    $currenttimestamp = time()*1000;
    $keeptime = 3600000; // one hour
    //�$keeptime = 600000; // 10 minutes = used for test
    if ($GLOBALS{'LOGIN_person_id'} == "bbra") {XH3($currenttimestamp." + ".$keeptime." milliseconds"); }  
    $tempfilea = Get_Directory_Array ($GLOBALS{'domainwwwpath'}."/"."domain_temp");
    foreach ($tempfilea as $tempfile ) {
     $taction = "Kept";
     if (($tempfile != ".")&&($tempfile != "..")) {
      $fbits = explode('.', $tempfile);
      $gbits = explode('_', $fbits[0]); 	  
      if ($gbits[0] == "temp") {
       if ($currenttimestamp > $gbits[1] + $keeptime) {
        Delete_File ($GLOBALS{'domainwwwpath'}."/"."domain_temp"."/".$tempfile);
        if ($GLOBALS{'IOWARNING'} == "0") {    	
         $taction = "Deleted";
        }
       }  else {
        $taction = "Kept";
       }
      }   	
     }
    if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($tempfile." ".$taction); }
    }	
}

function Finalise_TempImages ($tfolder,$timagename) {
	$tempfimagename = "tempf_".$timagename;
	$tempcimagename = "tempc_".$timagename;
	Check_File ($tfolder."/".$tempfimagename);
	if ($GLOBALS{'IOWARNING'} == "0") {
		copy($tfolder."/".$tempfimagename, $tfolder."/".$timagename);
	}	
	Delete_File ($tfolder."/".$tempcimagename);	
	Delete_File ($tfolder."/".$tempfimagename);	
}

function Finalise_TempFile ($tfolder,$tfilename) {e;
    Check_File ($tfolder."/".$tfilename);
    if ($GLOBALS{'IOWARNING'} == "0") {
        $nfilename = $tfilename;
        if (strlen(strstr($nfilename,"temp_")) > 0) {  $nfilename = str_replace("temp_","",$nfilename); }
        if (strlen(strstr($nfilename,"tempf_")) > 0) {  $nfilename = str_replace("tempf_","",$nfilename); }
        rename($tfolder."/".$tfilename, $tfolder."/".$nfilename);
        // XPTXT($tfolder."/".$tfilename." - renamed to - ".$tfolder."/".$nfilename);
    }
}

function View_Person_List ($parm0) {
	// person_idlist
	$listperson_ids = explode(',', $parm0);
	$viewlist = ""; $sepchars = "";
	foreach ($listperson_ids as $listperson_id) {		
		Check_Data("person",$listperson_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$viewlist=$viewlist.$sepchars.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
		}
		else{$viewlist=$viewlist.$sepchars."<b>".$listperson_id." Not Found</b>";
		}
		$sepchars="<br>";
	}
	return $viewlist;
}

function FinaliseImageInput($imagefilepath,$existingimage,$inputimage) {
    // imagefilepath existingindatabase inputfromform 
    $newimage = "";
    if ($inputimage != "") {
     if (strlen(strstr($inputimage,"tempf_")) > 0) {  $tempimage = $inputimage; $newimage = str_replace("tempf_","",$inputimage); } 	
     else { $tempimage = ""; $newimage = $inputimage; }
     if (($existingimage != "")&&($newimage != $existingimage)) { $oldimage = $existingimage; }
     else{ $oldimage = ""; }
     if (($tempimage != "")&&(file_exists($imagefilepath."/".$tempimage))) { rename($imagefilepath."/".$tempimage, $imagefilepath."/".$newimage); }
     if (($oldimage != "")&&(file_exists($imagefilepath."/".$oldimage))) { unlink($imagefilepath."/".$oldimage); } 
     $thumbimage = Imagename2Thumbname($inputimage);
     if (file_exists($imagefilepath."/".$thumbimage)) {
     	$newthumbimage = str_replace("tempf_","",$thumbimage);
     	rename($imagefilepath."/".$thumbimage, $imagefilepath."/".$newthumbimage);
     } 
     
    } 
    return $newimage;		
}

function FinaliseImageInputTemp($imagefilepath,$existingimage,$inputimage) {
    // imagefilepath existingindatabase inputfromform
    // XH3($imagefilepath."|".$existingimage."|".$inputimage);
    $newimage = "";
    if ($inputimage != "") {
        
        // Clean up temp area
        if (strlen(strstr($inputimage,"tempf_")) > 0) {  $tempimage = $inputimage; $newimage = str_replace("tempf_","",$inputimage); }
        else { $tempimage = ""; $newimage = $inputimage; }
        if (($existingimage != "")&&($newimage != $existingimage)) { $oldimage = $existingimage; }
        else{ $oldimage = ""; }
        if (($tempimage != "")&&(file_exists($GLOBALS{'domainwwwpath'}."/domain_temp/".$tempimage))) { rename($GLOBALS{'domainwwwpath'}."/domain_temp/".$tempimage, $GLOBALS{'domainwwwpath'}."/domain_temp/".$newimage); }
        if (($oldimage != "")&&(file_exists($GLOBALS{'domainwwwpath'}."/domain_temp/".$oldimage))) { unlink($GLOBALS{'domainwwwpath'}."/domain_temp/".$oldimage); }
        
        $thumbimage = Imagename2Thumbname($inputimage);
        if (file_exists($GLOBALS{'domainwwwpath'}."/domain_temp/".$thumbimage)) {
            $newthumbimage = str_replace("tempf_","",$thumbimage);
            rename($GLOBALS{'domainwwwpath'}."/domain_temp/".$thumbimage, $GLOBALS{'domainwwwpath'}."/domain_temp/".$newthumbimage);
        }
        
        // Copy to file area
        $from = $GLOBALS{'domainwwwpath'}."/domain_temp/".$newimage;
        if (($newimage != "")&&(file_exists($from))) {
            $to = $imagefilepath."/".$newimage;
            copy($from, $to);
        }
        $from = $GLOBALS{'domainwwwpath'}."/domain_temp/".$newthumbimage;
        if (($newthumbimage != "")&&(file_exists($from))) {
            $to = $imagefilepath."/".$newthumbimage;
            copy($from, $to);
        }
        
        // Delete residuals
        $from = $GLOBALS{'domainwwwpath'}."/domain_temp/".$newimage;
        if (($newimage != "")&&(file_exists($from))) {
           unlink($from);
        }
        $from = $GLOBALS{'domainwwwpath'}."/domain_temp/".$newthumbimage;
        if (($newthumbimage != "")&&(file_exists($from))) {
           unlink($from);
        }
    }        
    return $newimage;
}

// ========= convert html to text ========== 

function convert_html_to_text($html) {
	$html = fix_newlines($html);
	$html = fix_ampersands($html);	
	$doc = new DOMDocument();
	if (!$doc->loadHTML($html))
	throw new Html2TextException("Could not load HTML - badly formed?", $html);
	$output = iterate_over_node($doc);
	// remove leading and trailing spaces on each line
	$output = preg_replace("/[ \t]*\n[ \t]*/im", "\n", $output);
	// remove leading and trailing whitespace
	$output = trim($output);
	return $output;
}

function fix_newlines($text) {
	// replace \r\n to \n
	$text = str_replace("\r\n", "\n", $text);
	// remove \rs
	$text = str_replace("\r", "\n", $text);
	return $text;
}
function fix_ampersands($text) {
	$text = str_replace('&', '&amp;', $text);
	return $text;
}
function next_child_name($node) {
	// get the next child
	$nextNode = $node->nextSibling;
	while ($nextNode != null) {
		if ($nextNode instanceof DOMElement) {
			break;
		}
		$nextNode = $nextNode->nextSibling;
	}
	$nextName = null;
	if ($nextNode instanceof DOMElement && $nextNode != null) {
		$nextName = strtolower($nextNode->nodeName);
	}
	return $nextName;
}
function prev_child_name($node) {
	// get the previous child
	$nextNode = $node->previousSibling;
	while ($nextNode != null) {
		if ($nextNode instanceof DOMElement) {
			break;
		}
		$nextNode = $nextNode->previousSibling;
	}
	$nextName = null;
	if ($nextNode instanceof DOMElement && $nextNode != null) {
		$nextName = strtolower($nextNode->nodeName);
	}
	return $nextName;
}
function iterate_over_node($node) {
	if ($node instanceof DOMText) {
		return preg_replace("/\\s+/im", " ", $node->wholeText);
	}
	if ($node instanceof DOMDocumentType) {
		// ignore
		return "";
	}
	$nextName = next_child_name($node);
	$prevName = prev_child_name($node);
	$name = strtolower($node->nodeName);
	// start whitespace
	switch ($name) {
		case "hr":
			return "------\n";
		case "style":
		case "head":
		case "title":
		case "meta":
		case "script":
			// ignore these tags
			return "";
		case "h1":
		case "h2":
		case "h3":
		case "h4":
		case "h5":
		case "h6":
			// add two newlines
			$output = "\n";
			break;
		case "p":
		case "div":
			// add one line
			$output = "\n";
			break;
			// mod by r-a-y
		case "li":
			$output = '* ';
			break;
		default:
			// print out contents of unknown tags
			$output = "";
		break;
	}
	// debug
	//$output .= "[$name,$nextName]";
	for ($i = 0; $i < $node->childNodes->length; $i++) {
		$n = $node->childNodes->item($i);
		$text = iterate_over_node($n);
		$output .= $text;
	}
	// end whitespace
	switch ($name) {
		case "style":
		case "head":
		case "title":
		case "meta":
		case "script":
			// ignore these tags
			return "";
		case "h1":
		case "h2":
		case "h3":
		case "h4":
		case "h5":
		case "h6":
			$output .= "\n";
			break;
		case "p":
		case "br":
			// add one line
			if ($nextName != "div")
			$output .= "\n";
			break;
		case "div":
			// add one line only if the next child isn't a div
			if ($nextName != "div" && $nextName != null)
			$output .= "\n";
			break;
			// mod by r-a-y
		case "img":
			$alt = $node->getAttribute("alt");
			$src = $node->getAttribute("src");
			if ( ! empty( $alt ) ) {
				$output = "![Image - $alt]";
			} else {
				$output = "![Image]";
			}
			$output .= "($src)";
			break;
		case "a":
			// links are returned in [text](link) format
			$href = $node->getAttribute("href");
			if ($href == null) {
				// it doesn't link anywhere
				if ($node->getAttribute("name") != null) {
					$output = "[$output]";
				}
			} else {
				if ($href == $output) {
					// link to the same address: just use link
					$output;
				} else {
					// replace it
					$output = "[$output]($href)";
				}
			}
			// does the next node require additional whitespace?
			switch ($nextName) {
				case "h1": case "h2": case "h3": case "h4": case "h5": case "h6":
					$output .= "\n";
					break;
			}
		default:
			// do nothing
	}
	return $output;
}
class Html2TextException extends Exception {
	var $more_info;
	public function __construct($message = "", $more_info = "") {
		parent::__construct($message);
		$this->more_info = $more_info;
	}
}

function expandSymbolicURL ($url) {
	$url = str_replace("GLOBALDOMAINWWWURL", $GLOBALS{'domainwwwurl'}, $url);
	$url = str_replace("GLOBALSITEWWWURL", $GLOBALS{'site_wwwurl'}, $url);
	return $url;
}

function expandSymbolicPath ($filepath) {
	$filepath = str_replace("GLOBALDOMAINWWWPATH", $GLOBALS{'domainwwwpath'}, $filepath);
	$filepath = str_replace("GLOBALDOMAINFILEPATH", $GLOBALS{'domainfilepath'}, $filepath);
	$filepath = str_replace("GLOBALSITEWWWPATH", $GLOBALS{'site_wwwpath'}, $filepath);
	$filepath = str_replace("GLOBALSITEFILEPATH", $GLOBALS{'site_filepath'}, $filepath);
	return $filepath;
}

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];} 
    else { $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; }
    return $pageURL;
}


// ==========================================
include 'v1_xhtmlroutines.php';
include 'v1_menuroutines.php';
// ==========================================

?>
