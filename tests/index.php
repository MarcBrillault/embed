<?php

require_once __DIR__ . '/../vendor/autoload.php';

putenv('EMBED_LANG=fr');

// putenv('EMBED_WIDTH=600');

\Embryo\EmbedInstaller::writeCacheFile();

$urls = [
    'https://www.youtube.com/watch?v=VV6QeZFaVSQ',
    'https://www.dailymotion.com/video/x6rvo2t',
    'https://vimeo.com/45579112',
    'https://twitter.com/NASA/status/1029125700580716544',
    'https://www.instagram.com/p/BkTYuD3Ao53/?taken-by=nasa',
    'https://www.pinterest.com/pin/142567144438259038/',
];

$html = <<<HTML
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
		    .embryoEmbed {
		        max-width: 400px; 
		        margin: auto;
		    }
        </style>
	</head>
	<body>
		%s
		<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
	</body>
</html>
HTML;

$contents = '';

foreach ($urls as $url) {
    $embed = new \Embryo\Embed($url);
    try {
        $contents .= $embed->getEmbeddedCode();
    } catch (\Embryo\Exceptions\EmbedException $e) {
        $contents .= $e->getMessage() . '<br>';
    }
}

printf($html, $contents);
