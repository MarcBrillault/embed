<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;

class Facebook extends Social
{
    protected $regexp = [
        '#^https:\/\/www\.facebook\.com\/(?:\w+)\/(?:posts|videos)\/([0-9]+)#',
    ];

    protected $template = <<<TEMPLATE
<div class="embryoEmbed">
    <div
        class="fb-post"
        data-href="{URL}"
        data-width="{WIDTH}"
        >
    </div> 
</div>
TEMPLATE;

}