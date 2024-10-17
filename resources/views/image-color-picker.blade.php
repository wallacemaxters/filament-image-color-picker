@php
$componentSrc = \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('image-color-picker');
$helperText = $getHelperText();
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
<div
    x-data="canvasColorPicker({
        image: @js($getImageSrc()),
        state: $wire.$entangle('{{ $getStatePath() }}'),
        format: 'rgb'
    })"

    ax-load
    ax-load-src="{{ $componentSrc }}">

    @if($helperText)
        <strong>{{ $helperText }}</strong>
    @endif
    <div class="flex items-center gap-2">
        <div class="h-3 w-3" :style="{backgroundColor: previewColor}"></div>
        <span x-text="previewColor"></span>
    </div>
    <div wire:ignore>
        <canvas x-ref="canvas" class="w-full cursor-crosshair" x-on:mousemove="selectColor" x-on:click="onClick"></canvas>
    </div>
    <div>
        <div class="flex items-center gap-2" x-show="selectedColor">
            <div class="h-3 w-3" :style="{backgroundColor: selectedColor}"></div>
            <span x-text="selectedColor"></span>
        </div>
    </div>
</div>

</x-dynamic-component>
