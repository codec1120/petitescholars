<div>
<x-header title="Parent Notifications" />
    <x-content>
        <x-card class="sm:rounded-3xl">
        <form wire:submit.prevent="submit">
            <x-slot name="table">
                <div class="px-8 py-8">
                    <div class="bg-white grid grid-cols-1 mt-5">
                        <div class="bg-white grid grid-cols-2">
                            <x-list-data-input label="First Parent Reminder" >
                                <x-forms.select
                                    label=""
                                    id="firstParenReminder"
                                    :options="$reminderOpt"
                                    placeholder="Select Option..."
                                    wire:model="firstParenReminder"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                    <div class="bg-white grid grid-cols-1 mt-5">
                        <div class="bg-white grid grid-cols-2">
                            <x-list-data-input label="Second Parent Reminder" >
                                <x-forms.select
                                    label=""
                                    id="secondParenReminder"
                                    :options="$reminderOpt"
                                    placeholder="Select Option..."
                                    wire:model="secondParenReminder"
                                />
                            </x-list-data-input>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 w-full p-6">
                        <label class="flex items-center">
                        Email Message
                        </label>
                        <textarea
                            placeholder=""
                            name="emailMessage"
                            class="rounded-md shadow-sm block w-full outline-none"
                            id="emailMessage"
                            wire:model.defer="emailMessage"
                            rows="10" cols="50"
                        ></textarea>
                    </div>
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-button wire:click="submit">
                    Submit
                </x-jet-button>
            </x-slot>
            </form>
        </x-card>
    </x-content>
</div>
