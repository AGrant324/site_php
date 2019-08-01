<<<<<<< HEAD
<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// print_r($_FILES);

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$filename = $_FILES["file"]["name"];
$ftype = end((explode(".", $filename)));

if ($ftype == "gz") {    // ========================================================
    $maxfilesize = "100000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"sqlbackupupload.gz","gz",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
    
    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
    
    $derror = "0";
    
    if ($uploaderrorcode == "0") {
        // XH3("SQL Backup uploaded successfully");
        $fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$uploadfilename;
        // XPTXT($fullfilename);
        
        $sfp = gzopen($fullfilename, "rb");
        $fp = fopen($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sqlbackupupload.txt", "w");
        
        while (!gzeof($sfp)) {
            $string = gzread($sfp, 4096);
            fwrite($fp, $string, strlen($string));
        }
        gzclose($sfp);
        fclose($fp);
        // XH3("SQL Backup extracted successfully");
    }   
}
    
if ($ftype == "sql") {    // ========================================================
    $maxfilesize = "100000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"sqlbackupupload.sql","sql",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";

    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
    
    
    $derror = "0";
    
    if ($uploaderrorcode == "0") {
    	// XH3("SQL Backup uploaded successfully");
    	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$uploadfilename;
    	// XPTXT($fullfilename);
	    copy($fullfilename,$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sqlbackupupload.txt");
	    // XH3("SQL Backup extracted successfully");
    }	
}

if ($uploaderrorcode == "0") {

    $downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/backupdatadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
    $GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);
    Download_Instructions_Creator();
    $derror = "0";
    
    $fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sqlbackupupload.txt";
    $GLOBALS{'IOERRORcode'} = "G077";
    $GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
    $records = Get_File_Array("$fullfilename");
    
    $recordcount = 0;
    $thistable = "";
    $firstpass = "1";
    
    foreach ($records as $recordelement) {
        $recordcount++;
        
        if (strlen(strstr($recordelement,"Dumping events for database"))>0) {
            $firstpass = "0";
        }
        
        if ($firstpass == "1") {
            
            if (strlen(strstr($recordelement,"CREATE TABLE"))>0) {
                $rbits = explode("`",$recordelement);
                $thistable = $rbits[1];
                $outputrowarray = Array("","","","");
                fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
                $outputrowarray = Array("","","","");
                fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
                Download_Header_Creator($thistable);
            }
            
            if (strlen(strstr($recordelement,"INSERT INTO"))>0) {
                // XPTXT("S "."'".$recordelement."'");
                $recordelement  = str_replace("VALUES (", "", $recordelement);
                $recordelement = rtrim($recordelement, ");");
                $dbits = explode("),(",$recordelement);
                foreach ($dbits as $tfieldgroup) {
                    // XPTXT("R ".$tfieldgroup);
                    $tfields = CSV_In_FilterSQLBackup($tfieldgroup);
                    $outputrowarray = Array();
                    array_push($outputrowarray, "data", utf8_decode($thistable));
                    $first = "1";
                    foreach ($tfields as $tfieldvalue) {
                        if ($first != "1") {
                            array_push($outputrowarray, utf8_decode($tfieldvalue));
                        }
                        $first = "0";
                    }
                    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
                }
            }
            
            if (strlen(strstr($recordelement,"UNLOCK TABLES"))>0) {
                Download_Footer_Creator($thistable);
            }
        }
    }
    
    Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});
    
    if ($derror == "0") {
        Download_File ($downloadfilename,"delete");
    } 

} else {
    XPTXTCOLOR($uploadmessage,"red");
}


function CSV_In_FilterSQLBackup ($parm0) {
    // 'cor','RE00176','SI00030','Live','','3 Bed semi detached',1,1100,3,500000,500000,0.00,500000
    $instring  = trim($parm0); // remove newline   
    // XHR();XPTXTCOLOR($instring,"red");
    $bfieldsep = chr(167); $qqsub = chr(166); $CR = chr(13); $LF = chr(10);
    
    // translate special characters
    $instring  = str_replace($bfieldsep, '', $instring); // just in case 
    $qqc = "'"."'".",";
    $instring  = str_replace('NULL,', $qqc, $instring);
    $instring  = str_replace('\"', '"', $instring); // escaped double quotes    
    $rne = '\r\n'; $rnr = "\r";
    $instring = str_replace($rne, $rnr, $instring);
    // $instring = str_replace($CR, "", $instring);
    // $instring = str_replace($LF, "", $instring);
    $instring = str_replace("Â£","£",$instring);
    
    // split into fields
    $bits = str_split($instring);
    $withinfield = "No";
    $fieldinquotes = "?";    
    $midstring = "";
    
    // |'=N?_YY|c=YY_YYc|o=YY_YYo|r=YY_YYr|'=YY_N?|,=N?_N?|'=N?_N?|2=N?_N?|0=N?_N?|
    foreach ($bits as $bit) {
        // print "|".$bit."=".$withinfield[0].$fieldinquotes[0];
        $twithinfield = $withinfield;
        if ($twithinfield == "No") {
            if ($bit == ",") {                     // comma separator
                $fieldinquotes = "?";
                $outbit = $bfieldsep;
            } else {          
                if ($bit == "'") {                  // start of field within quotes
                    $withinfield = "Yes";
                    $fieldinquotes = "Yes";
                    $outbit = "";
                } else {
                    if ($bit == " ") {              // ignore space
                        $outbit = "";
                    } else {                        // start of field without quotes
                        $withinfield = "Yes";
                        $fieldinquotes = "No";
                        $outbit = $bit;
                    }
                }  
            }
        } else {
            if ($twithinfield == "Yes") {
                if ($bit == ",") {
                    if ( $fieldinquotes == "Yes" ) {    // comma within field
                        $outbit = $bit;
                    } else {                            // next field separator
                        $withinfield = "No";
                        $fieldinquotes = "?";
                        $outbit = $bfieldsep;
                    }
                } else {
                    if ($bit == "'") {
                        if ( $fieldinquotes == "Yes" ) { // end of field with quote
                            $withinfield = "No";
                            $fieldinquotes = "?";
                            $outbit = "";
                        } else {                         // quote within non quote contained firld
                            $outbit = $bit;
                        }
                    } else {
                        $outbit = $bit;                  // ordinary field element
                    }
                }  
            }
        }
        // print "_".$withinfield[0].$fieldinquotes[0].$outbit;
        $midstring = $midstring.$outbit;
    }
    
    // create output 
    // XPTXTCOLOR($midstring,"green");
    $midfielda = explode($bfieldsep,$midstring);
    $outfielda = Array();
    foreach ($midfielda as $midstring) {
        array_push($outfielda, $midstring);
    }
    return $outfielda;
}

?>

=======
<?php # setupuploadin.php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// print_r($_FILES);

Get_Common_Parameters();
GlobalRoutine();

Get_Data("person",$GLOBALS{'LOGIN_person_id'});
Check_Session_Validity();

$filename = $_FILES["file"]["name"];
$ftype = end((explode(".", $filename)));

if ($ftype == "gz") {    // ========================================================
    $maxfilesize = "100000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"sqlbackupupload.gz","gz",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";
    
    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
    
    $derror = "0";
    
    if ($uploaderrorcode == "0") {
        // XH3("SQL Backup uploaded successfully");
        $fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$uploadfilename;
        // XPTXT($fullfilename);
        
        $sfp = gzopen($fullfilename, "rb");
        $fp = fopen($GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sqlbackupupload.txt", "w");
        
        while (!gzeof($sfp)) {
            $string = gzread($sfp, 4096);
            fwrite($fp, $string, strlen($string));
        }
        gzclose($sfp);
        fclose($fp);
        // XH3("SQL Backup extracted successfully");
    }   
}
    
if ($ftype == "sql") {    // ========================================================
    $maxfilesize = "100000000";
    $continuewithupload  = "1";
    $uploadstring = Upload_File("file",$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'},"sqlbackupupload.sql","sql",$maxfilesize,"","","","");
    # uploadname filepath filename allowdfiletypes maxsize add/update tempprefix prefix
    // return "$errorcode|$message|$prefix$filename|$autaken|$filesize|$width|$height|";

    $uploadstringa = explode("|",$uploadstring);
    $uploaderrorcode = $uploadstringa[0];
    $uploadmessage = $uploadstringa[1];
    $uploadfilename = $uploadstringa[2];
    $uploadfilenamea = explode(".",$uploadfilename);
    $uploadfiletype = $uploadfilenamea[1];
    
    
    $derror = "0";
    
    if ($uploaderrorcode == "0") {
    	// XH3("SQL Backup uploaded successfully");
    	$fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/".$uploadfilename;
    	// XPTXT($fullfilename);
	    copy($fullfilename,$GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sqlbackupupload.txt");
	    // XH3("SQL Backup extracted successfully");
    }	
}

if ($uploaderrorcode == "0") {

    $downloadfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/backupdatadownload_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".csv";
    $GLOBALS{'IOFDOWNLOAD'} = Open_File_Write ($downloadfilename);
    Download_Instructions_Creator();
    $derror = "0";
    
    $fullfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/sqlbackupupload.txt";
    $GLOBALS{'IOERRORcode'} = "G077";
    $GLOBALS{'IOERRORmessage'} = $fullfilename." not found";
    $records = Get_File_Array("$fullfilename");
    
    $recordcount = 0;
    $thistable = "";
    $firstpass = "1";
    
    foreach ($records as $recordelement) {
        $recordcount++;
        
        if (strlen(strstr($recordelement,"Dumping events for database"))>0) {
            $firstpass = "0";
        }
        
        if ($firstpass == "1") {
            
            if (strlen(strstr($recordelement,"CREATE TABLE"))>0) {
                $rbits = explode("`",$recordelement);
                $thistable = $rbits[1];
                $outputrowarray = Array("","","","");
                fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
                $outputrowarray = Array("","","","");
                fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
                Download_Header_Creator($thistable);
            }
            
            if (strlen(strstr($recordelement,"INSERT INTO"))>0) {
                // XPTXT("S "."'".$recordelement."'");
                $recordelement  = str_replace("VALUES (", "", $recordelement);
                $recordelement = rtrim($recordelement, ");");
                $dbits = explode("),(",$recordelement);
                foreach ($dbits as $tfieldgroup) {
                    // XPTXT("R ".$tfieldgroup);
                    $tfields = CSV_In_FilterSQLBackup($tfieldgroup);
                    $outputrowarray = Array();
                    array_push($outputrowarray, "data", utf8_decode($thistable));
                    $first = "1";
                    foreach ($tfields as $tfieldvalue) {
                        if ($first != "1") {
                            array_push($outputrowarray, utf8_decode($tfieldvalue));
                        }
                        $first = "0";
                    }
                    fputcsv($GLOBALS{'IOFDOWNLOAD'} , $outputrowarray);
                }
            }
            
            if (strlen(strstr($recordelement,"UNLOCK TABLES"))>0) {
                Download_Footer_Creator($thistable);
            }
        }
    }
    
    Close_File_Write ($GLOBALS{'IOFDOWNLOAD'});
    
    if ($derror == "0") {
        Download_File ($downloadfilename,"delete");
    } 

} else {
    XPTXTCOLOR($uploadmessage,"red");
}


function CSV_In_FilterSQLBackup ($parm0) {
    // 'cor','RE00176','SI00030','Live','','3 Bed semi detached',1,1100,3,500000,500000,0.00,500000
    $instring  = trim($parm0); // remove newline   
    // XHR();XPTXTCOLOR($instring,"red");
    $bfieldsep = chr(167); $qqsub = chr(166); $CR = chr(13); $LF = chr(10);
    
    // translate special characters
    $instring  = str_replace($bfieldsep, '', $instring); // just in case 
    $qqc = "'"."'".",";
    $instring  = str_replace('NULL,', $qqc, $instring);
    $instring  = str_replace('\"', '"', $instring); // escaped double quotes    
    $rne = '\r\n'; $rnr = "\r";
    $instring = str_replace($rne, $rnr, $instring);
    // $instring = str_replace($CR, "", $instring);
    // $instring = str_replace($LF, "", $instring);
    $instring = str_replace("Â£","£",$instring);
    
    // split into fields
    $bits = str_split($instring);
    $withinfield = "No";
    $fieldinquotes = "?";    
    $midstring = "";
    
    // |'=N?_YY|c=YY_YYc|o=YY_YYo|r=YY_YYr|'=YY_N?|,=N?_N?|'=N?_N?|2=N?_N?|0=N?_N?|
    foreach ($bits as $bit) {
        // print "|".$bit."=".$withinfield[0].$fieldinquotes[0];
        $twithinfield = $withinfield;
        if ($twithinfield == "No") {
            if ($bit == ",") {                     // comma separator
                $fieldinquotes = "?";
                $outbit = $bfieldsep;
            } else {          
                if ($bit == "'") {                  // start of field within quotes
                    $withinfield = "Yes";
                    $fieldinquotes = "Yes";
                    $outbit = "";
                } else {
                    if ($bit == " ") {              // ignore space
                        $outbit = "";
                    } else {                        // start of field without quotes
                        $withinfield = "Yes";
                        $fieldinquotes = "No";
                        $outbit = $bit;
                    }
                }  
            }
        } else {
            if ($twithinfield == "Yes") {
                if ($bit == ",") {
                    if ( $fieldinquotes == "Yes" ) {    // comma within field
                        $outbit = $bit;
                    } else {                            // next field separator
                        $withinfield = "No";
                        $fieldinquotes = "?";
                        $outbit = $bfieldsep;
                    }
                } else {
                    if ($bit == "'") {
                        if ( $fieldinquotes == "Yes" ) { // end of field with quote
                            $withinfield = "No";
                            $fieldinquotes = "?";
                            $outbit = "";
                        } else {                         // quote within non quote contained firld
                            $outbit = $bit;
                        }
                    } else {
                        $outbit = $bit;                  // ordinary field element
                    }
                }  
            }
        }
        // print "_".$withinfield[0].$fieldinquotes[0].$outbit;
        $midstring = $midstring.$outbit;
    }
    
    // create output 
    // XPTXTCOLOR($midstring,"green");
    $midfielda = explode($bfieldsep,$midstring);
    $outfielda = Array();
    foreach ($midfielda as $midstring) {
        array_push($outfielda, $midstring);
    }
    return $outfielda;
}

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
