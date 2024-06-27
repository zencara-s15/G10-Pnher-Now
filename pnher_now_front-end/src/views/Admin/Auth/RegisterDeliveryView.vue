<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-lg w-full bg-white p-10 shadow-lg rounded-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
      <div class="flex justify-center mb-6">
        <div @click="openImageOptions" class="relative cursor-pointer">
          <input ref="fileInput" @change="onImageChange" type="file" id="profileImage" accept="image/*" class="hidden">
          <div v-if="imagePreview" class="w-24 h-24 bg-gray-200 rounded-full overflow-hidden">
            <img :src="imagePreview" alt="Profile Image Preview" class="w-full h-full object-cover">
          </div>
          <div v-else class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center">
            <img src="https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI=" alt="Default Avatar" class="w-full h-full object-cover rounded-full">
          </div>
        </div>
      </div>
      <form @submit.prevent="register" class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div class="mb-1">
          <label class="block text-gray-700" for="firstName">First Name</label>
          <input v-model="form.firstName" type="text" id="firstName" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-1">
          <label class="block text-gray-700" for="lastName">Last Name</label>
          <input v-model="form.lastName" type="text" id="lastName" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-1">
          <label class="block text-gray-700" for="email">Email</label>
          <input v-model="form.email" type="email" id="email" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-1">
          <label class="block text-gray-700" for="job">Password</label>
          <input v-model="form.job" type="text" id="job" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-1 md:col-span-2">
          <label class="block text-gray-700" for="address">Address</label>
          <input v-model="form.address" type="text" id="address" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div class="mb-1 md:col-span-2 flex space-x-2">
          <div class="w-1/3">
            <label class="block text-gray-700" for="date">Date of Birth</label>
            <input v-model="form.date" type="date" id="date" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
          </div>
        </div>
        <div class="md:col-span-2">
          <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
        </div>
      </form>
    </div>

    <!-- Image Options Modal -->
    <div v-if="imageOptionsVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-4 rounded-lg shadow-lg">
        <h3 class="text-lg font-bold mb-4">Select Image Source</h3>
        <button @click="triggerFileInput" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 mb-2">Upload File</button>
        <button @click="openCamera" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700">Use Camera</button>
        <button @click="closeImageOptions" class="mt-4 w-full bg-red-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-700">Cancel</button>
      </div>
    </div>

    <!-- Camera Modal -->
    <div v-if="cameraVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
        <video ref="video" class="w-full mb-4"></video>
        <button @click="captureImage" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-2">Capture</button>
        <button @click="closeCamera" class="w-full bg-red-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        firstName: '',
        lastName: '',
        phone: '',
        email: '',
        password: '',
        confirmPassword: '',
        date: '',
        job: '',
        address: ''
      },
      imagePreview: null,
      imageOptionsVisible: false,
      cameraVisible: false,
      videoStream: null
    }
  },
  methods: {
    triggerFileInput() {
      this.$refs.fileInput.click();
    },
    onImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.imagePreview = e.target.result;
        };
        reader.readAsDataURL(file);
      }
      this.closeImageOptions();
    },
    openImageOptions() {
      this.imageOptionsVisible = true;
    },
    closeImageOptions() {
      this.imageOptionsVisible = false;
    },
    openCamera() {
      this.imageOptionsVisible = false;
      this.cameraVisible = true;
      navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
          this.videoStream = stream;
          this.$refs.video.srcObject = stream;
          this.$refs.video.play();
        })
        .catch((err) => {
          console.error("Error accessing camera: ", err);
        });
    },
    captureImage() {
      const canvas = document.createElement('canvas');
      canvas.width = this.$refs.video.videoWidth;
      canvas.height = this.$refs.video.videoHeight;
      const context = canvas.getContext('2d');
      context.drawImage(this.$refs.video, 0, 0, canvas.width, canvas.height);
      this.imagePreview = canvas.toDataURL('image/png');
      this.closeCamera();
    },
    closeCamera() {
      if (this.videoStream) {
        this.videoStream.getTracks().forEach(track => track.stop());
      }
      this.cameraVisible = false;
    },
    register() {
      console.log("Form submitted", this.form, this.imagePreview);
    }
  }
}
</script>

<style>
/* Add any additional custom styles here */
</style>
