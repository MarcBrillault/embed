<?php

namespace Embryo\Classes\Video\MainStream;

use Embryo\Classes\Video;

class Vimeo extends Video
{
    protected $regexp = [
        '#^https?://vimeo\.com/([0-9]+)#',
        '#^https?://player\.vimeo\.com/video/([0-9]+)#',
    ];

    protected $template = <<<'TEMPLATE'
<iframe
    src="https://player.vimeo.com/video/{ID}"
    width="{WIDTH}"
    height="{HEIGHT}"
    frameborder="0"
    webkitallowfullscreen
    mozallowfullscreen
    allowfullscreen>
</iframe>
TEMPLATE;

}