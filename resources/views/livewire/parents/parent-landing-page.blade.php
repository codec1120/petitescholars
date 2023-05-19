<x-content>
    <span class="text-lg font-thin text-center"> Welcome <span class="text-xl font-semibold text-center">{{ $name }} </span> to Petite Scholars Online Management System !  </span>
    <div class="mt-10 text-center">
        <button type="button" 
            wire:click="registerChildren()"
            class="inline-flex items-center justify-center p-2 rounded-md text-green-400 hover:text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100 focus:text-green-500 transition duration-150 ease-in-out">
            New Child Registration  <x-heroicon-o-user-add class="w-4 h-4" /> 
        </button>
    </div>
</x-content>