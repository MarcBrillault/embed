<?php

namespace Embryo\Classes\Video\MainStream;

use Embryo\Classes\Video;

class YouTube extends Video
{
    protected $regexp = [
        '#^https?://www\.youtube\.com/watch\?v=([_a-zA-Z0-9]+)#',
        '#^https?://youtu\.be/([_a-zA-Z0-9]+)#',
        '#^https?://www\.youtube\.com/embed/([_a-zA-Z0-9]+)#',
    ];

    protected $template = <<<'TEMPLATE'
<div class="embryoEmbed">
    <iframe
        width="{WIDTH}"
        height="{HEIGHT}"
        src="https://www.youtube.com/embed/{ID}"
        frameborder="0"
        allow="autoplay; encrypted-media"
        allowfullscreen>
    </iframe>
</div>
TEMPLATE;
}