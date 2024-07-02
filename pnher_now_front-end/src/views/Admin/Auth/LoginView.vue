<template>
  <div class="container mx-auto px-4 py-4 flex justify-center items-center">
    <div class="w-full max-w-10/12 bg-white shadow-md rounded flex shadow-lg shadow-indigo-500/40">
      <div class="w-full max-w-md px-8 pt-6 pb-8 mb-9 md:w-1/2">
        <h1 class="text-center font-bold mt-3">Sign Up</h1>
        <form @submit.prevent="onSubmit" class="mt-5 mb-2">
          <div class="mb-2">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2"> Your Name </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
              id="name"
              type="text"
              placeholder="Name"
              v-model="name"
            />
            <span v-if="nameError" class="text-red-500 text-xs">{{ nameError }}</span>
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
            <span v-if="emailError" class="text-red-500 text-xs">{{ emailError }}</span>
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
            <span v-if="passwordError" class="text-red-500 text-xs">{{ passwordError }}</span>
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
            <span v-if="confirmPasswordError" class="text-red-500 text-xs">{{
              confirmPasswordError
            }}</span>
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
            <span v-if="termsError" class="text-red-500 text-xs">{{ termsError }}</span>
          </div>
          <div class="flex items-center justify-between">
            <button
              class="shadow appearance-none border rounded bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="submit"
              :disabled="isSubmitting"
            >
              LOGIN
            </button>
            <button
              class="shadow appearance-none border rounded bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              @click="navigateToRegister"
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

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'

const router = useRouter()

const formSchema = yup.object({
  name: yup.string().required().label('Name'),
  email: yup.string().required().email().label('Email address'),
  password: yup.string().required().label('Password'),
  confirmPassword: yup
    .string()
    .oneOf([yup.ref('password'), null], 'Passwords must match')
    .required()
    .label('Confirm Password'),
  terms: yup.bool().oneOf([true], 'You must accept the terms').required()
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
    terms: false
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/login', values)
    localStorage.setItem('access_token', data.access_token)
    router.push('/')
  } catch (error) {
    console.error('Error', error)
  }
})

const { value: name, errorMessage: nameError } = useField('name')
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')
const { value: confirmPassword, errorMessage: confirmPasswordError } = useField('confirmPassword')
const { value: terms, errorMessage: termsError } = useField('terms')

const navigateToRegister = () => {
  router.push('/register/user')
}
</script>

<style scoped>
/* Add any additional Tailwind CSS styles here */
</style>
