<?php

namespace Embryo\Embed\Classes\Video\MainStream;

use Embryo\Embed\Classes\Video;

class YouTube extends Video
{
    protected $regexp = [
        '#^https?://www\.youtube\.com/watch\?v=([a-zA-Z0-9]+)#',
        '#^https?://youtu\.be/([a-zA-Z0-9]+)#',
        '#^https?://www\.youtube\.com/embed/([a-zA-Z0-9]+)#',
    ];

    protected $template = <<<'TEMPLATE'
<iframe
    width="{WIDTH}"
    height="{HEIGHT}"
    src="https://www.youtube.com/embed/{ID}"
    frameborder="0"
    allow="autoplay; encrypted-media"
    allowfullscreen>
</iframe>
TEMPLATE;
}