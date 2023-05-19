<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between">
            <div class="flex justify-start text-center w-1/4">
                <div class="flex-shrink-0 py-4 flex flex-row items-center justify-center">
                    <a href="/users">
                        <x-jet-application-mark class="block h-[60px] w-auto" />
                    </a>
                    <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex justify-center w-full">
                <div class="flex justify-between text-center">
                @if ( Request::is('staffs/*') )
                    @foreach (App\Models\StaffProfileMenu::get() as $item)
                        <div class="mt-10 pl-3 pr-3 flex">
                            <a class="text-base sm:text-sm items-center text-base hover:opacity-50 hover:shadow-none rounded-lg {{ Request::is('staffs/*/'.$item->slug) ? 'text-[#ED5314] bg-white shadow-sm' : '' }}" 
                                href="{{ route($item->link, App\Models\User::find( Request::segment(2) )  )  }}">{{ $item->label }}</a>
                        </div> 
                    @endforeach
                @endif

                <!-- @if ( Request::is('children/*/child-edit/*') )
                    @foreach (App\Models\ChildMenu::get() as $item)
                        <div class="mt-10 pl-3 pr-3 flex">
                            <a class="text-base sm:text-sm items-center text-base hover:opacity-50 hover:shadow-none rounded-lg {{ Request::is('children/*/child-edit/'.$item->slug) ? 'text-[#ED5314] bg-white shadow-sm' : '' }}" 
                                href="{{ route($item->link, ['child_id' => Request::segment(2) ]  )  }}">{{ $item->label }}</a>
                        </div> 
                    @endforeach
                @endif -->
                
                </div>
            </div>

            <div class="flex justify-end h-16 text-center w-1/4">
                
                <div class="flex">
                    <span class="relative inline-block">
                        <svg class="h-[30px] w-[30px] mt-6 fill-current" viewBox="0 0 20 20">
                        <path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                        <span class="absolute top-0 right-0 inline-block w-2 h-2 mt-6 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                    </span>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden mt-5 md:flex  md:items-center ml-2">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-[40px] w-[40px] rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" />
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Account
                            </div>
                        
                            <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                                {{ __('My Account') }}
                            </x-jet-responsive-nav-link>

                            @if ( Session::get('add_back_to_user_page') ) 
                                <x-jet-dropdown-link href="/users/?backToUser=true">
                                    Go Back to User Accounts
                                </x-jet-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="/user/api-tokens">
                                    API Tokens
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Management -->
                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <x-jet-dropdown-link href="/teams/{{ Auth::user()->currentTeam->id }}">
                                    Team Settings
                                </x-jet-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jet-dropdown-link href="/teams/create">
                                        Create New Team
                                    </x-jet-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jet-switchable-team :team="$team" />
                                @endforeach

                                <div class="border-t border-gray-100"></div>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                    Logout
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach (
                App\Models\MenuItem::where('visible', true)->get()
                as $menuItem
            )
                @if ( $menuItem->with_sub_menu )
                    <x-jet-responsive-nav-link :href="$menuItem->link" :active="$menuItem->active">
                        {{ $menuItem->label }}
                    </x-jet-responsive-nav-link>
                    @foreach (
                        App\Models\MenuSubItem::where( 'parent_menu_id', $menuItem->parent_id )->get()
                        as $subMenuItem
                    )
                        <x-jet-dropdown-link href="{{ $subMenuItem->link }}">
                            {{ $subMenuItem->label }}
                        </x-jet-dropdown-link>
                    @endforeach
                @else
                    <x-jet-responsive-nav-link :href="$menuItem->link" :active="$menuItem->active">
                        {{ $menuItem->label }}
                    </x-jet-responsive-nav-link>
                @endif

            @endforeach
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" />
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="/user/profile" :active="request()->routeIs('profile.show')">
                    {{ __('My Account') }}
                </x-jet-responsive-nav-link>
                
                @if ( Session::get('add_back_to_user_page') ) 
                    <x-jet-dropdown-link href="/users/?backToUser=true">
                        Go Back to User Accounts
                    </x-jet-dropdown-link>
                @endif
                
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="/user/api-tokens" :active="request()->routeIs('api-tokens.index')">
                        API Tokens
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        Logout
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Team
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="/teams/{{ Auth::user()->currentTeam->id }}" :active="request()->routeIs('teams.show')">
                        Team Settings
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="/teams/create" :active="request()->routeIs('teams.create')">
                        Create New Team
                    </x-jet-responsive-nav-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Switch Teams
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>