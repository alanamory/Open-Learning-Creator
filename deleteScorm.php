<?php

function deleteDirectory($dirPath) {
    if (!is_dir($dirPath)) {
        return;
    }

    $files = glob($dirPath . '/*');
    foreach ($files as $file) {
        if (is_dir($file)) {
            // Recursively call function for subdirectories
            deleteDirectory($file);
        } else {
            // Delete files
            unlink($file);
        }
    }
    // Remove the now-empty directory
    rmdir($dirPath);
}

// Usage:
$time = $_POST['time'];
echo '+++++temp/'.$time;
deleteDirectory('temp/'.$time);

?>
