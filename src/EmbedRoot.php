<?php

namespace Embryo;

use Embryo\Interfaces\EmbedInterface;

abstract class EmbedRoot implements EmbedInterface
{
    /**
     * @var array
     */
    protected $regexp;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var int
     */
    protected $width;

    /**
     * @var string
     */
    protected $embedCode;

    /**
     * @var string
     */
    protected $template;

    const DEFAULT_WIDTH = 400;

    /**
     * Url to call to get the embedded content
     *
     * @var string
     */
    protected $embedUrl;

    /**
     * @var string
     */
    protected $embedUrlMethod;

    const DEFAULT_LANG = 'en';

    public final function __construct() { }

    /**
     * @return array
     */
    public function getRegexp()
    {
        return $this->regexp;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getEncodedUrl()
    {
        return urlencode($this->getUrl());
    }

    protected function setEmbedCode()
    {
        $replaces = [];
        foreach ($this->getTemplateKeys() as $key) {
            $templateKey = $this->transformToTemplateKey($key);
            $methodName  = $this->getMethodNameFromKey($key);
            if (
                $this->isInTemplate($key)
                && method_exists($this, $methodName)
            ) {
                $replaces[$templateKey] = $this->$methodName();
            }
        }

        $template = (string) str_replace(array_keys($replaces), array_values($replaces), $this->getTemplate());

        if ($this->embedUrl) {
            $urlContents     = $this->getUrlContents($template);
            $this->embedCode = $this->getEmbedCodeFromUrlResults($urlContents);
        } else {
            $this->embedCode = $template;
        }
    }

    /**
     * @param string $results
     * @return string
     */
    public function getEmbedCodeFromUrlResults($results)
    {
        return $results;
    }

    /**
     * @return string
     */
    public function getEmbedCode()
    {
        if (!$this->embedCode) {
            $this->setEmbedCode();
        }

        return $this->embedCode;
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        if ($this->width) {
            return $this->width;
        }

        return getenv('EMBED_WIDTH') ?: self::DEFAULT_WIDTH;
    }

    /**
     * @param string $key
     * @return bool
     */
    private function isInTemplate($key)
    {
        return strpos($this->getTemplate(), $this->transformToTemplateKey($key)) !== false;
    }

    /**
     * @param string $key
     * @return string
     */
    private function transformToTemplateKey($key)
    {
        return sprintf('{%s}', strtoupper($key));
    }

    /**
     * @param string $key
     * @return string
     */
    private function getMethodNameFromKey($key)
    {
        return 'get' . ucfirst($key);
    }

    /**
     * @return array[string]
     */
    private function getTemplateKeys()
    {
        preg_match_all('#\{([A-Z]+)\}#', $this->getTemplate(), $matches);

        return array_map('strtolower', $matches[1]);
    }

    /**
     * @return string
     */
    private function getTemplate()
    {
        return $this->getEmbedUrl() ?: $this->template;
    }

    /**
     * @return string
     */
    protected function getEmbedUrl()
    {
        return $this->embedUrl;
    }

    /**
     * @param string $url
     * @return string
     */
    protected function getUrlContents($url)
    {
        $guzzleClient = new \GuzzleHttp\Client();
        $res          = $guzzleClient->request($this->getUrlContentsMethod(), $url);

        return (string) $res->getBody();
    }

    /**
     * @return string
     */
    private function getUrlContentsMethod()
    {
        return $this->embedUrlMethod ?: 'GET';
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return getenv('EMBED_LANG') ?: self::DEFAULT_LANG;
    }
}