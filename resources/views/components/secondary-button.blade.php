@props([
    'variant' => 'secondary',
    'size' => 'md',
    'disabled' => false
])

@php
$baseClasses = 'inline-flex items-center justify-center border font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150';

$variantClasses = match($variant) {
    'secondary' => 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:ring-indigo-500',
    'outline' => 'border-indigo-300 bg-transparent text-indigo-700 hover:bg-indigo-50 focus:ring-indigo-500',
    'danger' => 'border-red-300 bg-white text-red-700 hover:bg-red-50 focus:ring-red-500',
    'success' => 'border-green-300 bg-white text-green-700 hover:bg-green-50 focus:ring-green-500',
    default => 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:ring-indigo-500'
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-2 text-sm',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-6 py-3 text-base',
    default => 'px-4 py-2 text-sm'
};

$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';
@endphp

<button {{ $attributes->merge([
    'type' => 'button',
    'class' => "{$baseClasses} {$variantClasses} {$sizeClasses} {$disabledClasses}",
    'disabled' => $disabled
]) }}>
    {{ $slot }}
</button>