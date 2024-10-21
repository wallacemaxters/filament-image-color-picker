@php
$componentSrc = \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('image-color-picker', 'wallacemaxters/filament-image-color-picker');
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

    class="wm-image-color-picker"

    ax-load
    class="relative"
    ax-load-src="{{ $componentSrc }}">

    <template x-teleport="body">
        <div
            class="wm-image-color-picker-preview-container" :style="{top: clientY + 'px', left: clientX + 'px'}"
            x-show="previewColor"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
            <div class="wm-color-preview" :style="{backgroundColor: previewColor}"></div>
            <span class="wm-color-preview-text" x-text="previewColor"></span>
        </div>
    </template>

    @if($helperText)
        <div>{{ $helperText }}</div>
    @endif
    <div wire:ignore>
        <canvas x-ref="canvas" class="w-full cursor-crosshair" x-on:mousemove="selectColor" x-on:click="onClick"></canvas>
    </div>
    <div class="wm-color-selected-container" x-show="selectedColor">
        <div class="wm-color-preview" :style="{backgroundColor: selectedColor}"></div>
        <span x-text="selectedColor"></span>
    </div>
</div>

</x-dynamic-component>
