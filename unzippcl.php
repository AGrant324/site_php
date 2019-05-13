<?php 

require_once('pclzip.lib.php');

$infile = $_REQUEST["file"];

$file = $infile;
if (file_exists($file)) {
  echo "$file - File Exists</br>";
} else {
  echo "$file - File does not exist</br>";
}


// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);
echo "path - ".$path."</br>";

$archive = new PclZip($file);
// if ($archive->extract(PCLZIP_OPT_PATH, $path."/TMP") == 0) {
if ($archive->extract() == 0) {	
	die("Error : ".$archive->errorInfo(true));
} else {
	echo $file." - extracted </br>";	
}
	
	


?>