<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="pt-3 text-2xl">
                    <h1 class="text-1xl font-bold">Driver Information</h1>
                </div>
                <div class="text-right">
                    @can('Deliverer create')
                        <a href="{{ route('admin.deliverer.create') }}"
                            class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">
                            New Driver
                        </a>
                    @endcan
                </div>

                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">Branch Name</th>
                                <th scope="col" class="px-6 py-3 text-center">First Name</th>
                                <th scope="col" class="px-6 py-3 text-center">Last name</th>
                                <th scope="col" class="px-6 py-3 text-center">Email</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Deliverer access')
                                @foreach ($deliverers as $deliverer)
                                    @if ($deliverer->branch && $deliverer->branch->name)
                                        @foreach ($branches as $branch)
                                            @if ($deliverer->branch->name == $branch->name)
                                                @php
                                                    $modalId = 'popup-modal-' . $deliverer->id;
                                                @endphp
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4 text-center">{{ $deliverer->branch->name }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $deliverer->user->first_name }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $deliverer->user->last_name }}</td>
                                                    <td class="px-6 py-4 text-center">{{ $deliverer->user->email }}</td>
                                                    <td class="px-6 py-4 text-center">
                                                        @can('Deliverer delete')
                                                            <button data-modal-target="{{ $modalId }}"
                                                                data-modal-toggle="{{ $modalId }}"
                                                                class="bg-red-500 text-white font-bold px-4 py-1 rounded focus:outline-none shadow transition-colors"
                                                                type="button">Delete</button>

                                                            <div id="{{ $modalId }}" tabindex="-1"
                                                                class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                        <button type="button"
                                                                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                            data-modal-hide="{{ $modalId }}">
                                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                        <div class="p-4 md:p-5 text-center">
                                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 20 20">
                                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                            </svg>
                                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                                Are you sure you want to delete this deliverer?
                                                                            </h3>
                                                                            <form action="{{ route('admin.deliverer.destroy', $deliverer->id) }}"
                                                                                method="POST" class="inline">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button data-modal-hide="{{ $modalId }}"
                                                                                    type="submit"
                                                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Yes, I'm sure</button>
                                                                            </form>
                                                                            <button data-modal-hide="{{ $modalId }}" type="button"
                                                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalToggleButtons = document.querySelectorAll('[data-modal-toggle]');
        const modalHideButtons = document.querySelectorAll('[data-modal-hide]');

        modalToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = button.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                }
            });
        });

        modalHideButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modalId = button.getAttribute('data-modal-hide');
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    });
</script>
