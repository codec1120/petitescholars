<div>
<x-header title="File Manager" />
    <x-content>
        <x-card class="sm:rounded-3xl">
            <x-slot name="table">
                <div class="px-8 py-8">
                    <div class="grid grid-cols-2 w-full">
                        <div class="flex justify-start font-bold">Staff Profile</div>
                    </div>
                    <div>
                        <x-table>
                            <x-slot name="head">
                                    <x-table.heading class="bg-[#b5d7a8] font-black text-left"> Document Type </x-table.heading>
                                    <x-table.heading class="bg-[#b5d7a8] font-black text-center"> Number of Files </x-table.heading>
                                    <x-table.heading class="bg-[#b5d7a8] font-black"> Settings</x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @forelse($staffFiles as $row)
                                        <x-table.row
                                            wire:loading.class.delay="opacity-50"
                                            wire:key="row-{{ $row['id'] }}"
                                        >
                                        <x-table.cell>
                                            {{ $row['doc_type'] }}
                                        </x-table.cell>
                                        <x-table.cell class="text-center">
                                                {{ $row['count_files']  }}
                                        </x-table.cell>
                                        <x-table.cell class="text-center">
                                            <x-link :href="route('file-manager.settings', ['documents' => $row['id']])">
                                                <x-heroicon-s-cog class="w-4 h-4" />
                                            </x-link>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                <x-table.row>
                                    <x-table.cell colspan="5">
                                        <x-placeholder
                                            title="No records found."
                                            description="There are no user accounts."
                                        >
                                            @svg('heroicon-o-users', 'w-8 h-8 text-gray-500 mb-4')
                                        </x-placeholder>
                                    </x-table.cell>
                                </x-table.row>
                                @endforelse 
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </x-slot>
        </x-card>
        <x-card class="sm:rounded-3xl mt-4">
            <x-slot name="table">
                <div class="px-8 py-8">
                    <div class="grid grid-cols-2 w-full">
                        <div class="flex justify-start font-bold">Child Profile</div>
                    </div>
                    <div>
                        <x-table>
                            <x-slot name="head">
                                    <x-table.heading class="bg-[#b5d7a8] font-black text-left"> Document Type </x-table.heading>
                                    <x-table.heading class="bg-[#b5d7a8] font-black text-center"> Number of Files </x-table.heading>
                                    <x-table.heading class="bg-[#b5d7a8] font-black text-left"> Settings</x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @forelse($childFiles as $row)
                                        <x-table.row
                                            wire:loading.class.delay="opacity-50"
                                            wire:key="row-{{ $row['id'] }}"
                                        >
                                        <x-table.cell>
                                            {{ $row['doc_type'] }}
                                        </x-table.cell>
                                        <x-table.cell class="text-center">
                                                {{ $row['count_files']  }}
                                        </x-table.cell>
                                        <x-table.cell class="text-center">
                                            <x-link :href="route('file-manager.settings', ['documents' => $row['id']])">
                                                <x-heroicon-s-cog class="w-4 h-4" />
                                            </x-link>
                                        </x-table.cell>
                                    </x-table.row>
                                @empty
                                <x-table.row>
                                    <x-table.cell colspan="5">
                                        <x-placeholder
                                            title="No records found."
                                            description="There are no user accounts."
                                        >
                                            @svg('heroicon-o-users', 'w-8 h-8 text-gray-500 mb-4')
                                        </x-placeholder>
                                    </x-table.cell>
                                </x-table.row>
                                @endforelse 
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-content>
</div>
