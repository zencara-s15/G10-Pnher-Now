<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-2">
                <div class="text-right">
                    @can('Branch create')
                    <a href="{{ route('admin.branch.create') }}"
                        class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">New
                        Branch
                    </a>
                    @endcan
                </div>
                
                <div class="bg-white shadow-md rounded my-6">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Branch name
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Supervisor name
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Company name
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Branch access')
                            @foreach ($branches as $branch)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 text-center">
                                        {{ $branch->id }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $branch->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $branch->user->first_name }} {{ $branch->user->last_name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $branch->company->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $branch->address }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @can('Branch edit')
                                        <a href="{{ route('admin.branch.edit', $branch->id) }}"
                                            class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-green-400">
                                            <span class="material-icons-outlined">
                                                border_color
                                            </span>
                                        </a>
                                        @endcan

                                        @can('Branch delete')
                                            <form action="{{ route('admin.branch.destroy', $branch->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('delete')
                                                <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">
                                                    <span class="material-icons-outlined">
                                                        delete
                                                    </span>
                                                </button>
                                            </form>
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
    </div>
</x-app-layout>
