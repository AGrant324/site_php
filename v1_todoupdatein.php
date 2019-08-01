<?php

session_start();
print_r($_SESSION['referer1']);
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');
// session_start();
// print_r($_SESSION);
// XTXT("1".$_SESSION['referer']);

Get_Common_Parameters();
GlobalRoutine();
Action_TODOVIEWLIST_CSSJS();
PageHeader("Default","Final");
Back_Navigator();
XTXT("01".$_SERVER['HTTP_REFERER']);
echo "<br>";
// $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

$intodo_id = $_REQUEST['todo_id'];

Check_Data("todo",$GLOBALS{'LOGIN_org_id'},$intodo_id);
if ($GLOBALS{'IOWARNING'} == "1") {
    Initialise_Data("todo");
    $GLOBALS{'todo_id'} = $intodo_id;
    XPTXTCOLOR("New ToDo Item Created","green");
}

foreach ( $_REQUEST as $keystring => $v ) {
    $keybits = explode("_",$keystring);
    if ($keybits[0] == "todo") {
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
XPTXTCOLOR("Item successfully updated for ".$intodo_id,"green");
Write_Data("todo",$GLOBALS{'LOGIN_org_id'},$intodo_id);

echo "<script>parent.self.location='".$_SESSION['referer']."';</script>";
Action_TODOVIEWLIST_Output ("");
// XTXT("0".$_SERVER['HTTP_REFERER']);
// echo "<br>";
// $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
// XTXT("1".$_SESSION['referer']);

Back_Navigator();
PageFooter("Default","Final");

?>
