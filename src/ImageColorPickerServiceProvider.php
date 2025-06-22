<?php

namespace WallaceMaxters\FilamentImageColorPicker;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ImageColorPickerServiceProvider extends PackageServiceProvider
{
    public static string $name = 'image-color-picker';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make(static::$name, __DIR__ . '/../resources/dist/css/image-color-picker.css'),
            AlpineComponent::make(static::$name, __DIR__ . '/../resources/dist/js/components/image-color-picker.js'),
        ], 'wallacemaxters/filament-image-color-picker');
    }
}
