<<<<<<< HEAD
<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$window = $_REQUEST['Window'];

Person_ADD2_CSSJS();
if ($window == "Window") { PageHeader("Default","Final"); Back_Navigator(); }
if ($window == "Popup") { PopUpHeader(); }
Check_Session_Validity();

$inperson_sname = $_REQUEST['PersonSName'];
$originalperson_sname = $inperson_sname;
$inperson_fname = $_REQUEST['PersonFName'];
$originalperson_fname = $inperson_fname;

if (($inperson_sname == "")||($inperson_fname == "")) {
 print "<P>No First Name or Surname entered. Please try again.";
 Person_ADD1_Output($window);	
} else {
 $inmatchsname = strtolower($inperson_sname);
 $inmatchfname = strtolower($inperson_fname);

 Get_Data("person",$GLOBALS{'LOGIN_person_id'});
 Get_Person_Authority();

 $persona = Get_Array('person'); 
 $anyfound = "0";
 foreach ($persona as $tperson_id) {	
  Get_Data("person",$tperson_id);
  
  $testperson_sname = strtolower($GLOBALS{'person_sname'});
  $testperson_fname = strtolower($GLOBALS{'person_fname'});
  $found = "0";
  if (($inmatchsname == $testperson_sname) &&  ($inmatchfname == $testperson_fname)) {
       $found = "1";
       $anyfound = "1";
    }
  if ($found == "1") {
     XH5($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.' already exists as '.$tperson_id);
  }
 }
 if ($anyfound == "1") {
  XTXTCOLOR("Warning - this name already exists. Proceed only if you wish to add another entry with the same name.","red");
 }
 $tempsname = str_replace("'", "", $inmatchsname."999");
 $tempsname = str_replace(" ", "", $tempsname."999");
 $tempfname = str_replace("'", "", $inmatchfname."999");
 $tempfname = str_replace(" ", "", $tempfname."999");
 $snamebits = str_split($tempsname);
 $fnamebits = str_split($tempfname);
 $newspace = "0";
 $n = "";
 while ($newspace == "0") {
  $newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
  $newperson_id = strtolower($newperson_id);
  $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
  Check_Data("person",$lookupnewperson_id);
  if ($GLOBALS{'IOWARNING'} == "0") {
   if ($n == "") { $n = "1"; } else { ++$n; }
  } else {
   $newspace = "1";
  }
 }
 Person_ADD2_Output($window,$newperson_id,$inperson_fname,$inperson_sname,"");
}

if ($window == "Window") { Back_Navigator(); PageFooter("Default","Final"); }
if ($window == "Popup") { XBR();XINBUTTONCLOSEWINDOW("Cancel"); PopUpFooter(); }

?>
=======
<?php # personAMin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

Get_Common_Parameters();
GlobalRoutine();

$window = $_REQUEST['Window'];

Person_ADD2_CSSJS();
if ($window == "Window") { PageHeader("Default","Final"); Back_Navigator(); }
if ($window == "Popup") { PopUpHeader(); }
Check_Session_Validity();

$inperson_sname = $_REQUEST['PersonSName'];
$originalperson_sname = $inperson_sname;
$inperson_fname = $_REQUEST['PersonFName'];
$originalperson_fname = $inperson_fname;

if (($inperson_sname == "")||($inperson_fname == "")) {
 print "<P>No First Name or Surname entered. Please try again.";
 Person_ADD1_Output($window);	
} else {
 $inmatchsname = strtolower($inperson_sname);
 $inmatchfname = strtolower($inperson_fname);

 Get_Data("person",$GLOBALS{'LOGIN_person_id'});
 Get_Person_Authority();

 $persona = Get_Array('person'); 
 $anyfound = "0";
 foreach ($persona as $tperson_id) {	
  Get_Data("person",$tperson_id);
  
  $testperson_sname = strtolower($GLOBALS{'person_sname'});
  $testperson_fname = strtolower($GLOBALS{'person_fname'});
  $found = "0";
  if (($inmatchsname == $testperson_sname) &&  ($inmatchfname == $testperson_fname)) {
       $found = "1";
       $anyfound = "1";
    }
  if ($found == "1") {
     XH5($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}.' already exists as '.$tperson_id);
  }
 }
 if ($anyfound == "1") {
  XTXTCOLOR("Warning - this name already exists. Proceed only if you wish to add another entry with the same name.","red");
 }
 $tempsname = str_replace("'", "", $inmatchsname."999");
 $tempsname = str_replace(" ", "", $tempsname."999");
 $tempfname = str_replace("'", "", $inmatchfname."999");
 $tempfname = str_replace(" ", "", $tempfname."999");
 $snamebits = str_split($tempsname);
 $fnamebits = str_split($tempfname);
 $newspace = "0";
 $n = "";
 while ($newspace == "0") {
  $newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
  $newperson_id = strtolower($newperson_id);
  $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
  Check_Data("person",$lookupnewperson_id);
  if ($GLOBALS{'IOWARNING'} == "0") {
   if ($n == "") { $n = "1"; } else { ++$n; }
  } else {
   $newspace = "1";
  }
 }
 Person_ADD2_Output($window,$newperson_id,$inperson_fname,$inperson_sname,"");
}

if ($window == "Window") { Back_Navigator(); PageFooter("Default","Final"); }
if ($window == "Popup") { XBR();XINBUTTONCLOSEWINDOW("Cancel"); PopUpFooter(); }

?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
