<?php

namespace Embryo\Classes\Video\MainStream;

use Embryo\Classes\Video;

class DailyMotion extends Video
{
    protected $regexp = [
        '#^https?://www\.dailymotion\.com/video/([a-z0-9]+)#',
        '#^https?://dai\.ly/([a-z0-9]+)#',
        '#^https?://www\.dailymotion\.com/embed/video/([a-z0-9]+)#',
    ];

    protected $template = <<<'TEMPLATE'
<div class="embryoEmbed">
    <iframe
        frameborder="0"
        width="{WIDTH}"
        height="{HEIGHT}"
        src="//www.dailymotion.com/embed/video/{ID}"
        allowfullscreen=""
        allow="autoplay">
    </iframe>
</div>
TEMPLATE;
}