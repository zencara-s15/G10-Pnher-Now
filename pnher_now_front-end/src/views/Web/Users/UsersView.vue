<template>
    <WebLayout></WebLayout>
    <div class="card">
        <body class="bg-gray-100">
            <div class="min-h-screen flex items-center justify-center w-full">
                <div class=" d-flex bg-white flex flex-row gap-5 p-8 rounded-lg shadow-lg max-w-md">
                    <div class="profile flex-col mb-3 bg-white border-r pr-8">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREoRGyXmHy_6aIgXYqWHdOT3KjfmnuSyxypw&s"
                            class="rounded-full" alt="profile" />
                        <h3 class="text-black text-2xl items-center ml-3">Jara Vira</h3>
                        <p class="text mt-3 ml-3">Phnom Penh</p>
                        <p class="text mt-3 ml-3">Work at BAB Bank</p> 
                    </div>
                    <form class="d-flex row" @submit.prevent="saveUserInfo">
                        <div class="mb-2 flex items-center">
                            <input type="text" id="firstname" v-model="firstName"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter Firstname" />
                            <i v-if="firstNameSuccess" class="fas fa-check-circle fa-1x text-green-500 ml-2"></i>
                        </div>
                        <div class="mb-2 flex items-center">
                            <input type="text" id="lastname" v-model="lastName"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter Lastname" />
                            <i v-if="lastNameSuccess" class="fas fa-check-circle fa-1x text-green-500 ml-2"></i>
                        </div>
                        <div class="mb-2 flex items-center">
                            <input type="date" id="dateofbirth" v-model="dateOfBirth"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            <i v-if="dateOfBirthSuccess" class="fas fa-check-circle fa-1x text-green-500 ml-2"></i>
                        </div>
                        <div class="mb-2 flex items-center">
                            <input type="text" id="address" v-model="address"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Enter Address" />
                            <i v-if="addressSuccess" class="fas fa-check-circle fa-1x text-green-500 ml-2"></i>
                        </div>
                        <button type="submit"
                            class="ml-15 mt-3 bg-blue-500 w-9/19 text-white py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Update Info
                        </button>
                    </form>
                </div>
            </div>
        </body>
    </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import '@fortawesome/fontawesome-free/css/all.css';

export default {
    components: {
        WebLayout
    },
    name: 'UsersView.vue',
    props: {
        msg: String
    },
    data() {
        return {
            firstName: '',
            lastName: '',
            dateOfBirth: '',
            address: '',
            formSubmitted: false,
            firstNameSuccess: false,
            lastNameSuccess: false,
            dateOfBirthSuccess: false,
            addressSuccess: false
        };
    },
    methods: {
        saveUserInfo() {
            console.log('User Information:');
            console.log('First Name:', this.firstName);
            console.log('Last Name:', this.lastName);
            console.log('Date of Birth:', this.dateOfBirth);
            console.log('Address:', this.address);

            // Show an alert message
            alert('User Info updated successfully!');

            // Set form submission status to true
            this.formSubmitted = true;

            // Set success status for each input
            this.firstNameSuccess = true;
            this.lastNameSuccess = true;
            this.dateOfBirthSuccess = true;
            this.addressSuccess = true;

            // Reset the form fields
            this.firstName = '';
            this.lastName = '';
            this.dateOfBirth = '';
            this.address = '';
        }
    }
};
</script>

<style scoped>
img {
    width: 365px;
    height: 70px;
    border-radius: 50%;
}
</style>
