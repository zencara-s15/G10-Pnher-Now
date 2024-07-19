<x-app-layout>
    <div>
        <main class="flex-1 justify-cetner overflow-x-hidden overflow-y-auto bg-gray-200 ">
            <div class="container mx-auto px-4 py-1 pb-10">
                <div class="bg-white shadow-md rounded my-3 p-3">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        <div class="flex justify-end">
                            <a href="{{route('admin.users.index')}}">
                                <span class="material-icons-outlined bg-red-300 p-2 rounded-full hover:text-red-500">
                                    close
                                </span>
                            </a>
                        </div>
                        <div class="form-header">
                            <h1 class="flex justify-center text-3xl">Create New User</h1>
                        </div>
                        @csrf
                        @method('post')
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">First Name</label>
                            <input id="name" type="text" name="last_name" value="{{ old('fist_name') }}" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="name" class="text-gray-700 select-none font-medium">Last Name</label>
                            <input id="name" type="text" name="first_name" value="{{ old('last_name') }}" placeholder="Enter name" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="email" class="text-gray-700 select-none font-medium">Email</label>
                            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Enter email" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="password" class="text-gray-700 select-none font-medium">Password</label>
                            <input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Enter password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="password_confirmation" class="text-gray-700 select-none font-medium">Confirm
                                Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter password" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>

                        <h3 class="text-xl my-4 text-gray-600">Role</h3>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($roles as $role)
                            <div class="flex flex-col justify-cente">
                                <div class="flex flex-col">
                                    <label class="inline-flex items-center mt-3">
                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="roles[]" value="{{ $role->id }}"><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-16 mb-16">
<<<<<<< HEAD
                            <button href="{{route('admin.users.index')}}" type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors flex ml-auto">Submit</button>
=======
                            <button href="{{route('admin.users.index')}}" type="submit"
                                class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
>>>>>>> user_feedback
                        </div>
                </div>


            </div>
        </main>
    </div>
    </div>
</x-app-layout>