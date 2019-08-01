<<<<<<< HEAD
<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

// ============ upload client timestamps =========================

$testorreal = $_REQUEST["TestorReal"];
$synchupdata = $_REQUEST["SynchUpData"];

Get_Data("site_dmws");
$synchroniseappversion = $GLOBALS{'site_synchroniseappversion'};

$zip = new ZipArchive();
$zipfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/appsynch_".$GLOBALS{'LOGIN_person_id'}."_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".zip";
// $zipfilename = "aziptest.zip";

// touch($zipfilename); // seems to be required in wampserver

if ($zip->open($zipfilename, ZipArchive::CREATE) !== TRUE) {
    exit("cannot open <$zipfilename>\n");
} else {
    $datastring = "ZIPFILENAME";
    $datastring = $datastring.$fieldsep."appsynch_".$GLOBALS{'LOGIN_person_id'}."_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".zip";
    $datastring = $datastring.$fieldsep.$synchroniseappversion;
    $datastring = $datastring.$fieldsep."";
    print "$datastring".$recsep;
}

$synchupdataa = explode($recsep,$synchupdata);
foreach ($synchupdataa as $synchupdataelement) {
    if ($synchupdataelement != "") {
       // folder highestfiletimestamp
       $fielddataa = explode($fieldsep,$synchupdataelement);
       $folder = $fielddataa[0];
       $highestclientfiletimestamp = $fielddataa[1];
    
       $filenamea = Get_Directory_Array ("../".$folder);
       foreach ($filenamea as $filename) {
           $fbits = explode('_',$filename);
           if (($fbits[0] == "v1")||($filename == "sqldesign.csv")||($folder == "site_assets")) {
               $filetimestamp = "T".date("YmdHis",filemtime("../".$folder."/".$filename)-5); // allows for rounding errors               
               if ($GLOBALS{'site_server'} == "W") { // just for testing
                   if (($filetimestamp > $highestclientfiletimestamp)||(substr_count($filename, 'date') > 0)) { 
                        $datastring = $folder;
                        $datastring = $datastring.$fieldsep.$filename;
                        $datastring = $datastring.$fieldsep.$filetimestamp;
                        $datastring = $datastring.$fieldsep.$highestclientfiletimestamp;
                        print "$datastring".$recsep;
                        $zip->addFile("../".$folder."/".$filename,$folder."/".$filename);
                   }
               } else {  // this is the real one
                   if ($filetimestamp > $highestclientfiletimestamp) {
                       $datastring = $folder;
                       $datastring = $datastring.$fieldsep.$filename;
                       $datastring = $datastring.$fieldsep.$filetimestamp;
                       $datastring = $datastring.$fieldsep.$highestclientfiletimestamp;
                       print "$datastring".$recsep;
                       $zip->addFile($GLOBALS{'site_wwwpath'}."/".$folder."/".$filename,"www/".$folder."/".$filename);
                   }
               }
           }
       }  
    }
}
$zip->close();




=======
<?php 
require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');


Get_Common_Parameters();
GlobalRoutine();

$recsep = chr(135); // double cross
$fieldsep = chr(134); // dagger  

// ============ upload client timestamps =========================

$testorreal = $_REQUEST["TestorReal"];
$synchupdata = $_REQUEST["SynchUpData"];

Get_Data("site_dmws");
$synchroniseappversion = $GLOBALS{'site_synchroniseappversion'};

$zip = new ZipArchive();
$zipfilename = $GLOBALS{'site_filepath'}."/".$GLOBALS{'LOGIN_domain_id'}."/appsynch_".$GLOBALS{'LOGIN_person_id'}."_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".zip";
// $zipfilename = "aziptest.zip";

// touch($zipfilename); // seems to be required in wampserver

if ($zip->open($zipfilename, ZipArchive::CREATE) !== TRUE) {
    exit("cannot open <$zipfilename>\n");
} else {
    $datastring = "ZIPFILENAME";
    $datastring = $datastring.$fieldsep."appsynch_".$GLOBALS{'LOGIN_person_id'}."_".$GLOBALS{'yy'}.$GLOBALS{'mm'}.$GLOBALS{'dd'}.$GLOBALS{'acthh'}.$GLOBALS{'actmi'}.$GLOBALS{'actss'}.".zip";
    $datastring = $datastring.$fieldsep.$synchroniseappversion;
    $datastring = $datastring.$fieldsep."";
    print "$datastring".$recsep;
}

$synchupdataa = explode($recsep,$synchupdata);
foreach ($synchupdataa as $synchupdataelement) {
    if ($synchupdataelement != "") {
       // folder highestfiletimestamp
       $fielddataa = explode($fieldsep,$synchupdataelement);
       $folder = $fielddataa[0];
       $highestclientfiletimestamp = $fielddataa[1];
    
       $filenamea = Get_Directory_Array ("../".$folder);
       foreach ($filenamea as $filename) {
           $fbits = explode('_',$filename);
           if (($fbits[0] == "v1")||($filename == "sqldesign.csv")||($folder == "site_assets")) {
               $filetimestamp = "T".date("YmdHis",filemtime("../".$folder."/".$filename)-5); // allows for rounding errors               
               if ($GLOBALS{'site_server'} == "W") { // just for testing
                   if (($filetimestamp > $highestclientfiletimestamp)||(substr_count($filename, 'date') > 0)) { 
                        $datastring = $folder;
                        $datastring = $datastring.$fieldsep.$filename;
                        $datastring = $datastring.$fieldsep.$filetimestamp;
                        $datastring = $datastring.$fieldsep.$highestclientfiletimestamp;
                        print "$datastring".$recsep;
                        $zip->addFile("../".$folder."/".$filename,$folder."/".$filename);
                   }
               } else {  // this is the real one
                   if ($filetimestamp > $highestclientfiletimestamp) {
                       $datastring = $folder;
                       $datastring = $datastring.$fieldsep.$filename;
                       $datastring = $datastring.$fieldsep.$filetimestamp;
                       $datastring = $datastring.$fieldsep.$highestclientfiletimestamp;
                       print "$datastring".$recsep;
                       $zip->addFile($GLOBALS{'site_wwwpath'}."/".$folder."/".$filename,"www/".$folder."/".$filename);
                   }
               }
           }
       }  
    }
}
$zip->close();




>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>