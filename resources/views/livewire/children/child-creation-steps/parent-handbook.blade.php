<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title> Parent Handbook </x-card-title>
        </x-slot>
        <x-slot name="table">
            <x-flex class="justify-between border-b border-gray-200 w-full px-4 py-3">
                <div class="grid grid-cols-1 gap-2">
                    <p class="block font-medium text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">Status:</span>
                        {{ $parentHandbook['signed_date'] ? "Parent Handbook Signed": "Parent Handbook Not Signed" }}
                    </p>
                    <p class="block font-medium text-sm text-gray-500">
                        <span class="font-semibold text-gray-800">Date of Agreement Signed:</span>
                        {{ $parentHandbook['signed_date'] }}
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-1">
                @if ( $parentHandbook['signed_date'] )
                <div>
                        <x-jet-secondary-button wire:click="$set('displayHandbookModal', 'true')" class="w-full">
                            <x-heroicon-o-eye class="w-4 h-4 mr-2 "/>
                            View
                        </x-jet-secondary-button>
                    </div> 
                <div>
                        <x-jet-secondary-button wire:click="downloadParentHandbook" class="w-full">
                            <x-heroicon-o-download class="w-4 h-4 mr-2"/>
                            Download
                        </x-jet-secondary-button>
                    </div>
                @else
                <div>
                        <x-jet-secondary-button wire:click="$set('displayHandbookModal', 'true')" class="w-full">
                            <x-heroicon-o-clipboard-check class="w-4 h-4 mr-2 "/>
                            Sign
                        </x-jet-secondary-button>
                    </div>
                @endif
                </div>
            </x-flex>
            <x-jet-dialog-modal :id="'parent-handbook'" wire:model="displayHandbookModal" >
                    <x-slot name="title">
                       <div class="text-center text-base"> Parent Handbook </div>
                    </x-slot>

                    <x-slot name="content">
                         <embed src= "{{ $parentHandBookTempUrl }}" class="overflow-y-scroll md:h-96 w-full"/>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-danger-button wire:click="$set('displayHandbookModal', false)">
                            Cancel
                        </x-jet-danger-button>

                        @if ( $parentHandbook['signed_date'] ||  $disableParentHandbookAcceptBtn) 
                            <x-jet-secondary-button class="ml-2 bg-gray-50 border-gray-50" wire:click="acceptParentHandbook" disabled>
                                <span class="text-gray-200">Accept</span>
                            </x-jet-secondary-button>
                        @else
                            <x-jet-secondary-button class="ml-2" wire:click="$set('confirmHandbookModal', true)">
                                Accept
                            </x-jet-secondary-button>
                        @endif
                    </x-slot>
            </x-jet-dialog-modal>

               <!-- Parent Confirmation modal -->
            <x-jet-confirmation-modal wire:model="confirmHandbookModal">
                <x-slot name="title">
                    Parent Handbook 
                </x-slot>

                <x-slot name="content">
                    By accepting this document, you are approving your consent to Petite Scholars. Please confirm to Continue
                </x-slot>

                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$set('confirmHandbookModal', false)" wire:loading.attr="disabled">
                        Cancel
                    </x-jet-secondary-button>

                    <x-jet-danger-button class="ml-2" wire:click="acceptParentHandbook" wire:loading.attr="disabled">
                        Confirm
                    </x-jet-danger-button>
                </x-slot>
            </x-jet-confirmation-modal>
               
        </x-slot>
        <x-slot name="actions">
            <button type="button" 
                wire:click="saveHandBook()"
                @click="scrollTo({top: 0, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                Save
            </button>
        </x-slot>
    </x-card> 
    <div>
</div>