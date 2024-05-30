@props(['active'])

@php
$classes = ($active ?? false)
            ? 'rounded text-primary-700 dark:text-primary-500'
            : 'text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' block']) }}>
    {{ $slot }}
</a>

usage

<x-nav-link :active="request()->routeIs('applications.*')" href="{{route('applications.index')}}">Applications</x-nav-link>
