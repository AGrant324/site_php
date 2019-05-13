<?php

require_once "v1_globalroutines.php";
require_once "v1_ioroutines.php";   
require_once "v1_libraryroutines.php";

Get_Common_Parameters();
GlobalRoutine();
Library_ACCREDEVIDENCEMAINTAIN_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();

Back_Navigator();

// print_r($_REQUEST);
// print_r($_FILES);

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$inaccredscheme_id = $_REQUEST['accredscheme_id'];
$inaccredcriteria_clubid = $_REQUEST['accredcriteria_clubid'];
$inaccredcriteria_id = $_REQUEST['accredcriteria_id'];
$inaccredupdate = $_REQUEST['AccredUpdate'];
$inevidenceseq = $_REQUEST['EvidenceSeq'];
$inevidenceasset_code = $_REQUEST['EvidenceAssetCode'];
$insubmitaction = $_REQUEST['SubmitAction'];
$currenttab = $_REQUEST['CurrentTab'];
$inaccredcriteria_selfassessment = $_REQUEST['accredcriteria_selfassessment'];
$inaccredcriteria_selfevaluation = $_REQUEST['accredcriteria_selfevaluation'];
$inaccredcriteria_owner = $_REQUEST['accredcriteria_owner'];
$inaccredcriteria_evidencetext = $_REQUEST['accredcriteria_evidencetext'];
$inaccredcriteria_evidenceimagelist = $_REQUEST['accredcriteria_evidenceimagelist_imagename'];
if(isset($_REQUEST['accredcriteria_dataradioresult'])) {$inaccred_radioresult = $_REQUEST["accredcriteria_dataradioresult"];} else {$inaccred_radioresult ="";}
if(isset($_REQUEST['accredcriteria_datacheckboxresult'])) { 
    $vstring = ""; $vsep = "";
    foreach ( $_REQUEST['accredcriteria_datacheckboxresult'] as $key => $value ) {
        $vstring = $vstring.$vsep.$value;
        $vsep = ",";
    }
    $inaccred_checkboxresult = $vstring;
} 
else { $inaccred_checkboxresult =""; }
$inaccredcriteria_reviewcomments = $_REQUEST['accredcriteria_reviewcomments'];
$inasset_librarysection = $_REQUEST['asset_librarysection'];
$inasset_title = $_REQUEST["asset_title"];
$inasset_description = $_REQUEST["asset_desription"];
$inasset_link = $_REQUEST["asset_link"];
$inasset_author = $_REQUEST["asset_author"];
$inasset_createdate = $_REQUEST['asset_createdate_YYYYpart'].$_REQUEST['asset_createdate_MMpart'].$_REQUEST['asset_createdate_DDpart'];  
$inasset_reviewdate = $_REQUEST['asset_reviewdate_YYYYpart'].$_REQUEST['asset_reviewdate_MMpart'].$_REQUEST['asset_reviewdate_DDpart'];
$inasset_submitter = $_REQUEST["asset_submitter"];
$inasset_security = $_REQUEST["asset_security"];
/*
print("accredscheme_id $inaccredscheme_id\n");XBR();
print("accredcriteria_id $inaccredcriteria_id\n");XBR();
print("accredcriteria_clubid $inaccredcriteria_clubid\n");XBR();
print("accredupdate $inaccredupdate\n");XBR();
print("evidenceseq $inevidenceseq\n");XBR();
print("evidenceasset_code $inevidenceasset_code\n");XBR();
print("submitaction $insubmitaction\n");XBR();
print("accredcriteria_owner $inaccredcriteria_owner\n");XBR();
print("accredlibrarysection $inasset_librarysection\n");XBR();
print("inevidenceasset_code $inevidenceasset_code\n");XBR();
*/ 

// a_01       section
// a_01_09    criteria
// a_01_09_e01 evidence
// a_01_09_e01_i01 data
// a_01_09_01_e02 evidence
// a_01_09_01_e02_i01 data
$abits = explode("_",$inaccredcriteria_id); // evidence id
if ( count($abits) == 4 ) {
    $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2];
    $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
} else { // count = 5
    $criteriaid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3];
    $evidenceid = $abits[0]."_".$abits[1]."_".$abits[2]."_".$abits[3]."_".$abits[4];
}

if ($inaccredupdate == "Owner") {
	 Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
	 $GLOBALS{'accredcriteria_owner'} = $inaccredcriteria_owner;
	 Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
	 Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,"");
}
if ($inaccredupdate == "Response") {
    //==== main response ========================
    Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
    $GLOBALS{'accredcriteria_selfassessment'} = $inaccredcriteria_selfassessment;
    $GLOBALS{'accredcriteria_selfevaluation'} = $inaccredcriteria_selfevaluation;
    $GLOBALS{'accredcriteria_evidencetext'} = $inaccredcriteria_evidencetext;
    Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);

    //==== data ========================
    $its = 0;
    $more = "1"; $di = 1;
    while (($more == "1" )&&($its < 99)) {
        $its++;
        $distring = substr("00".$di,-2);
        $dataid = $evidenceid."_i".$distring;
        Check_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$dataid);
        // XPTXTCOLOR($dataid,"red");
        if ($GLOBALS{'IOWARNING'} == "0" ) {
            // accredcriteria_datatextquestion Q1text
            // accredcriteria_datatextresult Q1text
            // accredcriteria_datacheckboxquestions Q1val=Q1Text,Q2val=Q2text,Q3val=Q3text
            // accredcriteria_datacheckboxresult Q1val,Q3val
            // accredcriteria_dataradioquestions Q1val=Q1Text,Q2val=Q2text,Q3val=Q3text
            // accredcriteria_datacheckboxresult Q2val
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
                $GLOBALS{'accredcriteria_datatextresult'} = $_REQUEST["accredcriteria_datatextresult_".$dataid];  
            }
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
                $GLOBALS{'accredcriteria_dataradioresult'} = $_REQUEST["accredcriteria_dataradioresult_".$dataid];  
            }
            if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
                $vstring = ""; $vsep = "";
                foreach ($_REQUEST["accredcriteria_datacheckboxresult_".$dataid] as $value) {
                    # XPTXT($value);
                    $vstring = $vstring.$vsep.$value;
                    $vsep = ",";
                }
                $GLOBALS{'accredcriteria_datacheckboxresult'} = $vstring;            
            }
            Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$dataid); 
            
            
            if ( $GLOBALS{'accredcriteria_datafieldname'} != "") {
                // Save data in defined datafield name                
                $dbits = explode('_',$GLOBALS{'accredcriteria_datafieldname'});
                // XPTXT($dbits[0]." ".$inaccredcriteria_clubid);
                Check_Data($dbits[0],$inaccredcriteria_clubid);
                if ($GLOBALS{'IOWARNING'} == "0" ) {
                    $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = "";
                    if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Text" ) {
                        $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = $GLOBALS{'accredcriteria_datatextresult'};
                    }
                    if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Radio" ) {
                        $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = $GLOBALS{'accredcriteria_dataradioresult'};
                    }
                    if ( $GLOBALS{'accredcriteria_dataquestiontype'} == "Checkbox" ) {
                        $GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}} = $GLOBALS{'accredcriteria_datacheckboxresult'};           
                    }
                    XPTXTCOLOR("datafieldname ".$GLOBALS{'accredcriteria_datafieldname'}." updated - value ".$GLOBALS{$GLOBALS{'accredcriteria_datafieldname'}},"green"); 
                    Write_Data($dbits[0],$inaccredcriteria_clubid); 
                } else {
                    XPTXTCOLOR("datafieldname ".$GLOBALS{'accredcriteria_datafieldname'}." not recognised","red");
                }
            }           
            $di++;
         } else {
             $more = "0";
         }
     }
     
     // Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,"");	 
     Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Maintain",$currenttab);	 	 
}

if ($inaccredupdate == "EvidenceAsset") {
    $accredmaintainerrormsg = "";
    if (($inasset_librarysection == "")&&($insubmitaction != "Delete Link to Document")) { $accredmaintainerrormsg = "Error:- No library section identified"; }
    if ($accredmaintainerrormsg != "") {
        Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,$accredmaintainerrormsg);
    } else {
        if ($insubmitaction == "Delete Link to Document") {
            Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
            $GLOBALS{'accredcriteria_evidenceassetcodes'} = Evidence_Codes_Update($GLOBALS{'accredcriteria_evidenceassetcodes'},"D",$inevidenceasset_code,$inevidenceseq);
            Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
            XPTXTCOLOR($GLOBALS{'asset_title'}." removed","green");
            // Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,$accredmaintainerrormsg);
            Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Maintain",$currenttab);
        }
        if ($insubmitaction == "Add Link to Document") {
            Library_ACCREDLIBRARYLINKER_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,"Add","Add",$inasset_librarysection);
        }
        if ($insubmitaction == "Update Link to Document") {
            Library_ACCREDLIBRARYLINKER_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,$inevidenceseq,$inevidenceasset_code,$inasset_librarysection);
        }
        if ($insubmitaction == "LibraryLinked") {
            Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
            if ($inevidenceseq == "Add") {$acdtxt = "A";} else {$acdtxt = "C";}
            $GLOBALS{'accredcriteria_evidenceassetcodes'} = Evidence_Codes_Update($GLOBALS{'accredcriteria_evidenceassetcodes'},$acdtxt,$inevidenceasset_code,$inevidenceseq);
            Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
            // Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,$accredmaintainerrormsg);
            Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Maintain",$currenttab);
        }
        if ($insubmitaction == "LibraryAdded") {
            Initialise_Data("asset");
            $asset_code = $GLOBALS{'currenttimestampunique'};
            $GLOBALS{'asset_title'} = $inasset_title;
            $GLOBALS{'asset_description'} = $inasset_description;
            $GLOBALS{'asset_librarysection'} = $inasset_librarysection;
            $uploaderrorfound = "0";
            if ($inasset_link == "") {
                $fileuploadpath = $GLOBALS{'site_filepath'}.'/'.$GLOBALS{'LOGIN_domain_id'}.'/assets';
                $maxfilesize = "30000000";
                $prefix = $inaccredcriteria_clubid."_".$inaccredcriteria_id."_";              
                # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix $maxwidth - returns string - Error(1/0)|Message|filename|filesize|width|height
                $uploadstring = Upload_File("asset_file",$fileuploadpath,"","all",$maxfilesize,"","",$prefix,"");
                $uploadstringa = explode("|",$uploadstring);
                $uploadfilename = $uploadstringa[2];
                if ($uploadstringa[0] == "1") {
                    XPTXTCOLOR("Error:- File not uploaded. - ".$uploadstring,"red");
                    $uploaderrorfound = "1";
                } else {
                    $GLOBALS{'asset_file'} = $uploadfilename;
                }
            } else {
                $GLOBALS{'asset_link'} = $inasset_link;
            }
            if ( $uploaderrorfound == "0" ) {
                $GLOBALS{'asset_author'} = $inasset_author;
                $GLOBALS{'asset_submitter'} = $inasset_submitter;
                $GLOBALS{'asset_security'} = $inasset_security;
                $GLOBALS{'asset_submitter'} = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
                $GLOBALS{'asset_createdate'} = substr($inasset_createdate,2,6);
                $GLOBALS{'asset_reviewdate'} = substr($inasset_reviewdate,2,6);
                Write_Data("asset",$inaccredcriteria_clubid,$asset_code);
                // XPTXTCOLOR($GLOBALS{'asset_title'}." uploaded","green"); // done by UploadFile
                Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
                if ($inevidenceseq == "Add") {$acdtxt = "A";} else {$acdtxt = "C";}
                $GLOBALS{'accredcriteria_evidenceassetcodes'} = Evidence_Codes_Update($GLOBALS{'accredcriteria_evidenceassetcodes'},$acdtxt,$asset_code,$inevidenceseq);
                Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
            }
            // Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,$accredmaintainerrormsg);
            Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Maintain",$currenttab);
        }
    }
}

if ($inaccredupdate == "EvidenceImage") {
    Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
    if ($GLOBALS{'accredcriteria_evidenceimagelist'} == "") { $existingimagelista = Array(); }
    else { $existingimagelista = explode(',',$GLOBALS{'accredcriteria_evidenceimagelist'}); }

    if ($insubmitaction == "Upload Image") {
        if ($inevidenceseq == "Add") {
            $thisimage = $_REQUEST['EvidenceImageNew_imagename'];
            $newimage = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media","",$thisimage);
            array_push($existingimagelista,$newimage);
        } else {
            $thisimage = $_REQUEST['EvidenceImage'.$inevidenceseq.'_imagename'];
            $changedimage = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$existingimagelista[$inevidenceseq],$thisimage);
            $existingimagelista[$inevidenceseq] = $changedimage;
        }
    }
    if ($insubmitaction == "Delete Image") {
        unset($existingimagelista[$inevidenceseq]);
    }
    $GLOBALS{'accredcriteria_evidenceimagelist'} = Array2List($existingimagelista);
    Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
    // Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,$accredmaintainerrormsg);
    Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Maintain",$currenttab);
}


if ($inaccredupdate == "Comments") {
    Get_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
    $GLOBALS{'accredcriteria_reviewcomments'} = $inaccredcriteria_reviewcomments;
    Write_Data("accredcriteria",$inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id);
    // Library_ACCREDEVIDENCEMAINTAIN_Output($inaccredscheme_id,$inaccredcriteria_clubid,$inaccredcriteria_id,"");
    Library_ACCREDVIEWLIST_Output ($inaccredscheme_id,$inaccredcriteria_clubid,"Maintain",$currenttab);
}
Back_Navigator();
PageFooter("Default","Final");

function Evidence_Codes_Update($inaccred_evidenceasset_codes,$tacd,$tevidenceasset_code,$tevidenceseq) {
	# accred_evidenceasset_codes, acd, evidenceasset_code, evidenceseq
	// XH2($inaccred_evidenceasset_codes."-".$tacd."-".$tevidenceasset_code."-".$tevidenceseq);
	// XH2("IN |".$inaccred_evidenceasset_codes."|");
	$tevidenceasset_codesa = explode (',', $inaccred_evidenceasset_codes); 
	if ($tacd == "A") { array_push ($tevidenceasset_codesa, $tevidenceasset_code); }	
	if ($tacd == "C") { $tevidenceasset_codesa[$tevidenceseq] = $tevidenceasset_code; }	
	if ($tacd == "D") { $tevidenceasset_codesa[$tevidenceseq] = ""; }	
	$outaccred_evidenceasset_codes = ""; $sep = "";
	foreach ( $tevidenceasset_codesa as $evidenceasset_code ) {
		if ($evidenceasset_code != "") {$outaccred_evidenceasset_codes = $outaccred_evidenceasset_codes.$sep.$evidenceasset_code; $sep = ",";}
	}
	// XH2("OUT |".$outaccred_evidenceasset_codes."|");	
	return $outaccred_evidenceasset_codes;  
}

