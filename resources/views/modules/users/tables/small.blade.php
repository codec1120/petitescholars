<div class="block md:hidden">
    <x-table>
        <x-slot name="headers">
            <x-th> </x-th>
        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
                <x-tr>
                    <x-td>
                        {{-- <x-forms.checkbox
                            wire:model.defer="checkboxes.selected"
                            :value="$user->id"
                        /> --}}
                        {{-- <div>
                            <x-flex>
                                <x-avatar class="w-8 h-8 mr-2" :src="$user->profile_photo_url" />
                                <p class="font-medium"> {{ $user->full_name }} </p>
                            </x-flex>
                            <p class="text-sm"> {{ $user->email }} </p>
                            <p> {{ $user->role_name }} </p>
                            <x-link :href="route('users.show', $user)">
                                <x-heroicon-o-chevron-right class="w-5 h-5 text-gray-500" />
                            </x-link>
                        </div> --}}
                        <div>
                            <x-flex class="justify-center mb-2">
                                <x-avatar class="w-16 h-16 mr-2" :src="$user->profile_photo_url" />
                            </x-flex>
                            <div class="flex items-start leading-tight relative">

                                <p
                                    class="font-medium text-gray-700 flex items-start flex-col"
                                >
                                    {{ $user->full_name }}
                                    <span class="text-sm text-gray-500 mb-2">{{ $user->email }}</span>
                                    <span class="text-sm py-1 px-3 bg-gray-200 text-gray-700 rounded-full">
                                        {{ $user->role_name }}
                                    </span>
                                </p>
                                <div class="absolute top-0 right-0">
                                    <x-forms.checkbox
                                        wire:model.defer="checkboxes.selected"
                                        :value="$user->id"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 mt-4">
                            <x-dropdown class="text-gray-500">
                                <x-slot name="trigger">
                                    <x-jet-secondary-button type="button" class="w-full justify-center">
                                        @svg('heroicon-o-chevron-down', 'w-4 h-4 mr-2')
                                        More
                                    </x-jet-secondary-button>
                                </x-slot>
                                <div class="bg-white rounded-lg mt-2">
                                    @include('modules.users.tables.dropdown')
                                </div>
                            </x-dropdown>
                        </div>
                    </x-td>
                </x-tr>
            @endforeach
        </x-slot>
        <x-slot name="footer">
            <x-flex class="justify-between w-full">
                <p class="text-gray-600">
                    <span class="font-semibold">
                        Total:
                    </span>
                    {{ $users->total() }}
                </p>
                {{ $users->links() }}
            </x-flex>
        </x-slot>
    </x-table>
</div>