<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;

class Instagram extends Social
{
    protected $regexp = [
        '#^https://www\.instagram\.com/p/([a-zA-Z0-9]+)/#',
    ];

    protected $template = <<<TEMPLATE
<div class="embryoEmbed">
    <blockquote
        class="instagram-media"
        data-instgrm-captioned
        data-instgrm-permalink="https://www.instagram.com/p/{ID}/?utm_source=ig_embed&amp;utm_campaign=embed_loading_state_script"
        data-instgrm-version="10"
        style="
            background:#FFF;
            border:0;
            border-radius:3px;
            box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15);
            margin: 1px;
            max-width:{WIDTH}px;
            min-width:326px;
            padding:0;
            width:99.375%;
            width:-webkit-calc(100% - 2px);
            width:calc(100% - 2px);
            "
    >
    </blockquote>
    <script async defer src="//www.instagram.com/embed.js"></script>
</div>
TEMPLATE;

}