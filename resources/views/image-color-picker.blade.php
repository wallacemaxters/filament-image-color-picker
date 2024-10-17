@php
$src = \Filament\Support\Facades\FilamentAsset::getScriptSrc('canvas-color-picker');
@endphp
<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
<div
    x-data="canvasColorPicker({
        image: @js($getImageSrc()),
        state: $wire.$entangle('{{ $getStatePath() }}'),
    })"
    x-load-src="[@js($src)]">
    <div>Passe o mouse sobre a região da logo e clique sobre a cor desejada.</div>
    <div class="flex items-center gap-2">
        <div class="h-3 w-3" :style="{backgroundColor: previewColor}"></div>
        <span x-text="previewColor"></span>
    </div>
    <canvas x-ref="canvas" class="w-full cursor-crosshair" x-on:mousemove="selectColor" x-on:click="onClick"></canvas>

    <div>
        <strong>Cor Selecionada:</strong>
        <div class="flex items-center gap-2" x-show="selectedColor">
            <div class="h-3 w-3" :style="{backgroundColor: selectedColor}"></div>
            <span x-text="selectedColor"></span>
        </div>
    </div>
</div>

</x-dynamic-component>
