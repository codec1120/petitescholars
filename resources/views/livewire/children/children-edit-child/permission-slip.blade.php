<div>
    <x-notification />
    <x-content>
        <div class="col-span-8 sm:col-span-6">
            <form wire:submit.prevent="submit">
                <x-card>
                    <x-slot name="header">
                        <div class="flex justify-between w-full">
                            <div>
                                <x-card-title> Permission Slips </x-card-title>
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
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Do you give Petite Scholars permission to apply sunscreen to your child ?</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_put_sunscreen" name="allow_put_sunscreen" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_put_sunscreen" name="allow_put_sunscreen" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Yes, I give Petite Scholars Permission</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_put_sunscreen" name="allow_put_sunscreen" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_put_sunscreen" name="allow_put_sunscreen" value="no" />
                                    @endif
                                <span class="ml-2">No, I do not give Petite Scholars my consent to apply sunscreen</span>
                                </label>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Do you give your child permission to use Hand Sanitizer?</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_use_hand_sanitizer" name="allow_use_hand_sanitizer" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_use_hand_sanitizer" name="allow_use_hand_sanitizer" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Yes, I give my child permission to use Hand Sanitizer</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_use_hand_sanitizer" name="allow_use_hand_sanitizer" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_use_hand_sanitizer" name="allow_use_hand_sanitizer" value="no"/>
                                    @endif
                                <span class="ml-2">No, I do not give my permission for my child to use Hand Sanitizer</span>
                                </label>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Do you give Petite Scholars permission to apply diaper cream to your child?</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_apply_diaper_cream" name="allow_apply_diaper_cream" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_apply_diaper_cream" name="allow_apply_diaper_cream" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Yes, I give my child permission to apply diaper cream</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_apply_diaper_cream" name="allow_apply_diaper_cream" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_apply_diaper_cream" name="allow_apply_diaper_cream" value="no"/>
                                    @endif
                                <span class="ml-2">No, I do not give my permission for my child to aaply diaper cream</span>
                                </label>
                                <label class="flex items-center w-full">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_apply_diaper_cream" name="allow_apply_diaper_cream" value="not_applicable" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="permissionSlip.allow_apply_diaper_cream" name="allow_apply_diaper_cream" value="not_applicable"/>
                                    @endif
                                <span class="ml-2">Not Applicable</span>
                                </label>
                            </div>
                        </div>
                    </x-slot>
                </x-card>
                </br> 
                <x-card>
                    <x-slot name="header">
                        <x-card-title> Permission to Photograph </x-card-title>
                    </x-slot>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1 p-5">
                            <p class="">I, <span class="underline">{{$childs_father['primary_guardian'] ? ($childs_father['first_name'].' '.$childs_father['last_name']): ($childs_mother['first_name'].' '.$childs_mother['last_name'])}}</span>, I gave permission to 
                            <span class="font-bold">Petite Scholars Learning Center </span> to photograph my child, <span class="underline">{{$childrenFields['first_name'].' '.$childrenFields['last_name']}}</span>, for the following purposes: 
                            </p>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Display in my personal scrapbook?</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                @if($disableInputs)
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_1" name="photograph_q_1" value="yes" checked disabled/>
                                @else
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_1" name="photograph_q_1" value="yes" checked/>
                                @endif                                    
                                <span class="ml-2">Grant Permission</span>
                                </label>
                                <label class="flex items-center">
                                @if($disableInputs)
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_1" name="photograph_q_1" value="no" disabled/>
                                @else
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_1" name="photograph_q_1" value="no"/>
                                @endif
                                <span class="ml-2">Decline Permission</span>
                                </label>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Give photographs possibly containing your child to current clients</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                @if($disableInputs)
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_2" name="photograph_q_2" value="yes" checked disabled/>
                                @else
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_2" name="photograph_q_2" value="yes" checked/>
                                @endif
                                <span class="ml-2">Grant Permission</span>
                                </label>
                                <label class="flex items-center">
                                @if($disableInputs)
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_2" name="photograph_q_2" value="no" disabled/>
                                @else
                                    <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_2" name="photograph_q_2" value="no"/>
                                @endif
                                <span class="ml-2">Decline Permission</span>
                                </label>
                            </div>
                        </div>
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Display in facility’s scrapbook or bulletin boards, shown to current and prospective clients</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_3" name="photograph_q_3" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_3" name="photograph_q_3" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Grant Permission</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_3" name="photograph_q_3" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_3" name="photograph_q_3" value="no"/>
                                    @endif
                                <span class="ml-2">Decline Permission</span>
                                </label>
                            </div>
                        </div>  
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Display still photos on child care website</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_4" name="photograph_q_4" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_4" name="photograph_q_4" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Grant Permission</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_4" name="photograph_q_4" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_4" name="photograph_q_4" value="no"/>
                                    @endif
                                <span class="ml-2">Decline Permission</span>
                                </label>
                            </div>
                        </div> 
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Post photos on child care’s Facebook Page</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_5" name="photograph_q_5" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_5" name="photograph_q_5" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Grant Permission</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_5" name="photograph_q_5" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_5" name="photograph_q_5" value="no"/>
                                    @endif
                                <span class="ml-2">Decline Permission</span>
                                </label>
                            </div>
                        </div>  
                        <div class="bg-white grid grid-cols-1 p-5">
                            <span class="">Post photos to the Brightwheel app</span>
                            <div class="mt-2">
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_6" name="photograph_q_6" value="yes" checked disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_6" name="photograph_q_6" value="yes" checked/>
                                    @endif
                                <span class="ml-2">Grant Permission</span>
                                </label>
                                <label class="flex items-center">
                                    @if($disableInputs)
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_6" name="photograph_q_6" value="no" disabled/>
                                    @else
                                        <input type="radio" class="form-radio"  wire:model="photographPermissionSlipQuestions.photograph_q_6" name="photograph_q_6" value="no"/>
                                    @endif
                                <span class="ml-2">Decline Permission</span>
                                </label>
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
