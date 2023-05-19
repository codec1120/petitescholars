<x-card>
    <x-slot name="header">
        <span class="font-bold mr-2">Evaluation Key: </span> (Use N/A for specific issues that are Not Applicable to your experiences)
    </x-slot>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 bg-white">
        @foreach ($ratings as $rating)
            <x-flex class="text-gray-700 px-4 py-3">
                <x-flex class="w-8 h-8 bg-gray-200 rounded-full justify-center text-sm font-bold text-gray-700 mr-2">
                    {{ $rating->value }}
                </x-flex>
                {{ $rating->name }}
            </x-flex>
        @endforeach
    </div>
</x-card>
@foreach($director_sections as $section)
    <x-table class="block sm:hidden">
        <x-slot name="headers">
            <tr class="text-left">
                <x-th> {{ $section['label'] }} </x-th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($section['labels'] as $key => $survey)
                <x-tr>
                    <x-td class="text-sm">
                        <div>
                           <p class="mb-4"> {{ $survey }} </p>
                           <div class="grid grid-cols-1 gap-4">
                                @foreach ($ratings as $rating)
                                    <x-flex class="space-x-2">
                                        <input
                                            type="radio"
                                            class="form-radio w-4 text-green-500"
                                            value="{{ $rating->value }}"
                                            wire:model.lazy="{{ $key }}"
                                        />
                                        <x-jet-label :value="$rating->name" />
                                    </x-flex>
                                @endforeach
                           </div>
                        </div>
                    </x-td>
                </x-tr>
            @endforeach
        </x-slot>
    </x-table>
    <x-table class="hidden md:block">
        <x-slot name="headers">
            <tr class="text-left">
                <x-th> {{ $section['label'] }} </x-th>
                <x-th> 1 </x-th>
                <x-th> 2 </x-th>
                <x-th> 3 </x-th>
                <x-th> 4 </x-th>
                <x-th> 5 </x-th>
                <x-th> N/A </x-th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach ($section['labels'] as $key => $survey)
                <x-tr>
                    <x-td class="text-sm">
                        <div>
                           <p> {{ $survey }} </p>
                        </div>
                    </x-td>
                    @foreach ($ratings as $rating)
                        <x-td>
                            <input
                                type="radio"
                                class="form-radio w-4 text-green-500"
                                value="{{ $rating->value }}"
                                wire:model.lazy="{{ $key }}"
                            />
                        </x-td>
                    @endforeach
                </x-tr>
            @endforeach
        </x-slot>
    </x-table>
@endforeach
<x-table>
    <x-slot name="headers">
        <tr class="text-left">
            <x-th class="bg-gray-200"> COMMENTS </x-th>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach ($director_comments as $director_comment)
            <x-tr>
                <x-td>
                    <div>
                        <x-jet-label for="{{ $director_comment['name'] }}" :value="$director_comment['label']" class="mb-2" />
                        <textarea id="{{ $director_comment['name'] }}" wire:model.defer="{{ $director_comment['name'] }}" id="" cols="30" rows="5" class="form-input w-full"></textarea>
                    </div>
                </x-td>
            </x-tr>
        @endforeach
    </x-slot>
</x-table>
<x-flex class="justify-start sm:justify-end">
    <x-jet-button>
        Submit & Save
    </x-jet-button>
</x-flex>