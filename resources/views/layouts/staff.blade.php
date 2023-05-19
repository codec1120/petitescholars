<div>
    <x-content>
        @if ($layout === 'split')
            <div class="md:grid md:grid-cols-1 md:gap-6">
                <div class="mt-5 md:mt-0 md:col-span-2">
                    @if ( isset($threerowlayout) && $threerowlayout )
                        <!-- Allow only 3 rows -->
                        
                        <!-- First Row -->
                            <x-card>
                                <x-slot name="header">
                                    <div class="grid grid-cols-2 w-full">
                                        <p class="text-lg leading-6 font-semibold text-gray-900 flex items-center">
                                            {{ $title1 }}
                                        </p>
                                        @isset($header1)
                                            <x-flex class="justify-end">
                                                {{ $header1 }}
                                            </x-flex>
                                        @endisset
                                    </div>
                                </x-slot>
                                @isset($content1)
                                        <x-slot name="body">
                                            {{ $content1 }}
                                        </x-slot>
                                @endisset
                                @isset($table1)
                                        <x-slot name="table">
                                            {{ $table1 }}
                                        </x-slot>
                                @endisset
                                @isset($actions1)
                                        <x-slot name="actions">
                                            {{ $actions1 }}
                                        </x-slot>
                                @endisset
                            </x-card>

                        <!-- Second Row -->
                            <x-card class="mt-10">
                                <x-slot name="header">
                                    <div class="grid grid-cols-2 w-full">
                                        <p class="text-lg leading-6 font-semibold text-gray-900 flex items-center">
                                            {{ $title2 }}
                                        </p>
                                        @isset($header2)
                                            <x-flex class="justify-end">
                                                {{ $header2 }}
                                            </x-flex>
                                        @endisset
                                    </div>
                                </x-slot>
                                @isset($content2)
                                        <x-slot name="body">
                                            {{ $content2 }}
                                        </x-slot>
                                @endisset
                                @isset($table2)
                                        <x-slot name="table">
                                            {{ $table2 }}
                                        </x-slot>
                                @endisset
                                @isset($actions2)
                                        <x-slot name="actions">
                                            {{ $actions2 }}
                                        </x-slot>
                                @endisset
                            </x-card>
                        
                        <!-- Third Row -->
                            <x-card class="mt-10">
                                <x-slot name="header">
                                    <div class="grid grid-cols-2 w-full">
                                        <p class="text-lg leading-6 font-semibold text-gray-900 flex items-center">
                                            {{ $title3 }}
                                        </p>
                                        @isset($header3)
                                            <x-flex class="justify-end">
                                                {{ $header3 }}
                                            </x-flex>
                                        @endisset
                                    </div>
                                </x-slot>
                                @isset($content3)
                                        <x-slot name="body">
                                            {{ $content3 }}
                                        </x-slot>
                                @endisset
                                @isset($table3)
                                        <x-slot name="table">
                                            {{ $table3 }}
                                        </x-slot>
                                @endisset
                                @isset($actions3)
                                        <x-slot name="actions">
                                            {{ $actions3 }}
                                        </x-slot>
                                @endisset
                            </x-card>
                       
                    @else
                         <x-card>
                            <x-slot name="header">
                                <div class="grid grid-cols-2 w-full">
                                    <p class="text-base md:text-lg leading-6 font-semibold text-gray-900 flex items-center">
                                        {{ $title }}
                                    </p>
                                    @isset($header)
                                        <x-flex class="justify-end">
                                            {{ $header }}
                                        </x-flex>
                                    @endisset
                                </div>
                            </x-slot>
                            @isset($content)
                                    <x-slot name="body">
                                        {{ $content }}
                                    </x-slot>
                            @endisset
                            @isset($table)
                                    <x-slot name="table">
                                        {{ $table }}
                                    </x-slot>
                            @endisset
                            @isset($actions)
                                    <x-slot name="actions">
                                        {{ $actions }}
                                    </x-slot>
                            @endisset
                        </x-card>
                    @endif
                </div>
            </div>
        @endif
        @if ($layout === 'full')
            {{ $slot }}
        @endif
    </x-content>
</div>