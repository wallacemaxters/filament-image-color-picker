# Image Color Picker for Filament 3

This library contains a custom form field to pick color from a image. 

## Install

```bash
composer require wallacemaxters/filament-image-color-picker
```

## Usage

Basic Input Usage example:

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

## Preview
https://github.com/user-attachments/assets/f1320c94-a275-4a54-8f3d-678607b46af9

<video width="320" height="240" controls>
  <source src="https://github.com/user-attachments/assets/f1320c94-a275-4a54-8f3d-678607b46af9" type="video/mp4">
</video>

