<?php

namespace Embryo\Embed\Classes\Video\MainStream;

use Embryo\Embed\Classes\Video;

class DailyMotion extends Video
{
    protected $regexp = [
        '#^https?://www\.dailymotion\.com/video/([a-z0-9]+)#',
        '#^https?://dai\.ly/([a-z0-9]+)#',
        '#^https?://www\.dailymotion\.com/embed/video/([a-z0-9]+)#',
    ];

    protected $template = <<<'TEMPLATE'
<iframe
    frameborder="0"
    width="{WIDTH}"
    height="{HEIGHT}"
    src="//www.dailymotion.com/embed/video/{ID}"
    allowfullscreen=""
    allow="autoplay">
</iframe>
TEMPLATE;
}