<div>
    <x-notification />
    <x-header :title="$childName" :description="$status" class="flex justify-end">
    @if($goToForm == '')
        @if(Auth()->user()->role == 'admin')
       <div>
            <div class="px-2 py-2">
                <x-link :href="route('children', ['user' => auth()->user()->id ])">
                    <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                    Go Back
                </x-link>
            </div>
            <div>
                <x-link :href="route('children.contacts.contacts', [
                        'user' => Auth()->user()->id,
                        'first_name' => $childrenFields['first_name'],
                        'last_name' => $childrenFields['last_name'],
                        'child_id' => $childrenFields['id'],
                    ])"
                    class="py-1 px-2 rounded-full inline-flex items-center bg-[#ED5314] text-white">
                    View or Add New Contacts
                </x-link>
            </div>
       </div>
       @else
        <div class="px-2 py-2">
            <x-link :href="route('children', ['user' => auth()->user()->id ])">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </div>
        @endif
    @else
        <x-link :href="route('children.children-view', [
                'user' => Auth()->user()->id,
                'first_name' => $childrenFields['first_name'],
                'last_name' => $childrenFields['last_name'],
                'child_id' => $childrenFields['id'],
            ])">
            <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
            Go Back
        </x-link>
    @endif


    </x-header>
    <x-content>
    @if($goToForm == '')
    <div class="px-8 w-full flex justify-end col-span-8 sm:col-span-6">
        <x-link :href="route('children.notes.notes', [
                'user' => Auth()->user()->id,
                'first_name' => $childrenFields['first_name'],
                'last_name' => $childrenFields['last_name'],
                'child_id' => $childrenFields['id'],
            ])"
            class="bg-blue-500 rounded-lg text-white w-2/4 md:w-1/4 flex justify-center btnSameWidth">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
            Notes
        </x-link>
    </div>
    @endif
    @if($goToForm == '')
    <!-- Child Information Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full py-4">
                <div class="flex justify-start font-bold">Child Information</div>
                <div class="flex justify-end">
                    <x-jet-button class="btnSameWidth w-2/4 md:w-1/4 flex justify-center" wire:click="$set('goToForm', 'childrenInfo')">
                        Edit
                    </x-jet-button>
                </div>
            </div>
            <div>Update child address, DOB and other important general child information. </div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($childInfoCompleted)
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        <span class="font-bold px-2">{{$childInfoLastModifiedDate}}</span>
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Medical Information Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Medical Information</div>
                <div class="flex justify-end">
                    <x-jet-button class="btnSameWidth w-2/4 md:w-1/4 flex justify-center" wire:click="$set('goToForm', 'medicalInfo')">
                        Edit
                    </x-jet-button>
                </div>
            </div>
            <div>Update child allergies, medication and additional medical information. </div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($childMedicalInfoCompleted)
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        <span class="font-bold px-2">{{$childMedicalInfoLastModifiedDate}}</span>
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Family Questionnaire Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Family Questionnaire</div>
                <div class="flex justify-end">
                    <x-jet-button class="btnSameWidth w-2/4 md:w-1/4 flex justify-center" wire:click="$set('goToForm', 'familyQuestionaire')">
                        Edit
                    </x-jet-button>
                </div>
            </div>
            <div>Update child information about family details.</div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($childChildQuestoinaerCompleted)
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        <span class="font-bold px-2">{{$childFamilyQuestionaierModifiedDate}}</span>
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Emergency Contacts Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full py-2">
                <div class="flex justify-start font-bold">Emergency Contacts</div>
                <div class="flex justify-end">
                        <x-jet-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center" wire:click="downloadEmergencyContactForm">
                            Download Form
                        </x-jet-button>
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-2">
                <div class="flex justify-start">Please follow these steps to include your emergency contact information:</div>
                <div class="flex justify-end">
                @if($emergencyContacForm)
                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="$fileUploaderRedirectRouteEmergencyContact"

                        :properties="[
                            'filename' => 'Emergency Contact Parental Consent Form',
                            'directory' => 'child_emergency_contact_uploads/consent_form_'.$child_id,
                            'tag' => slug('Emergency Contact Parental Consent Form'.'-'.$child_id, '_')
                        ]"
                    />
                @endif
                </div>
            </div>
            <div>1. Click on the ﻿Download﻿ button to print the state-approved Emergency Contact form.</div>
            <div>2. Complete the form and sign it.</div>
            <div>3. Click on the ﻿﻿0 File﻿ button to upload your signed form</div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($emergencyContactDateReviewed
                            && $this->user->hasMedia(slug('Emergency Contact Parental Consent Form'.'-'.$this->child_id, '_')))
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize">Complete</span>
                        </span>
                        @elseif(!$emergencyContactDateReviewed
                            && $this->user->hasMedia(slug('Emergency Contact Parental Consent Form'.'-'.$this->child_id, '_')))
                            <span class="px-2 py-2 text-xs rounded-full bg-yellow-400 text-black capitalize">Pending Review</span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not Complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-3">
                        @if($user->isAdmin())
                        <label class="flex items-center font-light text-slate-800">
                            <span class="w-full">Date of Signature:</span>
                            <x-pikaday
                                name="emergencyContactDateReviewed"
                                format="MM/DD/YYYY" wire:model.lazy="emergencyContactDateReviewed"
                                autocomplete="off"
                                class="form-input rounded-md shadow-sm w-full"
                            />
                        </label>
                        @else
                            <span class="font-bold px-2">{{$emergencyContactDateReviewed}}</span>
                        @endif
                </div>
                <div class="bg-white grid grid-cols-1 py-2">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        @if($emergencyContactDateReviewed)
                            <span class="font-bold px-2">{{$childEmergencyContactModifiedDate}}</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    @if($emergencyContactExpirationDate)
                        <label class="flex items-center font-light text-slate-800">Expiration Date:
                            <span class="font-bold px-2">{{$emergencyContactExpirationDate}}</span>
                        </label>
                    @endif
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Permission Slips Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Permission Slips</div>
                <div class="flex justify-end">
                    <x-jet-button class="btnSameWidth w-2/4 md:w-1/4 flex justify-center" wire:click="$set('goToForm', 'permissionSlips')">
                        Edit
                    </x-jet-button>
                </div>
            </div>
            <div>Update permissions provided to Petite Scholars staff.</div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($childPermissionCompleted)
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        <span class="font-bold px-2">{{$childPermissionDateModified}}</span>
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Parent Handbook Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            @if ($parentHandbook['signed_date'])
            <div class="flex justify-start font-bold">Parent Handbook</div>
            <div class="grid grid-cols-2 py-2">
                <div class="flex justify-start">View and Sign Parent Handbook.</div>
                <div class="flex justify-end">
                    @if($parentHandbookFile)
                    <x-jet-secondary-button wire:loading.attr="disabled" class="btnSameWidth w-2/4 md:w-1/4 flex justify-center" wire:click="$set('displayHandbookModal', 'true')">
                        View
                    </x-jet-secondary-button>
                    @else
                        <span class="text-red-500">Parent Handbook unavailable.</span>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-2">
                <div class="flex justify-start"></div>
                <div class="flex justify-end">
                    @if($parentHandbookFile)
                        <x-jet-button wire:loading.attr="disabled" class="btnSameWidth w-3/4 md:w-1/4 flex justify-center" wire:click="downloadParentHandbook">
                            Download
                        </x-jet-button>
                    @endif
                </div>
            </div>
            @else
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Parent Handbook</div>
                <div class="flex justify-end">
                    @if($parentHandbookFile)
                        <x-jet-button class="btnSameWidth w-2/4 md:w-1/4 flex justify-center" wire:click="$set('displayHandbookModal', 'true')">
                            Sign
                        </x-jet-button>
                    @else
                        <span class="text-red-500">Parent Handbook unavailable.</span>
                    @endif
                </div>
            </div>
            @endif
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($parentHandbook['signed_date'] && $parentHandbookFile)
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Date Signed:
                    @if( $parentHandbook['signed_date'] && $parentHandbookFile)
                        <span class="font-bold px-2">{{$childParentHandBookModifiedDate}}</span>
                    @else
                        <span class="font-bold px-2"></span>
                    @endif
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <div>
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

                @if ( $parentHandbook['signed_date'] ||  $disableParentHandbookAcceptBtn )
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
    </div>
    <!-- Health Assessments Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Health Assessments</div>
                <div class="flex justify-end">
                    @if($childHealthAssessmentFile)
                        <x-jet-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36" wire:click="downloadAssesmentForm">
                            Download Form
                        </x-jet-button>
                    @else
                        <span class="text-red-500">Child health assessment unavailable.</span>
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-2">
                <div class="flex justify-start">Please follow these steps to upload your child’s health report:</div>
                <div class="flex justify-end">
                    @if($childHealthAssessmentFile)
                        <livewire:file-uploader
                            :user="$user"
                            :key="uuid()"
                            :redirect="$fileUploaderRedirectRouteEmergencyContact"
                            :properties="[
                                'filename' => 'Assement Form',
                                'directory' => 'assesment_form/consent_form_'.$child_id,
                                'tag' => slug('Assement Form'.'-'.$child_id, '_')
                            ]"
                        />
                    @endif
                </div>
            </div>
            <div>1. Click on the ﻿Download Form﻿ button to print Health Report.</div>
            <div>2. Complete the form and sign it.</div>
            <div>3. Click on the ﻿﻿0 File﻿ button to upload your signed form.</div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($childHealthAssessmentFile
                            && $healthAssessmentDateReviewed
                            && $this->user->hasMedia(slug('Assement Form'.'-'.$this->child_id, '_')))
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize">Complete</span>
                        </span>
                        @elseif($childHealthAssessmentFile
                            && !$healthAssessmentDateReviewed
                            && $this->user->hasMedia(slug('Assement Form'.'-'.$this->child_id, '_')))
                            <span class="px-2 py-2 text-xs rounded-full bg-yellow-400 text-black capitalize">Pending Review</span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not Complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-3">
                    @if($user->isAdmin())
                    <label class="flex items-center font-light text-slate-800">
                        <span class="w-full">Date of Signature:</span>
                        <x-pikaday
                            name="healthAssessmentDateReviewed"
                            format="MM/DD/YYYY" wire:model.lazy="healthAssessmentDateReviewed"
                            autocomplete="off"
                            class="form-input rounded-md shadow-sm w-full"
                        />
                    </label>
                    @else
                        <span class="font-bold px-2">{{$healthAssessmentDateReviewed}}</span>
                    @endif
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        @if($childHealthAssessmentFile
                            && $healthAssessmentDateReviewed
                            && $this->user->hasMedia(slug('Assement Form'.'-'.$this->child_id, '_')))
                            <span class="font-bold px-2">{{$healthAssesmentDateUploadedFile}}</span>
                        @endif
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Immunization Records Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Immunization Records</div>
                <div class="flex justify-end">
                    <x-jet-button class="btnSameWidth w-2/4 md:w-1/4  flex justify-center" wire:click="$set('goToForm', 'immunization')">
                        Edit
                    </x-jet-button>
                </div>
            </div>
            <div>Update immunizations for your child.</div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($immunizationCompleted)
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        <span class="font-bold px-2">{{$immunizationLastModified}}</span>
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
    <!-- Fee Agreement Card -->
    <x-card class="sm:rounded-3xl">
        <x-slot name="table">
        <div class="px-8 py-8">
            @if(auth()->user()->isAdmin())
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Fee Agreement</div>
                <div class="hidden md:flex lg:flex justify-end ">
                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="$fileUploaderRedirectRouteEmergencyContact"
                        :properties="[
                            'filename' => 'Child Fee Agreement',
                            'directory' => 'child_fee_agreement/child_fee_agreement_'.$child_id,
                            'tag' => slug('Child Fee Agreement'.'-'.$child_id, '_'),
                            'label' => 'Add Fee Agreement',
                            'class' => 'bg-[#ff9900]',
                            'uploaded_label' => 'Fee Agreement File',
                        ]"
                    />
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-2">
                <div class="flex justify-start w-[300px] lg:w-[700px]">The Fee Agreement for your child will be provided by Petite Scholars. Once the Fee Agreement has been generated please follow these steps:</div>
                <div class="hidden md:flex lg:flex justify-end h-9">
                    <x-jet-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36 bg-[#ff9900]" wire:click="$set('displayNotifyParentModal', true)">
                        Notify Parent
                    </x-jet-button>
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-2">
                <div class="flex justify-start w-[300px] lg:w-[700px]">1. Click on the ﻿Download Form button to print your child’s Fee Agreement.</div>
                <div class="hidden md:flex lg:flex justify-end h-9">
                    <x-jet-secondary-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36 bg-white" wire:click="downloadFeeAgreement">
                        @if($childLastestFeeAgreementFile != '')
                            Download Fee Agreement
                        @else
                            Waiting For File
                        @endif
                    </x-jet-secondary-button>
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-1">
                <div class="flex justify-start">2. Complete the agreement and sign it.</div>
                <div class="hidden md:flex lg:flex justify-end h-9">
                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="$fileUploaderRedirectRouteEmergencyContact"
                        :properties="[
                            'filename' => 'Signed Child Fee Agreement',
                            'directory' => 'child_fee_agreement/child_fee_agreement'.$child_id,
                            'tag' => slug('Signed Child Fee Agreement'.'-'.$child_id, '_')
                        ]"
                    />
                </div>
            </div>
            @else
            <div class="grid grid-cols-2 w-full">
                <div class="flex justify-start font-bold">Fee Agreement</div>
                <div class="hidden md:flex lg:flex justify-end">
                    <livewire:file-uploader
                            :user="$user"
                            :key="uuid()"
                            :redirect="$fileUploaderRedirectRouteEmergencyContact"
                            :properties="[
                                'filename' => 'Emergency Contact Parental Consent Form',
                                'directory' => 'child_emergency_contact_uploads/consent_form_'.$child_id,
                                'tag' => slug('Emergency Contact Parental Consent Form'.'-'.$child_id, '_')
                            ]"
                        />
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-2">
                <div class="flex justify-start w-[300px] lg:w-[700px]">1. Click on the ﻿Download Form button to print your child’s Fee Agreement.</div>
                <div class="hidden md:flex lg:flex justify-end h-9">
                    <x-jet-secondary-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36 bg-white" wire:click="downloadAssesmentForm">
                        Waiting For File
                    </x-jet-secondary-button>
                </div>
            </div>
            <div>2. Complete the agreement and sign it.</div>
            @endif
            <div>3. Click on the ﻿﻿0 File﻿ button to upload your signed fee agreement.</div>
            <div class="block lg:hidden md:hidden py-4">
            @if(auth()->user()->isAdmin())
            <div class="grid grid-cols-2 w-full py-4">
                <div>
                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="$fileUploaderRedirectRouteEmergencyContact"
                        :properties="[
                            'filename' => 'Child Fee Agreement',
                            'directory' => 'child_fee_agreement/child_fee_agreement_'.$child_id,
                            'tag' => slug('Child Fee Agreement'.'-'.$child_id, '_'),
                            'label' => 'Add Fee Agreement',
                            'class' => 'bg-[#ff9900]',
                            'uploaded_label' => 'Fee Agreement File',
                        ]"
                    />
                </div>
                <div class="px-4">
                    <x-jet-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36 bg-[#ff9900]" wire:click="$set('displayNotifyParentModal', true)">
                        Notify Parent
                    </x-jet-button>
                </div>
            </div>
            <div class="grid grid-cols-2 w-full py-2">
                <div>
                    <x-jet-secondary-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36 bg-white" wire:click="downloadFeeAgreement">
                        @if($childLastestFeeAgreementFile != '')
                            Download Fee Agreement
                        @else
                            Waiting For File
                        @endif
                    </x-jet-secondary-button>
                </div>
                <div class="px-4">
                    <livewire:file-uploader
                            :user="$user"
                            :key="uuid()"
                            :redirect="$fileUploaderRedirectRouteEmergencyContact"
                            :properties="[
                                'filename' => 'Emergency Contact Parental Consent Form',
                                'directory' => 'child_emergency_contact_uploads/consent_form_'.$child_id,
                                'tag' => slug('Emergency Contact Parental Consent Form'.'-'.$child_id, '_')
                            ]"
                        />
                </div>
            </div>
            @else
            <div class="grid grid-cols-2 w-full py-2">
                <div>
                    <x-jet-secondary-button wire:loading.attr="disabled" class="btnSameWidth flex justify-center w-36 bg-white" wire:click="downloadFeeAgreement">
                        @if($childLastestFeeAgreementFile != '')
                            Download Fee Agreement
                        @else
                            Waiting For File
                        @endif
                    </x-jet-secondary-button>
                </div>
                <div class="px-4">
                    <livewire:file-uploader
                            :user="$user"
                            :key="uuid()"
                            :redirect="$fileUploaderRedirectRouteEmergencyContact"
                            :properties="[
                                'filename' => 'Emergency Contact Parental Consent Form',
                                'directory' => 'child_emergency_contact_uploads/consent_form_'.$child_id,
                                'tag' => slug('Emergency Contact Parental Consent Form'.'-'.$child_id, '_')
                            ]"
                        />
                </div>
            </div>
            @endif
            </div>
            <div class="bg-white grid grid-cols-1 pt-8">
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Status:
                        @if($childFeeAgreementCompleted
                            && $feeAgreementDateReviewed
                            && $this->user->hasMedia(slug('Signed Child Fee Agreement'.'-'.$this->child_id, '_')))
                        <span class="bg-green-500 py-1 px-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="#0b9f6e" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"  class="text-white" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <span class="px-2 text-xs font-medium leading-4 text-white capitalize"">Complete</span>
                        </span>
                        @elseif($childFeeAgreementCompleted
                            && !$feeAgreementDateReviewed
                            && $this->user->hasMedia(slug('Signed Child Fee Agreement'.'-'.$this->child_id, '_')))
                            <span class="px-2 py-2 text-xs rounded-full bg-yellow-400 text-black capitalize">Pending Review</span>
                        @else
                            <span class="px-2 py-2 text-xs rounded-full bg-red-100 text-black capitalize"">Not Complete</span>
                        @endif
                    </label>
                </div>
                <div class="bg-white grid grid-cols-3">
                    @if($user->isAdmin())
                    <label class="flex items-center font-light text-slate-800">
                        <span class="w-full">Date of Signature:</span>
                        <x-pikaday
                            name="feeAgreementDateReviewed"
                            format="MM/DD/YYYY" wire:model.lazy="feeAgreementDateReviewed"
                            autocomplete="off"
                            class="form-input rounded-md shadow-sm w-full"
                        />
                    </label>
                    @else
                        <span class="font-bold px-2">{{$feeAgreementDateReviewed}}</span>
                    @endif
                </div>
                <div class="bg-white grid grid-cols-1">
                    <label class="flex items-center font-light text-slate-800">Last Modified:
                        @if($feeAgreementDateReviewed)
                            <span class="font-bold px-2">{{$childFeeAgreementLastModified}}</span>
                        @endif
                    </label>
                </div>
            </div>
        </div>
        </x-slot>
    </x-card>
        <x-jet-dialog-modal :id="'notify-parent'" wire:model="displayNotifyParentModal" >
            <x-slot name="title">
                <div class="text-center text-base"> Fee Agreement Email Editor </div>
            </x-slot>

            <x-slot name="content">
                    <p>Please compose your email to notify parents of the <span class="font-bold">Fee Agreement</span>.</p>
                    <div class="grid grid-cols-1 w-full py-4">
                        <label class="flex items-center">
                            Parents Email
                        </label>
                        <x-input.text class="py-4 border" wire:model="parentEmails"/>
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
                            wire:model.defer="feeAgreementFields.parent_notification_email_content"
                            rows="10" cols="50"
                        ></textarea>
                    </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-danger-button wire:click="$set('displayNotifyParentModal', false)">
                    Cancel
                </x-jet-danger-button>
                @if($this->parentEmails != '')
                    <x-jet-secondary-button class="ml-2" wire:click="sendParentNotification">
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
    @else
    <div class="col-span-8 sm:col-span-6">
            <x-card>
                <x-slot name="table">
                    <div class="bg-white grid grid-cols-1 p-5">
                        <!-- Childcare Enrollment Application -->
                            @includeWhen( $goToForm == 'childrenInfo', 'livewire.children.child-creation-steps.enrollment-application')
                        <!-- Medical Information -->
                            @includeWhen( $goToForm == 'medicalInfo', 'livewire.children.child-creation-steps.medical-information')
                        <!-- Family and Child Questionaire -->
                            @includeWhen( $goToForm == 'familyQuestionaire', 'livewire.children.child-creation-steps.family-child-questionaire')
                        <!-- Emergenct Contact -->
                            @includeWhen( $goToForm == 'emergencyContact', 'livewire.children.child-creation-steps.emergency-contact')
                        <!-- Parent Handbook -->
                            @includeWhen( $goToForm == 'permissionSlips', 'livewire.children.child-creation-steps.permission-slip')
                        <!-- Permission Slips -->
                            @includeWhen( $goToForm == 'parenthandBook', 'livewire.children.child-creation-steps.parent-handbook')
                        <!-- Immunization record -->
                            @includeWhen( $goToForm == 'immunization', 'livewire.children.child-creation-steps.immunization-record')

                    </div>
                </x-slot>
            </x-card>
        </div>
    @endif
    </x-content>
</div>
