# Image Color Picker for Filament 3

This library contains a custom form field to pick color from a image. 

## Install

```bash
composer require wallacemaxters/filament-image-color-picker
```

## Usage

```php
use WallaceMaxters\FilamentImageColorPicker\ImageColorPicker;

// 

return $form->schema([
    TextInput::make('imagem_url')->url()->live(),
    ImageColorPicker::make('cor')
        ->columnSpanFull()
        ->helperText('Move mouse along to image and click to picker the color')
        ->image(fn ($get) => $get('image_url')),
]);

```

## Preview

https://github.com/user-attachments/assets/f1320c94-a275-4a54-8f3d-678607b46af9

