@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 f:border-indigo-600 text-start text-base font-medium text-indigo-700 f:text-indigo-300 bg-indigo-50 f:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 f:focus:text-indigo-200 focus:bg-indigo-100 f:focus:bg-indigo-900 focus:border-indigo-700 f:focus:border-indigo-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 f:text-gray-400 hover:text-gray-800 f:hover:text-gray-200 hover:bg-gray-50 f:hover:bg-gray-700 hover:border-gray-300 f:hover:border-gray-600 focus:outline-none focus:text-gray-800 f:focus:text-gray-200 focus:bg-gray-50 f:focus:bg-gray-700 focus:border-gray-300 f:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
