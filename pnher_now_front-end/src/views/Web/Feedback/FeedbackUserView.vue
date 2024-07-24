<template>
  <UserLayout>
    <div
      class="bg-gradient-to-r container mx-auto flex justify-center items-center h-screen w-full"
    >
      <div
        class="w-full max-w-6xl bg-white shadow-md rounded flex shadow-lg shadow-indigo-500/40 h-5/6"
      >
        <div class="w-full flex flex-row mx-auto px-8 my-10">
          <div class="w-1/2 flex flex-col justify-center items-center">
            <h1 class="text-4xl font-bold text-gray-800">Feedback to Deliverer</h1>
            <form @submit.prevent="onSubmit" class="w-full mt-8">
              <div class="mb-6">
                <label for="title" class="block text-gray-700 font-bold mb-2">Feedback On</label>
                <input
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="title"
                  type="text"
                  v-model="title"
                  maxlength="20"
                  :class="{'border-red-500': title.length > 20 || title.length < 1}"
                />
                <p v-if="title.length > 20 || title.length < 1" class="text-red-500 text-xs italic">Title must be between 1 and 20 characters.</p>
              </div>
              <div class="mb-6">
                <label for="message" class="block text-gray-700 font-bold mb-2">Your Feedback</label>
                <textarea
                  id="message"
                  v-model="message"
                  rows="4"
                  maxlength="50"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  :class="{'border-red-500': message.length > 100 || message.length < 1}"
                ></textarea>
                <p v-if="message.length > 100 || message.length < 1" class="text-red-500 text-xs italic">Message must be between 1 and 100 characters.</p>
              </div>
              <div class="mb-6">
                <label for="rate" class="block text-gray-700 font-bold mb-2">Rate</label>
                <select
                  id="rate"
                  v-model="rate"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="select a rate"
                >
                  <option disabled value="">Select a rate</option>
                  <option v-for="num in 10" :key="num" :value="num">{{ num }}</option>
                </select>
              </div>
              <div class="flex items-center justify-center mt-3">
                <button
                  class="shadow appearance-none border rounded bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  type="submit"
                  :disabled="isSubmitting || title.length < 1 || title.length > 20 || message.length < 1 || message.length > 100"
                >
                  Submit
                </button>
              </div>
            </form>
          </div>
          <div class="w-1/2 hidden md:block">
            <img
              src="https://media.istockphoto.com/id/1324723183/vector/workplace-culture-abstract-concept-vector-illustration.jpg?s=612x612&w=0&k=20&c=tt27M26Y-j-sCyJBYe-BOQ7duqeHFFlYBfENNYpJr-o="
              alt="Feedback Image"
              class="w-full h-full object-cover rounded-r-md"
            />
          </div>
        </div>
      </div>
    </div>
  </UserLayout>
</template>

<script>
import UserLayout from '@/Components/Layouts/UserLayout.vue'
import axiosInstance from '@/plugins/axios';

export default {
  components: {
    UserLayout
  },
  props: {
    userId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      title: '',
      message: '',
      rate: null,  // Initialize as null to handle the default value
      isSubmitting: false
    }
  },
  methods: {
    async onSubmit() {
      this.isSubmitting = true
      try {
        const response = await axiosInstance.post('http://127.0.0.1:8000/api/feedback_post', {
          user_id: this.userId,
          title: this.title,
          comment: this.message,
          rates: this.rate,
        })
        console.log('Response:', response.data)

        alert('Form submitted successfully!')
        // Optionally, clear the form
        this.title = ''
        this.message = ''
        this.rate = null
      } catch (error) {
        console.error('There was an error submitting the form:', error)
        alert('There was an error submitting the form. Please try again.')
      } finally {
        this.isSubmitting = false
      }
    }
  }
}
</script>

<style scoped>
/* Add your custom styles here */
.border-red-500 {
  border-color: #f56565;
}
.text-red-500 {
  color: #f56565;
}
</style>
