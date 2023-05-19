@if ( $user->role === 'parent' )
    <x-dropdown.item href="{{ route('users.show', $user) }}">
        Account
    </x-dropdown.item>
    <x-dropdown.item href="{{ route('children', ['user'=> Auth()->user()->id]) }}">
        Children
    </x-dropdown.item>
    <x-dropdown.item wire:click="loginAs({{ $user->id }})">
        Login
    </x-dropdown.item>
@else
    <x-dropdown.item href="{{ route('staffs.profile.general', $user) }}">
        Profile
    </x-dropdown.item>
    <x-dropdown.item href="{{ route('users.show', $user) }}">
        Account
    </x-dropdown.item>
    <x-dropdown.item wire:click="loginAs({{ $user->id }})">
        Login
    </x-dropdown.item>
@endif
