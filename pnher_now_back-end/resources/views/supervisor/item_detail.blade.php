<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">
                <div class="flex">
                    <div class="flex-col w-full">
                        <!-- Container -->
                        <div class="container mb-7 w-full">

                            <!-- Dashboard -->
                            <div class="row flex flex-row justify-between">
                                <div class="card card-stats card-round bg-white w-1/4 h-28 rounded-lg m-2">
                                    <div class="card-body flex flex-row">
                                        <a href="{{ route('admin.supervisor.list_delivery') }}"
                                            class="col-icon flex flex-row items-center">
                                            <div
                                                class="col-icon flex flex-row items-center justify-center bg-yellow-500 w-32 h-28 rounded-tl-lg rounded-bl-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <span class="material-icons-outlined"
                                                        style="font-size:50px ;color:white;">
                                                        <i class="fas fa-shipping-fast w-57"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="h-14 flex items-center justify-center w-36">
                                                    <h1>Delivery</h1>
                                                </div>
                                                <hr class="custom-hr">
                                                <div class="numbers h-14 flex items-center justify-center w-36">
                                                    <p class="card-category ml-4">10</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="card card-stats card-round bg-white w-1/4 h-28 rounded-lg m-2">
                                    <div class="card-body flex flex-row items-center">
                                        <a href="{{ route('admin.supervisor.list_instock') }}"
                                            class="col-icon flex flex-row items-center">
                                            <div
                                                class="col-icon flex flex-row items-center justify-center bg-yellow-500 w-32 h-28 rounded-tl-lg rounded-bl-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <svg class="h-16 w-16 text-white" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <line x1="16.5" y1="9.4" x2="7.5"
                                                            y2="4.21" />
                                                        <path
                                                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                                        <line x1="12" y1="22.08" x2="12"
                                                            y2="12" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="h-14 flex items-center justify-center w-36">
                                                    <h1>In Stock</h1>
                                                </div>
                                                <hr class="custom-hr">
                                                <div class="numbers h-14 flex items-center justify-center w-36">
                                                    <p class="card-category ml-4">10</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card card-stats card-round bg-white w-1/4 h-28 rounded-lg m-2">
                                    <div class="card-body flex flex-row items-center">
                                        <a href="{{ route('admin.supervisor.item_detail') }}"
                                            class="col-icon flex flex-row items-center">
                                            <div
                                                class="col-icon flex flex-row items-center justify-center bg-yellow-500 w-32 h-28 rounded-tl-lg rounded-bl-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <span class="material-icons-outlined"
                                                        style="font-size:50px ;color:white;">
                                                        <i class="fas fa-shopping-bag w-57"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="h-14 flex items-center justify-center w-36">
                                                    <h1>Item Detail</h1>
                                                </div>
                                                <hr class="custom-hr">
                                                <div class="numbers h-14 flex items-center justify-center w-36">
                                                    <p class="card-category ml-4">10</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="card card-stats card-round bg-white w-1/4 h-28 rounded-lg m-2">
                                    <div class="card-body flex flex-row">
                                        <a href="#" class="col-icon flex flex-row justify-center">
                                            <div
                                                class="col-icon flex flex-row items-center justify-center bg-yellow-500 w-32 h-28 rounded-tl-lg rounded-bl-lg">
                                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                    <svg class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                                <div class="h-14 flex items-center justify-center w-36">
                                                    <h1>Deliverer</h1>
                                                </div>
                                                <hr class="custom-hr">
                                                <div class="numbers h-14 flex items-center justify-center w-36">
                                                    <p class="card-category ml-4">10</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end Dashboard -->
                        </div>
                        <div class="container-table mt-5">
                            <div class="p-3">
                                <h1 class="text-2xl">Item Details</h1>
                            </div>
                            <table class="mr-5 table-fixed w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            User</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Type</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            From</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            To</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Sender</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Receiver</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Branch</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Date</th>
                                        <th
                                            class="px-5 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Expired</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($baggageInStockes as $baggageInStock)
                                        <tr>
                                            <td class="px-5 py-4 whitespace-wrap text-sm"
                                                style="word-wrap: break-word;">
                                                {{ $baggageInStock->post_id }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->type }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->sending_address }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->receiving_address }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->receiver_phone }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->receiver_phone }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->company }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->created_at }}
                                            </td>
                                            <td class="px-5 py-4 whitespace-wrap text-sm">
                                                {{ $baggageInStock->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Container -->
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
</x-app-layout>

<style>
    td {
        word-wrap: break-word;
    }
    .custom-hr {
        height: 2px;
        background-color: #60A5FA;
        border: none;
    }
</style>
