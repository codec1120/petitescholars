@props(['type' => 'link'])

@if ($type === 'link')
    <a {{ $attributes->merge(['href' => '#', 'class' => 'flex items-center px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900']) }} role="menuitem">
        {{ $slot }}
    </a>
@elseif ($type === 'button')
    <button {{ $attributes->merge(['type' => 'button', 'class' => 'flex items-center  w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900']) }} role="menuitem">
        {{ $slot }}
    </button>
@endif