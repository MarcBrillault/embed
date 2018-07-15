<?php

namespace Embryo\Embed;

use Embryo\Embed\Exceptions\EmbedException;

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

    public function __construct(string $url)
    {
        $this->setUrl($url);
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     * @throws \Embryo\Embed\Exceptions\EmbedException
     */
    public function getEmbeddedCode(): string
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
    private function getClass(string $class): EmbedRoot
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
        $filePath = Installer::getCacheFilePath();
        if (!is_file($filePath)) {
            Installer::writeCacheFile();
        }

        $this->regexpCache = json_decode(file_get_contents($filePath));
    }
}