<?php

namespace Embryo\Embed;

abstract class Embed
{
    /**
     * @var array
     */
    protected $regexp;

    public function getRegexp()
    {
        return $this->regexp;
    }
}