<x-app-layout>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 my-3">
        <div class="container mx-auto px-6 py-2">
        <div class="text-right">
          <!-- @can('User create') -->
          <a href="{{route('admin.company.create')}}" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors">New Company</a>
          <!-- @endcan -->
        </div>
        </div>
        <div class="bg-white shadow-md rounded m-2">
            <table class="text-left w-full border-collapse">
                <thead>
                    <tr>
                        <th class="py-4 px-4 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light">Company</th>
                        <th class="py-4 px-4 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light w-3/12">Address</th>
                        <th class="py-4 px-4 bg-grey-lightest font-bold text-sm text-grey-dark border-b border-grey-light text-right w-4/12">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @can('Company access')
                    @foreach($companies as $company)
                    <tr class="hover:bg-grey-lighter">
                        <td class="py-4 px-6 border-b border-grey-light">{{$company->company}}</td>
                        <td class="py-4 px-6 border-b border-grey-light">{{$company->address}}</td>
                        <td class="py-4 px-6 border-b border-grey-light text-right">

                            <a href="" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-blue-400">Edit</a>
                            <a href="" class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-green hover:bg-green-dark text-green-400">More</a>

                            <form action="" method="POST" class="inline">
                                <button class="text-grey-lighter font-bold py-1 px-3 rounded text-xs bg-blue hover:bg-blue-dark text-red-400">Delete</button>
                            </form>
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