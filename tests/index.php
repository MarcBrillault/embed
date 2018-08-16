<?php

require_once __DIR__ . '/../vendor/autoload.php';

putenv('EMBED_LANG=fr');

// putenv('EMBED_WIDTH=600');

\Embryo\EmbedInstaller::writeCacheFile();

$urls = [
    'https://www.youtube.com/watch?v=Us6TDxO9ItM',
    'https://www.dailymotion.com/video/x6ok5hl',
    'https://vimeo.com/41174743',
    'https://www.facebook.com/20531316728/posts/10154009990506729/',
    'https://twitter.com/SVimaire/status/1019128561100312577',
    'https://twitter.com/MarcBrillault/status/956183104368074753',
    'https://twitter.com/mathrobin/status/1018758932557369344',
    'https://twitter.com/mic/status/1018828090653282305',
];

foreach ($urls as $url) {
    $embed = new \Embryo\Embed($url);
    try {
        echo $embed->getEmbeddedCode();
    } catch (\Embryo\Exceptions\EmbedException $e) {
        echo $e->getMessage() . '<br>';
    }
}



