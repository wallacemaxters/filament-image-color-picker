## Filament Image Color Picker 🎨  

**Filament Image Color Picker** is a Filament plugin that provides a custom **color picker input** based on an image. This tool allows users to select colors directly from an image, making it perfect for applications that require precise color selection.  


### Features  
✅ Select colors from any uploaded image  
✅ Seamless integration with Filament forms  
✅ User-friendly and highly customizable  
✅ Supports multiple image formats  

### Installation  

Filament 3

```bash
composer require wallacemaxters/filament-image-color-picker ^0.6
```
Filament 4

```bash
composer require wallacemaxters/filament-image-color-picker ^0.1
```

## Usage

To use the **Filament Image Color Picker**, simply include it in your Filament form field configuration:  

```php
use WallaceMaxters\FilamentImageColorPicker\ImageColorPicker;

// 

return $form->schema([
    TextInput::make('image_url')->url()->live(),
    ImageColorPicker::make('color')
        ->columnSpanFull()
        ->image(fn ($get) => $get('image_url')),
]);

```


Use ImageColorPicker as Action:

```php
 Forms\Components\ColorPicker::make('color')
    ->suffixAction(fn ($get) => 
        Forms\Components\Actions\Action::make('color-from-image')
            ->action(function ($set, array $data) {
                $set('color', $data['color']);
            })
            ->icon('heroicon-o-eye-dropper')
            ->form([
                ImageColorPicker::make('color')
                    ->format('hsl')
                    ->image(fn() => $get('image_url'))
            ])

    ),
```

You can capture the image from `FileUpload` component. 

```php

$uploadedFile = FileUpload::make('image');

return $form->schema([
    $uploadedFile,
    ImageColorPicker::make('color')->fromComponent($uploadedFile),
]);
```

### License  
This package is open-source and available under the **MIT License**.  

## Preview
https://github.com/user-attachments/assets/f1320c94-a275-4a54-8f3d-678607b46af9

<video width="320" height="240" controls>
  <source src="https://github.com/user-attachments/assets/f1320c94-a275-4a54-8f3d-678607b46af9" type="video/mp4">
</video>

