<x-jet-secondary-button type="button" aria-haspopup="true" x-bind:aria-expanded="open" aria-expanded="true">
    {{ $slot }}
    @svg('heroicon-o-chevron-down', '-mr-1 ml-2 h-4 w-4')
</x-jet-secondary-button>