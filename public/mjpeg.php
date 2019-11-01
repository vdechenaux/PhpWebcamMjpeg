<?php

use VDX\Webcam\Webcam;

require_once __DIR__.'/../vendor/autoload.php';

$webcam = new Webcam();
$webcam->setDesiredSize(1920, 1080);
if (!$webcam->open()) {
    die('Cannot open webcam');
}

set_time_limit(0);

header('Content-Type: multipart/x-mixed-replace; boundary="VDX_MJPEG_SERVER"');

$filename = tempnam(sys_get_temp_dir(), 'webcam').'.jpg';

while (!connection_aborted()) {
    if ($webcam->saveFrame($filename, true)) {
        echo "--VDX_MJPEG_SERVER\r\nContent-Type: image/jpeg\r\n\r\n";
        echo file_get_contents($filename);
        echo "\r\n";
        ob_flush();
        flush();
    }
}

echo "--VDX_MJPEG_SERVER--\r\n";

unlink($filename);
