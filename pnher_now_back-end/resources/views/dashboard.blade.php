<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-8">

                @php
                    $roles = auth()->user()->roles->pluck('name')->toArray();
                @endphp

                @if (in_array('admin', $roles))
                    <div class="container">

                        <!-- Dashboard -->
                        <div class="row flex flex-row m-5 justify-between">
                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <div
                                        class="col-icon flex flex-row items-center bg-blue-600 h-37 px-4 py-3 rounded-lg">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <span class="material-icons-outlined" style="font-size:48px;color:white;">
                                                group
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                        <div class="numbers">
                                            <p class="card-category">New Register</p>
                                            <h4 class="card-title">1,294</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <div
                                        class="col-icon flex flex-row items-center bg-blue-400 h-37 px-4 py-3 rounded-lg">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <span class="material-icons-outlined" style="font-size:48px;color:white;">
                                                store
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                        <div class="numbers">
                                            <p class="card-category">Companies</p>
                                            <h4 class="card-title">1,294</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <div
                                        class="col-icon flex flex-row items-center bg-red-500 h-37 px-4 py-3 rounded-lg">
                                        <div class="icon-big text-center bubble-shadow-small">
                                            <span class="material-icons-outlined" style="font-size:48px;color:white;">
                                                production_quantity_limits
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0 mx-2">
                                        <div class="numbers">
                                            <p class="card-category">All Product</p>
                                            <h4 class="card-title">1,294</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <div
                                        class="col-icon flex flex-row items-center bg-yellow-400 h-37 px-4 py-3 rounded-lg">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <span class="material-icons-outlined" style="font-size:48px;color:white;">
                                                check_circle
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0  mx-2">
                                        <div class="numbers">
                                            <p class="card-category">Order</p>
                                            <h4 class="card-title">1,294</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end Dashboard -->
                    </div>
                    <!-- end Container -->
            </div>
            <!-- Chart -->
            <div class="cartInfo flex flex-row justify-between">
                <div class="card w-6/12 mx-1 p-2 bg-white rounded-lg">
                    <div class="card-header flex justify-center">
                        <h1 class="">Information of system</h1>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="card w-6/12 bg-white rounded-lg">
                    <div class="card-header flex justify-center">
                        <h1 class="">Total of each months</h1>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- chart graph script  --}}
            <script>
                var ctx = document.getElementById('barChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['New register', 'All companies', 'All products', 'Order'],
                        datasets: [{
                            data: [12, 19, 3, 5],
                            backgroundColor: [
                                '#2563EB',
                                '#2563EB',
                                '#EF4444',
                                '#FBBF24',
                            ],
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                // Line charts
                var ctx = document.getElementById('lineChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [{
                                label: 'New Register',
                                data: [12, 19, 3, 5, 2, 3, 10],
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                fill: false,
                                borderWidth: 1
                            },
                            {
                                label: 'Company',
                                data: [5, 2, 10, 3, 8, 15, 7, 1, 12, 9, 10, 20],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                fill: false,
                                borderWidth: 1
                            },
                            {
                                label: 'All Product',
                                data: [10, 15, 12, 20, 15, 10, 12, 18, 25, 12, 19, 30],
                                backgroundColor: 'rgba(0, 255, 0, 0.2)',
                                borderColor: 'rgba(0, 255, 0, 1)',
                                fill: false,
                                borderWidth: 1
                            },
                            {
                                label: 'Order',
                                data: [12, 19, 3, 5, 2, 3, 10, 18, 25, 12, 19, 30],
                                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                borderColor: 'rgba(255, 159, 64, 1)',
                                fill: false,
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        }
                    }
                })
            </script>
        @elseif(in_array('supervisor', $roles))
            <div class="flex">
                <div class="flex-col w-3/4">
                    <!-- Container -->
                    <div class="container mb-7">

                        <!-- Dashboard -->
                        <div class="row flex flex-row justify-self-start mr-10">

                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <a href="{{ route('supervisor.delivery_list') }}"
                                        class="col-icon flex flex-row items-center">
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
                                    </a>
                                </div>
                            </div>

                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <a href="{{ route('supervisor.list_instock') }}"
                                        class="col-icon flex flex-row items-center">
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
                                    </a>
                                </div>
                            </div>
                            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
                                <div class="card-body flex flex-row items-center">
                                    <a href="{{ route('supervisor.item_detail') }}"
                                        class="col-icon flex flex-row items-center">
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
                                    </a>
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
                            {{-- chart graph --}}

                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                            </div>

                        </div>

                    </div>
                    <div class="container-table mt-6 w-full">
                        <div class="p-3">
                            <h1 class="text-2xl">New Information</h1>
                        </div>
                        <table class="ml-2">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User</th>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type</th>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        From</th>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone Sender</th>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Phone Reciever</th>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Branch</th>
                                    <th
                                        class="px-7 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Active</th>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Narith
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Fruit
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Kompong Cham
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        086343092
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        079573972
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        BFC
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="text-blue-400">Edit</span>
                                        <span class="text-red-400">Red</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Narith
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Fruit
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Kompong Cham
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        086343092
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        079573972
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        BFC
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                <div class="col-icon flex flex-row items-center bg-red-700 h-30 px-3 py-3 rounded-lg">
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
            <script>
                //Supervisor
                var ctx = document.getElementById('barChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Monday', 'Tuesday', 'Wendesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                        datasets: [{
                            label: 'Sales',
                            data: [12, 19, 14, 9, 10, 13, 10],
                            backgroundColor: [
                                'rgba(255, 99, 132, 10)',
                                'rgba(54, 162, 235, 10)',
                                'rgba(255, 206, 86, 10)',
                                'rgba(75, 192, 192, 10)',
                                'rgba(153, 102, 255, 10)',
                                'rgba(255, 159, 64, 10)',
                                'rgba(255, 159, 109, 10)',
                            ]
                        }]
                    }
                });
            </script>
            @endif
        </main>
    </div>
</x-app-layout>
