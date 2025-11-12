@props([
    'variant' => 'solid',
    'intent' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'type' => 'button',
    'href' => null,
])

@php
    use App\Flexiwind\ButtonHelper;
    $btn_variants = ButtonHelper::getVariants();

    $sizes = [
        'xs' => 'btn-xs',
        'sm' => 'btn-sm',
        'md' => 'btn-md',
        'lg' => 'btn-lg',
        'xl' => 'btn-xl',
        'icon-xs' => 'btn-icon-xs',
        'icon-sm' => 'btn-icon-sm',
        'icon-md' => 'btn-icon-md',
        'icon-lg' => 'btn-icon-lg',
        'icon-xl' => 'btn-icon-xl',
        'none' => '',
    ];
    $baseClasses = 'btn ease-linear duration-200 ui-radius ';
    if ($variant !== 'none') {
        $baseClasses .= isset($btn_variants[$variant]) ? $btn_variants[$variant]['base'] : 'ee';
    }

    $variantClasses = '';
    if ($variant !== 'none') {
        if (isset($btn_variants[$variant]) && isset($btn_variants[$variant]['intents'][$intent])) {
            $variantClasses = $btn_variants[$variant]['intents'][$intent];
        } elseif (isset($btn_variants['solid']['intents'][$intent])) {
            $variantClasses = $btn_variants['solid']['intents'][$intent];
        }
    }

    $sizeClasses = isset($sizes[$size]) ? $sizes[$size] : $sizes['md'];

    $tag = $href ? 'a' : 'button';

    $attributes = $attributes->class([
        $baseClasses,
        $variantClasses,
        $sizeClasses,
        'cursor-not-allowed' => $disabled,
    ]);

    $isInternal = true;
    if ($href) {
        $isInternal = ($href && Str::startsWith($href, '/')) || Str::startsWith($href, '#');
    }

    $attributes =
        $tag === 'button'
            ? ($attributes = $attributes->merge([
                'type' => $type,
                'disabled' => $disabled,
            ]))
            : $attributes->merge([
                'href' => $disabled ? null : $href,
                'aria-disabled' => $disabled ? 'true' : null,
                'tabindex' => $disabled ? '-1' : null,
            ]);

@endphp

<{{ $tag }} {{ $attributes }}
    @if (!$isInternal) target="_blank"  rel="noopener noreferrer" @endif>
    {{ $slot }}
    </{{ $tag }}>
