@if( !$removeStepText )
<div class="col-span-8 sm:col-span-6">
    <span class="flex-col items-center justify-center mr-2 bg-green-100 font-semibold text-lg text-green-500"> Step 7 </span>
</div>
@endif
<div class="col-span-8 sm:col-span-6">
    <x-card>
        <x-slot name="header">
            <x-card-title>Please upload your child's health assessment:</x-card-title>
        </x-slot>
        <x-slot name="table">

        <div>
            <x-list-data
                        :label="'Health Assessment'"
                        :value="null"
                    >
                    @if ( !$user->hasMedia(slug('Health Assessment'.'-'.$child_id, '_')) )
                        <x-slot name="message">
                            <x-jet-label :for="'agreement'" value="Missing Health Assessment." class="text-red-500" />
                        </x-slot>
                    @endif

                    <livewire:file-uploader
                        :user="$user"
                        :key="uuid()"
                        :redirect="$fileUploaderRedirectRoute"
                        :properties="[
                            'filename' => 'Health Assessment',
                            'directory' => 'healthAssessmentFile'.'-'.$child_id,
                            'tag' => slug('Health Assessment'.'-'.$child_id, '_')
                        ]"
                    />
                </x-list-data>
        </div>
    </x-slot>
    <x-slot name="actions">
            @if ( $steps == 0 )
                <button type="button" 
                    wire:click="next()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    Save & Continue  <x-heroicon-o-arrow-narrow-right class="w-4 h-4" /> 
                </button>
            @elseif ( $steps == 7 )
                <button type="button"
                    wire:click="back()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <x-heroicon-o-arrow-narrow-left class="w-4 h-4" />Back
                </button>
                <button type="button" 
                    wire:click="next()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
                    Save   <x-heroicon-o-save class="w-4 h-4" /> 
                </button>
            @elseif ( $steps == 8 )
                <button type="button"
                    wire:click="back()"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <x-heroicon-o-arrow-narrow-left class="w-4 h-4" /> Back
                </button>
                <button type="button"
                    wire:click="childrenListTab"
                    @click="scrollTo({top: 0, behavior: 'smooth'})"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <x-heroicon-s-view-list class="w-4 h-4" /> Child List
                </button>
            @else
            <button type="button"
                wire:click="back()"
                @click="scrollTo({top: 0, behavior: 'smooth'})"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <x-heroicon-o-arrow-narrow-left class="w-4 h-4" />Back
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