<template>
  <div class="bg-gradient-to-r container mx-auto flex justify-center items-center h-screen w-full">
    <div class="w-full max-w-6xl bg-white shadow-md rounded flex shadow-lg shadow-indigo-500/40 h-5/6">
      <div class="w-full flex flex-row mx-auto px-8 my-10">
        <div class="w-1/2 flex flex-col justify-center items-center">
          <h1 class="text-4xl font-bold text-gray-800">SIGN-IN</h1>
          <form @submit.prevent="onSubmit" class="w-full mt-8">
            <div class="mb-6">
              <label for="email" class="block text-gray-700 font-bold mb-2">
                Email
              </label>
              <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email" type="email" v-model="email" placeholder="example@email.com" />
              <span v-if="emailError" class="text-red-500">{{ emailError }}</span>
            </div>
            <div class="mb-6 relative">
              <label for="password" class="block text-gray-700 font-bold mb-2">
                Password
              </label>
              <div class="relative">
                <input :type="passwordFieldType"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="password" v-model="password" />
                <span v-if="password.length < 8" class="text-red-500">
                  Password should be at least 8 characters long.
                </span>
                <span class="absolute inset-y-0 right-0 pr-4 items-center mt-2" @click="togglePasswordVisibility">
                  <svg v-if="passwordFieldType === 'password'" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-gray-500">
                    <path stroke-linecap="round" s troke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 1118 0 9 9 0 01-18 0z" />
                  </svg>
                  <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="h-5 w-5 text-gray-500 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A9.06 9.06 0 0112 19c-5 0-9-4-9-9 0-1.094.175-2.142.5-3.125M4.133 4.133A9.062 9.062 0 0112 4c5 0 9 4 9 9 0 1.094-.175 2.142-.5 3.125M9.879 9.879A3 3 0 1112 15a3 3 0 01-2.121-5.121z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.133 4.133l15.75 15.75" />
                  </svg>
                </span>
              </div>
            </div>
            <div class="flex items-center justify-between mb-6">
              <a href="#" class="text-blue-600 hover:text-blue-800">Forgot Password?</a>
              <button
                class="shadow appearance-none border rounded bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                type="submit" :disabled="isSubmitting">
                LOGIN
              </button>
            </div>
            <div class="text-center">
              <span class="text-dark">Don't have an account? </span>
              <a href="/register" class="text-blue-600 hover:text-blue-800">Signup</a>
            </div>
          </form>
        </div>
        <div class="w-1/2 hidden md:block">
          <img
            src="https://static.vecteezy.com/system/resources/previews/023/743/925/non_2x/scooter-with-delivery-man-flat-cartoon-character-fast-courier-restaurant-food-service-mail-delivery-service-a-postal-employee-the-determination-of-geolocation-using-electronic-device-free-png.png"
            alt="Signup Image" class="w-full h-full object-cover rounded-r-md" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const formSchema = yup.object({
  email: yup.string().required().email().label('Email address'),
  password: yup.string().required().label('Password')
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    email: '',
    password: ''
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/login', values)
    localStorage.setItem('access_token', data.access_token)
    router.push('/home') // Redirect to "/home" after successful login
  } catch (error) {
    console.error('Error', error)
  }
})

const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')

const passwordFieldType = ref('password')
const togglePasswordVisibility = () => {
  passwordFieldType.value = passwordFieldType.value === 'password' ? 'text' : 'password'
}
</script>

<style scoped>
.bg-gradient-to-r {
  background-image: linear-gradient(to right, #4f46e5, #7c3aed, #ec4899);
}
</style>
