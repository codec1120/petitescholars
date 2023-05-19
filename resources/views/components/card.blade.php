<div {{ $attributes->merge(['class' => 'shadow overflow-hidden sm:rounded-md col-span-8 sm:col-span-6']) }}>
    @isset($header)
        <div class="flex items-center p-4 bg-white sm:px-6 border-b border-gray-200">
            {{ $header }}
        </div>
    @endisset
    @isset($body)
        <div class="px-4 py-5 bg-white sm:p-6">
            {{ $body }}
        </div>
    @endisset
    {{ $slot }}
    @isset($table)
        <div>
            {{ $table }}
        </div>
    @endisset
    @isset($actions)
       <x-card-action>
           {{ $actions }}
       </x-card-action>
    @endisset
</div>