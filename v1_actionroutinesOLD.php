<?php
# actionroutines.php

function Action_VIEWLIST_Output () {
	XH3("Outstanding actions");
	$helplink = "AdminMaster/Setup_ACTIONSLIST_Output/setup_actionsslist_output.html"; Help_Link;
	XTABLE();
	XTR();
	XTDHTXT("Type");
	XTDHTXT("Reference");
	XTDHTXT("Addressee");
	XTDHTXT("Submitter");
	XTDHTXT("Description");
	XTDHTXT("date raised<BR>dd/mm/yy");
	# XTDHTXT("date due<BR>dd/mm/yy");
	XTDHTXT("");
	XTDHTXT("");
	X_TR();
	$acdirfiles = Get_Array('action',"open");
	$actionfound = "0";
	foreach ($acdirfiles as $action_code) {
		Get_Data('action',"open",$action_code);
		if (($GLOBALS{'LOGIN_person_id'} == $GLOBALS{'action_addressee'})
		||(Authority_Scan($GLOBALS{'domain_domainmasters'},$GLOBALS{'LOGIN_person_id'}) == "1")) {
			$actionfound = "1";
			XTR();
			XTDTXT($GLOBALS{'action_type'});
			XTDTXT($GLOBALS{'action_code'});
			XTDTXT($GLOBALS{'action_addressee'});
			XTDTXT($GLOBALS{'action_submitter'});
			XTDTXTWIDTH($GLOBALS{'action_description'},200);
			XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'action_dateraised'}));			#  @abits = split (//, $GLOBALS{'action_duedate'});
			#  XTDTXT("$abits[4]$abits[5]/$abits[2]$abits[3]/$abits[0]$abits[1]");
			$link = YPGMLINK("actionmanagerin.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("ActionCode",$action_code).YPGMPARM("ActionReqd","action");
			XTDLINKTXT($link,"action");
			$link = YPGMLINK("actionmanagerin.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("ActionCode",$action_code).YPGMPARM("ActionReqd","close");
			XTDLINKTXT($link,"close");
			X_TR();
		}
	}
	X_TABLE();
	if ($actionfound == "0") {
		XPTXT("There are no actions pending for you");
	}
}

function Split_ActionString () {
    $pairs = explode('&', $GLOBALS{'action_string'});
    foreach ($pairs as $pair) {
            $sbits = explode('=', $pair);
            $key = $sbits[0]; $value = $sbits[1];
            #�$key =~ tr/+/ /;
            #�$key =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
            #�$value =~ tr/+/ /;
            #�$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
            #�$value =~s/<!--(.|\n)*-->//g;
            if ($actionformdata{$key}) {
                    $actionformdata{$key} .= ", $value";
            } else {
                    $actionformdata{$key} = $value;
            }
    }
}

function Action_TODOVIEWLIST_CSSJS () {
  $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
  $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
 	session_start();}
function Action_TODOVIEWLIST_Output ($tofilter) {

  XH3("ToDo List");

  XHR();

  XFORMUPLOAD("todoupdateout.php","todoupdate");

  XINSTDHID();

  XINHID("todo_id","New");

  XINSUBMIT("Add New ToDo Item");

  X_FORM();

  XBR();


  XDIV("reportdiv","container");

  XTABLEJQDTID("reporttable_list");

  XTHEAD();

  XTRJQDT();

  XTDHTXT("Person");

  XTDHTXT("Title");

  XTDHTXT("Raised By");

  XTDHTXT("Date Raised");

  XTDHTXT("Due Date");

  XTDHTXT("Response");

  XTDHTXT("Status");

  XTDHTXT("");

  XTDHTXT("");

  X_TR();

  X_THEAD();

  X_THEAD();

  XTBODY();

  XINHID("list_sortcol","0");


  $todo_ida = Get_Array('todo',$GLOBALS{'LOGIN_org_id'});

  foreach ($todo_ida as $todo_id) {
        Get_Data('todo',$GLOBALS{'LOGIN_org_id'},$todo_id);

   // if ($GLOBALS{'LOGIN_person_id'} == $GLOBALS{'todo_personid'}) {

   XTRJQDT();

   XTDTXT($GLOBALS{'todo_personid'});
            XTDTXT($GLOBALS{'todo_title'});
            XTDTXT($GLOBALS{'todo_raisedbypersonid'});
            XTDTXT($GLOBALS{'todo_raiseddate'});
            XTDTXT($GLOBALS{'todo_enddate'});
            XTDTXT($GLOBALS{'todo_response'});

   $statustext = "";
            if ( $GLOBALS{'todo_status'} == "" ) { $statustext = '<span style="color:red"><b>No Status</b></span>'; }

   if ( $GLOBALS{'todo_status'} == "Open" ) {
     $statustext = '<span style="color:red"><b>Open</b></span>';
   }

   if ( $GLOBALS{'todo_status'} == "Closed" ) {
     $statustext = '<span style="color:green"><b>Closed</b></span>';
   }

   if ( $GLOBALS{'todo_status'} == "Dropped" ) {
     $statustext = '<span style="color:orange"><b>Dropped</b></span>';
   }

   XTDTXT($statustext);

   $link = YPGMLINK("todoupdateout.php").YPGMSTDPARMS();

   $link = $link.YPGMPARM("todo_id",$todo_id);
            XTDLINKTXT($link,"Update");

   $link = $link.YPGMPARM("todo_id",$todo_id);
            XTDLINKTXT($link,"Delete");

   X_TR();
        // }
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();

}



function Action_TODOUPDATE_CSSJS() {

  $GLOBALS{'SITECSSOPTIONAL'} = "datepicker,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,personselectionpopup,jqueryconfirm";

  $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
	session_start();

}

function Action_TODOUPDATE_Output($ttodo_id) {

  if ( $ttodo_id == "New" ) {
    Initialise_Data("todo");

    $GLOBALS{'todo_clubid'} = $GLOBALS{'LOGIN_org_id'};

    $GLOBALS{'todo_id'} = $GLOBALS{'currenttimestamp'};

    XH2("New ToDo Item");

  } else {

    Get_Data("todo",$GLOBALS{'LOGIN_org_id'},$ttodo_id);

    XH2("ToDo Item Update");

  }
	// XTXT("0".$_SERVER['HTTP_REFERER']);
	// echo "<br>";
	// XTXT("1".$_SESSION['referer']);
	// echo "<br>";
	$_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
	// // $_SESSION['referer'] = "test";
	// $_SESSION['referer1'] = "test1";
	// $_SESSION['reference'] = "testTwo";
	// XTXT("0".$_SERVER['HTTP_REFERER']);
	// echo "<br>";
	// XTXT("1".$_SESSION['referer']);
	// echo "<br>";

  XFORMUPLOAD("todoupdatein.php","todoupdate");
  XINSTDHID();
  XINHID("todo_id",$GLOBALS{'todo_id'});

  if ( $ttodo_id == "New" ) {

    XINHID("todo_raisedbypersonid",$GLOBALS{'LOGIN_person_id'});
        XINHID("todo_raiseddate",$GLOBALS{'currentYYYY-MM-DD'});

  }

  XBR();


  BROW();

  BCOLTXT("ToDo Actionee","1");

  BCOL("8");
    XINTXTID("todo_personid","todo_personid",$GLOBALS{'todo_personid'},"50","100");
XINBUTTONIDSPECIAL("Lookup","info","Lookup");
  XBR();
    XTXTID("todo_personidname",View_Person_List($GLOBALS{'todo_personid'}));
    B_COL();

  B_ROW();

  XBR();

  BROW();

  BCOLTXT("Title","1");
    BCOLINTXTID('todo_title','todo_title',$GLOBALS{'todo_title'},"2");
    B_ROW();

  XBR();

  BROW();

  BCOLTXT("Action Required","1");
    BCOLINTEXTAREAID('todo_actionrequired','todo_actionrequired',$GLOBALS{'todo_actionrequired'},"5","10");
  B_ROW();

  XBR();

  BROW();

  BCOLTXT("Due Date","1");

  BCOLINDATEID('todo_enddate','todo_enddate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'todo_enddate'}),'dd/mm/yyyy',"3");
  B_ROW();

  XBR();


  BROW();

  BCOLTXT("Reminder Leadtime","1");

  $xhash = List2Hash("Day,Week,Month");

  BCOL("2");
    BINSELECTHASH($xhash,'todo_reminderleadtime',$GLOBALS{'todo_reminderleadtime'});

  B_COL();

  B_ROW();

  XBR();

  BROW();

  BCOLTXT("Recurring Item","1");
    $xhash = List2Hash("Daily,Weekly,Monthly");

  BCOL("2");
    BINSELECTHASH($xhash,'todo_recurring',$GLOBALS{'todo_recurring'});
    B_COL();

  B_ROW();

  XBR();

  BROW();

  BCOLTXT("Response","1");
    BCOLINTEXTAREAID('todo_response','todo_response',$GLOBALS{'todo_response'},"5","10");

  B_ROW();

  XBR();

  BROW();

  BCOLTXT("Status","1");

  $xhash = List2Hash("Open,Closed,Dropped");

  BCOL("2");
    BINSELECTHASH($xhash,'todo_status',$GLOBALS{'todo_status'});

  B_COL();

  B_ROW();

  XBR();

  XHR();

  BROW();

  BCOLTXT("","1");

  BCOL("2");

  XINSUBMIT("Update");

  B_COL();

  B_ROW();

  X_FORM();


  $GLOBALS{'PersonSelectPopupParameters'} = array(
            "this,person_id|person_sname|person_fname|person_section",
            "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
            "field,Lookup,Select,todo_personid,todo_personidname,100",
            "person_id",
            "all",
            "search,center,center,800,600",
            "view",
            "buildfulllist"
    );

}

function Action_TODODELETECONFIRM_Output ($todo_id) {

  XH3('Delete To Do Item - "'.$todo_id.'"');

  XPTXT("Are you sure you want to delete this todo item");

  XBR();

  XFORM("tododeleteaction.php","deletetodo");

  XINSTDHID();

  XINHID("todo_id",$todo_id);

  XINSUBMIT("Confirm ToDo Item Deletion");

  X_FORM();

  XBR();

  XINBUTTONBACK("Cancel");
}

function Action_CALENDAR_CSSJS() {

  $GLOBALS{'SITECSSOPTIONAL'} = "fullcalendarmin";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,moment,fullcalendarmin,fullcalendargcalmin,calendar";
}

function Action_CALENDAR_Output($filter) {
echo <<<EOT
<h4>Calendar</h4>
<div id="calendar"></div>
EOT;

}

/*

function Action_CALENDARFULLYEAR_CSSJS() {

  $GLOBALS{'SITECSSOPTIONAL'} = "fullcalendarmin";
  $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,moment,fullcalendarmin,fullcalendargcalmin,calendarfullyear";


}

function Action_CALENDARFULLYEAR_Output($filter) {

echo <<<EOT
<h4>Calendar</h4>
<div id="calendar"></div>
EOT;

}

*/

// function Action_TODOVIEWLIST_CSSJS () {     $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
//    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report"; }

function Action_CALENDARFULLYEAR_CSSJS() {
  $GLOBALS{'SITECSSOPTIONAL'} = "fullcalendarmin,jqdatatables";
  $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,calendarfullyear,jqdatatablesmin,report";
  $GLOBALS{'SITEPOPUPHTML'} = "CalendarFullPopup";
}


function Action_CALENDARFULLYEAR_Output($orientation){
	//retpo

    // Get Events
    /*
     if ( $GLOBALS{'LOGIN_orgtype_id'} == "Club" ) {
        Check_Data('sfmclub',$GLOBALS{'LOGIN_org_id'});
        if ($GLOBALS{'IOWARNING'} == "0") {

            $todo_ida = Get_Array('todo',$GLOBALS{'LOGIN_org_id'});
            foreach ($todo_ida as $todo_id) {
                Get_Data('todo',$GLOBALS{'LOGIN_org_id'},$todo_id);
                $eventstring = $eventstring."todo"."|";
                $eventstring = $eventstring."green"."|";
                $eventstring = $eventstring.$GLOBALS{'todo_id'}."|";
                $eventstring = $eventstring.$GLOBALS{'todo_title'}."|";
                $eventstring = $eventstring."allDay"."|";
                $eventstring = $eventstring.$GLOBALS{'todo_enddate'}."|";
                $eventstring = $eventstring.$GLOBALS{'todo_enddate'}."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.$GLOBALS{'todo_personid'}."|";
                $eventstring = $eventstring.$GLOBALS{'todo_actionrequired'}."|";
                $eventstring = $eventstring.$GLOBALS{'todo_raisedbyorgtype'}."|";
                $eventstring = $eventstring.$GLOBALS{'todo_raisedbyorgid'}."|";
                $eventstring = $eventstring.$GLOBALS{'todo_raisedbypersonid'}."^";
            }

            $activeaccredscheme_id = "";
            $taccredscheme_ida = Get_Array('accredscheme');
            foreach ($taccredscheme_ida as $taccredscheme_id) {
                Check_Data("accredscheme",$taccredscheme_id);
                    if ($GLOBALS{'accredscheme_active'} == "Yes") {$activeaccredscheme_id = $taccredscheme_id;}
            }

            $accredactiona = Get_Array("accredaction",$activeaccredscheme_id,$GLOBALS{'LOGIN_org_id'});
            foreach ($accredactiona as $accredaction_id) {
                Get_Data("accredaction",$activeaccredscheme_id,$GLOBALS{'LOGIN_org_id'},$accredaction_id);
                $eventstring = $eventstring."devplan"."|";
                $eventstring = $eventstring."blue"."|";
                $eventstring = $eventstring.$GLOBALS{'$accredaction_id'}."|";
                $eventstring = $eventstring.$GLOBALS{'accredaction_sectiontopic'}."|";
                $eventstring = $eventstring."allDay"."|";
                $eventstring = $eventstring.$GLOBALS{'accredaction_duedate'}."|";
                $eventstring = $eventstring.$GLOBALS{'accredaction_duedate'}."|";
                $eventstring = $eventstring.""."|";
                $personidtext = "";
                if ($GLOBALS{'accredaction_personid'} != "") {
                    $personida = List2Array($GLOBALS{'accredaction_personid'});
                    $personidtext = $personida[0];
                }
                $eventstring = $eventstring.$personidtext."|";
                $eventstring = $eventstring.$GLOBALS{'accredaction_objective'}."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.""."^";
            }

            $sfmrectification_ida = Get_Array("sfmrectification",$GLOBALS{'sfmclub_sfmfacilityidlist'});
            foreach ($sfmrectification_ida as $sfmrectification_id) {
                Get_Data("sfmrectification",$GLOBALS{'sfmclub_sfmfacilityidlist'},$sfmrectification_id);
                $eventstring = $eventstring."rect"."|";
                $eventstring = $eventstring."red"."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_id'}."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_evidencerequirement'}."|";
                $eventstring = $eventstring."allDay"."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_duedate'}."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_duedate'}."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.$GLOBALS{'LOGIN_person_id'}."|";
                $eventstring = $eventstring.$GLOBALS{'sfmrectification_fixdescription'}."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.""."|";
                $eventstring = $eventstring.""."^";
            }
        }
    }

    if ($eventstring != "") {
        $eventstring = rtrim($eventstring, "^"); // last "^"
    }
    */

    // XINBUTTONIDCLASS ("Trigger","calendarfullyearevent","Show Popup");
    // XINBUTTONIDCLASS ("Trigger","dot","Show Popup");

                $sarray = Array("todo_clubid",$_GET["OrgId"]);
		$todo = Get_Array_Select("todo",$sarray,"*");
                $sarray = Array("accredaction_clubid",$_GET["OrgId"]);
		$devplan = Get_Array_Select("accredaction",$sarray,"*");
		// print_r($devplan);
		XDIVCLASSSTYLEWIDTH("todoa","","display:none;","");
		for ($i=0; $i < sizeof($todo); $i++) {
			for ($x=0; $x < sizeof($todo[$i]); $x++) {
				// if ($x+1 == sizeof($todo[$i])) {
				if ($x == 0) {
					print (";".$todo[$i][$x]);
					// print ($todo[$i][$x].";");
				}else{
					print (",".$todo[$i][$x]);
					// print ($todo[$i][$x].",");
				}
			}
		}
    // setcookie("todolink",$link);
		X_DIV("");
    XDIVCLASSSTYLEWIDTH("todol","","display:none;","");
      $link = YPGMLINK("todoupdateout.php").YPGMSTDPARMS();
      XTDLINKTXT($link,"Update");
    X_DIV("");
    // XTXT($link);
		// print_r($todo);
		XDIVCLASSSTYLEWIDTH("devplana","","display:none;","");
		for ($i=0; $i < sizeof($devplan); $i++) {
			for ($x=0; $x < sizeof($devplan[$i]); $x++) {
				// if ($x+1 == sizeof($todo[$i])) {
				if ($x == 0) {
					print (";".$devplan[$i][$x]);
					// print ($todo[$i][$x].";");
				}else{
					print (",".$devplan[$i][$x]);
					// print ($todo[$i][$x].",");
				}
			}
		}
		// XTDLINKTXT($link,"Update");
		X_DIV("");
    XDIVCLASSSTYLEWIDTH("devplanl","","display:none;","");
      $link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
      XTDLINKTXT($link,"Update");
    X_DIV("");
		// print_r($devplan);
  // Turn eventstring into array keyed by date

  // Step 2 structure calendare

  $column = 0;
  $row = 0;
  $year = date("Y");
  $timestamp = strtotime($year.'-01-01');
  $day = date('l', $timestamp);
  $yearStart = $day;

  $maxLen = 0;
  $monthArray = array
  (
    array('January',31),
    array('February',28),
    array('March',31),
    array('April',30),
    array('May',31),
    array('June',30),
    array('July',31),
    array('August',31),
    array('September',30),
    array('October',31),
    array('November',30),
    array('December',31),
  );
  for ($i=0; $i < 12; $i++) {
    $timestamp = strtotime($year.'-'.($i+1).'-01');
    $day = date('l', $timestamp);
    switch ($day) {
      case 'Monday':
        $mod = 0;
      break;
      case 'Tuesday':
        $mod = -1;
      break;
      case 'Wednesday':
        $mod = -2;
      break;
      case 'Thursday':
        $mod = -3;
      break;
      case 'Friday':
        $mod = -4;
      break;
      case 'Saturday':
        $mod = -5;
      break;
      default:
        $mod = 1;
      break;
    }
    for ($x=$mod; $x <= $monthArray[$i][1]; $x++) {
      if ($x<1) {
        array_push($monthArray[$i],"");
      }else{
        array_push($monthArray[$i],$x);
      }
    }
    if(sizeof($monthArray[$i])>$maxLen){
      $maxLen = sizeof($monthArray[$i])-1;
    }
  }
  if ($orientation == "horizontal") {
    $dayArray = Array("S","M","T","W","T","F","S");
    $rowIter = 13;
    $colIter = $maxLen;
    $oreint = "h";
  }else{
    $dayArray = Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    $rowIter = $maxLen;
    $colIter = 13;
    $oreint = "v";
  }
  XDIV("calendarContainer","");
    // XH2($orientation." ".$year." next Year");
    XH2("Full Year Calendar View");
    XBR();
    XTABLEID("yearView");
    for ($row=0; $row < $rowIter; $row++) {
      XTR();
      for ($column=0; $column < $colIter; $column++) {
        if ($orientation == "horizontal") {
          $parm0 = $row;
          $parm1 = $column;
        }else{
          $parm0 = $column;
          $parm1 = $row;
        }
        if ($parm0 != 0) {//bodyRow
          if ($parm1 != 0) {
						$past = false;
            $monthSep = "-";
            $daySep = "-";
            if ($parm0 < 10) {
              $monthSep .= "0";
            }
            if ($parm1 < 10) {
              $daySep .= "0";
            }
            if ($monthArray[$parm0-1][$parm1+1] != "") {
              $id = "fy".$oreint.$year.$monthSep.$parm0.$daySep.$monthArray[$parm0-1][$parm1+1];
            }else{
              $id = "";
            }
            if ($monthArray[$parm0-1][$parm1+1]=="") {
              XTDCLASSID("","nonDay");
            }else if ($parm0 == date('m')&&$monthArray[$parm0-1][$parm1+1] == date('d')) {
              XTDCLASSID($id,"curDay");
            }else if ($parm0 < date('m')||($parm0 == date('m')&&$monthArray[$parm0-1][$parm1+1] <= date('d'))) {
              XTDCLASSID($id,"past");
							$past = true;
            }else{
              XTDCLASSID($id,"");
            }

            if ($orientation == "vertical"&&$parm1==0) {
              XTXT($monthArray[$parm0-1][0]);
            }else {
              XTXT($monthArray[$parm0-1][$parm1+1]);
            }
						for ($i=0; $i < sizeof($todo); $i++) {
							if(substr($id,3) == $todo[$i][11]){
								// if($past && ($todo[$i][15] == "Closed"||$todo[$i][15] != "Dropped")){
								if($past && ($todo[$i][15] == "Open"||$todo[$i][15] == "")){
									echo "<span id='".$todo[$i][2]."' class='dot todo overdue'></span>";
								}else {
									echo "<span id='".$todo[$i][2]."' class='dot todo'></span>";
								}
							}
						}
						for ($i=0; $i < sizeof($devplan); $i++) {
							if(substr($id,3) == $devplan[$i][17]){
								// echo "test";
								// echo $devplan[$i][22];
								if($past && ($devplan[$i][22] == "Open"||$devplan[$i][22] == "")){
								// if($past && ($todo[$i][22] != ("Closed"||"Dropped"))){
									// if($past && ($devplan[$i][22] != "Closed"||$devplan[$i][22] != "Dropped")){
									echo "<span id='".$devplan[$i][3]."' class='dot devplan overdue'></span>";
								}else {
									echo "<span id='".$devplan[$i][3]."' class='dot devplan'></span>";
								}
								// echo "<span class='dot'></span>";
								// CalendarFullPopup();
							}
						}
            X_TD();
          }else{
            XTHTXT($monthArray[$parm0-1][0]);
          }
        }else{//headerRow
          if ($parm0 != 0) {
              XTHTXT("");
          }else{
            if ($parm1 != 0) {
              XTDTXT($dayArray[($parm1-1)%7]);
            }else{
              XTHTXT("");
            }
          }
        }
      }
      X_TR();
    }
    X_TABLE();
  X_DIV("");
	// for ($i=0; $i < sizeof($todo); $i++) {
	// 	if(substr($id,3) == $todo[$i][11]){
	// 		// CalendarFullPopup("ToDo",$todo[$i][5],$todo[$i][4]);
	// 	}
	// }
}

function CalendarFullPopup($eventType,$title,$body) {
		// print_r($eventType.":".$title.":".$body);
    XDIVPOPUP("fullyearpopup",$eventType." Calendar Event");
    // XDIVPOPUP("calendarfullyeareventpopup","Calendar Event");

    // content of popup goes here
    XH1("");
    // XH1("Hello World".$eventType.":".$title.":".$body);
    XPTXT("");
		$link = "";
    // YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
		XAHREF($link);
		XINBUTTONID("CalendarFullPopupUpdate","Update");
		X_A();
    XINBUTTONIDSPECIAL("CalendarFullPopupCancel","warning","Cancel");
    X_DIV("calendarfullyeareventpopup");
}


function Action_CALENDARFULLLIST_Output(){
  // XDIV("fullList","");
  // XTABLE();
  // XTR();
  // X_TR();
  // XTR();
  // X_TR();
  // X_TABLE();
  // X_DIV("fullList");



    XH2("Full List of Events in Calendar");
    XBR();
    XDIV("reportdiv","container");

    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Due Date");
    XTDHTXT("Person");
    XTDHTXT("Title");
    XTDHTXT("Item Type");
    XTDHTXT("Raised By");
    XTDHTXT("Date Raised");
    XTDHTXT("Response");
    XTDHTXT("Status");
    XTDHTXT("Update");
    X_TR();
    X_THEAD();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");


    $todo_ida = Get_Array('todo',$GLOBALS{'LOGIN_org_id'});
    // print_r($todo_ida);

    foreach ($todo_ida as $todo_id) {
      Get_Data('todo',$GLOBALS{'LOGIN_org_id'},$todo_id);
      XTRJQDT();
      XTDTXT($GLOBALS{'todo_enddate'});
      XTDTXT($GLOBALS{'todo_personid'});
      XTDTXT('To do');
      XTDTXT($GLOBALS{'todo_title'});
      XTDTXT($GLOBALS{'todo_raisedbypersonid'});
      XTDTXT($GLOBALS{'todo_raiseddate'});
      XTDTXT($GLOBALS{'todo_response'});
      $statustext = "";
      if ( $GLOBALS{'todo_status'} == "" ) {
        $statustext = '<span style="color:red"><b>No Status</b></span>';
      }
      if ( $GLOBALS{'todo_status'} == "Open" ) {
       $statustext = '<span style="color:red"><b>Open</b></span>';
      }
      if ( $GLOBALS{'todo_status'} == "Closed" ) {
       $statustext = '<span style="color:green"><b>Closed</b></span>';
      }
      if ( $GLOBALS{'todo_status'} == "Dropped" ) {
       $statustext = '<span style="color:orange"><b>Dropped</b></span>';
      }
      XTDTXT($statustext);
      $link = YPGMLINK("todoupdateout.php").YPGMSTDPARMS();
      $link .= YPGMPARM("todo_id",$todo_id);
      XTDLINKTXT($link,"Update");
      // $link = $link.YPGMPARM("todo_id",$todo_id);
      //         XTDLINKTXT($link,"Delete");
      X_TR();
    }

    // $devplan_ida = Get_Array_select('accredaction','','accredaction_id');
    // $devplan_ida = dearray($devplan_ida);

    $sarray = Array('accredaction_clubid',$_GET['OrgId']);
    $devplana = Get_Array_Select('accredaction',$sarray,'accredaction_id,accredaction_personid,accredaction_sectionid,accredaction_dateraised,accredaction_duedate,accredaction_response,accredaction_status,accredaction_schemeid');
    // print_r($devplana);
    for ($i=0; $i < sizeof($devplana); $i++) {
      XTRJQDT();
      XTDTXT($devplana[$i][4]);
      XTDTXT($devplana[$i][1]);
      XTDTXT("Dev plan");
      XTDTXT($devplana[$i][2]);
      XTDTXT($devplana[$i][1]);
      XTDTXT($devplana[$i][3]);
      XTDTXT($devplana[$i][5]);
      $statustext = "";
      if ($devplana[$i][6] == "" ) {
        $statustext = '<span style="color:red"><b>No Status</b></span>';
      }
      if ($devplana[$i][6] == "Open" ) {
       $statustext = '<span style="color:red"><b>Open</b></span>';
      }
      if ($devplana[$i][6] == "Closed" ) {
       $statustext = '<span style="color:green"><b>Closed</b></span>';
      }
      if ($devplana[$i][6] == "Dropped" ) {
       $statustext = '<span style="color:orange"><b>Dropped</b></span>';
      }
      XTDTXT($statustext);
      $link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
      $link .= "&accredaction_schemeid=".$devplana[$i][7];
      $link .= "&accredaction_clubid=".$_GET['OrgId'];
      $link .= "&accredaction_id=".$devplana[$i][0];
      XTDLINKTXT($link,"Update");
      X_TR();
    }
  X_TBODY();
  X_TABLE();
  X_DIV("reportdiv");
  XCLEARFLOAT();

}

?>
