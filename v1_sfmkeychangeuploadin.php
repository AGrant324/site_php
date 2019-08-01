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
        $link = YPGMLINK("sfmkeychangeuploadin.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("TestorReal","R");
        $link = $link.YPGMPARM("FirstOrConfirm","Confirm");
        $link = $link.YPGMPARM("LastFileTimeStamp",$lastfiletimestamp);
        XLINKBUTTON($link,"I'm OK with this Test. Now process the data upload in Real mode.");
        XBR();XBR();
        XLINKBACKBUTTON("Cancel.");
        XBR();
        XHR();
    }
	Upload_KeyChange_Data($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/dataupload.csv",$testorreal);

} else {
	XPTXT($uploadmessage,"red");
}

if ($testorreal == "R") {
    SFM_SFMDATALISTSUPDATE_Output ();
}   

Back_Navigator();
PageFooter("Default","Final");



function Upload_KeyChange_Data ($fullfilename,$testorreal) {
    
    // "0DATAHEADER", "1sfmteam", "2team id", "3team name", "4new team id", "5new team name"

    XDIV("reportdiv_".$uploadtable,"container");
    XTABLEJQDTID("reporttable_".$uploadtable);
    XTHEAD();
    XTRJQDT();
    XTDHTXT(""); 
    XTDHTXT("");     
    XTDHTXT("Table");
    XTDHTXT("Id");
    XTDHTXT("Name");
    XTDHTXT("Action");				    				    
    X_TR();
    X_THEAD();
    XTBODY();
    $seq = 0;
    if (($handle = fopen($fullfilename, "r")) !== FALSE) {
        while (($uploadcsv = fgetcsv($handle, 0, ",")) !== FALSE) {	
            if ($uploadcsv[0] == "DATA") { 
                if (($uploadcsv[4] != "")||($uploadcsv[5] != "")) {
                    $loaderror = "0";
                    $keychangemade = "0";
                    Check_Data($uploadcsv[1],$uploadcsv[2]);
                    if ($GLOBALS{'IOWARNING'} == "0") {
                        // Show current values input
                        XTRJQDT();
                        $seq++;
                        XTDHTXT($seq);
                        XTDHTXT('<span style="color:silver";>'."current"."</span>");
                        XTDHTXT('<span style="color:silver";>'.$uploadcsv[1]."</span>");
                        XTDHTXT('<span style="color:silver";>'.$GLOBALS{$uploadcsv[1].'_id'}."</span>");
                        XTDHTXT('<span style="color:silver";>'.$GLOBALS{$uploadcsv[1].'_name'}."</span>");
                        XTDHTXT("");				    				    
                        X_TR();                        
                        if ($uploadcsv[5] != "") {
                            $GLOBALS{$uploadcsv[1].'_name'} = $uploadcsv[5];
                        }
                        if ($testorreal == "R") {
                            if (( $uploadcsv[4] != "" )&&( $uploadcsv[4] != $uploadcsv[2] )) { 
                               // create new record
                               Check_Data($uploadcsv[1],$uploadcsv[4]); 
                               if ($GLOBALS{'IOWARNING'} == "0") {
                                   // PROBLEM - previous record exists
                                   $loaderror = "1";
                                   $message = "Error: Key Already Exists: (".$uploadcsv[2]." to ".$uploadcsv[4].")";
                               } else {
                                   // OK No previous record exists
                                   $keychangemade = "1";
                                   Write_Data($uploadcsv[1],$uploadcsv[4]);
                                   $message = "Key Change Successfully Made: (".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                   Delete_Data($uploadcsv[1],$uploadcsv[2]);
                                   $message = $message." Old Record Deleted: (".$uploadcsv[2].")";  
                               }
                            } else {
                               // update existing record 
                               Write_Data($uploadcsv[1],$uploadcsv[2]);  
                               $message = "Name Change Successfully Made.)"; 
                            }
                        } else {
                            if (( $uploadcsv[4] != "" )&&( $uploadcsv[4] != $uploadcsv[2] )) { 
                               // create new record
                               Check_Data($uploadcsv[1],$uploadcsv[4]); 
                               if ($GLOBALS{'IOWARNING'} == "0") {
                                   // PROBLEM - previous record exists
                                   $loaderror = "1";
                                   $message = "Error: Key Already Exists: (".$uploadcsv[2]." to ".$uploadcsv[4].")";
                               } else {
                                   // OK No previous record exists
                                   $message = "Key Change Would Be Successful: (".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                   $message = $message." Old Record Would Be Deleted: (".$uploadcsv[2].")";  
                               }
                            } else {
                               if ($uploadcsv[5] != "") { 
                                    // update existing record 
                                    Write_Data($uploadcsv[1],$uploadcsv[2]);  
                                    $message = "Name Change Would Be Successful.";
                               } else {
                                    $message = "No Changes Required.";
                               }
                            }
                        }
                        if ( $loaderror == "0" ) {
                            XTRJQDT();
                            $seq++;
                            XTDHTXT($seq);                    
                            XTDHTXT("new");
                            XTDHTXT($uploadcsv[1]);
                            XTDHTXT($uploadcsv[4]);
                            XTDHTXT($uploadcsv[5]);
                            XTDHTXT($message);				    				    
                            X_TR();
                        } else {
                            XTRJQDT();
                            $seq++;
                            XTDHTXT($seq);
                            XTDHTXT('<span style="color:red";>'."new"."</span>");
                            XTDHTXT('<span style="color:red";>'.$uploadcsv[1]."</span>");
                            XTDHTXT('<span style="color:red";>'.$uploadcsv[4]."</span>");
                            XTDHTXT('<span style="color:red";>'.$uploadcsv[5]."</span>");
                            XTDHTXT('<span style="color:red";>'.$message."</span>");				    				    
                            X_TR();
                        }    
                        // "0DATAHEADER", "1sfmteam", "2team id", "3team name", "4new team id", "5new team name"

                        if (($uploadcsv[1] == "sfmclub" )&&($keychangemade == "1")) {
                            // Accreditation Schemes - Club basaed
                            $accredschemea = Get_Array("accredscheme");
                            foreach ( $accredschemea as $accredscheme_id ) {
                                Get_Data( "accredscheme", $accredscheme_id);
                                if ( $GLOBALS{'accredscheme_type'} = "Normal" ) {
                                    $accredcriteriaa = Get_Array('accredcriteria',$accredscheme_id,$uploadcsv[2]); 
                                    foreach ($accredcriteriaa as $accredcriteria_id) { 
                                        Get_Data("accredcriteria",$accredscheme_id,$uploadcsv[2],$accredcriteria_id);

                                        if ($testorreal == "R") {
                                            Write_Data("accredcriteria",$accredscheme_id,$uploadcsv[4],$accredcriteria_id);
                                            Delete_Data("accredcriteria",$accredscheme_id,$uploadcsv[2],$accredcriteria_id);
                                            $message = "Accreditation Updated: (".$accredscheme_id."/".$accredcriteria_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        } else {
                                            $message = "Accreditation Updated: (".$accredscheme_id."/".$accredcriteria_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        }
                                        XTRJQDT();
                                        $seq++;
                                        XTDHTXT($seq);                    
                                        XTDHTXT("");
                                        XTDHTXT("accredcriteria");
                                        XTDHTXT($accredscheme_id."/".$accredcriteria_id);
                                        XTDHTXT("");
                                        XTDHTXT($message);				    				    
                                        X_TR();
                                    }

                                    $accredactiona = Get_Array('accredaction',$accredscheme_id,$uploadcsv[2]); 
                                    foreach ($accredactiona as $accredaction_id) { 
                                        Get_Data("accredaction",$accredscheme_id,$uploadcsv[2],$accredaction_id);

                                        if ($testorreal == "R") {
                                            Write_Data("accredaction",$accredscheme_id,$uploadcsv[2],$accredaction_id);
                                            Delete_Data("accredaction",$accredscheme_id,$uploadcsv[2],$accredaction_id);
                                            $message = "Accreditation Updated: (".$accredscheme_id."/".$accredaction_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        } else {
                                            $message = "Accreditation Updated: (".$accredscheme_id."/".$accredaction_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        }
                                        XTRJQDT();
                                        $seq++;
                                        XTDHTXT($seq);                    
                                        XTDHTXT("");
                                        XTDHTXT("accredaction");
                                        XTDHTXT($accredscheme_id."/".$accredaction_id);
                                        XTDHTXT("");
                                        XTDHTXT($message);				    				    
                                        X_TR();
                                    }

                                }
                            }
                                                               
                            $asseta = Get_Array('asset',$uploadcsv[2]); 
                            foreach ($asseta as $asset_code) { 
                                Get_Data("asset",$uploadcsv[2],$asset_code);

                                if ($testorreal == "R") {
                                    Write_Data("asset",$uploadcsv[2],$asset_code);
                                    Delete_Data("asset",$uploadcsv[2],$asset_code);
                                    $message = "Library Asset Updated: (".$asset_code." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                } else {
                                    $message = "Library Asset Updated: (".$asset_code." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                }
                                XTRJQDT();
                                $seq++;
                                XTDHTXT($seq);                    
                                XTDHTXT("");
                                XTDHTXT("asset");
                                XTDHTXT($asset_code);
                                XTDHTXT("");
                                XTDHTXT($message);				    				    
                                X_TR();
                            }              
                                
                            $todoa = Get_Array('todo',$uploadcsv[2]); 
                            foreach ($todoa as $todo_id) { 
                                Get_Data("todo",$uploadcsv[2],$todo_id);

                                if ($testorreal == "R") {
                                    Write_Data("todo",$uploadcsv[2],$todo_id);
                                    Delete_Data("todo",$uploadcsv[2],$todo_id);
                                    $message = "ToDo Item Updated: (".$todo_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                } else {
                                    $message = "ToDo Item Updated: (".$todo_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                }
                                XTRJQDT();
                                $seq++;
                                XTDHTXT($seq);                    
                                XTDHTXT("");
                                XTDHTXT("todo");
                                XTDHTXT($todo_id);
                                XTDHTXT("");
                                XTDHTXT($message);				    				    
                                X_TR();
                            }                                  
                        }                       
                        
                        if (($uploadcsv[1] == "sfmfacility" )&&($keychangemade == "1")) {
                            if ($uploadcsv[4] != "") {
                                $sfmcluba = Get_Array("sfmclub");
                                foreach ( $sfmcluba as $sfmclub_id  ) {
                                    Get_Data("sfmclub",$sfmclub_id);
                                    if (strlen(strstr($GLOBALS{'sfmclub_sfmfacilityidlist'},$uploadcsv[2]))>0) {
                                        $GLOBALS{'sfmclub_sfmfacilityidlist'} = str_replace($uploadcsv[2],$uploadcsv[4],$GLOBALS{'sfmclub_sfmfacilityidlist'});
                                        if ($testorreal == "R") {
                                            Write_Data("sfmclub",$sfmclub_id);
                                            $message = "Club Facility List Updated: (".$sfmclub_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        } else {
                                            $message = "Club Facility List Would Be Updated: (".$sfmclub_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        }
                                        XTRJQDT();
                                        $seq++;
                                        XTDHTXT($seq);                    
                                        XTDHTXT("");
                                        XTDHTXT("sfmclub");
                                        XTDHTXT($sfmclub_id);
                                        XTDHTXT("");
                                        XTDHTXT($message);				    				    
                                        X_TR(); 
                                    }
                                }
                                
                                $sfmfacilityvisita = Get_Array("sfmfacilityvisit",$uploadcsv[2]);
                                foreach ( $sfmfacilityvisita as $sfmfacilityvisit_id  ) {
                                    Get_Data("sfmfacilityvisit",$uploadcsv[2],$sfmfacilityvisit_id);
                                    if ($testorreal == "R") {
                                        Write_Data("sfmfacilityvisit",$uploadcsv[4],$sfmfacilityvisit_id);
                                        Delete_Data("sfmfacilityvisit",$uploadcsv[2],$sfmfacilityvisit_id);
                                        $message = "Facility Visit Updated: (".$sfmfacilityvisit_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    } else {
                                        $message = "Facility Visit Would Be Updated: (".$sfmfacilityvisit_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    }
                                    XTRJQDT();
                                    $seq++;
                                    XTDHTXT($seq);                    
                                    XTDHTXT("");
                                    XTDHTXT("sfmfacilityvisit");
                                    XTDHTXT($sfmfacilityvisit_id);
                                    XTDHTXT("");
                                    XTDHTXT($message);				    				    
                                    X_TR();    
                                }
                                
                                $sfmfloodlightvisita = Get_Array("sfmfloodlightvisit",$uploadcsv[2]);
                                foreach ( $sfmfloodlightvisita as $sfmfloodlightvisit_id  ) {
                                    Get_Data("sfmfloodlightvisit",$uploadcsv[2],$sfmfloodlightvisit_id);
                                    if ($testorreal == "R") {
                                        Write_Data("sfmfloodlightvisit",$uploadcsv[4],$sfmfloodlightvisit_id);
                                        Delete_Data("sfmfloodlightvisit",$uploadcsv[2],$sfmfloodlightvisit_id);
                                        $message = "Floodlight Visit Updated: (".$sfmfloodlightvisit_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    } else {
                                        $message = "Floodlight Visit Would Be Updated: (".$sfmfloodlightvisit_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    }
                                    XTRJQDT();
                                    $seq++;
                                    XTDHTXT($seq);                    
                                    XTDHTXT("");
                                    XTDHTXT("sfmfloodlightvisit");
                                    XTDHTXT($sfmfloodlightvisit_id);
                                    XTDHTXT("");
                                    XTDHTXT($message);				    				    
                                    X_TR();    
                                }
                                
                                $sfmrectificationa = Get_Array("sfmrectification",$uploadcsv[2]);
                                foreach ( $sfmrectificationa as $sfmrectification_id  ) {
                                    Get_Data("sfmrectification",$uploadcsv[2],$sfmrectification_id);
                                    if ($testorreal == "R") {
                                        Write_Data("sfmrectification",$uploadcsv[4],$sfmrectification_id);
                                        Delete_Data("sfmrectification",$uploadcsv[2],$sfmrectification_id);
                                        $message = "Rectification Updated: (".$sfmrectification_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    } else {
                                        $message = "Rectification Would Be Updated: (".$sfmrectification_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    }
                                    XTRJQDT();
                                    $seq++;
                                    XTDHTXT($seq);                    
                                    XTDHTXT("");
                                    XTDHTXT("sfmrectification");
                                    XTDHTXT($sfmrectification_id);
                                    XTDHTXT("");
                                    XTDHTXT($message);				    				    
                                    X_TR();    
                                }
                                
                                $sfmfloodlightcolumna = Get_Array("sfmfloodlightcolumn",$uploadcsv[2]);
                                foreach ( $sfmfloodlightcolumna as $sfmfloodlightcolumn_id  ) {
                                    Get_Data("sfmfloodlightcolumn",$uploadcsv[2],$sfmfloodlightcolumn_id);
                                    if ($testorreal == "R") {
                                        Write_Data("sfmfloodlightcolumn",$uploadcsv[4],$sfmfloodlightcolumn_id);
                                        Delete_Data("sfmfloodlightcolumn",$uploadcsv[2],$sfmfloodlightcolumn_id);
                                        $message = "Floodlight Column Updated: (".$sfmfloodlightcolumn_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    } else {
                                        $message = "Floodlight Column Would Be Updated: (".$sfmfloodlightcolumn_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                    }
                                    XTRJQDT();
                                    $seq++;
                                    XTDHTXT($seq);                    
                                    XTDHTXT("");
                                    XTDHTXT("sfmfloodlightcolumn");
                                    XTDHTXT($sfmfloodlightcolumn_id);
                                    XTDHTXT("");
                                    XTDHTXT($message);				    				    
                                    X_TR();    
                                }
                                
                                // "0DATAHEADER", "1sfmteam", "2team id", "3team name", "4new team id", "5new team name"
                                
                                $sfmfloodlightelementcolumnida = Get_Array("sfmfloodlightelement",$uploadcsv[2]);
                                foreach ( $sfmfloodlightelementcolumnida as $sfmfloodlightelement_columnid  ) {
                                    $sfmfloodlightelementida = Get_Array("sfmfloodlightelement",$uploadcsv[2],$sfmfloodlightelement_columnid);
                                    foreach ($sfmfloodlightelementida as $sfmfloodlightelement_id  ) {
                                        Get_Data("sfmfloodlightelement",$uploadcsv[2],$sfmfloodlightelement_columnid,$sfmfloodlightelement_id);
                                        if ($testorreal == "R") {
                                            Write_Data("sfmfloodlightelement",$uploadcsv[4],$sfmfloodlightelement_columnid,$sfmfloodlightelement_id);
                                            Delete_Data("sfmfloodlightelement",$uploadcsv[2],$sfmfloodlightelement_columnid,$sfmfloodlightelement_id);
                                            $message = "Floodlight Element Updated: (".$sfmfloodlightelement_columnid."/".$sfmfloodlightelement_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        } else {
                                            $message = "Floodlight Element Would Be Updated: (".$sfmfloodlightelement_columnid."/".$sfmfloodlightelement_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                        }
                                        XTRJQDT();
                                        $seq++;
                                        XTDHTXT($seq);                    
                                        XTDHTXT("");
                                        XTDHTXT("sfmfloodlightelement");
                                        XTDHTXT($sfmfloodlightelement_id);
                                        XTDHTXT("");
                                        XTDHTXT($message);				    				    
                                        X_TR();
                                    }
                                }
                                
                                // Accreditation Schemes - Facility basaed
                                $accredschemea = Get_Array("accredscheme");
                                foreach ( $accredschemea as $accredscheme_id ) {
                                    Get_Data( "accredscheme", $accredscheme_id);
                                    if ( $GLOBALS{'accredscheme_type'} = "Grading" ) {
                                        $accredcriteriaa = Get_Array('accredcriteria',$accredscheme_id,$uploadcsv[2]); 
                                        foreach ($accredcriteriaa as $accredcriteria_id) { 
                                            Get_Data("accredcriteria",$accredscheme_id,$uploadcsv[2],$accredcriteria_id);

                                            if ($testorreal == "R") {
                                                Write_Data("accredcriteria",$accredscheme_id,$uploadcsv[4],$accredcriteria_id);
                                                Delete_Data("accredcriteria",$accredscheme_id,$uploadcsv[2],$accredcriteria_id);
                                                $message = "Ground Grading Updated: (".$accredscheme_id."/".$accredcriteria_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                            } else {
                                                $message = "Ground Grading Updated: (".$accredscheme_id."/".$accredcriteria_id." | ".$uploadcsv[2]." to ".$uploadcsv[4].")";
                                            }
                                            XTRJQDT();
                                            $seq++;
                                            XTDHTXT($seq);                    
                                            XTDHTXT("");
                                            XTDHTXT("accredcriteria");
                                            XTDHTXT($accredscheme_id."/".$accredcriteria_id);
                                            XTDHTXT("");
                                            XTDHTXT($message);				    				    
                                            X_TR();
                                        }
                                    }
                                }    
                            }
                        }
                    } else {
                        $message = "Error: Existing Key Not Found";
                        XTRJQDT();
                        $seq++;
                        XTDHTXT($seq);
                        XTDHTXT('<span style="color:red";>'."current"."</span>");
                        XTDHTXT('<span style="color:red";>'.$uploadcsv[1]."</span>");
                        XTDHTXT('<span style="color:red";>'.$uploadcsv[2]."</span>");
                        XTDHTXT('<span style="color:red";>'.$uploadcsv[3]."</span>");
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
