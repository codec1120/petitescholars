@props(['href'])
<a {{ $attributes->merge(['class' => 'inline-flex items-center font-semibold text-sm transition ease-in-out duration-150 hover:opacity-75']) }} href="{{ $href }}">
    {{ $slot }}
</a>
