<<<<<<< HEAD
<?php # actionmanagerin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_NEWREG_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$action_code = $_REQUEST["ActionCode"];
$actionreqd = $_REQUEST["ActionReqd"];
$validactioncode = "1";
Check_Data("action","open",$action_code);
if ($GLOBALS{'IOWARNING'} != "0") {
	Check_Data('action',"closed",$action_code);
	if ($GLOBALS{'IOWARNING'} == "0") {
		XH3("ERROR: This action has already been processed");
		$validactioncode = "0";
		Action_VIEWLIST_Output();
	} else {
		XH3("ERROR: For some reason this action code does not exist");
		$validactioncode = "0";
		Action_VIEWLIST_Output();
	}
}
if ($validactioncode = "1") {
	if ($actionreqd == "close") {
	 Write_Data("action","closed",$action_code);
	 Delete_Data("action","open",$action_code); 
	 Action_VIEWLIST_Output();
	}
	
	if (($GLOBALS{'action_type'} == "NEWEMAIL")&&($actionreqd == "action")) {
	
	 $lookupfound = 0;
	 $lookupnewperson_id = "";
	 $lookupfoundperson_ids = array();
	 
	 Person_Action2Globals($GLOBALS{'action_string'});
	 $inmatchperson_fname = strtolower($GLOBALS{'person_fname'});
	 $inmatchperson_sname = strtolower($GLOBALS{'person_sname'});
	 $persona = Get_Array('person');
	 foreach ($persona as $tperson_id) {
	 	Get_Data("person",$tperson_id);
	 	$dbmatchperson_fname = strtolower($GLOBALS{'person_fname'});
	 	$dbmatchperson_sname = strtolower($GLOBALS{'person_sname'});
	 	if (($inmatchperson_fname == $dbmatchperson_fname) &&  ($inmatchperson_sname == $dbmatchperson_sname)) {
	 		++$lookupfound;
	 		array_push($lookupfoundperson_ids, $tperson_id);
	 	}
	 }
	 Person_Action2Globals($GLOBALS{'action_string'});
	 Person_NAMEMATCHLIST_Output($lookupfoundperson_ids, $action_code ); 
	}
	
	
	if (($GLOBALS{'action_type'} == "NEWEMAIL")&&($actionreqd == "addnewperson")) {
		$lookupfound = 0;
		$lookupnewperson_id = "";
		$lookupfoundperson_ids = array();
	
		Person_Action2Globals($GLOBALS{'action_string'});
		$inmatchperson_fname = strtolower($GLOBALS{'person_fname'});
		$inmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		$persona = Get_Array('person');
		foreach ($persona as $tperson_id) {
		 Get_Data("person",$tperson_id);
		 $dbmatchperson_fname = strtolower($GLOBALS{'person_fname'});
		 $dbmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		 if (($inmatchperson_fname == $dbmatchperson_fname) &&  ($inmatchperson_sname == $dbmatchperson_sname)) {
		  ++$lookupfound;
		  array_push($lookupfoundperson_ids, $tperson_id);
		 }
		}
		$fnamebits = str_split($inmatchperson_fname);
		$snamebits = str_split($inmatchperson_sname);
		$newspace = "0";
		$n = "";
		while ($newspace == "0") {
		 $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
		 Check_Data("person",$lookupnewperson_id);
		 if ($GLOBALS{'IOWARNING'} == "0") {
		  if ($n == "") {
		  	$n = "1";
		  } else { ++$n;
		  }
		 } else {
		  $newspace = "1";
		 }
		}
		if ($lookupfound == 1) {
		 XH5('Warning - '.$GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'}.' already exists as "'.Array2List($lookupfoundperson_ids).'". Proceed only if you wish to add another entry with the same name.');
		}
		if ($lookupfound > 1) {
		 XH5('Warning - '.$GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'}.' already exists several times as "'.Array2List($lookupfoundperson_ids).'". Proceed only if you wish to add another entry with the same name.');
		}
		Initialise_Data('person');	
		Person_Action2Globals($GLOBALS{'action_string'});
		Person_NEWREG_Output("CONFIRM",$lookupnewperson_id,$action_code,"");
	}
	
	
	if (($GLOBALS{'action_type'} == "NEWREG")&&($actionreqd == "action")) {
		$lookupfound = 0;
		$lookupnewperson_id = "";
		$lookupfoundperson_ids = array();
		
		Person_Action2Globals($GLOBALS{'action_string'});	
		$inmatchperson_fname = strtolower($GLOBALS{'person_fname'}); 
		$inmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		$persona = Get_Array('person'); 
		foreach ($persona as $tperson_id) {	
		 Get_Data("person",$tperson_id);
		 $dbmatchperson_fname = strtolower($GLOBALS{'person_fname'}); 
		 $dbmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		 if (($inmatchperson_fname == $dbmatchperson_fname) &&  ($inmatchperson_sname == $dbmatchperson_sname)) {
		  ++$lookupfound;
		  array_push($lookupfoundperson_ids, $tperson_id);
		 }
		}
		$fnamebits = str_split($inmatchperson_fname);
		$snamebits = str_split($inmatchperson_sname);
		$newspace = "0";
		$n = "";
		while ($newspace == "0") {
		 $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
		 Check_Data("person",$lookupnewperson_id);
		 if ($GLOBALS{'IOWARNING'} == "0") {
		  if ($n == "") { $n = "1"; } else { ++$n; }
		 } else {
		  $newspace = "1";
		 }
		}
		$existingpersonidlist = "";
		if ($lookupfound > 0) { $existingpersonidlist = Array2List($lookupfoundperson_ids); }
		Person_NEWREG_Output("CONFIRM",$lookupnewperson_id,$action_code,$existingpersonidlist); 
	}
}

Back_Navigator();
PageFooter("Default","Final");



?>
=======
<?php # actionmanagerin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_actionroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Person_NEWREG_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
$action_code = $_REQUEST["ActionCode"];
$actionreqd = $_REQUEST["ActionReqd"];
$validactioncode = "1";
Check_Data("action","open",$action_code);
if ($GLOBALS{'IOWARNING'} != "0") {
	Check_Data('action',"closed",$action_code);
	if ($GLOBALS{'IOWARNING'} == "0") {
		XH3("ERROR: This action has already been processed");
		$validactioncode = "0";
		Actions_VIEWLIST_Output();
	} else {
		XH3("ERROR: For some reason this action code does not exist");
		$validactioncode = "0";
		Actions_VIEWLIST_Output();
	}
}
if ($validactioncode = "1") {
	if ($actionreqd == "close") {
	 Write_Data("action","closed",$action_code);
	 Delete_Data("action","open",$action_code); 
	 Actions_VIEWLIST_Output();
	}
	
	if (($GLOBALS{'action_type'} == "NEWEMAIL")&&($actionreqd == "action")) {
	
	 $lookupfound = 0;
	 $lookupnewperson_id = "";
	 $lookupfoundperson_ids = array();
	 
	 Person_Action2Globals($GLOBALS{'action_string'});
	 $inmatchperson_fname = strtolower($GLOBALS{'person_fname'});
	 $inmatchperson_sname = strtolower($GLOBALS{'person_sname'});
	 $persona = Get_Array('person');
	 foreach ($persona as $tperson_id) {
	 	Get_Data("person",$tperson_id);
	 	$dbmatchperson_fname = strtolower($GLOBALS{'person_fname'});
	 	$dbmatchperson_sname = strtolower($GLOBALS{'person_sname'});
	 	if (($inmatchperson_fname == $dbmatchperson_fname) &&  ($inmatchperson_sname == $dbmatchperson_sname)) {
	 		++$lookupfound;
	 		array_push($lookupfoundperson_ids, $tperson_id);
	 	}
	 }
	 Person_Action2Globals($GLOBALS{'action_string'});
	 Person_NAMEMATCHLIST_Output($lookupfoundperson_ids, $action_code ); 
	}
	
	
	if (($GLOBALS{'action_type'} == "NEWEMAIL")&&($actionreqd == "addnewperson")) {
		$lookupfound = 0;
		$lookupnewperson_id = "";
		$lookupfoundperson_ids = array();
	
		Person_Action2Globals($GLOBALS{'action_string'});
		$inmatchperson_fname = strtolower($GLOBALS{'person_fname'});
		$inmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		$persona = Get_Array('person');
		foreach ($persona as $tperson_id) {
		 Get_Data("person",$tperson_id);
		 $dbmatchperson_fname = strtolower($GLOBALS{'person_fname'});
		 $dbmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		 if (($inmatchperson_fname == $dbmatchperson_fname) &&  ($inmatchperson_sname == $dbmatchperson_sname)) {
		  ++$lookupfound;
		  array_push($lookupfoundperson_ids, $tperson_id);
		 }
		}
		$fnamebits = str_split($inmatchperson_fname);
		$snamebits = str_split($inmatchperson_sname);
		$newspace = "0";
		$n = "";
		while ($newspace == "0") {
		 $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
		 Check_Data("person",$lookupnewperson_id);
		 if ($GLOBALS{'IOWARNING'} == "0") {
		  if ($n == "") {
		  	$n = "1";
		  } else { ++$n;
		  }
		 } else {
		  $newspace = "1";
		 }
		}
		if ($lookupfound == 1) {
		 XH5('Warning - '.$GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'}.' already exists as "'.Array2List($lookupfoundperson_ids).'". Proceed only if you wish to add another entry with the same name.');
		}
		if ($lookupfound > 1) {
		 XH5('Warning - '.$GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'}.' already exists several times as "'.Array2List($lookupfoundperson_ids).'". Proceed only if you wish to add another entry with the same name.');
		}
		Initialise_Data('person');	
		Person_Action2Globals($GLOBALS{'action_string'});
		Person_NEWREG_Output("CONFIRM",$lookupnewperson_id,$action_code,"");
	}
	
	
	if (($GLOBALS{'action_type'} == "NEWREG")&&($actionreqd == "action")) {
		$lookupfound = 0;
		$lookupnewperson_id = "";
		$lookupfoundperson_ids = array();
		
		Person_Action2Globals($GLOBALS{'action_string'});	
		$inmatchperson_fname = strtolower($GLOBALS{'person_fname'}); 
		$inmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		$persona = Get_Array('person'); 
		foreach ($persona as $tperson_id) {	
		 Get_Data("person",$tperson_id);
		 $dbmatchperson_fname = strtolower($GLOBALS{'person_fname'}); 
		 $dbmatchperson_sname = strtolower($GLOBALS{'person_sname'});
		 if (($inmatchperson_fname == $dbmatchperson_fname) &&  ($inmatchperson_sname == $dbmatchperson_sname)) {
		  ++$lookupfound;
		  array_push($lookupfoundperson_ids, $tperson_id);
		 }
		}
		$fnamebits = str_split($inmatchperson_fname);
		$snamebits = str_split($inmatchperson_sname);
		$newspace = "0";
		$n = "";
		while ($newspace == "0") {
		 $lookupnewperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
		 Check_Data("person",$lookupnewperson_id);
		 if ($GLOBALS{'IOWARNING'} == "0") {
		  if ($n == "") { $n = "1"; } else { ++$n; }
		 } else {
		  $newspace = "1";
		 }
		}
		$existingpersonidlist = "";
		if ($lookupfound > 0) { $existingpersonidlist = Array2List($lookupfoundperson_ids); }
		Person_NEWREG_Output("CONFIRM",$lookupnewperson_id,$action_code,$existingpersonidlist); 
	}
}

Back_Navigator();
PageFooter("Default","Final");



?>
>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
