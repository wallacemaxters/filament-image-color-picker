<?php

namespace WallaceMaxters\FilamentImageColorPicker;

use Filament\Forms\Components\Field;

class ImageColorPicker extends Field
{
    protected string $view = 'image-color-picker::image-color-picker';

    protected ?string $imageSrc = null;

    public function image(string $src)
    {
        $this->imageSrc = $src;

        return $this;
    }

    public function getImageSrc()
    {
        return $this->imageSrc;
    }
}