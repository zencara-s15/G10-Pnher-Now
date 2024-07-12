<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">

                <div class="flex justify-end">
                    @can('Branch create')
                        <!-- Modal toggle -->
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            New Branch
                        </button>
                    @endcan
                </div>

                {{-- Pop up --}}
                <!-- Main modal -->
                <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                    class="hidden fixed top-0 left-0 right-0 bottom-0 flex justify-center z-50 bg-gray-800 bg-opacity-75">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-green-600 dark:text-white">
                                    Create New Branch
                                </h3>
                                <button type="button"
                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="authentication-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form class="space-y-4" method="POST" action="{{ route('admin.branch.store') }}">
                                    @csrf
                                    @method('post')
                                    <div class="flex flex-col space-y-2">
                                        <label for="name" class="text-gray-700 select-none font-medium">Branch
                                            Name</label>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Branch name"
                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                    </div>

                                    <!-- Supervisor Name -->
                                    <div class="flex flex-col space-y-2 mt-3">
                                        <label for="supervisor_name"
                                            class="text-gray-700 select-none font-medium">Supervisor
                                            Name</label>
                                        <select id="supervisor_name" name="user_id"
                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                            <option value="">Select Supervisor</option>
                                            @foreach ($supervisors as $supervisor)
                                                <option value="{{ $supervisor->id }}">{{ $supervisor->first_name }}
                                                    {{ $supervisor->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Company Name -->
                                    <div class="flex flex-col space-y-2 mt-3">
                                        <label for="company" class="text-gray-700 select-none font-medium">Company
                                            Name</label>
                                        <select id="company" name="company_id"
                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex flex-col space-y-2 mt-3 ">
                                        <label for="address"
                                            class="text-gray-700 select-none font-medium">Address</label>
                                        <input id="address" type="text" name="address" value="{{ old('address') }}"
                                            placeholder="Address"
                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                    </div>

                                    <div class="flex flex-col space-y-2 mt-4">
                                        <button type="submit"
                                            class="text-white bg-blue-500 hover:bg-blue-500 px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">ID</th>
                                <th scope="col" class="px-6 py-3 text-center">Branch name</th>
                                <th scope="col" class="px-6 py-3 text-center">Supervisor name</th>
                                <th scope="col" class="px-6 py-3 text-center">Company name</th>
                                <th scope="col" class="px-6 py-3 text-center">Address</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Branch access')
                                @foreach ($branches as $branch)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 text-center">{{ $branch->id }}</td>
                                        <td class="px-6 py-4 text-center">{{ $branch->name }}</td>
                                        <td class="px-6 py-4 text-center">
                                            {{ $branch->user->first_name }} {{ $branch->user->last_name }}
                                        </td>
                                        <td class="px-6 py-4 text-center">{{ $branch->company->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $branch->address }}</td>
                                        <td class="px-6 py-4 text-center">
                                            @can('Branch edit')
                                                {{-- <a href="{{ route('admin.branch.edit', $branch->id) }}"
                                                    class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">
                                                    Edit
                                                </a> --}}
                                                <button data-modal-target="authentication-modal-edit"
                                                    data-modal-toggle="authentication-modal-edit"
                                                    class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-blue-400">
                                                    edit
                                                </button>

                                                {{-- Pop up --}}
                                                <!-- Main modal -->
                                                <div id="authentication-modal-edit" tabindex="-1" aria-hidden="true"
                                                    class="hidden fixed top-0 left-0 right-0 bottom-0 flex justify-center z-50 bg-gray-800 bg-opacity-75">
                                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div
                                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3
                                                                    class="text-xl font-semibold text-green-600 dark:text-white">
                                                                    Edit Branch
                                                                </h3>
                                                                <button type="button"
                                                                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                    data-modal-hide="authentication-modal">
                                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5">
                                                                <form method="POST"
                                                                    action="{{ route('admin.branch.update', $branch->id) }}">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="flex flex-col space-y-2">
                                                                        <label for="name"
                                                                            class="text-gray-700 select-none font-medium flex justify-start">Branch
                                                                            Name</label>
                                                                        <input id="name" type="text" name="name"
                                                                            value="{{ old('name', $branch->name) }}"
                                                                            placeholder="Branch name"
                                                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                                                    </div>

                                                                    <!-- Supervisor Name -->
                                                                    <div class="flex flex-col space-y-2 mt-3">
                                                                        <label for="supervisor_name"
                                                                            class="text-gray-700 select-none font-medium flex justify-start">Supervisor
                                                                            Name</label>
                                                                        <select id="supervisor_name" name="user_id"
                                                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                                                            <option value="">Select Supervisor</option>
                                                                            @foreach ($supervisors as $supervisor)
                                                                                <option value="{{ $supervisor->id }}"
                                                                                    {{ $supervisor->id == $branch->user_id ? 'selected' : '' }}>
                                                                                    {{ $supervisor->first_name }}
                                                                                    {{ $supervisor->last_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <!-- Company Name -->
                                                                    <div class="flex flex-col space-y-2 mt-3">
                                                                        <label for="company"
                                                                            class="text-gray-700 select-none font-medium flex justify-start">Company
                                                                            Name</label>
                                                                        <select id="company" name="company_id"
                                                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                                                            <option value="">Select Company</option>
                                                                            @foreach ($companies as $company)
                                                                                <option value="{{ $company->id }}"
                                                                                    {{ $company->id == $branch->company_id ? 'selected' : '' }}>
                                                                                    {{ $company->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="flex flex-col space-y-2 mt-3">
                                                                        <label for="address"
                                                                            class="text-gray-700 select-none font-medium flex justify-start">Address</label>
                                                                        <input id="address" type="text" name="address"
                                                                            value="{{ old('address', $branch->address) }}"
                                                                            placeholder="Address"
                                                                            class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                                                                    </div>

                                                                    <div class="text-center mt-10 mb-10">
                                                                        <button type="submit"
                                                                            class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan

                                            @can('Branch delete')
                                                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                                    class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400"
                                                    type="button">
                                                    Delete
                                                </button>

                                                <div id="popup-modal" tabindex="-1"
                                                    class="hidden fixed top-0 left-0 right-0 bottom-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75">
                                                    <div class="bg-white rounded-lg shadow-lg p-6">
                                                        <button type="button"
                                                            class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you
                                                                want to delete this branch?</h3>
                                                            <form action="{{ route('admin.branch.destroy', $branch->id) }}"
                                                                method="POST" class="inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button data-modal-hide="popup-modal" type="submit"
                                                                    class="text-gray-100 bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md mr-2">Delete</button>
                                                            </form>
                                                            <button data-modal-hide="popup-modal" type="button"
                                                                class="text-gray-700 bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

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
                    const modal = button.closest('.fixed');
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</x-app-layout>
