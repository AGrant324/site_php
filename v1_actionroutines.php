<?php # actionroutines.php

function Actions_VIEWLIST_Output () {
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
			XTDTXT(YYYY_MM_DDtoDDsMMsYYYY($GLOBALS{'action_dateraised'}));
			#  @abits = split (//, $GLOBALS{'action_duedate'});
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
		# $key =~ tr/+/ /;
		# $key =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		# $value =~ tr/+/ /;
		# $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		# $value =~s/<!--(.|\n)*-->//g;
		if ($actionformdata{$key}) {
			$actionformdata{$key} .= ", $value";
		} else {
			$actionformdata{$key} = $value;
		}
	}
}

?>