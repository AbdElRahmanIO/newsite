<?php

function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
          if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
              continue;

          $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
      }

    return $zip->close();
}


Zip('test', 'test.zip');
