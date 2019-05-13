<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// Note: Some sites require 127.0.0.1 rather than localhost to enable cron jobs to run mysql

ini_set('max_execution_time', 300);

Check_File("../../cronbackupdomaintriggerparms.txt");
if ( $GLOBALS{'IOWARNING'} == "0" ) {
    $GLOBALS{'IOERRORcode'} = "G601";
    $GLOBALS{'IOERRORmessage'} = "trigger config file not not found";
    $recordsa = Get_File_Array("../../cronbackupdomaintriggerparms.txt");
    $parmsa = explode("|",$recordsa[0]);

    $GLOBALS{'LOGIN_service_id'} = $parmsa[0];
    $GLOBALS{'LOGIN_domain_id'} = $parmsa[1];
    $GLOBALS{'LOGIN_mode_id'} = $parmsa[2];
    $GLOBALS{'LOGIN_person_id'} = "";
    $GLOBALS{'LOGIN_session_id'} = "";
    $GLOBALS{'LOGIN_loginmode_id'} = "";
    $GLOBALS{'LOGIN_menu_id'} = ""; 
    
    GlobalRoutine();

    $GLOBALS{'codeversion'} = 'v1';
    Get_Data("domain");

    $url = "https:".$GLOBALS{'domainwwwurl'}."/site_php/".$GLOBALS{'codeversion'}."_backupdomainsql.php";
    
    $ch = curl_init();

    // set URL and other appropriate options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // grab URL and pass it to the browser
    curl_exec($ch);

    // close cURL resource, and free up system resources
    curl_close($ch);
    
    XTXT($GLOBALS{'LOGIN_domain_id'}." database backup initiated - ".$url);
} 



?>