<template>
  <div
    class="bg-gradient-to-r min-h-screen flex flex-column items-center justify-center bg-gray-100"
  >
    <div class="pagination flex justify-center items-center pt-30 h-10vh w-80h">
      <div :class="['number', { active: step === 1 }]">1</div>
      <div class="bar"></div>
      <div :class="['number', { active: step === 2 }]">2</div>
      <div class="bar"></div>
      <div :class="['number', { active: step === 3 }]">3</div>
    </div>
    <div class="flex flex-column max-w-6/12 w-full bg-white px-10 shadow-lg rounded-lg h-70vh">
      <div class="flex-3">
        <h1 class="text-center font-bold text-gray-800 mt-3">Register</h1>
        <p class="text-center text-gray-800 my-4">Create an account!</p>
      </div>
      <form
        v-if="step === 1"
        @submit.prevent="nextStep"
        id=""
        class="stepOne flex-6 mb-4 flex flex-column gap-4"
      >
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
        <div class="stepOne flex-8 gap-2 step flex flex-column">
          <div class="">
            <span class="mt-2 color-black">Already have an account? <a href="/">Login</a></span>
          </div>
          <div class="flex justify-end item-center">
            <button class="cssbuttons-io-button" id="text_next">
              Next
              <div class="icon next" id="slide_provious">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
      </form>
  
      <!-- step-2  -->

      <form
        v-if="step === 2"
        @submit.prevent="nextStep"
        id="stepTwo"
        class="flex-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-3"
      >
        <div class="mb-1">
          <label class="block text-gray-700" for="firstName">First Name</label>
          <input
            v-model="form.firstName"
            type="text"
            id="firstName"
            class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required
          />
        </div>
        <div class="mb-1">
          <label class="block text-gray-700" for="lastName">Last Name</label>
          <input
            v-model="form.lastName"
            type="text"
            id="lastName"
            class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required
          />
        </div>
        <div class="mb-1 md:col-span-2">
          <label class="block text-gray-700" for="address">Address</label>
          <input
            v-model="form.address"
            type="text"
            id="address"
            class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required
          />
        </div>
        <div class="mb-1 md:col-span-2">
          <label class="block text-gray-700" for="date">Date of Birth</label>
          <input
            v-model="form.date"
            type="date"
            id="date"
            class="w-100 mt-1 mb-2 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            required
          />
        </div>
        <div class="md:col-span-2 stepTwo flex-8 gap-2 flex justify-between item-center">
          <!-- <div class="flex "> -->
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
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                    fill="currentColor"
                  ></path>
                </svg>
              </div>
            </button>
          <!-- </div> -->
        </div>
      </form>

      <!-- step 3 -->
      <form
        v-if="step === 3"
        @submit.prevent="nextStep"
        id="stepTwo"
        class="flex-6 py-2 grid grid-cols-1 md:grid-cols-2 gap-3"
      >
        <h1>Last Step</h1>
        <div class="md:col-span-2 stepTwo flex-8 gap-2 flex justify-between item-center">
          <!-- <div class="flex "> -->
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
              Finish
              <div class="icon next" id="slide_provious">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 0h24v24H0z" fill="none"></path>
                  <path
                    d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                    fill="currentColor"
                  ></path>
                </svg>
              </div>
            </button>
          <!-- </div> -->
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      step: 1,
      form: {
        firstName: '',
        lastName: '',
        phone: '',
        email: '',
        password: '',
        cfPassword: '',
        date: '',
        job: '',
        address: ''
      }
    }
  },
  methods: {
    nextStep() {
      this.step++
    },
    prevStep() {
      this.step--
    },
    register() {
      this.$router.push('/login')
    }
  }
}
</script>

<style>
/* Add any additional custom styles here */
.bg-gradient-to-r {
  background-image: linear-gradient(to right, #4f46e5, #7c3aed, #ec4899);
}

.step-indicator {
  display: flex;
  justify-content: space-between;
  margin: 20px 0;
  color: black;
}

.step {
  text-align: center;
}
/* number of step  */
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
  /* background: ; */
  background: #ffffff;
  font-size: 15px;
}

.pagination .bar {
  width: 295px;
  height: 4px;
  border-radius: 5px;
}

.pagination .active ~ div {
  background: #bbbbbb;
  color: rgb(0, 0, 0);
}

/* next and prevoiuse btn  */

#text_next,
#text_previous {
  background: #4f46e5;
  color: white;
  font-family: inherit;
  padding: 0.25em;
  /* padding-left: 0.9em; */
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
  /* change this line */

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
