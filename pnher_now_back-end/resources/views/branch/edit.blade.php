<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.branch.update', $branch->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">Branch Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $branch->name) }}"
                                placeholder="Branch name"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <!-- Supervisor Name -->
                        <div class="flex flex-col space-y-2 mt-3">
                            <label for="supervisor_name" class="text-gray-700 select-none font-medium">Supervisor Name</label>
                            <select id="supervisor_name" name="user_id"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <option value="">Select Supervisor</option>
                                @foreach ($supervisors as $supervisor)
                                    <option value="{{ $supervisor->id }}" {{ $supervisor->id == $branch->user_id ? 'selected' : '' }}>
                                        {{ $supervisor->first_name }} {{ $supervisor->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Company Name -->
                        <div class="flex flex-col space-y-2 mt-3">
                            <label for="company" class="text-gray-700 select-none font-medium">Company Name</label>
                            <select id="company" name="company_id"
                                class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $company->id == $branch->company_id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col space-y-2 mt-3">
                            <label for="address" class="text-gray-700 select-none font-medium">Address</label>
                            <input id="address" type="text" name="address" value="{{ old('address', $branch->address) }}"
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
        </main>
    </div>
</x-app-layout>
