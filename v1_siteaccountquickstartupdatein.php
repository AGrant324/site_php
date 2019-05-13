<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_siteroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Site_ACCOUNTQUICKSTART_CSSJS ();
PageHeader("Default","Final");
Back_Navigator();

$inquickstart_accountid = $_REQUEST['quickstart_accountid'];
$incurrenttab = $_REQUEST['CurrentTab'];

Check_Data("quickstart",$inquickstart_accountid);
if ($GLOBALS{'IOWARNING'} == "1") {
    Initialise_Data("quickstart");
    $GLOBALS{'quickstart_accountid'} = $inquickstart_accountid;
    XPTXTCOLOR("Warning: New Quickstart Record Created","orange");
}

foreach ( $_REQUEST as $keystring => $v ) {
    $keybits = explode("_",$keystring);
    
    if ($keybits[0] == "quickstart") {
        $thisfield = $keybits[0].'_'.$keybits[1];
        $thistable = $keybits[0];
        // XPTXT( $keystring." = ".$v  );
        if (sizeOf($keybits) == 2) { # normal
            if (is_array($_REQUEST[$k])) { # array
                $vstring = ""; $vsep = "";
                foreach ($_REQUEST[$k] as $value) {
                    # XPTXT($value);
                    $vstring = $vstring.$vsep.$value;
                    $vsep = ",";
                }
            } else {
                $vstring = $v;
            }
            $GLOBALS{$thisfield} = $vstring;
            // XPTXT( $thisfield." = ".$vstring  );
        }
        if (sizeOf($keybits) == 3) { # Multipart field
            if ($keybits[2] == "imagename") {
                $GLOBALS{$thisfield} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$thisfield},$v);
            }
            if ($keybits[2] == "DDpart") {$ddpart = $v;}
            if ($keybits[2] == "MMpart") {$mmpart = $v;}
            if ($keybits[2] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$thisfield} = $yyyypart."-".$mmpart."-".$ddpart;}
            if ($keybits[2] == "CODEpart") {$codepart = $v;}
            if ($keybits[2] == "NUMpart") {$numpart = $v; $GLOBALS{$thisfield} = $codepart." ".$numpart; }
            // XPTXT( $thisfield." = ".$v );
        }
    }
    
    
}
XBR();
XPTXTCOLOR("Information successfully updated for ".$inquickstart_accountid,"green");
Write_Data("quickstart",$inquickstart_accountid);

Site_ACCOUNTQUICKSTART_Output($inquickstart_accountid, $incurrenttab);

Back_Navigator();
PageFooter("Default","Final");



?>