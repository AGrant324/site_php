<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_sfmroutines.php');


Get_Common_Parameters();
GlobalRoutine();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();

$testorreal = $_REQUEST['TestorReal'];

Get_Data("person",$GLOBALS{'LOGIN_person_id'});

$sqltrace = "OFF";
// $sqltrace = "ON";
if ($testorreal == "T") { $tortext = "Test Mode"; }
if ($testorreal == "R") { $tortext = "Real Mode"; }
XH3("SFM Mass Data Load- ".$tortext);

$maxfilesize = "10000000";
$continuewithupload  = "1";
$uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"sfmmassupload.csv","csv",$maxfilesize,"","","","");
# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
// return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
$uploadstringa = explode("|",$uploadstring);
$uploaderrorcode = $uploadstringa[0];
$uploadmessage = $uploadstringa[1];
$uploadfilename = $uploadstringa[2];
$uploadfilenamea = explode(".",$uploadfilename);
$uploadfiletype = $uploadfilenamea[1];

if ($uploaderrorcode == "0") {
	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sfmmassupload.csv";
	$GLOBALS{'IOERRORcode'} = "G033";
	$GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
	$records = Get_File_Array("$fullfilename");
	
	$recordcount = 0;
	
	foreach ($records as $recordelement) {	
		$recordcount++;
		if ( $recordcount < 5000 ) {
			$upmessage = CSV_In_Filter($recordelement);
			# end of the tidy up
			$uploadcsva = explode("|",$upmessage);
			if ( $uploadcsva[0] == "dataheader" ) {
                            
			}
		
			if ($uploadcsva[0] == "data" ) {
                           XPTXT($recordelement);
                           if ($uploadcsva[1] == "sfmcounty") {
                               // 0dataheader,1sfmcounty,2id,3name,4contactfname,5contactsname,6contactemail
                               /*
                               sfmcounty_id
                               sfmcounty_name
                               sfmcounty_website
                               sfmcounty_adminpersonid
                               */
                               Check_Data("sfmcounty",$uploadcsva[2]);
                               if ($GLOBALS{'IOWARNING'} == "1" ) {
                                  Initialise_Data("sfmcounty");
                                  $GLOBALS{'sfmcounty_id'} = $uploadcsva[2];
                                  XPTXT("New County record created - ".$GLOBALS{'sfmcounty_name'});
                               }
                               $GLOBALS{'sfmcounty_name'} = $uploadcsva[3];
                               if ( $GLOBALS{'sfmcounty_adminpersonid'} == "" ) {
                                    $GLOBALS{'sfmcounty_adminpersonid'} = CreatePersonId( $uploadcsva[4], $uploadcsva[5], $uploadcsva[6], $GLOBALS{'sfmcounty_adminpersonid'} );
                               } else {
                                   XPTXTCOLOR("Person already exists - ".$GLOBALS{'sfmcounty_adminpersonid'},"green");  
                               }
                               Write_Data("sfmcounty",$uploadcsva[2]);
                               XPTXT("County record updated - ".$uploadcsva[2]);
                               XHR();
                           } 
                           if ($uploadcsva[1] == "sfmleague") {
                               // 0dataheader,1sfmleague,2id,3name,4contactfname,5contactsname,6contactemail
                               /*
                               sfmleague_id
                               sfmleague_name
                               sfmleague_adminpersonid
                               */
                               Check_Data("sfmleague",$uploadcsva[2]);
                               if ($GLOBALS{'IOWARNING'} == "1" ) {
                                  Initialise_Data("sfmleague");
                                  $GLOBALS{'sfmleague_id'} = $uploadcsva[2];
                                  XPTXT("New League record created - ".$GLOBALS{'sfmleague_name'});
                               }
                               $GLOBALS{'sfmleague_name'} = $uploadcsva[3];
                               if ( $GLOBALS{'sfmleague_adminpersonid'} == "" ) {
                                    $GLOBALS{'sfmleague_adminpersonid'} = CreatePersonId( $uploadcsva[4], $uploadcsva[5], $uploadcsva[6], $GLOBALS{'sfmleague_adminpersonid'} );
                               } else {
                                   XPTXTCOLOR("Person already exists - ".$GLOBALS{'sfmleague_adminpersonid'},"green");  
                               }                             
                               Write_Data("sfmleague",$uploadcsva[2]);
                               XPTXT("League record updated - ".$uploadcsva[2]);
                               XHR();
                           } 
                           if ($uploadcsva[1] == "sfmdivision") {
                               // 0dataheader,1sfmdivision,2sfmleagueid,3id,4name,5contactfname,6contactsname,7contactemail,8gradingtarget,9step
                               /*
                               sfmdivision_sfmleagueid
                               sfmdivision_id
                               sfmdivision_name
                               sfmdivision_adminpersonid
                               sfmdivision_step
                               sfmdivision_logo                               
                               */
                               Check_Data("sfmdivision",$uploadcsva[2],$uploadcsva[3]);
                               if ($GLOBALS{'IOWARNING'} == "1" ) {
                                  Initialise_Data("sfmdivision");
                                  $GLOBALS{'sfmdivision_sfmleagueid'} = $uploadcsva[2];
                                  $GLOBALS{'sfmdivision_id'} = $uploadcsva[3];
                                  XPTXT("New League record created - ".$GLOBALS{'sfmdivision_name'});
                               }
                               $GLOBALS{'sfmdivision_name'} = $uploadcsva[4];
                               if ( $GLOBALS{'sfmdivision_adminpersonid'} == "" ) {
                                    $GLOBALS{'sfmdivision_adminpersonid'} = CreatePersonId( $uploadcsva[5], $uploadcsva[6], $uploadcsva[7], $GLOBALS{'sfmdivision_adminpersonid'} );
                               } else {
                                   XPTXTCOLOR("Person already exists - ".$GLOBALS{'sfmdivision_adminpersonid'},"green");  
                               }                                
                               Write_Data("sfmdivision",$uploadcsva[2],$uploadcsva[3]);
                               XPTXT("Division record updated - ".$uploadcsva[2]." ".$uploadcsva[3]);
                               XHR();
                           }                            
                           if ($uploadcsva[1] == "sfmclub") {
                                // 0dataheader 1sfmclub 2id 3name 4sfmsetid 5sfmleagueid 6sfmdivisionid 7sfmstep 8contactfname,9contactsname,10contactemail
                                /*
                                sfmclub_domainid                 
                                sfmclub_id
                                sfmclub_name
                                sfmclub_sfmfacilityidlist
                                sfmclub_adminpersonid
                                sfmclub_sfmsetid
                                sfmclub_sfmleagueidlist
                                sfmclub_sfmdivisionidlist
                                sfmclub_sfmcountyid
                                */
                               Check_Data("sfmclub",$uploadcsva[2]);
                               if ($GLOBALS{'IOWARNING'} == "1" ) {
                                  Initialise_Data("sfmclub");
                                  $GLOBALS{'sfmclub_id'} = $uploadcsva[2];
                                  XPTXT("New Club record created - ".$GLOBALS{'sfmclub_name'});
                               }
                               $GLOBALS{'sfmclub_name'} = $uploadcsva[3];
                               $GLOBALS{'sfmclub_sfmfacilityidlist'} = $uploadcsva[2];
                               $GLOBALS{'sfmclub_sfmleagueidlist'} = $uploadcsva[5];
                               $GLOBALS{'sfmclub_sfmdivisionidlist'} = $uploadcsva[6];
                               $GLOBALS{'sfmclub_step'} = $uploadcsva[7];                               
                               if ( $GLOBALS{'sfmclub_adminpersonid'} == "" ) {
                                    $GLOBALS{'sfmclub_adminpersonid'} = CreatePersonId( $uploadcsva[8], $uploadcsva[9], $uploadcsva[10], $GLOBALS{'sfmclub_adminpersonid'} );
                               } else {
                                   XPTXTCOLOR("Person already exists - ".$GLOBALS{'sfmclub_adminpersonid'},"green");  
                               } 
                               Write_Data("sfmclub",$uploadcsva[2]);
                               XPTXT("Club record updated - ".$uploadcsva[2]." ".$GLOBALS{'sfmclub_sfmleagueidlist'});
                               
                               Check_Data("sfmfacility",$uploadcsva[2]);
                               if ($GLOBALS{'IOWARNING'} == "1" ) {
                                  Initialise_Data("sfmfacility");
                                  $GLOBALS{'sfmfacility_id'} = $uploadcsva[2];
                                  Write_Data("sfmfacility",$uploadcsva[2]);
                                  XPTXT("New ground record created - ".$GLOBALS{'sfmclub_name'});
                               }                               
                               XHR();
                           }  
  
			}
                        if ( $uploadcsva[0] == "dataend" ) {

			}
		}
	}
	
} else {
	XPTXTCOLOR($uploadmessage,"red");
}

Back_Navigator();
PageFooter("Default","Final");

function CreatePersonId( $fname, $sname, $email, $inpersonid ) {
    $outpersonid = "";
    if (($fname != "")&&($sname != "")) {
        $tempfname = strtolower($fname);
        $tempsname = strtolower($sname);
        $tempsname = str_replace(" ", "", $tempsname."999");
        $tempfname = str_replace(" ", "", $tempfname."999");
        $fnamebits = str_split($tempfname);
        $snamebits = str_split($tempsname);				
        $found = "0";
        $n = "";
        while ($found == "0") {
            $newperson_id = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
            $newperson_id = strtolower($newperson_id);
            $outpersonid = $fnamebits[0].$snamebits[0].$snamebits[1].$snamebits[2].$n;
            Check_Data("person",$outpersonid);
            if ($GLOBALS{'IOWARNING'} == "0") {
                if ( $email == $GLOBALS{'person_email1'} ) {
                    $found = "1";
                } else {
                   if ($n == "") { $n = "1"; } 
                   else { ++$n;}                  
                }
            } else {
                $found = "1";
            }
        }
        Check_Data("person",$outpersonid);
        if ($GLOBALS{'IOWARNING'} == "1" ) {
           Initialise_Data("person");
           $GLOBALS{'person_id'} = $outpersonid;
        }        
        $GLOBALS{'person_fname'} = $fname;        
        $GLOBALS{'person_sname'} = $sname;        
        $GLOBALS{'person_email1'} = $email;
        if ($GLOBALS{'person_password'} == "") {
            $randompassword = createRandomPassword();
            $GLOBALS{'person_password'} = XCrypt($randompassword,$inaddperson_id,"encrypt");
        }    
        Write_Data("person",$outpersonid);
        if ( $inpersonid == "" ) {
            XPTXTCOLOR("New person created - ".$fname." ".$sname." - ".$outpersonid, "orange");
        } else {
            XPTXTCOLOR("Person updated - ".$fname." ".$sname." - ".$outpersonid,"green");           
        }
    }    
    return $outpersonid;
}

?>



