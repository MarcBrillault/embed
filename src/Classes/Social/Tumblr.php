<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;

class Tumblr extends Social
{
    protected $regexp = [
        '#^https://(?:w+).tumblr.com/post/([0-9]+)/#',
    ];

    protected $template = <<<TEMPLATE
<div
    class="tumblr-post"
    data-href="https://embed.tumblr.com/embed/post/QIeiCNau1m7OjCBKgKfrJg/{ID}"
    data-did="a4083014e0665c98f3da359c8cc222f72771e539"
    data-language="fr_FR"
    >
    <a href="https://nasa.tumblr.com/post/177022978844/land-is-sliding-tell-us-where">
        https://nasa.tumblr.com/post/177022978844/land-is-sliding-tell-us-where
    </a>
</div>
<script async src="https://assets.tumblr.com/post.js"></script>
TEMPLATE;

}