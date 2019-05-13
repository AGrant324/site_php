<?php 
	print"<html>\n";
	print"<head>\n";
	
	
	print'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
	
	$alphaa = Array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$booklefta = Array('/','[','|');
	$bookrighta = Array('/',']','|');
	
	print"</head>\n";
	print"<body>\n"; 
	 
	$langcode = $_POST['langcode'];
    $password = $_POST['password'];
	$langinput = $_POST['langinput'];
	 
	$passwordOK = false;
	if (($langcode == "ar")&&($password == "jr17wU8O")) { $passwordOK = true; }  
	if (($langcode == "zh")&&($password == "1v8l4gSY")) { $passwordOK = true; }  
	if (($langcode == "en")&&($password == "GZgFM1dA")) { $passwordOK = true; }  
	if (($langcode == "fr")&&($password == "t2ymzL7J")) { $passwordOK = true; }  
	if (($langcode == "de")&&($password == "v8hVWZLW")) { $passwordOK = true; }  
	if (($langcode == "es")&&($password == "c8X3K20x")) { $passwordOK = true; }  
	if (($langcode == "it")&&($password == "K4870DWo")) { $passwordOK = true; } 
	if (($langcode == "hu")&&($password == "Mi2Jm2GI")) { $passwordOK = true; } 
	if (($langcode == "gr")&&($password == "45P4gDgV")) { $passwordOK = true; }
	if ($password == "7vxHxVHG") { $passwordOK = true; }

	if  ($passwordOK == true) {
		print "<h1>Sudoku Language Upload</h1>";
		
		print "file uploaded (".$langcode.")<br><br>";
		
		$jsona = explode('^', $langinput);
	
		$myfile = fopen("../lang/".$langcode.".json", "w") or die("Unable to open file!");
		fwrite($myfile, pack("CCC",0xef,0xbb,0xbf)); 
		$first = "1";
		$sample =0;
		foreach ($jsona as $record) {
			$sample++;
			for ($i = 0; $i < 3; $i++) {
				for ($a = 0; $a < 26; $a++) {
					$stringtoreplace = $booklefta[$i]." ".$alphaa[$a]." ".$bookrighta[$i];
					$stringreplacedby = $booklefta[$i].$alphaa[$a].$bookrighta[$i];
					// if ($sample == 12) { print  "** ".$stringtoreplace." ** ".$stringreplacedby."  **<br/>";}
					$record = str_replace($stringtoreplace,$stringreplacedby,$record);
					
				}
			}			
			
			if ($first == "1") {
				$first = "0";
				print  "[<br/>";
				fwrite($myfile,  '[');
				
			} else {
				print  $record."<br/>";
				fwrite($myfile,  $record);
			}
			 
		}
		fclose($myfile); 
		
		print "<h3>Language successfully updated - ".$langcode.".json"."</h3>";
		
	} else {
		print "invalid password";
	}

	print"</body>\n";
	print"</html>\n";

?>

