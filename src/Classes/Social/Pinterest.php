<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;

class Pinterest extends Social
{
    protected $regexp = [
        '#^https://www\.pinterest\.[a-z]{2,}/pin/([0-9]+)/#',
    ];

    protected $template = <<<TEMPLATE
<div class="embryoEmbed">
    <a
        data-pin-do="embedPin"
        data-pin-lang="{LANG}"
        data-pin-width="large"
        href="https://www.pinterest.com/pin/{ID}/">
    </a>
</div>
TEMPLATE;

}