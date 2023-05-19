<div>
    <x-header :title="$headerTitle">
        <div class="px-2 py-2 flex justify-end">
            <x-link :href="route('children.children-view', ['user' => auth()->user()->id, 'child_id' => $this->child_id ])">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </div>
    </x-header>
    <x-content>
        <x-table>
            <x-slot name="head">
                <x-table.heading class="text-left"> File name </x-table.heading>
                <x-table.heading class="text-left"> Action </x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach ($files as $key => $file)
                    <x-table.row
                        wire:loading.class.delay="opacity-50"
                        wire:key="row-{{ $key }}"
                    >
                        <x-table.cell>
                            <div>
                                <p class="font-semibold mb-1"> {{ \Str::after(\Str::after($file, '/'), '/') }} </p>
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
            </x-slot>
        </x-table>
        <div class="px-2 py-2 w-full">
            <div>
                <ul class="border border-gray-200 rounded-lg">
                    @forelse ($uploadDocx as $key => $media)
                        <li
                            class="px-4 py-3 {{ $loop->last ? '' : 'border-b border-gray-200' }}"
                            wire:key="row-{{ $key }}"
                        >
                            <div class="flex items-center justify-between">
                                <span class="text-sm">
                                    {{
                                        $media->getClientOriginalName()
                                    }}
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="px-4 py-3 border-b border-gray-200 flex items-center justify-center">
                            <p class="text-sm font-medium text-gray-500">
                                There are no files yet
                            </p>
                        </li>
                    @endforelse
                    <!-- <li class="px-4 py-3 flex justify-center"><label for="uploadDocx" class="control-label">File max size: (5MB)</label></li> -->
                    <li class="px-4 py-3 border-b border-gray-200 relative overflow-hidden flex justify-center">
                        <div>
                            <input type="file" id="uploadDocx" wire:model="uploadDocx" accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.pdf"/>
                            @error('uploadDocx') <span class="error">File too large</span> @enderror
                        </div>
                    </li>
                </ul>
            </div>
            @if($uploadDocx)
            <div class="flex items-center justify-start pt-2">
                <x-jet-button wire:click="upload">
                    Upload files
                </x-jet-button>
            </div>
            @endif
        </div>
    </x-content>
</div>
