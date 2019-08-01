<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_BULLETINCREATEC_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();


$formseq = $_REQUEST['FormSeq'];  // 0 for new & 1-9 for existing

// This routine maps bulletins from a single linkpoint to multiple bulletin boards

if ( $formseq == "0") {	
	// ==== New Bulletin ============	
	$inbulletin_ref = $_REQUEST['bulletin_ref0'];
	$inbulletin_target = $_REQUEST['bulletin_target0'];
	$fixedbulletinboard = $_REQUEST['FixedBulletinBoard0'];
	$inbulletin_id = $_REQUEST["bulletin_id0"];
	$inbulletin_date = $_REQUEST["bulletin_date0"."_YYYYpart"]."-".$_REQUEST["bulletin_date0"."_MMpart"]."-".$_REQUEST["bulletin_date0"."_DDpart"];
	$inbulletin_anchor = $_REQUEST["bulletin_anchor0"];
	$inbulletin_periodid = $_REQUEST["bulletin_periodid0"];
	$inbulletin_bulletinboardname = $_REQUEST["bulletin_bulletinboardname0"];
	$inbulletin_header = $_REQUEST["bulletin_header0"];
	$inbulletin_text = $_REQUEST["bulletin_text0"];
	$inbulletin_targetimageavailable = $_REQUEST["bulletin_targetimageavailable0"];
	// $inbulletin_image = $_REQUEST['bulletin_image0_input'];
	// $inimagefilepath = $_REQUEST['bulletin_image0_imagefilepath'];
	$inbulletin_image = $_REQUEST['bulletin_image0_imagename'];		
	$inimagefilepath = expandSymbolicPath($inimagefilepath);
 	$inbulletin_hide = $_REQUEST["bulletin_hide0"];
 	$republish = $_REQUEST["RePublish0"];
	/*
	XHR();
	XPTXT("inbulletin_ref"."=".$inbulletin_ref);
	XPTXT("inbulletin_target"."=".$inbulletin_target);		
	XPTXT("inbulletin_bulletinboardname"."=".$inbulletin_bulletinboardname);
	XPTXT("inbulletin_header"."=".$inbulletin_header);
	XPTXT("inbulletin_text"."=".$inbulletin_text);
	XPTXT("inbulletin_date"."=".$inbulletin_date);
	XPTXT("inbulletin_delete"."=".$inbulletin_delete);
	*/
	
	$highestbulletinid = "B000000";
	$duplicate = "0";
	foreach (Get_Array("bulletin") as $bulletin_id) {
		Get_Data("bulletin",$bulletin_id);
		if ( $bulletin_id > $highestbulletinid ) { $highestbulletinid = $bulletin_id; }
		if (($inbulletin_ref == $GLOBALS{'bulletin_ref'})&&
		    ($inbulletin_target == $GLOBALS{'bulletin_target'})&&
		    ($inbulletin_bulletinboardname == $GLOBALS{'bulletin_bulletinboardname'})) {
			$duplicate = "1"; 
		}
	}
	$highestbulletinidnum = (int)substr($highestbulletinid,1,6);
	$nextbulletinid = "B".substr("000000".(string)($highestbulletinidnum+1),-6);
	// XH2($highestbulletinid." ".$nextbulletinid);
	
	if ( $duplicate == "1" ) {
		XPTXTCOLOR("DUPLICATE: This bulletin is already posted to the ".$inbulletin_bulletinboardname." Bulletin Board","red");
		XPTXTCOLOR("Please edit the existing entry, rather than create a new one.","red");		
	} else {
		$editpassed = "1"; $editmessage = "";
		if ($inbulletin_date == "0000-00-00") { $editpassed = "0"; $editmessage = $editmessage." - No date entered<br>"; }
		if ($inbulletin_date == "---") { $editpassed = "0"; $editmessage = $editmessage." - No date entered<br>"; }	
		if ($inbulletin_bulletinboardname == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board selected<br>"; }
		if ($inbulletin_header == "") { $editpassed = "0"; $editmessage = $editmessage." - No header entered<br>"; }	
		if ($inbulletin_text == "") { $editpassed = "0"; $editmessage = $editmessage." - No text entered<br>"; }
		
		if ($editpassed == "1") {	
			Initialise_Data('bulletin');
			$GLOBALS{'bulletin_date'} = $inbulletin_date;
			$GLOBALS{'bulletin_ref'} = $inbulletin_ref;
			$GLOBALS{'bulletin_target'} = $inbulletin_target;
			$GLOBALS{'bulletin_anchor'} = $inbulletin_anchor;
			$GLOBALS{'bulletin_periodid'} = $inbulletin_periodid;
			$GLOBALS{'bulletin_bulletinboardname'} = $inbulletin_bulletinboardname;
			$GLOBALS{'bulletin_header'} = $inbulletin_header;
			$GLOBALS{'bulletin_text'} = $inbulletin_text;
			// $GLOBALS{'bulletin_image'} = $inbulletin_imageold;
			if ($inbulletin_image != "") {
				// $GLOBALS{'bulletin_image'} = FinaliseImageInput($inimagefilepath,$GLOBALS{'bulletin_image'},$inbulletin_image);
				$GLOBALS{'bulletin_image'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'bulletin_image'},$inbulletin_image);
			} else {
				if ($inbulletin_targetimageavailable == "Yes") {
					if ($inbulletin_ref == "E") {
						Get_Data("event",$inbulletin_target);
						$targetimageavailable = $GLOBALS{'event_featuredimage'};
						$targetimagesource = "event";
					}
					if ($inbulletin_ref == "A") {
						Get_Data("article",$inbulletin_target);
						$targetimageavailable = $GLOBALS{'article_featuredimage'};
						$targetimagesource = "article";
					}
					if ($inbulletin_ref == "C") {
						Get_Data("course",$inbulletin_target);
						$targetimageavailable = $GLOBALS{'course_featuredimage'};
						$targetimagesource = "course";
					}
					if ($inbulletin_ref == "R") {
						Get_Data("frs",$GLOBALS{'currperiodid'},$inbulletin_target);
						$targetimageavailable = $GLOBALS{'frs_reportphotofilename'};
						$targetimagesource = "match report";
					}
					$ibits = explode('_',$targetimageavailable);
					$bulletinimage = "Bulletin_".$nextbulletinid."_".$ibits[2];
					copy($GLOBALS{'domainwwwpath'}."/domain_media/".$targetimageavailable, $GLOBALS{'domainwwwpath'}."/domain_media/".$bulletinimage);
					// XPTXT("Bulletin image created from ".$targetimagesource);
					$GLOBALS{'bulletin_image'} = $bulletinimage;
				}
			}
			$GLOBALS{'bulletin_hide'} = $inbulletin_hide;
			$GLOBALS{'bulletin_linkurl'} = BulletinLink($GLOBALS{'bulletin_ref'},$GLOBALS{'bulletin_target'},$inbulletin_anchor,$GLOBALS{'bulletin_periodid'});
			$updatesmade = "1";
			Write_Data('bulletin', $nextbulletinid);
			XPTXTCOLOR("New Bulletin sucessfully added","green");
			if (AuthorisedToPublishBulletins($inbulletin_bulletinboardname)) {
				if ($republish == "Yes") {
					XHR();
					foreach (Get_Array('webpage') as $webpage_name) {
					    Get_Data("webpage",$webpage_name);
					    if (FoundInCommaList("[BulletinBoard:Name=".$inbulletin_bulletinboardname.";",$GLOBALS{'webpage_pluginlist'})) {
					        Plugin_BulletinBoard_Publish($webpage_name,Array($inbulletin_bulletinboardname));
					    }
					}
				}				
			} else {
				NotifyBoardController($nextbulletinid);
			}
		} else {
			XPTXTCOLOR("New Bulletin not created - please correct the following errors","red");
			XPTXTCOLOR($editmessage,"red");
		}
	}
} else {
	// ==== Existing Bulletin ============	
	$updatesmade = "0";
	$bulletinarray = Array();
	$bulletinimagearray = Array();
	$inbulletin_ref = $_REQUEST['bulletin_ref'.$formseq];
	$inbulletin_target = $_REQUEST['bulletin_target'.$formseq];
	$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'.$formseq];
	$inbulletin_id = $_REQUEST["bulletin_id".$formseq];
	$inbulletin_date = $_REQUEST["bulletin_date".$formseq."_YYYYpart"]."-".$_REQUEST["bulletin_date".$formseq."_MMpart"]."-".$_REQUEST["bulletin_date".$formseq."_DDpart"];
	$inbulletin_anchor = $_REQUEST["bulletin_anchor".$formseq];
	$inbulletin_periodid = $_REQUEST["bulletin_periodid".$formseq];
	$inbulletin_bulletinboardname = $_REQUEST["bulletin_bulletinboardname".$formseq];
	$inbulletin_header = $_REQUEST["bulletin_header".$formseq];
	$inbulletin_text = $_REQUEST["bulletin_text".$formseq];

	$inbulletin_targetimageavailable = $_REQUEST["bulletin_targetimageavailable".$formseq];
	// $inbulletin_image = $_REQUEST['bulletin_image'.$formseq.'_input'];
	// $inimagefilepath = $_REQUEST['bulletin_image'.$formseq.'_imagefilepath'];
	$inbulletin_image = $_REQUEST['bulletin_image'.$formseq.'_imagename'];
	$inimagefilepath = expandSymbolicPath($inimagefilepath);
	$inbulletin_hide = $_REQUEST["bulletin_hide".$formseq];
	$inbulletin_delete = $_REQUEST["bulletin_delete".$formseq];
	$republish = $_REQUEST["RePublish".$formseq];	
	/*
	XHR();
	XPTXT("inbulletin_bulletinboardname".$formseq."=".$inbulletin_bulletinboardname.$formseq);
	XPTXT("inbulletin_header".$formseq."=".$inbulletin_header.$formseq);
	XPTXT("inbulletin_text".$formseq."=".$inbulletin_text.$formseq);
	XPTXT("inbulletin_date".$formseq."=".$inbulletin_date.$formseq);
	XPTXT("inbulletin_delete".$formseq."=".$inbulletin_delete.$formseq);
	*/

	$duplicate = "0";
	foreach (Get_Array("bulletin") as $bulletin_id) {
		if (($inbulletin_ref == $GLOBALS{'bulletin_ref'})&&
		($inbulletin_target == $GLOBALS{'bulletin_target'})&&
		($inbulletin_bulletinboardname == $GLOBALS{'bulletin_bulletinboardname'})) {
			$duplicate = "1";
		}
	}		
	
	if ( $duplicate == "1" ) {
		XPTXTCOLOR("DUPLICATE: This bulletin is already posted to the Bulletin Board","red");
		XPTXTCOLOR("Please review the existing entry","red");
	} else {		
		$editpassed = "1"; $editmessage = "";
		if ($inbulletin_date == "0000-00-00") { $editpassed = "0"; $editmessage = $editmessage." - No date specified<br>"; }
		if ($inbulletin_date == "---") { $editpassed = "0"; $editmessage = $editmessage." - No date specified<br>"; }	
		if ($inbulletin_bulletinboardname == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board specified<br>"; }
		if ($inbulletin_header == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board specified<br>"; }	
		if ($inbulletin_text == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board specified<br>"; }
		if ($inbulletin_delete == "Yes") { $editpassed = "1"; }	
		
		if ($editpassed == "1") {				
			Get_Data('bulletin' , $inbulletin_id);	
			if ($inbulletin_delete == "Delete") {
				if ($GLOBALS{'bulletin_image'} != "") {
					$imagefilename = $GLOBALS{'domainwwwpath'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
					if (file_exists($imagefilename)) {
						unlink($imagefilename);
						// XPTXT($imagefilename." deleted");XBR();
					} else {
						// XPTXT("warning - ".$imagefilename." did not exist");XBR();
					}
				}
				$updatesmade = "1";
				Delete_Data('bulletin', $inbulletin_id);
				// XPTXT($inbulletin_id." removed");XBR();
			} else {
				$GLOBALS{'bulletin_date'} = $inbulletin_date;
				$GLOBALS{'bulletin_ref'} = $inbulletin_ref;
				$GLOBALS{'bulletin_target'} = $inbulletin_target;
				$GLOBALS{'bulletin_anchor'} = $inbulletin_anchor;
				$GLOBALS{'bulletin_periodid'} = $inbulletin_periodid;
				$GLOBALS{'bulletin_bulletinboardname'} = $inbulletin_bulletinboardname;
				$GLOBALS{'bulletin_header'} = $inbulletin_header;
				$GLOBALS{'bulletin_text'} = $inbulletin_text;
				/*
				if ($inbulletin_image_delete == "Delete") {
					$imagefilename = $GLOBALS{'domainwwwpath'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
					if (file_exists($imagefilename)) {
						// unlink($imagefilename);
						// XH3($imagefilename." deleted");XBR();
					} else {
						// XH3("warning - ".$imagefilename." did not exist");XBR();
					}
					$GLOBALS{'bulletin_image'} = "";
				} else {
					$GLOBALS{'bulletin_image'} = $inbulletin_imageold;
					if ($inbulletin_image != "") {
						$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
						$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG";
						$maxfilesize = "1000000";
						$fileprefix = "Bulletin_".$inbulletin_id."_";
						# uploadname filepath filename allowedfiletypes maxsize add/update tempprefix prefix
						$uploadstring = Upload_File("bulletin_image",$fileuploadpath,$inbulletin_image,$aft,$maxfilesize,"","",$fileprefix,"");
						# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
						$ubits = explode('|', $uploadstring);
						if ($ubits[0] == "1") {
							XPTXT("ERROR - ".$ubits[1]);
						}
						else { XPTXT($ubits[1]);
						}
						$GLOBALS{'bulletin_image'} = "Bulletin_".$inbulletin_id."_".$inbulletin_image;
						
					}
				}
				*/
				// $GLOBALS{'bulletin_image'} = FinaliseImageInput($inimagefilepath,$GLOBALS{'bulletin_image'},$inbulletin_image);
				$GLOBALS{'bulletin_image'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'bulletin_image'},$inbulletin_image);
				$GLOBALS{'bulletin_hide'} = $inbulletin_hide;
				$GLOBALS{'bulletin_linkurl'} = BulletinLink($GLOBALS{'bulletin_ref'},$GLOBALS{'bulletin_target'},$inbulletin_anchor,$GLOBALS{'bulletin_periodid'});
				$updatesmade = "1";
				Write_Data('bulletin', $inbulletin_id);
				// XPTXT($inbulletin_id." updated");XBR();
			}
		}
		if ($updatesmade == "1") { 
			XPTXTCOLOR("Changes to existing Bulletin sucessfully made","green"); 
			if (AuthorisedToPublishBulletins($inbulletin_bulletinboardname)) {
				if ($republish == "Yes") {
					XHR();
					foreach (Get_Array('webpage') as $webpage_name) {
					    Get_Data("webpage",$webpage_name);
					    if (FoundInCommaList("[BulletinBoard:Name=".$inbulletin_bulletinboardname.";",$GLOBALS{'webpage_pluginlist'})) {
					        Plugin_BulletinBoard_Publish($webpage_name,Array($inbulletin_bulletinboardname));
					    }
					}
				}
			} else {
				NotifyBoardController($inbulletin_id);
			}
		}
		else {	XPTXTCOLOR("No changes to existing Bulletin made<br>".$editmessage,"red"); }			
	}
}	

WebPage_BULLETINCREATEC_Output($inbulletin_ref, $inbulletin_target, $inbulletin_anchor, "", $fixedbulletinboard);

Back_Navigator();
PageFooter("Default","Final");


function NotifyBoardController($bulletinid) {
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	$askingperson_email = $GLOBALS{'person_email1'};
	$askingperson_fname = $GLOBALS{'person_fname'};
	$askingperson_sname = $GLOBALS{'person_sname'};
	Get_Data('bulletin',$bulletinid);
	Get_Data('bulletinboard',$GLOBALS{'bulletin_bulletinboardname'});
	if ($GLOBALS{'bulletinboard_controllers'} != "") {
		$controllera = explode(',',$GLOBALS{'bulletinboard_controllers'});
		Check_Data("person",$controllera[0]);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$emailto = $GLOBALS{'person_email1'};
			$emailcc = "";
			$emailbcc = "";
			$emailsubject = 'New Item for Bulletin Board';
			$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
			$mainmessage = $mainmessage.$askingperson_fname." ".$askingperson_sname.' has created a new bulletin to be posted on the '.$GLOBALS{'bulletin_bulletinboardname'}.' bulletin board.<br><br>';
			if ($GLOBALS{'bulletin_image'} == "") {
				$mainmessage = $mainmessage.'No Image<br><br>';
			} else {
				$mainmessage = $mainmessage.YIMGFLEX($GLOBALS{'domainwwwpath'}.'/domain_media/'.$GLOBALS{'bulletin_image'}).'<br><br>';
			}
			$mainmessage = $mainmessage.$GLOBALS{'bulletin_header'}.'<br><br>';
			$mainmessage = $mainmessage.$GLOBALS{'bulletin_text'}.'<br><br>';			
			$emailcontent = $mainmessage;
			$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
			$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
			$emailfooter2 = "Please do not reply to this message";
			HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			XPTXTCOLOR("Error: Bulletin Board controller not found","red");
		}	
	} 
}

=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');
require_once('v1_webpageroutines.php');

Get_Common_Parameters();
GlobalRoutine();
Webpage_BULLETINCREATEC_CSSJS();
PageHeader("Default","Final");
Check_Session_Validity();
Back_Navigator();


$formseq = $_REQUEST['FormSeq'];  // 0 for new & 1-9 for existing

// This routine maps bulletins from a single linkpoint to multiple bulletin boards

if ( $formseq == "0") {	
	// ==== New Bulletin ============	
	$inbulletin_ref = $_REQUEST['bulletin_ref0'];
	$inbulletin_target = $_REQUEST['bulletin_target0'];
	$fixedbulletinboard = $_REQUEST['FixedBulletinBoard0'];
	$inbulletin_id = $_REQUEST["bulletin_id0"];
	$inbulletin_date = $_REQUEST["bulletin_date0"."_YYYYpart"]."-".$_REQUEST["bulletin_date0"."_MMpart"]."-".$_REQUEST["bulletin_date0"."_DDpart"];
	$inbulletin_anchor = $_REQUEST["bulletin_anchor0"];
	$inbulletin_periodid = $_REQUEST["bulletin_periodid0"];
	$inbulletin_bulletinboardname = $_REQUEST["bulletin_bulletinboardname0"];
	$inbulletin_header = $_REQUEST["bulletin_header0"];
	$inbulletin_text = $_REQUEST["bulletin_text0"];
	$inbulletin_targetimageavailable = $_REQUEST["bulletin_targetimageavailable0"];
	// $inbulletin_image = $_REQUEST['bulletin_image0_input'];
	// $inimagefilepath = $_REQUEST['bulletin_image0_imagefilepath'];
	$inbulletin_image = $_REQUEST['bulletin_image0_imagename'];		
	$inimagefilepath = expandSymbolicPath($inimagefilepath);
 	$inbulletin_hide = $_REQUEST["bulletin_hide0"];
 	$republish = $_REQUEST["RePublish0"];
	/*
	XHR();
	XPTXT("inbulletin_ref"."=".$inbulletin_ref);
	XPTXT("inbulletin_target"."=".$inbulletin_target);		
	XPTXT("inbulletin_bulletinboardname"."=".$inbulletin_bulletinboardname);
	XPTXT("inbulletin_header"."=".$inbulletin_header);
	XPTXT("inbulletin_text"."=".$inbulletin_text);
	XPTXT("inbulletin_date"."=".$inbulletin_date);
	XPTXT("inbulletin_delete"."=".$inbulletin_delete);
	*/
	
	$highestbulletinid = "B000000";
	$duplicate = "0";
	foreach (Get_Array("bulletin") as $bulletin_id) {
		Get_Data("bulletin",$bulletin_id);
		if ( $bulletin_id > $highestbulletinid ) { $highestbulletinid = $bulletin_id; }
		if (($inbulletin_ref == $GLOBALS{'bulletin_ref'})&&
		    ($inbulletin_target == $GLOBALS{'bulletin_target'})&&
		    ($inbulletin_bulletinboardname == $GLOBALS{'bulletin_bulletinboardname'})) {
			$duplicate = "1"; 
		}
	}
	$highestbulletinidnum = (int)substr($highestbulletinid,1,6);
	$nextbulletinid = "B".substr("000000".(string)($highestbulletinidnum+1),-6);
	// XH2($highestbulletinid." ".$nextbulletinid);
	
	if ( $duplicate == "1" ) {
		XPTXTCOLOR("DUPLICATE: This bulletin is already posted to the ".$inbulletin_bulletinboardname." Bulletin Board","red");
		XPTXTCOLOR("Please edit the existing entry, rather than create a new one.","red");		
	} else {
		$editpassed = "1"; $editmessage = "";
		if ($inbulletin_date == "0000-00-00") { $editpassed = "0"; $editmessage = $editmessage." - No date entered<br>"; }
		if ($inbulletin_date == "---") { $editpassed = "0"; $editmessage = $editmessage." - No date entered<br>"; }	
		if ($inbulletin_bulletinboardname == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board selected<br>"; }
		if ($inbulletin_header == "") { $editpassed = "0"; $editmessage = $editmessage." - No header entered<br>"; }	
		if ($inbulletin_text == "") { $editpassed = "0"; $editmessage = $editmessage." - No text entered<br>"; }
		
		if ($editpassed == "1") {	
			Initialise_Data('bulletin');
			$GLOBALS{'bulletin_date'} = $inbulletin_date;
			$GLOBALS{'bulletin_ref'} = $inbulletin_ref;
			$GLOBALS{'bulletin_target'} = $inbulletin_target;
			$GLOBALS{'bulletin_anchor'} = $inbulletin_anchor;
			$GLOBALS{'bulletin_periodid'} = $inbulletin_periodid;
			$GLOBALS{'bulletin_bulletinboardname'} = $inbulletin_bulletinboardname;
			$GLOBALS{'bulletin_header'} = $inbulletin_header;
			$GLOBALS{'bulletin_text'} = $inbulletin_text;
			// $GLOBALS{'bulletin_image'} = $inbulletin_imageold;
			if ($inbulletin_image != "") {
				// $GLOBALS{'bulletin_image'} = FinaliseImageInput($inimagefilepath,$GLOBALS{'bulletin_image'},$inbulletin_image);
				$GLOBALS{'bulletin_image'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'bulletin_image'},$inbulletin_image);
			} else {
				if ($inbulletin_targetimageavailable == "Yes") {
					if ($inbulletin_ref == "E") {
						Get_Data("event",$inbulletin_target);
						$targetimageavailable = $GLOBALS{'event_featuredimage'};
						$targetimagesource = "event";
					}
					if ($inbulletin_ref == "A") {
						Get_Data("article",$inbulletin_target);
						$targetimageavailable = $GLOBALS{'article_featuredimage'};
						$targetimagesource = "article";
					}
					if ($inbulletin_ref == "C") {
						Get_Data("course",$inbulletin_target);
						$targetimageavailable = $GLOBALS{'course_featuredimage'};
						$targetimagesource = "course";
					}
					if ($inbulletin_ref == "R") {
						Get_Data("frs",$GLOBALS{'currperiodid'},$inbulletin_target);
						$targetimageavailable = $GLOBALS{'frs_reportphotofilename'};
						$targetimagesource = "match report";
					}
					$ibits = explode('_',$targetimageavailable);
					$bulletinimage = "Bulletin_".$nextbulletinid."_".$ibits[2];
					copy($GLOBALS{'domainwwwpath'}."/domain_media/".$targetimageavailable, $GLOBALS{'domainwwwpath'}."/domain_media/".$bulletinimage);
					// XPTXT("Bulletin image created from ".$targetimagesource);
					$GLOBALS{'bulletin_image'} = $bulletinimage;
				}
			}
			$GLOBALS{'bulletin_hide'} = $inbulletin_hide;
			$GLOBALS{'bulletin_linkurl'} = BulletinLink($GLOBALS{'bulletin_ref'},$GLOBALS{'bulletin_target'},$inbulletin_anchor,$GLOBALS{'bulletin_periodid'});
			$updatesmade = "1";
			Write_Data('bulletin', $nextbulletinid);
			XPTXTCOLOR("New Bulletin sucessfully added","green");
			if (AuthorisedToPublishBulletins($inbulletin_bulletinboardname)) {
				if ($republish == "Yes") {
					XHR();
					foreach (Get_Array('webpage') as $webpage_name) {
					    Get_Data("webpage",$webpage_name);
					    if (FoundInCommaList("[BulletinBoard:Name=".$inbulletin_bulletinboardname.";",$GLOBALS{'webpage_pluginlist'})) {
					        Plugin_BulletinBoard_Publish($webpage_name,Array($inbulletin_bulletinboardname));
					    }
					}
				}				
			} else {
				NotifyBoardController($nextbulletinid);
			}
		} else {
			XPTXTCOLOR("New Bulletin not created - please correct the following errors","red");
			XPTXTCOLOR($editmessage,"red");
		}
	}
} else {
	// ==== Existing Bulletin ============	
	$updatesmade = "0";
	$bulletinarray = Array();
	$bulletinimagearray = Array();
	$inbulletin_ref = $_REQUEST['bulletin_ref'.$formseq];
	$inbulletin_target = $_REQUEST['bulletin_target'.$formseq];
	$fixedbulletinboard = $_REQUEST['FixedBulletinBoard'.$formseq];
	$inbulletin_id = $_REQUEST["bulletin_id".$formseq];
	$inbulletin_date = $_REQUEST["bulletin_date".$formseq."_YYYYpart"]."-".$_REQUEST["bulletin_date".$formseq."_MMpart"]."-".$_REQUEST["bulletin_date".$formseq."_DDpart"];
	$inbulletin_anchor = $_REQUEST["bulletin_anchor".$formseq];
	$inbulletin_periodid = $_REQUEST["bulletin_periodid".$formseq];
	$inbulletin_bulletinboardname = $_REQUEST["bulletin_bulletinboardname".$formseq];
	$inbulletin_header = $_REQUEST["bulletin_header".$formseq];
	$inbulletin_text = $_REQUEST["bulletin_text".$formseq];

	$inbulletin_targetimageavailable = $_REQUEST["bulletin_targetimageavailable".$formseq];
	// $inbulletin_image = $_REQUEST['bulletin_image'.$formseq.'_input'];
	// $inimagefilepath = $_REQUEST['bulletin_image'.$formseq.'_imagefilepath'];
	$inbulletin_image = $_REQUEST['bulletin_image'.$formseq.'_imagename'];
	$inimagefilepath = expandSymbolicPath($inimagefilepath);
	$inbulletin_hide = $_REQUEST["bulletin_hide".$formseq];
	$inbulletin_delete = $_REQUEST["bulletin_delete".$formseq];
	$republish = $_REQUEST["RePublish".$formseq];	
	/*
	XHR();
	XPTXT("inbulletin_bulletinboardname".$formseq."=".$inbulletin_bulletinboardname.$formseq);
	XPTXT("inbulletin_header".$formseq."=".$inbulletin_header.$formseq);
	XPTXT("inbulletin_text".$formseq."=".$inbulletin_text.$formseq);
	XPTXT("inbulletin_date".$formseq."=".$inbulletin_date.$formseq);
	XPTXT("inbulletin_delete".$formseq."=".$inbulletin_delete.$formseq);
	*/

	$duplicate = "0";
	foreach (Get_Array("bulletin") as $bulletin_id) {
		if (($inbulletin_ref == $GLOBALS{'bulletin_ref'})&&
		($inbulletin_target == $GLOBALS{'bulletin_target'})&&
		($inbulletin_bulletinboardname == $GLOBALS{'bulletin_bulletinboardname'})) {
			$duplicate = "1";
		}
	}		
	
	if ( $duplicate == "1" ) {
		XPTXTCOLOR("DUPLICATE: This bulletin is already posted to the Bulletin Board","red");
		XPTXTCOLOR("Please review the existing entry","red");
	} else {		
		$editpassed = "1"; $editmessage = "";
		if ($inbulletin_date == "0000-00-00") { $editpassed = "0"; $editmessage = $editmessage." - No date specified<br>"; }
		if ($inbulletin_date == "---") { $editpassed = "0"; $editmessage = $editmessage." - No date specified<br>"; }	
		if ($inbulletin_bulletinboardname == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board specified<br>"; }
		if ($inbulletin_header == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board specified<br>"; }	
		if ($inbulletin_text == "") { $editpassed = "0"; $editmessage = $editmessage." - No target Bulletin Board specified<br>"; }
		if ($inbulletin_delete == "Yes") { $editpassed = "1"; }	
		
		if ($editpassed == "1") {				
			Get_Data('bulletin' , $inbulletin_id);	
			if ($inbulletin_delete == "Delete") {
				if ($GLOBALS{'bulletin_image'} != "") {
					$imagefilename = $GLOBALS{'domainwwwpath'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
					if (file_exists($imagefilename)) {
						unlink($imagefilename);
						// XPTXT($imagefilename." deleted");XBR();
					} else {
						// XPTXT("warning - ".$imagefilename." did not exist");XBR();
					}
				}
				$updatesmade = "1";
				Delete_Data('bulletin', $inbulletin_id);
				// XPTXT($inbulletin_id." removed");XBR();
			} else {
				$GLOBALS{'bulletin_date'} = $inbulletin_date;
				$GLOBALS{'bulletin_ref'} = $inbulletin_ref;
				$GLOBALS{'bulletin_target'} = $inbulletin_target;
				$GLOBALS{'bulletin_anchor'} = $inbulletin_anchor;
				$GLOBALS{'bulletin_periodid'} = $inbulletin_periodid;
				$GLOBALS{'bulletin_bulletinboardname'} = $inbulletin_bulletinboardname;
				$GLOBALS{'bulletin_header'} = $inbulletin_header;
				$GLOBALS{'bulletin_text'} = $inbulletin_text;
				/*
				if ($inbulletin_image_delete == "Delete") {
					$imagefilename = $GLOBALS{'domainwwwpath'}.'/domain_media/'.$GLOBALS{'bulletin_image'};
					if (file_exists($imagefilename)) {
						// unlink($imagefilename);
						// XH3($imagefilename." deleted");XBR();
					} else {
						// XH3("warning - ".$imagefilename." did not exist");XBR();
					}
					$GLOBALS{'bulletin_image'} = "";
				} else {
					$GLOBALS{'bulletin_image'} = $inbulletin_imageold;
					if ($inbulletin_image != "") {
						$fileuploadpath = $GLOBALS{'domainwwwpath'}."/domain_media";
						$aft = "jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG";
						$maxfilesize = "1000000";
						$fileprefix = "Bulletin_".$inbulletin_id."_";
						# uploadname filepath filename allowedfiletypes maxsize add/update tempprefix prefix
						$uploadstring = Upload_File("bulletin_image",$fileuploadpath,$inbulletin_image,$aft,$maxfilesize,"","",$fileprefix,"");
						# uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
						$ubits = explode('|', $uploadstring);
						if ($ubits[0] == "1") {
							XPTXT("ERROR - ".$ubits[1]);
						}
						else { XPTXT($ubits[1]);
						}
						$GLOBALS{'bulletin_image'} = "Bulletin_".$inbulletin_id."_".$inbulletin_image;
						
					}
				}
				*/
				// $GLOBALS{'bulletin_image'} = FinaliseImageInput($inimagefilepath,$GLOBALS{'bulletin_image'},$inbulletin_image);
				$GLOBALS{'bulletin_image'} = FinaliseImageInput($GLOBALS{'domainwwwpath'}."/domain_media",$GLOBALS{'bulletin_image'},$inbulletin_image);
				$GLOBALS{'bulletin_hide'} = $inbulletin_hide;
				$GLOBALS{'bulletin_linkurl'} = BulletinLink($GLOBALS{'bulletin_ref'},$GLOBALS{'bulletin_target'},$inbulletin_anchor,$GLOBALS{'bulletin_periodid'});
				$updatesmade = "1";
				Write_Data('bulletin', $inbulletin_id);
				// XPTXT($inbulletin_id." updated");XBR();
			}
		}
		if ($updatesmade == "1") { 
			XPTXTCOLOR("Changes to existing Bulletin sucessfully made","green"); 
			if (AuthorisedToPublishBulletins($inbulletin_bulletinboardname)) {
				if ($republish == "Yes") {
					XHR();
					foreach (Get_Array('webpage') as $webpage_name) {
					    Get_Data("webpage",$webpage_name);
					    if (FoundInCommaList("[BulletinBoard:Name=".$inbulletin_bulletinboardname.";",$GLOBALS{'webpage_pluginlist'})) {
					        Plugin_BulletinBoard_Publish($webpage_name,Array($inbulletin_bulletinboardname));
					    }
					}
				}
			} else {
				NotifyBoardController($inbulletin_id);
			}
		}
		else {	XPTXTCOLOR("No changes to existing Bulletin made<br>".$editmessage,"red"); }			
	}
}	

WebPage_BULLETINCREATEC_Output($inbulletin_ref, $inbulletin_target, $inbulletin_anchor, "", $fixedbulletinboard);

Back_Navigator();
PageFooter("Default","Final");


function NotifyBoardController($bulletinid) {
	Get_Data("person",$GLOBALS{'LOGIN_person_id'});
	$askingperson_email = $GLOBALS{'person_email1'};
	$askingperson_fname = $GLOBALS{'person_fname'};
	$askingperson_sname = $GLOBALS{'person_sname'};
	Get_Data('bulletin',$bulletinid);
	Get_Data('bulletinboard',$GLOBALS{'bulletin_bulletinboardname'});
	if ($GLOBALS{'bulletinboard_controllers'} != "") {
		$controllera = explode(',',$GLOBALS{'bulletinboard_controllers'});
		Check_Data("person",$controllera[0]);
		if ($GLOBALS{'IOWARNING'} == "0") {
			$emailto = $GLOBALS{'person_email1'};
			$emailcc = "";
			$emailbcc = "";
			$emailsubject = 'New Item for Bulletin Board';
			$mainmessage = 'Dear '.$GLOBALS{'person_fname'}.'<br><br>';
			$mainmessage = $mainmessage.$askingperson_fname." ".$askingperson_sname.' has created a new bulletin to be posted on the '.$GLOBALS{'bulletin_bulletinboardname'}.' bulletin board.<br><br>';
			if ($GLOBALS{'bulletin_image'} == "") {
				$mainmessage = $mainmessage.'No Image<br><br>';
			} else {
				$mainmessage = $mainmessage.YIMGFLEX($GLOBALS{'domainwwwpath'}.'/domain_media/'.$GLOBALS{'bulletin_image'}).'<br><br>';
			}
			$mainmessage = $mainmessage.$GLOBALS{'bulletin_header'}.'<br><br>';
			$mainmessage = $mainmessage.$GLOBALS{'bulletin_text'}.'<br><br>';			
			$emailcontent = $mainmessage;
			$emailfrom = $GLOBALS{'domain_defaultemailaddress'};
			$emailfooter1 = $GLOBALS{'domain_longname'}.' - initiated by '.$askingperson_fname." ".$askingperson_sname;
			$emailfooter2 = "Please do not reply to this message";
			HTMLEmail_Output("nodisplay",$emailfrom,$emailto,$emailcc,$emailbcc,$emailsubject,$emailcontent,$emailfooter1,$emailfooter2);
		} else {
			XPTXTCOLOR("Error: Bulletin Board controller not found","red");
		}	
	} 
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
