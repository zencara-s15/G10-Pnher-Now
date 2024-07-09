<template>
    <WebLayout></WebLayout>
    <div class="form ml-10 mt-3 d-flex">
        <h3 class="mb-3">Reguest for help</h3>
        <form class="request">
            <div class="img mr-6">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKTBull3qHk5M6LrZDxpTq3P_PMV40hk0Gnw&s"
                    alt="">
            </div>
            <div class="help mr-5">
                <h5 class="d-flex mb-3" style="justify-content: center;">Help</h5>
                <form class="w-full max-w-sm col">
                    <div class="md:flex md:items-center mb-6 mr-3">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-name">Name</label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                id="inline-name" type="text" value="Jane Doe">
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6 mr-3">
                        <div class="md:w-1/3">
                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                for="inline-descript">
                                Descript
                            </label>
                        </div>
                        <div class="md:w-2/3">
                            <input
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                id="inline-descript" type="descript" placeholder="" style="height: 40px;">
                        </div>
                    </div>
                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3 ml-3">
                            <button
                                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="button">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </form>
    </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';

export default {
    components: {
        WebLayout
    },
    name: 'FeedbackView',
}

</script>

<style scoped>
.form {
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

h3 {
    color: black;
}

.request {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    width: 800px;
    height: 70%;
    background: white;
}

img {
    width: 400px;
    height: 100%;
}

.help {
    flex-direction: column;
    padding: 5px;
    border: 1px solid orange;
}
</style>