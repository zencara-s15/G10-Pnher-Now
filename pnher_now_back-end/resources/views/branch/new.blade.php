<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.branch.store') }}">
                        @csrf
                        @method('post')
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">Branch Name</label>
                            <input id="name" type="text" name="last_name" value="{{ old('name') }}"
                                placeholder="Branch name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2 mt-3">
                            <label for="name" class="text-gray-700 select-none font-medium">Supervisor Name</label>
                            <input id="supervisor_name" type="number" name="supervisor_name" value="{{ old('user_id') }}"
                                placeholder="Supervisor name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2 mt-3">
                            <label for="company" class="text-gray-700 select-none font-medium">Company Name</label>
                            <input id="company" type="number" name="company" value="{{ old('company_id') }}"
                                placeholder="Company name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2 mt-3">
                            <label for="address" class="text-gray-700 select-none font-medium">Address</label>
                            <input id="address" type="text" name="address" value="{{ old('address') }}"
                                placeholder="Address"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="text-center mt-10 mb-10">
                            <button type="submit"
                                class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                        </div>
                </div>


            </div>
        </main>
    </div>
    </div>
</x-app-layout>
