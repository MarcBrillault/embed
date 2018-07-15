<?php

require_once __DIR__ . '/../vendor/autoload.php';

\Embryo\Embed\Installer::writeCacheFile();

$urls = [
    'https://www.youtube.com/watch?v=Us6TDxO9ItM',
    'https://www.dailymotion.com/video/x6ok5hl',
    'https://vimeo.com/41174743',
    'http://www.metacafe.com/watch/11705174/peruan-and-chilean-cultural-dance-in-chile/',
    'http://www.metacafe.com/watch/11704511/khalnayak-octapad-dj-mix-by-janny-dholi/',
];

foreach ($urls as $url) {
    $embed = new \Embryo\Embed\Embed($url);
    try {
        echo $embed->getEmbeddedCode();
    } catch (\Embryo\Embed\Exceptions\EmbedException $e) {
        echo $e->getMessage() . '<br>';
    }
}

echo <<<'HTML'
<iframe width="560" height="315" src="http://www.metacafe.com/embed/11704511/khalnayak-octapad-dj-mix-by-janny-dholi/" frameborder="0" allowfullscreen></iframe>
HTML;
