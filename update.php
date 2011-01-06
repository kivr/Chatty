<?php
	// function from http://www.php.net/rm_dir - Andreas Kalsch (akidee.de)
	function deleteDir($dir)
	{
	   if (substr($dir, strlen($dir)-1, 1) != '/')
	       $dir .= '/';
	   if ($handle = opendir($dir))
	   {
	       while ($obj = readdir($handle))
	       {
		   if ($obj != '.' && $obj != '..')
		   {
		       if (is_dir($dir.$obj))
		       {
		           if (!deleteDir($dir.$obj))
		               return false;
		       }
		       elseif (is_file($dir.$obj))
		       {
		           if (!unlink($dir.$obj))
		               return false;
		       }
		   }
	       }
	       closedir($handle);

	       if (!@rmdir($dir))
		   return false;
	       return true;
	   }
	   return false;
	}

	function clean()
	{
		$dir = opendir(dirname(__FILE__));
		while($entry = readdir($dir))
		{
			if($entry != basename(__FILE__)
				&& $entry != "."
				&& $entry != ".."){
				
				if(is_dir($entry))
					deleteDir($entry);
				else
					unlink($entry);
			}
		}
		closedir($dir);
	}

	function download($zipFile)
	{
		$data = file_get_contents(
			"https://github.com/kivr/Chatty/zipball/master");
		if($data === FALSE)
			fail();
		file_put_contents($zipFile, $data);
	}

	function inflate($zipFile)
	{
		$zip = zip_open($zipFile);
		if(is_resource($zip))
		{
			$entry = zip_read($zip);
			$dirName = zip_entry_name($entry);
			zip_close($zip);

			$zip = new ZipArchive;
			if($zip->open($zipFile) === TRUE)
			{
				$zip->extractTo(".");
				$zip->close();

				$dir = opendir($dirName);
				while($file = readdir($dir))
				{
					if($file != "."	&& $file != "..")

						rename($dirName.$file, $file);
				}
				closedir($dir);
				rmdir($dirName);
				unlink($zipFile);
			}
			else
				fail();
		}
		else
			fail();
	}

	function fail()
	{
		echo("BUILD FAILED");
		exit(0);
	}

	$zipFile = "chatty.zip";
	clean();
	download($zipFile);
	inflate($zipFile);

	echo("BUILD SUCCEEDED!");
