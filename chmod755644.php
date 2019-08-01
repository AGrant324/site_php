

 <?php
//http://www.webhostingtalk.com/showthread.php?t=218863
$start_dir = 'public_html'; // Starting directory no trailing slashes.
$perms['file'] = 0644; // chmod value for files don't enclose value in quotes.
$perms['folder'] = 0755; // chmod value for folders don't enclose value in quotes.

function chmod_file_folder($dir) {
    global $perms;
        
    $dh=@opendir($dir);
    
    if ($dh) {
        
        while (false!==($file = readdir($dh))) {
            
            if($file!="." && $file!="..") {
                
                $fullpath = $dir .'/'. $file;
                if(!is_dir($fullpath)) {
                    
                    if(chmod($fullpath, $perms['file'])) {
                        echo "\n<br><span style=\"font-weight:bold;\">File</span> ". $fullpath .' permissions changed to '. decoct($perms['file']);
                    }else {
                        echo "\n<br><span style=\"font-weight:bold; color:#ff0000;\">Failed</span> to set file permissions on ". $fullpath;
                    }
                }else {
                    
                    if(chmod($fullpath, $perms['folder'])) {
                        echo "\n<br><span style=\"font-weight:bold;\">Directory</span> ". $fullpath .' permissions changed to '. decoct($perms['folder']);
                        chmod_file_folder($fullpath);
                    }else {
                        echo "\n<br><span style=\"font-weight:bold; color:#ff0000;\">Failed</span> to set directory permissions on ". $fullpath;
                    }
                }
            }
        }
        closedir($dh);
    }
}

chmod_file_folder($start_dir);



?>