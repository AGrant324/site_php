<?php

function Person_Login_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "personloginout";
    $GLOBALS{'SITEJSOPTIONAL'} = "personloginout";
}

function Person_Login_Output () {
    $newstyle = "0";
    if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"sfm"))>0) { $newstyle = "1"; }
    if ( $newstyle == "1" ) {
        BROW();
        BCOLTXT("","5");
        BCOLCENTER("2");
        XIMG("https://www.grassrootspower.support/domain_media/WebPage_Home_GrassRootsLogo.png","100%","","");
        B_COL();
        BCOLTXT("","5");
        B_ROW();
        print '<div>';
        print '<h4 class="card-title text-center mb-4 mt-1">Sign in</h4>';
        XHR();
        BROW();
        BCOLTXT("","4");
        BCOLCENTER("4");
        XTXT("Welcome to Sports Facilities Management");XBR();
        B_COL();
        BCOLTXT("","4");
        B_ROW();
        XBR();
        XFORM("personloginin.php","login");
        XINMINHID();
        BROW();
        BCOLTXT("","4");
        BCOL("4");
        print '<input name="PersonId" class="form-control" placeholder="Personal Id or Email Address">';
        B_COL();
        BCOLTXT("","4");
        B_ROW();
        BROW();
        BCOLTXT("","4");
        BCOL("4");
        print '<input id="password-field" class="form-control" name="PersonPsw" type="password" placeholder="Password" />';
        print '<span toggle="#password-field" class="fa fa-fw fa-eye eye-icon toggle-password"></span>';
        B_COL();
        BCOLTXT("","4");
        B_ROW();
        XBR();
        BROW();
        BCOLTXT("","4");
        BCOL("4");
        print '<button class="btn btn-primary btn-block" type="submit"> Login </button>';
        B_COL();
        BCOLTXT("","4");
        B_ROW();
        // print '<p class="text-center"><a class="btn" href="http://www.grassrootspower.support/site_php/v1_personPWFout.php?ServiceId=sfm&DomainId=sfm&PersonId=&ModeId=1&SessionId=&LoginModeId=1&MenuId=Classic&FrameId=D">Forgot password?</a></p>';
        XBR();
        BROW();
        BCOLTXT("","4");
        BCOLCENTER("4");
        $outtext = "I have forgotten my Password and/or Personal Id";
        $link = YPGMLINK("personPWFout.php").YPGMSTDPARMS();
        XLINKTXT($link,"$outtext");
        B_COL();
        BCOLTXT("","4");
        BROW();
        print '</div>';


    } else {
        XBR();
        if ($GLOBALS{'service_portaltitle'} == "") {
            XH4("Welcome to ".$GLOBALS{'domain_longname'}.".");
            XBR();
            XH4("Please Login.");
        } else {
            XH4("Welcome to the ".$GLOBALS{'domain_longname'}." ".$GLOBALS{'service_portaltitle'}.".");
            XBR();
            XH4("Please Login.");
        }

        XFORM("personloginin.php","login");
        XINMINHID();
        if ($GLOBALS{'LOGIN_canvas_id'} == "M") {
            // ========= Mobile -================
            XPTXT("Personal Id or Email Address");
            BCOLINTXT("PersonId",$GLOBALS{'LOGIN_person_id'},"12");
            XPTXT("Password");
            BCOLINPSWID("PersonPsw","PersonPsw","","12");
            XBR();
            XINSUBMIT("Login");
            XBR();
            if (($GLOBALS{'site_mailsendmethod'} != "")||($GLOBALS{'site_server'} == "W")) {
                XBR();
                $outtext = "I have forgotten my Password and/or Personal Id";
                $link = YPGMLINK("personPWFout.php").YPGMSTDPARMS();
                XLINKTXT($link,"$outtext");
            }
        } else {
            // ========= Desktop or tablet -================
            XTABLE();
            XTR();XTDTXT("Personal Id or Email Address");XTDINTXT("PersonId",$GLOBALS{'LOGIN_person_id'},"40","60");X_TR();
            XTR();
            XTDTXT("Password");
            XTD();
            XINPSW("PersonPsw","","20","30");
            if (($GLOBALS{'site_mailsendmethod'} != "")||($GLOBALS{'site_server'} == "W")) {
                    XBR();
                    $outtext = "I have forgotten my Password and/or Personal Id";
                    $link = YPGMLINK("personPWFout.php").YPGMSTDPARMS();
                    XLINKTXT($link,"$outtext");
            }
            X_TD();
            X_TR();
            XTR();XTDTXT("");XTDINSUBMIT("Login");X_TR();
            X_TABLE();
        }

        X_FORM();
        XBR();

        if (VSF("personmembership")) {
            XH4("Other Options");
            /*
            XBR();XBR();
            $outtext = " - Access for Parents of Junior Member";
            $link = YPGMLINK("personPWFJout.php").YPGMSTDPARMS();
            XLINKTXT($link,"$outtext");
            */
            $outtext = "New to Our Club?  Please create your membership profile here";
            $link = YPGMLINK("personNEWREGout.php").YPGMSTDPARMS().YPGMPARM("ExistingPerson","No");
            XLINKTXT($link,"$outtext");
        }
    }
}

function Person_LoginMultiple_Output ($multipleperson_ida) {
	XH2("Login");
	# # $helplink = "Person/Person_Login_Output/person_login_screen_output.html"; Help_Link;
	XH4("Multiple names found for this email address and password. Please select the one you wish to login as.");
	XFORM("personloginmultiplein.php","multiplelogin");
	XINSTDHID();
	XTABLE();
	XTR();XTDHTXT("Id");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("");X_TR();
	foreach ($multipleperson_ida as $personid) {
		Get_Data('person',$personid);
		XTR();
		XTDTXT($GLOBALS{'person_id'});
		XTDTXT($GLOBALS{'person_fname'});
		XTDTXT($GLOBALS{'person_sname'});
		XTDINRADIO ("MultiplePersonId",$GLOBALS{'person_id'},"","");
		X_TR();
	}
	XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDINSUBMIT("Select");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_PWFmenu_Output () {
	XH3("Forgotten Password");
	# # $helplink = "Person/Person_PWE_Output/person_pwe_output.html"; Help_Link;
	XH5("Use this process to recover your password if you have forgotten it.");
	XH5("Results can only be sent to an email address or mobile number recorded for you on the club records." );;
	XFORM("personPWFmenuin.php","forgotten");
	XINMINHID();
	XINHID("VE","");
	XTABLE();
	XTR();
	XTDINRADIO("PasswordType","M","checked","");
	XTDTXT("My password");
	X_TR();XTR();
	XTDINRADIO("PasswordType","F","checked","");
	XTDTXT("Passwords to login on behalf of my children - Parents of Junior Members");
	XTR();XTDTXT("");XTDINSUBMIT("Continue");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_PWFmember_Output () {
	XH3("Forgotten Your Personal ID and/or Password?");
	# # $helplink = "Person/Person_PWE_Output/person_pwe_output.html"; Help_Link;
	XH5("Please provide some identifying information to enable us to help you to login");
	XFORM("personPWFmemberin.php","forgotten");
	XINSTDHID();
	XINHID("VE","");
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXT("PersonFName","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXT("PersonSName","","20","30");X_TR();
	XTR();XTDTXT("eMail");XTDINTXT("PersonEmail","","40","50");X_TR();
	XTR();XTDTXT("Mobile");XTDINTEL("PersonMobileTel","");X_TR();
	if ($GLOBALS{'domain_showforgottenpasswordemail'} == "ON") {
		XTR();XTDTXT("Event Password (Optional)");XTDINPSW("showforgottenpasswordemailkey","","12","20");X_TR();
	}
	XTR();
	XTDTXT("Preferred Notification Method");
	XTD();
	XINRADIO("NotificationMethod","Email","checked","By Email");
	XBR();
	XINRADIO("NotificationMethod","Mobile","","By Text");
	X_TD();
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Please send me my access details");X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	XPTXT('<b>Please Note</b>: A reset email can only be sent to the email address detailed in your "My Profile" section . If you have a new email address with no access to your previous email address and would like to have this new contact email address registered in the club records then please click here '.YLINKTXT($link,"<b>link</b>").'.');
}

function Person_PWFfamily_Output () {
	XH3("Forgotten Password - Parents of Junior Members");
	# # $helplink = "Person/Person_PWE_Output/person_pwe_output.html"; Help_Link;
	XH5("Please provide some identifying information to enable us to help you to login.");
	XH5("Just identify one child and we will return access details for the full family.");
	XBR();
	XFORM("personPWFfamilyin.php","access");
	XINSTDHID();
	XINHID("VE","");
	XTABLE();
	XTR();XTDTXT("Child's First Name");XTDINTXT("PersonFName","","20","30");X_TR();
	XTR();XTDTXT("Child's Surname");XTDINTXT("PersonSName","","20","30");X_TR();
	XTR();XTDTXT("Child's Date of Birth");XTDINDATEYYYY_MM_DD_AGE("PersonDOB","");X_TR();
	XTR();XTDTXT("Parent's Email");XTDINTXT("ParentEmail","","40","50");X_TR();
	XTR();XTDTXT("Parent's Mobile");XTDINTXT("ParentMobileTel","","40","50");X_TR();
	XTR();
	XTDTXT("Preferred Notification Method");
	XTD();
	XINRADIO("NotificationMethod","Email","checked","By Email");
	XBR();
	XINRADIO("NotificationMethod","Mobile","","By Text");
	X_TD();
	X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Please send me my access details");X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	XPTXT('<b>Please Note</b>: A reset email can only be sent to the email address detailed in your "My Profile" section . If you have a new email address with no access to your previous email address and would like to have this new contact email address registered in the club records then please click here '.YLINKTXT($link,"<b>link</b>").'.');
}


function Person_PWF_CSSJS () {
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,pwfcookie";
}

function Person_PWF_Output () {
    XH3("Forgotten Your Personal ID and/or Password?");
	# # $helplink = "Person/Person_PWE_Output/person_pwe_output.html"; Help_Link;
	XH5("Please provide some identifying information to enable us to help you to login.");
	XFORM("personPWFin.php","forgotten");
	XINSTDHID();
	XINHID("VE","");
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXT("PersonFName","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXT("PersonSName","","20","30");X_TR();
	XTR();XTDTXT("eMail");XTDINTXT("PersonEmail","","40","50");X_TR();
	if ($GLOBALS{'domain_showforgottenpasswordemail'} == "ON") {
		XTR();XTDTXT("Event Password (Optional)");XTDINPSW("showforgottenpasswordemailkey","","12","20");X_TR();
	}
	XTR();XTDTXT("");XTDINSUBMIT("Please email me my password recovery instructions");X_TR();
	X_TABLE();
	X_FORM();
	XBR();
	$link = YPGMLINK("personNEWEMAILout.php").YPGMSTDPARMS().YPGMPARM("ExistingPerson","Yes");
    XPTXT('<b>Please Note</b>: A reset email can only be sent to the email address detailed in your "My Profile" section . If you have a new email address with no access to your previous email address and would like to have this new contact email address registered in the club records then please click here '.YLINKTXT($link,"<b>link</b>").'.');
}

function Person_PW_CSSJS () {
    $GLOBALS{'SITEJSOPTIONAL'} = "bootstrappswupdate";
}

function Person_PW_Output () {
    $htext = "Password maintenance - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
    XH3($htext);
    XBR();
    XPTXT("You may either use a generated password (preferred) or enter one of your own.");
    XPTXT("Passwords must contain a combination of Upper Case, Lower Case and Numeric characters. Generated passwords also contain hyphens for clarity.");
    XPTXT('Passwords should be at least 10 characters and register at least "Strong" on the strength meter.');
    XPTXT("<b>Important: Please keep you password somewhere secure and do not disclose it to anyone.</b>");

    XBR();
    XDIV("pwd-container","");
    XFORM("personPWin.php","passwordmaint");
    XINSTDHID();
    XINHID("PswResetReason",$pswresetreason);
    BROW(); BCOLINPSWID ("OldPW","OldPW","Existing Password","4"); B_ROW();
    XHR();
    BROW(); BCOLINPSWID ("NewPW","NewPW","New Password","4");
    BCOL("2");BINBUTTONIDSPECIAL ("GeneratePW","success","Generate Password");B_COL();
    BCOL("5");BTXTID ("GeneratedPW","");B_COL();
    B_ROW();
    XDIV("pwstrength","pwstrength_viewport_progress");X_DIV("pwstrength");
    BROW(); BCOLINPSWID ("RepeatNewPW","RepeatNewPW","Repeat New Password","4"); B_ROW();
    XBR();
    BCOLINSUBMITID ("submit","Update","4");
    X_FORM();
    X_DIV("pwd-container");
}


function Person_PWR_Output () {
	XH3("Password reset for a person");
	# # $helplink = "PersonerMaPersonerson_PWR_Output/person_pwr_output.html"; Help_Link;
	XFORM("personPWRin.php","passwordreset1");
	XINSTDHID();
	XTABLE();
	XTR();XTDTXT("Personal Id requiring Password Reset");XTDINTXT("ActionPersonId","","20","30");X_TR();
	XTR();XTDTXT("&nbsp;");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_PWR2_CSSJS () {
    $GLOBALS{'SITEJSOPTIONAL'} = "bootstrappswupdate";
}
function Person_PWR2_Output ($changeperson_id) {
    Get_Data('person',$changeperson_id);
    XH3("Password reset - ".$changeperson_id.'" - '.$GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'});
	XPTXT("You may either use a generated password (preferred) or enter one of your own.");
	XPTXT("Passwords must contain a combination of Upper Case, Lower Case and Numeric characters. Generated passwords also contain hyphens for clarity.");
	XPTXT('Passwords should be at least 10 characters and register at least "Strong" on the strength meter.');
	XDIV("pwd-container","");
	XFORM("personPWR2in.php","passwordreset2");
	XINSTDHID();
	XINHID("ActionPersonId",$changeperson_id);
	$outstring = XCrypt($GLOBALS{'person_password'},$changeperson_id,"decrypt");
    XBR();
	XH4("Existing Password");
	BROW(); BCOLINTXTID ("OldPW","OldPW",$outstring,"4");B_ROW();
	XBR();
	XHRCLASS("underline");
	XH4("Reset Password");
	BROW(); BCOLINPSWID ("NewPW","NewPW","New Password","4");
	BCOL("2");BINBUTTONIDSPECIAL ("GeneratePW","success","Generate Password");B_COL();
	BCOL("5");BTXTID ("GeneratedPW","");B_COL();
	B_ROW();
	XDIV("pwstrength","pwstrength_viewport_progress");X_DIV("pwstrength");
	BROW(); BCOLINPSWID ("RepeatNewPW","RepeatNewPW","Repeat New Password","4"); B_ROW();
	XBR();
	BCOLINSUBMITID ("submit","Update","4");

	X_FORM();
	X_DIV("pwd-container");
}

function PWFLinkCodeGenerate ($person_id) {
    $codea = Array();
    $maincode = createRandomString(30);
    array_push($codea,$maincode);
    $keycode = mt_rand(1000,9999);
    array_push($codea,$keycode);
    $maincodex = XCrypt($maincode,$person_id,"encrypt");
    array_push($codea,$maincodex);
    $keycodex = XCrypt($keycode,$person_id,"encrypt");
    array_push($codea,$keycodex);
    return $codea;
}

function Person_NAMEMATCHLIST_Output ($personida,$tactioncode) {
	XH3("Confirm the person for whom the email address is to be updated");
	if( empty( $personida ) ) {
		XH5("Warning - ".$GLOBALS{"person_fname"}." ".$GLOBALS{"person_sname"}." name does not exist in the people database.");
		XFORM("actionmanagerin.php","personNewFromEmail");
		XINSTDHID();
		XINHID("ActionCode",$tactioncode);
		XINHID("ActionReqd","addnewperson");
		XINSUBMIT("Add to database as new member");
		X_FORM();
	} else {
		XH5("Existing Database record");
		XTABLE();
		XTR();
		XTDHTXT("Id");
		XTDHTXT("First Name");
		XTDHTXT("Surname");
		XTDHTXT("Email 1");
		XTDHTXT("Parent/Guardian Email");
		XTDHTXT("Home Tel");
		XTDHTXT("Mobile Tel");
		XTDHTXT("");
		X_TR();
		foreach ($personida as $personid) {
			Get_Data('person',$personid);
			XTR();
			XTDTXT($GLOBALS{'person_id'});
			XTDTXT($GLOBALS{'person_fname'});
			XTDTXT($GLOBALS{'person_sname'});
			XTDTXT($GLOBALS{'person_email1'});
			XTDTXT($GLOBALS{'person_email3'});
			XTDTXT($GLOBALS{'person_hometel'});
			XTDTXT($GLOBALS{'person_mobiletel'});
			$link = YPGMLINK("personNEWEMAILCONFIRMin.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("changeperson_id",$GLOBALS{'person_id'}).YPGMPARM("action_code",$tactioncode);
			XTDLINKTXT($link,"Update with new email address and contact details");
			X_TR();
		}
		X_TABLE();
	}
	Get_Data("action","open",$tactioncode);
    Person_Action2Globals($GLOBALS{'action_string'});

	XH5("New Email Address and Identifying information");
	XTABLE();
	XTR();XTDTXT("Title");XTDTXT($GLOBALS{"person_title"});X_TR();
	XTR();XTDTXT("First Name");XTDTXT($GLOBALS{"person_fname"});X_TR();
	# XTR();XTDTXT("Initials");XTDTXT($GLOBALS{"person_midinits"});X_TR();
	XTR();XTDTXT("Surname");XTDTXT($GLOBALS{"person_sname"});X_TR();
	XTR();XTDHTXT("");XTDHTXT($GLOBALS{""});X_TR();
	XTR();XTDTXT("New Email Address");XTDTXT($GLOBALS{"person_email1"});X_TR();
	XTR();XTDHTXT("");XTDHTXT($GLOBALS{""});X_TR();
	XTR();XTDTXT("House & Street");XTDTXT($GLOBALS{"person_addr1"});X_TR();
	XTR();XTDTXT("Town / City");XTDTXT($GLOBALS{"person_addr2"});X_TR();
	XTR();XTDTXT("State / County");XTDTXT($GLOBALS{"person_addr3"});X_TR();
	XTR();XTDTXT("Country");XTDTXT($GLOBALS{"person_addr4"});X_TR();;
	XTR();XTDTXT("Post Code");XTDTXT($GLOBALS{"person_postcode"});X_TR();
	XTR();XTDTXT("Home Tel");XTDTXT($GLOBALS{"person_hometel"});X_TR();
	XTR();XTDTXT("Work Tel");XTDTXT($GLOBALS{"person_worktel"});X_TR();
	XTR();XTDTXT("Mobile Tel");XTDTXT($GLOBALS{"person_mobiletel"});X_TR();

	XTR();XTDTXT("Section");XTD();
	$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
	XINCHECKBOXHASH($xhash,"person_section",$GLOBALS{'person_section'});
	X_TD();X_TR();
	X_TABLE();
}

function Person_PWGR_Output () {
	XH3("Provide new password");
	# # $helplink = "PersonerMaPersonerson_PWR2_Output/person_pwr2_output.html"; Help_Link;
	XFORM("personPWGRin.php","passwordgeneratereset");
	XINSTDHID();
	XINHID("ActionPersonId",$changeperson_id);
	$htext = "Personal Id - ".$Q.$changeperson_id.$Q." - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};
	XH4($htext);
	$outstring = XCrypt($GLOBALS{'person_password'},$changeperson_id,"decrypt");
	XTABLE();
	XTR();XTDTXT("current password");XTDTXT($outstring);X_TR();
	XTR();XTDTXT("new password - (at least 6 characters)");XTDINPSW("NewPW","","8","8");X_TR();
	XTR();XTDTXT("repeat new password");XTDINPSW("RepeatNewPW","","8","8");X_TR();
	XTR();XTDTXT("&nbsp;");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_MYMEMBERSHIP_Output () {
	XH2("Membership Status ".$GLOBALS{'currperiodid'});

	$personid = $GLOBALS{'LOGIN_person_id'};
	Get_Data('person',$personid);
	$myemaillist =  ""; $sep = "";
	if ($GLOBALS{'person_email1'} != "") {$myemaillist = $myemaillist.$sep.$GLOBALS{'person_email1'}; $sep = ",";}
	if ($GLOBALS{'person_email2'} != "") {$myemaillist = $myemaillist.$sep.$GLOBALS{'person_email2'}; $sep = ",";}
	if ($GLOBALS{'person_email3'} != "") {$myemaillist = $myemaillist.$sep.$GLOBALS{'person_email3'}; $sep = ",";}
	Get_Array('person');
	$anypersonida = Array();
	$anypersonnamea = Array();
	foreach (Get_Array('person') as $tpersonid ) {
		Get_Data('person',$tpersonid);
		$theiremaillist =  ""; $sep = "";
		if ($GLOBALS{'person_email1'} != "") {$theiremaillist = $theiremaillist.$sep.$GLOBALS{'person_email1'}; $sep = ",";}
		if ($GLOBALS{'person_email2'} != "") {$theiremaillist = $theiremaillist.$sep.$GLOBALS{'person_email2'}; $sep = ",";}
		if ($GLOBALS{'person_email3'} != "") {$theiremaillist = $theiremaillist.$sep.$GLOBALS{'person_email3'}; $sep = ",";}
		#�XPTXT($tpersonid." ". $theiremaillist);
		if (MatchLists($myemaillist, $theiremaillist)  ==  true) {
			array_push($anypersonida, $tpersonid );
			$paidmessage = "";
			if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'}) { $paidmessage = "- <b>ALREADY RENEWED</b>"; }
			$anypersonnamea[$tpersonid] = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." ".$paidmessage;
			#�XH5("MATCHED".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
    	}
	}

	$personid = $GLOBALS{'LOGIN_person_id'};
	Get_Data('person',$personid);
	XHR();
	$tpersontypea = Get_Array_Hash('persontype',$GLOBALS{'currperiodid'});
	XH4("Our current records show the following information:");
	XTABLEINVISIBLE();
	XTR();XTDTXTCOLOR("<b>Section</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_section'});X_TR();
	$membershipdescription = "No Previous Membership Details Found";
	Check_Data("persontype",$GLOBALS{'currperiodid'},$GLOBALS{'person_type'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$membershipdescription = $GLOBALS{'persontype_name'};
	}
	XTR();XTDTXTCOLOR("<b>Membership Type</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($membershipdescription);X_TR();
	if ($GLOBALS{'IOWARNING'} == "0") {
    	if ($GLOBALS{'persontype_multimember'} == "Yes") {
    	    XTR();XTDTXTCOLOR("<b>Family Group Members</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");
    	    if ($GLOBALS{'person_paidfamilygroup'} != "") {
    	        $vpaymentgroup = str_replace(',','<br>', $GLOBALS{'person_paidfamilygroup'});
    	        XTDTXT($vpaymentgroup);
    	    } else {
    	        XTDTXT("");
    	    }
    	    X_TR();
    	}
	}
	if ($GLOBALS{'person_paidperiodid'} != "") {
	    XTR();XTDTXTCOLOR("<b>Season</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paidperiodid'});X_TR();
	}
	if (($GLOBALS{'person_paiddate'} != "")&&($GLOBALS{'person_paiddate'} != "0000-00-00")) {
	    XTR();XTDTXTCOLOR("<b>Date Paid</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paiddate'});X_TR();
	}
	if ($GLOBALS{'person_paidmethod'} != "") {
	    XTR();XTDTXTCOLOR("<b>Payment Method</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paidmethod'});X_TR();
	}
	if (($GLOBALS{'person_paidamount'} != "")&&($GLOBALS{'person_paidamount'} != "0.00")) {
	    XTR();XTDTXTCOLOR("<b>Payment Amount</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paidamount'});X_TR();
	}
	if ($GLOBALS{'person_paidincrementfrequency'} == "oneoff") {
	    XTR();XTDTXTCOLOR("<b>Payment Staging</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paidincrementfrequency'});X_TR();
	}
	if ($GLOBALS{'person_paidincrementfrequency'} == "staged") {
	    XTR();XTDTXTCOLOR("<b>Payment Staging</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paidincrementfrequency'});X_TR();
	}
	if ($GLOBALS{'person_paiddetails'} != "") {
	    XTR();XTDTXTCOLOR("<b>Payment Ref/Details</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'person_paiddetails'});X_TR();
	}
	if (($GLOBALS{'person_paiddate'} != "")&&($GLOBALS{'person_paiddate'} != "0000-00-00")) {
	    XTR();XTDTXTCOLOR("<b>Payment Confirmed Date</b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");
		if (($GLOBALS{'person_paidconfirmationdate'} != "")&&($GLOBALS{'person_paidconfirmationdate'} != "0000-00-00")) {
			XTDTXT($GLOBALS{'person_paidconfirmationdate'});
		} else {
			XTDTXT("Awaiting treasurer confirmation");
		}
		X_TR();
	}
	X_TABLE();
	if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'}) {
		XBR();XTDTXTGREEN("Thank You: Membership has been renewed for this season.");
		XHR();
	} else {
	    XBR();XTDTXTRED("Your membership is currently outstanding for this season, it would really help the club if you could settle your account by completing the Renew my Membership Section below please");
		XHR();
		XH2("Renew my membership for ".$GLOBALS{'currperiodid'});
		XFORM("personmembershiprenewal1.php","membershiprenewal1");
		XINSTDHID();
		XH4("Confirm your section.");
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XINCHECKBOXHASH($xhash,"section_name",$GLOBALS{'person_section'});
		XH4("Select your membership category and how you would like to pay.");

		if ( sizeof($anypersonida) > 1 ) {
			XPTXT("<B>Note:</B> You have other family members associated with this email address - please indicate which members you would like to include in this payment.");
			XINCHECKBOXHASH($anypersonnamea,"IncludedPersonIdList","");
			XBR();
		}

		XTABLE();
		XTDHTXT("Membership Type");
		XTDHTXT("");
		XTDHTXT("One Off Payment");
		XTDHTXT("");
		XTDHTXT("Staged Monthly Payments");
		foreach ($tpersontypea as $tpersontype ) {
			Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
			if ($GLOBALS{'persontype_selectable'} == "Yes") {
				XTR();
				XTDTXT($GLOBALS{'persontype_name'}.":  ");
				if ($GLOBALS{'persontype_multimember'} == "Yes") { XTDTXT("Group"); }
				else { XTDTXT(""); }
				# radioid/name, value, selected, text
				XTD();
				XINRADIO ('TypeFreq',$GLOBALS{'persontype_code'}."|oneoff","","");
				XTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'});
				X_TD();
				if (intval($GLOBALS{'persontype_annualstagedfee'} > 0)) {
					XTDTXT("or");
					XTD();
					XINRADIO ('TypeFreq',$GLOBALS{'persontype_code'}."|staged","","");
					XTXT(intval($GLOBALS{'persontype_annualstagedrecurringpayments'})." payments of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'});
					X_TD();
				} else {
					XTDTXT("");
					XTDTXT("");
				}
				X_TR();

			}

		}
		XTABLE();
		#�XH4("Select your payment method.");
		#�$xhash = List2Hash("One Off payment,Staged Payment");
		#�XINRADIOHASH($xhash,"payment_method",$GLOBALS{'person_type'});
		#�XBR();
		X_TABLE();
		XINSUBMIT("Next");
		X_FORM();
		XHR();
	}

	XBR();XBR();
	$link = YPGMLINK("membershipoptionsout.php").YPGMSTDPARMS();
	XLINKTXTNEWPOPUP($link,"Types of Membership available","membership","center","center","600","600");XBR();
}

function Person_MEMBERSHIPRENEWAL1_CSSJS () {
    $GLOBALS{'SITEJSOPTIONAL'} = "personmembershiprenewal1";
}


function Person_MEMBERSHIPRENEWAL1_Output ($persontypecode, $paymentfreq, $includedpersonidlist) {
	$includedpersonida = explode(',',$includedpersonidlist);
	$includedpersonnamelist = ""; $sep = "";
	foreach ($includedpersonida as $includedpersonid) {
		Get_Data("person",$includedpersonid);
		$includedpersonnamelist = $includedpersonnamelist.$sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$sep=", ";
	}
	XH2("Membership Renewal ".$GLOBALS{'currperiodid'}."&nbsp;&nbsp;(".$includedpersonnamelist.")");
	$personid = $GLOBALS{'LOGIN_person_id'};
	Get_Data('person',$personid);
	XH3("You have asked to set up the following membership renewal:");
	Get_Data('persontype',$GLOBALS{'currperiodid'},$persontypecode);
	XTABLEINVISIBLE();
	XTR();XTDTXTCOLOR("<b>Membership Type:  </b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($GLOBALS{'persontype_name'});X_TR();
	if ($paymentfreq == "oneoff") {
		$paymentmethodtext =  "A single payment of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'};
	}
	if ($paymentfreq == "staged") {
		$paymentmethodtext =  intval($GLOBALS{'persontype_annualstagedrecurringpayments'})." monthly payments of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'};
	}
	XTR();XTDTXTCOLOR("<b>Payment Method:  </b>","#2F79B9");XTDTXT("&nbsp;&nbsp;");XTDTXT($paymentmethodtext);X_TR();
	X_TABLE();
	XHR();
	XFORM("personmembershiprenewal2.php","membershiprenewal1");
	if ($GLOBALS{'persontype_multimember'} == "Yes") {
		XH3("Family members being paid for");
		$imax = $GLOBALS{'persontype_multimemberquantity'};
		$includedpersonnamelista = List2Array($includedpersonnamelist);
		for ($i = 0; $i < $imax; $i++) {
		    if(isset($includedpersonnamelista[$i])) { $personname = $includedpersonnamelista[$i];  }
		    else { $personname = ""; }
		    XINTXTID("PaymentGroup".$i,"PaymentGroup".$i,$personname,"20","40");XBR();
		}
		XINHIDID("PaymentGroup","PaymentGroup",$includedpersonnamelist);
		XBR();
	}
	XH3("Select Payment Method.");
	# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
	if ($paymentfreq != "staged") {
		$xhash = Lists2Hash("BankTransfer,PayPal,Cheque","Bank Transfer (preferred),Debit/Credit Card via PayPal (+3%),Cheque"); #CHECK should link to payment options
	} else {
		$xhash = Lists2Hash("BankTransfer,Cheque","Bank Transfer (preferred),Cheque"); #CHECK should link to payment options
	}
	XINRADIOHASH($xhash,"PaymentMethod","");
	XINSTDHID();
	XINHID('Type',$persontypecode);
	XINHID('Freq',$paymentfreq);
	XINHID('IncludedPersonIdList',$includedpersonidlist);
	XBR();
	XINSUBMIT("Next");
	X_FORM();
}

function Person_MEMBERSHIPRENEWAL2BANK_Output ($persontypecode, $paymentfreq, $includedpersonidlist, $paymentgroup) {
	$includedpersonida = explode(',',$includedpersonidlist);
	$includedpersonnamelist = ""; $sep = "";
	$includedpersonnametext = ""; $tsep = "";
	foreach ($includedpersonida as $includedpersonid) {
		Get_Data("person",$includedpersonid);
		$includedpersonnamelist = $includedpersonnamelist.$sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$sep=", ";
		$includedpersonnametext = $includedpersonnametext.$tsep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$tsep=", ";
	}
	XH2("Membership Renewal Bank Transfer ".$GLOBALS{'currperiodid'}." - (".$includedpersonnamelist.")");
	$personid = $GLOBALS{'LOGIN_person_id'};
	Get_Data('person',$personid);
	$sectiona = explode(",",$GLOBALS{'person_section'});
	$lastseq = 999;
	$lastsection_name = "";
	foreach ($sectiona as $section_name ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
		if (intval($GLOBALS{'section_seq'}) < $lastseq) {
			$lastseq = $GLOBALS{'section_seq'};
			$lastsection_name = $section_name;
		}
	}
	if ( $lastsection_name != "" ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$lastsection_name);
		Get_Data('persontype',$GLOBALS{'currperiodid'},$persontypecode);
		XHR();
		XH3("Step 1 - Pay using your online banking system.");
		XUL("","");
		XLI("","");XTXT("Open up a new browser window and navigate to your online banking.");XTXT(" [ ");XLINKTXTNEWWINDOW("https://www.google.com","open new window for me","My Bank Transfer");XTXT(" ]");X_LI();
		XLI("","");XTXT("Select Payment (One Off Payment) - or Standing Order (Staged Payment).");X_LI();
		XLI("","");XTXT("Initiate the bank payment using the bank sort code and account code shown below.");X_LI();
		XLI("","");XTXT("Confirm the payment date(s) and your Payment Reference used on this screen when you have finished.");X_LI();
		X_UL();
		XTABLE();
		XTR();XTDTXT("Bank Sort Code");XTDTXT($GLOBALS{'section_banksort'});X_TR();
		XTR();XTDTXT("Bank Account Code");XTDTXT($GLOBALS{'section_bankaccount'});X_TR();
		XTR();XTDTXT("Bank Account Name");XTDTXT($GLOBALS{'section_bankaccountname'});X_TR();
		if ($paymentfreq == "oneoff") {
			$paymentmethodtext =  "A single payment of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'};
		}
		if ($paymentfreq == "staged") {
			$paymentmethodtext =  intval($GLOBALS{'persontype_annualstagedrecurringpayments'})." monthly payments of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'};
		}
		XTR();XTDTXT("Amounts(s)");XTDTXT($paymentmethodtext);X_TR();
		$inputcomplete = "1";
		if ($GLOBALS{'persontype_multimember'} == "Yes") {
			XTR();XTDTXT("Family Group Members");
			if ($paymentgroup != "") {
			    $vpaymentgroup = str_replace(',','<br>', $paymentgroup);
			    XTDTXT($vpaymentgroup);
			}
			else {
				XTDTXT("ERROR: Please go back to provide details of Family Members");
				$inputcomplete = "0";
		  	}
			X_TR();
		}
		X_TABLE();
		XBR();

		if ($inputcomplete == "1") {
			XHR();
			XFORM("personmembershiprenewal3.php","membershiprenewal2bank");
			XH3("Step 2 - Confirmation.");
			XINSTDHID();
			XINHID('Type',$persontypecode);
			XINHID('Freq',$paymentfreq);
			XINHID('Method',"Bank Transfer");
			XINHID('IncludedPersonIdList',$includedpersonidlist);
			XINHID('PaymentGroup',$paymentgroup);
			XTABLEINVISIBLE();
			if ($paymentfreq == "oneoff") {
				XINHID('Amount',$GLOBALS{'persontype_annualoneofffee'});
				XTR();XTDTXT("Payment Date");XTDTXT("&nbsp;&nbsp;");XTDINDATEYYYY_MM_DD ("PaymentDate",$GLOBALS{'currentYYYY-MM-DD'});X_TR();
			}
			if ($paymentfreq == "staged") {
				XINHID('Amount',$GLOBALS{'persontype_annualstagedfee'});
				for ($ti = 0; $ti < $GLOBALS{'persontype_annualstagedrecurringpayments'}; $ti++) {
				    XTR();XTDTXT("Payment ".($ti+1)." scheduled for");XTDTXT("&nbsp;&nbsp;");XTDINDATEYYYY_MM_DD ("PaymentDate".($ti+1),AddMonth($GLOBALS{'currentYYYY-MM-DD'},$ti));X_TR();
				}
			}
			XTR();XTDTXT("Payment Reference");XTDTXT("&nbsp;&nbsp;");XTDINTXT("PaymentDetails","","25","50");X_TR();
			if ($paymentfreq == "oneoff") {	$confirmmessage =  "I confirm that the above payment has been processed.";	}
			if ($paymentfreq == "staged") {	$confirmmessage =  "I confirm that the above payments have been scheduled.";	}
			XTR();XTDTXT("Confirmation");XTDTXT("&nbsp;&nbsp;");XTDINCHECKBOX("Confirmation","Yes","",$confirmmessage);X_TR();
			X_TABLE();
			XBR();XBR();
			XINSUBMIT("Finalise");
			XBR();XBR();
			XPTXTCOLOR("Please note that you will not be able to make changes to your membership status after this point.","green");
			X_FORM();
		} else {
			XBR();
			print '<a onClick="history.go(-1)"><button type="button">Go back to complete information</button></a>';
		}

	} else {
		XH4("No Section Found");
	}
}

function Person_MEMBERSHIPRENEWAL2PAYPAL_Output ($persontypecode, $paymentfreq, $includedpersonidlist, $paymentgroup) {
	$includedpersonida = explode(',',$includedpersonidlist);
	$includedpersonnamelist = ""; $sep = "";
	$includedpersonnametext = ""; $tsep = "";
	foreach ($includedpersonida as $includedpersonid) {
		Get_Data("person",$includedpersonid);
		$includedpersonnamelist = $includedpersonnamelist.$sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$sep=", ";
		$includedpersonnametext = $includedpersonnametext.$tsep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$tsep=", ";
	}
	XH2("Membership Renewal Debit/Credit Card via PayPal ".$GLOBALS{'currperiodid'}." - (".$includedpersonnamelist.")");
	XBR();
	$personid = $GLOBALS{'LOGIN_person_id'};
	Get_Data('person',$personid);
	$sectiona = explode(",",$GLOBALS{'person_section'});
	$lastseq = 999;
	$lastsection_name = "";
	foreach ($sectiona as $section_name ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
		if (intval($GLOBALS{'section_seq'}) < $lastseq) {
			$lastseq = $GLOBALS{'section_seq'};
			$lastsection_name = $section_name;
		}
	}
	if ( $lastsection_name != "" ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$lastsection_name);
		Get_Data('persontype',$GLOBALS{'currperiodid'},$persontypecode);

		$inputcomplete = "1";
		XTABLE();
		$paymentmethodtext =  "A single payment of ".$GLOBALS{'countrycurrencysymbol'}.number_format(($GLOBALS{'persontype_annualoneofffee'}*1.03), 2, '.', '');
		XTR();XTDTXT("Membership Type");XTDTXT($GLOBALS{'persontype_name'});X_TR();
		XTR();XTDTXT("Amount");XTDTXT($paymentmethodtext);X_TR();
		if ($GLOBALS{'persontype_multimember'} == "Yes") {
			XTR();XTDTXT("Family Group Members");
			if ($paymentgroup != "") {
			    $vpaymentgroup = str_replace(',','<br>', $paymentgroup);
			    XTDTXT($vpaymentgroup);
			}
			else {
				XTDTXT("ERROR: Please go back to provide details of Family Members");
				$inputcomplete = "0";
		  	}
			X_TR();
		}
		X_TABLE();

		if ($inputcomplete == "1") {
			XH3("Proceed to make payment");
			XUL("","");
			XLI("","");XTXT('Please note that you dont have to have a paypal account... just use the option to "Pay by Debit/Credit Card".');X_LI();
			XLI("","");XTXT("Check that the Card you are using matches the pre-populated address - or change the address to match the Card.");X_LI();
			XLI("","");XTXT('After payment select the "Return to Club" link on the final paypal screen to finalise your membership update.');X_LI();
			X_UL();
			$paypalamount = number_format(($GLOBALS{'persontype_annualoneofffee'}*1.03), 2, '.', '');
			// if (($GLOBALS{'LOGIN_person_id'} == "bbra")||($GLOBALS{'LOGIN_person_id'} == "abow")) { $paypalamount = "1.00";}

			$underage = UnderAge(18,$GLOBALS{'person_dob'});
			if ($underage) {
				$paypalfname = $GLOBALS{'person_parentfname'};
				$paypalsname = $GLOBALS{'person_parentsname'};
				if ($GLOBALS{'person_email3'} != "" ) { $paypalemail =  $GLOBALS{'person_email3'}; }
				else { $paypalemail =  $GLOBALS{'person_email1'}; }
				if (($GLOBALS{'person_hometel'} != "" )&&($GLOBALS{'person_hometel'} != " ")) { $paypaltel =  $GLOBALS{'person_hometel'}; }
				else {
					if (($GLOBALS{'person_mobiletel'} != "" )&&($GLOBALS{'person_mobiletel'} != " ")) { $paypaltel =  $GLOBALS{'person_mobiletel'}; }
					else { $paypaltel =  $GLOBALS{'person_emergencytel'}; }
				}
			} else {
				$paypalfname = $GLOBALS{'person_fname'};
				$paypalsname = $GLOBALS{'person_sname'};
				$paypalemail = $GLOBALS{'person_email1'};
				if (($GLOBALS{'person_hometel'} != "" )&&($GLOBALS{'person_hometel'} != " ")) { $paypaltel =  $GLOBALS{'person_hometel'}; }
				else {
					if (($GLOBALS{'person_mobiletel'} != "" )&&($GLOBALS{'person_mobiletel'} != " ")) { $paypaltel =  $GLOBALS{'person_mobiletel'}; }
					else { $paypaltel =  $GLOBALS{'person_emergencytel'}; }
				}
			}
			print'<form action="https://www.paypal.com/cgi-bin/webscr" method="post">'."\n";
			XINHID('business',$GLOBALS{'section_paypalemail'});
			XINHID('cmd',"_xclick");
			XINHID('item_name',$GLOBALS{'persontype_name'});
			// domain_id|purposetype|purposeref|personid|persontype|includedpersonidlist|paymentgroup
			XINHID('item_number',$GLOBALS{'LOGIN_domain_id'}."|Membership|".$GLOBALS{'currperiodid'}."|".$personid."|".$persontypecode."|".$includedpersonidlist."|".$paymentgroup);
			XINHID('first_name',$paypalfname);
			XINHID('last_name',$paypalsname);
			XINHID('address1',$GLOBALS{'person_addr1'});
			XINHID('address2',$GLOBALS{'person_addr2'});
			XINHID('city',$GLOBALS{'person_addr3'});
			XINHID('state',$GLOBALS{'addr4'});
			XINHID('zip',$GLOBALS{'person_postcode'});
			XINHID('email',$paypalemail);
			if ($paypaltel != "") {
				if (substr($paypaltel, 0, 1) == "0") { // well formed phone number
					$tbits = explode(" ",$paypaltel);
					XINHID('night_phone_a',"44");
					XINHID('night_phone_b',$tbits[0].$tbits[1]);
				}
			}
			XINHID('amount',$paypalamount);
			XINHID('currency_code',"GBP");

			$paypalsuccesslink = YPGMLINK("personmembershiprenewal3.php");
			$paypalsuccesslink = $paypalsuccesslink.YPGMSTDPARMS();
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('Type',$persontypecode);
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('Freq',$paymentfreq);
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('IncludedPersonIdList',$includedpersonidlist);
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('PaymentGroup',$paymentgroup);
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('Method',"PayPal");
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('Amount',$paypalamount);
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('PaymentDetails',"");
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('PaymentDate_DDpart',$GLOBALS{'dd'});
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('PaymentDate_MMpart',$GLOBALS{'mm'});
			$paypalsuccesslink = $paypalsuccesslink.YPGMPARM('PaymentDate_YYYYpart',$GLOBALS{'yyyy'});

			XINHID('return',$paypalsuccesslink);
			$paypalcancellink = YPGMLINK("personmembershippaypalcancel.php");
			$paypalcancellink = $paypalcancellink.YPGMSTDPARMS();
			$paypalcancellink = $paypalcancellink.YPGMPARM('TypeFreq',$persontypecode."|".$paymentfreq);
			$paypalcancellink = $paypalcancellink.YPGMPARM('IncludedPersonIdList',$includedpersonidlist);
			XINHID('cancel_return"',$paypalcancellink);
			print'<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" alt="PayPal - The safer, easier way to pay online"> 	<img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >';
			X_FORM();
			XBR();XBR();
			XPTXTCOLOR("Please note that you will not be able to make changes to your membership status after this point.","green");
		} else {
			XBR();
			print '<a onClick="history.go(-1)"><button type="button">Go back to complete information</button></a>';
		}

	} else {
		XH4("No Section Found");
	}
}

function Person_MEMBERSHIPRENEWAL2CHEQUE_Output ($persontypecode, $paymentfreq, $includedpersonidlist, $paymentgroup) {
	$includedpersonida = explode(',',$includedpersonidlist);
	$includedpersonnamelist = ""; $sep = "";
	$includedpersonnametext = ""; $sep = "";
	foreach ($includedpersonida as $includedpersonid) {
		Get_Data("person",$includedpersonid);
		$includedpersonnamelist = $includedpersonnamelist.$sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$sep=", ";
		$includedpersonnametext = $includedpersonnametext.$sep.$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'};$sep="</br>";
	}
	XH2("Membership Renewal Cheque ".$GLOBALS{'currperiodid'}." - (".$includedpersonnamelist.")");
	$personid = $GLOBALS{'LOGIN_person_id'};
	Get_Data('person',$personid);
	$sectiona = explode(",",$GLOBALS{'person_section'});
	$lastseq = 999;
	$lastsection_name = "";
	foreach ($sectiona as $section_name ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$section_name);
		if (intval($GLOBALS{'section_seq'}) < $lastseq) {
			$lastseq = $GLOBALS{'section_seq'};
			$lastsection_name = $section_name;
		}
	}
	if ( $lastsection_name != "" ) {
		Get_Data_Hash('section',$GLOBALS{'currperiodid'},$lastsection_name);
		Get_Data('persontype',$GLOBALS{'currperiodid'},$persontypecode);
		XPTXT("Please make a cheque to the following account.");
		XTABLE();
		XTR();XTDTXT("Cheque payable to");XTDTXT($GLOBALS{'section_bankaccountname'});X_TR();
		Get_Data('person',$GLOBALS{'section_treasurer'});
		XTR();XTDTXT("Send to");XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TR();
		$addresstext = $GLOBALS{'person_addr1'}."<br>".$GLOBALS{'person_addr2'}."<br>".$GLOBALS{'person_addr3'}."<br>".$GLOBALS{'person_addr4'}."<br>".$GLOBALS{'person_postcode'};
		XTR();XTDTXT("");XTDTXT($addresstext);X_TR();
		if ($paymentfreq == "oneoff") {
			$paymentmethodtext =  "A single payment of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'};
		}
		if ($paymentfreq == "staged") {
			$paymentmethodtext =  intval($GLOBALS{'persontype_annualstagedrecurringpayments'})." cheque payments of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'};
		}
		XTR();XTDTXT("Amounts(s)");XTDTXT($paymentmethodtext);X_TR();
		$inputcomplete = "1";
		if ($GLOBALS{'persontype_multimember'} == "Yes") {
			XTR();XTDTXT("Family Group Members");
			if ($paymentgroup != "") {
			    $vpaymentgroup = str_replace(',','<br>', $paymentgroup);
			    XTDTXT($vpaymentgroup);
			}
			else {
				XTDTXT("ERROR: Please go back to provide details of Family Members");
				$inputcomplete = "0";
		  	}
			X_TR();
		}
		X_TABLE();
		XBR();

		if ($inputcomplete == "1") {
			XHR();
			XFORM("personmembershiprenewal3.php","membershiprenewal2cheque");
			XH3("Confirmation.");
			XINSTDHID();
			XINHID('Type',$persontypecode);
			XINHID('Freq',$paymentfreq);
			XINHID('Method',"Cheque");
			XINHID('IncludedPersonIdList',$includedpersonidlist);
			XINHID('PaymentGroup',$paymentgroup);
			XTABLEINVISIBLE();

			if ($paymentfreq == "oneoff") {
				XINHID('Amount',$GLOBALS{'persontype_annualoneofffee'});
				XTR();XTDTXT("Cheque Date");XTDINDATEYYYY_MM_DD ("PaymentDate",$GLOBALS{'currentYYYY-MM-DD'});X_TR();
			}
			if ($paymentfreq == "staged") {
				XINHID('Amount',$GLOBALS{'persontype_annualstagedfee'});
				for ($ti = 0; $ti < $GLOBALS{'persontype_annualstagedrecurringpayments'}; $ti++) {
					XTR();XTDTXT("Cheque ".($ti+1)." dated");XTDINDATEYYYY_MM_DD ("PaymentDate".($ti+1),$GLOBALS{'currentYYYY-MM-DD'});X_TR();
				}
			}
			XTR();XTDTXT("Payment Details - <br>i.e To whom payment was made if not mailed.");XTDINTEXTAREA("PaymentDetails","","4","40");X_TR();
			if ($paymentfreq == "oneoff") {
				$confirmmessage =  "I confirm that the above payment has been processed.";
			}
			if ($paymentfreq == "staged") {
				$confirmmessage =  "I confirm that the above payments have been processed.";
			}
			XTR();XTDTXT("Confirmation");XTDINCHECKBOX("Confirmation","Yes","",$confirmmessage);X_TR();
			X_TABLE();
			XBR();XBR();
			XINSUBMIT("Finalise");
			XBR();XBR();
			XPTXTCOLOR("Please note that you will not be able to make changes to your membership status after this point.","green");
			X_FORM();
		} else {
			XBR();
			print '<a onClick="history.go(-1)"><button type="button">Go back to complete information</button></a>';
		}
	} else {
		XH4("No Section Found");
	}
}

function Person_MEMBERSHIPANALYSIS_Output() {

	$parm0 = "";
	$parm0 = $parm0."Membership Analysis - ".$GLOBALS{'currperiodid'}."|"; # pagetitle
	// $parm0 = $parm0."person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section+person_type+person_paidperiodid+person_membershipnotificationemailsent+person_paiddate+person_paidmethod+person_paidamount+person_paidincrementfrequency+person_paidincrementamount+person_paidincrementnumber+person_paiddetails+person_paidfamilygroup+person_paidconfirmationperiodid+person_paidconfirmationdate]|"; # primetable
	$parm0 = $parm0."person|"; # primetable
	$parm0 = $parm0."period,section[rootkey=".$GLOBALS{'currperiodid'}."],persontype[rootkey=".$GLOBALS{'currperiodid'}."]|"; # othertables
	$parm0 = $parm0."person_id|"; # keyfieldname
	$parm0 = $parm0."person_id|"; # sortfieldname
	$parm0 = $parm0."100|"; # pagination
	$parm0 = $parm0."NoAdd"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."person_id|Yes|Id|30|Yes|Id|KeyText,6,12^";
	$parm1 = $parm1."person_fname|Yes|FName|45|Yes|First Name|InputText,20,40^";
	$parm1 = $parm1."person_sname|Yes|SName|55|Yes|Surname|InputText,20,40^";
	$parm1 = $parm1."person_section|Yes|Section|55|Yes|Section|InputCheckboxFromTable,section,section_name,section_name,section_seq^";
	$parm1 = $parm1."person_type|Yes|Type|100|Yes|Membership Type|InputSelectFromTable,persontype,persontype_code,persontype_name,persontype_seq^";
	$parm1 = $parm1."person_paidperiodid|Yes|Season|55|Yes|Paid Season|InputSelectFromTable,period,period_id,period_id,period_id^";
	$parm1 = $parm1."person_membershipnotificationemailsent|Yes|Notd|35|Yes|Notified by Email|InputSelectFromList,Yes+No^";
	$parm1 = $parm1."person_paiddate|Yes|DatePd|60|Yes|Paid Date|InputDate^";
	$parm1 = $parm1."person_paidmethod|Yes|Method|85|Yes|Paid Method|InputSelectFromList,Bank Transfer+PayPal+Cheque+Cash^";
	$parm1 = $parm1."person_paidamount|Yes|Amnt|40|Yes|Paid Amount|InputText,20,40^";
	$parm1 = $parm1."person_paidincrementfrequency|No|Amount|50|Yes|Payment Staging|InputSelectFromList,oneoff+staged^";
	#�$parm1 = $parm1."person_paidincrementamount|No|Amount|50|Yes|Paid Increment Amount|InputText,20,40^";
	#�$parm1 = $parm1."person_paidincrementnumber|No|Amount|50|Yes|Paid Increment Number|InputText,20,40^";
	$parm1 = $parm1."person_paiddetails|No|Details|100|Yes|Paid Details|InputTextArea,3,50^";
	$parm1 = $parm1."person_paidfamilygroup|No|Details|100|Yes|Family Group Members|InputTextArea,3,50^";
	$parm1 = $parm1."person_paidconfirmationperiodid|Yes|Conf Season|55|Yes|Conf Season|InputSelectFromTable,period,period_id,period_id,period_id^";
	$parm1 = $parm1."person_paidconfirmationdate|No||60|Yes|Paid Confirmation Date|InputDate^";
	// $parm1 = $parm1."person_paidconfirmationemailsent|Yes|Cfmd|35|Yes|Confirmed by Email|InputSelectFromList,Yes+No^"; // To be deprecated
	$parm1 = $parm1."generic_updatebutton|Yes|Check|60|No|Check|UpdateButton^";
	$parm1 = $parm1."generic_programbutton|Yes|Confirm|60|No|Confirm|ProgramButton,personmembershipconfirm.php,confirmperson_id,person_id,newpopup,800,600";
	GenericHandler_Output ($parm0,$parm1);
}



function Person_NEWREG_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,formchecker";
}

function Person_NEWREG_Output ($mode,$person_id,$actioncode,$existingpersonidlist) {
	# registration confirmation
	$personid = $GLOBALS{'LOGIN_person_id'};
	# # $helplink = "PersonerMaPersonerson_PWR2_Output/person_pwr2_output.html"; Help_Link;
	if ($mode == "REG") {
		XH2("Online Membership Application");
		XPTXT($GLOBALS{'domain_personmembershipintrotext'});
		XFORM("personNEWREGin.php","personNEWREG");
		XINSTDHID();
		XINHID("SubmitId","RegFormSubmit");
		XINHID("WarningMessageId","regwarningmessage");
		XINHID("EditEnabled","Yes");
		XINHID("AgreementEnabled","Yes");
		Initialise_Data('person');
	}
	if ($mode == "CONFIRM") {
		Person_Action2Globals($GLOBALS{'action_string'});
		XH2("New Member - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
		XFORM("personNEWREGCONFIRMin.php","personNEWCONFIRM");
		XINSTDHID();
		XINHID("SubmitId","ConfirmFormSubmit");
		XINHID("WarningMessageId","confirmwarningmessage");
		XINHID("EditEnabled","Yes");
		XINHID("AgreementEnabled","No");
		XINHID("action_code",$actioncode);
		if ($existingpersonidlist != "") {
			XH5('Warning: There are already records in the database with the same name');
			XPTXT("Please select which record is to be updated with this information.");
			$eperson_ida = explode(',',$existingpersonidlist);
			XTABLE();
			XTR();XTDTXT("Create New Record");XTDTXT($person_id);XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
			XTDTXT($GLOBALS{'person_email1'});XTDINRADIO ("person_id",$person_id,"","");X_TR();
			foreach ($eperson_ida as $eperson_id) {
				Get_Data('person',$eperson_id);
				XTR();XTDTXT("Update Existing Record");XTDTXT($eperson_id);XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
				XTDTXT($GLOBALS{'person_email1'});XTDINRADIO ("person_id",$eperson_id,"checked","");X_TR();
			}
			X_TABLE();
			Person_Action2Globals($GLOBALS{'action_string'});
		} else {
			XPTXT("This person has been assigned a Personal Id of - ".$person_id);
			XINHID("person_id",$person_id);
		}
		XPTXT("Please check and confirm the membership request");
	}
	// fieldname1|fieldtype1|labelid1|highlighttype1|highlightid1|mandatory1|editrule1^
	$mfparm = "";
	$mfparm = $mfparm."person_fname|INTXT|person_fname_label|INTXT|person_fname|Yes|^";
	$mfparm = $mfparm."person_sname|INTXT|person_sname_label|INTXT|person_sname|Yes|^";
	$mfparm = $mfparm."person_postcode|INTXT|person_postcode_label|INTXT|person_postcode|Yes|^";
	if (VSF("personmedical")) { $mfparm = $mfparm."person_emergencytel|INTEL|person_emergencytel_label|INTEL|person_emergencytel|Yes|^"; }
	if (VSF("personsafeguarding")) { $mfparm = $mfparm."person_dob|INDATE|person_dob_label|INDATE|person_dob|Yes|^"; }
	$mfparm = $mfparm."person_section|INCHECKBOX|person_section_label|TD|person_section_cell|Yes|^";
	if (VSF("personmembership")) { $mfparm = $mfparm."person_type|INRADIO|person_type_label|TD|person_type_cell|Yes|^"; }
	if (VSF("personethnicity")) { $mfparm = $mfparm."person_ethnicity|INSELECT|person_ethnicity_label|INSELECT|person_ethnicity|Yes|^"; }
	if (VSF("persondisabiity")) { $mfparm = $mfparm."person_disability|INSELECT|person_disability_label|INSELECT|person_disability|Yes|"; }
	XINHID("EditFields",$mfparm);

	XH3("Member Contact Information");
	XTABLE();
	XTR();XTDHTXT("Mandatory Fields  *");XTDHTXT("");X_TR();
	XTR();XTDTXT("Title");XTDINTXT("person_title",$GLOBALS{'person_title'},"25","50");X_TR();
	XTR();XTDTXTID("person_fname_label","First Name*");XTDINTXTID("person_fname","person_fname",$GLOBALS{'person_fname'},"25","50");X_TR();
	# XTR();XTDTXT("Initials");XTDINTXT("person_midinits",$GLOBALS{'person_midinits'},"25","50");X_TR();
	XTR();XTDTXTID("person_sname_label","Surname*");XTDINTXTID("person_sname","person_sname",$GLOBALS{'person_sname'},"25","50");X_TR();
	XTR();XTDTXT("House & Street");XTDINTXT("person_addr1",$GLOBALS{'person_addr1'},"25","50");X_TR();
	XTR();XTDTXT("Town / City");XTDINTXT("person_addr2",$GLOBALS{'person_addr2'},"25","50");X_TR();
	XTR();XTDTXT("State / County");XTDINTXT("person_addr3",$GLOBALS{'person_addr3'},"25","50");X_TR();
	XTR();XTDTXT("Country");XTDINTXT("person_addr4",$GLOBALS{'person_addr4'},"25","50");X_TR();
	XTR();XTDTXTID("person_postcode_label","Post Code*");XTDINTXTID("person_postcode","person_postcode",$GLOBALS{'person_postcode'},"12","12");X_TR();
	XTR();XTDTXT("Home Tel");XTDINTEL("person_hometel",$GLOBALS{'person_hometel'});X_TR();
	XTR();XTDTXT("Work Tel");XTDINTEL("person_worktel",$GLOBALS{'person_worktel'});X_TR();
	XTR();XTDTXT("Mobile Tel");XTDINTEL("person_mobiletel",$GLOBALS{'person_mobiletel'});X_TR();
	XTR();XTDTXT("Email Address (or Parent/Guardian email - see below)*");XTD();XINTXT("person_email1",$GLOBALS{'person_email1'},"50","70");
	if (VSF("personsafeguarding")) { XTR();XTDTXTID("person_dob_label","Date of Birth*");XTDINDATEYYYY_MM_DD_AGE("person_dob",$GLOBALS{'person_dob'});X_TR(); }
	X_TABLE();

	if (VSF("personmembership")) {
		XH3("Select Club Subsection and Membership Type");
		XPTXT($GLOBALS{'domain_personmembershiptypetext'});
		XTABLE();
		XTR();XTDTXTID("person_section_label","Section that you would like to join*");XTDID("person_section_cell");
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","section_archive","No" );
		XINCHECKBOXHASH($xhash,"person_section",$GLOBALS{'person_section'});
		X_TD();X_TR();
		XTR();XTDTXTID("person_type_label","Membership Type");XTDID("person_type_cell");
		XTABLE();
		$tpersontypea = Get_Array_Hash('persontype',$GLOBALS{'currperiodid'});
		foreach ($tpersontypea as $tpersontype ) {
			Get_Data_Hash('persontype',$GLOBALS{'currperiodid'},$tpersontype);
			if ($GLOBALS{'persontype_selectable'} == "Yes") {
				XTR();
				XTDTXT($GLOBALS{'persontype_name'}.":  ");
				XTD();
				$thischecked = "";	if ($GLOBALS{'person_type'} == $tpersontype) {$thischecked = "checked";}
				XINRADIO ('person_type',$GLOBALS{'persontype_code'},$thischecked,"");
				XTXT($GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualoneofffee'});
				X_TD();
				if (intval($GLOBALS{'persontype_annualstagedfee'} > 0)) {
					XTDTXT("or");
					XTD();
					XTXT(intval($GLOBALS{'persontype_annualstagedrecurringpayments'})." payments of ".$GLOBALS{'countrycurrencysymbol'}.$GLOBALS{'persontype_annualstagedrecurringfee'});
					X_TD();
				} else {
					XTDTXT("");
					XTDTXT("");
				}
				X_TR();
			}
		}
		X_TABLE();
		X_TD();X_TR();
		X_TABLE();
	}
	if (VSF("personmembership")) {
		XH3("Member Information");
		XPTXT($GLOBALS{'domain_personmembershipexperiencetext'});
		XTABLE();
		XTR();XTDTXT("Playing experience - <br>Please provide us with a few details about<br>your previous playing experience.");XTDINTEXTAREA("person_experience",$GLOBALS{'person_experience'},"4","50");X_TR();
		XTR();XTDTXT("Occupation. If student what College or University");XTDINTXT("person_occupation",$GLOBALS{'person_occupation'},"40","80");X_TR();X_TR();
		XTR();XTDTXT("Do you have skills that could help the Club, e.g. Coaching Qualifications, Web-design, Accounting, Planning, Sponsorship. (Please complete separate section on Sports related Qualifications)");XTDINTEXTAREA("person_skills",$GLOBALS{'person_skills'},"4","50");X_TR();
		XTR();XTDTXT("Adult members/ Parents. Would you be interested in being a Coach, Official, Team Manager or Club officer.");XTDINTEXTAREA("person_willingtohelp",$GLOBALS{'person_willingtohelp'},"4","50");X_TR();
		XTR();XTDTXT("");XTDTXT("");X_TR();
		X_TABLE();
	}
	if (VSF("personmedical")) {
		XH3("Medical Details");
		XPTXT($GLOBALS{'domain_personmembershipmedicaltext'});
		XTABLE();
		XTR();XTDTXT("Do you suffer from asthma, diabetes, epilepsy, allergies or other medical condition or injury?");XTDINCHECKBOXYESNO ("person_medicalcondition",$GLOBALS{'person_medicalcondition'},"");	X_TR();
		XTR();XTDTXT("As far as you are aware, are you allergic to any drugs? (Please state)");XTDINCHECKBOXYESNO ("person_medicalallergy",$GLOBALS{'person_medicalallergy'},"");	X_TR();
		XTR();XTDTXT("Are you taking any regular medication? If so, for what reason?");XTDINCHECKBOXYESNO ("person_medicalmedication",$GLOBALS{'person_medicalmedication'},""); X_TR();
		XTR();XTDTXT("If Yes to any above, please provide details*");XTD();XINTEXTAREA("person_medicaldetails",$GLOBALS{'person_medicaldetails'},"3","40");
		XTR();XTDTXTID("person_emergencytel_label","Emergency Tel*");XTDINTELID("person_emergencytel","person_emergencytel",$GLOBALS{'person_emergencytel'});X_TR();
		XTR();XTDTXT("Doctor and Surgery Address");XTDINTEXTAREA("person_doctor",$GLOBALS{'person_doctor'},"2","50");X_TR();
		X_TABLE();
	}
	if (VSF("personsafeguarding")) {
		XH3("Parental/Guardian Information - If under 18");
		XPTXT($GLOBALS{'domain_personmembershipminortext'});
		XTABLE();
		XTR();XTDTXT("Parent/Guardian Title");XTDINTXT("person_parenttitle",$GLOBALS{'person_parenttitle'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian First Name*");XTDINTXT("person_parentfname",$GLOBALS{'person_parentfname'},"25","50");X_TR();
		#�XTR();XTDTXT("Parent/Guardian Initials");XTDINTXT("person_parentmidinits",$GLOBALS{'person_parentmidinits'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian Surname*");XTDINTXT("person_parentsname",$GLOBALS{'person_parentsname'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian Email*");XTD();XINTXT("person_email3",$GLOBALS{'person_email3'},"50","70");X_TD();X_TR();
		$GLOBALS{'person_photographyconsent'} = "Yes";
		XTR();XTDTXT("Photography Consent");XTDINCHECKBOXYESNO ("person_photographyconsent",$GLOBALS{'person_photographyconsent'},""); X_TR();
		$GLOBALS{'person_transportconsent'} = "Yes";
		XTR();XTDTXT("Transport Consent");XTDINCHECKBOXYESNO ("person_transportconsent",$GLOBALS{'person_transportconsent'},""); X_TR();
		X_TABLE();
	}
	if (VSF("personethnicity")||VSF("persondisability")) {
		$titletext = "";
		if (VSF("personethnicity")) { $titletext = $titletext."Ethnicity"; }
		if (VSF("personethnicity")&&VSF("persondisability")) { $titletext = $titletext." and "; }
		if (VSF("persondisability")) { $titletext = $titletext."Disability"; }
		XH3($titletext);
		XPTXT($GLOBALS{'domain_personmembershipethnicitytext'});
		XTABLE();
		XTR();XTDHTXT($titletext);XTDHTXT("");X_TR();
		if (VSF("personethnicity")) {
    		$xhash = Get_SelectArrays_Hash ("ethnicity","ethnicity_code","ethnicity_title","ethnicity_seq","","" );
    		$xhash[""] = "?";
    		XTR();XTDTXTID("person_ethnicity_label","Ethnicity*");XTDINSELECTHASH($xhash,"person_ethnicity",$GLOBALS{'person_ethnicity'});X_TR();
		}
		if (VSF("persondisability")) {
        	$xhash = Get_SelectArrays_Hash ("disability","disability_code","disability_title","disability_seq","","" );
        	$xhash[""] = "?";
        	XTR();XTDTXTID("person_disability_label","Any Learning or Physical Disability*");XTDINSELECTHASH($xhash,"person_disability",$GLOBALS{'person_disability'});X_TR();
		}
		X_TABLE();
	}


	if (VSF("dmws")) {
		XH3("User Level");
		XTABLE();
		$listv = "1,2,3,4";
		$listt = "Management,Officer,Administrator,Super User";
		XTR();XTDTXTID("person_userlevel_label","User Level*");XTDINSELECTHASH(Lists2Hash($listv,$listt),"person_userlevel",$GLOBALS{'person_userlevel'});X_TR();
		X_TABLE();
	}

	if ($mode == "REG") {
		XBR();XPTXT($GLOBALS{'domain_personmembershipfinaltext'});
		XTABLE();
		XTR();XTDTXT("I have read the attached agreement and give my consent.");
		XTD();XINCHECKBOXID ("AgreementCheckbox","person_membershiptermsconsent","","","");X_TD();
		X_TR();
		XTR();XTDTXTID("regwarningmessage","");
		XTD();XINSUBMITID("RegFormSubmit","Update");X_TD();
		X_TR();
		X_TABLE();
	}
	if ($mode == "CONFIRM") {
		XBR();
		XTABLE();
		XINHID("person_membershiptermsconsentdate",$GLOBALS{'currentYYYY-MM-DD'});
		XTR();XTDTXTID("confirmwarningmessage","");XTD();XINSUBMITID("ConfirmFormSubmit","Update");X_TD();X_TR();
		X_TABLE();
	}
	X_FORM();
	XBR();XBR();
	XHR();
	XH3("Membership Agreement");
	XPTXT($GLOBALS{'domain_personmembershiptermstext'});
}

function Person_MYPROFILE_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "slim,datepicker,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,formchecker,jqueryconfirm";
}

function Person_MYPROFILE_Output () {
$personid = $GLOBALS{'LOGIN_person_id'};

# # $helplink = "PersonerMaPersonerson_PWR2_Output/person_pwr2_output.html"; Help_Link;
Get_Data('person',$personid);
XH2("My Profile: ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
XFORM("personMYPROFILEin.php","personMYPROFILE");
XINSTDHID();
XINHID("UpdatePersonId",$GLOBALS{'LOGIN_person_id'});
// fieldname1|fieldtype1|labelid1|highlighttype1|highlightid1|mandatory1|editrule1^
$mfparm = "";
$mfparm .= "person_fname|INTXT|person_fname_label|INTXT|person_fname|Yes|^";
$mfparm .= "person_sname|INTXT|person_sname_label|INTXT|person_sname|Yes|^";
$mfparm .= "person_postcode|INTXT|person_postcode_label|INTXT|person_postcode|Yes|^";
if (VSF("personmedical")) {
    $mfparm .= "person_medicalcondition|INRADIO|person_medicalcondition_label|INRADIO|person_medicalcondition|Yes|^";
    $mfparm .= "person_medicalallergy|INRADIO|person_medicalallergy_label|INRADIO|person_medicalallergy|Yes|^";
    $mfparm .= "person_medicalmedication|INRADIO|person_medicalmedication_label|INRADIO|person_medicalmedication|Yes|^";
    $mfparm .= "person_emergencytel|INTEL|person_emergencytel_label|INTEL|person_emergencytel|Yes|^";
    $mfparm .= "person_doctor|INTXT|person_doctor_label|INTXT|person_doctor|Yes|^";
}
if (VSF("personmembership")) {
    $mfparm .= "person_skills|INTXT|person_skills_label|INTXT|person_skills|Yes|^";
    $mfparm .= "person_willingtohelp|INTXT|person_willingtohelp_label|INTXT|person_willingtohelp|Yes|^";
}
if (VSF("personsafeguarding")) {
    $mfparm .= "person_dob|INDATE|person_dob_label|INDATE|person_dob|Yes|^";
}
if (VSF("personethnicity")) {
    $mfparm .= "person_ethnicity|INSELECT|person_ethnicity_label|INSELECT|person_ethnicity|Yes|^";
}
if (VSF("persondisability")) {
    $mfparm .= "person_disability|INSELECT|person_disability_label|INSELECT|person_disability|Yes|";
}

$roles = "";
if ( $GLOBALS{'sfmuserclub'} != "" ) {
    $obits = List2Array($GLOBALS{'sfmuserclub'});
    foreach ($obits as $obit) {
        if (( $obit != "" )&&( $obit != $GLOBALS{'LOGIN_org_id'} )) {
          $roles .= $obit." Club<br>";
        }
    }
}
if ( $GLOBALS{'sfmuserdivision'} != "" ) {
    $obits = List2Array($GLOBALS{'sfmuserdivision'});
    foreach ($obits as $obit) {
        if (( $obit != "" )&&( $obit != $GLOBALS{'LOGIN_org_id'} )) {
          $roles .= $obit." Division<br>";
        }
    }
}
if ( $GLOBALS{'sfmuserleague'} != "" ) {
    $obits = List2Array($GLOBALS{'sfmuserleague'});
    foreach ($obits as $obit) {
        if (( $obit != "" )&&( $obit != $GLOBALS{'LOGIN_org_id'} )) {
            $roles .= $obit." League<br>";
        }
    }
}
if ( $GLOBALS{'sfmusercounty'} != "" ) {
    $obits = List2Array($GLOBALS{'sfmusercounty'});
    foreach ($obits as $obit) {
        if (( $obit != "" )&&( $obit != $GLOBALS{'LOGIN_org_id'} )) {
            $roles .= $obit." County<br>";
        }
    }
}
if ( $GLOBALS{'sfmuserngb'} != "" ) {
    $obits = List2Array($GLOBALS{'sfmuserngb'});
    foreach ($obits as $obit) {
        if (( $obit != "" )&&( $obit != $GLOBALS{'LOGIN_org_id'} )) {
            $roles .= $obit."<br>";
        }
    }
}

XINHID("SubmitId","FormSubmit");
XINHID("WarningMessageId","warningmessage");
if (VSF("personmembership")) { XINHID("EditEnabled","Yes"); }
if (VSF("personmembership")) { XINHID("AgreementEnabled","Yes"); }
else { XINHID("AgreementEnabled","No"); }
XINHID("EditFields",$mfparm);


XH3("Section 1 - Contact Information");
// BROW();
// BCOLTXT("User ID","4");
// BCOL("8");
// XINTXTDISABLED("person_id",$GLOBALS{'person_id'});B_COL();
// B_ROW();
BROW();
BCOLTXT("User ID","4");
BC("XINTXTDISABLED",'"person_id", '.$GLOBALS{"person_id"},"8");
B_ROW();
BROW();
BCOLTXT("User Role(s)","4");
BCOL("8");
// foreach ($roles as $role) {
  XTXT($roles);
//   XBR();
// }
B_COL();
// BC("XTXT",$roles,"8");
// BC("XINTXTDISABLED",'"person_role", '.$roles,"8");
B_ROW();
BROW();
BCOLTXT("User Title","4");
BC("XINTXT",'person_title,'.$GLOBALS{"person_title"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("First Name","4");
BC("XINTXTID",'person_fname,person_fname,'.$GLOBALS{"person_fname"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Surname","4");
BC("XINTXTID",'person_sname,person_sname,'.$GLOBALS{"person_sname"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("House & Street","4");
BC("XINTXTID",'person_addr1,person_addr1,'.$GLOBALS{"person_addr1"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Town / City","4");
BC("XINTXTID",'person_addr2,person_addr2,'.$GLOBALS{"person_addr2"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("State / County","4");
BC("XINTXTID",'person_addr3,person_addr3,'.$GLOBALS{"person_addr3"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Country","4");
BC("XINTXTID",'person_addr4,person_addr4,'.$GLOBALS{"person_addr4"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Post Code","4");
BC("XINTXTID",'person_postcode,person_postcode,'.$GLOBALS{"person_postcode"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Home Telephone","4");
BC("XINTXTID",'person_hometel,person_hometel,'.$GLOBALS{"person_hometel"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Work Telephone","4");
BC("XINTXTID",'person_worktel,person_worktel,'.$GLOBALS{"person_worktel"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Mobile Telephone","4");
BC("XINTXTID",'person_mobiletel,person_mobiletel,'.$GLOBALS{"person_mobiletel"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Email 1","4");
BC("XINTXTID",'person_email1,person_email1,'.$GLOBALS{"person_email1"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Email 2","4");
BC("XINTXTID",'person_email2,person_email2,'.$GLOBALS{"person_email2"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Twitter Username","4");
BC("XINTXTID",'person_twitterusername,person_twitterusername,'.$GLOBALS{"person_twitterusername"}.',25,50',"8");
B_ROW();
BROW();
BCOLTXT("Photo","4");
# 0nameroot 1imagename 2srcpath 3filepath 4reqdimagewidth 5reqimageheight 6prefix1 7prefix2 8showname 9thumbwidth
// XTDINIMAGECROP("person_photo",$GLOBALS{'person_photo'},"GLOBALDOMAINWWWURL/domain_temp","GLOBALDOMAINFILEPATH/personphotos",100,flex,PersonPhoto,$GLOBALS{'person_id'},"No","100");
// CHECK
// =================== Slim Image Cropper Output =======================
BCOL("8");
$imagefieldname = "person_photo";
$imageviewwidth = "100";
$imagename = $GLOBALS{'person_photo'};
$imageuploadto = "PersonPhoto";
$imageuploadid = $personid;
$imageuploadwidth = "200";
$imageuploadheight = "250";
$imageuploadfixedsize = "200x250";
$imagethumbwidth = "100";
XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);
B_COL();
B_ROW();
BROW();
if (VSF("personsafeguarding")) {
  BCOL("4");
    XTXTID("person_dob_label","Date of Birth*<br>dd/mm/yyyy");
  B_COL();
  BCOL("8");
    XINDATEYYYY_MM_DD_AGE("person_dob",$GLOBALS{'person_dob'});
  B_COL();
}
B_ROW();

//
// XTABLE();
// XTR();XTDHTXT("Mandatory Fields  *");XTDHTXT("");X_TR();
// XTR();XTDTXT("User ID");XTD();XINTXTDISABLED("person_id",$GLOBALS{'person_id'});X_TD();X_TR();
// XTR();XTDTXT("Title");XTDINTXT("person_title",$GLOBALS{'person_title'},"25","50");X_TR();
// XTR();XTDTXTID("person_fname_label","First Name*");XTDINTXTID("person_fname","person_fname",$GLOBALS{'person_fname'},"25","50");X_TR();
// # XTR();XTDTXT("Initials");XTDINTXT("person_midinits",$GLOBALS{'person_midinits'},"25","50");X_TR();
// XTR();XTDTXTID("person_sname_label","Surname*");XTDINTXTID("person_sname","person_sname",$GLOBALS{'person_sname'},"25","50");X_TR();
// XTR();XTDTXT("House & Street");XTDINTXT("person_addr1",$GLOBALS{'person_addr1'},"25","50");X_TR();
// XTR();XTDTXT("Town / City");XTDINTXT("person_addr2",$GLOBALS{'person_addr2'},"25","50");X_TR();
// XTR();XTDTXT("State / County");XTDINTXT("person_addr3",$GLOBALS{'person_addr3'},"25","50");X_TR();
// XTR();XTDTXT("Country");XTDINTXT("person_addr4",$GLOBALS{'person_addr4'},"25","50");X_TR();
// XTR();XTDTXTID("person_postcode_label","Post Code*");XTDINTXTID("person_postcode","person_postcode",$GLOBALS{'person_postcode'},"12","12");X_TR();
// XTR();XTDTXT("Home Tel");XTDINTELPH("person_hometel",$GLOBALS{'person_hometel'});X_TR();
// XTR();XTDTXT("Work Tel");XTDINTELPH("person_worktel",$GLOBALS{'person_worktel'});X_TR();
// XTR();XTDTXT("Mobile Tel");XTDINTELPH("person_mobiletel",$GLOBALS{'person_mobiletel'});X_TR();
// // XTR();XTDTXT("Fax");XTDINTEL("person_faxtel",$GLOBALS{'person_faxtel'});X_TR();
// XTR();XTDTXT("Email Address 1");XTD();XINTXT("person_email1",$GLOBALS{'person_email1'},"25","70");
// if (VSF("newsletters")) { XINCHECKBOXYESNO("person_emailbroadcast1",$GLOBALS{'person_emailbroadcast1'},"Used for Newsletters etc"); }
// X_TD();X_TR();
// XTR();XTDTXT("Email Address 2");XTD();XINTXT("person_email2",$GLOBALS{'person_email2'},"25","70");
// if (VSF("newsletters")) { XINCHECKBOXYESNO("person_emailbroadcast2",$GLOBALS{'person_emailbroadcast2'},"Used for Newsletters etc"); }
// X_TD();X_TR();
// XTR();XTDTXT("Twitter User Name");XTDINTXT("person_twitterusername",$GLOBALS{'person_twitterusername'},"25","70");X_TR();
// XTR();XTDTXT("Photo");
// # 0nameroot 1imagename 2srcpath 3filepath 4reqdimagewidth 5reqimageheight 6prefix1 7prefix2 8showname 9thumbwidth
// // XTDINIMAGECROP("person_photo",$GLOBALS{'person_photo'},"GLOBALDOMAINWWWURL/domain_temp","GLOBALDOMAINFILEPATH/personphotos",100,flex,PersonPhoto,$GLOBALS{'person_id'},"No","100");
// // CHECK
// // =================== Slim Image Cropper Output =======================
// $imagefieldname = "person_photo";
// $imageviewwidth = "100";
// $imagename = $GLOBALS{'person_photo'};
// $imageuploadto = "PersonPhoto";
// $imageuploadid = $personid;
// $imageuploadwidth = "200";
// $imageuploadheight = "250";
// $imageuploadfixedsize = "200x250";
// $imagethumbwidth = "100";
// XTD();XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);X_TD();

// X_TR();
// if (VSF("personsafeguarding")) {
//     XTR();XTDTXTID("person_dob_label","Date of Birth*<br>dd/mm/yyyy");XTDINDATEYYYY_MM_DD_AGE("person_dob",$GLOBALS{'person_dob'});X_TR();
// }
// X_TABLE();

if (VSF("personexdirectory")) {
	XH3("Communications and Privacy");
	XTABLE();
	XTR();XTDTXT("Internal Directory Control");
	$exkeylist = "3,2,1,0";
	$exvaluelist = "3 - Show Address Telephone & Email,2 - Show Telephone and Email only,1 - Show Email only,0 - Ex Directory";
	XTDINRADIOHASH (Lists2Hash($exkeylist,$exvaluelist),"person_exdirectory",$GLOBALS{'person_exdirectory'});
	X_TR();
	X_TABLE();
	XBR();
	XTABLE();
	if ($GLOBALS{'person_publicdirectory'} == "") { $GLOBALS{'person_publicdirectory'} = "3"; }
	XTR();XTDTXT("Publicly Visible Information</br>(Only relevant for Club Officers}");
	$exkeylist = "3,2,1,0";
	$exvaluelist = "3 - Show Telephone Mobile & Email,2 - Show Mobile and Email only,1 - Show Email only,0 - Anonymous Email only";
	XTDINRADIOHASH (Lists2Hash($exkeylist,$exvaluelist),"person_publicdirectory",$GLOBALS{'person_publicdirectory'});
	X_TR();
	X_TABLE();
}
if (VSF("personmembership")) {
    XH3("Can You Help Us");
    XTABLE();
    XTR();XTDTXT("Occupation. If student what College or University");XTDINTXT("person_occupation",$GLOBALS{'person_occupation'},"40","80");X_TR();X_TR();
    XTR();XTDTXTID("person_skills_label","Do you have skills that could help the Club, e.g. Coaching Qualifications, Web-design, Accounting, Planning, Sponsorship. (Please complete separate section on Sports related Qualifications)");
    XTD();XINTEXTAREAID("person_skills","person_skills",$GLOBALS{'person_skills'},"4","50");X_TD();X_TR();
    XTR();XTDTXTID("person_willingtohelp_label","Adult members/ Parents. Would you be interested in being a Coach, Official, Team Manager or Club officer.");
    XTD();XINTEXTAREAID("person_willingtohelp","person_willingtohelp",$GLOBALS{'person_willingtohelp'},"4","50");X_TD();X_TR();
    XTR();XTDTXT("");XTDTXT("");X_TR();
    X_TABLE();
    XH3("Player Profile");
    XTABLE();
    XTR();XTDTXT("Preferred playing position.");XTDINTXT("person_position",$GLOBALS{'person_position'},"40","80");X_TR();X_TR();
    XTR();XTDTXT("Playing experience - <br>Please provide us with a few details about<br>your previous playing experience.");XTDINTEXTAREA("person_experience",$GLOBALS{'person_experience'},"4","50");X_TR();
    XTR();XTDTXT("Shirt Number.");XTDTXT($GLOBALS{'person_shirtnumber'});X_TR();X_TR();
    XTR();XTDTXT("");XTDTXT("");X_TR();
    X_TABLE();
}
if (VSF("personmedical")) {
	XH3("Medical Details");
	XPTXT($GLOBALS{'domain_personmembershipmedicaltext'});
	XTABLE();
	XTR();XTDTXTID("person_medicalcondition_label","Do you suffer from asthma, diabetes, epilepsy, allergies or other medical condition or injury?*");
	XTD();XINRADIOHASHHORIZONTAL(List2Hash("No,Yes"),"person_medicalcondition",$GLOBALS{'person_medicalcondition'});X_TD();
	X_TR();
	XTR();XTDTXTID("person_medicalallergy_label","As far as you are aware, are you allergic to any drugs? (Please state)*");
	XTD();XINRADIOHASHHORIZONTAL(List2Hash("No,Yes"),"person_medicalallergy",$GLOBALS{'person_medicalallergy'});X_TD();
	X_TR();
	XTR();XTDTXTID("person_medicalmedication_label","Are you taking any regular medication? If so, for what reason?*");
	XTD();XINRADIOHASHHORIZONTAL(List2Hash("No,Yes"),"person_medicalmedication",$GLOBALS{'person_medicalmedication'});X_TD();
	X_TR();
	XTR();XTDTXT("If Yes to any above, please provide details*");XTD();XINTEXTAREA("person_medicaldetails",$GLOBALS{'person_medicaldetails'},"3","40");
	XTR();XTDTXTID("person_emergencytel_label","Emergency Tel*");XTDINTELID("person_emergencytel","person_emergencytel",$GLOBALS{'person_emergencytel'});X_TR();
	XTR();XTDTXTID("person_doctor_label","Doctor and Surgery Address*");
	XTD();XINTEXTAREAID("person_doctor","person_doctor",$GLOBALS{'person_doctor'},"2","50");X_TD();X_TR();
	X_TABLE();
}
if (VSF("personsafeguarding")) {
	XH3("Parental/Guardian Information - If under 18");
	XPTXT($GLOBALS{'domain_personmembershipminortext'});
	XTABLE();
	XTR();XTDHTXT("If under 18");XTDHTXT("");X_TR();
	XTR();XTDTXT("Parent/Guardian Title");XTDINTXT("person_parenttitle",$GLOBALS{'person_parenttitle'},"25","50");X_TR();
	XTR();XTDTXT("Parent/Guardian First Name");XTDINTXT("person_parentfname",$GLOBALS{'person_parentfname'},"25","50");X_TR();
	#�XTR();XTDTXT("Parent/Guardian Initials");XTDINTXT("person_parentmidinits",$GLOBALS{'person_parentmidinits'},"25","50");X_TR();
	XTR();XTDTXT("Parent/Guardian Surname");XTDINTXT("person_parentsname",$GLOBALS{'person_parentsname'},"25","50");X_TR();
	XTR();XTDTXT("Parent/Guardian Email");XTD();XINTXT("person_email3",$GLOBALS{'person_email3'},"50","70");
	XINCHECKBOXYESNO("person_emailbroadcast3",$GLOBALS{'person_emailbroadcast3'},"Used for Newsletters etc");X_TD();X_TR();
	XTR();XTDHTXT("");XTDHTXT("");X_TR();
	XTR();XTDTXT("Other Parent/Guardian Title");XTDINTXT("person_parent2title",$GLOBALS{'person_parent2title'},"25","50");X_TR();
	XTR();XTDTXT("Other Parent/Guardian First Name");XTDINTXT("person_parent2fname",$GLOBALS{'person_parent2fname'},"25","50");X_TR();
	#�XTR();XTDTXT("Other Parent/Guardian Initials");XTDINTXT("person_parent2midinits",$GLOBALS{'person_parent2midinits'},"25","50");X_TR();
	XTR();XTDTXT("Other Parent/Guardian Surname");XTDINTXT("person_parent2sname",$GLOBALS{'person_parent2sname'},"25","50");X_TR();
	XTR();XTDTXT("Other Parent/Guardian Email");XTD();XINTXT("person_email4",$GLOBALS{'person_email4'},"50","70");
	XINCHECKBOXYESNO("person_emailbroadcast4",$GLOBALS{'person_emailbroadcast4'},"Used for Newsletters etc");X_TD();X_TR();
	XTR();XTDHTXT("");XTDHTXT("");X_TR();
	XTR();XTDTXT("Photography Consent");XTDINCHECKBOXYESNO ("person_photographyconsent",$GLOBALS{'person_photographyconsent'},""); X_TR();
	XTR();XTDTXT("Transport Consent");XTDINCHECKBOXYESNO ("person_transportconsent",$GLOBALS{'person_transportconsent'},""); X_TR();
	XTR();XTDTXT("School/College");XTDINTXT("person_school",$GLOBALS{'person_school'},"50","70"); X_TR();
	XTR();XTDHTXT("");XTDHTXT("");X_TR();
	X_TABLE();
}

if (VSF("personethnicity")||VSF("persondisability")) {
    $titletext = "";
    if (VSF("personethnicity")) { $titletext = $titletext."Ethnicity"; }
    if (VSF("personethnicity")&&VSF("persondisability")) { $titletext = $titletext." and "; }
    if (VSF("persondisability")) { $titletext = $titletext."Disability"; }
    XH3($titletext);
    XPTXT($GLOBALS{'domain_personmembershipethnicitytext'});
    XTABLE();
    XTR();XTDHTXT($titletext);XTDHTXT("");X_TR();
    if (VSF("personethnicity")) {
        $xhash = Get_SelectArrays_Hash ("ethnicity","ethnicity_code","ethnicity_title","ethnicity_seq","","" );
        $xhash[""] = "?";
        XTR();XTDTXTID("person_ethnicity_label","Ethnicity*");XTDINSELECTHASH($xhash,"person_ethnicity",$GLOBALS{'person_ethnicity'});X_TR();
    }
    if (VSF("persondisability")) {
        $xhash = Get_SelectArrays_Hash ("disability","disability_code","disability_title","disability_seq","","" );
        $xhash[""] = "?";
        XTR();XTDTXTID("person_disability_label","Any Learning or Physical Disability*");XTDINSELECTHASH($xhash,"person_disability",$GLOBALS{'person_disability'});X_TR();
    }
    X_TABLE();
}

if (VSF("personmembership")) {
	XBR();
	XPTXT($GLOBALS{'domain_personmembershipfinaltext'});
	XTABLE();
	XTR();XTDTXT("I have re-read the attached membership agreement and give my consent.");
	XTD();XINCHECKBOXID ("AgreementCheckbox","person_membershiptermsconsent","","","");X_TD();
	X_TR();
	XTR();XTDTXTID("warningmessage","");
	XTD();XINSUBMITID("FormSubmit","Update");X_TD();
	X_TR();
	X_TABLE();
	X_FORM();
	XBR();XBR();
	XHR();
	XH3("Membership Agreement");
	XPTXT($GLOBALS{'domain_personmembershiptermstext'});
} else {
	XBR();
	XINSUBMITID("FormSubmit","Update");
}
X_FORM();
SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
}

function VSA($tbits,$tservicefeature) {
    // service feature is implemented
    // sbits personmembership
    if (($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {
        if (($tbits[1] == 'service_'.$tservicefeature)&&($GLOBALS{'serviceenabled_'.$tservicefeature} == "Enabled")) { return true; } else { return false; }
    } else {
        if (($tbits[1] == 'service_'.$tservicefeature)&&($GLOBALS{'service_'.$tservicefeature} != "")) { return true; } else { return false; }
    }
}

function VSF($servicefeaturename) {
    // service feature is implemented
	// eg personmembership
    if (($GLOBALS{'LOGIN_mode_id'} == "2")||($GLOBALS{'LOGIN_mode_id'} == "3")) {
        if ($GLOBALS{'serviceenabled_'.$servicefeaturename} == "Enabled") { return true; } else { return false; }
    } else {
	   if ($GLOBALS{'service_'.$servicefeaturename} != "") { return true; } else { return false; }
    }
}

function VPF($fieldname) {
    // valid person field
    if (strlen(strstr($GLOBALS{"person^FIELDS"},$fieldname))>0) { return true; } else { return false; }
}

function Person_MYPREFERENCES_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,jqdatatablesmin,jqueryconfirm";
}

function Person_MYPREFERENCES_Output() {
    $parm0 = "";
    $parm0 = $parm0."My Preferences|"; # pagetitle
    $parm0 = $parm0."person[fieldvalue=person_id:".$GLOBALS{'LOGIN_person_id'}."]|"; # primetable
    // $parm0 = $parm0."person|"; # primetable
    $parm0 = $parm0."|"; # othertables
    $parm0 = $parm0."person_id|"; # keyfieldname
    $parm0 = $parm0."person_id|"; # sortfieldname
    $parm0 = $parm0."No|"; # pagination
    $parm0 = $parm0."NoAdd"; # enable add-copy
    $parm1 = "";
    $parm1 = $parm1."person_id|Yes|Id|90|Yes|Id|KeyText,5,15^";
    $parm1 = $parm1."person_fname|Yes|FirstName|150|Yes|FirstName|Text^";
    $parm1 = $parm1."person_sname|Yes|SurName|150|Yes|SurName|Text^";
    $parm1 = $parm1."person_navigationpref|Yes|Navigation Alignment|60|Yes|Navigation Alignment|InputSelectFromList,Right+Left^";
    $parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton";
    GenericHandler_Output ($parm0,$parm1);
}


function Person_DELETESEARCH_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Person_DELETESEARCH_Output () {
	XH3("Person Delete");
	$helplink = "Person/Person_DELETE_Output/person_lu_output.html"; Help_Link;
	XTXT("You are authorised to delete information in the following Sections and Groups:-");XBR();
	foreach (Person_SectionVisibility_Array("change") as $tsection_name) {
		XTXT("- $tsection_name Section ");XBR();
	}
	foreach (Person_SectionGroupVisibility_Array("change") as $tsectiongroup_name) {
		XTXT("- $tsectiongroup_name Group ");XBR();
	}
	XBR();
	XTXT("Enter names (or part names) and press search");XBR();
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXTID("person_fname_presearch","person_fname_presearch","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXTID("person_sname_presearch","person_sname_presearch","","20","30");X_TR();
	X_TABLE();
	XINBUTTONID("Search","Search");
	$GLOBALS{'PersonSelectPopupParameters'} = array(
			 "person_id|person_sname|person_fname|person_email1|person_section|person_sectiongroup",
			 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_email1,Email,200|person_section,Section,90|person_sectiongroup,Group,90",
			 "program,Search,Delete,personDELETEin.php,,70",
			 "person_id",
			 "all",
			 "delete,center,center,500,200",
			 "change",
			 "multiprogramlinks"
	);
	# $parm0 = Fields to download - person_id|persons_fname|person_sname|person_email
	# $parm1 = Fields to show in list - person_sname,SurName,70|persons_fname,FirstName,90|person_id,Id,90|person_email,Email,90
	# $parm2 = Buttons Id � To,To..,ToDistList,ToPersonList,70|Cc,CC..,CcDistList,CcPersonList,70 or View,View..,personLUin.php,,70
	# $parm3 = Output Field Name - e.g person_id or person_email
	# $parm4 = Buttons to show on output - "all" or "active"
	# $parm5 = New Window positioning name/topx|topy|width|height
	# $parm6 = view/change - e.g authority to handle data returned
}

function Person_CHANGESEARCH_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Person_CHANGESEARCH_Output () {
	XH3("Update Person Details");
	$helplink = "Person/Person_CHANGE_Output/person_lu_output.html"; Help_Link;
	XTXT("You are authorised to update information in the following Sections and Groups:-");XBR();
	foreach (Person_SectionVisibility_Array("change") as $tsection_name) {
		XTXT("- $tsection_name Section ");XBR();
	}
	foreach (Person_SectionGroupVisibility_Array("change") as $tsectiongroup_name) {
		XTXT("- $tsectiongroup_name Group ");XBR();
	}
	XBR();
	XTXT("Enter names (or part names) and press search");XBR();
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXTID("person_fname_presearch","person_fname_presearch","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXTID("person_sname_presearch","person_sname_presearch","","20","30");X_TR();
	X_TABLE();
	XINBUTTONID("Search","Search");
	$GLOBALS{'PersonSelectPopupParameters'} = array(
			 "person_id|person_sname|person_fname|person_email1|person_section|person_sectiongroup",
			 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_email1,Email,200|person_section,Section,90|person_sectiongroup,Group,90",
			 "program,Search,Update,personCHANGEpopupout.php,,70",
			 "person_id",
			 "all",
			 "search,center,center,800,600",
			 "change",
			 "multiprogramlinks"
	);
}

function Person_CHANGE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Person_CHANGE_Output ($personid) {
	# # $helplink = "PersonerMaPersonerson_PWR2_Output/person_pwr2_output.html"; Help_Link;
	Get_Data('person',$personid);
	XH2("Update Person Profile - ".$personid." - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
	XFORM("personCHANGEin.php","personCHANGE");
	XINSTDHID();
	XINHID("ActionPersonId",$personid);
	XH3("Member Contact Information");
	XTABLE();
	XTR();XTDHTXT("Information");XTDHTXT("Value");X_TR();
	XTR();XTDTXT("Title");XTDINTXT("person_title",$GLOBALS{'person_title'},"25","50");X_TR();
	XTR();XTDTXT("First Name");XTDINTXT("person_fname",$GLOBALS{'person_fname'},"25","50");X_TR();
	# XTR();XTDTXT("Initials");XTDINTXT("person_midinits",$GLOBALS{'person_midinits'},"25","50");X_TR();
	XTR();XTDTXT("Surname");XTDINTXT("person_sname",$GLOBALS{'person_sname'},"25","50");X_TR();
	XTR();XTDTXT("House & Street");XTDINTXT("person_addr1",$GLOBALS{'person_addr1'},"25","50");X_TR();
	XTR();XTDTXT("Town / City");XTDINTXT("person_addr2",$GLOBALS{'person_addr2'},"25","50");X_TR();
	XTR();XTDTXT("State / County");XTDINTXT("person_addr3",$GLOBALS{'person_addr3'},"25","50");X_TR();
	XTR();XTDTXT("Country");XTDINTXT("person_addr4",$GLOBALS{'person_addr4'},"25","50");X_TR();
	XTR();XTDTXT("Post Code");XTDINTXT("person_postcode",$GLOBALS{'person_postcode'},"12","12");X_TR();
	XTR();XTDTXT("Home Tel");XTDINTEL("person_hometel",$GLOBALS{'person_hometel'});X_TR();
	XTR();XTDTXT("Work Tel");XTDINTEL("person_worktel",$GLOBALS{'person_worktel'});X_TR();
	XTR();XTDTXT("Mobile Tel");XTDINTEL("person_mobiletel",$GLOBALS{'person_mobiletel'});X_TR();
	// XTR();XTDTXT("Fax");XTDINTEL("person_faxtel",$GLOBALS{'person_faxtel'});X_TR();
	XTR();XTDTXT("Email Address 1");XTD();XINTXT("person_email1",$GLOBALS{'person_email1'},"50","70");
	if (VSF("newsletters")) { XINCHECKBOXYESNO("person_emailbroadcast1",$GLOBALS{'person_emailbroadcast1'},"Used for Newsletters etc");}
	X_TD();X_TR();
	XTR();XTDTXT("Email Address 2");XTD();XINTXT("person_email2",$GLOBALS{'person_email2'},"50","70");
	if (VSF("newsletters")) { XINCHECKBOXYESNO("person_emailbroadcast2",$GLOBALS{'person_emailbroadcast2'},"Used for Newsletters etc");}
	X_TD();X_TR();
	XTR();XTDTXT("Twitter User Name");XTDINTXT("person_twitterusername",$GLOBALS{'person_twitterusername'},"50","70");X_TR();
	XTR();XTDTXT("Photo");
	# 0nameroot 1imagename 2srcpath 3filepath 4reqdimagewidth 5reqimageheight 6prefix1 7prefix2 8showname 9thumbwidth
	// XTDINIMAGECROP("person_photo",$GLOBALS{'person_photo'},"GLOBALDOMAINWWWURL/domain_temp","GLOBALDOMAINFILEPATH/personphotos",100,flex,PersonPhoto,$GLOBALS{'person_id'},"No","100");

	// CHECK
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "person_photo";
	$imageviewwidth = "100";
	$imagename = $GLOBALS{'person_photo'};
	$imageuploadto = "PersonPhoto";
	$imageuploadid = $personid;
	$imageuploadwidth = "200";
	$imageuploadheight = "250";
	$imageuploadfixedsize = "200x250";
	$imagethumbwidth = "100";
	XTD();XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);X_TD();

	X_TR();
	if (VSF("personsafeguarding")) { XTR();XTDTXT("Date of Birth");XTDINDATEYYYY_MM_DD_AGE("person_dob",$GLOBALS{'person_dob'});X_TR(); }
	X_TABLE();

	if (VSF("personmembership")) {
		XH3("Membership Information");
		XTABLE();
		XTR();XTDHTXT("Membership");XTDHTXT("");X_TR();
		XTR();XTDTXT("Section");XTD();
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XINCHECKBOXHASH($xhash,"person_section",$GLOBALS{'person_section'});
		X_TD();X_TR();
		XTR();XTDTXT("Membership Type");XTD();
		# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
		$xhash = Get_SelectArrays_Hash ("persontype",$GLOBALS{'currperiodid'},"persontype_code","persontype_name","persontype_code","","" );
		XINSELECTHASH($xhash,"person_type",$GLOBALS{'person_type'});
		X_TD();X_TR();
		XTR();XTDTXT("Group");XTD();
		$xhash = Get_SelectArrays_Hash ("sectiongroup",$GLOBALS{'currperiodid'},"sectiongroup_code","sectiongroup_name","sectiongroup_seq","","" );
		XINCHECKBOXHASH($xhash,"person_sectiongroup",$GLOBALS{'person_sectiongroup'});
		X_TD();X_TR();
		X_TABLE();
	}
	if (VSF("personexdirectory")) {
		XH3("Communications & Privacy");
		XTABLE();
		XTR();XTDTXT("Internal Directory Control");
		$exkeylist = "3,2,1,0";
		$exvaluelist = "3 - Show Address Telephone & Email,2 - Show Telephone and Email only,1 - Show Email only,0 - Ex Directory";
		XTDINRADIOHASH (Lists2Hash($exkeylist,$exvaluelist),"person_exdirectory",$GLOBALS{'person_exdirectory'});
		X_TR();
		X_TABLE();
		XBR();
		XTABLE();
		if ($GLOBALS{'person_publicdirectory'} == "") {$GLOBALS{'person_publicdirectory'} = "3";}
		XTR();XTDTXT("Publicly Visible Information</br>(Only relevant for Club Officers}");
		$exkeylist = "3,2,1,0";
		$exvaluelist = "3 - Show Telephone Mobile & Email,2 - Show Mobile and Email only,1 - Show Email only,0 - Anonymous Email only";
		XTDINRADIOHASH (Lists2Hash($exkeylist,$exvaluelist),"person_publicdirectory",$GLOBALS{'person_publicdirectory'});
		X_TR();
		X_TABLE();
	}
	if (VSF("personmembership")) {
		XH3("Can You Help Us");
		XTABLE();
		XTR();XTDTXT("Occupation. If student what College or University");XTDINTXT("person_occupation",$GLOBALS{'person_occupation'},"40","80");X_TR();X_TR();
		XTR();XTDTXT("Do you have skills that could help the Club, e.g. Coaching Qualifications, Web-design, Accounting, Planning, Sponsorship. (Please complete separate section on Sports related Qualifications)");XTDINTEXTAREA("person_skills",$GLOBALS{'person_skills'},"4","50");X_TR();
		XTR();XTDTXT("Adult members/ Parents. Would you be interested in being a Coach, Official, Team Manager or Club officer.");XTDINTEXTAREA("person_willingtohelp",$GLOBALS{'person_willingtohelp'},"4","50");X_TR();
		XTR();XTDTXT("");XTDTXT("");X_TR();
		X_TABLE();
		XH3("Player Profile");
		XTABLE();
		XTR();XTDTXT("Preferred playing position.");XTDINTXT("person_position",$GLOBALS{'person_position'},"40","80");X_TR();X_TR();
		XTR();XTDTXT("Playing experience - <br>Please provide us with a few details about<br>your previous playing experience.");XTDINTEXTAREA("person_experience",$GLOBALS{'person_experience'},"4","50");X_TR();
		XTR();XTDTXT("Shirt Number.");XTDTXT($GLOBALS{'person_shirtnumber'});X_TR();X_TR();
		XTR();XTDTXT("");XTDTXT("");X_TR();
		X_TABLE();
	}
	if (VSF("personmedical")) {
		XH3("Medical Details");
		XTABLE();
		XTR();XTDTXT("Do you suffer from asthma, diabetes, epilepsy, allergies or other medical condition or injury?");XTDINCHECKBOXYESNO ("person_medicalcondition",$GLOBALS{'person_medicalcondition'},"");	X_TR();
		XTR();XTDTXT("As far as you are aware, are you allergic to any drugs? (Please state)");XTDINCHECKBOXYESNO ("person_medicalallergy",$GLOBALS{'person_medicalallergy'},"");	X_TR();
		XTR();XTDTXT("Are you taking any regular medication? If so, for what reason?");XTDINCHECKBOXYESNO ("person_medicalmedication",$GLOBALS{'person_medicalmedication'},""); X_TR();
		XTR();XTDTXT("If Yes to any above, please provide details*");XTD();XINTEXTAREA("person_medicaldetails",$GLOBALS{'person_medicaldetails'},"3","40");
		XTR();XTDTXT("Emergency Tel*");XTDINTEL("person_emergencytel",$GLOBALS{'person_emergencytel'});X_TR();
		XTR();XTDTXT("Doctor and Surgery Address");XTDINTEXTAREA("person_doctor",$GLOBALS{'person_doctor'},"2","50");X_TR();
		X_TABLE();
	}
	if (VSF("personsafeguarding")) {
		XH3("Parental/Guardian Information - If under 18");
		XTABLE();
		XTR();XTDTXT("Parent/Guardian Title");XTDINTXT("person_parenttitle",$GLOBALS{'person_parenttitle'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian First Name");XTDINTXT("person_parentfname",$GLOBALS{'person_parentfname'},"25","50");X_TR();
		#�XTR();XTDTXT("Parent/Guardian Initials");XTDINTXT("person_parentmidinits",$GLOBALS{'person_parentmidinits'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian Surname");XTDINTXT("person_parentsname",$GLOBALS{'person_parentsname'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian Email");XTD();XINTXT("person_email3",$GLOBALS{'person_email3'},"50","70");
		XINCHECKBOXYESNO("person_emailbroadcast3",$GLOBALS{'person_emailbroadcast3'},"Used for Newsletters etc");X_TD();X_TR();
		XTR();XTDHTXT("");XTDHTXT("");X_TR();
		XTR();XTDTXT("Other Parent/Guardian Title");XTDINTXT("person_parent2title",$GLOBALS{'person_parent2title'},"25","50");X_TR();
		XTR();XTDTXT("Other Parent/Guardian First Name");XTDINTXT("person_parent2fname",$GLOBALS{'person_parent2fname'},"25","50");X_TR();
		#�XTR();XTDTXT("Other Parent/Guardian Initials");XTDINTXT("person_parent2midinits",$GLOBALS{'person_parent2midinits'},"25","50");X_TR();
		XTR();XTDTXT("Other Parent/Guardian Surname");XTDINTXT("person_parent2sname",$GLOBALS{'person_parent2sname'},"25","50");X_TR();
		XTR();XTDTXT("Other Parent/Guardian Email");XTD();XINTXT("person_email4",$GLOBALS{'person_email4'},"50","70");
		XINCHECKBOXYESNO("person_emailbroadcast4",$GLOBALS{'person_emailbroadcast4'},"Used for Newsletters etc");X_TD();X_TR();
		XTR();XTDHTXT("");XTDHTXT("");X_TR();
		XTR();XTDTXT("Photography Consent");XTDINCHECKBOXYESNO ("person_photographyconsent",$GLOBALS{'person_photographyconsent'},""); X_TR();
		XTR();XTDTXT("Transport Consent");XTDINCHECKBOXYESNO ("person_transportconsent",$GLOBALS{'person_transportconsent'},""); X_TR();
		X_TABLE();
	}
	if (VSF("personethnicity")||VSF("persondisability")) {
	    $titletext = "";
	    if (VSF("personethnicity")) { $titletext = $titletext."Ethnicity"; }
	    if (VSF("personethnicity")&&VSF("persondisability")) { $titletext = $titletext." and "; }
	    if (VSF("persondisability")) { $titletext = $titletext."Disability"; }
	    XH3($titletext);
	    XPTXT($GLOBALS{'domain_personmembershipethnicitytext'});
	    XTABLE();
	    XTR();XTDHTXT($titletext);XTDHTXT("");X_TR();
	    if (VSF("personethnicity")) {
	        $xhash = Get_SelectArrays_Hash ("ethnicity","ethnicity_code","ethnicity_title","ethnicity_seq","","" );
	        $xhash[""] = "?";
	        XTR();XTDTXTID("person_ethnicity_label","Ethnicity*");XTDINSELECTHASH($xhash,"person_ethnicity",$GLOBALS{'person_ethnicity'});X_TR();
	    }
	    if (VSF("persondisability")) {
	        $xhash = Get_SelectArrays_Hash ("disability","disability_code","disability_title","disability_seq","","" );
	        $xhash[""] = "?";
	        XTR();XTDTXTID("person_disability_label","Any Learning or Physical Disability*");XTDINSELECTHASH($xhash,"person_disability",$GLOBALS{'person_disability'});X_TR();
	    }
	    X_TABLE();
	}
	if (array_key_exists("personuserlevel^FIELDS",$GLOBALS)) {
	    XH3("User Level");
	    XTABLE();
	    $xhash = Get_SelectArrays_Hash ("personuserlevel","personuserlevel_code","personuserlevel_description","personuserlevel_code","","" );
	    XTR();XTDTXT("User Level");XTDINSELECTHASH($xhash,"person_userlevel",$GLOBALS{'person_userlevel'});X_TR();
	    X_TABLE();
	}

	XH3("");
	XTABLE();
	XTR();XTDTXT("Complete update");XTDINSUBMIT("Update");X_TR();
	X_TABLE();
	X_FORM();

	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
}

function person_PlayOffUpdate_Output ($personid) {

	# # $helplink = "PersonerMaPersonerson_PWR2_Output/person_pwr2_output.html"; Help_Link;
	Get_Data('person',$personid);
	XH2("Update Player/Official Profile - ".$personid." - ".$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});
	XFORM("personplayoffupdatein.php","personplayoffupdate");
	XINSTDHID();
	XINHID("ActionPersonId",$personid);
	XH3("Player / Official status");
	XTABLE();
	XTR();XTDTXT("Active Player?");XTDINCHECKBOXYESNO ("person_activeplayer",$GLOBALS{'person_activeplayer'},"");	X_TR();
	XTR();XTDTXT("Active Umpire?");XTDINCHECKBOXYESNO ("person_activeofficial",$GLOBALS{'person_activeofficial'},"");	X_TR();
	X_TABLE();
	XH3("Membership Information");
	XTABLE();
	XTR();XTDHTXT("Membership");XTDHTXT("");X_TR();
	XTR();XTDTXT("Section");XTD();
	$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
	XINCHECKBOXHASH($xhash,"person_section",$GLOBALS{'person_section'});
	X_TD();X_TR();
	XTR();XTDTXT("Membership Type");XTD();
	# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
	$xhash = Get_SelectArrays_Hash ("persontype",$GLOBALS{'currperiodid'},"persontype_code","persontype_name","persontype_code","","" );
	XINSELECTHASH($xhash,"person_type",$GLOBALS{'person_type'});
	X_TD();X_TR();
	X_TABLE();
	XH3("");
	XTABLE();
	XTR();XTDTXT("Complete update");XTDINSUBMIT("Update");X_TR();
		X_TABLE();
	X_FORM();

}

function Person_ADD1_Output ($window) {
	XH3("Add a New Member");
	$helplink = "Person/Person_ADD_Output/person_lu_output.html"; Help_Link;
	XPTXT("You are authorised to add information in the following Sections and Groups:-");XBR();
	foreach (Person_SectionVisibility_Array("change") as $tsection_name) {
		XTXT("- $tsection_name Section ");XBR();
	}
	foreach (Person_SectionGroupVisibility_Array("change") as $tsectiongroup_name) {
		XTXT("- $tsectiongroup_name Group ");XBR();
	}
	XBR();
	XTXT("Enter name and press Add");XBR();
	XFORM("personADD1in.php","personADD");
	XINSTDHID();
	XINHID("Window",$window);
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXT("PersonFName","","25","25");X_TR();
	XTR();XTDTXT("Surname");XTDINTXT("PersonSName","","25","40");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Add");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_ADD2_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "slim,datepicker,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD,slimjquerymin,slimimagepopup,jqueryconfirm";
}

function Person_ADD2_Output ($window,$person_id,$person_fname,$person_sname,$errormode) {
	XH3("Add Person - ".$person_id." - ".$person_fname." ".$person_sname);
	# # $helplink = "PersonerMaPersonerson_PWR2_Output/person_pwr2_output.html"; Help_Link;
	if ( $errormode != "errormode") { Initialise_Data('person'); }
	XFORM("personADD2in.php","personNew");
	XINSTDHID();
	XINHID("Window",$window);
	XINHID("ActionPersonId",$person_id);
	XTABLE();
	XTR();XTDHTXT("Information".$GLOBALS{"person_photo"});XTDHTXT("Value");X_TR();
	XTR();XTDTXT("Title");XTDINTXT("person_title",$GLOBALS{'person_title'},"25","50");X_TR();
	XTR();XTDTXT("First Name");XTDINTXT("person_fname",$person_fname,"25","50");X_TR();
	# XTR();XTDTXT("Initials");XTDINTXT("person_midinits",$GLOBALS{'person_midinits'},"25","50");X_TR();
	XTR();XTDTXT("Surname");XTDINTXT("person_sname",$person_sname,"25","50");X_TR();
	XTR();XTDTXT("House & Street");XTDINTXT("person_addr1",$GLOBALS{'person_addr1'},"25","50");X_TR();
	XTR();XTDTXT("Town / City");XTDINTXT("person_addr2",$GLOBALS{'person_addr2'},"25","50");X_TR();
	XTR();XTDTXT("State / County");XTDINTXT("person_addr3",$GLOBALS{'person_addr3'},"25","50");X_TR();
	XTR();XTDTXT("Country");XTDINTXT("person_addr4",$GLOBALS{'person_addr4'},"25","50");X_TR();
	XTR();XTDTXT("Post Code");XTDINTXT("person_postcode",$GLOBALS{'person_postcode'},"12","12");X_TR();
	XTR();XTDTXT("Home Tel");XTDINTEL("person_hometel",$GLOBALS{'person_hometel'});X_TR();
	XTR();XTDTXT("Work Tel");XTDINTEL("person_worktel",$GLOBALS{'person_worktel'});X_TR();
	XTR();XTDTXT("Mobile Tel");XTDINTEL("person_mobiletel",$GLOBALS{'person_mobiletel'});X_TR();
	// XTR();XTDTXT("Fax");XTDINTEL("person_faxtel",$GLOBALS{'person_faxtel'});X_TR();
	XTR();XTDTXT("Email Address 1");XTD();XINTXT("person_email1",$GLOBALS{'person_email1'},"50","70");
	if (VSF("newsletters")) { XINCHECKBOXYESNO("person_emailbroadcast1",$GLOBALS{'person_emailbroadcast1'},"Used for Newsletters etc"); }
	X_TD();X_TR();
	XTR();XTDTXT("Email Address 2");XTD();XINTXT("person_email2",$GLOBALS{'person_email2'},"50","70");
	if (VSF("newsletters")) { XINCHECKBOXYESNO("person_emailbroadcast2",$GLOBALS{'person_emailbroadcast2'},"Used for Newsletters etc"); }
	X_TD();X_TR();
	XTR();XTDTXT("Twitter User Name");XTDINTXT("person_twitterusername",$GLOBALS{'person_twitterusername'},"50","70");X_TR();
	XTR();XTDTXT("Photo");
	# 0nameroot 1imagename 2srcpath 3filepath 4reqdimagewidth 5reqimageheight 6prefix1 7prefix2 8showname 9thumbwidth
	// XTDINIMAGECROP("person_photo",$GLOBALS{'person_photo'},"GLOBALDOMAINWWWURL/domain_temp","GLOBALDOMAINFILEPATH/personphotos",100,flex,PersonPhoto,$GLOBALS{'person_id'},"No","100");
	// CHECK
	// =================== Slim Image Cropper Output =======================
	$imagefieldname = "person_photo";
	$imageviewwidth = "100";
	$imagename = $GLOBALS{'person_photo'};
	$imageuploadto = "PersonPhoto";
	$imageuploadid = $person_id;
	$imageuploadwidth = "200";
	$imageuploadheight = "250";
	$imageuploadfixedsize = "200x250";
	$imagethumbwidth = "100";
	XTD();XINIMAGECROPPER($imagefieldname, $imageviewwidth, $imagename, $imageuploadto);X_TD();
	X_TR();
	if (VSF("personsafeguarding")) { XTR();XTDTXT("Date of Birth");XTDINDATEYYYY_MM_DD_AGE("person_dob",$GLOBALS{'person_dob'});X_TR(); }
	X_TABLE();

	if (VSF("personmembership")) {
		XH3("Membership Information");
		XTABLE();
		XTR();XTDTXT("Section");XTD();
		$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
		XINCHECKBOXHASH($xhash,"person_section",$GLOBALS{'person_section'});
		X_TD();X_TR();
		XTR();XTDTXT("Membership");XTD();
		# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
		$xhash = Get_SelectArrays_Hash ("persontype",$GLOBALS{'currperiodid'},"persontype_code","persontype_name","persontype_code","","" );
		XINSELECTHASH($xhash,"person_type",$GLOBALS{'person_type'});
		X_TD();X_TR();
		XTR();XTDTXT("Group");XTD();
		$xhash = Get_SelectArrays_Hash ("sectiongroup",$GLOBALS{'currperiodid'},"sectiongroup_code","sectiongroup_name","sectiongroup_seq","","" );
		XINCHECKBOXHASH($xhash,"person_sectiongroup",$GLOBALS{'person_sectiongroup'});
		X_TD();X_TR();
		X_TABLE();
	}
	if (VSF("personexdirectory")) {
		XH3("Communications & Privacy");
		XTABLE();
		XTR();XTDTXT("Internal Directory Control");
		$exkeylist = "3,2,1,0";
		$exvaluelist = "3 - Show Address Telephone & Email,2 - Show Telephone and Email only,1 - Show Email only,0 - Ex Directory";
		XTDINRADIOHASH (Lists2Hash($exkeylist,$exvaluelist),"person_exdirectory","3");
		X_TR();
		X_TABLE();
		XBR();
		XTABLE();
		XTR();XTDTXT("Publicly Visible Information</br>(Only relevant for Club Officers}");
		$exkeylist = "3,2,1,0";
		$exvaluelist = "3 - Show Telephone Mobile & Email,2 - Show Mobile and Email only,1 - Show Email only,0 - Anonymous Email only";
		XTDINRADIOHASH (Lists2Hash($exkeylist,$exvaluelist),"person_publicdirectory","3");
		X_TR();
		X_TABLE();
	}
	if (VSF("personmembership")) {
	    XH3("Can You Help Us");
	    XTABLE();
	    XTR();XTDTXT("Occupation. If student what College or University");XTDINTXT("person_occupation",$GLOBALS{'person_occupation'},"40","80");X_TR();X_TR();
	    XTR();XTDTXT("Do you have skills that could help the Club, e.g. Coaching Qualifications, Web-design, Accounting, Planning, Sponsorship. (Please complete separate section on Sports related Qualifications)");XTDINTEXTAREA("person_skills",$GLOBALS{'person_skills'},"4","50");X_TR();
	    XTR();XTDTXT("Adult members/ Parents. Would you be interested in being a Coach, Official, Team Manager or Club officer.");XTDINTEXTAREA("person_willingtohelp",$GLOBALS{'person_willingtohelp'},"4","50");X_TR();
	    XTR();XTDTXT("");XTDTXT("");X_TR();
	    X_TABLE();
	    XH3("Player Profile");
	    XTABLE();
	    XTR();XTDTXT("Preferred playing position.");XTDINTXT("person_position",$GLOBALS{'person_position'},"40","80");X_TR();X_TR();
	    XTR();XTDTXT("Playing experience - <br>Please provide us with a few details about<br>your previous playing experience.");XTDINTEXTAREA("person_experience",$GLOBALS{'person_experience'},"4","50");X_TR();
	    XTR();XTDTXT("Shirt Number.");XTDTXT($GLOBALS{'person_shirtnumber'});X_TR();X_TR();
	    XTR();XTDTXT("");XTDTXT("");X_TR();
	    X_TABLE();
	}
	if (VSF("personmedical")) {
		XH3("Medical Details");
		XTABLE();
		XTR();XTDTXT("Do you suffer from asthma, diabetes, epilepsy, allergies or other medical condition or injury?");XTDINCHECKBOXYESNO ("person_medicalcondition",$GLOBALS{'person_medicalcondition'},"");	X_TR();
		XTR();XTDTXT("As far as you are aware, are you allergic to any drugs? (Please state)");XTDINCHECKBOXYESNO ("person_medicalallergy",$GLOBALS{'person_medicalallergy'},"");	X_TR();
		XTR();XTDTXT("Are you taking any regular medication? If so, for what reason?");XTDINCHECKBOXYESNO ("person_medicalmedication",$GLOBALS{'person_medicalmedication'},""); X_TR();
		XTR();XTDTXT("If Yes to any above, please provide details*");XTD();XINTEXTAREA("person_medicaldetails",$GLOBALS{'person_medicaldetails'},"3","40");
		XTR();XTDTXT("Emergency Tel*");XTDINTEL("person_emergencytel",$GLOBALS{'person_emergencytel'});X_TR();
		XTR();XTDTXT("Doctor and Surgery Address");XTDINTEXTAREA("person_doctor",$GLOBALS{'person_doctor'},"2","50");X_TR();
		X_TABLE();
	}
	if (VSF("personsafeguarding")) {
		XH3("Parental/Guardian Information - If under 18");
		XTABLE();
		XTR();XTDTXT("Parent/Guardian Title");XTDINTXT("person_parenttitle",$GLOBALS{'person_parenttitle'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian First Name");XTDINTXT("person_parentfname",$GLOBALS{'person_parentfname'},"25","50");X_TR();
		#�XTR();XTDTXT("Parent/Guardian Initials");XTDINTXT("person_parentmidinits",$GLOBALS{'person_parentmidinits'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian Surname");XTDINTXT("person_parentsname",$GLOBALS{'person_parentsname'},"25","50");X_TR();
		XTR();XTDTXT("Parent/Guardian Email");XTD();XINTXT("person_email3",$GLOBALS{'person_email3'},"50","70");
		XINCHECKBOXYESNO("person_emailbroadcast3",$GLOBALS{'person_emailbroadcast3'},"Used for Newsletters etc");X_TD();X_TR();
		XTR();XTDHTXT("");XTDHTXT("");X_TR();
		XTR();XTDTXT("Other Parent/Guardian Title");XTDINTXT("person_parent2title",$GLOBALS{'person_parent2title'},"25","50");X_TR();
		XTR();XTDTXT("Other Parent/Guardian First Name");XTDINTXT("person_parent2fname",$GLOBALS{'person_parent2fname'},"25","50");X_TR();
		#�XTR();XTDTXT("Other Parent/Guardian Initials");XTDINTXT("person_parent2midinits",$GLOBALS{'person_parent2midinits'},"25","50");X_TR();
		XTR();XTDTXT("Other Parent/Guardian Surname");XTDINTXT("person_parent2sname",$GLOBALS{'person_parent2sname'},"25","50");X_TR();
		XTR();XTDTXT("Other Parent/Guardian Email");XTD();XINTXT("person_email4",$GLOBALS{'person_email4'},"50","70");
		XINCHECKBOXYESNO("person_emailbroadcast4",$GLOBALS{'person_emailbroadcast4'},"Used for Newsletters etc");X_TD();X_TR();
		XTR();XTDHTXT("");XTDHTXT("");X_TR();
		$GLOBALS{'person_photographyconsent'} = "Yes";
		XTR();XTDTXT("Photography Consent");XTDINCHECKBOXYESNO ("person_photographyconsent",$GLOBALS{'person_photographyconsent'},""); X_TR();
		$GLOBALS{'person_transportconsent'} = "Yes";
		XTR();XTDTXT("Transport Consent");XTDINCHECKBOXYESNO ("person_transportconsent",$GLOBALS{'person_transportconsent'},""); X_TR();
		X_TABLE();
	}
	if (VSF("personethnicity")||VSF("persondisability")) {
	    $titletext = "";
	    if (VSF("personethnicity")) { $titletext = $titletext."Ethnicity"; }
	    if (VSF("personethnicity")&&VSF("persondisability")) { $titletext = $titletext." and "; }
	    if (VSF("persondisability")) { $titletext = $titletext."Disability"; }
	    XH3($titletext);
	    XPTXT($GLOBALS{'domain_personmembershipethnicitytext'});
	    XTABLE();
	    XTR();XTDHTXT($titletext);XTDHTXT("");X_TR();
	    if (VSF("personethnicity")) {
	        $xhash = Get_SelectArrays_Hash ("ethnicity","ethnicity_code","ethnicity_title","ethnicity_seq","","" );
	        $xhash[""] = "?";
	        XTR();XTDTXTID("person_ethnicity_label","Ethnicity*");XTDINSELECTHASH($xhash,"person_ethnicity",$GLOBALS{'person_ethnicity'});X_TR();
	    }
	    if (VSF("persondisability")) {
	        $xhash = Get_SelectArrays_Hash ("disability","disability_code","disability_title","disability_seq","","" );
	        $xhash[""] = "?";
	        XTR();XTDTXTID("person_disability_label","Any Learning or Physical Disability*");XTDINSELECTHASH($xhash,"person_disability",$GLOBALS{'person_disability'});X_TR();
	    }
	    X_TABLE();
	}

	if (array_key_exists("personuserlevel^FIELDS",$GLOBALS)) {
	    XH3("User Level");
	    XTABLE();
	    $xhash = Get_SelectArrays_Hash ("personuserlevel","personuserlevel_code","personuserlevel_description","personuserlevel_code","","" );
	    XTR();XTDTXT("User Level");XTDINSELECTHASH($xhash,"person_userlevel",$GLOBALS{'person_userlevel'});X_TR();
	    X_TABLE();
	}

        if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"sfm"))>0) {
            XH3("SFM Roles");
	    XTABLE();
            XTR();
            XTDHTXT("");
            XTDHTXT("Organisation");
            XTDHTXT("Admin");
            XTDHTXT("Other<br>Admin");
            XTDHTXT("Read<br>Only");
            XTDHTXT("Ground Grading <br>Inspector");
            XTDHTXT("Floodlight<br>Inspector");

            XTR();XTDTXT("Club");
            $xhash = Get_SelectArrays_Hash ("sfmclub","sfmclub_id","sfmclub_name","sfmclub_id","","" );
            XTDINSELECTHASH($xhash,"sfmclub_id","");
            XTDINCHECKBOXYESNO("sfmclub_adminpersonid", "No", "");
            XTDINCHECKBOXYESNO("sfmclub_otheradminpersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmclub_otherreadonlypersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmclub_groundinspectoridlist", "No", "");
            XTDINCHECKBOXYESNO("sfmclub_floodinspectoridlist", "No", "");
            X_TR();
            XTR();XTDTXT("Division");
            $xhash = Get_SelectArrays_Hash ("sfmdivision","sfmdivision_id","sfmdivision_name","sfmdivision_id","","" );
            XTDINSELECTHASH($xhash,"sfmdivision_id","");
            XTDINCHECKBOXYESNO("sfmdivision_adminpersonid", "No", "");
            XTDINCHECKBOXYESNO("sfmdivision_otheradminpersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmdivision_otherreadonlypersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmdivision_groundinspectoridlist", "No", "");
            XTDINCHECKBOXYESNO("sfmdivision_floodinspectoridlist", "No", "");
            XTR();XTDTXT("League");
            $xhash = Get_SelectArrays_Hash ("sfmleague","sfmleague_id","sfmleague_name","sfmleague_id","","" );
            XTDINSELECTHASH($xhash,"sfmleague_id","");
            XTDINCHECKBOXYESNO("sfmleague_adminpersonid", "No", "");
            XTDINCHECKBOXYESNO("sfmleague_otheradminpersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmleague_otherreadonlypersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmleague_groundinspectoridlist", "No", "");
            XTDINCHECKBOXYESNO("sfmleague_floodinspectoridlist", "No", "");
            XTR();XTDTXT("County");
            $xhash = Get_SelectArrays_Hash ("sfmcounty","sfmcounty_id","sfmcounty_name","sfmcounty_id","","" );
            XTDINSELECTHASH($xhash,"sfmcounty_id","");
            XTDINCHECKBOXYESNO("sfmcounty_adminpersonid", "No", "");
            XTDINCHECKBOXYESNO("sfmcounty_otheradminpersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmcounty_otherreadonlypersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmcounty_groundinspectoridlist", "No", "");
            XTDINCHECKBOXYESNO("sfmcounty_floodinspectoridlist", "No", "");
            XTR();XTDTXT("NGB");
            $xhash = Get_SelectArrays_Hash ("sfmngb","sfmngb_id","sfmngb_name","sfmngb_id","","" );
            XTDINSELECTHASH($xhash,"sfmngb_id","");
            XTDINCHECKBOXYESNO("sfmngb_adminpersonid", "No", "");
            XTDINCHECKBOXYESNO("sfmngb_otheradminpersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmngb_otherreadonlypersonidlist", "No", "");
            XTDINCHECKBOXYESNO("sfmngb_groundinspectoridlist", "No", "");
            XTDINCHECKBOXYESNO("sfmngb_floodinspectoridlist", "No", "");
            X_TABLE();
        }

	XH3("");
        XINCHECKBOXYESNO("IssueEmail", "Yes", "Send an email to the new person");
        XH3("");
	XTABLE();
	XTR();XTDTXT("Complete add");XTDINSUBMIT("Add New Member");X_TR();
	X_TABLE();
	X_FORM();
	SlimImageCropper_Popup($imagefieldname, $imageviewwidth, $imagename, $imageuploadto, $imageuploadid,
	$imageuploadwidth, $imageuploadheight, $imageuploadfixedsize, $imagethumbwidth);
}

function Person_ADDUPLOAD_Output() {
	XH3("Person Data Upload");
	XFORMUPLOAD("personADDuploadin.php","upload");
	XINSTDHID();
	XPTXT("It is recommended that this is first done in <B>Test</B> mode. When any errors have been corrected perform the final update using <B>Real</B> mode.");
	XPTXT("File Containing Data:-");
	XINFILE("file","10000000") ;XBR();XBR();
	XINRADIO("TestorReal","T","checked","");XTXT("Test Mode - file will be verified but no updates made<BR>");
	XINRADIO("TestorReal","R","","");XTXT("Real Mode - updates will be made<BR>");
	XBR();
	XINSUBMIT("Upload!");
	X_FORM();
}

function Person_ADDTOGROUPSEARCH_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	// $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	// $GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";

	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,globalroutines,ioroutines,personselectionpopup,viewaspopup,jqdatatablesmin";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Person_ADDTOGROUPSEARCH_Output ($tsectiongroup) {
	XH3("Assign person to My Group - ".$tsectiongroup);
	$helplink = "Person/Person_CHANGE_Output/person_lu_output.html"; Help_Link;
	XTXT("You are authorised to update information in the following Sections and Groups:-");XBR();
	foreach (Person_SectionVisibility_Array("change") as $tsection_name) {
		XTXT("- $tsection_name Section ");XBR();
	}
	foreach (Person_SectionGroupVisibility_Array("change") as $tsectiongroup_name) {
		XTXT("- $tsectiongroup_name Group ");XBR();
	}
	XBR();
	XTXT("Enter names (or part names) and press search");XBR();
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXTID("person_fname_presearch","person_fname_presearch","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXTID("person_sname_presearch","person_sname_presearch","","20","30");X_TR();
	X_TABLE();
	XINBUTTONID("Search","Search");
	$GLOBALS{'PersonSelectPopupParameters'} = array(
			 "person_id|person_sname|person_fname|person_section|person_sectiongroup",
			 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_section,Section,90|person_sectiongroup,Group,90",
			 "program,Search,AssignToMyGroup,personADDTOGROUPin.php,,110",
			 "person_id,".$tsectiongroup,
			 "all",
			 "search,center,center,1000,600",
			 "change",
			 "multiprogramlinks"
	);
}


function XINCHECKBOXARRAYMATCH($checkboxidname,$allvaluesarray,$thesevaluesarray,$datatype,$datadescriptionfield) {
 foreach ($allvaluesarray as $allvalue) {
  $thisvaluechecked = "";
  foreach ($thesevaluesarray as $thisvalue) {
   if ($thisvalue == $allvalue) {$thisvaluechecked = "checked";}
  }
  # checkboxid/name, value, checked, text
  Get_Data_Hash($datatype,$allvalue);
  $allvaluedescription = $GLOBALS{$datadescriptionfield};
  XINCHECKBOX ($checkboxidname,$allvalue,$thisvaluechecked,$allvaluedescription);XBR();
 }
}

function Person_Visibility_Test ($viewchange) {
# assume that person globals are "target" person
$selectedperson = "0";
#�XH4($GLOBALS{'person_authority'});
if ($GLOBALS{'person_section'} != "") {
	 $tperson_sections = explode(',', $GLOBALS{'person_section'});
	 foreach ($tperson_sections as $tperson_section) {
	 	Get_Data_Hash("section",$GLOBALS{'currperiodid'},$tperson_section);
	 	if ($GLOBALS{'IOWARNING'} == "0") {
	  		if ($viewchange == "view") {
			   if ($GLOBALS{'section_exdir'} == "0") {  # section ex-dir to all
			      if (strlen(strstr($GLOBALS{'askingperson_section'},$tperson_section.","))>0) {
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMgr="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCaptain="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCoach="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMM="))>0) { $selectedperson = "1"; }
			      }
			   }
			   if ($GLOBALS{'section_exdir'} == "1") { # section ex-dir to other sections
			     if (strlen(strstr($GLOBALS{'askingperson_section'},$tperson_section.","))>0) { $selectedperson = "1"; }
			   }
			   if ($GLOBALS{'section_exdir'} == "2") { # section open to all
			     $selectedperson = "1";
			   }
	  		}
	 		if ($viewchange == "change") {
			   if ($GLOBALS{'section_exdir'} == "0") {  # section ex-dir to all
			      if (strlen(strstr($GLOBALS{'askingperson_section'},$tperson_section.","))>0) {
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMgr="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCaptain="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamCoach="))>0) { $selectedperson = "1"; }
			   		if (strlen(strstr($GLOBALS{'person_authority'},"MM#TeamMM="))>0) { $selectedperson = "1"; }
			      }
			   }
			   if ($GLOBALS{'section_exdir'} == "1") { # section ex-dir to other sections
			     if (strlen(strstr($GLOBALS{'askingperson_section'},$tperson_section.","))>0) { $selectedperson = "1"; }
			   }
			   if ($GLOBALS{'section_exdir'} == "2") { # section open to all
			     $selectedperson = "1";
			   }
	  		}
	    }
	    if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader=".$tperson_section."#,"))>0) { $selectedperson = "1"; }
	    if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM=".$tperson_section."#,"))>0) { $selectedperson = "1"; }
	 }

	 $tperson_sectiongroups = explode(',', $GLOBALS{'person_sectiongroup'});
	 foreach ($tperson_sectiongroups as $tperson_sectiongroup) {
		  if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr=".$tperson_sectiongroup."#,"))>0) { $selectedperson = "1"; }
		  if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach=".$tperson_sectiongroup."#,"))>0) { $selectedperson = "1"; }
		  if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM=".$tperson_sectiongroup."#,"))>0) { $selectedperson = "1"; }
	 }
	 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $selectedperson = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain#,"))>0) { $selectedperson = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"NM#Domain#,"))>0) { $selectedperson = "1"; }

	 $archivesectionfound = "0"; $nonarchivesectionfound = "0";
	 foreach ($tperson_sections as $tperson_section) {
	 	Get_Data_Hash("section",$GLOBALS{'currperiodid'},$tperson_section);
	 	if ($GLOBALS{'IOWARNING'} == "0") {
 			if ($GLOBALS{'section_archive'} == "Yes") { $archivesectionfound = "1"; }
			else { 	$nonarchivesectionfound = "1"; }
	    }
	 }
	 if (($archivesectionfound == "1")&&($nonarchivesectionfound == "0")) { $selectedperson = "0"; }
} else {
	 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $selectedperson = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain#,"))>0) { $selectedperson = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"NM#Domain#,"))>0) { $selectedperson = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $selectedperson = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) { $selectedperson = "1"; }
}
if ($GLOBALS{'site_clientservermode'} == "Client") { $selectedperson = "1"; }
if ($selectedperson == "1") {return true;} else {return false;}
}

function Person_Redaction_Filter () {
$l0 = "0"; $l1 = "0"; $l2 = "0"; $l3 = "0";
if ($GLOBALS{'person_exdirectory'} == "0") { $l0 = "1"; $l1 = "0"; $l2 = "0"; $l3 = "0"; }
if ($GLOBALS{'person_exdirectory'} == "1") { $l0 = "0"; $l1 = "1"; $l2 = "0"; $l3 = "0"; }
if ($GLOBALS{'person_exdirectory'} == "2") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "0"; }
if ($GLOBALS{'person_exdirectory'} == "3") { $l0 = "0"; $l1 = "1"; $l2 = "1"; $l3 = "1"; }
$searchstring = 'RM#SectionMM='.$GLOBALS{'askingperson_section'};
if (strlen(strstr($GLOBALS{'person_authority'},$searchstring))>0) { $l1 = "1"; $l2 = "1"; $l3 = "0"; }
if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain"))>0) { $l1 = "1"; $l2 = "1"; $l3 = "0"; }
if (strlen(strstr($GLOBALS{'person_authority'},"NM#Domain"))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
$searchstring = 'MM#SectionLeader='.$GLOBALS{'askingperson_section'};
if (strlen(strstr($GLOBALS{'person_authority'},$searchstring))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
$searchstring = 'MM#SectionMM='.$GLOBALS{'askingperson_section'};
if (strlen(strstr($GLOBALS{'person_authority'},$searchstring))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }

if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain"))>0) { $l1 = "1"; $l2 = "1"; $l3 = "1"; }
if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain"))>0) { $l1 = "1"; $l2 = "1"; $l3 = "0"; }
if ($l0 == "1") {
 $GLOBALS{'person_email1'} = "..........";
 $GLOBALS{'person_email2'} = "..........";
 $GLOBALS{'person_twitterusername'} = "..........";
 # $GLOBALS{'person_facebookusername'} = "..........";
 $GLOBALS{'person_hometel'} = "..........";
 $GLOBALS{'person_worktel'} = "..........";
 $GLOBALS{'person_mobiletel'} = "..........";
 $GLOBALS{'person_faxtel'} = "..........";
 $GLOBALS{'person_addr1'} = "..........";
 $GLOBALS{'person_addr2'} = "..........";
 $GLOBALS{'person_addr3'} = "..........";
 $GLOBALS{'person_addr4'} = "..........";
 $GLOBALS{'person_postcode'} = "..........";
}
if ($l1 == "1") {
 $GLOBALS{'person_hometel'} = "..........";
 $GLOBALS{'person_worktel'} = "..........";
 $GLOBALS{'person_mobiletel'} = "..........";
 $GLOBALS{'person_faxtel'} = "..........";
 $GLOBALS{'person_addr1'} = "..........";
 $GLOBALS{'person_addr2'} = "..........";
 $GLOBALS{'person_addr3'} = "..........";
 $GLOBALS{'person_addr4'} = "..........";
 $GLOBALS{'person_postcode'} = "..........";
}
if ($l2 == "1") {
 $GLOBALS{'person_addr1'} = "..........";
 $GLOBALS{'person_addr2'} = "..........";
 $GLOBALS{'person_addr3'} = "..........";
 $GLOBALS{'person_addr4'} = "..........";
 $GLOBALS{'person_postcode'} = "..........";
}
if ($l3 == "1") {

}
}

function Person_SectionVisibility_Array($viewchange) {
$selectedsectiona = array();
foreach (Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","") as $tsection_name) {
	$selectedsection = "0";
	Get_Data_Hash("section",$GLOBALS{'currperiodid'},$tsection_name);
	 if ($viewchange == "view") {
		 if ($GLOBALS{'section_exdir'} == "0") { # section ex-dir to all

		 }
		 if ($GLOBALS{'section_exdir'} == "1") { # section ex-dir to other sections
		 	XH2($GLOBALS{'askingperson_section'}." vs ".$tsection_name);
		  	if (strlen(strstr($GLOBALS{'askingperson_section'},$tsection_name.","))>0) { $selectedsection = "1"; }
		 }
		 if ($GLOBALS{'section_exdir'} == "2") { # section open to all
		   $selectedsection = "1";
		 }
	 }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader=".$tsection_name."#,"))>0) { $selectedsection = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM=".$tsection_name."#,"))>0) { $selectedsection = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $selectedsection = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain#,"))>0) { $selectedsection = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"NM#Domain#,"))>0) { $selectedsection = "1"; }
     if ($GLOBALS{'section_archive'} == "Yes") { $selectedsection = "0"; } # exclude exmembers
	 if ($selectedsection == "1") { array_push($selectedsectiona, $tsection_name); }
}
return $selectedsectiona;
}

function Person_TeamVisibility_Array($viewchange) {
$selectedteama = array();
foreach (Get_Array_Hash_SortSelect("team",$GLOBALS{'currperiodid'},"team_seq","","") as $tteam_code) {
	$selectedteam = "0";
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamRM=".$tteam_code."#"))>0) { $selectedteam = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCaptain=".$tteam_code."#"))>0) { $selectedteam = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamMgr=".$tteam_code."#"))>0) { $selectedteam = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#TeamCoach=".$tteam_code."#"))>0) { $selectedteam = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionRM="))>0) { $selectedteam = "1"; } #�CHECK - TO LOOSE
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#SectionLeader="))>0) { $selectedteam = "1"; }  #�CHECK - TO LOOSE
	 if (strlen(strstr($GLOBALS{'person_authority'},"RM#Domain#"))>0) { $selectedteam = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain#"))>0) { $selectedteam = "1"; }
	 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#"))>0) { $selectedteam = "1"; }

	 if ($selectedteam == "1") { array_push($selectedteama, $tteam_code); }
}
return $selectedteama;
}

function Person_TeamSquadMember_Array($person_id,$who) {
	$selectedteama = array();
	foreach (Get_Array_Hash_SortSelect("team",$GLOBALS{'currperiodid'},"team_seq","","") as $tteam_code) {
		Get_Data('team',$GLOBALS{'currperiodid'},$tteam_code);
		if ( FoundInCommaList($person_id,$GLOBALS{'team_squadlist'})) {
			array_push($selectedteama, $tteam_code);
		}
		if ($who == "all") {
			$selectedteam = "0";
			if (FoundInCommaList( $person_id,$GLOBALS{'team_captain'})) { $selectedteam = "1"; }
			if (FoundInCommaList( $person_id,$GLOBALS{'team_mgr'})) {	$selectedteam = "1"; }
			if (FoundInCommaList( $person_id,$GLOBALS{'team_coach'})) { $selectedteam = "1"; }
			if (FoundInCommaList( $person_id,$GLOBALS{'team_helpers'})) { $selectedteam = "1"; }
			if ($selectedteam == "1") {
				array_push($selectedteama, $tteam_code);
			}
		}
	}
	return array_unique($selectedteama);
}

function Person_SectionGroupVisibility_Array($viewchange) {
	$selectedsectiongroupa = array();
	foreach (Get_Array_Hash_SortSelect("sectiongroup",$GLOBALS{'currperiodid'},"sectiongroup_name","","") as $tsectiongroup_code) {
		 $selectedsectiongroup = "0";
		 if (strlen(strstr($GLOBALS{'person_authority'},"DM#Domain#,"))>0) { $selectedsectiongroup = "1"; }
		 if (strlen(strstr($GLOBALS{'person_authority'},"MM#Domain#,"))>0) { $selectedsectiongroup = "1"; }
		 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionLeader="))>0) { $selectedsectiongroup = "1"; }
		 if (strlen(strstr($GLOBALS{'person_authority'},"MM#SectionMM="))>0) { $selectedsectiongroup = "1"; }
		 if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMgr=".$tsectiongroup_code."#,"))>0) { $selectedsectiongroup = "1"; }
		 if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupCoach=".$tsectiongroup_code."#,"))>0) { $selectedsectiongroup = "1"; }
		 if (strlen(strstr($GLOBALS{'person_authority'},"MM#GroupMM=".$tsectiongroup_code."#,"))>0) { $selectedsectiongroup = "1"; }
		 if ($selectedsectiongroup == "1") { array_push($selectedsectiongroupa, $tsectiongroup_code);}
	}
	return $selectedsectiongroupa;
}

function Person_SectionGroupMember_Array($person_id,$who) {
	Get_Data('person',$person_id);
	$selectedsectiongroupa = List2Array($GLOBALS{'person_sectiongroup'});
	if ($who == "all") {
		foreach (Get_Array_Hash_SortSelect("sectiongroup",$GLOBALS{'currperiodid'},"sectiongroup_name","","") as $tsectiongroup_code) {
			Get_Data('sectiongroup',$GLOBALS{'currperiodid'},$tsectiongroup_code);
			$selectedsectiongroup = "0";
			if (FoundInCommaList( $person_id,$GLOBALS{'sectiongroup_mgr'})) { $selectedsectiongroup = "1"; }
			if (FoundInCommaList( $person_id,$GLOBALS{'sectiongroup_coach'})) {	$selectedsectiongroup = "1"; }
			if (FoundInCommaList( $person_id,$GLOBALS{'sectiongroup_personmgrs'})) { $selectedsectiongroup = "1"; }
			if (FoundInCommaList( $person_id,$GLOBALS{'sectiongroup_helpers'})) { $selectedsectiongroup = "1"; }
			if ($selectedsectiongroup == "1") {
				array_push($selectedsectiongroupa, $tsectiongroup_code);
			}
		}
	}
	return array_unique($selectedsectiongroupa);
}

function Person_NEWEMAIL_Output () {
	Initialise_Data("person");
	$helplink = "PersonMaster_Person_REG_Output/person_reg_output.html"; Help_Link();
	XFORM("personNEWEMAILin.php","personNEWEMAIL");
	XINSTDHID();
	XINHID("ActionType","NEWEMAIL");
	$GLOBALS{'action_type'} = "NEWEMAIL";
	XH3("Registration of a new email address");
	XTXT("Please provide us with your new email address and some additional identifying information.");
	XTXT("Once authenticated by the membership secretary, you will be notified by email.");
	XBR();XBR();

	XTABLE();
	XTR();XTDTXT("Title");XTDINTXT("person_title","","25","50");X_TR();
	XTR();XTDTXT("First Name");XTDINTXT("person_fname","","25","50");X_TR();
	# XTR();XTDTXT("Initials");XTDINTXT("person_midinits","","25","50");X_TR();
	XTR();XTDTXT("Surname");XTDINTXT("person_sname","","25","50");X_TR();
	XTR();XTDTXT("New Email Address");XTD();XINTXT("person_email1","","50","70");
	XTR();XTDHTXT("");XTDHTXT("");X_TR();
	XTR();XTDTXT("House & Street");XTDINTXT("person_addr1","","25","50");X_TR();
	XTR();XTDTXT("Town / City");XTDINTXT("person_addr2","","25","50");X_TR();
	XTR();XTDTXT("State / County");XTDINTXT("person_addr3","","25","50");X_TR();
	XTR();XTDTXT("Country");XTDINTXT("person_addr4","","25","50");X_TR();
	XTR();XTDTXT("Post Code");XTDINTXT("person_postcode","","12","12");X_TR();
	XTR();XTDTXT("Home Tel");XTDINTEL("person_hometel","");X_TR();
	XTR();XTDTXT("Work Tel");XTDINTEL("person_worktel","");X_TR();
	XTR();XTDTXT("Mobile Tel");XTDINTEL("person_mobiletel","");X_TR();
	XTR();XTDTXT("Section");XTD();
	$xhash = Get_SelectArrays_Hash ("section",$GLOBALS{'currperiodid'},"section_name","section_name","section_seq","","" );
	XINCHECKBOXHASH($xhash,"person_section",$GLOBALS{'person_section'});
	X_TD();X_TR();

	XTR();XTDTXT("");XTDINSUBMIT("Update");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_SEARCH_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Person_SEARCH_Output ($personid) {
	XH3("Person Search");
	XPTXTCOLOR("Enter names (or part names) and press search","Navy");
	XTABLE();
	XTR();XTDTXT("First Name");XTDINTXTID("person_fname_presearch","person_fname_presearch","","20","30");X_TR();
	XTR();XTDTXT("Surname");XTDINTXTID("person_sname_presearch","person_sname_presearch","","20","30");X_TR();
	X_TABLE();
	XBR();XINBUTTONID("Search","Search");
	if ($GLOBALS{'LOGIN_canvas_id'} == "M") {
	    // ========= Mobile -================
	    $GLOBALS{'PersonSelectPopupParameters'} = array(
	        "person_id|person_sname|person_fname",
	        "person_sname,SurName,70|person_fname,FirstName,70",
	        "program,Search,View,personLUin.php,,90",
	        "person_id",
	        "all",
	        "search,center,center,400,400",
	        "view",
	        "multiprogramlinks"
	    );
	} else {
	    // ========= Desktop or tablet -================
    	$GLOBALS{'PersonSelectPopupParameters'} = array(
			 "person_id|person_sname|person_fname|person_email1|person_section|person_sectiongroup",
			 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,45|person_email1,Email,200|person_section,Section,90|person_sectiongroup,Group,90",
			 "program,Search,View_More..,personLUin.php,,90",
			 "person_id",
			 "all",
			 "search,center,center,400,400",
			 "view",
			 "multiprogramlinks"
    	);
	}

	XBR();XBR();XBR();
	XPTXT("Note: If you can't find the person it may be that you do not have authority to access that information");
	XPTXT("You are authorised to view information in the following Sections and Groups:-");XBR();
	foreach (Person_SectionVisibility_Array("view") as $tsection_name) {
		XTXT("- $tsection_name Section ");XBR();
	}
	foreach (Person_SectionGroupVisibility_Array("view") as $tsectiongroup_name) {
		XTXT("- $tsectiongroup_name Group ");XBR();
	}
}



function Person_SE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,personselectionpopup";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup";
}

function Person_SE_Output () {
	XH2("SMS or EMail other people");
	$helplink = "Person/Person_SE_Output/person_se_output.html"; Help_Link;
	Get_Person_Authority();
	$SMSauthority = "0";
	if (strlen(strstr($GLOBALS{'person_authority'},'DM'))>0) { $SMSauthority = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},'RM'))>0) { $SMSauthority = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},'WM'))>0) { $SMSauthority = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},'SM'))>0) { $SMSauthority = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},'BM'))>0) { $SMSauthority = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},'MM'))>0) { $SMSauthority = "1"; }
	if (strlen(strstr($GLOBALS{'person_authority'},'NM'))>0) { $SMSauthority = "1"; }

	XFORM("personSEin.php","emailsms");
	XINSTDHID();
	XBR();

	XHR();
	XH2("Step1: Select Distribution");
	XTABLE();
	XTR();XTDTXT("To; Distribution List - comma separated");
	XTD();XINBUTTONID("To","To..");XBR();XTXT("<small>View</br>Names</small>");X_TD();
	XTD();XINTEXTAREAID("ToDistList","ToDistList","","2","70");XBR();XTXTID("ToPersonList","");X_TD();X_TR();
	XTR();XTDTXT("Cc: Distribution List - comma separated");
	XTD();XINBUTTONID("Cc","Cc..");XBR();XTXT("<small>View</br>Names</small>");X_TD();
	XTD();XINTEXTAREAID("CcDistList","CcDistList","","2","70");XBR();XTXTID("CcPersonList","");X_TD();X_TR();
	XTR();XTDTXT("Bcc: Distribution List - comma separated");
	XTD();XINBUTTONID("Bcc","Bcc..");XBR();XTXT("<small>View</br>Names</small>");X_TD();
	XTD();XINTEXTAREAID("BccDistList","BccDistList","","2","70");XBR();XTXTID("BccPersonList","");X_TD();X_TR();
	X_TABLE();
	XBR();
	XHR();
	XH2("Step 2 : Compose Messages");
	if ( $SMSauthority == "1" ) {
		XPTXT("Enter either an SMS Text Message or an Email Message - or Both");
		XH3("SMS Message");
		XTABLE();XTR();
		XTDTXTWIDTH("Max 160 Characters","100");
		XTDINTEXTAREA("SMSMessage","","2","80");
		X_TR();X_TABLE();
	} else {
		XPTXT("Sorry - You do not have authority to send Text Messages");
	}
	XH3("Email Message");
	XTABLE();XTR();
	XTDTXTWIDTH("Subject","100");XTDINTXT("EmailSubject","","100","80");
	X_TR();XTR();
	XTDTXTWIDTH("Message","100");XTDINTEXTAREA("EmailMessage","","10","80");
	X_TR();X_TABLE();

	XBR();XBR();
	XINCHECKBOXYESNO("Test","No","Test Mode - Allows Email/SMS messages to be checked before sending");XBR();
	XBR();XBR();
	XINSUBMIT("Send out Emails/SMSs");
	X_FORM();

	$GLOBALS{'PersonSelectPopupParameters'} = array(
		 "person_id|person_sname|person_fname|person_email|person_section",
		 "person_sname,SurName,70|person_fname,FirstName,70|person_id,Id,40|person_email,Email,150|person_section,Section,60",
		 "field,To,To..,ToDistList,ToPersonList,40|field,Cc,Cc..,CcDistList,CcPersonList,40|field,Bcc,Bcc..,BccDistList,BccPersonList,45",
		 "person_id",
		 "all",
		 "search,50,50,200,200",
		 "view",
		 "buildfulllist"
	);
	# $parm0 = Fields to download - person_id|persons_fname|person_sname|person_email
	# $parm1 = Fields to show in list - person_sname,SurName,70|persons_fname,FirstName,90|person_id,Id,90|person_email,Email,90
	# $parm2 = Buttons Id � To,To..,ToDistList,ToPersonList,70|Cc,CC..,CcDistList,CcPersonList,70 or View,View..,personLUin.php,,70
	# $parm3 = Output Field Name - e.g person_id or person_email
	# $parm4 = Buttons to show on output - "all" or "active"
	# $parm5 = New Window positioning name/topx|topy|width|height
	# $parm6 = view/change - e.g authority to handle data returned
    # $parm7 = buildfulllist/singleaddtolist/singlereplacelist/multiprogramlinks - build a list of results/close after each selection/keepopen after each selection
}

function Person_SEroleEmail_Output ($sendtorole,$sendtoid) {
	XH3("EMail");
	$helplink = "Person/Person_SErole_Output/person_serole_output.html"; Help_Link;

        $dicea = Array("321","534","512","808","199","243");

	XFORM("personSErolein.php","email");
	XINSTDHID();
	XINHID("SendToRole",$sendtorole);
	XINHID("SendToId",$sendtoid);
        $verificationmastercode = (rand (1,6).rand (1,6).rand (1,6).rand (1,6));
        $vmc = XCrypt($verificationmastercode,"Dice","encrypt");
        XINHID("VerificationMasterCode",$vmc);
	XTABLE();
	XTR();XTDTXT("To");XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}." - ".$sendtorole);X_TR();
	XTR();XTDTXT("Subject");XTDINTXT("Subject","","70","100");X_TR();
	XTR();XTDTXT("Message");XTDINTEXTAREA("SendMessage","","10","60");X_TR();
	XTR();XTDTXT("My Name");XTDINTXT("FromName","","70","100");X_TR();
	XTR();XTDTXT("My eMail address");XTDINTXT("FromEmail","","70","100");X_TR();
        XTR();XTDTXT("Enter dice numbers to verify<br>that you are not a computer.");

        XTD();
        XTABLEINVISIBLE();
        XTR();
        XTDC();XIMGWIDTH($GLOBALS{'site_wwwpath'}.'/site_assets/'.$dicea[$verificationmastercode[0]-1].".png","50");X_TD();
        XTDC();XIMGWIDTH($GLOBALS{'site_wwwpath'}.'/site_assets/'.$dicea[$verificationmastercode[1]-1].".png","50");X_TD();
        XTDC();XIMGWIDTH($GLOBALS{'site_wwwpath'}.'/site_assets/'.$dicea[$verificationmastercode[2]-1].".png","50");X_TD();
        XTDC();XIMGWIDTH($GLOBALS{'site_wwwpath'}.'/site_assets/'.$dicea[$verificationmastercode[3]-1].".png","50");X_TD();
        X_TR();
        XTR();
        XTDC();XINTXT("VC0","","1","1");X_TD();
        XTDC();XINTXT("VC1","","1","1");X_TD();
        XTDC();XINTXT("VC2","","1","1");X_TD();
        XTDC();XINTXT("VC3","","1","1");X_TD();
        X_TR();
        X_TABLE();
        X_TD();
        X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_LIST_Output ($limode) {
	XH3("Person List Download");
	$helplink = "Person/Person_LI_Output/person_li_output.html"; Help_Link;
	XTXT("You are authorised to view information in the following Sections and Groups:-");XBR();
	foreach (Person_SectionVisibility_Array("view") as $tsection_name) {
		XTXT("- $tsection_name Section ");XBR();
	}
	foreach (Person_SectionGroupVisibility_Array("view") as $tsectiongroup_name) {
		XTXT("- $tsectiongroup_name Group ");XBR();
	}
	XBR();
	XFORM("personlistin.php","distlist");
	XINSTDHID();
	XINHID("LIMode",$limode);
	XTABLE();
	$separator = "------------------------";
	$bigseparator = "========================================================";
	XTR();XTDHTXT("Step 1 : Select section");X_TR();
	XTR();XTD();
	foreach (Person_SectionVisibility_Array("view") as $section_name) {
		XTXT(".....");XINCHECKBOX("MicroSECTION$section_name","$section_name","","All $Q$section_name$Q section members");XBR();
	}
	X_TD();X_TR();
	if ($limode != "Advanced") {
		XTR();XTD();
		$link = YPGMLINK("personlistout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("LIMode","Advanced");
		XTXT(".....");XLINKTXT($link,"Show advanced selection options");
	} else {
		XTR();XTDHTXT("Step 1a : Advanced Selection Options");X_TR();
		$link = YPGMLINK("personlistout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("LIMode","Basic");
		XTR();XTD();
		XTXT(".....");XLINKTXT($link,"Return to basic selection options");XBR();
		XTXT("$separator By Person Type $separator<BR>");
		foreach (Get_Array_Hash_SortSelect('persontype',$GLOBALS{'currperiodid'},'persontype_seq',"","") as $persontype_code) {
			Get_Data("persontype",$GLOBALS{'currperiodid'},$persontype_code);
			XTXT(".....");XINCHECKBOX("MicroPERSONTYPE$persontype_code","$persontype_code","",$GLOBALS{'persontype_name'});XBR();
		}
		if ( $GLOBALS{'service_frs'} != "" ) {
			XTXT("$separator By Active Person Types $separator<BR>");
			XTXT(".....");XINCHECKBOX("MicroACTIVEplayer","player","","Active Players<BR>");
			XTXT(".....");XINCHECKBOX("MicroACTIVEofficial","official","","Active Officials");XBR();
		}
		$showanyway = "0";
		if ((strlen(strstr($GLOBALS{'person_authority'},'MM'))>0)||
		 	(strlen(strstr($GLOBALS{'person_authority'},'DM'))>0)||
		  	(strlen(strstr($GLOBALS{'person_authority'},'NM'))>0)) {
		  $showanyway = "1";
		}
		for ($imexd = 0; $imexd < 10; $imexd++) {
			Get_Data_Hash("personextradef",$imexd);
			$person_extra_seq = "person_extra".$imexd;
			if ($GLOBALS{$person_extra_seq} != "") {
				$authtag = ""; if (($GLOBALS{'$personextradef_self'} != "Yes")&&($showanyway == "1")) {
					$authtag = "*";
				}
				if (($GLOBALS{'$personextradef_self'} == "Yes")||($showanyway == "1")) {
					if ($GLOBALS{'$personextradef_syntax'} == "Checkbox") {
						XTXT("$separator $GLOBALS{'$personextradef_name'}$authtag $separator<BR>");
						XTXT(".....");XINCHECKBOXTD("MicroEXTRA$imexd","Yes","","$GLOBALS{'$personextradef_name'}$authtag");XBR();
					}
					if ($GLOBALS{'$personextradef_syntax'} == "SelectFromList") {
						XTXT("$separator $GLOBALS{'$personextradef_name'}$authtag $separator<BR>");
						$codevaluearray = explode(',', $GLOBALS{'$personextradef_codevalues'});
						foreach ($codevaluearray as $codevalue) {
							XTXT(".....");XINCHECKBOXTD("MicroEXTRA$imexd$codevalue","$codevalue","","$codevalue$authtag");XBR();
						}
					}
				}
			}
		}
	}
	X_TD();X_TR();
	XTR();XTDHTXT("Step 2 : Select the type of list to be produced");X_TR();
	XTR();XTD();
	XINRADIO("Format","List","Checked","A people list in PDF format.");XBR();
	if ((strlen(strstr($GLOBALS{'person_authority'},'MM'))>0)||
	 	(strlen(strstr($GLOBALS{'person_authority'},'DM'))>0)||
	  	(strlen(strstr($GLOBALS{'person_authority'},'NM'))>0)) {
		XINRADIO("Format","Label","","A set of labels in PDF format");XBR();
		$xkeylist = "8x2,6x3"; $xvaluelist = "16 labels 8x2,18 Labels 6x3";
		XTXT("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Label Type - ");XINSELECTHASH(Lists2Hash($xkeylist,$xvaluelist),"LabelType","8x2");XBR();
		$domain_emailblocksize = "500";
		if ($GLOBALS{'domain_emailblocksize'} != "") {
			$domain_emailblocksize = $GLOBALS{'domain_emailblocksize'};
		}
		XINRADIO("Format","DistList","","A distribution list for you to email.");XBR();
		XTXT("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Block size - ");XINTXT("DistListBlock",$domain_emailblocksize,"3","3");XTXT(" emails");XBR();
		XTXT("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Respect Newsletter Requirements - ");XINCHECKBOX("DistListNewsletterRespect","Yes","checked","");XBR();
		XINRADIO("Format","IdList","","A list of person-ids.");XBR();
		XINRADIO("Format","MailChimpList","","A distribution list for MailChimp.");XBR();
		XBR();
	}
	X_TD();X_TR();
	XTR();XTDHTXT("Step 3 : Download/View List");X_TR();
	XTR();XTDINSUBMIT("Continue");X_TR();
	X_TABLE();
	X_FORM();
}

function Person_QUALIFICATION_CSSJS () {
$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm";
$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,personselectionpopup,dropzonebasicfilepopup,generictablepopup,jqueryconfirm";
$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,GenericTable_Popup";
}

function Person_QUALIFICATION_Output() {
	$parm0 = "";
	$parm0 = $parm0."Person Qualification Update|"; # pagetitle
	$parm0 = $parm0."personqualification[mergedkey=personqualification_personid+personqualification_qualificationid]|"; # primetable
	$parm0 = $parm0."qualification,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."personqualification_personid+personqualification_qualificationid|"; # keyfieldname
	$parm0 = $parm0."personqualification_personid+personqualification_qualificationid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."personqualification_personid|Yes|Person|200|Yes|Person|KeyPerson,12,15,Person_Id,Lookup^";
	// $parm1 = $parm1."personqualification_qualificationid|Yes[qualification_id,qualification_title]|Qualification|200|Yes|Qualification|KeySelectFromTable,qualification,qualification_id,qualification_title,qualification_title,Qualification_Id,Descriptions^";
	$parm1 = $parm1."personqualification_qualificationid|Yes|Qualification|200|Yes|Qualification|KeySelectFromTable,qualification,qualification_id,qualification_title,qualification_title,Qualification_Id,Descriptions^";
	$parm1 = $parm1."personqualification_issuedby|No|Issued By|150|Yes|Issued By|InputText,40,80^";
	$parm1 = $parm1."personqualification_startdate|Yes|Start Date|70|Yes|Start Date|InputDate^";
	$parm1 = $parm1."personqualification_enddate|Yes|End Date|70|Yes|End Date</br>(If Specified)|InputDate,40,80^";
	$parm1 = $parm1."personqualification_certificate|Yes|Certificate|70|Yes|Certificate|InputFile,GLOBALDOMAINWWWPATH/domain_temp,GLOBALDOMAINFILEPATH/assets,Qualification,personqualification_personid^";
	$parm1 = $parm1."personqualification_comments|No|Comments|150|Yes|Comments|InputText,40,80^";
	$parm1 = $parm1."personqualification_approvedby|Yes|Approved By|70|Yes|Approved By|InputPerson,20,40,ApprovedBy,Lookup^";
	$parm1 = $parm1."personqualification_approveddate|Yes|Approved Date|70|Yes|Approved Date</br>|InputDate^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	$parm2 = "Finish|personreloginin.php|SpecialAction=DeleteDomainTempFiles";
	GenericHandler_Output ($parm0,$parm1,$parm2);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
	 "other,person_domainid|person_id|person_sname|person_fname|person_section",
	 "person_sname,SurName,100|person_fname,FirstName,100|person_id,Person_Id,60",
	 "field,Person_Id,Select..,addkeyinput1,addkeyinput1_personlist,85|field,ApprovedBy,Select,personqualification_approvedby_input,personqualification_approvedby_personlist,80",
	 "person_id",
	 "all",
	 "section,50,50,200,200",
	 "change",
	 "singleaddtolist"
	);
	$GLOBALS{'GenericTablePopupParameters'} = array(
		       "Qualifications",
		       "qualification",
		       "qualification_title",
			   "Qualification_Id",
		       "qualification_title,Title,180|qualification_description,Qualification Description,455",
		       "25",
		       "Qualification Descriptions,150,50,700,400"
	);
}

function Person_MYQUALIFICATION_CSSJS () {
	// $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,dropzone,datepicker";
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker,jqueryconfirm"; // DROPZONEBASIC
	// $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,dropzone,dropzonefilepopup,generictablepopup";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,generichandler,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,dropzonebasicfilepopup,generictablepopup,jqueryconfirm";	// DROPZONEBASIC
	$GLOBALS{'SITEPOPUPHTML'} = "GenericTable_Popup";
}

function Person_MYQUALIFICATION_Output($tpersonid) {
    if ( $tpersonid == $GLOBALS{'LOGIN_person_id'}) {
        $parm0 = $parm0."My Qualifications|"; # pagetitle
    } else {
        Check_Data("person",$tpersonid);
        if ($GLOBALS{'IOWARNING'} == "0" ) { $personname = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
        else { $personname = "Person Not Found"; }
    	$parm0 = $parm0."Qualifications - ".$personname."|"; # pagetitle
    }
	$parm0 = $parm0."personqualification[rootkey=".$tpersonid."]|"; # primetable
	$parm0 = $parm0."qualification|"; # othertables
	$parm0 = $parm0."personqualification_qualificationid|"; # keyfieldname
	$parm0 = $parm0."personqualification_qualificationid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."personqualification_qualificationid|Yes|Qualification|200|Yes|Qualification|KeySelectFromTable,qualification,qualification_id,qualification_title,qualification_title,Qualification_Id,Descriptions^";
	$parm1 = $parm1."personqualification_issuedby|No|Issued By|150|Yes|Issued By|InputText,40,80^";
	$parm1 = $parm1."personqualification_startdate|Yes|Start Date|70|Yes|Start Date|InputDate^";
	$parm1 = $parm1."personqualification_enddate|Yes|End Date|70|Yes|End Date</br>(If Specified)|InputDate,40,80^";
	$parm1 = $parm1."personqualification_certificate|Yes|Certificate|70|Yes|Certificate|InputFile,GLOBALDOMAINWWWPATH/domain_temp,GLOBALDOMAINFILEPATH/assets,Qualification,personqualification_personid^";
	$parm1 = $parm1."personqualification_comments|No|Comments|150|Yes|Comments|InputText,40,80^";
	$parm1 = $parm1."personqualification_approvedby|Yes|Approved By|70|Yes|Approved By|Text^";
	$parm1 = $parm1."personqualification_approveddate|Yes|Approved Date|70|Yes|Approved Date</br>|Date^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	$parm2 = "Finish|personreloginin.php|SpecialAction=DeleteDomainTempFiles";
	GenericHandler_Output ($parm0,$parm1,$parm2);
	$GLOBALS{'GenericTablePopupParameters'} = array(
       "Qualifications",
       "qualification",
       "qualification_title",
	   "Qualification_Id",
       "qualification_title,Title,180|qualification_description,Qualification Description,455",
       "25",
       "Qualification Descriptions,150,50,700,400"
	);
}

function Person_JOBROLE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,generichandler,personselectionpopup,generictablepopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "PersonSelection_Popup,GenericTable_Popup";
}

function Person_JOBROLE_Output() {
	$parm0 = "";
	$parm0 = $parm0."Person Job Role Update|"; # pagetitle
	$parm0 = $parm0."personjobrole[mergedkey=personjobrole_personid+personjobrole_jobroleid]|"; # primetable
	$parm0 = $parm0."jobrole,person[returnedfields=person_domainid+person_id+person_sname+person_fname+person_section]|"; # othertables
	$parm0 = $parm0."personjobrole_personid+personjobrole_jobroleid|"; # keyfieldname
	$parm0 = $parm0."personjobrole_personid+personjobrole_jobroleid|"; # sortfieldname
	$parm0 = $parm0."25|"; # pagination
	$parm0 = $parm0."No"; # enable add-copy
	$parm1 = "";
	$parm1 = $parm1."personjobrole_personid|Yes|Person|200|Yes|Personal Id|KeyPerson,12,15,Person_Id,Lookup^";
	$parm1 = $parm1."personjobrole_jobroleid|Yes|JobRole|200|Yes|JobRole|KeySelectFromTable,jobrole,jobrole_id,jobrole_title,jobrole_title,JobRole_Id,Descriptions^";
	$parm1 = $parm1."personjobrole_description|Yes|Description|150|Yes|Job Description|InputText,40,80^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'PersonSelectPopupParameters'} = array(
			 "other,person_domainid|person_id|person_sname|person_fname|person_section",
			 "person_sname,SurName,100|person_fname,FirstName,100|person_id,Person_Id,60",
			 "field,Person_Id,Select..,addkeyinput1,addkeyinput1_personlist,85",
			 "person_id",
			 "all",
			 "Person Select,250,50,500,400",
			 "change",
			 "singleaddtolist"
	);
	$GLOBALS{'GenericTablePopupParameters'} = array(
	       "Job Roles",
	       "jobrole",
	       "jobrole_title",
		   "JobRole_Id",
	       "jobrole_title,Job Title,180|jobrole_description,Role Description,455",
	       "25",
	       "Job Role Descriptions,150,50,700,400"
	);
}

function Person_MYJOBROLE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqueryconfirm";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,generichandler,generictablepopup,jqueryconfirm";
	$GLOBALS{'SITEPOPUPHTML'} = "GenericTable_Popup";
}

function Person_MYJOBROLE_Output($tpersonid) {

    if ( $tpersonid == $GLOBALS{'LOGIN_person_id'}) {
        $parm0 = "My Job Roles".$personname."|personjobrole[rootkey=".$tpersonid."]|jobrole|personjobrole_jobroleid|personjobrole_jobroleid|No|No";
    } else {
        Check_Data("person",$tpersonid);
        if ($GLOBALS{'IOWARNING'} == "0" ) { $personname = $GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'}; }
        else { $personname = "Person Not Found"; }
        $parm0 = "Job Roles - ".$personname."|personjobrole[rootkey=".$tpersonid."]|jobrole|personjobrole_jobroleid|personjobrole_jobroleid|No|No";
    }
	$parm1 = "";
	$parm1 = $parm1."personjobrole_jobroleid|Yes|JobRole|200|Yes|JobRole|KeySelectFromTable,jobrole,jobrole_id,jobrole_title,jobrole_title,JobRole_Id,Descriptions^";
	$parm1 = $parm1."personjobrole_description|Yes|Description|150|Yes|Job Description|InputText,40,80^";
	$parm1 = $parm1."generic_updatebutton|Yes|Update|70|No|Update|UpdateButton^";
	$parm1 = $parm1."generic_deletebutton|Yes|Delete|70|No|Delete|DeleteButton";
	GenericHandler_Output ($parm0,$parm1);
	$GLOBALS{'GenericTablePopupParameters'} = array(
       "Job Roles",
       "jobrole",
       "jobrole_title",
	   "JobRole_Id",
	       "jobrole_title,Job Title,180|jobrole_description,Role Description,455",
	       "25",
	       "Job Role Descriptions,150,50,700,400"
	);
}

// $parm0 = pagetitle
// $parm1 = primetable
// $parm2 = linkfield id
// $parm3 = field1,title1,w|field2,title2,w|field3,title3,w
// $parm4 = pagination
// $parm5 = New Window positioning name|topx|topy|width|height

function Person_Qualification_Report_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Person_Qualification_Report ($parm) {
# parm = person_id/all
$qualificationtablearray = Array();
#--- analyse person jobroles and matching  qualifications -------------------------
$personjobrolea = Get_Array_Mergedkey("personjobrole","personjobrole_personid","personjobrole_jobroleid");
foreach ($personjobrolea as $personjobrole_id) {
 $personjobrole_ida = explode("+",$personjobrole_id);
 $person_id =  $personjobrole_ida[0];
 if (($person_id == $parm)||($parm == "all")) {
  $jobrole_id =  $personjobrole_ida[1];
  Check_Data("person",$person_id);
  if ($GLOBALS{'IOWARNING'} == "0" ) {   $person_sname = $GLOBALS{'person_sname'};   $person_fname = $GLOBALS{'person_fname'};  }
  else {  $person_sname = $person_id." Not Found";   $person_fname = "Not Found";  }

  Check_Data("jobrole",$jobrole_id);
  if ($GLOBALS{'IOWARNING'} == "0" ) { 	$jobrole_title = $GLOBALS{'jobrole_title'};  }
  else { $jobrole_title = $jobrole_id." Not Found"; }

  $jobrolequalificationa = Get_Array("jobrolequalification",$jobrole_id);
  foreach ($jobrolequalificationa as $jobrolequalification_id) {
   $jrbits = explode("-",$jobrolequalification_id);
   $jobrolequalification_idroot = $jrbits[0];

   Check_Data("jobrolequalification",$jobrole_id,$jobrolequalification_id);
   if ($GLOBALS{'IOWARNING'} == "0" ) { $jobrolequalification_requirementlevel = $GLOBALS{'jobrolequalification_requirementlevel'}; }
   else { $jobrolequalification_requirementlevel = $jobrole_id."+".$jobrolequalification_id." Not Found"; }

   Check_Data("qualification",$jobrolequalification_id);
   if ($GLOBALS{'IOWARNING'} == "0" ) { $jobrolequalification_description = $GLOBALS{'qualification_description'}; }
   else { $jobrolequalification_description = $jobrolequalification_id." Not Found"; }

   $personqualification_description = "";
   $personqualification_startdate = "";
   $personqualification_enddate = "";
   $personqualification_certificate = "";
   $personqualificationa = Get_Array("personqualification",$person_id);
   $highestmatchedpersonqualification_id = "";
   foreach ($personqualificationa as $personqualification_id) {
   	$pqbits = explode("-",$personqualification_id);
   	$personqualification_idroot = $pqbits[0];
    if ($personqualification_idroot == $jobrolequalification_idroot) {
     if ($personqualification_id > $highestmatchedpersonqualification_id) { $highestmatchedpersonqualification_id = $personqualification_id; }
    }
   }
   if ($highestmatchedpersonqualification_id != "") {
    Check_Data("qualification",$highestmatchedpersonqualification_id);
    if ($GLOBALS{'IOWARNING'} == "0" ) { $personqualification_description = $GLOBALS{'qualification_description'}; }
    else { $qualification_description = $highestmatchedpersonqualification_id." Not Found"; }
    Check_Data("personqualification",$person_id,$highestmatchedpersonqualification_id);
    if ($GLOBALS{'IOWARNING'} == "0" ) {
     $personqualification_startdate = $GLOBALS{'personqualification_startdate'};
     $personqualification_enddate = $GLOBALS{'personqualification_enddate'};
     $personqualification_certificate = $GLOBALS{'personqualification_certificate'};
    }
   }

   $arraykey = $person_id."+".$jobrolequalification_id."+".$jobrole_id;
   $qualificationassessment = "";
   $arrayelement = $arraykey."#".$person_sname."|".$person_fname."|".$jobrole_title."|".$jobrolequalification_description."|".$jobrolequalification_requirementlevel;
   $arrayelement = $arrayelement."|".$highestmatchedpersonqualification_id."|".$personqualification_description."|".$personqualification_startdate."|".$personqualification_enddate."|".$personqualification_certificate;
   array_push($qualificationtablearray, $arrayelement);
  }
 }
}
#--- get all qualifications for a person -------------------------
$personqualificationa = Get_Array_Mergedkey("personqualification","personqualification_personid","personqualification_qualificationid");
foreach ($personqualificationa as $personqualification_id) {
 $personqualification_ida = explode("+",$personqualification_id);
 $person_id =  $personqualification_ida[0];
 if (($person_id == $parm)||($parm == "all")) {
  $personqualification_id =  $personqualification_ida[1];
  Check_Data("person",$person_id);
  if ($GLOBALS{'IOWARNING'} == "0" ) {
 	$person_sname = $GLOBALS{'person_sname'};
 	$person_fname = $GLOBALS{'person_fname'};
  } else {
 	$person_sname = $person_id." Not Found";
 	$person_fname = "Not Found";
  }
  Check_Data("qualification",$personqualification_id);
  if ($GLOBALS{'IOWARNING'} == "0" ) {
 	$personqualification_description = $GLOBALS{'qualification_description'};
  } else {
 	$personqualification_description = $personqualification_id." Not Found";
  }
  Check_Data("personqualification",$person_id,$personqualification_id);
  if ($GLOBALS{'IOWARNING'} == "0" ) {
 	$personqualification_startdate = $GLOBALS{'personqualification_startdate'};
 	$personqualification_enddate = $GLOBALS{'personqualification_enddate'};
 	$personqualification_certificate = $GLOBALS{'personqualification_certificate'};
 	$personqualification_approvedby = $GLOBALS{'personqualification_approvedby'};
 	$personqualification_approveddate = $GLOBALS{'personqualification_approveddate'};

  } else {
 	$personqualification_startdate = "";
 	$personqualification_enddate = "";
 	$personqualification_certificate = "";
 	$personqualification_approvedby = "";
 	$personqualification_approveddate = "";
  }
  $arraykey = $person_id."+".$personqualification_id."+"."ZZZZZZ";
  $qualificationassessment = "";
  $arrayelement = $arraykey."#".$person_sname."|".$person_fname."|".""."|".""."|"."";
  $arrayelement = $arrayelement."|".$personqualification_id."|".$personqualification_description."|".$personqualification_startdate."|".$personqualification_enddate."|".$personqualification_certificate."|".$personqualification_approvedby."|".$personqualification_approveddate;
  array_push($qualificationtablearray, $arrayelement);
 }
}


#--- bring total picture together and identify person qualifications where no jobrole requirement exists-------------------------
sort($qualificationtablearray);
$qualificationtablearray2 = Array();
$oldperson_id = "";
$oldpersonqualification_ida = Array();
foreach ($qualificationtablearray as $qualificationtablearrayelement) {
 $qbits = explode("#",$qualificationtablearrayelement);
 $qbits2 = explode("+",$qbits[0]);
 $qbits3 = explode("|",$qbits[1]);
 $personqualification_id = $qbits3[5];
 if ($qbits2[0] != $oldperson_id) {
 	$oldpersonqualification_ida = Array();
 	$oldperson_id = $qbits2[0];
 }
 $keep = "1";
 if ($qbits2[2] == "ZZZZZZ") {
  foreach ($oldpersonqualification_ida as $oldpersonqualification_id) {
   if ($personqualification_id == $oldpersonqualification_id) {$keep = "0";}	# qualification already matched to jobrole
  }
 } else {
 	array_push($oldpersonqualification_ida, $personqualification_id);
 }
 $arrayelement = $qbits2[0]."+".$qbits2[2]."+".$qbits2[1]."#".$qbits[1];
 if ($keep == "1") {array_push($qualificationtablearray2, $arrayelement); }
}

XH2("Qualification Report");
sort($qualificationtablearray2);

XDIV("reportdiv","container");
XTABLEJQDTID("reporttable_list");
XTHEAD();
XTRJQDT();
XTDHTXT("First Name");
XTDHTXT("Surname");
XTDHTXT("Job Role");
XTDHTXT("Required");
XTDHTXT("Recommended");
XTDHTXT("");
XTDHTXT("Qualification Achieved");
XTDHTXT("Start Date");
XTDHTXT("Expiry Date");
XTDHTXT("Certificate");
XTDHTXT("Approved By");
XTDHTXT("Approved Date");
XTDHTXT("Required Action");
X_TR();
X_THEAD();
XTBODY();

foreach ($qualificationtablearray2 as $qualificationtablearrayelement) {
 $qbits = explode("#",$qualificationtablearrayelement);
 $qbits3 = explode("|",$qbits[1]);
 $person_sname = $qbits3[0];
 $person_fname = $qbits3[1];
 $jobrole_title = $qbits3[2];
 $jobrolequalification_description = $qbits3[3];
 $jobrolequalification_requirementlevel = $qbits3[4];
 $personqualification_id = $qbits3[5];
 $personqualification_description = $qbits3[6];
 $personqualification_startdate = $qbits3[7];
 $personqualification_enddate = $qbits3[8];
 $personqualification_certificate = $qbits3[9];
 $personqualification_approvedby = $qbits3[10];
 $personqualification_approveddate = $qbits3[11];

 if ($jobrole_title == "ZZZZZZ") { # additional qualifications
 	$required_qualification_description = "";
 	$recommended_qualification_description =  "";
 	$personqualification_certificatetext = "";
 	if ($personqualification_certificate != "") {
 		$qlink = YPGMLINK("fileview.php").YPGMSTDPARMS().YPGMPARM("FilePath","GLOBALDOMAINFILEPATH/assets").YPGMPARM("FileName",$personqualification_certificate);
 		$personqualification_certificatetext = YLINKTXTNEWWINDOW ($qlink,"View","Certificate");
 	}
 	$qualificationachieved_description = "";
 	$qualificationassessment = "";
 	$sep = "";
 	if ($personqualification_startdate != "") {
 		$qualificationachieved_description = $personqualification_description;
 		if (($personqualification_enddate != "")||($personqualification_enddate != "    -  -  ")) {
 		  if ($personqualification_enddate < $GLOBALS{'currentYYYY-MM-DD'}) {
 			$qualificationassessment = $qualificationassessment.$sep."Qualification Expired"; $sep = "<br>";
 		  }
 		}
 		if ($personqualification_certificate == "") {
 			$qualificationassessment = $qualificationassessment.$sep."Certificate Required"; $sep = "<br>";
 		}
 	}
 } else { # qualifications related to jobroles
 	$required_qualification_description = "";
 	$recommended_qualification_description =  "";
 	if ($jobrolequalification_requirementlevel == "Required") {
 		$required_qualification_description =  $jobrolequalification_description;
 	}
 	if ($jobrolequalification_requirementlevel == "Recommended") {
 		$recommended_qualification_description = $jobrolequalification_description;
 	}
 	$personqualification_certificatetext = "";
 	if ($personqualification_certificate != "") {
 		$qlink = YPGMLINK("fileview.php").YPGMSTDPARMS().YPGMPARM("FilePath","GLOBALDOMAINFILEPATH/assets").YPGMPARM("FileName",$personqualification_certificate);
 		$personqualification_certificatetext = YLINKTXTNEWWINDOW ($qlink,"View","Certificate");
 	}
 	$qualificationachieved_description = "";
 	$qualificationassessment = "";
 	$rag = "";
 	$sep = "";
 	if (($jobrolequalification_requirementlevel == "Required")&&($personqualification_startdate == "")) {
 		$personqualification_startdate = "";
 		$qualificationassessment = "Qualification Required";
 		$rag = "r";
 	}
 	if ($personqualification_startdate != "") {
 		$qualificationachieved_description = $personqualification_description;
 		if (($personqualification_enddate != "")&&($personqualification_enddate != "    -  -  ")) {
 		  if ($personqualification_enddate < $GLOBALS{'currentYYYY-MM-DD'}) {
 			$qualificationassessment = $qualificationassessment.$sep."Qualification Expired"; $sep = "<br>";
 			$rag = "r";
 		  }
 		}
 		if ($personqualification_certificate == "") {
 			$qualificationassessment = $qualificationassessment.$sep."Certificate Required"; $sep = "<br>";
 			$rag = "a";
 		}
 	}

 }
 XTRJQDT();
 XTDTXT($person_fname);
 XTDTXT($person_sname);
 XTDTXT($jobrole_title." ".$personjobrole_description);
 XTDTXT($required_qualification_description);
 XTDTXT($recommended_qualification_description);
 XTDTXT("");
 XTDTXT($qualificationachieved_description);
 XTDTXT($personqualification_startdate);
 XTDTXT($personqualification_enddate);
 XTDTXT($personqualification_certificatetext);
 XTDTXT($personqualification_approvedby);
 XTDTXT($personqualification_approveddate);
 if ($rag == "r") {XTDTXTRED($qualificationassessment);}
 if ($rag == "a") {XTDTXTAMBER($qualificationassessment);}
 if ($rag == "g") {XTDTXTGREEN($qualificationassessment);}
 if ($rag == "") {XTDTXT($qualificationassessment);}
 X_TR();

}
X_TBODY();
X_TABLE();
X_DIV("reportdiv");
XCLEARFLOAT();
XINHID("list_sortcol",1);

# XH3("jobrolequalification");
# $jobrolequalificationa = Get_Array_Mergedkey("jobrolequalification","jobrolequalification_jobroleid","jobrolequalification_qualificationid");
# foreach ($jobrolequalificationa as $jobrolequalificationa_id) {
# XPTXT($jobrolequalificationa_id);
# }
# XH3("personqualification");
# $personqualificationa = Get_Array_Mergedkey("personqualification","personqualification_personid","personqualification_qualificationid");
# foreach ($personqualificationa as $personqualificationa_id) {
# XPTXT($personqualificationa_id);
# }
# XH3("personjobrole");
# $personjobrolea = Get_Array_Mergedkey("personjobrole","personjobrole_personid","personjobrole_jobroleid");
# foreach ($personjobrolea as $personjobrolea_id) {
# XPTXT($personjobrolea_id);
# }
}


function Person_MASSDETAILSNOTIFY_Output () {
	XH3("Mass confirmation of people records information");
	$helplink = "PersonMaster_Person_MASSDETAILSNOTIFY_Output/person_massdetailsnotify_output.html"; Help_Link();
	foreach (Person_SectionVisibility_Array("change") as $tsection_name) {
		XTXT("- $tsection_name section ");XBR();
	}
	$persona = &Get_Array('person');
	XFORM("personmassdetailsnotify.php","massdetailsnotify");
	XH4("Step 1 : Select people to be communicated to - list of peopleids (with any non-alphanumeric separator)");
	XINTEXTAREA("PersonList","","10","60");
	XH4("Step 2 : Compose the introduction to the email.");
	XTXT("Dear Firstname Surname.");XBR();
	XINTEXTAREA("PersonMassNotifyIntro",$GLOBALS{'domain_personmassnotifyintro'},"15","100");
	XH4("Step 3 : Select the details to be shown.");
	XINCHECKBOX("SelectName","Yes","checked","Name");XBR();
	XINCHECKBOX("SelectLogin","Yes","checked","Personid and Password");XBR();
	XINCHECKBOX("SelectAddress","Yes","checked","Address");XBR();
	XINCHECKBOX("SelectContacts","Yes","checked","eMail and Phone contacts");XBR();
	XINCHECKBOX("SelectSection","Yes","checked","Section and Membership Type");XBR();
	XINCHECKBOX("SelectPrivacy","Yes","checked","Privacy settings");XBR();
	XINCHECKBOX("SelectProfile","Yes","checked","Player/Official Profile");XBR();
	XINCHECKBOX("SelectExtraData","Yes","checked","Extra Data");XBR();
	XH5("Step 4 : Decide whether to preview the emails before sending.");
	XTABLEINVISIBLE();
	XTR();XTDINRADIO("TestorReal","T","checked","Test Mode - view emails that would be sent");X_TR();
	XTR();XTDINRADIO("TestorReal","R","","Real Mode - emails will be generated");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
}

function Person_MASSMEMBERSHIPNOTIFY_Output () {
	XH2("Membership Renewal");
	$helplink = "PersonMaster_Person_MASSDETAILSNOTIFY_Output/person_massdetailsnotify_output.html"; Help_Link();
	$sectionlist = ""; $sep = "";
	foreach (Person_SectionVisibility_Array("change") as $tsection_name) {
		$sectionlist = $sep.$sectionlist;
		$sep = ",";
	}
	$persona = &Get_Array('person');
	XFORM("personmassmembershipnotify.php","massdetailsnotify");
	XH3("Step 1 : Select the people to be notified.");
	XH5("Sections");
	$pvhash = Array2Hash(Person_SectionVisibility_Array("change"));
	XINCHECKBOXHASH($pvhash,"SelectSection","");
	XH5("Person Types");
	# datatype/rootkey keyfieldname textfieldname sortfieldname selectfieldname selectfieldcondition
	$mthash = Get_SelectArrays_Hash("persontype",$GLOBALS{'currperiodid'},"persontype_code","persontype_name","persontype_code","","" );
	print $mthash;
	XINCHECKBOXHASH($mthash,"SelectPersonType","");

	XH3("Step 2 : Compose the introduction to the email.");
	XTXT("Dear Firstname Surname.");XBR();
	XINTEXTAREA("PersonMembershipNotifyIntro",$GLOBALS{'domain_personmembershipnotifyintro'},"15","100");
	XH3("Step 3 : Decide whether to preview the emails before sending.");
	XTABLEINVISIBLE();
	XTR();XTDINRADIO("TestorReal","T","checked","Test Mode - view emails that would be sent");X_TR();
	XTR();XTDINRADIO("TestorReal","R","","Real Mode - emails will be generated");X_TR();
	XTR();XTDINRADIO("TestorReal","M","","Just Create a Mailchimp distribution list");X_TR();
	XTR();XTDTXT("");XTDINSUBMIT("Go");X_TR();
	X_TABLE();
	XINSTDHID();
	X_FORM();
}

function Person_MEMBERSHIPUPDATEREMOTE_Output () {
	XH2("Membership Renewal");

	XHR();
	$tpersontypea = Get_Array_Hash('persontype',$GLOBALS{'currperiodid'});
	XH4("Our current records show the following information about your membership:");
	XTABLEINVISIBLE();
	XTR();XTDTXT("Name");XTDTXT($GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});X_TR();
	XTR();XTDTXT("Address");
	XTDTXT($GLOBALS{'person_addr1'}
	.", ".$GLOBALS{'person_addr2'}
	.", ".$GLOBALS{'person_addr3'}
	.", ".$GLOBALS{'person_addr4'}
	.", ".$GLOBALS{'person_postcode'});
	X_TR();
	XTR();XTDTXT("Email");XTDTXT($GLOBALS{'person_email1'});X_TR();
	XTR();XTDTXT("Home");XTDTXT($GLOBALS{'person_hometel'});X_TR();
	XTR();XTDTXT("Work");XTDTXT($GLOBALS{'person_worktel'});X_TR();
	XTR();XTDTXT("Mobile");XTDTXT($GLOBALS{'person_mobiletel'});X_TR();
	XTR();XTDTXT("Section");XTDTXT($GLOBALS{'person_section'});X_TR();
	$membershipdescription = "No Previous Membership Details Found";
	Check_Data("persontype",$GLOBALS{'currperiodid'},$GLOBALS{'person_type'});
	if ($GLOBALS{'IOWARNING'} == "0") {
		$membershipdescription = $GLOBALS{'persontype_name'};
	}
	XTR();XTDTXT("Membership Type");XTDTXT($membershipdescription);X_TR();
	if ($GLOBALS{'person_paidperiodid'} != "") {
		XTR();XTDTXT("Season");XTDTXT($GLOBALS{'person_paidperiodid'});X_TR();
	}
	if (($GLOBALS{'person_paiddate'} != "")&&($GLOBALS{'person_paiddate'} != "0000-00-00")) {
		XTR();XTDTXT("Date Paid");XTDTXT($GLOBALS{'person_paiddate'});X_TR();
	}
	if ($GLOBALS{'person_paidmethod'} != "") {
		XTR();XTDTXT("Payment Method");XTDTXT($GLOBALS{'person_paidmethod'});X_TR();
	}
	if (($GLOBALS{'person_paidamount'} != "")&&($GLOBALS{'person_paidamount'} != "0.00")) {
		XTR();XTDTXT("Payment Amount");XTDTXT($GLOBALS{'person_paidamount'});X_TR();
	}
	if ($GLOBALS{'person_paiddetails'} != "") {
		XTR();XTDTXT("Payment Details");XTDTXT($GLOBALS{'person_paiddetails'});X_TR();
	}
	if (($GLOBALS{'person_paidconfirmationdate'} != "")&&($GLOBALS{'person_paidconfirmationdate'} != "0000-00-00")) {
		XTR();XTDTXT("Payment Confirmed");XTDTXT("Yes");X_TR();
	}
	X_TABLE();
	if ($GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'}) {
		XBR();XTDTXTGREEN("Thankyou: Membership has been renewed for this season.");
		XHR();
	} else {
		XTDTXTRED("Membership is outstanding for this season.");
		XBR();XBR();XHR();XBR();
		XPTXT("Please sign in to the website to renew your membership and update your contact details.");
		XTABLE();
		XFORM("personloginin.php","login");
		XINSTDHID();
		XTR();XTDTXT("Personal Id or Email Address");XTDINTXT("PersonId",$GLOBALS{'person_email1'},"40","60");X_TR();
		XTR();XTDTXT("Password");XTDINPSW("PersonPsw","","12","20");X_TR();
		XTR();XTDTXT("");XTDINSUBMIT("Login");X_TR();
		X_TABLE();
		X_FORM();
		$outtext = "I have forgotten my password - please email ths back to me";
		$link = YPGMLINK("personPWFin.php").YPGMSTDPARMS().YPGMPARM ('PersonFName',$GLOBALS{'person_fname'}).YPGMPARM ('PersonSName',$GLOBALS{'person_sname'}).YPGMPARM ('PersonEmail',$GLOBALS{'person_email1'});
		XLINKTXT($link,"$outtext");XBR();XBR();
		XHR();XBR();
		XH3("What to do after you have logged in.");
		XTABLEINVISIBLE();
		$image = $GLOBALS{'site_asseturl'}."/MYMEMBERSHIP.png";
		XTR();XTDIMG($image,"100","100","0");XTDTXT("Select this to renew my membership.");
		$image = $GLOBALS{'site_asseturl'}."/MYPROFILE.png";
		XTR();XTDIMG($image,"100","100","0");XTDTXT("Select this to update my contact details.");
		X_TABLE();
	}


}

function Person_Form2Globals() {
	foreach ( $_REQUEST as $k => $v ) {
		$keystring = $k;
		/*
		// The following avoids mod security issues because of ../../
		$keystring = str_replace("GLOBALDOMAINURL", $GLOBALS{'domainwwwurl'}, $keystring);
		$keystring = str_replace("GLOBALDOMAINFILEPATH", $GLOBALS{'domainfilepath'}, $keystring);
		*/
		 #�XPTXT($k." ".$v);
		if (strlen(strstr($keystring,"person_"))>0) {
			$keybits = explode("_",$keystring);
			if (sizeOf($keybits) == 2) { # normal
				if (is_array($_REQUEST[$k])) { # array
					$vstring = ""; $vsep = "";
					foreach ($_REQUEST[$k] as $value) {
						// XPTXT($k." = ".$value);
						$vstring = $vstring.$vsep.$value;
						$vsep = ",";
					}
				} else {
					$vstring = $v;
				}
				$GLOBALS{$keystring} = $vstring;
				// XPTXT($keystring." = ".$vstring);
			}
			if (sizeOf($keybits) == 3) { # Multipart field
			    if ($keybits[2] == "imagename") {
			        $imagename = $v;
			        $GLOBALS{$keybits[0]."_".$keybits[1]} = FinaliseImageInputTemp($GLOBALS{'domainfilepath'}."/personphotos",$GLOBALS{$keybits[0]."_".$keybits[1]},$imagename);
			    }
				if ($keybits[2] == "DDpart") {$ddpart = $v;}
				if ($keybits[2] == "MMpart") {$mmpart = $v;}
				if ($keybits[2] == "YYYYpart") {$yyyypart = $v; $GLOBALS{$keybits[0]."_".$keybits[1]} = $yyyypart."-".$mmpart."-".$ddpart;}
				if ($keybits[2] == "CODEpart") {$codepart = $v;}
				if ($keybits[2] == "NUMpart") {$numpart = $v; $GLOBALS{$keybits[0]."_".$keybits[1]} = $codepart." ".$numpart; }
			}
		}
	}
}

function Person_Form2Action() {
	$tactionstring = ""; $asep = "";
	foreach ( $_REQUEST as $k => $v ) {
		$keystring = $k;
		/*
		// The following avoids mod security issues because of ../../
		$keystring = str_replace("GLOBALDOMAINURL", $GLOBALS{'domainwwwurl'}, $keystring);
		$keystring = str_replace("GLOBALDOMAINFILEPATH", $GLOBALS{'domainfilepath'}, $keystring);
		*/
		if (strlen(strstr($keystring,"person_"))>0) {
			$keybits = explode("_",$keystring);
			if (sizeOf($keybits) == 2) { # Normal field or array
				if (is_array($_REQUEST[$k])) {
					$vstring = ""; $vsep = "";
					foreach ($_REQUEST[$k] as $value) {
						$vstring = $vstring.$vsep.$value;
						$vsep = ",";
					}
				} else {
					$vstring = $v;
				}
				$tactionstring = $tactionstring.$asep.$keystring."=".$vstring;
			}
			if (sizeOf($keybits) == 3) { # Multipart field
			    /*
			    if ($keybits[2] == "imagename") {
			        $imagename = $v;
			        $from = $GLOBALS{'domainwwwurl'}."/domain_temp/".$imagename;
			        if (($imagename != "")&&(file_exists($from))) {
			            $to = $GLOBALS{'domainfilepath'}."/personphotos/".$imagename;
			            copy($from, $to);
			        }
			        $tactionstring = FinaliseImageInput($GLOBALS{'domainfilepath'}."/personphotos",$GLOBALS{'person_photo'},$imagename);
			    }
			    */
				if ($keybits[2] == "DDpart") {$ddpart = $v;}
				if ($keybits[2] == "MMpart") {$mmpart = $v;}
				if ($keybits[2] == "YYYYpart") {$yyyypart = $v; $tactionstring = $tactionstring.$asep.$keybits[0]."_".$keybits[1]."=".$yyyypart."-".$mmpart."-".$ddpart;}
				if ($keybits[2] == "CODEpart") {$codepart = $v;}
				if ($keybits[2] == "NUMpart") {$numpart = $v; $tactionstring = $tactionstring.$asep.$keybits[0]."_".$keybits[1]."=".$codepart." ".$numpart; }
			}
			$asep = "|";
		}
	}
	return $tactionstring;
}

function Person_Action2Globals($tactionstring) {
	$tactionstringa = explode("|",$tactionstring);
	foreach ( $tactionstringa as $tactionstringelement ) {
		$tactionstringelementa = explode("=",$tactionstringelement);
		$GLOBALS{$tactionstringelementa[0]} = $tactionstringelementa[1];
		#�XPTXT($tactionstringelementa[0]." - ".$tactionstringelementa[1]);
	}
}

function Person_MYTEAM_CSSJS () {
	// $GLOBALS{'SITEJSOPTIONAL'} = "jqtabs";
}


function Person_MYTEAM_Output () {
	XH2("My Team");
	BTABHEADERCONTAINER();
	$first = "1";
	foreach (Person_TeamVisibility_Array("view") as $tteam_code) {
		Get_Data("team",$GLOBALS{'currperiodid'},$tteam_code);
		if ($first == "1") { BTABHEADERITEMACTIVE($tteam_code,$GLOBALS{'team_name'}); $first = "0"; }
		else { BTABHEADERITEM($tteam_code,$GLOBALS{'team_name'}); }
	}
	B_TABHEADERCONTAINER();
	BTABCONTENTCONTAINER();
	$first = "1";
	foreach (Person_TeamVisibility_Array("view") as $tteam_code) {
		$section_name = GetSectionFromTeamCode($tteam_code);
		Get_Data("team",$GLOBALS{'currperiodid'},$tteam_code);
		if ($first == "1") { BTABCONTENTITEMACTIVE($tteam_code); $first = "0"; }
		else { BTABCONTENTITEM($tteam_code); }
		// XH1($tteam_code);
		Frs_TEAMFIXTURESLIST_Output($GLOBALS{'currperiodid'},$section_name,$tteam_code);
		XH4("Squad Management");
		XTABLEINVISIBLE();
		XTR();
		$link = YPGMLINK("frsSETUPTEAMpopupout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$tteam_code);;
		# link,imagesrc,width,height,border,wintitle,top,left,height,width
		XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/SETUPTEAM.png","100","100","0","SetupTeam","center","center","90%","90%");X_TD();
		$link = YPGMLINK("frssquadselectionout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$tteam_code);;
		XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/TEAMSQUAD.png","100","100","0","TeamSquad","center","center","90%","90%");X_TD();
		$link = YPGMLINK("frssquadplannerout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$tteam_code);
		XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/TEAMSQUADPLANNER.png","100","100","0","SquadPlanner","center","center","90%","90%");X_TD();
		// XTD();XLINKIMGNEWWINDOW($link,$GLOBALS{'site_asseturl'}."/TEAMSQUADPLANNER.png","SquadPlanner","100","100","0");X_TD();
		$link = YPGMLINK("personADDpopupout.php");
		$link = $link.YPGMSTDPARMS();
		XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/ADDPERSON.png","100","100","0","NewPerson","center","center","90%","90%");X_TD();
		$link = YPGMLINK("personteamreport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$tteam_code);
		XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/PDFLIST.png","100","100","0","TeamReport","center","center","90%","90%");X_TD();
		$link = YPGMLINK("frssquademailsmsout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("team_code",$tteam_code);
		XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/EMAILTEXT.png","100","100","0","TeamEmailText","center","center","90%","90%");X_TD();
		Get_Data('section',$GLOBALS{'currperiodid'},$section_name);
		if ($GLOBALS{'section_showdateavailability'} == "Yes") {
			$link = YPGMLINK("frsselectionsummarymenuout.php");
			$link = $link.YPGMSTDPARMS().YPGMPARM("section_name",$section_name);
			XTD();XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/CLUBAVAILABILITY.png","100","100","0","ClubAvailability","center","center","90%","90%");X_TD();
		}
		X_TR();
		X_TABLE();
		B_TABCONTENTITEM();
	}
	B_TABCONTENTCONTAINER();


	Check_Data('webpage',"MYTEAM");
	if ($GLOBALS{'IOWARNING'} == "0") {
		print $GLOBALS{'webpage_html'};
	}
}

function Person_MYGROUP_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
	$GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,mygroup";
}

function Person_MYGROUP_Output () {
	XH2("My Group");

	$link = YPGMLINK("personloginselectin.php").YPGMSTDPARMS().YPGMPARM("SelectId","MYGROUP");
	XLINKBUTTONRIGHT($link,"Refresh List to see Updates");

	BTABHEADERCONTAINER();
	$first = "1";
	foreach (Person_SectionGroupVisibility_Array("view") as $tsectiongroup_code) {
		if ($first == "1") { BTABHEADERITEMACTIVE($tsectiongroup_code,$tsectiongroup_code); $first = "0"; }
		else { BTABHEADERITEM($tsectiongroup_code,$tsectiongroup_code); }
	}
	B_TABHEADERCONTAINER();
	BTABCONTENTCONTAINER();
	$first = "1";
	foreach (Person_SectionGroupVisibility_Array("view") as $tsectiongroup_code) {
		if ($first == "1") { BTABCONTENTITEMACTIVE($tsectiongroup_code); $first = "0"; }
		else { BTABCONTENTITEM($tsectiongroup_code); }
		Person_MYGROUPLIST_Output($tsectiongroup_code);
		XH4("Additional Options");

		/* Convert to Bootstrap
		BROW():
		$link = YPGMLINK("personSETUPGROUPpopupout.php");
		BLINKIMGNEWPOPUP($link,$src,$height,$wintitle,$top,$left,$wheight,$wheight)
		*/
		/*
		BROW();
		$link = YPGMLINK("personSETUPGROUPpopupout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/SETUPGROUP.png","100","100","0","SetupGroup","center","center","600","800");B_COL();
		$link = YPGMLINK("personADDTOGROUPpopupout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/ADDTOGROUP.png","100","100","0","AddToGroup","center","center","600","900");B_COL();
		$link = YPGMLINK("personADDpopupout.php");
		$link = $link.YPGMSTDPARMS();
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/ADDPERSON.png","100","100","0","NewPerson","center","center","600","800");B_COL();
		$link = YPGMLINK("persongroupreport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/PDFLIST.png","100","100","0","GroupReport","center","center","600","800");B_COL();
		$link = YPGMLINK("persongroupregistermout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/REGISTERM.png","100","100","0","GroupRegisterM","center","center","600","800");B_COL();
		$link = YPGMLINK("persongroupregisterfout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/REGISTER.png","100","100","0","GroupRegister","center","center","600","800");B_COL();
		$link = YPGMLINK("persongroupemailsmsout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("sectiongroup_code",$tsectiongroup_code);
		BCOL("1");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/EMAILTEXT.png","100","100","0","GroupEmailText","center","center","600","800");B_COL();
		BCOLTXT("","5");
		B_ROW();
		*/

		$link = YPGMLINK("personSETUPGROUPpopupout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/SETUPGROUP.png","100","100","0","SetupGroup","center","center","600","800");X_DIV("");
		$link = YPGMLINK("personADDTOGROUPpopupout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/ADDTOGROUP.png","100","100","0","AddToGroup","center","center","600","900");X_DIV("");
		$link = YPGMLINK("personADDpopupout.php");
		$link = $link.YPGMSTDPARMS();
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/ADDPERSON.png","100","100","0","NewPerson","center","center","600","800");X_DIV("");
		$link = YPGMLINK("persongroupreport.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/PDFLIST.png","100","100","0","GroupReport","center","center","600","800");X_DIV("");
		$link = YPGMLINK("persongroupregistermout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/REGISTERM.png","100","100","0","GroupRegisterM","center","center","600","800");X_DIV("");
		$link = YPGMLINK("persongroupregisterfout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("SectionGroup",$tsectiongroup_code);
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/REGISTER.png","100","100","0","GroupRegister","center","center","600","800");X_DIV("");
		$link = YPGMLINK("persongroupemailsmsout.php");
		$link = $link.YPGMSTDPARMS().YPGMPARM("sectiongroup_code",$tsectiongroup_code);
		XDIV("","floathoriz");XLINKIMGNEWPOPUP($link,$GLOBALS{'site_asseturl'}."/EMAILTEXT.png","100","100","0","GroupEmailText","center","center","600","800");X_DIV("");
		XBR();

		B_TABCONTENTITEM();

	}
	B_TABCONTENTCONTAINER();
	Check_Data('webpage',"MYGROUP");
	if ($GLOBALS{'IOWARNING'} == "0") {
		print $GLOBALS{'webpage_html'};
	}
	XCLEARFLOAT();
}

function Person_MYGROUPLIST_Output($tsectiongroup) {
	XH2("Group List - ".$tsectiongroup);

	XDIV($tsectiongroup."_tablecontainer","container");
	XTABLEJQDTID("mygrouptable_".$tsectiongroup);
	XTHEAD();
	XTRJQDT();
	XTDHTXT("First Name");
	XTDHTXT("Surname");
	XTDHTXT("Age");
	XTDHTXT("Medical");
	XTDHTXT("EmergTel");
	XTDHTXT("Photo");
	XTDHTXT("Trans");
	XTDHTXT("Parent First Name");
	XTDHTXT("Parent Surname");
	XTDHTXT("Paid");
	XTDHTXT("Update");
	X_TR();
	X_THEAD();
	XTBODY();
	foreach ( Get_Array('person') as $person_id) {
		Get_Data( 'person', $person_id );
		if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $tsectiongroup) ) {
			XTRJQDT();
			XTDTXT($GLOBALS{'person_fname'});
			XTDTXT($GLOBALS{'person_sname'});
			XTDTXT(Age($GLOBALS{'person_dob'},19));
			XTDTXT($GLOBALS{'person_medicaldetails'});
			XTDTXT($GLOBALS{'person_emergencytel'});
			XTDTXT($GLOBALS{'person_photographyconsent'});
			XTDTXT($GLOBALS{'person_transportconsent'});
			XTDTXT($GLOBALS{'person_parentfname'});
			XTDTXT($GLOBALS{'person_parentsname'});
			if ($GLOBALS{'person_paiddate'} == "0000-00-00") {$GLOBALS{'person_paiddate'} = "";}
			if ($GLOBALS{'person_paidconfirmationdate'} == "0000-00-00") {$GLOBALS{'person_paidconfirmationdate'} = "";}
			if ($GLOBALS{'person_paiddate'} != "") {
				if ( $GLOBALS{'person_paidperiodid'} == $GLOBALS{'currperiodid'} ) {
					if ( $GLOBALS{'person_paidconfirmationperiodid'} == $GLOBALS{'currperiodid'}) {
						XTDTXTGREEN($GLOBALS{'person_paiddate'});
					} else {
						XTDTXTAMBER($GLOBALS{'person_paiddate'});
					}
				} else {
					XTDTXTRED($GLOBALS{'person_paiddate'});
				}
			} else {
				XTDTXT('');
			}
			$link = YPGMLINK("personCHANGEpopupout.php").YPGMSTDPARMS().YPGMPARM("ActionPersonId",$person_id);
			XTDLINKTXTNEWPOPUP($link,"update","updateperson","center","center","800","800");
			X_TR();
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV($tsectiongroup."_tablecontainer");
}


function Person_MYGROUPEMAILSMS_Output ($season, $sectiongroup_code) {
	Get_Data('sectiongroup', $season, $sectiongroup_code);
	XH1("Group Communication - ".$GLOBALS{'sectiongroup_name'});
	$helplink = "ResultsMaster/Mass_Result/mass_result"; Help_Link;

	$sectiongrouplist = ""; $sep = "";
	foreach ( Get_Array('person') as $person_id) {
		Get_Data( 'person', $person_id );
		if ( $GLOBALS{'person_sectiongroup'} == $sectiongroup_code ) { $sectiongrouplist = $sectiongrouplist.$sep.$person_id; $sep = ",";}
	}
	if ($sectiongrouplist != "") {
		$groupa = explode(',',$sectiongrouplist);
		$sortarray = Array();
		foreach ($groupa as $personid)  {
			Check_Data('person',$personid);
			if ($GLOBALS{'IOWARNING'} == "0") {
				$record =  "1"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
				array_push($sortarray, $record);
			}
		}

		if ($GLOBALS{'sectiongroup_coach'} != "") {
			$splitstra = List2Array($GLOBALS{'sectiongroup_coach'});
			foreach ($splitstra as $personid)  {
				Check_Data('person',$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					$record =  "0"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
					array_unshift($sortarray, $record);
				}
			}
		}
		if ($GLOBALS{'sectiongroup_mgr'} != "") {
			$splitstra = List2Array($GLOBALS{'sectiongroup_mgr'});
			foreach ($splitstra as $personid)  {
				Check_Data('person',$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
					$record =  "0"."|".$GLOBALS{'person_sname'}."|".$GLOBALS{'person_fname'}."|".$personid;
					array_unshift($sortarray, $record);
				}
			}
		}


		sort($sortarray);

		XFORM("persongroupemailsmsin.php","ConfirmActionForm");
		XINSTDHID();
		XINHID("sectiongroup_code",$sectiongroup_code);
		XINHID("ConfirmActionText","This will generate SMS and EMails. Do you wish to continue");
		XINHID("ConfirmActionStatus","No");
		XBR();
		XHR();
		XH2("Step 1 : Compose Messages");
		XPTXT("Enter either an SMS Text Message or an Email Message - or Both");
		XH3("SMS Message");
		XTABLE();XTR();
		XTDTXTWIDTH("Max 160 Characters","100");
		XTDINTEXTAREA("SMSMessage","","2","80");
		X_TR();X_TABLE();
		XH3("Email Message");
		XTABLE();XTR();
		XTDTXTWIDTH("Subject","100");XTDINTXT("EmailSubject","","100","80");
		X_TR();XTR();
		XTDTXTWIDTH("Message","100");XTDINTEXTAREA("EmailMessage","","10","80");
		X_TR();X_TABLE();
		XBR();
		XHR();
		XH2("Step2: Select Distribution");
		XTABLE();
		XTR();XTDHTXT("Id");XTDHTXT("First Name");XTDHTXT("Surname");XTDHTXT("Email");XTDHTXT("Mobile");XTDHTXT("Send To");X_TR();

		$firstnonselected = "0";
		foreach ($sortarray as $record)  {
			$bitsa = explode('|',$record);
			if (($bitsa[0] == "1") && ($firstnonselected == "0")) {
				$firstnonselected = "1";
				XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
			}
			$personid = $bitsa[3];
			Get_Data('person',$personid);
			XTR();XTDTXT($personid);XTDTXT($GLOBALS{'person_fname'});XTDTXT($GLOBALS{'person_sname'});
			if (ValidEmail(Chosen_Person_Email())) { XTDTXT(Chosen_Person_Email()); }
			else { XTDTXTRED(Chosen_Person_Email()); }
			if (ValidMobile(Chosen_Person_SMS())) { XTDTXT(Chosen_Person_SMS()); }
			else { XTDTXTRED(Chosen_Person_SMS()); }
			XTDINCHECKBOXYESNO('sendto_'.$personid,"Yes","");
			X_TR();
		}
		X_TABLE();
		XBR();XBR();
		XINCHECKBOXCONFIRMACTION("Test","No","Preview Mode - Allows Email/SMS messages to be checked before sending");XBR();
		XBR();
		XINSUBMITID("ConfirmActionSubmit","Send out Emails/SMSs");
		X_FORM();
	} else {
		XH2("No group members exist.");
	}
}

function Person_SECTIONGROUPREGISTER_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,jqdatatablesfixedcolumns,datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,globalroutines,ioroutines,viewaspopup,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,jqdatatablesfixedcolumnsmin,sectiongroupregister";

	// $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables,datepicker";
	// $GLOBALS{'SITEJSOPTIONAL'} = "jquerymin,jqueryuimin,globalroutines,ioroutines,viewaspopup,bootstrapdatepicker,datepickerYYYYMMDD,jqdatatablesmin,sectiongroupregister";
}

function Person_SECTIONGROUPREGISTERF_Output ($sectiongroupcode) {
	Get_Data('sectiongroup', $GLOBALS{'currperiodid'}, $sectiongroupcode);
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	XH2("Group Register - ".$GLOBALS{'sectiongroup_name'});

	XHR();XH3("Create New Session");
	XFORM("persongroupregisterin.php","newsession");
	XINSTDHID();
	XINHID("SectionGroup",$sectiongroupcode);
	XINHID("Action","NewSession");
	XTABLE();
	// XTR();XTDHTXT("Create New Session");XTDHTXT("");X_TR();
	XTR();XTDTXT("date - dd/mm/yyyy");XTDINDATEYYYY_MM_DD("SessionDate","");X_TR();
	XTR();XTDTXT("");XTD();XINSUBMITID("NewSessionSubmit","Create New Session Register");X_TD();X_TR();
	X_TABLE();
	X_FORM();
	XHR();
	XH3("Update Register");
	XPTXTCOLOR("Don't forget to press the update button when you have finished to sabve your updates.","green");
	XFORM("persongroupregisterin.php","update Register");
	XINSTDHID();
	XINHID("SectionGroup",$sectiongroupcode);
	XINHID("Action","UpdateRegister");
	XDIV($tsectiongroup."_tablecontainer","container");
	XTABLEJQDTID("sectiongroupregistertable_".$tsectiongroup);
	XTHEAD();
	XTRJQDT();
	XTDHTXT("First Name");
	XTDHTXT("Surname");
	XTDHTXT("Age");

	$sessiondatea = GetRegisterListDates("sectiongroup_register");
	foreach ( $sessiondatea as $sessiondate) {
		XTDHTXT(YYYY_MM_DDtoDDbMMMbYY($sessiondate));
	}
	X_TR();
	X_THEAD();
	XTBODY();
	foreach ( Get_Array('person') as $person_id) {
		Get_Data( 'person', $person_id );
		if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $sectiongroupcode) ) {
			XTRJQDT();
			XTDTXT($GLOBALS{'person_fname'});
			XTDTXT($GLOBALS{'person_sname'});
			XTDTXT(Age($GLOBALS{'person_dob'},19));
			foreach ( $sessiondatea as $sessiondate) {
				XTD();XINCHECKBOXYNID($sessiondate."_".$person_id,$sessiondate."_".$person_id,"","");
			}
		}
	}
	X_TBODY();
	X_TABLE();
	X_DIV($tsectiongroup."_tablecontainer");
	XBR();XINSUBMITID("UpdateRegisterSubmit","Update Register");
	X_FORM();
	XHR();XH3("Print Register");
	XFORM("persongroupregisterprint.php","Print");
	XINHID("SectionGroup",$sectiongroupcode);
	XINHID("Action","PrintRegister");
	XINSUBMITID("NewSessionSubmit","Print");
	X_TABLE();
	X_FORM();

}

function Person_SECTIONGROUPREGISTERM_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,jqdatatablesmin,report";
}

function Person_SECTIONGROUPREGISTERM_Output ($sectiongroupcode) {
	Get_Data('sectiongroup', $GLOBALS{'currperiodid'}, $sectiongroupcode);
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	XH3($GLOBALS{'sectiongroup_name'});
	XH3(YYYY_MM_DDtoDDDbDDbMMMbYYYY($GLOBALS{'currentYYYY-MM-DD'}));

	$sessiondate = $GLOBALS{'currentYYYY-MM-DD'};
	XFORM("persongroupregisterin.php","update Register");
	XINSTDHID();
	XINHID("SectionGroup",$sectiongroupcode);
	XINHID("Action","UpdateRegister");

	XDIV("reportdiv","container");
	XTABLEJQDTID("reporttable_list");
	XTHEAD();
	XTRJQDT();
	XTDHTXT("Name");
	XTDHTXT("Age");
	XTDHTXT("");
	XTDHTXT("");
	X_TR();
    X_THEAD();
    XTBODY();

    foreach ( Get_Array('person') as $person_id) {
        Get_Data( 'person', $person_id );
        if ( MatchLists ($GLOBALS{'person_sectiongroup'}, $sectiongroupcode) ) {
            XTRJQDT();
            $link = YPGMLINK("persongroupregistermdetailout.php").YPGMSTDPARMS().YPGMPARM("RegisternPersonId",$person_id);
            XTDLINKTXTNEWWINDOW ($link,$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'},"PersonRegisterMDetails");
            XTDTXT(Age($GLOBALS{'person_dob'},19));
            // BCOL("1");XINCHECKBOXYNID($sessiondate."_".$person_id,$sessiondate."_".$person_id,"","");B_COL();
            $currentattendedstatus = GetRegisterList ("sectiongroup_register",$GLOBALS{'currentYYYY-MM-DD'},$person_id,"attended");
            XTDTXT($currentattendedstatus);
            XTD();XINCHECKBOXYNID($sessiondate."_".$person_id,$sessiondate."_".$person_id, $currentattendedstatus , "");X_TD();
            X_TR();
        }
    }

    X_TBODY();
    X_TABLE();
    X_DIV("reportdiv");



	XBR();XINSUBMITID("UpdateRegisterSubmit","Update Register");
	X_FORM();
}

function UpdateRegisterList($listfieldname,$sessiondate,$personid,$parametername,$parametervalue) {
	#�XH5($listfieldname." ".$personid." ".$parametername." ".$parametervalue);
	XH5("INPUT = ".$GLOBALS{$listfieldname});
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	$list = $GLOBALS{$listfieldname};
	$listdh = Array();
	$listph = Array();
	#�XH5('existinglist '.$list);
	if ($list != "") {
		$listda = explode('^',$list);
		foreach ($listda as $listdelement) {
			if ($listdelement != "") {
				$listdbits = explode('|',$listdelement);
				$listdh[$listdbits[0]] = $listdelement;
			}
		}
	}
	$updatedlist = ""; $dsep = "";
	foreach ($listdh as $dkey => $dvalue) {
		if ( $dkey == $sessiondate) {
			unset($listph); $listph = array();
			$listpa = explode('|',$listdh[$sessiondate]);
			foreach ($listpa as $listpelement) {
				if ($listpelement != "") {
					$listpbits = explode(',',$listpelement);
					$listph[$listpbits[0]] = $listpelement;
				}
			}
			if (array_key_exists($personid, $listph)) {
				$listpbits = explode(',',$listph[$personid]);
				$uattendedcode = $listpbits[1];
				$upaidcode = $listpbits[2];
			} else {
				$uattendedcode = "";
				$upaidcode = "";
			}
			if ( $parametername == "attended" ) { $uattendedcode = $parametervalue; }
			if ( $parametername == "paid" ) { $upaidcode = $parametervalue; }
			$listph[$personid] = $personid.",".$uattendedcode.",".$upaidcode;

			$updatedlistdelta = $sessiondate; $psep = "";
			foreach ($listph as $pkey => $pvalue) {
				$updatedlistdelta = $updatedlistdelta.$psep.$pvalue; $psep = "|";
			}
			$updatedlist = $updatedlist.$dsep.$updatedlistdelta; $dsep = "^";
		} else {
			$updatedlist = $updatedlist.$dsep.$dvalue; $dsep = "^";
		}
	}
	XH5("OUTPUT = ".$updatedlist);
	// $GLOBALS{$listfieldname} = $updatedlist;
}


function GetRegisterList ($listfieldname,$sessiondate,$personid,$parametername) {
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	$parametervalue	= "";
	if ($GLOBALS{$listfieldname} != "") {
		$listda = explode('^',$GLOBALS{$listfieldname});
		foreach ($listda as $listdelement) {
			if ($listdelement != "") {
				$listdbits = explode('|',$listdelement);
				if ($listdbits[0] == $sessiondate) {
					$listpa = explode('|',$listdelement);
					foreach ($listpa as $listpelement) {
						if ($listpelement != "") {
							$listpbits = explode('|',$listpelement);
							if ($listpbits[0] == $personid) {
								$listpbits = explode(',',$listpelement);
								if ( $parametername == "attended" ) { $parametervalue = $listpbits[1]; }
								if ( $parametername == "paid" ) { $parametervalue = $listpbits[2]; }
							}
						}
					}
				}
			}
		}
	}
	return $parametervalue;
}

function GetRegisterListDates ($listfieldname) {
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	$sessiondatea	= Array();
	if ($GLOBALS{$listfieldname} != "") {
		$listda = explode('^',$GLOBALS{$listfieldname});
		foreach ($listda as $listdelement) {
			if ($listdelement != "") {
				$listdbits = explode('|',$listdelement);
				array_push($sessiondatea, $listdbits[0]) ;
			}
		}
	}
	sort($sessiondatea);
	return $sessiondatea;
}

function DeleteFromRegisterList($listfieldname,$sessiondate,$personid) {
	#�XH5($listfieldname." ".$personid." ".$parametername." ".$parametervalue);
	#�XH5("INPUT = ".$GLOBALS{$listfieldname});
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	$list = $GLOBALS{$listfieldname};
	$listdh = Array();
	$listph = Array();
	#�XH5('existinglist '.$list);
	if ($list != "") {
		$listda = explode('^',$list);
		foreach ($listda as $listdelement) {
			if ($listdelement != "") {
				$listdbits = explode('|',$listdelement);
				$listdh[$listdbits[0]] = $listdelement;
			}
		}
	}
	$updatedlist = ""; $dsep = "";
	foreach ($listdh as $dkey => $dvalue) {
		if ( $dkey == $sessiondate) {
			unset($listph); $listph = array();
			$listpa = explode('|',$listdh[$sessiondate]);
			foreach ($listpa as $listpelement) {
				if ($listpelement != "") {
					$listpbits = explode(',',$listpelement);
					$listph[$listpbits[0]] = $listpelement;
				}
			}
			$updatedlistdelta = $sessiondate; $psep = "";
			foreach ($listph as $pkey => $pvalue) {
				if ( $pkey != $personid ) {
					$updatedlistdelta = $updatedlistdelta.$psep.$pvalue; $psep = "|";
				}
			}
			$updatedlist = $updatedlist.$dsep.$updatedlistdelta; $dsep = "^";
		} else {
			$updatedlist = $updatedlist.$dsep.$dvalue; $dsep = "^";
		}
	}
	# XH5("OUTPUT = ".$updatedlist);
	$GLOBALS{$listfieldname} = $updatedlist;
}

function AddSessionToRegisterList($listfieldname,$sessiondate) {
	XH5($listfieldname." ".$sessiondate);
	XH5("INPUT = ".$GLOBALS{$listfieldname});
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	$list = $GLOBALS{$listfieldname};
	$listdh = Array();
	$listph = Array();
	#�XH5('existinglist '.$list);
	if ($list != "") {
		$listda = explode('^',$list);
		foreach ($listda as $listdelement) {
			XH5("PPP".$listdelement);
			if ($listdelement != "") {
				$listdbits = explode('|',$listdelement);
				$listdh[$listdbits[0]] = $listdelement;
			}
		}
	}
	$foundsessiondate = "0";
	$updatedlist = ""; $dsep = "";
	foreach ($listdh as $dkey => $dvalue) {
		if ( $dkey == $sessiondate) {
			XH5("QQQ-".$dkey);
			$foundsessiondate = "1";
		} else {
			XH5("RRR-".$dkey);
			$updatedlist = $updatedlist.$dsep.$dvalue; $dsep = "^";
		}
	}
	if ( $foundsessiondate == "0" ) {
		$updatedlist = $updatedlist.$dsep.$sessiondate."|"; $dsep = "^";
	}

	XH5("OUTPUT = ".$updatedlist);
	$GLOBALS{$listfieldname} = $updatedlist;
}


function DeleteSessionFromRegisterList($listfieldname,$sessiondate) {
	#�XH5($listfieldname." ".$sessiondate);
	#�XH5("INPUT = ".$GLOBALS{$listfieldname});
	// format  date|personid,attended,paid|personid,attended,paid^date|personid,attended,paid|personid,attended,paid
	$list = $GLOBALS{$listfieldname};
	$listdh = Array();
	$listph = Array();
	#�XH5('existinglist '.$list);
	if ($list != "") {
		$listda = explode('^',$list);
		foreach ($listda as $listdelement) {
			if ($listdelement != "") {
				$listdbits = explode('|',$listdelement);
				$listdh[$listdbits[0]] = $listdelement;
			}
		}
	}
	$updatedlist = ""; $dsep = "";
	foreach ($listdh as $dkey => $dvalue) {
		if ( $dkey != $sessiondate) {
			$updatedlist = $updatedlist.$dsep.$dvalue; $dsep = "^";
		}
	}
	# XH5("OUTPUT = ".$updatedlist);
	$GLOBALS{$listfieldname} = $updatedlist;
}


function Person_MYAVAILABILITY_CSSJS () {
$GLOBALS{'SITEJSOPTIONAL'} = "frsavailability";
$GLOBALS{'SITECSSOPTIONAL'} = "frsavailability";
}

function Person_MYAVAILABILITY_Output ($personid) {
	Frs_Availability_Output($GLOBALS{'currperiodid'}, $personid, "full");
}

function Person_MYSTATS_CSSJS () {
    $GLOBALS{'SITECSSOPTIONAL'} = "jqdatatables";
    $GLOBALS{'SITEJSOPTIONAL'} = "jqdatatablesmin,report";
}

function Person_MYSTATS_Output ($personid) {
    XH2("My Stats");
    XPTXT("Check out the results for all the teams you have played for this season.");
    XPTXT("Just click on the headings to sort the results into order.");
    Frs_Stats_Output($GLOBALS{'currperiodid'}, $personid, "full");
}

function Person_TEAMCHAT_CSSJS () {
	$GLOBALS{'SITEJSOPTIONAL'} = "chatmessagepopup";
	$GLOBALS{'SITEPOPUPHTML'} = "ChatMessage_Popup";
}

function Person_TEAMCHAT_Output ( $remote, $chatviewerpersonid, $targetthreadset, $targetthreadid  ) {  // $threadset and threadid could be ""
	XBR();
	XTABLEINVISIBLE();XTR();
	XTD();XIMGWIDTH ($GLOBALS{'site_asseturl'}."/TEAMCHAT.png","60");XTD();
	XTD();XH2("Team Chat");XTD();
	X_TR();X_TABLE();
	XBR();
	XINHID("remote",$remote); // remote or loggedin
	XINHID("chatviewerpersonid",$chatviewerpersonid); // personid of viewer
	XINHID("target_threadset",$targetthreadset); // targetted threadset or "" to display first yab
	XINHID("target_threadid",$targetthreadid); // targetted threadid or "" for first threadid in threadset

	BTABHEADERCONTAINER();
	$first = "1";
	foreach (Person_TeamSquadMember_Array($chatviewerpersonid,"all") as $tteam_code) {
		Get_Data("team",$GLOBALS{'currperiodid'},$tteam_code);
		$chatmessage_threadset = "TM".$tteam_code;
		if ( $targetthreadset == "") {
			if ($first == "1") { BTABHEADERITEMACTIVE($chatmessage_threadset,$GLOBALS{'team_name'}."<br>Team"); $first = "0";	}
			else { BTABHEADERITEM($chatmessage_threadset,$GLOBALS{'team_name'}."<br>Team"); }
		} else {
			if ($targetthreadset == $chatmessage_threadset) { BTABHEADERITEMACTIVE($tteam_code,$GLOBALS{'team_name'}."<br>Team"); }
			else { BTABHEADERITEM($chatmessage_threadset,$GLOBALS{'team_name'}."<br>Team"); }
		}
	}
	foreach (Person_SectionGroupMember_Array($chatviewerpersonid,"all") as $tsectiongroup_code) {
		Get_Data("sectiongroup",$GLOBALS{'currperiodid'},$tsectiongroup_code);
		$chatmessage_threadset = "SG".$tsectiongroup_code;
		if ( $targetthreadset == "") {
			if ($first == "1") { BTABHEADERITEMACTIVE($chatmessage_threadset,$GLOBALS{'sectiongroup_name'}."<br>Group"); $first = "0"; }
			else { BTABHEADERITEM($chatmessage_threadset,$GLOBALS{'sectiongroup_name'}."<br>Group"); }
		} else {
			if ($targetthreadset == $chatmessage_threadset) { BTABHEADERITEMACTIVE($tsectiongroup_code,$GLOBALS{'sectiongroup_name'}."<br>Group");	}
			else { BTABHEADERITEM($chatmessage_threadset,$GLOBALS{'sectiongroup_name'}."<br>Group"); }
		}
	}

	B_TABHEADERCONTAINER();
	BTABCONTENTCONTAINER();
	$first = "1";
	foreach (Person_TeamSquadMember_Array($chatviewerpersonid,"all") as $tteam_code) {
		Get_Data("team",$GLOBALS{'currperiodid'},$tteam_code);
		$chatmessage_threadset = "TM".$tteam_code;
		if ( $targetthreadset == "") {
			if ($first == "1") { BTABCONTENTITEMACTIVE($chatmessage_threadset); $first = "0";	}
			else { BTABCONTENTITEM($chatmessage_threadset); }
		} else {
			if ($targetthreadset == $chatmessage_threadset) { BTABCONTENTITEMACTIVE($chatmessage_threadset); }
			else { BTABCONTENTITEM($chatmessage_threadset); }
		}
		if ( $GLOBALS{'team_photo'} != "" ) {
			XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'team_photo'},"100%");XBR();XBR();
		}
		XH3("Team Chat for ".$GLOBALS{'team_name'});
		ChatMessagesDisplay ($chatmessage_threadset);
		B_TABCONTENTITEM();
	}
	foreach (Person_SectionGroupMember_Array($chatviewerpersonid,"all") as $tsectiongroup_code) {
		Get_Data("sectiongroup",$GLOBALS{'currperiodid'},$tsectiongroup_code);
		$chatmessage_threadset = "SG".$tsectiongroup_code;
		if ( $targetthreadset == "") {
			if ($first == "1") { BTABCONTENTITEMACTIVE($chatmessage_threadset); $first = "0";	}
			else { BTABCONTENTITEM($chatmessage_threadset); }
		} else {
			if ($targetthreadset == $chatmessage_threadset) { BTABCONTENTITEMACTIVE($chatmessage_threadset); }
			else { BTABCONTENTITEM($chatmessage_threadset); }
		}
		/*
		if ( $GLOBALS{'sectiongroup_photo'} != "" ) {
			XIMGWIDTH($GLOBALS{'domainwwwurl'}."/domain_media/".$GLOBALS{'sectiongroup_photo'},"100%");XBR();XBR();
		}
		*/
		XH3("Team Chat for ".$GLOBALS{'sectiongroup_name'});
		ChatMessagesDisplay ($chatmessage_threadset);
		B_TABCONTENTITEM();
	}
	B_TABCONTENTCONTAINER();
}

function ChatMessagesDisplay ($chatmessage_threadset) {

	XHR();
	XH3("Open up a <u>new</u> topic");
	XINBUTTONIDCLASS ("chatmessagebutton_".$chatmessage_threadset."_new", "chatbuttonnew", "Start a new conversation");
	XHR();
	XH3("Existing conversation topics");

	$chatmessagea = Get_Array('chatmessage',$chatmessage_threadset);
	$chatthreadcounterhash = Array();
	if (!$chatmessagea) {
		XPTXT("No teamchat messages posted so far - be the first !");
	} else {
		$selectedchatmessagea = Array();
		foreach ($chatmessagea as $chatmessage_timestamp) {
			Get_Data("chatmessage",$chatmessage_threadset,$chatmessage_timestamp);
			$thisyyyyhmmhdd = substr($chatmessage_timestamp, 0, 4).'-'.substr($chatmessage_timestamp, 4, 2).'-'.substr($chatmessage_timestamp, 6, 2);
			if (DaysDifference($GLOBALS{'currentYYYY-MM-DD'},$thisyyyyhmmhdd) < 366) {
				array_push($selectedchatmessagea, $GLOBALS{'chatmessage_threadid'}.'|'.$chatmessage_timestamp );
			}
			if ( array_key_exists ( $GLOBALS{'chatmessage_threadid'} , $chatthreadcounterhash )) {
				$chatthreadcounterhash[$GLOBALS{'chatmessage_threadid'}] = $chatthreadcounterhash[$GLOBALS{'chatmessage_threadid'}] +1;
			} else {
				$chatthreadcounterhash[$GLOBALS{'chatmessage_threadid'}] = 1;
			}
		}
		rsort($selectedchatmessagea);
		$oldchatmessage_threadid = "";
		$foundchatmessages = "0";
		foreach ($selectedchatmessagea as $message) {
			$foundchatmessages = "1";
			$bits = explode('|',$message);
			$chatmessage_threadid = $bits[0];
			$chatmessage_timestamp = $bits[1];
			Get_Data("chatmessage",$chatmessage_threadset,$chatmessage_timestamp);
			if ( $chatmessage_threadid != $oldchatmessage_threadid ) {
				if ( $oldchatmessage_threadid != "" ) {
					// finish previous accordion
					B_ACCORDPANELCONTENT();
					B_ACCORDPANEL();
					B_ACCORDDIV();
				}
				// start new accordion
				BACCORDDIV("Accordion_".$chatmessage_threadset."_".$chatmessage_threadid);
				BACCORDPANEL();
				BACCORDPANELHEADING();
				XDIV("","headingdivleft");
				XINHIDID("chatmessagethreadtitle_".$chatmessage_threadset."_".$chatmessage_threadid,"chatmessagethreadtitle_".$chatmessage_threadset."_".$chatmessage_threadid,$GLOBALS{'chatmessage_threadtitle'});
				if ($chatthreadcounterhash[$chatmessage_threadid] == 1) {
					$responsetext = " Message";
				}
				else { $responsetext = " Messages";
				}
				XTXT("Topic - ".$GLOBALS{'chatmessage_threadtitle'}." - ".$chatthreadcounterhash[$chatmessage_threadid].$responsetext);
				X_DIV("");
				XDIV("","headingdivright");
				// BACCORDPANELHEADINGA("Accordion_".$chatmessage_threadset."_".$chatmessage_threadid, "Content_".$chatmessage_threadset."_".$chatmessage_threadid);
				XINBUTTONIDCLASS ("chatmessagebutton_".$chatmessage_threadset."_".$chatmessage_threadid, "chatbutton", "Add your message");
				// B_ACCORDPANELHEADINGA();
				XINBUTTONIDCLASS ("chatopenclosebutton_".$chatmessage_threadset."_".$chatmessage_threadid, "chatopenclosebutton", "Join this conversation");
				X_DIV("");
				XCLEARFLOAT();
				B_ACCORDPANELHEADING();
				BACCORDPANELCONTENT("Content_".$chatmessage_threadset."_".$chatmessage_threadid);
			}
			// add message to accordion content

			Check_Data('person',$GLOBALS{'chatmessage_personid'});
			if ($GLOBALS{'IOWARNING'} == "0") {
				XDIV("","");
				XDIV("","contentdivleft");
				XIMGPERSON ( $GLOBALS{'chatmessage_personid'}, "50");
				X_DIV("");
				XDIV("","contentdivright");
				XPTXT($GLOBALS{'chatmessage_message'});
				XH5($GLOBALS{'person_fname'}.' '.$GLOBALS{'person_sname'}.' on '.TimestamptoDDthMMMhhmm($chatmessage_timestamp));
				X_DIV("");
				XCLEARFLOAT();
				X_DIV("");
				XHR();
			}
			$oldchatmessage_threadid = $chatmessage_threadid;
		}
		if ( $foundchatmessages == "1" ) {
			// finish last accordion
			B_ACCORDPANELCONTENT();
			B_ACCORDPANEL();
			B_ACCORDDIV();
		}
	}
}

function Chosen_Person_Email () {
    $temail = $GLOBALS{'person_email1'};
    if ($temail == "") { $temail = $GLOBALS{'person_email3'}; }
    if ($temail == "") { $temail = $GLOBALS{'person_email4'}; }
    if ($temail == "") { $temail = $GLOBALS{'person_email2'}; }
    return $temail;
}

function Chosen_Person_SMS () {
    $tsms = $GLOBALS{'person_mobiletel'};
    if (($tsms == "")||($tsms == " ")) { $tsms = $GLOBALS{'person_emergencytel'}; }
    if (($tsms == "")||($tsms == " ")) { $tsms = $GLOBALS{'person_emergencytel2'}; }
    return $tsms;
}

function Valid_Email ( $temail ) {
	$validemail = false;
	$emailblanks = explode(' ', $temail);
	$emailats = explode('@', $temail);
	if (($temail != "")&&(sizeof($emailblanks) == 1)&&(sizeof($emailats) == 2)) { $validemail = true; }
	return $validemail;
}

function Person_PERSONDBINTEGRITY_Output() {
	XH2("Person Database Integrity Review");
	$persondetailsarraywarnings = Array();
	$persondetailsarrayduplicates = Array();
	foreach ( Get_Array('person') as $person_id) {
		Get_Data( 'person', $person_id );
		$warningtext = "";
		if (($GLOBALS{'person_sname'} == "")||($GLOBALS{'person_fname'} == "")) {
			$warningtext = "No Firstname or Surname";
		}
		if ($GLOBALS{'person_addr1'} == "..........") {
			$warningtext = "Redacted Data";
		}
		if (($GLOBALS{'person_email1'} == "")&&($GLOBALS{'person_email3'} == "")&&($GLOBALS{'person_email4'} == "")) {
			$warningtext = "No Email";
		}
		if ($GLOBALS{'person_section'} == "") {
			$warningtext = "No Section";
		}
		if ($warningtext != "") {
			array_push($persondetailsarraywarnings, $warningtext."|".strtolower($GLOBALS{'person_sname'})."|".strtolower($GLOBALS{'person_fname'})."|".$GLOBALS{'person_id'}."|".strtolower($GLOBALS{'person_section'}) );
		}
		array_push($persondetailsarrayduplicates, ""."|".strtolower($GLOBALS{'person_sname'})."|".strtolower($GLOBALS{'person_fname'})."|".$GLOBALS{'person_id'}."|".strtolower($GLOBALS{'person_section'}) );
	}
	sort($persondetailsarrayduplicates);
	sort($persondetailsarraywarnings);

	$oldsname = "xxxxxx";
	$oldfname = "xxxxxx";
	$oldid = "xxxxxx";
	$oldsection = "xxxxxx";


	XH4("Duplicate Records");
	XTABLE();
	foreach ( $persondetailsarrayduplicates as $record ) {
		# XPTXT($record);
		$pbits = explode('|',$record);
		if (($pbits[1] == $oldsname)&&($pbits[1] != "")&&($pbits[2] == $oldfname)&&($pbits[2] != "")) {
			spacerrow();
			persondatarow("Duplicate Person 1",$oldsname,$oldfname,$oldid,$oldsection);
			persondatarow("Duplicate Person 2",$pbits[1],$pbits[2],$pbits[3],$pbits[4]);
			persondeduplicaterow($oldid,$pbits[3]);
		}
		$oldsname = $pbits[1];
		$oldfname = $pbits[2];
		$oldid = $pbits[3];
		$oldsection = $pbits[4];
	}
	X_TABLE();

	$oldwarningtext = "xxxxxx";

	XH4("Other warning messages");
	XTABLE();
	foreach ( $persondetailsarraywarnings as $record ) {
		# XPTXT($record);
		$pbits = explode('|',$record);
		if ($pbits[0] != "") {
			spacerrow();
			persondatarow($pbits[0],$pbits[1],$pbits[2],$pbits[3],$pbits[4]);
		}
	}
	X_TABLE();
}

function spacerrow() {
	XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
}

function persondatarow($reason,$sname,$fname,$id,$section) {
	XTR();XTDTXT($reason);XTDTXT($sname);XTDTXT($fname);XTDTXT($id);XTDTXT($section);
	$link = YPGMLINK("personCHANGEpopupout.php").YPGMSTDPARMS().YPGMPARM("ActionPersonId",$id);
	XTDLINKTXTNEWPOPUP($link,"View/Update",$reason,"center","center","800","800");
	$link = YPGMLINK("personDELETEin.php").YPGMSTDPARMS().YPGMPARM("ActionPersonId",$id);
	XTDLINKTXTNEWPOPUP($link,"Delete",$reason,"center","center","800","800");
}

function persondeduplicaterow($personid1,$personid2) {
	XTR();XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");XTDTXT("");
	$link = YPGMLINK("personDEDUPLICATEpopupout.php").YPGMSTDPARMS().YPGMPARM("ActionPersonId1",$personid1).YPGMPARM("ActionPersonId2",$personid2);
	XTDLINKTXTNEWPOPUP($link,"<b>De-Duplicate</b>","De-Duplicate","center","center","800","800");
	XTDTXT("");
}

function Person_DEDUPLICATE_CSSJS () {
	$GLOBALS{'SITECSSOPTIONAL'} = "datepicker";
	$GLOBALS{'SITEJSOPTIONAL'} = "globalroutines,ioroutines,bootstrapdatepicker,datepickerYYYYMMDD";
}

function Person_DEDUPLICATE_Output($personid1,$personid2) {

Get_Data('person', $personid1);
$person_lastupdate1 = $GLOBALS{'person_lastupdate'};
$person_title1 = $GLOBALS{'person_title'};
$person_fname1 = $GLOBALS{'person_fname'};
$person_sname1 = $GLOBALS{'person_sname'};
$person_addr11 = $GLOBALS{'person_addr1'};
$person_addr21 = $GLOBALS{'person_addr2'};
$person_addr31 = $GLOBALS{'person_addr3'};
$person_addr41 = $GLOBALS{'person_addr4'};
$person_postcode1 = $GLOBALS{'person_postcode'};
$person_hometel1 = $GLOBALS{'person_hometel'};
$person_worktel1 = $GLOBALS{'person_worktel'};
$person_mobiletel1 = $GLOBALS{'person_mobiletel'};
$person_faxtel1 = $GLOBALS{'person_faxtel'};
$person_email11 = $GLOBALS{'person_email1'};
$person_email21 = $GLOBALS{'person_email2'};
$person_dob1 = $GLOBALS{'person_dob'};
$person_parenttitle1 = $GLOBALS{'person_parenttitle'};
$person_parentfname1 = $GLOBALS{'person_parentfname'};
$person_parentsname1 = $GLOBALS{'person_parentsname'};
$person_email31 = $GLOBALS{'person_email3'};
$person_email41 = $GLOBALS{'person_email4'};
$person_section1 = $GLOBALS{'person_section'};
$person_sectiongroup1 = $GLOBALS{'person_sectiongroup'};
$person_type1 = $GLOBALS{'person_type'};
$person_paiddate1 = $GLOBALS{'person_paiddate'};
$person_paidperiodid1 = $GLOBALS{'person_paidperiodid'};
$qualificationstring1 = "";
$qualificationa = Get_Array('personqualification',$personid1);
foreach ($qualificationa as $qualification_id) {
	$qualificationstring1 = $qualificationstring1.$qualification_id."</br>";
}
$jobrolestring1 = "";
$jobrolea = Get_Array('personjobrole',$personid1);
foreach ($jobrolea as $jobrole_id) {
	$jobrolestring1 = $jobrolestring1.$jobrole_id."</br>";
}

Get_Data('person', $personid2);
$person_lastupdate2 = $GLOBALS{'person_lastupdate'};
$person_title2 = $GLOBALS{'person_title'};
$person_fname2 = $GLOBALS{'person_fname'};
$person_sname2 = $GLOBALS{'person_sname'};
$person_addr12 = $GLOBALS{'person_addr1'};
$person_addr22 = $GLOBALS{'person_addr2'};
$person_addr32 = $GLOBALS{'person_addr3'};
$person_addr42 = $GLOBALS{'person_addr4'};
$person_postcode2 = $GLOBALS{'person_postcode'};
$person_hometel2 = $GLOBALS{'person_hometel'};
$person_worktel2 = $GLOBALS{'person_worktel'};
$person_mobiletel2 = $GLOBALS{'person_mobiletel'};
$person_faxtel2 = $GLOBALS{'person_faxtel'};
$person_email12 = $GLOBALS{'person_email1'};
$person_email22 = $GLOBALS{'person_email2'};
$person_dob2 = $GLOBALS{'person_dob'};
$person_parenttitle2 = $GLOBALS{'person_parenttitle'};
$person_parentfname2 = $GLOBALS{'person_parentfname'};
$person_parentsname2 = $GLOBALS{'person_parentsname'};
$person_email32 = $GLOBALS{'person_email3'};
$person_email42 = $GLOBALS{'person_email4'};
$person_section2 = $GLOBALS{'person_section'};
$person_sectiongroup2 = $GLOBALS{'person_sectiongroup'};
$person_type2 = $GLOBALS{'person_type'};
$person_paiddate2 = $GLOBALS{'person_paiddate'};
$person_paidperiodid2 = $GLOBALS{'person_paidperiodid'};
$qualificationstring2 = "";
$qualificationa = Get_Array('personqualification',$personid2);
foreach ($qualificationa as $qualification_id) {
	$qualificationstring2 = $qualificationstring2.$qualification_id."</br>";
}
$jobrolestring2 = "";
$jobrolea = Get_Array('personjobrole',$personid2);
foreach ($jobrolea as $jobrole_id) {
	$jobrolestring2 = $jobrolestring2.$jobrole_id."</br>";
}

XH2("De-Duplicate person records".$qualificationstring1);
XPTXT("This will merge the two records using the selected record as the master. (data for an element will only be merged from the non-master file if the master record information for that element is empty");
XPTXT("You may also delete the non master record at the same time if the delete box is ticked.");
XFORM("personDEDUPLICATEin.php","personDEDUPLICATE");
XINSTDHID();
XINHID("ActionPersonId1",$personid1);
XINHID("ActionPersonId2",$personid2);
XTABLE();
XTR();XTDHTXT("");XTDHTXT($personid1);XTDHTXT($personid2);X_TR();
XTR();XTDTXT("Last Updated");XTDTXT(formatlastupdate($person_lastupdate1));XTDTXT(formatlastupdate($person_lastupdate2));X_TR();
XTR();XTDTXT("Title");XTDTXT($person_title1);XTDTXT($person_title2);X_TR();
XTR();XTDTXT("First Name");XTDTXT($person_fname1);XTDTXT($person_fname2);X_TR();
XTR();XTDTXT("Surname");XTDTXT($person_sname1);XTDTXT($person_sname2);X_TR();
XTR();XTDTXT("Addr 1");XTDTXT($person_addr11);XTDTXT($person_addr12);X_TR();
XTR();XTDTXT("Addr 2");XTDTXT($person_addr21);XTDTXT($person_addr22);X_TR();
XTR();XTDTXT("Addr 3");XTDTXT($person_addr31);XTDTXT($person_addr32);X_TR();
XTR();XTDTXT("Addr 4");XTDTXT($person_addr41);XTDTXT($person_addr42);X_TR();
XTR();XTDTXT("Post Code");XTDTXT($person_postcode1);XTDTXT($person_postcode2);X_TR();
XTR();XTDTXT("Home Tel");XTDTXT($person_hometel1);XTDTXT($person_hometel2);X_TR();
XTR();XTDTXT("Work Tel");XTDTXT($person_worktel1);XTDTXT($person_worktel2);X_TR();
XTR();XTDTXT("Mobile Tel");XTDTXT($person_mobiletel1);XTDTXT($person_mobiletel2);X_TR();
// XTR();XTDTXT("Fax Tel");XTDTXT($person_faxtel1);XTDTXT($person_faxtel2);X_TR();
XTR();XTDTXT("Email 1");XTDTXT($person_email11);XTDTXT($person_email12);X_TR();
XTR();XTDTXT("Email 2");XTDTXT($person_email21);XTDTXT($person_email22);X_TR();
XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
XTR();XTDTXT("DOB");XTDTXT($person_dob1);XTDTXT($person_dob2);X_TR();
XTR();XTDTXT("Parent Title");XTDTXT($person_parenttitle1);XTDTXT($person_parenttitle2);X_TR();
XTR();XTDTXT("Parent First Name");XTDTXT($person_parentfname1);XTDTXT($person_parentfname2);X_TR();
XTR();XTDTXT("Parent Surname");XTDTXT($person_parentsname1);XTDTXT($person_parentsname2);X_TR();
XTR();XTDTXT("Parent Email");XTDTXT($person_email31);XTDTXT($person_email32);X_TR();
XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
XTR();XTDTXT("Section");XTDTXT($person_section1);XTDTXT($person_section2);X_TR();
XTR();XTDTXT("Group");XTDTXT($person_sectiongroup1);XTDTXT($person_sectiongroup2);X_TR();
XTR();XTDTXT("Membership Type");XTDTXT($person_type1);XTDTXT($person_type2);X_TR();
XTR();XTDTXT("Paid Season");XTDTXT($person_paidperiodid1);XTDTXT($person_paidperiodid2);X_TR();
XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();

#====== qualifications and job roles ========================
XTR();XTDTXT("Qualifications");XTDTXT($qualificationstring1);XTDTXT($qualificationstring2);X_TR();
XTR();XTDTXT("Job Roles");XTDTXT($jobrolestring1);XTDTXT($jobrolestring2);X_TR();
XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();

#====== sections, teams and frs stats ========================
$sectionauthority1 = ""; $sectionauthority2 = "";
$teamauthority1 = ""; $teamauthority2 = "";
$teamsquad1 = ""; $teamsquad2 = "";
$personfrsstats1 = ""; $personfrsstats2 = "";
foreach (Get_Array("section",$GLOBALS{'currperiodid'}) as $section_name) {
	Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
	if (checkpersoninlist($personid1,$GLOBALS{'section_leader'})) { $sectionauthority1 =$sectionauthority1.$section_name."-Leader,"; }
	if (checkpersoninlist($personid1,$GLOBALS{'section_personmgrs'})) { $sectionauthority1 =$sectionauthority1.$section_name."-PersonMgr,"; }
	if (checkpersoninlist($personid2,$GLOBALS{'section_leader'})) { $sectionauthority2 =$sectionauthority2.$section_name."-Leader,"; }
	if (checkpersoninlist($personid2,$GLOBALS{'section_personmgrs'})) { $sectionauthority2 =$sectionauthority2.$section_name."-PersonMgr,"; }
	if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) {
		if (checkpersoninlist($personid1,$GLOBALS{'section_resmgrs'})) { $sectionauthority1 =$sectionauthority1.$section_name."-ResMgr,"; }
		if (checkpersoninlist($personid2,$GLOBALS{'section_resmgrs'})) { $sectionauthority2 =$sectionauthority2.$section_name."-ResMgr,"; }
		$teama = &List2Array($GLOBALS{'section_teams'});
		foreach ($teama as $teamcode) {
			Check_Data("team",$GLOBALS{'currperiodid'},$teamcode);
			if ($GLOBALS{'IOWARNING'} == "0") {
				if (checkpersoninlist($personid1,$GLOBALS{'team_captain'})) { $teamauthority1 =$teamauthority1.$teamcode."-Captain,"; }
				if (checkpersoninlist($personid1,$GLOBALS{'team_resmgrs'})) { $teamauthority1 =$teamauthority1.$teamcode."-ResMgr,"; }
				if (checkpersoninlist($personid1,$GLOBALS{'team_mgr'})) { $teamauthority1 =$teamauthority1.$teamcode."-Manager,"; }
				if (checkpersoninlist($personid1,$GLOBALS{'team_coach'})) { $teamauthority1 =$teamauthority1.$teamcode."-Coach,"; }
				if (checkpersoninlist($personid1,$GLOBALS{'team_helpers'})) { $teamauthority1 =$teamauthority1.$teamcode."-Helper,"; }
				if (checkpersoninlist($personid1,$GLOBALS{'team_squadlist'})) { $teamsquad1 = $teamsquad1.$teamcode.","; }
				if (checkpersoninlist($personid2,$GLOBALS{'team_captain'})) { $teamauthority2 =$teamauthority2.$teamcode."-Captain,"; }
				if (checkpersoninlist($personid2,$GLOBALS{'team_resmgrs'})) { $teamauthority2 =$teamauthority2.$teamcode."-ResMgr,"; }
				if (checkpersoninlist($personid2,$GLOBALS{'team_mgr'})) { $teamauthority2 =$teamauthority2.$teamcode."-Manager,"; }
				if (checkpersoninlist($personid2,$GLOBALS{'team_coach'})) { $teamauthority2 =$teamauthority2.$teamcode."-Coach,"; }
				if (checkpersoninlist($personid2,$GLOBALS{'team_helpers'})) { $teamauthority2 =$teamauthority2.$teamcode."-Helper,"; }
				if (checkpersoninlist($personid2,$GLOBALS{'team_squadlist'})) { $teamsquad2 = $teamsquad2.$teamcode.","; }
				$frsa = Get_Array('frs',$GLOBALS{'currperiodid'},$teamcode);
				foreach ($frsa as $frsid) {
					Get_Data('frs',$GLOBALS{'currperiodid'},$teamcode,$frsid);
					#  XPTXT("FRSID ".$frsid." ".$GLOBALS{'frs_statslist'});
					if ($GLOBALS{'frs_statslist'} != "") {
						$statsa = explode('|',$GLOBALS{'frs_statslist'});
						foreach ($statsa as $stat) {
							# bbra,G,2
							$statbits = explode(',',$stat);
							if ($statbits[0] == $personid1) { $personfrsstats1 = $personfrsstats1.$teamcode.","; }
							if ($statbits[0] == $personid2) { $personfrsstats2 = $personfrsstats2.$teamcode.","; }
						}
					}
				}
			}
		}
	}
}
XTR();XTDTXT("Section Authority");XTDTXT($sectionauthority1);XTDTXT($sectionauthority2);X_TR();
if (strlen(strstr($GLOBALS{'LOGIN_service_id'},"ocz"))>0) {
	XTR();XTDTXT("Team Authority");XTDTXT($teamauthority1);XTDTXT($teamauthority2);X_TR();
	XTR();XTDTXT("Team Squad");XTDTXT($teamsquad1);XTDTXT($teamsquad2);X_TR();
	XTR();XTDTXT("Match Stats");XTDTXT($personfrsstats1);XTDTXT($personfrsstats2);X_TR();
}
XTR();XTDHTXT("");XTDHTXT("");XTDHTXT("");X_TR();
X_TABLE();
XH3("");

XTABLE();
XTR();XTDTXT("Use as Master Record");XTDINRADIO("Master",$personid1,"","");XTDINRADIO("Master",$personid2,"","");X_TR();
XTR();XTDTXT("Delete Record");XTDINCHECKBOX("Delete",$personid1,"","");XTDINCHECKBOX("Delete",$personid2,"","");X_TR();
XTR();XTDTXT("Send email for login details");XTDTXT("");XTDINCHECKBOX("SendEmail","Yes","","");X_TR();
XTR();XTDTXT("Complete");XTDTXT("");XTDINSUBMIT("Go");X_TR();
X_TABLE();
X_FORM();

}

function formatlastupdate($instring) {
	if ($instring == "") {
		return "";
	} else {
		if (strpos($instring,'-') !== false) {
			$in = explode('-',$instring);
			$ina = str_split($in[0]."                   ");
			return $ina[4].$ina[5]."/".$ina[2].$ina[3]."/".$ina[0].$ina[1]." ".$ina[6].$ina[7].":".$ina[8].$ina[9].":".$ina[10].$ina[11]." - ".$in[1];
		} else {
			return "";
		}
	}
}

function checkpersoninlist($tpersonid,$tliststring) {
	$tliststring = $tliststring.",";
	$tpersonid = $tpersonid.",";
	if (strpos($tliststring, $tpersonid) !== false) { return true; }
	else { return false; }
}

function replacepersoninlist($treplacepersonid,$tbypersonid,$tliststring) {
	$tliststring = $tliststring.",";
	$treplacepersonid = $treplacepersonid.",";
	$tbypersonid = $tbypersonid.",";
	$tliststring = str_replace($treplacepersonid, $tbypersonid, $tliststring);
	$tliststring = substr($tliststring, 0, -1); # remove trailing comma
	return $tliststring;
}

function checkreplacepersoninlist($message,$messagecode,$replacepersonid,$bypersonid,$fieldname) {
	if (checkpersoninlist($replacepersonid,$GLOBALS{$fieldname})) {
		XH2($message.$messagecode);
		XPTXT($GLOBALS{$fieldname}." - replace ".$replacepersonid." by ".$bypersonid);
		$GLOBALS{$fieldname} = replacepersoninlist($replacepersonid,$bypersonid,$GLOBALS{$fieldname});

		XPTXT($GLOBALS{$fieldname});
	}
}

function GetPersonEmail () {
  	$email = "";
  	if ( $GLOBALS{'person_email1'} != "") { $email = $GLOBALS{'person_email1'}; }
  	else {
	  	if ( $GLOBALS{'person_email3'} != "") { $email = $GLOBALS{'person_email3'}; }
	  	else { $email = $GLOBALS{'person_email2'}; }
  	}
  	$email = str_replace(" ", "", $email);
	return $email;
}

function Person_Contacts_Output () {
	XH3("EMail contacts");
	$helplink = "Person/Person_LINK_Output/person_link_output.html"; Help_Link;
	XTABLE();
	$sortstructure = Array();
	$tglobalsectionsarray = Get_Array_Hash_SortSelect("section",$GLOBALS{'currperiodid'},"section_seq","","");
	$orga = Get_Array('org');
	foreach ( $orga as $org_code ) {
	 Get_Data("org",$org_code);
	 $section_seq = "";
	 for ($si = 0; $si <= sizeof($tglobalsectionsarray); $si++) {
	  if ($GLOBALS{'org_section'} == $tglobalsectionsarray[$si]){$section_seq = $si;}
	 }
	 $tseq1 = $GLOBALS{'org_sequence'}."0000";
	 $tseq2 = substr($tseq1, 0, 4);
	 $tsortstring = $section_seq."#".$GLOBALS{'org_section'}."#".$tseq2."#".$org_code;
	 array_push($sortstructure, $tsortstring);
	}
	sort($sortstructure);
	foreach ( $tglobalsectionsarray as $section_name ) {
	  Get_Data("section",$GLOBALS{'currperiodid'},$section_name);
	  if ($GLOBALS{'section_archive'} != "Yes") {
		 $rolepersonarray = Array();
		 foreach ( $sortstructure as $tsortstring ) {
		  $obits = explode ('#', $tsortstring);
		  $torg_section = $obits[1];
		  $org_code = $obits[3];
		  Get_Data("org",$org_code);
		  if ($torg_section == $section_name) {
			  array_push($rolepersonarray,$GLOBALS{'org_title'}."#".$GLOBALS{'org_personid'});
		  }
		 }
		 $tteamarray = explode(',', $GLOBALS{'section_teams'});
		 array_push($rolepersonarray,"-#-");
		 foreach ( $tteamarray as $team_code ) {
		  Check_Data("team",$GLOBALS{'currperiodid'},$team_code);
		  if ($GLOBALS{'IOWARNING'} == "0" ) {
			  $contactpersonid = $GLOBALS{'team_mgr'};
			  if ($contactpersonid == ""){$contactpersonid = $GLOBALS{'team_captain'};}
			  if ($contactpersonid == ""){$contactpersonid = $GLOBALS{'team_coach'};}
			  array_push($rolepersonarray,$GLOBALS{'team_name'}."#".$contactpersonid);
		 }
		 }

		 XTR();XTDHTXT("$section_name");XTD();
		 foreach ( $rolepersonarray as $astring ) {
		  $xbits = explode ('#', $astring);
		  if ($xbits[0] == "-") { XTXT("");XBR(); }
		  else { XTXT($xbits[0]);XBR();	}
		 }
		 X_TD();
		 XTD();
		 foreach ( $rolepersonarray as $astring ) {
		  $xbits = explode ('#', $astring);
		  if ($xbits[0] == "-") { XTXT("");XBR(); }
		  else {
			  $splitstra = explode(',', $xbits[1]);
			  $sep = "";
			  foreach ( $splitstra as $personid ) {
			  	Check_Data("person",$personid);
				if ($GLOBALS{'IOWARNING'} == "0") {
				 $link = YPGMLINK("personSEroleemailout.php");
				 $link = $link.YPGMMINPARMS().YPGMPARM("SendToRole",$xbits[0]).YPGMPARM("SendToId",$personid);
				 XTXT($sep);XLINKTXT($link,$GLOBALS{'person_fname'}." ".$GLOBALS{'person_sname'});$sep = " / ";
				} else {
				 XTXT("TBA");
				}
		     }
		     XBR();
		  }
		 }
		 X_TD();
		 X_TR();
	  }
	}
	X_TABLE();
}

?>
