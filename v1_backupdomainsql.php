<<<<<<< HEAD
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// Note: Some sites require 127.0.0.1 rather than localhost to enable cron jobs to run mysql

ini_set('max_execution_time', 300);

Check_File("../../cronbackupdomainsqlparms.txt");
if ( $GLOBALS{'IOWARNING'} == "0" ) {
    $GLOBALS{'IOERRORcode'} = "G601";
    $GLOBALS{'IOERRORmessage'} = "config file not not found";
    $recordsa = Get_File_Array("../../cronbackupdomainsqlparms.txt");
    $parmsa = explode("|",$recordsa[0]);

    $GLOBALS{'LOGIN_service_id'} = $parmsa[0];
    $GLOBALS{'LOGIN_domain_id'} = $parmsa[1];
    $GLOBALS{'LOGIN_mode_id'} = $parmsa[2];
    
    $GLOBALS{'LOGIN_person_id'} = "";
    $GLOBALS{'LOGIN_session_id'} = "";
    $GLOBALS{'LOGIN_loginmode_id'} = "";
    $GLOBALS{'LOGIN_menu_id'} = ""; 
    
    GlobalRoutine();
    
    Backup_Domain ();
       
} 



=======
<?php

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');
require_once('v1_personroutines.php');

// Note: Some sites require 127.0.0.1 rather than localhost to enable cron jobs to run mysql

ini_set('max_execution_time', 300);

Check_File("../../cronbackupdomainsqlparms.txt");
if ( $GLOBALS{'IOWARNING'} == "0" ) {
    $GLOBALS{'IOERRORcode'} = "G601";
    $GLOBALS{'IOERRORmessage'} = "config file not not found";
    $recordsa = Get_File_Array("../../cronbackupdomainsqlparms.txt");
    $parmsa = explode("|",$recordsa[0]);

    $GLOBALS{'LOGIN_service_id'} = $parmsa[0];
    $GLOBALS{'LOGIN_domain_id'} = $parmsa[1];
    $GLOBALS{'LOGIN_mode_id'} = $parmsa[2];
    
    $GLOBALS{'LOGIN_person_id'} = "";
    $GLOBALS{'LOGIN_session_id'} = "";
    $GLOBALS{'LOGIN_loginmode_id'} = "";
    $GLOBALS{'LOGIN_menu_id'} = ""; 
    
    GlobalRoutine();
    
    Backup_Domain ();
       
} 



>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>