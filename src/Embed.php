<?php

namespace Embryo;

use Embryo\Exceptions\EmbedException;

class Embed
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $regexpCache;

    /**
     * Embed constructor.
     *
     * @param string $url
     */
    public function __construct($url = '')
    {
        if ($url) {
            $this->setUrl($url);
        }
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
     * @throws \Embryo\Exceptions\EmbedException
     */
    public function getEmbeddedCode()
    {
        foreach ($this->getRegexpCache() as $regexp => $className) {
            if (preg_match($regexp, $this->url, $matches)) {
                $class = $this->getClass($className);
                $class->setId($matches[1]);

                return $class->getEmbedCode();
            }
        }

        throw new EmbedException(sprintf('No match for the given url: %s', $this->getUrl()));
    }

    /**
     * @param string $class
     * @return \Embryo\Embed\EmbedRoot
     */
    private function getClass($class)
    {
        return new $class();
    }

    /**
     * @return array
     */
    private function getRegexpCache()
    {
        if (is_null($this->regexpCache)) {
            $this->setRegexpCache();
        }

        return $this->regexpCache;
    }

    private function setRegexpCache()
    {
        $filePath = EmbedInstaller::getCacheFilePath();
        if (!is_file($filePath)) {
            EmbedInstaller::writeCacheFile();
        }

        $this->regexpCache = json_decode(file_get_contents($filePath));
    }
}