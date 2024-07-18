<template>
  <div
    class="bg-gradient-to-r from-orange-400 to-red-500 min-h-screen flex flex-column items-center justify-center bg-gray-100"
  >
    <div class="flex flex-column max-w-6/12 w-full bg-white px-10 mb-4 shadow-lg rounded-lg h-75vh">
      <div class="flex-3">
        <h1 class="text-center font-size-12 font-bold text-gray-800 mt-3">Register</h1>
        <div class="pagination flex justify-center items-center pt-30 h-10vh w-80h">
          <div :class="['number', { active: step === 1, verified: step > 1 }]">
            <span v-if="step > 1" class="checkmark">✔</span>
            <span v-else>1</span>
          </div>
          <div :class="['bar', { active: step >= 2 }]"></div>
          <div :class="['number', { active: step === 2, verified: step > 2 }]">
            <span v-if="step > 2" class="checkmark">✔</span>
            <span v-else>2</span>
          </div>
          <div :class="['bar', { active: step >= 3 }]"></div>
          <div :class="['number', { active: step === 3, verified: step > 3 }]">
            <span v-if="step > 3" class="checkmark">✔</span>
            <span v-else>3</span>
          </div>
        </div>
      </div>
      <form
        v-if="step === 1"
        @submit.prevent="nextStep"
        id="stepOne"
        class="stepOne flex-6 flex flex-column gap-4"
      >
        <div class="flex flex-column justify-between h-35vh">
          <div class="mb-1">
            <label class="block text-gray-700 font-bold" for="email">Email</label>
            <input
              v-model="form.email"
              type="email"
              id="email"
              class="w-100 mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
            />
          </div>
          <div class="mb-1">
            <label class="block text-gray-700 font-bold" for="password">Password</label>
            <input
              v-model="form.password"
              type="password"
              id="password"
              class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
            />
          </div>

          <div class="mb-1">
            <label class="block text-gray-700 font-bold" for="cfPassword">Confirm Password</label>
            <input
              v-model="form.cfPassword"
              type="password"
              id="cfPassword"
              class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
            />
          </div>
        </div>

        <div class="">
          <div class="stepOne flex-8 step flex flex-column">
            <div class="">
              <span class="mt-2 color-black"
                >Already have an account?
                <a class="text-primary font-italic" href="/login">Login</a></span
              >
            </div>
            <div class="flex justify-end item-center">
              <button class="cssbuttons-io-button" id="text_next">
                Next
                <div class="icon next" id="slide_provious">
                  <svg
                    height="24"
                    width="24"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path
                      d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                      fill="currentColor"
                    ></path>
                  </svg>
                </div>
              </button>
            </div>
          </div>
        </div>
      </form>

      <!-- step-2  -->

      <form
        v-if="step === 2"
        @submit.prevent="nextStep"
        id="stepTwo"
        class="flex-6 flex flex-col py-2 grid grid-cols-1 md:grid-cols-2 gap-3"
      >
        <div class="flex flex-col justify-between h-35vh">
          <div class="flex flex-row justify-between gap-4">
            <div class="mb-1 flex-1">
              <label class="block text-gray-700 font-bold" for="firstName">First Name</label>
              <input
                v-model="form.first_name"
                type="text"
                id="firstName"
                class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required
              />
            </div>
            <div class="mb-1 flex-1">
              <label class="block text-gray-700 font-bold" for="lastName">Last Name</label>
              <input
                v-model="form.last_name"
                type="text"
                id="lastName"
                class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required
              />
            </div>
          </div>
          <div class="mb-1 md:col-span-2">
            <label class="block text-gray-700 font-bold" for="address">Address</label>
            <input
              v-model="form.address"
              type="text"
              id="address"
              class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required
            />
          </div>
          <div class="mb-1 md:col-span-2">
            <label class="block text-gray-700 font-bold" for="date">Date of Birth</label>
            <input
              v-model="form.date"
              type="date"
              id="date"
              class="w-100 mt-1 mb-2 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              required
            />
          </div>
        </div>
        <div class="">
          <div class="mt-4 md:col-span-2 stepTwo flex-14 gap-2 flex justify-between item-center">
            <button class="cssbuttons-io-button" id="text_previous" @click.prevent="prevStep">
              Back
              <div class="icon" id="slide_next">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M7.828 11L13.192 5.636 11.778 4.222 4 12l7.778 7.778 1.414-1.414L7.828 13H20v-2z"
                    fill="currentColor"
                  ></path>
                </svg>
              </div>
            </button>
            <button class="cssbuttons-io-button" id="text_next">
              Next
              <div class="icon next" id="slide_provious">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                    fill="currentColor"
                  ></path>
                </svg>
              </div>
            </button>
          </div>
        </div>
      </form>

      <!-- step 3 -->
      <form
        v-if="step === 3"
        @submit.prevent="submitForm"
        id="stepThree"
        class="flex-6 flex flex-col py-2 grid grid-cols-1 md:grid-cols-2 gap-3"
      >
        <!-- <h1>Last Step</h1> -->
        <div class="flex flex-column justify-between h-35vh">
          <div class="flex justify-center mb-6">
            <div @click="openImageOptions" class="relative cursor-pointer">
              <input
                ref="fileInput"
                @change="onImageChange"
                type="file"
                id="profileImage"
                accept="image/*"
                class="hidden"
              />
              <div v-if="imagePreview" class="w-52 h-52 bg-gray-200 rounded-full overflow-hidden">
                <img
                  :src="imagePreview"
                  alt="Profile Image Preview"
                  class="w-full h-full object-cover"
                />
              </div>
              <div
                v-else
                class="w-48 h-48 bg-gray-200 rounded-full flex items-center justify-center"
              >
                <img
                  src="https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI="
                  alt="Default Avatar"
                  class="w-full h-full object-cover rounded-full"
                />
              </div>
              <span>Upload a Profile Picture</span>
            </div>
          </div>

          <!-- Image Options Modal -->
          <div
            v-if="imageOptionsVisible"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
          >
            <div class="bg-white p-4 rounded-lg shadow-lg">
              <h3 class="text-lg font-bold mb-4">Select Image Source</h3>
              <button
                type="button"
                @click="triggerFileInput"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 mb-2"
              >
                Upload File
              </button>
              <button
                @click="openCamera"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700"
              >
                Use Camera
              </button>
              <button
                @click="closeImageOptions"
                class="mt-4 w-full bg-red-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-700"
              >
                Cancel
              </button>
            </div>
          </div>

          <!-- Camera Modal -->
          <div
            v-if="cameraVisible"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
          >
            <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
              <video ref="video" class="w-full mb-4"></video>
              <button
                @click="captureImage"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-2"
              >
                Capture
              </button>
              <button
                @click="closeCamera"
                class="w-full bg-red-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
              >
                Cancel
              </button>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <div class="md:col-span-2 stepTwo flex-8 gap-2 flex justify-between item-center">
            <button class="cssbuttons-io-button" id="text_previous" @click.prevent="prevStep">
              Back
              <div class="icon" id="slide_next">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M7.828 11L13.192 5.636 11.778 4.222 4 12l7.778 7.778 1.414-1.414L7.828 13H20v-2z"
                    fill="currentColor"
                  ></path>
                </svg>
              </div>
            </button>
            <button class="cssbuttons-io-button" id="text_next">
              Done
              <div class="icon next" id="slide_provious">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                    fill="currentColor"
                  ></path>
                </svg>
              </div>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import * as Yup from 'yup'
import axiosInstance from '@/plugins/axios'
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      step: 1,
      form: {
        email: '',
        password: '',
        cfPassword: '',
        first_name: '',
        last_name: '',
        address: '',
        date: '',
        profilePicture: null
      },
      imagePreview: null,
      imageOptionsVisible: false,
      cameraVisible: false,
      videoStream: null,
      validationSchemaStep1: Yup.object().shape({
        email: Yup.string().email('Invalid email address').required('Email is required'),
        password: Yup.string().required('Password is required'),
        cfPassword: Yup.string()
          .oneOf([Yup.ref('password')], 'Passwords do not match')
          .required('Confirm Password is required')
      }),
      validationSchemaStep2: Yup.object().shape({
        first_name: Yup.string().required('First name is required'),
        last_name: Yup.string().required('Last name is required'),
        address: Yup.string().required('Address is required'),
        date: Yup.date().required('Date of birth is required').nullable()
      }),
      errors: {} // Track errors for empty fields
    }
  },
  methods: {
    async nextStep() {
      if (this.step === 1) {
        try {
          await this.validationSchemaStep1.validate({
            email: this.form.email,
            password: this.form.password,
            cfPassword: this.form.cfPassword
          })

          const response = await axiosInstance.get('/get_users')
          console.log('Response data:', response.data)

          const users = response.data.data
          const emailExists = users.some((user) => user.email === this.form.email)
          console.log('Email exists:', emailExists)

          if (emailExists) {
            Swal.fire({
              title: 'Email Already Exists',
              text: 'Please use a different email address.',
              icon: 'warning',
              confirmButtonText: 'OK'
            })
          } else {
            this.step++
            console.log('Next step:', this.step)
          }
        } catch (error) {
          if (error.name === 'ValidationError') {
            alert(error.errors[0])
          } else {
            console.error('Error checking email:', error)
            alert('An error occurred while checking the email.')
          }
        }
      } else if (this.step === 2) {
        try {
          await this.validationSchemaStep2.validate({
            first_name: this.form.first_name,
            last_name: this.form.last_name,
            address: this.form.address,
            date: this.form.date
          })

          this.step++
          console.log('Next step:', this.step)
        } catch (error) {
          if (error.name === 'ValidationError') {
            alert(error.errors[0])
          } else {
            console.error('Error validating step 2:', error)
            alert('An error occurred while validating step 2.')
          }
        }
      } else {
        this.step++
        console.log('Next step:', this.step)
      }
    },
    prevStep() {
      this.step--
    },
    triggerFileInput() {
      this.$refs.fileInput.click()
    },
    onImageChange(event) {
      const file = event.target.files[0]
      if (file) {
        const reader = new FileReader()
        reader.onload = (e) => {
          this.imagePreview = e.target.result
        }
        reader.readAsDataURL(file)
      }
      this.closeImageOptions()
    },
    openImageOptions() {
      this.imageOptionsVisible = true
    },
    closeImageOptions() {
      this.imageOptionsVisible = false
    },
    openCamera() {
      this.imageOptionsVisible = false
      this.cameraVisible = true
      navigator.mediaDevices
        .getUserMedia({ video: true })
        .then((stream) => {
          this.videoStream = stream
          this.$refs.video.srcObject = stream
          this.$refs.video.play()
        })
        .catch((err) => {
          console.error('Error accessing camera: ', err)
        })
    },
    captureImage() {
      const canvas = document.createElement('canvas')
      canvas.width = this.$refs.video.videoWidth
      canvas.height = this.$refs.video.videoHeight
      const context = canvas.getContext('2d')
      context.drawImage(this.$refs.video, 0, 0, canvas.width, canvas.height)
      this.imagePreview = canvas.toDataURL('image/png')
      this.closeCamera()
    },
    closeCamera() {
      if (this.videoStream) {
        this.videoStream.getTracks().forEach((track) => track.stop())
      }
      this.cameraVisible = false
    },
    async submitForm() {
      try {
        const formData = new FormData()
        formData.append('email', this.form.email)
        formData.append('password', this.form.password)
        formData.append('first_name', this.form.first_name)
        formData.append('last_name', this.form.last_name)
        formData.append('address', this.form.address)
        formData.append('date', this.form.date)
        if (this.form.profilePicture) {
          formData.append('profilePicture', this.form.profilePicture)
        }

        const response = await axiosInstance.post('/register/user', formData)
        Swal.fire({
          title: 'Form submitted successfully!',
          text: 'Click OK to go to login page.',
          icon: 'success',
          showConfirmButton: false, // Hide the confirm button
          timer: 3000 // Display the alert for 3 seconds
        }).then(() => {
          this.$router.push('/login')
        })
        console.log(response.data)
      } catch (error) {
        console.error('Error submitting form:', error)
        Swal.fire({
          title: 'Error!',
          text: 'An error occurred while submitting the form.',
          icon: 'error',
          confirmButtonText: 'OK'
        })
      }
    },
    handleFileUpload(event) {
      this.form.profilePicture = event.target.files[0]
    }
  }
}
</script>

<style scoped>
.step-indicator {
  display: flex;
  justify-content: space-between;
  margin: 20px 0;
  color: black;
}

.step {
  text-align: center;
}

.pagination {
  gap: 5px;
  padding: 15px 15px;
}

.pagination .number {
  width: 28px;
  height: 28px;
  text-align: center;
  line-height: 28px;
  border-radius: 50%;
  color: #4f46e5;
  background: #c5c2c2;
  font-size: 15px;
  position: relative;
}

.pagination .number.active {
  background: #4f46e5;
  color: #ffffff;
}

.pagination .number.verified {
  background: #4caf50;
  color: #ffffff;
}

.pagination .number.verified::after {
  position: absolute;
  top: -10px;
  right: -10px;
  background: white;
  color: #4caf50;
  border-radius: 50%;
  width: 18px;
  height: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: bold;
}

.pagination .bar {
  width: 295px;
  height: 4px;
  border-radius: 5px;
  background: #bbbbbb;
}

.pagination .bar.active {
  background: #4f46e5;
  color: rgb(0, 0, 0);
}

/* next and previous buttons */
#text_next,
#text_previous {
  background: #4f46e5;
  color: white;
  font-family: inherit;
  padding: 0.25em;
  font-size: 14px;
  font-weight: 500;
  border-radius: 0.4em;
  border: none;
  letter-spacing: 0.05em;
  display: flex;
  align-items: center;
  box-shadow: inset 0 0 1.2em -0.4em #4f46e5;
  overflow: hidden;
  position: relative;
  height: 2.2em;
  cursor: pointer;
  margin: 10px;
  width: 6em;
}

#text_next {
  padding-left: 2.7em;
}

#text_previous {
  padding-left: 0.8em;
}

.cssbuttons-io-button .icon {
  background: white;
  margin-left: 1.8em;
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 1.8em;
  width: 1.8em;
  border-radius: 0.3em;
  box-shadow: 0.1em 0.1em 0.4em 0.15em #4f46e5;
  transition: all 0.3s;
}

.cssbuttons-io-button #slide_next {
  right: 0.2em;
}

.cssbuttons-io-button #slide_provious {
  left: -1.6em;
}

.cssbuttons-io-button:hover .icon {
  width: calc(100% - 0.4em);
}

.cssbuttons-io-button .icon svg {
  width: 0.9em;
  transition: transform 0.3s;
  color: #4f46e5;
}

.cssbuttons-io-button:hover .icon svg {
  transform: translateX(0.1em);
}

.cssbuttons-io-button:active .icon {
  transform: scale(0.95);
}
</style>
