<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');

// print_r($_FILES);

Get_Common_Parameters();
GlobalRoutine();
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,jqdatatablesfixedcolumnsmin,uploadreport";
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();
$testorreal = $_REQUEST["TestorReal"];
$firstorconfirm = $_REQUEST["FirstOrConfirm"];
if ( isset($_REQUEST['LastFileTimeStamp']) ) { $inlastfiletimestamp = $_REQUEST["LastFileTimeStamp"]; } else { $inlastfiletimestamp = ""; }

if ($testorreal == "R") {$modetext = "Real Mode";} else {$modetext = "Test Mode";}
print '<h2>Data Upload - "'.$modetext.'"</h2>'."\n";

if ( $firstorconfirm == "First" ) {
    $maxfilesize = "10000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"dataupload.csv","csv",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
} else {   
    $lastfiletimestamp = date ("ymdHis", filemtime($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv"));
    // XPTXT($inlastfiletimestamp." ".$lastfiletimestamp);
    if ( $inlastfiletimestamp == $lastfiletimestamp) {
        $uploaderrorcode = "0";        
    } else {
        $uploadmessage = "Cannot find uploaded file. Please re-load from previous step.";
        $uploaderrorcode = "1";
    }
}

if ($uploaderrorcode == "0") { 
    if ( ($firstorconfirm == "First" )&&($testorreal == "T") ) {
        $lastfiletimestamp = date ("ymdHis", filemtime($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv"));
        XHR();
        $link = YPGMLINK("sfmteamdivisionuploadin.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("TestorReal","R");
        $link = $link.YPGMPARM("FirstOrConfirm","Confirm");
        $link = $link.YPGMPARM("LastFileTimeStamp",$lastfiletimestamp);
        XLINKBUTTON($link,"I'm OK with this Test. Now process the data upload in Real mode.");
        XBR();XBR();
        XLINKBACKBUTTON("Cancel.");
        XBR();
        XHR();
    }
    Upload_TeamDivision_Data($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv",$testorreal);

} else {
	XPTXT($uploadmessage,"red");
}

if ($testorreal == "R") {
    SFM_SFMDATALISTSUPDATE_Output ();
}   

Back_Navigator();
PageFooter("Default","Final");



function Upload_TeamDivision_Data ($fullfilename,$testorreal) {
    // 0DATAHEADER  1TABLE  2team id  3team name  4club id  5existing division id  6new division id
    XDIV("reportdiv_".$uploadtable,"container");
    XTABLEJQDTID("reporttable_".$uploadtable);
    XTHEAD();
    XTRJQDT();
    XTDHTXT(""); 
    XTDHTXT("");     
    XTDHTXT("Table");
    XTDHTXT("Team Id");
    XTDHTXT("Division Id");
    XTDHTXT("Action");				    				    
    X_TR();
    X_THEAD();
    XTBODY();
    $seq = 0;
    if (($handle = fopen($fullfilename, "r")) !== FALSE) {
        while (($uploadcsv = fgetcsv($handle, 0, ",")) !== FALSE) {	
            if ($uploadcsv[0] == "DATA") { 
                if (($uploadcsv[6] != "")||($uploadcsv[6] != "")) {
                    $loaderror = "0";
                    // Show current values input
                    XTRJQDT();
                    $seq++;
                    XTDHTXT($seq);
                    XTDHTXT('<span style="color:silver";>'."current"."</span>");
                    XTDHTXT('<span style="color:silver";>'."sfmteamn"."</span>");
                    XTDHTXT('<span style="color:silver";>'.$uploadcsv[2]."</span>");
                    XTDHTXT('<span style="color:silver";>'.$uploadcsv[5]."</span>");
                    XTDHTXT("");				    				    
                    X_TR();                    

                    Check_Data($uploadcsv[1],$uploadcsv[2]);
                    if ($GLOBALS{'IOWARNING'} == "0") {
                        $oldsfmleagueid = $GLOBALS{'sfmteam_sfmleagueid'};
                        Check_Data('sfmdivision',$uploadcsv[6]); 
                        if ($GLOBALS{'IOWARNING'} == "0") {
                            $GLOBALS{'sfmteam_sfmleagueid'} = $GLOBALS{'sfmdivision_sfmleagueid'};
                            $GLOBALS{'sfmteam_sfmdivisionid'} = $uploadcsv[6];
                            $newsfmleagueid = $GLOBALS{'sfmteam_sfmleagueid'};
                            if ($testorreal == "R") {
                                Write_Data($uploadcsv[1],$uploadcsv[2]);
                                $message = "Team Division Change Successfully Made: (".$oldsfmleagueid."/".$uploadcsv[5]." to ".$newsfmleagueid."/".$uploadcsv[6].")";
                            } else {
                                $message = "Team Division Change Would be Successful: (".$oldsfmleagueid."/".$uploadcsv[5]." to ".$newsfmleagueid."/".$uploadcsv[6].")";
                            }
                        } else {
                            $loaderror = "1";
                            $message = "Error: Division does not exist: (".$uploadcsv[5].")";
                        }
                    } else {
                        $loaderror = "1";
                        $message = "Error: Team does not exist: (".$uploadcsv[2].")";
                    }
                    // 0DATAHEADER  1TABLE  2team id  3team name  4club id  5existing division id  6new division id
                    if ( $loaderror == "0" ) {
                        XTRJQDT();
                        $seq++;
                        XTDHTXT($seq);                    
                        XTDHTXT("new");
                        XTDHTXT($uploadcsv[1]);
                        XTDHTXT($uploadcsv[2]);
                        XTDHTXT($uploadcsv[6]);
                        XTDHTXT($message);				    				    
                        X_TR();
                    } else {
                        XTRJQDT();
                        $seq++;
                        XTDHTXT($seq);
                        XTDHTXT('<span style="color:red";>'."new"."</span>");
                        XTDHTXT('<span style="color:red";>'.$uploadcsv[1]."</span>");
                        XTDHTXT('<span style="color:red";>'.$uploadcsv[2]."</span>");
                        XTDHTXT('<span style="color:red";>'.$uploadcsv[6]."</span>");
                        XTDHTXT('<span style="color:red";>'.$message."</span>");				    				    
                        X_TR();
                    }    
                }    
            }
        }
    }
    
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv_".$uploadtable);
    XCLEARFLOAT();
    XINHID($uploadtable."_sortcol","0");
    XINHID($uploadtable."_sortseq","asc");
}

?>
