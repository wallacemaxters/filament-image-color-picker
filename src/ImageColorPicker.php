<?php

namespace WallaceMaxters\FilamentImageColorPicker;

use Closure;
use Filament\Forms\Components\Field;

class ImageColorPicker extends Field
{
    protected string $view = 'image-color-picker::image-color-picker';

    protected  Closure|string|null $imageSrc = null;

    public function image(string|Closure $src)
    {
        $this->imageSrc = $src;

        return $this;
    }

    public function getImageSrc()
    {
        return $this->evaluate($this->imageSrc);
    }
}