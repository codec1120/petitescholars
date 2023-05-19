<x-staff-layout :user="$user" title="Education Information">
    <x-slot name="content">
        @foreach ($education as $label => $value)
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
                    :redirect="'/staffs/' . $this->user->id . '/education'"
                    :properties="[
                        'filename' => $label,
                        'directory' => 'education',
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
                            Update Education Information
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 overflow-y-scroll sm:overflow-hidden h-96 sm:h-full">
                            <div>
                                <x-jet-label for="hs_diploma" value="HS Disploma" class="mb-2" />
                                 <x-pikaday
                                    name="dob"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="educationInfoFields.hs_diploma"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="college_diploma" value="College Diploma" class="mb-2" />
                                 <x-pikaday
                                    name="college_diploma"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="educationInfoFields.college_diploma"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="college_transcripts" value="College Transcripts" class="mb-2" />
                                 <x-pikaday
                                    name="college_transcripts"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="educationInfoFields.college_transcripts"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="cda" value="CDA" class="mb-2" />
                                 <x-pikaday
                                    name="cda"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="educationInfoFields.cda"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="other_relevant_education" value="Other Relevant Education" class="mb-2" />
                                 <x-pikaday
                                    name="cda"
                                    format="MM/DD/YYYY"
                                    autocomplete="off"
                                    wire:model.lazy="educationInfoFields.other_relevant_education"
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
