<?php

require_once __DIR__ . '/../vendor/autoload.php';

\Embryo\Embed\Installer::writeCacheFile();

$urls = [
    'https://www.youtube.com/watch?v=Us6TDxO9ItM',
    'https://www.dailymotion.com/video/x6ok5hl',
    'https://vimeo.com/41174743',
];

foreach ($urls as $url) {
    $embed = new \Embryo\Embed\Embed($url);
    try {
        echo $embed->getEmbeddedCode();
    } catch (\Embryo\Embed\Exceptions\EmbedException $e) {
        echo $e->getMessage() . '<br>';
    }
}
