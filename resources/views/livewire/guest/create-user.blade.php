<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if ( $userCreated )
                    <div class="col-span-8 sm:col-span-6">
                        <x-card>
                            <x-slot name="table">
                            <div class="bg-white grid grid-cols-3 p-5 text-center">
                                <div>
                                    
                                </div>
                                <div>
                                    <x-heroicon-s-badge-check class="text-green-500" />
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                            <div class="bg-white grid grid-cols-1 p-5 text-center">
                                <span class=" flex-col items-center justify-center mr-2 font-semibold text-lg text-green-500"> Successfully Created New User. Try to login using the new account. </span><a href="{{ route('login') }}">Click here to login.</a>
                            </div>
                            </x-slot>
                        </x-card> 
                    </div>
                @else
                    <div>
                        <x-link :href="route('login')">
                            <x-heroicon-o-arrow-narrow-left class="w-4 h-4 mr-2" />
                            Go Back to login page
                        </x-link>
                    </div>
                    <form wire:submit.prevent="submit">
                        <div class="px-6 py-4">
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
                                        wire:model.defer="formFields.first_name"
                                        autocomplete="false"
                                    />
                                    <x-jet-input-error for="formFields.first_name" class="mt-2" />
                                </div>
                                <div>
                                    <x-jet-label for="last_name" value="Last Name" />
                                    <x-jet-input
                                        id="last_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        wire:model.defer="formFields.last_name"
                                        autocomplete="false"
                                    />
                                    <x-jet-input-error for="formFields.last_name" class="mt-2" />
                                </div>
                                <div>
                                    <x-jet-label for="email" value="Email" />
                                    <x-jet-input
                                        id="email"
                                        type="text"
                                        class="mt-1 block w-full"
                                        wire:model.defer="formFields.email"
                                        autocomplete="false"
                                    />
                                    <x-jet-input-error for="formFields.email" class="mt-2" />
                                </div>
                                <div>
                                    <x-jet-label for="phone_number" value="Phone Number" />
                                    <x-jet-input
                                        id="phone_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        wire:model.defer="formFields.phone_number"
                                        autocomplete="phone_number"
                                    />
                                    <x-jet-input-error for="formFields.phone_number" class="mt-2" />
                                </div>
                                <div>
                                    <x-jet-label for="password" value="Password" />
                                    <x-jet-input
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        wire:model.defer="formFields.password"
                                    />
                                    <x-jet-input-error for="formFields.password" class="mt-2" />
                                </div>
                                <div>
                                    <x-forms.select
                                        id="role-selector"
                                        label="Role"
                                        :options="$formFields['roles']"
                                        placeholder="Select Role"
                                        error="formFields.roles"
                                        wire:model.defer="formFields.role"
                                    />
                                    <x-jet-input-error for="role" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <x-card-action>
                            <div>
                                <x-jet-button>
                                    Create
                                </x-jet-button>
                            </div>
                        </x-card-action>
                    </form>
                @endif
            </div>
        </div>
    </div>