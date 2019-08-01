<?php # personmassdetails.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('PHPMailer/PHPMailerAutoload.php');

Get_Common_Parameters();
GlobalRoutine();
$testorreal = $_REQUEST['TestorReal'];
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$askingperson_fname = $GLOBALS{'person_fname'};
$askingperson_sname = $GLOBALS{'person_sname'};
$emailfrom = $GLOBALS{'person_email1'};
XH2("Membership Renewal");

$sectionlist = "";
if (isset($_REQUEST['SelectSection'])) { $sectionlist = implode(',', $_REQUEST['SelectSection']); }
XPTXT($sectionlist);
$persontypelist = "";
if (isset($_REQUEST['SelectPersonType'])) {	$persontypelist = implode(',', $_REQUEST['SelectPersonType']); }
XPTXT($persontypelist);
if ($testorreal == "M") { XH5("MailChimp extract prepared for ".$sectionlist." subsections"); }
else { XH5("Emails prepared for ".$sectionlist." subsections");  }
	
$GLOBALS{'domain_personmembershipnotifyintro'} = $_REQUEST['PersonMembershipNotifyIntro']; 
Write_Data('domain');

$CR = chr(13); $LF = chr(10);
$tpersontypea = Get_Array_Hash_SortSelect('persontype',$GLOBALS{'currperiodid'},"persontype_seq","","");

if ($testorreal == "T") {
 XH4('Note:_ "Test" mode has been selected - none of the following emails have actually been sent.');
}
$persona = Get_Array('person');
	# datatype/rootkey sortfieldname selectfieldname selectfieldcondition - creates sorted array
$chimparrayraw = Array();
$excludedarrayraw = Array();
foreach ($persona as $tperson_id ) {
 Get_Data("person",$tperson_id);
 if ((MatchLists($GLOBALS{'person_section'},$sectionlist))&&(MatchLists($GLOBALS{'person_type'},$persontypelist))) {
  $selectperson = "1"; $excludeperson = "0"; $includeperson = "0";
  
  if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'} ) { $excludeperson = "1"; }

   if (($selectperson == "1") && ($excludeperson == "0") && (($GLOBALS{'person_email1'} != "")||($GLOBALS{'person_email3'} != ""))) { 
  
   if (($testorreal == "T")||($testorreal == "R")) {	
  	   #================ email options =========================================
	   $emailfooter1 = "From ".$GLOBALS{'domain_longname'}." - initiated by $askingperson_fname $askingperson_sname.";
	   $emailfooter2 = "";   
	   $emailto = Chosen_Person_Email();
	   $emailcc = "";   
	   $emailbcc = "";      
	   $emailsubject = $GLOBALS{'domain_longname'}. " - Membership Renewal.";
	   $mainmessage = "Dear ".$GLOBALS{'person_fname'}.",<br> <br>";
	   $tmsg = $GLOBALS{'domain_personmembershipnotifyintro'};
	   $tmsg = str_replace($LF, "<br>", $tmsg);
	   $mainmessage .= $tmsg;
	   $mainmessage .= "<br> <br> <br>";
	   $bpage = "<b>CLICK TO RENEW MY MEMBERSHIP</b>";
	   
	   $sessionid = XCrypt(Remove_NonAplha($GLOBALS{'person_email1'}),$tperson_id,'encrypt'); 
	   $blink =$GLOBALS{'site_phpurl'}."/".$GLOBALS{'codeversion'}."_personmembershipupdateremote.php?ServiceId=".$GLOBALS{'LOGIN_service_id'}
	   ."&DomainId=".$GLOBALS{'LOGIN_domain_id'}."&ModeId=".$GLOBALS{'site_modeid'}."&LoginModeId=".$GLOBALS{'LOGIN_loginmode_id'}
	   ."&PersonId=".$tperson_id."&SessionId=".$sessionid."&SelectId=UD";
	   $mainmessage .= '<a href="'.$blink.'">'.$bpage.'</a><br>'."\n";
	   $mainmessage .= "<br> <br>";
	   
	   $stagedpaymentoption = "0";
	   $mainmessage .= "<table border=1>";
	   $mainmessage .= "<tr>";   
	   $mainmessage .= "<th>Membership Type</th>";   
	   $mainmessage .= "<th>Annual Fee</th>"; 
	   $mainmessage .= "</tr>";
	   foreach ($tpersontypea as $tpersontype ) {
	   	Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
	   	if ($GLOBALS{'persontype_selectable'} == "Yes") {
	   		$mainmessage .= "<tr>";
	   		$mainmessage .= "<td>".$GLOBALS{'persontype_name'}."</td>";   		
	   		$mainmessage .= "<td>".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'}."</td>";   		
	   		$mainmessage .= "</tr>";
	   		$annualstagedfeenumeric = intval($GLOBALS{'persontype_annualstagedfee'});
	   		if ($annualstagedfeenumeric != 0) { $stagedpaymentoption = "1"; } 		
	   	}
	   }   
	   $mainmessage .= "</table>";   
		
		if ( $stagedpaymentoption == "1" ) {
			$mainmessage .= "<br> <br>";
			$mainmessage .= "<h5>It is also possible to pay the following membership types as a series of staged payments</h5>";		 
			$mainmessage .= "<table border=1>";
			$mainmessage .= "<tr>";
			$mainmessage .= "<th>Membership Type</th>";
			$mainmessage .= "<th>Number of Payments</th>";			
			$mainmessage .= "<th>Monthly Payments</th>";
			$mainmessage .= "<th>Total</th>";
			$mainmessage .= "</tr>";
			foreach ($tpersontypea as $tpersontype ) {
				Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
				if ($GLOBALS{'persontype_selectable'} == "Yes") {
					$annualstagedfeenumeric = intval($GLOBALS{'persontype_annualstagedfee'});
					if ($annualstagedfeenumeric != 0) {
						$mainmessage .= "<tr>";
						$mainmessage .= "<td>".$GLOBALS{'persontype_name'}."</td>";
						$mainmessage .= "<td>".intval($GLOBALS{'persontype_annualstagedrecurringpayments'})."</td>";					
						$mainmessage .= "<td>".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'}."</td>";
						$mainmessage .= "<td>".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedfee'}."</td>";								
						$mainmessage .= "</tr>";
						if ($GLOBALS{'persontype_annualstagedfee'} != "") {
							$stagedpaymentoption = "1";
						}
					}
				}
			}
			$mainmessage .= "</table>";
		}
	 
	   $emailcontent = $mainmessage;
	   if ($testorreal == "R") {
	    HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
	    $GLOBALS{'person_membershipnotificationemailsent'} = "Yes";
	    Write_Data("person",$tperson_id);
	   }
	   Email_Display($emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
   }
   
   if ($testorreal == "M") {
  	   #================ mailchimp options =========================================	

   	$selectedperson_email = "";
    $addressee_fname = "";
    $addressee_sname = "";
    $child_sname = "";   
    $child_sname = "";   
   
   	if ($GLOBALS{'person_email3'} != "") {
   		$selectedperson_email = $GLOBALS{'person_email3'};
   		$addressee_fname = $GLOBALS{'person_parentfname'};
   		$addressee_sname = $GLOBALS{'person_parentsname'};
   		$child_fname = $GLOBALS{'person_fname'};
   		$child_sname = $GLOBALS{'person_sname'};
   	} else {
   		$selectedperson_email = $GLOBALS{'person_email1'};
   		$addressee_fname = $GLOBALS{'person_fname'};
   		$addressee_sname = $GLOBALS{'person_sname'};
   		$child_fname = "";
   		$child_sname = "";   		
	}

   	$includeperson = "1";
   	array_push($chimparrayraw, $selectedperson_email.'|'.$addressee_fname.'|'.$addressee_sname.'|'.$child_fname.'|'.$child_sname.'|'.$GLOBALS{'person_section'}.'|'.$tperson_id.'|'.$GLOBALS{'person_type'}.'|'.$GLOBALS{'person_paiddate'} ); 	
   }	  
   
  }
  
  if ( $includeperson == "0" ) {
   	if ($GLOBALS{'person_email3'} != "") {
   		$selectedperson_email = $GLOBALS{'person_email3'};
   		$addressee_fname = $GLOBALS{'person_parentfname'};
   		$addressee_sname = $GLOBALS{'person_parentsname'};
   		$child_fname = $GLOBALS{'person_fname'};
   		$child_sname = $GLOBALS{'person_sname'};
   	} else {
   		$selectedperson_email = $GLOBALS{'person_email1'};
   		$addressee_fname = $GLOBALS{'person_fname'};
   		$addressee_sname = $GLOBALS{'person_sname'};
   		$child_fname = "";
   		$child_sname = "";   		
	}

   	$includeperson = "1";
   	array_push($excludedarrayraw, $selectedperson_email.'|'.$addressee_fname.'|'.$addressee_sname.'|'.$child_fname.'|'.$child_sname.'|'.$GLOBALS{'person_section'}.'|'.$tperson_id.'|'.$GLOBALS{'person_type'}.'|'.$GLOBALS{'person_paiddate'} ); 	
  }
  
  
 } 
}

if ($testorreal == "M") {
	
	XH3("Included in distribution - Payment not yet made");
	XTABLE();
	foreach ($chimparrayraw as $element ) {
		XTR(); 
		$bits = explode('|',$element);
		foreach ($bits as $bit ) { XTDTXT($bit); }
		X_TR();
	}	
	X_TABLE();	
	
	XH3("Excluded from distribution - Already Paid or No email address found");	
	XTABLE();
	foreach ($excludedarrayraw as $element ) {
		XTR();
		$bits = explode('|',$element);
		foreach ($bits as $bit ) {
			XTDTXT($bit);
		}
		X_TR();
	}
	X_TABLE();

	
	XH3("Download the mailchimp distribution list");	
	$GLOBALS{'IOERRORcode'} = "MMR001";
	$downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/mmrmailchimp.csv";
	$GLOBALS{'IOERRORmessage'} = "$downloadfilename - unable to be created";
	$handle = fopen($downloadfilename, "w");

	sort($chimparrayraw);
	$chimparraydeduped = Array();
	$oldemail = "";
	$accumsectionlist = ""; $aslsep = "";
	foreach ($chimparrayraw as $element ) {	
		$cbits = explode('|', $element);
		if (($cbits[0] != $oldemail)&&($oldemail != "")) {
			$newelement = $oldemail.'|'.$oldfname.'|'.$oldsname.'|'.$accumsectionlist;
			array_push($chimparraydeduped, $newelement);
			$oldemail = $cbits[0];
			$oldfname = $cbits[1];
			$oldsname = $cbits[2];
			$accumsectionlist = $cbits[5];
		} else {
			$oldemail = $cbits[0];
			$oldfname = $cbits[1];
			$oldsname = $cbits[2];
			$accumsectionlist = $accumsectionlist.",".$cbits[5];
		}
	}
	$newelement = $oldemail.'|'.$oldfname.'|'.$oldsname.'|'.$accumsectionlist;
	array_push($chimparraydeduped, $newelement);
	
	foreach ($chimparraydeduped as $element ) {		
		$cbits = explode('|', $element);
		$outmessage = '"'.$cbits[0].'","'.$cbits[1].'","'.$cbits[2].'","'.$cbits[3].'"';
		fwrite($handle, $outmessage."\n");
	}
	
	fclose($handle);
	
	$link = YPGMLINK("genericdownloadin.php").YPGMSTDPARMS();
	$link = $link.YPGMPARM("DownloadFileName",$downloadfilename);
	$link = $link.YPGMPARM("Action","delete");
	XLINKTXT($link,"Download Mailchimp File");

}


Back_Navigator();
PageFooter("Default","Final");















?>
