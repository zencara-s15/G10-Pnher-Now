<template>
    <WebLayout></WebLayout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <title>Card with Icons</title>
    </head>
    <body>
        <div class="form m-5">
            <div class="flex gap-3" style="width: 65%; margin: auto;">
                <div class="bg-orange-300 shadow-md rounded-lg p-6 flex-1">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-truck text-gray-500"></i>
                        <h5 class="text-2xl font-bold ml-15">10</h5>
                    </div>
                    <p class="text-gray-500 mt-3">On process delivery</p>
                </div>
                <div class="bg-orange-300 shadow-md rounded-lg p-6 flex-1">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-box text-gray-500"></i>
                        <h5 class="text-2xl font-bold ml-15">10</h5>
                    </div>
                    <p class="text-gray-500 mt-3">Total delivery</p>
                </div>
                <div class="bg-orange-300 shadow-md rounded-lg p-6 flex-1">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-comments text-gray-500"></i>
                        <h5 class="text-2xl font-bold ml-15">10</h5>
                    </div>
                    <p class="text-gray-500 mt-3">Total feedback</p>
                </div>
                <div class="bg-orange-300 shadow-md rounded-lg p-6 flex-1">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-money-bill text-gray-500"></i>
                        <h5 class="text-2xl font-bold ml-15">10</h5>
                    </div>
                    <p class="text-gray-500 mt-3">Total money earned</p>
                </div>
            </div>
        </div>
    </body>
</template>
<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue'
export default {
    components: {
        WebLayout
    },
    name: "AverageView",
}
</script>

<style scoped>

</style>