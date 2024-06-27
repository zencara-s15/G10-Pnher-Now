<x-app-layout>
  <div>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
      <div class="container mx-auto px-6 py-8">


        <h3 class="text-gray-700 text-3xl font-medium">Welcome : {{ auth()->user()->name }}</h3>

        <p>Hello : <b>
            @foreach(auth()->user()->roles as $role)
            {{ $role->name }}
            @endforeach
          </b>
        </p>
        @php
        $roles = auth()->user()->roles->pluck('name')->toArray();
        @endphp

        @if(in_array('admin', $roles))
        @elseif(in_array('user', $roles))
        <div class="flex">
          <div class="flex w-3/4 bg-green-400">
            02
          </div>
          <div class="flex w-1/4 bg-red-400">
            03
          </div>
        </div>
        @endif


        <!-- Container -->
        <div class="container mt-1 ">

          <!-- Dashboard -->
          <div class="row flex flex-row m-5 justify-between">
            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
              <div class="card-body flex flex-row items-center">
                <div class="col-icon flex flex-row items-center bg-blue-600 h-37 px-4 py-3 rounded-lg">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <span class="material-icons-outlined" style="font-size:48px;color:white;">
                      group
                    </span>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0 mx-2">
                  <div class="numbers">
                    <p class="card-category">New Register</p>
                    <h4 class="card-title">1,294</h4>
                  </div>
                </div>
              </div>
            </div>


            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
              <div class="card-body flex flex-row items-center">
                <div class="col-icon flex flex-row items-center bg-blue-400 h-37 px-4 py-3 rounded-lg">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <span class="material-icons-outlined" style="font-size:48px;color:white;">
                      store
                    </span>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0 mx-2">
                  <div class="numbers">
                    <p class="card-category">Companies</p>
                    <h4 class="card-title">1,294</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
              <div class="card-body flex flex-row items-center">
                <div class="col-icon flex flex-row items-center bg-red-500 h-37 px-4 py-3 rounded-lg">
                  <div class="icon-big text-center bubble-shadow-small">
                    <span class="material-icons-outlined" style="font-size:48px;color:white;">
                      production_quantity_limits
                    </span>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0 mx-2">
                  <div class="numbers">
                    <p class="card-category">All Product</p>
                    <h4 class="card-title">1,294</h4>
                  </div>
                </div>
              </div>
            </div>


            <div class="card card-stats card-round bg-white w-1/3 px-2 py-2 m-2 rounded-lg">
              <div class="card-body flex flex-row items-center">
                <div class="col-icon flex flex-row items-center bg-yellow-400 h-37 px-4 py-3 rounded-lg">
                  <div class="icon-big text-center icon-primary bubble-shadow-small">
                    <span class="material-icons-outlined" style="font-size:48px;color:white;">
                      check_circle
                    </span>
                  </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0  mx-2">
                  <div class="numbers">
                    <p class="card-category">Order</p>
                    <h4 class="card-title">1,294</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end Dashboard -->
        </div>
        <!-- end Container -->
        
      </div>
    </main>
  </div>
  </div>
</x-app-layout>