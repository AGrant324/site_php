<?php # sqltest.php

$dbconnect = "sudoku";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "sudokulo_sudokulogicapp";
$hostconnect = "localhost";
$userconnect = "sudokulo_dbuser";
$pswconnect = "d1b2u3s4e5r6";

$inpuzzleseq = $_REQUEST["PuzzleSeq"];
$indelete = $_REQUEST["Delete"]; 
$intype = $_REQUEST["Type"];
$intitle = $_REQUEST["Title"];
$indescription = $_REQUEST["Description"];
$indifficulty = $_REQUEST["Difficulty"];
$ingrid = $_REQUEST["Grid"];
$insolution = $_REQUEST["Solution"];
$insolvingmode = $_REQUEST["SolvingMode"];
$insolvingmethods = $_REQUEST["SolvingMethods"];
$insolutionscore = $_REQUEST["SolutionScore"];
// ------------ The following only for examples --------------------
if (isset($_REQUEST['RemovedCandidates'])) { $inremovedcandidates = $_REQUEST["RemovedCandidates"]; } else { $inremovedcandidates = ""; }
if (isset($_REQUEST['MarkedCandidates'])) { $inmarkedcandidates = $_REQUEST["MarkedCandidates"]; } else { $inmarkedcandidates = ""; }
// ------------ The following only for competition puzzles --------------------
if (isset($_REQUEST['CompetitionDateStart'])) { $incompetitiondatestart = $_REQUEST["CompetitionDateStart"]; } else { $incompetitiondatestart = ""; }
if (isset($_REQUEST['CompetitionTimeStart'])) { $incompetitiontimestart = $_REQUEST["CompetitionTimeStart"]; } else { $incompetitiontimestart = ""; }
if (isset($_REQUEST['CompetitionDateEnd'])) { $incompetitiondateend = $_REQUEST["CompetitionDateEnd"]; } else { $incompetitiondateend = ""; }
if (isset($_REQUEST['CompetitionTimeEnd'])) { $incompetitiontimeend = $_REQUEST["CompetitionTimeEnd"]; } else { $incompetitiontimeend = ""; }
$errorcode = "0";
$errormessage = "";

$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">The database connection cannot be made.</p>';
    exit();
}
$sqlaction = "insert";
if ($intype == "Puzzle") {
	if ($inpuzzleseq == "new") {
		$highestpuzzleid = "P00000";	
		$sqlstring = "SELECT * FROM puzzles";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] > $highestpuzzleid) {  $highestpuzzleid = $row[0]; }
			}
		}
		$highestpuzzleseq = str_replace("P","",$highestpuzzleid);
		$nextseq = $highestpuzzleseq + 1;
		$seqstring = "00000".$nextseq;	
		$endseqstring = substr($seqstring, -5);;	
		$thispuzzleid = "P".$endseqstring;
	} else {
		$seqstring = "00000".$inpuzzleseq;
		$endseqstring = substr($seqstring, -5);;		
		$thispuzzleid = "P".$endseqstring;
		$sqlstring = "SELECT * FROM puzzles WHERE type = 'Puzzle'" ;
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] == $thispuzzleid) {  
					if ($indelete == "DELETE") { $sqlaction = "delete";  }					
					else { $sqlaction = "update"; } 
				}
			}
		}
		if ( $sqlaction == "insert" ) {
			if ($indelete == "DELETE") {			
				$errorcode = "1";
				$errormessage = "Puzzle ".$inpuzzleseq." does not exist";
			}			
		}
	}
}
if ($intype == "Example") {	
	if ($inpuzzleseq == "new") {
		$highestpuzzleid = "E00000";
		$sqlstring = "SELECT * FROM puzzles WHERE type = 'Example'";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] > $highestpuzzleid) {
					$highestpuzzleid = $row[0];
				}
			}
		}
		$highestpuzzleseq = str_replace("E","",$highestpuzzleid);
		$nextseq = $highestpuzzleseq + 1;
		$seqstring = "00000".$nextseq;
		$endseqstring = substr($seqstring, -5);;
		$thispuzzleid = "E".$endseqstring;
	} else {
		$seqstring = "00000".$inpuzzleseq;
		$endseqstring = substr($seqstring, -5);;		
		$thispuzzleid = "E".$endseqstring;
		$sqlstring = "SELECT * FROM puzzles";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] == $thispuzzleid) {
					if ($indelete == "DELETE") { $sqlaction = "delete";  }					
					else { $sqlaction = "update"; } 
				}
			}
		}
		if ( $sqlaction == "insert" ) {
			if ($indelete == "DELETE") {
				$errorcode = "1";
				$errormessage = "Example ".$inpuzzleseq." does not exist";
			}
		}
	}
}

if ($intype == "Competition") {
	if ($inpuzzleseq == "new") {
		$highestpuzzleid = "C00000";
		$sqlstring = "SELECT * FROM puzzles WHERE type = 'Competition'";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] > $highestpuzzleid) {
					$highestpuzzleid = $row[0];
				}
			}
		}
		$highestpuzzleseq = str_replace("C","",$highestpuzzleid);
		$nextseq = $highestpuzzleseq + 1;
		$seqstring = "00000".$nextseq;
		$endseqstring = substr($seqstring, -5);;
		$thispuzzleid = "C".$endseqstring;
	} else {
		$seqstring = "00000".$inpuzzleseq;
		$endseqstring = substr($seqstring, -5);;
		$thispuzzleid = "C".$endseqstring;
		$sqlstring = "SELECT * FROM puzzles";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] == $thispuzzleid) {
					if ($indelete == "DELETE") {
						$sqlaction = "delete";
					}
					else { $sqlaction = "update";
					}
				}
			}
		}
		if ( $sqlaction == "insert" ) {
			if ($indelete == "DELETE") {
				$errorcode = "1";
				$errormessage = "Competition Puzzle ".$inpuzzleseq." does not exist";
			}
		}
	}
}

if ($intype == "Onestep") {
	if ($inpuzzleseq == "new") {
		$highestpuzzleid = "O00000";
		$sqlstring = "SELECT * FROM puzzles WHERE type = 'Onestep'";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] > $highestpuzzleid) {
					$highestpuzzleid = $row[0];
				}
			}
		}
		$highestpuzzleseq = str_replace("O","",$highestpuzzleid);
		$nextseq = $highestpuzzleseq + 1;
		$seqstring = "00000".$nextseq;
		$endseqstring = substr($seqstring, -5);;
		$thispuzzleid = "O".$endseqstring;
	} else {
		$seqstring = "00000".$inpuzzleseq;
		$endseqstring = substr($seqstring, -5);;
		$thispuzzleid = "O".$endseqstring;
		$sqlstring = "SELECT * FROM puzzles";
		$r = mysqli_query($mysqli,$sqlstring);
		if (mysqli_num_rows($r) > 0) {
			while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
				if ($row[0] == $thispuzzleid) {
					if ($indelete == "DELETE") {
						$sqlaction = "delete";
					}
					else { $sqlaction = "update";
					}
				}
			}
		}
		if ( $sqlaction == "insert" ) {
			if ($indelete == "DELETE") {
				$errorcode = "1";
				$errormessage = "Onestep ".$inpuzzleseq." does not exist";
			}
		}
	}
}

if ( $errorcode == "0") {
	if ($sqlaction == "insert") {
		$sqlstring = "";
		$sqlstring = $sqlstring."INSERT INTO `".$dbconnect."`.`puzzles` ( `puzzleid` , `type` , `title` , `description` , `difficulty` , `grid` , `solution` , `solvingmode`, `solvingmethods`, `solutionscore`, `removedcandidates`, `markedcandidates`, `competitiondatestart`, `competitiontimestart`, `competitiondateend`, `competitiontimeend` )";
		$sqlstring = $sqlstring." VALUES (";
		$sqlstring = $sqlstring."'".$thispuzzleid."','".$intype."','".$intitle."','".$indescription."','".$indifficulty."','".$ingrid."','".$insolution."','".$insolvingmode."','".$insolvingmethods."','".$insolutionscore;
		$sqlstring = $sqlstring."','".$inremovedcandidates."','".$inmarkedcandidates."','".$incompetitiondatestart."','".$incompetitiontimestart."','".$incompetitiondateend."','".$incompetitiontimeend."'";
		$sqlstring = $sqlstring.");";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			$errorcode = "1";
			$errormessage = "sql insert error ". mysqli_error($mysqli);
		}
	}	
	if ($sqlaction == "update") {
		$sqlstring = "";
		$sqlstring = $sqlstring."UPDATE `".$dbconnect."`.`puzzles` SET ";
		$sqlstring = $sqlstring."type = '".$intype."', ";	
		$sqlstring = $sqlstring."title = '".$intitle."', ";
		$sqlstring = $sqlstring."description = '".$indescription."', ";			
		$sqlstring = $sqlstring."difficulty = '".$indifficulty."', ";	
		$sqlstring = $sqlstring."grid = '".$ingrid."', ";	
		$sqlstring = $sqlstring."solution = '".$insolution."', ";
		$sqlstring = $sqlstring."solvingmode = '".$insolvingmode."', ";
		$sqlstring = $sqlstring."solvingmethods = '".$insolvingmethods."', ";
		$sqlstring = $sqlstring."solutionscore = '".$insolutionscore."', ";
		$sqlstring = $sqlstring."removedcandidates = '".$inremovedcandidates."', ";
		$sqlstring = $sqlstring."markedcandidates = '".$inmarkedcandidates."', ";
		$sqlstring = $sqlstring."competitiondatestart = '".$incompetitiondatestart."', ";
		$sqlstring = $sqlstring."competitiontimestart = '".$incompetitiontimestart."', ";
		$sqlstring = $sqlstring."competitiondateend = '".$incompetitiondateend."', ";		
		$sqlstring = $sqlstring."competitiontimeend = '".$incompetitiontimeend."' ";					
		$sqlstring = $sqlstring."WHERE ( puzzleid = '".$thispuzzleid."');";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			$errorcode = "1";
			$errormessage = "sql update error ". mysqli_error($mysqli);
		}	
	}
	if ($sqlaction == "delete") {
		$sqlstring = "";
		$sqlstring = $sqlstring."DELETE FROM `".$dbconnect."`.`puzzles` ";
		$sqlstring = $sqlstring."WHERE ( puzzleid = '".$thispuzzleid."');";
		$r = mysqli_query($mysqli,$sqlstring);
		if (!$r) {
			$errorcode = "1";
			$errormessage = "sql delete error ". mysqli_error($mysqli);
		}		
	}
}
print $errorcode."|".$errormessage."|".$thispuzzleid."|".$indifficulty."|".$sqlaction."|SQL - ".$sqlstring;
?>

