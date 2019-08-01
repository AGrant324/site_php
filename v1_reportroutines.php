<<<<<<< HEAD
<?php # reportroutines.inc

function ReportUserVisibility($reportlevel,$nameduserlist,$selectionlogic) {
    $reportvisibility = false;
    $userlevel = 0;
    if ( $GLOBALS{'service_cor'} != "" ) {
        Check_Data('coruser');
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) { $userlevel = 1;}
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) { $userlevel = 2; }
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) { $userlevel = 3; }
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) { $userlevel = 4; }
        if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $userlevel = 4; }
        if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $userlevel = 4; }
        
        // ================ extra custom logic to enforce programme isolation ==============================
        // (corsite_corprogramme=Piraat)&(corsite_version=Live)&(corsite_status=Sold)
        if (strlen(strstr($selectionlogic,"corsite_corprogramme="))>0) {           
            $selbits = explode("corsite_corprogramme=",$selectionlogic);
            if (strlen(strstr($selbits[1],")"))>0) {
                $selbits1 = explode(")",$selbits[1]);
                $proglist = $selbits1[0];
            } else {
                $proglist = $selbits[1];
            }
            $proglist = str_replace('||', '|', $proglist);
            $corprogramme_namea = explode("|",$proglist);
            $found = "0";
            foreach ( $corprogramme_namea as $corprogramme_name ) {
                Check_Data("corprogramme",$corprogramme_name);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'corprogramme_authorisedpersonidlist'})) { $found = "1"; }
                }
            }
            if ( $found == "0" ) { $userlevel = 0; } // Dont show Repoert
        }
    }
    if ( $GLOBALS{'service_dmws'} != "" ) {
        Check_Data('person',$GLOBALS{'LOGIN_person_id'});
        $userlevel = $GLOBALS{'person_userlevel'};
        if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $userlevel = 4; }
        if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $userlevel = 4; }
    }
    if ( $GLOBALS{'service_sfm'} != "" ) {
        $userlevel = 4;
    }
    if (($userlevel >= $reportlevel)||(FoundInCommaList($GLOBALS{'LOGIN_person_id'},$nameduserlist))) { $reportvisibility = true; }
    return $reportvisibility;
}

function RelevantReportFilterVisibility($visibilityfilter) {
    $reportvisibility = false;
    if ( $visibilityfilter != "" ) {
        $selfieldvaluea = Array(); $selfieldcompa = Array(); $selfieldformata = Array();
        $seltesta = explodeAND($visibilityfilter);
        $fi = 0;
        foreach ( $seltesta as $seltest) {
            $fi++;
            $selbits = explodeCOMP($seltest);
            $selfieldcompa{$fi."_".$selbits[0]} = $selbits[1];
            $selfieldvaluea{$fi."_".$selbits[0]} = $selbits[2];
            $selfieldformata{$fi."_".$selbits[0]} = $selbits[3];
        }
        $selected = "1";
        foreach($selfieldvaluea as $k => $v) {
            $kbits = explode("_",$k);
            $kfield = $kbits[1]."_".$kbits[2];
            $selected = ReSelection($selected,$kfield,$selfieldcompa{$k},$v,$selfieldformata{$k});
        }
        if ($selected == "1") { $reportvisibility = true; }
    } else {
        $reportvisibility = true; // No filter
    }
    return $reportvisibility;
}

function Report_SETUPREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPREPORTLIST_Output () {
    XH2("Reports");
    XFORMUPLOAD("reportcomposerout.php","newreport");
    XINSTDHID();
    XINHID("report_id","new");
    XINHID("action","new");
    XINHID("menulist","reportupdatelist");
    XINSUBMIT("Create New Report");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $report_ida = Get_Array('report');
    foreach ($report_ida as $report_id) {
        Get_Data("report",$report_id);
        if ( ReportUserVisibility($GLOBALS{'report_userlevel'},$GLOBALS{'report_personidlist'},$GLOBALS{'report_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($report_id);
            XTDTXT($GLOBALS{'report_title'});
            XTDTXT($GLOBALS{'report_description'});
            XTDTXT($GLOBALS{'report_userlevel'});
            XTDTXT($GLOBALS{'report_primetable'});
            if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) { XTDTXT("Yes"); }
            else { XTDTXT("No"); }
            //			XTDTXT($GLOBALS{'report_referencedtablelist'});
            $link = YPGMLINK("reportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$report_id).YPGMPARM("menulist","reportupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("reportdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$report_id);
            XTDLINKTXT($link,"delete");
            if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) {
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"view","view");
                $link = YPGMLINK("reportpdfdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            } else {
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"view","view");
                $link = YPGMLINK("reportpdfdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            }
            $link = YPGMLINK("reportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$report_id).YPGMPARM("menulist","reportupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function Report_SETUPREPORTCOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPREPORTCOMPOSER_Output($report_id,$action) {
    
    if (($action == "new")||($action == "replicate")) {
        $report_ida = Get_Array('report');
        $highestreport_id = "RP00000";
        foreach ($report_ida as $treport_id) {
            $highestreport_id = $treport_id;
        }
        $highestreport_seq = str_replace("RP", "", $highestreport_id);
        $highestreport_seq++;
        $newreport_id = "RP".substr(("00000".$highestreport_seq), -5);
        if ($action == "new") {
            Initialise_Data('report');
            XH2("Report Composer - New Report - ".$newreport_id);
        }
        if ($action == "replicate") {
            Get_Data('report', $report_id);
            Write_Data('report', $newreport_id);
            XH2("Report Composer - Replicated Report - ".$newreport_id);
        }
        $report_id = $newreport_id;
    }
    if ($action == "update") {
        Get_Data('report', $report_id);
        XH2("Report Composer - ".$report_id." - ".$GLOBALS{'report_title'});
    }
    
    XFORM("reportcomposerin.php","reportin");
    XINSTDHID();
    XINHID("report_id",$report_id);
    XINHID("menulist","reportupdatelist");
    XHRCLASS("underline");
    XH3('Report Settings');
    BROW();
    BCOLTXT("Title<br>","1");
    BCOLINTXT("report_title",$GLOBALS{'report_title'},"3");
    BCOLTXT("Description","1");
    BCOLINTXT("report_description",$GLOBALS{'report_description'},"7");
    B_ROW();
    BROW();
    BCOLTXT("Prime Table","1");
    BCOLINTXT("report_primetable",$GLOBALS{'report_primetable'},"3");
    BCOLTXT("Referenced Tables","1");
    BCOLINTXT("report_referencedtablelist",$GLOBALS{'report_referencedtablelist'},"7");
    B_ROW(); 
    BROW();
    BCOLTXT("&nbsp;","1");
    BCOL("3");
    XINSUBMITNAME("find_submit","Show Database Fields");
    B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Prime Table<br>Filter","1");
    BCOLINTXT("report_selectionlogic",$GLOBALS{'report_selectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Referenced Table<br>Filter","1");
    BCOLINTXT("report_referencedselectionlogic",$GLOBALS{'report_referencedselectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Sort","1");
    BCOLINTXT("report_sortlogic",$GLOBALS{'report_sortlogic'},"11");
    B_ROW();
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    XBR();
    BROW();
    BCOLTXT("User Level","1");
    BCOL("3");
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"report_userlevel",$GLOBALS{'report_userlevel'});
    B_COL();
    BCOLTXT("Named People","1");
    BCOL("7");
    XINTXTID("report_personidlist","report_personidlist",$GLOBALS{'report_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("report_personidnames",View_Person_List($GLOBALS{'report_personidlist'}));
    B_COL();
    B_ROW();

    XHRCLASS("underline");
    XH3("PDF Settings");
    BROW();
    BCOLTXT("Page Layout","1");
    $xkeylist = "A4,A4-L,A3,A3-L";
    BCOLINSELECTHASH (List2Hash($xkeylist),"report_pagelayout",$GLOBALS{'report_pagelayout'},"2");
    BCOLTXT("Page Margins - L,R,T,B","1");
    if ($GLOBALS{'report_pagemargins'} == "") { $GLOBALS{'report_pagemargins'} = "15,15,15,15"; }
    BCOLINTXT("report_pagemargins",$GLOBALS{'report_pagemargins'},"2");
    BCOLTXT("Font Size","1");
    $xkeylist = "4,5,6,7,8,9,10,11,12,13,14,15,16";
    BCOLINSELECTHASH (List2Hash($xkeylist),"report_fontsize",$GLOBALS{'report_fontsize'},"2");
    BCOLTXT("Lines per page","1");
    $xkeylist = "5,6,7,8,9,10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50,52,54,56,58,60";
    BCOLINSELECTHASH (List2Hash($xkeylist),"report_linesperpage",$GLOBALS{'report_linesperpage'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Dashboard Favourite","1");
    BCOLINSELECTHASH (List2Hash("Yes,No"),"report_dashboardfavourite",$GLOBALS{'report_dashboardfavourite'},"2");
    BCOLTXT("Dashboard Icon Text","1");
    BCOLINTXT("report_favouriteicontext",$GLOBALS{'report_favouriteicontext'},"2");
    BCOLTXT("Max Report Entries<br>(Default = 500)","1");
    BCOLINTXT("report_maxselection",$GLOBALS{'report_maxselection'},"2");
    BCOLTXT("Max Execution Time<br>(Default = 30)","1");
    BCOLINTXT("report_maxexecutiontime",$GLOBALS{'report_maxexecutiontime'},"2");
    B_ROW();
       
    XHRCLASS("underline");
    XH3("Graph Settings");
    BROW();
    BCOLTXT("Caption","1");
    BCOLINTXT("report_graphcaption",$GLOBALS{'report_graphcaption'},"2");
    BCOLTXT("Graph Type","1");
    $xkeylist = ",column,line,area,spline,pie";
    $xvaluelist = "None,Column,Line,Area,Spline,Pie";
    BCOLINSELECTHASH (Lists2Hash($xkeylist,$xvaluelist),"report_graphtype",$GLOBALS{'report_graphtype'},"2");
    BCOLTXT("Stacked Data","1");
    BCOLINCHECKBOXYESNO ("report_graphstacked",$GLOBALS{'report_graphstacked'},"","2");
    B_ROW();
    BROW();
    BCOLTXT("Axes Inverted","1");
    BCOLINCHECKBOXYESNO ("report_graphinverted",$GLOBALS{'report_graphinverted'},"","2");
    BCOLTXT("Hide Source Data","1");
    BCOLINCHECKBOXYESNO ("report_graphhiderawdata",$GLOBALS{'report_graphhiderawdata'},"","2");
    B_ROW();
    BROW();
    BCOLTXT('Advanced Format<br>"table"',"1");
    BCOLINTXT("report_graphtableparms",$GLOBALS{'report_graphtableparms'},"11");
    B_ROW();
    BROW();
    BCOLTXT('Advanced Format<br>"th"',"1");
    BCOLINTXT("report_graphthparms",$GLOBALS{'report_graphthparms'},"11");
    B_ROW();  
    
    XHRCLASS("underline");
    XH3("CSV Export Settings");
    BROW();
    BCOLTXT("Re-Import Keys","1");
    BCOLINCHECKBOXYESNO ("report_uploadable",$GLOBALS{'report_uploadable'},"","2");
    B_ROW();
    
    XHRCLASS("underline");
    BROW();
    BCOL("6");
    XH3('Report Fields');
    XINTEXTAREA("report_fieldlist",$GLOBALS{'report_fieldlist'},"20","100");
    B_COL();
    
    if (strlen(strstr($GLOBALS{'report_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'report_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'report_primetable'};
        $primetablepair = "";
    }
    $tstring = $GLOBALS{$primetable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $fstring = ""; $fsep = "";
    foreach ($tfields as $tfieldelement) {
        $fbits = explode('_',$tfieldelement);
        Check_Data('field',$fbits[0],$fbits[1]);
        if ($GLOBALS{'IOWARNING'} == "0") {
            if ( $GLOBALS{"field_reportname"} != "" ) {
                $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        } else {
            $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
        }
    }
    if ( $primetablepair != "" ) {
        $fstring = $fstring.$fsep."==================="; $fsep = "\n";
        $tstring = $GLOBALS{$primetablepair."^FIELDS"};
        $tfields = explode('|', $tstring);
        foreach ($tfields as $tfieldelement) {
            $fbits = explode('_',$tfieldelement);
            Check_Data('field',$fbits[0],$fbits[1]);
            if ($GLOBALS{'IOWARNING'} == "0") {
                if ( $GLOBALS{"field_reportname"} != "" ) {
                    $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
                } else {
                    $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
                }
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        }
    }
    
    if ( $GLOBALS{'report_referencedtablelist'} != "" ) {
        //
        $reftablea = explode(',', $GLOBALS{'report_referencedtablelist'});
        foreach ($reftablea as $reftable) {
            $fstring = $fstring.$fsep."==================="; $fsep = "\n";
            
            $keylistfield = "";
            $tfielda = Get_Array('field',$primetable);
            foreach ($tfielda as $tfieldelement) {
                if ( $GLOBALS{"field_tablekeylist"} == $reftable ) {
                    // [startreflist,corresi,corsite_dispcorresiidlist]
                    $keylistfield = $tfieldelement;
                    $fstring = $fstring.$fsep.'[startreflist,'.$reftable.','.$keylistfield.']'; $fsep = "\n";
                }
            }
            if ($primetablepair != "") {
                $tfielda = Get_Array('field',$primetablepair);
                foreach ($tfielda as $tfieldelement) {
                    if ( $GLOBALS{"field_tablekeylist"} == $reftable ) {
                        // [startreflist,corresi,corsite_dispcorresiidlist]
                        $keylistfield = $tfieldelement;
                        $fstring = $fstring.$fsep.'[startreflist,'.$reftable.','.$keylistfield.']'; $fsep = "\n";
                    }
                }
            }
            if ($keylistfield == "") {
                // Keylist not found - assume reflookup instead
                // [startreflookup,corsitecomms,corsite_id]
                $tstring = $GLOBALS{$primetable."^FIELDS"};
                $tfields = explode('|', $tstring);
                $keylistfield = $tfields[1]; // CHECK - this only allows 1st key
                $fstring = $fstring.$fsep.'[startreflookup,'.$reftable.','.$keylistfield.']'; $fsep = "\n";
            }
            
            $tstring = $GLOBALS{$reftable."^FIELDS"};
            $tfields = explode('|', $tstring);
            foreach ($tfields as $tfieldelement) {
                $fbits = explode('_',$tfieldelement);
                Check_Data('field',$fbits[0],$fbits[1]);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    // corresi_aaa(AAA)[keyval=mmm]
                    if ( $GLOBALS{"field_reportname"} != "" ) {
                        $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
                    } else {
                        $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
                    }
                } else {
                    $fstring = $fstring.$fsep.$tfieldelement.''; $fsep = "\n";
                }
            }
            
            $fstring = $fstring.$fsep.'[endreflist]'; $fsep = "\n";
            
        }
    }
    
    BCOL("6");
    XH3('Database Fields');
    XTEXTAREANEW("20","100");
    XTXT($fstring);
    X_TEXTAREA();
    B_COL();
    B_ROW();
    XBR();XBR();
    XINSUBMITNAME("final_submit","Update Report Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,report_personidlist,report_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPREPORTDELETECONFIRM_Output ($report_id) {
    Get_Data("report",$report_id);
    XH3("Delete Report - ".$report_id." - ".$GLOBALS{'report_title'});
    // $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
    XPTXT("Are you sure you want to delete this report");
    XBR();
    XFORM("reportdeleteaction.php","deletereport");
    XINSTDHID();
    XINHID("report_id",$report_id);
    XINSUBMIT("Confirm Report Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}


function Report_SETUPMPDFREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPMPDFREPORTLIST_Output () {
    XH2("Custom PDF Reports");
    XFORMUPLOAD("mpdfreportcomposerout.php","newreport");
    XINSTDHID();
    XINHID("mpdfreport_id","new");
    XINHID("action","new");
    XINHID("menulist","mpdfreportupdatelist");
    XINSUBMIT("Create New Custom PDF");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("mpdfreportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Type");
    XTDHTXT("Keys");
    XTDHTXT("Filter");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $mpdfreport_ida = Get_Array('mpdfreport');
    foreach ($mpdfreport_ida as $mpdfreport_id) {
        Get_Data("mpdfreport",$mpdfreport_id);
        if ( ReportUserVisibility($GLOBALS{'mpdfreport_userlevel'},$GLOBALS{'mpdfreport_personidlist'},$GLOBALS{'mpdfreport_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($mpdfreport_id);
            XTDTXT($GLOBALS{'mpdfreport_title'});
            XTDTXT($GLOBALS{'mpdfreport_description'});
            XTDTXT($GLOBALS{'mpdfreport_userlevel'});
            XTDTXT($GLOBALS{'mpdfreport_primetable'});
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes") { XTDTXT("Unique Key"); }
            else { XTDTXT("List"); }
            XTDTXT($GLOBALS{'mpdfreport_listkeys'});
            if ($GLOBALS{'mpdfreport_selectionlogic'} != "") { XTDTXT("Yes"); }
            else { XTDTXT(""); }
            $link = YPGMLINK("mpdfreportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("menulist","mpdfreportupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("mpdfreportdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
            XTDLINKTXT($link,"delete");
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
                $link = YPGMLINK("mpdfreportkeylist.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
            } else {
                if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
                    $link = YPGMLINK("mpdfreportwebviewsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownloadsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownloadsetfilter.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                } else {
                    $link = YPGMLINK("mpdfreportwebview.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownload.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownload.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                }
            }
            $link = YPGMLINK("mpdfreportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("menulist","mpdfreportupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreport_tablecontainer");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No Custom PDF available");
    }
}

function Report_SETUPMPDFREPORTCOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup,mpdfreportcomposer";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPMPDFREPORTCOMPOSER_Output($mpdfreport_id,$action) {
    if (($action == "new")||($action == "replicate")) {
        $mpdfreport_ida = Get_Array('mpdfreport');
        $highestmpdfreport_id = "RM00000";
        foreach ($mpdfreport_ida as $tmpdfreport_id) {
            $highestmpdfreport_id = $tmpdfreport_id;
        }
        $highestmpdfreport_seq = str_replace("RM", "", $highestmpdfreport_id);
        $highestmpdfreport_seq++;
        $newmpdfreport_id = "RM".substr(("00000".$highestmpdfreport_seq), -5);
        if ($action == "new") {
            Initialise_Data('mpdfreport');
            XH2("Custom PDF Composer - New Custom PDF - ".$newmpdfreport_id);
        }
        if ($action == "replicate") {
            Get_Data('mpdfreport', $mpdfreport_id);
            Write_Data('mpdfreport', $newmpdfreport_id);
            XH2("Custom PDF Composer - Replicated Custom PDF - ".$newmpdfreport_id);
        }
        $mpdfreport_id = $newmpdfreport_id;
    }
    if ($action == "update") {
        Get_Data('mpdfreport', $mpdfreport_id);
        XH2("MPDF Report Composer - ".$mpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});
    }
    
    XFORM("mpdfreportcomposerin.php","mpdfreportin");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    XINHID("menulist","mpdfreportupdatelist");
    XHR();
    XH2('Title');
    XINTXT("mpdfreport_title",$GLOBALS{'mpdfreport_title'},"100","100");
    XH2('Description');
    XINTXT("mpdfreport_description",$GLOBALS{'mpdfreport_description'},"100","200");
    XH2('Prime Table');
    XINTXT("mpdfreport_primetable",$GLOBALS{'mpdfreport_primetable'},"20","40");
    XH2('Report Type and Parameters');
    if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
        $uniquekeyreportselected = "checked";
        $nonuniquekeyreportselected = "";
    } else {
        $uniquekeyreportselected = "";
        $nonuniquekeyreportselected = "checked";
    }
    XTABLE();
    XTR();
    XTD();
    XINRADIO("mpdfreport_uniquekeyreport", "Yes", $uniquekeyreportselected, "This report is for a specific database record");XBR();
    XTABLEINVISIBLE();
    XTR();XTDTXT("Key Field Names");XTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");XTDINTXT("mpdfreport_listkeys",$GLOBALS{'mpdfreport_listkeys'},"100","100");X_TR();
    XTR();XTDTXT("Title Field");XTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");XTDINTXT("mpdfreport_listkeytitlefields",$GLOBALS{'mpdfreport_listkeytitlefields'},"100","100");X_TR();
    XTR();XTDTXT("Composer Preview - Key Values");XTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");XTDINTXT("mpdfreport_listtestkeyvalues",$GLOBALS{'mpdfreport_listtestkeyvalues'},"100","100");X_TR();
    X_TABLE();
    X_TD();
    X_TR();
    XTR();
    XTD();
    XINRADIO("mpdfreport_uniquekeyreport", "No", $nonuniquekeyreportselected, "This report is for a list of records");XBR();
    XTABLEINVISIBLE();
    XTR();XTDTXT("Report Filter");XTDINTXT("mpdfreport_selectionlogic",$GLOBALS{'mpdfreport_selectionlogic'},"100","200");X_TR();
    XTR();XTDTXT("Max Report Entries: (Default = 10)");XTDINTXT("mpdfreport_maxselection",$GLOBALS{'mpdfreport_maxselection'},"100","200");X_TR();
    XTR();XTDTXT("Max Execution Time: (Default = 30)");XTDINTXT("mpdfreport_maxexecutiontime",$GLOBALS{'mpdfreport_maxexecutiontime'},"100","200");X_TR();
    X_TABLE();
    X_TD();
    X_TR();
    X_TABLE();
    XH2('User Level');
    
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"mpdfreport_userlevel",$GLOBALS{'mpdfreport_userlevel'});
    XH4('Authorised People');
    XINTXTID("mpdfreport_personidlist","mpdfreport_personidlist",$GLOBALS{'mpdfreport_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("mpdfreport_personidnames",View_Person_List($GLOBALS{'mpdfreport_personidlist'}));
    XH4('Visibility Filter');
    XINTXT("mpdfreport_visibilityfilter",$GLOBALS{'mpdfreport_visibilityfilter'},"100","200");
    XH2('Page Layout');
    $xkeylist = "A4,A4-L,A3,A3-L";
    XINSELECTHASH (List2Hash($xkeylist),"mpdfreport_pagelayout",$GLOBALS{'mpdfreport_pagelayout'});
    XH3('Page Margins - Left,Right,Top,Bottom');
    if ($GLOBALS{'mpdfreport_pagemargins'} == "") { $GLOBALS{'mpdfreport_pagemargins'} = "15,15,15,15"; }
    XINTXTID("mpdfreport_pagemargins","mpdfreport_pagemargins",$GLOBALS{'mpdfreport_pagemargins'},"12","20");
    XH2('Font Size');
    $xkeylist = "6,7,8,9,10,11,12,13,14,15,16";
    XINSELECTHASH (List2Hash($xkeylist),"mpdfreport_fontsize",$GLOBALS{'mpdfreport_fontsize'});
    XH2('Dashboard Favourite');
    XINSELECTHASH (List2Hash("Yes,No"),"mpdfreport_dashboardfavourite",$GLOBALS{'mpdfreport_dashboardfavourite'});
    XH2('Dashboard Icon Text');
    XINTXTID("mpdfreport_favouriteicontext","mpdfreport_favouriteicontext",$GLOBALS{'mpdfreport_favouriteicontext'},"2","2");
    XH4('Report can be  downloaded as CSV');
    XINCHECKBOXYESNO("mpdfreport_csvdownloadable",$GLOBALS{'mpdfreport_csvdownloadable'},"");
    XH3('Report php');
    BROW();
    BCOLINTEXTAREAID ('mpdfreport_php','mpdfreport_php',$GLOBALS{'mpdfreport_php'},"40","12");
    B_ROW();
    XBR();XBR();
    XINSUBMIT("Update Report Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,mpdfreport_personidlist,mpdfreport_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPMPDFREPORTDELETECONFIRM_Output ($mpdfreport_id) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Delete Custom PDF - ".$mpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});
    // $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
    XPTXT("Are you sure you want to delete this Custom PDF");
    XBR();
    XFORM("mpdfreportdeleteaction.php","deletempdfreport");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    XINSUBMIT("Confirm Custom PDF Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_SETUPFIELDAUTO_Output() {
    XH3("Setup Report and Mass Update Fields");
    XPTXT("Identify the tables for which you would like to automatically generate field titles and mass update input types");
    XPTXT("Note: This will preserve any settings that you have made manually");
    XFORM("setupfieldautoin.php","setupfield");
    XINSTDHID();
    $tablea = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            array_push($tablea, $row[0]);
        }
    }
    foreach ($tablea as $table) {
        $fielda = Get_Array('field',$table);
        if( count( $fielda ) != 0 ) { $infotext = "<b> <== Field Definitions Already Set</b>"; }
        else { $infotext = ""; }
        XINCHECKBOX("TableSelect[]","sel-".$table."-","",$table.$infotext."<BR>");
    }
    X_TD();
    X_TR();
    X_TABLE();
    XBR();
    XINSUBMIT("Select");
    X_FORM();
}

function Report_SETUPTABLEFIELDAUTO_Output($table) {
    XH3("Table - ".$table);
    $changesmade = "0";
    $seqnum = 0;
    $q = 'SHOW COLUMNS FROM '.$table;
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            // corsite_id|char(8)|NO|PRI|
            // corsite_versionpersonid|tinytext|YES||
            $tbits = explode('_',$row[0]);
            $seqnum++;
            $seqstring = "S".substr(("000".$seqnum), -3);
            // set default values
            $field_table = $tbits[0];
            $field_name = $tbits[1];
            $field_databasetype = $row[1]; 		// maintained
            $field_seq = $seqstring; 			// automatically set
            $field_reportname = $tbits[1];		// defaulted in report anyway
            $field_tablekeylist = ""; 			// manually set
            $field_massupdatetype = "";			// see logic below
            $field_massupdateparm1 = "";		// see logic below
            $field_massupdateparm2 = "";		// see logic below
            $field_massupdateselection = "";	// manually set
            
            if (substr_count($row[1], 'char') > 0) {
                $lbits = explode('(',$row[1]);
                $mbits = explode(')',$lbits[1]);
                $field_massupdatetype = "TEXT";
                $field_massupdateparm1 = "1"; // bootstrap cols
                $field_massupdateparm2 = $mbits[0]; // maxlen
            }
            if (substr_count($row[1], 'tinytext') > 0) {
                $field_massupdatetype = "TEXT";
                $field_massupdateparm1 = "1"; // bootstrap cols
                $field_massupdateparm2 = "100"; // maxlen
            }
            if (substr_count($row[1], 'text') > 0) {
                if (substr_count($row[1], 'tinytext') > 0) {}
                else {
                    $field_massupdatetype = "TEXTAREA";
                    $field_massupdateparm1 = "2"; // bootstrap cols
                    $field_massupdateparm2 = "3"; // rows
                }
            }
            if (substr_count($row[1], 'date') > 0) {
                $field_massupdatetype = "DATE";
                $field_massupdateparm1 = "1"; // bootstrap cols
                $field_massupdateparm2 = "";
            }
            if (substr_count($row[1], 'decimal') > 0) {
                $lbits = explode('(',$row[1]);
                $mbits = explode(')',$lbits[1]);
                $nbits = explode(',',$mbits[0]);
                $field_massupdatetype = "TEXT";
                $field_massupdateparm1 = "1"; // len
                $field_massupdateparm2 = $nbits[0]; // maxlen
            }
            
            if (substr_count($field_name, 'date') > 0) {
                if (substr_count($field_name, 'dates') > 0) {}
                else {
                    $field_massupdatetype = "DATE";
                    $field_massupdateparm1 = "1"; // bootstrap cols
                    $field_massupdateparm2 = "";
                }
            }
            
            Check_Data("field",$field_table,$field_name);
            if ($GLOBALS{'IOWARNING'} == "0") {
                // selectively update existing records
                $update = "0";
                $GLOBALS{'field_seq'} = $field_seq;
                if ($GLOBALS{'field_databasetype'} != $field_databasetype) {
                    XPTXTCOLOR("field_databasetype changed from |".$GLOBALS{'field_databasetype'}."| to |".$field_databasetype."|","red");
                    $GLOBALS{'field_databasetype'} = $field_databasetype;
                }
                if ($GLOBALS{'field_massupdatetype'} == "") {
                    XPTXTCOLOR("field_massupdatetype changed from |".$GLOBALS{'field_massupdatetype'}."| to |".$field_massupdatetype."|","red");
                    $GLOBALS{'field_massupdatetype'} = $field_massupdatetype;
                    $GLOBALS{'field_massupdateparm1'} = $field_massupdateparm1;
                    $GLOBALS{'field_massupdateparm2'} = $field_massupdateparm2;
                }
                Write_Data("field",$field_table,$field_name);
                // XPTXTCOLOR($field_table." ".$field_name,"orange");
                XPTXTCOLOR("Field record updated for ".$field_name,"green");
                
            } else {
                // write new record with default values
                Initialise_Data("field");
                $GLOBALS{'field_seq'} = $field_seq;
                $GLOBALS{'field_databasetype'} = $field_databasetype;
                $GLOBALS{'field_reportname'} = "";	// defaulted in report anyway
                $GLOBALS{'field_tablekeylist'} = "";
                $GLOBALS{'field_massupdatetype'} = $field_massupdatetype;
                $GLOBALS{'field_massupdateparm1'} = $field_massupdateparm1;
                $GLOBALS{'field_massupdateparm2'} = $field_massupdateparm2;
                $GLOBALS{'field_massupdateselection'} = "";	// manually set
                $changesmade = "1";
                Write_Data("field",$field_table,$field_name);
                // XPTXTCOLOR($field_table." ".$field_name,"orange");
                XPTXTCOLOR("New field record created for ".$field_name,"green");
            }
        }
    }
    XPTXTCOLOR("Automatic Generation Completed","green");
    
}

function Report_SETUPFIELD_Output() {
    XH3("Setup Report and Mass Update Fields");
    XPTXT("Detailed customisation of field settings for report headings and mass input forms");
    XFORM("setupfieldin.php","setupfield");
    XINSTDHID();
    $tablearray = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            $fielda = Get_Array('field',$row[0]);
            if( count( $fielda ) != 0 ) { array_push($tablearray, $row[0]); }
        }
    }
    $xhash = Array2Hash($tablearray);
    # hash id/name value
    XINSELECTHASH ($xhash,field_table,"");XBR();XBR();
    XINSUBMIT("Select");
    X_FORM();
}

function Report_SETUPFIELDPRINT_Output() {
    XH3("PDF Print of Report Fields");
    XPTXT("Download a PDF of the field properties for this table");
    XFORMNEWWINDOW("setupfieldpdfprintout.php","Field Print","setupfieldprint");
    XINSTDHID();
    $tablearray = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            $fielda = Get_Array('field',$row[0]);
            if( count( $fielda ) != 0 ) {
                array_push($tablearray, $row[0]);
            }
        }
    }
    $xhash = Array2Hash($tablearray);
    # hash id/name value
    XINSELECTHASH ($xhash,"field_table","");XBR();XBR();
    XINSUBMIT("Select");
    X_FORM();
}

function Report_SETUPTABLEFIELD_Output($table) {
    $parm0 = "";
    $parm0 = $parm0."Report Field Names - ".$table."|"; # pagetitle
    $parm0 = $parm0."field[rootkey=".$table."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."field_name|"; # keyfieldname
    $parm0 = $parm0."field_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."NoAdd"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."field_name|Yes|Field Name|60|Yes|Field Name|KeyText,25,40^";
    // $parm1 = $parm1."field_databasetype|Yes|Database Type|150|Yes|Database Type|InputText,30,60^";
    $parm1 = $parm1."field_reportname|Yes|Report Header|150|Yes|Report Header|InputText,30,60^";
    $parm1 = $parm1."field_tablekeylist|Yes|Key List|150|Yes|Referenced Table Key List - (Enter Referenced Table Name)|InputText,20,60^";
    $parm1 = $parm1."field_massupdatetype|Yes|Input Type|150|Yes|Input Type|InputText,30,60^";
    $parm1 = $parm1."field_massupdateparm1||||Yes|Cols|InputText,30,60^";
    $parm1 = $parm1."field_massupdateparm2||||Yes|Max Chars/Rows|InputText,30,60^";
    // $selectiontext = "Selection Values e.g.<br>Lookup(<i>tablename</i>)<br>Select(<i>val1,val2,val3</i>)<br>Checkbox(<i>Yes,No</i>)<br>Radio(<i>val1,val2,val3</i>)";
    // $parm1 = $parm1."field_massupdateselection||||Yes|".$selectiontext."|InputText,30,60^";
    $parm1 = $parm1."field_seq|Yes|Seq|60|Yes|Seq|InputText,6,6^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Report_SETUPEXPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPEXPORTLIST_Output () {
    XH2("CSV Exports");
    XFORMUPLOAD("exportcomposerout.php","newexport");
    XINSTDHID();
    XINHID("export_id","new");
    XINHID("action","new");
    XINHID("menulist","exportupdatelist");
    XINSUBMIT("Create New CSV Export");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("exportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Re-Import");
    XTDHTXT("Variable Filter");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Browser");
    XTDHTXT("CSV");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $export_ida = Get_Array('export');
    foreach ($export_ida as $export_id) {
        Get_Data("export",$export_id);
        $canupdate = "1";
        if ( ReportUserVisibility($GLOBALS{'export_userlevel'},$GLOBALS{'export_personidlist'},$GLOBALS{'export_selectionlogic'})) {
            XTR();
            XTDTXT($export_id);
            XTDTXT($GLOBALS{'export_title'});
            XTDTXT($GLOBALS{'export_description'});
            XTDTXT($GLOBALS{'export_userlevel'});
            XTDTXT($GLOBALS{'export_primetable'});
            XTDTXT($GLOBALS{'export_uploadable'});
            if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) { XTDTXT("Yes"); }
            else { XTDTXT("No"); }
            $link = YPGMLINK("exportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$export_id).YPGMPARM("menulist","exportupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("exportdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$export_id);
            XTDLINKTXT($link,"delete");
            if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) {
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            } else {
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            }
            $link = YPGMLINK("exportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$export_id).YPGMPARM("menulist","exportupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("exportdiv");
    XCLEARFLOAT();
}

function Report_SETUPEXPORTCOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPEXPORTCOMPOSER_Output($export_id,$action) {
    
    if (($action == "new")||($action == "replicate")) {
        $export_ida = Get_Array('export');
        $highestexport_id = "EX00000";
        foreach ($export_ida as $texport_id) {
            $highestexport_id = $texport_id;
        }
        $highestexport_seq = str_replace("EX", "", $highestexport_id);
        $highestexport_seq++;
        $newexport_id = "EX".substr(("00000".$highestexport_seq), -5);
        if ($action == "new") {
            Initialise_Data('export');
            XH2("Export Composer - New Export - ".$newexport_id);
        }
        if ($action == "replicate") {
            Get_Data('export', $export_id);
            Write_Data('export', $newexport_id);
            XH2("Export Composer - Replicated Export - ".$newexport_id);
        }
        $export_id = $newexport_id;
    }
    if ($action == "update") {
        Get_Data('export', $export_id);
        XH2("Export Composer - ".$export_id." - ".$GLOBALS{'export_title'});
    }
    
    XFORM("exportcomposerin.php","exportin");
    XINSTDHID();
    XINHID("export_id",$export_id);
    XINHID("menulist","exportupdatelist");
    
    XHRCLASS("underline");
    XH3('Export Settings');
    BROW();
    BCOLTXT("Title<br>","1");
    BCOLINTXT("export_title",$GLOBALS{'export_title'},"3");
    BCOLTXT("Description","1");
    BCOLINTXT("export_description",$GLOBALS{'export_description'},"7");
    B_ROW();
    BROW();
    BCOLTXT("Prime Table","1");
    BCOLINTXT("export_primetable",$GLOBALS{'export_primetable'},"3");
    BCOLTXT("Referenced Tables","1");
    BCOLINTXT("export_referencedtablelist",$GLOBALS{'export_referencedtablelist'},"7");
    B_ROW();
    BROW();
    BCOLTXT("&nbsp;","1");
    BCOL("3");
    XINSUBMITNAME("find_submit","Show Database Fields");
    B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Prime Table<br>Filter","1");
    BCOLINTXT("export_selectionlogic",$GLOBALS{'export_selectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Referenced Table<br>Filter","1");
    BCOLINTXT("export_referencedselectionlogic",$GLOBALS{'export_referencedselectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Sort","1");
    BCOLINTXT("export_sortlogic",$GLOBALS{'export_sortlogic'},"11");
    B_ROW();
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    XBR();
    BROW();
    BCOLTXT("User Level","1");
    BCOL("3");
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"export_userlevel",$GLOBALS{'export_userlevel'});
    B_COL();
    BCOLTXT("Named People","1");
    BCOL("7");
    XINTXTID("export_personidlist","export_personidlist",$GLOBALS{'export_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("export_personidnames",View_Person_List($GLOBALS{'export_personidlist'}));
    B_COL();
    B_ROW();
    
    XHRCLASS("underline");
    XH3("CSV Export Settings");
    BROW();
    BCOLTXT("Re-Import Keys","1");
    BCOLINCHECKBOXYESNO ("export_uploadable",$GLOBALS{'export_uploadable'},"","2");
    B_ROW();    
    
    /*
    
    XHR();
    XH2('Title');
    XINTXT("export_title",$GLOBALS{'export_title'},"50","100");
    XH2('Description');
    XINTXT("export_description",$GLOBALS{'export_description'},"100","200");
    XH2('Prime Table');
    XINTXT("export_primetable",$GLOBALS{'export_primetable'},"20","40");
    XH2('Referenced Tables');
    XINTXT("export_referencedtablelist",$GLOBALS{'export_referencedtablelist'},"150","250");
    XBR();XBR();
    XINSUBMITNAME("find_submit","Show Database Fields");
    XH2('Prime Table Filter');
    XINTXT("export_selectionlogic",$GLOBALS{'export_selectionlogic'},"250","250");
    XH2('Referenced Tables Filter');
    XINTXT("export_referencedselectionlogic",$GLOBALS{'export_referencedselectionlogic'},"250","250");
    XH2('Sort');
    XINTXT("export_sortlogic",$GLOBALS{'export_sortlogic'},"250","250");
    XH2('User Level');
    
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"export_userlevel",$GLOBALS{'export_userlevel'});
    XH4('Authorised People');
    XINTXTID("export_personidlist","export_personidlist",$GLOBALS{'export_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("export_personidnames",View_Person_List($GLOBALS{'export_personidlist'}));
    XH4('Add Re-Import Keys');
    XINCHECKBOXYESNO("export_uploadable",$GLOBALS{'export_uploadable'},"");
    */
    
    XHRCLASS("underline");
    BROW();
    BCOL("6");
    XH2('Export Fields');
    XINTEXTAREA("export_fieldlist",$GLOBALS{'export_fieldlist'},"20","100");
    B_COL();
    
    if (strlen(strstr($GLOBALS{'export_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'export_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'export_primetable'};
        $primetablepair = "";
    }
    $tstring = $GLOBALS{$primetable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $fstring = ""; $fsep = "";
    foreach ($tfields as $tfieldelement) {
        $fbits = explode('_',$tfieldelement);
        Check_Data('field',$fbits[0],$fbits[1]);
        if ($GLOBALS{'IOWARNING'} == "0") {
            if ( $GLOBALS{"field_reportname"} != "" ) {
                $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        } else {
            $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
        }
    }
    if ( $primetablepair != "" ) {
        $fstring = $fstring.$fsep."==================="; $fsep = "\n";
        $tstring = $GLOBALS{$primetablepair."^FIELDS"};
        $tfields = explode('|', $tstring);
        foreach ($tfields as $tfieldelement) {
            $fbits = explode('_',$tfieldelement);
            Check_Data('field',$fbits[0],$fbits[1]);
            if ($GLOBALS{'IOWARNING'} == "0") {
                if ( $GLOBALS{"field_exportname"} != "" ) {
                    $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
                } else {
                    $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
                }
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        }
    }
    
    BCOL("6");
    XH2('Database Fields');
    XTEXTAREANEW("20","100");
    XTXT($fstring);
    X_TEXTAREA();
    B_COL();
    B_ROW();
    XBR();XBR();
    XINSUBMITNAME("final_submit","Update Export Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,export_personidlist,export_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPEXPORTDELETECONFIRM_Output ($export_id) {
    Get_Data("export",$export_id);
    XH3("Delete Export - ".$export_id." - ".$GLOBALS{'export_title'});
    XPTXT("Are you sure you want to delete this export");
    XBR();
    XFORM("exportdeleteaction.php","deleteexport");
    XINSTDHID();
    XINHID("export_id",$export_id);
    XINSUBMIT("Confirm Export Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_REPORTWEBVIEWSETFILTER_Output( $reportexport, $reportexport_id ) {
    
    Get_Data($reportexport,$reportexport_id);
    $reporttitle = $GLOBALS{$reportexport.'_title'};
    $reportdescription = $GLOBALS{$reportexport.'_description'};
    $reportprimetablelist = $GLOBALS{$reportexport.'_primetable'};
    $reportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $reportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $reportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $reportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $reportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    if ( $inreportexport == "export" ) { $reportuploadable = $GLOBALS{$reportexport.'_uploadable'}; }
    else { $reportuploadable = "No"; }
    
    if (strlen(strstr($reportprimetablelist,','))>0) {
        $reportprimetablea = explode(",",$reportprimetablelist);
        $reportprimetable = $reportprimetablea[0];
        $reportprimetablepair = $reportprimetablea[1];
    } else {
        $reportprimetable = $reportprimetablelist;
        $reportprimetablepair = "";
    }
    XH3('Set the filter values for this "browser view"');
    XBR();
    XFORM("reportwebview.php","reportwebview");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    if ($reportselectionlogic != "") {
        FilterTable("PF",$reportselectionlogic);
        XBR();
    }
    if ($reportreferencedselectionlogic != "") {
        FilterTable("RF",$reportreferencedselectionlogic);
        XBR();
    }
    XINSUBMIT("Create Report.");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function FilterTable($PForRF,$thisselectionlogic) {
    $orsep = ""; $ori = 1;
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            XPTXT($orsep);
            XTABLE();
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $selbits0a = explode("_",$selbits[0]);
                $thistable = $selbits0a[0];
                $specialdisplay = "0";
                if ($fi == 1) {$andtext = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {$andtext = "and";}
                if ( $selbits[2] == '?' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXTBACKCOLOR($PForRF.$ori.$fi."_".$selbits[0],"","50","100","LightBlue");X_TR();
                    $specialdisplay = "1";
                }
                if ( $selbits[2] == '??' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);
                    $selectvala = Array();
                    $thistablea = Get_Array($thistable);
                    foreach ( $thistablea as $thistablekey ) {
                        Get_Data($thistable,$thistablekey);
                        array_push($selectvala, $GLOBALS{$selbits[0]});
                    }
                    $selectvala = array_unique($selectvala);
                    sort($selectvala);
                    XTD();
                    foreach ( $selectvala as $selectval) {
                        XINCHECKBOX ($PForRF.$ori.$fi."_".$selbits[0]."[]",$selectval,"",$selectval);XBR();
                    }
                    X_TD();
                    X_TR();
                    $specialdisplay = "1";
                }
                if ( $selbits[2][0] == '[' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDTXTCOLOR($selbits[2],"Red");X_TR();
                    $specialdisplay = "1";
                }
                /*
                 if (strlen(strstr($selbits[0],'{dd/mm/yyyy}'))>0) {
                 XTR();XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);
                 XINDATEID($PForRF.$fi."_".$selbits[0],$PForRF.$fi."_".$selbits[0].'_dd/mm/yyyy',"");
                 X_TR();
                 $specialdisplay = "1";
                 }
                 */
                if ( $specialdisplay == "0" ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXT($PForRF.$ori.$fi."_".$selbits[0],$selbits[2],"50","100");X_TR();
                }
            }
            X_TABLE();
            $orsep = "or";
            $ori++;
        }
    }
}

function Report_REPORTPDFDOWNLOADSETFILTER_Output( $reportexport, $reportexport_id ) {
    
    Get_Data($reportexport,$reportexport_id);
    $reporttitle = $GLOBALS{$reportexport.'_title'};
    $reportdescription = $GLOBALS{$reportexport.'_description'};
    $reportprimetable = $GLOBALS{$reportexport.'_primetable'};
    $reportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $reportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $reportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $reportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $reportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    
    XH3('Set the filter values for this "pdf download"');
    XBR();
    XFORM("reportpdfdownload.php","reportpdfdownload");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    if ($reportselectionlogic != "") {
        FilterTable("PF",$reportselectionlogic);
        XBR();
    }
    if ($reportreferencedselectionlogic != "") {
        FilterTable("RF",$reportreferencedselectionlogic);
        XBR();
    }
    XINSUBMIT("Create Report");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_REPORTWEBVIEW_Output( $reportexport, $reportexport_id, $selectionlogic, $referencedselectionlogic ) {
    
    Get_Data($reportexport,$reportexport_id);
    $reporttitle = $GLOBALS{$reportexport.'_title'};
    $reportdescription = $GLOBALS{$reportexport.'_description'};
    $reportprimetable = $GLOBALS{$reportexport.'_primetable'};
    $reportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $reportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $reportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $reportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $reportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    if ( $inreportexport == "export" ) { $GLOBALS{$reportexport.'_uploadable'}; }
    else { $reportuploadable = "No"; }
    $reportgraphtype = $GLOBALS{$reportexport.'_graphtype'};
    $reportgraphstacked = $GLOBALS{$reportexport.'_graphstacked'};
    $reportgraphcaption = $GLOBALS{$reportexport.'_graphcaption'};
    $reportgraphinverted = $GLOBALS{$reportexport.'_graphinverted'};
    $reportgraphtableparms = $GLOBALS{$reportexport.'_graphtableparms'};
    $reportgraphthparms = $GLOBALS{$reportexport.'_graphthparms'};
    $reportgraphhiderawdata = $GLOBALS{$reportexport.'_graphhiderawdata'};
    
    XH3("Description");
    XPTXT($reportdescription);
    XH3("Settings");
    XPTXT("Prime Table - ".$reportprimetable);
    if ($reportreferencedtablelist != "") {$reftext = $reportreferencedtablelist;} else {$reftext = "None";}
    XPTXT("Other Referenced Tables - ".$reftext);
    
    if ( $selectionlogic != "") { $thisselectionlogic = $selectionlogic; }
    else { $thisselectionlogic = $reportselectionlogic; }
    if ( $referencedselectionlogic != "") { $thisreferencedselectionlogic = $referencedselectionlogic; }
    else { $thisreferencedselectionlogic = $reportreferencedselectionlogic; }
    
    XFORM("reportwebview.php","reportwebview");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    XPTXT("Filters");
    $orsep = ""; $ori = 1;
    $adjustablefiltersfound = "0";
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            XPTXT($orsep);
            XTABLE();
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $specialdisplay = "0";
                if ($fi == 1) {$andtext = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {$andtext = "and";}
                if ( $selbits[2] == '?' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXTBACKCOLOR("PF".$ori.$fi."_".$selbits[0],"","50","100","LightBlue");X_TR();
                    $adjustablefiltersfound = "1"; $specialdisplay = "1";
                }
                if ( $selbits[2][0] == '[' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDTXTCOLOR($selbits[2],"Red");X_TR();
                    $specialdisplay = "1";
                }
                if ( $specialdisplay == "0" ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXT("PF".$ori.$fi."_".$selbits[0],$selbits[2],"50","100");X_TR();
                    $adjustablefiltersfound = "1";
                }
            }
            X_TABLE();
            $orsep = "or";
            $ori++;
        }
    }
    
    $orsep = ""; $ori = 1;
    if ( $thisreferencedselectionlogic != "" ) {
        $multirefsellogica = explodeOR($thisreferencedselectionlogic);
        foreach ($multirefsellogica as $multirefsellogic) {
            $seltesta = explodeAND($multirefsellogic);
            XPTXT($orsep);
            XTABLE();
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $specialdisplay = "0";
                if ($fi == 1) {$andtext = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {$andtext = "and";}
                if ( $selbits[2] == '?' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXTBACKCOLOR("RF".$ori.$fi."_".$selbits[0],"","50","100","LightBlue");X_TR();
                    $adjustablefiltersfound = "1"; $specialdisplay = "1";
                }
                if ( $selbits[2][0] == '[' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDTXTCOLOR($selbits[2],"Red");X_TR();
                    $specialdisplay = "1";
                }
                if ( $specialdisplay == "0" ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXT("RF".$ori.$fi."_".$selbits[0],$selbits[2],"50","100");X_TR();
                    $adjustablefiltersfound = "1";
                }
            }
            X_TABLE();
            $orsep = "or";
            $ori++;
        }
    }
    
    if ( $adjustablefiltersfound == "1" ) {
        XBR();XINSUBMIT("Refresh Filters");
    }
    
    XBR();
    X_FORM();
    if ($reportsortlogic != "") {$sorttext = $reportsortlogic;} else {$sorttext = "None";}
    XBR();XPTXT("Sort - ".$sorttext);
    $primetable = $reportprimetable;
    
    // =======  Generate Report Array ===============
    $ra = GenerateReportArray($reportprimetable,$reportreferencedtablelist,$thisselectionlogic,$thisreferencedselectionlogic,$reportsortlogic,$reportfieldlist);
    // $primetable, $referencedtablelist, $selectionlogic, $referencedselectionlogic, $sortlogic, $fieldlist
    
    // print_r($ra["rdata"]);

    
    // =======  Format the Graph ===============
    if ($reportgraphtype != "") {
        XH3("Graph View.");
        XINHIDID("ReportType","ReportType","report");
        BROW();
        BCOL("3"); BINBUTTONIDSPECIAL("SaveGraphImage","info","Save Graph Image"); B_COL();
        B_ROW();
        // XTXT("gxheader - ");print_r($ra["gxheader"]);XBR();
        // XTXT("gyheader - ");print_r($ra["gyheader"]);XBR();
        // XTXT("gdata - ");print_r($ra["gdata"]);XBR();  
        // Note that this table switches X and Y orientation !!
        
        $extratableparms = $reportgraphtableparms;
        if ($reportgraphinverted == "Yes") {
            $extratableparms = $extratableparms.' data-graph-inverted="1"';
        }
        
        $extrathparms = $reportgraphthparms;
        if ($reportgraphstacked == "Yes") {
            $extrathparms = $extrathparms.' data-graph-stack-group="1" ';
        }
        print '<table class="table highchart" data-graph-container-before="1" '.$extratableparms." ";
        
        if ( $reportgraphtype == "pie" ) { 
            print ' data-graph-datalabels-enabled=1 ';
        }              

        $coli = 1;
        foreach ($ra["gyheader"] as $ykey => $yvalue) {
            if ($yvalue == "Red") { print 'data-graph-color-'.$coli.'="red" ';  }
            if ($yvalue == "Amber") { print 'data-graph-color-'.$coli.'="orange" ';  }
            if ($yvalue == "Green") { print 'data-graph-color-'.$coli.'="green" ';  }
            if ($yvalue == "") { print 'data-graph-color-'.$coli.'="silver" ';  }
            $coli++;
        }
        
        if ( $reportgraphcaption == "" ) { $reportgraphcaption = $reporttitle; }
        print ' data-graph-type="'.$reportgraphtype.'" ';
        print ' >'."\n";
        print '<caption>'.$reportgraphcaption.'</caption>'."\n";
        print '<thead>'."\n";
        print '<tr>'."\n";
        print '<th></th>'."\n";
        
        foreach ($ra["gyheader"] as $ykey => $yvalue) {
            if ($yvalue == "") { print '<th '.$extrathparms.'>None</th>'."\n";  }
            else { print '<th '.$extrathparms.'>'.$yvalue.'</th>'."\n"; }
        }       
        print '</tr>'."\n";
        print '</thead>'."\n";
        print '<tbody>'."\n";        
        
        foreach ($ra["gxheader"] as $xkey => $xvalue) {
            print '<tr>'."\n";
            print '<td>'.$xvalue.'</td>'."\n";           
            foreach ($ra["gyheader"] as $ykey => $yvalue) {               
                $yvalue = $ra["gdata"][$xvalue][$yvalue];               
                // data-graph-name="January" data-graph-item-color="#ccc"
                $color = "";
                if ($xvalue == "Red") { $color = ' data-graph-item-color="red" ';  }
                if ($xvalue == "Amber") { $color = ' data-graph-item-color="orange" ';  }
                if ($xvalue == "Green") { $color = ' data-graph-item-color="green" ';  }
                if ($xvalue == "") { $color = ' data-graph-item-color="silver" ';  }
                $pielabel = "";
                if ( $reportgraphtype == "pie" ) { $pielabel = ' data-graph-name="'.$xvalue.' '.$yvalue.'" '; }               
                print '<td'.$color.$pielabel.'>'.$yvalue.'</td>'."\n";
            }
            print '</tr>'."\n";
        }      
        print '</tbody>'."\n";
        print '</table>'."\n";
        XBR();
        print '<canvas id="myCanvas" width="600" height="600"'."\n";
        print 'style="border:1px solid #c3c3c3;">'."\n";
        print '</canvas>'."\n";   
        print '<img id="myImage" src="../site_assets/NoImage_Flex.png" height="600" >'."\n";
        XINHIDID("report_graphimage","report_graphimage","");
    }
    
    // =======  Format and Show the Report ===============
    if ($reportgraphhiderawdata != "Yes") {
    
        XH3("Report View.");
        $linecounter = 0;
        XDIV("reportdiv","container");
        XTABLEJQDTID("reporttable_report");
        
        // ============ Create Header Row ==============
        XTHEAD();
        XTRJQDT();
        $coloffset = 0;
        $colindex = 0;
        if ( AssocArrayCount($ra["rtable"]) > 0 ) {
            XTDHTXT("Seq");
            $coloffset = 1;
            $colindex++;
        }
        $maxprimeheadingcount = 0;
        $pfi = 0;
        foreach ($ra["pheader"] as $hfield) {
            XTH();
            XTXT($hfield);
            $fieldname = $ra["pfieldname"][$pfi];
            if ( $ra["pfilter"][$pfi] == "Y" ) { XTXT('<i id="filter_'.$colindex.'"class="fa fa-filter reportfilter"></i>'); }
            X_TH();
            $maxprimeheadingcount++;
            $colindex++;
            $pfi++;
        }
        $maxrefheadingcount = 0;
        if (AssocArrayCount($ra["rtable"]) == 1 ) { // show headings on prime heading line
            foreach ($ra["rtable"] as $reftable) {  // Theres only 1 !!
                $rfi = 0;
                foreach ($ra["rheader"][$reftable] as $hfield) {
                    XTH();
                    XTXT($hfield);
                    $fieldname = $ra["pfieldname"][$reftable][$rfi];
                    if ( $ra["pfilter"][$rfi] == "Y" ) { XTXT('<i id="filter_'.$colindex.'"class="fa fa-filter filteroff"></i>'); }
                    X_TH();
                    // $maxprimeheadingcount++; REMOVE
                    $colindex++;
                    $maxrefheadingcount++;
                    $rfi++;
                }
            }
        }
        if (AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines
            foreach ($ra["rtable"] as $reftable) {
                $thiscount = AssocArrayCount($ra["rheader"][$reftable]);
                if ($thiscount > $maxrefheadingcount) { $maxrefheadingcount = $thiscount; }
            }
            for( $i = 0; $i<$maxrefheadingcount; $i++ ) { XTDHTXT(" "); }
        }
        $maxprogramheadingcount = 0;
        foreach ($ra["programheader"] as $hfield) { XTDHTXT(""); $maxprogramheadingcount++; }
        X_TR();
        X_THEAD();
        
        // ============ Create Data Rows ==============
        XTBODY();
        foreach ($ra["pdata"] as $primeid => $valuearray) {
            // ----- first data line relating to this primeid -------------
            XTRJQDT();
            if ( AssocArrayCount($ra["rtable"]) > 0 ) { $linecounter++; XTDTXT($linecounter); }
            foreach ($ra["pdata"][$primeid] as $field) { XTDTXT($field); }
            $reflineusedalready = "0";
            if (AssocArrayCount($ra["rtable"]) == 1 ) { // show first referenced data on prime data line
                $reftable = AssocArrayFirstValue($ra["rtable"]); // only one
                // XPTXT(AssocArrayCount($ra["rtable"])." | ".$reftable." | ".$primeid." | ".AssocArrayCount($ra["rdata"][$reftable][$primeid]));
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    $firstreferencedid = AssocArrayFirstKey($ra["rdata"][$reftable][$primeid]);
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) { // may not be selected
                        foreach ($ra["rdata"][$reftable][$primeid][$firstreferencedid] as $field) { XTDTXT($field); }
                        $reflineusedalready = "1";
                    }
                } else {  // no ref data - pad out
                    for( $i = 0; $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
                }
            } else { // show multi ref table data on separate lines
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
            }
            foreach ($ra["programdata"][$primeid] as $field) { XTDTXT($field); }
            X_TR();
            
            // ----- subsequent data lines relating to this prime id -----------
            foreach ($ra["rtable"] as $reftable) {
                if (AssocArrayCount($ra["rtable"]) > 1 ) {
                    // show heading row before each referenced table section provided there is data
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                        XTRJQDT();
                        if (AssocArrayCount($ra["rtable"]) > 0 ) { $linecounter++; XTDTXT($linecounter); }
                        foreach ($ra["pdata"][$primeid] as $field) { XTDTXTCOLOR($field,"#cccccc"); }
                        if (AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines
                            foreach ($ra["rheader"][$reftable] as $hfield) { XTDTXTCOLOR("<b>".$hfield."</b>","navy"); }
                            for( $i = AssocArrayCount($ra["rheader"][$reftable]); $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
                        }
                        for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { XTDTXT(""); }
                        X_TR();
                    }
                }
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
                        // ----- show referenced table data row -----------
                        if ($reflineusedalready == "1") {
                            $reflineusedalready = "0";
                        } else {
                            XTRJQDT();
                            if (AssocArrayCount($ra["rtable"]) > 0 ) { $linecounter++; XTDTXT($linecounter); }
                            foreach ($ra["pdata"][$primeid] as $field) { XTDTXTCOLOR($field,"#cccccc"); }
                            $refcount = 0;
                            foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) { XTDTXT($field); $refcount++;}
                            for( $i = $refcount; $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
                            for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { XTDTXT(""); }
                            X_TR();
                        }
                    }
                }
            }
        }
        
        $footerrow = "0";
        
        // ===== Counts ===============
        
        if (((AssocArrayFindCount($ra["pcountreqd"],"Y") > 0 )||(AssocArrayFindCount2($ra["rcountreqd"],"Y") > 0 ))) {
            $footerrow = "1";
            X_TBODY();
            XTFOOT();
            XTRJQDT();
            if ( AssocArrayCount($ra["rtable"]) > 0 ) { XTDTXT(""); }
            $fi = 0;
            foreach ($ra["pfieldname"] as $tfieldname) {
                if ( $ra["pcountreqd"][$fi] == "Y" ) {
                    XTDTXTCOLOR ($ra["pcountnumval"][$fi], "blue");
                }
                else { XTDTXT(""); }
                $fi++;
            }
            if (AssocArrayCount($ra["rtable"]) == 1 ) {
                // show counts on single line
                foreach ($ra["rtable"] as $reftable) { // Theres only 1 !!
                    $rfi = 0;
                    foreach ($ra["rfieldname"][$reftable] as $tfieldname) {
                        if ( $ra["rcountreqd"][$reftable][$rfi] == "Y" ) { XTDTXTCOLOR ($ra["rcountnumval"][$reftable][$rfi], "blue"); }
                        else {  XTDTXT(""); }
                        $rfi++;
                    }
                }
            }
            
            if (AssocArrayCount($ra["rtable"]) > 1 ) {
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                    XTDTXT(""); // CHECK - NOT CATERED FOR
                }
            }
            foreach ($ra["programheader"] as $hfield) { XTDTXT(""); }
            X_TR();
            X_TFOOT();
        }
        
        
        // ===== Totals ===============
        
        if (((AssocArrayFindCount($ra["ptotalreqd"],"Y") > 0 )||(AssocArrayFindCount2($ra["rtotalreqd"],"Y") > 0 ))) {
            $footerrow = "1";
            X_TBODY();
            XTFOOT();
            XTRJQDT();
            if ( AssocArrayCount($ra["rtable"]) > 0 ) { XTDTXT(""); }
            $fi = 0;
            foreach ($ra["pfieldname"] as $tfieldname) {
                if ( $ra["ptotalreqd"][$fi] == "Y" ) {
                    // XTDTXT($ra["ptotalformattedval"][$tfieldname]);
                    XTDTXTCOLOR ($ra["ptotalformattedval"][$fi], "blue");
                }
                else { XTDTXT(""); }
                $fi++;
            }
            if (AssocArrayCount($ra["rtable"]) == 1 ) {
                // show totals on single line
                $rfi = 0;
                foreach ($ra["rtable"] as $reftable) {
                    // Theres only 1 !!
                    foreach ($ra["rfieldname"][$rfi] as $tfieldname) {
                        if ( $ra["rtotalreqd"][$rfi] == "Y" ) { XTDTXT($ra["rtotalformattedval"][$rfi]); }
                        else {  XTDTXT(""); }
                    }
                    $rfi++;
                }
            }
            
            if (AssocArrayCount($ra["rtable"]) > 1 ) {
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                    XTDTXT(""); // CHECK - NOT CATERED FOR
                }
            }
            foreach ($ra["programheader"] as $hfield) { XTDTXT(""); }
            X_TR();
            X_TFOOT();
        }
        
        
        
        if ( $footerrow == "0" ) {
            XTFOOT();
            X_TFOOT();
            X_TBODY();
        }
        
        X_TABLE();
        
        X_DIV("reportdiv");
        XCLEARFLOAT();
        
        if ($coloffset == 1) {
            for ($i = 0; $i < count($ra["sortfieldcol"]); $i++) {
                $ra["sortfieldcol"][$i]++;
            }
        }
        XINHID("report_sortcol",Array2List($ra["sortfieldcol"]));
        XINHID("report_sortseq",Array2List($ra["sortfieldseq"]));
    }
    
    $link = YPGMLINK("reportpdfdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport",$reportexport).YPGMPARM("reportexport_id",$reportexport_id);
    $orsep = ""; $ori = 1;
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {          
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("PF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }
    $orsep = ""; $ori = 1;
    if ( $thisreferencedselectionlogic != "" ) {
        $multisellogica = explodeOR($thisreferencedselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("RF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }
    XBR();    
    XLINKTXTNEWWINDOW($link,"download this report as pdf","pdf_view");
    
    $link = YPGMLINK("exportcsvdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport",$reportexport).YPGMPARM("reportexport_id",$reportexport_id);
    
    $orsep = ""; $ori = 1;
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("PF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }
    $orsep = ""; $ori = 1;
    if ( $thisreferencedselectionlogic != "" ) {
        $multisellogica = explodeOR($thisreferencedselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("RF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }  
    XBR();
    XLINKTXTNEWWINDOW($link,"download this report as csv","csv_view");
    FilterPopup();
    
    XTXTID("TRACETEXT","");
}


// ==========================================

function GenerateReportArray( $primetablelist, $referencedtablelist, $selectionlogic, $referencedselectionlogic, $sortlogic, $fieldlist) {
   
    // get field sqldata types
    if ($referencedtablelist != "") { $totaltablelist = $primetablelist.",".$referencedtablelist; }
    else { $totaltablelist = $primetablelist; }
    $totaltablea = List2Array($totaltablelist);
    foreach ($totaltablea as $table) {
        $q = 'SHOW COLUMNS FROM '.$table;
        $r = mysqli_query($GLOBALS{'IOSQL'},$q);
        if (mysqli_num_rows($r) > 0) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                $GLOBALS{$row[0]."_sqldatatype"} = $row[1];
            }
        }
    }
    
    if (strlen(strstr($primetablelist,','))>0) {
        $primetablea = explode(",",$primetablelist);
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $primetablelist;
        $primetablepair = "";
    }
    
    $graphrequired = "0";
    $graphxdynamic = "0"; // X axis created from data
    $graphxdynamicsyntax = ""; // X axis creation syntax
    
    $fieldlist = Replace_CRandLF($fieldlist,"|");
    $fieldlist = str_replace('||', '|', $fieldlist);
    if ( substr($fieldlist, -1) == '|' ) { substr_replace($fieldlist ,"",-1); }
    $fieldsa = explode('|',$fieldlist);
    
    // setup the prime table filters
    // Note that this has now been extended to handle "or" conditions outside the "and" conditions
    $selfieldvaluea = Array();
    $selfieldcompa = Array();
    $selfieldformata = Array();
    $sellogicmax = -1;
    if ( $selectionlogic != "" ) {
        $multisellogica = explodeOR($selectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $sellogicmax++;
            $selfieldvaluea[$sellogicmax] = Array();
            $selfieldcompa[$sellogicmax] = Array();
            $selfieldformata[$sellogicmax] = Array();
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $selfieldcompa[$sellogicmax][$fi."_".$selbits[0]] = $selbits[1];
                if ( strlen(strstr($selbits[2],'['))>0 ) {
                    $rbits = explode("[",$selbits[2]);
                    $sbits = explode("]",$rbits[1]);
                    $selfieldvaluea[$sellogicmax][$fi."_".$selbits[0]] = call_user_func($sbits[0]);
                } else {
                    $selfieldvaluea[$sellogicmax][$fi."_".$selbits[0]] = $selbits[2];
                }
                $selfieldformata[$sellogicmax][$fi."_".$selbits[0]] = $selbits[3];
            }
        }
    }
    
    // setup the referenced table filters
    // Note that this has now been extended to handle "or" conditions outside the "and" conditions
    $refselfieldvaluea = Array();
    $refselfieldcompa = Array();
    $refselfieldformata = Array();
    $refsellogicmax = -1;
    if ( $referencedselectionlogic != "" ) {
        $multirefsellogica = explodeOR($referencedselectionlogic);
        foreach ($multirefsellogica as $multirefsellogic) {
            $refsellogicmax++;
            $refselfieldvaluea[$refsellogicmax] = Array();
            $refselfieldcompa[$refsellogicmax] = Array();
            $refselfieldformata[$refsellogicmax] = Array();
            $refseltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $refseltesta as $refseltest) {
                $fi++;
                $selbits = explodeCOMP($refseltest);
                $refselfieldcompa[$refsellogicmax][$fi."_".$selbits[0]] = $selbits[1];
                if ( strlen(strstr($selbits[2],'['))>0 ) {
                    $rbits = explode("[",$selbits[2]);
                    $sbits = explode("]",$rbits[1]);
                    $refselfieldvaluea[$refsellogicmax][$fi."_".$selbits[0]] = call_user_func($sbits[0]);
                } else {
                    $refselfieldvaluea[$refsellogicmax][$fi."_".$selbits[0]] = $selbits[2];
                }
                $refselfieldformata[$refsellogicmax][$fi."_".$selbits[0]] = $selbits[3];
            }
        }
    }
    
    // ========== Define Report Arrays ===================
    
    $ra = Array();
    $ra["pfieldname"] = Array();			// fields to be reported from prime table - (by pfieldname)
    $ra["pheader"] = Array();				// header values for prime table fields - (by pfieldname)
    $ra["pfilter"] = Array();				// filter for prime table fields - (by pfieldname)
    $ra["pdata"] = Array();					// prime data value [primeid](by pfieldname)
    $ra["pformat"] = Array();				// display format - [by pfieldname]
    $ra["ptotalreqd"] = Array();			// totals reqd for prime table fields - [by pfieldname]
    $ra["ptotalnumval"] = Array();			// numeric totals prime table fields - [by pfieldname]
    $ra["ptotalformattedval"] = Array();	// formatted totals prime table fields - [by pfieldname]
    $ra["pcountreqd"] = Array();			// counts reqd for prime table fields - [by pfieldname]
    $ra["pcountnumval"] = Array();			// count totals prime table fields - [by pfieldname]
    $ra["pgraphxsyntax"] = Array();			// graph x syntax - [by pfieldname]
    $ra["pgraphysyntax"] = Array();			// graph y syntax - [by pfieldname]
    $ra["rtable"] = Array();				// referenced tables
    $ra["rfieldlistelement"] = Array();		// origibal fieldlist element
    $ra["rfieldname"] = Array();			// fields to be reported from referenced table - [referencedtable](by rfieldname) - can have multiple referenced tables
    $ra["rheader"] = Array();				// header values for referenced table fields - [referencedtable](by rfieldname)
    $ra["rfilter"] = Array();				// filter for referenced table fields - [referencedtable]
    $ra["rrootkey"] = Array();				// rootkeyfields for referenced tables - [referencedtable]
    $ra["rdata"] = Array();					// referenced data values [referencedtable][primeid][referencedid](by fieldvalue)
    $ra["rformat"] = Array();				// display format - [referencedtable](by rfieldname)
    $ra["rtotalreqd"] = Array();			// totals reqd for referenced table fields - [referencedtable](by rfieldname)
    $ra["rtotalnumval"] = Array();			// numeric totals referenced table fields - [referencedtable](by rfieldname)
    $ra["rtotalformattedval"] = Array();	// formatted totals referenced table fields - [referencedtable](by rfieldname)
    $ra["rcountreqd"] = Array();			// counts reqd for referenced table fields - [referencedtable][by pfieldname]
    $ra["rcountnumval"] = Array();			// count totals referenced table fields - [referencedtable][by pfieldname]
    $ra["programsyntax"] = Array();			// program syntax - (syntax)
    $ra["programheader"] = Array();			// header values for program fields - (programfieldheader)
    $ra["programdata"] = Array();			// program data value [primeid](fieldvalue)
    $ra["sortfieldcol"] = Array();		    // sortfield column 0 -> X
    $ra["sortfieldseq"] = Array();		    // sortfield sequences asc/desc
    $ra["gxheader"] = Array();				// graphtable xaxis headers
    $ra["gyheader"] = Array();				// graphtable yaxis headers
    $ra["gdata"] = Array();					// graphtable values [xval][yval]
    
    $tablecolcounter = 0;
    $fieldnamesa = Array();
    foreach ($fieldsa as $tfield) {
        if ($tfield != "") {
            if ( DF($tfield,"Type") == "startreflist" ) {
                array_push($ra["rtable"], DF($tfield,"RefTable"));
                $ra["rfieldlistelement"][DF($tfield,"RefTable")] = Array();
                $ra["rfieldname"][DF($tfield,"RefTable")] = Array();
                $ra["rheader"][DF($tfield,"RefTable")] = Array();
                $ra["rfilter"][DF($tfield,"RefTable")] = Array();
                $ra["rformat"][DF($tfield,"RefTable")] = Array();
                $ra["rdata"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalnumval"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalformattedval"][DF($tfield,"RefTable")] = Array();
                $ra["rcountreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rcountnumval"][DF($tfield,"RefTable")] = Array();
            }
            if ( DF($tfield,"Type") == "startreflookup" ) {
                array_push($ra["rtable"], DF($tfield,"RefTable"));
                $ra["rfieldlistelement"][DF($tfield,"RefTable")] = Array();
                $ra["rfieldname"][DF($tfield,"RefTable")] = Array();
                $ra["rheader"][DF($tfield,"RefTable")] = Array();
                $ra["rfilter"][DF($tfield,"RefTable")] = Array();
                $ra["rformat"][DF($tfield,"RefTable")] = Array();
                $ra["rdata"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalnumval"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalformattedval"][DF($tfield,"RefTable")] = Array();
                $ra["rcountreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rcountnumval"][DF($tfield,"RefTable")] = Array();
            }
            if ( DF($tfield,"Type") == "field" ) {
                if (( DF($tfield,"Table") == $primetable )||( DF($tfield,"Table") == $primetablepair )) {
                    array_push($ra["pfieldname"], DF($tfield,"Field"));
                    array_push($ra["pheader"], DF($tfield,"Title"));
                    array_push($ra["pformat"], DF($tfield,"FieldFormat"));
                    array_push($ra["pfilter"], DF($tfield,"Filter"));
                    array_push($ra["ptotalreqd"], DF($tfield,"Total"));
                    array_push($ra["ptotalnumval"], 0);
                    array_push($ra["ptotalformattedval"], "");
                    array_push($ra["pcountreqd"], DF($tfield,"Count"));
                    array_push($ra["pcountnumval"], 0);
                    array_push($ra["pgraphxsyntax"], DF($tfield,"GraphXSyntax"));
                    array_push($ra["pgraphysyntax"], DF($tfield,"GraphYSyntax"));
                    $xsyntax = DF($tfield,"GraphXSyntax");
                    if ( $xsyntax != "" ) {
                        $graphrequired = "1";                        
                        if ((DF($xsyntax,"GraphXSyntax") == "X:")||(DF($xsyntax,"GraphXSyntax") == "X:TITLE")) {
                            array_push($ra["gxheader"], DF($tfield,"Title"));
                        } else {
                            $graphxdynamic = "1";
                            $graphxdynamicsyntax = $xsyntax;
                        }
                    }                    
                } else {
                    array_push($ra["rfieldlistelement"][DF($tfield,"Table")], $tfield);
                    array_push($ra["rfieldname"][DF($tfield,"Table")], DF($tfield,"Field"));
                    array_push($ra["rheader"][DF($tfield,"Table")], DF($tfield,"Title"));
                    array_push($ra["rformat"][DF($tfield,"Table")], DF($tfield,"FieldFormat"));
                    array_push($ra["rfilter"][DF($tfield,"Table")], DF($tfield,"Filter"));
                    array_push($ra["rtotalreqd"][DF($tfield,"Table")], DF($tfield,"Total"));
                    array_push($ra["rtotalnumval"][DF($tfield,"Table")], 0);
                    array_push($ra["rtotalformattedval"][DF($tfield,"Table")], "");
                    array_push($ra["rcountreqd"][DF($tfield,"Table")], DF($tfield,"Count"));
                    array_push($ra["rcountnumval"][DF($tfield,"Table")], 0);
                }
                $tablecolcounter++;
            }
            if ( DF($tfield,"Type") == "programlink" ) {
                array_push($ra["programsyntax"], $tfield);
                array_push($ra["programheader"], "");
            }
            array_push($fieldnamesa, DF($tfield,"Field"));
        }
    }
    
    // print_r($ra["pgraphxsyntax"]);XBR();XPTXT("=====");
    // print_r($ra["pgraphysyntax"]);XBR();XPTXT("=====");
    // print_r($ra["gxheader"]);
    
    // =======  Stage 1: Select and then sort by prime table ===============
    // sort syntax
    // field 1
    // (field1)
    // (field1=desc)
    // (field1)(field2)(field3)
    // (field1=asc)(field2=asc)(field3=desc)
    if ($sortlogic != "" ) {
        $sortlogic = str_replace('==', "=", $sortlogic);
        $sortlogic = str_replace('=ASC', "=asc", $sortlogic);
        $sortlogic = str_replace('=DESC', "=desc", $sortlogic);
        $sortfieldnamea = Array();
        $sortfieldseqa = Array();
        $sortformata = Array();
        if (strlen(strstr($sortlogic,'('))>0) {
            $tbits = explode('(',$sortlogic);
            foreach ( $tbits as $tbit) {
                if ($tbit != "") {
                    $ubits = explode(')',$tbit);
                    $sfieldsyntax = $ubits[0];
                    if (strlen(strstr($sfieldsyntax,'='))>0) {
                        $wbits = explode('=',$sfieldsyntax);
                        if (strlen(strstr($wbits[0],'{'))>0) {
                            $bitsa = explode('{',$wbits[0]);
                            $bitsb = explode('}',$bitsa[1]);
                            array_push($sortfieldnamea, $bitsa[0]);
                            array_push($sortformata, $bitsb[0]);
                            array_push($sortfieldseqa, $wbits[1]);
                            array_push($ra["sortfieldcol"], array_search($bitsa[0], $fieldnamesa));
                            array_push($ra["sortfieldseq"], $wbits[1]);
                            
                        } else {
                            array_push($sortfieldnamea, $wbits[0]);
                            array_push($sortformata, "");
                            array_push($sortfieldseqa, $wbits[1]);
                            array_push($ra["sortfieldcol"], array_search($wbits[0], $fieldnamesa));
                            array_push($ra["sortfieldseq"], $wbits[1]); 
                        }
                    } else {
                        if (strlen(strstr($sfieldsyntax,'{'))>0) {
                            $bitsa = explode('{',$sfieldsyntax);
                            $bitsb = explode('}',$bitsa[1]);
                            array_push($sortfieldnamea, $bitsa[0]);
                            array_push($sortformata, $bitsb[0]);
                        } else {
                            array_push($sortfieldnamea, $sfieldsyntax);
                            array_push($sortformata, "");
                        }
                        array_push($sortfieldseqa, "asc");
                        array_push($ra["sortfieldcol"], array_search($sfieldsyntax, $fieldnamesa));
                        array_push($ra["sortfieldseq"], "asc");
                    }
                }
            }
        } else {
            if (strlen(strstr($sortlogic,'='))>0) {
                $wbits = explode('=',$sortlogic);
                array_push($sortfieldnamea, $wbits[0]);
                array_push($sortfieldseqa, $wbits[1]);
                array_push($ra["sortfieldcol"], array_search($wbits[0], $fieldnamesa));
                array_push($ra["sortfieldseq"], $wbits[1]);
            } else {
                array_push($sortfieldnamea, $sortlogic);
                array_push($sortfieldseqa, "asc");
                array_push($ra["sortfieldcol"], array_search($sortlogic, $fieldnamesa));
                array_push($ra["sortfieldseq"], "asc");
            }
        }
    } else {
        // no sort logic
        array_push($ra["sortfieldcol"], 0);
        array_push($ra["sortfieldseq"], "asc");
    }
    
    // Note that selection has now been extended to handle "or" conditions outside the "and" conditions
    $primetableida = Get_NKey_Array($primetable);
    $sortselecteda = Array();
    foreach ( $primetableida as $primetableid) {
        $ida = explode('|',$primetableid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); }
        if ( $primetablepair != "" ) {
            if ($GLOBALS{$primetablepair."^KEYS"} == "2") { Get_Data($primetablepair,$ida[0]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "3") { Get_Data($primetablepair,$ida[0],$ida[1]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "4") { Get_Data($primetablepair,$ida[0],$ida[1],$ida[2]); }
        }
        $multiselected = "1";
        if ( $selectionlogic != "" ) {
            $multiselected = "0";
            for ( $sellogici = 0; $sellogici<=$sellogicmax; $sellogici++ ) {
                $selected = "1";
                foreach($selfieldvaluea[$sellogici] as $k => $v) {
                    $kbits = explode("_",$k);
                    $kfield = $kbits[1]."_".$kbits[2];
                    $selected = ReSelection($selected,$kfield,$selfieldcompa[$sellogici][$k],$v,$selfieldformata[$sellogici][$k]);
                }
                if ( $selected == "1" ) { $multiselected = "1"; }
            }
        }
        if ($sortlogic == "" ) { $sortfieldvalue = ""; }
        else {
            if ( count($sortfieldnamea) == 1) { $sortfieldvalue = ReFormat($sortfieldnamea[0],$GLOBALS{$sortfieldnamea[0]},$sortformata[0]); }
            if ( count($sortfieldnamea) == 2) { $sortfieldvalue = ReFormat($sortfieldnamea[0],$GLOBALS{$sortfieldnamea[0]},$sortformata[0])."|".ReFormat($sortfieldnamea[1],$GLOBALS{$sortfieldnamea[1]},$sortformata[1]);  }
            if ( count($sortfieldnamea) == 3) { $sortfieldvalue = ReFormat($sortfieldnamea[0],$GLOBALS{$sortfieldnamea[0]},$sortformata[0])."|".ReFormat($sortfieldnamea[1],$GLOBALS{$sortfieldnamea[1]},$sortformata[1])."|".ReFormat($sortfieldnamea[2],$GLOBALS{$sortfieldnamea[2]},$sortformata[2]);  }
        }
        if ($multiselected == "1") { array_push($sortselecteda, $sortfieldvalue."^".$primetableid); }
    }
    
    if ($sortlogic != "" ) {
        if ($sortfieldseqa[0] == "desc") {
            rsort($sortselecteda);
        } else {
            sort($sortselecteda);
        }
    }
    
    // =======  Stage 2: Populate the report Arrays ===============
    $referencedtable = "";
    $referencedtableida = Array();
    foreach ( $sortselecteda as $sortelement) {
        $sbits = explode("^",$sortelement);
        $primeid = $sbits[1];
        $ra["pdata"][$primeid] = Array();
        foreach ($ra["rtable"] as $reftable => $valuearray) {
            $ra["rdata"][$reftable][$primeid] = Array();
        }
        $ra["programdata"][$primeid] = Array();
        $sida = explode('|',$primeid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$sida[0]); }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$sida[0],$sida[1]); }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$sida[0],$sida[1],$sida[2]); }
        if ( $primetablepair != "" ) {
            if ($GLOBALS{$primetablepair."^KEYS"} == "2") { Get_Data($primetablepair,$sida[0]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "3") { Get_Data($primetablepair,$sida[0],$sida[1]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "4") { Get_Data($primetablepair,$sida[0],$sida[1],$sida[2]); }
        }
        
        // Scan the field list - set up the main arrays and populate data for the prime fields
        $xgraphkey = "";
        $ygraphvala = Array();        
        $fi = 0;
        foreach ($fieldsa as $tfield) {
            $graphxkey = "";
            $graphykey = "";
            if ($tfield != "") {
                if ( DF($tfield,"Type") == "startreflist" ) {	// get the ids referenced table from a list
                    $referencedtable = DF($tfield,"RefTable");
                    $ra["rdata"][$referencedtable][$primeid] = Array();
                    $referencedtablerootkeya = DF($tfield,"RefRootKeyArray"); // CHECK returns null in this version
                    $ra["rrootkey"][$referencedtable] = $referencedtablerootkeya;
                    $referencedtableida = explode(',',$GLOBALS{DF($tfield,"RefKeyList")});
                    foreach ( $referencedtableida as $referencedtableid ) {
                        $ra["rdata"][$referencedtable][$primeid][$referencedtableid] = Array();
                    }
                    $referencedtablerootkeya= Array(); // no rootkeys required if not table lookup
                }
                if ( DF($tfield,"Type") == "endreflist" ) {  // empty array of ids for referenced table
                    $referencedtable = "";
                    $referencedtableida = Array();
                }
                if ( DF($tfield,"Type") == "startreflookup" ) {	// get the ids referenced table by scanning database
                    $referencedtable = DF($tfield,"RefTable");
                    $ra["rdata"][$referencedtable][$primeid] = Array();
                    $referencedtablerootkeya = DF($tfield,"RefRootKeyArray");
                    // foreach ( $referencedtablerootkeya as $referencedtablerootkey ) { XH1($referencedtablerootkey); }
                    $ra["rrootkey"][$referencedtable] = $referencedtablerootkeya;
                    if (count($referencedtablerootkeya) == 0) { $referencedtableida = Get_Array($referencedtable); }
                    if (count($referencedtablerootkeya) == 1) { $referencedtableida = Get_Array($referencedtable,$GLOBALS{$referencedtablerootkeya[0]}); }
                    if (count($referencedtablerootkeya) == 2) { $referencedtableida = Get_Array($referencedtable,$GLOBALS{$referencedtablerootkeya[0]},$GLOBALS{$referencedtablerootkeya[1]}); }
                    foreach ( $referencedtableida as $referencedtableid ) {
                        $ra["rdata"][$referencedtable][$primeid][$referencedtableid] = Array();
                    }
                }
                if ( DF($tfield,"Type") == "endreflookup" ) {	// empty array of ids for referenced table
                    $referencedtable = "";
                    $referencedtableida = Array();
                }
                if ( DF($tfield,"Type") == "field" ) { // populate data from the prime fields
                    $fbits = explode("_",$tfield);
                    if (($fbits[0] == $primetable)||($fbits[0] == $primetablepair)) {
                        // ---- prime field -----
                        array_push($ra["pdata"][$primeid], DF($tfield,"FieldFormattedValue"));
                        // ---- totals and counts -----
                        if ( $ra["ptotalreqd"][$fi] == "Y" ) {
                            $ra["ptotalnumval"][$fi] = $ra["ptotalnumval"][$fi] + DF($tfield,"TotalIncrValue");
                            $ra["ptotalformattedval"][$fi] = fieldFormat($ra["ptotalnumval"][$fi], $ra["pformat"][$fi]);
                            // $ra["ptotalformattedval"][$fi] = $ra["ptotalnumval"][$fi];
                        } else {
                            $ra["ptotalnumval"][$fi] = 0;
                            $ra["ptotalformattedval"][$fi] = "";
                        }
                        if ( $ra["pcountreqd"][$fi] == "Y" ) {
                            $ra["pcountnumval"][$fi] = $ra["pcountnumval"][$fi] + DF($tfield,"CountIncrValue");
                        } else {
                            $ra["pcountnumval"][$fi] = 0;
                        }
                        // ---- graph data -----
                        if ( $ra["pgraphxsyntax"][$fi] != "" ) {
                            if (substr($ra["pgraphxsyntax"][$fi],0,2) == "X:") {
                                // $graphxkey = GraphXKey(DF($tfield,"FieldValue"),$ra["pgraphxsyntax"][$fi],$ra["pheader"][$fi]); 
                                $graphxkey = GraphXYKey($ra["pheader"][$fi],DF($tfield,"FieldValue"),$ra["pgraphxsyntax"][$fi]); 
                            }
                        }
                        if ( $ra["pgraphysyntax"][$fi] != "" ) {
                            if (substr($ra["pgraphysyntax"][$fi],0,2) == "Y:") {
                                // $graphykey = GraphYKey(DF($tfield,"FieldValue"),$ra["pgraphysyntax"][$fi]);
                                $graphykey = GraphXYKey($ra["pheader"][$fi],DF($tfield,"FieldValue"),$ra["pgraphysyntax"][$fi]);
                                $graphyval = DF($tfield,"FieldValue");
                            }
                        }
                    }
                }
                // populate graphical array for this field in the database record
                if ( $graphxkey != "" ) {
                    // XPTXTCOLOR($graphxkey." ".$graphykey,"orange");
                    if (array_key_exists($graphxkey, $ra["gdata"])) {} else { $ra["gdata"][$graphxkey] = Array(); }
                    if (array_key_exists($graphykey, $ra["gdata"][$graphxkey])) {} else { $ra["gdata"][$graphxkey][$graphykey] = ""; }
                    if (in_array($graphxkey, $ra["gxheader"])) {} else {
                        array_push($ra["gxheader"], $graphxkey);
                    }
                    if (in_array($graphykey, $ra["gyheader"])) {} else {
                        array_push($ra["gyheader"], $graphykey);  
                    }
                    $ra["gdata"][$graphxkey][$graphykey] = GraphYVal($ra["gdata"][$graphxkey][$graphykey],$graphyval,$ra["pgraphysyntax"][$fi]);
                }
                $fi++;
            }
        }
        
        $refselectioncount = 0;
        // populate data for the referenced tables
        // Note that selection has now been extended to handle "or" conditions outside the "and" conditions
        foreach ($ra["rtable"] as $reftable) {
            $rfi = 0;
            foreach($ra["rdata"][$reftable][$primeid] as $reftableid => $vxx) {
                $reftablerootkeya = $ra["rrootkey"][$reftable];
                if (count($reftablerootkeya) == 0) { Check_Data($reftable,$reftableid); }
                if (count($reftablerootkeya) == 1) { Check_Data($reftable,$GLOBALS{$reftablerootkeya[0]},$reftableid); }
                if ($GLOBALS{'IOWARNING'} == "0") {
                    $multirefselected = "1";
                    if ( $referencedselectionlogic != "" ) {
                        $multirefselected = "0";
                        for ( $refsellogici = 0; $refsellogici<=$refsellogicmax; $refsellogici++ ) {
                            $refselected = "1";
                            foreach($refselfieldvaluea[$refsellogici] as $k => $v) {
                                $kbits = explode("_",$k);
                                $kfield = $kbits[1]."_".$kbits[2];
                                $selected = ReSelection($selected,$kfield,$refselfieldcompa[$refsellogici][$k],$v,$refselfieldformata[$refsellogici][$k]);
                            }
                            if ( $refselected == "1" ) { $multirefselected = "1"; }
                        }
                    }
                    if ($multirefselected == "1") {
                        // XPTXT("SELECTED ".$reftableid);
                        $refselectioncount++;
                        $rfi = 0;
                        foreach ($ra["rfieldname"][$reftable] as $reffieldname) {
                            array_push($ra["rdata"][$reftable][$primeid][$reftableid], DF($ra["rfieldlistelement"][$reftable][$rfi],"FieldFormattedValue"));
                            if ( $ra["rtotalreqd"][$reftable][$rfi] == "Y" ) {
                                $ra["rtotalnumval"][$reftable][$rfi] = $ra["rtotalnumval"][$reftable][$rfi] + DF($ra["rfieldlistelement"][$reftable][$rfi],"TotalIncrValue");
                                $ra["rtotalformattedval"][$rfi] = fieldFormat($ra["rtotalnumval"][$rfi], $ra["rformat"][$rfi]);
                                // CHECK if fieldFormat required
                            } else {
                                $ra["rtotalnumval"][$reftable][$rfi] = 0;
                                $ra["rtotalformattedval"][$reftable][$rfi] = "";
                            }
                            if ( $ra["rcountreqd"][$reftable][$rfi] == "Y" ) {
                                $ra["rcountnumval"][$reftable][$rfi] = $ra["rcountnumval"][$reftable][$rfi] + DF($ra["rfieldlistelement"][$reftable][$rfi],"CountIncrValue");
                            } else {
                                $ra["rcountnumval"][$reftable][$rfi] = 0;
                            }
                            $rfi++;
                        }
                    } else { // remove non selected rows
                        // XPTXT("DROPPED ".$reftableid);
                        unset($ra["rdata"][$reftable][$primeid][$reftableid]);
                    }
                }
                $rfi++;
            }
        }
        
        $primetableshow = "1";
        // remove prime table entries if required referenced table selection fails
        if ( count($refselfieldvaluea) > 0  ) {
            if ( $refselectioncount == 0 ) {
                unset($ra["pdata"][$primeid]);
                $primetableshow = "0";
            }
        }
        
        if ( $primetableshow == "1" ) {
            // populate data for the program links
            foreach ($ra["programsyntax"] as $tsyntax) {
                $link = YPGMLINK(DF($tsyntax,"ProgramName").".php").YPGMSTDPARMS();
                $windowname = "";
                foreach (DF($tsyntax,"ProgramKeyArray") as $programkey) {
                    $link = $link.YPGMPARM($programkey,$GLOBALS{$programkey});
                    $windowname = $windowname.$GLOBALS{$programkey};
                }
                array_push($ra["programdata"][$primeid], YCLASSLINKTXTNEWWINDOW('updatelink',$link,DF($tsyntax,"LinkText"),$windowname));
                // array_push($ra["programdata"][$primeid], YCLASSLINKTXTNEWWINDOW('updatelink',$link,"XXXXX",$windowname));
            }
        }
    }
    
    if ( $graphxdynamic == "1" ) { 
        if ( $graphxdynamicsyntax == "X:FOREACHyyyy") {
            $gxheadera = Array();
            $cleangxheadera = Array();
            $finalgxheadera = Array();
            foreach ($ra["gxheader"] as $xkey => $xvalue) {
                array_push($gxheadera, $xvalue);
                if (($xvalue > "1900")&&($xvalue < "2100")) {
                    array_push($cleangxheadera, $xvalue);
                }
            }
            sort($cleangxheadera);
            // XH2("cleangxheadera"); print_r($cleangxheadera);
            $firstyyyy = $cleangxheadera[0];
            $lastyyyy = end($cleangxheadera);
            for ( $yyyyi=(int)$firstyyyy; $yyyyi<=(int)$lastyyyy; $yyyyi++) {
                array_push($finalgxheadera, strval($yyyyi));            
            }
            $ra["gxheader"] = $finalgxheadera;
            // XH2("finalgxheadera"); print_r($finalgxheadera);
            foreach ($finalgxheadera as $yyyy) {
                if (array_key_exists($yyyy, $ra["gdata"])) {} else { 
                    $ra["gdata"][$yyyy] = Array(); 
                    $ra["gdata"][$yyyy]["All"] = "0";
                }
            }
            // print_r($ra["gxheader"]);
        }
    }
    
    /*
     print_r($ra["rcountnumval"]);XBR();
     print_r($ra["pcountreqd"]);XBR();
     print_r($ra["pcountnumval"]);
     XTXT("pformat - ");print_r($ra["pformat"]);XBR();
     XTXT("rformat - ");print_r($ra["rformat"]);XBR();
     XTXT("gheader - ");print_r($ra["gxheader"]);XBR();
     XTXT("gdata - ");print_r($ra["gdata"]);XBR();
     */    
    return $ra;
    
}

function GraphXYKey ($title, $value, $syntax ) {  
    /*

    Fieldname[X:FORALL]
    Fieldname[X:FOREACH]
    Fieldname[X:FOREACHmm]
    Fieldname[X:FOREACHqtr]
    Fieldname[X:FOREACHyyyy]
    
    Fieldname[Y:FORALL:COUNT]
    Fieldname[Y:FORALL:SUM]
    Fieldname[Y:FOREACH:COUNT]
    Fieldname[Y:FOREACH:SUM]
    Fieldname[Y:FOREACHotherfieldname:COUNT]
    Fieldname[Y:FOREACHotherfieldname:SUM]    
    */
    $sbits = explode(":",$syntax.":::");
    $axis = $sbits[0];
    $keygroup = $sbits[1];
    $action = $sbits[2];
    $graphxykey = "";
    
    if (strlen(strstr($keygroup,"FOREACH"))>0) { $ruletype = "FOREACH"; }  
    if ($keygroup == "FORALL") { $ruletype = "FORALL"; }
    
    if ( $ruletype == "FOREACH" ) {
        if (strlen(strstr($keygroup,'_'))>0) { 
            // special situation - another field is involved
            $otherfieldname = str_replace("FOREACH","",$sbits[1]);
            $graphxykey = $GLOBALS{$otherfieldname};
        } else {
            // normal situation this field value  returned
            $rulefound = "0";
            if (( $keygroup == "FOREACH" )&&( $rulefound == "0" )) {
                $graphxykey = $graphykey = $value;
            }
            if (( $keygroup == "FOREACHyyyy" )&&( $rulefound == "0" )) {
                $graphxykey = substr($value,0,4);
            }
            if (( $keygroup == "FOREACHmm" )&&( $rulefound == "0" )) {
                $graphxykey = substr($value,2,2).substr($value,6,2);
            }
            if (( $keygroup == "FOREACHqtr" )&&( $rulefound == "0" )) {
                $mmi = (int)substr($value,6,2);
                $qtr = "";
                if ($mmi > 0) { $qtr = "Q1"; }
                if ($mmi > 3) { $qtr = "Q2"; }
                if ($mmi > 6) { $qtr = "Q3"; }
                if ($mmi > 9) { $qtr = "Q4"; }
                $graphxykey = substr($value,2,2).$qtr;
            }
        }
    }
    
    if ( $ruletype == "FORALL" ) {
        $graphxykey = $title;
    }
    
    // $colour = "green";
    // if ( $axis == "Y" ) { $colour = "red"; }
    // XPTXTCOLOR($axis." ".$value." ".$syntax." ==> ".$graphxykey,$colour);
    return $graphxykey;
}

function GraphYVal ($oldvalue, $thisvalue, $graphysyntax) {
    $graphyval = "";    
    if (strlen(strstr($graphysyntax,":COUNT"))>0) { $graphyval = $oldvalue + 1; }
    if (strlen(strstr($graphysyntax,":VALUE"))>0) { $graphyval = $thisvalue; }
    if (strlen(strstr($graphysyntax,":SUM"))>0) { $graphyval = $oldvalue + $thisvalue; }
    // XPTXTCOLOR("GraphYVal"."|".$oldvalue."|".$thisvalue."|".$graphysyntax." ==> ".$graphyval,"green");    
    return $graphyval;
}


// ============================================

function AssocArrayFirstKey ($mdaa) {
    // this seems to be required rather than key if searching at middle level of MultiDimensional Associative Array !
    $firstkey = "";
    if (in_array(null, $mdaa)) {}
    else {
        foreach($mdaa as $k => $v) {
            if ( $firstkey == "" ) { $firstkey = $k; }
        }
    }
    return $firstkey;
}


function AssocArrayFirstValue ($mdaa) {
    // this seems to be required rather than key if searching at middle level of MultiDimensional Associative Array !
    $firstvalue = "";
    if (in_array(null, $mdaa)) {}
    else {
        foreach($mdaa as $k => $v) {
            if ( $firstvalue == "" ) { $firstvalue = $v; }
        }
    }
    return $firstvalue;
}

function AssocArrayCount ($mdaa) {
    // this seems to be required rather than key if counting at middle level of MultiDimensional Associative Array !
    $count = 0;
    if (in_array(null, $mdaa)) {}
    else {
        foreach($mdaa as $k => $v) {
            $count++;
        }
    }
    return $count;
}

function AssocArrayFindCount ($mdaa,$findstring) {
    // this seems to be required rather than key if counting at middle level of MultiDimensional Associative Array !
    $count = 0;
    foreach($mdaa as $k => $v) {
        // XPTXT($k." ".$v." ".$mdaa[$k]." ".$mdaa[$k]);
        if ( $mdaa[$k] == $findstring ) { $count++; }
    }
    return $count;
}

function AssocArrayFindCount2 ($mdaa,$findstring) {
    // this seems to be required rather than key if counting at middle level of MultiDimensional Associative Array !
    $count = 0;
    foreach($mdaa as $k => $v) {
        foreach($mdaa[$k] as $k2 => $v2) {
            if ( $mdaa[$k][$k2] == $findstring ) { $count++; }
        }
    }
    return $count;
}


function Report_MPDFREPORTKEYLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MPDFREPORTKEYLIST_Output( $mpdfreport_id ) {
    Get_Data('mpdfreport',$mpdfreport_id);
    if (strlen(strstr($GLOBALS{'mpdfreport_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'mpdfreport_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'mpdfreport_primetable'};
        $primetablepair = "";
    }
    
    XDIV("mpdfreport_tablecontainer","container");
    XTABLEJQDTID("reporttable_mpdfreport");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    X_TR();
    X_THEAD();
    XTBODY();
    
    $primetableida = Get_NKey_Array($primetable);
    foreach ( $primetableida as $primetableid) {
        $ida = explode('|',$primetableid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); $keyvaluelist = $ida[0]; }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); $keyvaluelist = $ida[0].','.$ida[1]; }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); $keyvaluelist = $ida[0].','.$ida[1].','.$ida[2]; }
        if ( $primetablepair != "" ) {
            if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetablepair,$ida[0]); }
            if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetablepair,$ida[0],$ida[1]); }
            if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetablepair,$ida[0],$ida[1],$ida[2]); }
        }
        
        XTRJQDT();
        XTDTXT($primetableid);
        $tfa = explode(',',$GLOBALS{'mpdfreport_listkeytitlefields'});
        $titlefield = ""; $sep = "";
        foreach ( $tfa as $tfelement) {
            $titlefield = $titlefield.$sep.$GLOBALS{$tfelement};
            $sep = " ";
        }
        XTDTXT($titlefield);
        $link = YPGMLINK("mpdfreportwebview.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
        XTDLINKTXTNEWWINDOW($link,"view","view");
        $link = YPGMLINK("mpdfreportpdfdownload.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
        XTDLINKTXTNEWWINDOW($link,"download","pdfview");
        $link = YPGMLINK("mpdfreportcsvdownload.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
        XTDLINKTXTNEWWINDOW($link,"download","csv");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreport_tablecontainer");
    XCLEARFLOAT();
}

function Report_MPDFREPORTWEBVIEWSETFILTER_Output( $mpdfreport_id ) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Set the filter values for this custom report..");
    // XPTXT($GLOBALS{'mpdfreport_selectionlogic'});
    XBR();
    XFORM("mpdfreportwebview.php","mpdfreportwebview");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    if ($GLOBALS{'mpdfreport_selectionlogic'} != "") {
        // XH3($GLOBALS{'mpdfreport_selectionlogic'});
        FilterTable("PF",$GLOBALS{'mpdfreport_selectionlogic'});
        XBR();
    }
    // CHECK No referenced table filter capability
    XBR();
    XINSUBMIT("Create Report.");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_MPDFREPORTPDFDOWNLOADSETFILTER_Output( $mpdfreport_id ) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Set the filter values for this custom report..");
    // XPTXT($GLOBALS{'mpdfreport_selectionlogic'});
    XPTXT("Report Max - ".$GLOBALS{'mpdfreport_maxselection'});
    if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
        $mettext = $GLOBALS{'mpdfreport_maxexecutiontime'};
    } else {$mettext = "Default (30 seconds)";
    }
    XPTXT("Report Max Execution TIme - ".$mettext);
    XBR();
    XFORM("mpdfreportpdfdownload.php","mpdfreportpdfdownload");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    if ($GLOBALS{'mpdfreport_selectionlogic'} != "") {
        FilterTable("PF",$GLOBALS{'mpdfreport_selectionlogic'});
        XBR();
    }
    // CHECK No referenced table filter capability
    XBR();
    XINSUBMIT("Create Report");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
    
}

function Report_MPDFREPORTCSVDOWNLOADSETFILTER_Output( $mpdfreport_id ) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Set the filter values for this custom report..");
    // XPTXT($GLOBALS{'mpdfreport_selectionlogic'});
    XPTXT("Report Max - ".$GLOBALS{'mpdfreport_maxselection'});
    if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
        $mettext = $GLOBALS{'mpdfreport_maxexecutiontime'};
    } else {$mettext = "Default (30 seconds)";
    }
    XPTXT("Report Max Execution TIme - ".$mettext);
    XBR();
    XFORM("mpdfreportcsvdownload.php","mpdfreportcsvdownload");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    if ($GLOBALS{'mpdfreport_selectionlogic'} != "") {
        FilterTable("PF",$GLOBALS{'mpdfreport_selectionlogic'});
        XBR();
    }
    // CHECK No referenced table filter capability
    XBR();
    XINSUBMIT("Download CSV");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
    
}

function Report_MPDFREPORTWEBVIEW_Output( $mpdfreport_id, $parmkeyvaluelist, $thisselectionlogic ) {
    
    Get_Data('mpdfreport',$mpdfreport_id);
    XH3("Description");
    XINHIDID("ReportType","ReportType","mpdfreport");
    XINHIDID("mpdfreport_id","mpdfreport_id",$mpdfreport_id);
    
    XPTXT($GLOBALS{'mpdfreport_description'});
    XH3("Settings");
    XPTXT("Prime Table - ".$GLOBALS{'mpdfreport_primetable'});
    if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
        XPTXT("Report Type - This report is for a specific database record");
        if ( $parmkeyvaluelist == "TESTKEYS") {
            XPTXTCOLOR("Test Key Values - ".$GLOBALS{'mpdfreport_listtestkeyvalues'},"red");
            $thiskeyvaluelist = $GLOBALS{'mpdfreport_listtestkeyvalues'};
        } else {
            XPTXT("Key Values - ".$parmkeyvaluelist);
            $thiskeyvaluelist = $parmkeyvaluelist;
        }
    } else {
        XPTXT("Report Type - This report is for a list of records == ".$thisselectionlogic);
        if ( $thisselectionlogic != "") { $filtervalue = $thisselectionlogic; }
        else { $filtervalue = $GLOBALS{'mpdfreport_selectionlogic'}; }
        if ($filtervalue != "") {$seltext = $filtervalue;} else {$seltext = "None";}
        XPTXT("Report Filter - ".$seltext);
        XPTXT("Report Max - ".$GLOBALS{'mpdfreport_maxselection'});
        if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {$mettext = $GLOBALS{'mpdfreport_maxexecutiontime'};} else {$mettext = "Default (30 seconds)";}
        XPTXT("Report Max Execution TIme - ".$mettext);
    }
    //set global parameter for report
    $GLOBALS{'MPDFREPORTKEYVALUELIST'} = $thiskeyvaluelist;
    $GLOBALS{'MPDFREPORTFILTER'} = $filtervalue;
    $GLOBALS{'MPDFREPORTMODE'} = "web";
    XHR();
    XBR();
    // following include uses keys and mpdfreportid to construct report
    include $GLOBALS{'domainfilepath'}."/mpdfreports/".$mpdfreport_id.".php";
    print $GLOBALS{'pdfr'};
    
    XBR();
    $link = YPGMLINK("mpdfreportpdfdownloadfromwebview.php");
    // $link = YPGMLINK("mpdfreportpdfdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$thiskeyvaluelist).YPGMPARM("mpdfreport_filtervalue",urlencode($filtervalue));
    XTDLINKTXTNEWWINDOW($link,"download this report as a pdf","pdfview");
    XBR();
    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
        $link = YPGMLINK("mpdfreportcsvdownloadfromwebview.php");
        // $link = YPGMLINK("mpdfreportcsvdownload.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$thiskeyvaluelist).YPGMPARM("mpdfreport_filtervalue",urlencode($filtervalue));
        XTDLINKTXTNEWWINDOW($link,"download this report as a csv","csv");
    }
}

function Report_EXPORTCSVDOWNLOADSETFILTER_Output( $reportexport, $reportexport_id ) {
    
    Get_Data($reportexport,$reportexport_id);
    $exporttitle = $GLOBALS{$reportexport.'_title'};
    $exportdescription = $GLOBALS{$reportexport.'_description'};
    $exportprimetablelist = $GLOBALS{$reportexport.'_primetable'};
    $exportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $exportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $exportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $exportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $exportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    if ( $inreportexport == "export" ) { $exportuploadable = $GLOBALS{$reportexport.'_uploadable'}; }
    else { $exportuploadable = "No"; }
    
    if (strlen(strstr($exportprimetablelist,','))>0) {
        $exportprimetablea = explode(",",$exportprimetablelist);
        $exportprimetable = $exportprimetablea[0];
        $exportprimetablepair = $exportprimetablea[1];
    } else {
        $exportprimetable = $exportprimetablelist;
        $exportprimetablepair = "";
    }
    
    XH3('Set the filter values for this "csv download"');
    XBR();
    XFORM("exportcsvdownload.php","exportcsvdownload");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    if ($exportselectionlogic != "") {
        FilterTable("PF",$exportselectionlogic);
        XBR();
    }
    if ($exportreferencedselectionlogic != "") {
        FilterTable("RF",$exportreferencedselectionlogic);
        XBR();
    }
    XINSUBMIT("Create Export");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_REPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_REPORTLIST_Output () {
    XH2("Reports");
    XBR();XBR();XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $report_ida = Get_Array('report');
    foreach ($report_ida as $report_id) {
        Get_Data("report",$report_id);
        if ( ReportUserVisibility($GLOBALS{'report_userlevel'},$GLOBALS{'report_personidlist'},$GLOBALS{'report_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($report_id);
            XTDTXT($GLOBALS{'report_title'});
            XTDTXT($GLOBALS{'report_description'});
            XTDTXT($GLOBALS{'report_primetable'});
            // XTDTXT($GLOBALS{'report_referencedtablelist'});
            if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) {
                XTDTXT("Yes");
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            } else {
                XTDTXT("No");
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function Report_EXPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_EXPORTLIST_Output () {
    XH2("Export information to spreadsheet");
    XBR();XBR();XBR();
    XDIV("exportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Re-Import");
    XTDHTXT("Variable Filter");
    XTDHTXT("CSV");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $export_ida = Get_Array('export');
    foreach ($export_ida as $export_id) {
        Get_Data("export",$export_id);
        if ( ReportUserVisibility($GLOBALS{'export_userlevel'},$GLOBALS{'export_personidlist'},$GLOBALS{'export_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($export_id);
            XTDTXT($GLOBALS{'export_title'});
            XTDTXT($GLOBALS{'export_description'});
            XTDTXT($GLOBALS{'export_primetable'});
            XTDTXT($GLOBALS{'export_uploadable'});
            if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) {
                XTDTXT("Yes");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"download");
            } else {
                XTDTXT("No");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"download");
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("exportdiv");
    XCLEARFLOAT();
}

function Report_MPDFREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MPDFREPORTLIST_Output () {
    XH2("Run Custom PDF Reports");
    XBR();XBR();XBR();
    XDIV("mpdfreportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Type");
    XTDHTXT("Keys");
    XTDHTXT("Filter");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $mpdfreport_ida = Get_Array('mpdfreport');
    foreach ($mpdfreport_ida as $mpdfreport_id) {
        Get_Data("mpdfreport",$mpdfreport_id);
        if ( ReportUserVisibility($GLOBALS{'mpdfreport_userlevel'},$GLOBALS{'mpdfreport_personidlist'},$GLOBALS{'mpdfreport_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($mpdfreport_id);
            XTDTXT($GLOBALS{'mpdfreport_title'});
            XTDTXT($GLOBALS{'mpdfreport_description'});
            XTDTXT($GLOBALS{'mpdfreport_primetable'});
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes") { XTDTXT("Unique Key"); }
            else { XTDTXT("List"); }
            XTDTXT($GLOBALS{'mpdfreport_listkeys'});
            if ($GLOBALS{'mpdfreport_selectionlogic'} != "") { XTDTXT("Yes"); }
            else { XTDTXT(""); }
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
                $link = YPGMLINK("mpdfreportkeylist.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
            } else {
                if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
                    $link = YPGMLINK("mpdfreportwebviewsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownloadsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownloadsetfilter.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                } else {
                    $link = YPGMLINK("mpdfreportwebview.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownload.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownload.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                }
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreportdiv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No Custom PDF available");
    }
}

function Report_MASSUPDATELIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MASSUPDATELIST_Output () {
    XH2("Mass Update Forms");
    XBR();XBR();XBR();
    XDIV("massupdatediv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Form");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $massupdate_ida = Get_Array('massupdate');
    foreach ($massupdate_ida as $massupdate_id) {
        Get_Data("massupdate",$massupdate_id);
        if ( ReportUserVisibility($GLOBALS{'massupdate_userlevel'},$GLOBALS{'massupdate_personidlist'},$GLOBALS{'massupdate_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($massupdate_id);
            XTDTXT($GLOBALS{'massupdate_title'});
            XTDTXT($GLOBALS{'massupdate_primetable'});
            // XTDTXT($GLOBALS{'massupdate_referencedtablelist'});
            if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) {
                XTDTXT("Yes");
                $link = YPGMLINK("massupdateformsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            } else {
                XTDTXT("No");
                $link = YPGMLINK("massupdateformout.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("massupdatediv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No massupdates available");
    }
}

function Report_MPDFRELEVANTREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MPDFRELEVANTREPORTLIST_Output ( $keynamelist, $keyvaluelist ) {
    $keynamea = explode(',',$keynamelist);
    $bits = explode("_",$keynamea[0]);
    $primetable = $bits[0];
    $keyvaluea = explode(',',$keyvaluelist);
    if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$keyvaluea[0]); }
    if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$keyvaluea[0],$keyvaluea[1]); }
    if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$keyvaluea[0],$keyvaluea[1],$keyvaluea[2]); }
    XH2("Available Custom PDF Reports");
    XBR();XBR();XBR();
    XDIV("mpdfreportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("PDF");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $mpdfreport_ida = Get_Array('mpdfreport');
    foreach ($mpdfreport_ida as $mpdfreport_id) {
        Get_Data("mpdfreport",$mpdfreport_id);
        $canselect = "0";
        if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes") { // dont consider generic scan reports
            $kbits = explode(',',$keynamelist);
            if ($GLOBALS{'mpdfreport_listkeys'} == $keynamelist) { $canselect = "1"; }  // this table is involved
            if ( $canselect == "1") {
                if ( ReportUserVisibility($GLOBALS{'mpdfreport_userlevel'},$GLOBALS{'mpdfreport_personidlist'},$GLOBALS{'mpdfreport_selectionlogic'})) {
                    if ( RelevantReportFilterVisibility($GLOBALS{'mpdfreport_visibilityfilter'})) {
                        $itemfound = "1";
                        XTR();
                        XTDTXT($mpdfreport_id);
                        XTDTXT($GLOBALS{'mpdfreport_title'});
                        XTDTXT($GLOBALS{'mpdfreport_description'});
                        $link = YPGMLINK("mpdfreportpdfdownload.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
                        XTDLINKTXTNEWWINDOW($link,"download","pdf");
                        X_TR();
                    }
                }
            }
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreportdiv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No Custom PDF reports available");
    }
}

function Report_IMPORT_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
    $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin";
}

function Report_IMPORT_Output() {
    
    XH3("Data UploadX");
    XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
    
    $helplink = "Setup/Setup_UPLOAD_Output/setup_upload_output.html"; Help_Link;
    // XFORMUPLOAD("setupuploadin.php","upload");
    XFORMDROPZONE("setupuploadin.php","FileUpload");
    XINSTDHID();
    // XINFILE("UPLOAD","10000000");
    print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
    print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
    print '</div>'."\n";
    
    XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
    XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
    
}


function Report_SETUPMASSUPDATELIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPMASSUPDATELIST_Output () {
    XH2("Mass Update Forms");
    XFORMUPLOAD("massupdatecomposerout.php","newmassupdate");
    XINSTDHID();
    XINHID("massupdate_id","new");
    XINHID("action","new");
    XINHID("menulist","massupdateupdatelist");
    XINSUBMIT("Create New Mass Update Form");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("massupdatediv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Form");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $massupdate_ida = Get_Array('massupdate');
    foreach ($massupdate_ida as $massupdate_id) {
        Get_Data("massupdate",$massupdate_id);
        if ( ReportUserVisibility($GLOBALS{'massupdate_userlevel'},$GLOBALS{'massupdate_personidlist'},$GLOBALS{'massupdate_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($massupdate_id);
            XTDTXT($GLOBALS{'massupdate_title'});
            XTDTXT($GLOBALS{'massupdate_description'});
            XTDTXT($GLOBALS{'massupdate_userlevel'});
            XTDTXT($GLOBALS{'massupdate_primetable'});
            //			XTDTXT($GLOBALS{'massupdate_referencedtablelist'});
            if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) { XTDTXT("Yes"); }
            else { XTDTXT("No"); }
            $link = YPGMLINK("massupdatecomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id).YPGMPARM("menulist","massupdateupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("massupdatedeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
            XTDLINKTXT($link,"delete");
            if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) {
                $link = YPGMLINK("massupdateformsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            } else {
                $link = YPGMLINK("massupdateformout.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            }
            $link = YPGMLINK("massupdatecomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id).YPGMPARM("menulist","massupdateupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("massupdatediv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No massupdates available");
    }
}

function Report_SETUPMASSUPDATECOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPMASSUPDATECOMPOSER_Output($massupdate_id,$action) {
    
    if (($action == "new")||($action == "replicate")) {
        $massupdate_ida = Get_Array('massupdate');
        $highestmassupdate_id = "MU00000";
        foreach ($massupdate_ida as $tmassupdate_id) {
            $highestmassupdate_id = $tmassupdate_id;
        }
        $highestmassupdate_seq = str_replace("MU", "", $highestmassupdate_id);
        $highestmassupdate_seq++;
        $newmassupdate_id = "MU".substr(("00000".$highestmassupdate_seq), -5);
        if ($action == "new") {
            Initialise_Data('massupdate');
            XH2("Mass Update Composer - New Mass Update Form - ".$newmassupdate_id);
        }
        if ($action == "replicate") {
            Get_Data('massupdate', $massupdate_id);
            Write_Data('massupdate', $newmassupdate_id);
            XH2("Mass Update Composer - Replicated Mass Update Form - ".$newmassupdate_id);
        }
        $massupdate_id = $newmassupdate_id;
    }
    if ($action == "update") {
        Get_Data('massupdate', $massupdate_id);
        XH2("Report Composer - ".$massupdate_id." - ".$GLOBALS{'massupdate_title'});
    }
    
    XFORM("massupdatecomposerin.php","massupdatein");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    XINHID("menulist","massupdateupdatelist");
    XHR();
    XH2('Title');
    XINTXT("massupdate_title",$GLOBALS{'massupdate_title'},"50","100");
    XH2('Description');
    XINTXT("massupdate_description",$GLOBALS{'massupdate_description'},"100","200");
    XH2('Prime Table');
    XINTXT("massupdate_primetable",$GLOBALS{'massupdate_primetable'},"20","40");
    /*
     XH2('Referenced Tables');
     XINTXT("massupdate_referencedtablelist",$GLOBALS{'massupdate_referencedtablelist'},"150","250");
     */
    XBR();XBR();
    XINSUBMITNAME("find_submit","Show Database Fields");
    XH2('Filter');
    XINTXT("massupdate_selectionlogic",$GLOBALS{'massupdate_selectionlogic'},"250","250");
    XH2('Sort');
    XINTXT("massupdate_sortlogic",$GLOBALS{'massupdate_sortlogic'},"250","250");
    XH2('User Level');
    $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only";
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"massupdate_userlevel",$GLOBALS{'massupdate_userlevel'});
    XH4('Authorised People');
    XINTXTID("massupdate_personidlist","massupdate_personidlist",$GLOBALS{'massupdate_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("massupdate_personidnames",View_Person_List($GLOBALS{'massupdate_personidlist'}));
    BROW();
    BCOL("6");
    XH2('Mass Update Fields');
    XINTEXTAREA("massupdate_fieldlist",$GLOBALS{'massupdate_fieldlist'},"20","100");
    B_COL();
    
    if (strlen(strstr($GLOBALS{'export_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'export_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'export_primetable'};
        $primetablepair = "";
    }
    $tstring = $GLOBALS{$primetable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $fstring = ""; $fsep = "";
    foreach ($tfields as $tfieldelement) {
        $fbits = explode('_',$tfieldelement);
        Check_Data('field',$fbits[0],$fbits[1]);
        if ($GLOBALS{'IOWARNING'} == "0") {
            $parmlist = "Input=".$GLOBALS{"field_massupdatetype"}.",";
            $parmlist = $parmlist."Cols=".$GLOBALS{"field_massupdateparm1"};
            $sep = ",";
            if ($GLOBALS{"field_massupdatetype"} == "TITLE") {
            }
            if ($GLOBALS{"field_massupdatetype"} == "TEXT") {
                $parmlist = $parmlist.$sep."MaxChars=".$GLOBALS{"field_massupdateparm2"};
            }
            if ($GLOBALS{"field_massupdatetype"} == "TEXTAREA") {
                $parmlist = $parmlist.$sep."Rows=".$GLOBALS{"field_massupdateparm2"};
            }
            if ($GLOBALS{"field_massupdatetype"} == "DATE") {
            }
            if ($GLOBALS{"field_massupdateselection"} != "") {
                $parmlist = $parmlist.$sep.$GLOBALS{"field_massupdateselection"};
            }
            $fstring = $fstring.$fsep.$tfieldelement."(".$parmlist.')'; $fsep = "\n";
        } else {
            $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
        }
    }
    
    if ( $primetablepair != "" ) {
        $tstring = $GLOBALS{$primetablepair."^FIELDS"};
        $tfields = explode('|', $tstring);
        $fstring = ""; $fsep = "";
        foreach ($tfields as $tfieldelement) {
            $fbits = explode('_',$tfieldelement);
            Check_Data('field',$fbits[0],$fbits[1]);
            if ($GLOBALS{'IOWARNING'} == "0") {
                $parmlist = "Input=".$GLOBALS{"field_massupdatetype"}.",";
                $parmlist = $parmlist."Cols=".$GLOBALS{"field_massupdateparm1"};
                $sep = ",";
                if ($GLOBALS{"field_massupdatetype"} == "TITLE") {
                }
                if ($GLOBALS{"field_massupdatetype"} == "TEXT") {
                    $parmlist = $parmlist.$sep."MaxChars=".$GLOBALS{"field_massupdateparm2"};
                }
                if ($GLOBALS{"field_massupdatetype"} == "TEXTAREA") {
                    $parmlist = $parmlist.$sep."Rows=".$GLOBALS{"field_massupdateparm2"};
                }
                if ($GLOBALS{"field_massupdatetype"} == "DATE") {
                }
                if ($GLOBALS{"field_massupdateselection"} != "") {
                    $parmlist = $parmlist.$sep.$GLOBALS{"field_massupdateselection"};
                }
                $fstring = $fstring.$fsep.$tfieldelement."(".$parmlist.')'; $fsep = "\n";
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        }
    }
    
    /*
     if ( $GLOBALS{'massupdate_referencedtablelist'} != "" ) {
     //
     $reftablea = explode(',', $GLOBALS{'massupdate_referencedtablelist'});
     foreach ($reftablea as $reftable) {
     $tbits = explode('[', $reftable);
     $fstring = $fstring.$fsep."==================="; $fsep = "\n";
     $tstring = $GLOBALS{$tbits[0]."^FIELDS"};
     $tfields = explode('|', $tstring);
     foreach ($tfields as $tfieldelement) {
     $fbits = explode('_',$tfieldelement);
     Check_Data('field',$fbits[0],$fbits[1]);
     if ($GLOBALS{'IOWARNING'} == "0") {
     // corresi_aaa(AAA)[keyval=mmm]
     if ( $GLOBALS{"field_massupdatename"} != "" ) {
     $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_massupdatename"}.')'; $fsep = "\n";
     } else {
     $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
     }
     } else {
     $fstring = $fstring.$fsep.$tfieldelement.''; $fsep = "\n";
     }
     }
     }
     }
     */
    
    BCOL("6");
    XH2('Database Fields');
    XTEXTAREANEW("20","100");
    XTXT($fstring);
    X_TEXTAREA();
    B_COL();
    B_ROW();
    XBR();XBR();
    XINSUBMITNAME("final_submit","Update Report Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,report_personidlist,report_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPMASSUPDATEDELETECONFIRM_Output ($massupdate_id) {
    Get_Data("massupdate",$massupdate_id);
    XH3("Delete Mass Update Form - ".$massupdate_id." - ".$GLOBALS{'massupdate_title'});
    // $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
    XPTXT("Are you sure you want to delete this massupdate");
    XBR();
    XFORM("massupdatedeleteaction.php","deletemassupdate");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    XINSUBMIT("Confirm Mass Update Form Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}


function Report_MASSUPDATEFORMSETFILTER_Output( $massupdate_id ) {
    Get_Data("massupdate",$massupdate_id);
    XH3("Set the filter values for this mass update form");
    XBR();
    XFORM("massupdateformout.php","massupdateformout");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    $seltesta = explodeAND($GLOBALS{'massupdate_selectionlogic'});
    XTABLE();
    foreach ( $seltesta as $seltest) {
        $selbits = explodeCOMP($seltest);
        if ( $selbits[2] == '?' ) {
            XTR();XTDTXT($selbits[0]);XTDTXT($selbits[1]);XTDINTXT($selbits[0],"","20","50");X_TR();
        }
    }
    X_TABLE();
    XBR();
    XINSUBMIT("Launch Mass Update Form");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_MASSUPDATEFORM_CSSJS( ) {
    $GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
    $GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepicker";
}

function Report_MASSUPDATEFORM_Output( $massupdate_id, $thisselectionlogic ) {
    
    Get_Data('massupdate',$massupdate_id);
    XH3("Description");
    XPTXT($GLOBALS{'massupdate_description'});
    XH3("Settings");
    XPTXT("Prime Table - ".$GLOBALS{'massupdate_primetable'});
    if ( $thisselectionlogic != "") { $thisselectionlogic = $thisselectionlogic; }
    else { $thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'}; }
    if ($thisselectionlogic != "") {$seltext = $thisselectionlogic;} else {$seltext = "None";}
    XPTXT("Selection - ".$seltext);
    if ($GLOBALS{'massupdate_sortlogic'} != "") {$sorttext = $GLOBALS{'massupdate_sortlogic'};} else {$sorttext = "None";}
    XPTXT("Sort - ".$sorttext);
    $primetable = $GLOBALS{'massupdate_primetable'};
    
    $selfieldvaluea = Array(); $selfieldcompa = Array();
    if ( $thisselectionlogic != "" ) {
        $seltesta = explodeAND($thisselectionlogic);
        $fi = 0;
        foreach ( $seltesta as $seltest) {
            $fi++;
            $selbits = explodeCOMP($seltest);
            $selfieldcompa{$fi."_".$selbits[0]} = $selbits[1];
            $selfieldvaluea{$fi."_".$selbits[0]} = $selbits[2];
            $selfieldformata{$fi."_".$selbits[0]} = $selbits[3];
        }
    }
    $sortfieldname = $GLOBALS{'massupdate_sortlogic'};
    
    $primetableida = Get_NKey_Array($primetable);
    $sortselecteda = Array();
    foreach ( $primetableida as $primetableid) {
        $ida = explode('|',$primetableid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); }
        $selected = "1";
        foreach($selfieldvaluea as $k => $v) {
            $kbits = explode("_",$k);
            $kfield = $kbits[1]."_".$kbits[2];
            $selected = ReSelection($selected,$kfield,$selfieldcompa{$k},$v,$selfieldformata{$k});
        }
        if ($sortfieldname == "" ) { $sortfieldvalue = ""; }
        else { $sortfieldvalue = $GLOBALS{$sortfieldname}; }
        if ($selected == "1") { array_push($sortselecteda, $sortfieldvalue."|".$primetableid); }
    }
    if ($sortfieldname != "" ) { sort($sortselecteda); }
    
    XH3("Mass Update Form");
    XFORM("massupdateformin.php","massupdateform");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    
    $thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'};
    $seltesta = explodeAND($GLOBALS{'massupdate_selectionlogic'});
    foreach ( $seltesta as $seltest) {
        $selbits = explodeCOMP($seltest);
        if ( $selbits[2] == '?' ) {
            $thisparmvalue = $_REQUEST[$selbits[0]];
            XINHID($selbits[0],$thisparmvalue);
        }
    }
    $massupdate_fieldlist = Replace_CRandLF($GLOBALS{'massupdate_fieldlist'},"|");
    $massupdate_fieldlist = str_replace('||', '|', $massupdate_fieldlist);
    if ( substr($massupdate_fieldlist, -1) == '|' ) {
        substr_replace($string ,"",-1);
    }
    // XPTXT("$".$massupdate_fieldlist.'$');
    $fieldsa = explode('|',$massupdate_fieldlist);
    /*
     corsite_id(Input=TITLE,Cols=1)
     corsite_arkoutletname(Input=TITLE,Cols=1)
     corsite_arkaddr1(Input=TEXT,Cols=1,MaxChars=100)
     corsite_arktown(Input=TEXTAREA,Cols=2,Rows=3)
     corsite_arkdate(Input=DATE,Cols=1)
     */
    BROW();
    foreach ($fieldsa as $field) {
        $tfield = str_replace(")",",)",$field);
        $nbits = explode("(",$tfield);
        $fbits = explode("_",$nbits[0]);
        $headertitle = $fbits[1];
        $cbits = explode("Cols=",$tfield);
        $dbits = explode(",",$cbits[1]);
        $cols = $dbits[0];
        BCOLTXTCOLOR("<b>".$headertitle."</b>",$cols,"gray","white");
    }
    B_ROW();
    BROW();
    foreach ($fieldsa as $field) {
        $tfield = str_replace(")",",)",$field);
        $cbits = explode("Cols=",$tfield);
        $dbits = explode(",",$cbits[1]);
        $cols = $dbits[0];
        BCOLTXTCOLOR("X",$cols,"white","white");
    }
    B_ROW();
    
    foreach ( $sortselecteda as $sortselectedid) {
        $sida = explode('|',$sortselectedid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$sida[1]); $keyref=$sida[1];}
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$sida[1],$sida[2]); $keyref=$sida[1]."-".$sida[2];}
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$sida[1],$sida[2],$sida[3]); $keyref=$sida[1]."-".$sida[2]."-".$sida[3];}
        BROWTOP();
        foreach ($fieldsa as $field) {
            $tfield = str_replace(")",",)",$field);
            $nbits = explode("(",$tfield);
            $fieldname = $nbits[0];
            $fbits = explode("_",$fieldname);
            Check_Data("field",$fbits[0],$fieldname);
            $tbits = explode("Input=",$tfield);
            $ubits = explode(",",$tbits[1]);
            $inputtype = $ubits[0];
            $cbits = explode("Cols=",$tfield);
            $dbits = explode(",",$cbits[1]);
            $cols = $dbits[0];
            if ( $inputtype == "TITLE" ) {
                BCOLTXT ($GLOBALS{$fieldname},$cols);
            }
            if ( $inputtype == "TEXT" ) {
                if ( $GLOBALS{'field_massupdateselection'} == "" ) {
                    BCOLINTXT ($fieldname."_".$keyref,$GLOBALS{$fieldname},$cols);
                }
                if (strlen(strstr($GLOBALS{'field_massupdateselection'},"Lookup("))>0) {
                    $lbits = explode("(",$GLOBALS{'field_massupdateselection'});
                    $mbits = explode(")",$lbits[1]);
                    $thistable = $mbits[0];
                    BCOLINSELECTHASHID (Array2Hash(Get_Array($thistable)),$fieldname."_".$keyref,$fieldname."_".$keyref,$GLOBALS{$fieldname},$cols);
                }
            }
            if ( $inputtype == "TEXTAREA" ) {
                $rbits = explode("Rows=",$tfield);
                $sbits = explode(",",$rbits[1]);
                $rows = $sbits[0];
                BCOLINTEXTAREA ($fieldname."_".$keyref,$GLOBALS{$fieldname},$rows,$cols);
            }
            if ( $inputtype == "DATE" ) {
                BCOLINDATE ($fieldname."_".$keyref,$GLOBALS{$fieldname},"dd-mm-yyyy",$cols);
                
            }
        }
        B_ROW();
    }
    XBR();
    XINSUBMIT ("Update");
    X_FORM();
}

function DF($thisfield,$parm) {
    
    /*
     corsite_arkaddr1(Addr1)
     corsite_arktown(Town){Filter}
     corsite_arkpostcode(PostCode)
     [startreflist,corresi,corsite_dispcorresiidlist]
     corresi_class(Class)
     corresi_quantity(No.)
     [endreflist]
     [startreflookup,corcomms,corsite_id]
     corsitecomms_type(Type)
     corsitecomms_message(Message)
     [endreflookup]
     [link,manage,corsiteupdate,corsite_id,corsite_version]
     
     or
     
     corsite_arkaddr1
     corsite_arktown
     corsite_arkpostcode
     [startlist,corresi,corsite_dispcorresiidlist]
     corresi_class
     corresi_quantity
     [endlist]
     [startscan,corcomms,corsite_id]
     corsitecomms_type
     corsitecomms_message
     [endscan]
     [link,manage,corsiteupdate,corsite_id,corsite_version]
     
     sfmfacility_id(Ground)
     sfmfacility_floodlightfixtureinstalldate(Date)[X:FOREACHyyyy][Y:FOREACHsfmfacility_floodlightfixturetypeid:COUNT]

     */
    
    // Set Defaults
    $type = "field";
    $table = "";
    $fieldname = $thisfield;
    $formattype = "";
    $fieldvalue = "";
    $totalincrvalue = 0;
    $countincrvalue = 0;
    $titlefield = $thisfield;
    $totalfield = "";
    $countfield = "";
    $filterfield = "";
    $reftable = "";
    $refkeylist = "";
    $refrootkeyarray = Array();
    $linktext = "";
    $programname = "";
    $programkeyarray = Array();
    $graphxsyntax = "";
    $graphysyntax = "";
    
    if ($thisfield[0] == "[") {
        // Deal with the special lines that are not directly related to fieldnames
        if (strlen(strstr($thisfield,'[startreflist'))>0) {
            $type = "startreflist";
            // [startreflist,corresi,corsite_dispcorresiidlist]
            $tbits = explode('[',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $vbits = explode(',',$ubits[0]);
            $reftable = $vbits[1];
            $refkeylist = $vbits[2];
            $refrootkeyarray = Array(); // CHECK This is a simplification for this version
        }
        if (strlen(strstr($thisfield,'[endreflist'))>0) { $type = "endreflist"; }
        
        if (strlen(strstr($thisfield,'[startreflookup'))>0) {
            $type = "startreflookup";
            // [startreflookup,corsitecomms,corsite_id]
            $tbits = explode('[',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $vbits = explode(',',$ubits[0]);
            $reftable = $vbits[1];
            if ( count($vbits) ==  2 ) { $refrootkeyarray = Array(); }
            if ( count($vbits) ==  3 ) { $refrootkeyarray = Array($vbits[2]); }
            if ( count($vbits) ==  4 ) { $refrootkeyarray = Array($vbits[2],$vbits[3]); }
        }
        if (strlen(strstr($thisfield,'[endreflookup'))>0) { $type = "endreflookup"; }
        
        if (strlen(strstr($thisfield,'[link'))>0) {
            $type = "programlink";
            // [link,manage,corsiteupdate,corsite_id,corsite_version]
            $tbits = explode('[',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $vbits = explode(',',$ubits[0]);
            $linktext = $vbits[1];
            $programname = $vbits[2];
            if ( count($vbits) ==  4 ) { $programkeyarray = Array($vbits[3]); }
            if ( count($vbits) ==  5 ) { $programkeyarray = Array($vbits[3],$vbits[4]); }
            if ( count($vbits) ==  6 ) { $programkeyarray = Array($vbits[3],$vbits[4],$vbits[5]); }
        }
    } else {
        // find the field name before any special characters
        $type = "field";
        if ((strlen(strstr($thisfield,'('))>0)||(strlen(strstr($thisfield,'{'))>0)||(strlen(strstr($thisfield,'['))>0)) {
            // XPTXT("Here");
            $tfieldname = "";
            $specialfound = "0";
            for ($ci = 0; $ci <= strlen($thisfield); $ci++) {
                if (($thisfield[$ci] != "{")&&($thisfield[$ci] != "(")&&($thisfield[$ci] != "[")&&($specialfound == "0")) {
                    $tfieldname = $tfieldname.$thisfield[$ci];
                } else {
                    $specialfound = "1";
                }
            }
            $fieldname = $tfieldname;
        }
    }
    
    // Process the fieldname related parameters
    
    if ($parm == "Title") {
        if (strlen(strstr($thisfield,'('))>0) {
            $tbits = explode('(',$thisfield);
            $ubits = explode(')',$tbits[1]);
            $titlefield = $ubits[0];
        } else {
            if (strlen(strstr($thisfield,'{'))>0) { // assumes { comes first
                $tbits = explode('{',$thisfield);
                $titlefield = $tbits[0];
            } else {
                if (strlen(strstr($thisfield,'['))>0) {
                    $tbits = explode('[',$thisfield);
                    $titlefield = $tbits[0];
                }
            }
        }
    }
    
    if ($parm == "Total") {
        if (strlen(strstr($thisfield,'{Total}'))>0) {
            $totalfield = "Y";
        }
    }
    
    if ($parm == "Count") {
        if (strlen(strstr($thisfield,'{Count}'))>0) {
            $countfield = "Y";
        }
    }
    
    if ($parm == "Filter") {
        if (strlen(strstr($thisfield,'{Filter}'))>0) {
            $filterfield = "Y";
        }
    }
    
    $fbits = explode('_',$thisfield);
    $table = $fbits[0];
    
    if ($parm == "FieldFormat") {
        if (strlen(strstr($thisfield,'{'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('{',$thisfield);
            $ubits = explode('}',$tbits[1]);
            $validformats = Array("Num0","Num1","Num2","Curr0","Curr1","Curr2","Percent0","Percent1","Percent2","RAG","NonBlank","NonZero","Weblink","YYYY-MM-DD","yyyy-mm-dd","DD/MM/YYYY","dd/mm/yyyy");
            if (in_array($ubits[0], $validformats)) { $formattype = $ubits[0]; }
            if (strlen(strstr($ubits[0],'Max'))>0) { $formattype = $ubits[0]; }
            if (strlen(strstr($ubits[0],'Compare='))>0) { $formattype = $ubits[0]; }
            if (strlen(strstr($ubits[0],'ListVal='))>0) { $formattype = $ubits[0]; }
        }
    }
    
    if ($parm == "FieldValue") {
        // [Y:FOREACHsfmfacility_floodlightfixturetypeid:COUNT]
        if (strlen(strstr($thisfield,'Y:FOREACH'))>0) {
            $sbits = explode(":",$thisfield);
            if (strlen(strstr($sbits[1],'_'))>0) { // special situation - another field is involved
                $otherfieldname = str_replace("FOREACH","",$sbits[1]);
                $fieldvalue = $GLOBALS{$otherfieldname}; 
            } else {
                $fieldvalue = $GLOBALS{$fieldname}; // normal situation this field value  returned
            } 
        } else { 
            $fieldvalue = $GLOBALS{$fieldname}; // normal situation this field value  returned
        } 
    }
    
    if ($parm == "FieldFormattedValue") {
        if (strlen(strstr($thisfield,'{'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('{',$thisfield);
            $ubits = explode('}',$tbits[1]);
            $formattype = $ubits[0];
            if ($formattype == "Num0") { $fieldvalue = number_format($GLOBALS{$fieldname}); }
            if ($formattype == "Num1") { $fieldvalue = number_format($GLOBALS{$fieldname}, 1, '.', ''); }
            if ($formattype == "Num2") { $fieldvalue = number_format($GLOBALS{$fieldname}, 2, '.', ''); }
            if ($formattype == "Curr0") { $fieldvalue = "&pound;".number_format($GLOBALS{$fieldname}); }
            if ($formattype == "Curr1") { $fieldvalue = "&pound;".number_format($GLOBALS{$fieldname}, 1, '.', ''); }
            if ($formattype == "Curr2") { $fieldvalue = "&pound;".number_format($GLOBALS{$fieldname}, 2, '.', ''); }
            if ($formattype == "Percent0") { $fieldvalue = number_format($GLOBALS{$fieldname})."%"; }
            if ($formattype == "Percent1") { $fieldvalue = number_format($GLOBALS{$fieldname}, 1, '.', '')."%"; }
            if ($formattype == "Percent2") { $fieldvalue = number_format($GLOBALS{$fieldname}, 2, '.', '')."%"; }
            if (substr($formattype, 0, 3) == "Max") {
                $flength = (int)str_replace("Max", "", $formattype);
                if ($fieldvalue != "") {
                    if ( strlen($GLOBALS{$fieldname}) > $flength ) { $fieldvalue = substr($GLOBALS{$fieldname}, 0, $flength).".."; }
                }
            }
            if (substr($formattype, 0, 8) == "Compare=") {
                $cfieldname = str_replace("Compare=", "", $formattype);
                if ($cfieldname != "") {
                    if ($GLOBALS{$fieldname} == $GLOBALS{$cfieldname}) { $fieldvalue = "Yes"; }
                    else { $fieldvalue = "No"; }
                }
            }
            if (substr($formattype, 0, 8) == "ListVal=") {
                $cfieldname = str_replace("ListVal=", "", $formattype);
                if ($cfieldname != "") {
                    if (strlen(strstr($GLOBALS{$fieldname}.",",$cfieldname.","))>0) { $fieldvalue = $cfieldname; }
                    else { $fieldvalue = ""; }
                }
            }
            if ($formattype == "RAG") {
                if ($GLOBALS{$fieldname} == "Red") { $fieldvalue = '<span style="color:red">Red</span>'; }
                if ($GLOBALS{$fieldname} == "red") { $fieldvalue = '<span style="color:red">red</span>'; }
                if ($GLOBALS{$fieldname} == "Amber") { $fieldvalue = '<span style="color:orange">Amber</span>'; }
                if ($GLOBALS{$fieldname} == "amber") { $fieldvalue = '<span style="color:orange">amber</span>'; }
                if ($GLOBALS{$fieldname} == "Green") { $fieldvalue = '<span style="color:green">Green</span>'; }
                if ($GLOBALS{$fieldname} == "green") { $fieldvalue = '<span style="color:green">green</span>'; }
                
                if ($GLOBALS{$fieldname} == "Yes") { $fieldvalue = '<span style="color:green">Yes</span>'; }
                if ($GLOBALS{$fieldname} == "Y") { $fieldvalue = '<span style="color:green">Y</span>'; }
                if ($GLOBALS{$fieldname} == "yes") { $fieldvalue = '<span style="color:green">yes</span>'; }
                if ($GLOBALS{$fieldname} == "No") { $fieldvalue = '<span style="color:red">No</span>'; }
                if ($GLOBALS{$fieldname} == "N") { $fieldvalue = '<span style="color:red">N</span>'; }
                if ($GLOBALS{$fieldname} == "no") { $fieldvalue = '<span style="color:red">no</span>'; }
                if ($GLOBALS{$fieldname} == "NA") { $fieldvalue = '<span style="color:blue">no</span>'; }
                
                if ($GLOBALS{$fieldname} == "Pass") { $fieldvalue = '<span style="color:green">Pass</span>'; }
                if ($GLOBALS{$fieldname} == "Fail") { $fieldvalue = '<span style="color:red">Fail</span>'; }
            }
            if ($formattype == "NonBlank") {
                if ($GLOBALS{$fieldname} == "") { $fieldvalue = '<img src="../site_assets/checkbox-selected-red.png" />'; }
                else { $fieldvalue = '<img src="../site_assets/checkbox-selected-green.png" />'; }
            }
            if ($formattype == "NonZero") {
                if ($GLOBALS{$fieldname} == 0) { $fieldvalue = '<img src="../site_assets/checkbox-selected-orange.png" />'; }
                else { $fieldvalue = '<img src="../site_assets/checkbox-selected-green.png" />'; }
            }
            if ($formattype == "Weblink") {
                if ($GLOBALS{$fieldname} == "") { $fieldvalue = ""; }
                else { $fieldvalue = YLINKTXTNEWWINDOW(DDbMMbYYYYtoYYYYhMMhDD($GLOBALS{$fieldname}),"link","Link View"); }
            }
            if ($formattype == "YYYY-MM-DD") {
                if ($GLOBALS{$fieldname} == "") { $fieldvalue = ""; }
                else { $fieldvalue = DDbMMbYYYYtoYYYYhMMhDD($GLOBALS{$fieldname}); }
            }
            
        } else {
            $fieldvalue = $GLOBALS{$fieldname};
            // XPTXT( $thisfield." ".$fieldname." ".$fieldvalue." ".$GLOBALS{$fieldname} );
        }
    }
    
    if ($parm == "TotalIncrValue") {
        $totalincrvalue = floatval($GLOBALS{$fieldname});
    }
    
    if ($parm == "CountIncrValue") {
        $countincrvalue = 0;
        if (strlen(strstr($thisfield,'{Count}'))>0) {
            $thisfield2  = str_replace('{Count}', "", $thisfield);
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('{',$thisfield2);
            $ubits = explode('}',$tbits[1]);
            $formattype = $ubits[0];
            if (substr($formattype, 0, 8) == "ListVal=") { // to identify entries in list
                $cfieldname = str_replace("ListVal=", "", $formattype);
                if ($cfieldname != "") {
                    if (strlen(strstr($GLOBALS{$fieldname}.",",$cfieldname.","))>0) { $countincrvalue = 1; }
                    else { $countincrvalue = 0; }
                }
            } else {
                if ($GLOBALS{$fieldname} != "") { $countincrvalue = 1; };
            }
        }
    }
    
    if ($parm == "GraphXSyntax") {
        // [X:TITLE]
        if (strlen(strstr($thisfield,'[X:'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('[X:',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $graphxsyntax = "X:".$ubits[0];
        }
    }
    if ($parm == "GraphYSyntax") {
        // [Y:FOREACH:COUNT]
        if (strlen(strstr($thisfield,'[Y:'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('[Y:',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $graphysyntax = "Y:".$ubits[0];
        }
    }
    
    // XPTXT($thisfield.'|'.$parm.'==>'.$type.'|'.$table.'|'.$fieldname.'|'.$titlefield.'|'.$indexvalue);
    
    if ($parm == "Type") { return $type; }
    if ($parm == "Table") { return $table; }
    if ($parm == "Field") { return $fieldname; }
    if ($parm == "FieldFormat") { return $formattype; }
    if ($parm == "FieldFormattedValue") { return $fieldvalue; }
    if ($parm == "FieldValue") { return $fieldvalue; }
    if ($parm == "TotalIncrValue") { return $totalincrvalue; }
    if ($parm == "CountIncrValue") { return $countincrvalue; }
    if ($parm == "Title") { return $titlefield; }
    if ($parm == "Total") { return $totalfield; }
    if ($parm == "Count") { return $countfield; }
    if ($parm == "Filter") { return $filterfield; }
    if ($parm == "RefTable") { return $reftable; }
    if ($parm == "RefKeyList") { return $refkeylist; }
    if ($parm == "RefRootKeyArray") { return $refrootkeyarray; }
    if ($parm == "LinkText") { return $linktext; }
    if ($parm == "ProgramName") { return $programname; }
    if ($parm == "ProgramKeyArray") { return $programkeyarray; }
    if ($parm == "GraphXSyntax") { return $graphxsyntax; }
    if ($parm == "GraphYSyntax") { return $graphysyntax; }
}

function fieldFormat($fieldvalue, $formattype) {
    $outfieldvalue = $fieldvalue;
    if ($formattype == "") { $outfieldvalue = $fieldvalue; }
    if ($formattype == "Num0") { $outfieldvalue = number_format($fieldvalue); }
    if ($formattype == "Num1") { $outfieldvalue = number_format($fieldvalue, 1, '.', ''); }
    if ($formattype == "Num2") { $outfieldvalue = number_format($fieldvalue, 2, '.', ''); }
    if ($formattype == "Curr0") { $outfieldvalue = "&pound;".number_format($fieldvalue); }
    if ($formattype == "Curr1") { $outfieldvalue = "&pound;".number_format($fieldvalue, 1, '.', ''); }
    if ($formattype == "Curr2") { $outfieldvalue = "&pound;".number_format($fieldvalue, 2, '.', ''); }
    if ($formattype == "Percent0") { $outfieldvalue = number_format($fieldvalue)."%"; }
    if ($formattype == "Percent1") { $outfieldvalue = number_format($fieldvalue, 1, '.', '')."%"; }
    if ($formattype == "Percent2") { $outfieldvalue = number_format($fieldvalue, 2, '.', '')."%"; }
    if (substr($formattype, 0, 3) == "Max") {
        $flength = (int)str_replace("Max", "", $formattype);
        if ($fieldvalue != "") {
            if ( strlen($fieldvalue) >= $flength ) { $outfieldvalue = substr($fieldvalue, 0, $flength).".."; }
        }
    }
    if (substr($formattype, 0, 8) == "Compare=") {
        $cfieldname = (int)str_replace("Compare=", "", $formattype);
        if ($cfieldname != "") {
            if ($fieldvalue == $GLOBALS{$cfieldname}) { $outfieldvalue = "Yes"; }
            else { $outfieldvalue = "No"; }
        }
    }
    if (substr($formattype, 0, 8) == "ListVal=") {
        $cfieldname = str_replace("ListVal=", "", $formattype);
        if ($cfieldname != "") {
            if (strlen(strstr($GLOBALS{$fieldname}.",",$cfieldname.","))>0) { $outfieldvalue = $cfieldname; }
            else { $outfieldvalue = ""; }
        }
    }
    if (($formattype == "YYYY-MM-DD")||($formattype == "yyyy-mm-dd")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} != "date" ) {
            if ($GLOBALS{$fieldname} == "") { $outfieldvalue = ""; }
            else { $outfieldvalue = DDbMMbYYYYtoYYYYhMMhDD($GLOBALS{$fieldname}); }
        }
    }
    if (($formattype == "DD/MM/YYYY")||($formattype == "dd/mm/yyyy")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} == "date" ) {
            if ($GLOBALS{$fieldname} == "") { $outfieldvalue = ""; }
            else { $outfieldvalue = YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{$fieldname}); }
        }
    }  
    return $outfieldvalue;
}

function explodeOR($thisselectionlogic) {
    $thisselectionlogic = trim($thisselectionlogic,' ');
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($thisselectionlogic); }
    $orfound = "0";
    if (strlen(strstr($thisselectionlogic,')||('))>0) {
        $thisselectionlogic = str_replace(')||(', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if (strlen(strstr($thisselectionlogic,') || ('))>0) {
        $thisselectionlogic = str_replace(') || (', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if (strlen(strstr($thisselectionlogic,')|('))>0) {
        $thisselectionlogic = str_replace(')|(', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if (strlen(strstr($thisselectionlogic,') | ('))>0) {
        $thisselectionlogic = str_replace(') | (', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if ( $orfound == "1" ) {
        $thisselectionlogic = ltrim($thisselectionlogic,'(');
        $thisselectionlogic = rtrim($thisselectionlogic,')');
    }
    return explode('^',$thisselectionlogic);
}

function explodeAND($thisselectionlogic) {
    $thisselectionlogic = trim($thisselectionlogic,' ');
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($thisselectionlogic); }
    $thisselectionlogic = str_replace(')&&(', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(') && (', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(')&(', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(') & (', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(')', '', $thisselectionlogic);
    $thisselectionlogic = str_replace('(', '', $thisselectionlogic);
    return explode('^',$thisselectionlogic);
}

function rebuildOR($tselora) {
    $outstring = ""; $sepor = "";
    if (isset($tselora)) {
        foreach ($tselora as $element) {
            $outstring = $outstring.$sepor.'('.$element.')';
            $sepor = "|";
        }
    }
    return $outstring;
}

function rebuildAND($tseltestouta) {
    $outstring = ""; $sepand = "";
    if (isset($tseltestouta)) {
        foreach ($tseltestouta as $element) {
            $outstring = $outstring.$sepand.'('.$element.')';
            $sepand = "&";
        }
    }
    return $outstring;
}

function explodeCOMP($thisfieldcomp) {
    // field==value  field{dd/mm/yyyy}=value field!=value field>=value   etc    returns array (field,comp,value,{format})
    $fva = Array();
    $thiscomp = "=="; // default
    if (strlen(strstr($thisfieldcomp,'='))>0) {
        if (strlen(strstr($thisfieldcomp,'=='))>0) { $fva = explode('==',$thisfieldcomp); $thiscomp = "==";}
        else { $fva = explode('=',$thisfieldcomp); $thiscomp = "==";}
    }
    if (strlen(strstr($thisfieldcomp,'!='))>0) { $fva = explode('!=',$thisfieldcomp); $thiscomp = "!=";}
    if (strlen(strstr($thisfieldcomp,'<>'))>0) { $fva = explode('<>',$thisfieldcomp); $thiscomp = "!=";}
    if (strlen(strstr($thisfieldcomp,'>'))>0) {
        if (strlen(strstr($thisfieldcomp,'>='))>0) { $fva = explode('>=',$thisfieldcomp); $thiscomp = ">=";}
        else { $fva = explode('>',$thisfieldcomp); $thiscomp = ">";}
    }
    if (strlen(strstr($thisfieldcomp,'<'))>0) {
        if (strlen(strstr($thisfieldcomp,'<='))>0) { $fva = explode('<=',$thisfieldcomp); $thiscomp = "<=";}
        else { $fva = explode('<',$thisfieldcomp); $thiscomp = "<";}
    }
    if (strlen(strstr($fva[0],'{'))>0) {
        $fbits = explode('{',$fva[0]);
        $gbits = explode('}',$fbits[1]);
        $thisfield = $fbits[0];
        $thisformat = $gbits[0];
    } else {
        $thisfield = $fva[0];
        $thisformat = "";
    }
    
    $ra = Array($thisfield,$thiscomp,$fva[1],$thisformat);
    return $ra;
}

function ReSelection($tselected,$field,$comp,$value,$format) {
    $inselected = $tselected;
    if ( $value != '' ) {
        $thisvalue = $value;
        if ($comp == '==') {
            // ========== OR list comparisons =============
            if ( strlen(strstr($thisvalue,'|'))>0 ) {
                $orva = explode('|',$thisvalue);
                $ormatch = "0";
                foreach ( $orva as $orv ) {
                    if (strlen(strstr($orv,'*'))>0) { // wildcard
                        if ( $orv == '*' ) { $ormatch = "1"; } // always select
                        else { // wildcard based selection
                            $partialvalue = str_replace('*', "", $orv);
                            if ( (substr($orv, 0, 1) == "*")&&(substr($orv, -1) == "*") ) {	 // any position
                                if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) { $ormatch = "1"; }
                            } else {
                                if ( substr($orv, -1) == "*" ) { // start of string
                                    if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                                }
                                if ( substr($orv, 0, 1) == "*") { // end of string
                                    if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                                }
                            }
                        }
                    } else { // normal based selection
                        if ($orv == "NonBlank") {
                            if (CC($GLOBALS{$field}) != "") { $ormatch = "1"; }
                        } else {
                            if ($orv == "Blank") { $orv = ""; }
                            if (CC($GLOBALS{$field}) == CC($orv)) { $ormatch = "1"; }
                        }
                    }
                    // XPTXT($value." ".$orv." ".$ormatch);
                }
                
                if ($ormatch == "0") { $tselected = "0"; }
            }
            // ========== single value comparison =============
            else {
                if (strlen(strstr($value,'*'))>0) { // wildcard
                    if ( $value == '*' ) { } // always select
                    /*
                     else { // wildcard based selection
                     $partialvalue = str_replace('*', "", $value);
                     if (strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0) {} else { $tselected = "0"; }
                     }
                     */
                    else { // wildcard based selection
                        $partialvalue = str_replace('*', "", $value);
                        if ( (substr($value, 0, 1) == "*")&&(substr($value, -1) == "*") ) {	 // any position
                            if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) {} else { $tselected = "0"; }
                        } else {
                            if ( substr($value, -1) == "*" ) { // start of string
                                if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                            if ( substr($value, 0, 1) == "*") { // end of string
                                if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                        }
                    }
                } else { // normal based selection
                    if ($thisvalue == "NonBlank") {
                        if (CC($GLOBALS{$field}) != "") { } else { $tselected = "0"; }
                    } else {
                        if ($thisvalue == "Blank") { $thisvalue = ""; }
                        if (CC($GLOBALS{$field}) == CC($thisvalue)) { } else { $tselected = "0"; }
                    }
                }
            }
        }
        if ($comp == '!=') {
            // ========== OR list comparisons =============
            if ( strlen(strstr($thisvalue,'|'))>0 ) {
                $orva = explode('|',$thisvalue);
                $ormatch = "0";
                foreach ( $orva as $orv ) {
                    if (strlen(strstr($orv,'*'))>0) { // wildcard
                        $partialvalue = str_replace('*', "", $orv);
                        /*
                         if (strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0) { $ormatch = "1"; }
                         */
                        if ( (substr($orv, 0, 1) == "*")&&(substr($orv, -1) == "*") ) {	 // any position
                            if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) { $ormatch = "1"; }
                        } else {
                            if ( substr($orv, -1) == "*" ) { // start of string
                                if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                            }
                            if ( substr($orv, 0, 1) == "*") { // end of string
                                if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                            }
                        }
                    } else { // normal based selection
                        if ($orv == "Blank") {
                            if (CC($GLOBALS{$field}) != "") { $ormatch = "1"; }
                        } else {
                            if ($orv == "NonBlank") { $orv = ""; }
                            if (CC($GLOBALS{$field}) == CC($orv)) { $ormatch = "1"; }
                        }
                    }
                }
                if ($ormatch == "1") { $tselected = "0"; }
            }
            // ========== single valsubstr($value, 0, 1)rison =============
            else {
                if (strlen(strstr($value,'*'))>0) { // wildcard
                    if ( $value == '*' ) { } // always select
                    else { // wildcard based selection
                        $partialvalue = str_replace('*', "", $value);
                        /*
                         if (strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0) { $tselected = "0"; }
                         */
                        if ( (substr($value, 0, 1) == "*")&&(substr($value, -1) == "*") ) {	 // any position
                            if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) {} else { $tselected = "0"; }
                        } else {
                            if ( substr($value, -1) == "*" ) { // start of string
                                if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                            if ( substr($value, 0, 1) == "*") { // end of string
                                if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                        }
                    }
                } else { // normal based selection
                    if ($thisvalue == "NonBlank") {
                        if (CC($GLOBALS{$field}) == "") { } else { $tselected = "0"; }
                    } else {
                        if ($thisvalue == "Blank") { $thisvalue = ""; }
                        if (CC($GLOBALS{$field}) != CC($thisvalue)) { } else { $tselected = "0"; }
                    }
                }
            }
            
        }
        if ($comp == '>') {  if (ReFormat($field,$GLOBALS{$field},$format) > ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        if ($comp == '>=') {  if (ReFormat($field,$GLOBALS{$field},$format) >= ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        if ($comp == '<') {  if (ReFormat($field,$GLOBALS{$field},$format) < ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        if ($comp == '<=') {  if (ReFormat($field,$GLOBALS{$field},$format) <= ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        
    }
    // XPTXT($inselected." ".$field." ".$comp." ".$value." ".$tselected);
    return $tselected;
}

function ReFormat($fieldname,$fieldstring,$fieldformat) {
    $reformatstring = $fieldstring;
    if (($fieldformat == "YYYY-MM-DD")||($fieldformat == "yyyy-mm-dd")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} != "date" ) {
            if ($GLOBALS{$fieldname} == "") { $reformatstring = ""; }
            else { $reformatstring = DDbMMbYYYYtoYYYYhMMhDD($fieldstring); }
        }
    }
    if (($fieldformat == "DD/MM/YYYY")||($fieldformat == "dd/mm/yyyy")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} == "date" ) {
            if ($GLOBALS{$fieldname} == "") { $reformatstring = ""; }
            else { $reformatstring = YYYY_MM_DDtoDDsMMsYYYY($fieldstring); }
        }
    }
    return $reformatstring;
}

function ShowFormat($fieldformat) {
    $fieldformatstring = "";
    if ($fieldformat != "" ) {
        $fieldformatstring = "{".$fieldformat."}";
    }
    return $fieldformatstring;
}

function CC($compstring) {
    // adapts special characters to permit comparison
    $compstring = str_replace('&', "AND", $compstring);
    $compstring = str_replace(':', "COLON", $compstring);
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($compstring); }
    return $compstring;
}


function FilterPopup() {
    XDIVPOPUP("filterpopup","Filter");
    XINHIDID("filterid","filterid","");
    XDIVSCROLL("filterdiv","","400px");
    XTXTID("filterstring","filterstring");
    X_DIV("filterdiv");
    XBR();
    XINBUTTONIDSPECIAL("ClearFilter","secondary","Clear Filters");
    XBR();XHR();
    XINBUTTONID("ApplyFilter","Apply Filter");
    XINBUTTONIDSPECIAL("CancelFilter","warning","Cancel");
    X_DIV("filterpopup");
}

// ================== Custom FIlters ===========================

function myLocations() {
    $pipelist = ""; $psep = "";
    $dmwscontractlocationa = Get_Array('dmwscontractlocation');
    foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
        $include = "0";
        Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
        if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $include = "1"; }
        if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $include = "1"; }
        if ($include == "1") { $pipelist = $pipelist.$psep.$dmwscontractlocation_id; $psep = "|";}
    }
    return $pipelist;
}

function myWOs() {
    $woarray = Array();
    $dmwscontractlocationa = Get_Array('dmwscontractlocation');
    foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
        Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
        if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) {
            $tarray = List2Array($GLOBALS{'dmwscontractlocation_officerlist'});
            $woarray = array_merge($woarray, $tarray);
        }
    }
    $rarray = array_unique($woarray);
    $pipelist = Array2List($rarray);
    $pipelist = str_replace(',', '|', $pipelist);
    return $pipelist;
}

function meOnly() {
    $pipelist = $GLOBALS{'LOGIN_person_id'};
    return $pipelist;
}

=======
<?php # reportroutines.inc

function ReportUserVisibility($reportlevel,$nameduserlist,$selectionlogic) {
    $reportvisibility = false;
    $userlevel = 0;
    if ( $GLOBALS{'service_cor'} != "" ) {
        Check_Data('coruser');
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_readonlyuserlist'})) { $userlevel = 1;}
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_otheruserlist'})) { $userlevel = 2; }
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_primeuserlist'})) { $userlevel = 3; }
        if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'coruser_superuserlist'})) { $userlevel = 4; }
        if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $userlevel = 4; }
        if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $userlevel = 4; }
        
        // ================ extra custom logic to enforce programme isolation ==============================
        // (corsite_corprogramme=Piraat)&(corsite_version=Live)&(corsite_status=Sold)
        if (strlen(strstr($selectionlogic,"corsite_corprogramme="))>0) {           
            $selbits = explode("corsite_corprogramme=",$selectionlogic);
            if (strlen(strstr($selbits[1],")"))>0) {
                $selbits1 = explode(")",$selbits[1]);
                $proglist = $selbits1[0];
            } else {
                $proglist = $selbits[1];
            }
            $proglist = str_replace('||', '|', $proglist);
            $corprogramme_namea = explode("|",$proglist);
            $found = "0";
            foreach ( $corprogramme_namea as $corprogramme_name ) {
                Check_Data("corprogramme",$corprogramme_name);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    if (FoundInCommaList($GLOBALS{'LOGIN_person_id'},$GLOBALS{'corprogramme_authorisedpersonidlist'})) { $found = "1"; }
                }
            }
            if ( $found == "0" ) { $userlevel = 0; } // Dont show Repoert
        }
    }
    if ( $GLOBALS{'service_dmws'} != "" ) {
        Check_Data('person',$GLOBALS{'LOGIN_person_id'});
        $userlevel = $GLOBALS{'person_userlevel'};
        if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $userlevel = 4; }
        if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $userlevel = 4; }
    }
    if ( $GLOBALS{'service_sfm'} != "" ) {
        $userlevel = 4;
    }
    if (($userlevel >= $reportlevel)||(FoundInCommaList($GLOBALS{'LOGIN_person_id'},$nameduserlist))) { $reportvisibility = true; }
    return $reportvisibility;
}

function RelevantReportFilterVisibility($visibilityfilter) {
    $reportvisibility = false;
    if ( $visibilityfilter != "" ) {
        $selfieldvaluea = Array(); $selfieldcompa = Array(); $selfieldformata = Array();
        $seltesta = explodeAND($visibilityfilter);
        $fi = 0;
        foreach ( $seltesta as $seltest) {
            $fi++;
            $selbits = explodeCOMP($seltest);
            $selfieldcompa{$fi."_".$selbits[0]} = $selbits[1];
            $selfieldvaluea{$fi."_".$selbits[0]} = $selbits[2];
            $selfieldformata{$fi."_".$selbits[0]} = $selbits[3];
        }
        $selected = "1";
        foreach($selfieldvaluea as $k => $v) {
            $kbits = explode("_",$k);
            $kfield = $kbits[1]."_".$kbits[2];
            $selected = ReSelection($selected,$kfield,$selfieldcompa{$k},$v,$selfieldformata{$k});
        }
        if ($selected == "1") { $reportvisibility = true; }
    } else {
        $reportvisibility = true; // No filter
    }
    return $reportvisibility;
}

function Report_SETUPREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPREPORTLIST_Output () {
    XH2("Reports");
    XFORMUPLOAD("reportcomposerout.php","newreport");
    XINSTDHID();
    XINHID("report_id","new");
    XINHID("action","new");
    XINHID("menulist","reportupdatelist");
    XINSUBMIT("Create New Report");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $report_ida = Get_Array('report');
    foreach ($report_ida as $report_id) {
        Get_Data("report",$report_id);
        if ( ReportUserVisibility($GLOBALS{'report_userlevel'},$GLOBALS{'report_personidlist'},$GLOBALS{'report_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($report_id);
            XTDTXT($GLOBALS{'report_title'});
            XTDTXT($GLOBALS{'report_description'});
            XTDTXT($GLOBALS{'report_userlevel'});
            XTDTXT($GLOBALS{'report_primetable'});
            if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) { XTDTXT("Yes"); }
            else { XTDTXT("No"); }
            //			XTDTXT($GLOBALS{'report_referencedtablelist'});
            $link = YPGMLINK("reportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$report_id).YPGMPARM("menulist","reportupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("reportdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$report_id);
            XTDLINKTXT($link,"delete");
            if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) {
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"view","view");
                $link = YPGMLINK("reportpdfdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            } else {
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"view","view");
                $link = YPGMLINK("reportpdfdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            }
            $link = YPGMLINK("reportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("report_id",$report_id).YPGMPARM("menulist","reportupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function Report_SETUPREPORTCOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPREPORTCOMPOSER_Output($report_id,$action) {
    
    if (($action == "new")||($action == "replicate")) {
        $report_ida = Get_Array('report');
        $highestreport_id = "RP00000";
        foreach ($report_ida as $treport_id) {
            $highestreport_id = $treport_id;
        }
        $highestreport_seq = str_replace("RP", "", $highestreport_id);
        $highestreport_seq++;
        $newreport_id = "RP".substr(("00000".$highestreport_seq), -5);
        if ($action == "new") {
            Initialise_Data('report');
            XH2("Report Composer - New Report - ".$newreport_id);
        }
        if ($action == "replicate") {
            Get_Data('report', $report_id);
            Write_Data('report', $newreport_id);
            XH2("Report Composer - Replicated Report - ".$newreport_id);
        }
        $report_id = $newreport_id;
    }
    if ($action == "update") {
        Get_Data('report', $report_id);
        XH2("Report Composer - ".$report_id." - ".$GLOBALS{'report_title'});
    }
    
    XFORM("reportcomposerin.php","reportin");
    XINSTDHID();
    XINHID("report_id",$report_id);
    XINHID("menulist","reportupdatelist");
    XHRCLASS("underline");
    XH3('Report Settings');
    BROW();
    BCOLTXT("Title<br>","1");
    BCOLINTXT("report_title",$GLOBALS{'report_title'},"3");
    BCOLTXT("Description","1");
    BCOLINTXT("report_description",$GLOBALS{'report_description'},"7");
    B_ROW();
    BROW();
    BCOLTXT("Prime Table","1");
    BCOLINTXT("report_primetable",$GLOBALS{'report_primetable'},"3");
    BCOLTXT("Referenced Tables","1");
    BCOLINTXT("report_referencedtablelist",$GLOBALS{'report_referencedtablelist'},"7");
    B_ROW(); 
    BROW();
    BCOLTXT("&nbsp;","1");
    BCOL("3");
    XINSUBMITNAME("find_submit","Show Database Fields");
    B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Prime Table<br>Filter","1");
    BCOLINTXT("report_selectionlogic",$GLOBALS{'report_selectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Referenced Table<br>Filter","1");
    BCOLINTXT("report_referencedselectionlogic",$GLOBALS{'report_referencedselectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Sort","1");
    BCOLINTXT("report_sortlogic",$GLOBALS{'report_sortlogic'},"11");
    B_ROW();
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    XBR();
    BROW();
    BCOLTXT("User Level","1");
    BCOL("3");
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"report_userlevel",$GLOBALS{'report_userlevel'});
    B_COL();
    BCOLTXT("Named People","1");
    BCOL("7");
    XINTXTID("report_personidlist","report_personidlist",$GLOBALS{'report_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("report_personidnames",View_Person_List($GLOBALS{'report_personidlist'}));
    B_COL();
    B_ROW();

    XHRCLASS("underline");
    XH3("PDF Settings");
    BROW();
    BCOLTXT("Page Layout","1");
    $xkeylist = "A4,A4-L,A3,A3-L";
    BCOLINSELECTHASH (List2Hash($xkeylist),"report_pagelayout",$GLOBALS{'report_pagelayout'},"2");
    BCOLTXT("Page Margins - L,R,T,B","1");
    if ($GLOBALS{'report_pagemargins'} == "") { $GLOBALS{'report_pagemargins'} = "15,15,15,15"; }
    BCOLINTXT("report_pagemargins",$GLOBALS{'report_pagemargins'},"2");
    BCOLTXT("Font Size","1");
    $xkeylist = "4,5,6,7,8,9,10,11,12,13,14,15,16";
    BCOLINSELECTHASH (List2Hash($xkeylist),"report_fontsize",$GLOBALS{'report_fontsize'},"2");
    BCOLTXT("Lines per page","1");
    $xkeylist = "10,12,14,16,18,20,22,24,26,28,30,32,34,36,38,40,42,44,46,48,50,52,54,56,58,60";
    BCOLINSELECTHASH (List2Hash($xkeylist),"report_linesperpage",$GLOBALS{'report_linesperpage'},"2");
    B_ROW();
    BROW();
    BCOLTXT("Dashboard Favourite","1");
    BCOLINSELECTHASH (List2Hash("Yes,No"),"report_dashboardfavourite",$GLOBALS{'report_dashboardfavourite'},"2");
    BCOLTXT("Dashboard Icon Text","1");
    BCOLINTXT("report_favouriteicontext",$GLOBALS{'report_favouriteicontext'},"2");
    BCOLTXT("Max Report Entries<br>(Default = 500)","1");
    BCOLINTXT("report_maxselection",$GLOBALS{'report_maxselection'},"2");
    BCOLTXT("Max Execution Time<br>(Default = 30)","1");
    BCOLINTXT("report_maxexecutiontime",$GLOBALS{'report_maxexecutiontime'},"2");
    B_ROW();
       
    XHRCLASS("underline");
    XH3("Graph Settings");
    BROW();
    BCOLTXT("Caption","1");
    BCOLINTXT("report_graphcaption",$GLOBALS{'report_graphcaption'},"2");
    BCOLTXT("Graph Type","1");
    $xkeylist = ",column,line,area,spline,pie";
    $xvaluelist = "None,Column,Line,Area,Spline,Pie";
    BCOLINSELECTHASH (Lists2Hash($xkeylist,$xvaluelist),"report_graphtype",$GLOBALS{'report_graphtype'},"2");
    BCOLTXT("Stacked Data","1");
    BCOLINCHECKBOXYESNO ("report_graphstacked",$GLOBALS{'report_graphstacked'},"","2");
    B_ROW();
    BROW();
    BCOLTXT("Axes Inverted","1");
    BCOLINCHECKBOXYESNO ("report_graphinverted",$GLOBALS{'report_graphinverted'},"","2");
    BCOLTXT("Hide Source Data","1");
    BCOLINCHECKBOXYESNO ("report_graphhiderawdata",$GLOBALS{'report_graphhiderawdata'},"","2");
    B_ROW();
    BROW();
    BCOLTXT('Advanced Format<br>"table"',"1");
    BCOLINTXT("report_graphtableparms",$GLOBALS{'report_graphtableparms'},"11");
    B_ROW();
    BROW();
    BCOLTXT('Advanced Format<br>"th"',"1");
    BCOLINTXT("report_graphthparms",$GLOBALS{'report_graphthparms'},"11");
    B_ROW();  
    
    XHRCLASS("underline");
    XH3("CSV Export Settings");
    BROW();
    BCOLTXT("Re-Import Keys","1");
    BCOLINCHECKBOXYESNO ("report_uploadable",$GLOBALS{'report_uploadable'},"","2");
    B_ROW();
    
    XHRCLASS("underline");
    BROW();
    BCOL("6");
    XH3('Report Fields');
    XINTEXTAREA("report_fieldlist",$GLOBALS{'report_fieldlist'},"20","100");
    B_COL();
    
    if (strlen(strstr($GLOBALS{'report_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'report_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'report_primetable'};
        $primetablepair = "";
    }
    $tstring = $GLOBALS{$primetable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $fstring = ""; $fsep = "";
    foreach ($tfields as $tfieldelement) {
        $fbits = explode('_',$tfieldelement);
        Check_Data('field',$fbits[0],$fbits[1]);
        if ($GLOBALS{'IOWARNING'} == "0") {
            if ( $GLOBALS{"field_reportname"} != "" ) {
                $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        } else {
            $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
        }
    }
    if ( $primetablepair != "" ) {
        $fstring = $fstring.$fsep."==================="; $fsep = "\n";
        $tstring = $GLOBALS{$primetablepair."^FIELDS"};
        $tfields = explode('|', $tstring);
        foreach ($tfields as $tfieldelement) {
            $fbits = explode('_',$tfieldelement);
            Check_Data('field',$fbits[0],$fbits[1]);
            if ($GLOBALS{'IOWARNING'} == "0") {
                if ( $GLOBALS{"field_reportname"} != "" ) {
                    $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
                } else {
                    $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
                }
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        }
    }
    
    if ( $GLOBALS{'report_referencedtablelist'} != "" ) {
        //
        $reftablea = explode(',', $GLOBALS{'report_referencedtablelist'});
        foreach ($reftablea as $reftable) {
            $fstring = $fstring.$fsep."==================="; $fsep = "\n";
            
            $keylistfield = "";
            $tfielda = Get_Array('field',$primetable);
            foreach ($tfielda as $tfieldelement) {
                if ( $GLOBALS{"field_tablekeylist"} == $reftable ) {
                    // [startreflist,corresi,corsite_dispcorresiidlist]
                    $keylistfield = $tfieldelement;
                    $fstring = $fstring.$fsep.'[startreflist,'.$reftable.','.$keylistfield.']'; $fsep = "\n";
                }
            }
            if ($primetablepair != "") {
                $tfielda = Get_Array('field',$primetablepair);
                foreach ($tfielda as $tfieldelement) {
                    if ( $GLOBALS{"field_tablekeylist"} == $reftable ) {
                        // [startreflist,corresi,corsite_dispcorresiidlist]
                        $keylistfield = $tfieldelement;
                        $fstring = $fstring.$fsep.'[startreflist,'.$reftable.','.$keylistfield.']'; $fsep = "\n";
                    }
                }
            }
            if ($keylistfield == "") {
                // Keylist not found - assume reflookup instead
                // [startreflookup,corsitecomms,corsite_id]
                $tstring = $GLOBALS{$primetable."^FIELDS"};
                $tfields = explode('|', $tstring);
                $keylistfield = $tfields[1]; // CHECK - this only allows 1st key
                $fstring = $fstring.$fsep.'[startreflookup,'.$reftable.','.$keylistfield.']'; $fsep = "\n";
            }
            
            $tstring = $GLOBALS{$reftable."^FIELDS"};
            $tfields = explode('|', $tstring);
            foreach ($tfields as $tfieldelement) {
                $fbits = explode('_',$tfieldelement);
                Check_Data('field',$fbits[0],$fbits[1]);
                if ($GLOBALS{'IOWARNING'} == "0") {
                    // corresi_aaa(AAA)[keyval=mmm]
                    if ( $GLOBALS{"field_reportname"} != "" ) {
                        $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
                    } else {
                        $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
                    }
                } else {
                    $fstring = $fstring.$fsep.$tfieldelement.''; $fsep = "\n";
                }
            }
            
            $fstring = $fstring.$fsep.'[endreflist]'; $fsep = "\n";
            
        }
    }
    
    BCOL("6");
    XH3('Database Fields');
    XTEXTAREANEW("20","100");
    XTXT($fstring);
    X_TEXTAREA();
    B_COL();
    B_ROW();
    XBR();XBR();
    XINSUBMITNAME("final_submit","Update Report Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,report_personidlist,report_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPREPORTDELETECONFIRM_Output ($report_id) {
    Get_Data("report",$report_id);
    XH3("Delete Report - ".$report_id." - ".$GLOBALS{'report_title'});
    // $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
    XPTXT("Are you sure you want to delete this report");
    XBR();
    XFORM("reportdeleteaction.php","deletereport");
    XINSTDHID();
    XINHID("report_id",$report_id);
    XINSUBMIT("Confirm Report Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}


function Report_SETUPMPDFREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPMPDFREPORTLIST_Output () {
    XH2("Custom PDF Reports");
    XFORMUPLOAD("mpdfreportcomposerout.php","newreport");
    XINSTDHID();
    XINHID("mpdfreport_id","new");
    XINHID("action","new");
    XINHID("menulist","mpdfreportupdatelist");
    XINSUBMIT("Create New Custom PDF");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("mpdfreportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Type");
    XTDHTXT("Keys");
    XTDHTXT("Filter");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $mpdfreport_ida = Get_Array('mpdfreport');
    foreach ($mpdfreport_ida as $mpdfreport_id) {
        Get_Data("mpdfreport",$mpdfreport_id);
        if ( ReportUserVisibility($GLOBALS{'mpdfreport_userlevel'},$GLOBALS{'mpdfreport_personidlist'},$GLOBALS{'mpdfreport_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($mpdfreport_id);
            XTDTXT($GLOBALS{'mpdfreport_title'});
            XTDTXT($GLOBALS{'mpdfreport_description'});
            XTDTXT($GLOBALS{'mpdfreport_userlevel'});
            XTDTXT($GLOBALS{'mpdfreport_primetable'});
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes") { XTDTXT("Unique Key"); }
            else { XTDTXT("List"); }
            XTDTXT($GLOBALS{'mpdfreport_listkeys'});
            if ($GLOBALS{'mpdfreport_selectionlogic'} != "") { XTDTXT("Yes"); }
            else { XTDTXT(""); }
            $link = YPGMLINK("mpdfreportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("menulist","mpdfreportupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("mpdfreportdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
            XTDLINKTXT($link,"delete");
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
                $link = YPGMLINK("mpdfreportkeylist.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
            } else {
                if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
                    $link = YPGMLINK("mpdfreportwebviewsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownloadsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownloadsetfilter.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                } else {
                    $link = YPGMLINK("mpdfreportwebview.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownload.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownload.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                }
            }
            $link = YPGMLINK("mpdfreportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("menulist","mpdfreportupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreport_tablecontainer");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No Custom PDF available");
    }
}

function Report_SETUPMPDFREPORTCOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup,mpdfreportcomposer";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPMPDFREPORTCOMPOSER_Output($mpdfreport_id,$action) {
    if (($action == "new")||($action == "replicate")) {
        $mpdfreport_ida = Get_Array('mpdfreport');
        $highestmpdfreport_id = "RM00000";
        foreach ($mpdfreport_ida as $tmpdfreport_id) {
            $highestmpdfreport_id = $tmpdfreport_id;
        }
        $highestmpdfreport_seq = str_replace("RM", "", $highestmpdfreport_id);
        $highestmpdfreport_seq++;
        $newmpdfreport_id = "RM".substr(("00000".$highestmpdfreport_seq), -5);
        if ($action == "new") {
            Initialise_Data('mpdfreport');
            XH2("Custom PDF Composer - New Custom PDF - ".$newmpdfreport_id);
        }
        if ($action == "replicate") {
            Get_Data('mpdfreport', $mpdfreport_id);
            Write_Data('mpdfreport', $newmpdfreport_id);
            XH2("Custom PDF Composer - Replicated Custom PDF - ".$newmpdfreport_id);
        }
        $mpdfreport_id = $newmpdfreport_id;
    }
    if ($action == "update") {
        Get_Data('mpdfreport', $mpdfreport_id);
        XH2("MPDF Report Composer - ".$mpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});
    }
    
    XFORM("mpdfreportcomposerin.php","mpdfreportin");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    XINHID("menulist","mpdfreportupdatelist");
    XHR();
    XH2('Title');
    XINTXT("mpdfreport_title",$GLOBALS{'mpdfreport_title'},"100","100");
    XH2('Description');
    XINTXT("mpdfreport_description",$GLOBALS{'mpdfreport_description'},"100","200");
    XH2('Prime Table');
    XINTXT("mpdfreport_primetable",$GLOBALS{'mpdfreport_primetable'},"20","40");
    XH2('Report Type and Parameters');
    if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
        $uniquekeyreportselected = "checked";
        $nonuniquekeyreportselected = "";
    } else {
        $uniquekeyreportselected = "";
        $nonuniquekeyreportselected = "checked";
    }
    XTABLE();
    XTR();
    XTD();
    XINRADIO("mpdfreport_uniquekeyreport", "Yes", $uniquekeyreportselected, "This report is for a specific database record");XBR();
    XTABLEINVISIBLE();
    XTR();XTDTXT("Key Field Names");XTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");XTDINTXT("mpdfreport_listkeys",$GLOBALS{'mpdfreport_listkeys'},"100","100");X_TR();
    XTR();XTDTXT("Title Field");XTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");XTDINTXT("mpdfreport_listkeytitlefields",$GLOBALS{'mpdfreport_listkeytitlefields'},"100","100");X_TR();
    XTR();XTDTXT("Composer Preview - Key Values");XTDTXT("&nbsp;&nbsp;&nbsp;&nbsp;");XTDINTXT("mpdfreport_listtestkeyvalues",$GLOBALS{'mpdfreport_listtestkeyvalues'},"100","100");X_TR();
    X_TABLE();
    X_TD();
    X_TR();
    XTR();
    XTD();
    XINRADIO("mpdfreport_uniquekeyreport", "No", $nonuniquekeyreportselected, "This report is for a list of records");XBR();
    XTABLEINVISIBLE();
    XTR();XTDTXT("Report Filter");XTDINTXT("mpdfreport_selectionlogic",$GLOBALS{'mpdfreport_selectionlogic'},"100","200");X_TR();
    XTR();XTDTXT("Max Report Entries: (Default = 10)");XTDINTXT("mpdfreport_maxselection",$GLOBALS{'mpdfreport_maxselection'},"100","200");X_TR();
    XTR();XTDTXT("Max Execution Time: (Default = 30)");XTDINTXT("mpdfreport_maxexecutiontime",$GLOBALS{'mpdfreport_maxexecutiontime'},"100","200");X_TR();
    X_TABLE();
    X_TD();
    X_TR();
    X_TABLE();
    XH2('User Level');
    
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"mpdfreport_userlevel",$GLOBALS{'mpdfreport_userlevel'});
    XH4('Authorised People');
    XINTXTID("mpdfreport_personidlist","mpdfreport_personidlist",$GLOBALS{'mpdfreport_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("mpdfreport_personidnames",View_Person_List($GLOBALS{'mpdfreport_personidlist'}));
    XH4('Visibility Filter');
    XINTXT("mpdfreport_visibilityfilter",$GLOBALS{'mpdfreport_visibilityfilter'},"100","200");
    XH2('Page Layout');
    $xkeylist = "A4,A4-L,A3,A3-L";
    XINSELECTHASH (List2Hash($xkeylist),"mpdfreport_pagelayout",$GLOBALS{'mpdfreport_pagelayout'});
    XH3('Page Margins - Left,Right,Top,Bottom');
    if ($GLOBALS{'mpdfreport_pagemargins'} == "") { $GLOBALS{'mpdfreport_pagemargins'} = "15,15,15,15"; }
    XINTXTID("mpdfreport_pagemargins","mpdfreport_pagemargins",$GLOBALS{'mpdfreport_pagemargins'},"12","20");
    XH2('Font Size');
    $xkeylist = "6,7,8,9,10,11,12,13,14,15,16";
    XINSELECTHASH (List2Hash($xkeylist),"mpdfreport_fontsize",$GLOBALS{'mpdfreport_fontsize'});
    XH2('Dashboard Favourite');
    XINSELECTHASH (List2Hash("Yes,No"),"mpdfreport_dashboardfavourite",$GLOBALS{'mpdfreport_dashboardfavourite'});
    XH2('Dashboard Icon Text');
    XINTXTID("mpdfreport_favouriteicontext","mpdfreport_favouriteicontext",$GLOBALS{'mpdfreport_favouriteicontext'},"2","2");
    XH4('Report can be  downloaded as CSV');
    XINCHECKBOXYESNO("mpdfreport_csvdownloadable",$GLOBALS{'mpdfreport_csvdownloadable'},"");
    XH3('Report php');
    BROW();
    BCOLINTEXTAREAID ('mpdfreport_php','mpdfreport_php',$GLOBALS{'mpdfreport_php'},"40","12");
    B_ROW();
    XBR();XBR();
    XINSUBMIT("Update Report Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,mpdfreport_personidlist,mpdfreport_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPMPDFREPORTDELETECONFIRM_Output ($mpdfreport_id) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Delete Custom PDF - ".$mpdfreport_id." - ".$GLOBALS{'mpdfreport_title'});
    // $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
    XPTXT("Are you sure you want to delete this Custom PDF");
    XBR();
    XFORM("mpdfreportdeleteaction.php","deletempdfreport");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    XINSUBMIT("Confirm Custom PDF Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_SETUPFIELDAUTO_Output() {
    XH3("Setup Report and Mass Update Fields");
    XPTXT("Identify the tables for which you would like to automatically generate field titles and mass update input types");
    XPTXT("Note: This will preserve any settings that you have made manually");
    XFORM("setupfieldautoin.php","setupfield");
    XINSTDHID();
    $tablea = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            array_push($tablea, $row[0]);
        }
    }
    foreach ($tablea as $table) {
        $fielda = Get_Array('field',$table);
        if( count( $fielda ) != 0 ) { $infotext = "<b> <== Field Definitions Already Set</b>"; }
        else { $infotext = ""; }
        XINCHECKBOX("TableSelect[]","sel-".$table."-","",$table.$infotext."<BR>");
    }
    X_TD();
    X_TR();
    X_TABLE();
    XBR();
    XINSUBMIT("Select");
    X_FORM();
}

function Report_SETUPTABLEFIELDAUTO_Output($table) {
    XH3("Table - ".$table);
    $changesmade = "0";
    $seqnum = 0;
    $q = 'SHOW COLUMNS FROM '.$table;
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            // corsite_id|char(8)|NO|PRI|
            // corsite_versionpersonid|tinytext|YES||
            $tbits = explode('_',$row[0]);
            $seqnum++;
            $seqstring = "S".substr(("000".$seqnum), -3);
            // set default values
            $field_table = $tbits[0];
            $field_name = $tbits[1];
            $field_databasetype = $row[1]; 		// maintained
            $field_seq = $seqstring; 			// automatically set
            $field_reportname = $tbits[1];		// defaulted in report anyway
            $field_tablekeylist = ""; 			// manually set
            $field_massupdatetype = "";			// see logic below
            $field_massupdateparm1 = "";		// see logic below
            $field_massupdateparm2 = "";		// see logic below
            $field_massupdateselection = "";	// manually set
            
            if (substr_count($row[1], 'char') > 0) {
                $lbits = explode('(',$row[1]);
                $mbits = explode(')',$lbits[1]);
                $field_massupdatetype = "TEXT";
                $field_massupdateparm1 = "1"; // bootstrap cols
                $field_massupdateparm2 = $mbits[0]; // maxlen
            }
            if (substr_count($row[1], 'tinytext') > 0) {
                $field_massupdatetype = "TEXT";
                $field_massupdateparm1 = "1"; // bootstrap cols
                $field_massupdateparm2 = "100"; // maxlen
            }
            if (substr_count($row[1], 'text') > 0) {
                if (substr_count($row[1], 'tinytext') > 0) {}
                else {
                    $field_massupdatetype = "TEXTAREA";
                    $field_massupdateparm1 = "2"; // bootstrap cols
                    $field_massupdateparm2 = "3"; // rows
                }
            }
            if (substr_count($row[1], 'date') > 0) {
                $field_massupdatetype = "DATE";
                $field_massupdateparm1 = "1"; // bootstrap cols
                $field_massupdateparm2 = "";
            }
            if (substr_count($row[1], 'decimal') > 0) {
                $lbits = explode('(',$row[1]);
                $mbits = explode(')',$lbits[1]);
                $nbits = explode(',',$mbits[0]);
                $field_massupdatetype = "TEXT";
                $field_massupdateparm1 = "1"; // len
                $field_massupdateparm2 = $nbits[0]; // maxlen
            }
            
            if (substr_count($field_name, 'date') > 0) {
                if (substr_count($field_name, 'dates') > 0) {}
                else {
                    $field_massupdatetype = "DATE";
                    $field_massupdateparm1 = "1"; // bootstrap cols
                    $field_massupdateparm2 = "";
                }
            }
            
            Check_Data("field",$field_table,$field_name);
            if ($GLOBALS{'IOWARNING'} == "0") {
                // selectively update existing records
                $update = "0";
                $GLOBALS{'field_seq'} = $field_seq;
                if ($GLOBALS{'field_databasetype'} != $field_databasetype) {
                    XPTXTCOLOR("field_databasetype changed from |".$GLOBALS{'field_databasetype'}."| to |".$field_databasetype."|","red");
                    $GLOBALS{'field_databasetype'} = $field_databasetype;
                }
                if ($GLOBALS{'field_massupdatetype'} == "") {
                    XPTXTCOLOR("field_massupdatetype changed from |".$GLOBALS{'field_massupdatetype'}."| to |".$field_massupdatetype."|","red");
                    $GLOBALS{'field_massupdatetype'} = $field_massupdatetype;
                    $GLOBALS{'field_massupdateparm1'} = $field_massupdateparm1;
                    $GLOBALS{'field_massupdateparm2'} = $field_massupdateparm2;
                }
                Write_Data("field",$field_table,$field_name);
                // XPTXTCOLOR($field_table." ".$field_name,"orange");
                XPTXTCOLOR("Field record updated for ".$field_name,"green");
                
            } else {
                // write new record with default values
                Initialise_Data("field");
                $GLOBALS{'field_seq'} = $field_seq;
                $GLOBALS{'field_databasetype'} = $field_databasetype;
                $GLOBALS{'field_reportname'} = "";	// defaulted in report anyway
                $GLOBALS{'field_tablekeylist'} = "";
                $GLOBALS{'field_massupdatetype'} = $field_massupdatetype;
                $GLOBALS{'field_massupdateparm1'} = $field_massupdateparm1;
                $GLOBALS{'field_massupdateparm2'} = $field_massupdateparm2;
                $GLOBALS{'field_massupdateselection'} = "";	// manually set
                $changesmade = "1";
                Write_Data("field",$field_table,$field_name);
                // XPTXTCOLOR($field_table." ".$field_name,"orange");
                XPTXTCOLOR("New field record created for ".$field_name,"green");
            }
        }
    }
    XPTXTCOLOR("Automatic Generation Completed","green");
    
}

function Report_SETUPFIELD_Output() {
    XH3("Setup Report and Mass Update Fields");
    XPTXT("Detailed customisation of field settings for report headings and mass input forms");
    XFORM("setupfieldin.php","setupfield");
    XINSTDHID();
    $tablearray = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            $fielda = Get_Array('field',$row[0]);
            if( count( $fielda ) != 0 ) { array_push($tablearray, $row[0]); }
        }
    }
    $xhash = Array2Hash($tablearray);
    # hash id/name value
    XINSELECTHASH ($xhash,field_table,"");XBR();XBR();
    XINSUBMIT("Select");
    X_FORM();
}

function Report_SETUPFIELDPRINT_Output() {
    XH3("PDF Print of Report Fields");
    XPTXT("Download a PDF of the field properties for this table");
    XFORMNEWWINDOW("setupfieldpdfprintout.php","Field Print","setupfieldprint");
    XINSTDHID();
    $tablearray = array();
    $q = 'SHOW TABLES';
    $r = mysqli_query($GLOBALS{'IOSQL'},$q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            $fielda = Get_Array('field',$row[0]);
            if( count( $fielda ) != 0 ) {
                array_push($tablearray, $row[0]);
            }
        }
    }
    $xhash = Array2Hash($tablearray);
    # hash id/name value
    XINSELECTHASH ($xhash,"field_table","");XBR();XBR();
    XINSUBMIT("Select");
    X_FORM();
}

function Report_SETUPTABLEFIELD_Output($table) {
    $parm0 = "";
    $parm0 = $parm0."Report Field Names - ".$table."|"; # pagetitle
    $parm0 = $parm0."field[rootkey=".$table."]|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."field_name|"; # keyfieldname
    $parm0 = $parm0."field_seq|"; # sortfieldname
    $parm0 = $parm0."25|"; # pagination
    $parm0 = $parm0."NoAdd"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."field_name|Yes|Field Name|60|Yes|Field Name|KeyText,25,40^";
    // $parm1 = $parm1."field_databasetype|Yes|Database Type|150|Yes|Database Type|InputText,30,60^";
    $parm1 = $parm1."field_reportname|Yes|Report Header|150|Yes|Report Header|InputText,30,60^";
    $parm1 = $parm1."field_tablekeylist|Yes|Key List|150|Yes|Referenced Table Key List - (Enter Referenced Table Name)|InputText,20,60^";
    $parm1 = $parm1."field_massupdatetype|Yes|Input Type|150|Yes|Input Type|InputText,30,60^";
    $parm1 = $parm1."field_massupdateparm1||||Yes|Cols|InputText,30,60^";
    $parm1 = $parm1."field_massupdateparm2||||Yes|Max Chars/Rows|InputText,30,60^";
    // $selectiontext = "Selection Values e.g.<br>Lookup(<i>tablename</i>)<br>Select(<i>val1,val2,val3</i>)<br>Checkbox(<i>Yes,No</i>)<br>Radio(<i>val1,val2,val3</i>)";
    // $parm1 = $parm1."field_massupdateselection||||Yes|".$selectiontext."|InputText,30,60^";
    $parm1 = $parm1."field_seq|Yes|Seq|60|Yes|Seq|InputText,6,6^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Report_SETUPEXPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPEXPORTLIST_Output () {
    XH2("CSV Exports");
    XFORMUPLOAD("exportcomposerout.php","newexport");
    XINSTDHID();
    XINHID("export_id","new");
    XINHID("action","new");
    XINHID("menulist","exportupdatelist");
    XINSUBMIT("Create New CSV Export");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("exportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Re-Import");
    XTDHTXT("Variable Filter");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Browser");
    XTDHTXT("CSV");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $export_ida = Get_Array('export');
    foreach ($export_ida as $export_id) {
        Get_Data("export",$export_id);
        $canupdate = "1";
        if ( ReportUserVisibility($GLOBALS{'export_userlevel'},$GLOBALS{'export_personidlist'},$GLOBALS{'export_selectionlogic'})) {
            XTR();
            XTDTXT($export_id);
            XTDTXT($GLOBALS{'export_title'});
            XTDTXT($GLOBALS{'export_description'});
            XTDTXT($GLOBALS{'export_userlevel'});
            XTDTXT($GLOBALS{'export_primetable'});
            XTDTXT($GLOBALS{'export_uploadable'});
            if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) { XTDTXT("Yes"); }
            else { XTDTXT("No"); }
            $link = YPGMLINK("exportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$export_id).YPGMPARM("menulist","exportupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("exportdeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$export_id);
            XTDLINKTXT($link,"delete");
            if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) {
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            } else {
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            }
            $link = YPGMLINK("exportcomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("export_id",$export_id).YPGMPARM("menulist","exportupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("exportdiv");
    XCLEARFLOAT();
}

function Report_SETUPEXPORTCOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPEXPORTCOMPOSER_Output($export_id,$action) {
    
    if (($action == "new")||($action == "replicate")) {
        $export_ida = Get_Array('export');
        $highestexport_id = "EX00000";
        foreach ($export_ida as $texport_id) {
            $highestexport_id = $texport_id;
        }
        $highestexport_seq = str_replace("EX", "", $highestexport_id);
        $highestexport_seq++;
        $newexport_id = "EX".substr(("00000".$highestexport_seq), -5);
        if ($action == "new") {
            Initialise_Data('export');
            XH2("Export Composer - New Export - ".$newexport_id);
        }
        if ($action == "replicate") {
            Get_Data('export', $export_id);
            Write_Data('export', $newexport_id);
            XH2("Export Composer - Replicated Export - ".$newexport_id);
        }
        $export_id = $newexport_id;
    }
    if ($action == "update") {
        Get_Data('export', $export_id);
        XH2("Export Composer - ".$export_id." - ".$GLOBALS{'export_title'});
    }
    
    XFORM("exportcomposerin.php","exportin");
    XINSTDHID();
    XINHID("export_id",$export_id);
    XINHID("menulist","exportupdatelist");
    
    XHRCLASS("underline");
    XH3('Export Settings');
    BROW();
    BCOLTXT("Title<br>","1");
    BCOLINTXT("export_title",$GLOBALS{'export_title'},"3");
    BCOLTXT("Description","1");
    BCOLINTXT("export_description",$GLOBALS{'export_description'},"7");
    B_ROW();
    BROW();
    BCOLTXT("Prime Table","1");
    BCOLINTXT("export_primetable",$GLOBALS{'export_primetable'},"3");
    BCOLTXT("Referenced Tables","1");
    BCOLINTXT("export_referencedtablelist",$GLOBALS{'export_referencedtablelist'},"7");
    B_ROW();
    BROW();
    BCOLTXT("&nbsp;","1");
    BCOL("3");
    XINSUBMITNAME("find_submit","Show Database Fields");
    B_COL();
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Prime Table<br>Filter","1");
    BCOLINTXT("export_selectionlogic",$GLOBALS{'export_selectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Referenced Table<br>Filter","1");
    BCOLINTXT("export_referencedselectionlogic",$GLOBALS{'export_referencedselectionlogic'},"11");
    B_ROW();
    BROW();
    BCOLTXT("Sort","1");
    BCOLINTXT("export_sortlogic",$GLOBALS{'export_sortlogic'},"11");
    B_ROW();
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    XBR();
    BROW();
    BCOLTXT("User Level","1");
    BCOL("3");
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"export_userlevel",$GLOBALS{'export_userlevel'});
    B_COL();
    BCOLTXT("Named People","1");
    BCOL("7");
    XINTXTID("export_personidlist","export_personidlist",$GLOBALS{'export_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("export_personidnames",View_Person_List($GLOBALS{'export_personidlist'}));
    B_COL();
    B_ROW();
    
    XHRCLASS("underline");
    XH3("CSV Export Settings");
    BROW();
    BCOLTXT("Re-Import Keys","1");
    BCOLINCHECKBOXYESNO ("export_uploadable",$GLOBALS{'export_uploadable'},"","2");
    B_ROW();    
    
    /*
    
    XHR();
    XH2('Title');
    XINTXT("export_title",$GLOBALS{'export_title'},"50","100");
    XH2('Description');
    XINTXT("export_description",$GLOBALS{'export_description'},"100","200");
    XH2('Prime Table');
    XINTXT("export_primetable",$GLOBALS{'export_primetable'},"20","40");
    XH2('Referenced Tables');
    XINTXT("export_referencedtablelist",$GLOBALS{'export_referencedtablelist'},"150","250");
    XBR();XBR();
    XINSUBMITNAME("find_submit","Show Database Fields");
    XH2('Prime Table Filter');
    XINTXT("export_selectionlogic",$GLOBALS{'export_selectionlogic'},"250","250");
    XH2('Referenced Tables Filter');
    XINTXT("export_referencedselectionlogic",$GLOBALS{'export_referencedselectionlogic'},"250","250");
    XH2('Sort');
    XINTXT("export_sortlogic",$GLOBALS{'export_sortlogic'},"250","250");
    XH2('User Level');
    
    if ($GLOBALS{'LOGIN_service_id'} == 'dmws') { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Welfare Officer,Manager,HQ User,Super User,Named People Only"; }
    else { $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only"; }
    
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"export_userlevel",$GLOBALS{'export_userlevel'});
    XH4('Authorised People');
    XINTXTID("export_personidlist","export_personidlist",$GLOBALS{'export_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("export_personidnames",View_Person_List($GLOBALS{'export_personidlist'}));
    XH4('Add Re-Import Keys');
    XINCHECKBOXYESNO("export_uploadable",$GLOBALS{'export_uploadable'},"");
    */
    
    XHRCLASS("underline");
    BROW();
    BCOL("6");
    XH2('Export Fields');
    XINTEXTAREA("export_fieldlist",$GLOBALS{'export_fieldlist'},"20","100");
    B_COL();
    
    if (strlen(strstr($GLOBALS{'export_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'export_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'export_primetable'};
        $primetablepair = "";
    }
    $tstring = $GLOBALS{$primetable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $fstring = ""; $fsep = "";
    foreach ($tfields as $tfieldelement) {
        $fbits = explode('_',$tfieldelement);
        Check_Data('field',$fbits[0],$fbits[1]);
        if ($GLOBALS{'IOWARNING'} == "0") {
            if ( $GLOBALS{"field_reportname"} != "" ) {
                $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        } else {
            $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
        }
    }
    if ( $primetablepair != "" ) {
        $fstring = $fstring.$fsep."==================="; $fsep = "\n";
        $tstring = $GLOBALS{$primetablepair."^FIELDS"};
        $tfields = explode('|', $tstring);
        foreach ($tfields as $tfieldelement) {
            $fbits = explode('_',$tfieldelement);
            Check_Data('field',$fbits[0],$fbits[1]);
            if ($GLOBALS{'IOWARNING'} == "0") {
                if ( $GLOBALS{"field_exportname"} != "" ) {
                    $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_reportname"}.')'; $fsep = "\n";
                } else {
                    $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
                }
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        }
    }
    
    BCOL("6");
    XH2('Database Fields');
    XTEXTAREANEW("20","100");
    XTXT($fstring);
    X_TEXTAREA();
    B_COL();
    B_ROW();
    XBR();XBR();
    XINSUBMITNAME("final_submit","Update Export Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,export_personidlist,export_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPEXPORTDELETECONFIRM_Output ($export_id) {
    Get_Data("export",$export_id);
    XH3("Delete Export - ".$export_id." - ".$GLOBALS{'export_title'});
    XPTXT("Are you sure you want to delete this export");
    XBR();
    XFORM("exportdeleteaction.php","deleteexport");
    XINSTDHID();
    XINHID("export_id",$export_id);
    XINSUBMIT("Confirm Export Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_REPORTWEBVIEWSETFILTER_Output( $reportexport, $reportexport_id ) {
    
    Get_Data($reportexport,$reportexport_id);
    $reporttitle = $GLOBALS{$reportexport.'_title'};
    $reportdescription = $GLOBALS{$reportexport.'_description'};
    $reportprimetablelist = $GLOBALS{$reportexport.'_primetable'};
    $reportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $reportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $reportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $reportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $reportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    if ( $inreportexport == "export" ) { $reportuploadable = $GLOBALS{$reportexport.'_uploadable'}; }
    else { $reportuploadable = "No"; }
    
    if (strlen(strstr($reportprimetablelist,','))>0) {
        $reportprimetablea = explode(",",$reportprimetablelist);
        $reportprimetable = $reportprimetablea[0];
        $reportprimetablepair = $reportprimetablea[1];
    } else {
        $reportprimetable = $reportprimetablelist;
        $reportprimetablepair = "";
    }
    XH3('Set the filter values for this "browser view"');
    XBR();
    XFORM("reportwebview.php","reportwebview");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    if ($reportselectionlogic != "") {
        FilterTable("PF",$reportselectionlogic);
        XBR();
    }
    if ($reportreferencedselectionlogic != "") {
        FilterTable("RF",$reportreferencedselectionlogic);
        XBR();
    }
    XINSUBMIT("Create Report.");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function FilterTable($PForRF,$thisselectionlogic) {
    $orsep = ""; $ori = 1;
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            XPTXT($orsep);
            XTABLE();
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $selbits0a = explode("_",$selbits[0]);
                $thistable = $selbits0a[0];
                $specialdisplay = "0";
                if ($fi == 1) {$andtext = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {$andtext = "and";}
                if ( $selbits[2] == '?' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXTBACKCOLOR($PForRF.$ori.$fi."_".$selbits[0],"","50","100","LightBlue");X_TR();
                    $specialdisplay = "1";
                }
                if ( $selbits[2] == '??' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);
                    $selectvala = Array();
                    $thistablea = Get_Array($thistable);
                    foreach ( $thistablea as $thistablekey ) {
                        Get_Data($thistable,$thistablekey);
                        array_push($selectvala, $GLOBALS{$selbits[0]});
                    }
                    $selectvala = array_unique($selectvala);
                    sort($selectvala);
                    XTD();
                    foreach ( $selectvala as $selectval) {
                        XINCHECKBOX ($PForRF.$ori.$fi."_".$selbits[0]."[]",$selectval,"",$selectval);XBR();
                    }
                    X_TD();
                    X_TR();
                    $specialdisplay = "1";
                }
                if ( $selbits[2][0] == '[' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDTXTCOLOR($selbits[2],"Red");X_TR();
                    $specialdisplay = "1";
                }
                /*
                 if (strlen(strstr($selbits[0],'{dd/mm/yyyy}'))>0) {
                 XTR();XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);
                 XINDATEID($PForRF.$fi."_".$selbits[0],$PForRF.$fi."_".$selbits[0].'_dd/mm/yyyy',"");
                 X_TR();
                 $specialdisplay = "1";
                 }
                 */
                if ( $specialdisplay == "0" ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXT($PForRF.$ori.$fi."_".$selbits[0],$selbits[2],"50","100");X_TR();
                }
            }
            X_TABLE();
            $orsep = "or";
            $ori++;
        }
    }
}

function Report_REPORTPDFDOWNLOADSETFILTER_Output( $reportexport, $reportexport_id ) {
    
    Get_Data($reportexport,$reportexport_id);
    $reporttitle = $GLOBALS{$reportexport.'_title'};
    $reportdescription = $GLOBALS{$reportexport.'_description'};
    $reportprimetable = $GLOBALS{$reportexport.'_primetable'};
    $reportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $reportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $reportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $reportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $reportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    
    XH3('Set the filter values for this "pdf download"');
    XBR();
    XFORM("reportpdfdownload.php","reportpdfdownload");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    if ($reportselectionlogic != "") {
        FilterTable("PF",$reportselectionlogic);
        XBR();
    }
    if ($reportreferencedselectionlogic != "") {
        FilterTable("RF",$reportreferencedselectionlogic);
        XBR();
    }
    XINSUBMIT("Create Report");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_REPORTWEBVIEW_Output( $reportexport, $reportexport_id, $selectionlogic, $referencedselectionlogic ) {
    
    Get_Data($reportexport,$reportexport_id);
    $reporttitle = $GLOBALS{$reportexport.'_title'};
    $reportdescription = $GLOBALS{$reportexport.'_description'};
    $reportprimetable = $GLOBALS{$reportexport.'_primetable'};
    $reportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $reportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $reportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $reportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $reportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    if ( $inreportexport == "export" ) { $GLOBALS{$reportexport.'_uploadable'}; }
    else { $reportuploadable = "No"; }
    $reportgraphtype = $GLOBALS{$reportexport.'_graphtype'};
    $reportgraphstacked = $GLOBALS{$reportexport.'_graphstacked'};
    $reportgraphcaption = $GLOBALS{$reportexport.'_graphcaption'};
    $reportgraphinverted = $GLOBALS{$reportexport.'_graphinverted'};
    $reportgraphtableparms = $GLOBALS{$reportexport.'_graphtableparms'};
    $reportgraphthparms = $GLOBALS{$reportexport.'_graphthparms'};
    $reportgraphhiderawdata = $GLOBALS{$reportexport.'_graphhiderawdata'};
    
    XH3("Description");
    XPTXT($reportdescription);
    XH3("Settings");
    XPTXT("Prime Table - ".$reportprimetable);
    if ($reportreferencedtablelist != "") {$reftext = $reportreferencedtablelist;} else {$reftext = "None";}
    XPTXT("Other Referenced Tables - ".$reftext);
    
    if ( $selectionlogic != "") { $thisselectionlogic = $selectionlogic; }
    else { $thisselectionlogic = $reportselectionlogic; }
    if ( $referencedselectionlogic != "") { $thisreferencedselectionlogic = $referencedselectionlogic; }
    else { $thisreferencedselectionlogic = $reportreferencedselectionlogic; }
    
    XFORM("reportwebview.php","reportwebview");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    XPTXT("Filters");
    $orsep = ""; $ori = 1;
    $adjustablefiltersfound = "0";
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            XPTXT($orsep);
            XTABLE();
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $specialdisplay = "0";
                if ($fi == 1) {$andtext = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {$andtext = "and";}
                if ( $selbits[2] == '?' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXTBACKCOLOR("PF".$ori.$fi."_".$selbits[0],"","50","100","LightBlue");X_TR();
                    $adjustablefiltersfound = "1"; $specialdisplay = "1";
                }
                if ( $selbits[2][0] == '[' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDTXTCOLOR($selbits[2],"Red");X_TR();
                    $specialdisplay = "1";
                }
                if ( $specialdisplay == "0" ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXT("PF".$ori.$fi."_".$selbits[0],$selbits[2],"50","100");X_TR();
                    $adjustablefiltersfound = "1";
                }
            }
            X_TABLE();
            $orsep = "or";
            $ori++;
        }
    }
    
    $orsep = ""; $ori = 1;
    if ( $thisreferencedselectionlogic != "" ) {
        $multirefsellogica = explodeOR($thisreferencedselectionlogic);
        foreach ($multirefsellogica as $multirefsellogic) {
            $seltesta = explodeAND($multirefsellogic);
            XPTXT($orsep);
            XTABLE();
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $specialdisplay = "0";
                if ($fi == 1) {$andtext = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";} else {$andtext = "and";}
                if ( $selbits[2] == '?' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXTBACKCOLOR("RF".$ori.$fi."_".$selbits[0],"","50","100","LightBlue");X_TR();
                    $adjustablefiltersfound = "1"; $specialdisplay = "1";
                }
                if ( $selbits[2][0] == '[' ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDTXTCOLOR($selbits[2],"Red");X_TR();
                    $specialdisplay = "1";
                }
                if ( $specialdisplay == "0" ) {
                    XTR();XTDTXT($andtext);XTDTXT($selbits[0].ShowFormat($selbits[3]));XTDTXT($selbits[1]);XTDINTXT("RF".$ori.$fi."_".$selbits[0],$selbits[2],"50","100");X_TR();
                    $adjustablefiltersfound = "1";
                }
            }
            X_TABLE();
            $orsep = "or";
            $ori++;
        }
    }
    
    if ( $adjustablefiltersfound == "1" ) {
        XBR();XINSUBMIT("Refresh Filters");
    }
    
    XBR();
    X_FORM();
    if ($reportsortlogic != "") {$sorttext = $reportsortlogic;} else {$sorttext = "None";}
    XBR();XPTXT("Sort - ".$sorttext);
    $primetable = $reportprimetable;
    
    // =======  Generate Report Array ===============
    $ra = GenerateReportArray($reportprimetable,$reportreferencedtablelist,$thisselectionlogic,$thisreferencedselectionlogic,$reportsortlogic,$reportfieldlist);
    // $primetable, $referencedtablelist, $selectionlogic, $referencedselectionlogic, $sortlogic, $fieldlist
    
    // print_r($ra["rdata"]);

    
    // =======  Format the Graph ===============
    if ($reportgraphtype != "") {
        XH3("Graph View.");
        XINHIDID("ReportType","ReportType","report");
        BROW();
        BCOL("3"); BINBUTTONIDSPECIAL("SaveGraphImage","info","Save Graph Image"); B_COL();
        B_ROW();
        // XTXT("gxheader - ");print_r($ra["gxheader"]);XBR();
        // XTXT("gyheader - ");print_r($ra["gyheader"]);XBR();
        // XTXT("gdata - ");print_r($ra["gdata"]);XBR();  
        // Note that this table switches X and Y orientation !!
        
        $extratableparms = $reportgraphtableparms;
        if ($reportgraphinverted == "Yes") {
            $extratableparms = $extratableparms.' data-graph-inverted="1"';
        }
        
        $extrathparms = $reportgraphthparms;
        if ($reportgraphstacked == "Yes") {
            $extrathparms = $extrathparms.' data-graph-stack-group="1" ';
        }
        print '<table class="table highchart" data-graph-container-before="1" '.$extratableparms." ";
        
        if ( $reportgraphtype == "pie" ) { 
            print ' data-graph-datalabels-enabled=1 ';
        }              

        $coli = 1;
        foreach ($ra["gyheader"] as $ykey => $yvalue) {
            if ($yvalue == "Red") { print 'data-graph-color-'.$coli.'="red" ';  }
            if ($yvalue == "Amber") { print 'data-graph-color-'.$coli.'="orange" ';  }
            if ($yvalue == "Green") { print 'data-graph-color-'.$coli.'="green" ';  }
            if ($yvalue == "") { print 'data-graph-color-'.$coli.'="silver" ';  }
            $coli++;
        }
        
        if ( $reportgraphcaption == "" ) { $reportgraphcaption = $reporttitle; }
        print ' data-graph-type="'.$reportgraphtype.'" ';
        print ' >'."\n";
        print '<caption>'.$reportgraphcaption.'</caption>'."\n";
        print '<thead>'."\n";
        print '<tr>'."\n";
        print '<th></th>'."\n";
        
        foreach ($ra["gyheader"] as $ykey => $yvalue) {
            if ($yvalue == "") { print '<th '.$extrathparms.'>None</th>'."\n";  }
            else { print '<th '.$extrathparms.'>'.$yvalue.'</th>'."\n"; }
        }       
        print '</tr>'."\n";
        print '</thead>'."\n";
        print '<tbody>'."\n";        
        
        foreach ($ra["gxheader"] as $xkey => $xvalue) {
            print '<tr>'."\n";
            print '<td>'.$xvalue.'</td>'."\n";           
            foreach ($ra["gyheader"] as $ykey => $yvalue) {               
                $yvalue = $ra["gdata"][$xvalue][$yvalue];               
                // data-graph-name="January" data-graph-item-color="#ccc"
                $color = "";
                if ($xvalue == "Red") { $color = ' data-graph-item-color="red" ';  }
                if ($xvalue == "Amber") { $color = ' data-graph-item-color="orange" ';  }
                if ($xvalue == "Green") { $color = ' data-graph-item-color="green" ';  }
                if ($xvalue == "") { $color = ' data-graph-item-color="silver" ';  }
                $pielabel = "";
                if ( $reportgraphtype == "pie" ) { $pielabel = ' data-graph-name="'.$xvalue.' '.$yvalue.'" '; }               
                print '<td'.$color.$pielabel.'>'.$yvalue.'</td>'."\n";
            }
            print '</tr>'."\n";
        }      
        print '</tbody>'."\n";
        print '</table>'."\n";
        XBR();
        print '<canvas id="myCanvas" width="600" height="600"'."\n";
        print 'style="border:1px solid #c3c3c3;">'."\n";
        print '</canvas>'."\n";   
        print '<img id="myImage" src="../site_assets/NoImage_Flex.png" height="600" >'."\n";
        XINHIDID("report_graphimage","report_graphimage","");
    }
    
    // =======  Format and Show the Report ===============
    if ($reportgraphhiderawdata != "Yes") {
    
        XH3("Report View.");
        $linecounter = 0;
        XDIV("reportdiv","container");
        XTABLEJQDTID("reporttable_report");
        
        // ============ Create Header Row ==============
        XTHEAD();
        XTRJQDT();
        $coloffset = 0;
        $colindex = 0;
        if ( AssocArrayCount($ra["rtable"]) > 0 ) {
            XTDHTXT("Seq");
            $coloffset = 1;
            $colindex++;
        }
        $maxprimeheadingcount = 0;
        $pfi = 0;
        foreach ($ra["pheader"] as $hfield) {
            XTH();
            XTXT($hfield);
            $fieldname = $ra["pfieldname"][$pfi];
            if ( $ra["pfilter"][$pfi] == "Y" ) { XTXT('<i id="filter_'.$colindex.'"class="fa fa-filter reportfilter"></i>'); }
            X_TH();
            $maxprimeheadingcount++;
            $colindex++;
            $pfi++;
        }
        $maxrefheadingcount = 0;
        if (AssocArrayCount($ra["rtable"]) == 1 ) { // show headings on prime heading line
            foreach ($ra["rtable"] as $reftable) {  // Theres only 1 !!
                $rfi = 0;
                foreach ($ra["rheader"][$reftable] as $hfield) {
                    XTH();
                    XTXT($hfield);
                    $fieldname = $ra["pfieldname"][$reftable][$rfi];
                    if ( $ra["pfilter"][$rfi] == "Y" ) { XTXT('<i id="filter_'.$colindex.'"class="fa fa-filter filteroff"></i>'); }
                    X_TH();
                    // $maxprimeheadingcount++; REMOVE
                    $colindex++;
                    $maxrefheadingcount++;
                    $rfi++;
                }
            }
        }
        if (AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines
            foreach ($ra["rtable"] as $reftable) {
                $thiscount = AssocArrayCount($ra["rheader"][$reftable]);
                if ($thiscount > $maxrefheadingcount) { $maxrefheadingcount = $thiscount; }
            }
            for( $i = 0; $i<$maxrefheadingcount; $i++ ) { XTDHTXT(" "); }
        }
        $maxprogramheadingcount = 0;
        foreach ($ra["programheader"] as $hfield) { XTDHTXT(""); $maxprogramheadingcount++; }
        X_TR();
        X_THEAD();
        
        // ============ Create Data Rows ==============
        XTBODY();
        foreach ($ra["pdata"] as $primeid => $valuearray) {
            // ----- first data line relating to this primeid -------------
            XTRJQDT();
            if ( AssocArrayCount($ra["rtable"]) > 0 ) { $linecounter++; XTDTXT($linecounter); }
            foreach ($ra["pdata"][$primeid] as $field) { XTDTXT($field); }
            $reflineusedalready = "0";
            if (AssocArrayCount($ra["rtable"]) == 1 ) { // show first referenced data on prime data line
                $reftable = AssocArrayFirstValue($ra["rtable"]); // only one
                // XPTXT(AssocArrayCount($ra["rtable"])." | ".$reftable." | ".$primeid." | ".AssocArrayCount($ra["rdata"][$reftable][$primeid]));
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    $firstreferencedid = AssocArrayFirstKey($ra["rdata"][$reftable][$primeid]);
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) { // may not be selected
                        foreach ($ra["rdata"][$reftable][$primeid][$firstreferencedid] as $field) { XTDTXT($field); }
                        $reflineusedalready = "1";
                    }
                } else {  // no ref data - pad out
                    for( $i = 0; $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
                }
            } else { // show multi ref table data on separate lines
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
            }
            foreach ($ra["programdata"][$primeid] as $field) { XTDTXT($field); }
            X_TR();
            
            // ----- subsequent data lines relating to this prime id -----------
            foreach ($ra["rtable"] as $reftable) {
                if (AssocArrayCount($ra["rtable"]) > 1 ) {
                    // show heading row before each referenced table section provided there is data
                    if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                        XTRJQDT();
                        if (AssocArrayCount($ra["rtable"]) > 0 ) { $linecounter++; XTDTXT($linecounter); }
                        foreach ($ra["pdata"][$primeid] as $field) { XTDTXTCOLOR($field,"#cccccc"); }
                        if (AssocArrayCount($ra["rtable"]) > 1 ) { // create headings on separate lines
                            foreach ($ra["rheader"][$reftable] as $hfield) { XTDTXTCOLOR("<b>".$hfield."</b>","navy"); }
                            for( $i = AssocArrayCount($ra["rheader"][$reftable]); $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
                        }
                        for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { XTDTXT(""); }
                        X_TR();
                    }
                }
                if (AssocArrayCount($ra["rdata"][$reftable][$primeid]) > 0 ) {
                    foreach($ra["rdata"][$reftable][$primeid] as $referencedid => $v2a) {
                        // ----- show referenced table data row -----------
                        if ($reflineusedalready == "1") {
                            $reflineusedalready = "0";
                        } else {
                            XTRJQDT();
                            if (AssocArrayCount($ra["rtable"]) > 0 ) { $linecounter++; XTDTXT($linecounter); }
                            foreach ($ra["pdata"][$primeid] as $field) { XTDTXTCOLOR($field,"#cccccc"); }
                            $refcount = 0;
                            foreach ($ra["rdata"][$reftable][$primeid][$referencedid] as $field) { XTDTXT($field); $refcount++;}
                            for( $i = $refcount; $i<$maxrefheadingcount; $i++ ) { XTDTXT(""); }
                            for( $i = 0; $i<$maxprogramheadingcount; $i++ ) { XTDTXT(""); }
                            X_TR();
                        }
                    }
                }
            }
        }
        
        $footerrow = "0";
        
        // ===== Counts ===============
        
        if (((AssocArrayFindCount($ra["pcountreqd"],"Y") > 0 )||(AssocArrayFindCount2($ra["rcountreqd"],"Y") > 0 ))) {
            $footerrow = "1";
            X_TBODY();
            XTFOOT();
            XTRJQDT();
            if ( AssocArrayCount($ra["rtable"]) > 0 ) { XTDTXT(""); }
            $fi = 0;
            foreach ($ra["pfieldname"] as $tfieldname) {
                if ( $ra["pcountreqd"][$fi] == "Y" ) {
                    XTDTXTCOLOR ($ra["pcountnumval"][$fi], "blue");
                }
                else { XTDTXT(""); }
                $fi++;
            }
            if (AssocArrayCount($ra["rtable"]) == 1 ) {
                // show counts on single line
                foreach ($ra["rtable"] as $reftable) { // Theres only 1 !!
                    $rfi = 0;
                    foreach ($ra["rfieldname"][$reftable] as $tfieldname) {
                        if ( $ra["rcountreqd"][$reftable][$rfi] == "Y" ) { XTDTXTCOLOR ($ra["rcountnumval"][$reftable][$rfi], "blue"); }
                        else {  XTDTXT(""); }
                        $rfi++;
                    }
                }
            }
            
            if (AssocArrayCount($ra["rtable"]) > 1 ) {
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                    XTDTXT(""); // CHECK - NOT CATERED FOR
                }
            }
            foreach ($ra["programheader"] as $hfield) { XTDTXT(""); }
            X_TR();
            X_TFOOT();
        }
        
        
        // ===== Totals ===============
        
        if (((AssocArrayFindCount($ra["ptotalreqd"],"Y") > 0 )||(AssocArrayFindCount2($ra["rtotalreqd"],"Y") > 0 ))) {
            $footerrow = "1";
            X_TBODY();
            XTFOOT();
            XTRJQDT();
            if ( AssocArrayCount($ra["rtable"]) > 0 ) { XTDTXT(""); }
            $fi = 0;
            foreach ($ra["pfieldname"] as $tfieldname) {
                if ( $ra["ptotalreqd"][$fi] == "Y" ) {
                    // XTDTXT($ra["ptotalformattedval"][$tfieldname]);
                    XTDTXTCOLOR ($ra["ptotalformattedval"][$fi], "blue");
                }
                else { XTDTXT(""); }
                $fi++;
            }
            if (AssocArrayCount($ra["rtable"]) == 1 ) {
                // show totals on single line
                $rfi = 0;
                foreach ($ra["rtable"] as $reftable) {
                    // Theres only 1 !!
                    foreach ($ra["rfieldname"][$rfi] as $tfieldname) {
                        if ( $ra["rtotalreqd"][$rfi] == "Y" ) { XTDTXT($ra["rtotalformattedval"][$rfi]); }
                        else {  XTDTXT(""); }
                    }
                    $rfi++;
                }
            }
            
            if (AssocArrayCount($ra["rtable"]) > 1 ) {
                for( $i = 0; $i<$maxrefheadingcount; $i++ ) {
                    XTDTXT(""); // CHECK - NOT CATERED FOR
                }
            }
            foreach ($ra["programheader"] as $hfield) { XTDTXT(""); }
            X_TR();
            X_TFOOT();
        }
        
        
        
        if ( $footerrow == "0" ) {
            XTFOOT();
            X_TFOOT();
            X_TBODY();
        }
        
        X_TABLE();
        
        X_DIV("reportdiv");
        XCLEARFLOAT();
        
        if ($coloffset == 1) {
            for ($i = 0; $i < count($ra["sortfieldcol"]); $i++) {
                $ra["sortfieldcol"][$i]++;
            }
        }
        XINHID("report_sortcol",Array2List($ra["sortfieldcol"]));
        XINHID("report_sortseq",Array2List($ra["sortfieldseq"]));
    }
    
    $link = YPGMLINK("reportpdfdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport",$reportexport).YPGMPARM("reportexport_id",$reportexport_id);
    $orsep = ""; $ori = 1;
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {          
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("PF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }
    $orsep = ""; $ori = 1;
    if ( $thisreferencedselectionlogic != "" ) {
        $multisellogica = explodeOR($thisreferencedselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("RF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }
    XBR();    
    XLINKTXTNEWWINDOW($link,"download this report as pdf","pdf_view");
    
    $link = YPGMLINK("exportcsvdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport",$reportexport).YPGMPARM("reportexport_id",$reportexport_id);
    
    $orsep = ""; $ori = 1;
    if ( $thisselectionlogic != "" ) {
        $multisellogica = explodeOR($thisselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("PF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }
    $orsep = ""; $ori = 1;
    if ( $thisreferencedselectionlogic != "" ) {
        $multisellogica = explodeOR($thisreferencedselectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest ) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $link = $link.YPGMPARM("RF".$ori.$fi."_".$selbits[0],$selbits[2]);
            }
            $orsep = "or";
            $ori++;
        }
    }  
    XBR();
    XLINKTXTNEWWINDOW($link,"download this report as csv","csv_view");
    FilterPopup();
    
    XTXTID("TRACETEXT","");
}


// ==========================================

function GenerateReportArray( $primetablelist, $referencedtablelist, $selectionlogic, $referencedselectionlogic, $sortlogic, $fieldlist) {
   
    // get field sqldata types
    if ($referencedtablelist != "") { $totaltablelist = $primetablelist.",".$referencedtablelist; }
    else { $totaltablelist = $primetablelist; }
    $totaltablea = List2Array($totaltablelist);
    foreach ($totaltablea as $table) {
        $q = 'SHOW COLUMNS FROM '.$table;
        $r = mysqli_query($GLOBALS{'IOSQL'},$q);
        if (mysqli_num_rows($r) > 0) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                $GLOBALS{$row[0]."_sqldatatype"} = $row[1];
            }
        }
    }
    
    if (strlen(strstr($primetablelist,','))>0) {
        $primetablea = explode(",",$primetablelist);
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $primetablelist;
        $primetablepair = "";
    }
    
    $graphrequired = "0";
    $graphxdynamic = "0"; // X axis created from data
    $graphxdynamicsyntax = ""; // X axis creation syntax
    
    $fieldlist = Replace_CRandLF($fieldlist,"|");
    $fieldlist = str_replace('||', '|', $fieldlist);
    if ( substr($fieldlist, -1) == '|' ) { substr_replace($fieldlist ,"",-1); }
    $fieldsa = explode('|',$fieldlist);
    
    // setup the prime table filters
    // Note that this has now been extended to handle "or" conditions outside the "and" conditions
    $selfieldvaluea = Array();
    $selfieldcompa = Array();
    $selfieldformata = Array();
    $sellogicmax = -1;
    if ( $selectionlogic != "" ) {
        $multisellogica = explodeOR($selectionlogic);
        foreach ($multisellogica as $multisellogic) {
            $sellogicmax++;
            $selfieldvaluea[$sellogicmax] = Array();
            $selfieldcompa[$sellogicmax] = Array();
            $selfieldformata[$sellogicmax] = Array();
            $seltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $seltesta as $seltest) {
                $fi++;
                $selbits = explodeCOMP($seltest);
                $selfieldcompa[$sellogicmax][$fi."_".$selbits[0]] = $selbits[1];
                if ( strlen(strstr($selbits[2],'['))>0 ) {
                    $rbits = explode("[",$selbits[2]);
                    $sbits = explode("]",$rbits[1]);
                    $selfieldvaluea[$sellogicmax][$fi."_".$selbits[0]] = call_user_func($sbits[0]);
                } else {
                    $selfieldvaluea[$sellogicmax][$fi."_".$selbits[0]] = $selbits[2];
                }
                $selfieldformata[$sellogicmax][$fi."_".$selbits[0]] = $selbits[3];
            }
        }
    }
    
    // setup the referenced table filters
    // Note that this has now been extended to handle "or" conditions outside the "and" conditions
    $refselfieldvaluea = Array();
    $refselfieldcompa = Array();
    $refselfieldformata = Array();
    $refsellogicmax = -1;
    if ( $referencedselectionlogic != "" ) {
        $multirefsellogica = explodeOR($referencedselectionlogic);
        foreach ($multirefsellogica as $multirefsellogic) {
            $refsellogicmax++;
            $refselfieldvaluea[$refsellogicmax] = Array();
            $refselfieldcompa[$refsellogicmax] = Array();
            $refselfieldformata[$refsellogicmax] = Array();
            $refseltesta = explodeAND($multisellogic);
            $fi = 0;
            foreach ( $refseltesta as $refseltest) {
                $fi++;
                $selbits = explodeCOMP($refseltest);
                $refselfieldcompa[$refsellogicmax][$fi."_".$selbits[0]] = $selbits[1];
                if ( strlen(strstr($selbits[2],'['))>0 ) {
                    $rbits = explode("[",$selbits[2]);
                    $sbits = explode("]",$rbits[1]);
                    $refselfieldvaluea[$refsellogicmax][$fi."_".$selbits[0]] = call_user_func($sbits[0]);
                } else {
                    $refselfieldvaluea[$refsellogicmax][$fi."_".$selbits[0]] = $selbits[2];
                }
                $refselfieldformata[$refsellogicmax][$fi."_".$selbits[0]] = $selbits[3];
            }
        }
    }
    
    // ========== Define Report Arrays ===================
    
    $ra = Array();
    $ra["pfieldname"] = Array();			// fields to be reported from prime table - (by pfieldname)
    $ra["pheader"] = Array();				// header values for prime table fields - (by pfieldname)
    $ra["pfilter"] = Array();				// filter for prime table fields - (by pfieldname)
    $ra["pdata"] = Array();					// prime data value [primeid](by pfieldname)
    $ra["pformat"] = Array();				// display format - [by pfieldname]
    $ra["ptotalreqd"] = Array();			// totals reqd for prime table fields - [by pfieldname]
    $ra["ptotalnumval"] = Array();			// numeric totals prime table fields - [by pfieldname]
    $ra["ptotalformattedval"] = Array();	// formatted totals prime table fields - [by pfieldname]
    $ra["pcountreqd"] = Array();			// counts reqd for prime table fields - [by pfieldname]
    $ra["pcountnumval"] = Array();			// count totals prime table fields - [by pfieldname]
    $ra["pgraphxsyntax"] = Array();			// graph x syntax - [by pfieldname]
    $ra["pgraphysyntax"] = Array();			// graph y syntax - [by pfieldname]
    $ra["rtable"] = Array();				// referenced tables
    $ra["rfieldlistelement"] = Array();		// origibal fieldlist element
    $ra["rfieldname"] = Array();			// fields to be reported from referenced table - [referencedtable](by rfieldname) - can have multiple referenced tables
    $ra["rheader"] = Array();				// header values for referenced table fields - [referencedtable](by rfieldname)
    $ra["rfilter"] = Array();				// filter for referenced table fields - [referencedtable]
    $ra["rrootkey"] = Array();				// rootkeyfields for referenced tables - [referencedtable]
    $ra["rdata"] = Array();					// referenced data values [referencedtable][primeid][referencedid](by fieldvalue)
    $ra["rformat"] = Array();				// display format - [referencedtable](by rfieldname)
    $ra["rtotalreqd"] = Array();			// totals reqd for referenced table fields - [referencedtable](by rfieldname)
    $ra["rtotalnumval"] = Array();			// numeric totals referenced table fields - [referencedtable](by rfieldname)
    $ra["rtotalformattedval"] = Array();	// formatted totals referenced table fields - [referencedtable](by rfieldname)
    $ra["rcountreqd"] = Array();			// counts reqd for referenced table fields - [referencedtable][by pfieldname]
    $ra["rcountnumval"] = Array();			// count totals referenced table fields - [referencedtable][by pfieldname]
    $ra["programsyntax"] = Array();			// program syntax - (syntax)
    $ra["programheader"] = Array();			// header values for program fields - (programfieldheader)
    $ra["programdata"] = Array();			// program data value [primeid](fieldvalue)
    $ra["sortfieldcol"] = Array();		    // sortfield column 0 -> X
    $ra["sortfieldseq"] = Array();		    // sortfield sequences asc/desc
    $ra["gxheader"] = Array();				// graphtable xaxis headers
    $ra["gyheader"] = Array();				// graphtable yaxis headers
    $ra["gdata"] = Array();					// graphtable values [xval][yval]
    
    $tablecolcounter = 0;
    $fieldnamesa = Array();
    foreach ($fieldsa as $tfield) {
        if ($tfield != "") {
            if ( DF($tfield,"Type") == "startreflist" ) {
                array_push($ra["rtable"], DF($tfield,"RefTable"));
                $ra["rfieldlistelement"][DF($tfield,"RefTable")] = Array();
                $ra["rfieldname"][DF($tfield,"RefTable")] = Array();
                $ra["rheader"][DF($tfield,"RefTable")] = Array();
                $ra["rfilter"][DF($tfield,"RefTable")] = Array();
                $ra["rformat"][DF($tfield,"RefTable")] = Array();
                $ra["rdata"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalnumval"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalformattedval"][DF($tfield,"RefTable")] = Array();
                $ra["rcountreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rcountnumval"][DF($tfield,"RefTable")] = Array();
            }
            if ( DF($tfield,"Type") == "startreflookup" ) {
                array_push($ra["rtable"], DF($tfield,"RefTable"));
                $ra["rfieldlistelement"][DF($tfield,"RefTable")] = Array();
                $ra["rfieldname"][DF($tfield,"RefTable")] = Array();
                $ra["rheader"][DF($tfield,"RefTable")] = Array();
                $ra["rfilter"][DF($tfield,"RefTable")] = Array();
                $ra["rformat"][DF($tfield,"RefTable")] = Array();
                $ra["rdata"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalnumval"][DF($tfield,"RefTable")] = Array();
                $ra["rtotalformattedval"][DF($tfield,"RefTable")] = Array();
                $ra["rcountreqd"][DF($tfield,"RefTable")] = Array();
                $ra["rcountnumval"][DF($tfield,"RefTable")] = Array();
            }
            if ( DF($tfield,"Type") == "field" ) {
                if (( DF($tfield,"Table") == $primetable )||( DF($tfield,"Table") == $primetablepair )) {
                    array_push($ra["pfieldname"], DF($tfield,"Field"));
                    array_push($ra["pheader"], DF($tfield,"Title"));
                    array_push($ra["pformat"], DF($tfield,"FieldFormat"));
                    array_push($ra["pfilter"], DF($tfield,"Filter"));
                    array_push($ra["ptotalreqd"], DF($tfield,"Total"));
                    array_push($ra["ptotalnumval"], 0);
                    array_push($ra["ptotalformattedval"], "");
                    array_push($ra["pcountreqd"], DF($tfield,"Count"));
                    array_push($ra["pcountnumval"], 0);
                    array_push($ra["pgraphxsyntax"], DF($tfield,"GraphXSyntax"));
                    array_push($ra["pgraphysyntax"], DF($tfield,"GraphYSyntax"));
                    $xsyntax = DF($tfield,"GraphXSyntax");
                    if ( $xsyntax != "" ) {
                        $graphrequired = "1";                        
                        if ((DF($xsyntax,"GraphXSyntax") == "X:")||(DF($xsyntax,"GraphXSyntax") == "X:TITLE")) {
                            array_push($ra["gxheader"], DF($tfield,"Title"));
                        } else {
                            $graphxdynamic = "1";
                            $graphxdynamicsyntax = $xsyntax;
                        }
                    }                    
                } else {
                    array_push($ra["rfieldlistelement"][DF($tfield,"Table")], $tfield);
                    array_push($ra["rfieldname"][DF($tfield,"Table")], DF($tfield,"Field"));
                    array_push($ra["rheader"][DF($tfield,"Table")], DF($tfield,"Title"));
                    array_push($ra["rformat"][DF($tfield,"Table")], DF($tfield,"FieldFormat"));
                    array_push($ra["rfilter"][DF($tfield,"Table")], DF($tfield,"Filter"));
                    array_push($ra["rtotalreqd"][DF($tfield,"Table")], DF($tfield,"Total"));
                    array_push($ra["rtotalnumval"][DF($tfield,"Table")], 0);
                    array_push($ra["rtotalformattedval"][DF($tfield,"Table")], "");
                    array_push($ra["rcountreqd"][DF($tfield,"Table")], DF($tfield,"Count"));
                    array_push($ra["rcountnumval"][DF($tfield,"Table")], 0);
                }
                $tablecolcounter++;
            }
            if ( DF($tfield,"Type") == "programlink" ) {
                array_push($ra["programsyntax"], $tfield);
                array_push($ra["programheader"], "");
            }
            array_push($fieldnamesa, DF($tfield,"Field"));
        }
    }
    
    // print_r($ra["pgraphxsyntax"]);XBR();XPTXT("=====");
    // print_r($ra["pgraphysyntax"]);XBR();XPTXT("=====");
    // print_r($ra["gxheader"]);
    
    // =======  Stage 1: Select and then sort by prime table ===============
    // sort syntax
    // field 1
    // (field1)
    // (field1=desc)
    // (field1)(field2)(field3)
    // (field1=asc)(field2=asc)(field3=desc)
    if ($sortlogic != "" ) {
        $sortlogic = str_replace('==', "=", $sortlogic);
        $sortlogic = str_replace('=ASC', "=asc", $sortlogic);
        $sortlogic = str_replace('=DESC', "=desc", $sortlogic);
        $sortfieldnamea = Array();
        $sortfieldseqa = Array();
        $sortformata = Array();
        if (strlen(strstr($sortlogic,'('))>0) {
            $tbits = explode('(',$sortlogic);
            foreach ( $tbits as $tbit) {
                if ($tbit != "") {
                    $ubits = explode(')',$tbit);
                    $sfieldsyntax = $ubits[0];
                    if (strlen(strstr($sfieldsyntax,'='))>0) {
                        $wbits = explode('=',$sfieldsyntax);
                        if (strlen(strstr($wbits[0],'{'))>0) {
                            $bitsa = explode('{',$wbits[0]);
                            $bitsb = explode('}',$bitsa[1]);
                            array_push($sortfieldnamea, $bitsa[0]);
                            array_push($sortformata, $bitsb[0]);
                            array_push($sortfieldseqa, $wbits[1]);
                            array_push($ra["sortfieldcol"], array_search($bitsa[0], $fieldnamesa));
                            array_push($ra["sortfieldseq"], $wbits[1]);
                            
                        } else {
                            array_push($sortfieldnamea, $wbits[0]);
                            array_push($sortformata, "");
                            array_push($sortfieldseqa, $wbits[1]);
                            array_push($ra["sortfieldcol"], array_search($wbits[0], $fieldnamesa));
                            array_push($ra["sortfieldseq"], $wbits[1]); 
                        }
                    } else {
                        if (strlen(strstr($sfieldsyntax,'{'))>0) {
                            $bitsa = explode('{',$sfieldsyntax);
                            $bitsb = explode('}',$bitsa[1]);
                            array_push($sortfieldnamea, $bitsa[0]);
                            array_push($sortformata, $bitsb[0]);
                        } else {
                            array_push($sortfieldnamea, $sfieldsyntax);
                            array_push($sortformata, "");
                        }
                        array_push($sortfieldseqa, "asc");
                        array_push($ra["sortfieldcol"], array_search($sfieldsyntax, $fieldnamesa));
                        array_push($ra["sortfieldseq"], "asc");
                    }
                }
            }
        } else {
            if (strlen(strstr($sortlogic,'='))>0) {
                $wbits = explode('=',$sortlogic);
                array_push($sortfieldnamea, $wbits[0]);
                array_push($sortfieldseqa, $wbits[1]);
                array_push($ra["sortfieldcol"], array_search($wbits[0], $fieldnamesa));
                array_push($ra["sortfieldseq"], $wbits[1]);
            } else {
                array_push($sortfieldnamea, $sortlogic);
                array_push($sortfieldseqa, "asc");
                array_push($ra["sortfieldcol"], array_search($sortlogic, $fieldnamesa));
                array_push($ra["sortfieldseq"], "asc");
            }
        }
    } else {
        // no sort logic
        array_push($ra["sortfieldcol"], 0);
        array_push($ra["sortfieldseq"], "asc");
    }
    
    // Note that selection has now been extended to handle "or" conditions outside the "and" conditions
    $primetableida = Get_NKey_Array($primetable);
    $sortselecteda = Array();
    foreach ( $primetableida as $primetableid) {
        $ida = explode('|',$primetableid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); }
        if ( $primetablepair != "" ) {
            if ($GLOBALS{$primetablepair."^KEYS"} == "2") { Get_Data($primetablepair,$ida[0]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "3") { Get_Data($primetablepair,$ida[0],$ida[1]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "4") { Get_Data($primetablepair,$ida[0],$ida[1],$ida[2]); }
        }
        $multiselected = "1";
        if ( $selectionlogic != "" ) {
            $multiselected = "0";
            for ( $sellogici = 0; $sellogici<=$sellogicmax; $sellogici++ ) {
                $selected = "1";
                foreach($selfieldvaluea[$sellogici] as $k => $v) {
                    $kbits = explode("_",$k);
                    $kfield = $kbits[1]."_".$kbits[2];
                    $selected = ReSelection($selected,$kfield,$selfieldcompa[$sellogici][$k],$v,$selfieldformata[$sellogici][$k]);
                }
                if ( $selected == "1" ) { $multiselected = "1"; }
            }
        }
        if ($sortlogic == "" ) { $sortfieldvalue = ""; }
        else {
            if ( count($sortfieldnamea) == 1) { $sortfieldvalue = ReFormat($sortfieldnamea[0],$GLOBALS{$sortfieldnamea[0]},$sortformata[0]); }
            if ( count($sortfieldnamea) == 2) { $sortfieldvalue = ReFormat($sortfieldnamea[0],$GLOBALS{$sortfieldnamea[0]},$sortformata[0])."|".ReFormat($sortfieldnamea[1],$GLOBALS{$sortfieldnamea[1]},$sortformata[1]);  }
            if ( count($sortfieldnamea) == 3) { $sortfieldvalue = ReFormat($sortfieldnamea[0],$GLOBALS{$sortfieldnamea[0]},$sortformata[0])."|".ReFormat($sortfieldnamea[1],$GLOBALS{$sortfieldnamea[1]},$sortformata[1])."|".ReFormat($sortfieldnamea[2],$GLOBALS{$sortfieldnamea[2]},$sortformata[2]);  }
        }
        if ($multiselected == "1") { array_push($sortselecteda, $sortfieldvalue."^".$primetableid); }
    }
    
    if ($sortlogic != "" ) {
        if ($sortfieldseqa[0] == "desc") {
            rsort($sortselecteda);
        } else {
            sort($sortselecteda);
        }
    }
    
    // =======  Stage 2: Populate the report Arrays ===============
    $referencedtable = "";
    $referencedtableida = Array();
    foreach ( $sortselecteda as $sortelement) {
        $sbits = explode("^",$sortelement);
        $primeid = $sbits[1];
        $ra["pdata"][$primeid] = Array();
        foreach ($ra["rtable"] as $reftable => $valuearray) {
            $ra["rdata"][$reftable][$primeid] = Array();
        }
        $ra["programdata"][$primeid] = Array();
        $sida = explode('|',$primeid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$sida[0]); }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$sida[0],$sida[1]); }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$sida[0],$sida[1],$sida[2]); }
        if ( $primetablepair != "" ) {
            if ($GLOBALS{$primetablepair."^KEYS"} == "2") { Get_Data($primetablepair,$sida[0]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "3") { Get_Data($primetablepair,$sida[0],$sida[1]); }
            if ($GLOBALS{$primetablepair."^KEYS"} == "4") { Get_Data($primetablepair,$sida[0],$sida[1],$sida[2]); }
        }
        
        // Scan the field list - set up the main arrays and populate data for the prime fields
        $xgraphkey = "";
        $ygraphvala = Array();        
        $fi = 0;
        foreach ($fieldsa as $tfield) {
            $graphxkey = "";
            $graphykey = "";
            if ($tfield != "") {
                if ( DF($tfield,"Type") == "startreflist" ) {	// get the ids referenced table from a list
                    $referencedtable = DF($tfield,"RefTable");
                    $ra["rdata"][$referencedtable][$primeid] = Array();
                    $referencedtablerootkeya = DF($tfield,"RefRootKeyArray"); // CHECK returns null in this version
                    $ra["rrootkey"][$referencedtable] = $referencedtablerootkeya;
                    $referencedtableida = explode(',',$GLOBALS{DF($tfield,"RefKeyList")});
                    foreach ( $referencedtableida as $referencedtableid ) {
                        $ra["rdata"][$referencedtable][$primeid][$referencedtableid] = Array();
                    }
                    $referencedtablerootkeya= Array(); // no rootkeys required if not table lookup
                }
                if ( DF($tfield,"Type") == "endreflist" ) {  // empty array of ids for referenced table
                    $referencedtable = "";
                    $referencedtableida = Array();
                }
                if ( DF($tfield,"Type") == "startreflookup" ) {	// get the ids referenced table by scanning database
                    $referencedtable = DF($tfield,"RefTable");
                    $ra["rdata"][$referencedtable][$primeid] = Array();
                    $referencedtablerootkeya = DF($tfield,"RefRootKeyArray");
                    // foreach ( $referencedtablerootkeya as $referencedtablerootkey ) { XH1($referencedtablerootkey); }
                    $ra["rrootkey"][$referencedtable] = $referencedtablerootkeya;
                    if (count($referencedtablerootkeya) == 0) { $referencedtableida = Get_Array($referencedtable); }
                    if (count($referencedtablerootkeya) == 1) { $referencedtableida = Get_Array($referencedtable,$GLOBALS{$referencedtablerootkeya[0]}); }
                    if (count($referencedtablerootkeya) == 2) { $referencedtableida = Get_Array($referencedtable,$GLOBALS{$referencedtablerootkeya[0]},$GLOBALS{$referencedtablerootkeya[1]}); }
                    foreach ( $referencedtableida as $referencedtableid ) {
                        $ra["rdata"][$referencedtable][$primeid][$referencedtableid] = Array();
                    }
                }
                if ( DF($tfield,"Type") == "endreflookup" ) {	// empty array of ids for referenced table
                    $referencedtable = "";
                    $referencedtableida = Array();
                }
                if ( DF($tfield,"Type") == "field" ) { // populate data from the prime fields
                    $fbits = explode("_",$tfield);
                    if (($fbits[0] == $primetable)||($fbits[0] == $primetablepair)) {
                        // ---- prime field -----
                        array_push($ra["pdata"][$primeid], DF($tfield,"FieldFormattedValue"));
                        // ---- totals and counts -----
                        if ( $ra["ptotalreqd"][$fi] == "Y" ) {
                            $ra["ptotalnumval"][$fi] = $ra["ptotalnumval"][$fi] + DF($tfield,"TotalIncrValue");
                            $ra["ptotalformattedval"][$fi] = fieldFormat($ra["ptotalnumval"][$fi], $ra["pformat"][$fi]);
                            // $ra["ptotalformattedval"][$fi] = $ra["ptotalnumval"][$fi];
                        } else {
                            $ra["ptotalnumval"][$fi] = 0;
                            $ra["ptotalformattedval"][$fi] = "";
                        }
                        if ( $ra["pcountreqd"][$fi] == "Y" ) {
                            $ra["pcountnumval"][$fi] = $ra["pcountnumval"][$fi] + DF($tfield,"CountIncrValue");
                        } else {
                            $ra["pcountnumval"][$fi] = 0;
                        }
                        // ---- graph data -----
                        if ( $ra["pgraphxsyntax"][$fi] != "" ) {
                            if (substr($ra["pgraphxsyntax"][$fi],0,2) == "X:") {
                                // $graphxkey = GraphXKey(DF($tfield,"FieldValue"),$ra["pgraphxsyntax"][$fi],$ra["pheader"][$fi]); 
                                $graphxkey = GraphXYKey($ra["pheader"][$fi],DF($tfield,"FieldValue"),$ra["pgraphxsyntax"][$fi]); 
                            }
                        }
                        if ( $ra["pgraphysyntax"][$fi] != "" ) {
                            if (substr($ra["pgraphysyntax"][$fi],0,2) == "Y:") {
                                // $graphykey = GraphYKey(DF($tfield,"FieldValue"),$ra["pgraphysyntax"][$fi]);
                                $graphykey = GraphXYKey($ra["pheader"][$fi],DF($tfield,"FieldValue"),$ra["pgraphysyntax"][$fi]);
                                $graphyval = DF($tfield,"FieldValue");
                            }
                        }
                    }
                }
                // populate graphical array for this field in the database record
                if ( $graphxkey != "" ) {
                    // XPTXTCOLOR($graphxkey." ".$graphykey,"orange");
                    if (array_key_exists($graphxkey, $ra["gdata"])) {} else { $ra["gdata"][$graphxkey] = Array(); }
                    if (array_key_exists($graphykey, $ra["gdata"][$graphxkey])) {} else { $ra["gdata"][$graphxkey][$graphykey] = ""; }
                    if (in_array($graphxkey, $ra["gxheader"])) {} else {
                        array_push($ra["gxheader"], $graphxkey);
                    }
                    if (in_array($graphykey, $ra["gyheader"])) {} else {
                        array_push($ra["gyheader"], $graphykey);  
                    }
                    $ra["gdata"][$graphxkey][$graphykey] = GraphYVal($ra["gdata"][$graphxkey][$graphykey],$graphyval,$ra["pgraphysyntax"][$fi]);
                }
                $fi++;
            }
        }
        
        $refselectioncount = 0;
        // populate data for the referenced tables
        // Note that selection has now been extended to handle "or" conditions outside the "and" conditions
        foreach ($ra["rtable"] as $reftable) {
            $rfi = 0;
            foreach($ra["rdata"][$reftable][$primeid] as $reftableid => $vxx) {
                $reftablerootkeya = $ra["rrootkey"][$reftable];
                if (count($reftablerootkeya) == 0) { Check_Data($reftable,$reftableid); }
                if (count($reftablerootkeya) == 1) { Check_Data($reftable,$GLOBALS{$reftablerootkeya[0]},$reftableid); }
                if ($GLOBALS{'IOWARNING'} == "0") {
                    $multirefselected = "1";
                    if ( $referencedselectionlogic != "" ) {
                        $multirefselected = "0";
                        for ( $refsellogici = 0; $refsellogici<=$refsellogicmax; $refsellogici++ ) {
                            $refselected = "1";
                            foreach($refselfieldvaluea[$refsellogici] as $k => $v) {
                                $kbits = explode("_",$k);
                                $kfield = $kbits[1]."_".$kbits[2];
                                $selected = ReSelection($selected,$kfield,$refselfieldcompa[$refsellogici][$k],$v,$refselfieldformata[$refsellogici][$k]);
                            }
                            if ( $refselected == "1" ) { $multirefselected = "1"; }
                        }
                    }
                    if ($multirefselected == "1") {
                        // XPTXT("SELECTED ".$reftableid);
                        $refselectioncount++;
                        $rfi = 0;
                        foreach ($ra["rfieldname"][$reftable] as $reffieldname) {
                            array_push($ra["rdata"][$reftable][$primeid][$reftableid], DF($ra["rfieldlistelement"][$reftable][$rfi],"FieldFormattedValue"));
                            if ( $ra["rtotalreqd"][$reftable][$rfi] == "Y" ) {
                                $ra["rtotalnumval"][$reftable][$rfi] = $ra["rtotalnumval"][$reftable][$rfi] + DF($ra["rfieldlistelement"][$reftable][$rfi],"TotalIncrValue");
                                $ra["rtotalformattedval"][$rfi] = fieldFormat($ra["rtotalnumval"][$rfi], $ra["rformat"][$rfi]);
                                // CHECK if fieldFormat required
                            } else {
                                $ra["rtotalnumval"][$reftable][$rfi] = 0;
                                $ra["rtotalformattedval"][$reftable][$rfi] = "";
                            }
                            if ( $ra["rcountreqd"][$reftable][$rfi] == "Y" ) {
                                $ra["rcountnumval"][$reftable][$rfi] = $ra["rcountnumval"][$reftable][$rfi] + DF($ra["rfieldlistelement"][$reftable][$rfi],"CountIncrValue");
                            } else {
                                $ra["rcountnumval"][$reftable][$rfi] = 0;
                            }
                            $rfi++;
                        }
                    } else { // remove non selected rows
                        // XPTXT("DROPPED ".$reftableid);
                        unset($ra["rdata"][$reftable][$primeid][$reftableid]);
                    }
                }
                $rfi++;
            }
        }
        
        $primetableshow = "1";
        // remove prime table entries if required referenced table selection fails
        if ( count($refselfieldvaluea) > 0  ) {
            if ( $refselectioncount == 0 ) {
                unset($ra["pdata"][$primeid]);
                $primetableshow = "0";
            }
        }
        
        if ( $primetableshow == "1" ) {
            // populate data for the program links
            foreach ($ra["programsyntax"] as $tsyntax) {
                $link = YPGMLINK(DF($tsyntax,"ProgramName").".php").YPGMSTDPARMS();
                $windowname = "";
                foreach (DF($tsyntax,"ProgramKeyArray") as $programkey) {
                    $link = $link.YPGMPARM($programkey,$GLOBALS{$programkey});
                    $windowname = $windowname.$GLOBALS{$programkey};
                }
                array_push($ra["programdata"][$primeid], YCLASSLINKTXTNEWWINDOW('updatelink',$link,DF($tsyntax,"LinkText"),$windowname));
                // array_push($ra["programdata"][$primeid], YCLASSLINKTXTNEWWINDOW('updatelink',$link,"XXXXX",$windowname));
            }
        }
    }
    
    if ( $graphxdynamic == "1" ) { 
        if ( $graphxdynamicsyntax == "X:FOREACHyyyy") {
            $gxheadera = Array();
            $cleangxheadera = Array();
            $finalgxheadera = Array();
            foreach ($ra["gxheader"] as $xkey => $xvalue) {
                array_push($gxheadera, $xvalue);
                if (($xvalue > "1900")&&($xvalue < "2100")) {
                    array_push($cleangxheadera, $xvalue);
                }
            }
            sort($cleangxheadera);
            // XH2("cleangxheadera"); print_r($cleangxheadera);
            $firstyyyy = $cleangxheadera[0];
            $lastyyyy = end($cleangxheadera);
            for ( $yyyyi=(int)$firstyyyy; $yyyyi<=(int)$lastyyyy; $yyyyi++) {
                array_push($finalgxheadera, strval($yyyyi));            
            }
            $ra["gxheader"] = $finalgxheadera;
            // XH2("finalgxheadera"); print_r($finalgxheadera);
            foreach ($finalgxheadera as $yyyy) {
                if (array_key_exists($yyyy, $ra["gdata"])) {} else { 
                    $ra["gdata"][$yyyy] = Array(); 
                    $ra["gdata"][$yyyy]["All"] = "0";
                }
            }
            // print_r($ra["gxheader"]);
        }
    }
    
    /*
     print_r($ra["rcountnumval"]);XBR();
     print_r($ra["pcountreqd"]);XBR();
     print_r($ra["pcountnumval"]);
     XTXT("pformat - ");print_r($ra["pformat"]);XBR();
     XTXT("rformat - ");print_r($ra["rformat"]);XBR();
     XTXT("gheader - ");print_r($ra["gxheader"]);XBR();
     XTXT("gdata - ");print_r($ra["gdata"]);XBR();
     */    
    return $ra;
    
}

function GraphXYKey ($title, $value, $syntax ) {  
    /*

    Fieldname[X:FORALL]
    Fieldname[X:FOREACH]
    Fieldname[X:FOREACHmm]
    Fieldname[X:FOREACHqtr]
    Fieldname[X:FOREACHyyyy]
    
    Fieldname[Y:FORALL:COUNT]
    Fieldname[Y:FORALL:SUM]
    Fieldname[Y:FOREACH:COUNT]
    Fieldname[Y:FOREACH:SUM]
    Fieldname[Y:FOREACHotherfieldname:COUNT]
    Fieldname[Y:FOREACHotherfieldname:SUM]    
    */
    $sbits = explode(":",$syntax.":::");
    $axis = $sbits[0];
    $keygroup = $sbits[1];
    $action = $sbits[2];
    $graphxykey = "";
    
    if (strlen(strstr($keygroup,"FOREACH"))>0) { $ruletype = "FOREACH"; }  
    if ($keygroup == "FORALL") { $ruletype = "FORALL"; }
    
    if ( $ruletype == "FOREACH" ) {
        if (strlen(strstr($keygroup,'_'))>0) { 
            // special situation - another field is involved
            $otherfieldname = str_replace("FOREACH","",$sbits[1]);
            $graphxykey = $GLOBALS{$otherfieldname};
        } else {
            // normal situation this field value  returned
            $rulefound = "0";
            if (( $keygroup == "FOREACH" )&&( $rulefound == "0" )) {
                $graphxykey = $graphykey = $value;
            }
            if (( $keygroup == "FOREACHyyyy" )&&( $rulefound == "0" )) {
                $graphxykey = substr($value,0,4);
            }
            if (( $keygroup == "FOREACHmm" )&&( $rulefound == "0" )) {
                $graphxykey = substr($value,2,2).substr($value,6,2);
            }
            if (( $keygroup == "FOREACHqtr" )&&( $rulefound == "0" )) {
                $mmi = (int)substr($value,6,2);
                $qtr = "";
                if ($mmi > 0) { $qtr = "Q1"; }
                if ($mmi > 3) { $qtr = "Q2"; }
                if ($mmi > 6) { $qtr = "Q3"; }
                if ($mmi > 9) { $qtr = "Q4"; }
                $graphxykey = substr($value,2,2).$qtr;
            }
        }
    }
    
    if ( $ruletype == "FORALL" ) {
        $graphxykey = $title;
    }
    
    // $colour = "green";
    // if ( $axis == "Y" ) { $colour = "red"; }
    // XPTXTCOLOR($axis." ".$value." ".$syntax." ==> ".$graphxykey,$colour);
    return $graphxykey;
}

function GraphYVal ($oldvalue, $thisvalue, $graphysyntax) {
    $graphyval = "";    
    if (strlen(strstr($graphysyntax,":COUNT"))>0) { $graphyval = $oldvalue + 1; }
    if (strlen(strstr($graphysyntax,":VALUE"))>0) { $graphyval = $thisvalue; }
    if (strlen(strstr($graphysyntax,":SUM"))>0) { $graphyval = $oldvalue + $thisvalue; }
    // XPTXTCOLOR("GraphYVal"."|".$oldvalue."|".$thisvalue."|".$graphysyntax." ==> ".$graphyval,"green");    
    return $graphyval;
}


// ============================================

function AssocArrayFirstKey ($mdaa) {
    // this seems to be required rather than key if searching at middle level of MultiDimensional Associative Array !
    $firstkey = "";
    if (in_array(null, $mdaa)) {}
    else {
        foreach($mdaa as $k => $v) {
            if ( $firstkey == "" ) { $firstkey = $k; }
        }
    }
    return $firstkey;
}


function AssocArrayFirstValue ($mdaa) {
    // this seems to be required rather than key if searching at middle level of MultiDimensional Associative Array !
    $firstvalue = "";
    if (in_array(null, $mdaa)) {}
    else {
        foreach($mdaa as $k => $v) {
            if ( $firstvalue == "" ) { $firstvalue = $v; }
        }
    }
    return $firstvalue;
}

function AssocArrayCount ($mdaa) {
    // this seems to be required rather than key if counting at middle level of MultiDimensional Associative Array !
    $count = 0;
    if (in_array(null, $mdaa)) {}
    else {
        foreach($mdaa as $k => $v) {
            $count++;
        }
    }
    return $count;
}

function AssocArrayFindCount ($mdaa,$findstring) {
    // this seems to be required rather than key if counting at middle level of MultiDimensional Associative Array !
    $count = 0;
    foreach($mdaa as $k => $v) {
        // XPTXT($k." ".$v." ".$mdaa[$k]." ".$mdaa[$k]);
        if ( $mdaa[$k] == $findstring ) { $count++; }
    }
    return $count;
}

function AssocArrayFindCount2 ($mdaa,$findstring) {
    // this seems to be required rather than key if counting at middle level of MultiDimensional Associative Array !
    $count = 0;
    foreach($mdaa as $k => $v) {
        foreach($mdaa[$k] as $k2 => $v2) {
            if ( $mdaa[$k][$k2] == $findstring ) { $count++; }
        }
    }
    return $count;
}


function Report_MPDFREPORTKEYLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MPDFREPORTKEYLIST_Output( $mpdfreport_id ) {
    Get_Data('mpdfreport',$mpdfreport_id);
    if (strlen(strstr($GLOBALS{'mpdfreport_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'mpdfreport_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'mpdfreport_primetable'};
        $primetablepair = "";
    }
    
    XDIV("mpdfreport_tablecontainer","container");
    XTABLEJQDTID("reporttable_mpdfreport");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    X_TR();
    X_THEAD();
    XTBODY();
    
    $primetableida = Get_NKey_Array($primetable);
    foreach ( $primetableida as $primetableid) {
        $ida = explode('|',$primetableid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); $keyvaluelist = $ida[0]; }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); $keyvaluelist = $ida[0].','.$ida[1]; }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); $keyvaluelist = $ida[0].','.$ida[1].','.$ida[2]; }
        if ( $primetablepair != "" ) {
            if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetablepair,$ida[0]); }
            if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetablepair,$ida[0],$ida[1]); }
            if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetablepair,$ida[0],$ida[1],$ida[2]); }
        }
        
        XTRJQDT();
        XTDTXT($primetableid);
        $tfa = explode(',',$GLOBALS{'mpdfreport_listkeytitlefields'});
        $titlefield = ""; $sep = "";
        foreach ( $tfa as $tfelement) {
            $titlefield = $titlefield.$sep.$GLOBALS{$tfelement};
            $sep = " ";
        }
        XTDTXT($titlefield);
        $link = YPGMLINK("mpdfreportwebview.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
        XTDLINKTXTNEWWINDOW($link,"view","view");
        $link = YPGMLINK("mpdfreportpdfdownload.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
        XTDLINKTXTNEWWINDOW($link,"download","pdfview");
        $link = YPGMLINK("mpdfreportcsvdownload.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
        XTDLINKTXTNEWWINDOW($link,"download","csv");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreport_tablecontainer");
    XCLEARFLOAT();
}

function Report_MPDFREPORTWEBVIEWSETFILTER_Output( $mpdfreport_id ) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Set the filter values for this custom report..");
    // XPTXT($GLOBALS{'mpdfreport_selectionlogic'});
    XBR();
    XFORM("mpdfreportwebview.php","mpdfreportwebview");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    if ($GLOBALS{'mpdfreport_selectionlogic'} != "") {
        // XH3($GLOBALS{'mpdfreport_selectionlogic'});
        FilterTable("PF",$GLOBALS{'mpdfreport_selectionlogic'});
        XBR();
    }
    // CHECK No referenced table filter capability
    XBR();
    XINSUBMIT("Create Report.");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_MPDFREPORTPDFDOWNLOADSETFILTER_Output( $mpdfreport_id ) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Set the filter values for this custom report..");
    // XPTXT($GLOBALS{'mpdfreport_selectionlogic'});
    XPTXT("Report Max - ".$GLOBALS{'mpdfreport_maxselection'});
    if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
        $mettext = $GLOBALS{'mpdfreport_maxexecutiontime'};
    } else {$mettext = "Default (30 seconds)";
    }
    XPTXT("Report Max Execution TIme - ".$mettext);
    XBR();
    XFORM("mpdfreportpdfdownload.php","mpdfreportpdfdownload");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    if ($GLOBALS{'mpdfreport_selectionlogic'} != "") {
        FilterTable("PF",$GLOBALS{'mpdfreport_selectionlogic'});
        XBR();
    }
    // CHECK No referenced table filter capability
    XBR();
    XINSUBMIT("Create Report");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
    
}

function Report_MPDFREPORTCSVDOWNLOADSETFILTER_Output( $mpdfreport_id ) {
    Get_Data("mpdfreport",$mpdfreport_id);
    XH3("Set the filter values for this custom report..");
    // XPTXT($GLOBALS{'mpdfreport_selectionlogic'});
    XPTXT("Report Max - ".$GLOBALS{'mpdfreport_maxselection'});
    if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {
        $mettext = $GLOBALS{'mpdfreport_maxexecutiontime'};
    } else {$mettext = "Default (30 seconds)";
    }
    XPTXT("Report Max Execution TIme - ".$mettext);
    XBR();
    XFORM("mpdfreportcsvdownload.php","mpdfreportcsvdownload");
    XINSTDHID();
    XINHID("mpdfreport_id",$mpdfreport_id);
    if ($GLOBALS{'mpdfreport_selectionlogic'} != "") {
        FilterTable("PF",$GLOBALS{'mpdfreport_selectionlogic'});
        XBR();
    }
    // CHECK No referenced table filter capability
    XBR();
    XINSUBMIT("Download CSV");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
    
}

function Report_MPDFREPORTWEBVIEW_Output( $mpdfreport_id, $parmkeyvaluelist, $thisselectionlogic ) {
    
    Get_Data('mpdfreport',$mpdfreport_id);
    XH3("Description");
    XINHIDID("ReportType","ReportType","mpdfreport");
    XINHIDID("mpdfreport_id","mpdfreport_id",$mpdfreport_id);
    
    XPTXT($GLOBALS{'mpdfreport_description'});
    XH3("Settings");
    XPTXT("Prime Table - ".$GLOBALS{'mpdfreport_primetable'});
    if ( $GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
        XPTXT("Report Type - This report is for a specific database record");
        if ( $parmkeyvaluelist == "TESTKEYS") {
            XPTXTCOLOR("Test Key Values - ".$GLOBALS{'mpdfreport_listtestkeyvalues'},"red");
            $thiskeyvaluelist = $GLOBALS{'mpdfreport_listtestkeyvalues'};
        } else {
            XPTXT("Key Values - ".$parmkeyvaluelist);
            $thiskeyvaluelist = $parmkeyvaluelist;
        }
    } else {
        XPTXT("Report Type - This report is for a list of records == ".$thisselectionlogic);
        if ( $thisselectionlogic != "") { $filtervalue = $thisselectionlogic; }
        else { $filtervalue = $GLOBALS{'mpdfreport_selectionlogic'}; }
        if ($filtervalue != "") {$seltext = $filtervalue;} else {$seltext = "None";}
        XPTXT("Report Filter - ".$seltext);
        XPTXT("Report Max - ".$GLOBALS{'mpdfreport_maxselection'});
        if ($GLOBALS{'mpdfreport_maxexecutiontime'} > 0) {$mettext = $GLOBALS{'mpdfreport_maxexecutiontime'};} else {$mettext = "Default (30 seconds)";}
        XPTXT("Report Max Execution TIme - ".$mettext);
    }
    //set global parameter for report
    $GLOBALS{'MPDFREPORTKEYVALUELIST'} = $thiskeyvaluelist;
    $GLOBALS{'MPDFREPORTFILTER'} = $filtervalue;
    $GLOBALS{'MPDFREPORTMODE'} = "web";
    XHR();
    XBR();
    // following include uses keys and mpdfreportid to construct report
    include $GLOBALS{'domainfilepath'}."/mpdfreports/".$mpdfreport_id.".php";
    print $GLOBALS{'pdfr'};
    
    XBR();
    $link = YPGMLINK("mpdfreportpdfdownloadfromwebview.php");
    // $link = YPGMLINK("mpdfreportpdfdownload.php");
    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$thiskeyvaluelist).YPGMPARM("mpdfreport_filtervalue",urlencode($filtervalue));
    XTDLINKTXTNEWWINDOW($link,"download this report as a pdf","pdfview");
    XBR();
    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
        $link = YPGMLINK("mpdfreportcsvdownloadfromwebview.php");
        // $link = YPGMLINK("mpdfreportcsvdownload.php");
        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$thiskeyvaluelist).YPGMPARM("mpdfreport_filtervalue",urlencode($filtervalue));
        XTDLINKTXTNEWWINDOW($link,"download this report as a csv","csv");
    }
}

function Report_EXPORTCSVDOWNLOADSETFILTER_Output( $reportexport, $reportexport_id ) {
    
    Get_Data($reportexport,$reportexport_id);
    $exporttitle = $GLOBALS{$reportexport.'_title'};
    $exportdescription = $GLOBALS{$reportexport.'_description'};
    $exportprimetablelist = $GLOBALS{$reportexport.'_primetable'};
    $exportreferencedtablelist = $GLOBALS{$reportexport.'_referencedtablelist'};
    $exportselectionlogic = $GLOBALS{$reportexport.'_selectionlogic'};
    $exportreferencedselectionlogic = $GLOBALS{$reportexport.'_referencedselectionlogic'};
    $exportsortlogic = $GLOBALS{$reportexport.'_sortlogic'};
    $exportfieldlist = Replace_CRandLF($GLOBALS{$reportexport.'_fieldlist'},"|");
    if ( $inreportexport == "export" ) { $exportuploadable = $GLOBALS{$reportexport.'_uploadable'}; }
    else { $exportuploadable = "No"; }
    
    if (strlen(strstr($exportprimetablelist,','))>0) {
        $exportprimetablea = explode(",",$exportprimetablelist);
        $exportprimetable = $exportprimetablea[0];
        $exportprimetablepair = $exportprimetablea[1];
    } else {
        $exportprimetable = $exportprimetablelist;
        $exportprimetablepair = "";
    }
    
    XH3('Set the filter values for this "csv download"');
    XBR();
    XFORM("exportcsvdownload.php","exportcsvdownload");
    XINSTDHID();
    XINHID("reportexport",$reportexport);
    XINHID("reportexport_id",$reportexport_id);
    if ($exportselectionlogic != "") {
        FilterTable("PF",$exportselectionlogic);
        XBR();
    }
    if ($exportreferencedselectionlogic != "") {
        FilterTable("RF",$exportreferencedselectionlogic);
        XBR();
    }
    XINSUBMIT("Create Export");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_REPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_REPORTLIST_Output () {
    XH2("Reports");
    XBR();XBR();XBR();
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $report_ida = Get_Array('report');
    foreach ($report_ida as $report_id) {
        Get_Data("report",$report_id);
        if ( ReportUserVisibility($GLOBALS{'report_userlevel'},$GLOBALS{'report_personidlist'},$GLOBALS{'report_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($report_id);
            XTDTXT($GLOBALS{'report_title'});
            XTDTXT($GLOBALS{'report_description'});
            XTDTXT($GLOBALS{'report_primetable'});
            // XTDTXT($GLOBALS{'report_referencedtablelist'});
            if ( (strlen(strstr($GLOBALS{'report_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'report_referencedselectionlogic'},'?'))>0) ) {
                XTDTXT("Yes");
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            } else {
                XTDTXT("No");
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","report").YPGMPARM("reportexport_id",$report_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function Report_EXPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_EXPORTLIST_Output () {
    XH2("Export information to spreadsheet");
    XBR();XBR();XBR();
    XDIV("exportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Re-Import");
    XTDHTXT("Variable Filter");
    XTDHTXT("CSV");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $export_ida = Get_Array('export');
    foreach ($export_ida as $export_id) {
        Get_Data("export",$export_id);
        if ( ReportUserVisibility($GLOBALS{'export_userlevel'},$GLOBALS{'export_personidlist'},$GLOBALS{'export_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($export_id);
            XTDTXT($GLOBALS{'export_title'});
            XTDTXT($GLOBALS{'export_description'});
            XTDTXT($GLOBALS{'export_primetable'});
            XTDTXT($GLOBALS{'export_uploadable'});
            if ( (strlen(strstr($GLOBALS{'export_selectionlogic'},'?'))>0) || (strlen(strstr($GLOBALS{'export_referencedselectionlogic'},'?'))>0) ) {
                XTDTXT("Yes");
                $link = YPGMLINK("exportcsvdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
                $link = YPGMLINK("reportwebviewsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownloadsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"download");
            } else {
                XTDTXT("No");
                $link = YPGMLINK("exportcsvdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXTNEWWINDOW($link,"download","csvview");
                $link = YPGMLINK("reportwebview.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"view");
                $link = YPGMLINK("reportpdfdownload.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("reportexport","export").YPGMPARM("reportexport_id",$export_id);
                XTDLINKTXT($link,"download");
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("exportdiv");
    XCLEARFLOAT();
}

function Report_MPDFREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MPDFREPORTLIST_Output () {
    XH2("Run Custom PDF Reports");
    XBR();XBR();XBR();
    XDIV("mpdfreportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Type");
    XTDHTXT("Keys");
    XTDHTXT("Filter");
    XTDHTXT("Browser");
    XTDHTXT("PDF");
    XTDHTXT("CSV");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $mpdfreport_ida = Get_Array('mpdfreport');
    foreach ($mpdfreport_ida as $mpdfreport_id) {
        Get_Data("mpdfreport",$mpdfreport_id);
        if ( ReportUserVisibility($GLOBALS{'mpdfreport_userlevel'},$GLOBALS{'mpdfreport_personidlist'},$GLOBALS{'mpdfreport_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($mpdfreport_id);
            XTDTXT($GLOBALS{'mpdfreport_title'});
            XTDTXT($GLOBALS{'mpdfreport_description'});
            XTDTXT($GLOBALS{'mpdfreport_primetable'});
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes") { XTDTXT("Unique Key"); }
            else { XTDTXT("List"); }
            XTDTXT($GLOBALS{'mpdfreport_listkeys'});
            if ($GLOBALS{'mpdfreport_selectionlogic'} != "") { XTDTXT("Yes"); }
            else { XTDTXT(""); }
            if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes" ) {
                $link = YPGMLINK("mpdfreportkeylist.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
                XTDLINKTXT($link,"view keylist");
            } else {
                if (strlen(strstr($GLOBALS{'mpdfreport_selectionlogic'},'?'))>0) {
                    $link = YPGMLINK("mpdfreportwebviewsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownloadsetfilter.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownloadsetfilter.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                } else {
                    $link = YPGMLINK("mpdfreportwebview.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXT($link,"view");
                    $link = YPGMLINK("mpdfreportpdfdownload.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                    XTDLINKTXTNEWWINDOW($link,"download","pdfview");
                    if ($GLOBALS{'mpdfreport_csvdownloadable'} == "Yes") {
                        $link = YPGMLINK("mpdfreportcsvdownload.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id);
                        XTDLINKTXTNEWWINDOW($link,"download","csv");
                    } else {
                        XTDTXT("");
                    }
                }
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreportdiv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No Custom PDF available");
    }
}

function Report_MASSUPDATELIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MASSUPDATELIST_Output () {
    XH2("Mass Update Forms");
    XBR();XBR();XBR();
    XDIV("massupdatediv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Description");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Form");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $massupdate_ida = Get_Array('massupdate');
    foreach ($massupdate_ida as $massupdate_id) {
        Get_Data("massupdate",$massupdate_id);
        if ( ReportUserVisibility($GLOBALS{'massupdate_userlevel'},$GLOBALS{'massupdate_personidlist'},$GLOBALS{'massupdate_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($massupdate_id);
            XTDTXT($GLOBALS{'massupdate_title'});
            XTDTXT($GLOBALS{'massupdate_primetable'});
            // XTDTXT($GLOBALS{'massupdate_referencedtablelist'});
            if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) {
                XTDTXT("Yes");
                $link = YPGMLINK("massupdateformsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            } else {
                XTDTXT("No");
                $link = YPGMLINK("massupdateformout.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            }
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("massupdatediv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No massupdates available");
    }
}

function Report_MPDFRELEVANTREPORTLIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_MPDFRELEVANTREPORTLIST_Output ( $keynamelist, $keyvaluelist ) {
    $keynamea = explode(',',$keynamelist);
    $bits = explode("_",$keynamea[0]);
    $primetable = $bits[0];
    $keyvaluea = explode(',',$keyvaluelist);
    if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$keyvaluea[0]); }
    if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$keyvaluea[0],$keyvaluea[1]); }
    if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$keyvaluea[0],$keyvaluea[1],$keyvaluea[2]); }
    XH2("Available Custom PDF Reports");
    XBR();XBR();XBR();
    XDIV("mpdfreportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Name");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("PDF");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $mpdfreport_ida = Get_Array('mpdfreport');
    foreach ($mpdfreport_ida as $mpdfreport_id) {
        Get_Data("mpdfreport",$mpdfreport_id);
        $canselect = "0";
        if ($GLOBALS{'mpdfreport_uniquekeyreport'} == "Yes") { // dont consider generic scan reports
            $kbits = explode(',',$keynamelist);
            if ($GLOBALS{'mpdfreport_listkeys'} == $keynamelist) { $canselect = "1"; }  // this table is involved
            if ( $canselect == "1") {
                if ( ReportUserVisibility($GLOBALS{'mpdfreport_userlevel'},$GLOBALS{'mpdfreport_personidlist'},$GLOBALS{'mpdfreport_selectionlogic'})) {
                    if ( RelevantReportFilterVisibility($GLOBALS{'mpdfreport_visibilityfilter'})) {
                        $itemfound = "1";
                        XTR();
                        XTDTXT($mpdfreport_id);
                        XTDTXT($GLOBALS{'mpdfreport_title'});
                        XTDTXT($GLOBALS{'mpdfreport_description'});
                        $link = YPGMLINK("mpdfreportpdfdownload.php");
                        $link = $link.YPGMSTDPARMS().YPGMPARM("mpdfreport_id",$mpdfreport_id).YPGMPARM("keyvaluelist",$keyvaluelist);
                        XTDLINKTXTNEWWINDOW($link,"download","pdf");
                        X_TR();
                    }
                }
            }
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("mpdfreportdiv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No Custom PDF reports available");
    }
}

function Report_IMPORT_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "dropzone";
    $GLOBALS{'SITEJSOPTIONAL'} = "dropzonemin";
}

function Report_IMPORT_Output() {
    
    XH3("Data UploadX");
    XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
    
    $helplink = "Setup/Setup_UPLOAD_Output/setup_upload_output.html"; Help_Link;
    // XFORMUPLOAD("setupuploadin.php","upload");
    XFORMDROPZONE("setupuploadin.php","FileUpload");
    XINSTDHID();
    // XINFILE("UPLOAD","10000000");
    print '<div id="dropzonePreview" class="dz-default dz-message">'."\n";
    print '<span>Drop files here to upload.. or click to browse.</span>'."\n";
    print '</div>'."\n";
    
    XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
    XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
    XBR();
    XINSUBMIT("Upload!");
    X_FORM();
    
}


function Report_SETUPMASSUPDATELIST_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Report_SETUPMASSUPDATELIST_Output () {
    XH2("Mass Update Forms");
    XFORMUPLOAD("massupdatecomposerout.php","newmassupdate");
    XINSTDHID();
    XINHID("massupdate_id","new");
    XINHID("action","new");
    XINHID("menulist","massupdateupdatelist");
    XINSUBMIT("Create New Mass Update Form");
    X_FORM();
    
    XBR();XBR();XBR();
    XDIV("massupdatediv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Id");
    XTDHTXT("Title");
    XTDHTXT("Description");
    XTDHTXT("User Level");
    XTDHTXT("Prime Table");
    XTDHTXT("Variable Filter");
    // XTDHTXT("Referenced Tables");
    XTDHTXT("Composer");
    XTDHTXT("Delete");
    XTDHTXT("Form");
    XTDHTXT("Replicate");
    X_TR();
    X_THEAD();
    XTBODY();
    $itemfound = "0";
    $massupdate_ida = Get_Array('massupdate');
    foreach ($massupdate_ida as $massupdate_id) {
        Get_Data("massupdate",$massupdate_id);
        if ( ReportUserVisibility($GLOBALS{'massupdate_userlevel'},$GLOBALS{'massupdate_personidlist'},$GLOBALS{'massupdate_selectionlogic'})) {
            $itemfound = "1";
            XTR();
            XTDTXT($massupdate_id);
            XTDTXT($GLOBALS{'massupdate_title'});
            XTDTXT($GLOBALS{'massupdate_description'});
            XTDTXT($GLOBALS{'massupdate_userlevel'});
            XTDTXT($GLOBALS{'massupdate_primetable'});
            //			XTDTXT($GLOBALS{'massupdate_referencedtablelist'});
            if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) { XTDTXT("Yes"); }
            else { XTDTXT("No"); }
            $link = YPGMLINK("massupdatecomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id).YPGMPARM("menulist","massupdateupdatelist").YPGMPARM("action","update");
            XTDLINKTXT($link,"composer");
            $link = YPGMLINK("massupdatedeleteconfirm.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
            XTDLINKTXT($link,"delete");
            if (strlen(strstr($GLOBALS{'massupdate_selectionlogic'},'?'))>0) {
                $link = YPGMLINK("massupdateformsetfilter.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            } else {
                $link = YPGMLINK("massupdateformout.php");
                $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id);
                XTDLINKTXT($link,"launch");
            }
            $link = YPGMLINK("massupdatecomposerout.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("massupdate_id",$massupdate_id).YPGMPARM("menulist","massupdateupdatelist").YPGMPARM("action","replicate");
            XTDLINKTXT($link,"replicate");
            X_TR();
        }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("massupdatediv");
    XCLEARFLOAT();
    if ($itemfound == "0") {
        XH5("No massupdates available");
    }
}

function Report_SETUPMASSUPDATECOMPOSER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Report_SETUPMASSUPDATECOMPOSER_Output($massupdate_id,$action) {
    
    if (($action == "new")||($action == "replicate")) {
        $massupdate_ida = Get_Array('massupdate');
        $highestmassupdate_id = "MU00000";
        foreach ($massupdate_ida as $tmassupdate_id) {
            $highestmassupdate_id = $tmassupdate_id;
        }
        $highestmassupdate_seq = str_replace("MU", "", $highestmassupdate_id);
        $highestmassupdate_seq++;
        $newmassupdate_id = "MU".substr(("00000".$highestmassupdate_seq), -5);
        if ($action == "new") {
            Initialise_Data('massupdate');
            XH2("Mass Update Composer - New Mass Update Form - ".$newmassupdate_id);
        }
        if ($action == "replicate") {
            Get_Data('massupdate', $massupdate_id);
            Write_Data('massupdate', $newmassupdate_id);
            XH2("Mass Update Composer - Replicated Mass Update Form - ".$newmassupdate_id);
        }
        $massupdate_id = $newmassupdate_id;
    }
    if ($action == "update") {
        Get_Data('massupdate', $massupdate_id);
        XH2("Report Composer - ".$massupdate_id." - ".$GLOBALS{'massupdate_title'});
    }
    
    XFORM("massupdatecomposerin.php","massupdatein");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    XINHID("menulist","massupdateupdatelist");
    XHR();
    XH2('Title');
    XINTXT("massupdate_title",$GLOBALS{'massupdate_title'},"50","100");
    XH2('Description');
    XINTXT("massupdate_description",$GLOBALS{'massupdate_description'},"100","200");
    XH2('Prime Table');
    XINTXT("massupdate_primetable",$GLOBALS{'massupdate_primetable'},"20","40");
    /*
     XH2('Referenced Tables');
     XINTXT("massupdate_referencedtablelist",$GLOBALS{'massupdate_referencedtablelist'},"150","250");
     */
    XBR();XBR();
    XINSUBMITNAME("find_submit","Show Database Fields");
    XH2('Filter');
    XINTXT("massupdate_selectionlogic",$GLOBALS{'massupdate_selectionlogic'},"250","250");
    XH2('Sort');
    XINTXT("massupdate_sortlogic",$GLOBALS{'massupdate_sortlogic'},"250","250");
    XH2('User Level');
    $xkeylist = "1,2,3,4,5"; $xvaluelist = "Read Only,Other User,Authorised User,Super User,Named People Only";
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"massupdate_userlevel",$GLOBALS{'massupdate_userlevel'});
    XH4('Authorised People');
    XINTXTID("massupdate_personidlist","massupdate_personidlist",$GLOBALS{'massupdate_personidlist'},"50","100");
    XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
    XTXTID("massupdate_personidnames",View_Person_List($GLOBALS{'massupdate_personidlist'}));
    BROW();
    BCOL("6");
    XH2('Mass Update Fields');
    XINTEXTAREA("massupdate_fieldlist",$GLOBALS{'massupdate_fieldlist'},"20","100");
    B_COL();
    
    if (strlen(strstr($GLOBALS{'export_primetable'},','))>0) {
        $primetablea = explode(",",$GLOBALS{'export_primetable'});
        $primetable = $primetablea[0];
        $primetablepair = $primetablea[1];
    } else {
        $primetable = $GLOBALS{'export_primetable'};
        $primetablepair = "";
    }
    $tstring = $GLOBALS{$primetable."^FIELDS"};
    $tfields = explode('|', $tstring);
    $fstring = ""; $fsep = "";
    foreach ($tfields as $tfieldelement) {
        $fbits = explode('_',$tfieldelement);
        Check_Data('field',$fbits[0],$fbits[1]);
        if ($GLOBALS{'IOWARNING'} == "0") {
            $parmlist = "Input=".$GLOBALS{"field_massupdatetype"}.",";
            $parmlist = $parmlist."Cols=".$GLOBALS{"field_massupdateparm1"};
            $sep = ",";
            if ($GLOBALS{"field_massupdatetype"} == "TITLE") {
            }
            if ($GLOBALS{"field_massupdatetype"} == "TEXT") {
                $parmlist = $parmlist.$sep."MaxChars=".$GLOBALS{"field_massupdateparm2"};
            }
            if ($GLOBALS{"field_massupdatetype"} == "TEXTAREA") {
                $parmlist = $parmlist.$sep."Rows=".$GLOBALS{"field_massupdateparm2"};
            }
            if ($GLOBALS{"field_massupdatetype"} == "DATE") {
            }
            if ($GLOBALS{"field_massupdateselection"} != "") {
                $parmlist = $parmlist.$sep.$GLOBALS{"field_massupdateselection"};
            }
            $fstring = $fstring.$fsep.$tfieldelement."(".$parmlist.')'; $fsep = "\n";
        } else {
            $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
        }
    }
    
    if ( $primetablepair != "" ) {
        $tstring = $GLOBALS{$primetablepair."^FIELDS"};
        $tfields = explode('|', $tstring);
        $fstring = ""; $fsep = "";
        foreach ($tfields as $tfieldelement) {
            $fbits = explode('_',$tfieldelement);
            Check_Data('field',$fbits[0],$fbits[1]);
            if ($GLOBALS{'IOWARNING'} == "0") {
                $parmlist = "Input=".$GLOBALS{"field_massupdatetype"}.",";
                $parmlist = $parmlist."Cols=".$GLOBALS{"field_massupdateparm1"};
                $sep = ",";
                if ($GLOBALS{"field_massupdatetype"} == "TITLE") {
                }
                if ($GLOBALS{"field_massupdatetype"} == "TEXT") {
                    $parmlist = $parmlist.$sep."MaxChars=".$GLOBALS{"field_massupdateparm2"};
                }
                if ($GLOBALS{"field_massupdatetype"} == "TEXTAREA") {
                    $parmlist = $parmlist.$sep."Rows=".$GLOBALS{"field_massupdateparm2"};
                }
                if ($GLOBALS{"field_massupdatetype"} == "DATE") {
                }
                if ($GLOBALS{"field_massupdateselection"} != "") {
                    $parmlist = $parmlist.$sep.$GLOBALS{"field_massupdateselection"};
                }
                $fstring = $fstring.$fsep.$tfieldelement."(".$parmlist.')'; $fsep = "\n";
            } else {
                $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
            }
        }
    }
    
    /*
     if ( $GLOBALS{'massupdate_referencedtablelist'} != "" ) {
     //
     $reftablea = explode(',', $GLOBALS{'massupdate_referencedtablelist'});
     foreach ($reftablea as $reftable) {
     $tbits = explode('[', $reftable);
     $fstring = $fstring.$fsep."==================="; $fsep = "\n";
     $tstring = $GLOBALS{$tbits[0]."^FIELDS"};
     $tfields = explode('|', $tstring);
     foreach ($tfields as $tfieldelement) {
     $fbits = explode('_',$tfieldelement);
     Check_Data('field',$fbits[0],$fbits[1]);
     if ($GLOBALS{'IOWARNING'} == "0") {
     // corresi_aaa(AAA)[keyval=mmm]
     if ( $GLOBALS{"field_massupdatename"} != "" ) {
     $fstring = $fstring.$fsep.$tfieldelement."(".$GLOBALS{"field_massupdatename"}.')'; $fsep = "\n";
     } else {
     $fstring = $fstring.$fsep.$tfieldelement; $fsep = "\n";
     }
     } else {
     $fstring = $fstring.$fsep.$tfieldelement.''; $fsep = "\n";
     }
     }
     }
     }
     */
    
    BCOL("6");
    XH2('Database Fields');
    XTEXTAREANEW("20","100");
    XTXT($fstring);
    X_TEXTAREA();
    B_COL();
    B_ROW();
    XBR();XBR();
    XINSUBMITNAME("final_submit","Update Report Design");
    X_FORM();
    
    $GLOBALS{'PersonSelectPopupParameters'} = array(
        "this,person_id|person_sname|person_fname|person_section",
        "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
        "field,Lookup,Select,report_personidlist,report_personidnames,100",
        "person_id",
        "all",
        "search,center,center,800,600",
        "view",
        "buildfulllist"
    );
    
}

function Report_SETUPMASSUPDATEDELETECONFIRM_Output ($massupdate_id) {
    Get_Data("massupdate",$massupdate_id);
    XH3("Delete Mass Update Form - ".$massupdate_id." - ".$GLOBALS{'massupdate_title'});
    // $helplink = "ResultsMaster/Results_Mass2_Output_TR/mass_output2_tr.html"; Help_Link;
    XPTXT("Are you sure you want to delete this massupdate");
    XBR();
    XFORM("massupdatedeleteaction.php","deletemassupdate");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    XINSUBMIT("Confirm Mass Update Form Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}


function Report_MASSUPDATEFORMSETFILTER_Output( $massupdate_id ) {
    Get_Data("massupdate",$massupdate_id);
    XH3("Set the filter values for this mass update form");
    XBR();
    XFORM("massupdateformout.php","massupdateformout");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    $seltesta = explodeAND($GLOBALS{'massupdate_selectionlogic'});
    XTABLE();
    foreach ( $seltesta as $seltest) {
        $selbits = explodeCOMP($seltest);
        if ( $selbits[2] == '?' ) {
            XTR();XTDTXT($selbits[0]);XTDTXT($selbits[1]);XTDINTXT($selbits[0],"","20","50");X_TR();
        }
    }
    X_TABLE();
    XBR();
    XINSUBMIT("Launch Mass Update Form");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function Report_MASSUPDATEFORM_CSSJS( ) {
    $GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
    $GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepicker";
}

function Report_MASSUPDATEFORM_Output( $massupdate_id, $thisselectionlogic ) {
    
    Get_Data('massupdate',$massupdate_id);
    XH3("Description");
    XPTXT($GLOBALS{'massupdate_description'});
    XH3("Settings");
    XPTXT("Prime Table - ".$GLOBALS{'massupdate_primetable'});
    if ( $thisselectionlogic != "") { $thisselectionlogic = $thisselectionlogic; }
    else { $thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'}; }
    if ($thisselectionlogic != "") {$seltext = $thisselectionlogic;} else {$seltext = "None";}
    XPTXT("Selection - ".$seltext);
    if ($GLOBALS{'massupdate_sortlogic'} != "") {$sorttext = $GLOBALS{'massupdate_sortlogic'};} else {$sorttext = "None";}
    XPTXT("Sort - ".$sorttext);
    $primetable = $GLOBALS{'massupdate_primetable'};
    
    $selfieldvaluea = Array(); $selfieldcompa = Array();
    if ( $thisselectionlogic != "" ) {
        $seltesta = explodeAND($thisselectionlogic);
        $fi = 0;
        foreach ( $seltesta as $seltest) {
            $fi++;
            $selbits = explodeCOMP($seltest);
            $selfieldcompa{$fi."_".$selbits[0]} = $selbits[1];
            $selfieldvaluea{$fi."_".$selbits[0]} = $selbits[2];
            $selfieldformata{$fi."_".$selbits[0]} = $selbits[3];
        }
    }
    $sortfieldname = $GLOBALS{'massupdate_sortlogic'};
    
    $primetableida = Get_NKey_Array($primetable);
    $sortselecteda = Array();
    foreach ( $primetableida as $primetableid) {
        $ida = explode('|',$primetableid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$ida[0]); }
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$ida[0],$ida[1]); }
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$ida[0],$ida[1],$ida[2]); }
        $selected = "1";
        foreach($selfieldvaluea as $k => $v) {
            $kbits = explode("_",$k);
            $kfield = $kbits[1]."_".$kbits[2];
            $selected = ReSelection($selected,$kfield,$selfieldcompa{$k},$v,$selfieldformata{$k});
        }
        if ($sortfieldname == "" ) { $sortfieldvalue = ""; }
        else { $sortfieldvalue = $GLOBALS{$sortfieldname}; }
        if ($selected == "1") { array_push($sortselecteda, $sortfieldvalue."|".$primetableid); }
    }
    if ($sortfieldname != "" ) { sort($sortselecteda); }
    
    XH3("Mass Update Form");
    XFORM("massupdateformin.php","massupdateform");
    XINSTDHID();
    XINHID("massupdate_id",$massupdate_id);
    
    $thisselectionlogic = $GLOBALS{'massupdate_selectionlogic'};
    $seltesta = explodeAND($GLOBALS{'massupdate_selectionlogic'});
    foreach ( $seltesta as $seltest) {
        $selbits = explodeCOMP($seltest);
        if ( $selbits[2] == '?' ) {
            $thisparmvalue = $_REQUEST[$selbits[0]];
            XINHID($selbits[0],$thisparmvalue);
        }
    }
    $massupdate_fieldlist = Replace_CRandLF($GLOBALS{'massupdate_fieldlist'},"|");
    $massupdate_fieldlist = str_replace('||', '|', $massupdate_fieldlist);
    if ( substr($massupdate_fieldlist, -1) == '|' ) {
        substr_replace($string ,"",-1);
    }
    // XPTXT("$".$massupdate_fieldlist.'$');
    $fieldsa = explode('|',$massupdate_fieldlist);
    /*
     corsite_id(Input=TITLE,Cols=1)
     corsite_arkoutletname(Input=TITLE,Cols=1)
     corsite_arkaddr1(Input=TEXT,Cols=1,MaxChars=100)
     corsite_arktown(Input=TEXTAREA,Cols=2,Rows=3)
     corsite_arkdate(Input=DATE,Cols=1)
     */
    BROW();
    foreach ($fieldsa as $field) {
        $tfield = str_replace(")",",)",$field);
        $nbits = explode("(",$tfield);
        $fbits = explode("_",$nbits[0]);
        $headertitle = $fbits[1];
        $cbits = explode("Cols=",$tfield);
        $dbits = explode(",",$cbits[1]);
        $cols = $dbits[0];
        BCOLTXTCOLOR("<b>".$headertitle."</b>",$cols,"gray","white");
    }
    B_ROW();
    BROW();
    foreach ($fieldsa as $field) {
        $tfield = str_replace(")",",)",$field);
        $cbits = explode("Cols=",$tfield);
        $dbits = explode(",",$cbits[1]);
        $cols = $dbits[0];
        BCOLTXTCOLOR("X",$cols,"white","white");
    }
    B_ROW();
    
    foreach ( $sortselecteda as $sortselectedid) {
        $sida = explode('|',$sortselectedid);
        if ($GLOBALS{$primetable."^KEYS"} == "2") { Get_Data($primetable,$sida[1]); $keyref=$sida[1];}
        if ($GLOBALS{$primetable."^KEYS"} == "3") { Get_Data($primetable,$sida[1],$sida[2]); $keyref=$sida[1]."-".$sida[2];}
        if ($GLOBALS{$primetable."^KEYS"} == "4") { Get_Data($primetable,$sida[1],$sida[2],$sida[3]); $keyref=$sida[1]."-".$sida[2]."-".$sida[3];}
        BROWTOP();
        foreach ($fieldsa as $field) {
            $tfield = str_replace(")",",)",$field);
            $nbits = explode("(",$tfield);
            $fieldname = $nbits[0];
            $fbits = explode("_",$fieldname);
            Check_Data("field",$fbits[0],$fieldname);
            $tbits = explode("Input=",$tfield);
            $ubits = explode(",",$tbits[1]);
            $inputtype = $ubits[0];
            $cbits = explode("Cols=",$tfield);
            $dbits = explode(",",$cbits[1]);
            $cols = $dbits[0];
            if ( $inputtype == "TITLE" ) {
                BCOLTXT ($GLOBALS{$fieldname},$cols);
            }
            if ( $inputtype == "TEXT" ) {
                if ( $GLOBALS{'field_massupdateselection'} == "" ) {
                    BCOLINTXT ($fieldname."_".$keyref,$GLOBALS{$fieldname},$cols);
                }
                if (strlen(strstr($GLOBALS{'field_massupdateselection'},"Lookup("))>0) {
                    $lbits = explode("(",$GLOBALS{'field_massupdateselection'});
                    $mbits = explode(")",$lbits[1]);
                    $thistable = $mbits[0];
                    BCOLINSELECTHASHID (Array2Hash(Get_Array($thistable)),$fieldname."_".$keyref,$fieldname."_".$keyref,$GLOBALS{$fieldname},$cols);
                }
            }
            if ( $inputtype == "TEXTAREA" ) {
                $rbits = explode("Rows=",$tfield);
                $sbits = explode(",",$rbits[1]);
                $rows = $sbits[0];
                BCOLINTEXTAREA ($fieldname."_".$keyref,$GLOBALS{$fieldname},$rows,$cols);
            }
            if ( $inputtype == "DATE" ) {
                BCOLINDATE ($fieldname."_".$keyref,$GLOBALS{$fieldname},"dd-mm-yyyy",$cols);
                
            }
        }
        B_ROW();
    }
    XBR();
    XINSUBMIT ("Update");
    X_FORM();
}

function DF($thisfield,$parm) {
    
    /*
     corsite_arkaddr1(Addr1)
     corsite_arktown(Town){Filter}
     corsite_arkpostcode(PostCode)
     [startreflist,corresi,corsite_dispcorresiidlist]
     corresi_class(Class)
     corresi_quantity(No.)
     [endreflist]
     [startreflookup,corcomms,corsite_id]
     corsitecomms_type(Type)
     corsitecomms_message(Message)
     [endreflookup]
     [link,manage,corsiteupdate,corsite_id,corsite_version]
     
     or
     
     corsite_arkaddr1
     corsite_arktown
     corsite_arkpostcode
     [startlist,corresi,corsite_dispcorresiidlist]
     corresi_class
     corresi_quantity
     [endlist]
     [startscan,corcomms,corsite_id]
     corsitecomms_type
     corsitecomms_message
     [endscan]
     [link,manage,corsiteupdate,corsite_id,corsite_version]
     
     sfmground_id(Ground)
     sfmground_floodlightfixtureinstalldate(Date)[X:FOREACHyyyy][Y:FOREACHsfmground_floodlightfixturetypeid:COUNT]

     */
    
    // Set Defaults
    $type = "field";
    $table = "";
    $fieldname = $thisfield;
    $formattype = "";
    $fieldvalue = "";
    $totalincrvalue = 0;
    $countincrvalue = 0;
    $titlefield = $thisfield;
    $totalfield = "";
    $countfield = "";
    $filterfield = "";
    $reftable = "";
    $refkeylist = "";
    $refrootkeyarray = Array();
    $linktext = "";
    $programname = "";
    $programkeyarray = Array();
    $graphxsyntax = "";
    $graphysyntax = "";
    
    if ($thisfield[0] == "[") {
        // Deal with the special lines that are not directly related to fieldnames
        if (strlen(strstr($thisfield,'[startreflist'))>0) {
            $type = "startreflist";
            // [startreflist,corresi,corsite_dispcorresiidlist]
            $tbits = explode('[',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $vbits = explode(',',$ubits[0]);
            $reftable = $vbits[1];
            $refkeylist = $vbits[2];
            $refrootkeyarray = Array(); // CHECK This is a simplification for this version
        }
        if (strlen(strstr($thisfield,'[endreflist'))>0) { $type = "endreflist"; }
        
        if (strlen(strstr($thisfield,'[startreflookup'))>0) {
            $type = "startreflookup";
            // [startreflookup,corsitecomms,corsite_id]
            $tbits = explode('[',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $vbits = explode(',',$ubits[0]);
            $reftable = $vbits[1];
            if ( count($vbits) ==  2 ) { $refrootkeyarray = Array(); }
            if ( count($vbits) ==  3 ) { $refrootkeyarray = Array($vbits[2]); }
            if ( count($vbits) ==  4 ) { $refrootkeyarray = Array($vbits[2],$vbits[3]); }
        }
        if (strlen(strstr($thisfield,'[endreflookup'))>0) { $type = "endreflookup"; }
        
        if (strlen(strstr($thisfield,'[link'))>0) {
            $type = "programlink";
            // [link,manage,corsiteupdate,corsite_id,corsite_version]
            $tbits = explode('[',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $vbits = explode(',',$ubits[0]);
            $linktext = $vbits[1];
            $programname = $vbits[2];
            if ( count($vbits) ==  4 ) { $programkeyarray = Array($vbits[3]); }
            if ( count($vbits) ==  5 ) { $programkeyarray = Array($vbits[3],$vbits[4]); }
            if ( count($vbits) ==  6 ) { $programkeyarray = Array($vbits[3],$vbits[4],$vbits[5]); }
        }
    } else {
        // find the field name before any special characters
        $type = "field";
        if ((strlen(strstr($thisfield,'('))>0)||(strlen(strstr($thisfield,'{'))>0)||(strlen(strstr($thisfield,'['))>0)) {
            // XPTXT("Here");
            $tfieldname = "";
            $specialfound = "0";
            for ($ci = 0; $ci <= strlen($thisfield); $ci++) {
                if (($thisfield[$ci] != "{")&&($thisfield[$ci] != "(")&&($thisfield[$ci] != "[")&&($specialfound == "0")) {
                    $tfieldname = $tfieldname.$thisfield[$ci];
                } else {
                    $specialfound = "1";
                }
            }
            $fieldname = $tfieldname;
        }
    }
    
    // Process the fieldname related parameters
    
    if ($parm == "Title") {
        if (strlen(strstr($thisfield,'('))>0) {
            $tbits = explode('(',$thisfield);
            $ubits = explode(')',$tbits[1]);
            $titlefield = $ubits[0];
        } else {
            if (strlen(strstr($thisfield,'{'))>0) { // assumes { comes first
                $tbits = explode('{',$thisfield);
                $titlefield = $tbits[0];
            } else {
                if (strlen(strstr($thisfield,'['))>0) {
                    $tbits = explode('[',$thisfield);
                    $titlefield = $tbits[0];
                }
            }
        }
    }
    
    if ($parm == "Total") {
        if (strlen(strstr($thisfield,'{Total}'))>0) {
            $totalfield = "Y";
        }
    }
    
    if ($parm == "Count") {
        if (strlen(strstr($thisfield,'{Count}'))>0) {
            $countfield = "Y";
        }
    }
    
    if ($parm == "Filter") {
        if (strlen(strstr($thisfield,'{Filter}'))>0) {
            $filterfield = "Y";
        }
    }
    
    $fbits = explode('_',$thisfield);
    $table = $fbits[0];
    
    if ($parm == "FieldFormat") {
        if (strlen(strstr($thisfield,'{'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('{',$thisfield);
            $ubits = explode('}',$tbits[1]);
            $validformats = Array("Num0","Num1","Num2","Curr0","Curr1","Curr2","Percent0","Percent1","Percent2","RAG","NonBlank","NonZero","Weblink","YYYY-MM-DD","yyyy-mm-dd","DD/MM/YYYY","dd/mm/yyyy");
            if (in_array($ubits[0], $validformats)) { $formattype = $ubits[0]; }
            if (strlen(strstr($ubits[0],'Max'))>0) { $formattype = $ubits[0]; }
            if (strlen(strstr($ubits[0],'Compare='))>0) { $formattype = $ubits[0]; }
            if (strlen(strstr($ubits[0],'ListVal='))>0) { $formattype = $ubits[0]; }
        }
    }
    
    if ($parm == "FieldValue") {
        // [Y:FOREACHsfmground_floodlightfixturetypeid:COUNT]
        if (strlen(strstr($thisfield,'Y:FOREACH'))>0) {
            $sbits = explode(":",$thisfield);
            if (strlen(strstr($sbits[1],'_'))>0) { // special situation - another field is involved
                $otherfieldname = str_replace("FOREACH","",$sbits[1]);
                $fieldvalue = $GLOBALS{$otherfieldname}; 
            } else {
                $fieldvalue = $GLOBALS{$fieldname}; // normal situation this field value  returned
            } 
        } else { 
            $fieldvalue = $GLOBALS{$fieldname}; // normal situation this field value  returned
        } 
    }
    
    if ($parm == "FieldFormattedValue") {
        if (strlen(strstr($thisfield,'{'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('{',$thisfield);
            $ubits = explode('}',$tbits[1]);
            $formattype = $ubits[0];
            if ($formattype == "Num0") { $fieldvalue = number_format($GLOBALS{$fieldname}); }
            if ($formattype == "Num1") { $fieldvalue = number_format($GLOBALS{$fieldname}, 1, '.', ''); }
            if ($formattype == "Num2") { $fieldvalue = number_format($GLOBALS{$fieldname}, 2, '.', ''); }
            if ($formattype == "Curr0") { $fieldvalue = "&pound;".number_format($GLOBALS{$fieldname}); }
            if ($formattype == "Curr1") { $fieldvalue = "&pound;".number_format($GLOBALS{$fieldname}, 1, '.', ''); }
            if ($formattype == "Curr2") { $fieldvalue = "&pound;".number_format($GLOBALS{$fieldname}, 2, '.', ''); }
            if ($formattype == "Percent0") { $fieldvalue = number_format($GLOBALS{$fieldname})."%"; }
            if ($formattype == "Percent1") { $fieldvalue = number_format($GLOBALS{$fieldname}, 1, '.', '')."%"; }
            if ($formattype == "Percent2") { $fieldvalue = number_format($GLOBALS{$fieldname}, 2, '.', '')."%"; }
            if (substr($formattype, 0, 3) == "Max") {
                $flength = (int)str_replace("Max", "", $formattype);
                if ($fieldvalue != "") {
                    if ( strlen($GLOBALS{$fieldname}) > $flength ) { $fieldvalue = substr($GLOBALS{$fieldname}, 0, $flength).".."; }
                }
            }
            if (substr($formattype, 0, 8) == "Compare=") {
                $cfieldname = str_replace("Compare=", "", $formattype);
                if ($cfieldname != "") {
                    if ($GLOBALS{$fieldname} == $GLOBALS{$cfieldname}) { $fieldvalue = "Yes"; }
                    else { $fieldvalue = "No"; }
                }
            }
            if (substr($formattype, 0, 8) == "ListVal=") {
                $cfieldname = str_replace("ListVal=", "", $formattype);
                if ($cfieldname != "") {
                    if (strlen(strstr($GLOBALS{$fieldname}.",",$cfieldname.","))>0) { $fieldvalue = $cfieldname; }
                    else { $fieldvalue = ""; }
                }
            }
            if ($formattype == "RAG") {
                if ($GLOBALS{$fieldname} == "Red") { $fieldvalue = '<span style="color:red">Red</span>'; }
                if ($GLOBALS{$fieldname} == "red") { $fieldvalue = '<span style="color:red">red</span>'; }
                if ($GLOBALS{$fieldname} == "Amber") { $fieldvalue = '<span style="color:orange">Amber</span>'; }
                if ($GLOBALS{$fieldname} == "amber") { $fieldvalue = '<span style="color:orange">amber</span>'; }
                if ($GLOBALS{$fieldname} == "Green") { $fieldvalue = '<span style="color:green">Green</span>'; }
                if ($GLOBALS{$fieldname} == "green") { $fieldvalue = '<span style="color:green">green</span>'; }
                
                if ($GLOBALS{$fieldname} == "Yes") { $fieldvalue = '<span style="color:green">Yes</span>'; }
                if ($GLOBALS{$fieldname} == "Y") { $fieldvalue = '<span style="color:green">Y</span>'; }
                if ($GLOBALS{$fieldname} == "yes") { $fieldvalue = '<span style="color:green">yes</span>'; }
                if ($GLOBALS{$fieldname} == "No") { $fieldvalue = '<span style="color:red">No</span>'; }
                if ($GLOBALS{$fieldname} == "N") { $fieldvalue = '<span style="color:red">N</span>'; }
                if ($GLOBALS{$fieldname} == "no") { $fieldvalue = '<span style="color:red">no</span>'; }
                if ($GLOBALS{$fieldname} == "NA") { $fieldvalue = '<span style="color:blue">no</span>'; }
            }
            if ($formattype == "NonBlank") {
                if ($GLOBALS{$fieldname} == "") { $fieldvalue = '<img src="../site_assets/checkbox-selected-red.png" />'; }
                else { $fieldvalue = '<img src="../site_assets/checkbox-selected-green.png" />'; }
            }
            if ($formattype == "NonZero") {
                if ($GLOBALS{$fieldname} == 0) { $fieldvalue = '<img src="../site_assets/checkbox-selected-orange.png" />'; }
                else { $fieldvalue = '<img src="../site_assets/checkbox-selected-green.png" />'; }
            }
            if ($formattype == "Weblink") {
                if ($GLOBALS{$fieldname} == "") { $fieldvalue = ""; }
                else { $fieldvalue = YLINKTXTNEWWINDOW(DDbMMbYYYYtoYYYYhMMhDD($GLOBALS{$fieldname}),"link","Link View"); }
            }
            if ($formattype == "YYYY-MM-DD") {
                if ($GLOBALS{$fieldname} == "") { $fieldvalue = ""; }
                else { $fieldvalue = DDbMMbYYYYtoYYYYhMMhDD($GLOBALS{$fieldname}); }
            }
            
        } else {
            $fieldvalue = $GLOBALS{$fieldname};
            // XPTXT( $thisfield." ".$fieldname." ".$fieldvalue." ".$GLOBALS{$fieldname} );
        }
    }
    
    if ($parm == "TotalIncrValue") {
        $totalincrvalue = floatval($GLOBALS{$fieldname});
    }
    
    if ($parm == "CountIncrValue") {
        $countincrvalue = 0;
        if (strlen(strstr($thisfield,'{Count}'))>0) {
            $thisfield2  = str_replace('{Count}', "", $thisfield);
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('{',$thisfield2);
            $ubits = explode('}',$tbits[1]);
            $formattype = $ubits[0];
            if (substr($formattype, 0, 8) == "ListVal=") { // to identify entries in list
                $cfieldname = str_replace("ListVal=", "", $formattype);
                if ($cfieldname != "") {
                    if (strlen(strstr($GLOBALS{$fieldname}.",",$cfieldname.","))>0) { $countincrvalue = 1; }
                    else { $countincrvalue = 0; }
                }
            } else {
                if ($GLOBALS{$fieldname} != "") { $countincrvalue = 1; };
            }
        }
    }
    
    if ($parm == "GraphXSyntax") {
        // [X:TITLE]
        if (strlen(strstr($thisfield,'[X:'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('[X:',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $graphxsyntax = "X:".$ubits[0];
        }
    }
    if ($parm == "GraphYSyntax") {
        // [Y:FOREACH:COUNT]
        if (strlen(strstr($thisfield,'[Y:'))>0) {
            $fieldvalue = $GLOBALS{$fieldname};
            $tbits = explode('[Y:',$thisfield);
            $ubits = explode(']',$tbits[1]);
            $graphysyntax = "Y:".$ubits[0];
        }
    }
    
    // XPTXT($thisfield.'|'.$parm.'==>'.$type.'|'.$table.'|'.$fieldname.'|'.$titlefield.'|'.$indexvalue);
    
    if ($parm == "Type") { return $type; }
    if ($parm == "Table") { return $table; }
    if ($parm == "Field") { return $fieldname; }
    if ($parm == "FieldFormat") { return $formattype; }
    if ($parm == "FieldFormattedValue") { return $fieldvalue; }
    if ($parm == "FieldValue") { return $fieldvalue; }
    if ($parm == "TotalIncrValue") { return $totalincrvalue; }
    if ($parm == "CountIncrValue") { return $countincrvalue; }
    if ($parm == "Title") { return $titlefield; }
    if ($parm == "Total") { return $totalfield; }
    if ($parm == "Count") { return $countfield; }
    if ($parm == "Filter") { return $filterfield; }
    if ($parm == "RefTable") { return $reftable; }
    if ($parm == "RefKeyList") { return $refkeylist; }
    if ($parm == "RefRootKeyArray") { return $refrootkeyarray; }
    if ($parm == "LinkText") { return $linktext; }
    if ($parm == "ProgramName") { return $programname; }
    if ($parm == "ProgramKeyArray") { return $programkeyarray; }
    if ($parm == "GraphXSyntax") { return $graphxsyntax; }
    if ($parm == "GraphYSyntax") { return $graphysyntax; }
}

function fieldFormat($fieldvalue, $formattype) {
    $outfieldvalue = $fieldvalue;
    if ($formattype == "") { $outfieldvalue = $fieldvalue; }
    if ($formattype == "Num0") { $outfieldvalue = number_format($fieldvalue); }
    if ($formattype == "Num1") { $outfieldvalue = number_format($fieldvalue, 1, '.', ''); }
    if ($formattype == "Num2") { $outfieldvalue = number_format($fieldvalue, 2, '.', ''); }
    if ($formattype == "Curr0") { $outfieldvalue = "&pound;".number_format($fieldvalue); }
    if ($formattype == "Curr1") { $outfieldvalue = "&pound;".number_format($fieldvalue, 1, '.', ''); }
    if ($formattype == "Curr2") { $outfieldvalue = "&pound;".number_format($fieldvalue, 2, '.', ''); }
    if ($formattype == "Percent0") { $outfieldvalue = number_format($fieldvalue)."%"; }
    if ($formattype == "Percent1") { $outfieldvalue = number_format($fieldvalue, 1, '.', '')."%"; }
    if ($formattype == "Percent2") { $outfieldvalue = number_format($fieldvalue, 2, '.', '')."%"; }
    if (substr($formattype, 0, 3) == "Max") {
        $flength = (int)str_replace("Max", "", $formattype);
        if ($fieldvalue != "") {
            if ( strlen($fieldvalue) >= $flength ) { $outfieldvalue = substr($fieldvalue, 0, $flength).".."; }
        }
    }
    if (substr($formattype, 0, 8) == "Compare=") {
        $cfieldname = (int)str_replace("Compare=", "", $formattype);
        if ($cfieldname != "") {
            if ($fieldvalue == $GLOBALS{$cfieldname}) { $outfieldvalue = "Yes"; }
            else { $outfieldvalue = "No"; }
        }
    }
    if (substr($formattype, 0, 8) == "ListVal=") {
        $cfieldname = str_replace("ListVal=", "", $formattype);
        if ($cfieldname != "") {
            if (strlen(strstr($GLOBALS{$fieldname}.",",$cfieldname.","))>0) { $outfieldvalue = $cfieldname; }
            else { $outfieldvalue = ""; }
        }
    }
    if (($formattype == "YYYY-MM-DD")||($formattype == "yyyy-mm-dd")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} != "date" ) {
            if ($GLOBALS{$fieldname} == "") { $outfieldvalue = ""; }
            else { $outfieldvalue = DDbMMbYYYYtoYYYYhMMhDD($GLOBALS{$fieldname}); }
        }
    }
    if (($formattype == "DD/MM/YYYY")||($formattype == "dd/mm/yyyy")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} == "date" ) {
            if ($GLOBALS{$fieldname} == "") { $outfieldvalue = ""; }
            else { $outfieldvalue = YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{$fieldname}); }
        }
    }  
    return $outfieldvalue;
}

function explodeOR($thisselectionlogic) {
    $thisselectionlogic = trim($thisselectionlogic,' ');
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($thisselectionlogic); }
    $orfound = "0";
    if (strlen(strstr($thisselectionlogic,')||('))>0) {
        $thisselectionlogic = str_replace(')||(', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if (strlen(strstr($thisselectionlogic,') || ('))>0) {
        $thisselectionlogic = str_replace(') || (', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if (strlen(strstr($thisselectionlogic,')|('))>0) {
        $thisselectionlogic = str_replace(')|(', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if (strlen(strstr($thisselectionlogic,') | ('))>0) {
        $thisselectionlogic = str_replace(') | (', '^', $thisselectionlogic);
        $orfound = "1";
    }
    if ( $orfound == "1" ) {
        $thisselectionlogic = ltrim($thisselectionlogic,'(');
        $thisselectionlogic = rtrim($thisselectionlogic,')');
    }
    return explode('^',$thisselectionlogic);
}

function explodeAND($thisselectionlogic) {
    $thisselectionlogic = trim($thisselectionlogic,' ');
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($thisselectionlogic); }
    $thisselectionlogic = str_replace(')&&(', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(') && (', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(')&(', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(') & (', '^', $thisselectionlogic);
    $thisselectionlogic = str_replace(')', '', $thisselectionlogic);
    $thisselectionlogic = str_replace('(', '', $thisselectionlogic);
    return explode('^',$thisselectionlogic);
}

function rebuildOR($tselora) {
    $outstring = ""; $sepor = "";
    if (isset($tselora)) {
        foreach ($tselora as $element) {
            $outstring = $outstring.$sepor.'('.$element.')';
            $sepor = "|";
        }
    }
    return $outstring;
}

function rebuildAND($tseltestouta) {
    $outstring = ""; $sepand = "";
    if (isset($tseltestouta)) {
        foreach ($tseltestouta as $element) {
            $outstring = $outstring.$sepand.'('.$element.')';
            $sepand = "&";
        }
    }
    return $outstring;
}

function explodeCOMP($thisfieldcomp) {
    // field==value  field{dd/mm/yyyy}=value field!=value field>=value   etc    returns array (field,comp,value,{format})
    $fva = Array();
    $thiscomp = "=="; // default
    if (strlen(strstr($thisfieldcomp,'='))>0) {
        if (strlen(strstr($thisfieldcomp,'=='))>0) { $fva = explode('==',$thisfieldcomp); $thiscomp = "==";}
        else { $fva = explode('=',$thisfieldcomp); $thiscomp = "==";}
    }
    if (strlen(strstr($thisfieldcomp,'!='))>0) { $fva = explode('!=',$thisfieldcomp); $thiscomp = "!=";}
    if (strlen(strstr($thisfieldcomp,'<>'))>0) { $fva = explode('<>',$thisfieldcomp); $thiscomp = "!=";}
    if (strlen(strstr($thisfieldcomp,'>'))>0) {
        if (strlen(strstr($thisfieldcomp,'>='))>0) { $fva = explode('>=',$thisfieldcomp); $thiscomp = ">=";}
        else { $fva = explode('>',$thisfieldcomp); $thiscomp = ">";}
    }
    if (strlen(strstr($thisfieldcomp,'<'))>0) {
        if (strlen(strstr($thisfieldcomp,'<='))>0) { $fva = explode('<=',$thisfieldcomp); $thiscomp = "<=";}
        else { $fva = explode('<',$thisfieldcomp); $thiscomp = "<";}
    }
    if (strlen(strstr($fva[0],'{'))>0) {
        $fbits = explode('{',$fva[0]);
        $gbits = explode('}',$fbits[1]);
        $thisfield = $fbits[0];
        $thisformat = $gbits[0];
    } else {
        $thisfield = $fva[0];
        $thisformat = "";
    }
    
    $ra = Array($thisfield,$thiscomp,$fva[1],$thisformat);
    return $ra;
}

function ReSelection($tselected,$field,$comp,$value,$format) {
    $inselected = $tselected;
    if ( $value != '' ) {
        $thisvalue = $value;
        if ($comp == '==') {
            // ========== OR list comparisons =============
            if ( strlen(strstr($thisvalue,'|'))>0 ) {
                $orva = explode('|',$thisvalue);
                $ormatch = "0";
                foreach ( $orva as $orv ) {
                    if (strlen(strstr($orv,'*'))>0) { // wildcard
                        if ( $orv == '*' ) { $ormatch = "1"; } // always select
                        else { // wildcard based selection
                            $partialvalue = str_replace('*', "", $orv);
                            if ( (substr($orv, 0, 1) == "*")&&(substr($orv, -1) == "*") ) {	 // any position
                                if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) { $ormatch = "1"; }
                            } else {
                                if ( substr($orv, -1) == "*" ) { // start of string
                                    if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                                }
                                if ( substr($orv, 0, 1) == "*") { // end of string
                                    if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                                }
                            }
                        }
                    } else { // normal based selection
                        if ($orv == "NonBlank") {
                            if (CC($GLOBALS{$field}) != "") { $ormatch = "1"; }
                        } else {
                            if ($orv == "Blank") { $orv = ""; }
                            if (CC($GLOBALS{$field}) == CC($orv)) { $ormatch = "1"; }
                        }
                    }
                    // XPTXT($value." ".$orv." ".$ormatch);
                }
                
                if ($ormatch == "0") { $tselected = "0"; }
            }
            // ========== single value comparison =============
            else {
                if (strlen(strstr($value,'*'))>0) { // wildcard
                    if ( $value == '*' ) { } // always select
                    /*
                     else { // wildcard based selection
                     $partialvalue = str_replace('*', "", $value);
                     if (strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0) {} else { $tselected = "0"; }
                     }
                     */
                    else { // wildcard based selection
                        $partialvalue = str_replace('*', "", $value);
                        if ( (substr($value, 0, 1) == "*")&&(substr($value, -1) == "*") ) {	 // any position
                            if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) {} else { $tselected = "0"; }
                        } else {
                            if ( substr($value, -1) == "*" ) { // start of string
                                if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                            if ( substr($value, 0, 1) == "*") { // end of string
                                if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                        }
                    }
                } else { // normal based selection
                    if ($thisvalue == "NonBlank") {
                        if (CC($GLOBALS{$field}) != "") { } else { $tselected = "0"; }
                    } else {
                        if ($thisvalue == "Blank") { $thisvalue = ""; }
                        if (CC($GLOBALS{$field}) == CC($thisvalue)) { } else { $tselected = "0"; }
                    }
                }
            }
        }
        if ($comp == '!=') {
            // ========== OR list comparisons =============
            if ( strlen(strstr($thisvalue,'|'))>0 ) {
                $orva = explode('|',$thisvalue);
                $ormatch = "0";
                foreach ( $orva as $orv ) {
                    if (strlen(strstr($orv,'*'))>0) { // wildcard
                        $partialvalue = str_replace('*', "", $orv);
                        /*
                         if (strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0) { $ormatch = "1"; }
                         */
                        if ( (substr($orv, 0, 1) == "*")&&(substr($orv, -1) == "*") ) {	 // any position
                            if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) { $ormatch = "1"; }
                        } else {
                            if ( substr($orv, -1) == "*" ) { // start of string
                                if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                            }
                            if ( substr($orv, 0, 1) == "*") { // end of string
                                if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) { $ormatch = "1"; }
                            }
                        }
                    } else { // normal based selection
                        if ($orv == "Blank") {
                            if (CC($GLOBALS{$field}) != "") { $ormatch = "1"; }
                        } else {
                            if ($orv == "NonBlank") { $orv = ""; }
                            if (CC($GLOBALS{$field}) == CC($orv)) { $ormatch = "1"; }
                        }
                    }
                }
                if ($ormatch == "1") { $tselected = "0"; }
            }
            // ========== single valsubstr($value, 0, 1)rison =============
            else {
                if (strlen(strstr($value,'*'))>0) { // wildcard
                    if ( $value == '*' ) { } // always select
                    else { // wildcard based selection
                        $partialvalue = str_replace('*', "", $value);
                        /*
                         if (strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0) { $tselected = "0"; }
                         */
                        if ( (substr($value, 0, 1) == "*")&&(substr($value, -1) == "*") ) {	 // any position
                            if ((strlen(strstr(CC($GLOBALS{$field}),CC($partialvalue)))>0)&&($partialvalue != "")) {} else { $tselected = "0"; }
                        } else {
                            if ( substr($value, -1) == "*" ) { // start of string
                                if ( substr(CC($GLOBALS{$field}), 0, strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                            if ( substr($value, 0, 1) == "*") { // end of string
                                if ( substr(CC($GLOBALS{$field}), strlen(CC($partialvalue))*(-1), strlen(CC($partialvalue))) == CC($partialvalue) ) {} else { $tselected = "0"; }
                            }
                        }
                    }
                } else { // normal based selection
                    if ($thisvalue == "NonBlank") {
                        if (CC($GLOBALS{$field}) == "") { } else { $tselected = "0"; }
                    } else {
                        if ($thisvalue == "Blank") { $thisvalue = ""; }
                        if (CC($GLOBALS{$field}) != CC($thisvalue)) { } else { $tselected = "0"; }
                    }
                }
            }
            
        }
        if ($comp == '>') {  if (ReFormat($field,$GLOBALS{$field},$format) > ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        if ($comp == '>=') {  if (ReFormat($field,$GLOBALS{$field},$format) >= ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        if ($comp == '<') {  if (ReFormat($field,$GLOBALS{$field},$format) < ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        if ($comp == '<=') {  if (ReFormat($field,$GLOBALS{$field},$format) <= ReFormat($field,$thisvalue,$format)) { } else { $tselected = "0"; }  }
        
    }
    // XPTXT($inselected." ".$field." ".$comp." ".$value." ".$tselected);
    return $tselected;
}

function ReFormat($fieldname,$fieldstring,$fieldformat) {
    $reformatstring = $fieldstring;
    if (($fieldformat == "YYYY-MM-DD")||($fieldformat == "yyyy-mm-dd")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} != "date" ) {
            if ($GLOBALS{$fieldname} == "") { $reformatstring = ""; }
            else { $reformatstring = DDbMMbYYYYtoYYYYhMMhDD($fieldstring); }
        }
    }
    if (($fieldformat == "DD/MM/YYYY")||($fieldformat == "dd/mm/yyyy")) {
        if ( $GLOBALS{$fieldname."_sqldatatype"} == "date" ) {
            if ($GLOBALS{$fieldname} == "") { $reformatstring = ""; }
            else { $reformatstring = YYYY_MM_DDtoDDsMMsYYYY($fieldstring); }
        }
    }
    return $reformatstring;
}

function ShowFormat($fieldformat) {
    $fieldformatstring = "";
    if ($fieldformat != "" ) {
        $fieldformatstring = "{".$fieldformat."}";
    }
    return $fieldformatstring;
}

function CC($compstring) {
    // adapts special characters to permit comparison
    $compstring = str_replace('&', "AND", $compstring);
    $compstring = str_replace(':', "COLON", $compstring);
    // if ($GLOBALS{'LOGIN_person_id'} == "bbra") { XPTXT($compstring); }
    return $compstring;
}


function FilterPopup() {
    XDIVPOPUP("filterpopup","Filter");
    XINHIDID("filterid","filterid","");
    XDIVSCROLL("filterdiv","","400px");
    XTXTID("filterstring","filterstring");
    X_DIV("filterdiv");
    XBR();
    XINBUTTONIDSPECIAL("ClearFilter","secondary","Clear Filters");
    XBR();XHR();
    XINBUTTONID("ApplyFilter","Apply Filter");
    XINBUTTONIDSPECIAL("CancelFilter","warning","Cancel");
    X_DIV("filterpopup");
}

// ================== Custom FIlters ===========================

function myLocations() {
    $pipelist = ""; $psep = "";
    $dmwscontractlocationa = Get_Array('dmwscontractlocation');
    foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
        $include = "0";
        Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
        if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $include = "1"; }
        if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $include = "1"; }
        if ($include == "1") { $pipelist = $pipelist.$psep.$dmwscontractlocation_id; $psep = "|";}
    }
    return $pipelist;
}

function myWOs() {
    $woarray = Array();
    $dmwscontractlocationa = Get_Array('dmwscontractlocation');
    foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
        Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
        if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) {
            $tarray = List2Array($GLOBALS{'dmwscontractlocation_officerlist'});
            $woarray = array_merge($woarray, $tarray);
        }
    }
    $rarray = array_unique($woarray);
    $pipelist = Array2List($rarray);
    $pipelist = str_replace(',', '|', $pipelist);
    return $pipelist;
}

function meOnly() {
    $pipelist = $GLOBALS{'LOGIN_person_id'};
    return $pipelist;
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>