<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">


                <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

                <p>Role : <b>
                        @foreach (auth()->user()->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </b> </p>

                @php
                    $roles = auth()->user()->roles->pluck('name')->toArray();
                @endphp

                @if (in_array('admin', $roles))
                    <p>Hello Admin</p>
                @elseif(in_array('user', $roles))
                    <div class="flex">
                        <div class="flex-col w-3/4">
                            <!-- Container -->
                            <div class="container mb-7">

                                <!-- Dashboard -->
                                <div class="row flex flex-row justify-self-start mr-10">
                                    <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                        <div class="card-body flex flex-row items-center">
                                            <div
                                                class="col-icon flex flex-row items-center  bg-yellow-500 h-37 px-6 py-3 rounded-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <span class="material-icons-outlined"
                                                        style="font-size:50px ;color:white;">
                                                        <i class="fas fa-shipping-fast w-57"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="numbers">
                                                    <p class="card-category ml-4">List Delivery</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                        <div class="card-body flex flex-row items-center">
                                            <div
                                                class="col-icon flex flex-row items-center  bg-yellow-500 h-37 px-8 py-3 rounded-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <span class="material-icons-outlined"
                                                        style="font-size:50px ;color:white;">
                                                        <i class="fas fa-file-alt w-57"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="numbers">
                                                    <p class="card-category ml-4">List Instock</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                        <div class="card-body flex flex-row items-center">
                                            <div
                                                class="col-icon flex flex-row items-center bg-yellow-500 h-37 px-8 py-3 rounded-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <span class="material-icons-outlined"
                                                        style="font-size:50px ;color:white;">
                                                        <i class="fas fa-shopping-bag w-57"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="numbers">
                                                    <p class="card-category ml-4">Item Detail</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end Dashboard -->
                            </div>
                            <div class="board flex justify-between">
                                <div
                                    class="card card-stats card-round bg-white w-2/4 h-70 px-2 py-2 m-2 rounded-lg flex justify-self-center">
                                    <img src="https://png.pngtree.com/png-clipart/20211026/original/pngtree-cartoon-delivery-man-png-image_876933.png"
                                        alt="" class=" w-1/2 ml-20">
                                </div>
                                <div class="card card-stats card-round bg-white w-2/4 px-2 py-2 m-2 rounded-lg mr-12">
                                    <div
                                        class="bg-white rounded-lg shadow-lg p-6 max-w-md mx-auto border-4 border-blue-500">
                                        <div class="flex justify-between items-center mb-4">
                                            <div class="flex items-center">
                                                <h2 class="text-lg font-bold mr-2">Nice process today!</h2>
                                                <svg class="w-4 h-4 text-blue-500" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                                                +45%
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="flex justify-between items-end text-gray-500 text-sm mb-2">
                                                <div class="flex-1 text-center">Week</div>
                                                <div class="flex-1 text-center">Month</div>
                                                <div class="flex-1 text-center">Year</div>
                                            </div>
                                            <div class="flex justify-between items-end">
                                                <div class="flex-1 text-center text-3xl font-bold">123,566</div>
                                                <div class="flex-1 text-center text-3xl font-bold">123,566</div>
                                                <div class="flex-1 text-center text-3xl font-bold">123,566</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-table flex justify-self-center mt-10">
                                <table class="ml-2">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                User</th>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Type</th>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                From</th>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Phone Sender</th>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Phone Reciever</th>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Branch</th>
                                            <th
                                                class="px-9 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Active</th>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Narith
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Fruit
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Kompong Cham
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm">
                                                086343092
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                079573972
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                BFC
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="text-blue-400">Edit</span>
                                                <span class="text-red-400">Red</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                Narith
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Fruit
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                Kompong Cham
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm">
                                                086343092
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                079573972
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                BFC
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="text-blue-400">Edit</span>
                                                <span class="text-red-400">Red</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Container -->
                        </div>
                        <div class="w-1/4 bg-white h-screen rounded-l-lg">
                            <div class="flex">
                                <div class="flex-grow p-4 grid grid-row-3 gap-4 mr-px">
                                    <div class="bg-white rounded-lg shadow-md p-3 px-3 flex gap-8">
                                        <div
                                            class="col-icon flex flex-row items-center bg-yellow-400 h-30 px-3 py-3 rounded-lg">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <p class="text-2xl font-bold text-white">+90</p>
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold">Exports</h2>
                                            <div class="flex mt-3 gap-2">
                                                <p class="text-green-500"> <i class='fas fa-arrow-up'></i></p>
                                                <p class="text-gray-500">10%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow-md p-3 px-3 flex gap-8">
                                        <div
                                            class="col-icon flex flex-row items-center bg-green-600 h-30 px-3 py-3 rounded-lg">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <p class="text-2xl font-bold text-white">+90</p>
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold">Activity</h2>
                                            <div class="flex mt-3 gap-2">
                                                <p class="text-green-500"> <i class='fas fa-arrow-up'></i></p>
                                                <p class="text-gray-500">10%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white rounded-lg shadow-md p-3 px-3 flex gap-8">
                                        <div
                                            class="col-icon flex flex-row items-center bg-red-700 h-30 px-3 py-3 rounded-lg">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <p class="text-2xl font-bold text-white">+90</p>
                                            </div>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold">Instock</h2>
                                            <div class="flex mt-3 gap-2">
                                                <p class="text-green-500"> <i class='fas fa-arrow-up'></i></p>
                                                <p class="text-gray-500">10%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </main>
    </div>
    </div>
</x-app-layout>
