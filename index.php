<?php

if ($_SERVER['REQUEST_METHOD'] === "GET" && $_SERVER['REQUEST_URI'] === '/test') {
    $header = "Content-Type: text/event-stream";

    header($header);
    header("Cache-control: no-cache");
    ob_flush();

    for ($i = 1; $i <= 100; $i++) {
        print "id: $i" . PHP_EOL;
        print "event: onProgress" . PHP_EOL;
        print "data: $i" . PHP_EOL;
        print PHP_EOL;
        usleep(100000);
        ob_flush();
    }
} else {
    require_once './template.php';
}
