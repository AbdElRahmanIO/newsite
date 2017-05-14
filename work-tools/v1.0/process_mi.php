<?php

// S1 Copy And Create
$presentationname = $_POST["presname"];
$prodname = $_POST["prodname"];
$pkcountry = $_POST["pkcountry"];
// $pkname = 'PCSK9_KSA_001';
$pkname = $prodname . "_" . $pkcountry;


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
$src = 'players/mi';
$dst = 'output/' . $presentationname;
recurse_copy($src,$dst);


// S3 Get images BG Name

$inputimages = $_POST["inputimages"];
$inputimages = str_replace("\\","/",$inputimages);
$inputimages = $inputimages . '/';
echo $inputimages;
$slidesname = scandir($inputimages);
$results = [];
foreach($slidesname as $key => $value){
	$my_name_array = explode(".", $value);
	$results[$key] = $my_name_array[0];
}
$numofslides = count($results);




// S4 create folders for all slides need
//
for ($i=2; $i < $numofslides; $i++) {
  $src = 'output/' . $presentationname . '/001';
  $dst = 'output/' . $presentationname . '/' . $pkname . "_" . $results[$i];
  recurse_copy($src,$dst);
}



// S5 remove Mail slide
//
function deleteDirectory($path) {
    if (!file_exists($path)) {
        return true;
    }

    if (!is_dir($path)) {
        return unlink($path);
    }

    foreach (scandir($path) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($path . DIRECTORY_SEPARATOR . $item)) {
            return false;
            echo "no";
        }

    }

    return rmdir($path);
}
deleteDirectory('output/' . $presentationname . '/001');



// put images as background
//
for ($i=2; $i < $numofslides; $i++) {

  $file = $inputimages . $slidesname[$i];

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/media/images/bg.jpg';

  if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
  }
}
//
// S Get thumbs
//
$inputimagesthumbs = $_POST["inputimagesthumbs"];
$inputimagesthumbs = str_replace("\\","/",$inputimagesthumbs);
$inputimagesthumbs = $inputimagesthumbs . '/';
echo $inputimagesthumbs;
for ($i=2; $i < $numofslides; $i++) {

  $file = $inputimagesthumbs . $slidesname[$i];

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/media/images/thumbnails/200x150.jpg';

  if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
  }
}

// S6 Edite html files to change head title to slide name

for ($i=2; $i < $numofslides; $i++) {

  $indexspath = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/index.html';

  $file = fopen($indexspath,"w");
  fwrite($file,'﻿<!DOCTYPE>
      <html>
      	<head>
      		<title>'. $pkname .'</title>
      		<meta charset="UTF-8">
      		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      		<meta name="viewport" content="width=1024">
      		<meta name="viewport" content="initial-scale = 1.0, user-scalable = yes, maximum-scale = 2.0">
      		<meta name="apple-mobile-web-app-capable" content="yes">
      		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
      		<meta name="format-detection" content="telephone=no">
      		<script type="text/javascript" src="js/jquery.js"></script>
      		<script type="text/javascript" src="js/insert.js"></script>
      		<link rel="stylesheet" href="css/animate.css">
      		<link rel="stylesheet" href="css/style.css" type="text/css">
      		<script type="text/javascript">
      			$(document).ready(function () {



      			});
      		</script>
      	</head>
      	<body>
      		<div id="Main_Container">



      		</div><!-- Main_Container -->
      	</body>
      </html>

  ');
  fclose($file);
}






// S6 Edite XML files to add parameters
// $slidesnameforlinks = [];
//   $v = 0;
// for ($b=2; $b < $numofslides; $b++) {
//   $slidesnameforlinks[$v] = '<Link SequenceId="' . $pkname . '_' . $results[$b] . '" />
//   ';
//   $v++;
// }

  //print_r($slidesnameforlinks);
  $nomm = 0;
for ($i=2; $i < $numofslides; $i++) {

  $slidesnameforlinks = [];
    $v = 0;
  for ($b=2; $b < $numofslides; $b++) {
    $slidesnameforlinks[$v] = '<Link SequenceId="' . $pkname . '_' . $results[$b] . '" />
    ';
    $v++;
  }

  unset($slidesnameforlinks[$nomm]);
  $slidesnameforlinks = implode(" ", $slidesnameforlinks);

  $parameterspath = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/parameters/parameters.xml';
  $file = fopen($parameterspath,"w");

  fwrite($file,'<?xml version="1.0" standalone="yes"?>
<Sequence Id="'. $pkname . '_' . $results[$i] .'" Orientation="Landscape" xmlns="urn:param-schema">
  <Links>
    '.$slidesnameforlinks.'
  </Links>
</Sequence>');
  fclose($file);
  $nomm++;
  $slidesnameforlinks = explode(" ", $slidesnameforlinks);
}

// header("Location: mi.php");
// exit;

?>
