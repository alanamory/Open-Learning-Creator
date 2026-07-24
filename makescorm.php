<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';



function zipFolder($source, $destination)
{
    $zip = new ZipArchive();

    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }
    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($files as $file)
        {

            $file = str_replace('\\', '/', $file);
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;
            $file = realpath($file);
           
            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if ($ext === 'php') {
                  //echo 'do nothing - '.PHP_EOL;
                } elseif (strpos($file, '_Store') > 1) {
                  //echo 'do nothing STORE '.PHP_EOL;
                } else {
                  $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }
    return $zip->close();
}

//data: output, time: id, scorm: scm, title: aname 



$scorm = $_POST['scorm'];
$data = $_POST['data'];
$time = $_POST['time'];
$title = $_POST['title'];


mkdir('temp/'.$time, 0777, true);
file_put_contents('temp/'.$time.'/imsmanifest.xml', $scorm);
chmod('temp/'.$time.'/imsmanifest.xml', 0777);

$filename = 'temp/'. $time.'/index.html';
file_put_contents($filename, $data);

//if (!is_dir('web/'.$id)) {
//    mkdir('web/'.$id, 0777, true);
//}
//file_put_contents($filename, $data);

$rootFolder = 'temp/'.$time.'/';
$zipName = 'temp/'.$time.'/'.$title.'_scorm.zip';
zipFolder($rootFolder, $zipName);


echo $zipName;




?>