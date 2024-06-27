
<template>
  <div class="container mx-auto px-4 py-4 flex justify-center items-center">
    <div class="w-full max-w-10/12 bg-white shadow-md rounded flex shadow-lg shadow-indigo-500/40">
      <div class="w-full max-w-md px-8 pt-6 pb-8 mb-9 md:w-1/2">
        <h1 class="text-center font-bold mt-3">Sign Up</h1>
        <form @submit.prevent="handleSubmit" class="mt-5 mb-2">
          <div class="mb-2">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2"> Your Name </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
              id="name"
              type="text"
              placeholder="Name"
              v-model="name"
            />
          </div>
          <div class="mb-2">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
              Your Email
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
              id="email"
              type="email"
              placeholder="Email"
              v-model="email"
            />
          </div>
          <div class="mb-2">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
              Password
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
              id="password"
              type="password"
              placeholder="Password"
              v-model="password"
            />
          </div>
          <div class="mb-2">
            <label for="confirmPassword" class="block text-gray-700 text-sm font-bold mb-2">
              Confirm your password
            </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
              id="confirmPassword"
              type="password"
              placeholder="Enter Password"
              v-model="confirmPassword"
            />
          </div>
          <div class="mb-6">
            <input
              type="checkbox"
              id="terms"
              v-model="terms"
              class="w-h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:ring-opacity-50"
            />
            <label for="terms" class="text-gray-700 text-sm font-bold ml-2">
              I agree to all statements in
              <a href="#" class="text-blue-600 hover:text-blue-800"> Forgot Password </a>
            </label>
          </div>
          <div class="flex items-center justify-between">
            <button
              class=" shadow appearance-none border rounded bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="submit"
            >
              LOGIN
            </button>
            <button
              class=" shadow appearance-none border rounded bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              @click="navigateTo('user')"
              type="button"
            >
              REGISTER
            </button>
          </div>
        </form>
      </div>
      <div class="hidden md:flex md:w-1/2">
        <img
          src="https://static.vecteezy.com/system/resources/previews/023/743/925/non_2x/scooter-with-delivery-man-flat-cartoon-character-fast-courier-restaurant-food-service-mail-delivery-service-a-postal-employee-the-determination-of-geolocation-using-electronic-device-free-png.png"
          alt="Signup Image"
          class="w-full h-full rounded-r object-cover"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      terms: false,
      showModal: false
    }
  },
  methods: {
    handleSubmit() {
      // Add form validation and submission logic here
      console.log('Submitted!')
    },
    navigateTo(role) {
      // Handle navigation to different registration forms based on the role
      this.showModal = false
      if (role === 'user') {
        // Navigate to user registration form
        window.location.href = 'register/user'
      }
      // } else if (role === 'delivery') {
      //   // Navigate to delivery registration form
      //   window.location.href = 'register/user'
      // }
    }
  }
}
</script>

<style scoped>
/* Add any additional Tailwind CSS styles here */
</style>
