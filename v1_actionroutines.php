<?php
# actionroutines.php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

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
			XTDTXT(Replace_LF($GLOBALS{'action_submitter'},"<br>"));
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
}

function Action_TODOVIEWLIST_Output ($tofilter) {
// 		XH1(isMobile());
	// XH1($_SERVER['HTTP_USER_AGENT']);
    XH3("ToDo List");
    XHR();
    XFORMUPLOAD("todoupdateout.php","todoupdate");
    XINSTDHID();
    XINHID("todo_id","New");
    XINHID("returnAddress",YPGMLINK("todoviewlistout.php").YPGMSTDPARMS());
    XINSUBMIT("Add New ToDo Item");
    X_FORM();
    XBR();


    XDIV("reportdiv","container");
    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Person");
    XTDHTXT("Title");
    XTDHTXT("Action Required");
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
        XTRJQDT();
        XTDTXT($GLOBALS{'todo_personid'});
        XTDTXT($GLOBALS{'todo_title'});
        XTDTXT(Replace_LF($GLOBALS{'todo_actionrequired'},"<br>"));
        XTDTXT($GLOBALS{'todo_raisedbypersonid'});
        // XTDTXT(XSPANHIDDEN($GLOBALS{'todo_raiseddate'}).$newDate);
        XTDDATESORT($GLOBALS{'todo_raiseddate'});
        // echo"<td><span style='visibility:hidden; font-size:0em;'>".$GLOBALS{'todo_raiseddate'}."</span>".$newDate."</td>";
        XTDDATESORT($GLOBALS{'todo_enddate'});
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
        $link = YPGMLINK("tododeleteconfirm.php").YPGMSTDPARMS();
        $link = $link.YPGMPARM("todo_id",$todo_id);
        XTDLINKTXT($link,"Delete");
        X_TR();
    }
    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");
    XCLEARFLOAT();
}

function Action_TODOUPDATE_CSSJS() {
    if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"sfm"))>0) { // specific name selection
        $GLOBALS{'SITECSSOPTIONAL'} = "datepicker,jqueryconfirm";
        $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,jqueryconfirm";
    } else {
        $GLOBALS{'SITECSSOPTIONAL'} = "datepicker,jqueryconfirm";
        $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,personselectionpopup,jqueryconfirm";
        $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
    }
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
		$_POST['returnAddress'] = $_SERVER['HTTP_REFERER'];

    XFORMUPLOAD("todoupdatein.php","todoupdate");
    XINSTDHID();
    XINHID("todo_id",$GLOBALS{'todo_id'});
    XINHID("returnAddress",$_POST['returnAddress']);

    if ( $ttodo_id == "New" ) {
        XINHID("todo_raisedbypersonid",$GLOBALS{'LOGIN_person_id'});
        XINHID("todo_raiseddate",$GLOBALS{'currentYYYY-MM-DD'});
    }


    XBR();
    BROW();
    BCOLTXT("Title","1");
    BCOLINTXTID('todo_title','todo_title',$GLOBALS{'todo_title'},"4");
    B_ROW();

    XBR();
    BROW();
    BCOLTXT("Action Required","1");
    BCOLINTEXTAREAID('todo_actionrequired','todo_actionrequired',$GLOBALS{'todo_actionrequired'},"5","10");
    B_ROW();

    if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"sfm"))>0) { // specific name selection
        XBR();
        BROW();
        BCOLTXT("ToDo Actionee","1");
        BCOL("4");
        if ( $_REQUEST['OrgTypeId'] == "NGB" ) {
            $carray = Array('sfmngb_id = "'.$_REQUEST['OrgId'].'"');
            $people = Get_Array_Select2("sfmngb",$carray,"sfmngb_adminpersonid, sfmngb_otheradminpersonidlist");
        }
        if ( $_REQUEST['OrgTypeId'] == "County" ) {
            $carray = Array('sfmcounty_id = "'.$_REQUEST['OrgId'].'"');
            $people = Get_Array_Select2("sfmcounty",$carray,"sfmcounty_adminpersonid, sfmcounty_otheradminpersonidlist");
        }
        if ( $_REQUEST['OrgTypeId'] == "League" ) {
            $carray = Array('sfmleague_id = "'.$_REQUEST['OrgId'].'"');
            $people = Get_Array_Select2("sfmleague",$carray,"sfmleague_adminpersonid, sfmleague_otheradminpersonidlist");
        }
        if ( $_REQUEST['OrgTypeId'] == "Division" ) {
            $carray = Array('sfmdivision_id = "'.$_REQUEST['OrgId'].'"');
            $people = Get_Array_Select2("sfmdivision",$carray,"sfmdivision_adminpersonid, sfmdivision_otheradminpersonidlist");
        }
        if ( $_REQUEST['OrgTypeId'] == "Club" ) {
            $carray = Array('sfmclub_id = "'.$_REQUEST['OrgId'].'"');
            $people = Get_Array_Select2("sfmclub",$carray,"sfmclub_adminpersonid, sfmclub_otheradminpersonidlist");
        }

        $hash = HashLists2Hash($people);
        foreach ( $hash as $key ) {
            Check_Data("person",$key);
            if ($GLOBALS{'IOWARNING'} == "0") { $hash[$key] = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
            else { unset($hash[$key]); }
        }
        BINCHECKBOXHASH ($hash,"todo_personid",$GLOBALS{'todo_personid'});
        B_COL();
        B_ROW();
    } else {
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
    }
    XBR();
    BROW();
    BCOLTXT("Due Date","1");
    BCOLINDATEID('todo_enddate','todo_enddate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'todo_enddate'}),'dd/mm/yyyy',"3");
    /*
    BCOLTXT("Reminder Leadtime","1");
    $xhash = List2Hash("Day,Week,Month");
    BCOL("2");
    BINSELECTHASH($xhash,'todo_reminderleadtime',$GLOBALS{'todo_reminderleadtime'});
    B_COL();
    BCOLTXT("Recurring Item","1");
    $xhash = List2Hash("Daily,Weekly,Monthly");
    BCOL("2");
    BINSELECTHASH($xhash,'todo_recurring',$GLOBALS{'todo_recurring'});
    B_COL();
     */
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
    BINSELECTHASHNOQ($xhash,'todo_status',$GLOBALS{'todo_status'});
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
  $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,moment,fullcalendarmin,fullcalendargcalmin,calendar,calendarfullyear";
	$GLOBALS{'SITEPOPUPHTML'} = "CalendarFullPopup";
}

function Action_CALENDAR_Output($filter) {
	echo <<<EOT
	<div id="calendar"></div>
EOT;


	$sarray = Array("todo_clubid",$_GET["OrgId"]);
	$todo = Get_Array_Select("todo",$sarray,"*");
	$sarray = Array("accredaction_clubid",$_GET["OrgId"]);
	$devplan = Get_Array_Select("accredaction",$sarray,"*");
	XDIVCLASSSTYLEWIDTH("todoa","","display:none;","");
	for ($i=0; $i < sizeof($todo); $i++) {
		for ($x=0; $x < sizeof($todo[$i]); $x++) {
			if ($x == 0) {
				print (";".$todo[$i][$x]);
			}else{
				print (",".$todo[$i][$x]);
			}
		}
	}
	X_DIV("");
	XDIVCLASSSTYLEWIDTH("todol","","display:none;","");
		$link = YPGMLINK("todoupdateout.php").YPGMSTDPARMS();
		XTDLINKTXT($link,"Update");
	X_DIV("");
	XDIVCLASSSTYLEWIDTH("devplana","","display:none;","");
	for ($i=0; $i < sizeof($devplan); $i++) {
		for ($x=0; $x < sizeof($devplan[$i]); $x++) {
			if ($x == 0) {
				print (";".$devplan[$i][$x]);
			}else{
				print (",".$devplan[$i][$x]);
			}
		}
	}
	X_DIV("");
	XDIVCLASSSTYLEWIDTH("devplanl","","display:none;","");
		$link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
		XTDLINKTXT($link,"Update");
	X_DIV("");
	XBR();
}

function ACTION_CAL_HEADER($url){
	XDIV("CalHeader","row");
		BCOL("2");
			ACTION_ADD_CAL_EVENT($url);
		B_COL();
		BCOL("4");
		if(isset($_SESSION['year'])){
				ACTION_CAL_YEAR_PICKER($url);
			}
		B_COL();
		ACTION_CAL_NAV("6");
	B_ROW();
}

function ACTION_CAL_YEAR_PICKER($url){

// 	$link = YPGMLINK("calendarfulllistout.php").YPGMSTDPARMS();
// 	XLINKBUTTONSPECIAL ($link,$nameA[0],$fl);
    $url = substr($_SERVER['REQUEST_URI'],16,20);
	switch ($url) {
		case 'v1_calendarout.php?S':
			$ca = "default";
			break;
		case 'v1_calendarfulllisto':
			$fl = "default";
			break;
		case 'v1_calendarfullyearh':
			$v1 = "default";
			$url = "calendarfullyearhout.php";
			break;
		case 'v1_calendarfullyearv':
			$v2 = "default";
			$url = "calendarfullyearvout.php";
			break;
		case 'v1_calendarfullyearo':
			$v3 = "default";
			$url = "calendarfullyearout3.php";
			break;
	}
	$link = YPGMLINK($url).YPGMSTDPARMS().("&year=".($_SESSION['year']-1));
	XLINKBUTTONSPECIAL ($link,$_SESSION['year']-1,"info");
	XLINKBUTTONSPECIAL ("",$_SESSION['year'],"default");
	$link = YPGMLINK($url).YPGMSTDPARMS().("&year=".($_SESSION['year']+1));
	XLINKBUTTONSPECIAL ($link,$_SESSION['year']+1,"info");
	$curYear = date('Y');
	$link = YPGMLINK($url).YPGMSTDPARMS().("&year=".$curYear);
	XLINKBUTTONSPECIAL ($link,"Current Year","info");
}

function ACTION_ADD_CAL_EVENT($url){
	if((isset($_REQUEST['accredscheme_id'])&&$_REQUEST['accredscheme_id']!="")) {
	    $thisaccredscheme_id = $_REQUEST['accredscheme_id'];
	} else {
	    $thisaccredscheme_id = "";
	    $taccredscheme_ida = Get_Array('accredscheme');
	    foreach ($taccredscheme_ida as $taccredscheme_id) {
	        Check_Data("accredscheme",$taccredscheme_id);
	            if ($GLOBALS{'accredscheme_active'} == "Yes" && $GLOBALS{'accredscheme_type'} == "Normal") {$thisaccredscheme_id = $taccredscheme_id;}
	    }
	}
	$thisclubid = $GLOBALS{'LOGIN_org_id'};
	if((isset($_REQUEST['accredaction_clubid'])&&$_REQUEST['accredaction_clubid']!="")) {
	    $thisclubid = $_REQUEST['accredaction_clubid'];
	}
	$taccredcriteria_clubid = $thisclubid;
	$activeaccredscheme_id = $thisaccredscheme_id;

	BROW();
	XFORMUPLOAD("todoupdateout.php","todoupdate");
	XINSTDHID();
	// XINHID("returnAddress",$url);
	XINHID("todo_id","New");
	XINSUBMIT("+ ToDo");
	X_FORM();

	XFORMUPLOAD("accredactionupdateout.php","accredactionupdate");
	XINSTDHID();
	XINHID("accredaction_schemeid",$activeaccredscheme_id);
	XINHID("accredaction_clubid",$taccredcriteria_clubid);
	// XINHID("returnAddress",$url);
	XINHID("accredaction_id","New");
	XINSUBMIT("+ Action");
	X_FORM();
	B_ROW();
}

function ACTION_CAL_NAV($col){
	// var_dump($_SERVER['request_url']);
	$fl = "info";
	$v1 = "info";
	$v2 = "info";
	$v3 = "info";
	$ca = "info";
	//16 for dev, 10 for live
	$url = substr($_SERVER['REQUEST_URI'],16,20);
	// XTXT($url);
	switch ($url) {
		case 'v1_calendarout.php?S':
			$ca = "default";
			break;
		case 'v1_calendarfulllisto':
			$fl = "default";
			break;
		case 'v1_calendarfullyearh':
			$v1 = "default";
			break;
		case 'v1_calendarfullyearv':
			$v2 = "default";
			break;
		case 'v1_calendarfullyearo':
			$v3 = "default";
			break;
	}
	// XTXT($url);
	BCOLRIGHT($col);
	if (isMobile() == 1) {
		$nameA = ['List','YV1','YV2','YV3','Cal'];
	}else {
		$nameA = ['Full List','Year View 1','Year View 2','Year View 3','Calendar'];
	}
	$link = YPGMLINK("calendarfulllistout.php").YPGMSTDPARMS();
	XLINKBUTTONSPECIAL ($link,$nameA[0],$fl);
	$link = YPGMLINK("calendarfullyearhout.php").YPGMSTDPARMS();
	XLINKBUTTONSPECIAL ($link,$nameA[1],$v1);
	$link = YPGMLINK("calendarfullyearvout.php").YPGMSTDPARMS();
	XLINKBUTTONSPECIAL ($link,$nameA[2],$v2);
	$link = YPGMLINK("calendarfullyearout3.php").YPGMSTDPARMS();
	XLINKBUTTONSPECIAL ($link,$nameA[3],$v3);
	$link = YPGMLINK("calendarout.php").YPGMSTDPARMS();
	XLINKBUTTONSPECIAL ($link,$nameA[4],$ca);
	B_COL();
}

function ACTION_PREP_CAL_EVENTS(){
	//retpo
	$sarray = Array("todo_clubid",$_GET["OrgId"]);
	$todo = Get_Array_Select("todo",$sarray,"*");
	$todo = ACTION_ASSOC_ARRAY($todo,GET_COLUMN_NAMES("todo"));
	$sarray = Array("accredaction_clubid",$_GET["OrgId"]);
	$devplan = Get_Array_Select("accredaction",$sarray,"*");
	$devplan = ACTION_ASSOC_ARRAY($devplan,GET_COLUMN_NAMES("accredaction"));
	//sfmfloodlightvisit_nextdate
	$nextDates = Get_Array_Select2("sfmfloodlightvisit
JOIN sfmteam on sfmteam.sfmteam_sfmfacilityidlist = sfmfloodlightvisit.sfmfloodlightvisit_sfmfacilityid",["sfmteam_id ='".$_GET["OrgId"]."'"],"sfmteam_id, sfmfloodlightvisit_sfmfacilityid, MAX(sfmfloodlightvisit_nextdate)");
	XDIVCLASSSTYLEWIDTH("todoa","","display:none;","");
	// XDIVCLASSSTYLEWIDTH("todoa","","","");
	// print_r($todo);
	// XBR();
	for ($i=0; $i < sizeof($todo); $i++) {
		print(";");
		foreach ($todo[$i] as $key) {
			print($key.",");
		}
		XBR();
	}
	X_DIV("");
	XDIVCLASSSTYLEWIDTH("todol","","display:none;","");
		$link = YPGMLINK("todoupdateout.php").YPGMSTDPARMS();
		XTDLINKTXT($link,"Update");
	X_DIV("");
	XDIVCLASSSTYLEWIDTH("devplana","","display:none;","");
	// XDIVCLASSSTYLEWIDTH("devplana","","","");
	for ($i=0; $i < sizeof($devplan); $i++) {
		print(";");
		foreach ($devplan[$i] as $key) {
			print($key.",");
		}
		XBR();
	}
	X_DIV("");
	XDIVCLASSSTYLEWIDTH("devplanl","","display:none;","");
		$link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
		XTDLINKTXT($link,"Update");
	X_DIV("");
	// Step 2 structure calendar

	$column = 0;
	$row = 0;
	if (isset($_GET['year'])) {
		$year = $_GET['year'];
	}else {
		$year = date('Y');
	}
	$curYear = date('Y');
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
	if (isleapyear($year)) {
		$monthArray[1][1]+=1;
	}
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
	return array($maxLen, $monthArray, $year, $curYear, $todo, $devplan, $nextDates);
}

function Action_CALENDARFULLYEAR_CSSJS() {
  $GLOBALS{'SITECSSOPTIONAL'} = "fullcalendarmin,jqdatatables";
  $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,calendarfullyear,jqdatatablesmin,report,moment";
  $GLOBALS{'SITEPOPUPHTML'} = "CalendarFullPopup";
}


function Action_CALENDARFULLYEAR_Output($orientation){
	list($maxLen, $monthArray, $year, $curYear, $todo, $devplan, $nextDates) = ACTION_PREP_CAL_EVENTS();
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
	// print_r($devplan);
	// XBR();
  XDIV("calendarContainer","");
    // XBR();XBR();
    // XH2("Full Year Calendar View");
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
            }else if ($parm0 == date('m')&&$monthArray[$parm0-1][$parm1+1] == date('d')&&$year == $curYear) {
              XTDCLASSID($id,"curDay");
            }else if (($parm0 < date('m')&&$year == $curYear)||($parm0 == date('m')&&$monthArray[$parm0-1][$parm1+1] <= date('d')&&$year == $curYear)||$year < $curYear) {
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
            // print_r(($nextDates));
            if(isset($nextDates[0][2])){
                for ($i=0; $i < sizeof($nextDates); $i++) {
                    // xtxt($id.":".$nextDates[$i][2]);
                    if(substr($id,3) == $nextDates[$i][2]){
                        echo "<span id='".$nextDates[$i][2]."' class='dot visitDate'></span>";
                    }
                }
            }
						for ($i=0; $i < sizeof($todo); $i++) {
							// xtxt($id.":".$todo[$i]['todo_enddate']);
							if(substr($id,3) == $todo[$i]['todo_enddate']){
								if($past && ($todo[$i]['todo_status'] == "Open"||$todo[$i]['todo_status'] == "")){
									$overdue=" overdue";
								}else{
									$overdue = "";
								}
								echo "<div id='".$todo[$i]['todo_id']."' class='dot todo".$overdue."  CellWithComment'><span class='CellComment'>".$todo[$i]['todo_title']."</span></div>";
							}
						}
						for ($i=0; $i < sizeof($devplan); $i++) {
							if(substr($id,3) == $devplan[$i]['accredaction_duedate']){
								if($past && ($devplan[$i]['accredaction_status'] == "Open"||$devplan[$i]['accredaction_status'] == "")){
									$overdue=" overdue";
								}else{
									$overdue = "";
								}
								echo "<div id='".$devplan[$i]['accredaction_id']."' class='dot devplan".$overdue."  CellWithComment'><span class='CellComment'>".$devplan[$i]['accredaction_sectiontopic']."</span></div>";
								//
								// if($past && ($devplan[$i][22] == "Open"||$devplan[$i][22] == "")){
								// 	echo "<span id='".$devplan[$i][3]."' class='dot devplan overdue'></span>";
								// }else {
								// 	echo "<span id='".$devplan[$i][3]."' class='dot devplan'></span>";
								// }
							}
						}
            X_TD();
          }else{
						XTHCLASSID("","headers".$oreint);
						XTXT($monthArray[$parm0-1][0]);
						X_TH();
          }
        }else{//headerRow
          if ($parm0 != 0) {
              // XTHTXT("");
							XTDCLASSID("","headers".$oreint);
							// XTXT($dayArray[($parm1-1)%7]);
							X_TD();
          }else{
            if ($parm1 != 0) {
							XTDCLASSID("","headers".$oreint);
              XTXT($dayArray[($parm1-1)%7]);
							X_TD();
              // XTDTXT($dayArray[($parm1-1)%7]);
            }else{
              // XTHTXT("");
							XTDCLASSID("","headerBlank");
							// XTXT($dayArray[($parm1-1)%7]);
							X_TD();
            }
          }
        }
      }
      X_TR();
    }
    X_TABLE();
  X_DIV("");
}

function CalendarFullPopup($eventType,$title,$body) {
    XDIVPOPUP("fullyearpopup",$eventType." Calendar Event");
    // content of popup goes here
    XH1("");
    XPTXT("");
    $link = "";
    XAHREF($link);
    XINBUTTONID("CalendarFullPopupUpdate","Update");
    X_A();
    XINBUTTONIDSPECIAL("CalendarFullPopupCancel","warning","Cancel");
    X_DIV("calendarfullyeareventpopup");
}


function Action_CALENDARFULLLIST_Output(){



    XDIV("reportdiv","container");

    XTABLEJQDTID("reporttable_list");
    XTHEAD();
    XTRJQDT();
    XTDHTXT("Due Date");
    XTDHTXT("Person");
    XTDHTXT("Item Type");
    XTDHTXT("Description");
    XTDHTXT("Action Taken");
    XTDHTXT("Status");
    XTDHTXT("Update");
    X_TR();
    X_THEAD();
    X_THEAD();
    XTBODY();
    XINHID("list_sortcol","0");
    $todo_a = Get_TableData('todo','enddate,personid,actionrequired,response,status',$GLOBALS{'LOGIN_org_id'});
    foreach ($todo_a as $todo) {
      XTDDATESORT($todo['enddate']);
      XTDTXT($todo['personid']);
      XTDTXT('To do');
      XTDTXT($todo['actionrequired']);
      XTDTXT($todo['response']);
			switch ($todo['status']) {
				case 'Dropped':
					$statustext = '<span style="color:orange"><b>Dropped</b></span>';
					break;
				case 'Closed':
					$statustext = '<span style="color:green"><b>Closed</b></span>';
					break;
				case 'Open':
					$statustext = '<span style="color:red"><b>Open</b></span>';
					break;
				default:
					$statustext = '<span style="color:red"><b>No Status</b></span>';
					break;
			}
      XTDTXT($statustext);
      $link = YPGMLINK("todoupdateout.php").YPGMSTDPARMS();
      $link .= YPGMPARM("todo_id",$todo_id);
      XTDLINKTXT($link,"Update");
      X_TR();
    }
    $sarray = Array('accredaction_clubid',$_GET['OrgId']);
    // $devplana = Get_Array_Select('accredaction',$sarray,'accredaction_id,accredaction_personid,accredaction_sectiontopic,accredaction_duedate,accredaction_response,accredaction_status,accredaction_schemeid');
		// XTXT("test");
		// print_r($GLOBALS{'LOGIN_org_id'});
		$devplan_ida = Get_Array_Select2('accredaction',['accredaction_clubid="'.$GLOBALS{"LOGIN_org_id"}.'"'],'accredaction_id, accredaction_duedate, accredaction_personid, accredaction_objective, accredaction_response, accredaction_status, accredaction_schemeid');
		$devPlanNames=[['id'],['dueDate'],['person'],['objective'],['response'],['status'],['schemeid']];
		$devplanA = ACTION_ASSOC_ARRAY($devplan_ida,$devPlanNames);
    foreach ($devplanA as $devplan_id) {
      XTRJQDT();
      XTDDATESORT($devplan_id{'dueDate'});
      XTDTXT($devplan_id{'person'});
      XTDTXT("Dev plan");
			XTDTXT($devplan_id{'objective'});
			XTDTXT($devplan_id{'response'});
			switch ($devplan_id{'status'}) {
				case 'Open':
					$statustext = '<span style="color:red"><b>Open</b></span>';
					break;
				case 'Closed':
					$statustext = '<span style="color:green"><b>Closed</b></span>';
					break;
				case 'Dropped':
					$statustext = '<span style="color:orange"><b>Dropped</b></span>';
					break;
				default:
					$statustext = '<span style="color:red"><b>No Status</b></span>';
					break;
			}
      XTDTXT($statustext);
      $link = YPGMLINK("accredactionupdateout.php").YPGMSTDPARMS();
      $link .= "&accredaction_schemeid=".$devplan_id{'schemeid'};
      $link .= "&accredaction_clubid=".$_GET['OrgId'];
      $link .= "&accredaction_id=".$devplan_id{'id'};
      XTDLINKTXT($link,"Update");
      X_TR();
    }
  X_TBODY();
  X_TABLE();
  X_DIV("reportdiv");
  XCLEARFLOAT();

}

function calendarFullYearMonths($columns){
	list($maxLen, $monthArray, $year, $curYear, $todo, $devplan) = ACTION_PREP_CAL_EVENTS();
	$month = 0;
	$rows = (12/$columns);
	for ($i=0; $i < $rows; $i++) {
		BROW();
		for ($x=0; $x < $columns; $x++) {
			if ($month < 12) {
				BCOL($rows);
					calMonth($month,$monthArray,$todo,$devplan,$year,$curYear);
				B_COL();
			}
			$month++;
		}
		B_ROW();
		XBR();
	}
	XBR();
}

function isleapyear($year)
{
    return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
}


function calMonth($month,$monthArray,$todo,$devplan,$year,$curYear){
	// print_r($todo);
	XBR();XBR();
        XTABLECLASS("","calMonth");
		XTR();
			XTHCOL("7");
				XTXT($monthArray[$month][0]);
			X_TH();
		X_TR();
		XTR();
			XTDTXT("Sun");
			XTDTXT("Mon");
			XTDTXT("Tue");
			XTDTXT("Wed");
			XTDTXT("Thu");
			XTDTXT("Fri");
			XTDTXT("Sat");
		X_TR();
		for ($day=2; $day < sizeof($monthArray[$month]); $day++) {
			XTR();
			for ($x=0; $x < 7; $x++) {
				$monthSep = "-";
				$daySep = "-";
				if ($month < 10) {
					$monthSep .= "0";
				}
				if ($day < 11) {
					$daySep .= "0";
				}
				$id = $year.$monthSep.($month+1).$daySep.$monthArray[$month][$day];
				$past = false;
				if ($monthArray[$month][$day]=="") {
					XTDCLASSID("","nonDay");
				}else if ($month+1 == date('m')&&$monthArray[$month][$day] == date('d')&&$year == $curYear) {
					XTDCLASSID($id,"curDay");
				}else if (($month+1 < date('m')&&$year == $curYear)||($month+1 == date('m')&&$monthArray[$month][$day] <= date('d')&&$year == $curYear)||$year < $curYear) {
					XTDCLASSID($id,"past");
					$past = true;
				}else{
					XTDCLASSID($id,"");
				}
				XTXT($monthArray[$month][$day]);
				// if($id == $nextDate);
				for ($i=0; $i < sizeof($todo); $i++) {
					// xtxt($id.":".$todo[$i]['todo_enddate']);
					if($id == $todo[$i]['todo_enddate']){
						if($past && ($todo[$i]['todo_status'] == "Open"||$todo[$i]['todo_status'] == "")){
							$overdue=" overdue";
						}else{
							$overdue = "";
						}
						echo "<div id='".$todo[$i]['todo_id']."' class='dot todo".$overdue."  CellWithComment'><span class='CellComment'>".$todo[$i]['todo_title']."</span></div>";
					}
				}
				for ($i=0; $i < sizeof($devplan); $i++) {
					if($id == $devplan[$i]['accredaction_duedate']){
						if($past && ($devplan[$i]['accredaction_status'] == "Open"||$devplan[$i]['accredaction_status'] == "")){
							$overdue=" overdue";
						}else{
							$overdue = "";
						}
						echo "<div id='".$devplan[$i]['accredaction_id']."' class='dot devplan".$overdue."  CellWithComment'><span class='CellComment'>".$devplan[$i]['accredaction_sectiontopic']."</span></div>";
						//
						// if($past && ($devplan[$i][22] == "Open"||$devplan[$i][22] == "")){
						// 	echo "<span id='".$devplan[$i][3]."' class='dot devplan overdue'></span>";
						// }else {
						// 	echo "<span id='".$devplan[$i][3]."' class='dot devplan'></span>";
						// }
					}
				}
				X_TD();
				$day++;
			}
			$day--;
			X_TR();
		}
	X_TABLE();
}

function ACTION_ASSOC_ARRAY($array,$fieldnames){
	$newA = Array();
	for ($i=0; $i < sizeof($array); $i++) {
		for ($x=0; $x < sizeof($array[$i]); $x++) {
			$newA[$i][$fieldnames[$x][0]] = $array[$i][$x];
		}
	}
	return $newA;
}

function Action_ISSUEREPORT_CSSJS () {
  $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
  $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report,rememberbtab,issuereport";
}

function Action_JQDataTable_Output ($tableName,$names,$tableData) {
	XBR();
	BROW();
	 BCOL("6");
    XFORMUPLOAD($tableName."update.php","issueupdate");
    XINSTDHID();
    XINHID($tableName."_id","New");
    XINSUBMIT("Add New ".ucfirst($tableName));
    X_FORM();
    XBR();
		B_COL();
		$tableStats = Get_Array_Select2($tableName,[$tableName."_domainid = 'sfm' LIMIT 1"],"(SELECT count(".$tableName."_status) from ".$tableName." where ".$tableName."_status = 'Open'),
		(SELECT count(".$tableName."_status) from ".$tableName." where ".$tableName."_status = 'Closed'),
		(SELECT count(".$tableName."_status) from ".$tableName." where ".$tableName."_status = 'Fixed'),
		(SELECT count(".$tableName."_status) from ".$tableName." where ".$tableName."_status = 'Dropped'),
		(SELECT count(".$tableName."_status) from ".$tableName." where ".$tableName."_status = 'Archived')");
		BCOLRIGHT("5");
			XDIV("filter","");
				XINCHECKIDLABEL("Open".$tableName,"Open".$tableName,"checked","Open:".$tableStats[0][0]);
				XINCHECKIDLABEL("Fixed".$tableName,"Fixed".$tableName,"checked","Fixed:".$tableStats[0][2]);
				XINCHECKIDLABEL("Closed".$tableName,"Closed".$tableName,"checked","Closed:".$tableStats[0][1]);
				XINCHECKIDLABEL("Dropped".$tableName,"Dropped".$tableName,"checked","Dropped:".$tableStats[0][3]);
				XINCHECKIDLABEL("Archived".$tableName,"Archived".$tableName,"","Archived:".$tableStats[0][4]);
			X_DIV("");
		B_COL();
		// BCOLRIGHT("3");
	  // /*
	  // $tableStats = Get_Array_Select2($tableName,["problem_domainid = 'sfm' LIMIT 1"],"(SELECT count(problem_status) from problem where problem_status = 'Open'),
	  // (SELECT count(problem_status) from problem where problem_status = 'Closed'),
	  // (SELECT count(problem_status) from problem where problem_status = 'Dropped'),
	  // (SELECT count(problem_status) from problem where problem_status = 'Archived')");*/
		// $tableStatsNames = ['Open','Closed','Dropped','Archived'];
		// for ($i=0; $i < sizeOf($tableStats[0]); $i++) {
		// 	XTXT($tableStatsNames[$i].":".$tableStats[0][$i]."  ");
		// }
		// XBR();
		// B_COL();
		BCOL("1");
		B_COL();
		B_ROW();
		// XTXT("test");

		// XDIV("reportdiv_".$tableName,"container");
			XTABLEJQDTID("reporttable_".$tableName);
		// XDIV("reportdiv_".$tableName,"container");
		// XTABLEJQDTID("reporttable_list_".$tableName);
			// XTABLEJQDTID("reporttable_".$tableName."_list");
				XTHEAD();
					XTRJQDT();
						for ($i=0; $i < sizeof($names); $i++) {
						  XTDHTXT($names[$i]);
							if ($names[$i] == "image") {
								$i++;
							}
						}
						if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
							XTDHTXT("");
						}
					X_TR();
		    X_THEAD();
		    XTBODY();
				// XINHID($tableName."_sortcol","1");
				if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
					XINHID($tableName."_sortcol","1,4,0");
					XINHID($tableName."_sortseq","desc,asc,asc");
				}else {
					XINHID($tableName."_sortcol","1,4,5");
					XINHID($tableName."_sortseq","desc,desc,asc");
				}
					for ($i=0; $i < sizeof($tableData); $i++) {
					  for ($x=0; $x < sizeof($tableData[$i]); $x++) {
							if ($names[$x] == "image") {
								$str = 0;
								if(strlen($tableData[$i][$x])){$str += 1;}
								if(strlen($tableData[$i][$x+1])){$str += 1;}
								if ($str > 0) {
									XTDTXT("Yes ".$str);
								}else {
									XTDTXT("No");
								}
								$x++;
							}else	if ($names[$x] == "description") {
								if(strlen($tableData[$i][$x]) > 30){
									XTDCLASSID("","hiddenText");
									XTXT(substr($tableData[$i][$x],0,30)."<span>".substr($tableData[$i][$x],30)."</span>");
									X_TD();
								}else{
									XTDTXT($tableData[$i][$x]);
								}
							}else	if ($names[$x] == "fixdescription") {
								if(strlen($tableData[$i][$x]) > 30){
									XTDCLASSID("","hiddenText");
									XTXT(substr($tableData[$i][$x],0,30)."<span>".substr($tableData[$i][$x],30)."</span>");
									X_TD();
								}else{
									XTDTXT($tableData[$i][$x]);
								}
							}else	if ($names[$x] == "status") {
								XTDCLASSID("",$tableData[$i][$x].$tableName);
								XTXT($tableData[$i][$x]);
								X_TD();
							}else{
								XTDTXT($tableData[$i][$x]);
							}
					  }
						if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
			        $link = YPGMLINK($tableName."update.php").YPGMSTDPARMS();
			        $link = $link.YPGMPARM($tableName."_id",$tableData[$i][0]);
			        XTDLINKTXT($link,"Update");
						}
					  X_TR();
					}
				X_TBODY();
			X_TABLE();
    XCLEARFLOAT();
}

function BTAB($tabNames,$content,$names){
	if ( $currenttab == "" ) { $currenttab = "Tab0"; }
	BTABDIV('accredactiontabmenu');
	BTABHEADERCONTAINER();
	$firstsection = "0";
	for ($i=0; $i < sizeof($tabNames); $i++) {
		$thistab = "Tab".$i;
		if ( $thistab == $currenttab ) {
			BTABHEADERITEMACTIVE($thistab,ucfirst($tabNames[$i]));
		} else {
			BTABHEADERITEM($thistab,ucfirst($tabNames[$i]));
		}
	}
	B_TABHEADERCONTAINER();
	BTABCONTENTCONTAINER();
	for ($i=0; $i < sizeof($tabNames); $i++) {
		$thistab = "Tab".$i;
		if ( $thistab == $currenttab ) {
				BTABCONTENTITEMACTIVE($thistab);
		} else {
				BTABCONTENTITEM($thistab);
		}
		Action_JQDataTable_Output($tabNames[$i],$names[$i], $content[$i]);
		B_TABCONTENTITEM();
	}
	B_TABCONTENTCONTAINER();
	B_TABDIV();
}

function Action_ISSUEUPDATE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,personselectionpopup,slimjquerymin,slimimagepopup,jqueryconfirm,issueroutines";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Action_ISSUEUPDATE_Output($tissue_id,$issueType) {
	XINHID("curDate",date('d/m/Y'));
	XFORMUPLOAD($issueType."updatein.php",$issueType."update");
    if ( $tissue_id == "New" ) {
	    Initialise_Data($issueType);
	    $GLOBALS{$issueType.'_clubid'} = $GLOBALS{'LOGIN_org_id'};
	    $GLOBALS{$issueType.'_id'} = $GLOBALS{'currenttimestamp'};
    	XH2("New ".ucfirst($issueType));
    } else {
      $itarray = Array($issueType."_id = '".$tissue_id."'");
      $GLOBALS['priorData'] = Get_Array_Select2($issueType,$itarray,"*");
      XH2(ucfirst($issueType)." Item Update");
      $GLOBALS[$issueType.'_id'] = $tissue_id;
			$tableNames = Get_Array_Select2("information_schema.columns",["table_name='".$issueType."'"],"COLUMN_NAME");
			for ($i=0; $i < sizeof($tableNames); $i++) {
				// XINHID("pd".$tableNames[$i][0],$GLOBALS['priorData'][0][$i]);
				$priorData[$tableNames[$i][0]] = $GLOBALS['priorData'][0][$i];
			}
    }
    XINSTDHID();
    if ( $tissue_id == "New" ) {
      XINHID($issueType."_raisedbypersonid",$GLOBALS{'LOGIN_person_id'});
      XINHID($issueType."_raiseddate",$GLOBALS{'currentYYYY-MM-DD'});
      XINHID("new",1);
    }else{
			XINHID("new",0);
		}
		XINHID($issueType.'_id',$GLOBALS{$issueType.'_id'});
    XTXT("Fields with a * next to them are mandatory");
    XBR();
    BROW();
    BCOLTXT("Title*","1");
    if ($priorData[$issueType.'_title']) {
        BCOLINTXTIDRQD($issueType.'_title',$issueType.'_title',$priorData[$issueType.'_title'].'" maxlength="50"',"4");
    }else{
        BCOLINTXTIDRQD($issueType.'_title',$issueType.'_title','" placeholder="'.ucfirst($issueType).' Title" maxlength="50"',"4");
    }
    // XTXTIDCLASS("titleCharCount","charCount","");
    B_ROW();
    XBR();
    BROW();
    BCOLTXT("Description*","1");
    if ($priorData[$issueType.'_description']) {
      BCOLINTEXTAREAIDRQD($issueType.'_description',$issueType.'_description"  maxlength="2500',$priorData[$issueType.'_description'],"5","10");
    }else if($issueType == "problem"){
      BCOLINTEXTAREAIDRQD($issueType.'_description',$issueType.'_description" placeholder="Please enter as much detail as you can about the problem that you have encountered." maxlength="2500"','',"5","10");
    }else{
      BCOLINTEXTAREAIDRQD($issueType.'_description',$issueType.'_description" placeholder="Please enter as much detail as you can about the enhancement that you would like implemented." maxlength="2500"','',"5","10");
    }
    B_ROW();
    XDIV('" style="display:none;',"");
    if ($GLOBALS['priorData']) {//drop and use signed in person id instead- no matter as if somebody updates the problem then it will still keep the original authors id
        BCOLINTXTIDRQD($issueType.'_raisedbypersonid',$issueType.'_raisedbypersonid',$GLOBALS['priorData'][0][6],"4");
        BCOLINTXTIDRQD($issueType.'_raiseddate',$issueType.'_raiseddate',$GLOBALS['priorData'][0][7],"4");
    }
    X_DIV("");

		XBR();
		BROW();
		BCOLTXT("Severity","1");
		$xhash = List2Hash("Critical,High,Medium,Low");
		BCOL("2");
		if ($priorData[$issueType.'_severity']) {
			BINRADIOHASH2($xhash,$issueType.'_severity',$priorData[$issueType.'_severity']);
		}else {
			BINRADIOHASH2($xhash,$issueType.'_severity','Medium');
		}
		B_COL();
		B_ROW();

    /*START IMAGE UPLOAD*/
    $GLOBALS{'CROPPARMS'} = Array();
    XH3(ucfirst($issueType)." screenshot");
    BROW();
		//First image
		BCOL("6");
    BCOLTXT("Caption","2"); BCOLINTXTID($issueType.'_imagename',$issueType.'_imagename',$priorData[$issueType.'_imagename'],"4");
		XBR();
    XINHID($issueType.'_image',$priorData[$issueType.'_image']);
    $imagefieldname = $issueType.'_image';
    $imageviewwidth = "90%";
    $imagename = $GLOBALS['priorData'][0][13];
    $imageuploadto = ucfirst($issueType);
    $imageuploadid = $GLOBALS{$issueType.'_id'};
    $imageuploadwidth = "800";
    $imageuploadheight = "flex";
    $imageuploadfixedsize = "";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
		B_COL();
		//Second image
		/*
		BCOL("6");
    BCOLTXT("Caption","2"); BCOLINTXTID($issueType.'_image1name',$issueType.'_image1name',$priorData[$issueType.'_image1name'],"4");
		XBR();
    XINHID($issueType.'_image1',$priorData[$issueType.'_image1']);
    $imagefieldname = $issueType.'_image1';
    $imageviewwidth = "90%";
    $imagename = $GLOBALS['priorData'][0][13];
    $imageuploadto = ucfirst($issueType);
    $imageuploadid = $GLOBALS{$issueType.'_id'}."1";
    $imageuploadwidth = "800";
    $imageuploadheight = "flex";
    $imageuploadfixedsize = "";
    $imagethumbwidth = "400";
    XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
    array_push($GLOBALS{'CROPPARMS'},$imagefieldname.'|'.$imageviewwidth.'|'.$imagename.'|'.$imageuploadto.'|'.$imageuploadid.'|'.
        $imageuploadwidth.'|'.$imageuploadheight.'|'.$imageuploadfixedsize.'|'.$imagethumbwidth);
		B_COL();
		*/
    B_ROW();
    XHRCLASS('underline');
    /*END IMAGE UPLOAD*/




    if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) {
			XBR();
			BROW();
			BCOLTXT("Priority","1");
			$xhash = List2Hash("1,2,3,4,5");
			BCOL("2");
			if ($priorData[$issueType.'_priority']) {
				BINRADIOHASH2($xhash,$issueType.'_priority',$priorData[$issueType.'_priority']);
			}else {
				BINRADIOHASH2($xhash,$issueType.'_priority','3');
			}
			B_COL();
			B_ROW();
			XBR();
			BROW();
			BCOLTXT(ucfirst($issueType)." Actionee","2");
			BCOL("4");
			$hash = List2Hash($GLOBALS{'domain_webmasters'});
			foreach ( $hash as $key ) {
				Check_Data("person",$key);
				if ($GLOBALS{'IOWARNING'} == "0") { $hash[$key] = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
				else { unset($hash[$key]); }
			}
			BINCHECKBOXHASH ($hash,$issueType."_assignedtopersonid",$priorData[$issueType.'_assignedtopersonid']);
			B_COL();
			B_ROW();

        XBR();
        BROW();
        BCOLTXT("Response","1");
        if ($priorData[$issueType.'_fixdescription']) {
          BCOLINTEXTAREAID($issueType.'_fixdescription',$issueType.'_fixdescription" maxlength="255',$priorData[$issueType.'_fixdescription'],"5","10");
        }else{
          BCOLINTEXTAREAID($issueType.'_fixdescription',$issueType.'_fixdescription" maxlength="255" placeholder="Please enter details of the fix that has been implemented."',"","5","10");
        }
        B_ROW();

        XBR();
        BROW();
        BCOLTXT("Status","1");
        $xhash = List2Hash("Open,Closed,Fixed,Dropped,Archived");
        BCOL("2");
        BINSELECTHASHNOQID($xhash,$issueType.'_status',$priorData[$issueType.'_status'],$issueType."_status");
        B_COL();
        B_ROW();
				XBR();
				BROW();
				BCOLTXT("Fix Date","1");
				if ($priorData[$issueType.'_fixdate']) {
					BCOLINDATEID($issueType.'_fixdate',$issueType.'_fixdate_dd/mm/yyyy',YYYY_MM_DDtoDDsMMsYYYY($priorData[$issueType.'_fixdate']),'dd/mm/yyyy',"3");
				}else{
					BCOLINDATEID($issueType.'_fixdate',$issueType.'_fixdate_dd/mm/yyyy',"",'dd/mm/yyyy',"3");
				}
				B_ROW();
            }

    XBR();
    XHR();
    BROW();
    BCOLTXT("","1");
    BCOL("2");
    XINSUBMIT("Update");
    B_COL();
    B_ROW();

    X_FORM();

		SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid, $imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);

  $GLOBALS{'PersonSelectPopupParameters'} = array(
            "this,person_id|person_sname|person_fname|person_section",
            "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90",
            "field,Lookup,Select,".$issueType."_assignedtopersonid,".$issueType."_assignedtopersonidname,100",
            "person_id",
            "all",
            "search,center,center,800,600",
            "view",
            "buildfulllist"
    );
}

function Action_ISSUEUPDATE_IN($issueType) {
	if ($_REQUEST['PersonId'] == "agra") {
		print_r($_POST);
		// echo "<img src='".$_POST[$issueType.'_image_imagename']."'>";
	}
	$personData = get_array_select2("person",["person_id = '".$_REQUEST[$issueType.'_raisedbypersonid']."'"],"person_email1,person_fname,person_sname");
	$recipient = $personData[0][0];
	if (empty($GLOBALS{'domain_defaultemailaddress'})) {
		$emailfrom = Get_Email($GLOBALS['domain_issuemasters']);
	}else{
		$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
	}
	$emailfooter1 = "Automated message from ".$GLOBALS{'domain_longname'};
	$emailfooter2 = "Please do not reply to this message";
	$emailto = $personData[0][0];
	$emailcc = "";
	$emailbcc = "";
	$emailsubject = ucfirst($issueType)." Ticket ".$_POST[$issueType.'_id'];
	if ($_POST['new']==1) {
		// echo($GLOBALS{'domain_defaultemailaddress'});
		$emailcontent = "Dear ".$personData[0][1]." ".$personData[0][2].",<br><br>Thank you for informing us of this issue. Please find a copy of it below.\n\n" .$_POST[$issueType.'_id']."\n" .$_POST[$issueType.'_raiseddate']."\n<h1>" .$_POST[$issueType.'_title']."</h1>\n<p>".$_POST[$issueType.'_description']."</p>\n\nThanks,\nSports Facilities Management\n";
	}else if ($_POST[$issueType."_status"] == ("Closed" OR "Fixed")) {
		$emailcontent = "Dear ".$personData[0][1]." ".$personData[0][2].",<br><br>Thank you for previously informing us of this issue. It has now been fixed. Please find a copy of your ticket and response below.\n\nReference: " .$_POST[$issueType.'_id']."\nRaised on: "  .$_POST[$issueType.'_raiseddate']."\nFix description: " .$_POST[$issueType.'_fixdescription']."\n\nTitle: " .$_POST[$issueType.'_title']."\n<p>Description: ".$_POST[$issueType.'_description']."</p>\nThanks,\nSports Facilities Management\n";
	}
	if ($_REQUEST['PersonId'] == "agra") {
		HTMLEmail_Output("display",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}else {
		HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	}
	if ($issueType."_assignedtopersonidbbra") {
		$_POST[$issueType."_assignedtopersonid"] .="bbra";
	}
	if ($issueType."_assignedtopersonidagra") {
		if ($issueType."_assignedtopersonidbbra") {
			$_POST[$issueType."_assignedtopersonid"] .=", ";
		}
		$_POST[$issueType."_assignedtopersonid"] .="agra";
	}
	if ($_POST['new']==1) {
		if ($issueType == "problem") {
			XH1("Thank you for informing us of this issue. Your reference is ".$_POST[$issueType.'_id']);
		}else{
			XH1("Thank you for submitting your enhancement idea. Your reference is ".$_POST[$issueType.'_id']);
		}
	}else if ($_POST[$issueType."_status"] == ("Closed" OR "Fixed")) {//Will only be seen by those with
		XH1("Thank you for closing issue reference:".$_POST[$issueType.'_id']);
	}
	XBR();
	$link = YPGMLINK("issuereport.php").YPGMSTDPARMS().YPGMPARM("SelectId","CLASSICMENU");
	XAHREF($link,"Issue Reporting");
	XTXT("Click here to return to Issue Reporting");
	X_A();
	$inproblem_id = $_REQUEST[$issueType.'_id'];
	if($_POST[$issueType.'_status']!="Open"){
	  $_REQUEST[$issueType.'_fixdate_dd/mm/yyyy'] = date('d-m-Y');
	}
	foreach ( $_REQUEST as $keystring => $v ) {
		$keybits = explode("_",$keystring);
		$fieldname = $issueType."_".$keybits[1];
		if (sizeOf($keybits) == 2) { # normal
			if (is_array($_REQUEST[$keystring])) { # checkbox array
        $vstring = ""; $vsep = "";
        foreach ( $_REQUEST[$keystring] as $key => $value ) {
          $vstring = $vstring.$vsep.$key;
          $vsep = ",";
        }
			} else {
        $vstring = $v;
			}
			$GLOBALS{$fieldname} = $vstring;
		}
		if (sizeOf($keybits) == 3) { # Multipart field
      if ($keybits[2] == "imagename") {
        $GLOBALS{$fieldname} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{$fieldname},$v);
      }
      if ($keybits[2] == "dd/mm/yyyy") {
        $GLOBALS{$fieldname} = DDbMMbYYYYtoYYYYhMMhDD($v);
      }
		}
	}
	Write_Data($issueType, $inproblem_id);
}
//comment
?>
