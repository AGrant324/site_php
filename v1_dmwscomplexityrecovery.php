<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XH2("Complexity Recovery");

$mastercomplexitya = Array();


$backupa = Get_Directory_Array ($GLOBALS{'domainfilepath'}."/backup");

$surangemin = "SU00000";
$surangemax = "SU02000";



foreach ($backupa as $backupfilename) {
    
    XTXTBOLD($backupfilename);XBR("");
    $recorda = Array();
    $recorda = Get_File_Array ($GLOBALS{'domainfilepath'}."/backup/".$backupfilename);
    $counter = 0;
    foreach ($recorda as $record) {
        $rbits = explode(",",$record.",,,,,,,,");
        if (($rbits[0] == "data")&&($rbits[1] == "dmwscomplexity")) {           
            $suid = $rbits[2];
            $complexityscore = $rbits[41];
            if (($suid >= $surangemin)&&($suid <= $surangemax)) {
                if ($complexityscore != "0.00") {
                    $counter++; if ($counter < 5000) { 
                        // XTXT($suid."|".$record."|".$complexityscore);XBR(); 
                        array_push($mastercomplexitya,$suid."|".$record);
                    }
                }
            }
        }
    }
}

sort($mastercomplexitya);

XH2("Consolidated");
$counter = 0;
$lastsuid = "SU00000";
$chosenrecord = "";
$highestcomplexityscorenum = 0;
$first = "1";

foreach ($mastercomplexitya as $sortrecord) {
    $rbits = explode(",",$sortrecord.",,,,,,,,");
    $xbits = explode("|",$sortrecord);
    $thisrecord = $xbits[1];
    $suid = $rbits[2];
    $complexityscore = $rbits[41];
    $complexityscorenum = floatval($complexityscore);
    // XPTXT($suid." ".$lastsuid." ".$complexityscore." ".$highestcomplexityscorenum);
        
    if (($suid != $lastsuid)&&($first != "1")) { 
        // ==== output result =====
        XTXT($chosenrecord);XBR();  
        $chosenrecord = "";
        $highestcomplexityscorenum = 0;       
    }
    
    if ( $complexityscorenum >= $highestcomplexityscorenum ) {       
        $chosenrecord = $thisrecord;
        $highestcomplexityscorenum = $complexityscorenum;
    }

    $lastsuid = $suid;
    $first = "0";
}

// ==== output result =====
XTXT($chosenrecord);XBR();
$chosenrecord = "";
$highestcomplexityscorenum = 0;    

Back_Navigator();
PageFooter("Default","Final");

?>


