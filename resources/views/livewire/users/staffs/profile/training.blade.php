<x-staff-layout :user="$user" title="Training Information">
    <x-slot name="content">
        <x-list-data label="DOH" :value="$this->user->getGeneralInfo()['doh']" />
        <x-list-data label="PD Registry" :value="$this->user->getGeneralInfo()['pd_registry']" />
        @foreach ($trainings as $index => $item)
            @if (in_array($item['label'], $disableUploadButtonForThisFields))
                <x-list-data
                        :label="$item['label']"
                        :value="$item['value']"
                    >
                    <x-slot name="message">
                        <x-jet-label :for="$index" wire:model="$item['value']" class="text-red-500" />
                        @if ( isset($item[$index.'_date_compilation_key']) )
                           {{ $item[$index.'_date_compilation_key'] }}
                        @endif
                    </x-slot>
                </x-list-data>
            @else
                @if($index === 'emergency_plan')
                <x-list-data
                        :label="$item['label']"
                        :value="$item['value']"
                    >
                    @if (!$item['value'])
                        <x-slot name="message">
                            <x-jet-label :for="$item['label']" value="Missing documentation" class="text-red-500" />
                        </x-slot>
                    @endif

                    @if ($item['value'])
                        <div>
                            <x-jet-secondary-button wire:click="viewEmergencyPlan" class="w-full">
                                <x-heroicon-o-eye class="w-4 h-4 mr-2 text-sm md:text-base"/>
                                View
                            </x-jet-secondary-button>
                        </div>
                    @else
                        <div>
                            <x-jet-secondary-button wire:click="$set('emergencyPlanModal', true)"  class="w-full">
                                <x-heroicon-o-clipboard-check class="w-4 h-4 mr-2 text-sm md:text-base"/>
                                Sign
                            </x-jet-secondary-button>
                        </div>
                    @endif
                </x-list-data>
                <div>
                    <x-jet-dialog-modal :id="'view-emergency-plan'" wire:model="emergencyPlanModal">
                        <x-slot name="title">
                        <div class="text-center text-sm md:text-base"> Petite Scholar Learning Center Emergency Plan </div>
                        </x-slot>

                        <x-slot name="content">
                            @include('livewire.users.staffs.profile.emergency-plan.emergency-plan-file')
                        </x-slot>

                        @if ( !$viewemergencyPlanModal )
                        <x-slot name="footer">
                            @if ( !$showAcceptBtnForEmergencyPlan )
                                <x-jet-danger-button wire:click="cancel" wire:loading.attr="disabled">
                                    Reject
                                </x-jet-danger-button>
                                <x-jet-secondary-button class="ml-2 bg-gray-50 border-gray-50" wire:click.prevent="acceptEmergencyPlan" disabled>
                                    <span class="text-gray-200 text-sm md:text-base">Accept</span>
                                </x-jet-secondary-button>
                            @else
                                <x-jet-danger-button wire:click="cancel" wire:loading.attr="disabled">
                                    Reject
                                </x-jet-danger-button>
                                <x-jet-secondary-button class="ml-2 text-sm md:text-base" wire:click.prevent="acceptEmergencyPlan" >
                                    Accept
                                </x-jet-secondary-button>
                            @endif
                        </x-slot>
                        @else
                        <x-slot name="footer">
                            <x-jet-danger-button wire:click="cancel">
                                Ok
                            </x-jet-danger-button>
                        </x-slot>
                        @endif
                    </x-jet-dialog-modal>
                </div>
                @else
                <x-list-data
                        :label="$item['label']"
                        :value="$item['value']"
                    >
                    @if (
                        !$user->hasMedia(slug($item['label'], '_')) &&
                        $item
                    )
                        <x-slot name="message">
                            <x-jet-label :for="$item['label']" value="Missing documentation" class="text-red-500" />
                        </x-slot>
                    @endif

                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="'/staffs/' . $this->user->id . '/training'"
                        :properties="[
                            'filename' => $item['label'],
                            'directory' => 'training',
                            'tag' => slug($item['label'], '_')
                        ]"
                    />
                </x-list-data>
                @endif
            @endif

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
                            Update Training Information
                        </div>
                        @error('modal') <span class="error" style="color:red">{{ $message }}</span> @enderror
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6 overflow-y-scroll h-96">

                            <div>
                                <x-jet-label for="first_aid_cpr" value="First Aid/CPR" class="mb-2" />
                                 <x-pikaday
                                    name="first_aid_cpr"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.first_aid_cpr.value"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="fire_safety" value="Fire Safety" class="mb-2" />
                                 <x-pikaday
                                    name="fire_safety"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.fire_safety.value"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="mandated_reported" value="Mandated Reported" class="mb-2" />
                                 <x-pikaday
                                    name="trainingFields.mandated_reported"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.mandated_reported.value"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="health_safety" value="Health & Safety" class="mb-2" />
                                 <x-pikaday
                                    name="health_safety"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.health_safety.value"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="stars101" value="Stars 101" class="mb-2" />
                                 <x-pikaday
                                    name="stars101"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.stars101.value"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                <x-jet-label for="stars102" value="Stars 102" class="mb-2" />
                                 <x-pikaday
                                    name="stars102"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.stars102.value"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                                @error('trainingFields.s_q343.s_q343_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.3"
                                    model="trainingFields.s_q343.value"
                                />
                                 <x-pikaday
                                    name="s_q343"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q343.s_q343_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>

                            <div>
                            @error('trainingFields.s_q344.s_q344_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.4"
                                    model="trainingFields.s_q344.value"
                                />
                                 <x-pikaday
                                    name="s_q344"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q344.s_q344_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                            @error('trainingFields.s_q345.s_q345_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.5"
                                    model="trainingFields.s_q345.value"
                                />
                                 <x-pikaday
                                    name="s_q345"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q345.s_q345_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                            @error('trainingFields.s_q346.s_q346_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.6"
                                    model="trainingFields.s_q346.value"
                                />
                                 <x-pikaday
                                    name="s_q346"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q346.s_q346_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                            @error('trainingFields.s_q347.s_q347_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.7"
                                    model="trainingFields.s_q347.value"
                                />
                                 <x-pikaday
                                    name="s_q347"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q347.s_q347_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                            @error('trainingFields.s_q348.s_q348_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.8"
                                    model="trainingFields.s_q348.value"
                                />
                                 <x-pikaday
                                    name="s_q348"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q348.s_q348_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <div>
                            @error('trainingFields.s_q349.s_q349_date_compilation_key') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                <x-selects.completion-statuses
                                    label="SQ 3.4.9"
                                    model="trainingFields.s_q349.value"
                                />
                                 <x-pikaday
                                    name="s_q349"
                                    format="MM/DD/YYYY" wire:model.lazy="trainingFields.s_q349.s_q349_date_compilation_key"
                                    autocomplete="off"
                                    class="form-input rounded-md shadow-sm w-full"
                                />
                            </div>
                            <x-selects.completion-statuses
                                label="Yearly 6-hour Training"
                                model="trainingFields.20206_hour_training.value"
                            />
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
