<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;

class Facebook extends Social
{
    protected $regexp = [
        '#^https://www.facebook.com/[0-9]+/posts/([0-9]+)/#',
    ];

    protected $template = <<<TEMPLATE
<iframe
    src="https://www.facebook.com/plugins/post.php?href={ENCODEDURL}&width={WIDTH}"
    width="{WIDTH}"
    height="295"
    style="border:none;overflow:hidden"
    scrolling="no"
    frameborder="0"
    allowTransparency="true"
    allow="encrypted-media"
    data-show-text="true"
    >
</iframe>
TEMPLATE;

}