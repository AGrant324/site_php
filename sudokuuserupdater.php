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
$inemail = $_REQUEST["email"];
$infname = $_REQUEST["fname"];
$insname = $_REQUEST["sname"];
$inpsw = $_REQUEST["psw"];
$inaction = $_REQUEST["action"];  // "A" = add, "C"=change  "D"=delete

$errorcode = "0";
$errormessage = "";

$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">The database connection cannot be made.</p>';
    exit();
}

$userexists = "0";
$sqlstring2 = 'SELECT * FROM compusers WHERE nickname = "'.$innickname.'";';
$r = mysqli_query($mysqli,$sqlstring2);
if (mysqli_num_rows($r) > 0) {
	$userexists = "1";
}

if ( $userexists == "0" ) {
	if ( $inaction == "A" ) {
		$sqlstring = "";
		$sqlstring = $sqlstring."INSERT INTO `".$dbconnect."`.`compusers` ( `nickname` , `email` , `fname` , `sname` , `psw` )";
		$sqlstring = $sqlstring." VALUES (";
		$sqlstring = $sqlstring."'".$innickname."','".$inemail."','".$infname."','".$insname."','".$inpsw."'";
		$sqlstring = $sqlstring.");";
		$r = mysqli_query($mysqli,$sqlstring);
		print "0|User added.| | | | ".$sqlstring;;
		exit();
	} else {
		print "1|User does not exist.| | | | ".$sqlstring;;
		exit();
	}
} else {  /// user previously exists
	if ( $inaction == "C" ) {
		$sqlstring = "";
		$sqlstring = $sqlstring."UPDATE `".$dbconnect."`.`compusers` SET ";
		$sqlstring = $sqlstring."nickname = '".$innickname."', ";		
		$sqlstring = $sqlstring."email = '".$inemail."', ";	
		$sqlstring = $sqlstring."fname = '".$infname."', ";			
		$sqlstring = $sqlstring."sname = '".$insname."', ";	
		$sqlstring = $sqlstring."psw = '".$inpsw."' ";					
		$sqlstring = $sqlstring."WHERE ( email = '".$inemail."');";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			print "1|User does not exist.| | | | ".$sqlstring;;
			exit();
		}	
		print "0|User changed.| | | | ".$sqlstring;;
		exit();
	} 
	if ( $inaction == "D" ) {
		$sqlstring = "";
		$sqlstring = $sqlstring."DELETE FROM `".$dbconnect."`.`compusers` ";
		$sqlstring = $sqlstring."WHERE ( nickname = '".$innickname."');";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			print "1|Error: User cannot be deleted.| | | | ".$sqlstring;;
		exit();
		}	
		print "0|User deleted.| | | | ".$sqlstring;;
		exit();
	}
	if ( $inaction == "A" ) {	
		print "1|User already exists.| | | | ".$sqlstring;;
		exit();
	}
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
$inemail = $_REQUEST["email"];
$infname = $_REQUEST["fname"];
$insname = $_REQUEST["sname"];
$inpsw = $_REQUEST["psw"];
$inaction = $_REQUEST["action"];  // "A" = add, "C"=change  "D"=delete

$errorcode = "0";
$errormessage = "";

$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">The database connection cannot be made.</p>';
    exit();
}

$userexists = "0";
$sqlstring2 = 'SELECT * FROM compusers WHERE nickname = "'.$innickname.'";';
$r = mysqli_query($mysqli,$sqlstring2);
if (mysqli_num_rows($r) > 0) {
	$userexists = "1";
}

if ( $userexists == "0" ) {
	if ( $inaction == "A" ) {
		$sqlstring = "";
		$sqlstring = $sqlstring."INSERT INTO `".$dbconnect."`.`compusers` ( `nickname` , `email` , `fname` , `sname` , `psw` )";
		$sqlstring = $sqlstring." VALUES (";
		$sqlstring = $sqlstring."'".$innickname."','".$inemail."','".$infname."','".$insname."','".$inpsw."'";
		$sqlstring = $sqlstring.");";
		$r = mysqli_query($mysqli,$sqlstring);
		print "0|User added.| | | | ".$sqlstring;;
		exit();
	} else {
		print "1|User does not exist.| | | | ".$sqlstring;;
		exit();
	}
} else {  /// user previously exists
	if ( $inaction == "C" ) {
		$sqlstring = "";
		$sqlstring = $sqlstring."UPDATE `".$dbconnect."`.`compusers` SET ";
		$sqlstring = $sqlstring."nickname = '".$innickname."', ";		
		$sqlstring = $sqlstring."email = '".$inemail."', ";	
		$sqlstring = $sqlstring."fname = '".$infname."', ";			
		$sqlstring = $sqlstring."sname = '".$insname."', ";	
		$sqlstring = $sqlstring."psw = '".$inpsw."' ";					
		$sqlstring = $sqlstring."WHERE ( email = '".$inemail."');";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			print "1|User does not exist.| | | | ".$sqlstring;;
			exit();
		}	
		print "0|User changed.| | | | ".$sqlstring;;
		exit();
	} 
	if ( $inaction == "D" ) {
		$sqlstring = "";
		$sqlstring = $sqlstring."DELETE FROM `".$dbconnect."`.`compusers` ";
		$sqlstring = $sqlstring."WHERE ( nickname = '".$innickname."');";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			print "1|Error: User cannot be deleted.| | | | ".$sqlstring;;
		exit();
		}	
		print "0|User deleted.| | | | ".$sqlstring;;
		exit();
	}
	if ( $inaction == "A" ) {	
		print "1|User already exists.| | | | ".$sqlstring;;
		exit();
	}
}

?>

>>>>>>> cbec31bba2128f8cfeb22fb0fa44e631f2c483fa
