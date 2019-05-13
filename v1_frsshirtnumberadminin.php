<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_frsroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Frs_SHIRTNUMBERADMIN_CSSJS();
PageHeader("Default","Final");
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$inallocationtype = $_REQUEST["AllocationType"];
$inallocationrangestart = $_REQUEST["AllocationRangeStart"];
$inallocationrangeend = $_REQUEST["AllocationRangeEnd"];
$inallocationpersonid = $_REQUEST["AllocationPersonId"];
$inallocationteamcode = $_REQUEST["AllocationTeamcode"];
$inallocationaction = $_REQUEST["AllocationAction"];

$aerror = "0";

if ( ($inallocationtype == "Player")||($inallocationtype == "Team")||($inallocationtype == "Reserved") ) {} else {
    XPTXTCOLOR("Invalid Allocation Type", "red"); $aerror = "1";
}
if ( $inallocationrangestart == "" ) {
    XPTXTCOLOR("No Range Start Entered", "red"); $aerror = "1";
} else {
    if (is_numeric($inallocationrangestart)) {
        $inallocationrangestartint = $inallocationrangestart;
        if ( $inallocationrangestartint < 1) { XPTXTCOLOR("Invalid Range Start", "red"); $aerror = "1"; }
        if ( $inallocationrangestartint > 999) { XPTXTCOLOR("Invalid Range Start", "red"); $aerror = "1"; }
    } else {
        XPTXTCOLOR("Invalid Range Start", "red"); $aerror = "1";
    }
}
if ( $inallocationrangeend != "" ) {
    if (is_numeric($inallocationrangeend)) {
        $inallocationrangeendint = $inallocationrangeend;
        if ( $inallocationrangeendint < 1) { XPTXTCOLOR("Invalid Range End", "red"); $aerror = "1"; }
        if ( $inallocationrangeendint > 999) { XPTXTCOLOR("Invalid Range End", "red"); $aerror = "1"; }
        if ( $inallocationrangeendint < $inallocationrangestartint ) { XPTXTCOLOR("Range End before Range Start", "red"); $aerror = "1";  }
    } else {
        XPTXTCOLOR("Invalid Range End", "red"); $aerror = "1";
    }
}

if ( $inallocationtype == "Player" ) {
    if ( $inallocationrangeend != "" ) { XPTXTCOLOR("Cannot have Range End for Person", "red"); $aerror = "1"; }
    if ( $inallocationpersonid == "" ) { 
        XPTXTCOLOR("No Personal Id entered", "red"); $aerror = "1"; 
    } else {
        Check_Data("person",$inallocationpersonid);
        if ($GLOBALS{'IOWARNING'} == "1" ) {
            XPTXTCOLOR("Personal Id does not exist", "red"); $aerror = "1"; 
        }
    }
    if ( $inallocationteamcode != "" ) {
        XPTXTCOLOR("No Team required for Person", "red"); $aerror = "1";
    }
    $inallocationrangeendint = $inallocationrangestartint;
}

if ( $inallocationtype == "Team" ) {
    if ( $inallocationteamcode == "" ) {
        XPTXTCOLOR("No Team entered", "red"); $aerror = "1";
    } else {
        Check_Data("team",$GLOBALS{'currperiodid'},$inallocationteamcode);
        if ($GLOBALS{'IOWARNING'} == "1" ) {
            XPTXTCOLOR("Team does not exist", "red"); $aerror = "1";
        }
    }
    if ( $inallocationpersonid != "" ) {
        XPTXTCOLOR("No Person Id required for Team", "red"); $aerror = "1";
    } 
    if ( $inallocationrangeend == "" ) {
        $inallocationrangeendint = $inallocationrangestartint;
    }
}

if ( $inallocationtype == "Reserved" ) {
    if ( $inallocationpersonid != "" ) {
        XPTXTCOLOR("No Person Id required for Reserved", "red"); $aerror = "1";
    }  
    if ( $inallocationteamcode != "" ) {
        XPTXTCOLOR("No Team required for Reserved", "red"); $aerror = "1";
    }
    if ( $inallocationrangeend == "" ) {
        $inallocationrangeendint = $inallocationrangestartint;
    }
}

if ( ($inallocationaction == "Allocate")||($inallocationaction == "DeAllocate")) {} else {
    XPTXTCOLOR("Invalid Action", "red"); $aerror = "1";
}

if ( $aerror == "0" ) {
    $berror = "0"; 
    if ( $inallocationaction == "Allocate" ) {       
        if ( $inallocationtype == "Player" ) {
            // check that no previous allocations for this person exist
            $frsplayernumber_codea = Get_Array("frsplayernumber","Club");
            foreach ( $frsplayernumber_codea as $frsplayernumber_code ) {
                Get_Data("frsplayernumber","Club",$frsplayernumber_code);
                if ( $GLOBALS{'frsplayernumber_personid'} == $inallocationpersonid ) {
                    Check_Data("person",$inallocationpersonid);
                    if ($GLOBALS{'IOWARNING'} == "0" ) {
                        XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." already Allocated for ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"red"); $berror = "1";
                    } else {
                        XPTXTCOLOR("Error: PersonId ".$inallocationpersonid." does not exist.","red");; $berror = "1";
                    }
                }       
            }       
        }
    }
    if ( $berror == "0" ) {
        for ( $shirtindex = $inallocationrangestartint; $shirtindex <= $inallocationrangeendint; $shirtindex++ ) {        
            $frsplayernumber_code = strval($shirtindex);
            if ( $inallocationaction == "Allocate" ) {
                Check_Data("frsplayernumber","Club",$frsplayernumber_code);
                if ($GLOBALS{'IOWARNING'} == "0" ) {                
                    XPTXTCOLOR("Error: Shirt Number ".$frsplayernumber_code." is already Allocated. Please De-Allocate first.","red");
                } else {
                    Initialise_Data("frsplayernumber");
                    $GLOBALS{'frsplayernumber_setcode'} = "Club";
                    $GLOBALS{'frsplayernumber_code'} = strval($shirtindex);
                    $frsplayernumber_code = strval($shirtindex);                
                    $GLOBALS{'frsplayernumber_allocationtype'} = $inallocationtype;
                    if ( $inallocationtype == "Player" ) {
                        $GLOBALS{'frsplayernumber_personid'} = $inallocationpersonid;
                        $GLOBALS{'frsplayernumber_teamcode'} = "";
                        Write_Data("frsplayernumber","Club",$frsplayernumber_code);                    
                        Check_Data("person",$inallocationpersonid);
                        if ($GLOBALS{'IOWARNING'} == "0" ) {
                            $GLOBALS{'person_shirtnumber'} = $frsplayernumber_code;
                            Write_Data("person",$inallocationpersonid); XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." has been Allocated to ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"green");
                        } else {
                            XPTXTCOLOR("Error: Person Id ".$inallocationpersonid." does not exist.","red");
                        }
                    }
                    if ( $inallocationtype == "Team" ) {
                        $GLOBALS{'frsplayernumber_personid'} = "";
                        $GLOBALS{'frsplayernumber_teamcode'} = $inallocationteamcode;
                        Write_Data("frsplayernumber","Club",$frsplayernumber_code);
                        Check_Data("team",$GLOBALS{'currperiodid'},$inallocationteamcode);
                        if ($GLOBALS{'IOWARNING'} == "0" ) {
                            XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." has been Allocated to ".$GLOBALS{'team_name'},"green");
                        } else {
                            XPTXTCOLOR("Error: Team Code ".$inallocationteamcode." does not exist.","red");
                        }
                        
                        
                    }
                    if ( $inallocationtype == "Reserved" ) {
                        $GLOBALS{'frsplayernumber_personid'} = "";
                        $GLOBALS{'frsplayernumber_teamcode'} = "";
                        Write_Data("frsplayernumber","Club",$frsplayernumber_code);
                        XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." has been Reserved.","green");
                    }
                }
            }
            
            if ( $inallocationaction == "DeAllocate" ) {
                Check_Data("frsplayernumber","Club",$frsplayernumber_code);
                if ($GLOBALS{'IOWARNING'} == "1" ) {
                    XPTXTCOLOR("Error: Shirt Number ".$frsplayernumber_code." is already De-Allocated.","red");
                } else {
                    if ($GLOBALS{'frsplayernumber_allocationtype'} != $inallocationtype ) {
                        XPTXTCOLOR("Error: Shirt Number ".$frsplayernumber_code." De-Allocation type mismatch.","red");                       
                    } else {
                        $GLOBALS{'frsplayernumber_allocationtype'} = "";
                        if ( $inallocationtype == "Player" ) {
                            if ( $GLOBALS{'frsplayernumber_personid'} == $inallocationpersonid ) {
                                Delete_Data("frsplayernumber","Club",$frsplayernumber_code);
                                Check_Data("person",$inallocationpersonid);
                                if ($GLOBALS{'IOWARNING'} == "0" ) {
                                    $GLOBALS{'person_shirtnumber'} = "";
                                    Write_Data("person",$inallocationpersonid);
                                    XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." has been De-Allocated from Player - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"green");
                                } else {
                                    XPTXTCOLOR("Error: PersonId ".$inallocationpersonid." does not exist.","red");
                                }
                            } else {
                                XPTXTCOLOR("Error: Person Id ".$inallocationpersonid." does not match.","red");
                            }
                        }
                        if ( $inallocationtype == "Team" ) {
                            if ( $GLOBALS{'frsplayernumber_teamcode'} == $inallocationteamcode ) {
                                Delete_Data("frsplayernumber","Club",$frsplayernumber_code);
                                Check_Data("team",$GLOBALS{'currperiodid'},$inallocationteamcode);
                                if ($GLOBALS{'IOWARNING'} == "0" ) {
                                    XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." has been De-Allocated from Team - ".$GLOBALS{'team_name'},"green");
                                } else {
                                    XPTXTCOLOR("Error: Team Code ".$inallocationteamcode." does not exist.","red");
                                }
                            } else {
                                XPTXTCOLOR("Error: Team Code ".$inallocationteamcode." does not match.","red");
                            }
                        }
                        if ( $inallocationtype == "Reserved" ) {
                            $GLOBALS{'frsplayernumber_personid'} = "";
                            $GLOBALS{'frsplayernumber_teamcode'} = "";                   
                            Delete_Data("frsplayernumber","Club",$frsplayernumber_code);
                            XPTXTCOLOR("Shirt Number ".$frsplayernumber_code." has been De-Allocated from Reserved.","green");
                        } 
                    }
                }
            }
            
        }
    }
}

Frs_SHIRTNUMBERADMIN_Output($inallocationtype,$inallocationrangestart,$inallocationrangeend,$inallocationpersonid,$inallocationteamcode,$inallocationaction);

Back_Navigator();
PageFooter("Default","Final");

?>


