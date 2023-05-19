<div wire:key="pagination test" class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
  <div class="flex-1 flex justify-between sm:hidden">
    <a href="#" @if ($paginator->onFirstPage()) @else wire:click.prevent="previousPage" @endif  class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
      Previous
    </a>
    <a href="#" @if ($paginator->hasMorePages()) wire:click.prevent="nextPage" @endif class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
      Next
    </a>
  </div>
  <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
    <div class="flex items-center flex-row flex-nowrap gap-x-4">
      <div>
      <p class="text-sm leading-5 text-gray-700">
          Showing
          <span class="font-medium"> {{ $paginator->firstItem() }}</span>
          to
          <span class="font-medium"> {{ $paginator->lastItem() }} </span>
          of
          <span class="font-medium"> {{ $paginator->total() }}</span>
          results
        </p>
      </div>
        <div class="pl-0 pr-2">
            <select wire:model="perPage">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="1000">1000</option>
              </select>
          <span class="font-medium"> Rows per page </span>
      </div>
    </div>
    <div>
     @if ($paginator->hasPages())
      <span class="relative z-0 inline-flex shadow-sm">
        <button type="button" @if ($paginator->onFirstPage()) @else wire:click="previousPage" @endif class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
          </svg>
        </button>
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                 <span class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button type="button" wire:click="gotoPage({{ $page }})" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-primary-500  text-sm leading-5 font-medium text-green-100 hover:bg-green-500 focus:z-10 focus:outline-none focus:border-green-300 focus:shadow-outline-blue active:bg-gray-100 active:text-white transition ease-in-out duration-150">
                            {{ $page }}
                        </button>
                    @else
                         <button type="button" wire:click="gotoPage({{ $page }})" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach
        <button type="button" @if ($paginator->hasMorePages()) wire:click="nextPage" @endif class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
          </svg>
        </button>
      </span>
      @endif
    </div>
  </div>
</div>