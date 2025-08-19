@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 f:border-gray-700 f:bg-gray-900 f:text-gray-300 focus:border-indigo-500 f:focus:border-indigo-600 focus:ring-indigo-500 f:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
