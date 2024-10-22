<?php

namespace WallaceMaxters\FilamentImageColorPicker;

use Closure;
use Filament\Forms\Components\Field;

class ImageColorPicker extends Field
{
    protected string $view = 'image-color-picker::image-color-picker';

    protected  Closure|string|null $imageSrc = null;

    protected Closure|string $format = 'rgb';

    public function image(string|Closure $src)
    {
        $this->imageSrc = $src;

        return $this;
    }

    public function getImageSrc()
    {
        return $this->evaluate($this->imageSrc);
    }

    public function format(string $format)
    {
        $this->format = $format;

        return $this;
    }

    public function hex()
    {
        return $this->format('hex');
    }

    public function rgb()
    {
        return $this->format('rgb');
    }

    public function hsl()
    {
        return $this->format('hsl');
    }

    public function getFormat()
    {
        return $this->evaluate($this->format);
    }
}