<?php

function addFolderToZip($dir, $zipArchive){
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {

            //Add the directory
            $zipArchive->addEmptyDir($dir);
           
            // Loop through all the files
            while (($file = readdir($dh)) !== false) {
           
                //If it's a folder, run the function again!
                if(is_dir($dir . $file)){
                    // Skip parent and root directories
                    if($file != "." && $file != ".."){
                        addFolderToZip($dir . $file . "/", $zipArchive);
                    }
                   
                }else{
                    // Add the files
                    $zipArchive->addFile($dir . $file);
                   
                }
            }
        }
    }
}

$zipFileName = "uploads.zip";
$zip = new ZipArchive;
if ($zip -> open($zipFileName, ZipArchive::CREATE) === TRUE)
{
	addFolderToZip("uploads/", $zip);
	if($zip ->close() === true)
	{
		header('Content-Disposition: attachment; filename="'.$zipFileName.'"');
		header("Content-type: application/zip");
		header("Content-Length: ".filesize($zipFileName));

		echo file_get_contents($zipFileName);
		unlink($zipFileName);
	}
}
