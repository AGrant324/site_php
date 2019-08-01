<<<<<<< HEAD
<?php # sqltest.php

$dbconnect = "sudoku";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "sudokulo_sudokulogicapp";
$hostconnect = "localhost";
$userconnect = "sudokulo_dbuser";
$pswconnect = "d1b2u3s4e5r6";

$innickname = $_REQUEST["nickname"];
$inpuzzleid = $_REQUEST["puzzleid"];
$inemail = $_REQUEST["email"];
$induration = $_REQUEST["duration"];
$insolutiona = $_REQUEST["solutiona"];
$inmovealist = $_REQUEST["movealist"];
$inlogicerrorcount = $_REQUEST["logicerrorcount"];
$inpsw = $_REQUEST["psw"];

$indate = date("Y-m-d");
$intime = date("h:i:s");

$errorcode = "0";
$errormessage = "";

$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    print "1|The database connection cannot be made.| | | | ";
    exit();
}

$responseexists = "0";
$sqlstring2 = 'SELECT * FROM compresponses WHERE nickname = "'.$innickname.'" AND puzzleid = "'.$inpuzzleid.'";';
$r = mysqli_query($mysqli,$sqlstring2);
if (mysqli_num_rows($r) > 0) {
    $responseexists = "1";
}

if ( $responseexists == "0" ) {
	$sqlstring = "";
	$sqlstring = $sqlstring."INSERT INTO `".$dbconnect."`.`compresponses` ( `nickname` , `puzzleid` , `email` , `date` , `time` , `duration` , `solutiona` ,`movealist` , `logicerrorcount` )";
	$sqlstring = $sqlstring." VALUES (";
	$sqlstring = $sqlstring."'".$innickname."','".$inpuzzleid."','".$inemail."','".$indate."','".$intime."','".$induration."','".$insolutiona."','".$inmovealist."','".$inlogicerrorcount."'";
	$sqlstring = $sqlstring.");";
	$r = mysqli_query($mysqli,$sqlstring);
	print "0|Response added.| | | | ".$sqlstring;
	exit();
} else {  /// user previously exists
	print "1|Response already exists.| | | | ".$sqlstring2;
	exit();
}

?>

=======
<?php # sqltest.php

$dbconnect = "sudoku";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "sudokulo_sudokulogicapp";
$hostconnect = "localhost";
$userconnect = "sudokulo_dbuser";
$pswconnect = "d1b2u3s4e5r6";

$innickname = $_REQUEST["nickname"];
$inpuzzleid = $_REQUEST["puzzleid"];
$inemail = $_REQUEST["email"];
$induration = $_REQUEST["duration"];
$insolutiona = $_REQUEST["solutiona"];
$inmovealist = $_REQUEST["movealist"];
$inlogicerrorcount = $_REQUEST["logicerrorcount"];
$inpsw = $_REQUEST["psw"];

$indate = date("Y-m-d");
$intime = date("h:i:s");

$errorcode = "0";
$errormessage = "";

$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    print "1|The database connection cannot be made.| | | | ";
    exit();
}

$responseexists = "0";
$sqlstring2 = 'SELECT * FROM compresponses WHERE nickname = "'.$innickname.'" AND puzzleid = "'.$inpuzzleid.'";';
$r = mysqli_query($mysqli,$sqlstring2);
if (mysqli_num_rows($r) > 0) {
    $responseexists = "1";
}

if ( $responseexists == "0" ) {
	$sqlstring = "";
	$sqlstring = $sqlstring."INSERT INTO `".$dbconnect."`.`compresponses` ( `nickname` , `puzzleid` , `email` , `date` , `time` , `duration` , `solutiona` ,`movealist` , `logicerrorcount` )";
	$sqlstring = $sqlstring." VALUES (";
	$sqlstring = $sqlstring."'".$innickname."','".$inpuzzleid."','".$inemail."','".$indate."','".$intime."','".$induration."','".$insolutiona."','".$inmovealist."','".$inlogicerrorcount."'";
	$sqlstring = $sqlstring.");";
	$r = mysqli_query($mysqli,$sqlstring);
	print "0|Response added.| | | | ".$sqlstring;
	exit();
} else {  /// user previously exists
	print "1|Response already exists.| | | | ".$sqlstring2;
	exit();
}

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
