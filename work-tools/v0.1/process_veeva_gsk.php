<?php

// S1 Copy And Create
$presentationname = $_POST["presname"];
$pkcountry = $_POST["pkcountry"];
$prodname = $_POST["prodname"];
$pkyear = $_POST["pkyear"];
$pkcountryv = $_POST["pkcountryv"];
$pkv = "V" . $_POST["pkv"];
// $pkname = 'SA_Lamictal_Keppra_2017_SA1.0_V1.0';
$pkname = $pkcountry . "_" . $prodname . "_" . $pkyear . "_" . $pkcountry . $pkcountryv . "_" . $pkv;


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
$src = 'players/veeva_gsk';
$dst = 'output/' . $presentationname;
recurse_copy($src,$dst);

// S2 Rename

rename("output/" .$presentationname. "/_MAIN","output/" . $presentationname . "/" .$pkname."_MAIN");
rename("output/" .$presentationname. "/_ADD","output/" . $presentationname . "/" .$pkname."_ADD");
rename("output/" .$presentationname. "/_RES","output/" . $presentationname . "/" .$pkname."_RES");

// S3 Get images BG Name

$inputimages = $_POST["inputimages"];
$slidesname = scandir($inputimages);
// print_r($slidesname);
$results = [];
foreach($slidesname as $key => $value){
	$my_name_array = explode(".", $value);
	$results[$key] = $my_name_array[0];
}

$numofslides = count($results);

// print_r($results);

// S4 create folders for all slides need

for ($i=2; $i < $numofslides; $i++) {
  $src = 'output/' . $presentationname . '/' . $pkname . '_MAIN/_001';
  $dst = 'output/' . $presentationname . '/' . $pkname . '_MAIN/' . $pkname . "_" . $results[$i];
  recurse_copy($src,$dst);
}

// S5 remove Mail slide

// rmdir('output/'.$presentationname.'/'.$pkname.'_MAIN/_001');
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
deleteDirectory('output/' . $presentationname . '/' . $pkname. '_MAIN/_001');


// put images as background



for ($i=2; $i < $numofslides; $i++) {

  $file = $inputimages . $slidesname[$i];
  // print_r($file);

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_MAIN/' . $pkname . '_' . $results[$i] . '/media/images/background.png';
  //print_r($newfile);

  if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
  }
}

// S Get thumbs

$inputimagesthumbs = $_POST["inputimagesthumbs"];
for ($i=2; $i < $numofslides; $i++) {

  $file = $inputimagesthumbs . $slidesname[$i];
  // print_r($file);

  $newfile = 'output/' . $presentationname . '/' . $pkname . '_MAIN/' . $pkname . '_' . $results[$i] . '/thumb.png';
  //print_r($newfile);

  if (!copy($file, $newfile)) {
      echo "failed to copy $file...\n";
  }
}

// print_r($bgimages);
// print_r($slidesdire);
// print_r($results);

// S6 Edite html files to change head title to slide name

for ($i=2; $i < $numofslides; $i++) {

  $indexspath = 'output/' . $presentationname . '/' . $pkname . '_MAIN/' . $pkname . '_' . $results[$i] . '/index.html';

  $file = fopen($indexspath,"w");
  fwrite($file,'<!DOCTYPE html>
  <html>
  	<head>
  		<title>'. $pkname . '_' . $results[$i] .'</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="format-detection" content="telephone=no">
      <meta name="msapplication-tap-highlight" content="no" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" href="../shared/css/core.css" type="text/css" charset="utf-8"/>
      <link rel="stylesheet" href="../shared/css/custom.css" type="text/css" charset="utf-8"/>
      <link rel="stylesheet" href="../shared/css/presentation.css" type="text/css" charset="utf-8"/>
      <link rel="stylesheet" href="css/local.css" type="text/css" charset="utf-8"/>
</head>
<body>
  <div id="container">
    <!-- Left and right double click navigation -->
    <div id="doubleClickLeft"></div>
      <div id="doubleClickRight"></div>
      <!-- Portrait mode double click zoom -->
      <div id="doubleClickCentre" style="display:none"></div>

      <!-- slide html -->
      <div class="mainContent">
        <div class="pageTitle">

        </div>
        <div class="bodyText">

        </div>


      </div>
      <div class="zincCode">
        XX/XX/0000/00<br/>
          Date of Preperation: August 2015
      </div>
      <!-- end of slide html -->

  <!-- mtgsk html -->
  <div class="header">
    <div class="mainLogo" id="logo"></div>
  </div>
  <div class="footer">
  </div>
  <div class="navBottom">
    <div id="home"></div>
    <div id="menu" class="active"></div>
    <div id="pi"></div>
    <div id="references"></div>
  </div>
  <!-- end mtgsk html -->

  </div>

<!-- Background settings required for pdf style portrait mode zoom -->
<div class="bg" id="bg" style="width: 1024px; height: 768px;"><img style="display: block; margin: 0 auto;" src="media/images/background.png" height="768" /></div>
<script src="../shared/js/jquery.js"></script>
<script src="../shared/js/jquery-ui.js"></script>
<script src="../shared/js/jquery.ui.touch-punch.js"></script>
<script src="../shared/js/veeva-library-4.1.js"></script>
<script src="../shared/js/swipetourl.js"></script>
<script src="../shared/js/config.json"></script>
<script src="../shared/js/functions.js"></script>
<script src="../shared/js/core.js"></script>
<script src="../shared/js/presentation.js"></script>
<script src="js/local.js"></script>
</body>
</html>

  ');
  fclose($file);
}

//print_r($numofslides - 2);

header("Location: index.php");
exit;

?>
