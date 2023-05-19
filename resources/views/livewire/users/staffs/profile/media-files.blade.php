<x-staff-layout :user="$user" title="Media Files">
    <x-slot name="header">
        @livewire('file-uploader', ['user' => $user])
    </x-slot>
    <x-slot name="content">
        @if ($files->isNotEmpty())
            <div class="grid grid-cols-1 gap-4">
                @foreach ($files as $file)
                    <x-flex class="justify-between">
                        <p class="font-medium"> {{ $file->filename . '.' . $file->extension }} </p>
                        <x-flex class="space-x-1">
                            <x-jet-secondary-button
                                wire:loading.attr="disabled"
                                wire:click="downloadFile('{{ $file->directory . '/' . $file->filename . '.' .$file->extension }}')">
                                <x-heroicon-o-download
                                    class="w-4 h-4"
                                />
                            </x-jet-secondary-button>
                            <livewire:users.staffs.profile.delete-file  :user="$user" :media="$file" :key="uuid()"
                            />
                        </x-flex>
                    </x-flex>
                @endforeach
            </div>
        @else
            <x-placeholder>
                <x-slot name="title"> No files found </x-slot>
                <x-slot name="description">
                    There are no file found.
                </x-slot>
            </x-placeholder>
        @endif
    </x-slot>
</x-staff-layout>