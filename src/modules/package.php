<?php
fwrite(STDOUT, "输入需要打包的文件夹，以逗号分割，不输入为打包所有: ");
$name = trim(fgets(STDIN));

if (!is_dir('zips')) {
	mkdir('zips');
}

$dirs = [];

if (!empty($name)) {
	$names = explode(',', $name);
	array_filter($names);
	foreach ($names as $name) {
		$dirs[] = __DIR__.DIRECTORY_SEPARATOR.$name;
	}
}

if (empty($dirs)) {
	$dirs = scandir(__DIR__);
}

foreach ($dirs as $dir) {
	if ($dir != '.' && $dir != '..' && $dir != 'zips' && is_dir($dir)) {
		$name = basename($dir);
		$tmp = 'zips'.DIRECTORY_SEPARATOR.$name;
		recurse_copy($dir, $tmp);
		combineXML($tmp, $name);
		zipFiles($name);
		deldir(__DIR__.DIRECTORY_SEPARATOR.$tmp);
	}
}

function recurse_copy($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}


function combineXML($dir, $id) {
	$dir .= DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'vqmod'.DIRECTORY_SEPARATOR.'xml';
	$files = is_dir($dir) ? glob($dir.DIRECTORY_SEPARATOR.'*.xml', GLOB_BRACE) : array();
	
	if (empty($files)) {
		return;
	}

	$modification = <<<XML
<modification>
	<id>$id</id>
	<version>2.1.0.2</version>
	<vqmver>2.4.1</vqmver>
	<author></author>
</modification>
XML;

	$xml = new DOMDocument('1.0', 'UTF-8');
	$xml->formatOutput = true;
	$xml->preserveWhiteSpace = true;
	$xml->loadXml($modification);
	$modification = $xml->getElementsByTagName('modification')->item(0);
	$author = $modification->getElementsByTagName('author')->item(0);

	foreach ($files as $file) {
		$dom = parseXML($file);
		$fileTags = $dom->getElementsByTagName('modification')->item(0)->getElementsByTagName('file');
		$originAutor = $dom->getElementsByTagName('modification')->item(0)->getElementsByTagName('author');
		$author->textContent = $originAutor->item(0)->textContent;
		for ($i = 0; $i < $fileTags->length; $i++) {
			$fileTag = $fileTags->item($i);
			$fileTag = $xml->importNode($fileTag, true);
			$modification->appendChild($fileTag);
		}
		unlink($file);
	}
	$xml->save($dir.DIRECTORY_SEPARATOR.$id.'.xml');
}

function parseXML($file) {
	$xml = file_get_contents($file);
	$dom = new DOMDocument('1.0', 'UTF-8');
	$dom->preserveWhiteSpace = true;
	$dom->loadXml($xml);
	return $dom;
}

function zipFiles($name) {
	$zip = new ZipArchive();

	if (file_exists('zips'.DIRECTORY_SEPARATOR.$name.'.vqmod.zip')) {
		unlink('zips'.DIRECTORY_SEPARATOR.$name.'.vqmod.zip');
	}

	if ($zip->open('zips'.DIRECTORY_SEPARATOR.$name.'.vqmod.zip', ZipArchive::CREATE) == true) {
		chdir('zips'.DIRECTORY_SEPARATOR.$name);
		$handler = opendir('./');
		while (($filename = readdir($handler)) !== false) {
			if ($filename != "." && $filename != "..") {
				if (is_dir($filename)) {
					addFolderToZip($filename, $zip);
				} else {
					$zip->addFile($filename);
				}
			}
		}
		@closedir('./');
		$zip->close();
		chdir('../..');
	}
}

function addFolderToZip($path, $zip) {
	$handler = opendir($path);
	while (($filename = readdir($handler)) !== false) {
		if ($filename != "." && $filename != "..") {
			if (is_dir($path . "/" . $filename)) {
				addFolderToZip($path . "/" . $filename, $zip);
			} else {
				$zip->addFile($path . "/" . $filename);
			}
		}
	}
	@closedir($path);
}

function deldir($dir) {
	$dh = opendir($dir);
	while ($file = readdir($dh)) {
	    if ($file != "." && $file != "..") {
	      	$fullpath = $dir."/".$file;
		    if (!is_dir($fullpath)) {
		        unlink($fullpath);
		    } else {
		        deldir($fullpath);
		    }
	    }
	}
	 
	closedir($dh);

	if (rmdir($dir)) {
	    return true;
	} else {
	    return false;
	}
}