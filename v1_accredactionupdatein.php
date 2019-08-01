<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_libraryroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Library_ACCREDACTIONVIEWLIST_CSSJS ();
PageHeader("Default","Final");
Back_Navigator();

$inaccredaction_schemeid = $_REQUEST['accredaction_schemeid'];
$inaccredaction_clubid = $_REQUEST['accredaction_clubid'];
$inaccredaction_id = $_REQUEST['accredaction_id'];

Check_Data("accredaction",$inaccredaction_schemeid,$inaccredaction_clubid,$inaccredaction_id);
if ($GLOBALS{'IOWARNING'} == "1") {
    Initialise_Data("accredaction");
    $GLOBALS{'accredaction_schemeid'} = $inaccredaction_schemeid;
    $GLOBALS{'accredaction_clubid'} = $inaccredaction_clubid;
    $GLOBALS{'accredaction_id'} = $inaccredaction_id;

    XPTXTCOLOR("New Development Plan Record Created","orange");
}

foreach ( $_REQUEST as $keystring => $v ) {
    $keybits = explode("_",$keystring);

    if ($keybits[0] == "accredaction") {
        $thisfield = $keybits[0].'_'.$keybits[1];
        $thistable = $keybits[0];
        // XPTXTCOLOR( $keystring." = ".$v, "orange"  );
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
            if ($keybits[2] == "dd/mm/yyyy") {
		$GLOBALS{$thisfield} = DDbMMbYYYYtoYYYYhMMhDD($v);
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
XPTXTCOLOR("Information successfully updated for ".$inaccredaction_id,"green");
Write_Data("accredaction",$inaccredaction_schemeid,$inaccredaction_clubid,$inaccredaction_id);

Library_ACCREDACTIONVIEWLIST_Output ($inaccredaction_schemeid,$inaccredaction_clubid);
echo "<script>parent.self.location='".$_SESSION['referer']."';</script>";

Back_Navigator();
PageFooter("Default","Final");

?>
