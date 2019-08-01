<<<<<<< HEAD
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

$poststring = "";
foreach ($_POST as $key => $value) {
    $poststring = $poststring.$key."=".$value."|";
}
*/

Get_Common_Parameters();
GlobalRoutine();

$fileuploadpath = $GLOBALS{'domainfilepath'}."/assets";

$uploaddir = realpath($fileuploadpath).'/';
$uploadfile = $uploaddir . basename($_FILES['file_contents']['name']);
if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
    // echo "File is valid, and was successfully uploaded. - ".$uploadfile."|".$poststring."\n";
    echo "File is valid, and was successfully uploaded.\n";
} else {
    // echo "ERROR: There was a problem uploading this file - ".$uploadfile."|".$poststring."\n";
    echo "ERROR: There was a problem uploading this file.\n";
}

=======
<?php 

require_once('v1_globalroutines.php');
require_once('v1_ioroutines.php');

/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

$poststring = "";
foreach ($_POST as $key => $value) {
    $poststring = $poststring.$key."=".$value."|";
}
*/

Get_Common_Parameters();
GlobalRoutine();

$fileuploadpath = $GLOBALS{'domainfilepath'}."/assets";

$uploaddir = realpath($fileuploadpath).'/';
$uploadfile = $uploaddir . basename($_FILES['file_contents']['name']);
if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
    // echo "File is valid, and was successfully uploaded. - ".$uploadfile."|".$poststring."\n";
    echo "File is valid, and was successfully uploaded.\n";
} else {
    // echo "ERROR: There was a problem uploading this file - ".$uploadfile."|".$poststring."\n";
    echo "ERROR: There was a problem uploading this file.\n";
}

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
?>