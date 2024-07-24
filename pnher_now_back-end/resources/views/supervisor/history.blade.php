<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-9 py-8">
                <div class="flex">
                    <div class="flex-col w-full">
                        <div class="container-table w-full">
                            <div class="p-3">
                                <h1 class="text-2xl">History of Delivery</h1>
                            </div>
                            <table class="ml-1 w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-7 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Post ID</th>
                                        <th
                                            class="px-7 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Type</th>
                                        <th
                                            class="px-7 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            From</th>
                                        <th
                                            class="px-7 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            To</th>
                                        <th
                                            class="px-7 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Sender</th>
                                        <th
                                            class="px-7 py-3 text-left text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            Reciever</th>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($histories as $history)
                                    <tr>
                                        <td class="px-7 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{$history->post_id}}
                                        </td>
                                        <td class="px-7 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$history->type}}
                                        </td>
                                        <td class="px-7 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$history->sending_address}}
                                        </td>
                                        <td class="px-7 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$history->receiving_address}}
                                        </td>
                                        <td class="px-7 py-4 whitespace-nowrap text-sm">
                                            {{$history->receiver_phone}}
                                        </td>
                                        <td class="px-7 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{$history->receiver_phone}}
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
