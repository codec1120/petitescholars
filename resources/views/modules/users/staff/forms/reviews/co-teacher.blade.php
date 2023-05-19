@foreach($co_teacher_review_sections as $section)
    <x-card>
        <x-slot name="header">
            <x-card-title> {{ $section['label'] }} </x-card-title>
        </x-slot>
        <x-slot name="body">
            <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 bg-gray-100 px-4 py-3 rounded">
                @foreach ($ratings as $rating)
                    <li class="text-gray-700 text-sm">
                        <span class="font-bold text-gray-900">
                            {{ $rating->value }}
                        </span>
                        - {{ $rating->name }}
                    </li>
                @endforeach
            </ul>
            @foreach ($section['labels'] as $key => $survey)
                <div class="mt-4">
                    <div class="flex items-start text-lg leading-tight">
                        <div class="flex items-center">
                            &#8203;
                            <select
                                class="border-b border-gray-300 bg-transparent w-12 sm:w-20" wire:model="{{ $key }}"
                            >
                                <option value=""></option>
                                @foreach ($ratings as $rating)
                                <option value="{{ $rating->value }}">
                                    {{ $rating->value }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="option4" class="ml-3 text-sm sm:text-base text-gray-700">
                            {{ $survey }}
                        </label>
                    </div>
                </div>
            @endforeach
        </x-slot>
    </x-card>
@endforeach
<x-card>
    <x-slot name="header">
        <x-card-title> Professional Development Plan </x-card-title>
    </x-slot>
    <x-slot name="body">
        <div class="grid grid-cols-1 gap-8">
            <div>
                <p class="mb-4 font-medium"> Strengths and Accomplishments </p>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-jet-label for="co_teacher_surveys.strengths_and_accomplishments.q1" value="1." />
                        <x-jet-input
                            id="co_teacher_surveys.strengths_and_accomplishments.q1"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.strengths_and_accomplishments.q1"
                            autocomplete="false"
                        />
                    </div>
                    <div>
                        <x-jet-label for="co_teacher_surveys.strengths_and_accomplishments.q2" value="2." />
                        <x-jet-input
                            id="co_teacher_surveys.strengths_and_accomplishments.q2"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.strengths_and_accomplishments.q2"
                            autocomplete="false"
                        />
                    </div>
                    <div>
                        <x-jet-label for="co_teacher_surveys.strengths_and_accomplishments.q3" value="3." />
                        <x-jet-input
                            id="co_teacher_surveys.strengths_and_accomplishments.q3"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.strengths_and_accomplishments.q3"
                            autocomplete="false"
                        />
                    </div>
                </div>
            </div>
            <div>
                <p class="mb-4 font-medium"> Development Needs </p>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-jet-label for="co_teacher_surveys.development_needs.q1" value="1." />
                        <x-jet-input
                            id="co_teacher_surveys.development_needs.q1"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.development_needs.q1"
                            autocomplete="false"
                        />
                    </div>
                    <div>
                        <x-jet-label for="co_teacher_surveys.development_needs.q2" value="2." />
                        <x-jet-input
                            id="co_teacher_surveys.development_needs.q2"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.development_needs.q2"
                            autocomplete="false"
                        />
                    </div>
                    <div>
                        <x-jet-label for="co_teacher_surveys.development_needs.q3" value="3." />
                        <x-jet-input
                            id="co_teacher_surveys.development_needs.q3"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.development_needs.q3"
                            autocomplete="false"
                        />
                    </div>
                </div>
            </div>
            <div>
                <p class="mb-4 font-medium"> Professional Development Goals </p>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-jet-label for="co_teacher_surveys.professional_development_goals.q1" value="1." />
                        <x-jet-input
                            id="co_teacher_surveys.professional_development_goals.q1"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.professional_development_goals.q1"
                            autocomplete="false"
                        />
                    </div>
                    <div>
                        <x-jet-label for="co_teacher_surveys.professional_development_goals.q2" value="2." />
                        <x-jet-input
                            id="co_teacher_surveys.professional_development_goals.q2"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.professional_development_goals.q2"
                            autocomplete="false"
                        />
                    </div>
                    <div>
                        <x-jet-label for="co_teacher_surveys.professional_development_goals.q3" value="3." />
                        <x-jet-input
                            id="co_teacher_surveys.professional_development_goals.q3"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="co_teacher_surveys.professional_development_goals.q3"
                            autocomplete="false"
                        />
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-card>
<x-card>
    <x-slot name="header">
        <x-card-title> Total </x-card-title>
    </x-slot>
    <x-slot name="body">
        <div>
            <x-jet-input
                id="co_teacher_surveys.overall_score"
                type="text"
                readonly
                class="mt-1 block w-full"
                wire:model.defer="co_teacher_surveys.overall_score"
                autocomplete="false"
            />
        </div>
    </x-slot>
</x-card>
<x-flex class="justify-start sm:justify-end">
    <x-jet-button>
        Submit & Save
    </x-jet-button>
</x-flex>
