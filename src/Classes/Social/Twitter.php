<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;
use Embryo\Interfaces\ExternalUrlInterface;

class Twitter extends Social implements ExternalUrlInterface
{
    protected $regexp = [
        '#^https?://twitter\.com/(?:.*)/status/([0-9]+)#',
    ];

    protected $embedUrl = 'https://publish.twitter.com/oembed?url={URL}&lang={LANG}&maxwidth={WIDTH}&dnt=true';

    /**
     * @param string $results
     * @return string
     */
    public function getEmbedCodeFromUrlResults($results)
    {
        $data = json_decode($results, true);

        return sprintf('<div class="embryoEmbed">%s</div>', (string) $data['html']);
    }
}