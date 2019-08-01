<?php # sqltest.php

$dbconnect = "sudoku";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "sudokulo_sudokulogicapp";
$hostconnect = "localhost";
$userconnect = "sudokulo_dbuser";
$pswconnect = "d1b2u3s4e5r6";

$inpuzzleloadtextarea = $_REQUEST["puzzleloadtextarea"];
$puzzleloadtextarea = str_replace(array(" ", "\n", "\r"), '', $inpuzzleloadtextarea);
$puzzloadarray = explode(",", $puzzleloadtextarea);

$errorcode = "0";
$errormessage = "";

print "Content-type: text/html\n\n";
print '<h2>Sudoku Puzzle Loader</h2>';
$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">The database connection cannot be made.</p>';
    exit();
}

$highestpuzzleid = "P00000";	
$sqlstring = "SELECT * FROM puzzles";
$r = mysqli_query($mysqli,$sqlstring);
if (mysqli_num_rows($r) > 0) {
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
		if ($row[0] > $highestpuzzleid) {  $highestpuzzleid = $row[0]; }
	}
}
$highestpuzzleseq = str_replace("P","",$highestpuzzleid);

foreach ($puzzloadarray as $puzzloadarraystring) {
	if ($puzzloadarraystring != "") {
		$string = str_replace('.', '0', $puzzloadarraystring);
		$sbits = str_split($string);
		$ingrid = "";
		$sep = "";
		foreach ($sbits as $sbit) {
			$ingrid = $ingrid.$sep.$sbit;
			$sep = ",";
		}
		$nextseq = $highestpuzzleseq + 1;
		$seqstring = "00000".$nextseq;	
		$endseqstring = substr($seqstring, -5);;	
		$thispuzzleid = "P".$endseqstring;

		$sqlstring = "";
		$sqlstring = $sqlstring."INSERT INTO `".$dbconnect."`.`puzzles` ( `puzzleid` , `type` , `title` , `description` , `difficulty` , `grid` , `solution` , `solvingmode`, `solvingmethods`, `solutionscore`, `removedcandidates`, `markedcandidates` )";
		$sqlstring = $sqlstring." VALUES (";
		$sqlstring = $sqlstring."'".$thispuzzleid."','"."Puzzle"."','".""."','".""."','"."????"."','".$ingrid."','".$ingrid."','".""."','".""."','".""."'"."'"."'";
		$sqlstring = $sqlstring.");";
		print $thispuzzleid." added - ".$ingrid."<br/>\n";		
		$r = mysqli_query($mysqli,$sqlstring);
		$highestpuzzleseq = $nextseq;
	}
}

?>

