<?php

namespace Embryo\Classes\Social;

use Embryo\Classes\Social;
use Embryo\Interfaces\ExternalUrlInterface;

class Twitter extends Social implements ExternalUrlInterface
{
    protected $regexp = [
        '#^https?://twitter\.com/(?:.*)/status/([0-9]+)#',
    ];

    protected $embedUrl = 'https://publish.twitter.com/oembed?url={URL}&lang={LANG}';

    /**
     * @param string $results
     * @return string
     */
    public function getEmbedCodeFromUrlResults($results)
    {
        $data = json_decode($results, true);

        return (string) $data['html'];
    }

    /**
     * @return string
     */
    protected function getEmbedUrl()
    {
        $url          = $this->embedUrl;
        $urlFragments = parse_url($url);

        return $url;
    }
}