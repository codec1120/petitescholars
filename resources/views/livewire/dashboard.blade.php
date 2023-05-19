<div>
    <x-content>
    <main class="container mx-w-6xl mx-auto py-4">
        <!-- Staff Info -->
        <div class="flex flex-col space-y-8">
            <!-- Start Second Row -->
            <div class="col-span-1 md:col-span-2 lg:col-span-4 flex justify-between">
                <h2 class="text-xs md:text-sm text-gray-700 font-bold tracking-wide md:tracking-wider">
                    Staff Info</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 px-4 xl:p-0 gap-4 xl:gap-6">
                <div class="bg-white p-6 rounded-xl border border-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-600 tracking-wide">Total number of Staff﻿</p>
                            <h3 class="mt-1 text-lg text-blue-500 font-bold"><x-link :href="route('users.index')">{{$totalStaff}}</x-link></h3>
                        </div>
                        <div class="bg-blue-500 p-2 md:p-1 xl:p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-600 tracking-wide">Total number of Staff with missing documentation</p>
                            <h3 class="mt-1 text-lg text-green-500 font-bold"><x-link :href="route('users.index')">{{$totalStaffWithMissingDocuementation}}</x-link></h3>
                        </div>
                        <div class="bg-green-500 p-2 md:p-1 xl:p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-600 tracking-wide">Total number of Staff with complete documentation</p>
                            <h3 class="mt-1 text-lg text-yellow-500 font-bold"><x-link :href="route('users.index')">{{$totalStaffWithCompleteDocumentation}}</x-link></h3>
                        </div>
                        <div class="bg-yellow-500 p-2 md:p-1 xl:p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-50 flex justify-center">
               <div class="w-1/2">
                    <canvas id="staffChart"></canvas>
               </div>
            </div>
            <!-- End Second Row -->
        </div>
         <!-- Children Info -->
         <div class="flex flex-col space-y-8">
            <!-- Start Second Row -->
            <div class="col-span-1 md:col-span-2 lg:col-span-4 flex justify-between">
                <h2 class="text-xs md:text-sm text-gray-700 font-bold tracking-wide md:tracking-wider">
                    Children Info</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 px-4 xl:p-0 gap-4 xl:gap-6">
                <div class="bg-white p-6 rounded-xl border border-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-600 tracking-wide">Total number of Children</p>
                            <h3 class="mt-1 text-lg text-blue-500 font-bold"><x-link :href="route('users.index')">{{$totalChildren}}</x-link></h3>
                        </div>
                        <div class="bg-blue-500 p-2 md:p-1 xl:p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-600 tracking-wide">Total number of Children with missing documentation</p>
                            <h3 class="mt-1 text-lg text-green-500 font-bold"><x-link :href="route('users.index')">{{$totalChildrenWithMissingDocuementation}}</x-link></h3>
                        </div>
                        <div class="bg-green-500 p-2 md:p-1 xl:p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl border border-gray-50">
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-600 tracking-wide">Total number of Children with complete documentation</p>
                            <h3 class="mt-1 text-lg text-yellow-500 font-bold"><x-link :href="route('users.index')">{{$totalChildrenWithCompleteDocumentation}}</x-link></h3>
                        </div>
                        <div class="bg-yellow-500 p-2 md:p-1 xl:p-2 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-50 flex justify-center">
               <div class="w-1/2">
                    <canvas id="childrenChart"></canvas>
               </div>
            </div>
            <!-- End Second Row -->
        </div>
    </main>
    </x-content>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
    <script>
        const staffCTX = document.getElementById('staffChart').getContext('2d');

        const staffData = {
            labels: [
                'Food & beverages',
                'Groceries',
                'Gaming',
                'Trip & holiday',
            ],
            datasets: [{
                label: 'Total Expenses',
                data: [148, 150, 130, 170],
                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#6366F1',
                    '#F59E0B'
                ]
            }]
        };

        const staffConfig = {
            type: 'polarArea',
            data: staffData,
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        };

        new Chart(staffCTX, staffConfig);

        const childrenCTX = document.getElementById('childrenChart').getContext('2d');

        const childrenData = {
            labels: [
                'Food & beverages',
                'Groceries',
                'Gaming',
                'Trip & holiday',
            ],
            datasets: [{
                label: 'Total Expenses',
                data: [148, 150, 130, 170],
                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#6366F1',
                    '#F59E0B'
                ]
            }]
        };

        const childnreConfig = {
            type: 'polarArea',
            data: childrenData,
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        };

        new Chart(childrenCTX, childnreConfig);
    </script>
