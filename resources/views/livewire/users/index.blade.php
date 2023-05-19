<div>
    <x-notification />
    <x-header :title="$title . ' Accounts'">
        <x-flex class="justify-end">
            <div>
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-dropdown.button>
                            Bulk Actions
                        </x-dropdown.button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown.item wire:click="export">
                            @svg('heroicon-o-download', 'w-5 h-5 mr-2 text-cool-gray-400')
                            Export
                        </x-dropdown.item>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            @livewire('users.import', ['role' => $role])
            @livewire('users.create', ['role' => $role, 'state.role' => $role])
        </x-flex>
    </x-header>
    <x-content>
        <x-flex class="space-x-2">
            <div class="w-64">
                <x-input.text
                    wire:model="search"
                    placeholder="Search User Accounts"
                />
            </div>
            <div>
                <x-input.checkbox wire:model="onlyTrashed">
                    <span class="ml-2">Show Deleted Users</span>
                </x-input.checkbox>
            </div>
        </x-flex>
        <x-table>
            <x-slot name="head">
                <x-table.heading>
                    <x-input.checkbox wire:model="selectPage" />
                </x-table.heading>
                <x-table.heading> Name </x-table.heading>
                <x-table.heading> Email </x-table.heading>
                <x-table.heading> Role </x-table.heading>
                <x-table.heading> Last Login </x-table.heading>
                <x-table.heading> </x-table.heading>
            </x-slot>
             <x-slot name="body">
                @if ($selectPage)
                    <x-table.row class="bg-cool-gray-200" wire:key="row-info">
                        <x-table.cell colspan="5">
                            @unless($selectAll)
                                <div>
                                    <span>
                                        You selected
                                        <strong> {{ $users->count() }} </strong>
                                        users, do you want to select all <strong> {{ $users->total() }}  </strong>?
                                    </span>
                                    <x-button.link
                                        wire:click="selectAll"
                                        class="text-blue-600"
                                    >
                                        Select All
                                    </x-button.link>
                                </div>
                            @else
                                <span>
                                    You currently selected all
                                    <strong> {{ $users->total() }}  </strong>
                                    users.
                                </span>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                @endif
                @forelse ($users as $user)
                    <x-table.row
                        wire:loading.class.delay="opacity-50"
                        wire:key="row-{{ $user->id }}"
                    >
                        <x-table.cell>
                            <div>
                                <x-input.checkbox
                                    wire:model="selected"
                                    value="{{ $user->id }}"
                                />
                            </div>
                        </x-table.cell>
                        <x-table.cell class="flex items-center font-medium">
                            <x-avatar class="w-8 h-8 mr-2" :src="$user->profile_photo_url" />
                            {{ $user->full_name }}
                        </x-table.cell>
                        <x-table.cell class="font-medium">
                            {{ $user->email }}
                        </x-table.cell>
                        <x-table.cell class="font-medium">
                        {{ $this->role == 'staff' ? 'Staff' : ucfirst($user->role )}}
                        </x-table.cell>
                        <x-table.cell class="font-medium">
                        {{ $user->login_at ?? null  }}
                        </x-table.cell>
                        <x-table.cell>
                            @if ($user->trashed())
                                <x-flex class="space-x-1">
                                    <x-jet-dropdown :align="$loop->last ? 'bottom' : 'right'" width="48">
                                        <x-slot name="trigger">
                                            <x-dropdown.button>
                                                Actions
                                            </x-dropdown.button>
                                        </x-slot>
                                        <x-slot name="content">
                                           <x-dropdown.item         wire:click="restoreOrDelete({{ $user->id }}, 'restore')">
                                                Restore
                                            </x-dropdown.item>
                                            <x-dropdown.item         wire:click="restoreOrDelete({{ $user->id }}, 'delete')">
                                                Delete Permanently
                                            </x-dropdown.item>
                                        </x-slot>
                                    </x-jet-dropdown>
                                </x-flex>
                            @else
                                <x-flex class="space-x-1">
                                    <x-jet-dropdown :align="$loop->last ? 'bottom' : 'right'" width="48">
                                        <x-slot name="trigger">
                                            <x-dropdown.button>
                                                Actions
                                            </x-dropdown.button>
                                        </x-slot>
                                        <x-slot name="content">
                                            @include('modules.users.tables.dropdown',  $user )
                                        </x-slot>
                                    </x-jet-dropdown>
                                    <livewire:users.delete :user="$user" :key="uuid()" />
                                </x-flex>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="5">
                            <x-placeholder
                                title="No records found."
                                description="There are no user accounts."
                            >
                                @svg('heroicon-o-users', 'w-8 h-8 text-gray-500 mb-4')
                            </x-placeholder>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>
        {{-- @includeWhen($users->isNotEmpty(), 'modules.users.tables.regular')
        @includeWhen($users->isNotEmpty(), 'modules.users.tables.small')
        @includeWhen($users->isEmpty(), 'modules.users.tables.empty') --}}
         {{ $users->links() }}
    </x-content>
</div>