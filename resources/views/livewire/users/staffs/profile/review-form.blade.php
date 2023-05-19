<div>
    <x-staff-layout :user="$user" title="Reviews" :layout="'full'">
        <div>
            <x-link :href="route('staffs.profile.reviews', $user)">
                <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                Go Back
            </x-link>
        </div>
        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-1 gap-4">
                <x-card>
                    <x-slot name="header">
                        <x-card-title> New Review </x-card-title>
                    </x-slot>
                    <x-slot name="table">
                        <div class="bg-white grid grid-cols-1">
                            <x-list-data label="Name of Employee" :value="$user->full_name"/>
                            <x-list-data label="Date Completed" :value="now()->format('m-d-Y')"/>
                            <x-list-data label="Completed By" :value="auth()->user()->full_name"/>
                            <x-list-data-input label="Yearly Review" >
                                <x-jet-input
                                    id="yearly_review"
                                    type="text"
                                    class="block w-full"
                                    wire:model.defer="commons.yearly_review"
                                    autocomplete="false"
                                />
                            </x-list-data-input>
                            <x-list-data label="Job Title" :value="$user->job_title"/>
                        </div>
                    </x-slot>
                </x-card>
                @includeWhen(
                    $type === App\Models\StaffTitle::CO_TEACHER,
                    'modules.users.staff.forms.reviews.co-teacher'
                )
                @includeWhen(
                    $type === App\Models\StaffTitle::DIRECTOR,
                    'modules.users.staff.forms.reviews.director'
                )
            </div>
        </form>
    </x-staff-layout>
    <script>
        window.onbeforeunload = function(e) {
            return;
        };
    </script>
<div>