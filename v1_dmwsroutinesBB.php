<?php

// last app version 29

function Dmws_DMWSSULIST_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,dmwssuupdate,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,jqueryconfirm,report,dmwssulist";
}

function Dmws_DMWSSULIST_Output($openclosed) {
    if ( $GLOBALS{'site_clientservermode'} == "Client") { $openclosed = "Open"; } // just to be sure
    XH2("My ".$openclosed." Cases - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
	XBR();XBR();
	BROW();
	if ( $openclosed == "Open") {
    	BCOL("2");
    	XFORMUPLOAD("dmwssuupdateout.php","newsu");
    	XINSTDHID();
    	XINHID("dmwssu_id","New");
    	XINHID("VisitType","First");
    	XINHID("VisitId","New");
    	XINSUBMIT("Add New Service User");
    	X_FORM();
    	B_COL();
	} else {
	    BCOLTXT("","2");
	}
	BCOLTXT("","8");
	if ( $GLOBALS{'site_clientservermode'} == "Client") {
	    BCOL("2");
	    BIMGID("statusonoffline","../site_assets/StatusOnline.png","50");
	    BIMGID("synchronise","../site_assets/Synchronise.png","50");
	    B_COL();
	} else {
	    BCOLTXT("","2");
	}
	B_ROW();

	XBR();XBR();

	XINHID("ListStatus",$openclosed);
	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("SU ref");
	XTDHTXT("Name");
	XTDHTXT("Surname");
	XTDHTXT("WO");
	XTDHTXT("Issues");
	XTDHTXT("Process Steps (Click to Select)");
	if ( $GLOBALS{'site_clientservermode'} == "Client") {
	   XTDHTXT("Updated");
	}else{
	   if ( $openclosed != "Open") {
	       XTDHTXT("");
	   }
	}
	XTDHTXT("");
	XTDHTXT("Contract");
	XTDHTXT("Location");
	X_TR();
	X_THEAD();
	XTBODY();
	XINHID("list_sortcol","0");
	// $dmwssua = Get_Array('dmwssu'); //old version without filtration
	// $dmwssua = Get_Array_Select('dmwssu',['dmwssu_casestatus',$openclosed],"dmwssu_id");
        $dmwssua = Get_Array_Select('dmwssu','dmwssu_casestatus',$openclosed,"dmwssu_id"); 
	//tableName, filters, returnedFields
	// foreach ($dmwssua[0] as $dmwssu_id) {
	for ($i=0; $i < sizeof($dmwssua); $i++) {
		$dmwssu_id = $dmwssua[$i][0];
		Check_Data('dmwssu',$dmwssu_id);
		Check_Data('dmwssux',$dmwssu_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
		    switch ($GLOBALS{'dmwssu_casestatus'}){
		        case open:
		            $thiscasestatus = "Open";
		            break;
		        case closed:
		            $thiscasestatus = "Closed";
		            break;
		        case archived:
		            $thiscasestatus = "Archived";
		            break;
		    }
    		if ( $thiscasestatus == $openclosed ) {
    		    $include = "0";
    		    if(!isset($dmwscontractlocationa)){
    		        //only loads the location once now
    		        $dmwscontractlocationa = Get_Array('dmwscontractlocation');
    		    }
    		    foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
    		        if ( $dmwscontractlocation_id == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
    		            Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
    		            //  Get_Data_Select('dmwscontractlocation',$dmwscontractlocation_id,'dmwssu_casestatus',$thiscasestatus);
    		            // XPTXT("MATCH|".$GLOBALS{'LOGIN_person_id'}."|".$GLOBALS{'dmwscontractlocation_officerlist'}."|");
    		            if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $include = "1"; }
    		            if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $include = "1"; }

    		        }
    		    }
    		    if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwssu_wopersonid'}) ) { $include = "1"; }
    		    if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwssu_otherwopersonidlist'}) ) { $include = "1"; }
    		    // if ( $GLOBALS{'person_userlevel'}  == "3" ) { $include = "1"; }
    		    if ( $GLOBALS{'person_userlevel'}  == "4" ) { $include = "1"; }
    		    if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $include = "1"; }
    		    // if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Test"))>0) { $include = "1"; }
    		    if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) { $include = "1"; }

    		    if ( $include == "1" ) {
    				XTRJQDT();
    				if (strlen(strstr($dmwssu_id,"New"))>0) {
    				    $sustring = "SU".$dmwssu_id;
    				} else {
    				    $sustring = $dmwssu_id;
    				}
    				if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Test"))>0) { $sustring = $sustring." (Test)"; }
    				if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) { $sustring = $sustring." (Example)"; }
    				XTDTXT($sustring);
    				XTDTXT($GLOBALS{'dmwssux_fname'});
    				XTDTXT($GLOBALS{'dmwssux_sname'});
    				XTDTXT($GLOBALS{'dmwssu_wopersonid'});
    				XTD();


    				$dmwswosafeguardingissuetypea = Get_Array('dmwswosafeguardingissuetype');
    				foreach ($dmwswosafeguardingissuetypea as $dmwswosafeguardingissuetype_id) {
    				    Get_Data('dmwswosafeguardingissuetype',$dmwswosafeguardingissuetype_id);
    				    if ( $GLOBALS{'dmwswosafeguardingissuetype_listshortcode'} != "" ) {
    				        if ( FoundInCommaList($dmwswosafeguardingissuetype_id,$GLOBALS{'dmwssu_dmwswosafeguardingissuelist'}) ) {
    				            XINBUTTONIDSPECIALTOOLTIP($dmwswosafeguardingissuetype_id,"danger",$GLOBALS{'dmwswosafeguardingissuetype_listshortcode'},$GLOBALS{'dmwswosafeguardingissuetype_name'});
    				        }
    				    }
    				}
    				$dmwssafeguardingissuetypea = Get_Array('dmwssafeguardingissuetype');
    				foreach ($dmwssafeguardingissuetypea as $dmwssafeguardingissuetype_id) {
    				    Get_Data('dmwssafeguardingissuetype',$dmwssafeguardingissuetype_id);
    				    if ( $GLOBALS{'dmwssafeguardingissuetype_listshortcode'} != "" ) {
    				        if ( FoundInCommaList($dmwssafeguardingissuetype_id,$GLOBALS{'dmwssu_dmwssafeguardingissuelist'}) ) {
    				            XINBUTTONIDSPECIALTOOLTIP($dmwssafeguardingissuetype_id,"warning",$GLOBALS{'dmwssafeguardingissuetype_listshortcode'},$GLOBALS{'dmwssafeguardingissuetype_name'});
    				        }
    				    }
    				}

    				if ( $GLOBALS{'dmwssu_dmwssupporttypeid'} ==  "Declined Support") {
    				    XINBUTTONIDSPECIALTOOLTIP("dmwssu_dmwssupporttypeid","info","Support Declined","Support Declined");
    				}

    				X_TD();
    				XTD();
    				$dmwsvisita = Get_Array('dmwsvisit',$dmwssu_id);
    				$latestvisittype = "";
    				$latestvisitstatus = "";
    				foreach ($dmwsvisita as $dmwsvisit_id) {
    					Get_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
    					$latestvisittype = $GLOBALS{'dmwsvisit_type'};
    					$latestvisitstatus = $GLOBALS{'dmwsvisit_status'};
    					if ($GLOBALS{'dmwsvisit_status'} == "Completed" ) {
    					    $visiticon = ' <span><i class="fa fa-check-circle-o"></i></span>';
    					} else {
    					    $visiticon = "";
    					}
    					// XPTXT($dmwssu_id."|".$dmwsvisit_id.$GLOBALS{'dmwsvisit_type'});
    					$visitdate = $GLOBALS{'dmwsvisit_date'};
    					$visittime = $GLOBALS{'dmwsvisit_time'};
    					if ($visitdate == null||$visitdate == "0000-00-00"){
        					if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
        						$link = YPGMLINK("dmwssuupdateout.php");
        						$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","First").YPGMPARM("VisitId",$dmwsvisit_id);
        						XLINKBUTTONSPECIALTOOLTIP($link,"Fi".$visiticon,"FiOn",VisitToolTipText($dmwsvisit_id));
        					}
        					if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
        						$link = YPGMLINK("dmwssuupdateout.php");
        						$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Subsequent").YPGMPARM("VisitId",$dmwsvisit_id);
        						XLINKBUTTONSPECIALTOOLTIP($link,"Su".$visiticon,"SuOn",VisitToolTipText($dmwsvisit_id));
        					}
        					if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
        						$link = YPGMLINK("dmwssuupdateout.php");
        						$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Discharge").YPGMPARM("VisitId",$dmwsvisit_id);
        						XLINKBUTTONSPECIALTOOLTIP($link,"Di".$visiticon,"DiOn",VisitToolTipText($dmwsvisit_id));
        					}
        					if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
        						$link = YPGMLINK("dmwssuupdateout.php");
        						$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","FollowUp").YPGMPARM("VisitId",$dmwsvisit_id);
        						XLINKBUTTONSPECIALTOOLTIP($link,"Fo".$visiticon,"FoOn",VisitToolTipText($dmwsvisit_id));
        					}
    					}
    					else{
    					    if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
    					        $link = YPGMLINK("dmwssuupdateout.php");
    					        $link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","First").YPGMPARM("VisitId",$dmwsvisit_id);
    					        XLINKBUTTONSPECIALTOOLTIP($link,"Fi".$visiticon,"FiOn",VisitToolTipTextDateTime($visitdate,$visittime));
    					    }
    					    if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
    					        $link = YPGMLINK("dmwssuupdateout.php");
    					        $link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Subsequent").YPGMPARM("VisitId",$dmwsvisit_id);
    					        XLINKBUTTONSPECIALTOOLTIP($link,"Su".$visiticon,"SuOn",VisitToolTipTextDateTime($visitdate,$visittime));
    					    }
    					    if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
    					        $link = YPGMLINK("dmwssuupdateout.php");
    					        $link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Discharge").YPGMPARM("VisitId",$dmwsvisit_id);
    					        XLINKBUTTONSPECIALTOOLTIP($link,"Di".$visiticon,"DiOn",VisitToolTipTextDateTime($visitdate,$visittime));
    					    }
    					    if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
    					        $link = YPGMLINK("dmwssuupdateout.php");
    					        $link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","FollowUp").YPGMPARM("VisitId",$dmwsvisit_id);
    					        XLINKBUTTONSPECIALTOOLTIP($link,"Fo".$visiticon,"FoOn",VisitToolTipTextDateTime($visitdate,$visittime));
    					    }
    					}
    				}
    				if ($latestvisittype == "" ) {
    					$link = YPGMLINK("dmwssuupdateout.php");
    					$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","First").YPGMPARM("VisitId","New");
    					XLINKBUTTONSPECIALTOOLTIP($link,"Fi","FiOff","New Visit");
    				}
    				if ($latestvisitstatus == "Completed" ) {
        				if ($latestvisittype == "First" ) {
        					$link = YPGMLINK("dmwssuupdateout.php");
        					$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Subsequent").YPGMPARM("VisitId","New");
        					XLINKBUTTONSPECIALTOOLTIP($link,"Su","SuOff","New Visit");
        					$link = YPGMLINK("dmwssuupdateout.php");
        					$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Discharge").YPGMPARM("VisitId","New");
        					XLINKBUTTONSPECIALTOOLTIP($link,"Di","DiOff","New Visit");
        				}
        				if ($latestvisittype == "Subsequent" ) {
        					$link = YPGMLINK("dmwssuupdateout.php");
        					$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Subsequent").YPGMPARM("VisitId","New");
        					XLINKBUTTONSPECIALTOOLTIP($link,"Su","SuOff","New Visit");
        					$link = YPGMLINK("dmwssuupdateout.php");
        					$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","Discharge").YPGMPARM("VisitId","New");
        					XLINKBUTTONSPECIALTOOLTIP($link,"Di","DiOff","New Visit");
        				}
        				if ($latestvisittype == "Discharge" ) {
        					$link = YPGMLINK("dmwssuupdateout.php");
        					$link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("VisitType","FollowUp").YPGMPARM("VisitId","New");
        					XLINKBUTTONSPECIALTOOLTIP($link,"Fo","FoOff","New Visit");
        				}
    				}
    				X_TD();
    				if ( $GLOBALS{'site_clientservermode'} == "Client") {
    				    if ($GLOBALS{'dmwssu_clientupdatetimestamp'} != "" ) {
    				        if ( strpos($GLOBALS{'dmwssu_clientupdatetimestamp'}, '(No Synch)') !== false ) {
                                $sbits = explode("(",$GLOBALS{' '});
                                XTD();XTXTIDCLASS('dmwssu_clientupdatetimestamp_'.$dmwssu_id,"clientupdatetimestamp",TimestamptoDDMMMbHHcMM($sbits[0])."(".$sbits[1]);X_TD();
    				        } else {
    				            XTD();XTXTIDCLASS('dmwssu_clientupdatetimestamp_'.$dmwssu_id,"clientupdatetimestamp",TimestamptoDDMMMbHHcMM($GLOBALS{'dmwssu_clientupdatetimestamp'}));X_TD();
    				        }
    				    } else {
    				        XTDTXT("");
    				    }
    				}
    				if ( $GLOBALS{'site_clientservermode'} != "Client") {
    				    if ( $openclosed != "Open") {
    				        $link = YPGMLINK("dmwssureplicateconfirm.php");
    				        $link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("List","DMWSSULIST").YPGMPARM("ListStatus",$openclosed);
    				        XTDLINKTXT($link,"new case");
    				    }
    				}

    				$deleteallowed = "0";
    				if ( $GLOBALS{'person_userlevel'}  == "1" ) {  // CHECK
    				    if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) {} else { $deleteallowed = "1"; }
    				}
    				if ( $GLOBALS{'person_userlevel'}  == "2" ) {
    				    if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) {} else { $deleteallowed = "1"; }
    				}
    				if ( $GLOBALS{'person_userlevel'}  == "4" ) { $deleteallowed = "1"; }
    				if ( $GLOBALS{'site_clientservermode'} == "Client") {
    				    if (strlen(strstr($dmwssu_id,"New"))>0) {} else { $deleteallowed = "0"; }
    				}
    				if ( $deleteallowed == "1" ) {
    				    $link = YPGMLINK("dmwssudeleteconfirm.php");
    				    $link = $link.YPGMSTDPARMS().YPGMPARM("dmwssu_id",$dmwssu_id).YPGMPARM("List","DMWSSULIST").YPGMPARM("ListStatus",$openclosed);
    				    XTDLINKTXT($link,"delete");
    				} else {
                        XTDTXT("");
    				}
    				XTDTXT($GLOBALS{'dmwssu_dmwscontractid'});
    				XTDTXT($GLOBALS{'dmwssu_dmwscontractlocationid'});
    				X_TR();
    			}
            }
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV("report_tablecontainer","container");
	XCLEARFLOAT();
}


function Dmws_DMWSSUUPDATE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "bootstrapdatepicker,dmwssuupdate,dmwsradarchart,jqueryuisliderpips,jqueryuisignature,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,dmwssuupdate,dropzonebasicfilepopup,bootstrapdatepicker,areyousure,d3v3min,jqueryuisliderpips,jqueryuisignature,jqueryconfirm";
}

function Dmws_DMWSSUUPDATE_Output($thisdmwssu_id, $thisvisittype, $thisvisitid ,$currenttab) {

    // if New SU  $thisdmwssu_id="New", $thisvisittype="First", $thisvisitid="New"
    // if New Visit  $thisdmwssu_id="SUId", $thisvisittype="First", $thisvisitid="New"

    if ( $thisvisittype == "undefined" ) { $thisvisittype = "Subsequent"; } // CHECK VISIT

	Check_Data('dmwssu', $thisdmwssu_id);
	if ($GLOBALS{'IOWARNING'} == "0") {
	    Get_Data('dmwssux', $thisdmwssu_id);
	    $examplesuffix = "";
	    if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) { $examplesuffix = " (Example)"; }
	    $headingtext = $GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'}." ".$GLOBALS{'dmwssu_id'}.$examplesuffix;
	} else {
	    if ($thisdmwssu_id == "New") {
	        Initialise_Data('dmwssu');
	        Initialise_Data('dmwssux');
	        $headingtext = "New Service User";
	        $GLOBALS{'dmwssu_id'} = "New";
	        $GLOBALS{'dmwssu_wopersonid'} = $GLOBALS{'LOGIN_person_id'};
	        $GLOBALS{'dmwssu_woname'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
	    } else {
	        XH1("Error - Cannot find Service User");
	    }
	}

	XBR();

	XFORMUPLOAD("dmwssuupdatein.php","dmwssuupdateform");
	XINSTDHID();
	XINHID("dmwssu_id",$thisdmwssu_id);
	XINHID("CurrentTab",$currenttab);
	BROW();
	BCOLTXT("<h3>".$headingtext."</h3>","3");
	BCOL("5");

	$dmwsvisita = Get_Array('dmwsvisit',$thisdmwssu_id);
	$latestvisittype = "";
	$latestvisitstatus = "";
	$buttontype = "";
	foreach ($dmwsvisita as $dmwsvisit_id) {
	    Get_Data('dmwsvisit',$thisdmwssu_id,$dmwsvisit_id);
	    $latestvisittype = $GLOBALS{'dmwsvisit_type'};
	    $latestvisitstatus = $GLOBALS{'dmwsvisit_status'};
		if ($GLOBALS{'dmwsvisit_status'} == "Completed" ) {
		    $visiticon = ' <span><i class="fa fa-check-circle-o"></i></span>';
		} else {
		    $visiticon = "";
		}
		$activesuffix = "";
		$othervisit = "";
		if ( $thisvisitid == $dmwsvisit_id ) {$activesuffix = "Active";}
		else { $othervisit = " othervisit"; }
		$visitdate = $GLOBALS{'dmwsvisit_date'};
		$visittime = $GLOBALS{'dmwsvisit_time'};
		if ($visitdate == null||$visitdate == "0000-00-00"){
        		if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
        		    BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","FiOn".$activesuffix.$othervisit,"Fi".$visiticon,VisitToolTipText($dmwsvisit_id));
        		}
        		if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
        		    BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","SuOn".$activesuffix.$othervisit,"Su".$visiticon,VisitToolTipText($dmwsvisit_id));
        		}
        		if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
        		    BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","DiOn".$activesuffix.$othervisit,"Di".$visiticon,VisitToolTipText($dmwsvisit_id));
        		}
        		if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
        		    BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","FoOn".$activesuffix.$othervisit,"Fo".$visiticon,VisitToolTipText($dmwsvisit_id));
        		}
		}
		else{
		    if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
		        BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","FiOn".$activesuffix.$othervisit,"Fi".$visiticon,VisitToolTipTextDateTime($visitdate,$visittime));
		    }
		    if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
		        BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","SuOn".$activesuffix.$othervisit,"Su".$visiticon,VisitToolTipTextDateTime($visitdate,$visittime));
		    }
		    if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
		        BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","DiOn".$activesuffix.$othervisit,"Di".$visiticon,VisitToolTipTextDateTime($visitdate,$visittime));
		    }
		    if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
		        BINBUTTONIDSPECIALTOOLTIP("$dmwsvisit_id","FoOn".$activesuffix.$othervisit,"Fo".$visiticon,VisitToolTipTextDateTime($visitdate,$visittime));
		    }
		}
	}
	$activesuffix = "";
	$othervisit = " othervisit";
	if ($latestvisittype == "" ) {
		$activesuffix = "Active";
		BINBUTTONIDSPECIALTOOLTIP("New","FiOff".$activesuffix,"Fi",VisitToolTipText($dmwsvisit_id));
	}
	if ($latestvisitstatus == "Completed" ) {
    	if ($latestvisittype == "First" ) {
    		$activesuffix = ""; if (( $thisvisittype == "Subsequent" )&&( $thisvisitid == "New" )) {$activesuffix = "Active";}
    		BINBUTTONIDSPECIALTOOLTIP("New","SuOff".$activesuffix.$othervisit,"Su","New Visit");
    		$activesuffix = ""; if (( $thisvisittype == "Discharge" )&&( $thisvisitid == "New" )) {$activesuffix = "Active";}
    		BINBUTTONIDSPECIALTOOLTIP("New","DiOff".$activesuffix.$othervisit,"Di","New Visit");
    	}
    	if ($latestvisittype == "Subsequent" ) {
    	    $activesuffix = ""; if (( $thisvisittype == "Subsequent" )&&( $thisvisitid == "New" )) {$activesuffix = "Active";}
    		BINBUTTONIDSPECIALTOOLTIP("New","SuOff".$activesuffix.$othervisit,"Su","New Visit");
    		$activesuffix = ""; if (( $thisvisittype == "Discharge" )&&( $thisvisitid == "New" )) {$activesuffix = "Active";}
    		BINBUTTONIDSPECIALTOOLTIP("New","DiOff".$activesuffix.$othervisit,"Di","New Visit");
    	}
    	if ($latestvisittype == "Discharge" ) {
    		$activesuffix = ""; if (( $thisvisittype == "FollowUp" )&&( $thisvisitid == "New" )) {$activesuffix = "Active";}
    		BINBUTTONIDSPECIALTOOLTIP("New","FoOff".$activesuffix.$othervisit,"Fo","New Visit");
    	}
	}

	XINHID("dmwsvisit_id",$thisvisitid);
	XINHID("dmwsvisit_type",$thisvisittype);
	XINHID("woname",$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
	XINHID("clientservermode",$GLOBALS{'site_clientservermode'});
	XINHID("SubmitAction","");

	if ( $thisvisitid == "New" ) {
	    Initialise_Data('dmwsvisit');
	    $GLOBALS{'dmwsvisit_id'} = "New";
	    $GLOBALS{'dmwsvisit_status'} = "Open";
	} else {
	    Get_Data('dmwsvisit',$thisdmwssu_id,$thisvisitid);
	}

	$updateallowed = "0";
	if (( $GLOBALS{'person_userlevel'}  == "1" )||( $GLOBALS{'person_userlevel'}  == "2" )) {
	    if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) {} else { $updateallowed = "1"; }
	}
	if ( $GLOBALS{'person_userlevel'}  == "4" ) { $updateallowed = "1"; }

	B_COL();
	BCOL("4");
	if ( $updateallowed == "1" ) {
	    BINBUTTONIDSPECIALTOOLTIP ("UpdatesMade1","info",'<span><i class="fa fa-crosshairs"></i></span>',"Updates Made");
	    BINBUTTONIDSPECIAL("Save1","primary","Save");
	    BINBUTTONIDSPECIAL("SaveClose1","primary","Save and Close");
	}
	BINBUTTONIDSPECIAL("Close1","warning","Close");

	$deleteallowed = "0";
	if ($GLOBALS{'dmwsvisit_status'} != "Completed" ) {
	    if (( $GLOBALS{'person_userlevel'}  == "1" )||( $GLOBALS{'person_userlevel'}  == "2" )) {
	        if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) {} else { $deleteallowed = "1"; }
	    }
	    if ( $GLOBALS{'person_userlevel'}  == "4" ) { $deleteallowed = "1"; }
	}
	if ( $thisvisitid == "New" ) { $deleteallowed = "0"; }
	if ( $deleteallowed == "1" ) {
	    if ($GLOBALS{'dmwsvisit_status'} != "Completed" ) {
	       BINBUTTONIDSPECIAL("DeleteVisit1","danger","Delete Visit");
	    }
	}
	B_COL();
	B_ROW();
	XBR();

	$wellbeingrecord = "0";
	Check_Data('dmwsvisit',$thisdmwssu_id,$thisvisitid);
	if ($GLOBALS{'IOWARNING'} == "0") { $wellbeingrecord = "1"; }

	BTABHEADERCONTAINER();
	if ($currenttab == "SUIN") { BTABHEADERITEMACTIVE("SUIN","SU Info"); } else { BTABHEADERITEM("SUIN","SU Info"); }
	if ($GLOBALS{'dmwssu_dmwscontractid'} == "MOD") {	// ought to be done in javascript
	    if ($currenttab == "MODSPECIFIC") { BTABHEADERITEMACTIVE("MODSPECIFIC","MOD Specific Info"); } else { BTABHEADERITEM("MODSPECIFIC","MOD Specific Info"); }
	}
	if ($thisvisittype == "First" ) {
	    if ($currenttab == "CONSENT") { BTABHEADERITEMACTIVE("CONSENT","Consent Form"); } else { BTABHEADERITEM("CONSENT","Consent Form"); }
	}
	if ($GLOBALS{'dmwssu_equalityforminterest'} == "Yes") {	// ought to be done in javascript
	   if ($currenttab == "EQUALITY") { BTABHEADERITEMACTIVE("EQUALITY","Equality & Diversity"); } else { BTABHEADERITEM("EQUALITY","Equality & Diversity"); }
	}
	if ($currenttab == "VISITS") { BTABHEADERITEMACTIVE("VISITS","Contact Log"); } else { BTABHEADERITEM("VISITS","Contact Log"); }
	if ($currenttab == "REFSIN") { BTABHEADERITEMACTIVE("REFSIN","Referrer Updates"); } else { BTABHEADERITEM("REFSIN","Referrer Updates"); }
	if (($thisvisittype == "First" )||($thisvisittype == "Discharge" )||($thisvisittype == "FollowUp" )) {
	   if ($currenttab == "WELL") { BTABHEADERITEMACTIVE("WELL","Wellbeing"); } else { BTABHEADERITEM("WELL","Wellbeing"); }
	}
	else {
	   if ($wellbeingrecord == "1") {
	       if ($currenttab == "WELL") { BTABHEADERITEMACTIVE("WELL","Wellbeing*"); } else { BTABHEADERITEM("WELL","Wellbeing*"); }
	   }
    }
	if ($currenttab == "PROG") { BTABHEADERITEMACTIVE("PROG","Progress"); } else { BTABHEADERITEM("PROG","Progress"); }
	if (($thisvisittype == "First" )||($thisvisittype == "Subsequent" )) {
	   if ($currenttab == "COMPLEX") { BTABHEADERITEMACTIVE("COMPLEX","Complexity"); } else { BTABHEADERITEM("COMPLEX","Complexity"); }
	}
	if ($currenttab == "REFSOUT") { BTABHEADERITEMACTIVE("REFSOUT","Services & Referrals"); } else { BTABHEADERITEM("REFSOUT","Services & Referrals"); }
	if ($currenttab == "ACTS") { BTABHEADERITEMACTIVE("ACTS","Actions"); } else { BTABHEADERITEM("ACTS","Actions"); }
	if ($currenttab == "OUTCOMES") { BTABHEADERITEMACTIVE("OUTCOMES","Outcomes & Impacts"); } else { BTABHEADERITEM("OUTCOMES","Outcomes & Impacts"); }
	if ($currenttab == "NOTE") { BTABHEADERITEMACTIVE("NOTE","Notes"); } else { BTABHEADERITEM("NOTE","Notes"); }
	B_TABHEADERCONTAINER();

	BTABCONTENTCONTAINER();

	if ($currenttab == "SUIN") {BTABCONTENTITEMACTIVE("SUIN");} else {BTABCONTENTITEM("SUIN");}
	SUINContentOutput($thisdmwssu_id);
	B_TABCONTENTITEM();

	if ($GLOBALS{'dmwssu_dmwscontractid'} == "MOD"){	// ought to be done in javascript
	   if ($currenttab == "MODSPECIFIC") {BTABCONTENTITEMACTIVE("MODSPECIFIC");} else {BTABCONTENTITEM("MODSPECIFIC");}
	   MODSPECIFICContentOutput($thisdmwssu_id);
	   B_TABCONTENTITEM();
	}

	if ($thisvisittype == "First" ) {
    	if ($currenttab == "CONSENT") {BTABCONTENTITEMACTIVE("CONSENT");} else {BTABCONTENTITEM("CONSENT");}
    	CONSENTContentOutput($thisdmwssu_id);
    	B_TABCONTENTITEM();
	}

	if ($GLOBALS{'dmwssu_equalityforminterest'} == "Yes"){	// ought to be done in javascript
	   if ($currenttab == "EQUALITY") {BTABCONTENTITEMACTIVE("EQUALITY");} else {BTABCONTENTITEM("EQUALITY");}
	   EQUALITYContentOutput($thisdmwssu_id);
	   B_TABCONTENTITEM();
	}

	if ($currenttab == "VISITS") {BTABCONTENTITEMACTIVE("VISITS");} else {BTABCONTENTITEM("VISITS");}
	VISITContentOutput($thisdmwssu_id,$thisvisitid);
	B_TABCONTENTITEM();

	if ($currenttab == "REFSIN") {BTABCONTENTITEMACTIVE("REFSIN");} else {BTABCONTENTITEM("REFSIN");}
	REFSINContentOutput($thisdmwssu_id);
	B_TABCONTENTITEM();

	if (($thisvisittype == "First" )||($thisvisittype == "Discharge" )||($thisvisittype == "FollowUp" )) {
    	if ($currenttab == "WELL") {BTABCONTENTITEMACTIVE("WELL");} else {BTABCONTENTITEM("WELL");}
    	WELLContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid);
    	B_TABCONTENTITEM();
	} else {
	    if ($wellbeingrecord == "1") {
	        if ($currenttab == "WELL") {BTABCONTENTITEMACTIVE("WELL");} else {BTABCONTENTITEM("WELL");}
	        WELLContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid);
	        B_TABCONTENTITEM();
	    }
	}

	if ($currenttab == "PROG") {BTABCONTENTITEMACTIVE("PROG");} else {BTABCONTENTITEM("PROG");}
	PROGRESSContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid);
	B_TABCONTENTITEM();

	if (($thisvisittype == "First" )||($thisvisittype == "Subsequent" )) {
    	if ($currenttab == "COMPLEX") {BTABCONTENTITEMACTIVE("COMPLEX");} else {BTABCONTENTITEM("COMPLEX");}
    	COMPLEXContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid);
    	B_TABCONTENTITEM();
	}

	if ($currenttab == "REFSOUT") {BTABCONTENTITEMACTIVE("REFSOUT");} else {BTABCONTENTITEM("REFSOUT");}
	REFSOUTContentOutput($thisdmwssu_id);
	B_TABCONTENTITEM();

	if ($currenttab == "ACTS") {BTABCONTENTITEMACTIVE("ACTS");} else {BTABCONTENTITEM("ACTS");}
	ACTSContentOutput($thisdmwssu_id);
	B_TABCONTENTITEM();

	if ($currenttab == "OUTCOMES") {BTABCONTENTITEMACTIVE("OUTCOMES");} else {BTABCONTENTITEM("OUTCOMES");}
	OUTCOMESContentOutput($thisdmwssu_id);
	B_TABCONTENTITEM();

	if ($currenttab == "NOTE") {BTABCONTENTITEMACTIVE("NOTE");} else {BTABCONTENTITEM("NOTE");}
	NOTEContentOutput($thisdmwssu_id);
	B_TABCONTENTITEM();

	B_TABCONTENTCONTAINER();

	XHR();
	BROW();
	BCOLTXT("","8");
	BCOL("4");
	if ( $updateallowed == "1" ) {
	    BINBUTTONIDSPECIALTOOLTIP ("UpdatesMade2","info",'<span><i class="fa fa-crosshairs"></i></span>',"Updates Made");
	    BINBUTTONIDSPECIAL("Save2","primary","Save");
	    BINBUTTONIDSPECIAL("SaveClose2","primary","Save and Close");
	}
	BINBUTTONIDSPECIAL("Close2","warning","Close");

	$deleteallowed = "0";
	if ($GLOBALS{'dmwsvisit_status'} != "Completed" ) {
	    if (( $GLOBALS{'person_userlevel'}  == "1" )||( $GLOBALS{'person_userlevel'}  == "2" )) {
	        if (strlen(strstr($GLOBALS{'dmwssu_dmwscontractlocationid'},"Example"))>0) {} else { $deleteallowed = "1"; }
	    }
	    if ( $GLOBALS{'person_userlevel'}  == "4" ) { $deleteallowed = "1"; }
	}
	if ( $thisvisitid == "New" ) { $deleteallowed = "0"; }
	if ( $deleteallowed == "1" ) {
	    if ($GLOBALS{'dmwsvisit_status'} != "Completed" ) {
	        BINBUTTONIDSPECIAL("DeleteVisit2","danger","Delete Visit");
	    }
	}
	B_COL();
	B_ROW();

	X_FORM();
	XTXTID("TRACETEXT","");

	SignaturePopup();
	AttachmentUploadPopup($thisdmwssu_id);
}

function SUINContentOutput() {
    XBR();
    XH3("Service User Information");
    XHRCLASS('underline');
    XPTXT("Please enter any changes to the Service User's information.");
    XHR();
    XH4("Contract & Location Details");
    BROW();

    // --- set permitted locations ------------
    $permitteddmwscontractlocationida = Array();
    $permitteddmwscontractlocationnamea = Array();
    $disabledLocations = Array();

    // $dmwscontractlocationa = Get_Array_Select('dmwscontractlocation','','dmwscontractlocation_id');
    // print_r($dmwscontractlocationa);
    // foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
    // for ($i=0; $i < sizeof($dmwscontractlocationa); $i++) {
            // $dmwscontractlocation_id = $dmwscontractlocationa[$i][0];
            // $disabledLocations[$dmwscontractlocationa[$i][0]] = $dmwscontractlocationa[$i][1];
            // $disabledLocations .= $dmwscontractlocationa[$i][1];

    $dmwscontractlocationa = Get_Array('dmwscontractlocation');  
    foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {     
        Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
        if ( ($GLOBALS{'person_userlevel'}  == "1" )||( $GLOBALS{'person_userlevel'}  == "2" )) {
            if (( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'}) )||
                ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'}) )) {
                array_push($permitteddmwscontractlocationida,$dmwscontractlocation_id);
                array_push($permitteddmwscontractlocationnamea,$GLOBALS{'dmwscontractlocation_name'});
            }
        }
        if ( ($GLOBALS{'person_userlevel'}  == "3" )||( $GLOBALS{'person_userlevel'}  == "4" )) {
            if ( $GLOBALS{'site_clientservermode'} == "Client") {
                if (( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'}) )||
                ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'}) )) {
                    array_push($permitteddmwscontractlocationida,$dmwscontractlocation_id);
                    array_push($permitteddmwscontractlocationnamea,$GLOBALS{'dmwscontractlocation_name'});
                }
            } else {
                array_push($permitteddmwscontractlocationida,$dmwscontractlocation_id);
                array_push($permitteddmwscontractlocationnamea,$GLOBALS{'dmwscontractlocation_name'});
            }
        }
    }

    // --- set permitted contracts ------------
    $permitteddmwscontractida = Array();
    $permitteddmwscontractnamea = Array();
    $dmwscontracta = Get_Array('dmwscontract');
    foreach ($dmwscontracta as $dmwscontract_id) {
        Get_Data('dmwscontract',$dmwscontract_id);
        $permittedcontract = "0";
        foreach ($permitteddmwscontractlocationida as $permitteddmwscontractlocationid) {
            if ( FoundInCommaList( $permitteddmwscontractlocationid, $GLOBALS{'dmwscontract_dmwscontractlocationidlist'} ) ) {
                $permittedcontract = "1";
            }
        }
        if ( $permittedcontract == "1" ) {
            array_push($permitteddmwscontractida,$dmwscontract_id);
            array_push($permitteddmwscontractnamea,$GLOBALS{'dmwscontract_name'});
        }
    }
    /*if ($GLOBALS{'LOGIN_person_id'} == "mche"){
        print_r($permitteddmwscontractlocationnamea);
        XBR();
        print_r($permitteddmwscontractnamea);
    }*/
    BCOLTXT("Contract","1");
    // $xhash = Get_SelectArrays_Hash ("dmwscontract","dmwscontract_id","dmwscontract_name","dmwscontract_id","","" );
    $xhash = Arrays2Hash ($permitteddmwscontractida, $permitteddmwscontractnamea);
		BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwscontractid','mand mandcheck','dmwssu_dmwscontractid',$GLOBALS{'dmwssu_dmwscontractid'},"3");
    BCOLTXT("Contract Location","1");
    $xhash = Arrays2Hash ($permitteddmwscontractlocationida, $permitteddmwscontractlocationnamea);
    // function BCOLINSELECTHASHIDCLASS ($hash,$id,$class,$name,$value,$cols) {
    BCOLINSELECTHASHIDCLASSDISABLED($xhash,'dmwssu_dmwscontractlocationid','mand mandcheck','dmwssu_dmwscontractlocationid',$GLOBALS{'dmwssu_dmwscontractlocationid'},"3",$disabledLocations);
    // BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwscontractlocationid','mand mandcheck','dmwssu_dmwscontractlocationid',$GLOBALS{'dmwssu_dmwscontractlocationid'},"3");

    B_ROW();
    XHR();
    XH4("Contact Details");
    BROW();
    BCOLTXT("Title","1");
    $xhash = Get_SelectArrays_Hash ("dmwstitle","dmwstitle_id","dmwstitle_name","dmwstitle_id","","" );
    BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwstitleid','mand mandcheck','dmwssu_dmwstitleid',$GLOBALS{'dmwssu_dmwstitleid'},"3");
    BCOLTXT("First Names","1");
    BCOLINTXTIDCLASS('dmwssux_fname','mand','dmwssux_fname',$GLOBALS{'dmwssux_fname'},"3");
    BCOLTXT("Last Name","1");
    BCOLINTXTIDCLASS('dmwssux_sname','mand','dmwssux_sname',$GLOBALS{'dmwssux_sname'},"3");
    B_ROW();
	BROW();
	BCOLTXT("DOB","1");
	BCOLINDATEID('dmwssu_dob','dmwssu_dob_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_dob'}),'dd/mm/yyyy',"3");
	BCOLTXT("Age","1");
	BCOLINTXTID('dmwssu_age','dmwssu_age',CurrentAgeYr($GLOBALS{'dmwssu_dob'}),"1");
	BCOLTXT("Gender","1");
	$xhash = Get_SelectArrays_Hash ("dmwsgender","dmwsgender_id","dmwsgender_name","dmwsgender_id","","" );
	BCOLINSELECTHASHID ($xhash,'dmwssu_gender','dmwssu_gender',$GLOBALS{'dmwssu_gender'},"1");
	BCOLTXT("Preferred Name","1");
	BCOLINTXTID('dmwssux_likedname','dmwssux_likedname',$GLOBALS{'dmwssux_likedname'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Address","1");
	BCOLINTXTID('dmwssux_address','dmwssux_address',$GLOBALS{'dmwssux_address'},"7");
	BCOLTXT("Post Code","1");
	BCOLINTXTID('dmwssux_postcode','dmwssux_postcode',$GLOBALS{'dmwssux_postcode'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Tel:","1");
	BCOLINTXTID('dmwssux_primetel','dmwssux_primetel',$GLOBALS{'dmwssux_primetel'},"3");
	BCOLTXT("Mobile Tel:","1");
	BCOLINTXTID('dmwssux_mobiletel','dmwssux_mobiletel',$GLOBALS{'dmwssux_mobiletel'},"3");
	BCOLTXT("Email","1");
	BCOLINTXTID('dmwssux_email','dmwssux_email',$GLOBALS{'dmwssux_email'},"3");
	B_ROW();
	XHR();
	XH4("Contacts");
	BROW();
	BCOLTXT("Next Of Kin Name","2");
	BCOLINTXTID('dmwssu_nokname','dmwssu_nokname',$GLOBALS{'dmwssu_nokname'},"3");
	BCOLTXT("Next Of Kin Relationship","2");
	BCOLINTXTID('dmwssu_nokrelationship','dmwssu_nokrelationship',$GLOBALS{'dmwssu_nokrelationship'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Next Of Kin Contact Tel","2");
	BCOLINTXTID('dmwssu_nokcontacttel','dmwssu_nokcontacttel',$GLOBALS{'dmwssu_nokcontacttel'},"3");
	BCOLTXT("Next Of Kin Contact Email","2");
	BCOLINTXTID('dmwssu_nokcontactemail','dmwssu_nokcontactemail',$GLOBALS{'dmwssu_nokcontactemail'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Emergency Contact Name","2");
	BCOLINTXTID('dmwssu_emergencyname','dmwssu_emergencyname',$GLOBALS{'dmwssu_emergencyname'},"3");
	BCOLTXT("Emergency Contact Relationship","2");
	BCOLINTXTID('dmwssu_emergencyrelationship','dmwssu_emergencyrelationship',$GLOBALS{'dmwssu_emergencyrelationship'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Emergency Contact Tel","2");
	BCOLINTXTID('dmwssu_emergencycontacttel','dmwssu_emergencycontacttel',$GLOBALS{'dmwssu_emergencycontacttel'},"3");
	BCOLTXT("Emergency Contact Email","2");
	BCOLINTXTID('dmwssu_emergencycontactemail','dmwssu_emergencycontactemail',$GLOBALS{'dmwssu_emergencycontactemail'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Police Fed/Other Rep Name","2");
	BCOLINTXTID('dmwssu_familywoemail','dmwssu_familywoemail',$GLOBALS{'dmwssu_familywoemail'},"3");
	BCOLTXT("Police Fed/Other Rep Tel","2");
	BCOLINTXTID('dmwssu_familywotel','dmwssu_familywotel',$GLOBALS{'dmwssu_familywotel'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Unit/Line Manager WO Tel","2");
	BCOLINTXTID('dmwssu_unitwotel','dmwssu_unitwotel',$GLOBALS{'dmwssu_unitwotel'},"3");
	BCOLTXT("Unit/Line Manager WO Email","2");
	BCOLINTXTID('dmwssu_unitwoemail','dmwssu_unitwoemail',$GLOBALS{'dmwssu_unitwoemail'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Family WO Name","2");
	BCOLINTXTID('dmwssu_familywoname','dmwssu_familywoname',$GLOBALS{'dmwssu_familywoname'},"3");
	BCOLTXT("Unit/Line Manager Aware","2");
	BCOLINCHECKBOXYESNO ("dmwssu_unitaware",$GLOBALS{'dmwssu_unitaware'},"","1");
	BCOLTXT("Family Aware","1");
	BCOLINCHECKBOXYESNO ("dmwssu_familyaware",$GLOBALS{'dmwssu_familyaware'},"","1");
	B_ROW();
	XHR();
	XH4("Service Details");
	BROW();
	BCOLTXT("Service","2");
	$xhash = Get_SelectArrays_Hash ("dmwsservice","dmwsservice_id","dmwsservice_name","dmwsservice_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwsserviceid','mand mandcheck','dmwssu_dmwsserviceid',$GLOBALS{'dmwssu_dmwsserviceid'},"2");
	BCOLTXT("Rank","2");
	BCOLINTXTID('dmwssu_servicerank','dmwssu_servicerank',$GLOBALS{'dmwssu_servicerank'},"2");
	BCOLTXT("Unit/Line Manager","2");
	BCOLINTXTID('dmwssu_serviceunit','dmwssu_serviceunit',$GLOBALS{'dmwssu_serviceunit'},"2");
	B_ROW();
	BROW();
	BCOLTXT("Service/Police Number","2");
	BCOLINTXTID('dmwssu_servicepolicenumber','dmwssu_servicepolicenumber',$GLOBALS{'dmwssu_servicepolicenumber'},"2");
	BCOLTXT("Regiment/Constabulary","2");
	BCOLINTXTID('dmwssu_serviceregiment','dmwssu_serviceregiment',$GLOBALS{'dmwssu_serviceregiment'},"2");
	BCOLTXT("Status","2");
	$xhash = Get_SelectArrays_Hash ("dmwsservicestatus","dmwsservicestatus_id","dmwsservicestatus_name","dmwsservicestatus_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwsuservicestatusid','mand mandcheck','dmwssu_dmwsuservicestatusid',$GLOBALS{'dmwssu_dmwsuservicestatusid'},"2");
	B_ROW();
	BROW();
	BCOLTXT("Workplace Location","2");
	BCOLINTXTID('dmwssu_serviceworkplace','dmwssu_serviceworkplace',$GLOBALS{'dmwssu_serviceworkplace'},"2");
	BCOLTXT("Service Discharge Date","2");
	BCOLINDATEID('dmwssu_servicedischargedate','dmwssu_servicedischargedate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_servicedischargedate'}),'dd/mm/yyyy',"2");
	BCOLTXT("MOD Out Of Area Contact Request","2");
	BCOLINCHECKBOXYESNO ("dmwssu_servicemodoutofarea",$GLOBALS{'dmwssu_servicemodoutofarea'},"","2");
	B_ROW();
	BROW();
	BCOLTXT("Current Occupational Status","2");
	$xhash = Get_SelectArrays_Hash ("dmwsoccupationalissuetype","dmwsoccupationalissuetype_id","dmwsoccupationalissuetype_name","dmwsoccupationalissuetype_id","","" );
	BCOLINSELECTHASHID ($xhash,'dmwssu_dmwsoccupationalissuetypeid','dmwssu_dmwsoccupationalissuetypeid',$GLOBALS{'dmwssu_dmwsoccupationalissuetypeid'},"2");
	BCOLTXT("Previous Occupation","2");
	$xhash = Get_SelectArrays_Hash ("dmwspreviousoccupationtype","dmwspreviousoccupationtype_id","dmwspreviousoccupationtype_name","dmwspreviousoccupationtype_id","","" );
	BCOLINSELECTHASHID ($xhash,'dmwssu_dmwspreviousoccupationtypeid','dmwssu_dmwspreviousoccupationtypeid',$GLOBALS{'dmwssu_dmwspreviousoccupationtypeid'},"2");
	BCOLTXT("Other","2");
	BCOLINTXTID('dmwssu_dmwspreviousoccupationtypeother','dmwssu_dmwspreviousoccupationtypeother',$GLOBALS{'dmwssu_dmwspreviousoccupationtypeother'},"2");
	B_ROW();
	BROW();
	BCOLTXT("Current Occupation","1");
	BCOLINTXTID('dmwssu_dmwsoccupation','dmwssu_dmwsoccupation',$GLOBALS{'dmwssu_dmwsoccupation'},"1");
	BCOLTXT("Is The SU A War Pensioner in receipt of:","2");
	BCOL("2");BINRADIOID("dmwssu_warpension","dmwssu_warpension","A war disablement pension/gratuity under the War Pensions Scheme",CheckedIf($GLOBALS{'dmwssu_warpension'},"A war disablement pension/gratuity under the War Pensions Scheme"),"A war disablement pension/gratuity under the War Pensions Scheme");B_COL();
	BCOL("2");BINRADIOID("dmwssu_warpensionlumpsum","dmwssu_warpension","A lump sum/guaranteed income payment under the Armed Forces Compensation Scheme",CheckedIf($GLOBALS{'dmwssu_warpension'},"A lump sum/guaranteed income payment under the Armed Forces Compensation Scheme"), "A lump sum/guaranteed income payment under the Armed Forces Compensation Scheme");B_COL();
	BCOL("2");BINRADIOID("dmwssu_warpensiondependant","dmwssu_warpension","receiving a war widow/widowers or dependants pension or dependant of a war pensioner.",CheckedIf($GLOBALS{'dmwssu_warpension'},"receiving a war widow/widowers or dependants pension or dependant of a war pensioner."), "receiving a war widow/widowers or dependants pension or dependant of a war pensioner.");B_COL();
	BCOL("2");BINRADIOID("dmwssu_warpensionnone","dmwssu_warpension","",CheckedIf($GLOBALS{'dmwssu_warpension'},""), "none.");B_COL();
	B_ROW();
	XHR();
	XH4("Referral Details");
	BROW();
	BCOLTXT("Referral Date","1");
	BCOLINDATEIDCLASS('dmwssu_referraldate','dmwssu_referraldate_dd/mm/yyyy','mand',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_referraldate'}),'dd/mm/yyyy',"3");
	BCOLTXT("Referral Time","1");
	BCOLINTXTIDCLASS('dmwssu_referraltime','mand','dmwssu_referraltime',$GLOBALS{'dmwssu_referraltime'},"3");
	BCOLTXT("Referrer Name","1");
	BCOLINTXTIDCLASS('dmwssu_referrername','mand','dmwssu_referrername',$GLOBALS{'dmwssu_referrername'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Referrer Org Name","1");
	BCOLINTXTIDCLASS('dmwssu_referrerorg','mand','dmwssu_referrerorg',$GLOBALS{'dmwssu_referrerorg'},"3");
	BCOLTXT("Referrer Telephone","1");
	BCOLINTXTIDCLASS('dmwssu_referrertel','mand','dmwssu_referrertel',$GLOBALS{'dmwssu_referrertel'},"3");
	BCOLTXT("Referrer Email","1");
	BCOLINTXTID('dmwssu_referreremail','dmwssu_referreremail',$GLOBALS{'dmwssu_referreremail'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Referral Org Type", 1);
	$xhash = Get_SelectArrays_Hash ("dmwsreferrerorgtype","dmwsreferrerorgtype_id","dmwsreferrerorgtype_name","dmwsreferrerorgtype_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_referralorgtypeid','mand mandcheck','dmwssu_referralorgtypeid',$GLOBALS{'dmwssu_referralorgtypeid'},"3");
	BCOLTXT("DMWS Location","1");
	BCOLINTXTIDCLASS('dmwssu_dmwslocation','mand','dmwssu_dmwslocation',$GLOBALS{'dmwssu_dmwslocation'},"3");
	BCOLTXT("Received By","1");
	BCOLINTXTIDCLASS('dmwssu_referralrecdby','mand','dmwssu_referralrecdby',$GLOBALS{'dmwssu_referralrecdby'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Service Unit Site","1");
	BCOLINTXTID('dmwssu_serviceunitsite','dmwssu_serviceunitsite',$GLOBALS{'dmwssu_serviceunitsite'},"3");
	BCOLTXT("Service Unit Contact","1");
	BCOLINTXTID('dmwssu_serviceunitcontact','dmwssu_serviceunitcontact',$GLOBALS{'dmwssu_serviceunitcontact'},"3");
	BCOLTXT("Service Unit Contact Tel","1");
	BCOLINTXTID('dmwssu_serviceunitcontacttel','dmwssu_serviceunitcontacttel',$GLOBALS{'dmwssu_serviceunitcontacttel'},"3");
	B_ROW();
	XHR();
	XH4("Referral Agreements");
	BROW();
	BCOLTXT("Consent Form Signed","1");
	BCOLINCHECKBOXYESNO ("dmwssu_consentsigned",$GLOBALS{'dmwssu_consentsigned'},"","1");
	BCOLTXT("Equality and Diversity Form","1");
	BCOLINCHECKBOXYESNO ("dmwssu_equalityforminterest",$GLOBALS{'dmwssu_equalityforminterest'},"","1");
	BCOLTXT("Support Type", 1);
	$xhash = Get_SelectArrays_Hash ("dmwssupporttype","dmwssupporttype_id","dmwssupporttype_name","dmwssupporttype_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwssupporttypeid','mand mandcheck','dmwssu_dmwssupporttypeid',$GLOBALS{'dmwssu_dmwssupporttypeid'},"3");
	B_ROW();
	XHR();
	XH4("Medical Location & Admission Details");
	BROW();
	BCOLTXT("Medical Location Type","1");
	$xhash = Get_SelectArrays_Hash ("dmwslocationtype","dmwslocationtype_id","dmwslocationtype_name","dmwslocationtype_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwslocationtypeid','mand mandcheck','dmwssu_dmwslocationtypeid',$GLOBALS{'dmwssu_dmwslocationtypeid'},"3");
	BCOLTXT("Location Name","1");
	BCOLINTXTIDCLASS('dmwssu_locationname','mand','dmwssu_locationname',$GLOBALS{'dmwssu_locationname'},"3");
	BCOLTXT("Location Site","1");
	BCOLINTXTIDCLASS('dmwssu_locationsite','mand','dmwssu_locationsite',$GLOBALS{'dmwssu_locationsite'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Location Contact","1");
	BCOLINTXTIDCLASS('dmwssu_locationcontact','mand','dmwssu_locationcontact',$GLOBALS{'dmwssu_locationcontact'},"3");
	BCOLTXT("Location Tel","1");
	BCOLINTXTIDCLASS('dmwssu_locationtel','mand','dmwssu_locationtel',$GLOBALS{'dmwssu_locationtel'},"3");
	BCOLTXT("Admission Reason","1");
	$xhash = Get_SelectArrays_Hash ("dmwsadmissionreason","dmwsadmissionreason_id","dmwsadmissionreason_name","dmwsadmissionreason_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwsadmissionreasonid','mand mandcheck','dmwssu_dmwsadmissionreasonid',$GLOBALS{'dmwssu_dmwsadmissionreasonid'},"3");
	B_ROW();
	BROW();
	BCOLTXT("Admission Type","1");
	$xhash = Get_SelectArrays_Hash ("dmwsadmissiontype","dmwsadmissiontype_id","dmwsadmissiontype_name","dmwsadmissiontype_id","","" );
	BCOLINSELECTHASHIDCLASS ($xhash,'dmwssu_dmwsadmissiontypeid','mand mandcheck','dmwssu_dmwsadmissiontypeid',$GLOBALS{'dmwssu_dmwsadmissiontypeid'},"3");
	BCOLTXT("Admission Date","1");
	BCOLINDATEIDCLASS('dmwssu_dmwsadmissiondate','dmwssu_dmwsadmissiondate_dd/mm/yyyy','mand',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_dmwsadmissiondate'}),'dd/mm/yyyy',"3");
	BCOLTXT("Additional Diagnosis","1");
	BCOLINTXTID('dmwssu_dmwsadditionaldiagnosis', 'dmwssu_dmwsadditionaldiagnosis',$GLOBALS{'dmwssu_dmwsadditionaldiagnosis'}, "3");
	B_ROW();
	BROW();
	BCOLTXT("NHS Number","1");
	BCOLINTXTID('dmwssux_nhsnumber', 'dmwssux_nhsnumber',$GLOBALS{'dmwssux_nhsnumber'}, "3");
	BCOLTXT("First Clinic Appointment Date","1");
	BCOLINDATEID('dmwssu_firstclinicapptdate','dmwssu_firstclinicapptdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_firstclinicapptdate'}),'dd/mm/yyyy',"3");

	B_ROW();
	BROW();
	BCOLTXT("WO Name","1");
	if ($GLOBALS{'dmwssu_woname'} != "") {
	    BCOLINTXTIDCLASS('dmwssu_woname','mand', 'dmwssu_woname', $GLOBALS{'dmwssu_woname'}, "3");
	} else {
	    BCOLINTXTIDCLASS('dmwssu_woname','mand', 'dmwssu_woname', $GLOBALS{'dmwsvisit_personid'}, "3");
	}
	BCOLTXT("WO Personal Id","1");
	BCOLINTXTID('dmwssu_wopersonid', 'dmwssu_wopersonid',$GLOBALS{'dmwssu_wopersonid'}, "3");
	BCOLTXT("Other WO Ids","1");
	BCOLINTXTID('dmwssu_otherwopersonidlist', 'dmwssu_otherwopersonidlist',$GLOBALS{'dmwssu_otherwopersonidlist'}, "3");
	B_ROW();
	XHR();
	XH4("Key Case Milestones","1");
	BROW();
	BCOLTXT("Initial Visit Date","1");
	BCOLINDATEIDCLASS('dmwssu_initialvisitdate','dmwssu_initialvisitdate_dd/mm/yyyy','mand',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_initialvisitdate'}),'dd/mm/yyyy',"3");
	BCOLTXT("Initial Visit Time","1");
	BCOLINTXTIDCLASS('dmwssu_initialvisittime','mand','dmwssu_initialvisittime',$GLOBALS{'dmwssu_initialvisittime'},"3");
	BCOLTXT("Expected Discharge Date","1");
	BCOLINDATEID('dmwssu_expecteddischargedate','dmwssu_expecteddischargedate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_expecteddischargedate'}),'dd/mm/yyyy',"3");
	B_ROW();
	BROW();
	BCOLTXT("Death Date","1");
	BCOLINDATEID('dmwssu_deathdate','dmwssu_deathdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_deathdate'}),'dd/mm/yyyy',"3");
	BCOLTXT("Case Closure Date","1");
	BCOLINDATEID('dmwssu_casecloseddate','dmwssu_casecloseddate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_casecloseddate'}),'dd/mm/yy',"3");
	BCOLTXT("Actual Discharge Date","1");
	BCOLINDATEID('dmwssu_dischargedate','dmwssu_dischargedate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_dischargedate'}),'dd/mm/yyyy',"3");
	B_ROW();
	BROW();
	BCOLTXT("Case Status","1");
	BCOL("2");BINRADIOID("dmwssu_caseopen","dmwssu_casestatus","Open",CheckedIf($GLOBALS{'dmwssu_casestatus'},"open"), "Open");B_COL();
	BCOL("2");BINRADIOID("dmwssu_caseclosed","dmwssu_casestatus","Closed",CheckedIf($GLOBALS{'dmwssu_casestatus'},"closed"), "Closed");B_COL();
	BCOL("2");BINRADIOID("dmwssu_casearchived","dmwssu_casestatus","Archived",CheckedIf($GLOBALS{'dmwssu_casestatus'},"archived"), "Archived");B_COL();
	B_ROW();
	BROW();
	BCOLTXT("Pre Referral A&E Attendance Occasions","1");
	BCOLINNUMID('dmwssu_prereferralaeattendancecount', 'dmwssu_prereferralaeattendancecount',$GLOBALS{'dmwssu_prereferralaeattendancecount'}, "2");
	BCOLTXT("Pre Referral A&E Period Weeks","1");
	BCOLINNUMID('dmwssu_prereferralaeperiodweek', 'dmwssu_prereferralaeperiodweek',$GLOBALS{'dmwssu_prereferralaeperiodweek'}, "2");
	BCOLTXT("Post Referral A&E Attendance Occasions","1");
	BCOLINNUMID('dmwssu_postreferralaeattendancecount', 'dmwssu_postreferralaeattendancecount',$GLOBALS{'dmwssu_postreferralaeattendancecount'}, "2");
	BCOLTXT("Pre Referral A&E Period Weeks","1");
	BCOLINNUMID('dmwssu_postreferralaeperiodweek', 'dmwssu_postreferralaeperiodweek',$GLOBALS{'dmwssu_postreferralaeperiodweek'}, "2");
	B_ROW();
	BROW();
	BCOLTXT("Pre Referral Admission Occasions","1");
	BCOLINNUMID('dmwssu_prereferraladmissioncount', 'dmwssu_prereferraladmissioncount',$GLOBALS{'dmwssu_prereferraladmissioncount'}, "2");

	BCOLTXT("Pre Referral Admission Period Weeks","1");
	BCOLINNUMID('dmwssu_prereferralperiodweek', 'dmwssu_prereferralperiodweek',$GLOBALS{'dmwssu_prereferralperiodweek'}, "2");

	BCOLTXT("Post Referral Admission Occasions","1");
	BCOLINNUMID('dmwssu_postreferraladmissioncount', 'dmwssu_postreferraladmissioncount',$GLOBALS{'dmwssu_postreferraladmissioncount'}, "2");

	BCOLTXT("Post Referral Admission Period Weeks","1");
	BCOLINNUMID('dmwssu_postreferralperiodweek', 'dmwssu_postreferralperiodweek',$GLOBALS{'dmwssu_postreferralperiodweek'}, "2");
	B_ROW();
	BROW();
	BCOLTXT("Follow Up Agreed","1");
	BCOLINCHECKBOXYESNO ("dmwssu_followupagreed",$GLOBALS{'dmwssu_followupagreed'},"","3");
	BCOLTXT("Survey Issued","1");
	BCOLINCHECKBOXYESNO ("dmwssu_surveyissued",$GLOBALS{'dmwssu_surveyissued'},"","3");
	BCOLTXT("Survey Completed","1");
	BCOLINCHECKBOXYESNO ("dmwssu_surveycompleted",$GLOBALS{'dmwssu_surveycompleted'},"","3");
	B_ROW();
	BROW();
	BCOLTXT("Use Case Consent","1");
	BCOLINCHECKBOXYESNO ("dmwssu_usecaseconsent",$GLOBALS{'dmwssu_usecaseconsent'},"","3");
	BCOLTXT("Use Case Anonymity","1");
	BCOLINCHECKBOXYESNO ("dmwssu_usecaseanonymity",$GLOBALS{'dmwssu_usecaseanonymity'},"","3");
	B_ROW();
	XHR();
	XH4("Safeguarding Status");
	XPTXT("Consider all the Safeguarding Issues, where SU is the possible victim or perpetrator. In Contact Log record detailed reasoning and whether the risk is to the SU or to members of their family, children & young people, carers, the general public, DMWS/ Medical/Organisations staff etc and if the SU is the victim of abuse or perpetrator.  ");
	//BCOLTXT("SU Safeguarding Issue","2");
	//$xhash = Get_SelectArrays_Hash ("dmwssafeguardingissuetype","dmwssafeguardingissuetype_id","dmwssafeguardingissuetype_name","dmwssafeguardingissuetype_id","","" );
	//BCOLINSELECTHASHID ($xhash,'dmwssu_dmwssafeguardingissuetypeid','dmwssu_dmwssafeguardingissuetypeid',$GLOBALS{'dmwssu_dmwssafeguardingissuetypeid'},"3");
	XBR();
	XPTXT("<b>WO Safeguarding Issues:</b>");
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwswosafeguardingissuetype","dmwswosafeguardingissuetype_id","dmwswosafeguardingissuetype_name","","","" );
	BCOLINCHECKBOXHASH($xhash,"dmwssu_dmwswosafeguardingissuelist",$GLOBALS{'dmwssu_dmwswosafeguardingissuelist'},"4");
	B_ROW();
	XPTXT("<b>SU Safeguarding Issues:</b>");
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwssafeguardingissuetype","dmwssafeguardingissuetype_id","dmwssafeguardingissuetype_name","","","" );
	BCOLINCHECKBOXHASHCLASS($xhash,"dmwssu_dmwssafeguardingissuelist",$GLOBALS{'dmwssu_dmwssafeguardingissuelist'},"susafeguardingissuebox","11");
	B_ROW();
	XDIV("dmwssafeguardingextras","");
	BROW();
	BCOLTXT("RAG Status","1");
	BCOLINSELECTHASHIDCLASS(List2Hash("Red,Amber,Green"),"dmwssu_safeguarding",'ragMand mandcheck','dmwssu_safeguarding',$GLOBALS{'dmwssu_safeguarding'},"1");
	B_ROW();
	BROW();
	BCOLTXT("Safeguarding Applies To","2");
	$xhash = Get_SelectArrays_Hash ("dmwssafeguardeetype","dmwssafeguardeetype_id","dmwssafeguardeetype_name","","","" );
	BCOLINSELECTHASHIDCLASS($xhash,"dmwssu_dmwssafeguardeetypeid",'mand mandcheck','dmwssu_dmwssafeguardeetypeid',$GLOBALS{'dmwssu_dmwssafeguardeetypeid'},"6");
	if ($GLOBALS{'dmwssu_dmwssafeguardeetypeid'} == "SUWorkVulnAdult" || $GLOBALS{'dmwssu_dmwssafeguardeetypeid'} == "VulnerableAdultFam" || $GLOBALS{'dmwssu_dmwssafeguardeetypeid'} == "SUCarerAdult"){
	    B_ROW();
	    BROW();
	    BCOLTXT("Reason For Vulnerable Adult","2");
	    $xhash = Get_SelectArrays_Hash ("dmwssafeguardeereasontype","dmwssafeguardeereasontype_id","dmwssafeguardeereasontype_name","","","" );
	    BCOLINSELECTHASHIDCLASS($xhash,"dmwssu_dmwssafeguardeereasontypeid",'mand mandcheck','dmwssu_dmwssafeguardeereasontypeid',$GLOBALS{'dmwssu_dmwssafeguardeereasontypeid'},"3");
	};
	B_ROW();
	X_DIV("dmwssafeguardingextras");
}

function VISITContentOutput($thisdmwssu_id, $dmwsvisit_id) {

    Check_Data('dmwsvisit',$thisdmwssu_id,$dmwsvisit_id);

    XINHID('dmwsvisit_startfield',"");
    XBR();
    BROW();
    BCOLTXT("<h3>Contact Log</h3>","2");
    BCOLTXT("","7");
    BCOLTXT("Status","1");
    BCOLINSELECTHASHIDCLASS(List2Hash('Open,Completed'),'dmwsvisit_status','rag','dmwsvisit_status',$GLOBALS{'dmwsvisit_status'},"1");
    B_ROW();
    XHRCLASS('underline');
    XPTXT("Please complete a latest contact assessment.");
    XH3("Contact Summary");
    BROW();
    BCOLTXT("Contact Type","1");
    $xhash = Get_SelectArrays_Hash ("dmwscontacttype","dmwscontacttype_id","dmwscontacttype_type","dmwscontacttype_id","","" );
    BCOLINSELECTHASHID ($xhash,'dmwsvisit_contacttype','dmwsvisit_contacttype',$GLOBALS{'dmwsvisit_contacttype'},"2");
    BCOLTXT("Contact Date","1");
    if (($GLOBALS{'dmwsvisit_date'} == "0000-00-00")||($GLOBALS{'dmwsvisit_date'} == "")) {
        $GLOBALS{'dmwsvisit_date'} = $GLOBALS{'currentYYYY-MM-DD'};
    }
    BCOLINDATEID('dmwsvisit_date','dmwsvisit_date_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsvisit_date'}),"dd/mm/yyyy","2");
    BCOLTXT("Contact Time","1");
    BCOLINTXTID('dmwsvisit_time','dmwsvisit_time',$GLOBALS{'dmwsvisit_time'},"2");
    BCOLTXT("","3");
    B_ROW();
    BROW();
    BCOLTXT("Welfare Officer","1");
    if ($GLOBALS{'dmwsvisit_personid'} != "") {
        BCOLINTXTID('dmwsvisit_personid', 'dmwsvisit_personid', $GLOBALS{'dmwsvisit_personid'}, "2");
    } else {
        BCOLINTXTID('dmwsvisit_personid', 'dmwsvisit_personid', $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}, "2");
    }
    BCOLTXT("Location Of Visit","1");
    BCOLINTXTID('dmwsvisit_location','dmwsvisit_location',$GLOBALS{'dmwsvisit_location'},"2");
    BCOLTXT("","6");
    B_ROW();

    XH3("Notes");
    BROW();
    BCOLTXT("Contact Notes","1");
    BCOLINTEXTAREAID('dmwsvisit_notes','dmwsvisit_notes',$GLOBALS{'dmwsvisit_notes'},"5","10");
    BCOLTXT("","1");
    B_ROW();


    XH3("Timesheet");
    BROW();
    BCOLTXT("Activity Within TimeBand<br>Minutes","2");
    BCOLTXT("SU Visit","1");
    BCOLTXT("Telephone","1");
    BCOLTXT("Research","1");
    BCOLTXT("Travel","1");
    BCOLTXT("Family<br>Support","1");
    BCOLTXT("Bereavement<br>Support","1");
    BCOLTXT("Death<br>Viewing","1");
    BCOLTXT("Support to NHS Staff/Others","1");
    BCOLTXT("Other Admin<br>etc","1");
    BCOLTXT("","1");
    B_ROW();

    $timebandsa = Array();
    $dmwstimebanda = Get_Array('dmwstimeband');
    foreach ($dmwstimebanda as $dmwstimeband_id) {
        Get_Data('dmwstimeband',$dmwstimeband_id);

        if ($GLOBALS{'dmwstimeband_dmwscontractid'} == $GLOBALS{'dmwssu_dmwscontractid'} && $GLOBALS{'dmwstimeband_dmwscontractlocationid'} == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
            array_push($timebandsa,$dmwstimeband_id);
            BROW();
            BCOLTXT($GLOBALS{'dmwstimeband_name'}." ".$GLOBALS{'dmwstimeband_start'}." - ".$GLOBALS{'dmwstimeband_end'},"2");
            BCOLINTXTIDCLASS('dmwsvisit_durationvisit_'.$dmwstimeband_id,'contMand','dmwsvisit_durationvisit_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationvisit',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationtel_'.$dmwstimeband_id,'contMand','dmwsvisit_durationtel_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationtel',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationresearch_'.$dmwstimeband_id,'contMand','dmwsvisit_durationresearch_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationresearch',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationtravel_'.$dmwstimeband_id,'contMand','dmwsvisit_durationtravel_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationtravel',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationfamily_'.$dmwstimeband_id,'contMand','dmwsvisit_durationfamily_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationfamily',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationbereavement_'.$dmwstimeband_id,'contMand','dmwsvisit_durationbereavement_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationbereavement',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationdeathviewing_'.$dmwstimeband_id,'contMand','dmwsvisit_durationdeathviewing_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationdeathviewing',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationstaffsupport_'.$dmwstimeband_id,'contMand','dmwsvisit_durationstaffsupport_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationstaffsupport',$dmwstimeband_id),"1");
            BCOLINTXTIDCLASS('dmwsvisit_durationadmin_'.$dmwstimeband_id,'contMand','dmwsvisit_durationadmin_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationadmin',$dmwstimeband_id),"1");
            BCOLTXT("","1");
            B_ROW();
        }
    }
    if (sizeof($timebandsa) == "0"){

        foreach ($dmwstimebanda as $dmwstimeband_id) {
            Get_Data('dmwstimeband',$dmwstimeband_id);
            if ($GLOBALS{'dmwstimeband_dmwscontractid'} == "Default"){
                BROW();
                BCOLTXT($GLOBALS{'dmwstimeband_name'}." ".$GLOBALS{'dmwstimeband_start'}." - ".$GLOBALS{'dmwstimeband_end'},"2");
                BCOLINTXTIDCLASS('dmwsvisit_durationvisit_'.$dmwstimeband_id,'contMand','dmwsvisit_durationvisit_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationvisit',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationtel_'.$dmwstimeband_id,'contMand','dmwsvisit_durationtel_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationtel',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationresearch_'.$dmwstimeband_id,'contMand','dmwsvisit_durationresearch_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationresearch',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationtravel_'.$dmwstimeband_id,'contMand','dmwsvisit_durationtravel_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationtravel',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationfamily_'.$dmwstimeband_id,'contMand','dmwsvisit_durationfamily_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationfamily',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationbereavement_'.$dmwstimeband_id,'contMand','dmwsvisit_durationbereavement_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationbereavement',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationdeathviewing_'.$dmwstimeband_id,'contMand','dmwsvisit_durationdeathviewing_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationdeathviewing',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationstaffsupport_'.$dmwstimeband_id,'contMand','dmwsvisit_durationstaffsupport_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationstaffsupport',$dmwstimeband_id),"1");
                BCOLINTXTIDCLASS('dmwsvisit_durationadmin_'.$dmwstimeband_id,'contMand','dmwsvisit_durationadmin_'.$dmwstimeband_id,GetTimeBandList('dmwsvisit_durationadmin',$dmwstimeband_id),"1");
                BCOLTXT("","1");
                B_ROW();
            }
        }
    }
    XBR();
    if (($GLOBALS{'dmwsvisit_type'} == "Discharge" )||($GLOBALS{'dmwsvisit_type'} == "Subsequent" )||($GLOBALS{'dmwsvisit_type'} == "FollowUp" )) {
        XHR();
        BROW();
        BCOLTXT("Change this visit type:","2");
        BCOL("10");
        if ( $GLOBALS{'dmwsvisit_type'} == "FollowUp" ) { $chgvisittype = "Discharge"; }
        if ( $GLOBALS{'dmwsvisit_type'} == "Discharge" ) { $chgvisittype = "Subsequent"; }
        if ( $GLOBALS{'dmwsvisit_type'} == "Subsequent" ) { $chgvisittype = "Discharge"; }
        BINBUTTONIDCLASSSPECIAL('dmwschangevisitstatusbtn','changestatusbtn','warning','Change Visit Type from "'.$GLOBALS{'dmwsvisit_type'}.'" to "'.$chgvisittype.'"');
        B_COL();
        B_ROW();
        XINHID('dmwsvisit_newvisittype','');

    }
    XINHID('dmwsvisit_mandfieldsremaininglist','');
    XINHID('dmwsvisit_endfield',"");
}


function CONSENTContentOutput($thisdmwssu_id) {
	XINHID('dmwsconsent_startfield',"");
	XBR();
	XH3("Patient Information and Referral Consent Form");
	XHRCLASS('underline');
	XPTXT("Please read and fill in the consent form below.");
	XBR();
	XPTXT("DMWS collect and store your personal information in line with the <b>Data Protection Act  1998</b> (DPA) and the <b>General Data Protection Regulation (GDPR)</b> (Regulation (EU) 2016/679).
			DMWS follow the 8 principles of the DPA ");
	XPTXT("<ol><li>Personal data shall be processed fairly and lawfully.</li>
            <li>Personal data shall be obtained only for one or more specified and lawful purposes, and shall not be further processed in any manner incompatible with that purpose or those purposes.</li>
			<li>Personal data shall be adequate, relevant and not excessive.</li>
			<li>Personal data shall be accurate and, where necessary, kept up to date.</li>
			<li>Personal data shall not be kept for longer than is necessary.</li>
			<li>Personal data shall be processed in accordance with the rights of data subjects under this Act.</li>
			<li>Appropriate technical and organisational measures shall be taken against unauthorised or unlawful processing of personal data and against accidental loss or destruction of, or damage to, personal data.</li>
			<li>Personal data shall not be transferred to a country or territory outside the European Economic Area unless that country or territory ensures an adequate level of protection for the rights and freedoms of data subjects in relation to the processing of personal data.</li></ol>");
	XHR();

	XPTXT("<b>How we use your personal data</b>");
	XPTXT("<i>(for you and any members of your family that we may provide our services to)</i>");
	XPTXT("<ul>
		  <li>We gather and store your personal information to enable us to provide a medical welfare service.</li>
		  <li>We store your information on our service user information management portal, held on a secure and password protected server. Only appropriate members of DMWS staff have access to your personal information.</li>
		  <li>We do not keep any paper copies of your information.</li>
		  <li>We utilise the information to understand your needs, and to be able to make appropriate and relevant referrals to third party organisations that will be able to help and support you.</li>
		  <li>No referrals will be made, or personal information disclosed to any third party organisation without your specific agreement and consent.</li>
			<li>Only necessary information to enable them to respond to the referral we make to them, will be shared with those third party organisations.</li>
			<li>We utilise anonymous case data and outcomes to analyse the service we provide, to make improvements to the services provided, and to report to our stakeholders and funders.</li>
			<li>As we work within the health and social care environment, your personal information will be stored on our service user information management portal for a period of 7 years from the date we receive your information.</li>
			<li>You can opt out of your consent to storage of your information at any time, following which we will destroy all personal information stored on DMWS systems.</li>
			<li>We may, from time to time, like to send you information about DMWS and its services, activities or events. Your details will not be passed to any other third party for marketing purposes.  You can opt out of receiving marketing information at any time.</li>
			<li>We may contact you to request your permission to use your story for marketing, reports, and website promotion of our services and the how we have supported our service users. At time of contact you can choose to permit us to use your story anonymously if you prefer, or refuse to allow us to use your story.  You can opt out of being contacted for this purpose at any time.</li>
		</ul> ");
	XHR();
	XPTXT("<b>Your Rights Under the DPA</b>");
	XPTXT("<ul>
	<li>a right of access to a copy of the information comprised in their personal data;</li>
	<li>a right to object to processing that is likely to cause or is causing damage or distress;</li>
	<li>a right to prevent processing for direct marketing;</li>
	<li>a right to object to decisions being taken by automated means;</li>
	<li>a right in certain circumstances to have inaccurate personal data rectified, blocked, erased or destroyed; </li>
	<li>a right to claim compensation for damages caused by a breach of the Act.</li>
	</ul>");
	XPTXT("If you wish to action these rights at any time, please let your Welfare Officer know, and we will arrange for our Data Protection Controller to contact you as soon as possible to ensure your request is carried out.");
	XHR();
	XPTXT("<b>Your Consent</b>");
	BROW();
	BCOLINCHECKBOXYESNO ("dmwssu_readandunderstood",$GLOBALS{'dmwssu_readandunderstood'},"I, ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'}.", have read and understood the purposes for which DMWS will store my personal information.","12");
	B_ROW();
	BROW();
	BCOLINCHECKBOXYESNO ("dmwssu_personalinfostorage",$GLOBALS{'dmwssu_personalinfostorage'},"I agree to DMWS storing my personal information for the purposes set out above.","5");
	B_ROW();
	BROW();
	BCOLINCHECKBOXYESNO ("dmwssu_makingreferrals",$GLOBALS{'dmwssu_makingreferrals'},"I agree to DMWS utilising my personal information as appropriate for the purpose of making referrals to those third party organisations identified and agreed by me within my DMWS Service User Record.","12");
	B_ROW();
	XBR();
	XPTXT("I agree to DMWS Welfare Officers contacting me for the purposes of providing DMWS services and support using the following methods of communication:");
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwssupportcommunicationtype","dmwssupportcommunicationtype_id","dmwssupportcommunicationtype_name","","","" );
	BCOLINCHECKBOXHASH($xhash,"dmwssu_supportcommunicationlist",$GLOBALS{'dmwssu_supportcommunicationlist'},"7");
	B_ROW();
	XBR();
	XPTXT("I agree to DMWS holding my contact information on their contact management system and to contacting me in relation to requests for using my story for marketing, promotional, and reporting to stakeholders.  I understand that I can choose to remain anonymous.  I agree to contact being made for this purpose by:");
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwsreportcommunicationtype","dmwsreportcommunicationtype_id","dmwsreportcommunicationtype_name","","","" );
	BCOLINCHECKBOXHASH($xhash,"dmwssu_reportcommunicationlist",$GLOBALS{'dmwssu_reportcommunicationlist'},"7");
	B_ROW();
	XHR();

	/*
	XH3("Signature");
	XDIV("captureSignature","kbw-signature");
	X_DIV("captureSignature");
	XBR();
	if ( $GLOBALS{'person_userlevel'}  == "4" ) {
	    BINBUTTONIDSPECIAL("changeSignature","success","Change");
	}
	BINBUTTONIDSPECIAL("clearSignature","warning","Clear");
	BINBUTTONIDSPECIAL("saveSignature","primary","Save");
	// XINHIDID("mirrorsignature","mirrorsignature",$GLOBALS{'dmwssux_signature'});
	XINHIDIDDQ("dmwssux_signature","dmwssux_signature",$GLOBALS{'dmwssux_signature'});
	XINHIDIDDQ("mirrorsignature","mirrorsignature","");
	// XINHIDID("dmwssux_signature","dmwssux_signature","");
	XBR();XBR();
	*/

	XH3("Signature");
	// XPTXT($GLOBALS{'dmwssux_signature'});
	XINHIDIDDQ("dmwssux_signature","dmwssux_signature",$GLOBALS{'dmwssux_signature'});
	XINHIDIDDQ("mirrorsignature","mirrorsignature","");

	XDIV("noSignature","");
	XBR();
	XTXT("No signature recorded");
	XBR();
	X_DIV("noSignature");

	XDIV("drawSignature","kbw-signaturedraw");
	X_DIV("drawSignature");
	XBR();
	BINBUTTONIDSPECIAL("drawSignatureClear","warning","Remove Signature");
	BINBUTTONIDSPECIAL("drawSignatureUpdate","primary","Enter Signature");
	XBR();XBR();

	BROW();
	BCOLINCHECKBOXYN ("dmwssu_signatureproxy",$GLOBALS{'dmwssu_signatureproxy'},"Consent provided by proxy.","2");
	BCOLTXT("Name","1");
	BCOLINTXTID('dmwssu_signatureproxyname','dmwssu_signatureproxyname',$GLOBALS{'dmwssu_signatureproxyname'},"6");
	B_ROW();

	BROW();
	BCOLTXT("Date","1");
	BCOLINDATEID('dmwssu_consentdate','dmwssu_consentdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_consentdate'}), "dd/mm/yyyy","3");
	BCOLTXT("","9");
	B_ROW();
	XHR();
	XBR();
	BROWEQH();
	BCOLTXTCOLOR("<b>Withdrawal Reason</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Comment</b>","3","gray","white");
	BCOLTXTCOLOR("<b>Date</b>","1","gray","white");
	BCOL("1"); BINBUTTONIDSPECIAL('dmwsconsentwithdrawal_add_new',"success","+"); B_COL();
	B_ROW();

	$dmwsconsentwithdrawala = Get_Array('dmwsconsentwithdrawal',$thisdmwssu_id);
	foreach ($dmwsconsentwithdrawala as $dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid) {
	    Check_Data('dmwsconsentwithdrawal',$thisdmwssu_id,$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid);
	    if ($GLOBALS{'IOWARNING'} == "0") {
	        BROW();
	        XINHID('dmwsconsentwithdrawal_startfield_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,"");
	        $xhash = Get_SelectArrays_Hash ("dmwsconsentwithdrawaltype","dmwsconsentwithdrawaltype_id","dmwsconsentwithdrawaltype_name","dmwsconsentwithdrawaltype_id","","" );
	        BCOLINSELECTHASHID ($xhash,'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,$GLOBALS{'dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid'},"2");
	        BCOLINTEXTAREAID('dmwsconsentwithdrawal_comment_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,'dmwsconsentwithdrawal_comment_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,$GLOBALS{'dmwsconsentwithdrawal_comment'},"3","3");
	        BCOLINDATEID('dmwsconsentwithdrawal_date_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,'dmwsconsentwithdrawal_date_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsconsentwithdrawal_date'}),"dd/mm/yyyy","1");
	        BCOL("1"); BINBUTTONIDCLASSSPECIAL('dmwsconsentwithdrawal_delete_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,"dmwsconsentwithdrawaldelete","danger","x"); B_COL();
	        XINHID('dmwsconsentwithdrawal_endfield_'.$dmwsconsentwithdrawal_dmwsconsentwithdrawaltypeid,"");
	        B_ROW();
	        XHR();
	    }
	}
	XDIV("dmwsconsentwithdrawallistend","");
	X_DIV("dmwsconsentwithdrawallistend");


	/*XBR();
	BROW();
	BCOLTXT("", "2");
	// XTABLEINVISIBLE();
	print '<table border="1px">';
	XTR();
	// XTDFIXED("600");
	print '<td width="600px" style="padding: 50px;" >';

	XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_style/DMWSLogo.png",'75px');
    XBR();XBR();
	BROW();
	$text = "<b>Consent for information to be collected, stored and appropriately shared by DMWS in accordance with the Data Protection Act 1998:</b>";
	BCOLTXT($text,"12");
	B_ROW();
	XBR();
	BROW();
	$text = "I, ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'}.", hereby consent to DMWS collecting and sorting my personal details for their use in relation to DMWS Welfare Services provided.";
	BCOLTXT($text,"12");
    B_ROW();
    XBR();
	BROW();
	$xhash=List2Hash("do,do not");
	$text = " In addition, I &nbsp;";
	$text = $text.YINSELECTHASH ($xhash,'dmwssu_consentgiven',$GLOBALS{'dmwssu_consentgiven'});
	$text = $text."&nbsp; consent to my contact details and summary of need being shared with other appropriate statutory, public and/or ";
	$text = $text."third sector organisations, after discussion and agreement with myself and/or my next of kin where appropriate, and as identified on my DMWS service user records and/or DMWS assessment form, for the sole purpose of enabling signposting and supported referrals to thise organisations to provide advice, guidance, services and support to me and/or my family.";
    BCOL("12");
	XTXT($text);
	B_COL();
    B_ROW();
	XBR();XBR();
echo <<< EOT

	<p>Signature</h3>
	<div id="defaultSignature" class="kbw-signature"></div>
	<p style="clear: both;"><span class="demoLabel">&nbsp;</span>
	<button type="button" id="removeSignature">Clear</button>
	<button type="button" id="saveSignature">Save</button>

EOT;
    XBR();XBR();
	BROW();
	BCOLTXT("Date","1");
	BCOLINDATEID('dmwssu_consentdate'.$dmwsreferral_id, 'dmwsreferral_consentdate'.$dmwsreferral_id.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwssu_consentdate'}), "dd/mm/yyyy","3");
	BCOLTXT("","9");
	B_ROW();

	X_TD();
	X_TR();
	X_TABLE();
	B_ROW();*/
	XINHID('dmwsconsent_endfield',"");
}

function MODSPECIFICContentOutput($thisdmwssu_id) {
	XINHID('dmwsmodspceific_startfield',"");
	XBR();
	XH3("MOD Specific Info");
	XHRCLASS('underline');
	XPTXT("Please check the relevant boxes to show which services were used.");
	XBR();
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwsmodspecifictype","dmwsmodspecifictype_id","dmwsmodspecifictype_name","","","" );
	BCOLINCHECKBOXHASH($xhash,"dmwssu_modspecificlist",$GLOBALS{'dmwssu_modspecificlist'},"7");
	B_ROW();
	BROW();
	BCOLTXT("Originating Country (Aeromeded From)","2");
	BCOLINTXTID('dmwssu_originatingcountry','dmwssu_originatingcountry',$GLOBALS{'dmwssu_originatingcountry'},"3");
	B_ROW();
	XINHID('dmwsmodspecific_endfield',"");
}


function EQUALITYContentOutput($thisdmwssu_id) {
	XINHID('dmwsequality_startfield',"");
	XBR();
	XH3("Equality and Diversity");
	XHRCLASS('underline');
	XPTXT("<b>DMWS </b>"."wants to meet the aims and commitments set out in its equality policy. This includes not discriminating under the Equality Act 2010, and building an accurate picture of the make-up of the people we support, encouraging equality and diversity. The organisation needs your help and co-operation to enable it to do this, but filling in this form is voluntary. The information you provide will stay confidential, and be stored securely and limited to only staff that require it to enable appropriate support to be provided to you based on your needs.");
	XHR();
	XH4("Marriage Status");
	BROW();

	/*
	function BINRADIOID ($idname, $name, $value, $selected, $text) {
	    echo '<div class="radio"><label><input id="'.$idname.'" type="radio" name="'.$name.'" value="'.$value.'" '.$selected.'>'.$text.'</label></div>'."\n";
	}
	*/

	BCOL("2");BINRADIOID("dmwssu_marriagestatusyes","dmwssu_marriagestatus","Married",CheckedIf($GLOBALS{'dmwssu_marriagestatus'},"Married"), "Married / In a Civil Partnership");B_COL();
	BCOL("3");BINRADIOID("dmwssu_marriagestatusno","dmwssu_marriagestatus","NotMarried",CheckedIf($GLOBALS{'dmwssu_marriagestatus'},"NotMarried"),  "Not Married / Not In a Civil Partnership");B_COL();
	BCOL("2");BINRADIOID("dmwssu_marriagewidow","dmwssu_marriagestatus","Widow", CheckedIf($GLOBALS{'dmwssu_marriagestatus'},"Widow"), "Widow / Widower/ Partner Deceased");B_COL();
	BCOL("2");BINRADIOID("dmwssu_marriagestatusprefnotsay","dmwssu_marriagestatus","PrefNotSay", CheckedIf($GLOBALS{'dmwssu_marriagestatus'},"PrefNotSay"), "Prefer not to say");B_COL();
	B_ROW();
	XHR();
	XH4("Ethnicity");
	XPTXT("Ethnic origin is not about nationality, place of birth or citizenship. It is about the group to which you perceive you belong. Please select the appropriate option.");
	XPTXT("<b>White</b>");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_ethnicityeng","dmwssu_ethnicity","English",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"English"), "English");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitywelsh","dmwssu_ethnicity","Welsh",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Welsh"), "Welsh");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicityscott","dmwssu_ethnicity","Scottish",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Scottish"), "Scottish");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitynorthirsh","dmwssu_ethnicity","NorthernIrish",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"NorthernIrish"), "Northern Irish");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicityirish","dmwssu_ethnicity","Irish",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Irish"), "Irish");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitybritish","dmwssu_ethnicity","British",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"British"),"", "British");B_COL();
	BCOL("2");BINRADIOID("dmwssu_ethnicitygypsytraveller","dmwssu_ethnicity","Traveller",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Traveller"), "Gypsy or Irish Traveller");B_COL();
	B_ROW();
	XPTXT("<b>Mixed/Multiple ethnic groups</b>");
	BROW();
	BCOL("2");BINRADIOID("dmwssu_ethnicitywhiteblackcarrib","dmwssu_ethnicity","WaBCaribbean",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"WaBCaribbean"), "White and Black Carribean");B_COL();
	BCOL("2");BINRADIOID("dmwssu_ethnicitywhiteblackafrican","dmwssu_ethnicity","WaBAfrican",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"WaBAfrican"), "White and Black African");B_COL();
	BCOL("2");BINRADIOID("dmwssu_ethnicitywhiteasian","dmwssu_ethnicity","WaAsian",CheckedIf($GLOBALS{'dmwssu_ethnicity'},"WaAsian"), "White and Asian");B_COL();
	B_ROW();
	XBR();
	XPTXT("<b>Asian / Asian British</b>");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_ethnicityindian","dmwssu_ethnicity","Indian", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Indian"), "Indian");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitypakistani","dmwssu_ethnicity","Pakistani", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Pakistani"), "Pakistani");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitybangladeshi","dmwssu_ethnicity","Bangladeshi", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Bangladeshi"), "Bangladeshi");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitychinese","dmwssu_ethnicity","Chinese", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Chinese"), "Chinese");B_COL();
	B_ROW();
	XBR();
	XPTXT("<b>Black / African / Caribbean / Black British</b>");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_ethnicityafrican","dmwssu_ethnicity","African", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"African"), "African");B_COL();
	BCOL("1");BINRADIOID("dmwssu_ethnicitycarribean","dmwssu_ethnicity","Carribbean", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Carribbean"), "Carribbean");B_COL();
	B_ROW();
	XBR();
	XPTXT("<b>Other ethnic group</b>");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_ethnicityarab","dmwssu_ethnicity","Arab", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Arab"), "Arab");B_COL();
	BCOL("2");BINRADIOID("dmwssu_ethnicityprefnotsay","dmwssu_ethnicity","PrefNotSay", CheckedIf($GLOBALS{'dmwssu_ethnicity'},"Prefnotsay"), "Prefer not to say");B_COL();
	BCOLTXT("Any other ethnic group, please specify","3");
	BCOLINTXTID('dmwssu_ethnicityalternative','dmwssu_ethnicityalternative',$GLOBALS{'dmwssu_ethnicityalternative'},"2");
	B_ROW();
	XHR();
	XH4("Disabilities / Health Conditions");
	XPTXT("Please select all that apply");
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwsdisabilitytype","dmwsdisabilitytype_id","dmwsdisabilitytype_name","","","" );
	BCOLINCHECKBOXHASH($xhash,"dmwssu_disabilitytypelist",$GLOBALS{'dmwssu_disabilitytypelist'},"5");
	B_ROW();
	XHR();
	XH4("Sexual Orientation");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_sexualorientationhetero","dmwssu_sexualorientation","Heterosexual", CheckedIf($GLOBALS{'dmwssu_sexualorientation'},"Heterosexual"), "Heterosexual");B_COL();
	BCOL("2");BINRADIOID("dmwssu_sexualorientationlesbian","dmwssu_sexualorientation","GayWoman", CheckedIf($GLOBALS{'dmwssu_sexualorientation'},"GayWoman"), "Gay Woman / Lesbian");B_COL();
	BCOL("1");BINRADIOID("dmwssu_sexualorientationgayman","dmwssu_sexualorientation","GayMan", CheckedIf($GLOBALS{'dmwssu_sexualorientation'},"GayMan"), "Gay Man");B_COL();
	BCOL("1");BINRADIOID("dmwssu_sexualorientationbisexual","dmwssu_sexualorientation","Bisexual", CheckedIf($GLOBALS{'dmwssu_sexualorientation'},"Bisexual"), "Bisexual");B_COL();
	BCOL("2");BINRADIOID("dmwssu_sexualorientationprefnotsay","dmwssu_sexualorientation","PrefNotSay", CheckedIf($GLOBALS{'dmwssu_sexualorientation'},"PrefNotSay"), "Prefer not to say");B_COL();
	B_ROW();
	BROW();
	BCOLTXT("Any other sexual orientation, please specify","3");
	BCOLINTXTID('dmwssu_sexualorientationalternative','dmwssu_sexualorientationalternative',$GLOBALS{'dmwssu_sexualorientationalternative'},"2");
	B_ROW();
	XHR();
	XH4("Religion");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_religionnone","dmwssu_religion","NoReligion",CheckedIf($GLOBALS{'dmwssu_religion'},"NoReligion"), "No Religion");B_COL();
	BCOL("1");BINRADIOID("dmwssu_religionbuddhist","dmwssu_religion","Buddhist",CheckedIf($GLOBALS{'dmwssu_religion'},"Buddhist"), "Buddhist");B_COL();
	BCOL("1");BINRADIOID("dmwssu_religionchristian","dmwssu_religion","Christian",CheckedIf($GLOBALS{'dmwssu_religion'},"Christian"), "Christian");B_COL();
	BCOL("1");BINRADIOID("dmwssu_religionhindu","dmwssu_religion","Hindu",CheckedIf($GLOBALS{'dmwssu_religion'},"Hindu"), "Hindu");B_COL();
	BCOL("1");BINRADIOID("dmwssu_religionjewish","dmwssu_religion","Jewish",CheckedIf($GLOBALS{'dmwssu_religion'},"Jewish"), "Jewish");B_COL();
	BCOL("1");BINRADIOID("dmwssu_religionsikh","dmwssu_religion","Sikh",CheckedIf($GLOBALS{'dmwssu_religion'},"Sikh"), "Sikh");B_COL();
	BCOL("2");BINRADIOID("dmwssu_religionprefnotsay","dmwssu_religion","PrefNotSay",CheckedIf($GLOBALS{'dmwssu_religion'},"PrefNotSay"), "Prefer not to say");B_COL();
	B_ROW();
	BROW();
	BCOLTXT("Any other religion, please specify","3");
	BCOLINTXTID('dmwssu_religionalternative','dmwssu_religionalternative',$GLOBALS{'dmwssu_religionalternative'},"2");
	B_ROW();
	XHR();
	XH4("Working Pattern");
	BROW();
	BCOL("1");BINRADIOID("dmwssu_workingpatternfulltime","dmwssu_workingpattern","FullTime", CheckedIf($GLOBALS{'dmwssu_workingpattern'},"FullTime"), "Full-time");B_COL();
	BCOL("1");BINRADIOID("dmwssu_workingpatternparttime","dmwssu_workingpattern","PartTime", CheckedIf($GLOBALS{'dmwssu_workingpattern'},"PartTime"), "Part-time");B_COL();
	BCOL("1");BINRADIOID("dmwssu_workingpatternretired","dmwssu_workingpattern","Retired", CheckedIf($GLOBALS{'dmwssu_workingpattern'},"Retired"), "Retired");B_COL();
	BCOL("2");BINRADIOID("dmwssu_workingpatternprefnotsay","dmwssu_workingpattern","PrefNotSay", CheckedIf($GLOBALS{'dmwssu_workingpattern'},"PrefNotSay"), "Prefer not to say");B_COL();
	B_ROW();
	XH4("Caring Responsibilities");
	XPTXT("Please select all that apply");
	BROW();
	BCOLTXT("","1");
	$xhash = Get_SelectArrays_Hash ("dmwscaringresponsibilitytype","dmwscaringresponsibilitytype_id","dmwscaringresponsibilitytype_name","","","" );
	BCOLINCHECKBOXHASH($xhash,"dmwssu_caringresponsibilitytypelist",$GLOBALS{'dmwssu_caringresponsibilitytypelist'},"12");
	B_ROW();
	XINHID('dmwsequality_endfield',"");
}

function UpdateTimeBandList($listfieldname,$timebandid,$hours) {
	// XH5($listfieldname."|".$timebandid."|".$hours);
	// Format:  timebandid|hrs^timebandid|hrs^timebandid|hrs
	$list = $GLOBALS{$listfieldname};
	$listh = Array();
	#�XH5('existinglist '.$list);
	if ($list != "") {
		$lista = explode('^',$list);
		foreach ($lista as $listelement) {
			if ($listelement != "") {
				$listbits = explode('|',$listelement);
				$listh[$listbits[0]] = $listelement;
			}
		}
	}
	$listh[$timebandid] = $timebandid."|".$hours;

	$updatedlist = ""; $sep = "";
	foreach ($listh as $key => $value) {
		$updatedlist = $updatedlist.$sep.$value; $sep = "^";
	}
	// XPTXTCOLOR($listfieldname." = ".$updatedlist,"magneta");
	$GLOBALS{$listfieldname} = $updatedlist;
}

function GetTimeBandList ($listfieldname,$timebandid) {
	// return hours
	$hours = "";
	if ($GLOBALS{$listfieldname} != "") {
		$lista = explode('^',$GLOBALS{$listfieldname});
		foreach ($lista as $listelement) {
			if ($listelement != "") {
				$listbits = explode('|',$listelement);
				if ($listbits[0] == $timebandid) {
					$hours = $listbits[1];
				}
			}
		}
	}
	// XH5($timebandid." ".$hours);
	if ( $hours == "0" ) { $hours = ""; }
	return $hours;
}



function REFSINContentOutput($thisdmwssu_id) {
	XBR();
	XH3("Referrer Updates");
	XHRCLASS('underline');
	XPTXT("Please record any feedback to referrers.");
	XBR();

	BROWEQH();
	BCOLTXTCOLOR("<b>Date</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Welfare Officer</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Referrer Org / Referrer Contact Details </b>","2","gray","white");
	BCOLTXTCOLOR("<b>Update</b>","3","gray","white");
	BCOLTXTCOLOR("<b>Response From Referrer</b>","3","gray","white");
	BCOL("1");	BINBUTTONIDSPECIAL('dmwsreferrerupdate_add_new',"success","+"); B_COL();
	B_ROW();
	$dmwsreferrerupdatea = Get_Array('dmwsreferrerupdate',$thisdmwssu_id);
	foreach ($dmwsreferrerupdatea as $dmwsreferrerupdate_id) {
		Check_Data('dmwsreferrerupdate',$thisdmwssu_id,$dmwsreferrerupdate_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
		    BROW();
		    XINHID('dmwsreferrerupdate_startfield_'.$dmwsreferrerupdate_id,"");
		    BCOLINDATEIDCLASS('dmwsreferrerupdate_date_'.$dmwsreferrerupdate_id,'dmwsreferrerupdate_date_'.$dmwsreferrerupdate_id.'_dd/mm/yyyy','mand',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsreferrerupdate_date'}),"dd/mm/yyyy","1");
		    BCOLINTXTIDCLASS('dmwsreferrerupdate_woname_'.$dmwsreferrerupdate_id,'mand', 'dmwsreferrerupdate_woname_'.$dmwsreferrerupdate_id, $GLOBALS{'dmwsreferrerupdate_woname'}, "2");
		    BCOL("2");
			$xhash = Get_SelectArrays_Hash ("dmwsreferrerorgtype","dmwsreferrerorgtype_id","dmwsreferrerorgtype_name","dmwsreferrerorgtype_id","","" );
			BINSELECTHASHIDCLASS ($xhash,'dmwsreferrerupdate_dmwsreferrerorgtypeid_'.$dmwsreferrerupdate_id,'mand mandcheck','dmwsreferrerupdate_dmwsreferrerorgtypeid_'.$dmwsreferrerupdate_id,$GLOBALS{'dmwsreferrerupdate_dmwsreferrerorgtypeid'});
			BINTXTIDCLASS('dmwsreferrerupdate_contactref_'.$dmwsreferrerupdate_id,'mand','dmwsreferrerupdate_contactref_'.$dmwsreferrerupdate_id,$GLOBALS{'dmwsreferrerupdate_contactref'});
			B_COL();
			BCOLINTEXTAREAIDCLASS('dmwsreferrerupdate_statusupdate_'.$dmwsreferrerupdate_id,'mand','dmwsreferrerupdate_statusupdate_'.$dmwsreferrerupdate_id,$GLOBALS{'dmwsreferrerupdate_statusupdate'},"3","3");
			BCOLINTEXTAREAIDCLASS('dmwsreferrerupdate_response_'.$dmwsreferrerupdate_id,'mand','dmwsreferrerupdate_response_'.$dmwsreferrerupdate_id,$GLOBALS{'dmwsreferrerupdate_response'},"3","3");
			BCOL("1"); BINBUTTONIDCLASSSPECIAL('dmwsreferrerupdate_delete_'.$dmwsreferrerupdate_id,"dmwsreferrerupdatedelete","danger","x"); B_COL();
			XINHID('dmwsreferrerupdate_endfield_'.$dmwsreferrerupdate_id,"");
			B_ROW();
			XHR();
		}
	}
	XDIV("dmwsreferrerupdatelistend","");
	X_DIV("dmwsreferrerupdatelistend");
}

function WELLContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid) {

    XINHID('dmwswellbeing_startfield',"");
    XBR();
	XH3("Wellbeing Assessment");
	XHRCLASS('underline');
	XPTXT("Please complete a latest wellbeing assessment.");
	XHR();
	XDIV("wellbeingdatabuttons","");
	$dmwsvisita = Get_Array('dmwsvisit',$thisdmwssu_id);
	$latestvisittype = "";
	foreach ($dmwsvisita as $dmwsvisit_id) {
	    Get_Data('dmwsvisit',$thisdmwssu_id,$dmwsvisit_id);
	    $latestvisittype = $GLOBALS{'dmwsvisit_type'};
	    $activesuffix = "";
	    if ( $thisvisitid == $dmwsvisit_id ) {$activesuffix = "Active";}
	    if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"wellbeingdatabutton","FiOn".$activesuffix,"Fi");
	    }
	    /*if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"wellbeingdatabutton","SuOn".$activesuffix,"Su");
	    }*/
	    if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"wellbeingdatabutton","DiOn".$activesuffix,"Di");
	    }
	    if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"wellbeingdatabutton","FoOn".$activesuffix,"Fo");
	    }
	}
	if ($thisvisitid == "New") {
	    if ($latestvisittype == "" ) {
	        BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","FiOffActive","Fi");
	    }
	    if ($latestvisittype == "First" ) {
	        /*if ( $thisvisittype == "Subsequent" ){
	            BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","SuOffActive","Su");
	        }*/
	        if ($thisvisittype == "Discharge" ){
	            BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","DiOffActive","Di");
	        }
	    }
	    if ($latestvisittype == "Subsequent" ) {
	       /* if ($thisvisittype == "Subsequent" ) {
	            BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","SuOffActive","Su");
	        }*/
	        if ( $thisvisittype == "Discharge" ){
	            BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","DiOffActive","Di");
	        }
	    }
	    if ($latestvisittype == "Discharge" ) {
	        BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","FoOffActive","Fo");
	    }
	    if ($latestvisittype == "FollowUp" ) {
	        BINBUTTONIDCLASSSPECIAL("New","wellbeingdatabutton","FoOffActive","Fo");
	    }
	}
	X_DIV("wellbeingdatabuttons");
	BROW();
	BCOLTXT("","4");
	BCOLTXT("None of the Time","1");
	BCOLTXT("Rarely","1");
	BCOLTXT("Some of the Time","1");
	BCOLTXT("Often","1");
	BCOLTXT("All of the time","1");
	BCOLTXT("","3");
	B_ROW();
	XHR();
	BROW();
	BCOLTXT("I've been feeling optimistic about the future","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qoptimistic1", "wellbeingradio", "radio-primary", "dmwswellbeing_qoptimistic", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qoptimistic2", "wellbeingradio", "radio-primary", "dmwswellbeing_qoptimistic", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qoptimistic3", "wellbeingradio", "radio-primary", "dmwswellbeing_qoptimistic", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qoptimistic4", "wellbeingradio", "radio-primary", "dmwswellbeing_qoptimistic", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qoptimistic5", "wellbeingradio", "radio-primary", "dmwswellbeing_qoptimistic", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling useful","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_quseful1", "wellbeingradio", "radio-primary", "dmwswellbeing_quseful", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_quseful2", "wellbeingradio", "radio-primary", "dmwswellbeing_quseful", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_quseful3", "wellbeingradio", "radio-primary", "dmwswellbeing_quseful", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_quseful4", "wellbeingradio", "radio-primary", "dmwswellbeing_quseful", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_quseful5", "wellbeingradio", "radio-primary", "dmwswellbeing_quseful", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling relaxed","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qrelaxed1", "wellbeingradio", "radio-primary", "dmwswellbeing_qrelaxed", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qrelaxed2", "wellbeingradio", "radio-primary", "dmwswellbeing_qrelaxed", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qrelaxed3", "wellbeingradio", "radio-primary", "dmwswellbeing_qrelaxed", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qrelaxed4", "wellbeingradio", "radio-primary", "dmwswellbeing_qrelaxed", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qrelaxed5", "wellbeingradio", "radio-primary", "dmwswellbeing_qrelaxed", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling interested in other people","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinothers1", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinothers", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinothers2", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinothers", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinothers3", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinothers", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinothers4", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinothers", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinothers5", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinothers", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	XHR();
	BROW();
	BCOLTXT("I've had energy to spare","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qenergy1", "wellbeingradio", "radio-primary", "dmwswellbeing_qenergy", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qenergy2", "wellbeingradio", "radio-primary", "dmwswellbeing_qenergy", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qenergy3", "wellbeingradio", "radio-primary", "dmwswellbeing_qenergy", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qenergy4", "wellbeingradio", "radio-primary", "dmwswellbeing_qenergy", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qenergy5", "wellbeingradio", "radio-primary", "dmwswellbeing_qenergy", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been dealing with problems well","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qproblemmanagement1", "wellbeingradio", "radio-primary", "dmwswellbeing_qproblemmanagement", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qproblemmanagement2", "wellbeingradio", "radio-primary", "dmwswellbeing_qproblemmanagement", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qproblemmanagement3", "wellbeingradio", "radio-primary", "dmwswellbeing_qproblemmanagement", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qproblemmanagement4", "wellbeingradio", "radio-primary", "dmwswellbeing_qproblemmanagement", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qproblemmanagement5", "wellbeingradio", "radio-primary", "dmwswellbeing_qproblemmanagement", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been thinking clearly","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qthinkingclearly1", "wellbeingradio", "radio-primary", "dmwswellbeing_qthinkingclearly", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qthinkingclearly2", "wellbeingradio", "radio-primary", "dmwswellbeing_qthinkingclearly", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qthinkingclearly3", "wellbeingradio", "radio-primary", "dmwswellbeing_qthinkingclearly", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qthinkingclearly4", "wellbeingradio", "radio-primary", "dmwswellbeing_qthinkingclearly", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qthinkingclearly5", "wellbeingradio", "radio-primary", "dmwswellbeing_qthinkingclearly", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling good about myself","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qgoodaboutme1", "wellbeingradio", "radio-primary", "dmwswellbeing_qgoodaboutme", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qgoodaboutme2", "wellbeingradio", "radio-primary", "dmwswellbeing_qgoodaboutme", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qgoodaboutme3", "wellbeingradio", "radio-primary", "dmwswellbeing_qgoodaboutme", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qgoodaboutme4", "wellbeingradio", "radio-primary", "dmwswellbeing_qgoodaboutme", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qgoodaboutme5", "wellbeingradio", "radio-primary", "dmwswellbeing_qgoodaboutme", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	XHR();
	BROW();
	BCOLTXT("I've been feeling close to other people","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qclosetoothers1", "wellbeingradio", "radio-primary", "dmwswellbeing_qclosetoothers", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qclosetoothers2", "wellbeingradio", "radio-primary", "dmwswellbeing_qclosetoothers", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qclosetoothers3", "wellbeingradio", "radio-primary", "dmwswellbeing_qclosetoothers", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qclosetoothers4", "wellbeingradio", "radio-primary", "dmwswellbeing_qclosetoothers", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qclosetoothers5", "wellbeingradio", "radio-primary", "dmwswellbeing_qclosetoothers", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling confident","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qconfident1", "wellbeingradio", "radio-primary", "dmwswellbeing_qconfident", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qconfident2", "wellbeingradio", "radio-primary", "dmwswellbeing_qconfident", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qconfident3", "wellbeingradio", "radio-primary", "dmwswellbeing_qconfident", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qconfident4", "wellbeingradio", "radio-primary", "dmwswellbeing_qconfident", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qconfident5", "wellbeingradio", "radio-primary", "dmwswellbeing_qconfident", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been able to make up my own mind about things","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qmakeupmind1", "wellbeingradio", "radio-primary", "dmwswellbeing_qmakeupmind", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qmakeupmind2", "wellbeingradio", "radio-primary", "dmwswellbeing_qmakeupmind", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qmakeupmind3", "wellbeingradio", "radio-primary", "dmwswellbeing_qmakeupmind", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qmakeupmind4", "wellbeingradio", "radio-primary", "dmwswellbeing_qmakeupmind", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qmakeupmind5", "wellbeingradio", "radio-primary", "dmwswellbeing_qmakeupmind", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling loved","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qloved1", "wellbeingradio", "radio-primary", "dmwswellbeing_qloved", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qloved2", "wellbeingradio", "radio-primary", "dmwswellbeing_qloved", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qloved3", "wellbeingradio", "radio-primary", "dmwswellbeing_qloved", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qloved4", "wellbeingradio", "radio-primary", "dmwswellbeing_qloved", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qloved5", "wellbeingradio", "radio-primary", "dmwswellbeing_qloved", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	XHR();
	BROW();
	BCOLTXT("I've been interested in new things","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinnew1", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinnew", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinnew2", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinnew", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinnew3", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinnew", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinnew4", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinnew", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qinterestedinnew5", "wellbeingradio", "radio-primary", "dmwswellbeing_qinterestedinnew", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	BROW();
	BCOLTXT("I've been feeling cheerful","4");
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qcheerful1", "wellbeingradio", "radio-primary", "dmwswellbeing_qcheerful", "1", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qcheerful2", "wellbeingradio", "radio-primary", "dmwswellbeing_qcheerful", "2", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qcheerful3", "wellbeingradio", "radio-primary", "dmwswellbeing_qcheerful", "3", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qcheerful4", "wellbeingradio", "radio-primary", "dmwswellbeing_qcheerful", "4", "", "", "1");B_COL();
	BCOL("1");BINRADIOIDCLASSTICKBASE ("dmwswellbeing_qcheerful5", "wellbeingradio", "radio-primary", "dmwswellbeing_qcheerful", "5", "", "", "1");B_COL();
	BCOLTXT("","3");
	B_ROW();
	XBR();

	BROW();
	BCOLTXT("<b>Total Score</b>", "1");
	BCOLINTXTID("dmwswellbeing_score", "dmwswellbeing_score", $GLOBALS{'dmwswellebing_score'}, 1);
	BCOLTXTID(dmwswellbeingmessage, "Please complete the assessment before continuing", 3);
	BCOLTXT("","7");
	B_ROW();
	XBR();
	/*
	XHR();
	BROW();
	BCOLTXT("Wellbeing Assessment Declined","2");
	BCOLINCHECKBOXYESNO ("dmwswellbeing_declined",$GLOBALS{'dmwswellbeing_declined'},"","1");
	BCOLTXT("","9");
	B_ROW();
	BROW();
	BCOLTXT("Reason for Declining","2");
	BCOLINTEXTAREAID('dmwswellbeing_declinedreason','dmwswellbeing_declinedreason',$GLOBALS{'dmwswellbeing_declinedreason'},"2","8");
	B_ROW();
	*/
	XINHID('dmwswellbeing_endfield',"");
}

function PROGRESSContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid) {
    XINHID('dmwsprogress_startfield',"");
	XBR();
	XH3("Progress Assessment");
	XHRCLASS('underline');
	XPTXT("Please complete a latest progress assessment by rating how well the SU is managing with each issue from 1 to 5, where 1 indicates the SU is managing poorly and 5 indicates the SU is managing well.");
	BROW();
	BCOLTXTIDCOLORBORDER("progressexp5","5: Managing Well","2","lightblue","white","black");
	BCOLTXTIDCOLORBORDER("progressexp4","4: Mostly OK","2","lightgreen","white","black");
	BCOLTXTIDCOLORBORDER("progressexp3","3: Making Changes","2","yellow","white","black");
	BCOLTXTIDCOLORBORDER("progressexp2","2: Accepting Help","2","orange","white","black");
	BCOLTXTIDCOLORBORDER("progressexp1","1: Cause For Concern","2","red","white","white");
	BCOLTXTIDCOLORBORDER("progressexp1","0: Dont Know - N/A","2","pink","white","black");
	B_ROW();
	XBR();
	XDIV("progdatabuttons","");
	$dmwsvisita = Get_Array('dmwsvisit',$thisdmwssu_id);
	$latestvisittype = "";
	foreach ($dmwsvisita as $dmwsvisit_id) {
		Get_Data('dmwsvisit',$thisdmwssu_id,$dmwsvisit_id);
		$latestvisittype = $GLOBALS{'dmwsvisit_type'};
		$activesuffix = "";
		if ( $thisvisitid == $dmwsvisit_id ) {$activesuffix = "Active";}
		if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
			BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"progdatabutton","FiOn".$activesuffix,"Fi");
		}
		if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
			BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"progdatabutton","SuOn".$activesuffix,"Su");
		}
		if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
			BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"progdatabutton","DiOn".$activesuffix,"Di");
		}
		if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
			BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"progdatabutton","FoOn".$activesuffix,"Fo");
		}
    }
    if ($thisvisitid == "New") {
        if ($latestvisittype == "" ) {
            BINBUTTONIDCLASSSPECIAL("New","progdatabutton","FiOffActive","Fi");
        }
        if ($latestvisittype == "First" ) {
            if ( $thisvisittype == "Subsequent" ){
                BINBUTTONIDCLASSSPECIAL("New","progdatabutton","SuOffActive","Su");
            }
            if ($thisvisittype == "Discharge" ){
                BINBUTTONIDCLASSSPECIAL("New","progdatabutton","DiOffActive","Di");
            }
        }
        if ($latestvisittype == "Subsequent" ) {
            if ($thisvisittype == "Subsequent" ) {
                BINBUTTONIDCLASSSPECIAL("New","progdatabutton","SuOffActive","Su");
            }
            if ( $thisvisittype == "Discharge" ){
                BINBUTTONIDCLASSSPECIAL("New","progdatabutton","DiOffActive","Di");
            }
        }
        if ($latestvisittype == "Discharge" ) {
            BINBUTTONIDCLASSSPECIAL("New","progdatabutton","FoOffActive","Fo");
        }
        if ($latestvisittype == "FollowUp" ) {
            BINBUTTONIDCLASSSPECIAL("New","progdatabutton","FoOffActive","Fo");
        }
    }
    X_DIV("progdatabuttons");
    BROW();
    BCOLTXT("","10");
    B_ROW();
    XBR();
    XDIV("chart","");
    X_DIV("chart");
    XBR();XBR();XBR();XBR();XBR();
    XCLEARFLOAT();

    Check_Data('dmwsprogress',$thisdmwssu_id,$thisvisitid);

	// Included to capture the results of the progress chart
	XINHIDID("dmwsprogress_treatment", "dmwsprogress_treatment", $GLOBALS{'dmwsprogress_treatment'});
	XINHIDID("dmwsprogress_health", "dmwsprogress_health", $GLOBALS{'dmwsprogress_health'});
	XINHIDID("dmwsprogress_wellbeing", "dmwsprogress_wellbeing", $GLOBALS{'dmwsprogress_wellbeing'});
	XINHIDID("dmwsprogress_family", "dmwsprogress_family", $GLOBALS{'dmwsprogress_family'});
	XINHIDID("dmwsprogress_relationships", "dmwsprogress_relationships", $GLOBALS{'dmwsprogress_relationships'});
	XINHIDID("dmwsprogress_housing", "dmwsprogress_housing", $GLOBALS{'dmwsprogress_housing'});
	XINHIDID("dmwsprogress_finance", "dmwsprogress_finance", $GLOBALS{'dmwsprogress_finance'});
	XINHIDID("dmwsprogress_work", "dmwsprogress_work", $GLOBALS{'dmwsprogress_work'});
	XINHIDID("dmwsprogress_social", "dmwsprogress_social", $GLOBALS{'dmwsprogress_social'});
	XINHIDID("dmwsprogress_activities", "dmwsprogress_activities", $GLOBALS{'dmwsprogress_activities'});

	BROW();
	BCOLTXT("<b>Total Score</b>", "1");
	BCOLINTXTID("dmwsprogress_score", "dmwsprogress_score", $GLOBALS{'dmwsprogress_score'}, 1);
	BCOLTXTID(dmwsprogressmessage, "Please complete the assessment notes before continuing","4");
	BCOLTXT("","7");
	B_ROW();


	XH3("Notes");
	BROW();
	BCOLTXT("Current Admission or Treatment","2");
	BCOLINTEXTAREAID('dmwsprogress_treatmentnotes','dmwsprogress_treatmentnotes',$GLOBALS{'dmwsprogress_treatmentnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("General Health","2");
	BCOLINTEXTAREAID('dmwsprogress_healthnotes','dmwsprogress_healthnotes',$GLOBALS{'dmwsprogress_healthnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("General Wellbeing","2");
	BCOLINTEXTAREAID('dmwsprogress_wellbeingnotes','dmwsprogress_wellbeingnotes',$GLOBALS{'dmwsprogress_wellbeingnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Family","2");
	BCOLINTEXTAREAID('dmwsprogress_familynotes','dmwsprogress_familynotes',$GLOBALS{'dmwsprogress_familynotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Relationships","2");
	BCOLINTEXTAREAID('dmwsprogress_relationshipsnotes','dmwsprogress_relationshipsnotes',$GLOBALS{'dmwsprogress_relationshipsnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Housing","2");
	BCOLINTEXTAREAID('dmwsprogress_housingnotes','dmwsprogress_housingnotes',$GLOBALS{'dmwsprogress_housingnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Finance","2");
	BCOLINTEXTAREAID('dmwsprogress_financenotes','dmwsprogress_financenotes',$GLOBALS{'dmwsprogress_financenotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Work","2");
	BCOLINTEXTAREAID('dmwsprogress_worknotes','dmwsprogress_worknotes',$GLOBALS{'dmwsprogress_worknotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Social Life","2");
	BCOLINTEXTAREAID('dmwsprogress_socialnotes','dmwsprogress_socialnotes',$GLOBALS{'dmwsprogress_socialnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	BROW();
	BCOLTXT("Activities","2");
	BCOLINTEXTAREAID('dmwsprogress_activitiesnotes','dmwsprogress_activitiesnotes',$GLOBALS{'dmwsprogress_activitiesnotes'},"3","8");
	BCOLTXT("","2");
	B_ROW();
	// XINHID("dmwsvisit_type",$thisvisittype);  // CHECK VISIT - Note: This is probably the cause of undefined visits
	XINHID('dmwsprogress_endfield',"");
}

function COMPLEXContentOutput($thisdmwssu_id,$thisvisittype,$thisvisitid) {
    XINHID('dmwscomplexity_startfield',"");
	XBR();
	XH3("Core Issues Complexity Assessment");
	XHRCLASS('underline');
	XPTXTCOLOR("Note:- The Complexity Assessment is now being recorded as the latest position - with any new updates modifying the previous assessment.","green");
	XHR();

	/*
	XDIV("complexdatabuttons","");
	$dmwsvisita = Get_Array('dmwsvisit',$thisdmwssu_id);
	$latestvisittype = "";
	foreach ($dmwsvisita as $dmwsvisit_id) {
	    Get_Data('dmwsvisit',$thisdmwssu_id,$dmwsvisit_id);
	    $latestvisittype = $GLOBALS{'dmwsvisit_type'};
	    $activesuffix = "";
	    if ( $thisvisitid == $dmwsvisit_id ) {$activesuffix = "Active";}
	    if ($GLOBALS{'dmwsvisit_type'} == "First" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"complexdatabutton","FiOn".$activesuffix,"Fi");
	    }

	    if ($GLOBALS{'dmwsvisit_type'} == "Subsequent" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"complexdatabutton","SuOn".$activesuffix,"Su");
	    }

	    if ($GLOBALS{'dmwsvisit_type'} == "Discharge" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"complexdatabutton","DiOn".$activesuffix,"Di");
	    }
	    if ($GLOBALS{'dmwsvisit_type'} == "FollowUp" ) {
	        BINBUTTONIDCLASSSPECIAL($dmwsvisit_id,"complexdatabutton","FoOn".$activesuffix,"Fo");
	    }
	}
	if ($thisvisitid == "New") {
	    if ($latestvisittype == "" ) {
	        BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","FiOffActive","Fi");
	    }
	    if ($latestvisittype == "First" ) {
	        if ( $thisvisittype == "Subsequent" ){
	            BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","SuOffActive","Su");
	        }
	        if ($thisvisittype == "Discharge" ){
	            BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","DiOffActive","Di");
	        }
	    }
	    if ($latestvisittype == "Subsequent" ) {
	        if ($thisvisittype == "Subsequent" ) {
	            BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","SuOffActive","Su");
	        }
	        if ( $thisvisittype == "Discharge" ){
	            BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","DiOffActive","Di");
	        }
	    }
	    if ($latestvisittype == "Discharge" ) {
	        BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","FoOffActive","Fo");
	    }
	    if ($latestvisittype == "FollowUp" ) {
	        BINBUTTONIDCLASSSPECIAL("New","complexdatabutton","FoOffActive","Fo");
	    }
	}
	X_DIV("complexdatabuttons");
	XBR();
	*/

	BROW();
	BCOLTXT("","10");
	B_ROW();

	XPTXT("Please complete the Core Issues Assessment by selecting the issues affecting the service user and rating their impact.");
	XBR();
	BROWEQH();
	BCOLTXTCOLOR("<b>Issue Type</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Weighting</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Impact Assessment</b>","6","gray","white");
	BCOL("1");	BINBUTTONIDSPECIAL('dmwscomplexity_add_new',"success","+"); B_COL();
	B_ROW();
	XBR();
	$ctypehash = Get_SelectArrays_Hash ("dmwscomplexitytype","dmwscomplexitytype_id","dmwscomplexitytype_name","dmwscomplexitytype_name","","" );
	$thiscomplexityvisitid = "";
	Check_Data('dmwscomplexity',$thisdmwssu_id,"Latest");
	if ($GLOBALS{'IOWARNING'} == "0") {
	    $thiscomplexityvisitid = "Latest";
	} else {
	    $complexityvisita = Get_Array('dmwscomplexity',$thisdmwssu_id);
	    foreach ($complexityvisita as $complexityvisit_id) {
	        Check_Data('dmwscomplexity',$thisdmwssu_id,$complexityvisit_id);
	        if ( $GLOBALS{'dmwscomplexity_score'} != 0) {
	           $thiscomplexityvisitid = $complexityvisit_id;
	        }
	    }
	}

	Check_Data('dmwscomplexity',$thisdmwssu_id,$thiscomplexityvisitid);
	if ($GLOBALS{'IOWARNING'} == "0") {
		for( $ci = 1; $ci<13; $ci++ ) {
			if ($GLOBALS{'dmwscomplexity_issuetype'.$ci} != "") {
			    XDIV('dmwscomplexity_issuediv_'.$ci,"");
			    BROW();
			    BCOLINSELECTHASHIDCLASS($ctypehash,'dmwscomplexity_issuetype_'.$ci,'dmwscomplexityissuetype','dmwscomplexity_issuetype_'.$ci,$GLOBALS{'dmwscomplexity_issuetype'.$ci},"2");
			    $GLOBALS{'dmwscomplexitytype_weighting'} = 1; // default
			    Check_Data('dmwscomplexitytype',$GLOBALS{'dmwscomplexity_issuetype'.$ci});
			    BCOLTXTID('dmwscomplexitytype_weighting_'.$ci,$GLOBALS{'dmwscomplexitytype_weighting'},"1");
			    $sliderhtml = "<br>";
			    $sliderhtml = $sliderhtml.'<div class="complexityslider" id="dmwscomplexity_slider_'.$ci.'"></div>';
			    BCOL("6");
			    print $sliderhtml;
			    B_COL();
			    BCOL("1"); BINBUTTONIDCLASSSPECIAL('dmwscomplexity_delete_'.$ci,"dmwscomplexitydelete","danger","x"); B_COL();
			    B_ROW();
			    XINHIDID('dmwscomplexity_issuescore_'.$ci, 'dmwscomplexity_issuescore_'.$ci, $GLOBALS{'dmwscomplexity_issuescore'.$ci});
			    XINHIDID('dmwscomplexity_issueweight_'.$ci, 'dmwscomplexity_issueweight_'.$ci, $GLOBALS{'dmwscomplexitytype_weighting'});
			    XHR();
			    X_DIV('dmwscomplexity_issuediv_'.$ci);
			}
		}
	}

	XDIV("dmwscomplexitylistend","");
	X_DIV("dmwscomplexitylistend");

	BROW();
	BCOLTXT("<b>Total Score</b>", "1");
	BCOLINTXTID("dmwscomplexity_score", "dmwscomplexity_score", $GLOBALS{'dmwscomplexity_score'}, 1);  // CHECK CHANGE NAME
	BCOLTXT("","10");
	B_ROW();

	XBR();
	// XH3("Core Issues Complexity Matrix");
	// XPTXTCOLOR("Please note that the complexity visualisation is being changed and may need some more calibration before being finalised.","orange");

	print('<div id="complexitybackdrop" style="background-image: url('.$GLOBALS{'site_asseturl'}.'/ComplexityBackdrop4.png); height: 80px; width: 900px;"></div>');
	print('<div id="complexitymarker" style="background-color: white; height: 30px; width: 30px;"></div>');

	XINHID('dmwscomplexity_endfield',"");


}

function OUTCOMESContentOutput($thisdmwssu_id) {
    XINHID('dmwsoutcomes_startfield',"");
    XBR();
    XH3("Outcomes & Impacts");
    XHRCLASS('underline');
    XPTXT("Please check the relevant boxes to assess the impact of DMWS care on the various topics.");
    XHR();

    XH4("Primary Care");
    XPTXT("Please select all that apply");
    BROW();
    BCOL("8");
    XDIV("outcomesdiv1","outcomesmanddiv");
    BROW();
    BCOLTXT("","1");
    $xhash = Get_SelectArrays_Hash ("dmwsprimarycaretype","dmwsprimarycaretype_id","dmwsprimarycaretype_name","","","" );
    BCOLINCHECKBOXHASHCLASS($xhash,"dmwssu_primarycarelist",$GLOBALS{'dmwssu_primarycarelist'},"outcomescbMand1","7");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT("Other Impact in Primary Care: Please state","4");
    BCOLINTXTIDCLASS('dmwssu_primarycareother','outcomescbMand1','dmwssu_primarycareother',$GLOBALS{'dmwssu_primarycareother'},"3");
    B_ROW();
    XBR();
    X_DIV("outcomesdiv1","");
    B_COL();
    B_ROW();

    XHR();
    XH4("Secondary Care");
    XPTXT("Please select all that apply");
    BROW();
    BCOL("8");
    XDIV("outcomesdiv2","outcomesmanddiv");
    BROW();
    BCOLTXT("","1");
    $xhash = Get_SelectArrays_Hash ("dmwssecondarycaretype","dmwssecondarycaretype_id","dmwssecondarycaretype_name","","","" );
    BCOLINCHECKBOXHASHCLASS($xhash,"dmwssu_secondarycarelist",$GLOBALS{'dmwssu_secondarycarelist'},"outcomescbMand2","7");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT("Other Impact in Secondary Care: Please state","4");
    BCOLINTXTIDCLASS('dmwssu_secondarycareother','outcomescbMand2','dmwssu_secondarycareother',$GLOBALS{'dmwssu_secondarycareother'},"3");
    B_ROW();
    XBR();
    X_DIV("outcomesdiv2");
    B_COL();
    B_ROW();
    XHR();
    XH4("Independent Living");
    XPTXT("Please select all that apply");
    BROW();
    BCOL("8");
    XDIV("outcomesdiv3","outcomesmanddiv");
    BROW();
    BCOLTXT("","1");
    $xhash = Get_SelectArrays_Hash ("dmwsindependentlivingtype","dmwsindependentlivingtype_id","dmwsindependentlivingtype_name","","","" );
    BCOLINCHECKBOXHASHCLASS($xhash,"dmwssu_independentlivinglist",$GLOBALS{'dmwssu_independentlivinglist'},"outcomescbMand3","7");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT("Other Impact in Independent Living: Please state","4");
    BCOLINTXTIDCLASS('dmwssu_independentlivingother','outcomescbMand3','dmwssu_independentlivingother',$GLOBALS{'dmwssu_independentlivingother'},"3");
    B_ROW();
    XBR();
    X_DIV("outcomesdiv3");
    B_COL();
    B_ROW();
    XHR();
    XH4("Social Isolation");
    XPTXT("Please select all that apply");
    BROW();
    BCOL("8");
    XDIV("outcomesdiv4","outcomesmanddiv");
    BROW();
    BCOLTXT("","1");
    $xhash = Get_SelectArrays_Hash ("dmwssocialisolationtype","dmwssocialisolationtype_id","dmwssocialisolationtype_name","","","" );
    BCOLINCHECKBOXHASHCLASS($xhash,"dmwssu_socialisolationlist",$GLOBALS{'dmwssu_socialisolationlist'},"outcomescbMand4 ","7");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT("Other Impact in Social Isolation: Please state","4");
    BCOLINTXTIDCLASS('dmwssu_socialisolationother','outcomescbMand4','dmwssu_socialisolationother',$GLOBALS{'dmwssu_socialisolationother'},"3");
    B_ROW();
    XBR();
    X_DIV("outcomesdiv4","");
    B_COL();
    B_ROW();
    XHR();
    XH4("Employment");
    XPTXT("Please select all that apply");
    BROW();
    BCOL("8");
    XDIV("outcomesdiv5","outcomesmanddiv");
    BROW();
    BCOLTXT("","1");
    $xhash = Get_SelectArrays_Hash ("dmwsemploymenttype","dmwsemploymenttype_id","dmwsemploymenttype_name","","","" );
    BCOLINCHECKBOXHASHCLASS($xhash,"dmwssu_employmentlist",$GLOBALS{'dmwssu_employmentlist'},"outcomescbMand5","7");
    B_ROW();
    BROW();
    BCOLTXT("","1");
    BCOLTXT("Other Impact in Employment: Please state","4");
    BCOLINTXTIDCLASS('dmwssu_employmentother','outcomescbMand5','dmwssu_employmentother',$GLOBALS{'dmwssu_employmentother'},"3");
    B_ROW();
    XBR();
    X_DIV("outcomesdiv5","");
    B_COL();
    B_ROW();
    XH4("Key Case Measurements","1");
    BROW();
    BCOLTXT("Family Supported Over 18","2");
    BCOLINTXTIDCLASS('dmwssu_familysupportedO18','outMand','dmwssu_familysupportedO18',$GLOBALS{'dmwssu_familysupportedO18'},"1");
    BCOLTXT("","1");
    BCOLTXT("Family Supported Under 18","2");
    BCOLINTXTIDCLASS('dmwssu_familysupportedU18','outMand','dmwssu_familysupportedU18',$GLOBALS{'dmwssu_familysupportedU18'},"1");
    BCOLTXT("","1");
    BCOLTXT("Staff/Others Supported","2");
    BCOLINTXTIDCLASS('dmwssu_staffsupported','outMand','dmwssu_staffsupported',$GLOBALS{'dmwssu_staffsupported'},"1");
    BCOLTXT("","1");
    B_ROW();
    BROW();
    BCOLTXT("Medical Appointments Attended","2");
    BCOLINTXTIDCLASS('dmwssu_medicalapptsattended','outMand','dmwssu_medicalapptsattended',$GLOBALS{'dmwssu_medicalapptsattended'},"1");
    BCOLTXT("","1");
    BCOLTXT("Medical appointments Missed","2");
    BCOLINTXTIDCLASS('dmwssu_medicalapptsmissed','outMand','dmwssu_medicalapptsmissed',$GLOBALS{'dmwssu_medicalapptsmissed'},"1");
    BCOLTXT("","1");
    B_ROW();
    BROW();
    BCOLTXT("Expected Time Off Work","2");
    BCOLINTXTIDCLASS('dmwssu_timeoffworkexpected','outMand','dmwssu_timeoffworkexpected',$GLOBALS{'dmwssu_timeoffworkexpected'},"1");
    BCOLTXT("","1");
    BCOLTXT("Actual Time Off Work","2");
    BCOLINTXTIDCLASS('dmwssu_timeoffworkactual','outMand','dmwssu_timeoffworkactual',$GLOBALS{'dmwssu_timeoffworkactual'},"1");
    BCOLTXT("","1");
    B_ROW();
    BROW();
    BCOLTXT("Expected Length Of Stay","2");
    BCOLINTXTIDCLASS('dmwssu_losexpected','outMand','dmwssu_losexpected',$GLOBALS{'dmwssu_losexpected'},"1");
    BCOLINTXTIDCLASS('dmwssu_losexpectedcalc','calcres','dmwssu_losexpectedcalc',$GLOBALS{'dmwssu_losexpectedcalc'},"1");
    BCOLTXT("Actual Length Of Stay","2");
    BCOLINTXTIDCLASS('dmwssu_losactual','outMand','dmwssu_losactual',$GLOBALS{'dmwssu_losactual'},"1");
    BCOLINTXTIDCLASS('dmwssu_losactualcalc','calcres','dmwssu_losactualcalc',$GLOBALS{'dmwssu_losactualcalc'},"1");
    B_ROW();
    XINHID('dmwsoutcomes_endfield',"");
}


function ACTSContentOutput($thisdmwssu_id) {
    XBR();
    XH3("Actions");
    XHRCLASS('underline');
    XPTXT("Please review the agreed actions.");
    XBR();

    BROWEQH();
    BCOLTXTCOLOR("<b>Date/Time</b>","1","gray","white");
    BCOLTXTCOLOR("<b>Issue</b>","3","gray","white");
    BCOLTXTCOLOR("<b>Action</b>","4","gray","white");
    BCOLTXTCOLOR("<b>Taken by</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Completion Target</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Consent Given</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Timeband</b>","2","gray","white");
    BCOLTXTCOLOR("<b>Completion Date</b>","2","gray","white");
    BCOL("1");	BINBUTTONIDSPECIAL('dmwsaction_add_new',"success","+"); B_COL();
    B_ROW();

    $timebanda = Array();
    $dmwstimebanda = Get_Array('dmwstimeband');
    foreach ($dmwstimebanda as $dmwstimeband_id) {
        Get_Data('dmwstimeband',$dmwstimeband_id);

        if ($GLOBALS{'dmwstimeband_dmwscontractid'} == $GLOBALS{'dmwssu_dmwscontractid'} && $GLOBALS{'dmwstimeband_dmwscontractlocationid'} == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
            $timebanda[$dmwstimeband_id] = $GLOBALS{'dmwstimeband_name'}." ".$GLOBALS{'dmwstimeband_start'}."-".$GLOBALS{'dmwstimeband_end'};
        }
    }
    if (sizeof($timebanda) == '0'){
        foreach ($dmwstimebanda as $dmwstimeband_id) {
            Get_Data('dmwstimeband',$dmwstimeband_id);

            if ($GLOBALS{'dmwstimeband_dmwscontractid'} == "Default") {
                $timebanda[$dmwstimeband_id] = $GLOBALS{'dmwstimeband_name'}." ".$GLOBALS{'dmwstimeband_start'}."-".$GLOBALS{'dmwstimeband_end'};
            }
        }
    }
    $dmwsactiona = Get_Array('dmwsaction',$thisdmwssu_id);
    foreach ($dmwsactiona as $dmwsaction_id) {
        Check_Data('dmwsaction',$thisdmwssu_id,$dmwsaction_id);
        if ($GLOBALS{'IOWARNING'} == "0") {
            BROW();
            XINHID('dmwsaction_startfield_'.$dmwsaction_id,"");
            BCOL("1");
            BINDATEID('dmwsaction_date_'.$dmwsaction_id,'dmwsaction_date_'.$dmwsaction_id.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsaction_date'}),"dd/mm/yyyy","1");
            BINTXTID('dmwsaction_time_'.$dmwsaction_id,'dmwsaction_time_'.$dmwsaction_id,$GLOBALS{'dmwsaction_time'});
            B_COL();
            BCOLINTEXTAREAID('dmwsaction_issue_'.$dmwsaction_id,'dmwsaction_issue_'.$dmwsaction_id,$GLOBALS{'dmwsaction_issue'},"3","3");
            BCOLINTEXTAREAID('dmwsaction_action_'.$dmwsaction_id,'dmwsaction_action_'.$dmwsaction_id,$GLOBALS{'dmwsaction_action'},"3","4");
            BCOLINTXTID('dmwsaction_takenby_'.$dmwsaction_id,'dmwsaction_takenby_'.$dmwsaction_id,$GLOBALS{'dmwsaction_takenby'},"2");
            BCOLINDATEID('dmwsaction_completebydate_'.$dmwsaction_id,'dmwsaction_completebydate_'.$dmwsaction_id.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsaction_completebydate'}),"dd/mm/yyyy","2");
            BCOLINCHECKBOXYESNO ("dmwsaction_consent_".$dmwsaction_id,$GLOBALS{'dmwsaction_consent'},"","2");
            // $xhash = Get_SelectArrays_Hash ("dmwstimeband","dmwstimeband_id","dmwstimeband_name","dmwstimeband_id","","" );
            BCOLINSELECTHASHID ($timebanda,'dmwsaction_dmwstimebandid_'.$dmwsaction_id,'dmwsaction_dmwstimebandid_'.$dmwsaction_id,$GLOBALS{'dmwsaction_dmwstimebandid'},"2");
            BCOLINDATEID('dmwsaction_completiondate_'.$dmwsaction_id,'dmwsaction_completiondate_'.$dmwsaction_id.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsaction_completiondate'}),"dd/mm/yyyy","2");
            BCOL("1");
            BINBUTTONIDCLASSSPECIAL('dmwsaction_delete_'.$dmwsaction_id,"dmwsactiondelete","danger","x");
            B_COL();
            XINHID('dmwsaction_endfield_'.$dmwsaction_id,"");
            B_ROW();
            XHR();
        }
    }
    XDIV("dmwsactionlistend","");
    X_DIV("dmwsactionlistend");
}

function REFSOUTContentOutput($thisdmwssu_id) {
	XBR();
	XH3("DMWS Services Used");
	XHRCLASS('underline');
	XPTXT("Please select the DMWS services used.");
	BROWEQH();
	BCOLTXTCOLOR("<b>Date</b>","1","gray","white");
	BCOLTXTCOLOR("<b>DMWS Service</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Comment</b>","3","gray","white");
	BCOL("1"); BINBUTTONIDSPECIAL('dmwsserviceprovided_add_new',"success","+"); B_COL();
	B_ROW();
	//RETURNPOINT
//$dmwscontractlocationa = Get_Array_Select('dmwscontractlocation','','dmwscontractlocation_id,dmwscontractlocation_disabled');
// print_r($dmwscontractlocationa);
// foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
// for ($i=0; $i < sizeof($dmwscontractlocationa); $i++) {
// 		$dmwscontractlocation_id = $dmwscontractlocationa[$i][0];
//
// 		$disabledLocations[$dmwscontractlocationa[$i][0]] = $dmwscontractlocationa[$i][1];


	$dmwsserviceprovideda = Get_Array('dmwsserviceprovided',$thisdmwssu_id);//services used
	// $dmwsservicetype = Get_Array_Select('dmwsservicetype','','dmwsservicetype_id,dmwsservicetype_disabled');//services available
        $dmwsservicetype = Get_Array('dmwsservicetype');
	$disabled = array();
	for ($i=0; $i < sizeof($dmwsservicetype); $i++) {
		if ($dmwsservicetype[$i][1] != "Yes") {
			$disabled[$dmwsservicetype[$i][0]] = "0";//fixes nulls
		}else{
			$disabled[$dmwsservicetype[$i][0]] = "1";
		}
		// print_r($disabled);
		// echo "<br>";
		// print($dmwsserviceprovideda[$i][0]);
		// echo ":";
		// print($dmwsserviceprovideda[$i][1]);
		// echo "<br>";
	}
	// print_r($disabled);
	echo "<div id='disabledServiceType' style='display:none;'>";
		$hash = Get_SelectArrays_Hash ("dmwsservicetype","dmwsservicetype_id","dmwsservicetype_name","dmwsservicetype_id","","" );
		$id = '';
		$name = '';
		$value = $GLOBALS{'dmwsserviceprovided_dmwsservicetypeid'};
		$cols = '2';
		BCOLINSELECTHASHIDCLASSDISABLED ($hash,$id,$class,$name,$value,$cols,$disabled);
	echo "</div>";
	// echo "<br>";
	// print_r ($dmwsserviceprovideda);
	// echo "<br>";
	// $dmwscontractlocationa = Get_Array_Select('dmwscontractlocation','','dmwscontractlocation_id,dmwscontractlocation_disabled');
	foreach ($dmwsserviceprovideda as $dmwsserviceprovided_id) {
	    Check_Data('dmwsserviceprovided',$thisdmwssu_id,$dmwsserviceprovided_id);
	    print ($GLOBALS{'IOWARNING'});
	    if ($GLOBALS{'IOWARNING'} == "0") {
        	BROW();
        	XINHID('dmwsserviceprovided_startfield_'.$dmwsserviceprovided_id,"");
        	BCOLINDATEID('dmwsserviceprovided_date_'.$dmwsserviceprovided_id,'dmwsserviceprovided_date_'.$dmwsserviceprovided_id.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsserviceprovided_date'}),"dd/mm/yyyy","1");
        	$xhash = Get_SelectArrays_Hash ("dmwsservicetype","dmwsservicetype_id","dmwsservicetype_name","dmwsservicetype_id","","" );
					// BCOLINSELECTHASHID
					$hash = $xhash;
					$id = 'dmwsserviceprovided_dmwsservicetypeid_'.$dmwsserviceprovided_id;
					$name = 'dmwsserviceprovided_dmwsservicetypeid_'.$dmwsserviceprovided_id;
					$value = $GLOBALS{'dmwsserviceprovided_dmwsservicetypeid'};
					$cols = '2';
					BCOLINSELECTHASHIDCLASSDISABLED ($hash,$id,$class,$name,$value,$cols,$disabled);
        	// BCOLINSELECTHASHID ($xhash,'dmwsserviceprovided_dmwsservicetypeid_'.$dmwsserviceprovided_id,'dmwsserviceprovided_dmwsservicetypeid_'.$dmwsserviceprovided_id,$GLOBALS{'dmwsserviceprovided_dmwsservicetypeid'},"2");
        	BCOLINTEXTAREAID('dmwsserviceprovided_comment_'.$dmwsserviceprovided_id,'dmwsserviceprovided_comment_'.$dmwsserviceprovided_id,$GLOBALS{'dmwsserviceprovided_comment'},"3","3");
        	BCOL("1"); BINBUTTONIDCLASSSPECIAL('dmwsserviceprovided_delete_'.$dmwsserviceprovided_id,"dmwsserviceprovideddelete","danger","x"); B_COL();
        	XINHID('dmwsserviceprovided_endfield_'.$dmwsserviceprovided_id,"");
        	B_ROW();
        	XHR();
	    }
	}
	XDIV("dmwsserviceprovidedlistend","");
	X_DIV("dmwsserviceprovidedlistend");
	XBR();
	XH3("Referrals");
	XHRCLASS('underline');
	XPTXT("Please review the agreed referrals.");
	BROWEQH();
	BCOLTXTCOLOR("<b>Date/Time</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Support Type / Organisation</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Organisation Name</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Contact Details, Role & Intervention</b>","3","gray","white");
	BCOLTXTCOLOR("<b>Funding / Grant Secured / Consent</b>","1","gray","white");
	BCOLTXTCOLOR("<b>SU Feedback</b>","2","gray","white");
	BCOLTXTCOLOR("<b>Comments</b>","2","gray","white");
	BCOL("1"); BINBUTTONIDSPECIAL('dmwsreferral_add_new',"success","+"); B_COL();
	B_ROW();
	$reforghash = Get_SelectArrays_Hash ("dmwsreferralorg","dmwsreferralorg_id","dmwsreferralorg_name","dmwsreferralorg_id","","" );
	$specreforghash = Get_SelectArrays_Hash ("dmwsspecialistreferralorg","dmwsspecialistreferralorg_id","dmwsspecialistreferralorg_name","dmwsspecialistreferralorg_id","","" );
	$dmwsreferrala = Get_Array('dmwsreferral',$thisdmwssu_id);
	foreach ($dmwsreferrala as $dmwsreferral_id) {
		Check_Data('dmwsreferral',$thisdmwssu_id,$dmwsreferral_id);
		if ($GLOBALS{'IOWARNING'} == "0") {
		    BROW();
		    XINHID('dmwsreferral_startfield_'.$dmwsreferral_id,"");
		    BCOL("1");
		    BINDATEIDCLASS('dmwsreferral_date_'.$dmwsreferral_id,'dmwsreferral_date_'.$dmwsreferral_id.'_dd/mm/yyyy','mand',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsreferral_date'}),"dd/mm/yyyy");
		    BINTXTIDCLASS('dmwsreferral_time_'.$dmwsreferral_id,'mand','dmwsreferral_time_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_time'});
		    B_COL();
		    BCOL("2");
		    BINSELECTHASHIDCLASS($reforghash,'dmwsreferral_dmwsreferralorgid_'.$dmwsreferral_id,'mand','dmwsreferral_dmwsreferralorgid_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_dmwsreferralorgid'});
		    BINSELECTHASHIDCLASS($specreforghash,'dmwsreferral_dmwsspecialistreferralorgid_'.$dmwsreferral_id,'mand','dmwsreferral_dmwsspecialistreferralorgid_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_dmwsspecialistreferralorgid'});
		    B_COL();
		    BCOL("2");
		    BCOLINTXTIDCLASS('dmwsreferral_orgname_'.$dmwsreferral_id,'mand','dmwsreferral_orgname_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_orgname'},"2");
		    BINCHECKBOXYESNOCLASS ("dmwsreferral_gdprcompliant_".$dmwsreferral_id,'mandcb',$GLOBALS{'dmwsreferral_gdprcompliant'},"Confirmed GDPR Compliant");
		    B_COL();
		    BCOLINTEXTAREAIDCLASS('dmwsreferral_roleintervention_'.$dmwsreferral_id,'mand','dmwsreferral_roleintervention_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_roleintervention'},"3","3");
		    BCOL("1");
		    BINTXTID('dmwsreferral_fundingsecured_'.$dmwsreferral_id,'dmwsreferral_fundingsecured_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_fundingsecured'});
		    BINCHECKBOXYESNOCLASS ("dmwsreferral_suconsent_".$dmwsreferral_id,'mandcb',$GLOBALS{'dmwsreferral_suconsent'},"Consent to Contact","1");
		    B_COL();
		    $xhash = Get_SelectArrays_Hash ("dmwssufeedbacktype","dmwssufeedbacktype_id","dmwssufeedbacktype_name","dmwssufeedbacktype_id","","" );
			BCOLINSELECTHASHID ($xhash,'dmwsreferral_sufeedback_'.$dmwsreferral_id,'dmwsreferral_sufeedback_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_sufeedback'},"2");
		    BCOLINTEXTAREAID('dmwsreferral_comment_'.$dmwsreferral_id,'dmwsreferral_comment_'.$dmwsreferral_id,$GLOBALS{'dmwsreferral_comment'},"3","2");
		    BCOL("1"); BINBUTTONIDCLASSSPECIAL('dmwsreferral_delete_'.$dmwsreferral_id,"dmwsreferraldelete","danger","x"); B_COL();
		    XINHID('dmwsreferral_endfield_'.$dmwsreferral_id,"");
		    B_ROW();
			XHR();
		}
	}
	XDIV("dmwsreferrallistend","");
	X_DIV("dmwsreferrallistend");
}

function NOTEContentOutput($thisdmwssu_id) {
	XBR();
	XH3("Notes");
	XHRCLASS('underline');
	XPTXT("Freeform Notes Area.");
	XHR();
	# name, value, rows, cols
	XINTEXTAREA ("dmwssu_notes",$GLOBALS{'dmwssu_notes'},"8","120");


	XH3("Attachments");
	XPTXT("Note: Attachments may only be downloaded whilst you have an online connection.");
	XHRCLASS('underline');
	XBR();

	BROWEQH();
	BCOLTXTCOLOR("<b>Title</b>","3","gray","white");
	BCOLTXTCOLOR("<b>Description</b>","3","gray","white");
	BCOLTXTCOLOR("<b>Date</b>","1","gray","white");
	BCOLTXTCOLOR("<b>Filename</b>","2","gray","white");
	BCOLTXTCOLOR("","1","gray","white");
	BCOL("1");	BINBUTTONIDSPECIAL('dmwsattachment_add_new',"success","+"); B_COL();
	B_ROW();

	$dmwsattachmenta = Get_Array('dmwsattachment',$thisdmwssu_id);
	foreach ($dmwsattachmenta as $dmwsattachment_id) {
	    Check_Data('dmwsattachment',$thisdmwssu_id,$dmwsattachment_id);
	    if ($GLOBALS{'IOWARNING'} == "0") {
	        BROW();
	        XINHID('dmwsattachment_startfield_'.$dmwsattachment_id,"");
	        BCOLINTXTID('dmwsattachment_title_'.$dmwsattachment_id,'dmwsattachment_title_'.$dmwsattachment_id,$GLOBALS{'dmwsattachment_title'},"3");
	        BCOLINTEXTAREAID('dmwsattachment_description_'.$dmwsattachment_id,'dmwsattachment_description_'.$dmwsattachment_id,$GLOBALS{'dmwsattachment_description'},"3","3");
	        BCOLINDATEID('dmwsattachment_date_'.$dmwsattachment_id,'dmwsattachment_date_'.$dmwsattachment_id.'_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'dmwsattachment_date'}),"dd/mm/yyyy","1");
	        BCOLWRAP("2");
	        BTXTID('dmwsattachment_filename_'.$dmwsattachment_id,removeNamePrefixes($GLOBALS{'dmwsattachment_filename'}));
	        B_COL();
	        XINHID('dmwsattachment_filename_'.$dmwsattachment_id,$GLOBALS{'dmwsattachment_filename'});
	        BCOL("1");
	        if ( $GLOBALS{'site_clientservermode'} == "Client") {
	            if ($dmwsattachment_id[0] == "X") {
	                $link = YPGMLINK("assetfiledownloadin.php").YPGMSTDPARMS();
	            } else {
	                $link = $GLOBALS{'site_synchroniseurl'}."/site_php/".$GLOBALS{'codeversion'}."_assetfiledownloadin.php";
	                $link = $link.'?ServiceId=dmws&DomainId=dmwsportal&PersonId=&ModeId=1&SessionId=&LoginModeId=1&MenuId='.$GLOBALS{'LOGIN_menu_id'}.'&FrameId='.$GLOBALS{'LOGIN_frame_id'};
	            }
	        } else {
	            $link = YPGMLINK("assetfiledownloadin.php").YPGMSTDPARMS();
	        }
	        $link = $link.YPGMPARM("AssetFileName",$GLOBALS{'dmwsattachment_filename'});
	        XLINKTXTNEWWINDOW($link,"download","download");
	        B_COL();
	        BCOL("1");
	        BINBUTTONIDCLASSSPECIAL('dmwsattachment_delete_'.$dmwsattachment_id,"dmwsattachmentdelete","danger","x");
	        B_COL();
	        XINHID('dmwsattachment_endfield_'.$dmwsattachment_id,"");
	        B_ROW();
	        XHR();
	    }
	}

	XDIV("dmwsattachmentlistend","");
	X_DIV("dmwsattachmentlistend");

}

function VisitToolTipText($tvisitid) {
    if ($tvisitid == "") { return ("New Visit"); }
    else {
        if ($tvisitid[0] == "T") {
            $timestamp = ltrim($tvisitid, 'T');
            return (TimestamptoDDthMMMhhmm ($timestamp));
        } else {
            return ($tvisitid);
        }
    }
}

function VisitToolTipTextDateTime($visitdate,$visittime) {
    if ($visitdate == "") { return ("New Visit"); }
    else {
        if ($visittime == "" || $visittime == null){
            $visittime = "00:00";
        }
        $visitdatebits = explode("-",$visitdate);
        $formattedvisitdate = Dayth($visitdatebits[2])." ".Monthmmm($visitdatebits[1]);
        return ($formattedvisitdate." ".$visittime);
    }
}


function Dmws_DMWSSUDELETECONFIRM_Output ($dmwssu_id,$list,$liststatus) {
    Get_Data("dmwssux",$dmwssu_id);
    XH3("Delete Service User - ".$dmwssu_id." - ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'});
    XPTXT("Are you sure you want to delete this service user");
    XBR();
    XFORM("dmwssudeleteaction.php","deletesu");
    XINSTDHID();
    XINHID("dmwssu_id",$dmwssu_id);
    XINHID("List",$list);
    XINHID("ListStatus",$liststatus);
    XINSUBMIT("Confirm Deletion");
    X_FORM();
    XBR();XBR();
    XINBUTTONBACK("Cancel");
    XBR();
}

function Dmws_DMWSSUREPLICATECONFIRM_Output ($dmwssu_id,$list,$liststatus) {
    Get_Data("dmwssux",$dmwssu_id);
    XH3("Create New Case - ".$dmwssu_id." - ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'});
    XPTXT("Are you sure you want to create a new case for ".$GLOBALS{'dmwssux_fname'}." ".$GLOBALS{'dmwssux_sname'});
    XBR();
    XFORM("dmwssureplicateaction.php","deletesu");
    XINSTDHID();
    XINHID("dmwssu_id",$dmwssu_id);
    XINHID("List",$list);
    XINHID("ListStatus",$liststatus);
    XINSUBMIT("Create New Case");
    X_FORM();
    XBR();XBR();
    XINBUTTONBACK("Cancel");
    XBR();
}

function Dmws_DMWSVISITDELETECONFIRM_Output ($dmwssu_id,$dmwsvisit_id) {
    Get_Data("dmwssvisit",$dmwsvisit_id);
    XH3("Delete Visit - ".$dmwssu_id."/".$dmwsvisit_id." - ".$GLOBALS{'dmwsvisit_type'});
    XPTXT("Are you sure you want to delete this visit");
    XBR();
    XFORM("dmwsvisitdeleteaction.php","deletesu");
    XINSTDHID();
    XINHID("dmwsvisit_id",$dmwssu_id);
    XINSUBMIT("Confirm Deletion");
    X_FORM();
    XBR();
    XINBUTTONBACK("Cancel");
}

function SignaturePopup() {
    XDIVPOPUP("signaturepopup","Signature");
    XDIV("captureSignaturePopup","kbw-signature");


    X_DIV("captureSignaturePopup");
    XBR();XBR();
    XINBUTTONID("signaturepopupSave","Save");
    XINBUTTONID("signaturepopupClear","Clear");
    XINBUTTONIDSPECIAL("signaturepopupClose","warning","Close");
    X_DIV("signaturepopup");
}

function AttachmentUploadPopup($thisdmwssu_id) {
    XDIVPOPUP("attachmentuploadpopup","Attachment Upload");
    XFORMUPLOAD("dmwsattachmentuploadin.php","upload");
    XINSTDHID();
    // XPTXT("Please provide the attachment details.");
    XBR();
    BROW();
    BCOLTXT("Attachment Title","3");
    BCOLINTXTID('dmwsattachment_title','dmwsattachment_title',"","9");
    B_ROW();
    XHR();
    BROW();
    BCOLTXT("Attachment Description","3");
    BCOLINTEXTAREAID('dmwsattachment_description','dmwsattachment_description',"","5","9");
    B_ROW();
    XHR();
    BROW();
    BCOLTXT("Attachment Date","3");
    BCOLINDATEID('dmwsattachment_date','dmwsattachment_date_dd/mm/yyyy',"",'dd/mm/yyyy',"3");
    B_ROW();
    XHR();
    BROW();
    BCOLTXT("Attachment File","3");
    BCOL("9");
    $filefieldname = "dmwsattachment_filename";
    $fileviewwidth = "50";
    $filename = "";
    $fileuploadto = "Attachment";
    $fileuploadid = $thisdmwssu_id;
    $fileuploadmaxwidth = "800";
    XINDROPZONEFILE($filefieldname, $fileviewwidth, $filename, $fileuploadto);
    B_COL();
    B_ROW();
    XBR();
    XHR();
    XINBUTTONID("attachmentupload","Save");
    XINBUTTONIDSPECIAL("attachmentuploadcancel","warning","Cancel");
    X_FORM();
    X_DIV("attachmentuploadpopup");

    DropZoneBasicFileUpload_Popup ($filefieldname,$filename,$fileuploadto,$fileuploadid,$fileuploadmaxwidth);
}

// ==== reference tables ====================

function Dmws_SETUPDMWSTITLE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Titles"."|"; # pagetitle
	$parm0 = $parm0."dmwstitle"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwstitle_id|"; # keyfieldname
	$parm0 = $parm0."dmwstitle_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwstitle_id|Yes|Title Id|80|Yes|Title Id|KeyText,10,15^";
	$parm1 = $parm1."dmwstitle_name|Yes|Title|80|Yes|Title Name|InputText,10,15^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSGENDER_Output() {
	$parm0 = "";
	$parm0 = $parm0."Gender"."|"; # pagetitle
	$parm0 = $parm0."dmwsgender"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsgender_id|"; # keyfieldname
	$parm0 = $parm0."dmwsgender_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsgender_id|Yes|Gender Id|80|Yes|Gender Id|KeyText,10,15^";
	$parm1 = $parm1."dmwsgender_name|Yes|Gender|80|Yes|Name|InputText,10,15^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSCONTRACT_Output() {
    $parm0 = "";
    $parm0 = $parm0."Contract"."|"; # pagetitle
    $parm0 = $parm0."dmwscontract"."|"; # primetable
    $parm0 = $parm0."dmwscontractlocation|"; # othertables
    $parm0 = $parm0."dmwscontract_id|"; # keyfieldname
    $parm0 = $parm0."dmwscontract_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwscontract_id|Yes|Contract Id|80|Yes|Contract Id|KeyText,10,15^";
    $parm1 = $parm1."dmwscontract_name|Yes|Contract|80|Yes|Name|InputText,20,40^";
    $parm1 = $parm1."dmwscontract_description|Yes|Description|80|Yes|Description|InputText,30,60^";
    $parm1 = $parm1."dmwscontract_dmwscontractlocationidlist|Yes|Locations|80|Yes|Locations|InputCheckboxFromTable,dmwscontractlocation,dmwscontractlocation_id,dmwscontractlocation_name,dmwscontractlocation_name^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSERVICE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Service"."|"; # pagetitle
	$parm0 = $parm0."dmwsservice"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsservice_id|"; # keyfieldname
	$parm0 = $parm0."dmwsservice_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsservice_id|Yes|Service Id|80|Yes|Service Id|KeyText,10,15^";
	$parm1 = $parm1."dmwsservice_name|Yes|Service|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsservice_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSERVICESTATUS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Service status"."|"; # pagetitle
	$parm0 = $parm0."dmwsservicestatus"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsservicestatus_id|"; # keyfieldname
	$parm0 = $parm0."dmwsservicestatus_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsservicestatus_id|Yes|Service status Id|80|Yes|Service status Id|KeyText,10,20^";
	$parm1 = $parm1."dmwsservicestatus_name|Yes|Service status|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsservicestatus_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSLOCATIONTYPE_Output() {
	$parm0 = "";
	$parm0 .="Medical Location type"."|"; # pagetitle
	$parm0 .="dmwslocationtype"."|"; # primetable
	$parm0 .="|"; # othertables
	$parm0 .="dmwslocationtype_id|"; # keyfieldname
	$parm0 .="dmwslocationtype_id|"; # sortfieldname
	$parm0 .="20|"; # pagination
	$parm0 .="No"; # enable add-copy
	$parm1 = "";
	$parm1 .="dmwslocationtype_id|Yes|Medical Location type Id|80|Yes|Medical Location type Id|KeyText,10,22^";
	$parm1 .="dmwslocationtype_name|Yes|Medical Location type|80|Yes|Name|InputText,15,30^";
	$parm1 .="dmwslocationtype_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 .="generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 .="generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSCONTRACTLOCATION_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,personselectionpopup,jqueryconfirm";
    $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Dmws_SETUPDMWSCONTRACTLOCATION_Output() {
	$parm0 = "";
	$parm0 = $parm0."Contract Location"."|"; # pagetitle
	$parm0 = $parm0."dmwscontractlocation"."|"; # primetable
	$parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname]|"; # othertables
	$parm0 = $parm0."dmwscontractlocation_id|"; # keyfieldname
	$parm0 = $parm0."dmwscontractlocation_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwscontractlocation_id|Yes|Id|80|Yes|Contract LocationId|KeyText,10,22^";
	$parm1 = $parm1."dmwscontractlocation_name|Yes|Name|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwscontractlocation_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."dmwscontractlocation_mgrlist||||Yes|Management|InputPerson,80,160,managers,Lookup^";
	$parm1 = $parm1."dmwscontractlocation_officerlist||||Yes|Officers|InputPerson,80,160,officers,Lookup^";
        $parm1 = $parm1."dmwscontractlocation_disabled|Yes|Disabled|10|Yes|Disabled|InputRadioFromList,Yes+No^";               
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
$GLOBALS{'PersonSelectPopupParameters'} = array(
"other,person_domainid|person_id|person_sname|person_fname",
"person_sname,SurName,70|
person_fname,FirstName,70|
person_id,Id,40",
"field,managers,Select,dmwscontractlocation_mgrlist_input,dmwscontractlocation_mgrlist_personlist,80|
field,officers,Select,dmwscontractlocation_officerlist_input,dmwscontractlocation_officerlist_personlist,80",
"person_id",
"active",
"corusers,50,50,400,400","view",
"buildfulllist"
);
}

function Dmws_SETUPDMWSSAFEGUARDINGISSUETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."SU Safeguarding issue type"."|"; # pagetitle
	$parm0 = $parm0."dmwssafeguardingissuetype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwssafeguardingissuetype_id|"; # keyfieldname
	$parm0 = $parm0."dmwssafeguardingissuetype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwssafeguardingissuetype_id|Yes|SU Safeguarding Issue type Id|80|Yes|SU Safeguarding Issue type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwssafeguardingissuetype_name|Yes|SU Safeguarding Issue type|80|Yes|Name|InputText,30,50^";
	$parm1 = $parm1."dmwssafeguardingissuetype_description||Description|80|Yes|Description|InputText,60,250^";
	$parm1 = $parm1."dmwssafeguardingissuetype_listshortcode|Yes|Shortcode|40|Yes|Short Code|InputText,2,2^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSAFEGUARDEETYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."SU Safeguardee type"."|"; # pagetitle
    $parm0 = $parm0."dmwssafeguardeetype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."dmwssafeguardeetype_id|"; # keyfieldname
    $parm0 = $parm0."dmwssafeguardeetype_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwssafeguardeetype_id|Yes|SU Safeguardee type Id|80|Yes|SU Safeguardee type Id|KeyText,10,22^";
    $parm1 = $parm1."dmwssafeguardeetype_name|Yes|SU Safeguardee type|80|Yes|Name|InputText,60,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSAFEGUARDEEREASONTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."SU Safeguardee Reason type"."|"; # pagetitle
    $parm0 = $parm0."dmwssafeguardeereasontype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."dmwssafeguardeereasontype_id|"; # keyfieldname
    $parm0 = $parm0."dmwssafeguardeereasontype_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwssafeguardeereasontype_id|Yes|SU Safeguardee Reason type  Id|80|Yes|SU Safeguardee Reason type  Id|KeyText,10,22^";
    $parm1 = $parm1."dmwssafeguardeereasontype_name|Yes|SU Safeguardee Reason type |80|Yes|Name|InputText,20,45^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSWOSAFEGUARDINGISSUETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."WO Safeguarding issue type"."|"; # pagetitle
	$parm0 = $parm0."dmwswosafeguardingissuetype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwswosafeguardingissuetype_id|"; # keyfieldname
	$parm0 = $parm0."dmwswosafeguardingissuetype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwswosafeguardingissuetype_id|Yes|WO Safeguarding Issue type Id|80|Yes|WO Safeguarding Issue type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwswosafeguardingissuetype_name|Yes|WO Safeguarding Issue type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwswosafeguardingissuetype_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."dmwswosafeguardingissuetype_listshortcode|Yes|Shortcode|40|Yes|Short Code|InputText,2,2^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}



function Dmws_SETUPDMWSEQDIVOPTIONS_Output() {
	$parm0 = "";
	$parm0 = $parm0."Equality and diversity options"."|"; # pagetitle
	$parm0 = $parm0."dmwseqdivbuttons"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwseqdivbuttons_id|"; # keyfieldname
	$parm0 = $parm0."dmwseqdivbuttons_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwseqdivbuttons_id|Yes|Radio Button Id|80|Yes|Radio Button Id|KeyText,10,22^";
	$parm1 = $parm1."dmwseqdivbuttons_name|Yes|Radio Button Name|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwseqdivbuttons_class|Yes|Class|80|Yes|Class|InputText,30,60^";
	$parm1 = $parm1."dmwseqdivbuttons_subclass|Yes|Subclass|80|Yes|Subclass|InputText,30,60^";
	$parm1 = $parm1."dmwseqdivbuttons_cols|Yes|Cols|80|Yes|Cols|InputText,30,60^";
	$parm1 = $parm1."dmwseqdivbuttons_sequence|Yes|Sequence Number|80|Yes|Sequence|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSDISABILITYTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Disability type"."|"; # pagetitle
	$parm0 = $parm0."dmwsdisabilitytype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsdisabilitytype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsdisabilitytype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsdisabilitytype_id|Yes|Disability type Id|80|Yes|Caring Responsibilities type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwsdisabilitytype_name|Yes|Caring Responsibilities type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsdisabilitytype_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSPRIMARYCARETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Primary Care type"."|"; # pagetitle
	$parm0 = $parm0."dmwsprimarycaretype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsprimarycaretype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsprimarycaretype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsprimarycaretype_id|Yes|Primary Care type Id|80|Yes|Primary Care type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwsprimarycaretype_name|Yes|Primary Care type Id|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSECONDARYCARETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Secondary Care type"."|"; # pagetitle
	$parm0 = $parm0."dmwssecondarycaretype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwssecondarycaretype_id|"; # keyfieldname
	$parm0 = $parm0."dmwssecondarycaretype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwssecondarycaretype_id|Yes|Secondary Care Type Id|80|Yes|Secondary Care Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwssecondarycaretype_name|Yes|Secondary Care Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSINDEPENDENTLIVINGTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Independent Living Type"."|"; # pagetitle
	$parm0 = $parm0."dmwsindependentlivingtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsindependentlivingtype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsindependentlivingtype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsindependentlivingtype_id|Yes|Independent Living Type Id|80|Yes|Independent Living Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwsindependentlivingtype_name|Yes|Independent Living Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSOCIALISOLATIONTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Social Isolation Type"."|"; # pagetitle
	$parm0 = $parm0."dmwssocialisolationtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwssocialisolationtype_id|"; # keyfieldname
	$parm0 = $parm0."dmwssocialisolationtype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwssocialisolationtype_id|Yes|Social Isolation Type Id|80|Yes|Social Isolation Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwssocialisolationtype_name|Yes|Social Isolation Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSEMPLOYMENTTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Employment Type"."|"; # pagetitle
	$parm0 = $parm0."dmwsemploymenttype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsemploymenttype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsemploymenttype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsemploymenttype_id|Yes|Employment Type Id|80|Yes|Employment Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwsemploymenttype_name|Yes|Employment Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSSUPPORTCOMMUNICATIONTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Support Communication Type"."|"; # pagetitle
	$parm0 = $parm0."dmwssupportcommunicationtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwssupportcommunicationtype_id|"; # keyfieldname
	$parm0 = $parm0."dmwssupportcommunicationtype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwssupportcommunicationtype_id|Yes|Support Communication Type Id|80|Yes|Support Communication Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwssupportcommunicationtype_name|Yes|Support Communication Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSEVENTSCOMMUNICATIONTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Events Communication Type"."|"; # pagetitle
	$parm0 = $parm0."dmwseventscommunicationtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwseventscommunicationtype_id|"; # keyfieldname
	$parm0 = $parm0."dmwseventscommunicationtype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwseventscommunicationtype_id|Yes|Events Communication Type Id|80|Yes|Events Communication Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwseventscommunicationtype_name|Yes|Events Communication Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSREPORTCOMMUNICATIONTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Report Communication Type"."|"; # pagetitle
	$parm0 = $parm0."dmwsreportcommunicationtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsreportcommunicationtype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsreportcommunicationtype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsreportcommunicationtype_id|Yes|Report Communication Type Id|80|Yes|Report Communication Type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwsreportcommunicationtype_name|Yes|Report Communication Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSCARINGRESPONSIBILITYTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Disability type"."|"; # pagetitle
	$parm0 = $parm0."dmwscaringresponsibilitytype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwscaringresponsibilitytype_id|"; # keyfieldname
	$parm0 = $parm0."dmwscaringresponsibilitytype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwscaringresponsibilitytype_id|Yes|Disability type Id|80|Yes|Disability type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwscaringresponsibilitytype_name|Yes|Disability type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwscaringresponsibilitytype_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSMODSPECIFICTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."MOD Specific info type"."|"; # pagetitle
	$parm0 = $parm0."dmwsmodspecifictype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsmodspecifictype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsmodspecifictype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsmodspecifictype_id|Yes|MOD Specific Info type Id|80|Yes|MOD Specific Info type Id|KeyText,10,22^";
	$parm1 = $parm1."dmwsmodspecifictype_name|Yes|Disability type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}


function Dmws_SETUPDMWSADMISSIONTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Admission type"."|"; # pagetitle
	$parm0 = $parm0."dmwsadmissiontype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsadmissiontype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsadmissiontype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsadmissiontype_id|Yes|Admission type Id|80|Yes|Admission type Id|KeyText,10,19^";
	$parm1 = $parm1."dmwsadmissiontype_name|Yes|Admission type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsadmissiontype_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSADMISSIONREASON_Output() {
	$parm0 = "";
	$parm0 = $parm0."Admission reason"."|"; # pagetitle
	$parm0 = $parm0."dmwsadmissionreason"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsadmissionreason_id|"; # keyfieldname
	$parm0 = $parm0."dmwsadmissionreason_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsadmissionreason_id|Yes|Admission Reason Id|80|Yes|Admission reason Id|KeyText,10,17^";
	$parm1 = $parm1."dmwsadmissionreason_name|Yes|Admission Reason|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsadmissionreason_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSERVICETYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Service type"."|"; # pagetitle
	$parm0 = $parm0."dmwsservicetype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsservicetype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsservicetype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsservicetype_id|Yes|Service Type Id|80|Yes|Service type Id Id|KeyText,10,15^";
	$parm1 = $parm1."dmwsservicetype_name|Yes|Service Type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsservicetype_description||Service type|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."dmwsservicetype_disabled|Yes|Disabled|10|Yes|Disabled|InputRadioFromList,Yes+No^";        
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSUFEEDBACKTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."SU Feedback type"."|"; # pagetitle
    $parm0 = $parm0."dmwssufeedbacktype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."dmwssufeedbacktype_id|"; # keyfieldname
    $parm0 = $parm0."dmwssufeedbacktype_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwssufeedbacktype_id|Yes|sufeedback type Id|80|Yes|SU Feedback Id|KeyText,10,15^";
    $parm1 = $parm1."dmwssufeedbacktype_name|Yes|sufeedback type|80|Yes|Name|InputText,15,30^";
    $parm1 = $parm1."dmwssufeedbacktype_description||sufeedback type|80|Yes|Description|InputText,30,60^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSREFERRALORG_Output() {
	$parm0 = "";
	$parm0 = $parm0."Referral organisation"."|"; # pagetitle
	$parm0 = $parm0."dmwsreferralorg"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsreferralorg_id|"; # keyfieldname
	$parm0 = $parm0."dmwsreferralorg_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsreferralorg_id|Yes|Referral organisation Id|80|Yes|Referral organisation Id|KeyText,10,30^";
	$parm1 = $parm1."dmwsreferralorg_name|Yes|Referral organisation|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsreferralorg_description||Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSCONTACTTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Contact type"."|"; # pagetitle
	$parm0 = $parm0."dmwscontacttype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwscontacttype_id|"; # keyfieldname
	$parm0 = $parm0."dmwscontacttype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwscontacttype_id|Yes|Contact type|80|Yes|Contact type Id|KeyText,10,15^";
	$parm1 = $parm1."dmwscontacttype_type|Yes|Contact type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSCONSENTWITHDRAWALTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Consent Withdrawal type"."|"; # pagetitle
    $parm0 = $parm0."dmwsconsentwithdrawaltype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."dmwsconsentwithdrawaltype_id|"; # keyfieldname
    $parm0 = $parm0."dmwsconsentwithdrawaltype_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwsconsentwithdrawaltype_id|Yes|Consent Withdrawal type|80|Yes|Consent Withdrawal type Id|KeyText,10,15^";
    $parm1 = $parm1."dmwsconsentwithdrawaltype_type|Yes|Consent Withdrawal type|80|Yes|Name|InputText,15,30^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSPECIALISTREFERRALORG_Output() {
	$parm0 = "";
	$parm0 = $parm0."Specialist referral org"."|"; # pagetitle
	$parm0 = $parm0."dmwsspecialistreferralorg"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsspecialistreferralorg_id|"; # keyfieldname
	$parm0 = $parm0."dmwsspecialistreferralorg_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsspecialistreferralorg_id|Yes|Contact type|80|Yes|Specialist referral org Id|KeyText,10,15^";
	$parm1 = $parm1."dmwsspecialistreferralorg_name|Yes|Contact type|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSVISITLOCATION_Output() {
	$parm0 = "";
	$parm0 = $parm0."Visit location"."|"; # pagetitle
	$parm0 = $parm0."dmwsvisitlocation"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsvisitlocation_id|"; # keyfieldname
	$parm0 = $parm0."dmwsvisitlocation_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsvisitlocation_id|Yes|Visit location Id|80|Yes|Visit location Id|KeyText,10,15^";
	$parm1 = $parm1."dmwsvisitlocation_type|Yes|Visit location|80|Yes|Name|InputText,15,30^";
	$parm1 = $parm1."dmwsvisitlocation_postcode||Postcode|80|Yes|Postcode|InputText,10,15^";
	$parm1 = $parm1."dmwsvisitlocation_address||Address|80|Yes|Address|InputText,10,15^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSCOMPLEXITYSCORE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Complexity score"."|"; # pagetitle
	$parm0 = $parm0."dmwscomplexityscore"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwscomplexityscore_id|"; # keyfieldname
	$parm0 = $parm0."dmwscomplexityscore_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwscomplexityscore_id|Yes|Complexity score|80|Yes|Complexity score Id Id|KeyText,10,15^";
	$parm1 = $parm1."dmwscomplexityscore_date|Yes|Complexity score|80|Yes|Complexity score date Name|InputText,10,15^";
	$parm1 = $parm1."dmwscomplexityscore_score|Yes|Complexity score|80|Yes|Complexity score Name|InputText,10,15^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSTIMEBAND_Output() {
	$parm0 = "";
	$parm0 = $parm0."Time band"."|"; # pagetitle
	$parm0 = $parm0."dmwstimeband"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwstimeband_id|"; # keyfieldname
	$parm0 = $parm0."dmwstimeband_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwstimeband_id|Yes|Time band Id|80|Yes|Time band Id|KeyText,10,15^";
	$parm1 = $parm1."dmwstimeband_name|Yes|Time band|80|Yes|Name|InputText,20,30^";
	$parm1 = $parm1."dmwstimeband_start|Yes|Start|80|Yes|Time band start|InputText,10,15^";
	$parm1 = $parm1."dmwstimeband_end|Yes|End|80|Yes|Time band end|InputText,10,15^";
	$parm1 = $parm1."dmwstimeband_dmwscontractid|Yes|Contract Id|80|Yes|Contract Id|InputText,30,15^";
	$parm1 = $parm1."dmwstimeband_dmwscontractlocationid|Yes|Contract Location Id|80|Yes|Contract Location Id|InputText,30,25^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSCOMPLEXITYTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Complexity Type"."|"; # pagetitle
	$parm0 = $parm0."dmwscomplexitytype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwscomplexitytype_id|"; # keyfieldname
	$parm0 = $parm0."dmwscomplexitytype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwscomplexitytype_id|Yes|Id|80|Yes|Complexity Type Id|KeyText,10,15^";
	$parm1 = $parm1."dmwscomplexitytype_name|Yes|Name|80|Yes|Name|InputText,30,60^";
	$parm1 = $parm1."dmwscomplexitytype_description|Yes|Description|80|Yes|Description|InputText,30,60^";
	$parm1 = $parm1."dmwscomplexitytype_weighting|Yes|Weighting|80|Yes|Weighting|InputSelectFromList,0.5+1.0+1.5+2.0+2.5+3.0+3.5+4.0+4.5+5.0+5.5+6.0^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
}

function Dmws_SETUPDMWSSUPPORTTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Support type"."|"; # pagetitle
	$parm0 = $parm0."dmwssupporttype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwssupporttype_id|"; # keyfieldname
	$parm0 = $parm0."dmwssupporttype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwssupporttype_id|Yes|Support Type|80|Yes|Support Type Id|KeyText,10,21^";
	$parm1 = $parm1."dmwssupporttype_name|Yes|Support Type|80|Yes|Name|InputText,10,21^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);

}

function Dmws_SETUPDMWSREFERRERORGTYPE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Referrer Org type"."|"; # pagetitle
	$parm0 = $parm0."dmwsreferrerorgtype"."|"; # primetable
	$parm0 = $parm0."|"; # othertables
	$parm0 = $parm0."dmwsreferrerorgtype_id|"; # keyfieldname
	$parm0 = $parm0."dmwsreferrerorgtype_id|"; # sortfieldname
	$parm0 = $parm0."20|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."dmwsreferrerorgtype_id|Yes|Referrer Org Type|80|Yes|Referrer Org Id|KeyText,10,21^";
	$parm1 = $parm1."dmwsreferrerorgtype_name|Yes|Referrer Org|80|Yes|Name|InputText,10,21^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);

}


function Dmws_SETUPDMWSOCCUPATIONALISSUETYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Current Occupational Status Type"."|"; # pagetitle
    $parm0 = $parm0."dmwsoccupationalissuetype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."dmwsoccupationalissuetype_id|"; # keyfieldname
    $parm0 = $parm0."dmwsoccupationalissuetype_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwsoccupationalissuetype_id|Yes|Current Occupational Status Type|80|Yes|Current Occupational Status Type Id|KeyText,10,21^";
    $parm1 = $parm1."dmwsoccupationalissuetype_name|Yes|Current Occupational Status Type|80|Yes|Name|InputText,10,21^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);

}

function Dmws_SETUPDMWSPREVIOUSOCCUPATIONTYPE_Output() {
    $parm0 = "";
    $parm0 = $parm0."Previous Occupation Type"."|"; # pagetitle
    $parm0 = $parm0."dmwspreviousoccupationtype"."|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."dmwspreviousoccupationtype_id|"; # keyfieldname
    $parm0 = $parm0."dmwspreviousoccupationtype_id|"; # sortfieldname
    $parm0 = $parm0."20|"; # pagination
    $parm0 = $parm0."No"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."dmwspreviousoccupationtype_id|Yes|Previous Occupation Type|80|Yes|Previous Occupation Type Id|KeyText,10,21^";
    $parm1 = $parm1."dmwspreviousoccupationtype_name|Yes|Previous Occupation Type|80|Yes|Name|InputText,10,21^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
    $parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
    GenericHandler_Output ($parm0,$parm1);
}

function Dmws_DMWSTRELLO_Output() {
    XH1("DWMS Support");
    XH3("The following support options are provided on Trello");
    XUL("","");
    XLITXT("Problem Reporting and Status");
    XLITXT("Submission of Improvements");
    XLITXT("Requests for Clarification");
    XLITXT("Frequently Asked Questions");
    X_UL();
    XBR();
    XLINKBUTTONNEWWINDOW ("https://www.trello.com","Go to Trello","trello");
    XBR();XBR();
    XPTXT("Tip: Save your Trello password in the browser to take you straight there");
}

function Dmws_DMWSCLIENTSYNCHRONISE_Output() {
    XH3("Synchronisation");
    XIMG("../site_assets/Synchronise.png","50","","0");
    XBR();XBR();
    XPTXT("This will take any work in progress on your local machine and send it to the central server.");
    XPTXT("It will also download the latest information for other Service Users in your location.");
    XFORMUPLOAD("dmwsclientsynchronise.php","synchronise");
    XINSTDHID();
    XINHID("TestorReal","R");
    /*
    XBR();
    XINRADIO("TestorReal","R","checked","");XTXT("Normal Synchronisation<BR>");
    XBR();
    XTABLE();XTRODD();XTD();
    XINRADIO("TestorReal","T","","");XTXT("Test Mode (no updates made)<BR>");
    XBR();
    XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");
    XBR();
    X_TD();X_TR();X_TABLE();
    */
    XBR();
    XINSUBMIT("Synchronise");
    X_FORM();
}

function Dmws_DMWSDATACLEANUP_Output() {
    XH3("Data Cleanup");
    XFORMUPLOAD("dmwsdatacleanup.php","datacleanup");
    XINSTDHID();
    XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - actions will be verified but no updates made<BR>");
    XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
    XBR();XBR();
    XINSUBMIT("CleanUp!");
    X_FORM();
}

function Dmws_DMWSDATAREMOVE_Output() {
    XH3("Remove DMWS Data");
    XPTXT('This utility removes all DMWS data from the DMWS Client - including all person data except for "cset".');
    XPTXTCOLOR('<b>ARE YOU REALLY SURE YOU WANT TO DO THIS?</b>',"red");
    XFORMUPLOAD("dmwsdataremove.php","dataremove");
    XINSTDHID();
    XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - actions will be verified but no deletions made<BR>");
    XINRADIO("TestorReal","R","","");XTXT("Real Mode - deletions will be made<BR>");
    XBR();XBR();
    XINSUBMIT("Remove!");
    X_FORM();
}

function Dmws_DMWSCLIENTAPPSYNCHRONISE_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqueryconfirm,dmwsclientappsynchroniseout";
}

function Dmws_DMWSCLIENTAPPSYNCHRONISE_Output() {
    XH3("Application Updates");
    BROW();
    BCOLTXT("","10");
    if ( $GLOBALS{'site_clientservermode'} == "Client") {
        BCOL("2");
        BIMGID("statusonoffline","../site_assets/StatusOnline.png","50");
        B_COL();
    }
    B_ROW();
    XBR();
    XIMG("../site_assets/APPSYNCH.png","80","","0");
    XTXT(" Current Version  : ".$GLOBALS{'site_synchroniseappversion'});
    XBR();XBR();
    XPTXT("This checks to see whether there are any available updates for your machine.");
    XPTXT("If there are, it will download them and guide you through the implementation.");
    XPTXT("Note: It is important to keep your machine up to date so that data can be synchronised properly.");
    XBR();
    XFORMUPLOAD("dmwsclientappsynchronise.php","appsynchronise");
    XINSTDHID();
    XINHID("TestorReal","R");
    /*
     XINRADIO("TestorReal","R","checked","");XTXT("Normal Mode<BR>");
     XBR();
     XTABLE();XTRODD();XTD();
     XINRADIO("TestorReal","T","","");XTXT("Test Mode (no updates made)<BR>");
     XBR();
     XINCHECKBOXYESNO("ExtendedTrace", "", "Extended Trace Information");
     XBR();
     X_TD();X_TR();X_TABLE();
     */

    XBR();
    XINSUBMIT("Get Application Updates");
    XBR();XBR();
    XINCHECKBOXYESNO("FullDownload", "", "Full Download");
    XBR();
    X_FORM();
}

function Dmws_DMWSCLIENTAPPREPAIR_Output() {
    XH3("Offline Application Repair");
    XBR();XBR();
    XPTXT("Use this in case of problems with the Offline Application.");
    XBR();
    XPTXT("Step 1: Download the Application Repair Files and save in Downloads");
    XLINKTXT ("https://www.dmwsportal.org.uk/downloads/".$GLOBALS{'codeversion'}."_dmwsclientapprepairfiles.zip","download");
    XBR();XBR();XBR();
    XFORMUPLOAD("dmwsclientapprepair.php","clientapprepair");
    XINSTDHID();
    XBR();
    XINSUBMIT("Step 2: Repair the Offline Application");
    XBR();
    X_FORM();
}

function Dmws_DMWSDATEFIX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Dmws_DMWSDATEFIX_Output ($testorreal) {
    XH3("DMWS Date fixer  - $testorreal");
    if ($testorreal == "Test") {
        XBR();
        $link = YPGMLINK("dmwsdatefixreal.php").YPGMSTDPARMS();
        XLINKBUTTON($link,"I'm OK with this Test. Now fix the dates in Real mode.");
        XBR();
    }
    // $testorreal == "Test";
    $relevantdatesa = Array("dmwssu_servicedischargedate","dmwssu_referraldate","dmwssu_consentdate","dmwssu_dmwsadmissiondate","dmwssu_initialvisitdate","dmwssu_dischargedate","dmwssu_deathdate","dmwssu_casecloseddate","dmwssu_firstclinicapptdate","dmwssu_dob");
    $datestatsa = Array();
    $dmwssua = Get_Array('dmwssu');
    //XH3($dmwscontracta);
    //XDIV("DateTable","container");
    XTABLEJQDTID("reporttable_datelist");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("SU Id");
    XTDHTXT("Field Name");
    XTDHTXT("Old Date");
    XTDHTXT("New Date");
    X_TR();
    X_THEAD();
    XTBODY();
    foreach ($dmwssua as $dmwssu_id) {
        //XH3($dmwssu_id);
        Get_Data('dmwssu',$dmwssu_id);
        if (($GLOBALS{'dmwssu_dmwscontractid'} == "Test")||($GLOBALS{'dmwssu_dmwscontractid'} == "Example")){

        } else {

            /*
            foreach ($relevantdatesa as $fieldname){
                $wrong = "0";
                $fieldvalue = $GLOBALS{$fieldname};
                if (($fieldname == "dmwssu_dob")){
                    if ($fieldvalue > date("Y-m-d")){
                        XTRJQDT();XTDTXT($dmwssu_id);XTDTXT($fieldname);XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT(" ");X_TR();
                        $GLOBALS{$fieldname} = "";
                        $wrong = "1";
                    }
                }
                if (($fieldname == "dmwssu_referraldate")){
                    $datea = explode("-",$fieldvalue);
                    if (($datea[0] == "2015")||($datea[0] == "2016")){
                        $yyyy = $datea[0];
                        $mm = $datea[1];
                        $dd = $datea[2];
                        $yyyya = str_split($yyyy);
                        $dda = str_split($dd);
                        $newyyyy = $yyyya[0].$yyyya[1].$dda[0].$dda[1];
                        $yy = $yyyya[0].$yyyya[1];
                        $newdd = $yyyya[2].$yyyya[3];
                        $newdate = $newyyyy."-".$mm."-".$newdd;
                        $formatchecka = explode("-",$newdate);
                        if (($newdate >= 2017-01-01)&&($newdate <= date("Y-m-d"))){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT($fieldname);XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }

                        if (($newdate != "0000-00-00")&&(strlen($formatchecka[0]) == 4)&&(strlen($formatchecka[1]) == 2)&&(strlen($formatchecka[2]) == 2)&&($fieldname != "dmwssu_servicedischargedate")){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT($fieldname);XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }

                    }
                }
                if ( ($wrong == "1" )&&($testorreal == "Real") ) {
                    Write_Data('dmwssu',$dmwssu_id);
                }
            }
            */

            /*$dmwsvisita = Get_Array('dmwsvisit',$dmwssu_id);
            foreach ($dmwsvisita as $dmwsvisit_id){
                //XH3($dmwsvisit_id);
                $wrong = "0";
                Get_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
                //XH3($GLOBALS{'dmwsvisit_date'});
                $fieldname = "dmwsvisit_date";
                $fieldvalue = $GLOBALS{'dmwsvisit_date'};
                if ($fieldvalue == "0000-00-00") {
                    $newdate = TimestamptoYYYYhMMhDD($dmwsvisit_id);
                    XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=blue>$fieldname</font>");XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                    $GLOBALS{$fieldname} = $newdate;
                    $wrong = "1";
                } else {
                    if (($fieldvalue > date("Y-m-d"))||($fieldvalue < 2017-01-01)) {
                        $datea = explode("-",$fieldvalue);
                        $yyyy = $datea[0];
                        $mm = $datea[1];
                        $dd = $datea[2];
                        $yyyya = str_split($yyyy);
                        $dda = str_split($dd);
                        $newyyyy = $yyyya[0].$yyyya[1].$dda[0].$dda[1];
                        $yy = $yyyya[0].$yyyya[1];
                        $newdd = $yyyya[2].$yyyya[3];
                        $newdate = $newyyyy."-".$mm."-".$newdd;
                        $formatchecka = explode("-",$newdate);
                        if (($newdate != "0000-00-00")&&(strlen($formatchecka[0]) == 4)&&(strlen($formatchecka[1]) == 2)&&(strlen($formatchecka[2]) == 2)&&($fieldname != "dmwssu_servicedischargedate")){
                            if ((($dd == "17")&&($newdd == "18"))||(($dd == "18")&&($newdd == "17"))){
                                XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=blue>$fieldname</font>");XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                                $GLOBALS{$fieldname} = $newdate;
                                $wrong = "1";
                            } else {
                                XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=blue>$fieldname</font>");XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                                $GLOBALS{$fieldname} = $newdate;
                                $wrong = "1";
                            }
                        }
                    }
                }
                if ( ($wrong == "1" )&&($testorreal == "Real") ) {
                    Write_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
                }
            }
            */

            $dmwsprogressa = Get_Array('dmwsprogress',$dmwssu_id);
            foreach ($dmwsprogressa as $dmwsprogress_id) {
                Get_Data('dmwsprogress',$dmwssu_id,$dmwsprogress_id);
                //XH3($GLOBALS{'dmwsprogress_date'});
                $wrong = "0";
                $fieldname = 'dmwsprogress_date';
                $fieldvalue = $GLOBALS{'dmwsprogress_date'};
                if (($fieldvalue > date("Y-m-d"))||($fieldvalue < 2017-01-01)){
                    $datea = explode("-",$fieldvalue);
                    $yyyy = $datea[0];
                    $mm = $datea[1];
                    $dd = $datea[2];
                    $yyyya = str_split($yyyy);
                    $dda = str_split($dd);
                    $newyyyy = $yyyya[0].$yyyya[1].$dda[0].$dda[1];
                    $yy = $yyyya[0].$yyyya[1];
                    $newdd = $yyyya[2].$yyyya[3];
                    $newdate = $newyyyy."-".$mm."-".$newdd;
                    $formatchecka = explode("-",$newdate);
                    if ($yy == "20"||$yy == "19"){
                        if ((($dd == "17")&&($newdd == "18"))||(($dd == "18")&&($newdd == "17"))){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                        elseif (($newdate != "0000-00-00")&&(strlen($formatchecka[0]) == 4)&&(strlen($formatchecka[1]) == 2)&&(strlen($formatchecka[2]) == 2)&&($fieldname != "dmwssu_servicedischargedate")){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                    }
                }
                if ( ($wrong == "1" )&&($testorreal == "Real") ) {
                    Write_Data('dmwsprogress',$dmwssu_id,$dmwsprogress_id);
                }
            }

            /*
            $dmwsreferrerupdatea = Get_Array('dmwsreferrerupdate',$dmwssu_id);
            foreach ($dmwsreferrerupdatea as $dmwsreferrerupdate_id) {
                Get_Data('dmwsreferrerupdate',$dmwssu_id,$dmwsreferrerupdate_id);
                //XH3($GLOBALS{'dmwsreferrerupdate_date'});
                $wrong = "0";
                $fieldname = 'dmwsreferrerupdate_date';
                $fieldvalue = $GLOBALS{'dmwsreferrerupdate_date'};
                if (($fieldvalue > date("Y-m-d"))||($fieldvalue < 2017-01-01)){
                    $datea = explode("-",$fieldvalue);
                    $yyyy = $datea[0];
                    $mm = $datea[1];
                    $dd = $datea[2];
                    $yyyya = str_split($yyyy);
                    $dda = str_split($dd);
                    $newyyyy = $yyyya[0].$yyyya[1].$dda[0].$dda[1];
                    $yy = $yyyya[0].$yyyya[1];
                    $newdd = $yyyya[2].$yyyya[3];
                    $newdate = $yyyy."-".$dd."-".$mm;
                    $formatchecka = explode("-",$newdate);
                    if ($yy == "20"||$yy == "19"){
                        if ((($dd == "17")&&($newdd == "18"))||(($dd == "18")&&($newdd == "17"))){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                        elseif (($newdate != "0000-00-00")&&(strlen($formatchecka[0]) == 4)&&(strlen($formatchecka[1]) == 2)&&(strlen($formatchecka[2]) == 2)&&($fieldname != "dmwssu_servicedischargedate")){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                    }
                }
                if ( ($wrong == "1" )&&($testorreal == "Real") ) {
                    Write_Data('dmwsreferrerupdate',$dmwssu_id,$dmwsreferrerupdate_id);
                }
            }

            $dmwsreferrala = Get_Array('dmwsreferral',$dmwssu_id);
            foreach ($dmwsreferrala as $dmwsreferral_id) {
                Get_Data('dmwsreferral',$dmwssu_id,$dmwsreferral_id);
                //XH3($GLOBALS{'dmwsreferral_date'});
                $wrong = "0";
                $fieldname = 'dmwsreferral_date';
                $fieldvalue = $GLOBALS{'dmwsreferral_date'};
                if (($fieldvalue > date("Y-m-d"))||($fieldvalue < 2017-01-01)){
                    $datea = explode("-",$fieldvalue);
                    $yyyy = $datea[0];
                    $mm = $datea[1];
                    $dd = $datea[2];
                    $yyyya = str_split($yyyy);
                    $dda = str_split($dd);
                    $newyyyy = $yyyya[0].$yyyya[1].$dda[0].$dda[1];
                    $yy = $yyyya[0].$yyyya[1];
                    $newdd = $yyyya[2].$yyyya[3];
                    $newdate = $yyyy."-".$dd."-".$mm;
                    $formatchecka = explode("-",$newdate);
                    if ($yy == "20"||$yy == "19"){
                        if ((($dd == "17")&&($newdd == "18"))||(($dd == "18")&&($newdd == "17"))){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                        elseif (($newdate != "0000-00-00")&&(strlen($formatchecka[0]) == 4)&&(strlen($formatchecka[1]) == 2)&&(strlen($formatchecka[2]) == 2)&&($fieldname != "dmwssu_servicedischargedate")){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }

                    }
                }*/
                //XH3($GLOBALS{'dmwsreferral_consentdate'});
               /* $fieldname = 'dmwsreferral_consentdate';
                $fieldvalue = $GLOBALS{'dmwsreferral_consentdate'};
                if (($fieldvalue > date("Y-m-d"))||($fieldvalue < 2017-01-01)){
                    $datea = explode("-",$fieldvalue);
                    $yyyy = $datea[0];
                    $mm = $datea[1];
                    $dd = $datea[2];
                    $yyyya = str_split($yyyy);
                    $dda = str_split($dd);
                    $newyyyy = $yyyya[0].$yyyya[1].$dda[0].$dda[1];
                    $yy = $yyyya[0].$yyyya[1];
                    $newdd = $yyyya[2].$yyyya[3];
                    $newdate = $yyyy."-".$dd."-".$mm;
                    $formatchecka = explode("-",$newdate);
                    if ($yy == "20"||$yy == "19"){
                        if ((($dd == "17")&&($newdd == "18"))||(($dd == "18")&&($newdd == "17"))){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=orange>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                        elseif (($newdate != "0000-00-00")&&(strlen($formatchecka[0]) == 4)&&(strlen($formatchecka[1]) == 2)&&(strlen($formatchecka[2]) == 2)&&($fieldname != "dmwssu_servicedischargedate")){
                            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=purple>$fieldname</font>");XTDTXT("<font color=red>$fieldvalue</font>");XTDTXT("<font color=green>$newdate</font>");X_TR();
                            $GLOBALS{$fieldname} = $newdate;
                            $wrong = "1";
                        }
                    }
                }
                if ( ($wrong == "1" )&&($testorreal == "Real") ) {
                    Write_Data('dmwsreferral',$dmwssu_id,$dmwsreferral_id);
                }

            }*/
        }
    }
    X_TBODY();
    X_TABLE();
    //X_DIV("DateTable","container");
}


function Dmws_DMWSTIMEBANDFIX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Dmws_DMWSTIMEBANDFIX_Output ($testorreal) {
    //XH3($GLOBALS{'MPDFREPORTFILTER'});

    function GetTimeBandList ($listfieldname,$timebandid) {
        // return hours
        $hours = "";
        if ($GLOBALS{$listfieldname} != "") {
            $lista = explode('^',$GLOBALS{$listfieldname});
            foreach ($lista as $listelement) {
                if ($listelement != "") {
                    $listbits = explode('|',$listelement);
                    if ($listbits[0] == $timebandid) {
                        $hours = $listbits[1];
                    }
                }
            }
        }
        // XH5($timebandid." ".$hours);
        if ( $hours == "0" ) { $hours = ""; }
        return $hours;
    }


    // Here is some code that could be adapted to read the filter parameter string syntax
    $admissiontypeida = Array("dmwsvisit_timeslot","dmwsvisit_durationvisit","dmwsvisit_durationtel","dmwsvisit_durationresearch","dmwsvisit_durationtravel","dmwsvisit_durationfamily","dmwsvisit_durationbereavement","dmwsvisit_durationdeathviewing","dmwsvisit_durationstaffsupport","dmwsvisit_durationadmin");
    $timebandnamea = Array("Time Band","SU Visit","Telephone","Research","Travel","Family","Bereavement","Death Viewing","Staff Support","Admin etc");

    //XH3($formattedstartdate." ".$formattedenddate);

    // Step 0 - colour palette
    $htc = "#FFFFFF"; // header text colour
    $hbc = "#808080"; // header background colour
    $rtc = "#000000"; // row text colour
    $rbc = "#f2f2f2"; // row background colour

    //Step 2 - gather the data from the database

    $timebandstatsa = Array();
    $relevantdmwssua = Array();
    $dmwssua = Get_Array('dmwssu');
    $opencasesa = Array();

    //XH3($dmwscontracta);
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("SU ref");
    XTDHTXT("Visit Date");
    XTDHTXT("Time Band");
    XTDHTXT("Contract");
    XTDHTXT("Field name");
    XTDHTXT("Time");
    X_TR();
    X_THEAD();
    XTBODY();
    foreach ($dmwssua as $dmwssu_id) {
        Get_Data('dmwssu',$dmwssu_id);
        Get_Data('dmwssux',$dmwssu_id);
        $include = "0";

        // this logic needs to be replaced by identifying whether this is the welfare officers case
        /*  $dmwscontractlocationa = Get_Array('dmwscontractlocation');
         foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
         if ( $dmwscontractlocation_id == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
         Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
         // XPTXT("MATCH|".$GLOBALS{'LOGIN_person_id'}.$recsep.$GLOBALS{'dmwscontractlocation_officerlist'}.$recsep);
         if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $include = "1"; }
         if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $include = "1"; }
         }
         }*/
        $thiscontract = $GLOBALS{'dmwssu_dmwscontractid'};
        $thiscontractlocation = $GLOBALS{'dmwssu_dmwscontractlocationid'};
        $thiswo = $GLOBALS{'dmwssu_wopersonid'};


        if(($filtervaluea[2] == $thiscontract)&&($filtervaluea[3] == $thiscontractlocation)&&($filtervaluea[4] == $thiswo)){
            $include = "1";
        }
        if ( $include == "1" ) {
            $dmwsvisita = Get_Array('dmwsvisit',$dmwssu_id);
            $dmwstimebanda = Get_Array('dmwstimeband');
            //XH3("WORKING");
            foreach ($dmwsvisita as $dmwsvisit_id) {
                Get_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
                if (($GLOBALS{'dmwsvisit_date'} > $formattedstartdate)&&($GLOBALS{'dmwsvisit_date'} < $formattedenddate)){
                    foreach ($dmwstimebanda as $dmwstimeband_id) {
                        Get_Data('dmwstimeband',$dmwstimeband_id);
                        if ((GetTimeBandList('dmwsvisit_durationvisit',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationtel',$dmwstimeband_id) != 0)
                            ||(GetTimeBandList('dmwsvisit_durationresearch',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationtravel',$dmwstimeband_id) != 0)
                            ||(GetTimeBandList('dmwsvisit_durationfamily',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationbereavement',$dmwstimeband_id) != 0)
                            ||(GetTimeBandList('dmwsvisit_durationdeathviewing',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationstaffsupport',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationadmin',$dmwstimeband_id) != 0)){
                                if (($GLOBALS{'LOGIN_person_id'} == "knew")||($GLOBALS{'LOGIN_person_id'} == "mche")){
                                    foreach ($admissiontypeida as $fieldname){
                                        if (GetTimeBandList($fieldname,$dmwstimeband_id) != 0){
                                            XTDTXT($dmwssu_id);XTDTXT($GLOBALS{'dmwsvisit_date'});XTDTXT($dmwstimeband_id);XTDTXT($thiscontract);XTDTXT($fieldname);XTDTXT(GetTimeBandList($fieldname,$dmwstimeband_id));X_TR();
                                        }
                                    }

                                }


                        }
                    }
                }


                /*for ($i = 0; $i < 19; $i++){
                 if ($timebandstatsa[$dmwstimeband_id][$i] == null){
                 $timebandstatsa[$dmwstimeband_id][$i] = 0;
                 }
                 }*/
            }
        }

    }

    X_TBODY();
    X_TABLE();
    X_DIV("report_tablecontainer","container");



}


function Dmws_DMWSLOCATIONFIX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Dmws_DMWSLOCATIONFIX_Output ($testorreal) {
    //XH3($GLOBALS{'MPDFREPORTFILTER'});




    // Here is some code that could be adapted to read the filter parameter string syntax
    $admissiontypeida = Array("dmwsvisit_timeslot","dmwsvisit_durationvisit","dmwsvisit_durationtel","dmwsvisit_durationresearch","dmwsvisit_durationtravel","dmwsvisit_durationfamily","dmwsvisit_durationbereavement","dmwsvisit_durationdeathviewing","dmwsvisit_durationstaffsupport","dmwsvisit_durationadmin");
    $timebandnamea = Array("Time Band","SU Visit","Telephone","Research","Travel","Family","Bereavement","Death Viewing","Staff Support","Admin etc");

    //XH3($formattedstartdate." ".$formattedenddate);

    // Step 0 - colour palette
    $htc = "#FFFFFF"; // header text colour
    $hbc = "#808080"; // header background colour
    $rtc = "#000000"; // row text colour
    $rbc = "#f2f2f2"; // row background colour

    //Step 2 - gather the data from the database

    $timebandstatsa = Array();
    $relevantdmwssua = Array();
    $dmwssua = Get_Array('dmwssu');
    $opencasesa = Array();

    //XH3($dmwscontracta);
    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("SU ref");
    XTDHTXT("Name");
    XTDHTXT("Location");
    XTDHTXT("Visit Date");
    XTDHTXT("Time Band");
    XTDHTXT("Field name");
    XTDHTXT("Time");
    X_TR();
    X_THEAD();
    XTBODY();
    foreach ($dmwssua as $dmwssu_id) {
        Get_Data('dmwssu',$dmwssu_id);
        Get_Data('dmwssux',$dmwssu_id);
        $include = "0";

        // this logic needs to be replaced by identifying whether this is the welfare officers case
        /*  $dmwscontractlocationa = Get_Array('dmwscontractlocation');
         foreach ($dmwscontractlocationa as $dmwscontractlocation_id) {
         if ( $dmwscontractlocation_id == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
         Get_Data('dmwscontractlocation',$dmwscontractlocation_id);
         // XPTXT("MATCH|".$GLOBALS{'LOGIN_person_id'}.$recsep.$GLOBALS{'dmwscontractlocation_officerlist'}.$recsep);
         if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_officerlist'} ) ) { $include = "1"; }
         if ( FoundInCommaList( $GLOBALS{'LOGIN_person_id'}, $GLOBALS{'dmwscontractlocation_mgrlist'} ) ) { $include = "1"; }
         }
         }*/
        $thiscontract = $GLOBALS{'dmwssu_dmwscontractid'};
        $thiscontractlocation = $GLOBALS{'dmwssu_dmwscontractlocationid'};
        $thiswo = $GLOBALS{'dmwssu_wopersonid'};
        $formattedstartdate = "2018-08-01";
        $formattedenddate = "2018-08-31";
        $sname = $GLOBALS{'dmwssux_sname'};


        if(("MOD" == $thiscontract)&&("mboy" == $thiswo)){
            $include = "1";
        }
        if ( $include == "1" ) {
            $dmwsvisita = Get_Array('dmwsvisit',$dmwssu_id);
            $dmwstimebanda = Get_Array('dmwstimeband');
            //XH3("WORKING");
            foreach ($dmwsvisita as $dmwsvisit_id) {
                Get_Data('dmwsvisit',$dmwssu_id,$dmwsvisit_id);
                if (($GLOBALS{'dmwsvisit_date'} >= $formattedstartdate)&&($GLOBALS{'dmwsvisit_date'} <= $formattedenddate)&&(($GLOBALS{'dmwsvisit_personid'} == "mboy")||($GLOBALS{'dmwsvisit_personid'} == "Marie Boyett"))){
                    foreach ($dmwstimebanda as $dmwstimeband_id) {
                        Get_Data('dmwstimeband',$dmwstimeband_id);
                        if ((GetTimeBandList('dmwsvisit_durationvisit',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationtel',$dmwstimeband_id) != 0)
                            ||(GetTimeBandList('dmwsvisit_durationresearch',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationtravel',$dmwstimeband_id) != 0)
                            ||(GetTimeBandList('dmwsvisit_durationfamily',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationbereavement',$dmwstimeband_id) != 0)
                            ||(GetTimeBandList('dmwsvisit_durationdeathviewing',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationstaffsupport',$dmwstimeband_id) != 0)||(GetTimeBandList('dmwsvisit_durationadmin',$dmwstimeband_id) != 0)){
                                if (($GLOBALS{'LOGIN_person_id'} == "knew")||($GLOBALS{'LOGIN_person_id'} == "mche")){
                                    foreach ($admissiontypeida as $fieldname){
                                        if (GetTimeBandList($fieldname,$dmwstimeband_id) != 0){
                                            XTDTXT($dmwssu_id);XTDTXT($sname);XTDTXT($thiscontractlocation);XTDTXT($GLOBALS{'dmwsvisit_date'});XTDTXT($dmwstimeband_id);XTDTXT($fieldname);XTDTXT(GetTimeBandList($fieldname,$dmwstimeband_id));X_TR();
                                        }
                                    }

                                }


                        }
                    }
                }


                /*for ($i = 0; $i < 19; $i++){
                 if ($timebandstatsa[$dmwstimeband_id][$i] == null){
                 $timebandstatsa[$dmwstimeband_id][$i] = 0;
                 }
                 }*/
            }
        }

    }

    X_TBODY();
    X_TABLE();
    X_DIV("report_tablecontainer","container");
}




function Dmws_DMWSMANDFIELDSFIX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Dmws_DMWSMANDFIELDSFIX_Output ($testorreal) {
    XH3("DMWS Mandatory Fields fixer  - $testorreal $action");
    if ($testorreal == "Test") {
        XBR();
        $link = YPGMLINK("dmwsmandfieldsfixreal.php").YPGMSTDPARMS();
        XLINKBUTTON($link,"I'm OK with this Test. Now update the missing mandatory fields log in Real mode.");
        XBR();
    }
    $contactmandfieldsa = Array('dmwsvisit_durationvisit','dmwsvisit_durationtel','dmwsvisit_durationresearch','dmwsvisit_durationresearch','dmwsvisit_durationtravel','dmwsvisit_durationfamily','dmwsvisit_durationbereavement','dmwsvisit_durationdeathviewing','dmwsvisit_durationstaffsupport','dmwsvisit_durationadmin');
    $mandfieldsa = Array('dmwssu_dmwscontractid','dmwssu_dmwscontractlocationid','dmwssu_dmwstitleid','dmwssux_fname','dmwssux_sname','dmwssu_dmwsserviceid','dmwssu_dmwsuservicestatusid','dmwssu_referraldate','dmwssu_referraltime','dmwssu_referrername',
        'dmwssu_referrerorg','dmwssu_referrertel','dmwssu_referralorgtypeid','dmwssu_dmwslocation','dmwssu_referralrecdby','dmwssu_dmwssupporttypeid','dmwssu_dmwslocationtypeid','dmwssu_locationname','dmwssu_locationsite','dmwssu_locationcontact',
        'dmwssu_locationtel','dmwssu_dmwsadmissionreasonid','dmwssu_dmwsadmissiontypeid','dmwssu_dmwsadmissiondate','dmwssu_woname','dmwssu_initialvisitdate','dmwssu_initialvisittime','dmwssu_safeguarding','dmwssu_dmwssafeguardeetypeid','followup_dmwssu_familysupportedO18','followup_dmwssu_familysupportedU18','followup_dmwssu_staffsupported','followup_dmwssu_medicalapptsattended',
        'followup_dmwssu_medicalapptsmissed','followup_dmwssu_timeoffworkexpected','followup_dmwssu_timeoffworkactual','followup_dmwssu_losexpected','followup_dmwssu_losactual',    'followup_dmwssu_primarycarelist','followup_dmwssu_secondarycarelist','followup_dmwssu_independentlivinglist','followup_dmwssu_socialisolationlist','followup_dmwssu_employmentlist','dmwsreferrerupdate_date','dmwsreferrerupdate_woname','dmwsreferrerupdate_dmwsreferrerorgtypeid','dmwsreferrerupdate_contactref','dmwsreferrerupdate_statusupdate',
        'dmwsreferrerupdate_response','dmwsreferral_date','dmwsreferral_time','dmwsreferral_dmwsreferralorgid','dmwsreferral_dmwsspecialistreferralorgid','dmwsreferral_orgname','dmwsreferral_roleintervention');
    $mandfieldsremainingnamesa['dmwssux_fname'] = "SU First Name";
    $mandfieldsremainingnamesa['dmwssux_sname'] = "SU Last Name";
    $mandfieldsremainingnamesa['dmwssu_referraldate'] = "SU Referral Date";
    $mandfieldsremainingnamesa['dmwssu_referraltime'] = "SU Referral Time";
    $mandfieldsremainingnamesa['dmwssu_referrername'] = "SU Referrer Name";
    $mandfieldsremainingnamesa['dmwssu_referrerorg'] = "SU Referrer Org";
    $mandfieldsremainingnamesa['dmwssu_referrertel'] = "SU Referrer Tel";
    $mandfieldsremainingnamesa['dmwssu_referralrecdby'] = "SU Referral Recieved By";
    $mandfieldsremainingnamesa['dmwssu_dmwslocation'] = "DMWS Location";
    $mandfieldsremainingnamesa['dmwssu_dmwslocationtypeid'] = "Medical Location";
    $mandfieldsremainingnamesa['dmwssu_locationname'] = "Location Name";
    $mandfieldsremainingnamesa['dmwssu_locationsite'] = "Location Site";
    $mandfieldsremainingnamesa['dmwssu_locationcontact'] = "Location Contact";
    $mandfieldsremainingnamesa['dmwssu_locationtel'] = "Location Tel";
    $mandfieldsremainingnamesa['dmwssu_dmwsadmissiondate'] = "SU Admission Date";
    $mandfieldsremainingnamesa['dmwssu_woname'] = "WO Name";
    $mandfieldsremainingnamesa['dmwssu_initialvisitdate'] = "Initial Visit Date";
    $mandfieldsremainingnamesa['dmwssu_initialvisittime'] = "Initial Visit Time";
    $mandfieldsremainingnamesa['dmwssu_safeguarding'] = "Safeguarding RAG Status";
    $mandfieldsremainingnamesa['dmwssu_dmwssafeguardeetypeid'] = "Safeguarding Apples To";
    $mandfieldsremainingnamesa['dmwssu_referralorgtypeid'] = "Referrer Org Type";
    $mandfieldsremainingnamesa['dmwssu_dmwscontractid'] = "Contract";
    $mandfieldsremainingnamesa['dmwssu_dmwscontractlocationid'] = "Location";
    $mandfieldsremainingnamesa['dmwssu_dmwssupporttypeid'] = "SU Support Type";
    $mandfieldsremainingnamesa['dmwssu_dmwstitleid'] = "SU Title";
    $mandfieldsremainingnamesa['dmwssu_dmwsserviceid'] = "SU Service Type";
    $mandfieldsremainingnamesa['dmwssu_dmwsuservicestatusid'] = "SU Service Status";
    $mandfieldsremainingnamesa['dmwssu_dmwsadmissionreasonid'] = "SU Admission Reason";
    $mandfieldsremainingnamesa['dmwssu_dmwsadmissiontypeid'] = "SU Admission Type";
    //======== Mandatory on Follow Up ==================
    $mandfieldsremainingnamesa['followup_dmwssu_familysupportedO18'] = "SU Family Over 18 Supported";
    $mandfieldsremainingnamesa['followup_dmwssu_familysupportedU18'] = "SU Family Under 18 Supported";
    $mandfieldsremainingnamesa['followup_dmwssu_staffsupported'] = "Staff/Others Supported";
    $mandfieldsremainingnamesa['followup_dmwssu_medicalapptsattended'] = "Medical Appointments Attended";
    $mandfieldsremainingnamesa['followup_dmwssu_medicalapptsmissed'] = "Medical Appointments Missed";
    $mandfieldsremainingnamesa['followup_dmwssu_timeoffworkexpected'] = "Time Off Work Expected";
    $mandfieldsremainingnamesa['followup_dmwssu_timeoffworkactual'] = "Time Off Work Actual";
    $mandfieldsremainingnamesa['followup_dmwssu_losexpected'] = "Length Of Stay Expected";
    $mandfieldsremainingnamesa['followup_dmwssu_losactual'] = "Length Of Stay Actual";
    $mandfieldsremainingnamesa['followup_dmwssu_primarycarelist'] = "Primary Care";
    $mandfieldsremainingnamesa['followup_dmwssu_secondarycarelist'] = "Secondary Care";
    $mandfieldsremainingnamesa['followup_dmwssu_independentlivinglist'] = "Independent Living";
    $mandfieldsremainingnamesa['followup_dmwssu_socialisolationlist'] = "Social Isolation";
    $mandfieldsremainingnamesa['followup_dmwssu_employmentlist'] = "Employment";
    //==================================================
    $mandfieldsremainingnamesa['dmwsreferrerupdate_woname'] = "Referrer Update WO";
    $mandfieldsremainingnamesa['dmwsreferrerupdate_dmwsreferrerorgtypeid'] = "Referrer Org";
    $mandfieldsremainingnamesa['dmwsreferrerupdate_contactref'] = "Referrer Contact Details";
    $mandfieldsremainingnamesa['dmwsreferrerupdate_statusupdate'] = "Referrer Update";
    $mandfieldsremainingnamesa['dmwsreferrerupdate_response'] = "Referrer Update Response";
    $mandfieldsremainingnamesa['dmwsreferrerupdate_date'] = "Referrer Update Date";
    $mandfieldsremainingnamesa['dmwsreferral_date'] = "Referral Date";
    $mandfieldsremainingnamesa['dmwsreferral_time'] = "Referral Time";
    $mandfieldsremainingnamesa['dmwsreferral_dmwsreferralorgid'] = "Referral Support Type";
    $mandfieldsremainingnamesa['dmwsreferral_dmwsspecialistreferralorgid'] = "Referral Org";
    $mandfieldsremainingnamesa['dmwsreferral_orgname'] = "Referral Organisation Name";
    $mandfieldsremainingnamesa['dmwsreferral_roleintervention'] = "Contact Details, Role & Intervention";
    $dmwssua = Get_Array('dmwssu');

    XTABLEJQDTID("reporttable_locationlist");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("SU Id");
    XTDHTXT("List");
    X_TR();
    X_THEAD();
    XTBODY();
    $dmwstimebanda = Get_Array('dmwstimeband');
    foreach ($dmwssua as $dmwssu_id) {
        $lastvisit_id = "";
        $timebandsa = Array();
        $nullsglist = "0";
        $fucounter = "0";
        $incompletevisitcounter = 0;
        Get_Data('dmwssu',$dmwssu_id);
        Get_Data('dmwssux',$dmwssu_id);
        //XH3($GLOBALS{'dmwssu_mandfieldsremaininglist'});
        $incompletefieldsa[$dmwssu_id] = Array();
        foreach ($dmwstimebanda as $dmwstimeband_id) {
            Get_Data('dmwstimeband',$dmwstimeband_id);
            if ($GLOBALS{'dmwstimeband_dmwscontractid'} == $GLOBALS{'dmwssu_dmwscontractid'} && $GLOBALS{'dmwstimeband_dmwscontractlocationid'} == $GLOBALS{'dmwssu_dmwscontractlocationid'}) {
                array_push($timebandsa,$dmwstimeband_id);
            }
        }
        if (sizeof($timebandsa) == "0"){
            foreach ($dmwstimebanda as $dmwstimeband_id) {
                Get_Data('dmwstimeband',$dmwstimeband_id);
                if ($GLOBALS{'dmwstimeband_dmwscontractid'} == "Default"){
                    array_push($timebandsa,$dmwstimeband_id);
                }
            }
        }
        $suvisita = Get_Array('dmwsvisit',$dmwssu_id);
        $lastvisit_id = end($suvisita);
        foreach ($suvisita as $visit_id){
            Get_Data('dmwsvisit',$dmwssu_id,$visit_id);
            foreach ($timebandsa as $dmwstimeband_id){
                foreach ($contactmandfieldsa as $field){
                    if (GetTimeBandList($field,$dmwstimeband_id) != 0){
                        $contcounter = "1"; // <---- was '=='
                        break 2;
                    }
                }
            }

            if ($contcounter == "0"){
                $incompletevisitcounter++;
            }

            $contcounter = "0"; // <---- was '=='

        }
        if ($incompletevisitcounter != 0){
            if ($incompletevisitcounter == 1){
                array_push($incompletefieldsa[$dmwssu_id],"Contact Log");
            }
            else{array_push($incompletefieldsa[$dmwssu_id],"Contact Log X".$incompletevisitcounter);}

        }
        //XH3($dmwssu_id." ----- ".$GLOBALS{'dmwssu_dmwsadmissionreasonid'});
        $dmwsreferrerupdatea = Get_Array('dmwsreferrerupdate',$dmwssu_id);
        $dmwsreferrala = Get_Array('dmwsreferral',$dmwssu_id);

        if ($GLOBALS{'dmwssu_dmwssafeguardingissuelist'} == null){
            $nullsglist = "1";
        }

        foreach ($mandfieldsa as $fieldname){
            $fielda = explode("_",$fieldname);
            if (($nullsglist == "1")&&(($fieldname == "dmwssu_safeguarding")||($fieldname == "dmwssu_dmwssafeguardeetypeid"))){
                continue;
            }

            if ($fielda[0] == "dmwsreferrerupdate"){
                foreach ($dmwsreferrerupdatea as $dmwsreferrerupdate_id) {
                    Get_Data('dmwsreferrerupdate',$dmwssu_id,$dmwsreferrerupdate_id);
                    if ($fielda[0] == "dmwsreferrerupdate"){
                        //XH3($dmwssu_id." --- ".$fieldname." ----- ".$GLOBALS{$fieldname});
                        if (strlen(strstr($fielda[1],"date")) > 0){
                            if ($GLOBALS{$fieldname} == "0000-00-00"){
                                array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                            }
                        }
                        elseif (strlen(strstr($fieldname,"typeid")) > 0){
                            if (($GLOBALS{$fieldname} == "?")||($GLOBALS{$fieldname} == "")||($GLOBALS{$fieldname} == null)){
                                array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                            }
                        }
                        elseif (($GLOBALS{$fieldname} == null)||($GLOBALS{$fieldname} == "")){
                            array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                        }
                    }
                }
            }


            elseif ($fielda[0] == "dmwsreferral"){
                foreach ($dmwsreferrala as $dmwsreferral_id) {
                    Get_Data('dmwsreferral',$dmwssu_id,$dmwsreferral_id);
                    //XH3($dmwssu_id." --- ".$fieldname." ----- ".$GLOBALS{$fieldname});
                    if (strlen(strstr($fieldname,"date")) > 0){
                        if ($GLOBALS{$fieldname} == "0000-00-00"){
                            array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                        }
                    }
                    elseif (strlen(strstr($fieldname,"id")) > 0){
                        if (($GLOBALS{$fieldname} == "?")||($GLOBALS{$fieldname} == "")||($GLOBALS{$fieldname} == null)){
                            array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                        }
                    }
                    elseif (($GLOBALS{$fieldname} == null)||($GLOBALS{$fieldname} == "")){
                        array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                    }
                }
            }

            elseif (($fielda[0] == "followup")){
                if ($lastvisit_id != ""){
                Get_Data('dmwsvisit',$dmwssu_id,$lastvisit_id);
                //XH3($dmwssu_id." -- ".$GLOBALS{'dmwsvisit_type'});
                    if ($GLOBALS{'dmwsvisit_type'} == "FollowUp"){
                        $fieldname2 = $fielda[1]."_".$fielda[2];
                        //XH3($dmwssu_id." -- ".$fieldname." -- ".$GLOBALS{$fieldname});
                        if (($GLOBALS{$fieldname2} == null)||($GLOBALS{$fieldname2} == "")){
                            array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                        }
                    }
                }
            }


            else{
                if (strlen(strstr($fieldname,"date")) > 0){
                    if ($GLOBALS{$fieldname} == "0000-00-00"){
                        array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                    }
                }

                elseif (($GLOBALS{$fieldname} == null)||($GLOBALS{$fieldname} == "")){
                    array_push($incompletefieldsa[$dmwssu_id],$mandfieldsremainingnamesa[$fieldname]);
                }
            }

        }
        $list = implode(", ",$incompletefieldsa[$dmwssu_id]);
        if ($list != null){
            $action = "";
            if ( $testorreal == "Real" ) {
                $GLOBALS{'dmwssu_mandfieldsremaininglist'} = $list;
                Write_Data('dmwssu',$dmwssu_id);
                $action = "<b>Updated";
            }
            XTRJQDT();
            XTDTXT($dmwssu_id);XTDTXT($list." ".$action);
            //print_r($incompletefieldsa);
            $list = "";

            X_TR();
        }
    }

    X_TBODY();
    X_TABLE();
}

function Dmws_DMWSCOMPLEXITYUTILITY_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Dmws_DMWSCOMPLEXITYUTILITY_Output ($testorreal) {
    if ($testorreal == "Test") {
        XBR();
        $link = YPGMLINK("dmwscomplexityutilityreal.php").YPGMSTDPARMS();
        XLINKBUTTON($link,"I'm OK with this Test. Now update the scores in Real mode.");
        XBR();
    }
    $dmwssua = Get_Array('dmwssu');
    XTABLEJQDTID("reporttable_scorelist");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("SU Id");
    XTDHTXT("Initial No");
    XTDHTXT("Final No");
    X_TR();
    X_THEAD();
    XTBODY();
    foreach ($dmwssua as $dmwssu_id) {
        Get_Data('dmwssu',$dmwssu_id);
        Get_Data('dmwssux',$dmwssu_id);
        $nokno = $GLOBALS{'dmwssu_nokcontacttel'};
        $firstchar = substr($nokno,0,1);
        $secondchar = substr($nokno,1,2);
        if (($firstchar != "0")&&(is_numeric($secondchar))){
            $newno = "0".$nokno;
            XTRJQDT();XTDTXT($dmwssu_id);XTDTXT("<font color=red>$nokno</font>");XTDTXT("<font color=green>$newno</font>");X_TR();

            if ( $testorreal == "Real" ) {
                $nokno = $GLOBALS{'dmwssu_nokcontacttel'} = $newno;
                Write_Data('dmwssu',$dmwssu_id);
            }
        }
    }


    X_TBODY();
    X_TABLE();
}

function Dmws_DMWSWELLBEINGFIX_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Dmws_DMWSWELLBEINGFIX_Output ($testorreal) {
    XH3("Wellbeing Data Reset - ".$testorreal);
    if ($testorreal == "Test") {
        XBR();
        $link = YPGMLINK("dmwswellbeingfixreal.php").YPGMSTDPARMS();
        XLINKBUTTON($link,"I'm OK with this Test. Now update the wellbeing data in Real mode.");
        XBR();
    }
    $dmwssua = Get_Array('dmwssu');
    XTABLEJQDTID("reporttable_scorelist");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("SU Id");
    XTDHTXT("Visit Id");
    XTDHTXT("Action");
    X_TR();
    X_THEAD();
    XTBODY();
    foreach ($dmwssua as $dmwssu_id) {
        Get_Data('dmwssu',$dmwssu_id);
        Get_Data('dmwssux',$dmwssu_id);
        $dmwswellbeinga = Get_Array('dmwswellbeing',$dmwssu_id);
        $initialwellbeingscore = 0;
        $finalwellbeingscore = 0;
        $first = "1";
        foreach ($dmwswellbeinga as $dmwswellbeing_dmwsvisitid) {
            Get_Data('dmwswellbeing',$dmwssu_id,$dmwswellbeing_dmwsvisitid);
            $bigsum = 0;
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qoptimistic'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_quseful'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qrelaxed'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qinterestedinothers'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qenergy'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qproblemmanagement'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qthinkingclearly'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qgoodaboutme'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qclosetoothers'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qconfident'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qmakeupmind'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qloved'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qinterestedinnew'};
            $bigsum = $bigsum + $GLOBALS{'dmwswellbeing_qcheerful'};
            if (($bigsum == 0)&&($GLOBALS{'dmwswellbeing_score'} == 0)) {
                XTRJQDT();
                XTDTXT($dmwssu_id);
                XTDTXT($dmwswellbeing_dmwsvisitid);
                if ($testorreal == "Real") {
                    Delete_Data('dmwswellbeing',$dmwssu_id,$dmwswellbeing_dmwsvisitid);
                    XTDTXT("Empty wellbeing record deleted");
                } else {
                    XTDTXT("Empty wellbeing record would be deleted");
                }
                X_TR();
            } else {
                if ($bigsum != $GLOBALS{'dmwswellbeing_score'}) {
                    XTRJQDT();
                    XTDTXT($dmwssu_id);
                    XTDTXT($dmwswellbeing_dmwsvisitid);
                    if ($testorreal == "Real") {
                        $GLOBALS{'dmwswellbeing_score'} = $bigsum;
                        Write_Data('dmwswellbeing',$dmwssu_id,$dmwswellbeing_dmwsvisitid);
                        XTDTXT("Error in Wellbeing Record Summary Field - ".$bigsum." vs ".$GLOBALS{'dmwswellbeing_score'}." - Corrected");
                    } else {
                        XTDTXT("Error in Wellbeing Record Summary Field - ".$bigsum." vs ".$GLOBALS{'dmwswellbeing_score'}." - Would be Corrected");
                    }
                    X_TR();
                }
                if ($bigsum != 0) {
                    if ($first == "1") {
                        $first = "0";
                        $initialwellbeingscore = $bigsum;
                    } else {
                        $finalwellbeingscore = $bigsum;
                    }
                }
            }
        }
        // ======== Now check that the correct summary information is stored in the dmwssu record. ====

        if (($initialwellbeingscore != $GLOBALS{'dmwssu_initialwellbeingscore'})||($finalwellbeingscore != $GLOBALS{'dmwssu_finalwellbeingscore'})) {
            XTRJQDT();
            XTDTXT($dmwssu_id);
            XTDTXT($dmwswellbeing_dmwsvisitid);
            if ($testorreal == "Real") {
                $GLOBALS{'dmwssu_initialwellbeingscore'} = $initialwellbeingscore;
                $GLOBALS{'dmwssu_finalwellbeingscore'} = $finalwellbeingscore;
                Write_Data('dmwssu',$dmwssu_id);
                XTDTXT("Error in SU Record Summary Fields - ".$initialwellbeingscore."|".$finalwellbeingscore." vs ".$GLOBALS{'dmwssu_initialwellbeingscore'}."|".$GLOBALS{'dmwssu_finalwellbeingscore'}." - Corrected");
            } else {
                XTDTXT("Error in SU Record Summary Fields - ".$initialwellbeingscore."|".$finalwellbeingscore." vs ".$GLOBALS{'dmwssu_initialwellbeingscore'}."|".$GLOBALS{'dmwssu_finalwellbeingscore'}." - Would be Corrected");
            }
            X_TR();
        }


    }
    X_TBODY();
    X_TABLE();
}
?>
