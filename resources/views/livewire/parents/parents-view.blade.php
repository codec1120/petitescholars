<div>
    <x-notification />
    <x-header :title="'Parents'">
    <x-flex class="justify-end">
            <div>
                <x-jet-button wire:click="createParentData">
                            <x-heroicon-o-plus class="w-4 h-4" />
                            Parent Form
                </x-jet-button>
            </div>
        </x-flex>
    </x-header>
    <x-content>
        <x-flex class="space-x-2">
            <div class="w-64">
                <x-input.text
                    wire:model="search"
                    placeholder="Search Parent Accounts"
                />
            </div>
            <div>
                <x-input.checkbox wire:model="onlyTrashed">
                    <span class="ml-2">Show Deleted Parent Accounts</span>
                </x-input.checkbox>
            </div>
        </x-flex>
        <x-table>
            <x-slot name="head">
                <x-table.heading> Name </x-table.heading>
                <x-table.heading> Email </x-table.heading>
                <x-table.heading> Role </x-table.heading>
                <x-table.heading> Last Login </x-table.heading>
                <x-table.heading> Status </x-table.heading>
                <x-table.heading> </x-table.heading>
            </x-slot>
            <x-slot name="body">
                @if ( !$tableRow )
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
                @else
                    @foreach ( $tableRow as $row )
                    <x-table.row
                            wire:loading.class.delay="opacity-50"
                            wire:key="row-{{ $row['user_id'] }}"
                        >
                    <x-table.cell class="flex items-center font-medium">
                        {{ $row['first_name'].' '.$row['last_name'] }}
                    </x-table.cell>
                    <x-table.cell class="font-medium">
                            {{ $row['email_address'] }}
                    </x-table.cell>
                    <x-table.cell class="font-medium">
                            Parent
                    </x-table.cell>
                    <x-table.cell class="font-medium">
                        {{ $row['user']['login_at'] }}
                    </x-table.cell>
                    @if ( $row['deleted_at'] )
                        <x-table.cell class="font-medium">
                                Deleted
                        </x-table.cell>
                    @else
                     <x-table.cell class="font-medium">
                                {{ $row['status'] == 1 ? "Activated" : "Not Activated" }}
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
                                <x-slot name="content">
                                    <x-dropdown.item  href="{{ route('users.show', $row['user_id']) }}">
                                        My Account
                                    </x-dropdown.item>
                                    <x-dropdown.item  href="{{ route('children', ['user' => $row['user_id'] ])  }}">
                                        Children
                                    </x-dropdown.item>
                                    <x-dropdown.item   wire:click="archive({{ $row['user_id'] }})">
                                        Delete
                                    </x-dropdown.item>
                                </x-slot>
                            </x-jet-dropdown>
                        </x-flex>
                    </x-table.cell>
                    </x-table.row>
                    @endforeach
                @endif
            </x-slot>
        </x-table>
        <!-- For Parent notication -->
        <!-- @if ( $parentChildToUpdate )
            <x-jet-dialog-modal wire:model="displayChildToUpdateNotificationModal">
                <x-slot name="title">
                    <x-card.title> Parent Notification </x-card.title>
                </x-slot>
                <x-slot name="content">
                    <span> Hello <span class="font-bold">{{ $parent->first_name.' '.$parent->last_name }}</span>, 
                    there is child information that needs to be updated immediately for the following child(ren): </span>
                    </br>
                    </br>
                    <span class="font-bold">List of Children(s):</span>
                    </br>
                    <div>
                        <ul class="list-inside">
                            @foreach ( $parentChildToUpdate as $child )
                                <li class="list-disc"> {{ $child['first_name'].' '.$child['last_name'] }} </li>
                            @endforeach
                        </ul>
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <x-jet-danger-button class="ml-2" wire:click="removeNotification" wire:loading.attr="disabled">
                        Disable Notification on this browser
                    </x-jet-danger-button>
                    <x-jet-button
                        wire:click="proceedToChildList"
                    >
                        Proceed
                    </x-jet-button>
                    <x-jet-secondary-button
                        wire:click="$set('displayChildToUpdateNotificationModal', false)"
                    >
                        Close
                    </x-jet-secondary-button>
                </x-slot>
            </x-jet-dialog-modal>
        @endif -->
        <!-- incomplete parent data -->
        <x-jet-dialog-modal wire:model="incompleData">
            <x-slot name="title">
                <x-card.title> Parent Notification </x-card.title>
            </x-slot>
            <x-slot name="content">
                <span> Hello <span class="font-bold">{{ $parent->first_name.' '.$parent->last_name }}</span>, 
                There are new field(s) that you need to fill-up: </span>
                </br>
                </br>
                <span class="font-bold">List of New Field(s):</span>
                </br>
                <div>
                    <ul class="list-inside">
                        <li class="list-disc"> Phone Number (Required)</li>
                        <li class="list-disc"> Phone Number Type (Required)</li>
                        <li class="list-disc"> Address (Optional)</li>
                        <li class="list-disc"> State (Optional)</li>
                        <li class="list-disc"> City (Optional)</li>
                        <li class="list-disc"> Zip Code (Optional)</li>
                    </ul>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-button
                    wire:click="proceedToChildList"
                >
                    Proceed
                </x-jet-button>
                <x-jet-secondary-button
                    wire:click="$set('incompleData', false)"
                >
                    Close
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-content>
</div>