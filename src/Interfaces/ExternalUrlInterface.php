<?php

namespace Embryo\Interfaces;

interface ExternalUrlInterface
{
    /**
     * @param string $results
     * @return string
     */
    public function getEmbedCodeFromUrlResults($results);
}