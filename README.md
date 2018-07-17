[![Maintainability](https://api.codeclimate.com/v1/badges/b0539914aa24194fd50d/maintainability)](https://codeclimate.com/github/MarcBrillault/embed/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/b0539914aa24194fd50d/test_coverage)](https://codeclimate.com/github/MarcBrillault/embed/test_coverage)

# Embryo/Embed

This is a library intended to easily embed data from different kind of sources.

## Installation

- via composer : `composer require embryo/embed`

## Usage

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

$url = 'https://www.youtube.com/watch?v=2_HXUhShhmY';

$embed = new \Embryo\Embed($url);
echo $embed->getEmbeddedCode();
```

Will display :

```html
<iframe
    width="400"
    height="225"
    src="https://www.youtube.com/embed/2_HXUhShhmY"
    frameborder="0"
    allow="autoplay; encrypted-media"
    allowfullscreen>
</iframe>
```

## Configuration

Some of the default values can be overridden by editing the correct env value.

We strongly suggest using [phpdotenv](https://github.com/vlucas/phpdotenv)
to do so.

Available values are:

- `EMBED_WIDTH` (Used on videos, default value is 400)
- `EMBED_RATIO` (Used on videos, default value is 16/9)

## Available sources

- Video services
  - DailyMotion
  - Vimeo
  - Youtube

## Suggesting another source

All suggestions are welcome, [just create an issue here : https://github.com/MarcBrillault/embed/issues]
(https://github.com/MarcBrillault/embed/issues)
