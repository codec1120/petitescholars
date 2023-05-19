<div>
    <x-header :title="$headerTitle">
        <div class="px-2 py-2 flex justify-end">
            <x-link :href="route('file-manager')">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </div>
    </x-header>
    <x-content>
        <x-table>
            <x-slot name="head">
                <x-table.heading class="text-left"> File name </x-table.heading>
                <x-table.heading class="text-left"> Set as Default </x-table.heading>
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
                                <p class="font-semibold mb-1"> {{ \Str::after($file['filename'], "{$environment}/{$documents_folder_name}/") }} </p>
                                <p class="text-xs text-gray-500">
                                    {{ file_last_modified($file['filename']) }}
                                </p>
                            </div>
                        </x-table.cell>
                        <x-table.cell>
                            <div>
                                <x-input.checkbox class="ml-10" wire:model="itemValue.{{$key}}.isDefault" wire:click="setAsDefault('{{ $file['filename'] }}', 0, {{$key}})"/>
                            </div>
                        </x-table.cell>
                        <x-table.cell>
                            <div class="flex items-center space-x-3">
                                <x-button.link
                                    class="hover:opacity-50"
                                    wire:target="downloadFile"
                                    wire:loading.class.delay="opacity-50"
                                    wire:click.prevent="downloadFile('{{ $file['filename'] }}')"
                                >
                                    <x-heroicon-o-download class="w-4 h-4"/>
                                </x-button.link>
                                @if($file['default'])
                                    <x-button.link
                                        class="hover:opacity-50"
                                        wire:loading.class.delay="opacity-50"
                                        wire:click.prevent="$set('deleteConfirmModal', true)"
                                    >
                                        <x-heroicon-o-trash class="w-4 h-4 text-red-500"/>
                                    </x-button.link>
                                @else
                                    <x-button.link
                                        class="hover:opacity-50"
                                        wire:target="delete"
                                        wire:loading.class.delay="opacity-50"
                                        wire:click.prevent="onDelete('{{ $file['filename'] }}')"
                                    >
                                        <x-heroicon-o-trash class="w-4 h-4 text-red-500"/>
                                    </x-button.link>
                                @endif
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
                    <!-- <li class="px-4 py-3 flex justify-center"><label for="uploadDocx" class="control-label">File max size: (25MB)</label></li> -->
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
    <x-jet-dialog-modal wire:model="displayResetModalNotif">
        <x-slot name="title">
            Reset File Status
        </x-slot>

        <x-slot name="content">
            <div>
                Reset all<span class="font-bold"> {{$docx->doc_type}} </span> Status to <span class="italic">Not Complete</span>?
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetStatus" wire:loading.attr="disabled">
                Yes
            </x-jet-button>
            <x-jet-secondary-button wire:click="$set('displayResetModalNotif', false)" wire:loading.attr="disabled">
                No
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    <x-jet-dialog-modal wire:model="deleteConfirmModal">
        <x-slot name="title">
            <div class="flex justify-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="px-2 py-2">Delete File Confirmation</div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div>
                This file is currently set as default. To delete this file, please set another file as default
            </div>
        </x-slot>

        <x-slot name="footer">
             <x-jet-danger-button wire:click="$set('deleteConfirmModal', false)" wire:loading.attr="disabled">
                Ok
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
