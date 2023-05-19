<!-- This is an example component -->
<div class="w-full h-screen">
  <header class="bg-white">
    <nav class="flex justify-between w-full bg-white text-white p-4">
        <div class="w-full flex justify-between md:items-center md:w-auto">
           <!-- Logo -->
           <div class="flex-shrink-0 flex items-center">
                <a href="/dashboard">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>
             <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <span class="relative inline-block">
                    <svg class="h-[30px] w-[30px] mt-1 text-gray-500 fill-current" viewBox="0 0 20 20">
                    <path d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 mt-1 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                </span>
            </div>
                <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="" />
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
        </div>
    </nav>
  </header>
  <main class="w-full md:flex md:justify-center md:items-center">
        @if ( Request::is('staffs/*') )
            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                
                <button @click="open = !open" class="md:hidden items-center w-full pt-2 mt-2 text-xl font-semibold text-center bg-gray-300 rounded-lg dark-mode:focus:text-white dark-mode:hover:text-white md:block hover:text-gray-900 focus:text-gray-900 focus:outline-none focus:shadow-outline">
                
                    @foreach (App\Models\StaffProfileMenu::get() as $item)
                        @if( Request::is('staffs/*/'.$item->slug) )
                        <span class="text-[#ED5314]">{!! $item->label !!}</span>
                        @endif
                    @endforeach
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg text-sm">
                    <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800"> 
                    @foreach (App\Models\StaffProfileMenu::get() as $item)
                            <div class="mt-8 p-2 flex">
                                <a class=class="block pr-5 py-2 mt-2 text-sm font-semibold @if( $item->active ) text-[#ED5314] @else text-gray-900 @endif rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" 
                                    href="{{ route($item->link, App\Models\User::find( Request::segment(2) )  )  }}">{{ $item->label }}</a>
                            </div> 
                        @endforeach
                </div>
            </div>
        @endif
    {{ $slot }}
  </main>
  <div class="bottomNav fixed bottom-0 w-full">
    <nav class="md:hidden bottom-0 w-full bg-white text-xs">
      <ul class="flex justify-around items-center text-white text-center opacity-75 text-lg font-bold">
        @foreach (
            App\Models\MenuItem::where('visible', true)->get()
            as $menuItem
        ) 
            @if ( $menuItem->with_sub_menu )
            <li class="p-1 hover:bg-gray-500 text-gray-500">
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                    <span>{!! $menuItem->icon !!}</span>
                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg bottom-0 text-sm">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800"> 
                        @foreach (
                            App\Models\MenuSubItem::where( 'parent_menu_id', $menuItem->parent_id )->get()
                            as $subMenuItem
                        )
                            <a class="block pr-5 py-2 mt-2 text-sm font-semibold @if( $subMenuItem->active ) text-[#ED5314] @else text-gray-900 @endif rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" 
                                href="{{ $subMenuItem->link }}">
                                
                                {{ $subMenuItem->label }}
                            </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </li>
            @else
            <li class="p-1 hover:bg-gray-500">
                <a class="block px-4 py-2 mt-2 text-sm font-semibold @if( $menuItem->active ) text-[#ED5314] @else text-gray-900 @endif rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" 
                    href="{{ $menuItem->link }}">
                    {!! $menuItem->icon !!}
                </a>
            </li>
            @endif
        @endforeach
      </ul>
    </nav>
  </div>
</div>