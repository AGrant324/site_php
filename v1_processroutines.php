<?php # finroutines.php

function Build_NonWorkDays () {
 $startyear = substr($GLOBALS{'currentYYYYMMDD'}, 0, 4)-1;
 $startdate =  (string)$startyear.substr($GLOBALS{'currentYYYYMMDD'}, 4, 4);
 $endyear = substr($GLOBALS{'currentYYYYMMDD'}, 0, 4)+1;
 $enddate =  (string)$endyear.substr($GLOBALS{'currentYYYYMMDD'}, 4, 4);
# print $startdate." -> ".$enddate."<br>";	
 $nonworkdaya = Get_Array("nonworkday");
 foreach ($nonworkdaya as $nonworkday_date ) {
  if (($nonworkday_date >= $startdate)&&($nonworkday_date <= $enddate)) {
   Get_Data("nonworkday",$nonworkday_date);  
   $GLOBALS{'NWD_'.$nonworkday_date} = $GLOBALS{'nonworkday_description'};
#   print "Vacation - ".$nonworkday_date." ".$GLOBALS{'NWD_'.$nonworkday_date}."<br>";	 	   
  }
 }
}
function Date_WorkDayOffset($parm0,$parm1) {
# date offset   returns YYYYMMDD
# print $parm0." <-> ".$parm1."<br>";
$tYYYY = substr($parm0, 0, 4);$tMM = substr($parm0, 4, 2);$tDD = substr($parm0, 6, 2);
if ($parm1 > 0) {
 $winc = 1; $wi = $parm1-1; $tlastmktime = mktime(0,0,0,$tMM,$tDD,$tYYYY);
} else {
 $winc = -1; $wi = $parm1*(-1); $tlastmktime = mktime(0,0,0,$tMM,$tDD+1,$tYYYY);
}
while ($wi >= 0):
 $tYYYYMMDD = date("Ymd", $tlastmktime);
 $tYYYY = substr($tYYYYMMDD, 0, 4);$tMM = substr($tYYYYMMDD, 4, 2);$tDD = substr($tYYYYMMDD, 6, 2);
 $tnewmktime = mktime(0,0,0,$tMM,$tDD+$winc,$tYYYY);
 $tYYYYMMDD = date("Ymd", $tnewmktime); 
 if ((date("l",$tnewmktime) == "Saturday")
    ||(date("l",$tnewmktime) == "Sunday")
    ||($GLOBALS{'NWD_'.$tYYYYMMDD} != null)) { 
#  if (date("l",$tnewmktime) == "Saturday") {print "Saturday - ".$tYYYYMMDD."<br>";}
#  if (date("l",$tnewmktime) == "Sunday") {print "Sunday - ".$tYYYYMMDD."<br>";}    	
#  if ($GLOBALS{'NWD_'.$tYYYYMMDD} != NULL) {print "Vacation - ".$GLOBALS{'NWD_'.$tYYYYMMDD}." - ".$tYYYYMMDD."<br>";}       	
 } else {
    --$wi;	
 }
 $tlastmktime = $tnewmktime;
endwhile;
return date("Ymd", $tnewmktime);
}
function Date_Offset($parm0,$parm1,$parm2) {
# print $parm0." <-> ".$parm1." <-> ".$parm2."<br>";	
if ($parm2 == "Day") {return Date_DayOffset($parm0,$parm1);}
if ($parm2 == "Week") {return Date_WeekOffset($parm0,$parm1);}
if ($parm2 == "Month") {return Date_MonthOffset($parm0,$parm1);}
if ($parm2 == "Quarter") {return Date_QuarterOffset($parm0,$parm1);}
if ($parm2 == "Year") {return Date_YearOffset($parm0,$parm1);}	
}
function Date_DayOffset($parm0,$parm1) {
# date offset   returns YYYYMMDD
# mktime(hour,minute,second,month,day,year,is_dst)
$tYYYY = substr($parm0, 0, 4);$tMM = substr($parm0, 4, 2);$tDD = substr($parm0, 6, 2);
$tnewmktime = mktime(0,0,0,$tMM,$tDD+$parm1,$tYYYY);
return date("Ymd", $tnewmktime);
}
function Date_WeekOffset($parm0,$parm1) {
# date offset   returns YYYYMMDD
$tYYYY = substr($parm0, 0, 4);$tMM = substr($parm0, 4, 2);$tDD = substr($parm0, 6, 2);
$tnewmktime = mktime(0,0,0,$tMM,$tDD+($parm1*7),$tYYYY);
return date("Ymd", $tnewmktime);
}	
function Date_MonthOffset($parm0,$parm1) {
# date offset   returns YYYYMMDD
$tYYYY = substr($parm0, 0, 4);$tMM = substr($parm0, 4, 2);$tDD = substr($parm0, 6, 2);
$tnewmktime = mktime(0,0,0,$tMM+$parm1,$tDD,$tYYYY);
return date("Ymd", $tnewmktime);
}
function Date_QuarterOffset($parm0,$parm1) {
# date offset   returns YYYYMMDD
$tYYYY = substr($parm0, 0, 4);$tMM = substr($parm0, 4, 2);$tDD = substr($parm0, 6, 2);
$tnewmktime = mktime(0,0,0,$tMM+($parm1*3),$tDD,$tYYYY);
return date("Ymd", $tnewmktime);
}	
function Date_YearOffset($parm0,$parm1) {
# date offset   returns YYYYMMDD
$tYYYY = substr($parm0, 0, 4);$tMM = substr($parm0, 4, 2);$tDD = substr($parm0, 6, 2);
$tnewmktime = mktime(0,0,0,$tMM,$tDD,$tYYYY+$parm1);
return date("Ymd", $tnewmktime);
}


function Process_SETUPNONWORKDAY_Output() {
$parm0 = "Non Workday Update|nonworkday||nonworkday_date|nonworkday_date|25|Yes";
$parm1 = "";
$parm1 = $parm1."nonworkday_date|Yes|Date|90|Yes|Date YYYYMMDD|KeyDate^";
$parm1 = $parm1."nonworkday_description|Yes|Description|180|Yes|Description|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Process_SETUPPROCESSROLE_Output() {
$parm0 = "Role Update|processrole||processrole_id|processrole_id|0|No";
$parm1 = "";
$parm1 = $parm1."processrole_id|Yes|Id|90|Yes|Role Id|KeyText,8,8^";
$parm1 = $parm1."processrole_title|Yes|Title|180|Yes|Role Title|InputText,25,40^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
GenericHandler_Output ($parm0,$parm1); 
}

function Process_SETUPPROCESSTEMPLATE_Output() {

/*  TEST ROUTINES FOR CALENDAR	
Build_NonWorkDays(); 
$startyear = substr($GLOBALS{'currentYYYYMMDD'}, 0, 4)-1;
$startdate =  (string)$startyear.substr($GLOBALS{'currentYYYYMMDD'}, 4, 4);
$endyear = substr($GLOBALS{'currentYYYYMMDD'}, 0, 4)+1;
$enddate =  (string)$endyear.substr($GLOBALS{'currentYYYYMMDD'}, 4, 4);
$lastdate = $GLOBALS{'currentYYYYMMDD'};
print "<br>"; 
print "WorkDays<br>"; 
for ($ai = 0; $ai <= 10; $ai++) {
 $nextdate = Date_WorkDayOffset($lastdate,6);
 $lastdate = $nextdate;	
}
print "Days<br>"; 
for ($ai = 0; $ai <= 800; $ai++) {
 $nextdate = Date_DayOffset($lastdate,+1);
 print "$nextdate<br>"; 
 $lastdate = $nextdate;	
}
print "Weeks<br>";
for ($ai = 0; $ai <= 100; $ai++) {
 $nextdate = Date_WeekOffset($lastdate,-1);
 print "$nextdate<br>"; 
 $lastdate = $nextdate;	
}
print "Months<br>";
for ($ai = 0; $ai <= 30; $ai++) {
 $nextdate = Date_MonthOffset($lastdate,+1);
 print "$nextdate<br>"; 
 $lastdate = $nextdate;	
}
print "Quarters<br>";
for ($ai = 0; $ai <= 6; $ai++) {
 $nextdate = Date_QuarterOffset($lastdate,+1);
 print "$nextdate<br>"; 
 $lastdate = $nextdate;	
}
print "Years<br>";
for ($ai = 0; $ai <= 3; $ai++) {
 $nextdate = Date_YearOffset($lastdate,-1);
 print "$nextdate<br>"; 
 $lastdate = $nextdate;	
}
*/

$parm0 = "Process Template Update|processtemplate||processtemplate_id|Template Id|20|30|processtemplate_id|25|PT[00000]|Yes";
$parm1 = "";
$parm1 = $parm1."processtemplate_id|Yes|Id|90|Yes|Template Id|KeyGenerated,PT[00000]^";
$parm1 = $parm1."processtemplate_description|Yes|Description|180|Yes|Description|InputText,25,40^";
$parm1 = $parm1."processtemplate_anchorenddate|Yes|Anchor End Date|100|Yes|Anchor End Date - YYYYMMDD|InputText,8,8^";
$parm1 = $parm1."processtemplate_repetition|Yes|Repeat Period|100|Yes|Repetition|InputSelectFromList,Day+Week+Month+Quarter+Year^";
$parm1 = $parm1."processtemplate_horizon|Yes|Repeat Horizon|100|Yes|Horizon|InputSelectFromList,Month+Quarter+Year^";
$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton^";
$parm1 = $parm1."generic_programbutton|Yes|Design|70|No|Design|ProgramButton,processdesignout.php,processtemplate_id,processtemplate_id,newpopup,800,600";
GenericHandler_Output ($parm0,$parm1); 
}

function Process_DESIGN_CSSJS () {
# XPTXT("Fin_ALLOCATEBANK_CSSJS");	
$GLOBALS{'YUICSSOPTIONAL'} = "fonts,button,container,paginator,datatable";
$GLOBALS{'YUIJSOPTIONAL'} = "yahoo-dom-event,logger,animation,element,dragdrop,connection,button,container,paginator,datasource,datatable";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,processdesign";
$GLOBALS{'SITEPOPUPHTML'} = "Process_SetupProcess_Popup";
}

function Process_DESIGN_Output ($parm0) {
XDIV("processdesigndiv","yui-skin-sam");
Get_Data("processtemplate",$parm0);
XH5("Process Designer - ".$parm0." - ".$GLOBALS{'processtemplate_description'} );
XTXT("It is recommended that process steps are entered in the format 010, 020 etc.. (this allows for insertions.. eg at 015)");
XBR();XBR();
XDIV("setupProcessTable","yui-skin-sam");
X_DIV("setupProcessTable");
XBR();
XTABLE();
XTR();XTDHTXT("New Process Step");XTDHTXT("");X_TR();
XTR();XTD();XINTXTID("addprocesstask","addprocesstask","","3","5");X_TD();XTDINSUBMITNAME("Add","addprocesstaskbutton");X_TR();
X_TABLE();
XBR();
XFORM("processfinish.php","processfinishform");
XINSTDHID();
XINHID("processtemplate_id",$parm0);
XINSUBMIT("Finish and Re-Sequence Process Steps");
X_FORM();

XH5("Update Log");
XDIV("updateLog","");
XTXT("No updates have been made in this session so far");
X_DIV("updateLog");
X_DIV("processdesigndiv");
}

function Process_SetupProcess_Popup () {
XDIV("setupProcessDialogouter","yui-skin-sam");
XDIV("setupProcessDialog","");
XDIV("dialoghd","hd");
XTXT("Process Step");
X_DIV("setupProcessDialoghd");
XDIV("setupProcessDialogbd","bd");
XFORM("genericin.php","processinputform");
XINSTDHID();
XINHID("processtemplate_id",$parm0);
XINHID("idinput","idinput","XXXX");
XTABLE();
$nullhash = array();
XTRID("seqrow");XTD();XTXT("Process Step");X_TD();XTD();XTXTID("seqtext","");X_TD();X_TR();
XTRID("descriptionrow");XTD();XTXT("Task Description");X_TD();XTD();XINTXTID("descriptioninput","descriptioninput","","50","90");X_TD();X_TR();
XTRID("processroleidrow");XTD();XTXT("Role performed by");X_TD();XTD();XINSELECTHASH ($nullhash,"processroleidinput","");X_TD();X_TR();
XTRID("durationrow");XTD();XTXT("Task Duration (workdays)");X_TD();XTD();XINTXTID("durationinput","durationinput","","2","3");X_TD();X_TR();
XTRID("dateflexibilityrow");XTD();XTXT("Date Flexibility:");X_TD();XTD();XINSELECTHASH ($nullhash,"dateflexibilityinput","");X_TD();X_TR();
XTRID("eventtyperow");XTD();XTXT("Task Event Type");X_TD();XTD();XINSELECTHASH ($nullhash,"eventtypeinput","");X_TD();X_TR();
XTRID("evidenceassetcoderow");XTD();XTXT("Evidence Asset Code");XTD();XINTXTID("evidenceassetcodeinput","evidenceassetcodeinput","","20","50");X_TD();X_TR();
X_TABLE();
X_FORM();
X_DIV("setupProcessDialogbd");
X_DIV("setupProcessDialog");
X_DIV("setupProcessDialogouter");
}


function Process_ReSequence ($parm0) {
// XPTXT("Process_ReSequence - $parm0");
$tasktemplatea = Get_Array_Hash ("tasktemplate");
$tseq = 0;
foreach ($tasktemplatea as $oldtasktemplate_id) {
 $ibits = explode('-', $oldtasktemplate_id);
 if ($ibits[0] == $parm0) {		
  Delete_Data("tasktemplate",$oldtasktemplate_id);
 }   
}
foreach ($tasktemplatea as $oldtasktemplate_id) {	
 $ibits = explode('-', $oldtasktemplate_id);
 if ($ibits[0] == $parm0) {
  $tseq++;
  $newtasktemplate_id = $parm0."-".substr("000".strval($tseq*10), -3, 3);
  Get_Data_Hash("tasktemplate",$oldtasktemplate_id);
  $GLOBALS{'tasktemplate_id'} = $newtasktemplate_id;
  Write_Data("tasktemplate",$newtasktemplate_id);  
//  XPTXT($oldtasktemplate_id."->".$newtasktemplate_id);
 } 
}
}

function Process_ReSequence_CSSJS () {
$GLOBALS{'YUICSSOPTIONAL'} = "fonts,button,container,calendar,tabview";
$GLOBALS{'YUIJSOPTIONAL'} = "yahoo-dom-event,logger,animation,element,dragdrop,connection,button,container,cookie,tabview";
$GLOBALS{'SITEJSOPTIONAL'} = "tabmenu";
}

function Process_SETUPTASKCALENDAR_Output () {
XH5("Refresh Task Calendar");
XPTXT("Task Calendar updated with the following entries");
$tasktemplatea = Get_Array_Hash ("tasktemplate");
$taska = Get_Array_Hash ("task");
$processtemplatea = Get_Array_Hash ("processtemplate");
$pseq = 0;
foreach ($processtemplatea as $processtemplate_id) {	
# print $processtemplate_id."<br>";
 Get_Data ("processtemplate",$processtemplate_id);
 XH5($GLOBALS{'processtemplate_description'});
 XTABLE();
 XTR();XTDHTXT("Task Id");XTDHTXT("Due Date");XTDHTXT("Description");X_TR();
 $highestoldtask_id = "";
 foreach ($taska as $task_id) {	
  $tbits = explode('-', $task_id); 
  if ($tbits[0] == $processtemplate_id) {$highestoldtask_id = $task_id;}
 }
 if ($highestoldtask_id == "") {
  $highestolddate = $GLOBALS{'processtemplate_anchorenddate'};		
 } else {
  Get_Data_Hash ("task",$highestoldtask_id);
  $highestolddate = $GLOBALS{'task_datedue'};	
 }
# print $highestolddate."<-  highestolddate<br>";
# print $GLOBALS{'processtemplate_horizon'}."<-  horizon<br>";
 $horizondate = Date_Offset($GLOBALS{'currentYYYYMMDD'},1,$GLOBALS{'processtemplate_horizon'});
# print $horizondate."<-  horizondate<br>"; 
 $highestnewdate = $highestolddate;
 if ($highestnewdate == "") {$highestnewdate = $GLOBALS{'currentYYYYMMDD'};}
 while ($highestnewdate < $horizondate):
  $highestnewdate = Date_Offset($highestnewdate,1,$GLOBALS{'processtemplate_repetition'});
  if ($highestnewdate >= $GLOBALS{'currentYYYYMMDD'}) {
   $addedtasksa = array();
   foreach ($tasktemplatea as $tasktemplate_id) { 
    $ttbits = explode('-', $tasktemplate_id); 
    if ($ttbits[0] == $processtemplate_id) {
     Get_Data_Hash ("tasktemplate",$tasktemplate_id);
     $hotbits = explode('-', $highestoldtask_id); 
     $newtask_id = $processtemplate_id."-".substr("00000".strval($hotbits[1]+1), -5, 5);
     $tstring = $newtask_id."|".$tasktemplate_id."|".$GLOBALS{'tasktemplate_description'}."|".$GLOBALS{'tasktemplate_processroleid'}."|";
     $tstring = $tstring.$GLOBALS{'tasktemplate_duration'}."|".$GLOBALS{'tasktemplate_dateflexibility'}."|";
     $tstring = $tstring.$GLOBALS{'tasktemplate_eventtype'}."|".$GLOBALS{'tasktemplate_evidenceassetcode'};    
     array_push($addedtasksa, $tstring);
#     print "addedtask ->".$tstring."<br>";
     $highestoldtask_id = $newtask_id;
    }
   }
   $addedtasksar = array_reverse($addedtasksa); 
   $lasttask = "1";
   $writtentasksa = array();
   foreach ($addedtasksar as $addedtaskselement) { 
    $atbits = explode('|', $addedtaskselement); 
    $newtask_id = $atbits[0];
    $GLOBALS{'task_id'} = $atbits[0];
    $GLOBALS{'task_tasktemplateid'} = $atbits[1];
    $GLOBALS{'task_description'} = $atbits[2];
    $GLOBALS{'task_processroleid'} = $atbits[3];
    if ($lasttask == "1") {
     $GLOBALS{'task_datedue'} = $highestnewdate;
    } else {
     $GLOBALS{'task_datedue'} = Date_WorkDayOffset($followingtaskdate,$followingtaskduration*(-1)); 
    }
    $GLOBALS{'task_datecompleted'} = "";
    $GLOBALS{'task_dateflexibility'} = $atbits[5];
    $GLOBALS{'task_eventtype'} = $atbits[6];
    $GLOBALS{'task_evidenceassetcode'} = "";
    $GLOBALS{'task_comment'} = "";    
#    print "writetask ->".$newtask_id." ".$GLOBALS{'task_datedue'}."<br>";    
    Write_Data ("task",$newtask_id);
    $wstring = $GLOBALS{'task_id'}."|".$GLOBALS{'task_datedue'}."|".$GLOBALS{'task_description'};
    array_push($writtentasksa, $wstring);    
    $lasttask = "0";
    $followingtaskdate = $GLOBALS{'task_datedue'};
    $followingtaskduration = $atbits[4];
   }
   sort($writtentasksa); 
   foreach ($writtentasksa as $writtentaskselement) { 
    $wtbits = explode('|', $writtentaskselement);    	
    XTR();XTDTXT($wtbits[0]);XTDTXT($wtbits[1]);XTDTXT($wtbits[2]);X_TR();   	
   }   
  }  
 endwhile;
 X_TABLE();
}
}

function Process_VIEWTASKCALENDAR_CSSJS () {
# XPTXT("Fin_ALLOCATEBANK_CSSJS");	
$GLOBALS{'YUICSSOPTIONAL'} = "fonts,button,container,paginator,datatable";
$GLOBALS{'SITECSSOPTIONAL'} = "viewtaskcalendar";
$GLOBALS{'YUIJSOPTIONAL'} = "yahoo-dom-event,logger,animation,element,dragdrop,connection,button,container,paginator,datasource,datatable";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,viewtaskcalendar";
$GLOBALS{'SITEPOPUPHTML'} = "Calendar_Popup,Process_VIEWTASKCALENDAR_Popup()";
}

function Process_VIEWTASKCALENDAR_Output() {
XDIV("viewtaskcalendardiv","yui-skin-sam");
XH5("View Task Calendar");
XDIV("viewTaskTable","yui-skin-sam");
X_DIV("viewTaskTable");
XFORM("personreloginin.php","finishform");
XINSTDHID();
XINSUBMIT("Finish");
X_FORM();

XH5("Update Log");
XDIV("updateLog","");
XTXT("No updates have been made in this session so far");
X_DIV("updateLog");
X_DIV("viewtaskcalendardiv");
}

function Process_VIEWTASKCALENDAR_Popup() {
XDIV("viewTaskDialogouter","yui-skin-sam");
XDIV("viewTaskDialog","");
XDIV("dialoghd","hd");
XTXT("Task Management");
X_DIV("viewTaskDialoghd");
XDIV("viewTaskDialogbd","bd");
XFORM("setuptaskmanagementin.php","taskinputform"); # check
XINSTDHID();
XINHID("CurrentYYYYMMDD",$GLOBALS{'currentYYYYMMDD'});
XINHID("idinput","idinput","XXXX");
XTABLE();
$nullhash = array();
XTRID("idrow");XTD();XTXT("Task Id");X_TD();XTD();XTXTID("idtext","");X_TD();X_TR();
XTRID("templateidrow");XTD();XTXT("Task Template Id");X_TD();XTD();XTXTID("templateidtext","");X_TD();X_TR();
XTRID("descriptionrow");XTD();XTXT("Task Description");X_TD();XTD();XTXTID("descriptiontext","");X_TD();X_TR();
XTRID("processroleidrow");XTD();XTXT("Role");X_TD();XTD();XTXTID("processroleidtext","");X_TD();X_TR();
XTRID("dateduerow");XTD();XTXT("Date Due");X_TD();XTD();XTXTID("dateduetext","");X_TD();X_TR();
XTRID("datecompletedrow");XTD();XTXT("Date Completed YYYYMMDD");X_TD();XTD();XINTXTID("datecompletedinput","datecompletedinput","","8","8");X_TD();X_TR();
XTRID("dateflexibilityrow");XTD();XTXT("Date Flexibility");X_TD();XTD();XTXTID("dateflexibilitytext","");X_TD();X_TR();
XTRID("eventtyperow");XTD();XTXT("Event Type");X_TD();XTD();XTXTID("eventtypetext","");X_TD();X_TR();
XTRID("evidenceassetcoderow");XTD();XTXT("Evidence");X_TD();XTD();XINTXTID("evidenceassetcodeinput","evidenceassetcodeinput","","8","8");X_TD();X_TR();
XTRID("commentrow");XTD();XTXT("Comment");X_TD();XTD();XINTXTID("commentinput","commentinput","","8","8");X_TD();X_TR();
X_TABLE();
X_FORM();
X_DIV("viewTaskDialogbd");
X_DIV("viewTaskDialog");
X_DIV("viewTaskDialogouter");
}
?>