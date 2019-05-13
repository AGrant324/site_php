<?php # finallocatebank1.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_finroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});


XH4("Convert Financial Categories");
XH5("Create Conversion Table");
$fincategoryh = array ();
$fincategorya = Get_Array('fincategory');
foreach ($fincategorya as $fincategory_id) {
 Get_Data('fincategory',$fincategory_id);
 if ($GLOBALS{'fincategory_sageid'} != "") {
  $rawsagecode = str_replace("S","",$GLOBALS{'fincategory_sageid'});
  $fincategoryh[$rawsagecode] = $fincategory_id;
  print "<br>".$rawsagecode." converts to $fincategory_id";  
 }
}


XH5("Perform Conversion");
$banktxna = Get_Array('banktxn');
foreach ($banktxna as $banktxn_id) {
 Get_Data('banktxn',$banktxn_id);
 if ($GLOBALS{'banktxn_fincategoryid'} != "") {
  $oldcode = $GLOBALS{'banktxn_fincategoryid'}; 
  if ($fincategoryh[$GLOBALS{'banktxn_fincategoryid'}]) {
   $newcode = $fincategoryh[$GLOBALS{'banktxn_fincategoryid'}];
   print "<br>Bank Transaction $banktxn_id converted from $oldcode to $newcode";
   $GLOBALS{'banktxn_fincategoryid'} = $fincategoryh[$GLOBALS{'banktxn_fincategoryid'}]; 
   Write_Data('banktxn',$banktxn_id); 
  } else {
   print "<br>Bank Transaction $banktxn_id - $oldcode not found";    
  }
 }
} 

$cashtxna = Get_Array('cashtxn');
foreach ($cashtxna as $cashtxn_id) {
 Get_Data('cashtxn',$cashtxn_id);
 if ($GLOBALS{'cashtxn_fincategoryid'} != "") {
  $oldcode = $GLOBALS{'cashtxn_fincategoryid'};
  if ($fincategoryh[$GLOBALS{'cashtxn_fincategoryid'}]) {
   $newcode = $fincategoryh[$GLOBALS{'cashtxn_fincategoryid'}];
   print "<br>Cash Transaction $cashtxn_id converted from $oldcode to $newcode";
   $GLOBALS{'cashtxn_fincategoryid'} = $fincategoryh[$GLOBALS{'cashtxn_fincategoryid'}];
   Write_Data('cashtxn',$cashtxn_id);
  } else {
   print "<br>Cash Transaction $cashtxn_id - $oldcode not found";
  }
 }
}

$txnfavouritea = Get_Array('txnfavourite');
foreach ($txnfavouritea as $txnfavourite_id) {
 Get_Data('txnfavourite',$txnfavourite_id);
 if ($GLOBALS{'txnfavourite_fincategoryid'} != "") {
  $oldcode = $GLOBALS{'txnfavourite_fincategoryid'};
  if ($fincategoryh[$GLOBALS{'txnfavourite_fincategoryid'}]) {
   $newcode = $fincategoryh[$GLOBALS{'txnfavourite_fincategoryid'}];
   print "<br>Txn Favourite $txnfavourite_id converted from $oldcode to $newcode";
   $GLOBALS{'txnfavourite_fincategoryid'} = $fincategoryh[$GLOBALS{'txnfavourite_fincategoryid'}];
   Write_Data('txnfavourite',$txnfavourite_id);
  } else {
   print "<br>Txn Favourite $txnfavourite_id - $oldcode not found";
  }
 }
}

$salesinvoicea = Get_Array('salesinvoice');
foreach ($salesinvoicea as $salesinvoice_id) {
 Get_Data('salesinvoice',$salesinvoice_id);
 if ($GLOBALS{'salesinvoice_fincategoryid'} != "") {
  $oldcode = $GLOBALS{'salesinvoice_fincategoryid'};
  if ($fincategoryh[$GLOBALS{'salesinvoice_fincategoryid'}]) {
   $newcode = $fincategoryh[$GLOBALS{'salesinvoice_fincategoryid'}];
   print "<br>Sales Invoice $salesinvoice_id converted from $oldcode to $newcode";
   $GLOBALS{'salesinvoice_fincategoryid'} = $fincategoryh[$GLOBALS{'salesinvoice_fincategoryid'}];
   Write_Data('salesinvoice',$salesinvoice_id);
  } else {
   print "<br>Sales Invoice $salesinvoice_id - $oldcode not found";
  }
 }
}

$purchaseinvoicea = Get_Array('purchaseinvoice');
foreach ($purchaseinvoicea as $purchaseinvoice_id) {
 Get_Data('purchaseinvoice',$purchaseinvoice_id);
 if ($GLOBALS{'purchaseinvoice_fincategoryid'} != "") {
  $oldcode = $GLOBALS{'purchaseinvoice_fincategoryid'};
  if ($fincategoryh[$GLOBALS{'purchaseinvoice_fincategoryid'}]) {
   $newcode = $fincategoryh[$GLOBALS{'purchaseinvoice_fincategoryid'}];
   print "<br>Purchase Invoice $purchaseinvoice_id converted from $oldcode to $newcode";
   $GLOBALS{'purchaseinvoice_fincategoryid'} = $fincategoryh[$GLOBALS{'purchaseinvoice_fincategoryid'}];
   Write_Data('purchaseinvoice',$purchaseinvoice_id);
  } else {
   print "<br>Purchase Invoice $purchaseinvoice_id - $oldcode not found";
  }
 }
}

Back_Navigator();
PageFooter("Default","Final");

?>


