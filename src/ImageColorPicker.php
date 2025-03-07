<?php

namespace WallaceMaxters\FilamentImageColorPicker;

use Closure;
use Filament\Support\RawJs;
use Illuminate\Support\Arr;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\FileUpload;

/**
 * @author Wallace Maxters <wallacemaxters@gmail.com>
 */
class ImageColorPicker extends Field
{
    protected string $view = 'image-color-picker::image-color-picker';

    protected  Closure|RawJs|string|null $imageSrc = null;

    protected Closure|string $format = 'rgb';

    protected ?FileUpload $uploadComponent = null;

    public function image(string | RawJs | Closure $src)
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

    public function fromComponent(FileUpload $component)
    {
        $this->uploadComponent = $component;

        return $this;
    }

    public function getImageFromUploadComponent()
    {
        if ($this->uploadComponent === null) {
            return null;
        }

        $file = Arr::first($this->uploadComponent?->getUploadedFiles() ?? []);

        if ($file) return $file['url'];
    }
}
