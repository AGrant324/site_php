<?php # libraryroutines.php

function Library_LIBRARYVIEW_Output1 () {
	XH3("Library");
	# $helplink = "AdminMaster/Setup_ASSETSLIST_Output/setup_assetslist_output.html"; Help_Link;
	XPTXT("Please select the library section");
	XFORM("libraryviewout2.php","libraryviewout2");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Library Section");XTDHTXT("");X_TR();
	XTR();XTDINSELECTHASH (Get_Library_Select_Hash(),"LibrarySection","");XTDINSUBMIT("Search");X_TR();
	X_TABLE();
	X_FORM();
}

function Library_LIBRARYINDEX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Library_LIBRARYINDEX_Output ($mode,$asset_clubid) {
    XH3("Library");

    if ($mode == "Maintain") {
        XH3("Maintain Documents in Library");
    }

    $tlibdirfiles = Get_Array_Hash('librarysection');
    $librarysectiontemparray = Array();
    foreach ($tlibdirfiles as $tlibrarysection_id) {
        if ($tlibrarysection_id != "libraryroot") {
            Get_Data_Hash('librarysection',$tlibrarysection_id);
            $libbit5s = explode('/',$GLOBALS{'librarysection_sequence'});
            $libhierarchy = count($libbit5s);
            $arrayelement = $GLOBALS{'librarysection_sequence'}."/000/000/000/000/000/000/000/000/000"."^".$tlibrarysection_id;
            array_push($librarysectiontemparray, $arrayelement);
        }
    }
    sort($librarysectiontemparray);

    XDIV("reportdiv","container");
    XINHIDID("reportwidth","reportwidth","50%");
    XINHIDID("reportheight","reportheight","50vh");
    XINHIDID("reportalign","reportalign","left");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Index");
    XTDHTXT("Library Folder");
    if ($mode == "Maintain") {
        XTDHTXT("Security");
    }
	XTDHTXT("View Contents");
    X_TR();
    X_THEAD();
    XTBODY();

    $libindex = 0;
    $outkeya = Array(); $outtexta = Array();
    foreach ($librarysectiontemparray as $librarysectionelement) {
        $libbit3s = explode('^', $librarysectionelement );
        $tlibrarysection_id = $libbit3s[1];
        Get_Data_Hash('librarysection',$tlibrarysection_id);
        $libbit5s = explode('/',$GLOBALS{'librarysection_sequence'});
        $libhierarchy = count($libbit5s);
        $libtext = ""; $insettxt = ""; for ($inset = 0; $inset < $libhierarchy; $inset++) { $libtext = $libtext.$insettxt; $insettxt = "........"; }
        $libtext = $libtext.$GLOBALS{'librarysection_title'};
        XTRJQDT();
        XTDHTXT($libindex);
        $libindex++;
        XTDTXT($libtext);
        if ($mode == "Maintain") {
            XTDTXT($GLOBALS{'librarysection_security'});
            $link = YPGMLINK("librarymaintainout2.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("LibrarySection",$tlibrarysection_id).YPGMPARM("asset_clubid",$asset_clubid);
            XTDLINKTXT($link,"open");
        } else {
            $link = YPGMLINK("libraryviewout2.php");
            $link = $link.YPGMSTDPARMS().YPGMPARM("LibrarySection",$tlibrarysection_id).YPGMPARM("asset_clubid",$asset_clubid);
            XTDLINKTXT($link,"open");
        }
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
    XINHID("list_sortcol",0);
}

function Library_LIBRARYVIEW_2_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Library_LIBRARYVIEW_Output2 ( $librarysection_id,$asset_clubid) {
	XH3("Library - ".$asset_clubid);
	Check_Data("librarysection",$librarysection_id);
	if ($GLOBALS{'IOWARNING'} == "1") { $GLOBALS{'librarysection_title'} = "Library Section Not Found"; }
	XH4($GLOBALS{'librarysection_title'});

	XDIV("reportdiv_LibraryView","container");
	XINHIDID("reportwidth","reportwidth","90%");
	XINHIDID("reportheight","reportheight","60vh");
	XINHIDID("reportalign","reportalign","left");
	XTABLEJQDTID("reporttable_LibraryView");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("date - yyyy-mm-dd");
	XTDHTXTFIXED("title","500");
	# XTDHTXT("file name");
	#�XTDHTXT("author");
	# XTDHTXTFIXED("description","200");
	XTDHTXT("");
	X_TR();
	X_THEAD();
	XTBODY();
	$assetsa = Get_Array_Hash_SortSelect('asset',$asset_clubid,"asset_title","","");
	$assetfound = "0";
	foreach ( Get_Array_Hash("org") as $org_personid ) {
		 $targetstring = $org_personid.",";
		 $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
		 $confidentialok = "0";
		 foreach (Get_Array_Hash("org") as $org_personid) {
			  $targetstring = $org_personid.",";
			  $searchstring = $GLOBALS{'LOGIN_person_id'}.",";
			  if (strlen(strstr($org_personid,$searchstring))>0) {
				   $confidentialok = "1";
			  }
		 }
	}
	foreach ($assetsa as $asset_code) {
	 Get_Data("asset",$asset_clubid,$asset_code);
	 if (($librarysection_id == $GLOBALS{'asset_librarysection'})||($librarysection_id == "All")) {
	  $assetfound = "1";
	  $viewable = "0";
	  if ($GLOBALS{'asset_security'} == "") { $viewable = "1"; }
	  if ($GLOBALS{'asset_security'} == "0") { $viewable = "1"; }
	  if ($GLOBALS{'asset_security'} == "1") { $viewable = "1"; }
	  if ($GLOBALS{'asset_security'} == "2") {
		   if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $viewable = "1"; }
		   if (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0) { $viewable = "1"; }
		   if (strlen(strstr($GLOBALS{'person_authority'},"ORG#Domain"))>0) { $viewable = "1"; }
	  	   if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $viewable = "1"; }
	  }
	  if ($GLOBALS{'asset_security'} == "3") {
	  	   if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $viewable = "1"; }
	  }
	  if ($viewable == "1") {
	   XTRJQDT();
	   if ($GLOBALS{'asset_createdate'} != "") {
		    XTDTXT($GLOBALS{'asset_createdate'});
	   } else {
		    $abits = str_split($asset_code);
		    // XTDTXT("$abits[6]$abits[7]/$abits[4]$abits[5]/$abits[2]$abits[3]");
		    XTDTXT($abits[0].$abits[1].$abits[2].$abits[3]."-".$abits[4].$abits[5]."-".$abits[7].$abits[8]);
	   }
	   XTDTXTWIDTH($GLOBALS{'asset_title'},500);
	   # XTDTXTWIDTH($GLOBALS{'asset_file'},200);
	   # XTDTXT($GLOBALS{'asset_author'});
	   #�XTDTXTWIDTH($GLOBALS{'asset_description'},250);
	   if ((strlen(strstr($GLOBALS{'asset_file'},"http://"))>0)||(strlen(strstr($GLOBALS{'asset_file'},"https://"))>0)) {
		    $link = $GLOBALS{'asset_file'};
		    XTDLINKTXTNEWWINDOW($link,"view","View");
	   } else {
		    $link = YPGMLINK("librarydownloadin.php");
		    $link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code);
		    XTDLINKTXTNEWWINDOW($link,"view","Download");
	   }
	   X_TR();
	  }
	 }
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv_LibraryView");
	XCLEARFLOAT();
	XINHID("LibraryView_sortcol",0);
	XINHID("LibraryView_sortseq","desc");
	// if ($assetfound == "0") { XPTXT("There are no items registered in this library section"); }
	XBR();

	$link = YPGMLINK("libraryviewout1.php");
	$link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$asset_clubid);
	XBR();XLINKTXT($link,"Return to Library Folder Index");
}

function Library_ACCREDVIEWLIST_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryui";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,slimjquerymin,slimimagepopup,accredviewlist,rememberbtab";
}

function Library_ACCREDVIEWLIST_Output ($activeaccredscheme_id,$taccredcriteria_clubid,$maintainorview,$currenttab) {
	# accredscheme_id (or active), maintain/view
	# $helplink = "AdminMaster/Setup_ACCREDVIEW_Output/setup_accredview_output.html"; Help_Link;
	if ($activeaccredscheme_id == "Active") {
            $activeaccredscheme_id = "";
            $taccredscheme_ida = Get_Array('accredscheme');
            foreach ($taccredscheme_ida as $taccredscheme_id) {
                Check_Data("accredscheme",$taccredscheme_id);
                if ( $GLOBALS{'accredscheme_type'} == "Normal") {
                    if ($GLOBALS{'accredscheme_active'} == "Yes") {$activeaccredscheme_id = $taccredscheme_id;}
                }
            }
	}
	// XH1($activeaccredscheme_id." ".$taccredcriteria_clubid." ".$maintainorview);
	Check_Data("accredscheme",$activeaccredscheme_id);
	if ($GLOBALS{'IOWARNING'} == "1") {
    	XH5("No accreditation criteria found");
	} else {
    	if ($GLOBALS{'accredscheme_logolink'} != "") { XIMGFLEX($GLOBALS{'accredscheme_logolink'}); }
    	// XH3("Accreditation - ".$GLOBALS{'accredscheme_authority'}." - ".$GLOBALS{'accredscheme_name'}." - Version ".$GLOBALS{'accredscheme_version'});
    	XH3($GLOBALS{'accredscheme_name'}." - Version ".$GLOBALS{'accredscheme_version'});
    	$accredcriteriaa = Get_Array('accredcriteria',$activeaccredscheme_id,$taccredcriteria_clubid);
    	sort($accredcriteriaa);
    	XINHIDID("accredcriteria_schemeid","accredcriteria_schemeid",$activeaccredscheme_id);
    	XINHIDID("accredcriteria_clubid","accredcriteria_clubid",$taccredcriteria_clubid);
    	XHRCLASS("underline");
    	Check_Data("accredcriteria",$activeaccredscheme_id,$taccredcriteria_clubid,"a_01");
    	if ($GLOBALS{'IOWARNING'} == "0" ) {
        	if ($GLOBALS{'accredcriteria_criteria'} !="") {
        	    XH3COLOR("Introduction","#5499C7  ");
                    XBR();
                    BROW();
                    BCOL("12");
        	    XTXT(Replace_CRandLF($GLOBALS{'accredcriteria_criteria'},"<br>"));
        	    B_COL();
                    B_ROW();
                    XBR();
        	}
    	}

    	$evidencekeya = Array(); // [criteriakey][evidencekey]
    	$datakeya = Array(); // [criteriakey][evidencekey][datakeya]

    	if ( $currenttab == "" ) { $currenttab = "Tab1"; }
    	BTABDIV('accreditationtabmenu');
    	BTABHEADERCONTAINER();
    	$t1 = 0;
    	$firstsection = "1";
        foreach ($accredcriteriaa as $accredcriteria_id) {
            Get_Data("accredcriteria",$activeaccredscheme_id,$taccredcriteria_clubid,$accredcriteria_id);
        	if ($GLOBALS{'accredcriteria_type'} == "section") {
                $ti++;
                $thistab = "Tab".$ti;
                if ( $thistab == $currenttab ) {
                    BTABHEADERITEMACTIVE($thistab,$GLOBALS{'accredcriteria_section'});
                } else {
                    BTABHEADERITEM($thistab,$GLOBALS{'accredcriteria_section'});
                }
            }
            if ($GLOBALS{'accredcriteria_type'} == "criteria") {
                $lastcriteriakey = $accredcriteria_id;
                // XPTXT($lastcriteriakey);
                $lastcriteriasection = $GLOBALS{'accredcriteria_section'};
                $evidencekeya[$lastcriteriakey] = Array();
                $datakeya[$lastcriteriakey] = Array();
            }
            if ($GLOBALS{'accredcriteria_type'} == "evidence") {
                $lastevidencekey = $accredcriteria_id;
                XINHIDID("accredcriteria_ref_".$accredcriteria_id,"accredcriteria_ref_".$accredcriteria_id,$GLOBALS{'accredcriteria_ref'});
                XINHIDID("accredcriteria_section_".$GLOBALS{'accredcriteria_id'},"accredcriteria_section_".$GLOBALS{'accredcriteria_id'},$lastcriteriasection);
                array_push ($evidencekeya[$lastcriteriakey],$lastevidencekey);
                $datakeya[$lastcriteriakey][$lastevidencekey] = Array();
            }
            if ($GLOBALS{'accredcriteria_type'} == "data") {
                XINHIDID("accredcriteria_ref_".$accredcriteria_id,"accredcriteria_ref_".$accredcriteria_id,$GLOBALS{'accredcriteria_ref'});
                array_push ($datakeya[$lastcriteriakey][$lastevidencekey],$accredcriteria_id);
            }
    	}
    	B_TABHEADERCONTAINER();

    	BTABCONTENTCONTAINER();
    	$thisaccredcriteria_section = "";
    	$firstsection = "1";

    	// print_r($evidencekeya); XHR(); print_r($datakeya);

    	$ti = 0;
    	if ($GLOBALS{'accredscheme_inspectionenabled'} == "Yes") {
         	$criteriacols = "4";
        	$evidencecols = "4";
        	$inspectioncols = "4";
    	} else {
    	    $criteriacols = "6";
    	    $evidencecols = "6";
    	    $inspectioncols = "0";
    	}

    	foreach ($accredcriteriaa as $accredcriteria_id) {
    	    Get_Data("accredcriteria",$activeaccredscheme_id,$taccredcriteria_clubid,$accredcriteria_id);
        	// XPTXT($activeaccredscheme_id." - ".$accredcriteria_id." - ".$GLOBALS{'accredcriteria_type'});
            // === section ======================================
            if ($GLOBALS{'accredcriteria_type'} == "section") {
                if ($firstsection == "1") {
                    $firstsection = "0";
                } else {
                    X_TABLE();
                    B_TABCONTENTITEM();
                }
       	        $ti++;
    	        $thistab = "Tab".$ti;
                if ( $thistab == $currenttab ) {
                    BTABCONTENTITEMACTIVE($thistab);
                } else {
                    BTABCONTENTITEM($thistab);
                }
                XBR();
                BROW();
                BCOLTXTCOLOR("<b>"."Criteria"."</b>",$criteriacols,"white","navy");
                BCOLTXTCOLOR("<b>"."Club Self Assessment"."</b>",$evidencecols,"white","navy");
                if ($GLOBALS{'accredscheme_inspectionenabled'} = "Yes") { BCOLTXTCOLOR("<b>"."Inspection"."</b>",$inspectioncols,"white","navy"); }
                B_ROW();
            }
            if ($GLOBALS{'accredcriteria_type'} == "evidence") {
                XHRCLASS("underline");
                BROW();
                BCOL($criteriacols);
                CriteriaText($activeaccredscheme_id,$taccredcriteria_clubid,$accredcriteria_id);
                B_COL();
                BCOL($evidencecols);
                ResponseText($activeaccredscheme_id,$taccredcriteria_clubid,$accredcriteria_id,$datakeya,$maintainorview);
                B_COL();
                if ($GLOBALS{'accredscheme_inspectionenabled'} = "Yes") {
                    BCOL($inspectioncols);
                    InspectionText($activeaccredscheme_id,$taccredcriteria_clubid,$accredcriteria_id,$datakeya,$maintainorview);
                    B_COL();
                }
                B_ROW();
            }
        }
    	B_TABCONTENTITEM();
    	B_TABCONTENTCONTAINER();
    	B_TABDIV();
    }
    if ($maintainorview == "Inspect") {
        AccredInspectionPopup();
        AccredInspectionImagePopup();
    }
}

// section    a_sectionref [eg a_02]
// criteria   a_sectionref_criteriaref [eg a_02_02]
// evidence   a_sectionref_criteriaref_evidenceref [eg a_02_02_e01  or  a_02_02_01_e01 ]
// data       a_sectionref_criteriaref_dataref [eg a_02_02_e01_i01  or  a_02_02_01_e01_i01 ]

function CriteriaText($accredscheme_id,$accredcriteria_clubid,$accredcriteria_id) {
    $abits = explode("_",$accredcriteria_id);
    if ( count($abits) == 4 ) {
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
    } else { // count = 5
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4];
    }
    Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$criteriaid);
    BROWTOP();
    $reftext = str_replace("S", "", $GLOBALS{'accredcriteria_ref'});
    BCOLTXT("<h4>".$reftext."&nbsp;&nbsp;".$GLOBALS{'accredcriteria_section'}."</h4>","12");
    B_ROW();
    BROW();
    $textout = Replace_CR($GLOBALS{'accredcriteria_criteria'},'<br>');
    if ( strlen($textout) >= 250 ) { $textout = substr($textout, 0, 500)."&nbsp;&nbsp;&nbsp;More.."; }
    BCOLTXT($textout,"12");
    B_ROW();
    BROW();
    BCOLTXT("&nbsp;","12");
    B_ROW();
    BROW();
    BCOLTXTCOLOR("<b>"."Evidence Required"."</b>","12","white","navy");
    B_ROW();
    Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$evidenceid);
    BROW();
    BCOL("12");
    XTXTID('accredcriteria_evidencerequirement_'.$accredcriteria_id,Replace_CR($GLOBALS{'accredcriteria_evidencerequirement'},'<br>'));
    B_COL();
    B_ROW();

    if ($GLOBALS{'accredscheme_ownerenabled'} == "Yes") {
        Check_Data("person",$GLOBALS{'accredcriteria_owner'});
        $fullname = "";
        if ($GLOBALS{'IOWARNING'} == "0") {$fullname = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};}
        XBR();
        BROW();
        BCOLTXTCOLOR("<b>"."Owner"."</b>","12","white","navy");
        B_ROW();
        BROW();
        BCOL("12");
        XTXTID('accredcriteria_owner_'.$accredcriteria_id,$fullname);
        B_COL();
        B_ROW();
    }
}

/*
 accredcriteria_schemeid
 accredcriteria_clubid
 accredcriteria_id
 accredcriteria_ref
 accredcriteria_type
 accredcriteria_section
 accredcriteria_criteria
 accredcriteria_subcriteria
 accredcriteria_evidencerequirement
 accredcriteria_datafieldname
 accredcriteria_datafieldtitle
 accredcriteria_dataradioquestions
 accredcriteria_datacheckboxquestions
 accredcriteria_datatextquestion
 accredcriteria_evidenceassetcodesreqd
 accredcriteria_evidenceimagelistreqd

 $evidencekeya = Array(); // [criteriakey][evidencekey]
 $datakeya = Array(); // [criteriakey][evidencekey][datakeya]

 */


function ResponseText($accredscheme_id,$accredcriteria_clubid,$accredcriteria_id,$datakeya,$maintainorview) {
    $abits = explode("_",$accredcriteria_id);
    if ( count($abits) == 4 ) {
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
    } else { // count = 5
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4];
    }
    Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$accredcriteria_id);

    $thistimestamp = $GLOBALS{'accredcriteria_lastselfassessmenttimestamp'};
    $thispersonid = $GLOBALS{'accredcriteria_lastselfassessmentpersonid'};

    BROW();
    BCOLTXTIDCOLOR( 'accredcriteria_selfassessment_'.$accredcriteria_id,$GLOBALS{'accredcriteria_selfassessment'},"11",Val2RAG($GLOBALS{'accredcriteria_selfassessment'}),"Black");
    B_ROW();
    XHR();

    if ($GLOBALS{'accredcriteria_evidencetext'} != "") {
        BROW();
        BCOLTXT(Replace_CR($GLOBALS{'accredcriteria_evidencetext'},'<br>'),"11");
        B_ROW();
        XHR();
    }

    if ($GLOBALS{'accredcriteria_evidenceassetcodes'} != "") {
        $evidenceasset_codesa = explode(',', $GLOBALS{'accredcriteria_evidenceassetcodes'} );
        foreach ($evidenceasset_codesa as $evidenceasset_code) {
            // XPTXTCOLOR($accredcriteria_clubid." ".$evidenceasset_code,"red");
            Check_Data('asset',$accredcriteria_clubid,$evidenceasset_code);
            if ($GLOBALS{'IOWARNING'} == "1") {$GLOBALS{'asset_description'} = "Not Found";}
            else {
                if ((strlen(strstr($GLOBALS{'asset_file'},"http://"))>0)||(strlen(strstr($GLOBALS{'asset_file'},"https://"))>0)) {
                    $link = $GLOBALS{'asset_file'};
                    # XLINKTXTNEWWINDOW($link,"view","View");
                } else {
                    $link = YPGMLINK("librarydownloadin.php");
                    $link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$accredcriteria_clubid).YPGMPARM("asset_code",$evidenceasset_code);
                    # XLINKTXTNEWWINDOW($link,"view","View");
                }
                BROW();
                BCOLTXT(YLINKTXT($link,$GLOBALS{'asset_title'}),"11");
                B_ROW();
            }
        }
        XHR();
    }

    if ($GLOBALS{'accredcriteria_evidenceimagelist'} != "") {
        $evidence_imagea = explode(',', $GLOBALS{'accredcriteria_evidenceimagelist'} );
        foreach ($evidence_imagea as $evidence_image) {
            $imagesrc = $GLOBALS{'domainwwwurl'}."/domain_media/".$evidence_image;
            BROW();
            BCOLIMG ($imagesrc,"150","11");
            B_ROW();
            XHR();
        }
    }

    $found = "0";
    $evidencedatalist = ""; $sep = "";
    $GLOBALS{'fbToggle'} = "even";
    foreach ( $datakeya[$criteriaid][$evidenceid] as $dataid ) {
        $found = "1";
        Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$dataid);
        $evidencedatalist = $evidencedatalist.$sep.$dataid;
        $sep = ",";
        BROW();
        BCOLTXTIDCOLOR('accredcriteria_datafieldtitle_'.$dataid,$GLOBALS{'accredcriteria_datafieldtitle'},"5",feintback(),"black");
        $reqmttext = "&nbsp;";
        if ( $GLOBALS{'accredcriteria_datatargetreqd'} != "") { $reqmttext = "Req: ".$GLOBALS{'accredcriteria_datatargetreqd'}; }
        BCOLTXTCOLOR($reqmttext,"3",feintback(),"black");

        if ($GLOBALS{'accredcriteria_datafieldname'} != "") {
            XINHIDID('accredcriteria_dataquestiontype_'.$dataid,'accredcriteria_dataquestiontype_'.$dataid,$GLOBALS{'accredcriteria_dataquestiontype'});
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
                XINHIDID('accredcriteria_datatextquestion_'.$dataid,'accredcriteria_datatextquestion_'.$dataid,$GLOBALS{'accredcriteria_datatextquestion'});
                XINHIDID('accredcriteria_datatextresult_'.$dataid,'accredcriteria_datatextresult_'.$dataid,$GLOBALS{'accredcriteria_datatextresult'});
                $dataresult = "&nbsp;";
                if ( $GLOBALS{'accredcriteria_datatextresult'} != "") { $dataresult = $GLOBALS{'accredcriteria_datatextresult'}; }
            }
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
                XINHIDID('accredcriteria_dataradioquestions_'.$dataid,'accredcriteria_dataradioquestions_'.$dataid,$GLOBALS{'accredcriteria_dataradioquestions'});
                XINHIDID('accredcriteria_dataradioresult_'.$dataid,'accredcriteria_dataradioresult_'.$dataid,$GLOBALS{'accredcriteria_dataradioresult'});
                $dataresult = "&nbsp;";
                if ( $GLOBALS{'accredcriteria_dataradioresult'} != "") { $dataresult = $GLOBALS{'accredcriteria_dataradioresult'}; }
            }
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
                XINHIDID('accredcriteria_datacheckboxquestions_'.$dataid,'accredcriteria_datacheckboxquestions_'.$dataid,$GLOBALS{'accredcriteria_datacheckboxquestions'});
                XINHIDID('accredcriteria_datacheckboxresult_'.$dataid,'accredcriteria_datacheckboxresult_'.$dataid,$GLOBALS{'accredcriteria_datacheckboxresult'});
                $dataresult = "&nbsp;";
                if ( $GLOBALS{'accredcriteria_datacheckboxresult'} != "") { $dataresult = $GLOBALS{'accredcriteria_datacheckboxresult'}; }
            }
        }
        BCOLTXTCOLOR($dataresult,"3",feintback(),"black");
        feintbackToggle();
        B_ROW();

    }
    if ($found == "1") { XHR(); }
    XINHIDID('EvidenceDataList_'.$evidenceid,'EvidenceDataList_'.$evidenceid,$evidencedatalist);

    if ($GLOBALS{'accredcriteria_reviewcomments'} != "") {
        BROW();
        BCOLTXTCOLOR("<b>"."Comments and Status"."</b>","11","white","navy");
        B_ROW();
        BROW();
        BCOLTXT(Replace_CR($GLOBALS{'accredcriteria_reviewcomments'},'<br>'),"11");
        B_ROW();
        XHR();
    }
    if ($maintainorview == "Maintain") {
        $link = YPGMLINK("accredevidencemaintainout.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("accredscheme_id",$accredscheme_id).YPGMPARM("accredcriteria_clubid",$accredcriteria_clubid).YPGMPARM("accredcriteria_id",$accredcriteria_id);
        BROW();
        BCOL("6");
        XLINKBUTTONSPECIAL ($link,"Update Club Self Assessment","primary");
        B_COL();
        BCOL("6");

        if ($thistimestamp != "") {
            $lupid = $thispersonid;
            $luhh = substr($thistimestamp."000000000000000",9,2);
            $lumi = substr($thistimestamp."000000000000000",11,2);
            $mmnum = intval(substr($thistimestamp."000000000000000",5,2));
            $lummma = List2Array($GLOBALS{'STATIC_mmm'});
            $lummm = $lummma[$mmnum -1];
            $ludd = substr($thistimestamp."000000000000000",7,2);
            XTXT("<small>Last Update</small>");XBR();
            XTXT("<small>".$lupid." ".$luhh.":".$lumi." ".$lummm." ".$ludd."</small>");
        }

        B_COL();
        B_ROW();
    }
}

function feintback() {
    if ( $GLOBALS{'fbToggle'} == "even" ) { $feintbackval = "#F1F2F1"; }
    else { $feintbackval = "#FDFCFB"; }
    return $feintbackval;
}

function feintbackToggle() {
    if ( $GLOBALS{'fbToggle'} == "even" ) { $GLOBALS{'fbToggle'} = "odd"; }
    else { $GLOBALS{'fbToggle'} = "even"; }
}


function InspectionText($accredscheme_id,$accredcriteria_clubid,$accredcriteria_id,$datakeya,$maintainorview) {

    $abits = explode("_",$accredcriteria_id);
    if ( count($abits) == 4 ) {
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
    } else { // count = 5
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4];
    }
    Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$accredcriteria_id);

    BROW();
    BCOLTXTIDCOLOR('accredcriteria_inspectionresult_'.$accredcriteria_id,$GLOBALS{'accredcriteria_inspectionresult'},"11",Val2RAG($GLOBALS{'accredcriteria_inspectionresult'}),"Black");
    B_ROW();
    XHR();

    XDIV("accredcriteria_inspectioncommentsdiv_".$accredcriteria_id,"inspectioncommentsdiv");
    XH4("Inspection Comments");
    BROW();
    BCOL("12");
    XTXTID('accredcriteria_inspectioncomments_'.$accredcriteria_id,Replace_CR($GLOBALS{'accredcriteria_inspectioncomments'},'<br>'));
    B_COL();
    B_ROW();
    XHR();
    X_DIV("accredcriteria_inspectioncommentsdiv");

    $GLOBALS{'fbToggle'} = "even";
    $found = "0";
    foreach ( $datakeya[$criteriaid][$evidenceid] as $dataid ) {
        $found = "1";
        Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$dataid);
        BROW();
        BCOLTXTCOLOR($GLOBALS{'accredcriteria_datafieldtitle'},"4",feintback(),"black");
        $reqmttext = "&nbsp;";
        if ( $GLOBALS{'accredcriteria_datatargetreqd'} != "") { $reqmttext = "Req: ".$GLOBALS{'accredcriteria_datatargetreqd'}; }
        BCOLTXTCOLOR($reqmttext,"3",feintback(),"black");

        XINHIDID('accredcriteria_inspectiondatatextresult_'.$dataid,'accredcriteria_inspectiondatatextresult_'.$dataid,$GLOBALS{'accredcriteria_inspectiondatatextresult'});
        XINHIDID('accredcriteria_inspectiondataradioresult_'.$dataid,'accredcriteria_inspectiondataradioresult_'.$dataid,$GLOBALS{'accredcriteria_inspectiondataradioresult'});
        XINHIDID('accredcriteria_inspectiondatacheckboxresult_'.$dataid,'accredcriteria_inspectiondatacheckboxresult_'.$dataid,$GLOBALS{'accredcriteria_inspectiondatacheckboxresult'});

        if ($GLOBALS{'accredcriteria_datafieldname'} != "") {
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
                $dataresult = "&nbsp;";
                if ( $GLOBALS{'accredcriteria_inspectiondatatextresult'} != "") { $dataresult = $GLOBALS{'accredcriteria_inspectiondatatextresult'}; }
            }
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
                $dataresult = "&nbsp;";
                if ( $GLOBALS{'accredcriteria_inspectiondataradioresult'} != "") { $dataresult = $GLOBALS{'accredcriteria_inspectiondataradioresult'}; }
            }
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
                $dataresult = "&nbsp;";
                if ( $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'} != "") { $dataresult = $GLOBALS{'accredcriteria_inspectiondatacheckboxresult'}; }
            }
        }

        BCOLTXTIDCOLOR('accredcriteria_inspectiondataresult_'.$dataid,$dataresult,"3",feintback(),"black");

        if ( $GLOBALS{'accredcriteria_inspectiondatacondition'} != "") {
            BCOLTXTIDCOLOR('accredcriteria_inspectiondatacondition_'.$dataid,$GLOBALS{'accredcriteria_inspectiondatacondition'}[0],"1",Val2RAG($GLOBALS{'accredcriteria_inspectiondatacondition'}),"black");
        } else {
            BCOLTXTIDCOLOR('accredcriteria_inspectiondatacondition_'.$dataid,"&nbsp;","1",feintback(),"black");
        }

        XDIV("accredcriteria_inspectioncommentsdiv_".$accredcriteria_id,"inspectioncommentsdiv");
        X_DIV("accredcriteria_inspectioncommentsdiv");

        B_ROW();
        feintbackToggle();
    }
    if ($found == "1") { XHR(); }

    Check_Data("accredcriteria",$accredscheme_id,$accredcriteria_clubid,$accredcriteria_id); // repeat after data

    XINHIDID('accredcriteria_inspectionimagelist_'.$evidenceid,'accredcriteria_inspectionimagelist_'.$evidenceid,$GLOBALS{'accredcriteria_inspectionimagelist'});
    XDIV("accredcriteria_inspectionimagelistdiv_".$accredcriteria_id,"inspectionimagelistdiv");
    if ($GLOBALS{'accredcriteria_inspectionimagelist'} != "") {
        $evidence_imagea = explode(',', $GLOBALS{'accredcriteria_inspectionimagelist'} );
        foreach ($evidence_imagea as $evidence_image) {
            $imagesrc = $GLOBALS{'domainwwwurl'}."/domain_media/".$evidence_image;
            BROW();
            BCOLIMGWIDTH ($imagesrc,"100%","12");
            B_ROW();
            XHR();
        }
    }
    X_DIV("accredcriteria_inspectionimagelistdiv_".$accredcriteria_id);

    if ($maintainorview == "Inspect") {
        $link = YPGMLINK("accredinspectin.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("accredscheme_id",$activeaccredscheme_id).YPGMPARM("accredcriteria_clubid",$accredcriteria_clubid).YPGMPARM("accredcriteria_id",$accredcriteria_id);
        BROW();
        BCOL("6");
        XINBUTTONIDCLASSSPECIAL ("CriteriaInspectButton_".$accredcriteria_id,"CriteriaInspectButton","primary","Update Inspection");
        B_COL();

        $link = YPGMLINK("accredinspectimagein.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("accredscheme_id",$activeaccredscheme_id).YPGMPARM("accredcriteria_clubid",$accredcriteria_clubid).YPGMPARM("accredcriteria_id",$accredcriteria_id);
        BCOL("6");
        XINBUTTONIDCLASSSPECIAL ("CriteriaInspectImageButton_".$accredcriteria_id,"CriteriaInspectImageButton","info",'&nbsp;<i class="fa fa-refresh fa-camera"></i>');
        B_COL();

        B_ROW();
    }
}

function AccredInspectionPopup() {
    XDIVPOPUP("accredinspectionpopup","Inspection Assessment");
    XINHIDID("popupaccredcriteria_schemeid","popupaccredcriteria_schemeid","");
    XINHIDID("popupaccredcriteria_clubid","popupaccredcriteria_clubid","");
    XINHIDID("popupaccredcriteria_id","popupaccredcriteria_id","");
    BROW();
    BCOL("2");
    XH4("Result");
    $hash = List2Hash("Pass,Advisory,Fail");
    BINSELECTHASHIDCLASS($hash, "popupaccredcriteria_inspectionresult","rag","popupaccredcriteria_inspectionresult", "", "2");
    B_COL();
    BCOLINTEXTAREAID("popupaccredcriteria_inspectioncomments", "popupaccredcriteria_inspectioncomments", "", "6", "10") ;
    B_ROW();
    XHR();

    BROW();
    BCOL("2");
    XH4("Data");
    B_COL();
    BCOL("10");
    XDIV("InspectionDataArea", "");
    X_DIV("InspectionDataArea");
    B_COL();
    B_ROW();
    XHR();

    XINBUTTONID("InspectionUpdate","Update");
    XINBUTTONIDSPECIAL("InspectionCancel","warning","Cancel");
    X_DIV("accredinspectionpopup");
}

function AccredInspectionImagePopup() {
    XDIVPOPUP("accredinspectionimagepopup","Update Image");
    XINHIDID("popupimageaccredcriteria_schemeid","popupimageaccredcriteria_schemeid","");
    XINHIDID("popupimageaccredcriteria_clubid","popupimageaccredcriteria_clubid","");
    XINHIDID("popupimageaccredcriteria_id","popupimageaccredcriteria_id","");
    XINHIDID("popupimageaccredcriteria_inspectionimagelist","popupimageaccredcriteria_inspectionimagelist","");

    $GLOBALS{'CROPPARMS'} = Array();

    XFORM("accredinspectionimagemaintainin.php","accredinspectionimagemaintainin");
    XINSTDHID();
    XINHID("accredscheme_id",$taccredscheme_id);
    XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
    XINHID("accredcriteria_id",$taccredcriteria_id);
    XINHID("AccredUpdate","InspectionImage");
    XINHID("EvidenceSeq",$evidenceseq);
    XINHID("accredcriteria_evidenceimagelist",$GLOBALS{'accredcriteria_inspectionimagelist'});
    $currenttab = "Tab".$taccredcriteria_id[3];
    XINHID("CurrentTab",$currenttab);

    XH3("Inspection Images");
    XHR();
    for ($ei=0; $ei<6; $ei++) { // Max 6 images
        XDIV("InspectionImageDiv".$ei,"");
        // =================== Slim Image Cropper Output =======================
        $imagefieldname = "InspectionImageName".$ei;
        $imageviewwidth = "600";
        $imagename = "";
        $imageuploadto = "AccredInspection"."accredscheme_id".$ei;
        $imageuploadid = "accredcriteria_clubid"."accredcriteria_id".$ei;
        $imageuploadwidth = "800";
        $imageuploadheight = "500";
        $imageuploadfixedsize = "800x500";
        $imagethumbwidth = "400";
        XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
        array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
        XHR();
        X_DIV("InspectionImageDiv".$ei);
    }
    XINBUTTONID("InspectionImageUpdate","Update");
    XINBUTTONIDSPECIAL("InspectionImageCancel","warning","Cancel");
    X_FORM();
    X_DIV("accredinspectionimagepopup");

    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function Library_ACCREDEVIDENCEMAINTAIN_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,jqueryconfirm,datepicker,jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,slimjquerymin,slimimagepopup,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm,jqdatatablesmin,report,accredviewlist,rememberbtab";
}

function Library_ACCREDEVIDENCEMAINTAIN_Output ($taccredscheme_id,$taccredcriteria_clubid,$taccredcriteria_id,$taccredmaintainerrormsg) {
    # accredscheme_id accred_id2;
    if ($taccredmaintainerrormsg != "") {XPTXTCOLOR($taccredmaintainerrormsg,"red");}

    // XPTXT($taccredscheme_id." ".$taccredcriteria_clubid." ".$taccredcriteria_id);

    // Note taccredcriteria_id parameter is evidence id
    // section    a_sectionref [eg a_02]
    // criteria   a_sectionref_criteriaref [eg a_02_02]
    // evidence   a_sectionref_criteriaref_evidenceref [eg a_02_02_e01  or  a_01_02_01_e01 ]
    // data       a_sectionref_criteriaref_dataref [eg a_02_02_e01_i01  or  a_01_02_01_e01_i01 ]

    $abits = explode("_",$taccredcriteria_id);
    if ( count($abits) == 4 ) {
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
        $dataid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_i01";
    } else { // count = 5
        $sectionid = $abits[0]."_".$abits[1];
        $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
        $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4];
        $dataid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4]."_i01";
    }

    Get_Data("accredscheme",$taccredscheme_id);
    Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$sectionid);
    Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$criteriaid);

    BROW();
    BCOLRIGHT("12");
    XFORM("accredmaintainlistout.php","cancelform");
    XINSTDHID();
    XINHID("accredscheme_id",$taccredscheme_id);
    XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
    BINSUBMITIDSPECIAL("CancelButton","warning","Cancel");
    X_FORM();
    B_COL();
    B_ROW();

    BROW(); BCOLTXTCOLOR("<b>Topic:</b>","2","white","#5499C7"); BCOLTXT("<b>".$GLOBALS{'accredcriteria_section'}."</b>","10");B_ROW();
    XBR();
    BROW(); BCOLTXTCOLOR("<b>Criteria:</b>","2","white","#5499C7"); BCOLTXT(Replace_CRandLF($GLOBALS{'accredcriteria_criteria'},"<br>"),"10");B_ROW();
    XBR();
    BROW(); BCOLTXTCOLOR('<b>Evidence Requirement:'."</b>","2","white","#5499C7"); BCOLTXT(Replace_CRandLF($GLOBALS{'accredcriteria_evidencerequirement'},"<br>"),"10");B_ROW();
    if ($GLOBALS{'accredcriteria_help'} != "") {
        XBR();
        BROW(); BCOLTXTCOLOR("<b>Help:</b>","2","white","#5499C7"); BCOLTXT(Replace_CRandLF($GLOBALS{'accredcriteria_help'},"<br>"),"10");B_ROW();
    }
    if ($GLOBALS{'accredcriteria_templates'} != "") {
        XBR();
        BROW(); BCOLTXTCOLOR("<b>Reference Documents:</b>","2","white","#5499C7"); BCOLTXT($GLOBALS{'accredcriteria_templates'},"10");B_ROW();
    }
    if ($GLOBALS{'accredscheme_ownerenabled'} == "Yes") {
        XBR();
        BROW();
        BCOLTXTCOLOR("<b>Ownership:</b>","2","white","#5499C7");
        BCOL("10");
        XFORM("accredevidencemaintainin.php","accredevidencemaintain");
        XINSTDHID();
        XINHID("accredscheme_id",$taccredscheme_id);
        XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
        XINHID("accredcriteria_id",$taccredcriteria_id);
        $currenttab = "Tab".$taccredcriteria_id[3];
        XINHID("CurrentTab",$currenttab);
        XINHID("AccredUpdate","Owner");
        XTABLE();
        XTR();XTDTXT(View_Person_List($GLOBALS{'accredcriteria_owner'}));
        XTDINTXT("accredcriteria_owner",$GLOBALS{'accredcriteria_owner'},"15","30");XTDINSUBMIT("Update Owner");
        X_TR();
        X_TABLE();
        X_FORM();
        B_COL();
        B_ROW();
    }
    XBR();

    // ===== response ===========================
    Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$evidenceid);
    XHRCLASS('underline');
    XH2("Club Self Assessment");
    XFORM("accredevidencemaintainin.php","accredevidencemaintain");
    XINSTDHID();
    XINHID("accredscheme_id",$taccredscheme_id);
    XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
    XINHID("accredcriteria_id",$taccredcriteria_id);
    XINHID("AccredUpdate","Response");
    $currenttab = "Tab".$taccredcriteria_id[3];
    XINHID("CurrentTab",$currenttab);

    BROW();
    BCOLTXTCOLOR("<b>Compliance:</b>","2","white","#5499C7");
    BCOL("10");
    $xkeylist = "Yes,Partial,No,";
    $xvaluelist = "Fully Compliant,Partially Compliant,Not Compliant,Not Completed Yet";
    XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"accredcriteria_selfassessment",$GLOBALS{'accredcriteria_selfassessment'});
    B_COL();
    BCOLTXT($GLOBALS{'accredcriteria_section'},"10");
    B_ROW();

    /*
     XTD();
     XTXTBOLD("Condition");
     XBR();
     $xkeylist = "Green,Amber,Red";
     $xvaluelist = "Green,Amber,Red";
     XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"accredcriteria_selfevaluation",$GLOBALS{'accredcriteria_selfevaluation'});
     X_TD();
     */
    XBR();
    BROW();
    BCOLTXTCOLOR("<b>Response:</b>","2","white","#5499C7");
    BCOLINTEXTAREA("accredcriteria_evidencetext",$GLOBALS{'accredcriteria_evidencetext'},"5","10");
    B_ROW();


    $dataid = $evidenceid."_i01";
    Check_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$dataid);
    if ($GLOBALS{'IOWARNING'} == "0" ) {
        XBR();
        BROW();
        BCOLTXTCOLOR("<b>Data Collection:</b>","2","white","#5499C7");
        BCOL("10");
        $its = 0;
        $more = "1"; $di = 1;
        while (($more == "1" )&&($its < 9)) {
            $its++;
            $distring = substr("00".$di,-2);
            $dataid = $evidenceid."_i".$distring;
            Check_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$dataid);
            if ($GLOBALS{'IOWARNING'} == "0" ) {
                // accredcriteria_datatextquestion Q1text
                // accredcriteria_datatextresult Q1text
                // accredcriteria_datacheckboxquestions Q1val=Q1Text,Q2val=Q2text,Q3val=Q3text
                // accredcriteria_datacheckboxresult Q1val,Q3val
                // accredcriteria_dataradioquestions Q1val=Q1Text,Q2val=Q2text,Q3val=Q3text
                // accredcriteria_datacheckboxresult Q2val
                $reqmttext = "";
                if ( $GLOBALS{'accredcriteria_datatargetreqd'} != "") { $reqmttext = " - Requirement: ".$GLOBALS{'accredcriteria_datatargetreqd'}; }

                if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
                    BROW();
                    BCOLTXT($GLOBALS{'accredcriteria_datatextquestion'}.$reqmttext,"4");
                    BCOLINTXT("accredcriteria_datatextresult_".$dataid,$GLOBALS{'accredcriteria_datatextresult'},"3");
                    B_ROW();
                    XHR();
                }
                if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
                    $qarray = explode(",",$GLOBALS{'accredcriteria_dataradioquestions'});
                    $qvlist = ""; $qsep = "";
                    $qtlist = "";
                    $rval = "";
                    foreach ($qarray as $qstring) {
                        $qbits = explode("=",$qstring);
                        $qvlist = $qvlist.$qsep.$qbits[0];
                        $qtlist = $qtlist.$qsep.$qbits[1];
                        $qsep = ",";
                    }
                    BROW();
                    BCOLTXT($GLOBALS{'accredcriteria_datafieldtitle'}.$reqmttext,"4");
                    BCOL("8");
                    $qhash = Lists2Hash($qvlist,$qtlist);
                    # hash name valuelist
                    XTDINRADIOHASH ($qhash,"accredcriteria_dataradioresult_".$dataid,$GLOBALS{'accredcriteria_dataradioresult'});
                    B_COL();
                    B_ROW();
                    XHR();
                }
                if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
                    $qarray = explode(",",$GLOBALS{'accredcriteria_datacheckboxquestions'});
                    $qvlist = ""; $qsep = "";
                    $qtlist = "";
                    $rlist = ""; $rsep = "";
                    foreach ($qarray as $qstring) {
                        $qbits = explode("=",$qstring);
                        $qvlist = $qvlist.$qsep.$qbits[0];
                        $qtlist = $qtlist.$qsep.$qbits[1];
                        $qsep = ",";
                    }
                    BROW();
                    BCOLTXT($GLOBALS{'accredcriteria_datafieldtitle'}.$reqmttext,"4");
                    BCOL("8");
                    $qhash = Lists2Hash($qvlist,$qtlist);
                    # hash name valuelist
                    XTDINCHECKBOXHASH ($qhash,"accredcriteria_datacheckboxresult_".$dataid,$GLOBALS{'accredcriteria_datacheckboxresult'});
                    B_COL();
                    B_ROW();
                    XHR();
                }
                $di++;
            } else {
                $more = "0";
            }
        }
        B_COL();
        B_ROW();
    }
    XBR();
    BROW();
    BCOLTXT("","2");
    BCOLINSUBMITID ("responsebutton","Save Response","3");
    B_ROW();
    X_FORM();

    Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$taccredcriteria_id); // because other data records will have been read

    if ($GLOBALS{'accredcriteria_evidenceassetcodesreqd'} != "No") {
        XHR();
        XH3("Evidence Documents");
        BROW();
        BCOLTXTCOLOR("Evidence Title","3","#D6DBDF","black");
        BCOLTXTCOLOR("Library Section","3","#D6DBDF","black");
        BCOLTXTCOLOR("&nbsp;","3","#D6DBDF","black");
        BCOLTXTCOLOR("&nbsp;","3","#D6DBDF","black");
        B_ROW();
        XBR();
        if ( $GLOBALS{'accredcriteria_evidenceassetcodes'} != "" ) {
            $evidenceassetcodesa = explode(',', $GLOBALS{'accredcriteria_evidenceassetcodes'} );
            $evidenceseq = 0;
            foreach ($evidenceassetcodesa as $evidenceassetcode) {
                Check_Data('asset',$taccredcriteria_clubid,$evidenceassetcode);
                if ($GLOBALS{'IOWARNING'} == "1") { $GLOBALS{'asset_title'} = $evidenceassetcode." Not Found"; }
                XFORM("accredevidencemaintainin.php","accredevidencemaintain");
                XINSTDHID();
                XINHID("accredscheme_id",$taccredscheme_id);
                XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
                XINHID("accredcriteria_id",$taccredcriteria_id);
                XINHID("AccredUpdate","EvidenceAsset");
                XINHID("EvidenceAssetCode",$evidenceassetcode);
                XINHID("EvidenceSeq",$evidenceseq);
                $currenttab = "Tab".$taccredcriteria_id[3];
                XINHID("CurrentTab",$currenttab);
                BROW();
                BCOLTXT($GLOBALS{'asset_title'},"3");
                BCOLINSELECTHASH (Get_Library_Select_Hash(),"asset_librarysection",$GLOBALS{'asset_librarysection'},"3");
                BCOL("3");XINSUBMITNAME("SubmitAction","Update Link to Document");B_COL();
                BCOL("3");XINSUBMITNAME("SubmitAction","Delete Link to Document");B_COL();
                B_ROW();
                XHR();
                X_FORM();
                $evidenceseq++;
            }
        }
        XFORM("accredevidencemaintainin.php","accredevidencemaintainin");
        XINSTDHID();
        XINHID("accredscheme_id",$taccredscheme_id);
        XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
        XINHID("accredcriteria_id",$taccredcriteria_id);
        XINHID("AccredUpdate","EvidenceAsset");
        XINHID("EvidenceSeq","New");
        $currenttab = "Tab".$taccredcriteria_id[3];
        XINHID("CurrentTab",$currenttab);
        BROW();
        BCOLTXT("New Document","3");
        BCOLINSELECTHASH (Get_Library_Select_Hash(),"asset_librarysection","","3");
        BCOL("3");XINSUBMITNAME("SubmitAction","Add Link to Document");B_COL();
        BCOLTXT("","3");
        B_ROW();
        X_FORM();
    }

    $GLOBALS{'CROPPARMS'} = Array();
    if ($GLOBALS{'accredcriteria_evidenceimagelistreqd'} != "No") {
        XHR();
        XH3("Evidence Images");
        BROW();
        BCOLTXTCOLOR("Evidence Image","3","#D6DBDF","black");
        BCOLTXTCOLOR("&nbsp;","3","#D6DBDF","black");
        BCOLTXTCOLOR("&nbsp;","3","#D6DBDF","black");
        BCOLTXTCOLOR("&nbsp;","3","#D6DBDF","black");
        B_ROW();
        XBR();
        if ( $GLOBALS{'accredcriteria_evidenceimagelist'} != "" ) {
            $evidenceimagelista = explode(',', $GLOBALS{'accredcriteria_evidenceimagelist'} );
            $evidenceseq = 0;
            foreach ($evidenceimagelista as $evidenceimage) {

                XFORM("accredevidencemaintainin.php","accredevidencemaintain");
                XINSTDHID();
                XINHID("accredscheme_id",$taccredscheme_id);
                XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
                XINHID("accredcriteria_id",$taccredcriteria_id);
                XINHID("AccredUpdate","EvidenceImage");
                XINHID("EvidenceSeq",$evidenceseq);
                XINHID("accredcriteria_evidenceimagelist",$GLOBALS{'accredcriteria_evidenceimagelist'});
                $currenttab = "Tab".$taccredcriteria_id[3];
                XINHID("CurrentTab",$currenttab);
                BROW();
                BCOLTXT("Image ".($evidenceseq+1),"3");
                BCOL("3");
                // =================== Slim Image Cropper Output =======================
                $imagefieldname = "EvidenceImageName".$evidenceseq;
                $imageviewwidth = "200";
                $imagename = $evidenceimagelista[$evidenceseq];
                $imageuploadto = "Accred".$taccredscheme_id;
                $imageuploadid = $taccredcriteria_clubid.$taccredcriteria_id;
                $imageuploadwidth = "800";
                $imageuploadheight = "500";
                $imageuploadfixedsize = "800x500";
                $imagethumbwidth = "400";
                XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
                array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
                    $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
                B_COL();
                BCOL("3");XINSUBMITNAME("SubmitAction","Save Image");B_COL();
                BCOL("3");XINSUBMITNAME("SubmitAction","Delete Image");B_COL();
                B_ROW();
                XBR();
                X_FORM();
                $evidenceseq++;
            }
        }
        XFORM("accredevidencemaintainin.php","accredevidencemaintain");
        XINSTDHID();
        XINHID("accredscheme_id",$taccredscheme_id);
        XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
        XINHID("accredcriteria_id",$taccredcriteria_id);
        XINHID("AccredUpdate","EvidenceImage");
        XINHID("EvidenceSeq","New");
        XINHID("accredcriteria_evidenceimagelist",$GLOBALS{'accredcriteria_evidenceimagelist'});
        $currenttab = "Tab".$taccredcriteria_id[3];
        XINHID("CurrentTab",$currenttab);
        BROW();
        BCOLTXT("New Image","3");
        BCOL("3");
        // =================== Slim Image Cropper Output =======================
        $imagefieldname = "EvidenceImageNew";
        $imageviewwidth = "200";
        $imagename = "";
        $imageuploadto = "Accred".$taccredscheme_id;
        $imageuploadid = $taccredcriteria_clubid.$taccredcriteria_id;
        $imageuploadwidth = "800";
        $imageuploadheight = "500";
        $imageuploadfixedsize = "800x500";
        $imagethumbwidth = "400";
        XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
        array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
            $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
        B_COL();
        BCOL("3");XTDINSUBMITNAME("Save Image","SubmitAction");B_COL();
        BCOLTXT("","3");
        B_ROW();
        X_FORM();
    }

    if ($GLOBALS{'accredscheme_reviewenabled'} == "Yes") {
        // ===== review ===========================
        XHRCLASS('underline');
        XH2("Internal Review Comments");
        XFORM("accredevidencemaintainin.php","accredevidencemaintain");
        XINSTDHID();
        XINHID("accredscheme_id",$taccredscheme_id);
        XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
        XINHID("accredcriteria_id",$taccredcriteria_id);
        XINHID("AccredUpdate","Comments");
        $currenttab = "Tab".$taccredcriteria_id[3];
        XINHID("CurrentTab",$currenttab);
        BROW();
        BCOLTXTCOLOR("<b>Comments:</b>","2","white","#5499C7");
        BCOLINTEXTAREA("accredcriteria_reviewcomments",$GLOBALS{'accredcriteria_reviewcomments'},"10","5");
        B_ROW();
        XBR();
        BROW();
        BCOLTXT("","2");
        BCOLINSUBMITID ("reviewbutton","Update Comments","3");
        B_ROW();
        X_FORM();
        XBR();
    }
    if ($GLOBALS{'accredscheme_inspectionenabled'} == "Yes") {
        // ===== review ===========================
        /*
         XHRCLASS('underline');
         XH2("Inspection Review Comments");
         XTABLE();
         XTR();XTD();
         $xkeylist = "Pass,Advisory,Fail";
         $xvaluelist = "Pass,Advisory,Fail";
         XINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"accredcriteria_inspectionresult",$GLOBALS{'accredcriteria_inspectionresult'});
         X_TD();X_TR();
         XTR();XTD();
         XINTEXTAREA('accredcriteria_inspectioncomments',$GLOBALS{'accredcriteria_inspectioncomments'},5,120);
         X_TD();X_TR();
         X_TABLE();
         */
    }

    XBR();
    $link = YPGMLINK("accredmaintainlistout.php").YPGMSTDPARMS();
    $link = $link.YPGMPARM("accredscheme_id",$taccredscheme_id).YPGMPARM("accredcriteria_clubid",$taccredcriteria_clubid);
    XLINKTXT($link,"Return to Accreditation List");

    foreach($GLOBALS{'CROPPARMS'} as $cropelement) {
        $cbits = explode('|',$cropelement);
        SlimImageCropper_Popup($cbits[0], $cbits[1], $cbits[2], $cbits[3], $cbits[4], $cbits[5], $cbits[6], $cbits[7], $cbits[8]);
    }
}

function Library_ACCREDLIBRARYLINKER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}


function Library_ACCREDLIBRARYLINKER_Output ($taccredscheme_id,$taccredcriteria_clubid,$taccredcriteria_id,$evidenceseq,$evidenceasset_code,$librarysection_id) {
	# accredscheme_id accred_id
    // XH5($taccredscheme_id."|".$taccredcriteria_clubid."|".$taccredcriteria_id."|".$evidenceseq."|".$evidenceasset_code."|".$librarysection_id);
	if ($evidenceasset_code == "Add") {$actiontext = "Add New";}
	else {$actiontext = "Update";}
	XH3("$actiontext Evidence Link to Club Library");

	// a_01       section
	// a_01_09    criteria
	// a_01_09_e01 evidence
	// a_01_09_e02 evidence
	// a_01_09_e02_i01 data
	// a_01_09_e02_i02 data
	$abits = explode("_",$taccredcriteria_id); // evidence id
	$sectionid = $abits[0]."_".$abits[1];
	$criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
	XTABLE();
	Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$sectionid);
	XTR();XTDHTXT("Section");XTDTXTWIDTH($GLOBALS{'accredcriteria_section'},"500");X_TR();
	Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$criteriaid);
	XTR();XTDHTXT("Criteria");XTDTXTWIDTH($GLOBALS{'accredcriteria_criteria'},"500");X_TR();
	Get_Data("accredcriteria",$taccredscheme_id,$taccredcriteria_clubid,$taccredcriteria_id);
	XTR();XTDHTXT('Evidence Requirement - '.$GLOBALS{'accredcriteria_ref'});XTDTXTWIDTH($GLOBALS{'accredcriteria_evidencerequirement'},"500");X_TR();
	XTR();XTDHTXT("Help");XTDTXTWIDTH($GLOBALS{'accredcriteria_help'},"500");X_TR();
	XTR();XTDHTXT("Templates");XTDTXTWIDTH($GLOBALS{'accredcriteria_templates'},"500");X_TR();
	X_TABLE();
	XBR();XBR();
	Check_Data("librarysection",$librarysection_id);
	if ($GLOBALS{'IOWARNING'} == "1") {$GLOBALS{'librarysection_title'} = "Library Section Not Found"; }
	XH4('Existing documents in "'.$GLOBALS{'librarysection_title'}.'" section of library');
	XDIV("reportdiv_LibraryView","container");
	XINHIDID("reportwidth","reportwidth","100%");
	XINHIDID("reportheight","reportheight","50vh");
	XINHIDID("reportalign","reportalign","left");
	XTABLEJQDTID("reporttable_LibraryView");
	XTHEAD();
	XTRJQDT();
	XTR();
	XTDHTXT("date - yyyy-mm-dd");
	XTDHTXT("title");
	XTDHTXT("file name");
	XTDHTXT("author");
	XTDHTXT("description");
	XTDHTXT("");
	if ($evidenceasset_code == "Add") {XTDHTXT("Add<br/>Evidence");}
	else {XTDHTXT("Current<br/>Selection");XTDHTXT("New<br/>Selection");}
	X_TR();
	X_THEAD();
	XTBODY();
	$assetsa = Get_Array_Hash_SortSelect('asset',$taccredcriteria_clubid,"asset_title","","");
	$assetfound = "0";
	foreach ($assetsa as $asset_code) {
	    Get_Data("asset",$taccredcriteria_clubid,$asset_code);
    	if (($librarysection_id == $GLOBALS{'asset_librarysection'})||($librarysection_id == "All")) {
        	 $assetfound = "1";
        	 XTRJQDT();
        	 if ($GLOBALS{'asset_createdate'} != "") {
        	     XTDTXT($GLOBALS{'asset_createdate'});
        	 } else {
        	     $abits = str_split($asset_code);
        	     XTDTXT($abits[0].$abits[1].$abits[2].$abits[3]."-".$abits[4].$abits[5]."-".$abits[7].$abits[8]);
        	 }
        	 XTDTXTWIDTH($GLOBALS{'asset_title'},200);
        	 XTDTXTWIDTH($GLOBALS{'asset_file'},200);
        	 XTDTXT($GLOBALS{'asset_author'});
        	 XTDTXTWIDTH($GLOBALS{'asset_description'},250);
        	 if ((strlen(strstr($GLOBALS{'asset_file'},"http://"))>0)||(strlen(strstr($GLOBALS{'asset_file'},"https://"))>0)) {
        		   $link = $GLOBALS{'asset_file'};
        		   XTDLINKTXT($link,"view");
        	 } else {
        		   $link = YPGMLINK("librarydownloadin.php");
        		   $link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$taccredcriteria_clubid).YPGMPARM("asset_code",$asset_code);
        		   XTDLINKTXT($link,"view");
        	 }
        	 if ($evidenceasset_code == $asset_code) {
        		   XTDTXT("Current<br>Selection");
        		   XTDTXT("");
        	 } else {
        		   $link = YPGMLINK("accredevidencemaintainin.php");
        		   $link = $link.YPGMSTDPARMS();
        		   $link = $link.YPGMPARM("accredscheme_id",$taccredscheme_id).YPGMPARM("accredcriteria_clubid",$taccredcriteria_clubid).YPGMPARM("accredcriteria_id",$taccredcriteria_id);
        		   $link = $link.YPGMPARM("AccredUpdate","EvidenceAsset").YPGMPARM("EvidenceSeq",$evidenceseq);
        		   $link = $link.YPGMPARM("EvidenceAssetCode",$asset_code).YPGMPARM("asset_librarysection",$librarysection_id).YPGMPARM("SubmitAction",LibraryLinked);
        		   $currenttab = "Tab".$taccredcriteria_id[3];
        		   $link = $link.YPGMPARM("CurrentTab",$currenttab);
        		   if ($evidenceasset_code == "Add") {XTDLINKTXT($link,"select");}
        		   else {XTDTXT("");XTDLINKTXT($link,"select");}
        	 }
        	 X_TR();
    	}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("reportdiv_LibraryView");
	XCLEARFLOAT();
	XINHID("LibraryView_sortcol",0);
	XINHID("LibraryView_sortseq","desc");
	XBR();
	// if ($assetfound == "0") { XPTXT("There are no items registered in this library section") ;}
	XH4("Add a new Document if one does not already exist in the Library");
	XFORMUPLOAD("accredevidencemaintainin.php","accredevidencemaintain");
	XINSTDHID();

	XINHID("accredscheme_id",$taccredscheme_id);
	XINHID("accredcriteria_clubid",$taccredcriteria_clubid);
	XINHID("accredcriteria_id",$taccredcriteria_id);
	XINHID("AccredUpdate","EvidenceAsset");
	XINHID("EvidenceSeq",$evidenceseq);
	XINHID("SubmitAction","LibraryAdded");
	XINHID("EvidenceAssetCode","New");
	$currenttab = "Tab".$taccredcriteria_id[3];
	XINHID("CurrentTab",$currenttab);
	XTABLE();
	XTR();XTDHTXT("Information");XTDHTXT("");X_TR();
	XTR();XTDTXT("Title");XTDINTXT("asset_title","","30","60");X_TR();
	XTR();XTDTXT("Description");XTDINTEXTAREA("asset_description","","5","30");X_TR();
	XTR();XTDTXT("Library Section");XTDINSELECTHASH(Get_Library_Select_Hash(),"asset_librarysection",$librarysection_id);X_TR();
	XTR();XTDTXT("File Name");XTDINFILE("asset_file","30000000");X_TR();
	XTR();XTDTXT("Author");XTDINTXT("asset_author","","20","40");X_TR();
	XTR();XTDTXT("Date Created - dd/mm/yy");XTDINDATEYYYY_MM_DD("asset_createdate","");X_TR();
	XTR();XTDTXT("Date to be Reviewed - dd/mm/yy");XTDINDATEYYYY_MM_DD("asset_reviewdate","");X_TR();
	XTR();XTDTXT("Asset Security Level");
	$xkeylist = "0,1,2";
	$xvaluelist = "Public,Login only,Committee only";
	XTDINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"asset_security",$GLOBALS{'asset_security'});
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Library_WEBLIBRARYLINKER_Output1 () {
	XH3("Link to Club Library - 1");
	# $helplink = "AdminMaster/Setup_ASSETSLIST_Output/setup_assetslist_output.html"; Help_Link;
	XPTXT("Please select the library section");
	XFORM("weblibrarylinker2.php","weblibrarylinker");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Library Section");XTDHTXT("");X_TR();
	$xhash = Get_Library_Select_Hash();
	$xhash["All"] = "All";
	XTR();XTDINSELECTHASH($xhash,"LibrarySection","");XTDINSUBMIT("Search");X_TR();
	X_TABLE();
	X_FORM();
}


function Library_WEBLIBRARYLINKER_Output2 ($asset_clubid) {
	# $librarysection_id
	$librarysection_id = $parm0;
	X_TABLE();
	XBR();XBR();
	Check_Data("librarysection",$librarysection_id);
	if ($GLOBALS{'IOWARNING'} == "1") { $GLOBALS{'librarysection_title'} = "Library Section Not Found"; }
	XH4('Existing documents in "'.$GLOBALS{'librarysection_title'}.'" section of library.');
	XTABLE();
	XTR();
	XTDHTXT("date<BR>dd/mm/yy");
	XTDHTXT("title");
	XTDHTXT("file name");
	XTDHTXT("author");
	XTDHTXT("description");
	XTDHTXT("");
	if ($evidenceasset_code == "Add") {XTDHTXT("Add<br/>Evidence");}
	else {XTDHTXT("Current<br/>Selection");XTDHTXT("New<br/>Selection");}
	X_TR();
	$assetsa = Get_Array_Hash_SortSelect('asset',$asset_clubid,"asset_title","","");
	$assetfound = "0";
	foreach ($assetsa as $asset_code) {
	    Get_Data("asset",$asset_clubid,$asset_code);
	 if (($librarysection_id == $GLOBALS{'asset_librarysection'})||($librarysection_id == "All")) {
	  $assetfound = "1";
	  XTR();
	  $abits = str_split($asset_code);
	  XTDTXT("$abits[6]$abits[7]/$abits[4]$abits[5]/$abits[2]$abits[3]");
	  XTDTXTWIDTH($GLOBALS{'asset_title'},200);
	  XTDTXTWIDTH($GLOBALS{'asset_file'},200);
	  XTDTXT($GLOBALS{'asset_author'});
	  XTDTXTWIDTH($GLOBALS{'asset_description'},250);
	  if ((strlen(strstr($GLOBALS{'asset_file'},"http://"))>0)||(strlen(strstr($GLOBALS{'asset_file'},"https://"))>0)) {
	   $link = $GLOBALS{'asset_file'};
	   XTDLINKTXT($link,"view");
	  } else {
	   $link = YPGMLINK("librarydownloadin.php");
	   $link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code);
	   XTDLINKTXT($link,"view");
	  }
	  if ($evidenceasset_code == $asset_code) {
		   XTDTXT("Yes");
		   XTDTXT("");
	  } else {
		   $link = YPGMLINK("accredevidencemaintainin.php");
		   $link = $link.YPGMSTDPARMS();
		   $link = $link.YPGMPARM("accredscheme_id",$taccredscheme_id).YPGMPARM("accredcriteria_clubid",$taccredcriteria_clubid).YPGMPARM("accredcriteria_id",$taccredcriteria_id);
		   $link = $link.YPGMPARM("AccredUpdate","EvidenceAsset").YPGMPARM("EvidenceSeq",$evidenceseq);
		   $link = $link.YPGMPARM("EvidenceAssetCode",$asset_code).YPGMPARM("asset_librarysection",$librarysection_id).YPGMPARM("SubmitAction",LibraryLinked);
		   $currenttab = "Tab".$taccredcriteria_id[3];
		   $link = $link.YPGMPARM("CurrentTab",$currenttab);
		   if ($evidenceasset_code == "Add") {XTDLINKTXT($link,"select");}
		   else {XTDTXT("");XTDLINKTXT($link,"select");}
	  }
	  X_TR();
	 }
	}
	X_TABLE();
	if ($assetfound == "0") {XPTXT("There are no items registered in this library section"); }
}

function Library_LIBRARYMAINTAIN_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Library_LIBRARYMAINTAIN_Output2 ($librarysection_id,$asset_clubid) {
    XH3("Library Maintenance - ".$asset_clubid);
    XBR();
    # $helplink = "AdminMaster/Setup_ASSETSLIST_Output/setup_assetslist_output.html"; Help_Link;
    Check_Data("librarysection",$librarysection_id);
    if ($GLOBALS{'IOWARNING'} == "1") {$GLOBALS{'librarysection_title'} = "Library Section Not Found"; }
    XH4($GLOBALS{'librarysection_title'});
    XTABLEJQDTID("reporttable_LibraryView");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("date<BR>dd/mm/yy");
    XTDHTXTFIXED("title","500");
    # XTDHTXTFIXED("file name","100");
    # XTDHTXT("author");
    #�XTDHTXT("Library section");
    XTDHTXT("filed by");
    XTDHTXT("");XTDHTXT("");XTDHTXT("");
    X_TR();
    X_THEAD();
    XTBODY();
    $assetsa = Get_Array_Hash_SortSelect('asset',$asset_clubid,"asset_title","","");
    $formseq = 0;
    foreach ($assetsa as $asset_code) {
        Get_Data("asset",$asset_clubid,$asset_code);
     if (($librarysection_id == $GLOBALS{'asset_librarysection'})||($librarysection_id == "All")) {
      XTR();
      if ($GLOBALS{'asset_createdate'} != "") {
               XTDTXT(YYYY_MM_DDtoDDsMMsYY($GLOBALS{'asset_createdate'}));
      }	else {
               $abits = str_split($asset_code);
               XTDTXT("$abits[6]$abits[7]/$abits[4]$abits[5]/$abits[2]$abits[3]");
      }
      XTDTXTWIDTH($GLOBALS{'asset_title'},"500");
      # XTDTXTWIDTH($GLOBALS{'asset_file'},"100");
      #�XTDTXT($GLOBALS{'asset_author'});
      #�Check_Data("librarysection",$GLOBALS{'asset_librarysection'}); XTDTXT($GLOBALS{'librarysection_title'});
      XTDTXT($GLOBALS{'asset_submitter'});
      $link = YPGMLINK("libraryassetupdateout.php").YPGMSTDPARMS();
      $link = $link.YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code).YPGMPARM("ACD","C").YPGMPARM("LibrarySection",$librarysection_id);
      XTDLINKTXT($link,"update");
      if (($GLOBALS{'LOGIN_person_id'} == $GLOBALS{'asset_submitter'})||
          (strlen(strstr($GLOBALS{'person_authority'},"AM#Domain"))>0)||
          (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0)) {
               $link = YPGMLINK("libraryassetupdatein.php").YPGMSTDPARMS();
               $link = $link.YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code).YPGMPARM("ACD","D").YPGMPARM("LibrarySection",$librarysection_id);
               XTDLINKTXT($link,"delete");
      } else {
               XTDTXT("");
      }
      if ($GLOBALS{'asset_link'} != "") {
              $link = $GLOBALS{'asset_link'};
              $httpfound = "0";
              if (strlen(strstr($link,'http://'))>0) { $httpfound = "1"; }
              if (strlen(strstr($link,'https://'))>0) { $httpfound = "1"; }
              if ( $httpfound == "0" ) { $link = "http://".$link; }
               XTDLINKTXTNEWWINDOW($link,"view","View");
      } else {
               $link = YPGMLINK("librarydownloadin.php");
               $link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code);
               XTDLINKTXTNEWWINDOW($link,"view","Download");
      }
      X_TR();
      $formseq++;
     }
    }
    X_TBODY();
    X_TABLE();
    XBR();XBR();
    XFORM("libraryassetupdateout.php","librarymaintenance");
    XINSTDHID();
    XINHID("ACD","A1");
    XINHID("LibrarySection",$librarysection_id);
    XINHID("asset_clubid",$asset_clubid);
    XINSUBMIT("Add a new library document");
    X_FORM();
    $link = YPGMLINK("librarymaintainout1.php").YPGMSTDPARMS();
    $link = $link.YPGMPARM("asset_clubid",$asset_clubid);
    XBR();XLINKTXT($link,"Library Maintenance Menu");
}

function Library_LIBRARYMAINTAINDELETE_Output ($librarysection_id,$asset_clubid,$asset_code) {
	XH3("Club Library Maintenance");
	# $helplink = "AdminMaster/Setup_ASSETSLIST_Output/setup_assetslist_output.html"; Help_Link;
	XFORM("libraryassetdeletein.php","librarymaintenancedelete");
	XINSTDHID();
	XINHID("LibrarySection",$librarysection_id);
	XINHID("asset_clubid",$asset_clubid);
	XINHID("asset_code",$asset_code);
	XTXT('This document "'.$GLOBALS{'asset_title'}.'" will now be deleted. Are you sure?'); XBR(); XBR();
	XINSUBMIT("Delete document");
	X_FORM();
}

function Library_ASSET_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "bootstrapdatepicker,datepickerYYYYMMDD";
}

function Library_ASSET_Output ($thislibrarysection_id,$asset_clubid,$asset_code,$acd) {
    // XH1($thislibrarysection_id." ".$asset_clubid." ".$asset_code." ".$acd);
	Check_Data("librarysection",$thislibrarysection_id);
	$thislibrarysection_title = $GLOBALS{'librarysection_title'};
	XH3("Club Library Administration");
	if ($acd == "A1") { XH4('Create New Asset in '.$thislibrarysection_title); }
	if ($acd == "A2") { XH4('Successfully Created - "'.$GLOBALS{'asset_title'}.'" in '.$thislibrarysection_title); }
	if ($acd == "C") {  XH4('Update - "'.$GLOBALS{'asset_title'}.'" in '.$thislibrarysection_title); }
	# $helplink = "AdninMaster/Setup_ASSET_Output/setup_asset_output.html"; Help_Link;
	XFORMUPLOAD("libraryassetupdatein.php","librarymaintenance");
	XINSTDHID();
	if ($acd == "A1") { $nextacd = "A2"; }
	if ($acd == "A2") { $nextacd = "C"; }
	if ($acd == "C") { $nextacd = "C"; }
	XINHID("ACD",$nextacd);
	XINHID("asset_clubid",$asset_clubid);
	XINHID("asset_code",$asset_code);
	XINHID("LibrarySection",$thislibrarysection_id);
	XTABLE();
	XTR();XTDHTXT("Information");XTDHTXTFIXED("Old Value","300");XTDHTXT("New Value");X_TR();

	XTR();XTDTXT("Asset Code");XTDTXT($GLOBALS{'asset_code'});XTDTXT("");X_TR();
	XTR();XTDTXT("Title");XTDTXT("");XTDINTXT("asset_title",$GLOBALS{'asset_title'},"40","100");X_TR();
	XTR();XTDTXT("Description");XTDTXTWIDTH("","300");XTDINTEXTAREA("asset_description",$GLOBALS{'asset_description'},"5","30");X_TR();
	if ($acd == "A1") { $tasset_librarysection = $thislibrarysection_id; }
	else { $tasset_librarysection = $GLOBALS{'asset_librarysection'}; }
	XTR();XTDTXT("Library Section");XTDTXT("");XTDINSELECTHASH(Get_Library_Select_Hash(),"AssetLibrarySection",$tasset_librarysection);X_TR();
	XTR();XTDTXT("Library File Name or Link");
	XTDFIXED("300");

	if ($GLOBALS{'asset_link'} != "") {
		 XTXT($GLOBALS{'asset_link'});XBR();XBR();
		 $link = $GLOBALS{'asset_link'};
		 XLINKTXTNEWWINDOW($link,"test view","Test View");
	}
	if ($GLOBALS{'asset_file'} != "") {
		XTXT($GLOBALS{'asset_file'});XBR();XBR();
		$link = YPGMLINK("librarydownloadin.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code);
		 XLINKTXTNEWWINDOW($link,"test view","Test View");
	}

	X_TD();
	XTD();XTXT("File");XINFILE("asset_file","300000");XBR();
	XTXT("Link");XBR();XINTEXTAREA("AssetLink",$GLOBALS{'asset_link'},"3","30");X_TD();
	X_TR();

	XTR();XTDTXT("Author");XTDTXT("");XTDINTXT("asset_author",$GLOBALS{'asset_author'},"20","40");X_TR();
	if ($acd != "A1") {
	 $abits = str_split($asset_code);
	 XTR();XTDTXT("Filed by");XTDTXT($GLOBALS{'asset_submitter'});XTDTXT("");X_TR();
	}
	XTR();XTDTXT("Date Created - dd/mm/yyyy");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'asset_createdate'}));XTDINDATEYYYY_MM_DD("asset_createdate",$GLOBALS{'asset_createdate'});X_TR();
	XTR();XTDTXT("Date to be Reviewed - dd/mm/yyyy");XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'asset_reviewdate'}));XTDINDATEYYYY_MM_DD("asset_reviewdate",$GLOBALS{'asset_reviewdate'});X_TR();
	XTR();XTDTXT("Asset Security Level");
	$xkeylist = "0,1,2";
	$xvaluelist = "Public,Login only,Committee only";
	XTDINRADIOHASH (Lists2Hash($xkeylist,$xvaluelist),"asset_security",$GLOBALS{'asset_security'});
	X_TR();

	if ($GLOBALS{'asset_security'} == "0") {
		if ($GLOBALS{'asset_link'} != "") {
		  $link = $GLOBALS{'asset_link'};
		  $httpfound = "0";
		  if (strlen(strstr($link,'http://'))>0) { $httpfound = "1"; }
		  if (strlen(strstr($link,'https://'))>0) { $httpfound = "1"; }
		  if ( $httpfound == "0" ) { $link = "http://".$link; }
		  XTR();
		  XTDTXT("Test Link");
		  XTDLINKTXTNEWWINDOW($link,$GLOBALS{'asset_title'},"View");
		  XTDTXT("");
		  X_TR();
		  XTR();XTDTXT("Cut and paste the following into the Composer Link.");
		  XTD();
		  // $linkhtml = YLINKTXTNEWWINDOW($link,$GLOBALS{'asset_title'},"View");XBR();
		  XINTEXTAREA("",$link,"5","50");
		  X_TD();
		  XTDTXT("");
		  X_TR();
	 } else {
		  $link = YPGMLINK("librarydownloadin.php");
		  $link = $link.YPGMMINPARMS().YPGMPARM("asset_clubid",$asset_clubid).YPGMPARM("asset_code",$asset_code);
		  XTR();
		  XTDTXT("Test Link");
		  XTDLINKTXTNEWWINDOW($link,$GLOBALS{'asset_title'},"View");
		  XTDTXT("");
		  X_TR();
		  XTR();XTDTXT("Cut and paste the following into the Composer Link.");
		  XTD();
		  // $linkhtml = YLINKTXTNEWWINDOW($link,$GLOBALS{'asset_title'},"View");XBR();
		  XINTEXTAREA("",$link,"5","50");
		  X_TD();
		  XTDTXT("");
		  X_TR();
	 }
	}

	XTR();XTDTXT("");XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	if ($acd != "A1") {
		 XFORM("libraryassetupdatein.php","librarymaintenance");
		 XINSTDHID();
		 XINHID("ACD","A1");
		 XINHID("LibrarySection",$thislibrarysection_id);
		 XINHID("asset_clubid",$asset_clubid);
		 XINSUBMIT("Add a new library document");
		 X_FORM();
	}
	$link = YPGMLINK("librarymaintainout2.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("LibrarySection",$thislibrarysection_id);
	$link = $link.YPGMPARM("asset_clubid",$asset_clubid);
	XBR();XLINKTXT($link,'review list of assets in "'.$thislibrarysection_title.'" section of library.');
	$link = YPGMLINK("librarymaintainout1.php").YPGMSTDPARMS();
	$link = $link.YPGMSTDPARMS().YPGMPARM("asset_clubid",$asset_clubid);
	XBR();XLINKTXT($link,"Library Maintenance Menu");
}

function Get_Library_Select_Hash (){
	$tlibdirfiles = Get_Array_Hash('librarysection');
	$librarysectiontemparray = Array();
	foreach ($tlibdirfiles as $tlibrarysection_id) {
		 if ($tlibrarysection_id != "libraryroot") {
			  Get_Data_Hash('librarysection',$tlibrarysection_id);
			  $libbit5s = explode('/',$GLOBALS{'librarysection_sequence'});
			  $libhierarchy = count($libbit5s);
			  $arrayelement = $GLOBALS{'librarysection_sequence'}."/000/000/000/000/000/000/000/000/000"."^".$tlibrarysection_id;
			  array_push($librarysectiontemparray, $arrayelement);
		 }
	}
	sort($librarysectiontemparray);
	$outkeya = Array(); $outtexta = Array();
	foreach ($librarysectiontemparray as $librarysectionelement) {
		 $libbit3s = explode('^', $librarysectionelement );
		 $tlibrarysection_id = $libbit3s[1];
		 Get_Data_Hash('librarysection',$tlibrarysection_id);
		 $libbit5s = explode('/',$GLOBALS{'librarysection_sequence'});
		 $libhierarchy = count($libbit5s);
		 $libtext = ""; for ($inset = 0; $inset < $libhierarchy; $inset++) { $libtext = $libtext."..."; }
		 $libtext = $libtext.$GLOBALS{'librarysection_title'};
		 array_push($outkeya, $tlibrarysection_id);
		 array_push($outtexta, $libtext);
	}
	return Arrays2Hash ($outkeya, $outtexta);
}

function Library_ACCREDACTIONVIEWLIST_CSSJS () {
	session_start();
    // $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    // $GLOBALS{'SITEJSOPTIONAL'} = "rememberbtab,jqdatatablesmin,simpletable";
}

function Library_ACCREDACTIONVIEWLIST_Output ($activeaccredscheme_id,$taccredcriteria_clubid) {
    $currenttab = "Tab1";
    if ($activeaccredscheme_id == "Active") {
        $activeaccredscheme_id = "";
        $taccredscheme_ida = Get_Array('accredscheme');
        foreach ($taccredscheme_ida as $taccredscheme_id) {
            Check_Data("accredscheme",$taccredscheme_id);
						if ($GLOBALS{'accredscheme_active'} == "Yes" && $GLOBALS{'accredscheme_type'} == "Normal"){$activeaccredscheme_id = $taccredscheme_id;}
        }
    }


    Check_Data("accredscheme",$activeaccredscheme_id);
    if ($GLOBALS{'IOWARNING'} == "1") {
        XH5("No accreditation criteria found");
    } else {
        if ($GLOBALS{'accredscheme_logolink'} != "") { XIMGFLEX($GLOBALS{'accredscheme_logolink'}); }
        // XH3("Accreditation - ".$GLOBALS{'accredscheme_authority'}." - ".$GLOBALS{'accredscheme_name'}." - Version ".$GLOBALS{'accredscheme_version'});
        XH2("Development Plan");
        $accredcriteriaa = Get_Array('accredcriteria',$activeaccredscheme_id,$taccredcriteria_clubid);
        sort($accredcriteriaa);
        XHRCLASS("underline");

        XFORMUPLOAD("accredactionupdateout.php","accredactionupdate");
        XINSTDHID();
        XINHID("accredaction_schemeid",$activeaccredscheme_id);
        XINHID("accredaction_clubid",$taccredcriteria_clubid);
        XINHID("accredaction_id","New");
        XINSUBMIT("Add New Development Action Item");
        X_FORM();
        XBR();
        $accredactionsorta = Array();
        $accredactiona = Get_Array("accredaction",$activeaccredscheme_id,$taccredcriteria_clubid);
				// print($activeaccredscheme_id);
        // $accredactiona = Get_Data("accredaction","CharterStandard",$taccredcriteria_clubid);
        // $accredactiona = Get_Array_Select("accredaction",["accredaction_schemeid",$activeaccredscheme_id,"accredaction_clubid",$taccredcriteria_clubid],"accredaction_id");
        // $accredactiona = Get_Array_Select("accredaction",["accredaction_schemeid","CharterStandard","accredaction_clubid",$taccredcriteria_clubid],"accredaction_id");
				// $accredactiona = dearray($accredactiona);
        // print($activeaccredscheme_id.":".$taccredcriteria_clubid);
				// var_dump($accredactiona);
        foreach ($accredactiona as $accredaction_id) {
            // XPTXT($accredaction_id);
						// XTXT("test0");
            Get_Data("accredaction",$activeaccredscheme_id,$taccredcriteria_clubid,$accredaction_id);
						// XTXT("test1");
            Get_Data("accredactionsection",$activeaccredscheme_id,$GLOBALS{'accredaction_sectionid'});
						// XTXT("test2");
            array_push ($accredactionsorta,$GLOBALS{'accredactionsection_seq'}.$GLOBALS{'accredaction_sectionid'}.$GLOBALS{'accredaction_ref'}."|".$accredaction_id);
        }

        // foreach ($accredactionsorta as $accredactionsortelement) { XPTXT($accredactionsortelement); }

        if ( $currenttab == "" ) { $currenttab = "Tab1"; }
        BTABDIV('accredactiontabmenu');
        BTABHEADERCONTAINER();
        $ti = 0;
        $firstsection = "1";
        $accredactionsectiona = Get_Array_Hash_SortSelect('accredactionsection',$activeaccredscheme_id,"accredactionsection_seq","","");
        foreach ($accredactionsectiona as $accredactionsection_id) {
            Get_Data("accredactionsection",$activeaccredscheme_id,$accredactionsection_id);
            // put extra dummy record in each section (will be removed later)
            array_push ($accredactionsorta,$GLOBALS{'accredactionsection_seq'}.$accredactionsection_id."                |NEWSECTION|".$accredactionsection_id);
            $ti++;
            $thistab = "Tab".$ti;
            if ( $thistab == $currenttab ) {
                BTABHEADERITEMACTIVE($thistab,$GLOBALS{'accredactionsection_title'});
            } else {
                BTABHEADERITEM($thistab,$GLOBALS{'accredactionsection_title'});
            }
        }
        B_TABHEADERCONTAINER();

        sort($accredactionsorta);
        // print_r($accredactionsorta);

        BTABCONTENTCONTAINER();

        $firstsection = "1";
        $ti = 0;

        foreach ($accredactionsorta as $accredactionsortelement) {
            $abits = explode("|",$accredactionsortelement);
            $thisaccredaction_id = $abits[1];
            // XPTXTCOLOR($activeaccredscheme_id." ".$taccredcriteria_clubid." ".$thisaccredaction_id." - ".$lastaccredaction_sectionid,"red");
            if ( $thisaccredaction_id == "NEWSECTION" ) {
                $thissection = $abits[2];
                // XH1($thissection);
                // XPTXT("XXXXX".$GLOBALS{'accredcriteria_sectionid'})
                if ($firstsection == "1") {
                    $firstsection = "0";
                } else {
                    X_TBODY();
                    X_TABLE();
                    X_DIV("simpletablediv_".$thissection);
                    XCLEARFLOAT();
                    // XINHID("list_sortcol",0);
                    B_TABCONTENTITEM();
                }
                $ti++;
                $thistab = "Tab".$ti;
                if ( $thistab == $currenttab ) {
                    BTABCONTENTITEMACTIVE($thistab);
                } else {
                    BTABCONTENTITEM($thistab);
                }
                XDIV("simpletablediv_".$thissection,"container");
                XTABLEJQDTID("simpletabletable_".$thissection);
                XTHEAD();
                XTRJQDT();
                XTDHTXT("Ref");
                XTDHTXT("Topic");
                XTDHTXT("Objective");
                XTDHTXT("How");
                if ($GLOBALS{'accredscheme_achievementindicatorsreqd'} == "Yes") { XTDHTXT("Achievement"); }
                if ($GLOBALS{'accredscheme_costtextreqd'} == "Yes") { XTDHTXT("Cost Elements"); }
                if ($GLOBALS{'accredscheme_costvaluereqd'} == "Yes") { XTDHTXT("Cost"); }
                if ($GLOBALS{'accredscheme_fundingapproachreqd'} == "Yes") { XTDHTXT("Funding Approach"); }
                if ($GLOBALS{'accredscheme_fundingvalueselfreqd'} == "Yes") { XTDHTXT("Self Funding"); }
                if ($GLOBALS{'accredscheme_fundingvaluegrantreqd'} == "Yes") { XTDHTXT("Grant Funding"); }
                if ($GLOBALS{'accredscheme_fundingvaluesponsorreqd'} == "Yes") { XTDHTXT("Sponsor Funding"); }
                if ($GLOBALS{'accredscheme_dateraisedreqd'} == "Yes") { XTDHTXT("Raised Date"); }
                if ($GLOBALS{'accredscheme_duedatereqd'} == "Yes") { XTDHTXT("Due Date"); }
                if ($GLOBALS{'accredscheme_timescalereqd'} == "Yes") { XTDHTXT("Timescale"); }
                if ($GLOBALS{'accredscheme_actioneesreqd'} == "Yes") { XTDHTXT("Who"); }
                if ($GLOBALS{'accredscheme_personidreqd'} == "Yes") { XTDHTXT("Person"); }
                if ($GLOBALS{'accredscheme_responsereqd'} == "Yes") { XTDHTXT("Response"); }
                if ($GLOBALS{'accredscheme_statusreqd'} == "Yes") { XTDHTXT("Status"); }
                XTDHTXT("");
                XTDHTXT("");
                X_TR();
                X_THEAD();
                XTBODY();
            } else {
                Get_Data("accredaction",$activeaccredscheme_id,$taccredcriteria_clubid,$thisaccredaction_id);
                XTRJQDT();
                XTDTXT($GLOBALS{'accredaction_ref'});
                XTDTXT($GLOBALS{'accredaction_sectiontopic'});
                XTDTXT($GLOBALS{'accredaction_objective'});
                XTDTXT($GLOBALS{'accredaction_how'});
                if ($GLOBALS{'accredscheme_achievementindicatorsreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_achievementindicators'}); }
                if ($GLOBALS{'accredscheme_costtextreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_costtext'}); }
                if ($GLOBALS{'accredscheme_costvaluereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_dateraised'}); }
                if ($GLOBALS{'accredscheme_fundingapproachreqd'} == "Yes") { XTDTXT($GLOBALS{'fundingapproach'}); }
                if ($GLOBALS{'accredscheme_fundingvalueselfreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_fundingvalueself'}); }
                if ($GLOBALS{'accredscheme_fundingvaluegrantreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_fundingvaluegrant'}); }
                if ($GLOBALS{'accredscheme_fundingvaluesponsorreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_fundingvaluesponsor'}); }
                if ($GLOBALS{'accredscheme_dateraisedreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_dateraised'}); }
                if ($GLOBALS{'accredscheme_duedatereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_duedate'}); }
                if ($GLOBALS{'accredscheme_timescalereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_timescale'}); }
                if ($GLOBALS{'accredscheme_actioneesreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_actionees'}); }
                if ($GLOBALS{'accredscheme_personidreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_personid'}); }
                if ($GLOBALS{'accredscheme_responsereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_response'}); }
                if ($GLOBALS{'accredscheme_statusreqd'} == "Yes") {
                    $statustext = "";
                    if ( $GLOBALS{'accredaction_status'} == "" ) { $statustext = '<span style="color:red"><b>No Status</b></span>'; }
                    if ( $GLOBALS{'accredaction_status'} == "Open" ) { $statustext = '<span style="color:red"><b>Open</b></span>'; }
                    if ( $GLOBALS{'accredaction_status'} == "Closed" ) { $statustext = '<span style="color:green"><b>Closed</b></span>'; }
                    if ( $GLOBALS{'accredaction_status'} == "Dropped" ) { $statustext = '<span style="color:orange"><b>Dropped</b></span>'; }
                    XTDTXT($statustext);
                }
                $link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
                $link = $link.YPGMPARM("accredaction_schemeid",$activeaccredscheme_id);
                $link = $link.YPGMPARM("accredaction_clubid",$taccredcriteria_clubid);
                $link = $link.YPGMPARM("accredaction_id",$thisaccredaction_id);
                XTDLINKTXT($link,"Update");
                $link = YPGMLINK("accredactiondeleteconfirm.php").YPGMSTDPARMS();
                $link = $link.YPGMPARM("accredaction_schemeid",$activeaccredscheme_id);
                $link = $link.YPGMPARM("accredaction_clubid",$taccredcriteria_clubid);
                $link = $link.YPGMPARM("accredaction_id",$thisaccredaction_id);
                XTDLINKTXT($link,"Delete");
                X_TR();
            }
        }

        X_TBODY();
        X_TABLE();
        X_DIV("simpletablediv_".$thissection);
        XCLEARFLOAT();

        B_TABCONTENTITEM();

        B_TABCONTENTCONTAINER();
        B_TABDIV();
    }
}

function Library_ACCREDACTIONUPDATE_CSSJS() {
    $GLOBALS{'SITECSSOPTIONAL'} = "datepicker,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
		session_start();
}

function Library_ACCREDACTIONUPDATE_Output($taccredaction_schemeid,$taccredaction_clubid,$taccredaction_id) {

    Get_Data("accredscheme",$taccredaction_schemeid);

    if ( $taccredaction_id == "New" ) {
        Initialise_Data("accredaction");
        $GLOBALS{'accredaction_schemeid'} = $taccredaction_schemeid;
        $GLOBALS{'accredaction_clubid'} = $taccredaction_clubid;
        $GLOBALS{'accredaction_id'} = $GLOBALS{'currenttimestamp'};
        $taccredaction_id = $GLOBALS{'accredaction_id'};
        XH2("New Development Plan Action");
    } else {
        Get_Data("accredaction",$taccredaction_schemeid,$taccredaction_clubid,$taccredaction_id);
        XH2("Development Plan Action Update");
    }
		$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

    XFORMUPLOAD("accredactionupdatein.php","accredactionupdate");
    XINSTDHID();
    XINHID("accredaction_schemeid",$GLOBALS{'accredaction_schemeid'});
    XINHID("accredaction_clubid",$GLOBALS{'accredaction_clubid'});
    XINHID("accredaction_id",$GLOBALS{'accredaction_id'});

    XBR();
    BROW();
    BCOLTXT("Ref","1");
    BCOLINTXTID('accredaction_ref','accredaction_ref',$GLOBALS{'accredaction_ref'},"2");
    BCOLTXT("Topic Area","1");
    $xhash = Get_SelectArrays_Hash ("accredactionsection",$taccredaction_schemeid,"accredactionsection_id","accredactionsection_title","accredactionsection_seq","","" );
    BCOLINSELECTHASHID ($xhash,'accredaction_sectionid','accredaction_sectionid',$GLOBALS{'accredaction_sectionid'},"2");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Topic","1");
    BCOLINTEXTAREAID('accredaction_sectiontopic','accredaction_sectiontopic',$GLOBALS{'accredaction_sectiontopic'},"5","10");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Objective","1");
    BCOLINTEXTAREAID('accredaction_objective','accredaction_objective',$GLOBALS{'accredaction_objective'},"5","10");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("How","1");
    BCOLINTEXTAREAID('accredaction_how','accredaction_how',$GLOBALS{'accredaction_how'},"5","10");
    B_ROW();
    XBR();
    if ($GLOBALS{'accredscheme_achievementindicatorsreqd'} == "Yes") {
        BROW();
        BCOLTXT("Achievement Indicators","1");
        BCOLINTEXTAREAID('accredaction_achievementindicators','accredaction_achievementindicators',$GLOBALS{'accredaction_achievementindicators'},"5","10");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_costtextreqd'} == "Yes") {
        BROW();
        BCOLTXT("Cost Drivers","1");
        BCOLINTEXTAREAID('accredaction_costtext','accredaction_costtext',$GLOBALS{'accredaction_costtext'},"5","10");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_costvaluereqd'} == "Yes") {
        BROW();
        BCOLTXT("Cost","1");
        BCOLINTXTID('accredaction_costvalue','accredaction_costvalue',$GLOBALS{'accredaction_costvalue'},"2");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_fundingapproachreqd'} == "Yes") {
        BROW();
        BCOLTXT("Funding Approach","1");
        BCOLINTEXTAREAID('accredaction_fundingapproach','accredaction_fundingapproach',$GLOBALS{'accredaction_fundingapproach'},"5","10");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_fundingvalueselfreqd'} == "Yes") {
        BROW();
        BCOLTXT("Self Funding","1");
        BCOLINTXTID('accredaction_fundingvalueself','accredaction_fundingvalueself',$GLOBALS{'accredaction_fundingvalueself'},"2");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_fundingvaluegrantreqd'} == "Yes") {
        BROW();
        BCOLTXT("Grant Funding","1");
        BCOLINTXTID('accredaction_fundingvaluegrant','accredaction_fundingvaluegrant',$GLOBALS{'accredaction_fundingvaluegrant'},"2");
        B_ROW();
    }
    if ($GLOBALS{'accredscheme_fundingvaluesponsorreqd'} == "Yes") {
        BROW();
        BCOLTXT("Sponsorship","1");
        BCOLINTXTID('accredaction_fundingvaluesponsor','accredaction_fundingvaluesponsor',$GLOBALS{'accredaction_fundingvaluesponsor'},"2");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_dateraisedreqd'} == "Yes") {
        BROW();
 	BCOLTXT("Date Raised","1");
	BCOLINDATEID('accredaction_dateraised','accredaction_dateraised_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'accredaction_dateraised'}),'dd/mm/yyyy',"3");
        B_ROW();
        XBR();
        }
    if ($GLOBALS{'accredscheme_duedatereqd'} == "Yes") {
        BROW();
 	BCOLTXT("Due Date","1");
	BCOLINDATEID('accredaction_duedate','accredaction_duedate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'accredaction_duedate'}),'dd/mm/yyyy',"3");
        B_ROW();
        XBR();
        }
    if ($GLOBALS{'accredscheme_timescalereqd'} == "Yes") {
        BROW();
        BCOLTXT("Timescale","1");
        BCOLINTEXTAREAID('accredaction_timescale','accredaction_timescale',$GLOBALS{'accredaction_timescale'},"5","10");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_actioneesreqd'} == "Yes") {
        BROW();
        BCOLTXT("Who","1");
        BCOLINTEXTAREAID('accredaction_actionees','accredaction_actionees',$GLOBALS{'accredaction_actionees'},"5","10");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_personidreqd'} == "Yes") {
        BROW();
        BCOLTXT("Actionee","1");
        BCOL("4");
	XINTXTID("accredaction_personid","accredaction_personid",$GLOBALS{'accredaction_personid'},"50","100");
	XINBUTTONIDSPECIAL("Lookup","info","Lookup");XBR();
	XTXTID("accredaction_personidname",View_Person_List($GLOBALS{'accredaction_personid'}));
        B_COL();
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_responsereqd'} == "Yes") {
        BROW();
        BCOLTXT("Response","1");
        BCOLINTEXTAREAID('accredaction_response','accredaction_response',$GLOBALS{'accredaction_response'},"5","10");
        B_ROW();
        XBR();
    }
    if ($GLOBALS{'accredscheme_statusreqd'} == "Yes") {
        BROW();
        BCOLTXT("Status","1");
        $xhash = List2Hash("Open,Closed,Dropped");
        BCOL("2");
        BINSELECTHASHNOQ($xhash,'accredaction_status',$GLOBALS{'accredaction_status'});
        B_COL();
        B_ROW();
        XBR();
    }
    XHR();
    BROW();
    BCOLTXT("","1");
    BCOL("2");
    XINSUBMIT("Update");
    B_COL();
    B_ROW();
    X_FORM();

    $GLOBALS{'PersonSelectPopupParameters'} = array(
            "this,person_id|person_sname|person_fname|person_section",
            "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
            "field,Lookup,Select,accredaction_personid,accredaction_personidname,100",
            "person_id",
            "all",
            "search,center,center,800,600",
            "view",
            "buildfulllist"
    );
}

function Library_ACCREDACTIONDELETECONFIRM_Output ($accredaction_schemeid,$accredaction_clubid,$accredaction_id) {
	XH3('Delete Development Plan Action - "'.$accredaction_id.'"');
	XPTXT("Are you sure you want to delete this action item");
	XBR();
	XFORM("accredactiondeleteaction.php","deleteaction");
	XINSTDHID();
	XINHID("accredaction_schemeid",$accredaction_schemeid);
	XINHID("accredaction_clubid",$accredaction_clubid);
	XINHID("accredaction_id",$accredaction_id);
	XINSUBMIT("Confirm Action Deletion");
	X_FORM();
	XBR();
	XINBUTTONBACK("Cancel");
}


function Library_ACCREDACTIONTRACKER_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Library_ACCREDACTIONTRACKER_Output ($activeaccredscheme_id,$taccredcriteria_clubid) {
    $currenttab = "Tab1";
    if ($activeaccredscheme_id == "Active") {
        $activeaccredscheme_id = "";
        $taccredscheme_ida = Get_Array('accredscheme');
        foreach ($taccredscheme_ida as $taccredscheme_id) {
            Check_Data("accredscheme",$taccredscheme_id);
            if ($GLOBALS{'accredscheme_active'} == "Yes" && $GLOBALS{'accredscheme_type'} == "Normal"){$activeaccredscheme_id = $taccredscheme_id;}
        }
    }

    Check_Data("accredscheme",$activeaccredscheme_id);
    if ($GLOBALS{'IOWARNING'} == "1") {
        XH5("No accreditation criteria found");
    } else {
        if ($GLOBALS{'accredscheme_logolink'} != "") { XIMGFLEX($GLOBALS{'accredscheme_logolink'}); }
        // XH3("Accreditation - ".$GLOBALS{'accredscheme_authority'}." - ".$GLOBALS{'accredscheme_name'}." - Version ".$GLOBALS{'accredscheme_version'});
        XH2("Development Plan");
        $accredcriteriaa = Get_Array('accredcriteria',$activeaccredscheme_id,$taccredcriteria_clubid);
        sort($accredcriteriaa);
        XHRCLASS("underline");

        XFORMUPLOAD("accredactionupdateout.php","accredactionupdate");
        XINSTDHID();
        XINHID("accredaction_schemeid",$activeaccredscheme_id);
        XINHID("accredaction_clubid",$taccredcriteria_clubid);
        XINHID("accredaction_id","New");
        XINSUBMIT("Add New Development Action Item");
        X_FORM();
        XBR();

        XDIV("reportdiv_list","container");
        XTABLEJQDTID("reporttable_list");
        XTHEAD();
        XTRJQDT();
        XTDHTXT("Ref");
        XTDHTXT("Topic");
        XTDHTXT("Objective");
        XTDHTXT("How");
        if ($GLOBALS{'accredscheme_achievementindicatorsreqd'} == "Yes") { XTDHTXT("Achievement"); }
        if ($GLOBALS{'accredscheme_costtextreqd'} == "Yes") { XTDHTXT("Cost Elements"); }
        if ($GLOBALS{'accredscheme_costvaluereqd'} == "Yes") { XTDHTXT("Cost"); }
        if ($GLOBALS{'accredscheme_fundingapproachreqd'} == "Yes") { XTDHTXT("Funding Approach"); }
        if ($GLOBALS{'accredscheme_fundingvalueselfreqd'} == "Yes") { XTDHTXT("Self Funding"); }
        if ($GLOBALS{'accredscheme_fundingvaluegrantreqd'} == "Yes") { XTDHTXT("Grant Funding"); }
        if ($GLOBALS{'accredscheme_fundingvaluesponsorreqd'} == "Yes") { XTDHTXT("Sponsor Funding"); }
        if ($GLOBALS{'accredscheme_dateraisedreqd'} == "Yes") { XTDHTXT("Raised Date"); }
        if ($GLOBALS{'accredscheme_duedatereqd'} == "Yes") { XTDHTXT("Due Date"); }
        if ($GLOBALS{'accredscheme_timescalereqd'} == "Yes") { XTDHTXT("Timescale"); }
        if ($GLOBALS{'accredscheme_actioneesreqd'} == "Yes") { XTDHTXT("Who"); }
        if ($GLOBALS{'accredscheme_personidreqd'} == "Yes") { XTDHTXT("Person"); }
        if ($GLOBALS{'accredscheme_responsereqd'} == "Yes") { XTDHTXT("Response"); }
        if ($GLOBALS{'accredscheme_statusreqd'} == "Yes") { XTDHTXT("Status"); }
        XTDHTXT("");
        XTDHTXT("");
        X_TR();
        X_THEAD();
        XTBODY();

        $accredactiona = Get_Array("accredaction",$activeaccredscheme_id,$taccredcriteria_clubid);
        foreach ($accredactiona as $accredaction_id) {
            Get_Data("accredaction",$activeaccredscheme_id,$taccredcriteria_clubid,$accredaction_id);
            XTRJQDT();
            XTDTXT($GLOBALS{'accredaction_ref'});
            XTDTXT($GLOBALS{'accredaction_sectiontopic'});
            XTDTXT($GLOBALS{'accredaction_objective'});
            XTDTXT($GLOBALS{'accredaction_how'});
            if ($GLOBALS{'accredscheme_achievementindicatorsreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_achievementindicators'}); }
            if ($GLOBALS{'accredscheme_costtextreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_costtext'}); }
            if ($GLOBALS{'accredscheme_costvaluereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_dateraised'}); }
            if ($GLOBALS{'accredscheme_fundingapproachreqd'} == "Yes") { XTDTXT($GLOBALS{'fundingapproach'}); }
            if ($GLOBALS{'accredscheme_fundingvalueselfreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_fundingvalueself'}); }
            if ($GLOBALS{'accredscheme_fundingvaluegrantreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_fundingvaluegrant'}); }
            if ($GLOBALS{'accredscheme_fundingvaluesponsorreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_fundingvaluesponsor'}); }
            if ($GLOBALS{'accredscheme_dateraisedreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_dateraised'}); }
            if ($GLOBALS{'accredscheme_duedatereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_duedate'}); }
            if ($GLOBALS{'accredscheme_timescalereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_timescale'}); }
            if ($GLOBALS{'accredscheme_actioneesreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_actionees'}); }
            if ($GLOBALS{'accredscheme_personidreqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_personid'}); }
            if ($GLOBALS{'accredscheme_responsereqd'} == "Yes") { XTDTXT($GLOBALS{'accredaction_response'}); }
            if ($GLOBALS{'accredscheme_statusreqd'} == "Yes") {
                $statustext = "";
                if ( $GLOBALS{'accredaction_status'} == "" ) { $statustext = '<span style="color:red"><b>No Status</b></span>'; }
                if ( $GLOBALS{'accredaction_status'} == "Open" ) { $statustext = '<span style="color:red"><b>Open</b></span>'; }
                if ( $GLOBALS{'accredaction_status'} == "Closed" ) { $statustext = '<span style="color:green"><b>Closed</b></span>'; }
                if ( $GLOBALS{'accredaction_status'} == "Dropped" ) { $statustext = '<span style="color:orange"><b>Dropped</b></span>'; }
                XTDTXT($statustext);
            }
            $link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
            $link = $link.YPGMPARM("accredaction_schemeid",$activeaccredscheme_id);
            $link = $link.YPGMPARM("accredaction_clubid",$taccredcriteria_clubid);
            $link = $link.YPGMPARM("accredaction_id",$accredaction_id);
            XTDLINKTXT($link,"Update");
            $link = YPGMLINK("accredactiondeleteconfirm.php").YPGMSTDPARMS();
            $link = $link.YPGMPARM("accredaction_schemeid",$activeaccredscheme_id);
            $link = $link.YPGMPARM("accredaction_clubid",$taccredcriteria_clubid);
            $link = $link.YPGMPARM("accredaction_id",$accredaction_id);
            XTDLINKTXT($link,"Delete");
            X_TR();
        }

        X_TBODY();
        X_TABLE();
        X_DIV("reportdiv_list");
        XCLEARFLOAT();
        XINHID("list_sortcol","6");
    }
}


?>
