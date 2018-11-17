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
     * @var string
     */
    private $className;

    /**
     * @var array
     */
    private $regexpMatches;

    /**
     * Embed constructor.
     *
     * @param string $url
     * @throws \Embryo\Exceptions\EmbedException
     */
    public function __construct($url = '')
    {
        if ($url) {
            $this->setUrl($url);
        }
    }

    /**
     * @param $url
     * @throws \Embryo\Exceptions\EmbedException
     */
    public function setUrl($url)
    {
        $this->url = $url;
        $this->setClassName();
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
    public function getEmbeddedCode()
    {
        $class = $this->getClass($this->className);
        $class->setUrl($this->regexpMatches[0]);
        if (array_key_exists(1, $this->regexpMatches)) {
            $class->setId($this->regexpMatches[1]);
        }

        return $class->getEmbedCode();
    }

    /**
     * @return void
     * @throws \Embryo\Exceptions\EmbedException
     */
    private function setClassName()
    {
        foreach ($this->getRegexpCache() as $regexp => $className) {
            if (preg_match($regexp, $this->url, $matches)) {
                $this->className     = $className;
                $this->regexpMatches = $matches;

                return;
            }
        }

        throw new EmbedException(sprintf('No match for the given url: %s', $this->getUrl()));
    }

    /**
     * @param string $class
     * @return \Embryo\EmbedRoot
     */
    private function getClass($class)
    {
        return new $class();
    }

    /**
     * @return string
     */
    public function getProviderClass()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getProviderName()
    {
        $className = $this->getProviderClass();
        $explode   = explode('\\', $className);

        return array_pop($explode);
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