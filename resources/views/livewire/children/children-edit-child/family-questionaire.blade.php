<div>
    <x-notification />
    <x-content>
        <div class="col-span-8 sm:col-span-6">
            <form wire:submit.prevent="submit">
                <x-card>
                    <x-slot name="header">
                        <div class="flex justify-between w-full">
                                    <div>
                                        <x-card-title> Family Questionaire </x-card-title>
                                    </div> 
                                    <div class="">
                                        @if(!$disableInputs)
                                            <x-jet-secondary-button wire:click.prevent="$set('disableInputs', true)"  class="w-full">
                                                Cancel
                                            </x-jet-secondary-button> 
                                        @else
                                            <x-jet-button wire:click.prevent="$set('disableInputs', false)"  class="w-full">
                                                <x-heroicon-o-pencil class="w-4 h-4" />
                                                    Edit
                                            </x-jet-button> 
                                        @endif
                                    </div>    
                                </div>
                    </x-slot>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data wire:key="q_child_name" label="Child's Name: " :value="$childrenFields['first_name'].' '.$childrenFields['last_name']" />
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Nickname: " >
                                    <x-jet-input
                                        id="q_nickname"
                                        type="text"
                                        class="block w-full"
                                        wire:model="familyQuestionaireFields.nickname"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.nickname') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                    </x-slot>
                </x-card> 
                </br>
                <x-card>
                    <div class="bg-white grid grid-cols-1 p-5">
                        <span class="font-bold text-gray-500 "> Family Culture. </span>
                    </div>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Child Ethnic/Cultural Background: " >
                                    <x-jet-input
                                        id="q_family_cultural"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.cultural_bg"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.cultural_bg') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Language spoken in household: " >
                                    <x-jet-input
                                        id="q_family_language"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.language"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.language') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500"> Does family celebrate birthdays/holidays? </span>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1 p-5">
                                @if ($disableInputs)
                                <textarea 
                                    placeholder="Description" 
                                    name="family_celebrate_occasions-textArea"
                                    class="rounded-md shadow-sm block w-full outline-none" 
                                    id="family_celebrate_occasions-textArea" 
                                    wire:model.defer="familyQuestionaireFields.family_celebrate_occasions"
                                    disabled
                                ></textarea>
                                @else
                                <textarea 
                                    placeholder="Description" 
                                    name="family_celebrate_occasions-textArea"
                                    class="rounded-md shadow-sm block w-full outline-none" 
                                    id="family_celebrate_occasions-textArea" 
                                    wire:model.defer="familyQuestionaireFields.family_celebrate_occasions"
                                ></textarea>
                                @endif
                            </div>
                        </div>
                    </x-slot>
                </x-card> 
                </br>
                <x-card>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500 "> Childcare History. </span>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-400"> Has your child been in daycare before?  </span>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1 p-5">
                                <x-forms.select
                                    id="daycare_bg"
                                    label=""
                                    :options="$familyQuestionaireFields['options']"
                                    placeholder="Please select..."
                                    error="familyQuestionaireFields.daycare_bg"
                                    wire:model="familyQuestionaireFields.daycare_bg"
                                    disabled={{$disableInputs}}
                                />
                            </div>
                        </div>
                        <div>
                            @if ( $familyQuestionaireFields['daycare_bg'] )
                                <div class="bg-white grid grid-cols-1">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data-input label="Name of previous daycare provider: " >
                                            <x-jet-input
                                                id="daycare_bg_name"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="familyQuestionaireFields.daycare_bg_name"
                                                autocomplete="false"
                                                disabled={{$disableInputs}}
                                            />
                                        @error('familyQuestionaireFields.daycare_bg_name') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </x-list-data-input>
                                    </div>
                                </div>
                                <div class="bg-white grid grid-cols-1">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data-input label="Daycare start date: " >
                                            <x-pikaday
                                                name="daycare_bg_start_date"
                                                format="MM/DD/YYYY" wire:model.lazy="familyQuestionaireFields.daycare_bg_start_date"
                                                class="form-input rounded-md shadow-sm w-full"
                                                disabled={{$disableInputs}}
                                            />
                                        @error('familyQuestionaireFields.daycare_bg_start_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </x-list-data-input>
                                    </div>
                                </div>
                                <div class="bg-white grid grid-cols-1">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data-input label="Daycare end date: " >
                                            <x-pikaday
                                                name="daycare_bg_end_date"
                                                format="MM/DD/YYYY" wire:model.lazy="familyQuestionaireFields.daycare_bg_end_date"
                                                class="form-input rounded-md shadow-sm w-full"
                                                disabled={{$disableInputs}}
                                            />
                                        @error('familyQuestionaireFields.daycare_bg_end_date') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </x-list-data-input>
                                    </div>
                                </div>
                                <div class="bg-white grid grid-cols-1">
                                    <div class="bg-white grid grid-cols-1">
                                        <x-list-data-input label="Reason for Daycare termination: " >
                                            <x-jet-input
                                                id="daycare_bg_reason_termination"
                                                type="text"
                                                class="block w-full"
                                                wire:model.defer="familyQuestionaireFields.daycare_bg_reason_termination"
                                                autocomplete="false"
                                                disabled={{$disableInputs}}
                                            />
                                        @error('familyQuestionaireFields.daycare_bg_reason_termination') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                        </x-list-data-input>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </x-slot>
                </x-card> 
                </br>
                <x-card>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500 "> Eating Habits. </span>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="What are your child eating habits? " >
                                    <x-jet-input
                                        id="eating_habits"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.eating_habits"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.eating_habits') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="How often does your child drink during the day? " >
                                    <x-jet-input
                                        id="child_drink"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.child_drink"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.child_drink') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Does your child have a special diet?" >
                                    <x-jet-input
                                        id="special_diet"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.special_diet"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.special_diet') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Any other foods your child should not be fed?" >
                                    <x-jet-input
                                        id="child_food_refrain"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.child_food_refrain"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.child_food_refrain') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                    </x-slot>
                </x-card> 
                </br>
                <x-card>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="font-bold text-gray-500 "> Sleeping Habits. </span>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="How many hours of sleep does your child get? " >
                                    <x-jet-input
                                        id="hours_of_sleep"
                                        type="number"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.hours_of_sleep"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.hours_of_sleep') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="What time does your child go to bed at night?" >
                                    <x-jet-input
                                        id="bed_time"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.bed_time"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.bed_time') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1">
                            <div class="bg-white grid grid-cols-1">
                                <x-list-data-input label="Does your child take naps during the day? If so, what time?" >
                                    <x-jet-input
                                        id="nap_days"
                                        type="text"
                                        class="block w-full"
                                        wire:model.defer="familyQuestionaireFields.nap_days"
                                        autocomplete="false"
                                        disabled={{$disableInputs}}
                                    />
                                @error('familyQuestionaireFields.nap_days') <span class="error" style="color:red">{{ $message }}</span> @enderror
                                </x-list-data-input>
                            </div>
                        </div>
                    </x-slot>
                </x-card> 
                <x-card-action>
                    <div>
                    @if($disableInputs) 
                        <x-jet-button disabled>
                            Update
                        </x-jet-button> 
                    @else 
                        <x-jet-button>
                            Update
                        </x-jet-button> 
                    @endif   
                    </div>
                </x-card-action>
            </form>
        </div> 
    </x-content>
</div>
