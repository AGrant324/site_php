<<<<<<< HEAD
<?php # javascriptpersonprovider.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$recsep = "^"; $fieldsep = chr(126);   // tilde

# PersonShowFieldsRequired = field1|field2|field3
# PersonSelectionCriteria = fieldx(value1|value2|value3)
# Output Records = person_data|field1|field2|field3^ 
$viewchange = $_REQUEST["PersonViewChange"];
$personfieldsrequired = $_REQUEST["PersonFieldsRequired"];
$personfieldsrequireda = explode('|', $personfieldsrequired);
$selectionrequired = "0";
$personselectioncriteria = $_REQUEST["PersonSelectionCriteria"];
if ($personselectioncriteria != "") {
 $selectionrequired = "1";  
 $xfields = explode('(', $personselectioncriteria);	
 $selfield = $xfields[0]; 	
 $yfields = explode(')', $xfields[1]);	
 $selvaluea = explode('|', $yfields[0]);  	
}
print "person_keys".$fieldsep."2".$recsep;
$datastring = "person_header".$fieldsep."person_domainid";
foreach ($personfieldsrequireda as $tfieldelement) {
    $datastring = $datastring.$fieldsep.$tfieldelement;
}
print $datastring.$recsep;

$person_ida = Get_Array('person'); 
foreach ($person_ida as $person_id) {
 if ($person_ida != "") {
	 Get_Data('person',$person_id);
	 if ($GLOBALS{'person_email1'} == "") { $GLOBALS{'person_email1'} = $GLOBALS{'person_email3'} ;}
	 $fselected = "0"; 
	 if (Person_Visibility_Test($viewchange)) {
	  # Person_Redaction_Filter(); 
	  if ($selectionrequired == "1") {
	   foreach ($selvaluea as $selvalue) {
	   	if ($GLOBALS{$selfield} == $selvalue) {$fselected = "1"; }
	   }	 	 	
	  } else {
	   $fselected = "1";  	
	  }
	  if ($fselected == "1") {
	      $datastring = "person_data".$fieldsep.$GLOBALS{'person_domainid'};
	   foreach ($personfieldsrequireda as $tfieldelement) {
	       $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};
	   }
	   print $datastring.$recsep;
	  }
	 }
 }	      
}
?>
=======
<?php # javascriptpersonprovider.php
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
Get_Common_Parameters();
GlobalRoutine();
Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Get_Person_Authority();

$recsep = "^"; $fieldsep = chr(126);   // tilde

# PersonShowFieldsRequired = field1|field2|field3
# PersonSelectionCriteria = fieldx(value1|value2|value3)
# Output Records = person_data|field1|field2|field3^ 
$viewchange = $_REQUEST["PersonViewChange"];
$personfieldsrequired = $_REQUEST["PersonFieldsRequired"];
$personfieldsrequireda = explode('|', $personfieldsrequired);
$selectionrequired = "0";
$personselectioncriteria = $_REQUEST["PersonSelectionCriteria"];
if ($personselectioncriteria != "") {
 $selectionrequired = "1";  
 $xfields = explode('(', $personselectioncriteria);	
 $selfield = $xfields[0]; 	
 $yfields = explode(')', $xfields[1]);	
 $selvaluea = explode('|', $yfields[0]);  	
}
print "person_keys".$fieldsep."2".$recsep;
$datastring = "person_header".$fieldsep."person_domainid";
foreach ($personfieldsrequireda as $tfieldelement) {
    $datastring = $datastring.$fieldsep.$tfieldelement;
}
print $datastring.$recsep;

$person_ida = Get_Array('person'); 
foreach ($person_ida as $person_id) {
 if ($person_ida != "") {
	 Get_Data('person',$person_id);
	 if ($GLOBALS{'person_email1'} == "") { $GLOBALS{'person_email1'} = $GLOBALS{'person_email3'} ;}
	 $fselected = "0"; 
	 if (Person_Visibility_Test($viewchange)) {
	  # Person_Redaction_Filter(); 
	  if ($selectionrequired == "1") {
	   foreach ($selvaluea as $selvalue) {
	   	if ($GLOBALS{$selfield} == $selvalue) {$fselected = "1"; }
	   }	 	 	
	  } else {
	   $fselected = "1";  	
	  }
	  if ($fselected == "1") {
	      $datastring = "person_data".$fieldsep.$GLOBALS{'person_domainid'};
	   foreach ($personfieldsrequireda as $tfieldelement) {
	       $datastring = $datastring.$fieldsep.$GLOBALS{$tfieldelement};
	   }
	   print $datastring.$recsep;
	  }
	 }
 }	      
}
?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
