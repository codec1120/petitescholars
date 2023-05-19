<x-staff-layout :user="$user" title1="Reviews" title2="Reviews Documentation" threerowlayout="true" >
     <!-- First Row -->
     <x-slot name="header1" >
        @admin
            <x-jet-button wire:click="create" :disabled="$user->invalidTitle()">
                <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
                New Reviews
            </x-jet-button>
        @endadmin
    </x-slot>
    <x-slot name="table1">
        <div class="bg-white">
            @if ($user->invalidTitle())
                <x-flex class="justify-center px-4 py-3">
                    <x-placeholder class="py-6" title="Title not set yet" description="Set title by going to general section page.">
                        <x-heroicon-o-exclamation class="w-12 h-12 mb-2 text-gray-500" />
                    </x-placeholder>
                </x-flex>
            @else
                @if ($reviews->isNotEmpty())
                    <div class="grid grid-cols-1">
                        @foreach ($reviews as $review)
                            <x-flex class="justify-between border-b border-gray-200 w-full px-4 py-3">
                                <div class="grid grid-cols-1 gap-2">
                                    <p class="block font-medium text-sm text-gray-500">
                                        <span class="font-semibold text-gray-800">Date Completed</span>
                                        {{ $review->readable_date_completed }}
                                    </p>
                                    <p class="block font-medium text-sm text-gray-500">
                                        <span class="font-semibold text-gray-800">Date Uploaded</span>
                                        {{ $review->completedBy->full_name }}
                                    </p>
                                    <p class="block font-medium text-sm text-gray-500">
                                        <span class="font-semibold text-gray-800">Yearly Review</span>
                                        {{ $review->yearly_review }}
                                    </p>
                                    <p class="block font-medium text-sm text-gray-500">
                                        <span class="font-semibold text-gray-800"> Overall Score </span>
                                        {{ $review->overall_score }}
                                    </p>
                                </div>
                                <div class="grid grid-cols-1 gap-1">
                                    <x-jet-secondary-button wire:click="edit({{ $review }})">
                                        <x-heroicon-o-pencil class="w-4 h-4 mr-2 "/>
                                        Edit
                                    </x-jet-secondary-button>
                                    @livewire('users.staffs.reviews.delete', [
                                        'user' => $user,
                                        'review' => $review
                                    ])
                                </div>
                            </x-flex>
                        @endforeach
                    </div>
                @else
                    <x-flex class="justify-center px-4 py-3">
                        <x-flex class="justify-center px-4 py-3">
                            <x-placeholder class="py-6" title="No reviews yet" description="There are no reviews yet">
                                <x-heroicon-o-document-text class="w-12 h-12 mb-4 text-gray-500" />
                            </x-placeholder>
                        </x-flex>
                    </x-flex>
                @endif
            @endif
        </div>
    </x-slot>
    <x-slot name="actions1">
        <p class="text-gray-600">
            <span class="font-semibold">
                Total Reviews:
            </span>
            {{ $reviews->total() }}
        </p>
    </x-slot>

    <!-- 2nd Row -->
    <x-slot name="header2" >
             <livewire:file-uploader
                :user="$user"
                :key="uuid()"
                :redirect="'/staffs/' . $this->user->id . '/reviews'"
                :properties="[
                    'filename' => 'Review Documents',
                    'directory' => 'review',
                    'tag' => slug('review_documents', '_')
                ]"
            />
    </x-slot>
    <x-slot name="table2">
        <div class="bg-white">
            @if ($reviewsDocs)
                <div class="grid grid-cols-1">
                    @foreach ($reviewsDocs as $docs)
                        <x-flex class="justify-between border-b border-gray-200 w-full px-4 py-3">
                            <div class="grid grid-cols-1 gap-2">
                                <p class="block font-medium text-sm text-gray-500"> 
                                    <span class="font-semibold text-gray-800">File Name: </span>
                                    {{ $docs->filename }}
                                </p>
                                <p class="block font-medium text-sm text-gray-500">
                                    <span class="font-semibold text-gray-800">Date Uploaded: </span>
                                    {{  carbon( $docs->created_at )->format('Y-m-d') }}
                                </p>
                            </div>
                        </x-flex>
                    @endforeach
                </div>
            @else
                <x-flex class="justify-center px-4 py-3">
                    <x-flex class="justify-center px-4 py-3">
                        <x-placeholder class="py-6" title="No reviews documentation yet" description="No files found">
                            <x-heroicon-o-document-text class="w-12 h-12 mb-4 text-gray-500" />
                        </x-placeholder>
                    </x-flex>
                </x-flex>
            @endif
        </div>
    </x-slot>
</x-staff-layout>