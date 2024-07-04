<x-app-layout>
    <div>
        <form action="{{route('admin.company.store')}}" method="POST" id="popupFormModal" tabindex="-1" aria-labelledby="popupFormModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="popupFormModalLabel">Create New Company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{('admin.company.create')}}">
                            @csrf
                            <div class="flex flex-col space-y-2">
                                <label for="title" class="text-gray-700 select-none font-medium">Company</label>
                                <input id="title" type="text" name="title" value="" placeholder="Enter title" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                            </div>

                            <div class="flex flex-col space-y-2">
                                <label for="description" class="text-gray-700 select-none font-medium">Address</label>
                                <input id="address" type="text" name="address" value="" placeholder="Enter address" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />

                            </div>

                            <div class="text-center mt-16 mb-16">
                                <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
</x-app-layout>