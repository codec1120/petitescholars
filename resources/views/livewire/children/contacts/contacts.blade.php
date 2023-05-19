<div>
    <x-notification />
    <x-header :title="$childName" class="flex justify-end">
        <x-link :href="route('children.children-view', [
                'user' => Auth()->user()->id, 
                'first_name' => $childrenFields['first_name'],
                'last_name' => $childrenFields['last_name'],
                'child_id' => $childrenFields['id'] ?? $child_id,
            ])">
            <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
            Go Back
        </x-link>
    </x-header>
    <x-content>
        <x-card class="sm:rounded-3xl">
            <x-slot name="table">
            <div class="px-8 py-8">
                <div class="grid grid-cols-1 w-full py-4">
                    <div class="flex justify-start font-bold">Contacts</div>
                </div>
                    @if(count($childContactsFields['lists']) > 0)
                    <x-table>
                        <x-slot name="head">
                        </x-slot>
                        <x-slot name="body">
                                @foreach ($childContactsFields['lists'] as $key => $row)
                                    <x-table.row
                                            wire:loading.class.delay="opacity-50"
                                            wire:key="row-{{ $row['id'] }}"
                                        >
                                        <x-table.cell class="flex items-center font-medium">
                                            {{ $row['first_name'].' '.$row['last_name'] }}
                                        </x-table.cell>
                                        <x-table.cell class="font-medium">
                                                {{ $row['phone_number'] }}
                                        </x-table.cell>
                                        <x-table.cell class="font-medium">
                                                {{ $row['email'] }}
                                        </x-table.cell>
                                        <x-table.cell>
                                            <x-flex class="space-x-1">
                                                <div>
                                                    <button type="button"
                                                        wire:click="editContact({{$row['id']}}, '{{isset($row['fathers_info']) && $row['fathers_info'] ?  1: (isset($row['mothers_info']) && $row['mothers_info']? 2: 0)}}')"
                                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                                            <x-heroicon-o-pencil-alt class="w-6 h-6" />
                                                    </button>
                                                </div>
                                                @if($row['email'])
                                                <div>
                                                    <button type="button"
                                                        wire:click="openEmailEditor('{{$row['email']}}', {{$row['id']}}, '{{isset($row['fathers_info']) && $row['fathers_info'] ?  1: (isset($row['mothers_info']) && $row['mothers_info']? 2: 0)}}')"
                                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                                            <x-heroicon-o-inbox class="w-6 h-6" />
                                                    </button>
                                                </div>
                                                @endif
                                            </x-flex>
                                        </x-table.cell>
                                    </x-table.row>
                                @endforeach
                        </x-slot>
                    </x-table>
                    @else
                    <div class="grid grid-cols-1 w-full py-4">
                        <div class="flex justify-start text-red-400">No Contacts found.</div>
                    </div>
                    @endif
            </div>
            </x-slot>
            @if(auth()->user()->role == 'admin')
            <x-slot name="actions" >
                <div class="flex justify-start w-full">
                    <button type="button" 
                        wire:click="$set('displayForm', true)"
                        @click="scrollTo({top: 0, behavior: 'smooth'})"
                        class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-400 active:bg-primary-600 focus:outline-none focus:border-primary-600 focus:shadow-outline-primary disabled:opacity-25 transition ease-in-out duration-150 ml-2">
                        <x-heroicon-o-plus class="w-6 h-6" /> New Contact
                    </button>
                </div>
            </x-slot>
            @endif
        </x-card>
        <div>
            <x-jet-modal :id="'childContact-modal'" wire:model="displayForm">
                <form wire:submit.prevent="saveContact">
                    <div class="px-6 py-4">
                        <div class="bg-white grid grid-cols-1 mt-5">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="First Name " >
                                    <x-jet-input
                                        id="first_name"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer.defer="childContactsFields.first_name"
                                        autocomplete="false"
                                    />
                                    @if($errors->has('first_name')) <span class="error" style="color:red">{{ $errors->first('first_name') }}</span> @endif
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 mt-5">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Last Name " >
                                    <x-jet-input
                                        id="last_name"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer.defer="childContactsFields.last_name"
                                        autocomplete="false"
                                    />
                                    @if($errors->has('last_name')) <span class="error" style="color:red">{{ $errors->first('last_name') }}</span> @endif
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 mt-5">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Email :" >
                                    <x-jet-input
                                        id="email"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer.defer="childContactsFields.email"
                                        autocomplete="false"
                                    />
                                    @if($errors->has('email')) <span class="error" style="color:red">{{ $errors->first('email') }}</span> @endif
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 mt-5">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Phone Number: " >
                                    <x-jet-input
                                        id="phone_number"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="childContactsFields.phone_number"
                                        autocomplete="false"
                                    />
                                    @if($errors->has('phone_number')) <span class="error" style="color:red">{{ $errors->first('phone_number') }}</span> @endif
                                </x-list-data-input>
                            </div>
                        </div>
                    </div>
                    <x-card-action>
                        <div>
                            <x-jet-secondary-button wire:click="clearForm">
                                Close
                            </x-jet-secondary-button>
                            <x-jet-button>
                                Save
                            </x-jet-button>
                        </div>
                    </x-card-action>
                </form>
            </x-jet-modal>
        </div>
        <x-jet-dialog-modal :id="'contact-modal'" wire:model="displayEmailSender" >
            <x-slot name="title">
                <div class="text-center text-base"> Email Composer </div>
            </x-slot>

            <x-slot name="content">
                    <p>Please compose your email to notify parents being added as a <span class="font-bold">Primary Guardian</span>.</p>
                    <div class="grid grid-cols-1 w-full py-4">
                        <label class="flex items-center">
                            Parents Email
                        </label>
                        <x-input.text class="py-4 border disabled" wire:model="parentEmails"/>
                    </div>
                    <div class="grid grid-cols-1 w-full py-2">
                        <label class="flex items-center">
                            Message
                        </label>
                        <textarea 
                            placeholder="" 
                            name="parent_notification_email_content-textArea"
                            class="rounded-md shadow-sm block w-full outline-none" 
                            id="parent_notification_email_content-textArea" 
                            wire:model.defer="contactFields.parent_notification_email_content"
                            rows="10" cols="50"
                        ></textarea>
                    </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-danger-button wire:click="$set('displayEmailSender', false)">
                    Cancel
                </x-jet-danger-button>
                @if($this->parentEmails != '')
                    <x-jet-secondary-button class="ml-2" wire:click="sendEmailToContact()">
                        Send    
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                    </x-jet-secondary-button>
                @else
                    <x-jet-secondary-button class="ml-2 bg-gray-50 border-gray-50" wire:click="acceptParentHandbook" disabled>
                        Send    
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                        </svg>
                    </x-jet-secondary-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
    </x-content>
</div>
