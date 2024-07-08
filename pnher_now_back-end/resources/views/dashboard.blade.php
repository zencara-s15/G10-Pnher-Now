<x-app-layout>
  <div>
    <main class="flex-1 bg-gray-200">
      <div class="container px-6 py-3">
        <h3 class="text-gray-700 text-3xl font-medium mt-2">Welcome : {{ auth()->user()->name }}</h3>
        <!-- Container -->
        <div class="container">

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
                    <p class="card-category">All Baggages</p>
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
      <!-- Chart -->
      <div class="cartInfo flex flex-row justify-between">
        <div class="card w-6/12 mx-1 p-2 bg-white rounded-lg">
          <div class="card-header flex justify-center">
            <h1 class="">Information of system</h1>
          </div>
          <div class="card-body">
            <canvas id="barChart"></canvas>
          </div>
        </div>
        <div class="card w-6/12 bg-white rounded-lg">
          <div class="card-header flex justify-center">
            <h1 class="">Total of each months</h1>
          </div>
          <div class="card-body">
            <canvas id="lineChart"></canvas>
          </div>
        </div>
      </div>
    </main>
  </div>
  </div>
  <script>
  var ctx = document.getElementById('barChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['New register', 'All companies', 'All Baggages', 'Order'],
      datasets: [{
        data: [12, 19, 3, 5],
        backgroundColor: [
          '#B941FF',
          '#2563EB',
          '#EF4444',
          '#FBBF24',
        ],
      }],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  // Line charts
  var ctx = document.getElementById('lineChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
          label: 'New Register',
          data: [12, 19, 3, 5, 2, 3, 10],
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          fill: false,
          borderWidth: 1
        },
        {
          label: 'Company',
          data: [5, 2, 10, 3, 8, 15, 7, 1, 12, 9, 10, 20],
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          fill: false,
          borderWidth: 1
        },
        {
          label: 'All Product',
          data: [10, 15, 12, 20, 15, 10, 12, 18, 25, 12, 19, 30],
          backgroundColor: 'rgba(0, 255, 0, 0.2)',
          borderColor: 'rgba(0, 255, 0, 1)',
          fill: false,
          borderWidth: 1
        },
        {
          label: 'Order',
          data: [12, 19, 3, 5, 2, 3, 10, 18, 25, 12, 19, 30],
          backgroundColor: 'rgba(255, 159, 64, 0.2)',
          borderColor: 'rgba(255, 159, 64, 1)',
          fill: false,
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      legend: {
        display: false
      }
    }
  })
</script>
</x-app-layout>