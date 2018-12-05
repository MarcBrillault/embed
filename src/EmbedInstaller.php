<?php

namespace Embryo;

use Embryo\Interfaces\EmbedInterface;

class EmbedInstaller
{
    /**
     * @var array
     */
    private $regexpList;

    const CACHE_FILENAME = 'regexpCache.json';
    const DIR_NAME       = '/Classes';

    private function setRegexpList()
    {
        $paths = $this->getFilePaths();
        foreach ($paths as $path) {
            $path      = str_replace('/', '\\', $path);
            $path      = str_replace('.php', '', $path);
            $path      = '\Embryo\Classes' . $path;
            $reflexion = new \ReflectionClass($path);
            if (
                $reflexion->isInstantiable()
                && $reflexion->implementsInterface(EmbedInterface::class)
                && $reflexion->hasProperty('regexp')
            ) {
                $regexp = $reflexion->getProperty('regexp');
                $regexp->setAccessible('public');
                foreach ($regexp->getValue(new $path) as $reg) {
                    $this->addToRegexpList($reg, $path);
                }
            }
        }
    }

    /**
     * @return array
     */
    private function getRegexpList()
    {
        return $this->regexpList;
    }

    /**
     * @param string $dirName
     * @param array  $paths
     * @return array
     */
    private function getFilePaths($dirName = '', array $paths = [])
    {
        $rootDirName = __DIR__ . self::DIR_NAME;
        $dirName     = $dirName ?: $rootDirName;

        $resources = scandir($dirName);
        foreach ($resources as $resource) {
            $pathToResource = $dirName . '/' . $resource;
            if (is_file($pathToResource) && pathinfo($pathToResource, PATHINFO_EXTENSION) === 'php') {
                $paths[] = str_replace($rootDirName, '', $pathToResource);
            } elseif (is_dir($pathToResource) && !in_array($resource, ['.', '..'])) {
                $paths = array_merge($paths, $this->getFilePaths($pathToResource, $paths));
            }
        }

        return array_unique($paths);
    }

    /**
     * @param string $regexp
     * @param string $className
     */
    private function addToRegexpList($regexp, $className)
    {
        $this->regexpList[$regexp] = $className;
    }

    /**
     * @return bool
     */
    public static function writeCacheFile()
    {
        $installer = new self();
        $installer->setRegexpList();
        if (!$handle = fopen(self::getCacheFilePath(), 'w+')) {
            return false;
        }

        fwrite($handle, json_encode($installer->getRegexpList(), JSON_PRETTY_PRINT));
        fclose($handle);

        return true;
    }

    /**
     * @return string
     */
    public static function getCacheFilePath()
    {
        return __DIR__ . '/' . self::CACHE_FILENAME;
    }
}
