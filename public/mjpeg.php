<?php

use VDX\Webcam\Webcam;

require_once __DIR__.'/../vendor/autoload.php';

$webcam = new Webcam();
if (!$webcam->open()) {
    die('Cannot open webcam');
}

header('Content-Type: multipart/x-mixed-replace; boundary="VDX_MJPEG_SERVER"');

$filename = tempnam(sys_get_temp_dir(), 'webcam').'.jpg';

for ($i=0; $i<1000; $i++) {
    if ($webcam->saveFrame($filename)) {
        echo "--VDX_MJPEG_SERVER\r\nContent-Type: image/jpeg\r\n\r\n";
        echo file_get_contents($filename);
        echo "\r\n";
        ob_flush();
        flush();
    }
}

echo "--VDX_MJPEG_SERVER\r\n";

$webcam->close();

unlink($filename);
