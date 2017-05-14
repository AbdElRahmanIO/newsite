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
$src = 'players/veeva_irep';
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

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/assets/img/img/bg.jpg';

  if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
  }
}

//
// S Get Full
//
for ($i=2; $i < $numofslides; $i++) {

  $file = $inputimages . $slidesname[$i];

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/' . $pkname . '_' . $results[$i] . '-full.jpg';

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

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/' . $pkname . '_' . $results[$i] . '-thumb.jpg';

  if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
  }
}


// rename index file

for ($i=2; $i < $numofslides; $i++) {
  rename('output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/index.html','output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/' . $pkname . '_' . $results[$i] . '.html');
}



// S6 Edite html files to change head title to slide name

for ($i=2; $i < $numofslides; $i++) {

  $indexspath = 'output/' . $presentationname . '/' . $pkname . '_' . $results[$i] . '/' . $pkname . '_' . $results[$i] . '.html';

  $file = fopen($indexspath,"w");
  fwrite($file,'<!DOCTYPE>
          <html>
          	<head>
          		<title>'. $pkname . '_' . $results[$i] .'</title>
          		<meta charset="UTF-8" />
          		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
          		<meta name="apple-mobile-web-app-capable" content="yes" />
          		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
          		<meta name="format-detection" content="telephone=no" />
          		<meta name="apple-mobile-web-app-capable" content="yes" />
          		<script type="text/javascript" src="assets/js/plugins.js"></script>
          		<link href="assets/css/style.css" rel="stylesheet" />
          		<link href="assets/css/animate.css" rel="stylesheet" />
          		<script src="assets/js/jquery.js"></script>
          		<script src="assets/js/scripts.js" type="text/javascript"></script>
          		<script src="assets/js/insert.js" type="text/javascript"></script>
          		<script type="text/javascript" src="assets/js/irep.js"></script>
          		<script type="text/javascript" src="assets/js/insert.js"></script>
          		<link rel="stylesheet" href="assets/css/animate.css" />
          		<script type="text/javascript" id="customs-js">
          			$(document).ready(function () {



          			});
          		</script>
          	</head>
          	<body>
          		<div id="Main_Container">



          		</div>
          	</body>
          </html>
  ');
  fclose($file);
}





header("Location: veeva_irep.php");
exit;

?>
