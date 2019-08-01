<?php # corhistoryuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_corroutines.php');

Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

XH1("corcomm table creation");

$corcomm_ida = Get_Array('corcomm');
foreach ($corcomm_ida as $corcomm_id) {
	Delete_Data('corcomm',$corcomm_id);
	XPTXT($corcomm_id." - deleted");
}

/*
$corcomm_ida = Get_Array('corcomm');
$highestcorcomm_id = "CO00000";
foreach ($corcomm_ida as $corcomm_id) {
	if ( $corcomm_id > $highestcorcomm_id ) {
		$highestcorcomm_id = $corcomm_id;
	}
}
$highestcorcomm_seq = str_replace("CO", "", $highestcorcomm_id);
*/

$corcommlist = "";
$corcommsep = "";
$highestcorcomm_seq = 0;

$corsite2keya = Get_NKey_Array('corsite');
foreach ($corsite2keya as $corsite2key) {
	$corsitekeya = explode('|',$corsite2key);	
	$corsite_id = $corsitekeya[0];
	$corsite_version = $corsitekeya[1];
	Check_Data('corsite',$corsite_id,$corsite_version);
	if ($GLOBALS{'IOWARNING'} == "0") {
		if ( $GLOBALS{'corsite_dispcommtenantgdvcalc'} > 0) {			
			$corcommlist = "";
			$corcommsep = "";			
			$highestcorcomm_seq++;		
			Initialise_Data('corcomm');
			$corcomm_id = "CO".substr(("00000".$highestcorcomm_seq), -5);				
			$GLOBALS{'corcomm_corsiteid'} = $corsite_id;
			$GLOBALS{'corcomm_corsiteversion'} = $corsite_version;
			$GLOBALS{'corcomm_tenantname'} = "Commercial Tenant";
			$GLOBALS{'corcomm_area'} = $GLOBALS{'corsite_dispcommarea'};
			$GLOBALS{'corcomm_rentpersqftcalc'} = $GLOBALS{'corsite_dispcommrentpersqftcalc'};
			$GLOBALS{'corcomm_rentperannum'} = $GLOBALS{'corsite_dispcommrentperannum'};
			$GLOBALS{'corcomm_capcon'} = $GLOBALS{'corsite_dispcommcapcon'};
			$GLOBALS{'corcomm_surrendercost'} = $GLOBALS{'corsite_dispcommsurrendercost'};
			$GLOBALS{'corcomm_rentfreemths'} = $GLOBALS{'corsite_dispcommrentfreemths'};
			$GLOBALS{'corcomm_purchaserscostpercent'} = $GLOBALS{'corsite_dispcommpurchaserscostpercent'};
			$GLOBALS{'corcomm_yieldpercent'} = $GLOBALS{'corsite_dispcommyieldpercent'};
			$GLOBALS{'corcomm_leasecapval'} = $GLOBALS{'corsite_dispcommleasecapval'};
			$GLOBALS{'corcomm_tenantgdvcalc'} = $GLOBALS{'corsite_dispcommtenantgdvcalc'};
			$GLOBALS{'corcomm_purchaserscostgdvcalc'} = $GLOBALS{'corsite_dispcommpurchaserscostgdvcalc'};
			$GLOBALS{'corcomm_rentfreegdvcalc'} = $GLOBALS{'corsite_dispcommrentfreegdvcalc'};
			$GLOBALS{'corcomm_capcongdvcalc'} = $GLOBALS{'corsite_dispcommcapcongdvcalc'};
			$GLOBALS{'corcomm_surrendercostgdvcalc'} = $GLOBALS{'corsite_dispcommsurrendercostgdvcalc'};
			XPTXT($corcomm_id." created");
			Write_Data('corcomm',$corcomm_id);		
			$corcommlist = $corcommlist.$corcommsep.$corcomm_id;
			$corcommsep = ",";
			$GLOBALS{'corsite_dispcorcommidlist'} = $corcommlist;
			XPTXT($corsite_id." ".$corsite_version." updated");		
			Write_Data('corsite',$corsite_id,$corsite_version);		
		}
	}	
}

Back_Navigator();
PageFooter("Default","Final");


?>






