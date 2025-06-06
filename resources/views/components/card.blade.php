@props([
    'title' => null,
    'icon' => null,
    'href' => null,
    'variant' => 'default'
])

@php
$tag = $href ? 'a' : 'div';
$baseClasses = 'bg-white overflow-hidden shadow-sm sm:rounded-lg';
$hoverClasses = $href ? 'hover:shadow-md transition-shadow duration-200 group cursor-pointer' : '';

$variantClasses = match($variant) {
    'gradient' => 'bg-gradient-to-br from-blue-50 to-indigo-50',
    'success' => 'bg-gradient-to-br from-green-50 to-emerald-50',
    'warning' => 'bg-gradient-to-br from-yellow-50 to-orange-50',
    'error' => 'bg-gradient-to-br from-red-50 to-pink-50',
    default => 'bg-white'
};
@endphp

<{{ $tag }} {{ $attributes->merge([
    'class' => "{$baseClasses} {$hoverClasses} {$variantClasses}",
    'href' => $href
]) }}>
    <div class="p-6">
        @if($title || $icon)
            <div class="flex items-center {{ $href ? 'group-hover:text-indigo-700' : '' }} transition-colors duration-200">
                @if($icon)
                    <div class="flex-shrink-0 mr-4">
                        <div class="w-12 h-12 bg-indigo-100 {{ $href ? 'group-hover:bg-indigo-200' : '' }} rounded-lg flex items-center justify-center transition-colors duration-200">
                            {{ $icon }}
                        </div>
                    </div>
                @endif
                @if($title)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 {{ $href ? 'group-hover:text-indigo-700' : '' }} transition-colors duration-200">
                            {{ $title }}
                        </h3>
                    </div>
                @endif
            </div>
        @endif
        
        @if($title || $icon)
            <div class="mt-4">
                {{ $slot }}
            </div>
        @else
            {{ $slot }}
        @endif
    </div>
</{{ $tag }}>