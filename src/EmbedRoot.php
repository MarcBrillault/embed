<?php

namespace Embryo\Embed;

use Embryo\Embed\Interfaces\EmbedInterface;

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

    /***
     * @var string
     */
    protected $embedCode;

    /**
     * @var string
     */
    protected $template;

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
    public function setId(string $id)
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

        $this->embedCode = (string) str_replace(array_keys($replaces), array_values($replaces), $this->template);
    }

    /**
     * @return string
     */
    public function getEmbedCode(): string
    {
        if (!$this->embedCode) {
            $this->setEmbedCode();
        }

        return $this->embedCode;
    }

    /**
     * @param string $key
     * @return bool
     */
    private function isInTemplate(string $key): bool
    {
        return strpos($this->template, $this->transformToTemplateKey($key)) !== false;
    }

    /**
     * @param string $key
     * @return string
     */
    private function transformToTemplateKey(string $key): string
    {
        return sprintf('{%s}', strtoupper($key));
    }

    /**
     * @param string $key
     * @return string
     */
    private function getMethodNameFromKey(string $key): string
    {
        return 'get' . ucfirst($key);
    }

    /**
     * @return array[string]
     */
    private function getTemplateKeys(): array
    {
        preg_match_all('#\{([A-Z]+)\}#', $this->template, $matches);

        return array_map('strtolower', $matches[1]);
    }
}