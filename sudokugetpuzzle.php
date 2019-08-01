<?php # sqltest.php

$dbconnect = "sudoku";
$hostconnect = "localhost";
$userconnect = "dbuser";
$pswconnect = "d1b2u3s4e5r6";

$dbconnect = "sudokulo_sudokulogicapp";
$hostconnect = "localhost";
$userconnect = "sudokulo_dbuser";
$pswconnect = "d1b2u3s4e5r6";

$indifficulty = "";
$intype = $_REQUEST["Type"];
$indifficulty = $_REQUEST["Difficulty"];
$inpuzzleposition = $_REQUEST["PuzzlePosition"];
$inspecificpuzzleseq = $_REQUEST["SpecificPuzzleSeq"];

$inspecificpuzzleseq = str_replace("P", "", $inspecificpuzzleseq);
$inspecificpuzzleseq = str_replace("E", "", $inspecificpuzzleseq);
$inspecificpuzzleseq = str_replace("O", "", $inspecificpuzzleseq);
$inspecificpuzzleseq = str_replace("C", "", $inspecificpuzzleseq);

// LatestPuzzle = "" && SpecificPuzzleSeq = "123"  => returns 123
// LatestPuzzle = "Latest" && SpecificPuzzleSeq = ""  => returns latest puzzle
// LatestPuzzle = "Next" && SpecificPuzzleSeq = "123"  => returns next puzzle following 123
// LatestPuzzle = "" && SpecificPuzzleSeq = ""  => returns random puzzle within difficulty

$puzzlefound = "";

$mysqli   = mysqli_connect($hostconnect, $userconnect, $pswconnect, $dbconnect);
if (mysqli_connect_errno($mysqli)) {
    echo '<p class="error">The database connection cannot be made.</p>';
    exit();
}

if ($intype == "Puzzle") {
	$sqlstring1 = "SELECT * FROM puzzles WHERE type = 'Puzzle'" ;
	$r = mysqli_query($mysqli,$sqlstring1);
	$tarray = Array();
	
	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			if (($indifficulty == "Any")||($indifficulty == "")) {
				if ($inspecificpuzzleseq != "") { array_push($tarray, $row[0]); }
				else { if ($row[4] != "UnSolved" ) { array_push($tarray, $row[0]); }   } 
			} else {
				if ($row[4] == $indifficulty ) {	
					array_push($tarray, $row[0]); 
				}
			}
		}
	}
	sort($tarray);
	if ($inspecificpuzzleseq != "") {
		$seqstring = "00000".$inspecificpuzzleseq;
		$endseqstring = substr($seqstring, -5);
		$thispuzzleid = "P".$endseqstring;
		if ($inpuzzleposition == "Next") {  //	megasolver loop - returns any difficulty type
			if ($thispuzzleid == "P00000") {			
				$thispuzzleid = $tarray[0];
				$puzzlefound = "";
			} else {			
				$tarrayindex = 0;
				$puzzlefound = "0";
				$thispuzzleidfound = "0";
				while (($tarrayindex < count($tarray))&&($thispuzzleidfound == "0")) {			
					if ($thispuzzleid == $tarray[$tarrayindex]) {
						$thispuzzleidfound = "1";					
						$nexttarrayindex = $tarrayindex + 1;
					}
					$tarrayindex++;
				}
				if ($thispuzzleidfound == "1") {			
					if ($nexttarrayindex <= count($tarray)-1) {
						$thispuzzleid = $tarray[$nexttarrayindex];
						$puzzlefound = "";
					}
				}
			}
		} 
	} else {
		if ($inpuzzleposition == "Latest") {
			$thispuzzleid = $tarray[sizeof($tarray)-1];	 
		} else {
			$randomindex = rand(0, (count($tarray)-1) );
			$thispuzzleid = $tarray[$randomindex];
		}
	}
}

if ($intype == "Onestep") {
	$sqlstring1 = "SELECT * FROM puzzles WHERE type = 'Onestep'" ;
	$r = mysqli_query($mysqli,$sqlstring1);
	$tarray = Array();

	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			if (($indifficulty == "Any")||($indifficulty == "")) {
				if ($inspecificpuzzleseq != "") {
					array_push($tarray, $row[0]);
				}
				else { if ($row[4] != "UnSolved" ) {
					array_push($tarray, $row[0]);
				}
				}
			} else {
				if ($row[4] == $indifficulty ) {
					array_push($tarray, $row[0]);
				}
			}
		}
	}
	sort($tarray);
	if ($inspecificpuzzleseq != "") {
		$seqstring = "00000".$inspecificpuzzleseq;
		$endseqstring = substr($seqstring, -5);
		$thispuzzleid = "O".$endseqstring;
		if ($inpuzzleposition == "Next") {
			//	megasolver loop - returns any difficulty type
			if ($thispuzzleid == "O00000") {
				$thispuzzleid = $tarray[0];
				$puzzlefound = "";
			} else {
				$tarrayindex = 0;
				$puzzlefound = "0";
				$thispuzzleidfound = "0";
				while (($tarrayindex < count($tarray))&&($thispuzzleidfound == "0")) {
					if ($thispuzzleid == $tarray[$tarrayindex]) {
						$thispuzzleidfound = "1";
						$nexttarrayindex = $tarrayindex + 1;
					}
					$tarrayindex++;
				}
				if ($thispuzzleidfound == "1") {
					if ($nexttarrayindex <= count($tarray)-1) {
						$thispuzzleid = $tarray[$nexttarrayindex];
						$puzzlefound = "";
					}
				}
			}
		}
	} else {
		if ($inpuzzleposition == "Latest") {
			$thispuzzleid = $tarray[sizeof($tarray)-1];
		} else {
			$randomindex = rand(0, (count($tarray)-1) );
			$thispuzzleid = $tarray[$randomindex];
		}
	}
}

if ($intype == "Competition") {
	$sqlstring1 = "SELECT * FROM puzzles WHERE type = 'Competition'" ;
	$r = mysqli_query($mysqli,$sqlstring1);
	$tarray = Array();

	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			if (($indifficulty == "Any")||($indifficulty == "")) {
				if ($inspecificpuzzleseq != "") {
					array_push($tarray, $row[0]);
				}
				else { if ($row[4] != "UnSolved" ) {
					array_push($tarray, $row[0]);
				}
				}
			} else {
				if ($row[4] == $indifficulty ) {
					array_push($tarray, $row[0]);
				}
			}
		}
	}
	sort($tarray);
	if ($inspecificpuzzleseq != "") {
		$seqstring = "00000".$inspecificpuzzleseq;
		$endseqstring = substr($seqstring, -5);
		$thispuzzleid = "C".$endseqstring;
		if ($inpuzzleposition == "Next") {
			//	megasolver loop - returns any difficulty type
			if ($thispuzzleid == "C00000") {
				$thispuzzleid = $tarray[0];
				$puzzlefound = "";
			} else {
				$tarrayindex = 0;
				$puzzlefound = "0";
				$thispuzzleidfound = "0";
				while (($tarrayindex < count($tarray))&&($thispuzzleidfound == "0")) {
					if ($thispuzzleid == $tarray[$tarrayindex]) {
						$thispuzzleidfound = "1";
						$nexttarrayindex = $tarrayindex + 1;
					}
					$tarrayindex++;
				}
				if ($thispuzzleidfound == "1") {
					if ($nexttarrayindex <= count($tarray)-1) {
						$thispuzzleid = $tarray[$nexttarrayindex];
						$puzzlefound = "";
					}
				}
			}
		}
	} else {
		if ($inpuzzleposition == "Latest") {
			$thispuzzleid = $tarray[sizeof($tarray)-1];
		} else {
			//===== find puzzle for relevant competition dates ====================
			$tarrayindex = 0;
			$puzzlefound = "0";
			$thispuzzleidfound = "0";
			$currentdate = date('Y-m-d');
			$currenttime = date("h:i:s");
			$currentdatetime = $currentdate."|".$currenttime;
			while (($tarrayindex < count($tarray))&&($thispuzzleidfound == "0")) {			
				$sqlstring2 = 'SELECT * FROM puzzles WHERE puzzleid = "'.$tarray[$tarrayindex].'";';
				$r = mysqli_query($mysqli,$sqlstring2);
				if (mysqli_num_rows($r) > 0) {
					$row = mysqli_fetch_array($r, MYSQL_ASSOC);
					$competitiondatestart = $row["competitiondatestart"];
					$competitiontimestart = $row["competitiontimestart"];
					$competitiondatetimestart = $competitiondatestart."|".$competitiontimestart;
					$competitiondateend = $row["competitiondateend"];		
					$competitiontimeend = $row["competitiontimeend"];
					$currentdatetime = $currentdate."|".$currenttime;
					$competitiondatetimeend = $competitiondateend."|".$competitiontimeend;
					if (($currentdatetime >= $competitiondatetimestart)&&($currentdatetime <= $competitiondatetimeend)) {
						$puzzlefound = "";
						$thispuzzleidfound = "1";
						$thispuzzleid = $tarray[$tarrayindex];
					}
				}
				$tarrayindex++;
			}
		}
	}
}

if ($intype == "Example") {
	$sqlstring1 = "SELECT * FROM puzzles WHERE type = 'Example'" ;
	$r = mysqli_query($mysqli,$sqlstring1);
	$tarray = Array();

	if (mysqli_num_rows($r) > 0) {
		while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
			if (($indifficulty == "Any")||($indifficulty == "")) {
		 	array_push($tarray, $row[0]);
		 }
		 else {
		  if ($row[4] == $indifficulty ) {
		  	array_push($tarray, $row[0]);
		  }
		 }
		}
	}
	sort($tarray);
	if ($inspecificpuzzleseq != "") {
		$seqstring = "00000".$inspecificpuzzleseq;
		$endseqstring = substr($seqstring, -5);;		
		$thispuzzleid = "E".$endseqstring;	
	} else {
		if ($inpuzzleposition == "Latest") {
			$thispuzzleid = $tarray[sizeof($tarray)-1];
		} else {
			$randomindex = rand(0, (count($tarray)-1) );
			$thispuzzleid = $tarray[$randomindex];
		}
	}
}	

if ($puzzlefound == "") {
	$sqlstring2 = 'SELECT * FROM puzzles WHERE puzzleid = "'.$thispuzzleid.'";';
	$r = mysqli_query($mysqli,$sqlstring2);
	if (mysqli_num_rows($r) > 0) {
		$row = mysqli_fetch_array($r, MYSQL_ASSOC);
		$type = $row["type"];
		$title = $row["title"];		
		$description = $row["description"];	
		$difficulty = $row["difficulty"];	
		$grid = $row["grid"];
		$solution = $row["solution"];
		$solvingmode = $row["solvingmode"];	
		$solvingmethods = $row["solvingmethods"];
		$solutionscore = $row["solutionscore"];
		$removedcandidates = $row["removedcandidates"];
		$markedcandidates = $row["markedcandidates"];
		$competitiondatestart = $row["competitiondatestart"];
		$competitiontimestart = $row["competitiontimestart"];
		$competitiondateend = $row["competitiondateend"];		
		$competitiontimeend = $row["competitiontimeend"];	
		$puzzlefound = "1";
		$printstring = $thispuzzleid."|".$type."|".$title."|".$description."|".$difficulty."|".$grid."|".$solution."|".$solvingmode."|".$solvingmethods."|".$solutionscore;		
		$printstring = $printstring."|".$removedcandidates."|".$markedcandidates."|".$competitiondatestart."|".$competitiontimestart."|".$competitiondateend."|".$competitiontimeend."|"."|";
		print $printstring;
	
	} else {
		$puzzlefound = "0";
	}
}
if ($puzzlefound == "0") {
	print $thispuzzleid."|"."Not Found"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|"."|".sizeof($tarray)."|".$sqlstring2;	
}

?> 