@props(['absolute' => false, 'class' => ''])

@php
    $position = $absolute ? 'absolute inset-y-0 flex items-center pointer-events-none right-(--right-space,12px)' : '';
    $final_class = "{$class} {$position} flex justify-center items-center";
@endphp
<span class="{{ $final_class }}">
    {{ $slot }}
</span>
