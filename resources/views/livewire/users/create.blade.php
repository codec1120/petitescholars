<div>
    <x-jet-button class="ml-2" wire:click="$set('showCreateUserModal', true)" wire:loading.attr="disabled">
        <x-heroicon-o-plus-circle class="w-4 h-4" />
        <span class="ml-2 hidden sm:block"> New {{ $title }} </span>
    </x-jet-button>
    <x-jet-modal :id="'create-users'" wire:model="showCreateUserModal" >
        <form wire:submit.prevent="submit">
            <div class="px-6 py-4 overflow-y-auto max-h-[44rem] md:max-h-screen md:max-h-96">
                <div class="text-lg font-semibold">
                    New User
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-jet-label for="first_name" value="First Name" />
                        <x-jet-input
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="fields.first_name"
                            autocomplete="firs_name"
                        />
                        <x-jet-input-error for="fields.first_name" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="last_name" value="Last Name" />
                        <x-jet-input
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="fields.last_name"
                            autocomplete="last_name"
                        />
                        <x-jet-input-error for="fields.last_name" class="mt-2" />
                    </div>
                     <div>
                        <x-jet-label for="email" value="Email" />
                        <x-jet-input
                            id="email"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="fields.email"
                            autocomplete="email"
                        />
                        <x-jet-input-error for="fields.email" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="phone_number" value="Phone Number" />
                        <x-jet-input
                            id="phone_number"
                            type="text"
                            class="mt-1 block w-full"
                            wire:model.defer="fields.phone_number"
                            autocomplete="phone_number"
                        />
                        <x-jet-input-error for="fields.phone_number" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="password" value="Password" />
                        <x-jet-input
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            wire:model.defer="fields.password"
                        />
                        <x-jet-input-error for="fields.password" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="password_confirmation" value="Confirm Password" />
                        <x-jet-input
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            wire:model.defer="fields.password_confirmation"
                        />
                        <x-jet-input-error for="fields.password_confirmation" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.roles
                            model="role"
                        />
                        <x-jet-input-error for="role" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.select
                            id="learning-center"
                            label="Learning Center"
                            :options="[
                                [
                                    'label' => 'Whitehall',
                                    'value' => 'Whitehall'
                                ],
                                [
                                    'label' => 'Coplay',
                                    'value' => 'Coplay'
                                ]
                            ]"
                            placeholder="Select"
                            error="fields.learning_center"
                            wire:model.defer="fields.learning_center"
                        />
                    </div>
                </div>
            </div>
            <x-card-action>
                <div>
                    <x-jet-button>
                        Add {{ $title }}
                    </x-jet-button>
                </div>
            </x-card-action>
        </form>
    </x-jet-modal>
</div>