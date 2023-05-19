<div>
    <x-notification />
    <x-header :title="'Child Accounts'">
    <x-flex class="justify-end">
            <div>
                <x-jet-button wire:click="$set('addNewChildren', true)">
                            <x-heroicon-o-plus class="w-4 h-4" />
                            New Child Enrollment
                </x-jet-button>
            </div>
        </x-flex>
    </x-header>
    <x-content>
        <x-flex class="space-x-2">
        @if ( auth()->user()['role'] !== 'parent' )
            <div class="w-64">
                <x-input.text
                    wire:model="search"
                    placeholder="Search Child Accounts"
                />
            </div>
            <div>
                <x-input.checkbox wire:model="onlyTrashed">
                    <span class="ml-2">Show Deleted Child Accounts</span>
                </x-input.checkbox>
            </div>
        @endif            
        </x-flex>
        <x-table>
            <x-slot name="head">
                <x-table.heading> Name </x-table.heading>
                <x-table.heading> Age </x-table.heading>
                <x-table.heading> Status </x-table.heading>
                <x-table.heading> </x-table.heading>
            </x-slot>
            <x-slot name="body">
                    @forelse ( $registeredChildrenList as $row )
                        @if ( auth()->user()['role'] !== 'parent' )
                            <x-table.row
                                    wire:loading.class.delay="opacity-50"
                                    wire:key="row-{{ $row['id'] }}"
                                >
                                <x-table.cell class="flex items-center font-medium">
                                    {{ $row['first_name'].' '.$row['last_name'] }}
                                </x-table.cell>
                                <x-table.cell class="font-medium text-center">
                                        {{ Carbon\Carbon::now()->diffInYears($row['birthdate']) }}
                                </x-table.cell>
                                @if ( $row['deleted_at'] )
                                    <x-table.cell class="font-medium text-center">
                                            Deleted
                                    </x-table.cell>
                                @else
                                <x-table.cell class="font-medium text-center">
                                            {{ $row['status'] == 1 ? "Registration Complete﻿" : "Updates Needed﻿﻿" }}
                                    </x-table.cell>
                                @endif
                                <x-table.cell>
                                    <x-flex class="space-x-1">
                                        <x-jet-dropdown :align="$loop->last ? 'bottom' : 'right'" width="48">
                                            <x-slot name="trigger">
                                                <x-dropdown.button>
                                                    Actions
                                                </x-dropdown.button>
                                            </x-slot>
                                            @if ( !$row['deleted_at'] )
                                            <x-slot name="content">
                                                @if ( $row['status'] == 1 )
                                                    <x-dropdown.item  href="{{ route('children.children-view', ['child_id' => $row['id'], 'user' => Auth()->user()->id] ) }}">
                                                    {{ "Profile" }}
                                                    </x-dropdown.item>
                                                @else
                                                    <x-dropdown.item  href="{{ route('children.children-view', ['child_id' => $row['id'], 'user' => Auth()->user()->id] ) }}">
                                                    {{ "Continue Registration" }}
                                                    </x-dropdown.item>
                                                @endif
                                                <x-dropdown.item   wire:click="delete({{ $row['id'] }})">
                                                    Delete
                                                </x-dropdown.item>
                                            </x-slot>
                                            @endif
                                        </x-jet-dropdown>
                                    </x-flex>
                                </x-table.cell>
                            </x-table.row>
                        @else
                            <x-table.row
                                    wire:loading.class.delay="opacity-50"
                                    wire:key="row-{{ $row['id'] }}"
                                >
                                <x-table.cell class="flex items-center font-medium">
                                    {{ $row['first_name'].' '.$row['last_name'] }}
                                </x-table.cell>
                                @if ( $row['deleted_at'] )
                                        <x-table.cell class="font-medium">
                                                Deleted
                                        </x-table.cell>
                                    @else
                                    <x-table.cell class="font-medium">
                                                {{ $row['status'] == 1 ? "Active" : "Registration Incomplete" }}
                                        </x-table.cell>
                                    @endif
                                    <x-table.cell>
                                        <x-flex class="space-x-1">
                                            <x-jet-dropdown :align="$loop->last ? 'bottom' : 'right'" width="48">
                                                <x-slot name="trigger">
                                                    <x-dropdown.button>
                                                        Actions
                                                    </x-dropdown.button>
                                                </x-slot>
                                                @if ( !$row['deleted_at'] )
                                                <x-slot name="content">
                                                    @if ( $row['status'] == 1 )
                                                        <x-dropdown.item  href="{{ route('children.children-view', ['child_id' => $row['id'], 'user' => Auth()->user()->id] ) }}">
                                                        {{ "Profile" }}
                                                        </x-dropdown.item>
                                                    @else
                                                        <x-dropdown.item  href="{{ route('children.children-view', ['child_id' => $row['id'], 'user' => Auth()->user()->id] ) }}">
                                                        {{ "Continue Registration" }}
                                                        </x-dropdown.item>
                                                    @endif
                                                    <x-dropdown.item   wire:click="delete({{ $row['id'] }})">
                                                        Delete
                                                    </x-dropdown.item>
                                                </x-slot>
                                                @endif
                                            </x-jet-dropdown>
                                        </x-flex>
                                    </x-table.cell>
                            </x-table.row>
                        @endif
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
        <!-- Modal -->
        <x-jet-modal :id="'add-new-children'" wire:model="addNewChildren">
            <form wire:submit.prevent="createChildAccount">
                <div class="px-6 py-4">
                    <div class="text-base md:text-base">
                        To add new child profile, please provide the child's name
                    </div>
                    <div class="mt-0 md:mt-4 grid grid-cols-1 md:grid-cols-1 gap-6 overflow-y-scroll sm:overflow-hidden h-64">
                        <div>
                            <x-list-data-input label="Child First Name: " class="py-0">
                                <x-jet-input
                                    id="first_name"
                                    type="text"
                                    class="block w-full"
                                    wire:model.defer="childrenFields.first_name"
                                    autocomplete="first_name"
                                />
                            @if($errors->has('first_name')) <span class="error" style="color:red">{{ $errors->first('first_name') }}</span> @endif
                            </x-list-data-input>
                        </div>
                        <div>
                            <x-list-data-input label="Child Last Name: " class="py-0">
                                <x-jet-input
                                    id="last_name"
                                    type="text"
                                    class="block w-full"
                                    wire:model.defer="childrenFields.last_name"
                                    autocomplete="last_name"
                                />
                                @if($errors->has('first_name')) <span class="error" style="color:red">{{ $errors->first('last_name') }}</span> @endif
                            </x-list-data-input>
                        </div>
                    </div>
                </div>
                <x-card-action>
                    <div>
                        <x-jet-secondary-button wire:click="$set('addNewChildren', false)">
                            Close
                        </x-jet-secondary-button>
                        <x-jet-button>
                            <x-heroicon-o-plus class="w-4 h-4"/> New Child
                        </x-jet-button>
                    </div>
                </x-card-action>
            </form>
        </x-jet-modal>
    </x-content>
</div>