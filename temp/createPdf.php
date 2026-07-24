<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$htmlData = $_POST['data'];
$bookFilename = $_POST['filename'];
$filename = time();
file_put_contents($filename.'.html', $htmlData);
echo $filename.'.html';

/*function executeCoverPage($htmlData, $bookFilename){
  $filename = time();
  file_put_contents($filename.'.html', $htmlData);
  //if ($_SERVER['HTTP_HOST'] ==='localhost') {
    $cmd = '/usr/local/bin/prince  --raster-dpi=300 '.$filename.'.html -o '.$bookFilename;
  //}  else {
  //  $cmd = '/usr/bin/prince --raster-dpi=300 '.$filename.'.html -o '.$bookFilename;
  //}
  
  //echo $cmd;
  $output = shell_exec($cmd);
  //echo $bookFilename;
  chmod($bookFilename, 0777);
  //echo filesize($bookFilename);
  
  header('Content-type: application/pdf');
  $header = 'Content-Disposition: attachment; filename="'.$bookFilename;
  header($header);
  header("Content-Length: " . filesize($bookFilename));
  if (readfile($bookFilename) ) {
    //unlink($filename.".html");
    //unlink($bookFilename);
  }
}*/

/*
$regex = '/<\/div><\/div>([\s\S]*?)<div style="max-width:720px/';
preg_match($regex, $htmlData, $matches);

if (!empty($matches[1])) {
    echo $matches[1];   // the extracted content
}*/

//executeCoverPage($htmlData, $bookFilename);

?>