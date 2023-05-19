<div>
    <div
    >
        {{-- @if ($user->hasMedia($properties['tag'])) --}}
        <x-jet-secondary-button
            wire:click="$set('showFilesModal', true)" class="btnSameWidth px-8">
            @if(isset($properties['label']))
                {{ $this->filesCount }}
            @else
                <x-heroicon-o-collection class="w-4 h-4 mr-2"/>
                {{ $this->filesCount }}
            @endif
        </x-jet-secondary-button>
        <x-jet-dialog-modal wire:model="showFilesModal">
            <x-slot name="title">
                <x-card.title> {{ $properties['filename'] . ' Files' }} </x-card.title>
            </x-slot>
            <x-slot name="content">
                <div
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <ul class="border border-gray-200 rounded-lg">
                        @forelse ($mediaFiles as $key => $media)
                            <li
                                class="px-4 py-3 {{ $loop->last ? '' : 'border-b border-gray-200' }}"
                                wire:key="row-{{ $key }}"
                            >
                                <div class="flex items-center justify-between">
                                    <span class="text-sm">
                                        {{
                                            $media->filename . '.' . $media->extension
                                        }}
                                    </span>
                                    <div class="flex items-center space-x-2">
                                    <x-button.link
                                            class="hover:opacity-50"
                                            wire:target="downloadFile"
                                            wire:loading.class.delay="opacity-50"
                                            wire:click.prevent="setEmpDataSheetModal({{$media}})"
                                        >
                                            <x-heroicon-o-eye class="w-4 h-4 mr-1"/>
                                            View
                                        </x-button.link>
                                        <x-button.link
                                            class="hover:opacity-50"
                                            wire:target="downloadFile"
                                            wire:loading.class.delay="opacity-50"
                                            wire:click.prevent="downloadFile({{ $media }})"
                                        >
                                            <x-heroicon-o-download class="w-4 h-4 mr-1"/>
                                            Download
                                        </x-button.link>
                                        <div>
                                            <livewire:users.staffs.profile.delete-file
                                            :key="$media->id"
                                            :user="$user"
                                            :media="$media"
                                            :redirect="$redirect"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-3 border-b border-gray-200 flex items-center justify-center">
                                <p class="text-sm font-medium text-gray-500">
                                    There are no files yet
                                </p>
                            </li>
                        @endforelse

                        <li class="px-4 py-3 border-b border-gray-200 relative overflow-hidden">
                            <div x-show="isUploading" class="flex items-center justify-center absolute inset-0 bg-white">
                                <div class="flex items-center">
                                    <x-loader class="w-4 h-4 mr-2 text-gray-600"  />
                                    Loading please wait...
                                </div>
                            </div>
                            <div>
                                <input type="file" multiple wire:model="files">
                                <x-jet-input-error for="files" class="mt-2" />
                            </div>
                        </li>
                    </ul>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button
                    wire:click="$toggle('showFilesModal')"
                    wire:loading.attr="disabled"
                >
                    Close
                </x-jet-secondary-button>
                <x-jet-button
                    wire:click="upload"
                    wire:loading.attr="disabled"
                    :disabled="collect($files)->isEmpty()"
                >
                    <x-loader class="w-4 h-4 mr-2" wire:loading wire:target="upload" />
                    Save
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
        @include('livewire.users.staffs.profile.view-modal')
    </div>
</div>
