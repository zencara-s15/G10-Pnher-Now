<template>
    <WebLayout></WebLayout>
    <div class="container ml-50 col mt-5">
        <h2>Feedback From Customer</h2>
        <div v-for="user in users" :key="user.id" class="card" style="width: 70%;">
            <div class="card-body ">
                <div class="card-text d-flex " style="flex-direction: row;">
                    <img :src="user.avatar" alt="User Profile" class="avatar-fluid rounded-circle">
                    <div class="user-info d-flex ml-5">
                        <p class="first_name">{{ user.first_name }}</p>
                        <p class="last_name">{{ user.last_name }}</p>
                        <div class="star-icon">
                            <i class="fas fa-star" v-for="n in 5" :key="n"></i>
                        </div>
                    </div>
                </div>
                <div class="des ml-12">
                    <p class="descript">{{ user.descript }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import '@fortawesome/fontawesome-free/css/all.css';

export default {
    components: {
        WebLayout
    },
    name: 'FeedbackView',
    data() {
        return {
            users: [
                {
                    "id": 1,
                    "email": "michael.lawson@reqres.in",
                    "first_name": "Michael",
                    "last_name": "Lawson",
                    "descript": "This project involves creating a social media application that integrates with the Facebook API for user authentication and management.",
                    "avatar": "https://reqres.in/img/faces/7-image.jpg"
                },
                {
                    "id": 2,
                    "email": "lindsay.ferguson@reqres.in",
                    "first_name": "Lindsay",
                    "last_name": "Ferguson",
                    "descript": "This project involves creating a social media application that integrates with the Facebook API for user authentication and management.",
                    "avatar": "https://reqres.in/img/faces/8-image.jpg"
                },
                {
                    "id": 3,
                    "email": "tobias.funke@reqres.in",
                    "first_name": "Tobias",
                    "last_name": "Funke",
                    "descript": "This project involves creating a social media application that integrates with the Facebook API for user authentication and management.",
                    "avatar": "https://reqres.in/img/faces/9-image.jpg"
                },
                {
                    "id": 4,
                    "email": "byron.fields@reqres.in",
                    "first_name": "Byron",
                    "last_name": "Fields",
                    "descript": "This project involves creating a social media application that integrates with the Facebook API for user authentication and management.",
                    "avatar": "https://reqres.in/img/faces/10-image.jpg"
                },
                {
                    "id": 5,
                    "email": "george.edwards@reqres.in",
                    "first_name": "George",
                    "last_name": "Edwards",
                    "descript": "This project involves creating a social media application that integrates with the Facebook API for user authentication and management.",
                    "avatar": "https://reqres.in/img/faces/11-image.jpg"
                },
                {
                    "id": 6,
                    "email": "rachel.howell@reqres.in",
                    "first_name": "Rachel",
                    "last_name": "Howell",
                    "descript": "This project involves creating a social media application that integrates with the Facebook API for user authentication and management.",
                    "avatar": "https://reqres.in/img/faces/12-image.jpg"
                }
            ]
        }
    }
}
</script>

<style scoped>

.card {
    margin-top: 5px;
    padding: 10px;
    height: 18vh;
}

.card-body {
    display: flex;
    flex-direction: column;
}

.star-icon {
    display: flex;
    color: gold;
    margin-left: 10px;
}

.avatar-fluid {
    width: 30px;
    height: 30px;
}
</style>
