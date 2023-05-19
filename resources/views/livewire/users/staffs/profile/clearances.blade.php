<x-staff-layout :user="$user" title="Clearance Information">
    <x-slot name="content">
        @foreach ($clearances as $label => $value)
            <x-list-data
                :label="$label"
                :value="$value"
            >
                @if (
                    !$user->hasMedia(slug($label, '_')) &&
                    $value
                )
                    <x-slot name="message">
                        <x-jet-label :for="$value" value="Missing documentation" class="text-red-500" />
                    </x-slot>
                @endif
                <livewire:file-uploader
                    :user="$user"
                    :key="uuid()"
                    :redirect="'/staffs/' . $this->user->id . '/clearances'"
                    :properties="[
                        'filename' => $label,
                        'directory' => 'clearances',
                        'tag' => slug($label, '_')
                    ]"
                />
            </x-list-data>
        @endforeach
    </x-slot>
    <x-slot name="actions">
       <div>
            <x-jet-button wire:click="$set('editing', true)" wire:loading.attr="disabled">
                <x-heroicon-o-pencil class="w-4 h-4 mr-2" />
                Edit
            </x-jet-button>
            <x-jet-modal :id="'edit-education-information'" wire:model="editing">
                <form wire:submit.prevent="submit">
                    <div class="px-6 py-4">
                        <div class="text-lg font-semibold">
                            Update Clearance Information
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 overflow-y-scroll sm:overflow-hidden h-96 sm:h-full">
                            <div>
                                <x-jet-label for="health_assessment_tb" value="Health Assessment/TB" class="mb-2" />
                                 <x-pikaday
                                    name="health_assessment_tb"
                                    format="MM/DD/YYYY" wire:model.lazy="clearancesFields.health_assessment_tb"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="child_abuse" value="Child Abuse" class="mb-2" />
                                 <x-pikaday
                                    name="child_abuse"
                                    format="MM/DD/YYYY" wire:model.lazy="clearancesFields.child_abuse"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="state_police" value="State Police" class="mb-2" />
                                 <x-pikaday
                                    name="clearancesFields.state_police"
                                    format="MM/DD/YYYY" wire:model.lazy="clearancesFields.state_police"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="fbi_fingerprinting" value="FBI Fingerprinting" class="mb-2" />
                                 <x-pikaday
                                    name="fbi_fingerprinting"
                                    format="MM/DD/YYYY" wire:model.lazy="clearancesFields.fbi_fingerprinting"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="nsor" value="NSOR" class="mb-2" />
                                 <x-pikaday
                                    name="nsor"
                                    format="MM/DD/YYYY" wire:model.lazy="clearancesFields.nsor"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                        </div>
                    </div>
                    <x-card-action>
                        <div>
                            <x-jet-secondary-button wire:click="$set('editing', false)">
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
    </x-slot>
</x-staff-layout>
