<x-staff-layout :user="$user" title="Employment Requirements">
    <x-slot name="content">
        <x-list-data label="DOH" :value="$this->user->getGeneralInfo()['doh']" />
        @foreach ($requirements as $label => $value)
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
                    :redirect="'/staffs/' . $this->user->id . '/employment-requirements'"
                    :properties="[
                        'filename' => $label,
                        'directory' => 'employment-requirements',
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
            <x-jet-modal :id="'edit-training-information'" wire:model="editing">
                <form wire:submit.prevent="submit">
                    <div class="px-6 py-4">
                        <div class="text-lg font-semibold">
                            Update Employment Requirements Information
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 overflow-y-scroll h-96">
                            <div>
                                <x-jet-label for="w4" value="W4" class="mb-2" />
                                <x-pikaday
                                    name="w4"
                                    format="MM/DD/YYYY" wire:model.lazy="employmentRequirementFields.w4"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <x-selects.submission-statuses
                                label="Resume"
                                model="employmentRequirementFields.resume"
                            />
                            <x-selects.submission-statuses
                                label="Reference 1"
                                model="employmentRequirementFields.reference1"
                            />
                            <x-selects.submission-statuses
                                label="Reference 2"
                                model="employmentRequirementFields.reference2"
                            />
                            <x-selects.submission-statuses
                                label="Driver's License"
                                model="employmentRequirementFields.drivers_license"
                            />
                            <div>
                                <x-jet-label for="emergency_contact" value="Emergency Contact" class="mb-2" />
                                <x-pikaday
                                    name="emergency_contact"
                                    format="MM/DD/YYYY" wire:model.lazy="employmentRequirementFields.emergency_contact"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="signed_disclosure" value="Signed Disclosure" class="mb-2" />
                                <x-pikaday
                                    name="signed_disclosure"
                                    format="MM/DD/YYYY" wire:model.lazy="employmentRequirementFields.signed_disclosure"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="emergency_plan" value="Emergency Plan" class="mb-2" />
                                <x-pikaday
                                    name="emergency_plan"
                                    format="MM/DD/YYYY" wire:model.lazy="employmentRequirementFields.emergency_plan"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <x-selects.submission-statuses
                                label="Job Description"
                                model="employmentRequirementFields.job_description"
                            />
                            <div>
                                <x-jet-label for="staff_handbook" value="Staff Handbook" class="mb-2" />
                                <x-pikaday
                                    name="staff_handbook"
                                    format="MM/DD/YYYY" wire:model.lazy="employmentRequirementFields.staff_handbook"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="staff_data_sheet" value="Staff Data Sheet" class="mb-2" />
                                <x-pikaday
                                    name="staff_data_sheet"
                                    format="MM/DD/YYYY" wire:model.lazy="employmentRequirementFields.staff_data_sheet"
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
