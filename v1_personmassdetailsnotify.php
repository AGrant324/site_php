<?php # personmassdetails.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$emailfrom = $GLOBALS{'person_email1'};
XH2("Confirmation of Club Records information");
$testorreal = $_REQUEST['TestorReal'];
$personlist = $_REQUEST['PersonList'];
$GLOBALS{'domain_personmassnotifyintro'} = $_REQUEST['PersonMassNotifyIntro'];
$selectname = "";
$selectlogin = "";
$selectaddress = "";
$selectcontacts = "";
$selectsection = "";
$selectprivacy = "";
$selectauthority = "";
$selectprofile = "";
$selectextradata = "";
$anyselection = "";
if(isset($_REQUEST['SelectName'])) {$selectname = $_REQUEST['SelectName']; $anyselection = "1";}
if(isset($_REQUEST['SelectLogin'])) {$selectlogin = $_REQUEST['SelectLogin']; $anyselection = "1";}
if(isset($_REQUEST['SelectAddress'])) {$selectaddress = $_REQUEST['SelectAddress']; $anyselection = "1";}
if(isset($_REQUEST['SelectContacts'])) {$selectcontacts = $_REQUEST['SelectContacts']; $anyselection = "1";}
if(isset($_REQUEST['SelectSection'])) {$selectsection = $_REQUEST['SelectSection']; $anyselection = "1";}
if(isset($_REQUEST['SelectPrivacy'])) {$selectprivacy = $_REQUEST['SelectPrivacy']; $anyselection = "1";}
if(isset($_REQUEST['SelectAuthority'])) {$selectauthority = $_REQUEST['SelectAuthority']; $anyselection = "1";}
if(isset($_REQUEST['SelectProfile'])) {$selectprofile = $_REQUEST['SelectProfile']; $anyselection = "1";}
if(isset($_REQUEST['SelectExtraData'])) {$selectextradata = $_REQUEST['SelectExtraData']; $anyselection = "1";}
Write_Data('domain');

$CR = chr(13); $LF = chr(10);
$tsectionkeya = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
$tsectionvaluea = $tsectionkeya;
$tpersontypea = Get_Array_Hash_SortSelect('persontype',$GLOBALS{'currperiodid'},"persontype_seq","","");
$tpersontypekeya = array(); $tpersontypevaluea = array();
foreach ($tpersontypea as $tpersontype ) {
 Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
 if ($GLOBALS{'persontype_selectable'} == "Yes") {	
 	array_push($tpersontypekeya, $tpersontype);  
 	array_push($tpersontypevaluea, $GLOBALS{'persontype_name'}." - ".$GLOBALS{'persontype_annualfee'});
 }	
}
$tqualificationida = Get_Array('qualification');
$tqualificationtitlea = array();
foreach ($tqualificationida as $tqualificationid ) {
 Get_Data_Hash('qualification',$tqualificationid);	
 array_push($tqualificationtitlea, $GLOBALS{'qualification_title'});	
}	

if ($testorreal == "T") {
 XH4('Note:_ "Test" mode has been selected - none of the following emails have actually been sent.');
}
$personlistbits = str_split($personlist);
$selectedpersona = array();
$alphanumerica = $GLOBALS{'STATIC_loweralpha'}.$GLOBALS{'STATIC_numerica'}."-"; 
$alphanumerica = str_replace(",", "", $alphanumerica);
$lastselectedperson=""; $sepjustfound="0";
foreach ($personlistbits as $pbit ) {
 if (strlen(strstr($alphanumerica,$pbit))>0) {
  if ($sepjustfound == "1") {   
   if ($lastselectedperson != "") {array_push($selectedpersona, $lastselectedperson);}
   $lastselectedperson="";
  }
  $lastselectedperson = $lastselectedperson.$pbit;
  $sepjustfound="0"; 
 } else {
  $sepjustfound="1";
 }
}
if ($lastselectedperson != "") {array_push($selectedpersona,$lastselectedperson);}	
foreach ($selectedpersona as $key => $tperson_id ) {
 Check_Data("person",$tperson_id);
 if ($GLOBALS{'IOWARNING'} == "0") {
  Get_Person_Authority();
  $selectperson = "1"; $excludeperson = "0";
  if (($selectperson == "1") && ($excludeperson == "0") && ($GLOBALS{'person_email1'} != "")) { 
   
   $emailto = Chosen_Person_Email();
   $emailfooter1 = "From ".$GLOBALS{'domain_longname'}." - initiated by $askingperson_fname $askingperson_sname.";
   $emailfooter2 = "";   
   $emailcc = "";   
   $emailbcc = "";      
   $emailsubject = $GLOBALS{'domain_longname'};
   $mainmessage = "Dear ".$GLOBALS{'person_fname'}.",<br> <br>";
   $tmsg = $GLOBALS{'domain_personmassnotifyintro'};
   $tmsg = str_replace($LF, "<br>", $tmsg);
   $mainmessage .= $tmsg;
   $mainmessage .= "<br> <br> <br>";
   $bpage = "<b>Quick Link</b> - Check and Update my personal details";
   $sessionid = XCrypt($GLOBALS{'person_password'},$tperson_id,'encrypt'); 
   $blink =$GLOBALS{'site_phpurl'}."/".$GLOBALS{'codeversion'}."_personMYPROFILEremoteout.php?ServiceId=".$GLOBALS{'LOGIN_service_id'}
   ."&DomainId=".$GLOBALS{'LOGIN_domain_id'}."&ModeId=".$GLOBALS{'site_modeid'}."&LoginModeId=".$GLOBALS{'LOGIN_loginmode_id'}
   ."&PersonId=".$tperson_id."&SessionId=".$sessionid."&SelectId=UD";
   $mainmessage .= '<a href="'.$blink.'">'.$bpage.'</a><br>'."\n";
   $mainmessage .= "<br> <br>";
   $bpage = "Full Login to Club Website"; 
   $blink =$GLOBALS{'site_phpurl'}."/".$GLOBALS{'codeversion'}."_personloginout.php?ServiceId=".$GLOBALS{'LOGIN_service_id'}."&DomainId=".$GLOBALS{'LOGIN_domain_id'}."&ModeId=".$GLOBALS{'site_modeid'}."&LoginModeId=".$GLOBALS{'LOGIN_loginmode_id'};
   $mainmessage .= '<a href="'.$blink.'">'.$bpage.'</a><br>'."\n";
   $mainmessage .= 'Use your email address or your personid "'.$tperson_id.'" and a password of "'.XCrypt($GLOBALS{'person_password'},$tperson_id,"decrypt").'" to loginto the Club Website'."\n";;    
   $mainmessage .= "<br> <br> <br>"."\n";
   $mainmessage .= "<b>Note: <i>Please keep this email secure and do not forward it to other people.</i></b>";
   $mainmessage .= "<br> <br>";
   if ($anyselection == "1") {$mainmessage .= "============================================================<br>";}
   if ($anyselection == "1") {$mainmessage .= "Current Records<br>"; }
   $mainmessage .= "<br>";
   if ($selectname == "Yes") {
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Name","Blue")."</td><td width=300></td></tr>";       	      
    $mainmessage .= "<tr><td>Title</td><td>".$GLOBALS{'person_title'}."</td></tr>";
    $mainmessage .= "<tr><td>First Name</td><td>".$GLOBALS{'person_fname'}."</td></tr>";    
    $mainmessage .= "<tr><td>Initals</td><td>".$GLOBALS{'person_midinits'}."</td></tr>";   
    $mainmessage .= "<tr><td>Surname</td><td>".$GLOBALS{'person_sname'}."</td></tr>";    
    $mainmessage .= "</table> <br>"; 
   }   
   if ($selectlogin == "Yes") { 
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Login","Blue")."</td><td width=100></td></tr>";
    $mainmessage .= "<tr><td>Personal Id</td><td>$tperson_id</td></tr>"; 
    $mainmessage .= "<tr><td>Password (Case Sensitive!)</td><td>".XCrypt($GLOBALS{'person_password'},$tperson_id,"decrypt")."</td></tr>";
    $mainmessage .= "</table> <br>"; 
   }
   if ($selectaddress == "Yes") { 
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td width=450>".YTXTCOLOR("Address","Blue")."</td></tr>";  
    $mainmessage .= "<tr><td>";            	
    $mainmessage .= $GLOBALS{'person_addr1'}."<br>"; 
    $mainmessage .= $GLOBALS{'person_addr2'}."<br>";    
    $mainmessage .= $GLOBALS{'person_addr3'}."<br>";    
    $mainmessage .= $GLOBALS{'person_addr4'}."<br>";    
    $mainmessage .= $GLOBALS{'person_postcode'}."<br>";  
    $mainmessage .= "</td></tr>";      
    $mainmessage .= "</table> <br>"; 
   }  
   if ($selectcontacts == "Yes") { 
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Contact Details","Blue")."</td><td width=300></td></tr>";       	
    $mainmessage .= "<tr><td>Home Tel</td><td>".$GLOBALS{'person_hometel'}."</td></tr>";   
    $mainmessage .= "<tr><td>Work Tel</td><td>".$GLOBALS{'person_worktel'}."</td></tr>";      
    $mainmessage .= "<tr><td>Mobile</td><td>".$GLOBALS{'person_mobiletel'}."</td></tr>";     
    $mainmessage .= "<tr><td>Fax Tel</td><td>".$GLOBALS{'person_faxtel'}."</td></tr>";   
    $mainmessage .= "<tr><td>Primary Email</td><td>".$GLOBALS{'person_email1'}."</td></tr>";   
    $mainmessage .= "<tr><td>Secondary Email</td><td>".$GLOBALS{'person_email2'}."</td></tr>";
    $mainmessage .= "<tr><td>Twitter User Name</td><td>".$GLOBALS{'person_twitterusername'}."</td></tr>";
#    $mainmessage .= "<tr><td>Facebook User Name</td><td>".$GLOBALS{'person_facebookusername'}."</td></tr>";    
    $mainmessage .= "</table> <br>"; 
   }
   if ($selectsection == "Yes") {
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Section & Membership Type","Blue")."</td><td></td></tr>";       	      
    $mainmessage .= "<tr><td>Section</td><td>".YTXTCHECKLIST($tsectionkeya,$tsectionvaluea,$GLOBALS{'person_section'})."</td></tr>";      
    $mainmessage .= "<tr><td>Membership Type</td><td>".YTXTCHECKLIST($tpersontypekeya,$tpersontypevaluea,$GLOBALS{'person_type'})."</td></tr>";       
    $mainmessage .= "</table> <br>"; 
   }    
    if ($selectprivacy == "Yes") {
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Privacy Controls","Blue")."</td><td></td></tr>";  
    $tvaluea = array("Show Address, Telephone and Email","Show Telephone and Email only","Show Email only","Ex Directory");  
    $tkeya = array("3","2","1","0");
    $texisting = $GLOBALS{'person_exdirectory'};if ($texisting == "") {$texisting = "3";}
    $mainmessage .= "<tr><td>Directory Status</td><td>".YTXTCHECKLIST($tkeya,$tvaluea,$texisting)."</td></tr>";   
    $tvaluea = array("I would like to receive newsletters and other correspondence via email.","I do not wish to receive newsletters and other correspondence via email.");
    $tkeya = array("Yes","No");
    $texisting = $GLOBALS{'person_broadcast1'};if ($texisting == "") {$texisting = "Yes";}
    $mainmessage .= "<tr><td>Broadcast Information</td><td>".YTXTCHECKLIST($tkeya,$tvaluea,$texisting)."</td></tr>";      
    $tvaluea = array("I would like to receive sponsor information via email.","I do not wish to receive sponsor information via email.");
    $tkeya = array("Yes","No");
    $texisting = $GLOBALS{'person_adverts'}; if ($texisting == "") {$texisting = "Yes";}
    $mainmessage .= "<tr><td>Sponsor Information</td><td> ".YTXTCHECKLIST($tkeya,$tvaluea,$texisting)."</td></tr>";    
    $mainmessage .= "</table> <br>"; 
   }
   if ($selectprofile == "Yes") {
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Profile","Blue")."</td><td  width=300></td></tr>";
    $tvaluea = array("Yes","No");$tkeya = array("Yes","No");    
    $texisting = $GLOBALS{'person_activeplayer'};if ($texisting == "") {$texisting = "No";}
    $mainmessage .= "<tr><td>Active Player (available for Selection)</td><td>".YTXTCHECKLIST($tkeya,$tvaluea,$texisting)."</td></tr>";    
    $tvaluea = array("Yes","No");$tkeya = array("Yes","No"); 
    $texisting = $GLOBALS{'person_activeofficial'};if ($texisting == "") {$texisting = "No";}
    $mainmessage .= "<tr><td>Active Official (available for Selection)</td><td>".YTXTCHECKLIST($tkeya,$tvaluea,$texisting)."</td></tr>";  
    $mainmessage .= "<tr><td>Occupation</td><td>".$GLOBALS{'person_occupation'}."</td></tr>"; 
    $mainmessage .= "<tr><td>Areas in which you would be willing to assist the club.<br>e.g Particular skills that you have.</td><td>".$GLOBALS{'person_canyouhelp'}."</td></tr>"; 
    $mainmessage .= "<tr><td>Coaching or other Qualifications held</td><td>".YTXTCHECKLIST($tqualificationida,$tqualificationtitlea,$GLOBALS{'person_qualificationid'})."</td></tr>";    
    $mainmessage .= "<tr><td>Qualification Description (if other)</td><td>".$GLOBALS{'person_qualificationotherdescription'}."</td></tr>";        
    $mainmessage .= "<tr><td>Qualification Date - DDMMYY<br>(most recent date if multiple qualifications held)</td><td>".$GLOBALS{'person_qualificationdate'}."</td></tr>"; 
    $tvaluea = array("Yes","No");$tkeya = array("Yes","No");
    $texisting = $GLOBALS{'person_crbcheck'};if ($texisting == "") {$texisting = "No";}         
    $mainmessage .= "<tr><td>CRB Check Passed</td><td>".YTXTCHECKLIST($tkeya,$tvaluea,$texisting)."</td></tr>";        
    $mainmessage .= "<tr><td>CRB Check - Date Passed - DDMMYY</td><td>".$GLOBALS{'person_crbcheckdate'}."</td></tr>";      
    $mainmessage .= "</table> <br>"; 
   }
   if ($selectextradata == "Yes") {
    $mainmessage .= "<table border=1>"; 
    $mainmessage .= "<tr bgcolor=lightgray><td>".YTXTCOLOR("Supplementary Information","Blue")."</td><td width=300></td></tr>";
    $showanyway = "0";
    for ($imexd = 0; $imexd < 10; $imexd++) {
     Get_Data_Hash("personextradef",$imexd);	
     if ($GLOBALS{'personextradef_title'} != "") {
      if ($GLOBALS{'personextradef_self'} == "Yes") {
       $mainmessage .= "<tr><td>".$GLOBALS{'personextradef_title'}."</td><td>".$GLOBALS{'person_extra'.$imexd}."</td></tr>";      	
      }  
     }
    }
    $mainmessage .= "</table> <br> <br>"; 
   }   
   if ($anyselection == "1") {$mainmessage .= "============================================================";} 
   $emailcontent = $mainmessage;
   if ($testorreal == "R") {
    HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
   }
   Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
  }
 } 
}


Back_Navigator();
PageFooter("Default","Final");

?>
