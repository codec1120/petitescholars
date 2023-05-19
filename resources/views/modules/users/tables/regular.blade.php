<div class="hidden md:block">
    <x-table>
        <x-slot name="headers">
            <x-th>
                <x-forms.checkbox
                    wire:model="checkboxes.select_all"
                />
            </x-th>
            <x-th> Name </x-th>
            <x-th> Email </x-th>
            <x-th> Role </x-th>
            <x-th> </x-th>
        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
                <x-tr>
                    <x-td>
                        <x-forms.checkbox
                            wire:model.defer="checkboxes.selected"
                            :value="$user->id"
                        />
                    </x-td>
                    <x-td>
                        <x-link :href="route('users.show', $user)">
                            <x-flex>
                                <x-avatar class="w-8 h-8 mr-2" :src="$user->profile_photo_url" />
                                {{ $user->full_name }}
                            </x-flex>
                        </x-link>
                    </x-td>
                    <x-td>
                        <x-link :href="route('users.show', $user)">
                            {{ $user->email }}
                        </x-link>
                    </x-td>
                    <x-td>
                        <x-link :href="route('users.show', $user)">
                            {{ $user->role_name }}
                        </x-link>
                    </x-td>
                    <x-td class="relative">
                        <x-flex class="space-x-1">
                            <x-dropdown class="text-gray-500">
                                <x-slot name="trigger">
                                    <x-jet-secondary-button type="button" class="w-full justify-center">
                                        @svg('heroicon-o-cog', 'w-4 h-4')
                                    </x-jet-secondary-button>
                                </x-slot>
                                <div class="origin-top-right absolute right-0 mt-2 mr-40 w-48 rounded-md shadow-lg z-50">
                                    <div class="bg-white rounded-lg mt-2">
                                        @include('modules.users.tables.dropdown')
                                    </div>
                                </div>
                            </x-dropdown>
                            <livewire:users.delete :user="$user" :key="uuid()" />
                        </x-flex>
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