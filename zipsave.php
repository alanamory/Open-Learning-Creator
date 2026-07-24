<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
header('Access-Control-Max-Age: 86400');
date_default_timezone_set('Africa/Johannesburg');



//$folder = $_GET['id'];
//if (!file_exists($folder)) {
//    mkdir($folder, 0777, true);
//}

$folder  = mt_rand(100000,999999);
mkdir($folder);
chmod ($folder, 0644);



function buildResources($fileZip, $resFolder){
  if (file_exists($fileZip)) {
      $zipFile = new ZipArchive();
      $zipFile->open($fileZip);
      $zipFile->extractTo($resFolder);
      $zipFile->close();
      $files = glob($resFolder.'*');
      $dir = getcwd();
      chdir($resFolder);
      $files = glob('*');
      foreach ($files as $file) {
          $change = preg_replace('/[^a-zA-Z0-9\-\._]/','_', $file);
          $change = str_replace(' ', '', $change); 
          rename($file,$change);
      }
      chdir($dir);
  }
}
$target = $folder.'/archive.zip';
move_uploaded_file( $_FILES['uploadedFile']['tmp_name'], $target);
buildResources($target, $folder);
unlink($target);
$data = file_get_contents($folder.'/index.html');
$data = str_replace('bgcolor="black"', 'style="background-color=transparent;"', $data);
file_put_contents($folder.'/index.html', $data);
echo $folder.'/index.html';


?>
