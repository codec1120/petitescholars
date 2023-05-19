@if( !$removeStepText )
<div class="col-span-8 sm:col-span-6">
    <span class="flex-col items-center justify-center mr-2 bg-green-100 font-semibold text-lg text-green-500"> Step 9 </span>
</div>
@endif
<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title> Fee Agreement </x-card-title>
        </x-slot>
        <x-slot name="table">
            @if(!$requestFeeAgreement)
            <div class="bg-white grid grid-cols-1 p-5">
                <p>
                Your child registration is almost complete. The final step is to request a Fee Agreement from Petite Scholars Learning Center. 
                Are you ready to submit your information to Petite Scholars and request a fee agreement for <span class="font-bold">{{$childrenFields['first_name'].' '.$childrenFields['last_name']}}? </span>
                </p>
            </div>
            <div class="w-full text-right p-5">
                <button type="button" 
                    wire:click="requestFeeAgreement"
                    class="p-5 inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    Request Fee Agreement
                </button>
            </div>
            @else
            <div class="bg-white grid grid-cols-1 p-5">
                <p>
                Your request to receive a Fee Agreement for <span class="font-bold">{{$childrenFields['first_name'].' '.$childrenFields['last_name']}} </span> has been submitted. Please check your mailbox.
                </p>
            </div>
            <div class="bg-white grid grid-cols-1 px-5">
                <p class="pb-10">
                Once you receive your Fee Agreement, please sign the Fee Agreement and upload the file below.
                </p>
                <x-list-data
                        :label="'Fee Agreement'"
                        :value="null"
                    >
                    @if ( !$user->hasMedia(slug('Fee Agreement'.'-'.$child_id, '_')) )
                        <x-slot name="message">
                            <x-jet-label :for="'agreement'" value="Missing Fee Agreement." class="text-red-500" />
                        </x-slot>
                    @endif

                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="$fileUploaderRedirectRoute"
                        :properties="[
                            'filename' => 'Fee Agreement',
                            'directory' => 'feeagreement'.'-'.$child_id,
                            'tag' => slug('Fee Agreement'.'-'.$child_id, '_')
                        ]"
                    />
                </x-list-data>
            </div>
            @endif

        </x-slot>
        <x-slot name="actions">
            @if ( $steps == 0 )
                <button type="button" 
                    wire:click="next()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    Save & Continue   <x-heroicon-o-arrow-narrow-right class="w-4 h-4" /> 
                </button>
            @elseif ( $steps == 8 )
                <button type="button"
                    wire:click="back()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <x-heroicon-o-arrow-narrow-left class="w-4 h-4" /> Back
                </button>
                <button type="button" 
                    wire:click="next()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    Save   <x-heroicon-o-save class="w-4 h-4" /> 
                </button>
            @else
            <button type="button"
                wire:click="back()"
                @click="scrollTo({top: 0, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <x-heroicon-o-arrow-narrow-left class="w-4 h-4" /> Back
            </button>
            <button type="button" 
                wire:click="next()"
                @click="scrollTo({top: 0, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                Save & Continue  <x-heroicon-o-arrow-narrow-right class="w-4 h-4" /> 
            </button>
            @endif

        </x-slot>
    </x-card> 
</div>