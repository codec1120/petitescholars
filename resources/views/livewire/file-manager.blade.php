<div>
    <x-header title="File Manager" />
    <x-content>
        <div class="grid grid-cols-1 gap-4">
            <x-input.select wire:model="directory">
                @foreach ($directories as $directory)
                    <option value="{{ $directory }}">
                        {{ $directory }}
                    </option>
                @endforeach
            </x-input.select>
        </div>
        <x-table>
            <x-slot name="head">
                <x-table.heading class="text-left"> File name </x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach ($files as $key => $file)
                    <x-table.row
                        wire:loading.class.delay="opacity-50"
                        wire:key="row-{{ $key }}"
                    >
                        <x-table.cell>
                            <div>
                                <p class="font-semibold mb-1"> {{ \Str::after($file, '/') }} </p>
                                <p class="text-xs text-gray-500">
                                    {{ file_last_modified($file) }}
                                </p>
                            </div>
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center space-x-3">
                                <x-button.link
                                    class="hover:opacity-50"
                                    wire:target="downloadFile"
                                    wire:loading.class.delay="opacity-50"
                                    wire:click.prevent="downloadFile('{{ $file }}')"
                                >
                                    <x-heroicon-o-download class="w-4 h-4"/>
                                </x-button.link>
                                <x-button.link
                                    class="hover:opacity-50"
                                    wire:target="delete"
                                    wire:loading.class.delay="opacity-50"
                                    wire:click.prevent="onDelete('{{ $file }}')"
                                >
                                    <x-heroicon-o-trash class="w-4 h-4 text-red-500"/>
                                </x-button.link>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
                <x-table.row wire:target="upload" wire:loading.class.delay="opacity-50">
                    <x-table.cell colspan="2">
                        <div>
                            <x-input.filepond multiple wire:model="uploads" />
                            @if ($uploads)
                                <div class="flex items-center justify-end pt-2">
                                    <x-jet-button wire:click="upload">
                                        Upload files
                                    </x-jet-button>
                                </div>
                            @endif
                        </div>
                    </x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table>
    </x-content>
</div>
