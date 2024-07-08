<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 my-5 mx-3">
        <div class="container mx-auto px-6">
            <div class="text-right flex justify-center items-end">
                @can('Company create')
                <a href="{{route('admin.company.create')}}" type="button" class="flex items-end px-4 py-2 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-500 text-white font-extrabold text-lg rounded-xl shadow-2xl hover:from-blue-600 hover:via-blue-700 hover:to-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-70 active:bg-red-800 active:shadow-inner transform hover:scale-110 transition duration-500 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed my-4 ml-auto">New Company</a>
                @endcan
            </div>
        </div>
        <div class="bg-white shadow-md rounded">
            <table class="text-left w-full border-collapse my-auto">
                <thead>
                    <tr>
                        <th class="py-4 px-4 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Company</th>
                        <th class="py-4 px-4 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-3/12">Address</th>
                        <th class="py-4 px-4 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-4/12">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @can('Company access')
                    @foreach($company as $company)
                    <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">{{$company->name}}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{$company->address}}</td>
                        <td class="py-4 px-6 border-b border-grey-light text-right">
                            @can('Company edit')
                            <a href="" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                            @endcan
                            <a href="" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-green-400">More</a>
                            @can('Company delete')
                            <form action="" method="POST" class="inline">
                                <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                    @endcan
                </tbody>
            </table>
        </div>
    </main>
    </div>
</x-app-layout>
