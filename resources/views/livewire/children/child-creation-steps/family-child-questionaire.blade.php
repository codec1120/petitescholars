<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title> Family & Child Questionnaire </x-card-title>
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
                            wire:model.defer="familyQuestionaireFields.nickname"
                            autocomplete="false"
                        />
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
                        />
                        @if($errors->has('cultural_bg')) <span class="error" style="color:red">{{ $errors->first('cultural_bg') }}</span> @endif
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
                        />
                        @if($errors->has('language')) <span class="error" style="color:red">{{ $errors->first('language') }}</span> @endif
                    </x-list-data-input>
                </div>
            </div>
            <div class="bg-white grid grid-cols-1 p-5">
                <span class="font-bold text-gray-500"> Does family celebrate birthdays/holidays? </span>
            </div>
            <div class="bg-white grid grid-cols-1">
                <div class="bg-white grid grid-cols-1 p-5">
                    <textarea 
                        placeholder="Description" 
                        name="family_celebrate_occasions-textArea"
                        class="rounded-md shadow-sm block w-full outline-none" 
                        id="family_celebrate_occasions-textArea" 
                        wire:model.defer="familyQuestionaireFields.family_celebrate_occasions"
                        ></textarea>
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
                        wire:model.defer="familyQuestionaireFields.daycare_bg"
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
                                />
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
                                />
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
                                />
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
                                />
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
                        />
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
                        />
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
                        />
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
                        />
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
                        />
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
                        />
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
                        />
                    </x-list-data-input>
                </div>
            </div>
        </x-slot>
        <x-slot name="actions">
            <button type="button" 
                wire:click="saveFamilyQuestionaire"
                @click="scrollTo({top: 15, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                Save
            </button>
        </x-slot>
    </x-card> 
</div>
<script>
window.scrollTo({ top: 0, left: 15, behaviour: 'smooth' })
</script>